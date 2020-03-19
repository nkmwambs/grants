<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Financial_report_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();

  }

  function index(){}

  function financial_report_information($report_id){
    return $this->CI->financial_report_model->financial_report_information($report_id);
  }

  function month_income_account_receipts($office_id, $start_date_of_month){
    return $this->CI->financial_report_model->month_income_account_receipts($office_id, $start_date_of_month);
  }

  function month_income_account_expenses($office_id, $start_date_of_month){
    return $this->CI->financial_report_model->month_income_account_expenses($office_id, $start_date_of_month);
  }

  function month_income_opening_balance($office_id, $start_date_of_month){
    return $this->CI->financial_report_model->month_income_opening_balance($office_id, $start_date_of_month);
  }

  function income_accounts(){
    return $this->CI->financial_report_model->income_accounts();
  }

  function page_position(){

    //$widget['position_1'][] = Widget_base::load('button','Show Combined Report',base_url().'financial_report/view/');

    //return $widget;
  }

} 