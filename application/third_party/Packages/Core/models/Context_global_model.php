<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Context_global_model extends MY_Model{

    public $table = 'context_global'; 
    public $dependant_table = '';
    public $name_field = 'context_global_name';
    public $create_date_field = "context_global_created_date";
    public $created_by_field = "context_global_created_by";
    public $last_modified_date_field = "context_global_last_modified_date";
    public $last_modified_by_field = "context_global_last_modified_by";
    public $deleted_at_field = "context_global_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('office');
    }

    public function detail_tables(){
        return array('context_global_user','context_region','context_definition');
    }

    function intialize_table(Array $foreign_keys_values = []){
        $context_definitions = $this->config->item('context_definitions');
        $global_context_key = count($context_definitions) + 1;

        $context_global_data['context_global_track_number'] = $this->grants_model->generate_item_track_number_and_name('context_global')['context_global_track_number'];
        $context_global_data['context_global_name'] = 'Head Office Context';
        $context_global_data['context_global_description'] = 'Head Office Context';
        $context_global_data['fk_office_id'] = 1; 
        $context_global_data['fk_context_definition_id'] = $global_context_key;
            
        $context_global_data_to_insert = $this->grants_model->merge_with_history_fields('context_definition',$context_global_data,false);
        $this->db->insert('context_global',$context_global_data_to_insert);

        return $this->db->insert_id();
    } 
}