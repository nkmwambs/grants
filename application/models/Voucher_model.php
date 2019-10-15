<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Voucher_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'voucher'; // you MUST mention the table name
  public $primary_key = 'voucher_id'; // you MUST mention the primary key
  public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
  public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){}

  public function lookup_tables(){
    return array('center','voucher_type');
  }

  public function detail_tables(){
    return array('voucher_detail');
  }

  public function master_table_visible_columns(){}

  public function master_table_hidden_columns(){}

  public function list_table_visible_columns(){
    return array('voucher_track_number','voucher_number','voucher_date','voucher_cheque_number','center_name');
  }

  public function list_table_hidden_columns(){}

  public function detail_list_table_visible_columns(){}

  public function detail_list_table_hidden_columns(){}

  public function single_form_add_visible_columns(){}

  public function single_form_add_hidden_columns(){}

  public function master_multi_form_add_visible_columns(){
    return array('center_name','voucher_number','voucher_date','voucher_type_name','voucher_cheque_number','voucher_vendor','voucher_description');
  }

  public function detail_multi_form_add_visible_columns(){}

  public function master_multi_form_add_hidden_columns(){}

  public function detail_multi_form_add_hidden_columns(){}

  function detail_list(){}

  function master_view(){}

  public function list(){}

  public function view(){}

}
