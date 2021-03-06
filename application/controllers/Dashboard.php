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
        $this->load->library('dashboard_library');
        
        $this->load->model("project_allocation_model");
        
    }


    public function index(){}

    function api(){
        echo json_encode($this->general_model->get_max_approval_status_id('voucher'));
    }

    static function get_menu_list(){

    }


}
