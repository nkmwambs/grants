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
  public $dependant_table = '';
  public $name_field = 'status_name';
  public $create_date_field = "status_created_date";
  public $created_by_field = "status_created_by";
  public $last_modified_date_field = "status_last_modified_date";
  public $last_modified_by_field = "status_last_modified_by";
  public $deleted_at_field = "status_deleted_at";

  function __construct(){
    parent::__construct();

  }

  function delete($id = null){

  }

  function index(){}

public function lookup_tables(){
  return array('role','approval_flow');
}

public function detail_tables(){
  return ['status_role'];
}

public function table_visible_columns(){}

public function table_hidden_columns(){}

public function master_table_visible_columns(){}

public function master_table_hidden_columns(){}

public function list(){}

public function view(){}

public function single_form_add_visible_columns(){
  return ['status_name','approval_flow_name','status_approval_sequence','status_approval_direction','status_backflow_sequence','status_is_requiring_approver_action','role_name'];
}


}
