<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Cheque_book_model extends MY_Model{

    public $table = 'Cheque_book'; 
    public $dependant_table = '';
    public $name_field = 'Cheque_book_name';
    public $create_date_field = "Cheque_book_created_date";
    public $created_by_field = "Cheque_book_created_by";
    public $last_modified_date_field = "Cheque_book_last_modified_date";
    public $last_modified_by_field = "Cheque_book_last_modified_by";
    public $deleted_at_field = "Cheque_book_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('office_bank');
    }

    function single_form_add_visible_columns(){
        return ['cheque_book_start_serial_number','cheque_book_count_of_leaves','cheque_book_use_start_date','cheque_book_is_active','office_bank_name'];
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function transaction_validate_duplicates_columns(){
        return ['fk_office_bank_id','cheque_book_is_active'];
    }

    // function transaction_validate_by_computation_flag($insert_array){
    //     // Get last cheque book record
    //     $last_cheque_book_obj = $this->db->order_by('cheque_book_id',"desc")->
    //     get_where('cheque_book',array('fk_office_bank_id'=>$insert_array['fk_office_bank_id']));

    //     if($last_cheque_book_obj->num_rows() > 0){
    //         $last_cheque_book_start_serial_number = $last_cheque_book_obj->row()->cheque_book_start_serial_number;
    //         $last_cheque_book_count_of_leaves = $last_cheque_book_obj->row()->cheque_book_count_of_leaves;
            
    //         $next_cheque_book_start_serial = $last_cheque_book_start_serial_number + $last_cheque_book_count_of_leaves;

    //         if($insert_array['cheque_book_start_serial_number'] < $next_cheque_book_start_serial){
    //             return 'VALIDATION_ERROR';
    //         }
    //     }
    // }
}