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
        return array('center_group_hierarchy');
    }

    public function detail_tables(){}

    function lookup_values_where($table){
        
        $query_condition_array = array();

        if($this->uri->segment(4)){
            $hierarchy_id = $this->db->get_where('center_group_hierarchy',
            array('center_group_hierarchy_table_name'=>$this->uri->segment(4,'group_center')))->row()->center_group_hierarchy_id;
            
            $query_condition_array = array('fk_center_group_hierarchy_id'=>$hierarchy_id);
        }

        
        return $query_condition_array;
    }
}