<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Voucher_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }

  function index(){

  }

  // function voucher_number_default_field_value(){
  //   return 100;
  // }

  function get_voucher_number($office_id){
    //return 191201;
    return $this->CI->voucher_model->get_voucher_number($office_id);
  }

  function get_voucher_date($office_id){
    //return date('Y-m-d');
    return $this->CI->voucher_model->get_voucher_date($office_id);
  }

  function default_field_value(){
    return array(
      'voucher_date'=>date('Y-m-d'),
      //'office_name'=>9,
      'voucher_number'=>1,
    );
  }

  function approved_unvouched_request_details(){
    $data['result'] = $this->CI->voucher_model->get_approved_unvouched_request_details();
    return $this->CI->load->view('voucher/unvouched_request_details',$data,true);
  }

  function page_position(){

    $widget['position_5'][] = $this->approved_unvouched_request_details();

    return $widget;
  }


}
