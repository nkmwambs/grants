<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Contra_account_model extends MY_Model{

    public $table = 'Contra_account'; 
    public $dependant_table = '';
    public $name_field = 'Contra_account_name';
    public $create_date_field = "Contra_account_created_date";
    public $created_by_field = "Contra_account_created_by";
    public $last_modified_date_field = "Contra_account_last_modified_date";
    public $last_modified_by_field = "Contra_account_last_modified_by";
    public $deleted_at_field = "Contra_account_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('account_system');
    }

    public function detail_tables(){
        return ['bank_contra_account','cash_contra_account'];
    }

    public function detail_multi_form_add_visible_columns(){}
}