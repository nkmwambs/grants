<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Approval_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'approval'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
  }

  function index(){}

  function lookup_tables(){
    return array('approve_item','status');
  }

  function detail_tables(){
    //,'budget','voucher','center','bank','permission','role_permission','project_allocation'
    return array('request','budget','voucher','office','bank','permission','role_permission','project_allocation');
  }

  function delete($id){

  }

  function detail_list(){}

  function master_view(){}

  public function list(){}

  public function view(){}

    // Access methods
  public function show_add_button(){
      return false;
  }

/**
 *  List table where
 * 
 *  Used in the run_list_query and ajax_model. Here it lists only approvaeable items
 * 
 */
  function list_table_where(){
    $this->db->where(array('approve_item.approve_item_is_active'=>1));
  }


 /***
  * *********************************************************************************************************
  * THESE ARE SYSTEM METHODS, PLEASE BE CONSCIOUS WHEN ALTERING THEM SINCE THE MAY AFFECT THE GENERAL 
  * PERFORMANCE OF THIS FRAMEWORK.
  *
  ***********************************************************************************************************
  */
  
  /**
   * get_status_id
   * 
   * Gives you the status id of a selected item
   * 
   * @param $table String
   * 
   * @param $primary  Int - Item primary key
   * 
   * @return int
   */
  function get_status_id($table,$primary_key){
    $fk_status_id = 0;

    $record_object = $this->db->get_where($table,array($table.'_id'=>$primary_key));

    if($record_object->num_rows()>0 && array_key_exists('fk_status_id',$record_object->row_array() ) ){
     $fk_status_id = $this->db->get_where($table,array($table.'_id'=>$primary_key))->row()->fk_status_id;
    }

    return $fk_status_id;
  } 

  /**
* The method produces an array of the valid approval status ids for the listed items
* These methods need to taken to the approval modal
* 
**/

function range_of_status_approval_sequence($approve_item_name){
  $this->db->select('MAX(status_approval_sequence) as status_approval_sequence');
  $this->db->join('approve_item','approve_item.approve_item_id=status.fk_approve_item_id');
  $max_range = $this->db->get_where('status',array('approve_item_name'=>$approve_item_name))->row()->status_approval_sequence;
  return $max_range;
}

function get_approveable_item_id_by_status($item_status){
    $this->db->select(array('approve_item_id'));
    $this->db->join('status','status.fk_approve_item_id=approve_item.approve_item_id');
    $result =  $this->db->get_where('approve_item',array('status_id'=>$item_status))->row()->approve_item_id;

    return $result;
}

function get_approve_item_name_by_status($item_status){

  $this->db->select(array('approve_item_name'));
  $this->db->join('status','status.fk_approve_item_id=approve_item.approve_item_id');
  $result =  $this->db->get_where('approve_item',array('status_id'=>$item_status))->row()->approve_item_name;

  return $result;
}

//Used for label naming e.g. Submit to [next_role_name]
function next_approval_actor($item_status){

  //Get approval item name using the status_id
  $approve_item_name = $this->get_approve_item_name_by_status($item_status);

  // Can remain a zero if this is the last status
  $next_approval_actor_role_id = 0; 

  $range_of_status_approval_sequence = $this->range_of_status_approval_sequence($approve_item_name);

  $approveable_item_id = $this->get_approveable_item_id_by_status($item_status);

  // 1.Get the status record
  $status_record = $this->db->get_where('status',array('status_id'=>$item_status))->row();

  // 2.Get the value of the approval direction
  $status_approval_direction = $status_record->status_approval_direction;

  // // 3.Get the record of the next status in the sequence and it's related role_id
  $next_possible_sequence_number = $status_record->status_approval_sequence + 1;
  // Check if this is not the last status
  $next_status_record = array();
  if($next_possible_sequence_number < $range_of_status_approval_sequence){

    $next_status_record = $this->db->get_where('status',
    array('status_approval_sequence'=>$next_possible_sequence_number,
    'fk_approve_item_id'=>$approveable_item_id))->row_array();
  }

  // // 4.Check if the approval direction is -1 then return the role id of the status record 
  // //else the role id of next sequence
    
    if($status_approval_direction == -1){

    $next_approval_actor_role_id = $status_record->fk_role_id;

    }elseif(is_array($next_status_record) && count($next_status_record) > 0){
      
      $next_approval_actor_role_id = $next_status_record['fk_role_id'];
    
    }

    return $next_approval_actor_role_id;
}

function current_approval_actor($item_status){

  //Get approval item name using the status_id
  $approve_item_name = $this->get_approve_item_name_by_status($item_status);

  $current_approval_actor_role_id = 0;

  $range_of_status_approval_sequence = $this->range_of_status_approval_sequence($approve_item_name);
  
  $approveable_item_id = $this->get_approveable_item_id_by_status($item_status);

  // Get the status record
  $status_record = $this->db->get_where('status',array('status_id'=>$item_status))->row();

  // Get the status record role_id of the status record
  $status_record_role_id = $status_record->fk_role_id;

  // Get the approval direction of the status record
  $status_record_direction = $status_record->status_approval_direction;

  // Get the backflow seq 
  $status_record_backflow = $status_record->status_backflow_sequence;

  // Check if backflow is gt 0 and if yes get record role id of its sequence
  if($status_record_backflow > 0){
      $status_record_role_id = $this->db->get_where('status',
      array('status_approval_sequence'=>$status_record_backflow,
      'fk_approve_item_id'=>$approveable_item_id))->row()->fk_role_id;
  
    }elseif($range_of_status_approval_sequence == $status_record->status_approval_sequence){
      // No current actor for the last approval sequence
      $status_record_role_id = 0;
  }

  return $status_record_role_id;

}

function get_status_name($item_status){
  return $this->db->get_where('status',
  array('status_id'=>$item_status))->row()->status_name;
}

function get_role_name($role_id){
  $role_name = "";
 
  $role = $this->db->get_where('role', array('role_id'=>$role_id));
  
  if($role->num_rows()>0){
    $role_name = $role->row()->role_name;
  }

  return $role_name;

}

function user_action_label($item_status,$role_id){
    //Get approval item name using the status_id
  $approve_item_name = $this->get_approve_item_name_by_status($item_status);
  $status_label = $this->get_status_name($item_status);
  $current_actor = $this->current_approval_actor($item_status);
  $next_actor = $this->next_approval_actor($item_status);
  $range_of_status_approval_sequence = $this->range_of_status_approval_sequence($approve_item_name);

  $next_actor_role_name = $this->get_role_name($next_actor);
  

  //Check if state has backflow value gt 0
  $status_record = $this->db->get_where('status',
  array('status_id'=>$item_status))->row();

  // Backflow seq value
  $backflow_sequence = $status_record->status_backflow_sequence;

  // Approval sequence
  $approval_sequence = $status_record->status_approval_sequence;

  // Check if the role id is the current actor or not and if final status in the sequence and created
  // the appropriate label 
  if($current_actor == $role_id &&  
      $backflow_sequence == 0 && 
        $approval_sequence < $range_of_status_approval_sequence && 
         $next_actor != 0
    ){
    $status_label = "Submit to ".$next_actor_role_name;
  }elseif($backflow_sequence > 0){
    $status_label = "Reinstate to ".$next_actor_role_name;
  }elseif($next_actor == 0){
    $status_label = 'Completed';
  }

  return $status_label;
}

function show_decline_button($item_status){
  // Just return the value of the actor receiving the declined item.
  $status_record = $this->db->get_where('status',array('status_id'=>$item_status))->row();

  // Get the approval direction
  $approval_direction  = $status_record->status_approval_direction;

  $has_decline_button = false;

  $current_actor = $this->current_approval_actor($item_status);

  if(($approval_direction == 1 || $approval_direction == 0) && 
      $current_actor > 0 && 
        $status_record->status_approval_sequence != 1
  )
  {
          $has_decline_button = true;
  }

  return $has_decline_button;
}

function next_status($item_status){

  $next_status_id = 0;

  $approve_item_name = $this->get_approve_item_name_by_status($item_status);

  $range_of_status_approval_sequence = $this->range_of_status_approval_sequence($approve_item_name);

  $approveable_item_id = $this->get_approveable_item_id_by_status($item_status);

  //Get status record
  $status_record = $this->db->get_where('status',array('status_id'=>$item_status))->row();

  // //Get the status id
  $status_approval_sequence = $status_record->status_approval_sequence;

  //Check if is not the last approval step
  if($status_approval_sequence < $range_of_status_approval_sequence){
    
    $next_approval_seq = $status_approval_sequence + 1;
    
    $next_status_id_obj = $this->db->get_where('status',
    array('status_approval_sequence'=>$next_approval_seq,
    'fk_approve_item_id'=>$approveable_item_id));

    if($next_status_id_obj->num_rows() > 0){
      $next_status_id = $next_status_id_obj->row()->status_id;
    }
  }

  // // Get the backflow seq
  $backflow_sequence = $status_record->status_backflow_sequence;

  //Check if the backflow seq > 0 and get and return its status id or else return the record status id
  if($backflow_sequence > 0){

    $next_status_id = $this->db->get_where('status',
    array('status_approval_sequence'=>$status_approval_sequence,
    'fk_approve_item_id'=>$approveable_item_id,'status_approval_direction'=>0))->row()->status_id;
  }



  return $next_status_id;

}

function decline_status($item_status){
  $next_decline_status = 0;

  // Same approval seq but has -1 direction 
  $status_record = $this->db->get_where('status',array('status_id'=>$item_status))->row();
  $approveable_item_id = $this->get_approveable_item_id_by_status($item_status);

  // Approval seq
  $approval_sequence = $status_record->status_approval_sequence;
  
  // Decline status
  $decline_status_record = $this->db->get_where('status',
  array('status_approval_sequence'=>$approval_sequence,'status_approval_direction'=>-1,
  'fk_approve_item_id'=>$approveable_item_id));

  if($decline_status_record->num_rows() > 0){
    $next_decline_status = $decline_status_record->row()->status_id;
  }

  return $next_decline_status;

}

function show_label_as_button($item_status,$logged_role_id,$table,$primary_key){

  $table = $this->get_approve_item_name_by_status($item_status);

  $current_approval_actor = $this->current_approval_actor($item_status);
  $logged_user_centers = array_column($this->session->hierarchy_offices,'office_id');
  $record_center_id = $this->grants->get_record_office_id($table,$primary_key);
  $is_approveable_item = $this->grants->approveable_item($table);

  // if($record_center_id == 0){

  // }

  $show_label_as_button = false; 
  
  if( is_array($logged_user_centers) && $logged_role_id == $current_approval_actor && 
      //in_array($record_center_id,$logged_user_centers) &&
      $is_approveable_item){
    $show_label_as_button = true;
  }

  return $show_label_as_button;

}

// function get_count_of_approval_workflow_levels($approveable_item_id){
//   $number_of_levels = $this->db->get_where('status',array('fk_approve_item_id'=>$approveable_item_id))->num_rows();
// }

function display_approver_status_action($logged_role_id,$table,$primary_key){
  /**
   * Given the status find the following:
   * 
   * - Who is the next actor? - The next actor is the role id represented by the next approval sequence number.
   *    But if the next status has an approval direction of -1, then the next actor is the role_id directly
   *    Next actor for all declines is derived by the value of backflow sequence status item of an item
   *    the same approval sequence with a direction of -1, get the related role id
   * 
   * - What is the currect status label or both the actor and others viewers? For the actor use 
   *  (Submit to or Decline to [role_name] and for  and for others use Submitted to or Declined to [role_name]
   *  except for the last in the sequence to the label Completed) - Status Action Label field is redundant since labels will be generic
   *  If status has backflow value > 0 then use Reinstate to [role_name] when accessing as s the current user
   * 
   * - Who is the current actor? Use the role id directly. But when value of approval direction is -1 and 
   *  backflow sequence has a value, then used the role id represented by the value in the backflow sequence.
   * 
   * - Show a decline button when? Show when the current approval sequence has 1 0r 0 approval directions
   * 
   * - What is the next status? - Use the status id of the next approval sequence but if the 
   *   approval direction is -1 then use the status represented by the backflow sequence
   * 
   * - The last status is irreversible
   *  
   */
    
    $approval_button_info = [];

    $item_status = $this->get_status_id($table,$primary_key);

    if($item_status > 0){

      $approval_button_info['current_actor_role_id'] = $this->current_approval_actor($item_status);
      $approval_button_info['next_actor_role_id'] = $this->next_approval_actor($item_status);
      $approval_button_info['status_name'] = $this->get_status_name($item_status);
      $approval_button_info['button_label'] = $this->user_action_label($item_status, $logged_role_id);
      $approval_button_info['show_decline_button'] = $this->show_decline_button($item_status);
      $approval_button_info['next_approval_status'] = $this->next_status($item_status);
      $approval_button_info['next_decline_status'] = $this->decline_status($item_status);
      $approval_button_info['show_label_as_button'] = $this->show_label_as_button($item_status,$logged_role_id,$table,$primary_key);
  
    }

    return $approval_button_info;

}

/**
 * get_max_approval_status_id
 * 
 * Gets the max approval status id
 * 
 * @param String $approveable_item
 * @return Int 
 */
function get_max_approval_status_id(String $approveable_item):Int{

  //Get the maximum status_approval_sequence of an approveable item
  $this->db->join('approve_item','approve_item.approve_item_id=status.fk_approve_item_id');
  $max_status_approval_sequence = $this->db
  ->select("max(status_approval_sequence) as status_approval_sequence")
  ->get_where('status',array('approve_item_name'=>$approveable_item))
  ->row()->status_approval_sequence;

  // Get the status_id
  $this->db->select('status_id');
  $this->db->join('approve_item','approve_item.approve_item_id=status.fk_approve_item_id');
  $max_status_id = $this->db->get_where('status',
  array('status_approval_sequence'=>$max_status_approval_sequence,'approve_item_name'=>$approveable_item))->row()->status_id;

  return $max_status_id;
}

/**
 * is_max_status_id
 * 
 * Check if the provided approval status id is maximum
 * 
 * @param String $approveable_item 
 * @param Int $status_id
 * 
 * @return Bool - True is Max while False is not 
 */
function is_max_approval_status_id(String $approveable_item,Int $status_id):Bool{
  $is_max_status_id = false;

  $max_status_id = $this->get_max_approval_status_id($approveable_item);

  if($status_id == $max_status_id){
    $is_max_status_id = true;
  }

  return $is_max_status_id;
}

/**
 * has_approval_status_been_set
 * 
 * Check if the approvaeable item has other approval statuses other than the "New" status 
 * auto-created by the system
 * 
 * @param String $approveable_item
 * @return Bool
 */

function has_approval_status_been_set(String $approveable_item):Bool{

  $has_approval_status_been_set = false;

  $this->db->join('approve_item','approve_item_id=status.fk_approve_item_id');
  $count_of_status = $this->db
  ->get_where('status',array('approve_item_name'=>$approveable_item))
  ->num_rows();

  if($count_of_status > 0){
    $has_approval_status_been_set = true;
  }

  return $has_approval_status_been_set;

}

// function approval_action_buttons($logged_role_id,$table,$primary_key){
  
// }

}
