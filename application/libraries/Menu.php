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

class Menu {

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

        return $top_menu_items;
    }

    function set_menu_sessions(){
      $menus = $this->getMenuItems();

      $sizeOfMenuItemsByController = count($menus);
      $sizeOfMenuItemsByDatabase = $this->CI->menu_model->get_count_of_menu_items();

      if($sizeOfMenuItemsByController !== $sizeOfMenuItemsByDatabase){
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


          //$this->CI->session->set_userdata('test_session',$user_menu_by_priority_groups);

          $this->CI->session->set_userdata('user_menu',$full_user_menu);

          $this->CI->session->set_userdata('user_priority_menu',$user_priority_menu);

          $this->CI->session->set_userdata('user_more_menu',$user_more_menu);

      }

    }


    function navigation(){

      $this->set_menu_sessions();

      $menus = $this->CI->session->user_priority_menu;

      $nav = "";

      foreach ($menus as $menu => $items) {
          $nav .= '
          <li class="">
              <a href="'.base_url().strtolower($menu).'/list">
                  <span>'.get_phrase($items['menu_name']).'</span>
              </a>
          </li>
          ';
      }

      if(count($this->CI->session->user_more_menu) > 0 ){
        $nav .= '
          <li class="has-sub">
              <a href="#">
                  <span class="fa fa-plus"></span>
              </a>
              <ul>
                ';

                  foreach ($this->CI->session->user_more_menu as $user_menu => $user_menu_item) {
                    $nav .= '
                      <li>
                        <a href="'.base_url().strtolower($user_menu).'/list">
                          <span class="title">'.get_phrase($user_menu).'</span>
                        </a>
                      </li>
                    ';
                  }

            $nav .='
              </ul>
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
          $breadcrumb_list = array_merge($breadcrumb_list,$new);

          $this->CI->session->set_userdata('breadcrumb_list', $breadcrumb_list );
        }

    }
}
