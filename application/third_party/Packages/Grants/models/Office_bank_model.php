<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Office_bank_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'office_bank'; // you MUST mention the table name
  //public $dependant_table = '';
  public $name_field = 'office_bank_name';
  public $create_date_field = "office_bank_created_date";
  public $created_by_field = "office_bank_created_by";
  public $last_modified_date_field = "office_bank_last_modified_date";
  public $last_modified_by_field = "office_bank_last_modified_by";
  public $deleted_at_field = "office_bank_deleted_at";


  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

  public function lookup_tables(){
    return array('office','bank','status','approval');
  }

  public function detail_tables(){
    return ['cheque_book','office_bank_project_allocation'];
  }

    public function master_table_visible_columns(){}

    public function master_table_hidden_columns(){}

    public function list_table_visible_columns(){}

    public function list_table_hidden_columns(){}

    public function detail_list_table_visible_columns(){
      return ['office_bank_track_number','office_bank_name',
      'office_bank_account_number','office_name','bank_name','status_name','approval_name'];
    }

    public function detail_list_table_hidden_columns(){}

    public function single_form_add_visible_columns(){}

    public function single_form_add_hidden_columns(){}

    public function multi_form_add_visible_columns(){}

    public function multi_form_add_hidden_columns(){}

    function detail_list(){}

    function master_view(){}

    public function list(){}

    public function view(){}

}
