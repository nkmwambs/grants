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

  private function income_accounts($office_ids){

    // Should be moved to Income accounts library
    return $this->financial_report_library->income_accounts($office_ids);
  }

  private function month_income_account_receipts($office_ids,$start_date_of_month){
    return $this->financial_report_library->month_income_account_receipts($office_ids, $start_date_of_month);
  }

  private function month_income_account_expenses($office_ids, $start_date_of_month){
    return $this->financial_report_library->month_income_account_expenses($office_ids, $start_date_of_month);
  }

  private function month_income_opening_balance($office_ids, $start_date_of_month){
    return $this->financial_report_library->month_income_opening_balance($office_ids, $start_date_of_month);
  }

  private function fund_balance_report($office_ids, $start_date_of_month){

    $income_accounts =  $this->income_accounts($office_ids);
    $month_opening_balance = $this->month_income_opening_balance($office_ids, $start_date_of_month);
    $month_income = $this->month_income_account_receipts($office_ids, $start_date_of_month);
    $month_expense = $this->month_income_account_expenses($office_ids, $start_date_of_month);
    
    $report = array();

    foreach($income_accounts as $account){
       $report[] = [
        'account_name'=>$account['income_account_name'],
        'month_opening_balance'=>isset($month_opening_balance[$account['income_account_id']])?$month_opening_balance[$account['income_account_id']]:0,
        'month_income'=>isset($month_income[$account['income_account_id']])?$month_income[$account['income_account_id']]:0,
        'month_expense'=>isset($month_expense[$account['income_account_id']])?$month_expense[$account['income_account_id']]:0,
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


  function financial_report_office_hierarchy($reporting_month){
    $user_office_hierarchy = $this->user_model->user_hierarchy_offices($this->session->user_id,true);

    // Remove offices with a financial reporting in the selected reporting month

    $user_hierarchy_offices_with_report = $this->_user_hierarchy_offices_with_financial_report_for_selected_month($reporting_month);

    foreach($user_office_hierarchy as $office_context => $offices){
      foreach($offices as $key => $office){
        if(!in_array($office['office_id'],$user_hierarchy_offices_with_report)){
          unset($user_office_hierarchy[$office_context][$key]);
        }
      }
    }


    if($this->config->item('only_combined_center_financial_reports')){
        $centers = $user_office_hierarchy[$this->user_model->get_lowest_office_context()->context_definition_name];
        unset($user_office_hierarchy);
        $user_office_hierarchy[$this->user_model->get_lowest_office_context()->context_definition_name] = $centers;
    }

    return $user_office_hierarchy;
  }

  private function _user_hierarchy_offices_with_financial_report_for_selected_month($reporting_month){
    $context_ungrouped_user_hierarchy_offices = $this->user_model->user_hierarchy_offices($this->session->user_id);
    
    $offices_ids = array_column($context_ungrouped_user_hierarchy_offices,'office_id');

    $this->db->select('fk_office_id');
    $this->db->where_in('fk_office_id',$offices_ids);
    $office_ids_with_report = $this->db->get_where('financial_report',array('financial_report_month'=>$reporting_month))->result_array();

    return array_column($office_ids_with_report,'fk_office_id');
  }
  
  private function financial_report_information(){

    $additional_information = $this->financial_report_library->financial_report_information($this->id);

    if(isset($_POST) && count($_POST) > 0){
      $additional_information = $this->financial_report_library->financial_report_information($this->id, $_POST['office_ids']);
    }

    $offices_ids = array_column($additional_information,'office_id');

    $reporting_month = $additional_information[0]['financial_report_month'];

    $office_ids = array_column($additional_information,'office_id');

    $multiple_offices_report = false;

    // if(array_keys($additional_information) !== range(0, count($additional_information) - 1)) {
    //     // One Office
    //     $office_names = $additional_information[0]['office_name'];
        
    // }

    $office_names = implode(', ',array_column($additional_information,'office_name'));

    if(count($additional_information) > 1){  
        // Multiple Office
        $multiple_offices_report = true;
    }

    return [
            'office_names'=>$office_names,
            'reporting_month'=>$reporting_month,
            'office_ids'=>$office_ids,
            'multiple_offices_report'=>$multiple_offices_report,
            //'test'=>$additional_information,
          ];
  }

  function result($id = ''){

    if($this->action == 'view'){
      
     extract($this->financial_report_information());

      return [
        //'test'=>$test,
        'multiple_offices_report'=>$multiple_offices_report,
        'user_office_hierarchy' => $this->financial_report_office_hierarchy($reporting_month),
        'office_names'=>$office_names,
        'office_ids'=>$office_ids,
        'reporting_month'=>$reporting_month,
        'fund_balance_report'=>$this->fund_balance_report($office_ids,$reporting_month),
        'proof_of_cash'=>$this->proof_of_cash(),
        'financial_ratios'=>$this->financial_ratios(),
        'bank_reconciliation'=>$this->bank_reconciliation(),
        'outstanding_cheques'=>$this->oustanding_cheques(),
        'clear_outstanding_cheques'=>$this->cleared_oustanding_cheques(),
        'deposit_in_transit'=>$this->deposit_in_transit(),
        'cleared_deposit_in_transit'=>$this->cleared_deposit_in_transit(),
        'expense_report'=>$this->expense_report()
      ];
    }else{
      return parent::result($id = '');
    }
  }

  function view(){
    parent::view();
  }

  function merge_financial_report(){
    echo json_encode($this->input->post());
  }

  static function get_menu_list(){}

}