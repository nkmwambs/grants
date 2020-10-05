<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Financial_report_model extends MY_Model{

    public $table = 'financial_report'; 
    public $dependant_table = '';
    public $name_field = 'financial_report_name';
    public $create_date_field = "financial_report_created_date";
    public $created_by_field = "financial_report_created_by";
    public $last_modified_date_field = "financial_report_last_modified_date";
    public $last_modified_by_field = "financial_report_last_modified_by";
    public $deleted_at_field = "financial_report_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('office','status','approval');
    }

    function show_add_button(){
        return false;
    }

    function list_table_visible_columns(){
        return ['financial_report_track_number','office_name','financial_report_month','financial_report_created_date','financial_report_is_submitted','status_name'];
    }

    /**
     * @todo - Find out why this method causes an error $this->user_model->get_lowest_office_context()->context_definition_id;
     */
     function list_table_where(){
        //$context_definition_level = $this->session->context_definition['context_definition_level'];

        if(!$this->session->system_admin){
            $this->db->where_in('office_id',array_column($this->session->hierarchy_offices,'office_id'));
        }
      }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function financial_report_information(String $id, Array $offices_ids = []){

        $report_id = hash_id($id,'decode');

        $offices_information = [];

        $financial_report_month = "";
        
        $reporting_month = $this->db->get_where('financial_report',
        array('financial_report_id'=>$report_id))->row()->financial_report_month;

        $this->db->join('office','office.office_id=financial_report.fk_office_id');
        $financial_report =  $this->db->select(array('financial_report_month',
        'fk_office_id as office_id','office_name'))->get_where('financial_report',
        array('financial_report_month'=>$reporting_month));

        //if(count($offices_ids) > 0){
            $offices_information =  $financial_report->result_array();
            
        //}
        // else{  
        //     $financial_report_month =  $financial_report->row()->financial_report_month; 
        // }
        
        // $offices_information =  $financial_report->result_array();

        // echo  json_encode($financial_report->result_array());exit;

        return $offices_information;
    }

    /**
     * is_financial_report_initial
     * 
     * Give results as true if the office has only one unsubmitted financial report
     * 
     * @param $office_id int 
     * 
     * @return bool
     */
    // function is_financial_report_initial(int $office_ids):bool{
        
    //     $is_initial_report = false;
    //     $initial_unsubmitted_report = 0;

    //     $initial_status = $this->grants_model->initial_item_status('financial_report');
        
    //     $this->db->where_in('fk_office_id',$office_ids);
    //     $count_of_financial_report = $this->db->get('financial_report')->num_rows();

    //     if($count_of_financial_report == 1){
    //         $initial_unsubmitted_report = $this->db->get_where('financial_report',
    //             array('fk_status_id'=>$initial_status,'fk_office_id'=>$office_id))->num_rows();
            
    //         if($initial_unsubmitted_report == 1){
    //             $is_initial_report = true;
    //         }    
    //     }

    //     return $is_initial_report;
    // }

    // function test_month_income_opening_balance($office_ids, $start_date_of_month, $project_ids = []){
        
    //     $income_accounts = $this->income_accounts($office_ids,$project_ids);

    //     $opening_balances = [];

    //     foreach($income_accounts as $income_account){
    //         $opening_balances[$income_account['income_account_id']] = $this->_get_income_account_opening_balance($office_ids,$income_account['income_account_id'],$start_date_of_month,$project_ids);
    //     }

    //     return $opening_balances;
    // }

    function month_income_opening_balance($office_ids, $start_date_of_month, $project_ids = []){
        
        $income_accounts = $this->income_accounts($office_ids,$project_ids);

        //print_r($income_accounts);exit;

        $opening_balances = [];

        foreach($income_accounts as $income_account){
            $opening_balances[$income_account['income_account_id']] = $this->_get_income_account_opening_balance($office_ids,$income_account['income_account_id'],$start_date_of_month,$project_ids);
        }

        //print_r($opening_balances);exit;

        return $opening_balances;
    }

    function _initial_opening_account_balance($office_ids,$income_account_id, $project_ids = []){
        $account_opening_balance = 0;
        $initial_account_opening_balance_obj = null;
        $balance_column = '';
        
        // Check if account is donor funder
        $this->db->select(array('income_account_is_donor_funded'));
        $income_account_is_donor_funded = $this->db->get_where('income_account',
        array('income_account_id'=>$income_account_id))->row()->income_account_is_donor_funded;

        //print_r($income_account_is_donor_funded);exit;

        if(!$income_account_is_donor_funded && empty($project_ids)){

            $this->db->select(array('opening_fund_balance_amount'));
            $this->db->join('opening_fund_balance','opening_fund_balance.fk_system_opening_balance_id=system_opening_balance.system_opening_balance_id');
            $this->db->where_in('system_opening_balance.fk_office_id',$office_ids);
            $initial_account_opening_balance_obj = $this->db->get_where('system_opening_balance',
                array('fk_income_account_id'=>$income_account_id));

            $balance_column = 'opening_fund_balance_amount';

        }else{

            $this->db->select('opening_fund_balance_amount');
            //$this->db->group_by(array('income_account_id'));
            $this->db->join('opening_fund_balance','opening_fund_balance.fk_system_opening_balance_id=system_opening_balance.system_opening_balance_id');
            $this->db->join('income_account','income_account.income_account_id=opening_fund_balance.fk_income_account_id');
            $this->db->join('project_income_account','project_income_account.fk_income_account_id=income_account.income_account_id');
            $this->db->join('project','project.project_id=project_income_account.fk_project_id');
            $this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
            
            if(count($project_ids) > 0){
                $this->db->where_in('fk_project_id',$project_ids);
            }   
           
            $initial_account_opening_balance_obj = $this->db->get('system_opening_balance',
                array('income_account_id'=>$income_account_id));

            $balance_column = 'opening_fund_balance_amount';

        }
        
        //print_r($initial_account_opening_balance_obj->result_array());exit;
        
        if($initial_account_opening_balance_obj->num_rows() == 1){
            $account_opening_balance = $initial_account_opening_balance_obj->row()->$balance_column;
        }

        return $account_opening_balance;
    }

    private function _get_income_account_opening_balance($office_ids,$income_account_id,$start_date_of_month, $project_ids = []){
        
        //$is_initial_report = $this->is_financial_report_initial($office_ids);

        //$account_opening_balance = $this->_initial_opening_account_balance($office_ids,$income_account_id);        

        //if(!$is_initial_report){
        $account_opening_balance = $this->_get_to_date_account_opening_balance($office_ids,$income_account_id,$start_date_of_month,$project_ids);
        //}
        
        return $account_opening_balance;
    }

    function _get_to_date_account_opening_balance($office_ids,$income_account_id,$start_date_of_month, $project_ids = []){
        
        $initial_account_opening_balance = $this->_initial_opening_account_balance($office_ids,$income_account_id,$project_ids);

        $account_last_month_income_to_date = $this->_get_account_last_month_income_to_date($office_ids,$income_account_id,$start_date_of_month,$project_ids);

        $account_last_month_expense_to_date = $this->_get_account_last_month_expense_to_date($office_ids,$income_account_id,$start_date_of_month, $project_ids);

        $account_opening_balance = $initial_account_opening_balance + ($account_last_month_income_to_date - $account_last_month_expense_to_date); 
        
        return $account_opening_balance;
    }

    function _get_account_last_month_income_to_date($office_ids,$income_account_id,$start_date_of_month, $project_ids = []){

        $previous_months_income_to_date = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->group_by('voucher_type_effect_code');
        $this->db->where_in('voucher.fk_office_id',$office_ids);

        if(count($project_ids)>0){
            $this->db->where_in('fk_project_id',$project_ids);
            $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
        }

        $previous_months_income_obj = $this->db->get_where('voucher_detail',
        array('voucher_date<'=>$start_date_of_month,
        'voucher_detail.fk_income_account_id'=>$income_account_id,'voucher_type_effect_code'=>'income'));

        if($previous_months_income_obj->num_rows() > 0){
            $previous_months_income_to_date = $previous_months_income_obj->row()->voucher_detail_total_cost;
        }

        return $previous_months_income_to_date;
    }

    function _get_account_last_month_expense_to_date($office_ids,$income_account_id,$start_date_of_month, $project_ids = []){
        
        $previous_months_expense_to_date = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('expense_account','expense_account.expense_account_id=voucher_detail.fk_expense_account_id');
        $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');

        if(count($project_ids)>0){
            $this->db->where_in('fk_project_id',$project_ids);
            $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
        }

        $this->db->group_by('voucher_type_effect_code');
        $this->db->where_in('voucher.fk_office_id',$office_ids);

        $previous_months_expense_obj = $this->db->get_where('voucher_detail',
        array('voucher_date<'=>$start_date_of_month,
        'income_account_id'=>$income_account_id,'voucher_type_effect_code'=>'expense'));

        if($previous_months_expense_obj->num_rows() > 0){
            $previous_months_expense_to_date = $previous_months_expense_obj->row()->voucher_detail_total_cost;
        }

        return $previous_months_expense_to_date;
    }

    function month_income_account_receipts($office_ids, $start_date_of_month,$project_ids = []){
        //print_r($project_ids);exit;
        $income_accounts = $this->income_accounts($office_ids,$project_ids);

        $month_income = [];

        foreach($income_accounts as $income_account){
            $month_income[$income_account['income_account_id']] = $this->_get_account_month_income($office_ids,$income_account['income_account_id'],$start_date_of_month,$project_ids);
        }
        //print_r($month_income);exit;
        return $month_income;
    }

    function _get_account_month_income($office_ids,$income_account_id,$start_date_of_month,$project_ids = []){
        //echo $income_account_id;exit;
        $last_date_of_month = date('Y-m-t',strtotime($start_date_of_month));

        $month_income = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->group_by('fk_income_account_id');
        $this->db->where_in('voucher.fk_office_id',$office_ids);

        if(count($project_ids) > 0){
            $this->db->where_in('fk_project_id',$project_ids);
            $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
        }

        $month_income_obj = $this->db->get_where('voucher_detail',
            array('voucher_type_effect_code'=>'income',
            'fk_income_account_id'=>$income_account_id,'voucher_date>='=>$start_date_of_month,
            'voucher_date<='=>$last_date_of_month));

        if($month_income_obj->num_rows() > 0){
            $month_income = $month_income_obj->row()->voucher_detail_total_cost;
        }    

        return $month_income;

    }
    
    function month_income_account_expenses($office_ids, $start_date_of_month,$project_ids = []){

        $income_accounts = $this->income_accounts($office_ids,$project_ids);

        $expense_income = [];

        foreach($income_accounts as $income_account){
            $expense_income[$income_account['income_account_id']] = $this->_get_income_account_month_expense($office_ids,$income_account['income_account_id'],$start_date_of_month,$project_ids);
        }

        return $expense_income;
    }

    function _get_income_account_month_expense($office_ids,$income_account_id,$start_date_of_month,$project_ids = []){
        $last_date_of_month = date('Y-m-t',strtotime($start_date_of_month));

        $expense_income = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('expense_account','expense_account.expense_account_id=voucher_detail.fk_expense_account_id');
        $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
        $this->db->group_by('voucher_type_effect_code');
        $this->db->where_in('voucher.fk_office_id',$office_ids);

        if(count($project_ids) > 0){
            $this->db->where_in('fk_project_id',$project_ids);
            $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
        }

        $expense_income_obj = $this->db->get_where('voucher_detail',
        array('voucher_date>='=>$start_date_of_month,'voucher_date<='=>$last_date_of_month,
        'income_account_id'=>$income_account_id,'voucher_type_effect_code'=>'expense'));

        if($expense_income_obj->num_rows() > 0){
            $expense_income = $expense_income_obj->row()->voucher_detail_total_cost;
        }    

        return $expense_income;
    }

    function income_accounts($office_ids, $project_ids = []){
        
        $this->db->select('fk_account_system_id');
        $this->db->where_in('office_id',$office_ids);
        $office_account_system_ids = $this->db->get('office')->result_array();
       
        if(count($project_ids) > 0){
            $this->db->where_in('fk_project_id',$project_ids);
            $this->db->join('project_income_account','project_income_account.fk_income_account_id=income_account.income_account_id');
            //$this->db->join('project','project.fk_income_account_id=income_account.income_account_id');
            //$this->db->join('project_allocation','project_allocation.fk_income_account_id=income_account.income_account_id');
        }
        
        $this->db->where_in('fk_account_system_id',array_column($office_account_system_ids,'fk_account_system_id'));
        $this->db->group_by('income_account_id');
        $result = $this->db->select(array('income_account_id','income_account_name'))->get('income_account')->result_array();

        return $result;
    }


    function system_opening_bank_balance($office_ids,Array $project_ids = []){

        $this->db->select_sum('opening_bank_balance_amount');
        $this->db->join('system_opening_balance','system_opening_balance.system_opening_balance_id=opening_bank_balance.fk_system_opening_balance_id');
        $this->db->join('office_bank','office_bank.office_bank_id=opening_bank_balance.fk_office_bank_id');
        $this->db->where_in('system_opening_balance.fk_office_id',$office_ids);

        if(count($project_ids) > 0){
            $this->db->where_in('project_allocation.fk_project_id',$project_ids);
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_office_bank_id=office_bank.office_bank_id');
            $this->db->join('project_allocation','project_allocation.project_allocation_id=office_bank_project_allocation.fk_project_allocation_id');
        }

        $opening_bank_balance_obj = $this->db->get('opening_bank_balance');
        
        return $opening_bank_balance_obj->num_rows()>0?$opening_bank_balance_obj->row()->opening_bank_balance_amount:0;
    }

    function system_opening_cash_balance($office_ids,$project_ids = []){
        $balance = 0;
    
        $this->db->select_sum('opening_cash_balance_amount');
        $this->db->join('system_opening_balance','system_opening_balance.system_opening_balance_id=opening_cash_balance.fk_system_opening_balance_id');
        $this->db->where_in('system_opening_balance.fk_office_id',$office_ids);

        if(count($project_ids) > 0 ){
            $this->db->where_in('project_allocation.fk_project_id',$project_ids);
            $this->db->join('office_bank','office_bank.office_bank_id=opening_cash_balance.fk_office_bank_id');
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_office_bank_id=office_bank.office_bank_id');
            $this->db->join('project_allocation','project_allocation.project_allocation_id=office_bank_project_allocation.fk_project_allocation_id');
        }

        $opening_cash_balance_obj = $this->db->get('opening_cash_balance');
        
        if($opening_cash_balance_obj->num_rows()>0){
           $balance = $opening_cash_balance_obj->row()->opening_cash_balance_amount; 
        }
    
        return $balance;
      }


    function cash_transactions_to_date($office_ids,$reporting_month, $transaction_type, $voucher_type_account, $project_ids = []){
        // bank_income = voucher of voucher_type_effect_code == income or cash_contra and voucher_type_account_code == bank 
        // bank_expense = voucher of voucher_type_effect_code == expense or bank_contra and voucher_type_account_code == bank 
        // cash_income = voucher of voucher_type_effect_code == income or bank_contra and voucher_type_account_code == cash 
        // cash_expense = voucher of voucher_type_effect_code == expense or cash_contra and voucher_type_account_code == cash 
        
        $voucher_detail_total_cost = 0;
        $end_of_reporting_month = date('Y-m-t',strtotime($reporting_month));

        $this->db->where(array('voucher_date<='=>$end_of_reporting_month));

        //$cond_string = "(voucher_type_account_code = '".$voucher_type_account."' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = '".$voucher_type_account."' AND voucher_type_effect_code = 'contra' )";
        
        if($voucher_type_account == 'bank' && $transaction_type == 'income'){
            $cond_string = "((voucher_type_account_code = 'bank' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'cash' AND  voucher_type_effect_code = 'contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account == 'bank' && $transaction_type == 'expense'){
            $cond_string = "((voucher_type_account_code = 'bank' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'bank' AND  voucher_type_effect_code = 'contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account == 'cash' && $transaction_type == 'income'){
            $cond_string = "((voucher_type_account_code = 'cash' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'bank' AND  voucher_type_effect_code = 'contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account == 'cash' && $transaction_type == 'expense'){
            $cond_string = "((voucher_type_account_code = 'cash' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'cash' AND  voucher_type_effect_code = 'contra'))";
            $this->db->where($cond_string);
        }
        
        

        $this->db->select_sum('voucher_detail_total_cost');

        $this->db->where_in('voucher.fk_office_id',$office_ids);
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');

        if(count($project_ids) > 0){
            $this->db->where_in('fk_project_id',$project_ids);
            $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
          }

        $voucher_detail_total_cost_obj = $this->db->get('voucher_detail');
    
        if($voucher_detail_total_cost_obj->num_rows() > 0){
          $voucher_detail_total_cost = $voucher_detail_total_cost_obj->row()->voucher_detail_total_cost;
        }
      
        return $voucher_detail_total_cost == null ? 0 : $voucher_detail_total_cost;
      }

      function get_month_active_projects($office_ids,$reporting_month,$show_active_only = false){
        
        $date_condition_string = "(project_end_date >= '".$reporting_month."' OR  project_allocation_extended_end_date >= '".$reporting_month."')";
        
        $this->db->select(array('project_id','project_name'));

        if($show_active_only){
            $this->db->where($date_condition_string);
        }
        
        $this->db->where_in('fk_office_id',$office_ids);
        $this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
        $projects = $this->db->get('project')->result_array();

        return $projects;
      }


      function month_expense_by_expense_account($office_ids,$reporting_month,$project_ids = []){
    
        $start_date_of_reporting_month = date('Y-m-01',strtotime($reporting_month));
        $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));
    
        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->select(array('income_account_id','expense_account_id'));
        $this->db->group_by('expense_account_id');
        $this->db->where_in('voucher.fk_office_id',$office_ids);
        $this->db->where(array('voucher_type_effect_code'=>'expense','voucher_date>='=>$start_date_of_reporting_month,
        'voucher_date<='=>$end_date_of_reporting_month));
        
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('expense_account','expense_account.expense_account_id=voucher_detail.fk_expense_account_id');
        $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
        
        if(count($project_ids) > 0){
          $this->db->where_in('fk_project_id',$project_ids);
          $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
        }
    
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

      function expense_to_date_by_expense_account($office_ids,$reporting_month,$project_ids = []){
    
        $fy_start_date = $this->grants->fy_start_date($reporting_month);
        $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));
    
        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->select(array('income_account_id','expense_account_id'));
        $this->db->group_by('expense_account_id');
        $this->db->where_in('voucher.fk_office_id',$office_ids);
        $this->db->where(array('voucher_type_effect_code'=>'expense','voucher_date>='=>$fy_start_date,
        'voucher_date<='=>$end_date_of_reporting_month));
        
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('expense_account','expense_account.expense_account_id=voucher_detail.fk_expense_account_id');
        $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
        
        if(count($project_ids) > 0){
          $this->db->where_in('fk_project_id',$project_ids);
          $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
        }
    
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

      function bugdet_to_date_by_expense_account($office_ids,$reporting_month,$project_ids = []){

        $financial_year = $this->grants->get_fy($reporting_month);
        $month_number = date('m',strtotime($reporting_month));
        $month_order = $this->db->get_where('month',array('month_number'=>$month_number))->row()->month_order;
    
        $this->db->select_sum('budget_item_detail_amount');
        $this->db->select(array('income_account.income_account_id as income_account_id','expense_account.expense_account_id as expense_account_id'));
        $this->db->group_by('expense_account.expense_account_id');
        $this->db->where_in('budget.fk_office_id',$office_ids);
        $this->db->where(array('month_order<='=>$month_order));
        $this->db->where(array('budget_year'=>$financial_year));
    
        $this->db->join('budget_item','budget_item.budget_item_id=budget_item_detail.fk_budget_item_id');
        $this->db->join('budget','budget.budget_id=budget_item.fk_budget_id');
        $this->db->join('month','month.month_id=budget_item_detail.fk_month_id');
        $this->db->join('expense_account','expense_account.expense_account_id=budget_item.fk_expense_account_id');
        $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    
        if(count($project_ids) > 0){
            $this->db->where_in('project_allocation.fk_project_id',$project_ids);
            $this->db->join('project_allocation','project_allocation.project_allocation_id=budget_item.fk_project_allocation_id');
        }
    
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

      function list_oustanding_cheques_and_deposits($office_ids,$reporting_month, $transaction_type,$contra_type,$voucher_type_account_code,$project_ids = []){
        //$office_bank_ids = [];
        if(count($project_ids) > 0){
            $this->db->select(array('office_bank.office_bank_id'));
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_office_bank_id=office_bank.office_bank_id');
            $this->db->join('project_allocation','project_allocation.project_allocation_id=office_bank_project_allocation.fk_project_allocation_id');
            $this->db->where_in('fk_project_id',$project_ids);
            $office_bank_ids = array_column($this->db->get('office_bank')->result_array(),'office_bank_id');

            if(!empty($office_bank_ids)){
                $this->db->where_in('office_bank.office_bank_id',$office_bank_ids);
            }
            
        }
        

        $list_oustanding_cheques_and_deposit = [];
        
        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->select(array('voucher_id','voucher_number','voucher_cheque_number',
        'voucher_description','voucher_cleared','office_code','office_name','voucher_date',
        'voucher_cleared','fk_office_bank_id','office_bank_name'));
        
        $this->db->group_by(array('voucher_id'));
        
        
        $this->db->where_in('voucher.fk_office_id',$office_ids);
        
        if($transaction_type == 'expense'){
            $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);// contra, expense , income
            $this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));// bank, cash
        }else{
            $this->db->where_in('voucher_type_effect_code',[$transaction_type]);// contra, expense , income
            $this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));// bank, cash
        }
       
        
        $this->db->group_start();
            $this->db->where(array('voucher_cleared'=>0));
            $this->db->or_group_start();
                $this->db->where(array('voucher_cleared'=>1,'voucher_cleared_month > '=>date('Y-m-t',strtotime($reporting_month))));
            $this->db->group_end();
        $this->db->group_end();
        
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('office','office.office_id=voucher.fk_office_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
        $this->db->join('office_bank','office_bank.office_bank_id=voucher.fk_office_bank_id');
        
        
        $list_oustanding_cheques_and_deposit = $this->db->get('voucher_detail')->result_array();
        //echo json_encode($list_oustanding_cheques_and_deposit);exit;
        return $list_oustanding_cheques_and_deposit;
      }

      /**
       * list_cleared_effects + list_oustanding_cheques_and_deposits can be normalized
       */

      function list_cleared_effects($office_ids,$reporting_month, $transaction_type,$contra_type,$voucher_type_account_code,$project_ids = []){

        if(count($project_ids) > 0){
            $this->db->select(array('office_bank.office_bank_id'));
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_office_bank_id=office_bank.office_bank_id');
            $this->db->join('project_allocation','project_allocation.project_allocation_id=office_bank_project_allocation.fk_project_allocation_id');
            $this->db->where_in('fk_project_id',$project_ids);
            $office_bank_ids = array_column($this->db->get('office_bank')->result_array(),'office_bank_id');

            if(!empty($office_bank_ids)){
                //$this->db->where_in('office_bank_id',$office_bank_ids);
            }
        }
        

        $list_cleared_effects = [];
        
        //return 145890.00;
        //$cleared_condition = " `voucher_cleared` = 1 AND `voucher_cleared_month` = '".date('Y-m-t',strtotime($reporting_month))."' ";
        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->select(array('voucher_id','voucher_number','voucher_cheque_number','voucher_description',
        'voucher_cleared','office_code','office_name','voucher_date','voucher_cleared','office_bank_id','office_bank_name'));
        $this->db->group_by('voucher_id');
        $this->db->where_in('voucher.fk_office_id',$office_ids);
        $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);
        $this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));

        $this->db->where_in('voucher.fk_office_id',$office_ids);
        $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);
        $this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));
        $this->db->where(array('voucher_cleared'=>1,'voucher_cleared_month'=>date('Y-m-t',strtotime($reporting_month))));

        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('office','office.office_id=voucher.fk_office_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
        $this->db->join('office_bank','office_bank.office_bank_id=voucher.fk_office_bank_id');

        if(count($project_ids) > 0){
            $this->db->where_in('voucher.fk_office_bank_id',$office_bank_ids);
        }

        $list_cleared_effects = $this->db->get('voucher_detail')->result_array();
        //echo json_encode($project_ids);exit;
        return $list_cleared_effects;
      }

      function check_if_financial_report_is_submitted($office_ids,$reporting_month){
    
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

}