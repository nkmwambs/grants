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
    }


    public function index(){}


    static function get_menu_list(){

    }


}
