<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Expense_account_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'expense_account'; // you MUST mention the table name
  public $primary_key = 'expense_account_id'; // you MUST mention the primary key


  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function delete($id = null){

  }

  function index(){

  }

  function lookup_tables(){
    return list_lookup_tables('expense_account');
  }

  function detail_tables(){
    
  }

  function list(){

  }

  function view(){

  }

 
}
