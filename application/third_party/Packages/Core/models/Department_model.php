<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Department_model extends MY_Model{

    public $table = 'department'; 
    public $dependant_table = '';
    public $name_field = 'department_name';
    public $create_date_field = "department_created_date";
    public $created_by_field = "department_created_by";
    public $last_modified_date_field = "department_last_modified_date";
    public $last_modified_by_field = "department_last_modified_by";
    public $deleted_at_field = "department_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('approval','status');
    }

    public function detail_tables(){
        return array('department_user');
    }

    
}