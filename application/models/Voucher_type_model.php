<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Voucher_type_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'voucher_type'; // you MUST mention the table name
  public $name_field = "voucher_type_name";
  //public $primary_key = "voucher_detail_id";

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){}

  public function lookup_tables(){
    return array('voucher');
  }

  public function detail_tables(){}

  public function list(){}

  public function view(){}

  
}
