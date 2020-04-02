<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Menu_user_order extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->library('menu_user_order_library');
    $this->load->model('user_model');
  }

  function index(){}

  //function list(){}

  function result($id = ""){
    $result = [];

    if($this->action == 'list'){
      $result['main_menu'] = $this->_get_user_menu_items(1);
      $result['sub_menu'] = $this->_get_user_menu_items(0);
    }else{
      $result  = parent::result($id);
    }

    return $result;
  }

  function _get_user_menu_items($priority){

    $query_condition = " `menu_user_order_priority_item`= ".$priority." AND `fk_user_id` = ".$this->session->user_id;
    $this->db->select(array('menu_id','menu_name'));
    $this->db->join('menu','menu.menu_id=menu_user_order.fk_menu_id');
   
    if(!$this->session->system_admin){
      $query_condition .= " AND `fk_role_id` = ".$this->session->role_id;
      $this->db->join('permission','permission.fk_menu_id=menu.menu_id');
      $this->db->join('role_permission','role_permission.fk_permission_id=permission.permission_id');
    }
    
    $this->db->order_by('menu_user_order_level ASC');
    $this->db->where($query_condition);
    $menu_user_order = $this->db->get('menu_user_order')->result_array();

    return $menu_user_order;
  }

  function _order_menu_items(){
    $this->db->select(array('menu_id','menu_name'));
    $this->db->join('menu','menu.menu_id=menu_user_order.fk_menu_id');
    $this->db->order_by('menu_user_order_level ASC');
    $menu_user_order = $this->db->get_where('menu_user_order',
      array('fk_user_id'=>$this->session->user_id))->result_array();
    
    $order_items = [];

    foreach($menu_user_order as $menu_item){
      $order_items[$menu_item['menu_id']] = $menu_item['menu_name'];
    }

    return $order_items;
  }

  function update_menu_order(){
    $menuorder = $this->input->post('menuorder');
    $menu_name = $this->input->post('menu_name');

    $menu_ids_array = ['menu_name'=>$menu_name,'order'=>explode(',',ltrim($menuorder,','))];

    $updated_data = [];
    $menu_user_order_level = 1;
    $user_priority_menu = [];
    $user_more_menu = [];
    $user_menu = [];
    $menu_user_order_priority_item = 0;

    $order_menu_items = $this->_order_menu_items();

      foreach($menu_ids_array['order'] as $menu_id){
        
        //if(!isset($order_menu_items[$menu_id])) continue;
      
        if($menu_ids_array['menu_name'] == 'sortable-main-menu'){
            
           $menu_user_order_priority_item = 1;
           $user_priority_menu[$order_menu_items[$menu_id]] = ['menu_name'=>$order_menu_items[$menu_id]];
           $user_menu[$order_menu_items[$menu_id]] = ['menu_name'=>$order_menu_items[$menu_id],'menu_user_order_priority_item'=>$menu_user_order_priority_item];
           $updated_data = array('menu_user_order_priority_item'=>$menu_user_order_priority_item,
           'menu_user_order_level'=>$menu_user_order_level);
          
        }
        else{

            $menu_user_order_priority_item = 0;
            $user_more_menu[$order_menu_items[$menu_id]] = ['menu_name'=>ucfirst($order_menu_items[$menu_id])];
            $user_menu[$order_menu_items[$menu_id]] = ['menu_name'=>$order_menu_items[$menu_id],'menu_user_order_priority_item'=>$menu_user_order_priority_item];
            $updated_data = array('menu_user_order_priority_item'=>$menu_user_order_priority_item,'menu_user_order_level'=>$menu_user_order_level);
          
       }
          //echo json_encode(array('fk_user_id'=>$this->session->user_id,'fk_menu_id'=>$menu_id));
          $this->db->where(array('fk_user_id'=>$this->session->user_id,'fk_menu_id'=>$menu_id));
          $this->db->update('menu_user_order',$updated_data);
          $menu_user_order_level++;        
      
      }


    if(count($user_menu)>0) {
      //if($this->session->has_userdata('user_menu')) $this->session->unset_session('user_menu'); 
      $this->session->set_userdata('user_menu',$user_menu);
    }

    if(count($user_priority_menu)>0){
      //if($this->session->has_userdata('user_priority_menu')) $this->session->unset_session('user_priority_menu'); 
      $this->session->set_userdata('user_priority_menu',$user_priority_menu);
    }

    if(count($user_more_menu)>0){
      //if($this->session->has_userdata('user_more_menu')) $this->session->unset_session('user_more_menu'); 
      $this->session->set_userdata('user_more_menu',$user_more_menu);
    }  
    
    //echo json_encode($updated_data);
    //echo count($user_priority_menu);
    $this->menu_library->navigation();
  }

  static function get_menu_list(){
   
  }

}
