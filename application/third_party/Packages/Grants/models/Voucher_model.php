<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Voucher_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'voucher'; // you MUST mention the table name
  //public $primary_key = 'voucher_id'; // you MUST mention the primary key
  public $dependant_table = 'voucher_detail';
  public $name_field = 'voucher_name';
  public $create_date_field = "voucher_created_date";
  public $created_by_field = "voucher_created_by";
  public $last_modified_date_field = "voucher_last_modified_date";
  public $last_modified_by_field = "voucher_last_modified_by";
  public $deleted_at_field = "voucher_deleted_at";

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){}

  public function lookup_tables(){
    return array('voucher_type','office','approval','status');
  }

  public function detail_tables(){
    return array('voucher_detail');
  }

  /**
   * @todo not yet used
   */
  public function detail_table_relationships(){
    $relationship['voucher_detail']['foreign_key'] = 'fk_voucher_id';

    return $relationship;
  }


  function detail_list(){}

  function master_multi_form_add_visible_columns(){
    return array('voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_description','office_name','voucher_type_name');
  }

  public function list(){}

  public function view(){}

  public function list_table_visible_columns(){

    return array('voucher_track_number','voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_created_date','office_name','voucher_type_name');
  
  }

  public function detail_list_table_visible_columns(){
    return array('voucher_detail_track_number','voucher_detail_description','voucher_detail_quantity',
    'voucher_detail_cost','voucher_detail_total_cost','expense_account_name','income_account_name');
  }

  public function master_table_visible_columns(){
    return array('voucher_track_number','voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_description','office_name','voucher_type_name','voucher_created_date');
  }

  public function edit_visible_columns(){
    return $this->master_table_visible_columns();
  }

    /**Local methods**/
  function highest_voucher_number($center_id){

    // Get max voucher number for center
    return $this->db->select_max("voucher_number")->get_where('voucher',
    array('fk_office_id'=>$center_id))->row()->voucher_number;
  }


  function get_approved_unvouched_request_details(){

    $this->db->select(array('request_detail_id','request_date','office_name',
    'request_detail_track_number','request_detail_description','request_detail_quantity',
    'request_detail_unit_cost','request_detail_total_cost','expense_account_name',
    'project_allocation_name','status_name'));
    
    $this->db->join('expense_account','expense_account.expense_account_id=request_detail.fk_expense_account_id');
    $this->db->join('project_allocation','project_allocation.project_allocation_id=request_detail.fk_project_allocation_id');
    $this->db->join('status','status.status_id=request_detail.fk_status_id');
    $this->db->join('request','request.request_id=request_detail.fk_request_id');    
    $this->db->join('office','office.office_id=request.fk_office_id'); 
    
    $this->db->where(array('request.fk_status_id'=>20));
      
    return $this->db->get('request_detail')->result_array();
  }
  
}
