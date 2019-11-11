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

  function voucher_number_default_field_value(){

    $center_id = $this->CI->session->center_id;

    // Not yet factoring if the books of the month has been closed or new center
    $highest_voucher_number = $this->CI->voucher_model->highest_voucher_number($center_id);

    $center_start_date = $this->center_start_date($center_id);

    $voucher_year = date('y',strtotime($center_start_date));
    $voucher_month = date('m',strtotime($center_start_date));
    $voucher_serial = 0;

    if($highest_voucher_number > 0){
      $voucher_year = substr($highest_voucher_number,0,2);
      $voucher_month = substr($highest_voucher_number,2,2);
      $voucher_serial = substr($highest_voucher_number,4);
    }


    $voucher_serial += 1;

    $voucher_serial = $voucher_serial < 10 ? "0".$voucher_serial : $voucher_serial;

    return $voucher_year.$voucher_month.$voucher_serial;
  }

  function default_field_value(){
    return array(
      'voucher_date'=>date('Y-m-d'),
      'center_name'=>$this->CI->session->center_id,
      'voucher_number'=>$this->voucher_number_default_field_value(),
      'voucher_type_name'=>2
    );
  }


}
