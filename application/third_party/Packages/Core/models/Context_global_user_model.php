<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Context_global_user_model extends MY_Model{

    public $table = 'context_global_user'; 
    public $dependant_table = '';
    public $name_field = 'context_global_user_name';
    public $create_date_field = "context_global_user_created_date";
    public $created_by_field = "context_global_user_created_by";
    public $last_modified_date_field = "context_global_user_last_modified_date";
    public $last_modified_by_field = "context_global_user_last_modified_by";
    public $deleted_at_field = "context_global_user_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('user','context_global','designation');
    }

    public function detail_tables(){}

    function intialize_table(Array $foreign_keys_values = []){
    
        $context_global_user_data['context_global_user_track_number'] = $this->grants_model->generate_item_track_number_and_name('context_global_user')['context_global_user_track_number'];
        $context_global_user_data['context_global_user_name'] = 'System User';
        $context_global_user_data['fk_user_id'] = $foreign_keys_values['user_id'];
        $context_global_user_data['fk_context_global_id'] = 1;//$foreign_keys_values['context_global_id']; 
        $context_global_user_data['fk_designation_id'] = $foreign_keys_values['designation_id'];
        $context_global_user_data['context_global_user_is_active'] = 1;
            
        $context_global_user_data_to_insert = $this->grants_model->merge_with_history_fields('context_global_user',$context_global_user_data,false);
        $this->db->insert('context_global_user',$context_global_user_data_to_insert);
    
        return $this->db->insert_id();
    }
}