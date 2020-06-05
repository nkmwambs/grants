<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Opening_cash_balance_model extends MY_Model{

    public $table = 'opening_cash_balance'; 
    public $dependant_table = '';
    public $name_field = 'opening_cash_balance_name';
    public $create_date_field = "opening_cash_balance_created_date";
    public $created_by_field = "opening_cash_balance_created_by";
    public $last_modified_date_field = "opening_cash_balance_last_modified_date";
    public $last_modified_by_field = "opening_cash_balance_last_modified_by";
    public $deleted_at_field = "opening_cash_balance_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('system_opening_balance');
    }

    public function detail_tables(){
        return ['project_allocation_opening_cash_balance'];
    }

    public function detail_multi_form_add_visible_columns(){}
}