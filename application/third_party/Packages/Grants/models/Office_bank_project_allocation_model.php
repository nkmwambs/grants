<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Office_bank_project_allocation_model extends MY_Model{

    public $table = 'office_bank_project_allocation'; 
    public $dependant_table = '';
    public $name_field = 'office_bank_project_allocation_name';
    public $create_date_field = "office_bank_project_allocation_created_date";
    public $created_by_field = "office_bank_project_allocation_created_by";
    public $last_modified_date_field = "office_bank_project_allocation_last_modified_date";
    public $last_modified_by_field = "office_bank_project_allocation_last_modified_by";
    public $deleted_at_field = "office_bank_project_allocation_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('office_bank','project_allocation');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function office_bank_project_allocation_office_id(){
        $result = $this->db->get_where('office_bank',
        array('office_bank_id'=>hash_id($this->id,'decode')))->row()->fk_office_id;

        return $result;
    }

    public function detail_list_table_visible_columns(){
        return [
            'office_bank_project_allocation_track_number',
            'office_bank_name',
            'project_allocation_name',
            'office_bank_project_allocation_created_date'
        ];
    }

    // public function lookup_values_where(){
    //     return [
    //         'project_allocation'=>['fk_office_id'=>$this->office_bank_project_allocation_office_id()]
    //     ];
    // }

    function single_form_add_visible_columns(){
        return ['office_bank_name','project_allocation_name'];
    }

    function lookup_values(){

        $lookup_values = [];

        if($this->id !== null){
            $office_bank = $this->read_db->get_where('office_bank',array('office_bank_id'=>hash_id($this->id,'decode')));
            $lookup_values['office_bank'] = $office_bank->result_array();
            $lookup_values['project_allocation']  = $this->read_db->get_where('project_allocation',array('fk_office_id'=>$office_bank->row_array()['fk_office_id']))->result_array(); 
        }
        return $lookup_values;
      }

    function show_add_button(){
        if($this->config->item('link_new_project_allocations_only_to_default_bank_accounts') || $this->session->system_admin){
            return true;
        }else{
            return false;
        }
    }
}