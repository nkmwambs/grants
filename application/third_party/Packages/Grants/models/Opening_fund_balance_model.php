<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Opening_fund_balance_model extends MY_Model{

    public $table = 'opening_fund_balance'; 
    public $dependant_table = '';
    public $name_field = 'opening_fund_balance_name';
    public $create_date_field = "opening_fund_balance_created_date";
    public $created_by_field = "opening_fund_balance_created_by";
    public $last_modified_date_field = "opening_fund_balance_last_modified_date";
    public $last_modified_by_field = "opening_fund_balance_last_modified_by";
    public $deleted_at_field = "opening_fund_balance_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return ['system_opening_balance','income_account','status'];
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function detail_list_table_visible_columns(){
        return ['opening_fund_balance_track_number','opening_fund_balance_name','income_account_name','opening_fund_balance_amount','status_name'];
    }

    function lookup_values_where(){
        return [
            'income_account'=>['income_account_is_donor_funded'=>0,'income_account_is_active'=>1]
        ];
    }

    function transaction_validate_duplicates_columns(){
        //return ['system_opening_balance','income_account'];
    }
}