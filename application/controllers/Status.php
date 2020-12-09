<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Status extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->library('status_library');
  }

  function index(){}

  function get_status_roles(){

    $this->read_db->select(array('role_id','role_name'));
    $this->read_db->where(array('role_is_new_status_default'=>0));
    $status_roles = $this->read_db->get('role')->result_array();

    echo json_encode($status_roles);
  }

  static function get_menu_list(){}

}