<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Role_permission_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'role_permission'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){

  }


  function list(){

  }

  function lookup_tables(){

  }

  function detail_tables(){

  }

  function view(){

  }
  
}
