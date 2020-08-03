<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Budget_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'budget'; // you MUST mention the table name
  public $dependant_table = '';

  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

  public function lookup_tables(){
    return array('office');
  }

  public function detail_tables(){
    return array('budget_item');
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
    return array('budget_name','budget_year','office_name');
  }

  public function detail_multi_form_add_visible_columns(){

  }

  public function master_multi_form_add_hidden_columns(){}

  public function detail_multi_form_add_hidden_columns(){}

  public function single_form_add_visible_columns(){
    return array('budget_name','budget_year','office_name');
  }

  public function single_form_add_hidden_columns(){}

  function detail_list(){}

  function master_view(){}

  public function list(){}

  public function view(){}

  function list_table_where(){
    //print_r($this->session->hierarchy_offices); exit();
    // Only list requests from the users' hierachy offices
    $this->db->where_in($this->controller.'.fk_office_id',array_column($this->session->hierarchy_offices,'office_id'));
  }

}
