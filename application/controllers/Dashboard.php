<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	date		: 6th June, 2018
 *	AFR Staff Recognition system
 *	https://www.compassion.com
 *	NKarisa@ke.ci.org
 */

class Dashboard extends MY_Controller{

public $auth;

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    public function index(){
      //$this->access->getAccess(__METHOD__);

      $page_data['page_name'] = "dashboard";
      $page_data['page_title'] = "Dashboard";
      $page_data['views_dir'] = "dashboard";

      $this->load->view('general/index',$page_data);
    }


    function page_name(){
      return 'dashboard';
    }

    function page_title(){
      return "Dashboard";
    }


    static function get_menu_list(){

    }


}
