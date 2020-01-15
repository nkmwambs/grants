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

    $this->load->model('finance_model');
    $this->load->model('voucher_model');

  }

  function index(){}

  function month_opening_bank_balance($office_id){
    return $this->journal_library->month_opening_bank_balance($office_id);
  }

  function month_opening_cash_balance($office_id){
    return $this->journal_library->month_opening_cash_balance($office_id);
  }

  function journal_records($office_id){
      return $this->journal_library->journal_records($office_id);
  }

  function get_office_data_from_journal(){
    return $this->journal_library->get_office_data_from_journal();
  }

  function result($id = ''){
    if($this->action == 'view'){
    
      $office_id = $this->get_office_data_from_journal()->office_id;

    $result = [
      'transacting_month'=> $this->voucher_model->get_office_transacting_month($office_id),
      'office_name'=> $this->get_office_data_from_journal()->office_name,
      'month_opening_balance'=>['bank'=>$this->month_opening_bank_balance($office_id),'cash'=>$this->month_opening_cash_balance($office_id)],
      'vouchers'=>$this->journal_records($office_id)
  
     ];

     return $result;
    }
  }

  function view(){
    parent::view();
  }

  static function get_menu_list(){

  }

}
