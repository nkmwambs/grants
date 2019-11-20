<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Month_model extends MY_Model{

    public $table = 'month'; 
    public $dependant_table = '';
    public $name_field = 'month_name';
    public $create_date_field = "month_created_date";
    public $created_by_field = "month_created_by";
    public $last_modified_date_field = "month_last_modified_date";
    public $last_modified_by_field = "month_last_modified_by";
    public $deleted_at_field = "month_deleted_at";
    
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