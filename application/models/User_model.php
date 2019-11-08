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

  /**
   * index
   * 
   * The model's index method
   * 
   * @return void
   */
  function index(){

  }

  /**
   * detail_table
   * 
   * It lists as an array all the table who have a foreign relationship to the User Table
   * 
   * @return Array : Table's foreign tables
   */
  function detail_table():Array {
    return array('user_detail');
  }

  function lookup_tables(){
    return array('language','role');
  }

  /**
   * list
   * 
   * Alternative list query result from the grants model one
   * @todo Not used yet
   * 
   * @return Array
   */
  function list(){

  }

  /**
   * list_table_visible_columns
   * 
   * Visible/ selected columns to the user list action page
   * 
   * @return Array
   */
  function list_table_visible_columns(): Array {
    return array('user_id','user_track_number','user_name','user_firstname',
    'user_lastname','user_email','user_system_admin','user_is_active');
  }

  /**
   * single_form_add_visible_columns
   * 
   * Visible or selected columns to the single_form_add action page
   * 
   * @return Array
   */

  function single_form_add_visible_columns(): Array {
    return array('user_name','user_firstname','user_lastname','user_email',
    'user_system_admin','user_password','language_name','role_name');
  }

  /**
   * default_launch_page
   * 
   * Setting the default launch page if user detail table has any for the logged user otherwise use the one 
   * provided by the config file (grants)
   * 
   * @param $user_id int : User id 
   * @todo Not yet able to read the data from the User detail table
   * 
   * @return String : Alternative default launch page specific to this user
   */
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

  /**
   * get_user_permissions
   * 
   * Get all permissions of a given role as an array of format [table:[permission_type:[permission_label:[permission_name]]]]
   * 
   * @param $role_id : Role of a user
   * 
   * @return Array
   */
  function get_user_permissions($role_id){    
 
      $role_permission_array = array();

      // Get role permissions for the role
      $this->db->select(array('menu_derivative_controller','permission_type','permission_label_name','permission_field','permission_name'));
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
              if($row->permission_type == 1){
                $role_permission_array[$row->menu_derivative_controller][$row->permission_type][$row->permission_label_name][] = $row->permission_name;  
              }elseif($row->permission_type == 2){
                $role_permission_array[$row->menu_derivative_controller][$row->permission_type][$row->permission_label_name][$row->permission_field] = $row->permission_name;
              }
              
          }
        
        }

        // Check if default permission is not present, add it

        if( !array_key_exists($this->config->item('default_launch_page'),$role_permission_array) || 
            !in_array('read',$role_permission_array)
          ){
          $role_permission_array[$this->config->item('default_launch_page')][1]['read'][] = "show_dashboard";
        }
  
        return $role_permission_array;
  }


  /**
   * check_role_has_permissions
   * 
   * Check if a user user has permission to access a page or 
   * any of the controlled fields in of a selected table.   
   * 
   * @param $active_controller String : Selected Table
   * @param $permission_label String : Permission label [Can be create, read, update or delete]
   * @param $permission_type int : Can with be 1 0r 2; 1 means Page Access Permission and 2 means Field Access Permission
   * 
   * @return Boolean
   */
  function check_role_has_permissions(String $active_controller,String $permission_label,int $permission_type = 1): bool {
      $permission = $this->session->role_permissions;

      $has_permission = false;

      $active_controller = ucfirst($active_controller);

      if( (array_key_exists($active_controller,$permission) && 
          array_key_exists($permission_type,$permission[$active_controller]) &&
          array_key_exists($permission_label,$permission[$active_controller][$permission_type])) ||
          $this->session->system_admin
        ){
          $has_permission = true;
        } 
  
       return $has_permission; 
  }

  /**
   * check_role_has_field_permission
   * It helps to check if the logged user has permission to acccess a controlled field based on their role
   * Any field that has been flagged in the permission table is referred to as a controlled field
   * 
   * @param $active_controller String : Active table
   * @param $permission_label String : Selected permission label [Can be create, update, delete or read]
   * @param $column String : Name of the passed column to check permission for
   * 
   * @return Boolean : True means has pemission while False means has no permission
   */
  function check_role_has_field_permission(String $active_controller,String $permission_label,
  String $column): bool {
    
    $has_permission = false;
    
    $active_controller = ucfirst($active_controller);

    //Is the passed column is a permission controlled field?
    $this->db->join('menu','menu.menu_id=permission.fk_menu_id');
    $is_column_controlled = $this->db->get_where('permission',
    array('menu_derivative_controller'=>$active_controller,'permission_field'=>$column));

    if($is_column_controlled->num_rows() > 0){
      // Yes, it permission controlled
      $has_permission = $this->check_role_has_permissions($active_controller,$permission_label,2);
    }else{
      // No its not permission controlled
      $has_permission = true;
    }


    return $has_permission;

  }

}