<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Status_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'status'; // you MUST mention the table name

  function __construct(){
    parent::__construct();

  }

  function index(){}

public function lookup_tables(){
  return array('approve_item');
}

public function detail_tables(){

}

public function table_visible_columns(){}

public function table_hidden_columns(){}

public function master_table_visible_columns(){}

public function master_table_hidden_columns(){}

public function list(){}

public function view(){}


}
