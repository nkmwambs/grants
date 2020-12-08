<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Permission_template_model extends MY_Model{

    public $table = 'permission_template'; 
    public $dependant_table = '';
    public $name_field = 'permission_template_name';
    public $create_date_field = "permission_template_created_date";
    public $created_by_field = "permission_template_created_by";
    public $last_modified_date_field = "permission_template_last_modified_date";
    public $last_modified_by_field = "permission_template_last_modified_by";
    public $deleted_at_field = "permission_template_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('role_group','permission');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    public function single_form_add_visible_columns()
    {
        return ['role_group_name','permission_name'];
    }

    public function detail_list_table_visible_columns()
    {
        return ['permission_template_track_number',
        'role_group_name','permission_name',
        'permission_template_created_date',
        'permission_template_last_modified_date'];
    }

    function multi_select_field(){
        return 'permission';
    }
}