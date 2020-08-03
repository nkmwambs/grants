<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Designation_model extends MY_Model{

    public $table = 'designation'; 
    public $dependant_table = '';
    public $name_field = 'designation_name';
    public $create_date_field = "designation_created_date";
    public $created_by_field = "designation_created_by";
    public $last_modified_date_field = "designation_last_modified_date";
    public $last_modified_by_field = "designation_last_modified_by";
    public $deleted_at_field = "designation_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('context_definition');
    }

    public function detail_tables(){}

    // function lookup_values_where($table){
        
    //     $query_condition_array = array();

    //     if($this->uri->segment(4)){
    //         $hierarchy_id = $this->db->get_where('context_definition',
    //         array('center_group_hierarchy_table_name'=>$this->uri->segment(4,'group_center')))->row()->center_group_hierarchy_id;
            
    //         $query_condition_array = array('fk_center_group_hierarchy_id'=>$hierarchy_id);
    //     }

        
    //     return $query_condition_array;
    // }

    function intialize_table(Array $foreign_keys_values = []){  

        $context_definitions = $this->config->item('context_definitions');
        $global_context_key = count($context_definitions) + 1;

        $designation_data['designation_track_number'] = $this->grants_model->generate_item_track_number_and_name('designation')['designation_track_number'];
        $designation_data['designation_name'] = 'Super System Administrator';
        $designation_data['fk_context_definition_id'] = 6;//$global_context_key;
      
        $designation_data_to_insert = $this->grants_model->merge_with_history_fields('designation',$designation_data,false);
        $this->db->insert('designation',$designation_data_to_insert);
    
        return $this->db->insert_id();
    }

    
}