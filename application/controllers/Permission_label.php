<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Permission_label extends MY_Controller
{

  function __construct(){
    parent::__construct();

    $this->grants->table_setup('permission');
  }
  function index(){}

  function result($id = ""){

    // Create a missing CRUD Page Access permission
    $this->_create_missing_page_access_permission();

    $permissions = $this->_get_permissions_grouped_by_label();

    // Permission labels
    $permission_labels =  array_column($this->_get_permission_labels(),'permission_label_name');
    $permission_label_ids =  array_column($this->_get_permission_labels(),'permission_label_id');
    $permission_labels_with_id_keys = array_combine($permission_label_ids,$permission_labels);

    // Permission labels with their permissions
    $permissions = $this->_get_permissions_grouped_by_label();

    $roles_permission = $this->_get_roles_with_permission();
    
    return array('permission_labels'=>$permission_labels_with_id_keys,'permissions'=>$permissions,'roles_permission'=>$roles_permission);
  }

  private function _create_missing_page_access_permission(){
    // Get all menu items
    $menus = $this->db->get('menu');
    $page_access_permissions = $this->db->get_where('permission',array('permission_type'=>1));
    $permission_labels = $this->db->get('permission_label');

    $count_of_menus = $menus->num_rows();
    $count_of_page_access_permissions = $page_access_permissions->num_rows();
    $count_of_permission_labels = $permission_labels->num_rows();

    //$this->grants_model->mandatory_fields('permission');

    $this->db->trans_start();
    
    // Only create a permission if count of menus are more that the permissions available
    if(($count_of_page_access_permissions * $count_of_permission_labels) < ($count_of_menus * $count_of_permission_labels) ){
      foreach($menus->result_array() as $menu_item){
        
        // Only create a missing permission for a given menu item and permission label
        foreach($permission_labels->result_array() as $permission_label){
          if($this->db->get_where('permission',
          array('fk_permission_label_id'=>$permission_label['permission_label_id'],
          'permission_type'=>1,'fk_menu_id'=>$menu_item['menu_id']))->num_rows() == 0){

              $permission_data['permission_name'] = ucfirst($permission_label['permission_label_name']).' '.str_replace('_',' ',$menu_item['menu_name']);
              $permission_data['permission_description'] = ucfirst($permission_label['permission_label_name']).' '.str_replace('_',' ',$menu_item['menu_name']);
              $permission_data['permission_is_active'] = 1;
              $permission_data['fk_permission_label_id'] = $permission_label['permission_label_id'];
              $permission_data['permission_type'] = 1; // Page Access
              $permission_data['permission_field'] = 0; // Always 0 for Page Access
              $permission_data['fk_menu_id'] = str_replace('_',' ',$menu_item['menu_id']);

              $permission_data_to_insert = $this->grants_model->merge_with_history_fields('permission',$permission_data,false);


              $this->db->insert('permission',$permission_data_to_insert);
          
            }
        }
      }
    }

    $this->db->trans_complete();

    if($this->db->trans_status() == false){
      $message = "Error occurred when mass creating system page access permissions";
      show_error($message,500,'An Error As Encountered');
    }else{
      
    }

  }

  private function _get_permission_labels(){
    $this->db->select(array('permission_label_id','permission_label_name'));
    return $this->db->get('permission_label')->result_array();
  }

  private function _get_permissions_grouped_by_label(){

    $this->db->select(array('permission_label_id','permission_label_name','permission_id','permission_name','menu_id','menu_name','permission_type'));
    $this->db->join('permission_label','permission_label.permission_label_id=permission.fk_permission_label_id');
    $this->db->join('menu','menu.menu_id=permission.fk_menu_id');
    $permissions = $this->db->get_where('permission',array('permission_is_active'=>1))->result_array();

    $order_array = [];

    foreach($permissions as $permission){
      $permission_label_id = array_shift($permission);
      $order_array[$permission_label_id][] = $permission;
    }

    return $order_array;
  }

  function _get_roles_with_permission(){
    $this->db->select(array('fk_permission_id','role_id','role_name','role_permission_is_active'));
    $this->db->join('role','role.role_id=role_permission.fk_role_id');
    $roles_with_permission = $this->db->get('role_permission')->result_array();

    $ordered_array = [];

    foreach($roles_with_permission as $role_with_permission){
      $permission_id = array_shift($role_with_permission);
      $ordered_array[$permission_id][] = $role_with_permission;
    }

    return $ordered_array;

  }

  function get_available_roles_for_permission(){
    
    $permission_id  = $this->input->post('permission_id');

    // Used roles in the current permission
    $this->db->select(array('fk_role_id as role_id'));
    $used_roles_obj = $this->db->get_where('role_permission',
    array('fk_permission_id'=>$permission_id));

    $this->db->select(array('role_id','role_name'));
    if($used_roles_obj->num_rows() > 0){
      $this->db->where_not_in('role_id',array_column($used_roles_obj->result_array(),'role_id'));
    }
    
    $role = $this->db->get_where('role',array('role_is_active'=>1))->result_object();

    $ids = array_column($role,'role_id');
    $names = array_column($role,'role_name');
    $select_array = array_combine($ids,$names);

    echo select_element($select_array,get_phrase('available_roles'),['available-roles'],$permission_id);
    
  }

  function create_a_new_role_permission(){
    $post = $this->input->post();

    $this->db->trans_start();

    $permission = $this->db->get_where('permission',array('permission_id'=>$post['permission_id']))->row();

    $roles_permission_data['role_permission_name'] = $permission->permission_name.' permission assigned to '.$post['role_name']. 'role';
    $roles_permission_data['role_permission_is_active'] = 1;
    $roles_permission_data['fk_role_id'] = $post['role_id'];
    $roles_permission_data['fk_permission_id'] = $post['permission_id'];
    
    $roles_permission_data_to_insert = $this->grants_model->merge_with_history_fields('role_permission',$roles_permission_data,false);

    $this->db->insert('role_permission',$roles_permission_data_to_insert);

    $this->db->trans_complete();

    if($this->db->trans_status() == false){
      echo false;
    }else{
      echo true;
    }

  }

  function update_role_permission(){
    $post = $this->input->post();

    $this->db->trans_start();

    $this->db->where(array('fk_role_id'=>$post['role_id'],'fk_permission_id'=>$post['permission_id']));
    $role_permission_data = array('role_permission_is_active'=>$post['role_permission_is_active']);
    $this->db->update('role_permission',$role_permission_data);

    $this->db->trans_complete();

    if($this->db->trans_status() == false){
      echo "Update failure";
    }else{
      echo "Update successful";
    }
  }

  static function get_menu_list(){

  }

}
