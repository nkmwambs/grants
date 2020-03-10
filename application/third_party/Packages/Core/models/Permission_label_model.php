<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Permission_label_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'permission_label'; // you MUST mention the table name
  //public $dependant_table = "permission";


  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function delete($id = null){

  }
  
  function index(){

  }


  function list(){

  }

  function lookup_tables(){
    
  }

  function detail_tables(){
    return array('permission');
  }

  function view(){

  }

  function show_add_button(){
    return false;
  }

}
