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

        // $financial_report_month = "";
        
        // $financial_report_obj = $this->db->get_where('financial_report',
        // array('financial_report_id'=>$report_id))->row();

        // $reporting_month = $financial_report_obj->financial_report_month;

        // $office_id = $financial_report_obj->fk_office_id;

        //echo $report_id;exit;

        $this->db->select(array('financial_report_month','fk_office_id as office_id','office_name'));
        $this->db->join('office','office.office_id=financial_report.fk_office_id');

        if(count($offices_ids) > 0){
            $this->db->where_in('fk_office_id',$offices_ids);
        }else{
            $this->db->where(array('financial_report_id'=>$report_id));
        }

        $offices_information =  $this->db->get('financial_report')->result_array();

        //if(count($offices_ids) > 0){
            //$offices_information =  $financial_report->result_array();
            
        //}
        // else{  
        //     $financial_report_month =  $financial_report->row()->financial_report_month; 
        // }
        
        // $offices_information =  $financial_report->result_array();

        // echo  json_encode($financial_report->result_array());exit;

        //print_r($offices_information);exit;

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

    function month_income_opening_balance($office_ids, $start_date_of_month, $project_ids = [], $office_bank_ids = []){
        
        $income_accounts = $this->income_accounts($office_ids,$project_ids,$office_bank_ids);

        //print_r($income_accounts);exit;

        $opening_balances = [];

        foreach($income_accounts as $income_account){
            
            $opening_balances[$income_account['income_account_id']] = $this->_get_to_date_account_opening_balance($office_ids,$income_account['income_account_id'],$start_date_of_month,$project_ids, $office_bank_ids);//$this->_get_income_account_opening_balance($office_ids,$income_account['income_account_id'],$start_date_of_month,$project_ids,$office_bank_ids);
        }

        //print_r($opening_balances);exit;

        return $opening_balances;
    }

    // function get_office_bank_project_allocation($office_bank_id){
    //     $office_bank_project_allocations = $this->db->
    //     where(array('fk_office_bank_id'=>$office_bank_id))->
    //     get('office_bank_project_allocation')->result_array();
    
    //     return $office_bank_project_allocations;
    //   }

    function _initial_opening_account_balance($office_ids,$income_account_id, $project_ids = [], $office_bank_ids = []){
        $account_opening_balance = 0;

        $get_office_bank_project_allocation = [];

        if(count($office_bank_ids) > 0){
            $get_office_bank_project_allocation = $this->get_office_bank_project_allocation($office_bank_ids);
        }
        
        $this->db->select(array('opening_fund_balance_amount'));
        $this->db->join('opening_fund_balance','opening_fund_balance.fk_system_opening_balance_id=system_opening_balance.system_opening_balance_id');
        
        if(count($office_bank_ids) > 0){
            $this->db->where_in('opening_fund_balance.fk_office_bank_id',$office_bank_ids);
            //$get_office_bank_project_allocation = $this->get_office_bank_project_allocation($office_bank_ids);

            // $this->db->join('income_account','income_account.income_account_id=opening_fund_balance.fk_income_account_id');
            // $this->db->join('project_income_account','project_income_account.fk_income_account_id=income_account.income_account_id');
            // $this->db->join('project','project.project_id=project_income_account.fk_project_id');

            // $this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
            // $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_project_allocation_id=project_allocation.project_allocation_id');
            
            // $this->db->group_start();
            //     $this->db->where_in('office_bank_project_allocation.fk_office_bank_id',$office_bank_ids);
            //     $this->db->or_where_in('office_bank_project_allocation.fk_project_allocation_id',$get_office_bank_project_allocation);
            // $this->db->group_end();
        }
        
        //echo json_encode($office_bank_ids);exit;

        if(count($project_ids) > 0){
            $this->db->where_in('project.project_id',$project_ids);
            $this->db->join('income_account','income_account.income_account_id=opening_fund_balance.fk_income_account_id');
            $this->db->join('project_income_account','project_income_account.fk_income_account_id=income_account.income_account_id');
            $this->db->join('project','project.project_id=project_income_account.fk_project_id');

        }

       
        //echo json_encode($project_ids);exit;
        
        
        $this->db->where_in('system_opening_balance.fk_office_id',$office_ids);
        $initial_account_opening_balance_obj = $this->db->get_where('system_opening_balance',
               array('opening_fund_balance.fk_income_account_id'=>$income_account_id));

        
        if($initial_account_opening_balance_obj->num_rows() == 1){
            $account_opening_balance = $initial_account_opening_balance_obj->row()->opening_fund_balance_amount;
        }

        return $account_opening_balance;
    }

    // private function _get_income_account_opening_balance($office_ids,$income_account_id,$start_date_of_month, $project_ids = [], $office_bank_ids = []){
        
    //     //$is_initial_report = $this->is_financial_report_initial($office_ids);

    //     //$account_opening_balance = $this->_initial_opening_account_balance($office_ids,$income_account_id);        

    //     //if(!$is_initial_report){
    //     $account_opening_balance = $this->_get_to_date_account_opening_balance($office_ids,$income_account_id,$start_date_of_month,$project_ids, $office_bank_ids);
    //     //}
        
    //     return $account_opening_balance;
    // }

    function _get_to_date_account_opening_balance($office_ids,$income_account_id,$start_date_of_month, $project_ids = [], $office_bank_ids = []){
        
        $initial_account_opening_balance = $this->_initial_opening_account_balance($office_ids,$income_account_id,$project_ids,$office_bank_ids);

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

    function month_income_account_receipts($office_ids, $start_date_of_month,$project_ids = [],$office_bank_ids = []){
        //print_r($project_ids);exit;
        $income_accounts = $this->income_accounts($office_ids,$project_ids);

        $month_income = [];

        foreach($income_accounts as $income_account){
            $month_income[$income_account['income_account_id']] = $this->_get_account_month_income($office_ids,$income_account['income_account_id'],$start_date_of_month,$project_ids,$office_bank_ids);
        }
        //print_r($month_income);exit;
        return $month_income;
    }

    function _get_account_month_income($office_ids,$income_account_id,$start_date_of_month,$project_ids = [], $office_bank_ids = []){
        //echo $income_account_id;exit;
        $last_date_of_month = date('Y-m-t',strtotime($start_date_of_month));

        $month_income = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->group_by(array('fk_income_account_id'));
        $this->db->where_in('voucher.fk_office_id',$office_ids);

        $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');

        if(count($project_ids) > 0){
            $this->db->where_in('project_allocation.fk_project_id',$project_ids);
        }

        if(count($office_bank_ids) > 0){
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_project_allocation_id=project_allocation.project_allocation_id');
            $this->db->where_in('office_bank_project_allocation.fk_office_bank_id',$office_bank_ids);
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
    
    function month_income_account_expenses($office_ids, $start_date_of_month,$project_ids = [], $office_bank_ids = []){

        $income_accounts = $this->income_accounts($office_ids,$project_ids);

        $expense_income = [];

        foreach($income_accounts as $income_account){
            $expense_income[$income_account['income_account_id']] = $this->_get_income_account_month_expense($office_ids,$income_account['income_account_id'],$start_date_of_month,$project_ids, $office_bank_ids);
        }

        return $expense_income;
    }

    function _get_income_account_month_expense($office_ids,$income_account_id,$start_date_of_month,$project_ids = [], $office_bank_ids = []){
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

        $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
        
        if(count($project_ids) > 0){
            $this->db->where_in('project_allocation.fk_project_id',$project_ids);
        }

        if(count($office_bank_ids) > 0){
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_project_allocation_id=project_allocation.project_allocation_id');
            $this->db->where_in('office_bank_project_allocation.fk_office_bank_id',$office_bank_ids);
        }

        $expense_income_obj = $this->db->get_where('voucher_detail',
        array('voucher_date>='=>$start_date_of_month,'voucher_date<='=>$last_date_of_month,
        'income_account_id'=>$income_account_id,'voucher_type_effect_code'=>'expense'));

        if($expense_income_obj->num_rows() > 0){
            $expense_income = $expense_income_obj->row()->voucher_detail_total_cost;
        }    

        return $expense_income;
    }

    function income_accounts($office_ids, $project_ids = [], $office_bank_ids = []){
        
        // Array of account system
        $this->db->select('fk_account_system_id');
        $this->db->where_in('office_id',$office_ids);
        $office_account_system_ids = $this->db->get('office')->result_array();
       
        if(count($project_ids) > 0){
            $this->db->where_in('project.project_id',$project_ids);
            $this->db->join('project_income_account','project_income_account.fk_income_account_id=income_account.income_account_id');
            $this->db->join('project','project.project_id=project_income_account.fk_project_id');
        }

        if(count($office_bank_ids) > 0){
            $this->db->join('project_income_account','project_income_account.fk_income_account_id=income_account.income_account_id');
            $this->db->join('project','project.project_id=project_income_account.fk_project_id');

            $this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_project_allocation_id=project_allocation.project_allocation_id');
            $this->db->where_in('fk_office_bank_id',$office_bank_ids);
        }
        
        $this->db->where_in('income_account.fk_account_system_id',array_column($office_account_system_ids,'fk_account_system_id'));
        $this->db->group_by(array('income_account_id'));
        $result = $this->db->select(array('income_account_id','income_account_name'))->get('income_account')->result_array();
        
        return $result;
    }


    function system_opening_bank_balance($office_ids,Array $project_ids = [], $office_bank_ids = []){

        $this->db->select_sum('opening_bank_balance_amount');
        $this->db->join('system_opening_balance','system_opening_balance.system_opening_balance_id=opening_bank_balance.fk_system_opening_balance_id');
        $this->db->join('office_bank','office_bank.office_bank_id=opening_bank_balance.fk_office_bank_id');
        $this->db->where_in('system_opening_balance.fk_office_id',$office_ids);

        if(!empty($project_ids)){
            $this->db->where_in('project_allocation.fk_project_id',$project_ids);
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_office_bank_id=office_bank.office_bank_id');
            $this->db->join('project_allocation','project_allocation.project_allocation_id=office_bank_project_allocation.fk_project_allocation_id');
        }

        if(!empty($office_bank_ids)){
            $this->db->where_in('opening_bank_balance.fk_office_bank_id',$office_bank_ids);
        }

        $opening_bank_balance_obj = $this->db->get('opening_bank_balance');
        
        return $opening_bank_balance_obj->num_rows()>0?$opening_bank_balance_obj->row()->opening_bank_balance_amount:0;
    }

    function system_opening_cash_balance($office_ids,$project_ids = [], $office_bank_ids = []){
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

        if(!empty($office_bank_ids)){
            $this->db->where_in('opening_cash_balance.fk_office_bank_id',$office_bank_ids);
        }

        $opening_cash_balance_obj = $this->db->get('opening_cash_balance');
        
        if($opening_cash_balance_obj->num_rows()>0){
           $balance = $opening_cash_balance_obj->row()->opening_cash_balance_amount; 
        }
    
        return $balance;
      }

      function get_office_bank_project_allocation($office_bank_ids){

        if(!empty($office_bank_ids)){
            $this->db->select(array('fk_project_allocation_id'));
            $this->db->where_in('fk_office_bank_id',$office_bank_ids);
            $result =  $this->db->get('office_bank_project_allocation')->result_array();

            return array_column($result,'fk_project_allocation_id');
        }else{
            return [];
        }
      }


    function cash_transactions_to_date($office_ids,$reporting_month, $transaction_type, $voucher_type_account, $project_ids = [], $office_bank_ids = []){
        // bank_income = voucher of voucher_type_effect_code == income or cash_contra and voucher_type_account_code == bank 
        // bank_expense = voucher of voucher_type_effect_code == expense or bank_contra and voucher_type_account_code == bank 
        // cash_income = voucher of voucher_type_effect_code == income or bank_contra and voucher_type_account_code == cash 
        // cash_expense = voucher of voucher_type_effect_code == expense or cash_contra and voucher_type_account_code == cash 
        
        $voucher_detail_total_cost = 0;
        $end_of_reporting_month = date('Y-m-t',strtotime($reporting_month));
        
        if(!empty($office_bank_ids)){
            
            $get_office_bank_project_allocation = !empty($project_ids)? $project_ids :$this->get_office_bank_project_allocation($office_bank_ids);

            $this->db->group_start();
                $this->db->where_in('voucher.fk_office_bank_id',$office_bank_ids);
                $this->db->or_where_in('voucher_detail.fk_project_allocation_id',$get_office_bank_project_allocation);
            $this->db->group_end();
        } 

        if(count($project_ids) > 0){
            $this->db->where_in('fk_project_id',$project_ids);
            $this->db->join('project_allocation','project_allocation.project_allocation_id=voucher_detail.fk_project_allocation_id');
        }

        $this->db->where(array('voucher_date<='=>$end_of_reporting_month));

        //$cond_string = "(voucher_type_account_code = '".$voucher_type_account."' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = '".$voucher_type_account."' AND voucher_type_effect_code = 'contra' )";
        
        if($voucher_type_account == 'bank' && $transaction_type == 'income'){
            $cond_string = "((voucher_type_account_code = 'bank' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'cash' AND  voucher_type_effect_code = 'cash_contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account == 'bank' && $transaction_type == 'expense'){
            $cond_string = "((voucher_type_account_code = 'bank' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'bank' AND  voucher_type_effect_code = 'bank_contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account == 'cash' && $transaction_type == 'income'){
            $cond_string = "((voucher_type_account_code = 'cash' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'bank' AND  voucher_type_effect_code = 'bank_contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account == 'cash' && $transaction_type == 'expense'){
            $cond_string = "((voucher_type_account_code = 'cash' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'cash' AND  voucher_type_effect_code = 'cash_contra'))";
            $this->db->where($cond_string);
        }
        
        

        $this->db->select_sum('voucher_detail_total_cost');

        $this->db->where_in('voucher.fk_office_id',$office_ids);
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id'); 

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


      function month_expense_by_expense_account($office_ids,$reporting_month,$project_ids = [], $office_bank_ids = []){
    
        $start_date_of_reporting_month = date('Y-m-01',strtotime($reporting_month));
        $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));
        $get_office_bank_project_allocation = $this->get_office_bank_project_allocation($office_bank_ids);
    
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

        if(!empty($office_bank_ids)){
            $this->db->where_in('voucher_detail.fk_project_allocation_id',$get_office_bank_project_allocation);
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

      function expense_to_date_by_expense_account($office_ids,$reporting_month,$project_ids = [],$office_bank_ids =[]){
    
        $fy_start_date = fy_start_date($reporting_month);
        $end_date_of_reporting_month = date('Y-m-t',strtotime($reporting_month));
        $get_office_bank_project_allocation = $this->get_office_bank_project_allocation($office_bank_ids);
    
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

        if(!empty($office_bank_ids)){
            $this->db->where_in('voucher_detail.fk_project_allocation_id',$get_office_bank_project_allocation);
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

    //   function list_of_month_order($reporting_month){
    //       return [1,2];
    //   }

      function get_budget_tag_based_on_month($reporting_month){
        
        $month_number = date('n',strtotime($reporting_month));
        
        $this->read_db->select(array('budget_tag_id','fk_month_id'));
        $this->read_db->order_by('budget_tag_level ASC');
        $this->read_db->where(array('fk_account_system_id'=>2));
        $budget_tags_start_month = $this->read_db->get('budget_tag')->result_array();

        $budget_tag_id_array = array_column($budget_tags_start_month,'budget_tag_id');
        $budget_tag_based_on_month_array = array_column($budget_tags_start_month,'fk_month_id');

        $budget_tag_id_based_on_month_values_array = array_combine($budget_tag_based_on_month_array,$budget_tag_id_array);
        
        ksort($budget_tag_id_based_on_month_values_array);

        $budget_tag_id = 0;

        if(array_key_exists($month_number,$budget_tag_id_based_on_month_values_array)){
            $budget_tag_id = $budget_tag_id_based_on_month_values_array[$month_number];
        }else{
            $original_budget_tag_id = $budget_tag_id;
            foreach($budget_tag_id_based_on_month_values_array as $_month_number => $_budget_tag_id){
                if($month_number > $_month_number){
                    $original_budget_tag_id = $_budget_tag_id;
                }else{
                    break;
                }
            }

            $budget_tag_id = $original_budget_tag_id;
        }

        return $budget_tag_id;
      }

      function bugdet_to_date_by_expense_account($office_ids,$reporting_month,$project_ids = [], $office_bank_ids = []){

        $financial_year = get_fy($reporting_month);
        $month_number = date('m',strtotime($reporting_month));
        $month_order = $this->db->get_where('month',array('month_number'=>$month_number))->row()->month_order;
        //$list_of_month_order = $this->list_of_month_order($reporting_month);
        $get_budget_tag_based_on_month = $this->get_budget_tag_based_on_month($reporting_month);

        $get_office_bank_project_allocation = $this->get_office_bank_project_allocation($office_bank_ids);

        $this->db->select_sum('budget_item_detail_amount');
        $this->db->select(array('income_account.income_account_id as income_account_id',
        'expense_account.expense_account_id as expense_account_id'));
        
        $this->db->group_by('expense_account.expense_account_id');
        $this->db->where_in('budget.fk_office_id',$office_ids);
        
        $this->db->where(array('month_order<='=>$month_order));
        //$this->db->where_in('month_order',$list_of_month_order);
        $this->db->where(array('fk_budget_tag_id'=>$get_budget_tag_based_on_month));

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

        if(!empty($office_bank_ids)){
            $this->db->where_in('budget_item.fk_project_allocation_id',$get_office_bank_project_allocation);
        }
    
        $result = $this->db->get('budget_item_detail');
    
        $order_array = [];
    
        if($result->num_rows() > 0){
          $rows = $result->result_array();
    
          foreach($rows as $record){
            $order_array[$record['income_account_id']][$record['expense_account_id']] = $record['budget_item_detail_amount'];
          }
        }
        //echo json_encode($get_office_bank_project_allocation);exit;
        return $order_array;
      }

      function list_oustanding_cheques_and_deposits($office_ids,$reporting_month, $transaction_type,$contra_type,$voucher_type_account_code,$project_ids = [], $office_bank_ids = []){
        //$office_bank_ids = [];
        if(count($project_ids) > 0){
            $this->db->select(array('office_bank.office_bank_id'));
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_office_bank_id=office_bank.office_bank_id');
            $this->db->join('project_allocation','project_allocation.project_allocation_id=office_bank_project_allocation.fk_project_allocation_id');
            $this->db->where_in('fk_project_id',$project_ids);
            //$office_bank_ids = array_column($this->db->get('office_bank')->result_array(),'office_bank_id');
            
        }

        if(!empty($office_bank_ids)){
            $this->db->where_in('office_bank.office_bank_id',$office_bank_ids);
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
        }elseif(($contra_type == 'cash_contra' ||$contra_type = 'bank_contra') && $transaction_type == 'income'){
            $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);
        }else{
            $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);// contra, expense , income
            $this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));// bank, cash
        }
       
        
        // $this->db->group_start();
        //     $this->db->where(array('voucher_cleared'=>0,'voucher_date <='=>date('Y-m-t',strtotime($reporting_month))));
        //     $this->db->or_group_start();
        //         $this->db->where(array('voucher_cleared'=>1,'voucher_cleared_month > '=>date('Y-m-t',strtotime($reporting_month))));
        //     $this->db->group_end();
        // $this->db->group_end();

        $this->db->group_start();
            $this->db->where(array('voucher_cleared'=>0,
            'voucher_date <='=>date('Y-m-t',strtotime($reporting_month))
            //'voucher_date <='=>date('Y-m-t',strtotime($reporting_month))    
            ));
            $this->db->or_group_start();
                $this->db->where(array('voucher_cleared'=>1,
                'voucher_date <='=>date('Y-m-t',strtotime($reporting_month)),
                'voucher_cleared_month > '=>date('Y-m-t',strtotime($reporting_month))));
            $this->db->group_end();
        $this->db->group_end();
        
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('office','office.office_id=voucher.fk_office_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
        $this->db->join('office_bank','office_bank.office_bank_id=voucher.fk_office_bank_id');
        
        
        $list_oustanding_cheques_and_deposit = $this->db->get('voucher_detail')->result_array();

        $uncleared_opening_outstanding_cheques = $this->get_uncleared_opening_outstanding_cheques();

        $list_oustanding_cheques_and_deposit = array_merge($list_oustanding_cheques_and_deposit,$uncleared_opening_outstanding_cheques);
        //echo json_encode($list_oustanding_cheques_and_deposit);exit;
        return $list_oustanding_cheques_and_deposit;
      }

      private function get_uncleared_opening_outstanding_cheques(){
        return [
            // [
            //     'voucher_detail_total_cost' => 34500.23,
            //     'voucher_id'=>0,
            //     'voucher_number'=>0,
            //     'voucher_cheque_number'=>1,
            //     'voucher_description'=>'Test 1',
            //     'voucher_cleared'=>0,
            //     'office_code'=>'KE0278',
            //     'office_name'=>'KE0728',
            //     'voucher_date'=>'2020-05-10',
            //     'fk_office_bank_id'=>1,
            //     'office_bank_name'=>'KCB'
            // ],
            // [
            //     'voucher_detail_total_cost' => 67800.11,
            //     'voucher_id'=>0,
            //     'voucher_number'=>0,
            //     'voucher_cheque_number'=>2,
            //     'voucher_description'=>'Test 2',
            //     'voucher_cleared'=>0,
            //     'office_code'=>'KE0278',
            //     'office_name'=>'KE0728',
            //     'voucher_date'=>'2020-06-12',
            //     'fk_office_bank_id'=>1,
            //     'office_bank_name'=>'KCB'
            // ]
        ];
      }

      /**
       * list_cleared_effects + list_oustanding_cheques_and_deposits can be normalized
       */

      function list_cleared_effects($office_ids,$reporting_month, $transaction_type,$contra_type,$voucher_type_account_code,$project_ids = [], $office_bank_ids = []){

        if(count($project_ids) > 0){
            $this->db->select(array('office_bank.office_bank_id'));
            $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_office_bank_id=office_bank.office_bank_id');
            $this->db->join('project_allocation','project_allocation.project_allocation_id=office_bank_project_allocation.fk_project_allocation_id');
            $this->db->where_in('fk_project_id',$project_ids);
            $office_bank_ids = array_column($this->db->get('office_bank')->result_array(),'office_bank_id');
        }

        if(!empty($office_bank_ids)){
            $this->db->where_in('office_bank_id',$office_bank_ids);
        }
        

        $list_cleared_effects = [];
        
        //return 145890.00;
        //$cleared_condition = " `voucher_cleared` = 1 AND `voucher_cleared_month` = '".date('Y-m-t',strtotime($reporting_month))."' ";
        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->select(array('voucher_id','voucher_number','voucher_cheque_number','voucher_description',
        'voucher_cleared','office_code','office_name','voucher_date','voucher_cleared',
        'office_bank_id','office_bank_name','voucher_is_reversed'));
        $this->db->group_by('voucher_id');
        $this->db->where_in('voucher.fk_office_id',$office_ids);
        //$this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);
        //$this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));

        $this->db->where_in('voucher.fk_office_id',$office_ids);

        // $this->db->where_in('voucher_type_effect_code',[$transaction_type,$contra_type]);
        // $this->db->where(array('voucher_type_account_code'=>$voucher_type_account_code));

        if($voucher_type_account_code == 'bank' && $transaction_type == 'income'){
            $cond_string = "((voucher_type_account_code = 'bank' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'cash' AND  voucher_type_effect_code = 'cash_contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account_code == 'bank' && $transaction_type == 'expense'){
            $cond_string = "((voucher_type_account_code = 'bank' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'bank' AND  voucher_type_effect_code = 'bank_contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account_code == 'cash' && $transaction_type == 'income'){
            $cond_string = "((voucher_type_account_code = 'cash' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'bank' AND  voucher_type_effect_code = 'bank_contra'))";
            $this->db->where($cond_string);
        }elseif($voucher_type_account_code == 'cash' && $transaction_type == 'expense'){
            $cond_string = "((voucher_type_account_code = 'cash' AND  voucher_type_effect_code = '".$transaction_type."') OR (voucher_type_account_code = 'cash' AND  voucher_type_effect_code = 'cash_contra'))";
            $this->db->where($cond_string);
        }
        
        // $this->db->where(array('voucher_cleared'=>1,
        // 'voucher_cleared_month'=>date('Y-m-t',strtotime($reporting_month))));
        $this->db->where(array('voucher_cleared'=>1,'voucher_date<='=>date('Y-m-t',strtotime($reporting_month)),'voucher_cleared_month'=>date('Y-m-t',strtotime($reporting_month))));
        
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