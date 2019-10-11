<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Budget_detail_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'budget_detail'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
  }

  function index(){}

  public function lookup_tables(){
    return array('budget','expense_account','approval_status');
  }

  public function detail_tables(){
    return array('budget_month_spread');
  }

  public function table_visible_columns(){}

  public function table_hidden_columns(){}

  public function master_table_visible_columns(){}

  public function master_table_hidden_columns(){}

  public function list(){}

  public function view(){}

}
