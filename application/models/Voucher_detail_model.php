<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Voucher_detail_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'voucher_detail'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){}

  public function lookup_tables(){
    return array('voucher');
  }

  public function detail_tables(){}

  public function table_visible_columns(){
    return array('voucher_detail_description','voucher_detail_quantity',
    'voucher_detail_unit_cost','voucher_detail_total_cost','voucher_detail_account','project_allocation_name');
  }

  public function table_hidden_columns(){}

  public function master_table_visible_columns(){}

  public function master_table_hidden_columns(){}

  public function list(){}

  public function view(){}

}
