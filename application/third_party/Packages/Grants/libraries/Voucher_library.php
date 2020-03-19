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

  function approved_unvouched_request_details($office_id){
    $data['result'] = $this->CI->voucher_model->get_approved_unvouched_request_details($office_id);
    return $this->CI->load->view('voucher/unvouched_request_details',$data,true);
  }

  function get_voucher_type_effect($voucher_type_id){
      return $this->CI->voucher_model->get_voucher_type_effect($voucher_type_id);
  }

  function page_position(){

    //$widget['position_5'][] = $this->approved_unvouched_request_details();

    //return $widget;
  }


  // Below is the code for a voucher object

function form_field_select($label,$offices = array(), $id = '',$label_cols =1, $input_cols = 3){
  $return = label_element(get_phrase($label),['col-xs-'.$label_cols]);
  $return .= div_element(
                [
                  select_element($offices,$label,[],$id)
                ],
                ['col-xs-'.$input_cols]
              );
  
   return $return;           
}


function field_date($date = ''){
  $return = label_element(get_phrase('date'),['col-xs-1']);
  $return .= div_element(
                [
                  input_element($date,get_phrase('enter_date'),['datepicker'],'t_date',['readonly'=>'readonly','data-format'=>'yyyy-mm-dd'])
                ],
                ['col-xs-3']
            );
  return $return;
}

function form_field_text($label, $default_value = '', $classes = [], $id = '', $parameters = [], $label_cols = 1, $input_cols = 3){
  $return = label_element(get_phrase($label),['col-xs-1']);
  $return .= div_element(
                  [
                    input_element($default_value,get_phrase($label),$classes,$id,$parameters)
                  ],
                  ['col-xs-3']
            );

  return $return;
}


}

