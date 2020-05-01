<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Project_allocation_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'project_allocation'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

  public function lookup_tables(){
    return array('office','project','income_account');
  }

  public function detach_detail_table(){
    return true;
  }

  public function detail_tables(){
    return ['project_allocation_detail'];
  }
    public function master_table_visible_columns(){}

    public function master_table_hidden_columns(){}

    public function list_table_visible_columns(){}

    public function list_table_hidden_columns(){}

    public function detail_list_table_visible_columns(){}

    public function detail_list_table_hidden_columns(){}

    public function single_form_add_visible_columns(){
      return array('project_allocation_name','project_allocation_is_active','project_allocation_amount','office_name','project_name','income_account_name');
    }

    public function edit_visible_columns(){
     // return array('project_allocation_name','project_allocation_is_active','project_allocation_amount','project_allocation_extended_end_date','office_name','project_name');
    }

    public function single_form_add_hidden_columns(){}

    public function master_multi_form_add_visible_columns(){
     
    }

    public function detail_multi_form_add_visible_columns(){}

    public function master_multi_form_add_hidden_columns(){}

    public function detail_multi_form_add_hidden_columns(){}

    function detail_list(){}

    function master_view(){}

    public function list(){}

    public function view(){}

    // function voucher_project_allocation(){
    //   return $this->db->get('project_allocation')->result_object();
    // }

}
