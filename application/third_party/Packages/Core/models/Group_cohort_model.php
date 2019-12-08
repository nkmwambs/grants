<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Group_cohort_model extends MY_Model{

    public $table = 'group_cohort'; 
    public $dependant_table = '';
    public $name_field = 'group_cohort_name';
    public $create_date_field = "group_cohort_created_date";
    public $created_by_field = "group_cohort_created_by";
    public $last_modified_date_field = "group_cohort_last_modified_date";
    public $last_modified_by_field = "group_cohort_last_modified_by";
    public $deleted_at_field = "group_cohort_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('group_country','approval','status');
    }

    public function detail_tables(){
        return array('group_cohort_user','group_cluster','group_cohort_unit');
    }
}