<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Cheque_injection_model extends MY_Model{

    public $table = 'cheque_injection'; 
    public $dependant_table = '';
    public $name_field = 'cheque_injection_name';
    public $create_date_field = "cheque_injection_created_date";
    public $created_by_field = "cheque_injection_created_by";
    public $last_modified_date_field = "cheque_injection_last_modified_date";
    public $last_modified_by_field = "cheque_injection_last_modified_by";
    public $deleted_at_field = "cheque_injection_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('office_bank');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    public function single_form_add_visible_columns()
    {
        return [
            "office_bank_name",
            "cheque_injection_number"
        ];
    }

    public function lookup_values()
    {
        $lookup_values = parent::lookup_values();

        if(!$this->session->system_admin){
            $office_ids = array_column($this->session->hierarchy_offices,"office_id");
            $this->read_db->where_in('fk_office_id',$office_ids);
            $lookup_values['office_bank'] = $this->read_db->get('office_bank')->result_array();
        }

        return $lookup_values;
    }

    public function list_table_visible_columns(){
        return [
            "cheque_injection_track_number",
            "cheque_injection_number",
            "office_bank_name",
            "cheque_injection_created_date"
        ];
    }

    function transaction_validate_duplicates_columns()
    {
        return ['fk_office_bank_id','cheque_injection_number'];
    }
}