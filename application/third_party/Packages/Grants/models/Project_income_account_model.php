<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Project_income_account_model extends MY_Model{

    public $table = 'project_income_account'; 
    public $dependant_table = '';
    public $name_field = 'project_income_account_name';
    public $create_date_field = "project_income_account_created_date";
    public $created_by_field = "project_income_account_created_by";
    public $last_modified_date_field = "project_income_account_last_modified_date";
    public $last_modified_by_field = "project_income_account_last_modified_by";
    public $deleted_at_field = "project_income_account_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('project','income_account');
    }

    function single_form_add_visible_columns(){
        return ['project_name','income_account_name'];
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    public function detail_list_table_visible_columns(){
        return [
            'project_income_account_track_number',
            'income_account_name',
            'project_name',
            'project_income_account_created_date'
        ];
    }

    public function transaction_validate_duplicates_columns(){
        return ['fk_project_id','fk_income_account_id'];
      }

    function multi_select_field(){
        return "income_account";
    }  
}