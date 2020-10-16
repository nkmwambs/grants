<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Budget_item_model extends MY_Model 
{
  public $table = 'budget_item'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
  }
  
  function delete($id = null){

  }


  function index(){}

  public function lookup_tables(){
    return array('budget','expense_account','status','approval');
  }

  public function show_add_button(){
    return false;
}

  public function detail_tables(){
    return array('budget_item_detail');
  }

  public function master_table_visible_columns(){}

  public function master_table_hidden_columns(){}

  public function list_table_visible_columns(){}

  public function list_table_hidden_columns(){}

  public function detail_list_table_visible_columns(){}

  public function detail_list_table_hidden_columns(){}

  //public function single_form_add_visible_columns(){}

  //public function single_form_add_hidden_columns(){}

  public function master_multi_form_add_visible_columns(){
    return array('budget_item_description','budget_item_total_cost','expense_account_name','project_allocation_name');
  }

  public function detail_multi_form_add_visible_columns(){}

  public function master_multi_form_add_hidden_columns(){}

  public function detail_multi_form_add_hidden_columns(){}

  function detail_list(){}

  function master_view(){}

  public function list(){}

  public function view(){}

}
