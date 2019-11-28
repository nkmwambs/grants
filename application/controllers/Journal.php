<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Journal extends MY_Controller
{

  function __construct(){
    parent::__construct();

  }

  function index(){}

  static function get_menu_list(){

  }

  function page_name():String{
    return "journal";
  }

  function page_title():String{
    return "Journal";
  }

  function result($id = ""){
    return $this->db->get('funder')->result_array();
  }

}
