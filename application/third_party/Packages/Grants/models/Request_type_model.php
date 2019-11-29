<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Request_type_model extends MY_Model{

    public $table = 'request_type'; 
    public $dependant_table = 'request_detail';
    public $name_field = 'request_type_name';
    public $create_date_field = "request_type_created_date";
    public $created_by_field = "request_type_created_by";
    public $last_modified_date_field = "request_type_last_modified_date";
    public $last_modified_by_field = "request_type_last_modified_by";
    public $deleted_at_field = "request_type_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array();
    }

    public function detail_tables(){
        return array('request');
    }

    public function detail_multi_form_add_visible_columns(){}
}