<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Menu_model extends CI_Model {

function __construct(){
  parent::__construct();
  $this->load->database();
}

function get_count_of_menu_items(){
  return $this->db->get('menu')->num_rows();
}

function get_count_of_user_menu_items(){
  return $this->db->get_where('menu_user_order',array('fk_user_id'=>$this->session->user_id))->num_rows();
}

function upsert_menu($menus){
  $data = array();

      foreach ($menus as $menu=>$menuItems) {
        $data['menu_name'] = $menu;
        $data['menu_derivative_controller'] = $menu;

        if($this->db->get_where('menu',array('menu_derivative_controller'=>$menu))->num_rows() == 0){
            $this->db->insert('menu',$data);
        }else{
          $this->db->where(array('menu_derivative_controller'=>$menu));
          $this->db->update('menu',$data);
        }
      }

}

function upsert_user_menu(){

    // Get all menu elements
    $menu_elements =  $this->db->get('menu')->result_array();

    //Array of menu ids
    $menu_ids = array_column($menu_elements,'menu_id');

    $sizeOfUserMenuItems = $this->get_count_of_user_menu_items();
    $sizeOfMenuItemsByDatabase = $this->get_count_of_menu_items();

    $user_menu_data = array();

    if($sizeOfUserMenuItems !== $sizeOfMenuItemsByDatabase){

      $order = $this->db->get_where('menu_user_order',array('fk_user_id'=>$this->session->user_id))->num_rows();

      foreach ($menu_ids as $menu_id) {

        $order++;

        $user_menu_data['fk_user_id'] = $this->session->user_id;
        $user_menu_data['fk_menu_id'] = $menu_id;
        $user_menu_data['menu_user_order_level'] = $order;

        if($this->db->get_where('menu_user_order',
        array('fk_user_id'=>$this->session->user_id,'fk_menu_id'=>$menu_id))->num_rows() == 0){
            $this->db->insert('menu_user_order',$user_menu_data);

        }else{
          $this->db->where(array('fk_user_id'=>$this->session->user_id,'fk_menu_id'=>$menu_id));
          $this->db->update('menu_user_order',$user_menu_data);
        }

      }
    }

    //Get user menu items in their user defined order
    return $this->get_user_menu_items();

}


function get_user_menu_items(){
  $this->db->select(array('menu_name','menu_derivative_controller','menu_user_order_priority_item'));
  $this->db->join('menu','menu.menu_id=menu_user_order.fk_menu_id');
  $this->db->order_by('menu_user_order_level');
  return $this->db->get_where('menu_user_order',
  array('fk_user_id'=>$this->session->user_id,'menu_user_order_is_active'=>1))->result_array();

}

}
