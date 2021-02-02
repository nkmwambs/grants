<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Voucher_type extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->library('voucher_type_library');
  }

  function index(){}

  function get_voucher_type_effects($voucher_type_account_id){
     $this->read_db->where(array('voucher_type_account_id'=>$voucher_type_account_id));
     $voucher_type_account_code = $this->read_db->get('voucher_type_account')->row()->voucher_type_account_code;

     $voucher_type_effect_codes = [];

     if($voucher_type_account_code == 'bank'){
        $voucher_type_effect_codes = ['income','expense','bank_contra','bank_to_bank_contra'];
     }elseif($voucher_type_account_code == 'cash'){
        $voucher_type_effect_codes = ['income','expense','cash_contra','cash_to_cash_contra'];
     }

     if(!empty($voucher_type_effect_codes)){
        $this->read_db->where_in('voucher_type_effect_code',$voucher_type_effect_codes);
     }

     $this->read_db->select(array('voucher_type_effect_id','voucher_type_effect_name','voucher_type_effect_code'));
     $voucher_type_effect = $this->read_db->get('voucher_type_effect')->result_array();
     
     echo json_encode($voucher_type_effect);
  }

  function check_select_voucher_type_effect($voucher_type_effect_id){
     $voucher_type_effect_code = $this->read_db->get_where('voucher_type_effect',
     array('voucher_type_effect_id'=>$voucher_type_effect_id))->row()->voucher_type_effect_code;

     echo $voucher_type_effect_code;
  }

  static function get_menu_list(){}

}