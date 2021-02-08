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

    function list_table_visible_columns(){
        return ['budget_tag_track_number','budget_tag_name','budget_tag_level','budget_tag_is_active','month_name','account_system_name','budget_tag_created_date','budget_tag_last_modified_date'];
    }

    function single_form_add_visible_columns(){
        return ['budget_tag_name','budget_tag_level','month_name','account_system_name'];
    }

    function edit_visible_columns(){
        return ['budget_tag_name','budget_tag_level','budget_tag_is_active','month_name','account_system_name'];
    }

    function get_budget_tag_id_based_on_reporting_month($office_id,$reporting_month){

        $this->read_db->select(array('budget_tag_id','fk_month_id'));
        $this->read_db->where(array('office_id'=>$office_id));
        $this->read_db->join('account_system','account_system.account_system_id=budget_tag.fk_account_system_id');
        $this->read_db->join('office','office.fk_account_system_id=account_system.account_system_id');
        $budget_tags = $this->read_db->get('budget_tag')->result_array();

        $budget_tag_ids = array_column($budget_tags,'budget_tag_id');
        $month_ids = array_column($budget_tags,'fk_month_id');

        //$start_tag_months_with_ids = [1=>7,2=>10,3=>1,4=>4];
        $start_tag_months_with_ids = array_combine($budget_tag_ids,$month_ids);
        $start_tag_months = array_values($start_tag_months_with_ids);

        $budget_tag_id = 0;
        
        $month = date('n',strtotime($reporting_month));

        for($i=0;$i<sizeof($start_tag_months);$i++){
            if(
                (isset($start_tag_months[$i + 1]) && $start_tag_months[$i] < $start_tag_months[$i + 1] && $month < $start_tag_months[$i + 1] && $month >= $start_tag_months[$i]) ||
                (isset($start_tag_months[$i + 1]) && $start_tag_months[$i] > $start_tag_months[$i + 1] && $month > $start_tag_months[$i + 1] && $month >= $start_tag_months[$i])
            )
            {
                $budget_tag_id = array_search($start_tag_months[$i],$start_tag_months_with_ids);
            }
        }

        return $budget_tag_id;
    }
}