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


  function __construct(){
    parent::__construct();
  }

  function index(){}

  public function lookup_tables(){
    return array('office','bank');
  }

  public function detail_tables(){}

    public function master_table_visible_columns(){}

    public function master_table_hidden_columns(){}

    public function list_table_visible_columns(){}

    public function list_table_hidden_columns(){}

    public function detail_list_table_visible_columns(){}

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
