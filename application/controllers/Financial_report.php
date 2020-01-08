<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Financial_report extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->library('financial_report_library');
    $this->load->model('financial_report_model');
  }

  function index(){}

  private function income_accounts(){

    // Should be moved to Income accounts library
    return $this->financial_report_library->income_accounts();
  }

  private function month_income_account_receipts($office_id,$start_date_of_month){
    return $this->financial_report_library->month_income_account_receipts($office_id, $start_date_of_month);
  }

  private function month_income_account_expenses($office_id, $start_date_of_month){
    return $this->financial_report_library->month_income_account_expenses($office_id, $start_date_of_month);
  }

  private function month_income_opening_balance($office_id, $start_date_of_month){
    return $this->financial_report_library->month_income_opening_balance($office_id, $start_date_of_month);
  }

  private function fund_balance_report($office_id, $start_date_of_month){

    $income_accounts =  $this->income_accounts();
    $month_opening_balance = $this->month_income_opening_balance($office_id, $start_date_of_month);
    $month_income = $this->month_income_account_receipts($office_id, $start_date_of_month);
    $month_expense = $this->month_income_account_expenses($office_id, $start_date_of_month);
    
    $report = array();

    foreach($income_accounts as $account){
       $report[] = [
        'account_name'=>$account['income_account_name'],
        'month_opening_balance'=>$month_opening_balance[$account['income_account_id']],
        'month_income'=>$month_income[$account['income_account_id']],
        'month_expense'=>$month_expense[$account['income_account_id']],
       ]; 
    }  
    
    return $report;
  }

  private function proof_of_cash(){

  }

  private function financial_ratios(){

  }

  private function bank_reconciliation(){

  }

  private function bank_statements(){

  }

  private function oustanding_cheques(){

  }

  private function cleared_oustanding_cheques(){
    
  }

  private function deposit_in_transit(){

  }

  private function cleared_deposit_in_transit(){

  }

  private function expense_report(){
    
  }

  private function financial_report_information($report_id){
    return $this->financial_report_library->financial_report_information($report_id);
  }

  function result($id = ''){

    $additional_information = $this->financial_report_information($this->id);
    
    return [
      'additional_information'=>$additional_information,
      'fund_balance_report'=>$this->fund_balance_report($additional_information['office_id'],$additional_information['financial_report_month']),
      'proof_of_cash'=>$this->proof_of_cash(),
      'financial_ratios'=>$this->financial_ratios(),
      'bank_reconciliation'=>$this->bank_reconciliation(),
      'outstanding_cheques'=>$this->oustanding_cheques(),
      'clear_outstanding_cheques'=>$this->cleared_oustanding_cheques(),
      'deposit_in_transit'=>$this->deposit_in_transit(),
      'cleared_deposit_in_transit'=>$this->cleared_deposit_in_transit(),
      'expense_report'=>$this->expense_report()
    ];
  }

  function view(){
    parent::view();
  }

  static function get_menu_list(){}

}