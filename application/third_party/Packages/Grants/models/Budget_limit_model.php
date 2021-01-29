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
            "budget_limit_amount"
        ];
    }
}