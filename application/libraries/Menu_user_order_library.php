<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Menu_user_order_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }

  function index(){

  }

  function change_field_type(){
    $change_field_type = array();

    $change_field_type['menu_user_order_priority_item']['field_type'] = 'select';
    $change_field_type['menu_user_order_priority_item']['options'] = array(get_phrase('collapse'),get_phrase('expanded'));

    return $change_field_type;
  }


}
