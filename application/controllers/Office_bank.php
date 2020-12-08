<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Office_bank extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->library('office_bank_library');
  }

  function index(){}

  function check_office_has_default_office_bank(){
    $office_has_default_office_bank = false;
    $post = $this->input->post();

    $this->read_db->where(array('fk_office_id'=>$post['office_id'],'office_bank_is_active'=>1,
    'office_bank_is_default'=>1));
    $active_default_office_bank = $this->read_db->get('office_bank');

    if($active_default_office_bank->num_rows() > 0){
      $office_has_default_office_bank = true;
    }

    echo $office_has_default_office_bank;

  }

  static function get_menu_list(){}

}