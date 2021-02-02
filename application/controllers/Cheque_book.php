<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Cheque_book extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->library('Cheque_book_library');
  }

  function index(){}

  function validate_start_serial_number(){
    
    $post = $this->input->post();
    $validate_start_serial_number = 0;

    $last_cheque_serial_number = $this->cheque_book_model->office_bank_last_cheque_serial_number($post['office_bank_id']);

    $next_new_cheque_book_start_serial = $last_cheque_serial_number + 1;

    if(($next_new_cheque_book_start_serial != $post['start_serial_number']) && $last_cheque_serial_number > 0){
      $validate_start_serial_number = $next_new_cheque_book_start_serial;
    }

    echo $validate_start_serial_number;
  }

  function new_cheque_book_start_serial(){

    $post = $this->input->post();

    $office_bank_id = $post['office_bank_id'];

    $last_cheque_serial_number = $this->cheque_book_model->office_bank_last_cheque_serial_number($office_bank_id);
    
    $next_new_cheque_book_start_serial = 0;

    if($last_cheque_serial_number > 0){
      $next_new_cheque_book_start_serial = $last_cheque_serial_number + 1;
    }
    
    echo $next_new_cheque_book_start_serial;
  }

  static function get_menu_list(){}

}