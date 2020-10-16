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

public function single_form_add_visible_columns(){
  return ['status_name','approval_flow_name','status_approval_sequence','status_approval_direction','status_backflow_sequence','status_is_requiring_approver_action'];
}

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

}
