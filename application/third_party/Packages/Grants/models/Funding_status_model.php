<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Funding_status_model extends MY_Model{

    public $table = 'funding_status'; 
    public $dependant_table = '';
    public $name_field = 'funding_status_name';
    public $create_date_field = "funding_status_created_date";
    public $created_by_field = "funding_status_created_by";
    public $last_modified_date_field = "funding_status_last_modified_date";
    public $last_modified_by_field = "funding_status_last_modified_by";
    public $deleted_at_field = "funding_status_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        //return array('status','approval');
    }

    public function detail_tables(){}

    function single_form_add_visible_columns(){
        //return ['funding_status_name','funding_status_is_active'];
    }

    // function show_add_button(){
    //     return false;
    // }
}