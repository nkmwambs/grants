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

  // private function _get_context_definition(){

  //   $this->db->select(array('context_definition_id','context_definition_name'));
  //   $this->db->order_by('context_definition_level ASC');
  //   $context_definitions = $this->db->get('context_definition')->result_array();

  //   // $ids = array_column($context_definitions,'context_definition_id');
  //   // $vals = array_column($context_definitions,'context_definition_name');

  //   return combine_name_with_ids($context_definitions,'context_definition_id','context_definition_name');

  //   //return array_combine($ids,$vals);
  // }

  function result($id = ""){
    $result = [];
    
    if($this->action == 'single_form_add'){
      // $result['context_definition'] = $this->_get_context_definition();
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

    $context['context_center_user_name'] = "Office context for ".$post['user_firstname']." ".$post['user_lastname'];
    $context['fk_user_id'] = $user_id;
    $context['fk_context_'.$context_definition_name.'_id'] = $post['office_context'];
    $context['fk_designation_id'] = $post['designation'];
    $context['context_center_user_is_active'] = 1;

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
      echo "Error occurred";
    }else{
      echo "User created successfully";
    }

  }

  static function get_menu_list(){
  
  }

}
