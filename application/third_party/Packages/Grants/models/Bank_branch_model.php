<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Bank_branch_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'bank_branch'; // you MUST mention the table name
  public $primary_key = 'bank_branch_id'; // you MUST mention the primary key


  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){

  }

  function lookup_tables(){
    return ['bank'];
  }

  function detail_tables(){
    return ['office_bank'];
  }

  function list(){

  }

  function view(){

  }

 
}
