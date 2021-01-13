<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Cheque_injection extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->library('cheque_injection_library');
    $this->load->model("cheque_book_model");
  }

  function index(){}

  function validate_cheque_number(){
    $post = $this->input->post();
    $validate_cheque_number = true;

    // Check if the injected leaf is before the first cheque book

    $min_serial_number = $this->cheque_book_model->office_bank_start_cheque_serial_number($post['office_bank_id']);

    // Check id injection leaf is already in the cheque_injection table
    $this->read_db->where(array('fk_office_bank_id'=>$post['office_bank_id'],
    'cheque_injection_number'=>$post['cheque_number']));
    $cheque_injection_count = $this->read_db->get('cheque_injection')->num_rows();

    if($cheque_injection_count > 0 || $min_serial_number <= $post['cheque_number']){
      $validate_cheque_number = false;
    }

    echo $validate_cheque_number;
  }

  static function get_menu_list(){}

}