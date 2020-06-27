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

  private function _income_accounts($office_ids, $project_ids = []){

    // Should be moved to Income accounts library
    return $this->financial_report_library->income_accounts($office_ids, $project_ids);
  }

  private function month_income_account_receipts($office_ids,$start_date_of_month){
    return $this->financial_report_library->month_income_account_receipts($office_ids, $start_date_of_month);
  }

  private function month_income_account_expenses($office_ids, $start_date_of_month){
    return $this->financial_report_library->month_income_account_expenses($office_ids, $start_date_of_month);
  }

  private function month_income_opening_balance($office_ids, $start_date_of_month,$project_ids = []){
    return $this->financial_report_library->month_income_opening_balance($office_ids, $start_date_of_month,$project_ids);
  }

  private function _fund_balance_report($office_ids, $start_date_of_month, $project_ids = []){
    
    $income_accounts =  $this->financial_report_model->income_accounts($office_ids,$project_ids);
    
    $all_accounts_month_opening_balance = $this->month_income_opening_balance($office_ids, $start_date_of_month,$project_ids);
    $all_accounts_month_income = $this->month_income_account_receipts($office_ids, $start_date_of_month,$project_ids);
    $all_accounts_month_expense = $this->month_income_account_expenses($office_ids, $start_date_of_month,$project_ids);

    $report = array();

    foreach($income_accounts as $account){
      
      $month_opening_balance = isset($all_accounts_month_opening_balance[$account['income_account_id']])?$all_accounts_month_opening_balance[$account['income_account_id']]:0;
      $month_income = isset($all_accounts_month_income[$account['income_account_id']])?$all_accounts_month_income[$account['income_account_id']]:0;
      $month_expense = isset($all_accounts_month_expense[$account['income_account_id']])?$all_accounts_month_expense[$account['income_account_id']]:0;

      if($month_opening_balance == 0 && $month_income == 0 && $month_expense == 0){
        continue;
      }
       $report[] = [
        'account_name'=>$account['income_account_name'],
        'month_opening_balance'=>$month_opening_balance,
        'month_income'=>$month_income,
        'month_expense'=>$month_expense,
       ]; 
    }  
    
    return $report;
  }

  private function _proof_of_cash($office_ids,$reporting_month,$project_ids = []){
    $cash_at_bank = $this->_compute_cash_at_bank($office_ids,$reporting_month,$project_ids);
    $cash_at_hand = $this->_compute_cash_at_hand($office_ids,$reporting_month,$project_ids);

    return ['cash_at_bank'=>$cash_at_bank,'cash_at_hand'=>$cash_at_hand];
  }

  function _compute_cash_at_bank($office_ids,$reporting_month,$project_ids = []){
    $opening_bank_balance = $this->_opening_cash_balance($office_ids,$project_ids)['bank'];
    $bank_income_to_date = $this->financial_report_model->cash_transactions_to_date($office_ids,$reporting_month,'income','bank',$project_ids);//$this->_cash_income_to_date($office_ids,$reporting_month);
    $bank_expenses_to_date = $this->financial_report_model->cash_transactions_to_date($office_ids,$reporting_month,'expense','bank',$project_ids);//$this->_cash_expense_to_date($office_ids,$reporting_month);
    
    return $bank_income_to_date;//$opening_bank_balance + $bank_income_to_date - $bank_expenses_to_date;
  }


  function _opening_cash_balance($office_ids, Array $project_ids = []){
    return [
      'bank'=>$this->financial_report_model->system_opening_bank_balance($office_ids,$project_ids),
      'cash'=>$this->financial_report_model->system_opening_cash_balance($office_ids,$project_ids)
    ];
  }

  function _compute_cash_at_hand($office_ids,$reporting_month,$project_ids = []){
    //return 15000;
    $opening_cash_balance = $this->_opening_cash_balance($office_ids,$project_ids)['cash'];
    $cash_income_to_date = $this->financial_report_model->cash_transactions_to_date($office_ids,$reporting_month, 'income','cash',$project_ids);//$this->_cash_income_to_date($office_ids,$reporting_month,'bank_contra','cash');
    $cash_expenses_to_date = $this->financial_report_model->cash_transactions_to_date($office_ids,$reporting_month, 'expense','cash',$project_ids);//$this->_cash_expense_to_date($office_ids,$reporting_month,'cash_contra','cash');
    
    return $opening_cash_balance + $cash_income_to_date - $cash_expenses_to_date;
  }

  private function financial_ratios(){

  }

  private function _bank_reconciliation($office_ids,$reporting_month,$multiple_offices_report,$project_ids = []){
    $bank_statement_date = $this->_bank_statement_date($office_ids,$reporting_month,$multiple_offices_report);
    $bank_statement_balance = $this->_bank_statement_balance($office_ids,$reporting_month);
    
    $book_closing_balance = $this->_compute_cash_at_bank($office_ids,$reporting_month,$project_ids);//$this->_book_closing_balance($office_ids,$reporting_month);
    $month_outstanding_cheques = $this->_sum_of_outstanding_cheques_and_transits($office_ids,$reporting_month,'expense','bank_contra','bank',$project_ids);
    $month_transit_deposit = $this->_sum_of_outstanding_cheques_and_transits($office_ids,$reporting_month,'income','cash_contra','bank',$project_ids);//$this->_deposit_in_transit($office_ids,$reporting_month);
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

    $financial_report_statement_amount = 0;

    $this->db->select_sum('financial_report_statement_balance');
    $this->db->where_in('fk_office_id',$office_ids);
    $this->db->where(array('financial_report_month'=>date('Y-m-01',strtotime($reporting_month))));
    $financial_report_statement_amount_obj = $this->db->get('financial_report');

    if($financial_report_statement_amount_obj->row()->financial_report_statement_balance != null){
      $financial_report_statement_amount = $financial_report_statement_amount_obj->row()->financial_report_statement_balance;
    }

    return $financial_report_statement_amount;
    
  }

  // function _book_closing_balance($office_ids,$reporting_month){
  //   return 245980.12;
  // }


  private function bank_statements(){

  }

  function _sum_of_outstanding_cheques_and_transits($office_ids,$reporting_month,$transaction_type,$contra_type,$voucher_type_account_code,$project_ids = []){
    return array_sum(array_column($this->financial_report_model->list_oustanding_cheques_and_deposits($office_ids,$reporting_month,$transaction_type,$contra_type,$voucher_type_account_code,$project_ids),'voucher_detail_total_cost'));
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

  private function _expense_report($office_ids,$reporting_month,$project_ids = []){
    
    $expense_account_grid = [];

    $income_grouped_expense_accounts = $this->_income_grouped_expense_accounts($office_ids);
    $month_expense = $this->financial_report_model->month_expense_by_expense_account($office_ids,$reporting_month,$project_ids);
    $month_expense_to_date = $this->financial_report_model->expense_to_date_by_expense_account($office_ids,$reporting_month,$project_ids);
    $budget_to_date = $this->financial_report_model->bugdet_to_date_by_expense_account($office_ids,$reporting_month,$project_ids);
    
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
    //print_r($user_hierarchy_offices_with_report);exit;
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
  
  private function financial_report_information($report_id){

    $additional_information = $this->financial_report_library->financial_report_information($report_id);

    if(isset($_POST['office_ids']) && count($_POST) > 0){
      $additional_information = $this->financial_report_library->financial_report_information($report_id, $_POST['office_ids']);
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

  function get_month_active_projects($office_ids,$reporting_month,$show_active_only = false){
 
    return $this->financial_report_library->get_month_active_projects($office_ids,$reporting_month);
  }

  function result($id = ''){

    if($this->action == 'view'){
      
     extract($this->financial_report_information($this->id));
      
      return [
        'test'=>[],
        'month_active_projects'=>$this->get_month_active_projects($office_ids,$reporting_month),
        'multiple_offices_report'=>$multiple_offices_report,
        'financial_report_submitted'=>$this->_check_if_financial_report_is_submitted($office_ids,$reporting_month),
        'user_office_hierarchy' => $this->financial_report_office_hierarchy($reporting_month),
        'office_names'=>$office_names,
        'office_ids'=>$office_ids,
        'reporting_month'=>$reporting_month,
        'fund_balance_report'=>$this->_fund_balance_report($office_ids,$reporting_month),
        'projects_balance_report'=>$this->_projects_balance_report($office_ids,$reporting_month),
        'proof_of_cash'=>$this->_proof_of_cash($office_ids,$reporting_month),
        'financial_ratios'=>$this->financial_ratios(),
        'bank_statements_uploads'=>$this->_bank_statements_uploads($office_ids,$reporting_month),
        'bank_reconciliation'=>$this->_bank_reconciliation($office_ids,$reporting_month,$multiple_offices_report),
        'outstanding_cheques'=>$this->financial_report_model->list_oustanding_cheques_and_deposits($office_ids,$reporting_month,'expense','bank_contra','bank'),
        'clear_outstanding_cheques'=>$this->_list_cleared_effects($office_ids,$reporting_month,'expense','bank_contra','bank'),
        'deposit_in_transit'=>$this->financial_report_model->list_oustanding_cheques_and_deposits($office_ids,$reporting_month,'income','cash_contra','bank'),//$this->_deposit_in_transit($office_ids,$reporting_month),
        'cleared_deposit_in_transit'=>$this->_list_cleared_effects($office_ids,$reporting_month,'income','cash_contra','bank'),
        'expense_report'=>$this->_expense_report($office_ids,$reporting_month)
      ];
    }else{
      return parent::result($id = '');
    }
  }

  function result_array($report_id,$office_ids,$reporting_month,$project_ids = []){
    extract($this->financial_report_information($report_id));

    return [
      'test'=>[],//$this->test_month_income_opening_balance($office_ids,$reporting_month,$project_ids),
      'month_active_projects'=>$this->get_month_active_projects($office_ids,$reporting_month),
      'multiple_offices_report'=>$multiple_offices_report,
      'financial_report_submitted'=>$this->_check_if_financial_report_is_submitted($office_ids,$reporting_month),
      'user_office_hierarchy' => $this->financial_report_office_hierarchy($reporting_month),
      'office_names'=>$office_names,
      'office_ids'=>$office_ids,
      'reporting_month'=>$reporting_month,
      'fund_balance_report'=>$this->_fund_balance_report($office_ids,$reporting_month,$project_ids),
      'projects_balance_report'=>$this->_projects_balance_report($office_ids,$reporting_month),
      'proof_of_cash'=>$this->_proof_of_cash($office_ids,$reporting_month,$project_ids),
      'financial_ratios'=>$this->financial_ratios(),
      'bank_statements_uploads'=>$this->_bank_statements_uploads($office_ids,$reporting_month),
      'bank_reconciliation'=>$this->_bank_reconciliation($office_ids,$reporting_month,$multiple_offices_report,$project_ids),
      'outstanding_cheques'=>$this->financial_report_model->list_oustanding_cheques_and_deposits($office_ids,$reporting_month,'expense','contra','bank',$project_ids),
      'clear_outstanding_cheques'=>$this->_list_cleared_effects($office_ids,$reporting_month,'expense','bank_contra','bank'),
      'deposit_in_transit'=>$this->financial_report_model->list_oustanding_cheques_and_deposits($office_ids,$reporting_month,'income','contra','bank',$project_ids),//$this->_deposit_in_transit($office_ids,$reporting_month),
      'cleared_deposit_in_transit'=>$this->_list_cleared_effects($office_ids,$reporting_month,'income','cash_contra','bank'),
      'expense_report'=>$this->_expense_report($office_ids,$reporting_month,$project_ids)
    ];
 
  }

  function filter_financial_report(){

    $project_ids = $this->input->post('project_ids') == null ? [] : $this->input->post('project_ids');
    $office_ids = $this->input->post('office_ids');
    $report_id = $this->input->post('report_id');
    $reporting_month = $this->input->post('reporting_month');

    $result = $this->result_array($report_id, $office_ids,$reporting_month,$project_ids);
    $result['result'] = $result;
    
    //echo json_encode($result);
    
    $view_page =  $this->load->view('financial_report/ajax_view',$result,true);

    echo $view_page;
  }

  function view(){
    parent::view();
  }

  function _check_if_financial_report_is_submitted($office_ids,$reporting_month){
    
    $report_is_submitted = false;

    if(count($office_ids) == 1 ){

      $financial_report_is_submitted = $this->db->get_where('financial_report',
      array('fk_office_id'=>$office_ids[0],
      'financial_report_month'=>date('Y-m-01',strtotime($reporting_month))))->row()->financial_report_is_submitted;
      
      if($financial_report_is_submitted){
        $report_is_submitted = true;
      }
    }

    return $report_is_submitted;
    
  }

  function _bank_statements_uploads($office_ids,$reporting_month){
    return $this->grants->retrieve_file_uploads_info('financial_report',$office_ids,$reporting_month);
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
    
    // $this->grants_model->create_table_join_statement_with_depth('voucher_detail',
    // ['voucher','voucher_type','voucher_type_effect']);

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
    
    // $this->grants_model->create_table_join_statement_with_depth('voucher_detail',
    // ['voucher','voucher_type','voucher_type_effect']);

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
    
    // $this->grants_model->create_table_join_statement_with_depth('voucher_detail',
    // ['voucher','voucher_type','voucher_type_effect']);

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

    // $this->grants_model->create_table_join_statement_with_depth('voucher_detail',
    // ['voucher','voucher_type','voucher_type_effect']);

    $voucher_detail_total_cost = $this->db->get('voucher_detail')->row()->voucher_detail_total_cost;

    return $voucher_detail_total_cost;
  }

  function _office_projects($office_ids,$reporting_month){

    $start_date_of_reporting_month = date('Y-m-01',strtotime($reporting_month));
    $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));
    
    $this->db->select(array('project_id','project_name','funder_name','fk_office_id'));
    $this->db->where_in('fk_office_id',$office_ids);
    // $this->db->where(array('project_start_date <='=>$start_date_of_reporting_month,
    // 'project_end_date>='=>$end_date_of_reporting_month));
    $query_condition = "(project_end_date >= '".$start_date_of_reporting_month."' OR  project_allocation_extended_end_date >= '".$start_date_of_reporting_month."')";
    $this->db->where($query_condition);

    $this->db->join('project','project.project_id=project_allocation.fk_project_id');
    //$this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
    $this->db->join('funder','funder.funder_id=project.fk_funder_id');

    //$this->grants_model->create_table_join_statement_with_depth('project_allocation',['project','funder']);

    $projects = $this->db->get('project_allocation')->result_array();

    $ordered_array = [];

    foreach($projects as $project){
      $ordered_array[$project['project_id']]['project_name'] = $project['project_name'];
      $ordered_array[$project['project_id']]['funder_name'] = $project['funder_name'];
    }

    return $ordered_array;
  }

  function update_bank_statement_balance(){

    $post = $this->input->post();

    $financial_report_obj = $this->db->get_where('financial_report',
      array('fk_office_id'=>$post['office_id'],
      'financial_report_month'=>date('Y-m-01',strtotime($post['reporting_month']))));

    $this->db->trans_start();

        $this->db->where(array('financial_report_id'=>$financial_report_obj->row()->financial_report_id));
        $update_financial_report_data['financial_report_statement_balance'] = $post['bank_statement_balance'];
        $update_financial_report_data['financial_report_statement_date'] = $post['statement_date'];
        $this->db->update('financial_report',$update_financial_report_data);
     
    $this->db->trans_complete();
    
    if($this->db->trans_status() == false){
      echo "Update failed";
    }else{
      echo "Updated successful";
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

  function upload_statements(){

    $post = $this->input->post();

    $financial_report_id = $this->db->get_where('financial_report',
    array('fk_office_id'=>$post['office_id'],
    'financial_report_month'=>$post['reporting_month']))->row()->financial_report_id;

    $storeFolder = upload_url('financial_report',$financial_report_id); 
    
    if(is_array($this->grants->upload_files($storeFolder)) && 
        count($this->grants->upload_files($storeFolder))>0){
          $report_info = ['financial_report_id'=>$financial_report_id];
          $files_array = array_merge($this->grants->upload_files($storeFolder),$report_info);

          echo json_encode($files_array);
    }else{
      echo 0;
    }
}

function delete_statement(){
  $path = $this->input->post('path');
  
  if(unlink($path)){
    echo "File deleted successful";
  }else{
    echo "File deletion failed";
  }

}

function submit_financial_report(){
  $post = $this->input->post();
  $message = true;

  // Check if the report has reconciled
  $report_reconciled = $this->_check_if_report_has_reconciled($post['office_id'],$post['reporting_month']);

  // Check if the all vouchers have been approved
  $vouchers_approved = $this->_check_if_month_vouchers_are_approved($post['office_id'],$post['reporting_month']);

  // Check if their is a bank statement
  $bank_statements_uploaded = $this->_check_if_bank_statements_are_uploaded($post['office_id'],$post['reporting_month']);

  if(!$report_reconciled || !$vouchers_approved || !$bank_statements_uploaded){
    $message = "You have missing requirements and report is not submitted. Check the following items:\n";

    $items = "";
    
    if(!$report_reconciled) $items .= "-> Report is reconciled\n";
    if(!$vouchers_approved) $items .= "-> All vouchers in the month are approved\n";
    if(!$bank_statements_uploaded) $items .= "-> Bank statement uploaded\n";

    $message .= $items;

  }else{
    // Update financial report table
    $this->db->where(array('fk_office_id'=>$post['office_id'],'financial_report_month'=>$post['reporting_month']));
    $update_data = ['financial_report_is_submitted'=>1];
    $this->db->update('financial_report',$update_data);
  }

  echo $message;
}

function _check_if_report_has_reconciled($office_id,$reporting_month){
  //return false;
  $bank_reconciliation_statement = $this->_bank_reconciliation([$office_id],$reporting_month,false);

  $is_book_reconciled = $bank_reconciliation_statement['is_book_reconciled'];
  
  return $is_book_reconciled;
}

function _check_if_month_vouchers_are_approved($office_id,$reporting_month){
  //return false;
  $this->load->model('voucher_model');
  return $this->voucher_model->check_if_month_vouchers_are_approved($office_id,$reporting_month);
}

function _check_if_bank_statements_are_uploaded($office_id,$reporting_month){
  //return false;
  $statements_uploaded = $this->grants->retrieve_file_uploads_info('financial_report',[$office_id],$reporting_month);

  return count($statements_uploaded) > 0? true : false;
}

static function get_menu_list(){}

}