<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Budget_limit_model extends MY_Model{

    public $table = 'budget_limit'; 
    public $dependant_table = '';
    public $name_field = 'budget_limit_name';
    public $create_date_field = "budget_limit_created_date";
    public $created_by_field = "budget_limit_created_by";
    public $last_modified_date_field = "budget_limit_last_modified_date";
    public $last_modified_by_field = "budget_limit_last_modified_by";
    public $deleted_at_field = "budget_limit_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
        
        $this->load->model('budget_model');
    }

    function index(){}

    public function lookup_tables(){
        return array('office','budget_tag');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    public function single_form_add_visible_columns()
    {
        return [
            "office_name",
            "budget_tag_name",
            "budget_limit_year",
            "income_account_name",
            "budget_limit_amount"
        ];
    }

    public function list_table_visible_columns()
    {
        return [
            "budget_limit_track_number",
            "office_name",
            "budget_limit_year",
            "budget_tag_name",
            "income_account_name",
            "budget_limit_amount"
        ];
    }

    private function budget_limit_amount($budget_id,$income_account_id){

        $budget_limit_amount = 0;

        $this->read_db->join('office','office.office_id=budget_limit.fk_office_id');
        $this->read_db->join('budget','budget.fk_office_id=office.office_id');
        $this->read_db->where(array('budget_id'=>$budget_id,'fk_income_account_id'=>$income_account_id));
        $budget_limit_obj = $this->read_db->get('budget_limit');

        if($budget_limit_obj->num_rows() > 0){
            $budget_limit_amount = $budget_limit_obj->row()->budget_limit_amount;
        }

        return $budget_limit_amount;
    }

    private function budget_to_date_amount_by_income_account($budget_id,$income_account_id){
        return $this->budget_model->budget_to_date_amount_by_income_account($budget_id,$income_account_id);
    }

    public function budget_limit_remaining_amount($budget_id,$income_account_id){
        $budget_limit_amount = $this->budget_limit_amount($budget_id,$income_account_id);
        $sum_year_budgeted_amount = $this->budget_to_date_amount_by_income_account($budget_id,$income_account_id);

        return $budget_limit_amount - $sum_year_budgeted_amount;
    }
}