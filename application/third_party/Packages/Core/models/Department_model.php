<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Department_model extends MY_Model{

    public $table = 'department'; 
    public $dependant_table = '';
    public $name_field = 'department_name';
    public $create_date_field = "department_created_date";
    public $created_by_field = "department_created_by";
    public $last_modified_date_field = "department_last_modified_date";
    public $last_modified_by_field = "department_last_modified_by";
    public $deleted_at_field = "department_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('approval','status');
    }

    public function detail_tables(){
        return array('department_user');
    }

    function intialize_table(Array $foreign_keys_values = []){
        
        $department_data['department_id'] = 1;
        $department_data['department_track_number'] = $this->grants_model->generate_item_track_number_and_name('department')['department_track_number'];
        $department_data['department_name'] = "Administration";
        $department_data['department_description'] = "Administration";
        $department_data['department_is_active'] = 1;
        
        $department_data_to_insert = $this->grants_model->merge_with_history_fields('account_system',$department_data,false);
        $this->db->insert('department',$department_data_to_insert);

        return $this->db->insert();
    }
}