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

  function validate_cheque_number($data){
    return $this->CI->voucher_model->validate_cheque_number($data);
  }

  function populate_office_banks($office_id){
    return $this->CI->voucher_model->populate_office_banks($office_id);
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
