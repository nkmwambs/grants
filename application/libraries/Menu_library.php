<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * File: (Codeigniterapp)/libraries/Controllerlist.php
 *
 * A simple library to list all your controllers with their methods.
 * This library will return an array with controllers and methods
 *
 * The library will scan the "controller" directory and (in case of) one (1) subdirectory level deep
 * for controllers
 *
 * Usage in one of your controllers:
 *
 * $this->load->library('controllerlist');
 * print_r($this->controllerlist->getControllers());
 *
 * @author Peter Prins
 */

class Menu_library {

    /**
     * Codeigniter reference
     */
    private $CI;
    private $EXT;

    /**
     * Array that will hold the controller names and methods
     */
    private $aControllers;

    // Construct
    function __construct() {
        // Get Codeigniter instance
        $this->CI =& get_instance();
        $this->CI->EXT = ".php";

        $this->CI->load->model('menu_model');

        // Get all controllers
        $this->setControllers();
    }

    /**
     * Return all controllers and their methods
     * @return array
     */
    public function getControllers() {
        return $this->aControllers;
    }

    /**
     * Set the array holding the controller name and methods
     */
    public function setControllerMethods($p_sControllerName, $p_aControllerMethods) {
        $this->aControllers[$p_sControllerName] = $p_aControllerMethods;
    }

    /**
     * Search and set controller and methods.
     */
    private function setControllers() {
        // Loop through the controller directory
        foreach(glob(APPPATH . 'controllers/*') as $controller) {

            // if the value in the loop is a directory loop through that directory
            if(is_dir($controller)) {
                // Get name of directory
                $dirname = basename($controller, $this->CI->EXT);

                // Loop through the subdirectory
                foreach(glob(APPPATH . 'controllers/'.$dirname.'/*') as $subdircontroller) {
                    // Get the name of the subdir
                    $subdircontrollername = basename($subdircontroller, $this->CI->EXT);

                    // Load the controller file in memory if it's not load already
                    if(!class_exists($subdircontrollername)) {
                        $this->CI->load->file($subdircontroller);
                    }
                    // Add the controllername to the array with its methods
                    $aMethods = get_class_methods($subdircontrollername);
                    $aUserMethods = array();
                    foreach($aMethods as $method) {
                        if($method != '__construct' && $method != 'get_instance' && $method != $subdircontrollername && $method != 'index' ) {
                            $aUserMethods[] = $method;
                        }
                    }
                    $this->setControllerMethods($subdircontrollername, $aUserMethods);
                }
            }
            else if(pathinfo($controller, PATHINFO_EXTENSION) == "php"){
                // value is no directory get controller name
                $controllername = basename($controller, $this->CI->EXT);

                // Load the class in memory (if it's not loaded already)
                if(!class_exists($controllername)) {
                    $this->CI->load->file($controller);
                }

                // Add controller and methods to the array
                $aMethods = get_class_methods($controllername);
                $aUserMethods = array();
                if(is_array($aMethods)){
                    foreach($aMethods as $method) {
                        if($method != '__construct' && $method != 'get_instance' && $method != $controllername && $method != 'index') {
                            $aUserMethods[] = $method;
                        }
                    }
                }

                $this->setControllerMethods($controllername, $aUserMethods);
            }
        }
    }

    function getMenuItems(){

      $controllers = $this->getControllers();

      $top_menu_items = array();

      foreach($controllers as $controller => $methods){
        //$interfaces = class_implements($controller);

        //if (isset($interfaces['CrudModelInterface']) && in_array('get_menu_list',$methods) ) {
        if (in_array('get_menu_list',$methods) ) {
            $top_menu_items[$controller] = $controller::get_menu_list();
        }
      }
        // Forcefully add Menu controller to menu table
        //$top_menu_items['Menu'] = array();
        
        return $top_menu_items;
        //return array('Approval'=>[],'Bank'=>[],'Budget'=>[],'Center'=>[],'Workplan'=>[],'Voucher'=>[]);
    }

    function set_menu_sessions(){
      $menus = $this->getMenuItems();

      $sizeOfMenuItemsByController = count($menus);
      $sizeOfMenuItemsByDatabase = $this->CI->menu_model->get_count_of_menu_items();

      if($sizeOfMenuItemsByController !== $sizeOfMenuItemsByDatabase){
        // $this->CI->db->where(array('menu_derivative_controller'=>'Role'));
        // $this->CI->db->delete('menu',$data);
          $this->CI->session->unset_userdata('user_menu');
          $this->CI->session->unset_userdata('user_priority_menu');
          $this->CI->session->unset_userdata('user_more_menu');

          // Check if menu are there or insert
          $this->CI->menu_model->upsert_menu($menus);
      }

      // Create a menu session
      if(!$this->CI->session->user_menu){

          // Check if logged user has any preferred menu order, if not create it
          $user_menu_items =  $this->CI->menu_model->upsert_user_menu();

          $full_user_menu =  elevate_array_element_to_key($user_menu_items,'menu_derivative_controller');

          $user_menu_by_priority_groups = elevate_assoc_array_element_to_key($user_menu_items,'menu_user_order_priority_item');

          $user_priority_menu = elevate_array_element_to_key($user_menu_by_priority_groups[1],'menu_derivative_controller');

          $user_more_menu = elevate_array_element_to_key($user_menu_by_priority_groups[0],'menu_derivative_controller');


          $this->CI->session->set_userdata('user_menu',$full_user_menu);

          // Build user priority and more menu based on user read label permission of the logged role
          if(!$this->CI->session->system_admin){

              $user_priority_menu_based_on_permissions = array();
              $user_more_menu_based_on_permissions = array();

              // Filter user priority menu based on the read label permission of the logged role
              foreach($user_priority_menu as $menu => $options ){
                if($this->CI->user_model->check_role_has_permissions($menu,'read')){
                  $user_priority_menu_based_on_permissions[$menu] = $options;
                } 
              }

              // Filter the user more menu based on the read label permission of the logged role
              foreach($user_more_menu as $menu => $options ){
                if($this->CI->user_model->check_role_has_permissions($menu,'read')){
                  $user_more_menu_based_on_permissions[$menu] = $options;
                } 
              }
              
              // Check if the filter priority menu has less than the config set max_priority_menu_items,
              // If yes, take the first max_priority_menu_items items from user more menu anf push them to the 
              // user priority menu

              if(
                  count($user_priority_menu_based_on_permissions) < $this->CI->config->item('max_priority_menu_items') && 
                  count($user_more_menu_based_on_permissions) > 0  
              ){

                  // Makes multiple arrays of user_more_menu_based_on_permissions of size of config max_priority_menu_items
                  // Take the first max_priority_menu_items elements to $user_priority_menu_based_on_permissions

                  $chunked_user_more = array_chunk($user_more_menu_based_on_permissions,
                  $this->CI->config->item('max_priority_menu_items'),true);

                  foreach($chunked_user_more[0] as $menu => $options){
                    $user_priority_menu_based_on_permissions[$menu] = $options;
                  }

                  // Remove the first max_priority_menu_items elements from $user_more_menu_based_on_permissions 
                  // and assign the remaning to $user_more_menu_based_on_permissions 
                  $user_more_menu_based_on_permissions = array_slice($user_more_menu_based_on_permissions,
                  $this->CI->config->item('max_priority_menu_items'));
                  
                  
              } 

              $this->CI->session->set_userdata('user_priority_menu',$user_priority_menu_based_on_permissions);

              $this->CI->session->set_userdata('user_more_menu',$user_more_menu_based_on_permissions);
            
            }else{
                
              $this->CI->session->set_userdata('user_priority_menu',$user_priority_menu);

              $this->CI->session->set_userdata('user_more_menu',$user_more_menu);
            
            }      

      }

    }
    
    
    function navigation(){
      
      $permission = $this->CI->session->role_permissions;

      $this->set_menu_sessions();

      $menus = $this->CI->session->user_priority_menu;

      $nav = "";

      $lib = "";
      $menu_icon = '';
      foreach ($menus as $menu => $items) {
        if($this->CI->user_model->check_role_has_permissions($menu,'read')){
           // Intended to show an icon but didn't work
          // $lib = $menu.'_library'; 
          
          // $this->CI->load->library($lib);

          // if(property_exists($this->CI->$lib,'menu_icon')){
          //   $menu_icon = $this->CI->$lib->menu_icon;
          // }
          if($this->CI->db->get_where('menu',
          array('menu_derivative_controller'=>ucfirst($menu),'menu_is_active'=>1))->num_rows()>0){
          $nav .= '
          <li class="">
              <a href="'.base_url().strtolower($menu).'/list">
                  <i class="'.$menu_icon.'"></i>
                  <span>'.get_phrase(strtolower($items['menu_name'])).'</span>
              </a>
          </li>
          ';
          }
        }
          
      }

      if(count($this->CI->session->user_more_menu) > 0 ){
        $nav .= '
          <li class="">
              <a href="'.base_url().'menu/view/'.hash_id(380,'encode').'">
                  <span class="fa fa-plus"></span>
              </a>
             
          </li>
        ';
      }

      return $nav;
    }

    function create_breadcrumb(){

        $breadcrumb_list = $this->CI->session->breadcrumb_list;

        if( $this->CI->uri->segment(2,'list') == 'list' ){
          $this->CI->session->set_userdata('breadcrumb_list',array($this->CI->uri->segment(1,'')));
        }

        if(array_pop($breadcrumb_list) !== $this->CI->uri->segment(1,'') ){
          $breadcrumb_list = $this->CI->session->breadcrumb_list;
          $new = array($this->CI->uri->segment(1,'') );

          if(!in_array($this->CI->uri->segment(1,''),$breadcrumb_list)){
            $breadcrumb_list = array_merge($breadcrumb_list,$new);
          }


          $this->CI->session->set_userdata('breadcrumb_list', $breadcrumb_list );
        }

    }
}
