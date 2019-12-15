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
        
        return array('user','context_'.$context_definition_name);
    }

    function show_add_button(){
        return false;
    }

    function edit_visible_columns(){
        //You can only edit the level since the name will conflict with table names and code when edited
        // This needs to be worked on later to make it flexible
        return array('context_definition_level');
    }

}