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

    public function past_months_in_fy($month_id){

        $past_months_in_fy = [];

        $this->read_db->where(array('month_id'=>$month_id));
        $month_order = $this->read_db->get('month')->row()->month_order;

        $past_month_order = range(1,$month_order - 1);
        
        $this->read_db->select(array('month_id'));
        $this->read_db->where_in('month_order',$past_month_order);
        $past_months_in_fy_obj = $this->read_db->get('month');

        if($past_months_in_fy_obj->num_rows() > 0){
            $past_months_in_fy = array_column($past_months_in_fy_obj->result_array(),'month_id');
        }

        return $past_months_in_fy;
    }


    function intialize_table(Array $foreign_keys_values = []){

        $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        
        $insert_ids = [];

        foreach($months as $month_order => $month_name){
            
            $month_order += 1;

            $months_data['month_track_number'] = $this->grants_model->generate_item_track_number_and_name('month')['month_track_number'];
            $months_data['month_name'] = $month_name;
            $months_data['month_number'] = $month_order;
            $months_data['month_order'] = $month_order; 
                
            $months_data_to_insert = $this->grants_model->merge_with_history_fields('month',$months_data,false);
            $this->write_db->insert('month',$months_data_to_insert);

            $insert_ids[] = $this->write_db->insert_id();
        }
        
    
        return $insert_ids;
    }
}