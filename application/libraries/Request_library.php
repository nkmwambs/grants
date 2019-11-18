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
  
  function page_position(){

    //$widgets['position_1'][] = Widget_base::load('comment');

    //$widgets['position_2'][] = Widget_base::load('button',get_phrase('edit'),$this->CI->controller.'/edit/'.$this->CI->id);
    $widgets['position_2'][] = Widget_base::load('button',get_phrase('clone'),$this->CI->controller.'/clone/'.$this->CI->id);
    //$widgets['position_2'][] = Widget_base::load('button',get_phrase('delete'),$this->CI->controller.'/delete/'.$this->CI->id);
          
    //$widgets['position_3'][] = "Here is main position two widgets";

    return $widgets;
  }

}
