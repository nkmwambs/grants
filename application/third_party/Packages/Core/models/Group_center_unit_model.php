<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Group_center_unit_model extends MY_Model{

    public $table = 'Group_center_unit'; 
    public $dependant_table = '';
    public $name_field = 'Group_center_unit_name';
    public $create_date_field = "Group_center_unit_created_date";
    public $created_by_field = "Group_center_unit_created_by";
    public $last_modified_date_field = "Group_center_unit_last_modified_date";
    public $last_modified_by_field = "Group_center_unit_last_modified_by";
    public $deleted_at_field = "Group_center_unit_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('center');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function show_add_button(){
        $show_add_button = true;
        //Check if there is any unit for a particular group center
        $count_units = $this->db->get_where('group_center_unit',array('fk_group_center_id'=>hash_id($this->id,'decode')))->num_rows();
        
        if($count_units > 0){
            $show_add_button = false;
        }

        return $show_add_button;
    }

    function action_before_insert($post_array){

        $count_units = $this->db->get_where('group_center_unit',array('fk_group_center_id'=>hash_id($this->id,'decode')))->num_rows();
        
        if($count_units > 0){
            //return "You can have duplicate records";
            //redirect(base_url() .$this->controller.'/view/'.$this->id, 'refresh');
            exit();
        }else{
            return $post_array;
        }

    }
}