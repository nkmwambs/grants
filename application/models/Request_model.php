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
  public $dependant_table = "request_detail";

  function __construct(){
    parent::__construct();
  }

  function index(){}

  public function lookup_tables(){
    return array('approval','status','department','request_type','center');
  }

  public function detail_tables(){
    return array('request_detail');
  }

  function master_multi_form_add_visible_columns(){
    return array('request_name','request_date','request_type_name','request_description','center_name','department_name');
  }

  function detail_list(){}

  function master_view(){}

  function list_table_visible_columns(){
    return array('request_id','request_track_number','request_name','request_type_name','request_description',
    'request_date','request_created_date','center_name','department_name',
    'approval_name','status_name');
  }

  public function list(){
      
    $this->grants->where_condition('centers');
    
    $this->grants->where_condition('page_view','request');

    $this->grants->create_table_join_statement($this->controller, $this->lookup_tables());

    return $this->db->get('request')->result_array();
  }

  public function view(){}


}
