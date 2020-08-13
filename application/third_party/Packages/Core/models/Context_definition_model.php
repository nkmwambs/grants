<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Context_definition_model extends MY_Model{

    public $table = 'context_definition'; 
    public $dependant_table = '';
    public $name_field = 'context_definition_name';
    public $create_date_field = "context_definition_created_date";
    public $created_by_field = "context_definition_created_by";
    public $last_modified_date_field = "context_definition_last_modified_date";
    public $last_modified_by_field = "context_definition_last_modified_by";
    public $deleted_at_field = "context_definition_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array();
    }

    public function detail_tables(){
        $context_definition_name =  $this->db->get_where('context_definition',
        array("context_definition_id"=>hash_id($this->id,'decode')))->row()->context_definition_name;
        
        return array('context_'.$context_definition_name);
    }

    function show_add_button(){
        return false;
    }

    function edit_visible_columns(){
        //You can only edit the level since the name will conflict with table names and code when edited
        // This needs to be worked on later to make it flexible
        return array('context_definition_level');
    }

    function intialize_table(Array $foreign_keys_values = []){

        $context_definitions = $this->config->item('context_definitions');

        array_push($context_definitions,'global');

        $insert_ids = [];

        foreach($context_definitions as $context_definition_level => $context_definition){

            $context_definition_level += 1;

            $context_definition_data['context_definition_track_number'] = $this->grants_model->generate_item_track_number_and_name('context_definition')['context_definition_track_number'];
            $context_definition_data['context_definition_name'] = $context_definition;
            $context_definition_data['context_definition_level'] = $context_definition_level;
            $context_definition_data['context_definition_is_implementing'] = 1; // 1 = Can raise a voucher, budget, request and financial report for
            $context_definition_data['context_definition_is_active'] = 1;

            $context_definition_data['context_definition_created_by'] = 1;
            $context_definition_data['context_definition_last_modified_by'] = 1;
            $context_definition_data['context_definition_created_date'] = date('Y-m-d');
            
            $context_definition_data_to_insert = $this->grants_model->merge_with_history_fields('context_definition',$context_definition_data,false);
            $this->db->insert('context_definition',$context_definition_data);

            $insert_ids[$context_definition_level] = $this->db->insert_id();
        }

        return $insert_ids;
        
    }    

    function lookup_values(){
        $lookup_values = $this->db->get('context_definition')->result_array();
        
        if(substr($this->controller,0,8) == 'context_'){
            $context_definition_name = str_replace('context_','',$this->controller);
            $lookup_values = $this->db->get_where('context_definition',array('context_definition_name'=>$context_definition_name))->result_array();
        }elseif(!$this->session->system_admin){
            $context_defination_level=$this->session->context_definition['context_definition_level'];

            $lookup_values = $this->db->get_where('context_definition',array('context_definition_level <= '=>$context_defination_level))->result_array();
            
        }
      

        return $lookup_values;
    }
}