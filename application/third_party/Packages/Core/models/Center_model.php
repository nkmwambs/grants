<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Center_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{

  public $table = 'center'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
    $this->load->database();
  }

  function index(){}

  public function lookup_tables(){
    return array('approval','status','group_cluster');
  }

  public function detail_tables(){
    return array('center_user','budget','reconciliation','center_bank','project_allocation','request');
  }

  public function master_table_visible_columns(){
    // return array(
    //   'center_track_number','center_name','center_code','center_start_date',
    //   'center_end_date','center_is_active','group_cluster_name','approval_name','status_name'
    // );
  }

  public function master_table_hidden_columns(){}

  public function list_table_visible_columns(){}

  public function list_table_hidden_columns(){}

  public function detail_list_table_visible_columns(){}

  public function detail_list_table_hidden_columns(){}

  //public function single_form_add_visible_columns(){}

  //public function single_form_add_hidden_columns(){}

  public function master_multi_form_add_visible_columns(){}

  public function detail_multi_form_add_visible_columns(){}

  public function master_multi_form_add_hidden_columns(){}

  public function detail_multi_form_add_hidden_columns(){}

  function single_form_add_visible_columns(){
    return array('center_name','center_code','center_start_date','center_is_active','group_cluster_name');
  }

  //function detail_list_query(){}

  function master_view(){}

  public function list(){}

  public function view(){}
}
