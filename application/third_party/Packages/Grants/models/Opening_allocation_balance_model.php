<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Opening_allocation_balance_model extends MY_Model{

    public $table = 'opening_allocation_balance'; 
    public $dependant_table = '';
    public $name_field = 'opening_allocation_balance_name';
    public $create_date_field = "opening_allocation_balance_created_date";
    public $created_by_field = "opening_allocation_balance_created_by";
    public $last_modified_date_field = "opening_allocation_balance_last_modified_date";
    public $last_modified_by_field = "opening_allocation_balance_last_modified_by";
    public $deleted_at_field = "opening_allocation_balance_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array(
            'project_allocation',
            'system_opening_balance',
        );
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function detail_list_table_visible_columns(){
        return ['opening_allocation_balance_track_number','opening_allocation_balance_name','project_allocation_name','opening_allocation_balance_amount'];
    }

    function opening_allocation_balance_project_allocation_id(){
        //echo hash_id($this->id,'decode');exit;
        $this->db->select(array('fk_project_allocation_id'));
        $result = $this->db->get_where('opening_allocation_balance',
        array('opening_allocation_balance_id'=>hash_id($this->id,'decode')))->row()->fk_project_allocation_id;

        return $result;
    }

    function lookup_values_where($table = ''){
        return [
                 'project_allocation'=>['project_allocation_id'=>$this->opening_allocation_balance_project_allocation_id()]
               ];
      }

     function lookup_values(){
         $lookup_values = [];
         
         if($this->id !== null){
           
            $lookup_values['system_opening_balance'] = $this->read_db->get_where('system_opening_balance',
            array('system_opening_balance_id'=>hash_id($this->id,'decode')))->result_array();

            $lookup_values['project_allocation'] = $this->read_db->get_where('project_allocation',
            array('fk_office_id'=>$lookup_values['system_opening_balance'][0]['fk_office_id']))->result_array();

            return $lookup_values;
         }
         
     } 
}