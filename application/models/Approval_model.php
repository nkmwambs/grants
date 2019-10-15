<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Approval_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'approval'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
  }

  function index(){}

  function lookup_tables(){
    return array('status');
  }

  function detail_tables(){
    return array('request');
  }

  //This method overrides the My_Model table_hidden_columns
  function table_hidden_columns(){}

  function table_visible_columns(){}

  function master_table_visible_columns(){}

//Not working yet. Should allow hidding columns by default from the My Model method or overide it here
  function master_table_hidden_columns(){}

  function list(){}

  function view(){}

  function add(){

  }

  function edit(){
    
  }

}
