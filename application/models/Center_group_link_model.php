<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Center_group_link_model extends MY_Model{

    public $table = 'center_group_link'; 
    public $dependant_table = '';
    public $name_field = 'center_group_link_name';
    public $create_date_field = "center_group_link_created_date";
    public $created_by_field = "center_group_link_created_by";
    public $last_modified_date_field = "center_group_link_last_modified_date";
    public $last_modified_by_field = "center_group_link_last_modified_by";
    public $deleted_at_field = "center_group_link_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('center','center_group');
    }

    public function detail_tables(){}
}