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

    function action_before_insert($post_array){

        return $this->grants->sanitize_post_value_before_insert($post_array,'account_system_code');
    }

    function transaction_validate_duplicates_columns(){
        return ['account_system_code'];
    }


    public function lookup_tables(){
        return array();
    }

    public function detail_tables(){
        return list_detail_tables();
    }

    function lookup_values(){
        
        $lookup_values = [];
        
        if(!$this->session->system_admin){
            $results = $this->db->select(array('account_system_id','account_system_name'))->
            get_where('account_system',array('account_system_code'=>$this->session->user_account_system));

            if($results->num_rows() > 0){
                $lookup_values = $results->result_array();
            }
            
            return $lookup_values;
        }
        
    }

    public function detail_multi_form_add_visible_columns(){}

    function intialize_table(Array $foreign_keys_values = []){
        
        $account_system_data['account_system_track_number'] = $this->grants_model->generate_item_track_number_and_name('account_system')['account_system_track_number'];
        $account_system_data['account_system_name'] = "Global Account System";
        $account_system_data['account_system_code'] = "global";
        $account_system_data['account_system_is_allocation_linked_to_account'] = 0;
        
        $account_system_data_to_insert = $this->grants_model->merge_with_history_fields('account_system',$account_system_data,false);
        $this->write_db->insert('account_system',$account_system_data_to_insert);

        return $this->write_db->insert();
    }

    function show_add_button(){
        if(!$this->session->system_admin){
            return false;
        }else{
            return true;
        }
    }

    function list_table_where(){
        if(!$this->session->system_admin){
            $this->db->where(array('account_system_code'=>$this->session->user_account_system));
        }
    }

}