<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Context_country_user_model extends MY_Model{

    public $table = 'context_country_user'; 
    public $dependant_table = '';
    public $name_field = 'context_country_user_name';
    public $create_date_field = "context_country_user_created_date";
    public $created_by_field = "context_country_user_created_by";
    public $last_modified_date_field = "context_country_user_last_modified_date";
    public $last_modified_by_field = "context_country_user_last_modified_by";
    public $deleted_at_field = "context_country_user_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('user','context_country','designation');
    }

    public function detail_tables(){}
}