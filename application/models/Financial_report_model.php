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
        return array('office');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function financial_report_information($id){
        $report_id = hash_id($id,'decode');

        $this->db->join('office','office.office_id=financial_report.fk_office_id');
        return $this->db->select(array('financial_report_month','fk_office_id as office_id','office_name'))->get_where('financial_report',
            array('financial_report_id'=>$report_id))->row_array();
    }

    function month_income_opening_balance($office_id, $start_date_of_month){
        return [
            1=>3200.00,
            2=>143000.00,
            3=>17110.00
        ];
    }

    function month_income_account_receipts($office_id, $start_date_of_month){
        return [
            1=>120000.00,
            2=>450000.00,
            3=>112340.00
        ];
    }
    
    function month_income_account_expenses($office_id, $start_date_of_month){
        return [
            1=>85000.00,
            2=>12000.00,
            3=>8250.00
        ];
    }

    function income_accounts(){
        return $this->db->select(array('income_account_id','income_account_name'))->get('income_account')->result_array();
    }

}