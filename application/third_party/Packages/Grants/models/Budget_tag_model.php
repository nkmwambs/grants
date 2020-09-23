<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Budget_tag_model extends MY_Model{

    public $table = 'budget_tag'; 
    public $dependant_table = '';
    public $name_field = 'budget_tag_name';
    public $create_date_field = "budget_tag_created_date";
    public $created_by_field = "budget_tag_created_by";
    public $last_modified_date_field = "budget_tag_last_modified_date";
    public $last_modified_by_field = "budget_tag_last_modified_by";
    public $deleted_at_field = "budget_tag_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('month','account_system');
    }

    function list_table_where(){
        if(!$this->session->system_admin){
            $this->db->where(array('account_system_id'=>$this->session->user_account_system_id));
        }
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}
}