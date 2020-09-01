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
        return ['cheque_book_start_serial_number','cheque_book_count_of_leaves','cheque_book_use_start_date','office_bank_name'];
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    static function get_menu_list(){}
}