<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Request_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }

  function index(){

  }

  function center_name_field_value(){
    return 1;
  }
  
  function list_table_where(){
    //return array('request_date'=>'2019-10-22');
  }
  
  function page_position($position_title){

    //$widgets['main_position'] = "Here is main position widgets";
    //$widgets['main_position_2'] = "Here is main position two widgets";

    return $position_title;
  }

}
