<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Group__model extends MY_Model{

    public $table = 'group_'; 
    public $dependant_table = '';
    public $name_field = 'group__name';
    public $create_date_field = "group__created_date";
    public $created_by_field = "group__created_by";
    public $last_modified_date_field = "group__last_modified_date";
    public $last_modified_by_field = "group__last_modified_by";
    public $deleted_at_field = "group__deleted_at";
    
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