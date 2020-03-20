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
        return ['financial_report_track_number','office_name','financial_report_month','financial_report_created_date','status_name'];
    }

    /**
     * @todo - Find out why this method causes an error $this->user_model->get_lowest_office_context()->context_definition_id;
     */
    function list_table_where(){
        $lowest_context = 13;// $this->user_model->get_lowest_office_context()->context_definition_id;
        if($this->config->item('only_combined_center_financial_reports')){
            $this->db->where(array('office.fk_context_definition_id'=>$lowest_context));
        }
        
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function financial_report_information(String $id, Array $offices_ids = []){
        $report_id = hash_id($id,'decode');

        $offices_information = [];

        if(count($offices_ids) == 0){
                $this->db->join('office','office.office_id=financial_report.fk_office_id');
                $offices_information =  $this->db->select(array('financial_report_month',
                'fk_office_id as office_id','office_name'))->get_where('financial_report',
                array('financial_report_id'=>$report_id))->result_array();
        }else{
            $financial_report_month =  $this->db->select(array('financial_report_month'))->get_where('financial_report',
            array('financial_report_id'=>$report_id))->row()->financial_report_month;

            $this->db->join('office','office.office_id=financial_report.fk_office_id');
            $offices_information = $this->db->select(array('financial_report_month','fk_office_id as office_id','office_name'))->get_where('financial_report',
                array('financial_report_month'=>$financial_report_month))->result_array();    
        }
        

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

    function month_income_opening_balance($office_ids, $start_date_of_month){
        
        $income_accounts = $this->income_accounts($office_ids);

        $opening_balances = [];

        foreach($income_accounts as $income_account){
            $opening_balances[$income_account['income_account_id']] = $this->_get_income_account_opening_balance($office_ids,$income_account['income_account_id'],$start_date_of_month);
        }

        return $opening_balances;
    }

    private function _initial_opening_account_balance($office_ids,$income_account_id){
        $account_opening_balance = 0;
        
        $this->db->select(array('opening_fund_balance_amount'));
        $this->db->join('opening_fund_balance','opening_fund_balance.fk_system_opening_balance_id=system_opening_balance.system_opening_balance_id');
        $this->db->where_in('fk_office_id',$office_ids);
        $initial_account_opening_balance_obj = $this->db->get_where('system_opening_balance',
            array('fk_income_account_id'=>$income_account_id));
        
        if($initial_account_opening_balance_obj->num_rows() == 1){
            $account_opening_balance = $initial_account_opening_balance_obj->row()->opening_fund_balance_amount;
        }

        return $account_opening_balance;
    }

    private function _get_income_account_opening_balance($office_ids,$income_account_id,$start_date_of_month){
        
        //$is_initial_report = $this->is_financial_report_initial($office_ids);

        //$account_opening_balance = $this->_initial_opening_account_balance($office_ids,$income_account_id);        

        //if(!$is_initial_report){
        $account_opening_balance = $this->_get_to_date_account_opening_balance($office_ids,$income_account_id,$start_date_of_month);
        //}

        return $account_opening_balance;
    }

    private function _get_to_date_account_opening_balance($office_ids,$income_account_id,$start_date_of_month){
        
        $initial_account_opening_balance = $this->_initial_opening_account_balance($office_ids,$income_account_id);

        $account_last_month_income_to_date = $this->_get_account_last_month_income_to_date($office_ids,$income_account_id,$start_date_of_month);

        $account_last_month_expense_to_date = $this->_get_account_last_month_expense_to_date($office_ids,$income_account_id,$start_date_of_month);

        $account_opening_balance = $initial_account_opening_balance + ($account_last_month_income_to_date - $account_last_month_expense_to_date); 
        
        return $account_opening_balance;
    }

    function _get_account_last_month_income_to_date($office_ids,$income_account_id,$start_date_of_month){

        $previous_months_income_to_date = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->group_by('voucher_type_effect_code');
        $this->db->where_in('fk_office_id',$office_ids);
        $previous_months_income_obj = $this->db->get_where('voucher_detail',
        array('voucher_date<'=>$start_date_of_month,
        'fk_income_account_id'=>$income_account_id,'voucher_type_effect_code'=>'income'));

        if($previous_months_income_obj->num_rows() > 0){
            $previous_months_income_to_date = $previous_months_income_obj->row()->voucher_detail_total_cost;
        }

        return $previous_months_income_to_date;
    }

    function _get_account_last_month_expense_to_date($office_ids,$income_account_id,$start_date_of_month){
        
        $previous_months_expense_to_date = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('expense_account','expense_account.expense_account_id=voucher_detail.fk_expense_account_id');
        $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
        $this->db->group_by('voucher_type_effect_code');
        $this->db->where_in('fk_office_id',$office_ids);
        $previous_months_expense_obj = $this->db->get_where('voucher_detail',
        array('voucher_date<'=>$start_date_of_month,
        'income_account_id'=>$income_account_id,'voucher_type_effect_code'=>'expense'));

        if($previous_months_expense_obj->num_rows() > 0){
            $previous_months_expense_to_date = $previous_months_expense_obj->row()->voucher_detail_total_cost;
        }

        return $previous_months_expense_to_date;
    }

    function month_income_account_receipts($office_ids, $start_date_of_month){

        $income_accounts = $this->income_accounts($office_ids);

        $month_income = [];

        foreach($income_accounts as $income_account){
            $month_income[$income_account['income_account_id']] = $this->_get_account_month_income($office_ids,$income_account['income_account_id'],$start_date_of_month);
        }

        return $month_income;
    }

    function _get_account_month_income($office_ids,$income_account_id,$start_date_of_month){
        
        $last_date_of_month = date('Y-m-t',strtotime($start_date_of_month));

        $month_income = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->group_by('fk_income_account_id');
        $this->db->where_in('fk_office_id',$office_ids);
        $month_income_obj = $this->db->get_where('voucher_detail',
            array('voucher_type_effect_code'=>'income',
            'fk_income_account_id'=>$income_account_id,'voucher_date>='=>$start_date_of_month,
            'voucher_date<='=>$last_date_of_month));

        if($month_income_obj->num_rows() > 0){
            $month_income = $month_income_obj->row()->voucher_detail_total_cost;
        }    

        return $month_income;

    }
    
    function month_income_account_expenses($office_ids, $start_date_of_month){

        $income_accounts = $this->income_accounts($office_ids);

        $expense_income = [];

        foreach($income_accounts as $income_account){
            $expense_income[$income_account['income_account_id']] = $this->_get_income_account_month_expense($office_ids,$income_account['income_account_id'],$start_date_of_month);
        }

        return $expense_income;
    }

    function _get_income_account_month_expense($office_ids,$income_account_id,$start_date_of_month){
        $last_date_of_month = date('Y-m-t',strtotime($start_date_of_month));

        $expense_income = 0;

        $this->db->select_sum('voucher_detail_total_cost');
        $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
        $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
        $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
        $this->db->join('expense_account','expense_account.expense_account_id=voucher_detail.fk_expense_account_id');
        $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
        $this->db->group_by('voucher_type_effect_code');
        $this->db->where_in('fk_office_id',$office_ids);
        $expense_income_obj = $this->db->get_where('voucher_detail',
        array('voucher_date>='=>$start_date_of_month,'voucher_date<='=>$last_date_of_month,
        'income_account_id'=>$income_account_id,'voucher_type_effect_code'=>'expense'));

        if($expense_income_obj->num_rows() > 0){
            $expense_income = $expense_income_obj->row()->voucher_detail_total_cost;
        }    

        return $expense_income;
    }

    function income_accounts($office_ids){
        
        $this->db->select('fk_account_system_id');
        $this->db->where_in('office_id',$office_ids);
        $office_account_system_ids = $this->db->get('office')->result_array();

        $this->db->where_in('fk_account_system_id',array_column($office_account_system_ids,'fk_account_system_id'));
        return $this->db->select(array('income_account_id','income_account_name'))->get('income_account')->result_array();
    }

}