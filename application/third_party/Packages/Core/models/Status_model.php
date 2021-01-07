<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Status_model extends MY_Model 
{
  public $table = 'status'; // you MUST mention the table name
  public $dependant_table = '';
  public $name_field = 'status_name';
  public $create_date_field = "status_created_date";
  public $created_by_field = "status_created_by";
  public $last_modified_date_field = "status_last_modified_date";
  public $last_modified_by_field = "status_last_modified_by";
  public $deleted_at_field = "status_deleted_at";

  function __construct(){
    parent::__construct();

  }

  function delete($id = null){

  }

  function index(){}

public function lookup_tables(){
  return array('approval_flow');
}

public function detail_tables(){
  return ['status_role'];
}

public function table_visible_columns(){}

public function table_hidden_columns(){}

public function master_table_visible_columns(){}

public function master_table_hidden_columns(){}

public function list(){}

public function view(){}

function transaction_validate_duplicates_columns(){
  return ['approval_flow_name','status_approval_sequence','status_approval_direction'];
}

function action_after_insert($post_array, $approval_id, $header_id){
  // Get approve item name of the of the created status
  $this->db->join('approval_flow','approval_flow.approval_flow_id=status.fk_approval_flow_id');
  $this->db->join('approve_item','approve_item.approve_item_id=approval_flow.fk_approve_item_id');
  $approve_item_name = $this->db->get_where('status',array('status_id'=>$header_id))->row()->approve_item_name;

  // Get the dependant/ detail table of the approve item name
  $approve_item_detail_name = $this->grants->dependant_table($approve_item_name);

  $this->db->join('approve_item','approve_item.approve_item_id=approval_flow.fk_approve_item_id');
  $dependant_table_approval_flow = $this->db->get_where('approval_flow',
    array('approve_item_name'=>$approve_item_detail_name))->row();

  if($approve_item_detail_name !== ""){
    $this->write_db->trans_start();
      $data['status_track_number'] = $this->grants_model->generate_item_track_number_and_name('status')['status_track_number'];
      $data['status_name'] = $post_array['status_name'];
      $data['fk_approval_flow_id'] = $dependant_table_approval_flow->approval_flow_id;
      $data['status_approval_sequence'] = $post_array['status_approval_sequence'];
      $data['status_backflow_sequence'] = $post_array['status_backflow_sequence'];
      $data['status_approval_direction'] = $post_array['status_approval_direction'];
      $data['status_is_requiring_approver_action'] = $post_array['status_is_requiring_approver_action'];
      $data['status_created_date'] = $post_array['status_created_date'];
      $data['status_created_by'] = $post_array['status_created_by'];
      $data['status_last_modified_by'] = $post_array['status_last_modified_by'];
      $data['fk_approval_id'] = $post_array['fk_approval_id'];
      $data['fk_status_id'] = $post_array['fk_status_id'];

      $this->write_db->insert('status',$data);
      $this->write_db->trans_complete();

    if($this->write_db->trans_status() == false){
      return false;
    }else{
      return true;
    }
  }

}

function status_approval_sequencies($change_field_type_sequencies){
  $lookup_values = [];

  if($this->id != null){
    $this->read_db->select(array('status_approval_sequence'));
    $this->read_db->where(array('approval_flow_id'=>hash_id($this->id,'decode'),
    'status_is_requiring_approver_action'=>1,'status_approval_direction'=>1));
    $this->read_db->join('approval_flow','approval_flow.approval_flow_id=status.fk_approval_flow_id');
    $status_approval_sequence_obj = $this->read_db->get('status');

    if($status_approval_sequence_obj->num_rows() > 0){
      $status_approval_sequence = array_flip(array_column($status_approval_sequence_obj->result_array(),'status_approval_sequence'));
      
      $all_status_approval_sequence = $change_field_type_sequencies;//$this->change_field_type()['status_approval_sequence'];

      foreach($status_approval_sequence as $status_approval_sequence_id => $status_approval_sequence_label){
        if(array_key_exists($status_approval_sequence_id,$all_status_approval_sequence)){
          unset($all_status_approval_sequence[$status_approval_sequence_id]);
        }
      }
    }

    $lookup_values =  $all_status_approval_sequence;
  }

  return $lookup_values;
}

function add(){
  $post = $this->input->post()['header'];
  $post_status_role = $this->input->post()['detail_header']['status_role'];

  $jumps = [1,0,-1]; // 1 = Submitted new Item, 0 = Submitted Reinstated Item, -1 = Declined Item
  
  $data = [];

  $message = get_phrase('insert_successful');

  $this->write_db->trans_start();

  foreach($jumps as $jump){

    $status_name = $post['status_name'];

    if($jump == 0){
      $status_name = 'Reinstated to '.$status_name;
    }elseif($jump == -1){
      $status_name = 'Declined from '.$status_name;
    }


    $status_approval_sequence = $post['status_approval_sequence'];
    $status_backflow_sequence =  $jump == -1 ? 1 : 0;
    $status_approval_direction = $jump;
    $status_is_requiring_approver_action = 1; // All custom status require an action from a user
    $approval_flow_id = $post['fk_approval_flow_id'];

    // Insert a fully approved status/ final status
    $this->insert_final_approval_status($approval_flow_id, $status_approval_sequence);

     // A new custom approval workflow status
    $status_id = $this->grants_model->insert_status($this->session->user_id,$status_name,$approval_flow_id,$status_approval_sequence,$status_backflow_sequence,$status_approval_direction,$status_is_requiring_approver_action);
    
    // Insert status Role
    if(is_array($post_status_role['fk_role_id'])){
      foreach($post_status_role['fk_role_id'] as $role_id){
        $this->insert_status_role($post_status_role,$role_id,$status_id,$status_name);     
      }
    }else{
      $this->insert_status_role($post_status_role,$post_status_role['fk_role_id'],$status_id,$status_name);
    }  
  } 

  $this->write_db->trans_complete();

  if(!$this->write_db->trans_status()){
    $message = get_phrase('insert_failed');
  }

  return $message;

}

function insert_final_approval_status($approval_flow_id, $status_approval_sequence){

  $this->read_db->where(array('fk_approval_flow_id'=>$approval_flow_id,
  'status_is_requiring_approver_action'=>0,
  'status_approval_direction'=>1,
  'status_backflow_sequence'=>0));
  $final_approval_status = $this->read_db->get('status');

  $max_sequency_level = $status_approval_sequence + 1;

  if($final_approval_status->num_rows() == 0){  
    $this->grants_model->insert_status($this->session->user_id,get_phrase('fully_approved'),$approval_flow_id,$max_sequency_level,0,1,0);
    $this->grants_model->insert_status($this->session->user_id,get_phrase('reinstate_after_allow_edit'),$approval_flow_id,$max_sequency_level,1,-1,1);
    $this->grants_model->insert_status($this->session->user_id,get_phrase('reinstated_after_edit'),$approval_flow_id,$max_sequency_level,0,0,1);
  }else{
    // Update to the status_approval_sequence to the last sequence
    $update_data['status_approval_sequence'] = $max_sequency_level;
    //$this->write_db->where(array('status_id'=>$final_approval_status->row()->status_id));
    $this->write_db->where(array('status_approval_sequence'=>$status_approval_sequence,
    'fk_approval_flow_id'=>$approval_flow_id));
    $this->write_db->update('status',$update_data);
  }
}


function insert_status_role($post_status_role,$role_id,$status_id,$status_name){
  $status_role_data['status_role_track_number'] = $this->grants_model->generate_item_track_number_and_name('status_role')['status_role_track_number'];
  $status_role_data['status_role_name'] = $status_name.' ['.$this->read_db->get_where('role',array('role_id'=>$role_id))->row()->role_name.']';
  $status_role_data['fk_role_id'] = $role_id;
  $status_role_data['status_role_status_id'] = $status_id;

  $status_role_data['status_role_created_by'] = $this->session->user_id;
  $status_role_data['status_role_created_date'] = date('Y-m-d');
  $status_role_data['status_role_last_modified_by'] = $this->session->user_id;

  $status_role_data['fk_approval_id'] = $this->grants_model->insert_approval_record('status_role');
  $status_role_data['fk_status_id'] = $this->grants_model->initial_item_status('status_role');

  $this->write_db->insert('status_role',$status_role_data);
}

function detail_tables_single_form_add_visible_columns(){
  return ['status_role'];
}

public function single_form_add_visible_columns(){
  return ['status_name','approval_flow_name','status_approval_sequence'];
}

function order_list_page():String{
  return 'status_approval_sequence ASC';
}

function detail_list_table_where(){
  if(!$this->session->system_admin){
    $this->db->group_start();
      $this->db->where(array('status_approval_sequence <> '=>1));
      $this->db->or_where(array('status_is_requiring_approver_action <> '=>0));
    $this->db->group_end();
  }
}

// function multi_select_field(){
//   return 'approval_flow';
// }

}
