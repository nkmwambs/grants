<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class User extends MY_Controller 
{

  function __construct(){
    parent::__construct();
    
    $this->load->library('user_library');

  }

  function index(){}

  private function _get_user_info(){
    $this->db->select(array('user_id','user_firstname','user_lastname','user_name','user_email','user_is_context_manager','user_is_system_admin','user_is_active'));
    $this->db->select(array('context_definition_id','context_definition_name','language_id','language_name','role_id','role_name'));
    $this->db->join('context_definition','context_definition.context_definition_id=user.fk_context_definition_id');
    $this->db->join('language','language.language_id=user.fk_language_id');
    $this->db->join('role','role.role_id=user.fk_role_id');
    $user = $this->db->get_where('user',array('user_id'=>hash_id($this->id,'decode')))->row_array();
    
    return $user;
  }

  private function _get_user_departments($user_id){
    // User can raise a request to any department irrespective of which he/she belongs
    $this->db->select(array('department_id','department_name'));
    $this->db->join('department_user','department_user.fk_department_id=department.department_id');
    $result = $this->db->get_where('department',array('department_is_active'=>1,'fk_user_id'=>$user_id))->result_array();

    return $result;
  
}

/**
 * @todo - This will change with the approval status update 
 */
private function _get_approval_assignments($role_id){
  $this->db->select(array('status_name','approve_item_name'));
  
  $this->db->join('approval_flow','approval_flow.approval_flow_id=status.fk_approval_flow_id');
  $this->db->join('approve_item','approve_item.approve_item_id=approval_flow.fk_approve_item_id');
  $status = $this->db->get_where('status',array('fk_role_id'=>$role_id,'status_is_requiring_approver_action'=>1))->result_array();

  return $status;
}

  function result($id = ""){
    $result = [];
    
    if($this->action == 'view'){
        $result['user_info'] = $this->_get_user_info();
        $result['role_permission'] = $this->user_model->get_user_permissions($this->_get_user_info()['role_id']);
        $result['user_hierarchy_offices'] = $this->user_model->user_hierarchy_offices($this->_get_user_info()['user_id'],true);
        $result['user_departments'] = $this->_get_user_departments($this->_get_user_info()['user_id']);
        $result['approval_workflow_assignments'] = $this->_get_approval_assignments($this->_get_user_info()['role_id']);
    }else{
      $result = parent::result($id);
    }

    return $result;
  }  

  function get_ajax_response_for_selected_definition(){

    $post = $this->input->post();

    $result = $this->user_model->get_available_office_user_context_by_email_context_definition($post['user_email'],$post['context_definition_id']);
    
    $list_of_contexts = $result['result'];
    $message = $result['message'];
    $list_of_departments = $this->get_user_available_department_department_by_email($post);
    $list_of_designation = $this->get_user_designation($post['context_definition_id']);

    $office_contexts_by_id = combine_name_with_ids($list_of_contexts,'context_table_id','context_table_name');
    $departments_by_id = combine_name_with_ids($list_of_departments,'department_id','department_name');
    $user_designation = combine_name_with_ids($list_of_designation,'designation_id','designation_name');
    

    $select_office_context = $this->grants->select_field('office_context',$office_contexts_by_id);
    $select_departments = $this->grants->select_field('department',$departments_by_id);
    $select_designation = $this->grants->select_field('designation',$user_designation);
    
    echo json_encode(array('select_office_context'=>$select_office_context,'select_designation'=>$select_designation,'select_department'=>$select_departments,'message'=>$message));
  }

  function get_user_designation($context_definition_id){
    $this->db->select(array('designation_id','designation_name'));
    return $this->db->get_where('designation',array('fk_context_definition_id'=>$context_definition_id))->result_array();
  }

  function get_user_available_department_department_by_email($post_array){

    $user_obj = $this->db->get_where('user',array('user_email'=>$post_array['user_email']));
    $departments = [];
    
    if($user_obj->num_rows() > 0){
      $user_department_assigned_obj = $this->db->get_where('department_user',array('fk_user_id'=>$user_obj->row()->user_id));

      if($user_department_assigned_obj->num_rows() > 0){

          $department_ids = array_column($user_department_assigned_obj->result_array(),'fk_department_id');

          $this->db->select(array('department_id','department_name'));
          $this->db->where_not_in('department_id',$department_ids);
          $this->db->where(array('department_is_active'=>1));
          $departments  = $this->db->get('department')->result_array();
      }else{

          $this->db->select(array('department_id','department_name'));
          $this->db->where(array('department_is_active'=>1));
          $departments  = $this->db->get('department')->result_array();
      }

    }else{
          $this->db->select(array('department_id','department_name'));
          $this->db->where(array('department_is_active'=>1));
          $departments  = $this->db->get('department')->result_array();
    }
    

    return $departments;
  }

  function check_if_email_is_used(){
    $post = $this->input->post();
    $this->db->or_where(array('user_name'=>$post['user_name'],'user_email'=>$post['user_email']));
    $count_of_users_with_email = $this->db->get('user')->num_rows();

    $valid_email = true;

    if($count_of_users_with_email > 0){
       $valid_email = false; 
    }

    echo $valid_email;
  }

  function list_role_permissions($role_id){
    echo json_encode($this->user_model->get_user_permissions($role_id));
  }

  function create_new_user(){
    $post = $this->input->post()['header'];
    
    $this->db->trans_start();

    $user['user_name'] = $post['user_name'];
    $user['user_firstname'] = $post['user_firstname'];
    $user['user_lastname'] = $post['user_lastname'];
    $user['user_email'] = $post['user_email'];
    $user['fk_context_definition_id'] = $post['fk_context_definition_id'];
    $user['user_is_context_manager'] = $post['user_is_context_manager'];
    $user['user_is_system_admin'] = $post['user_is_system_admin'];
    $user['fk_language_id'] = $post['fk_language_id'];
    $user['user_is_active'] = $post['user_is_active'];
    $user['fk_role_id'] = $post['fk_role_id'];
    $user['user_password'] = md5($post['user_password']);


    $user_to_insert = $this->grants_model->merge_with_history_fields($this->controller,$user,false);

    $this->db->insert('user',$user_to_insert);

    $user_id = $this->db->insert_id();

    // Insert an office context 
    $context_definition_name = $this->db->get_where('context_definition',array('context_definition_id'=>$post['fk_context_definition_id']))->row()->context_definition_name;
    $context_definition_user_table = 'context_'.$context_definition_name.'_user';

    $context[$context_definition_user_table.'_name'] = "Office context for ".$post['user_firstname']." ".$post['user_lastname'];
    $context['fk_user_id'] = $user_id;
    $context['fk_context_'.$context_definition_name.'_id'] = $post['office_context'];
    $context['fk_designation_id'] = $post['designation'];
    $context[$context_definition_user_table.'_is_active'] = 1;

    // $context[$context_definition_user_table.'_created_by'] = 1;
    // $context[$context_definition_user_table.'_last_modified_by'] = 1;
    // $context[$context_definition_user_table.'_created_date'] = date('Y-m-d');
    // $context[$context_definition_user_table.'_last_modified_date'] = date('Y-m-d h:i:s');
    // $context[$context_definition_user_table.'_track_number'] = $this->grants_model->generate_item_track_number_and_name($context_definition_user_table)[$context_definition_user_table.'_track_number'];
    // $context['fk_approval_id'] = $this->grants_model->insert_approval_record($context_definition_user_table);
    // $context['fk_status_id'] = $this->grants_model->initial_item_status($context_definition_user_table);

    $context_to_insert = $this->grants_model->merge_with_history_fields($context_definition_user_table,$context,false);

    $this->db->insert($context_definition_user_table,$context_to_insert);

    // Insert user department
    $department['department_user_name'] = "Department for ".$post['user_firstname']." ".$post['user_lastname'];
    $department['fk_user_id'] = $user_id;
    $department['fk_department_id'] = $post['department'];
    
    $department_to_insert = $this->grants_model->merge_with_history_fields('department_user',$department,false);

    $this->db->insert('department_user',$department_to_insert);

    $this->db->trans_complete();

    if($this->db->trans_status() == false){
      //echo "Error occurred";
      echo json_encode($context_to_insert);
    }else{
      echo "User created successfully";
    }

  }

  static function get_menu_list(){
  
  }

}
