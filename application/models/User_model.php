<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class User_model extends MY_Model
{
  public $table = 'user'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){

  }

  function detail_table(){
    return array('user_detail');
  }

  function lookup_tables(){
    return array('language','role');
  }

  function list(){

  }

  function list_table_visible_columns(){
    return array('user_id','user_track_number','user_name','user_firstname',
    'user_lastname','user_email','user_system_admin','user_is_active');
  }

  function single_form_add_visible_columns(){
    return array('user_name','user_firstname','user_lastname','user_email',
    'user_system_admin','user_password','language_name','role_name');
  }

  function default_launch_page($user_id){

    $default_launch_page = $this->config->item('default_launch_page');

    // $this->db->select(array('user_detail_value'));
    // $this->db->join('user_detail','user_detail.fk_user_id=user.user_id');
    // $this->db->join('user_setting','user_setting.user_setting_id=user_detail.fk_user_setting_id');
    // $user_object = $this->db->get_where('user',
    // array('user_id'=>$user_id,'user_setting_name'=>'default_launch_page'));

    // if($user_object->num_rows() > 0){
    //   $default_lauch_page = $user_object->row()->default_lauch_page;
    // }

    return strtolower($default_launch_page);

  }

  function get_user_permissions($role_id){    
 
      $role_permission_array = array();

      // Get role permissions for the role
      $this->db->select(array('menu_derivative_controller','permission_label_name','permission_name','permission_type'));
      //$this->db->select(array('menu_derivative_controller','permission_label_name','permission_name'));    
      
      $this->db->join('permission','permission.permission_id=role_permission.fk_permission_id');
      $this->db->join('permission_label','permission_label.permission_label_id=permission.fk_permission_label_id');
      $this->db->join('menu','menu.menu_id=permission.fk_menu_id');
  
      $role_permissions_object = $this->db->get_where('role_permission',
      array('fk_role_id'=>$role_id,'role_permission_is_active'=>1));
  
      // Build the $role_permission_array if $role_permissions_object is not empty
  
        if($role_permissions_object->num_rows() > 0){
  
          $role_permissions = $role_permissions_object->result_object();
  
          foreach($role_permissions as $row){
              $role_permission_array[$row->menu_derivative_controller][$row->permission_type][$row->permission_label_name] = $row->permission_name;
          }
        
        }

        // Check if default permission is not present, add it

        if( !array_key_exists($this->config->item('default_launch_page'),$role_permission_array) || 
            !in_array('read',$role_permission_array)
          ){
          $role_permission_array[$this->config->item('default_launch_page')][1]['read'] = "show_dashboard";
        }
  
        return $role_permission_array;
  }


  function check_role_has_permissions($active_controller,$permission_label,$permission_type = 1){
      $permission = $this->session->role_permissions;

      $has_permission = false;

      if( (array_key_exists($active_controller,$permission) && 
          array_key_exists($permission_type,$permission[$active_controller]) &&
          array_key_exists($permission_label,$permission[$active_controller][$permission_type])) ||
          $this->session->system_admin
        ){
          $has_permission = true;
        } 
  
       return $has_permission; 
  }

}