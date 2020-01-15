<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Journal_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }

  function index(){

  }

  function journal_records($office_id){
    return $this->CI->journal_model->journal_records($office_id);
  }

  function month_opening_bank_balance($office_id){
    return $this->CI->journal_model->month_opening_bank_balance($office_id);
  }

  function month_opening_cash_balance($office_id){
    return $this->CI->journal_model->month_opening_cash_balance($office_id);
  }

  function get_office_data_from_journal(){
    return $this->CI->journal_model->get_office_data_from_journal();
  }  
}
