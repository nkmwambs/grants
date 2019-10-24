<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Request_detail_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'request_detail'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
  }

  function index(){}

  public function lookup_tables(){
    return array('request','status','expense_account','project_allocation');
  }

  public function detail_tables(){}

    public function master_table_visible_columns(){}

    public function master_table_hidden_columns(){}

    public function list_table_visible_columns(){}

    public function list_table_hidden_columns(){}

    public function detail_list_table_visible_columns(){
      return array('request_detail_track_number','request_detail_description',
      'request_detail_quantity','request_detail_unit_cost','request_detail_total_cost',
      'expense_account_name','project_allocation_name','status_name');
    }

    public function detail_list_table_hidden_columns(){}

    public function single_form_add_visible_columns(){
      return array('request_detail_description','request_detail_quantity','request_detail_unit_cost',
      'request_detail_total_cost','expense_account_name','project_allocation_name');
    }

    public function single_form_add_hidden_columns(){}

    public function master_multi_form_add_visible_columns(){}

    public function detail_multi_form_add_visible_columns(){
      return array('request_detail_description','request_detail_quantity','request_detail_unit_cost',
      'request_detail_total_cost','expense_account_name','project_allocation_name');
    }

    public function master_multi_form_add_hidden_columns(){}

    public function detail_multi_form_add_hidden_columns(){}

    function detail_list(){}

    function master_view(){}

    public function list(){}

    public function view(){}

    // Access Action
    public function show_add_button(){
        return false;
    }

}
