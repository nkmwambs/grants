<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Context_region_model extends MY_Model{

    public $table = 'context_region'; 
    public $dependant_table = '';
    public $name_field = 'context_region_name';
    public $create_date_field = "context_region_created_date";
    public $created_by_field = "context_region_created_by";
    public $last_modified_date_field = "context_region_last_modified_date";
    public $last_modified_by_field = "context_region_last_modified_by";
    public $deleted_at_field = "context_region_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('context_global','office','context_definition');
    }

    public function detail_tables(){
        return array('context_region_user','context_country');
    }
}