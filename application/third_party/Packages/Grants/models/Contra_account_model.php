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
        return array('account_system','voucher_type_account','office_bank');
    }

    public function detail_tables(){

    }

    function lookup_values(){

        // $lookup_values['office_bank'] = $this->read_db->get('office_bank')->result_array(); 

        // if(!$this->session->system_admin){

        //     $this->read_db->join('bank','bank.bank_id=office_bank.fk_bank_id');
        //     $this->read_db->join('account_system','account_system.account_system_id=bank.fk_account_system_id');
        //     $lookup_values['office_bank'] = $this->read_db->get_where('office_bank',array('account_system_code'=>$this->session->user_account_system))->result_array();
        // }
  
        // return $lookup_values;
      }
  
    public function single_form_add_visible_columns(){
        //return ['contra_account_name','contra_account_code','contra_account_description','account_system_name','voucher_type_account_name','office_bank_name'];
    }

    public function detail_multi_form_add_visible_columns(){}

}