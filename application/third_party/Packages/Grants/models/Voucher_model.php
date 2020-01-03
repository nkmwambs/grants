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
    return array('office_name','voucher_type_name','voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_description');
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
    return array('office_name','voucher_type_name','voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_description','voucher_created_date');
  }

  public function edit_visible_columns(){
    return $this->master_table_visible_columns();
  }

    /**Local methods**/

  function get_voucher_date($office_id){
    //return date('Y-m-t');
    $voucher_date = $this->db->get_where('office',array('office_id'=>$office_id))->row()->office_start_date;
    
    if(count((array)$this->get_office_last_voucher($office_id)) > 0 ){
      $voucher_date = $this->get_office_last_voucher($office_id)->voucher_date;
    }

    return $voucher_date;
  }  

  function get_voucher_number($office_id){

    $next_voucher_number = "";

    /**
     * This method returns the date of the next voucher and the next serial number which is then passed
     * to the compute voucher number method to construct the voucher number
     * 
     * Check if the office has a voucher in the voucher table, if not present, 
     * get the office starting date from office table and and compute the first voucher number for that 
     * month using the compute_voucher_number method.
     * If there is a voucher present, check if the financial report of the transaction month has been
     * submitted, if not, just get the serial number of the next voucher number in the month series
     * If the financial report has been submitted, skip to the first voucher number of the next month
     */
      //return $this->get_office_transacting_month($office_id);
      return $this->compute_voucher_number($this->get_office_transacting_month($office_id),$this->get_voucher_next_serial_number($office_id));
  }

  function check_if_office_transacting_month_has_been_closed($office_id,$date_of_month){
      // If the reconciliation of the max date month has been done and submitted, 
      // then use the start date of the next month as the transacting date
      // *** Modify the query by checking if it has been submitted - Not yet done ****
  
    $check_month_reconciliation = $this->db->get_where('reconciliation',
      array('fk_office_id'=>$office_id,
      'reconciliation_reporting_month'=>date('Y-m-t',strtotime($date_of_month))))->num_rows();

      return $check_month_reconciliation > 0 ? true : false; 

  }

  function check_if_office_has_started_transacting($office_id){
    // If the office has not voucher yet, then the transacting month equals the office start date
    $count_of_vouchers = $this->db->get_where('voucher',array('fk_office_id'=>$office_id))->num_rows(); 

    return $count_of_vouchers > 0 ? true : false;
  }

  function get_office_last_voucher($office_id){

    $last_voucher = (object)[];

    if($this->check_if_office_has_started_transacting($office_id)){
      // Check the max voucher id of the office provided
      $voucher_id = $this->db->select_max('voucher_id')->get_where('voucher',
      array('fk_office_id'=>$office_id))->row()->voucher_id;

      $last_voucher = $this->db->get_where('voucher',
      array('voucher_id'=>$voucher_id))->row();
    }
    

    return $last_voucher;
  }

  /**
   * get_office_transacting_month
   */
  function get_office_transacting_month($office_id){
    
    $office_transacting_month  = date('Y-m-01');

    // If the office has not voucher yet, then the transacting month equals the office start date
    $count_of_vouchers = $this->db->get_where('voucher',array('fk_office_id'=>$office_id))->num_rows(); 

    //If count_of_vouchers eq to 0 then get the start date if the office
    if(!$this->check_if_office_has_started_transacting($office_id)){
      $office_transacting_month = $this->db->get_where('office',array('office_id'=>$office_id))->row()->office_start_date;
    }else{

      // Get the last office voucher date
      $voucher_date = $this->get_office_last_voucher($office_id)->voucher_date;

      // Check if the transacting month has been closed based on the last voucher date

      if($this->check_if_office_transacting_month_has_been_closed($office_id,$voucher_date)){
        $office_transacting_month = date('Y-m-d',strtotime('first day of next month',strtotime($voucher_date)));
      }else{
        $office_transacting_month = date('Y-m-01',strtotime($voucher_date));
      }
    }

    return $office_transacting_month;

  }

  function get_voucher_next_serial_number($office_id){

    // Set default serial number to 1 unless adding to a series in a month
    $next_serial = 1; 

    // Start checking if the office has a last voucher record
    if(count((array)$this->get_office_last_voucher($office_id)) > 0){
      $last_voucher_number = $this->get_office_last_voucher($office_id)->voucher_number; 
      $last_voucher_date = $this->get_office_last_voucher($office_id)->voucher_date; 

      if(!$this->check_if_office_transacting_month_has_been_closed($office_id,$last_voucher_date)){
        // Get the serial number of the last voucher, replace the month and year part of the 
        // voucher number with an empty string to remain with only the voucher serial number
        $current_voucher_serial_number = substr_replace($last_voucher_number,'',0,4);  
        $next_serial = $current_voucher_serial_number + 1;
      }
    }

    return $next_serial;
  }

  function compute_voucher_number($vouching_month, $next_voucher_serial = 1){

    $chunk_year_from_date = date('y',strtotime($vouching_month));
    $chunk_month_from_date = date('m',strtotime($vouching_month));


    if($next_voucher_serial < 10){
      $next_voucher_serial = '0'.$next_voucher_serial;
    }

    return $chunk_year_from_date.$chunk_month_from_date.$next_voucher_serial;

  }

  function get_approved_unvouched_request_details(){

    $this->db->select(array('request_detail_id','request_date','office_name',
    'request_detail_track_number','request_detail_description','request_detail_quantity',
    'request_detail_unit_cost','request_detail_total_cost','expense_account_name',
    'project_allocation_name','status_name'));
    
    $this->db->join('expense_account','expense_account.expense_account_id=request_detail.fk_expense_account_id');
    $this->db->join('project_allocation','project_allocation.project_allocation_id=request_detail.fk_project_allocation_id');
    $this->db->join('request','request.request_id=request_detail.fk_request_id'); 
    $this->db->join('status','status.status_id=request.fk_status_id');
    $this->db->join('office','office.office_id=request.fk_office_id'); 
    
    $this->db->where(array('request.fk_status_id'=>20,'office_id'=>9));
      
    return $this->db->get('request_detail')->result_array();
  }
  
}
