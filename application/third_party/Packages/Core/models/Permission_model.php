<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Permission_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'permission'; // you MUST mention the table name


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
    return array('menu','permission_label');
  }

  function detail_multi_form_add_visible_columns(){
    
  }

  function detail_tables(){
    return array('role_permission');
  }

  function view(){

  }

}
