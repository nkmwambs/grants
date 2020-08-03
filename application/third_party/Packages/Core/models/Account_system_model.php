<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Account_system_model extends MY_Model{

    public $table = 'account_system'; 
    public $dependant_table = '';
    public $name_field = 'account_system_name';
    public $create_date_field = "account_system_created_date";
    public $created_by_field = "account_system_created_by";
    public $last_modified_date_field = "account_system_last_modified_date";
    public $last_modified_by_field = "account_system_last_modified_by";
    public $deleted_at_field = "account_system_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array();
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function intialize_table(Array $foreign_keys_values = []){
        
        $account_system_data['account_system_track_number'] = $this->grants_model->generate_item_track_number_and_name('account_system')['account_system_track_number'];
        $account_system_data['account_system_name'] = "Global Account System";
        $account_system_data['account_system_code'] = "global";
        $account_system_data['account_system_is_allocation_linked_to_account'] = 0;
        
        $account_system_data_to_insert = $this->grants_model->merge_with_history_fields('account_system',$account_system_data,false);
        $this->db->insert('account_system',$account_system_data_to_insert);

        return $this->db->insert();
    }
}