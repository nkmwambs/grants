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

  function get_user_permissions($role_id){    
 
      $role_permission_array = array();

      // Get role permissions for the role
      $this->db->select(array('menu_derivative_controller','permission_label_name','permission_name'));
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
              $role_permission_array[$row->menu_derivative_controller][$row->permission_label_name] = $row->permission_name;
          }
        
        }

        // Check if default permission is not present, add it

        if( !array_key_exists($this->config->item('default_launch_controller'),$role_permission_array) || 
            !in_array('read',$role_permission_array)
          ){
          $role_permission_array[$this->config->item('default_launch_controller')]['read'] = "show_dashboard";
        }
  
        return $role_permission_array;
  }

  function perms($role_id = 1){
      $permission = array();

      $permission['Center']['create'][] = 'add_center';
      $permission['Center']['read'][] = 'show_center';
      $permission['Center']['update'][] = 'edit_center';
      $permission['Center']['update'][] = 'approve_center';
      $permission['Center']['update'][] = 'decline_center';
      $permission['Center']['delete'][] = 'delete_center';

      $permission['Approval']['read'][] = 'add_approval';

      $permission['Role_permission']['read'][] = 'add_role_permission';

      $permission['Role']['read'][] = 'add_role_permission';

      $permission['Permission']['read'][] = 'add_role_permission';
    
      return $permission;

  }

  function check_role_has_permissions($active_controller,$permission_label){
      $permission = $this->session->role_permissions;

      $has_permission = false;

      if( (array_key_exists($active_controller,$permission) && 
          array_key_exists($permission_label,$permission[$active_controller])) ||
          $this->session->system_admin
        ){
          $has_permission = true;
        } 
  
       return $has_permission; 
  }

}