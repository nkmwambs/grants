<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Income_account_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'income_account'; // you MUST mention the table name
  public $primary_key = 'income_account_id'; // you MUST mention the primary key


  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function delete($id = null){

  }
  
  function index(){

  }

  function lookup_tables(){
    return ['account_system'];
  }

  function detail_tables(){
    return ['expense_account','project_income_account'];
  }

  function list(){

  }

  function view(){

  }

  // function lookup_values_where($table = ''){
  //   return array('income_account_is_donor_funded'=>1);
  // }

}
