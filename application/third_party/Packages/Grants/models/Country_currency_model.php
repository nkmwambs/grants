<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Country_currency_model extends MY_Model{

    public $table = 'country_currency'; 
    public $dependant_table = '';
    public $name_field = 'country_currency_name';
    public $create_date_field = "country_currency_created_date";
    public $created_by_field = "country_currency_created_by";
    public $last_modified_date_field = "country_currency_last_modified_date";
    public $last_modified_by_field = "country_currency_last_modified_by";
    public $deleted_at_field = "country_currency_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array();
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function lookup_values(){
        $lookup_values = $this->db->get('country_currency')->result_array();

        if(!$this->session->system_admin){
            $user_currency_code = $this->session->user_currency_code;
            $lookup_values = $this->db->get_where('country_currency',array('country_currency_code'=>$user_currency_code))->result_array();
        }
        
        return $lookup_values;
    }

    function intialize_table(Array $foreign_keys_values = []){
        
        $user_data['country_currency_id'] = 1;
        $user_data['country_currency_track_number'] = $this->grants_model->generate_item_track_number_and_name('country_currency')['country_currency_track_number'];
        $user_data['country_currency_name'] = 'USD';
        $user_data['country_currency_code'] = 'USD';
            
        $user_data_to_insert = $this->grants_model->merge_with_history_fields('country_currency',$user_data,false);
        $this->write_db->insert('country_currency',$user_data_to_insert);
      
        return $this->write_db->insert_id();
      }
}