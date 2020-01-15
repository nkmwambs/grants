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

  function journal_navigation($office_id, $transacting_month){
    return $this->journal_library->journal_navigation($office_id, $transacting_month);
  }

  function financial_accounts(){
    return $this->journal_library->financial_accounts();
  }


  function result($id = ''){
    if($this->action == 'view'){
    
      $office_id = $this->get_office_data_from_journal()->office_id;
      $transacting_month = $this->get_office_data_from_journal()->journal_month;

    $result = [
      'transacting_month'=> $transacting_month,
      'office_name'=> $this->get_office_data_from_journal()->office_name,
      'navigation'=>$this->journal_navigation($office_id, $transacting_month),
      'accounts'=>$this->financial_accounts(),
      'month_opening_balance'=>['bank'=>$this->month_opening_bank_balance($office_id),'cash'=>$this->month_opening_cash_balance($office_id)],
      'vouchers'=>$this->journal_records($office_id)
     ];

     return $result;
    }else{
      return parent::result($id = '');
    }
  }

  function view(){
    parent::view();
  }

  static function get_menu_list(){

  }

}
