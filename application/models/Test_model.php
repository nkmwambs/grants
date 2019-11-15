<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Test_model extends MY_Model{

    public $table = 'test'; 
    public $dependant_table = '';
    public $name_field = 'test_name';
    public $create_date_field = "test_created_date";
    public $created_by_field = "test_created_by";
    public $last_modified_date_field = "test_last_modified_date";
    public $last_modified_by_field = "test_last_modified_by";
    public $deleted_at_field = "test_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array();
    }

    public function detail_tables(){}
}