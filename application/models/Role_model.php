<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Role_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'role'; // you MUST mention the table name
  //public $dependant_table = "role_permission";


  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){

  }


  function list(){

  }

  function lookup_tables(){
    return array('status','approval');
  }

  function detail_tables(){
    return ['role_permission','user','page_view_role'];
  }

  function view(){

  }

  // function master_table_visible_columns(){
  //   return array('role_name');
  // }

}
