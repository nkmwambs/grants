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

  private function _income_accounts($office_ids){

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

  private function _fund_balance_report($office_ids, $start_date_of_month){

    $income_accounts =  $this->_income_accounts($office_ids);
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

  private function _proof_of_cash($office_ids,$reporting_month){
    $cash_at_bank = $this->_compute_cash_at_bank($office_ids,$reporting_month);
    $cash_at_hand = $this->_compute_cash_at_hand($office_ids,$reporting_month);

    return ['cash_at_bank'=>$cash_at_bank,'cash_at_hand'=>$cash_at_hand];
  }

  function _compute_cash_at_bank($office_ids,$reporting_month){
    $opening_bank_balance = $this->_opening_cash_balance($office_ids);
    $bank_income_to_date = $this->_cash_transactions_to_date($office_ids,$reporting_month,'income','cash_contra','bank');//$this->_cash_income_to_date($office_ids,$reporting_month);
    $bank_expenses_to_date = $this->_cash_transactions_to_date($office_ids,$reporting_month,'expense','bank_contra','bank');//$this->_cash_expense_to_date($office_ids,$reporting_month);
    
    return $opening_bank_balance + $bank_income_to_date - $bank_expenses_to_date;
  }

  function _cash_transactions_to_date($office_ids,$reporting_month, $transaction_type,$contra_type, $voucher_type_account){
    // bank_income = voucher of voucher_type_effect_code == income or cash_contra and voucher_type_account_code == bank 
    // bank_expense = voucher of voucher_type_effect_code == expense or bank_contra and voucher_type_account_code == bank 
    // cash_income = voucher of voucher_type_effect_code == income or bank_contra and voucher_type_account_code == cash 
    // cash_expense = voucher of voucher_type_effect_code == expense or cash_contra and voucher_type_account_code == cash 

    $voucher_detail_total_cost = 0;
    $end_of_reporting_month = date('Y-m-t',strtotime($reporting_month));

    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);
    $this->db->where(array('voucher_type_account_code'=>$voucher_type_account,'voucher_date<='=>$end_of_reporting_month));
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $voucher_detail_total_cost_obj = $this->db->get('voucher_detail');

    if($voucher_detail_total_cost_obj->num_rows() > 0){
      $voucher_detail_total_cost = $voucher_detail_total_cost_obj->row()->voucher_detail_total_cost;
    }
  
    return $voucher_detail_total_cost;
  }

  function _opening_cash_balance($office_ids,$balance_type = "opening_cash_balance_bank"){
    $this->db->select_sum($balance_type);
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->join('system_opening_balance','system_opening_balance.system_opening_balance_id=opening_cash_balance.fk_system_opening_balance_id');
    //$this->db->group_by('fk_office_id');
    $opening_balance = $this->db->get('opening_cash_balance');

    $balance = 0;

    if($opening_balance->num_rows() > 0){
      $balance = $opening_balance->row()->$balance_type;
    }

    return $balance;
  }

  function _compute_cash_at_hand($office_ids,$reporting_month){
    //return 15000;
    $opening_cash_balance = $this->_opening_cash_balance($office_ids,'opening_cash_balance_cash');
    $cash_income_to_date = $this->_cash_transactions_to_date($office_ids,$reporting_month, 'income','bank_contra','cash');//$this->_cash_income_to_date($office_ids,$reporting_month,'bank_contra','cash');
    $cash_expenses_to_date = $this->_cash_transactions_to_date($office_ids,$reporting_month, 'expense','cash_contra','cash');//$this->_cash_expense_to_date($office_ids,$reporting_month,'cash_contra','cash');
    
    return $opening_cash_balance + $cash_income_to_date - $cash_expenses_to_date;
  }

  private function financial_ratios(){

  }

  private function _bank_reconciliation($office_ids,$reporting_month,$multiple_offices_report){
    $bank_statement_date = $this->_bank_statement_date($office_ids,$reporting_month,$multiple_offices_report);
    $bank_statement_balance = $this->_bank_statement_balance($office_ids,$reporting_month);
    $book_closing_balance = $this->_compute_cash_at_bank($office_ids,$reporting_month);//$this->_book_closing_balance($office_ids,$reporting_month);
    $month_outstanding_cheques = $this->_sum_of_outstanding_cheques_and_transits($office_ids,$reporting_month,'expense','bank_contra','bank');
    $month_transit_deposit = $this->_sum_of_outstanding_cheques_and_transits($office_ids,$reporting_month,'income','cash_contra','bank');//$this->_deposit_in_transit($office_ids,$reporting_month);
    $bank_reconciled_balance = $bank_statement_balance - $month_outstanding_cheques + $month_transit_deposit;

    $is_book_reconciled = false;

    if(round($bank_reconciled_balance,2) == round($book_closing_balance,2)){
      $is_book_reconciled = true;
    }

    return [
            'bank_statement_date'=>$bank_statement_date,
            'bank_statement_balance'=>$bank_statement_balance,
            'book_closing_balance'=>$book_closing_balance,
            'month_outstanding_cheques'=>$month_outstanding_cheques,
            'month_transit_deposit'=>$month_transit_deposit,
            'bank_reconciled_balance'=>$bank_reconciled_balance,
            'is_book_reconciled'=>$is_book_reconciled
          ];
  }

  function _bank_statement_date($office_ids,$reporting_month,$multiple_offices_report){
    
    $reconciliation_reporting_month = date('Y-m-t',strtotime($reporting_month));
    
    if(!$multiple_offices_report){
      $this->db->select(array('reconciliation_reporting_month'));
      $this->db->where(array('fk_office_id'=>$office_ids[0],
      'reconciliation_reporting_month'=>date('Y-m-t',strtotime($reporting_month))));
      $reconciliation_reporting_month_obj = $this->db->get('reconciliation');

      if($reconciliation_reporting_month_obj->num_rows() > 0){
        $reconciliation_reporting_month = $reconciliation_reporting_month_obj->row()->reconciliation_reporting_month;
      }

    }else{
      $reconciliation_reporting_month = "This field cannot be populated for multiple offices report";
    }

    return $reconciliation_reporting_month;
  }

  function _bank_statement_balance($office_ids,$reporting_month){
    //return 345000.34;
    $reconciliation_statement_amount = 0;

    $this->db->select_sum('reconciliation_statement_amount');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where(array('reconciliation_reporting_month'=>date('Y-m-t',strtotime($reporting_month))));
    $reconciliation_statement_amount_obj = $this->db->get('reconciliation');

    if($reconciliation_statement_amount_obj->row()->reconciliation_statement_amount != null){
      $reconciliation_statement_amount = $reconciliation_statement_amount_obj->row()->reconciliation_statement_amount;
    }

    return $reconciliation_statement_amount;
    
  }

  // function _book_closing_balance($office_ids,$reporting_month){
  //   return 245980.12;
  // }


  private function bank_statements(){

  }

  function _sum_of_outstanding_cheques_and_transits($office_ids,$reporting_month,$transaction_type,$contra_type,$voucher_type_account_code){
    return array_sum(array_column($this->_list_oustanding_cheques_and_deposits($office_ids,$reporting_month,$transaction_type,$contra_type,$voucher_type_account_code),'voucher_detail_total_cost'));
  }
  

  private function _list_oustanding_cheques_and_deposits($office_ids,$reporting_month, $transaction_type,$contra_type,$voucher_type_account_code){

    $list_oustanding_cheques_and_deposit = [];
    
    //return 145890.00;
    $cleared_condition = " `voucher_cleared` = 0 OR (`voucher_cleared` = 1  AND `voucher_cleared_month` > '".date('Y-m-t',strtotime($reporting_month))."' )";
    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->select(array('voucher_id','voucher_number','voucher_cheque_number','voucher_description','voucher_cleared','office_code','office_name','voucher_date','voucher_cleared'));
    $this->db->group_by('voucher_id');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);
    $this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));
    $this->db->where($cleared_condition);
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('office','office.office_id=voucher.fk_office_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $list_oustanding_cheques_and_deposit = $this->db->get('voucher_detail')->result_array();

    return $list_oustanding_cheques_and_deposit;
  }

  private function _list_cleared_effects($office_ids,$reporting_month, $transaction_type,$contra_type,$voucher_type_account_code){

    $list_cleared_effects = [];
    
    //return 145890.00;
    $cleared_condition = " `voucher_cleared` = 1 AND `voucher_cleared_month` = '".date('Y-m-t',strtotime($reporting_month))."' ";
    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->select(array('voucher_id','voucher_number','voucher_cheque_number','voucher_description','voucher_cleared','office_code','office_name','voucher_date','voucher_cleared'));
    $this->db->group_by('voucher_id');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);
    $this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));
    $this->db->where($cleared_condition);
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('office','office.office_id=voucher.fk_office_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $list_cleared_effects = $this->db->get('voucher_detail')->result_array();

    return $list_cleared_effects;
  }

  private function cleared_oustanding_cheques(){
    
  }

  // private function _deposit_in_transit($office_ids,$reporting_month){
  //   return 12000;
  // }

  private function cleared_deposit_in_transit(){

  }

  private function _expense_report($office_ids,$reporting_month){
    // $income_accounts =  $this->income_accounts($office_ids);
    // $month_opening_balance = $this->month_income_opening_balance($office_ids, $start_date_of_month);
    // $month_income = $this->month_income_account_receipts($office_ids, $start_date_of_month);
    // $month_expense = $this->month_income_account_expenses($office_ids, $start_date_of_month);
    
    // $report = array();

    // foreach($income_accounts as $account){
    //    $report[] = [
    //     'account_name'=>$account['income_account_name'],
    //     'month_opening_balance'=>isset($month_opening_balance[$account['income_account_id']])?$month_opening_balance[$account['income_account_id']]:0,
    //     'month_income'=>isset($month_income[$account['income_account_id']])?$month_income[$account['income_account_id']]:0,
    //     'month_expense'=>isset($month_expense[$account['income_account_id']])?$month_expense[$account['income_account_id']]:0,
    //    ]; 
    // }  
    
    // return $report;

    $expense_account_grid = [];

    $income_grouped_expense_accounts = $this->_income_grouped_expense_accounts($office_ids);
    $month_expense = $this->_month_expense_by_expense_account($office_ids,$reporting_month);
    $month_expense_to_date = $this->_expense_to_date_by_expense_account($office_ids,$reporting_month);
    $budget_to_date = $this->_bugdet_to_date_by_expense_account($office_ids,$reporting_month);
    $budget_variance = $this->_budget_variance_by_expense_account($office_ids,$reporting_month);
    $budget_variance_percent = $this->_budget_variance_percent_by_expense_account($office_ids,$reporting_month);
    $expense_account_comment = $this->_expense_account_comment($office_ids,$reporting_month);
    
    foreach($income_grouped_expense_accounts as $income_account_id => $income_account){
      foreach($income_account['expense_accounts'] as $expense_account){
        $income_account_id =  $income_account['income_account']['income_account_id'];
        $expense_account_id = $expense_account['expense_account_id'];

        $expense_account_grid[$income_account_id]['income_account'] = $income_account['income_account'];
        $expense_account_grid[$income_account_id]['expense_accounts'][$expense_account['expense_account_id']]['expense_account'] = $expense_account;
        $expense_account_grid[$income_account_id]['expense_accounts'][$expense_account['expense_account_id']]['month_expense'] = isset($month_expense[$income_account_id][$expense_account_id])?$month_expense[$income_account_id][$expense_account_id]:0;
        $expense_account_grid[$income_account_id]['expense_accounts'][$expense_account['expense_account_id']]['month_expense_to_date'] = isset($month_expense_to_date[$income_account_id][$expense_account_id])?$month_expense_to_date[$income_account_id][$expense_account_id]:0;
        $expense_account_grid[$income_account_id]['expense_accounts'][$expense_account['expense_account_id']]['budget_to_date'] = isset($budget_to_date[$income_account_id][$expense_account_id])?$budget_to_date[$income_account_id][$expense_account_id]:0;
        $expense_account_grid[$income_account_id]['expense_accounts'][$expense_account['expense_account_id']]['budget_variance'] = $budget_variance;
        $expense_account_grid[$income_account_id]['expense_accounts'][$expense_account['expense_account_id']]['budget_variance_percent'] = $budget_variance_percent;
        $expense_account_grid[$income_account_id]['expense_accounts'][$expense_account['expense_account_id']]['expense_account_comment'] = $expense_account_comment;
      }
    }
    
    return $expense_account_grid;
  }

  function _income_grouped_expense_accounts($office_ids){
    $income_accounts = $this->_income_accounts($office_ids);    

    $expense_accounts = [];

    foreach($income_accounts as $income_account){

      $expense_accounts[$income_account['income_account_id']]['income_account'] = $income_account;

      $this->db->select(array('expense_account_id','expense_account_code','expense_account_name'));
      $expense_accounts[$income_account['income_account_id']]['expense_accounts'] = $this->db->get_where('expense_account',
      array('fk_income_account_id'=>$income_account['income_account_id']))->result_array();
      
    }

    return $expense_accounts;
  }

  function _month_expense_by_expense_account($office_ids,$reporting_month){
    
    $start_date_of_reporting_month = date('Y-m-01',strtotime($reporting_month));
    $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));

    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->select(array('income_account_id','expense_account_id'));
    $this->db->group_by('expense_account_id');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where(array('voucher_type_effect_code'=>'expense','voucher_date>='=>$start_date_of_reporting_month,
    'voucher_date<='=>$end_date_of_reporting_month));
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $this->db->join('expense_account','expense_account.expense_account_id=voucher_detail.fk_expense_account_id');
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $result = $this->db->get('voucher_detail');

    $order_array = [];

    if($result->num_rows() > 0){
      $rows = $result->result_array();

      foreach($rows as $record){
        $order_array[$record['income_account_id']][$record['expense_account_id']] = $record['voucher_detail_total_cost'];
      }
    }

    return $order_array;
  }

  function _expense_to_date_by_expense_account($office_ids,$reporting_month){
    
    $fy_start_date = $this->grants->fy_start_date($reporting_month);
    $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));

    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->select(array('income_account_id','expense_account_id'));
    $this->db->group_by('expense_account_id');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where(array('voucher_type_effect_code'=>'expense','voucher_date>='=>$fy_start_date,
    'voucher_date<='=>$end_date_of_reporting_month));
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $this->db->join('expense_account','expense_account.expense_account_id=voucher_detail.fk_expense_account_id');
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $result = $this->db->get('voucher_detail');

    $order_array = [];

    if($result->num_rows() > 0){
      $rows = $result->result_array();

      foreach($rows as $record){
        $order_array[$record['income_account_id']][$record['expense_account_id']] = $record['voucher_detail_total_cost'];
      }
    }

    return $order_array;
  }

  function _bugdet_to_date_by_expense_account($office_ids,$reporting_month){
    //return 400;

    $financial_year = $this->grants->get_fy($reporting_month);
    $month_number = date('m',strtotime($reporting_month));
    $month_order = $this->db->get_where('month',array('month_number'=>$month_number))->row()->month_order;

    $this->db->select_sum('budget_item_detail_amount');
    $this->db->select(array('income_account_id','expense_account_id'));
    $this->db->group_by('expense_account_id');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where(array('month_order<='=>$month_order));
    $this->db->where(array('budget_year'=>$financial_year));

    $this->db->join('budget_item','budget_item.budget_item_id=budget_item_detail.fk_budget_item_id');
    $this->db->join('budget','budget.budget_id=budget_item.fk_budget_id');
    $this->db->join('month','month.month_id=budget_item_detail.fk_month_id');
    $this->db->join('expense_account','expense_account.expense_account_id=budget_item.fk_expense_account_id');
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');

    $result = $this->db->get('budget_item_detail');

    $order_array = [];

    if($result->num_rows() > 0){
      $rows = $result->result_array();

      foreach($rows as $record){
        $order_array[$record['income_account_id']][$record['expense_account_id']] = $record['budget_item_detail_amount'];
      }
    }

    return $order_array;
  }

  function _budget_variance_by_expense_account($office_ids,$reporting_month){
    return 150;
  }

  function _budget_variance_percent_by_expense_account($office_ids,$reporting_month){
    return 0.65;
  }

  function _expense_account_comment($office_ids,$reporting_month){
    return "Good work";
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
        'fund_balance_report'=>$this->_fund_balance_report($office_ids,$reporting_month),
        'projects_balance_report'=>$this->_projects_balance_report($office_ids,$reporting_month),
        'proof_of_cash'=>$this->_proof_of_cash($office_ids,$reporting_month),
        'financial_ratios'=>$this->financial_ratios(),
        'bank_reconciliation'=>$this->_bank_reconciliation($office_ids,$reporting_month,$multiple_offices_report),
        'outstanding_cheques'=>$this->_list_oustanding_cheques_and_deposits($office_ids,$reporting_month,'expense','bank_contra','bank'),
        'clear_outstanding_cheques'=>$this->_list_cleared_effects($office_ids,$reporting_month,'expense','bank_contra','bank'),
        'deposit_in_transit'=>$this->_list_oustanding_cheques_and_deposits($office_ids,$reporting_month,'income','cash_contra','bank'),//$this->_deposit_in_transit($office_ids,$reporting_month),
        'cleared_deposit_in_transit'=>$this->_list_cleared_effects($office_ids,$reporting_month,'income','cash_contra','bank'),
        'expense_report'=>$this->_expense_report($office_ids,$reporting_month)
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

  function _projects_balance_report($office_ids,$reporting_month){
    $headers = [];
    $body = [];


    $projects = $this->_office_projects($office_ids,$reporting_month);

    foreach($projects as $project_id => $project){
      $body[$project_id]['funder'] = $project['funder_name'];
      $body[$project_id]['project'] = $project['project_name'];
      $body[$project_id]['month_expense'] = $this->_projects_month_expense($office_ids,$reporting_month,$project_id) == null?0:$this->_projects_month_expense($office_ids,$reporting_month,$project_id);
      $body[$project_id]['allocation_target'] = $this->_projects_allocation_target($office_ids,$project_id) == null?0:$this->_projects_allocation_target($office_ids,$project_id);      
    }

    if($this->config->item('funding_balance_report_aggregate_method') == 'receipt'){
      $headers = [
                  "funder"=>get_phrase("funder"),
                  "project"=>get_phrase("project"),
                  "allocation_target"=>get_phrase("allocation_target"),
                  "opening_balance"=>get_phrase("opening_balance"),
                  "month_income"=>get_phrase("month_income"),
                  "month_expense"=>get_phrase("month_expense"),
                  "closing_balance"=>get_phrase("closing_balance")
                ];

      foreach($projects as $project_id => $project){
        $body[$project_id]['opening_balance'] = $this->_projects_opening_balances($office_ids,$reporting_month,$project_id) == null?0:$this->_projects_opening_balances($office_ids,$reporting_month,$project_id); 
        $body[$project_id]['month_income'] = $this->_projects_month_income($office_ids,$reporting_month,$project_id) == null?0:$this->_projects_month_income($office_ids,$reporting_month,$project_id); 
        $body[$project_id]['closing_balance'] = $this->_projects_receipt_closing_balance($office_ids,$reporting_month,$project_id) == null?0:$this->_projects_receipt_closing_balance($office_ids,$reporting_month,$project_id); 
      }                

    }elseif($this->config->item('funding_balance_report_aggregate_method') == 'allocation'){
      $headers = [
                  "funder"=>get_phrase("funder"),
                  "project"=>get_phrase("project"),
                  "allocation_target"=>get_phrase("allocation_target"),
                  "month_expense"=>get_phrase("month_expense"),
                  "month_expense_to_date"=>get_phrase("month_expense_to_date"),
                  "closing_balance"=>get_phrase("closing_balance")
                ];

        foreach($projects as $project_id => $project){
          $body[$project_id]['month_expense_to_date'] = $this->_projects_month_expense_to_date($office_ids,$reporting_month,$project_id); 
          $body[$project_id]['closing_balance'] = $this->_projects_allocation_closing_balance($office_ids,$reporting_month,$project_id); 
        }         
                   
    }

    return ['headers'=>$headers,'body'=>$body];
  }

  function _projects_allocation_closing_balance($office_ids,$reporting_month,$project_id){
    $closing_balance = $this->_projects_allocation_target($office_ids,$project_id) - $this->_projects_month_expense_to_date($office_ids,$reporting_month,$project_id);
    
    return $closing_balance;
  }

  function _projects_month_expense_to_date($office_ids,$reporting_month,$project_id){
    //return 15;

    $end_of_reporting_month = date('Y-m-t',strtotime($reporting_month));

    $project_allocations = $this->db->select('project_allocation_id')->get_where('project_allocation',
    array('fk_project_id'=>$project_id))->result_array();

    $project_allocation_ids = array_column($project_allocations,'project_allocation_id');

    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->where(array('voucher_type_effect_code'=>'expense'));
    $this->db->where(array('voucher_date<='=>$end_of_reporting_month));
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where_in('fk_project_allocation_id',$project_allocation_ids);
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $voucher_detail_total_cost = $this->db->get('voucher_detail')->row()->voucher_detail_total_cost;

    return $voucher_detail_total_cost;
  }

  function _projects_allocation_target($office_ids,$project_id){

    $this->db->select_sum('project_allocation_amount');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where(array('project_id'=>$project_id));
    $this->db->join('project','project.project_id=project_allocation.fk_project_id');
    $sum_project_allocation_amount = $this->db->get('project_allocation')->row()->project_allocation_amount;

    return $sum_project_allocation_amount;
  }

  function _projects_receipt_closing_balance($office_ids,$reporting_month,$project_id){
    $opening_balance = $this->_projects_opening_balances($office_ids,$reporting_month,$project_id);
    $month_income = $this->_projects_month_income($office_ids,$reporting_month,$project_id);
    $month_expense = $this->_projects_month_expense($office_ids,$reporting_month,$project_id);

    $closing_balance = $opening_balance + $month_income - $month_expense;

    return $closing_balance;
  } 

  function _projects_month_income($office_ids,$reporting_month,$project_id){
    //return 12;
    $project_allocations = $this->db->select('project_allocation_id')->get_where('project_allocation',
    array('fk_project_id'=>$project_id))->result_array();

    $project_allocation_ids = array_column($project_allocations,'project_allocation_id');

    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->where(array('voucher_type_effect_code'=>'income'));
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where_in('fk_project_allocation_id',$project_allocation_ids);
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $voucher_detail_total_cost = $this->db->get('voucher_detail')->row()->voucher_detail_total_cost;

    return $voucher_detail_total_cost;
  }

  function _projects_opening_balances($office_ids,$reporting_month,$project_id){
    $target_allocation = $this->_projects_allocation_target($office_ids,$project_id);
    $projects_previous_months_expense_to_date = $this->_projects_previous_months_expense_to_date($office_ids,$reporting_month,$project_id);

    $opening_balance = $target_allocation - $projects_previous_months_expense_to_date;

    return $opening_balance;
  }

  function _projects_previous_months_expense_to_date($office_ids,$reporting_month,$project_id){
    //return 15;

    $start_of_reporting_month = date('Y-m-01',strtotime($reporting_month));

    $project_allocations = $this->db->select('project_allocation_id')->get_where('project_allocation',
    array('fk_project_id'=>$project_id))->result_array();

    $project_allocation_ids = array_column($project_allocations,'project_allocation_id');

    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->where(array('voucher_type_effect_code'=>'expense'));
    $this->db->where(array('voucher_date<'=>$start_of_reporting_month));
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where_in('fk_project_allocation_id',$project_allocation_ids);
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $voucher_detail_total_cost = $this->db->get('voucher_detail')->row()->voucher_detail_total_cost;

    return $voucher_detail_total_cost;
  }

  function _projects_month_expense($office_ids,$reporting_month,$project_id){

    $start_date_of_reporting_month = date('Y-m-01',strtotime($reporting_month));
    $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));
    
    $project_allocations = $this->db->select('project_allocation_id')->get_where('project_allocation',
    array('fk_project_id'=>$project_id))->result_array();

    $project_allocation_ids = array_column($project_allocations,'project_allocation_id');

    $this->db->select_sum('voucher_detail_total_cost');
    $this->db->where(array('voucher_type_effect_code'=>'expense'));
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where_in('fk_project_allocation_id',$project_allocation_ids);
    $this->db->where(array('voucher_date>='=>$start_date_of_reporting_month,'voucher_date<='=>$end_date_of_reporting_month));
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $voucher_detail_total_cost = $this->db->get('voucher_detail')->row()->voucher_detail_total_cost;

    return $voucher_detail_total_cost;
  }

  function _office_projects($office_ids,$reporting_month){

    $start_date_of_reporting_month = date('Y-m-01',strtotime($reporting_month));
    $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));

    $this->db->select(array('project_id','project_name','funder_name','fk_office_id'));
    $this->db->join('funder','funder.funder_id=project.fk_funder_id');
    $this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where(array('project_start_date <='=>$start_date_of_reporting_month,
    'project_end_date>='=>$end_date_of_reporting_month));
    $projects = $this->db->get('project')->result_array();

    $ordered_array = [];

    foreach($projects as $project){
      $ordered_array[$project['project_id']]['project_name'] = $project['project_name'];
      $ordered_array[$project['project_id']]['funder_name'] = $project['funder_name'];
    }

    return $ordered_array;
  }

  function update_bank_statement_balance(){
    $post = $this->input->post();

    $insert_reconciliation_data['reconciliation_name'] = "Reconciliation for  ".$post['reporting_month'];
    $insert_reconciliation_data['fk_office_id'] = $post['office_id'];
    $insert_reconciliation_data['reconciliation_reporting_month'] = $post['reporting_month'];
    $insert_reconciliation_data['financial_report_is_submitted'] = 0;
    $insert_reconciliation_data['reconciliation_statement_amount'] = $post['bank_statement_balance'];
    $insert_reconciliation_data['reconciliation_statement_date'] = $post['statement_date'];
    $insert_reconciliation_data['reconciliation_suspense_amount'] = 0;

    $insert_reconciliation_data_to_insert = $this->grants_model->merge_with_history_fields('reconciliation',$insert_reconciliation_data,false);

    $reconciliation_obj = $this->db->get_where('reconciliation',
      array('fk_office_id'=>$post['office_id'],'reconciliation_reporting_month'=>$post['reporting_month']));

    $this->db->trans_start();

      if($reconciliation_obj->num_rows() == 0){
        $this->db->insert('reconciliation',$insert_reconciliation_data_to_insert);
      }else{
        $this->db->where(array('reconciliation_id'=>$reconciliation_obj->row()->reconciliation_id));
        $update_reconciliation_data['reconciliation_statement_amount'] = $post['bank_statement_balance'];
        $update_reconciliation_data['reconciliation_statement_date'] = $post['statement_date'];
        $this->db->update('reconciliation',$update_reconciliation_data);
      }
     
    $this->db->trans_complete();
    
    if($this->db->trans_status() == false){
      echo "Reconcialition update failed";
    }else{
      echo "Reconcialition updated";
    }

  }

  function clear_transactions(){
    $post = $this->input->post();

    $update_data['voucher_cleared'] = 1;
    $update_data['voucher_cleared_month'] = date('Y-m-t',strtotime($post['reporting_month']));//date('Y-m-t');

    if($post['voucher_state'] == 1){
      $update_data['voucher_cleared'] = 0;
      $update_data['voucher_cleared_month'] = null;
    }
    

    $this->db->trans_start();

    $this->db->where(array('voucher_id'=>$post['voucher_id']));

    $this->db->update('voucher',$update_data);

    $this->db->trans_complete();

    if($this->db->trans_status() == false){
      echo false;
    }else{
      echo true;
    }
  }

  static function get_menu_list(){}

}