<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Request_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'request'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
  }

  function index(){}

  public function lookup_tables(){
    return array('center','approval','status','department');
  }

  public function detail_tables(){
    return array('request_detail');
  }

  function master_multi_form_add_visible_columns(){
    return array('request_name','request_date','request_description','center_name','department_name');
  }

  function detail_list(){}

  function master_view(){}

  public function list(){}

  public function view(){}

  // Access methods

  // public function show_add_button(){
  //   return false;
  // }


}
