<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Workflow_model extends MY_Model{

    public $table = 'Workflow'; 
    public $dependant_table = '';
    public $name_field = 'Workflow_name';
    public $create_date_field = "Workflow_created_date";
    public $created_by_field = "Workflow_created_by";
    public $last_modified_date_field = "Workflow_last_modified_date";
    public $last_modified_by_field = "Workflow_last_modified_by";
    public $deleted_at_field = "Workflow_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('approve_item');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    public function list_table_visible_columns(){
        return ['workflow_track_number','approve_item_name','workflow_is_active','workflow_created_date'];
    }
}