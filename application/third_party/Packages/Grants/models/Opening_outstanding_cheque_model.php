<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Opening_outstanding_cheque_model extends MY_Model{

    public $table = 'opening_outstanding_cheque'; 
    public $dependant_table = '';
    public $name_field = 'opening_outstanding_cheque_name';
    public $create_date_field = "opening_outstanding_cheque_created_date";
    public $created_by_field = "opening_outstanding_cheque_created_by";
    public $last_modified_date_field = "opening_outstanding_cheque_last_modified_date";
    public $last_modified_by_field = "opening_outstanding_cheque_last_modified_by";
    public $deleted_at_field = "opening_outstanding_cheque_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('system_opening_balance','office_bank');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}
}