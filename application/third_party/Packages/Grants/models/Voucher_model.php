<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Voucher_model extends MY_Model implements  TableRelationshipInterface
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
    return array('office_name','voucher_type_name','voucher_number','voucher_date','office_bank_name',
    'voucher_cheque_number','voucher_vendor','voucher_description');
  }

  // function lookup_values($table){
  //   return [
  //     'office'=>['office_id'=>1,'office_name'=>'ABC']
  //   ];
  // }

  public function list(){}

  public function view(){}

  public function list_table_visible_columns(){

    return array('voucher_track_number','voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_created_date','office_name','voucher_type_name','status_name');
  
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

  /**
   * Get Voucher Date
   * 
   * This method computes the next valid vouching date for a given office
   * @param Int $office_id - The primary key of the office
   * @return String - The next valid vouching date
   * 
   */  

  function get_voucher_date(Int $office_id):String{
    //return date('Y-m-t');
    $voucher_date = $this->db->get_where('office',array('office_id'=>$office_id))->row()->office_start_date;

    $office_transaction_date = $this->get_office_transacting_month($office_id);

    if(count($this->get_office_last_voucher($office_id)) > 0 ){
      $voucher_date = $this->get_office_last_voucher($office_id)['voucher_date'];
    }

    if(strtotime($office_transaction_date) > strtotime($voucher_date)){
      $voucher_date = $office_transaction_date;
    }

    return $voucher_date;
  }  

  /**
   * Get Voucher Number
   * 
   * The method computes the next valid voucher number. The voucher numbers are in the format YYMMSS where YY is the fiscal year and MM is the month whe transaction
   * belongs to. SS is the voucher serial number incremented from 1 (First Voucher of the month)
   *  
   * @param Int $office_id - The primary key of the office
   * @return Int - The next valid voucher number
   */
  function get_voucher_number(Int $office_id):Int{

    $next_voucher_number = "";
    
    return $this->compute_voucher_number($this->get_office_transacting_month($office_id),$this->get_voucher_next_serial_number($office_id));
  }

  /**
   * Check if Office Transaction Month Has Been Closed
   * 
   * Finds out if the date passed as an argument belongs to a month whose vouching process has been closed based on whether the financial report (Bank Reconciliation)
   * has been created and submitted. 
   * 
   * @param Int $office_id - Office primary key
   * @param String $date_of_month - Date of the month in check
   * @return Bool - True if reconciliation has been created else false
   */
  function check_if_office_transacting_month_has_been_closed(Int $office_id,String $date_of_month):Bool{
      // If the reconciliation of the max date month has been done and submitted, 
      // then use the start date of the next month as the transacting date
      // *** Modify the query by checking if it has been submitted - Not yet done ****
  
    $check_month_reconciliation = $this->db->get_where('financial_report',
      array('financial_report_is_submitted'=>1,'fk_office_id'=>$office_id,
      'financial_report_month'=>date('Y-m-01',strtotime($date_of_month))))->num_rows();

      return $check_month_reconciliation > 0 ? true : false; 

  }

  /**
   * Check if Office Has Started Transacting
   * 
   * Finds out if the argument offfice has began raising vouchers
   * 
   * @param Int $office_id - Office in check
   * @return Bool - True if has began raising vouchers else false
   */
  function check_if_office_has_started_transacting(Int $office_id):Bool{
    // If the office has not voucher yet, then the transacting month equals the office start date
    $count_of_vouchers = $this->db->get_where('voucher',array('fk_office_id'=>$office_id))->num_rows(); 

    return $count_of_vouchers > 0 ? true : false;
  }

  function office_has_vouchers_for_the_transacting_month($office_id,$transacting_month){

    $month_start_date = date('Y-m-01',strtotime($transacting_month));
    $month_end_date = date('Y-m-t',strtotime($transacting_month));

    $coucher_count_for_the_month = $this->db->get_where('voucher',
    array('fk_office_id'=>$office_id,'voucher_date>='=>$month_start_date,'voucher_date<='=>$month_end_date))->num_rows();

    $office_has_vouchers_for_the_transacting_month = false;

    if($coucher_count_for_the_month > 0){
      $office_has_vouchers_for_the_transacting_month = true;
    }

    return $office_has_vouchers_for_the_transacting_month;

  }

  /**
   * Get Office Last Voucher
   * 
   * The methods get the last voucher record for a given office
   * 
   * @param Int $office_id - Office in check
   * @return Array - a voucher record
   */
  function get_office_last_voucher($office_id):Array{

    $last_voucher = [];

    if($this->check_if_office_has_started_transacting($office_id)){
      // Check the max voucher id of the office provided
      $voucher_id = $this->db->select_max('voucher_id')->get_where('voucher',
      array('fk_office_id'=>$office_id))->row()->voucher_id;

      $last_voucher = $this->db->get_where('voucher',
      array('voucher_id'=>$voucher_id))->row_array();
    }
    

    return $last_voucher;
  }

  /**
   * get_office_transacting_month
   * 
   * This methods gives the date of the first day of the valid transaction month of an office
   * 
   * @param Int $office - Office in check
   * @return String - Date of the first day of the valid transacting month
   */
  function get_office_transacting_month(Int $office_id):String{
    
    $office_transacting_month  = date('Y-m-01');

    // If the office has not voucher yet, then the transacting month equals the office start date
    //$count_of_vouchers = $this->db->get_where('voucher',array('fk_office_id'=>$office_id))->num_rows(); 

    //If count_of_vouchers eq to 0 then get the start date if the office
    if(!$this->check_if_office_has_started_transacting($office_id)){
      $office_transacting_month = $this->db->get_where('office',array('office_id'=>$office_id))->row()->office_start_date;
    }else{

      // Get the last office voucher date
      $voucher_date = $this->get_office_last_voucher($office_id)['voucher_date'];

      // Check if the transacting month has been closed based on the last voucher date

      if($this->check_if_office_transacting_month_has_been_closed($office_id,$voucher_date)){
        $office_transacting_month = date('Y-m-d',strtotime('first day of next month',strtotime($voucher_date)));
      }else{
        $office_transacting_month = date('Y-m-01',strtotime($voucher_date));
      }
    }

    return $office_transacting_month;

  }

  /**
   * Get Voucher Next Serial Number
   * 
   * Computes the next voucher serial number i.e. The 5th + digits in a voucher number
   * 
   * @param Int $office_id - Office in Check
   * @return Int - Next voucher serial number
   */
  function get_voucher_next_serial_number(Int $office_id):Int{

    // Set default serial number to 1 unless adding to a series in a month
    $next_serial = 1; 

    // Start checking if the office has a last voucher record
    if(count((array)$this->get_office_last_voucher($office_id)) > 0){
      $last_voucher_number = $this->get_office_last_voucher($office_id)['voucher_number']; 
      $last_voucher_date = $this->get_office_last_voucher($office_id)['voucher_date']; 

      if(!$this->check_if_office_transacting_month_has_been_closed($office_id,$last_voucher_date)){
        // Get the serial number of the last voucher, replace the month and year part of the 
        // voucher number with an empty string to remain with only the voucher serial number
        //voucher format - yymmss or yymmsss
        $current_voucher_serial_number = substr_replace($last_voucher_number,'',0,4);  
        $next_serial = $current_voucher_serial_number + 1;
      }
    }

    return $next_serial;
  }

  /**
   * Compute Voucher Number
   * 
   * This method computes the next valid voucher number by concatenating the YY, MM and SS together.
   * YY - Vouching Year, MM - Vouching Month and SS - Voucher Serial Number in the month
   * 
   * @param String $vouching_month - Date the voucher is being raised
   * @param Int $next_voucher_serial - Next valid voucher serial number
   * @return Int - A Voucher number
   */
  function compute_voucher_number(String $vouching_month, Int $next_voucher_serial = 1):Int{

    $chunk_year_from_date = date('y',strtotime($vouching_month));
    $chunk_month_from_date = date('m',strtotime($vouching_month));


    if($next_voucher_serial < 10){
      $next_voucher_serial = '0'.$next_voucher_serial;
    }

    return $chunk_year_from_date.$chunk_month_from_date.$next_voucher_serial;

  }

  /**
   * Has Cheque Number Been Used
   * 
   * Validates if a given cheque number has been used by a voucher
   * 
   * @param Int $office_bank - Primary key of the associated bank to the this office
   * @param Int $cheque_number - The cheque number to check
   * @return Bool - True if cheque has been used else false
   */  
  private function has_cheque_number_been_used($office_bank, $cheque_number){
     // Check if the cheque number for the give bank has been used
   $count_of_used_cheque = $this->db->get_where('voucher',
   array('fk_office_bank_id'=>$office_bank,'voucher_cheque_number'=>$cheque_number))->num_rows();
   
   return $count_of_used_cheque > 0 ? true : false;
  }

  /**
   * Is Next Valid Cheque Number
   * 
   * Check if the passed cheque number is a next valid one. 
   * It looks whether the check is not yet used in a voucher and is 1 step incremental from the maximum used cheque for a given bank.
   * If there are no vouchers for the office, the next valid cheque number is the starting cheque leaf serial as recorded in the system for the active cheque book.
   * @param Int $office_bank - Primary key of the associated back to the office
   * @param Int $cheque_number - the cheque number is check
   * @return Bool The next valid cheque number
   */
  private function is_next_valid_cheque_number(Int $office_bank, Int $cheque_number){
    
    $valid_next_cheque_number = false;

    $active_cheque_book_obj = $this->db->select(array('cheque_book_start_serial_number',
    'cheque_book_count_of_leaves'))->get_where('cheque_book',
    array('fk_office_bank_id'=>$office_bank,'cheque_book_is_active'=>1));

    if($active_cheque_book_obj->num_rows() > 0){
      $valid_next_cheque_number = $active_cheque_book_obj->row()->cheque_book_start_serial_number;
    }

    // Max used cheque number for the bank
    $cheque_obj = $this->db->get_where('voucher',
    array('fk_office_bank_id'=>$office_bank));

    if($cheque_obj->num_rows() > 0){
      $max_used_cheque_obj = $this->db->select_max('voucher_cheque_number')->get_where('voucher',
        array('fk_office_bank_id'=>$office_bank));
      $valid_next_cheque_number = $max_used_cheque_obj->row()->voucher_cheque_number + 1;
    }

    return $valid_next_cheque_number != $cheque_number ? false : true;
  }

  /**
   * Is Cheque Leaf In Active Cheque Book
   * 
   * It determines if the a cheque number is within the active cheque book for an office
   * @param Int $office_bank - Primary key of the associated bank to the office
   * @param Int $cheque_number - Cheque number is check
   * @return Bool - True if is within else false
   */
  private function is_cheque_leaf_in_active_cheque_book(Int $office_bank,Int $cheque_number):Bool{
    
    $cheque_number_in_active_cheque_book = false;

    // Check if the provided cheque number is within the current/active cheque book
    $active_cheque_book_obj = $this->db->select(array('cheque_book_start_serial_number','cheque_book_count_of_leaves'))->get_where('cheque_book',
    array('fk_office_bank_id'=>$office_bank,'cheque_book_is_active'=>1));
 
    if($active_cheque_book_obj->num_rows() == 1){
      
      $first_leaf_serial = $active_cheque_book_obj->row()->cheque_book_start_serial_number;
      $number_of_leaves = $active_cheque_book_obj->row()->cheque_book_count_of_leaves;
      
      $list_of_cheque_leaves = range($first_leaf_serial,$number_of_leaves);
  
      if(in_array($cheque_number,$list_of_cheque_leaves)){
        $cheque_number_in_active_cheque_book = true;
    }
     
   } 

   return $cheque_number_in_active_cheque_book;

  }

  /**
   * Validate Cheque Number
   * 
   * Checks if a cheque number is valid for an office
   * A valid cheque number should be:
   * - not have been used, 
   * - Be sequential in order (If the config item allow_skipping_of_cheque_leaves is set to false)
   * - Be a present leaf in the current active cheque book
   * @param String $office_bank - Office bank id
   * @param int $cheque_number - Cheque number
   * @return Bool - True is a valid cheque number else false 
   */
  function validate_cheque_number(String $office_bank, int $cheque_number):Bool{

   $is_valid_cheque = true;

   if(
      $this->has_cheque_number_been_used($office_bank,$cheque_number)
      || (
          !$this->is_next_valid_cheque_number($office_bank,$cheque_number) 
          && !$this->config->item("allow_skipping_of_cheque_leaves")
          )
      || !$this->is_cheque_leaf_in_active_cheque_book($office_bank,$cheque_number)
      ){
      $is_valid_cheque = false;
   }

    return $is_valid_cheque;
  }

  /**
   * Populate Office Banks
   * 
   * Gives an array of the banks associated to the office
   * 
   * @param Int $office_id - Office to check
   * @return Array - An array if Office banks
   */
  function populate_office_banks(Int $office_id):Array{

    $office_banks = array();

    $office_banks_obj = $this->db->select(array('office_bank_id','office_bank_name'))->get_where('office_bank',
    array('fk_office_id'=>$office_id));

    if($office_banks_obj->num_rows() > 0){
      $office_banks = $office_banks_obj->result_array();
    }

    return $office_banks;
  }

  /**
   * Get Approveable Item Last Status
   * 
   * Gives the Last Approval Status ID of the item as the set approval workflow
   * @param Int $approveable_item_id 
   * @todo - to be transferred to the approve_item model. You will have to load the approve_item model in the voucher model class for this to work
   * @return Int - $status_id
   * 
   * @todo - Refactor it by calling the "get_max_approval_status_id" from general model
   */
  function get_approveable_item_last_status(Int $approveable_item_id):Int{
    
    $this->db->join('approval_flow','approval_flow.approval_flow_id=status.fk_approval_flow_id');
    $this->db->join('approve_item','approve_item.approve_item_id=approval_flow.fk_approve_item_id');
    $max_status_approval_sequence = $this->db->select_max('status_approval_sequence')->get_where('status',
      array('approve_item_id'=>$approveable_item_id))->row()->status_approval_sequence;

    $status_id = $this->db->select(array('status_id'))->get_where('status',
      array('status_approval_sequence'=>$max_status_approval_sequence,'fk_approve_item_id'=>$approveable_item_id))->row()->status_id;
    
    return $status_id;  
  }

  /**
   * @todo - Not in use
   */
  function conversion_approval_status($office_id):int{

    $approval_status_id = 0;

    $office_account_system_id = $this->db->get_where('office',
    array('office_id'=>$office_id))->row()->fk_account_system_id;

    $request_conversion_obj =  $this->db->get_where('request_conversion',
    array('fk_account_system_id'=>$office_account_system_id));
    
    if($request_conversion_obj->num_rows() > 0){
      $approval_status_id = $request_conversion_obj->row()->conversion_status_id;
    }

    return $approval_status_id;
  }

  /**
   * Get Approved Unvouched Request Details
   * 
   * List all the request details that have been finalised in the approval workflow
   * @return Array
   */
  function get_approved_unvouched_request_details($office_id):Array{

    // 3 is the approve_item_id for request
    //$request_last_status_id = $this->get_approveable_item_last_status(3);

    $this->db->select(array('request_detail_id','request_date','office_name',
    'request_detail_track_number','request_detail_description','request_detail_quantity',
    'request_detail_unit_cost','request_detail_total_cost','expense_account_id',
    'project_allocation_name','status_name'));
    
    $this->db->join('expense_account','expense_account.expense_account_id=request_detail.fk_expense_account_id');
    $this->db->join('project_allocation','project_allocation.project_allocation_id=request_detail.fk_project_allocation_id');
    $this->db->join('request','request.request_id=request_detail.fk_request_id'); 
    $this->db->join('status','status.status_id=request.fk_status_id');
    $this->db->join('office','office.office_id=request.fk_office_id'); 
    
    //$conversion_approval_status = $this->conversion_approval_status($office_id);

    //$this->db->where(array('request.fk_status_id'=>$conversion_approval_status,'office.office_id'=>$office_id));
    $this->db->where(array('office_id'=>$office_id,'request.fk_status_id'=>61,'request_detail.fk_status_id<>'=>63,'office.office_id'=>$office_id));

    return $this->db->get('request_detail')->result_array();
  }

  /**
   * get_office_project_allocation_for_voucher_details
   * 
   * Find the office banks associated to the office being used in the voucher form
   * @return Array
   */
  function get_office_project_allocation_for_voucher_details():Array{
    $office_project_allocation = $this->db->select(array('project_allocation_id','project_allocation_name'))->get_where('project_allocation',
    array('fk_office_id'=>$this->session->voucher_office,'project_allocation_extended_end_date >= ' => date('Y-m-d')))->result_array();

    return $office_project_allocation;
  }

  /**
   * Lookup Values
   * Options for voucher details tables select fields. Used both on header fields and detail fields
   * @return Array
   */
  function lookup_values():Array{
    return array(
      'office'=>$this->config->item('use_context_office')?$this->session->context_offices:$this->session->hierarchy_offices,
      'project_allocation'=>$this->get_office_project_allocation_for_voucher_details()
    );
  }

  function get_voucher_type_effect($voucher_type_id){
      //return (object)['voucher_type_effect_id'=>1,'voucher_type_effect_name'=>'income'];
      $this->db->select(array('voucher_type_effect_code','voucher_type_id','voucher_type_effect_id'));
      $this->db->join('voucher_type','voucher_type.fk_voucher_type_effect_id=voucher_type_effect.voucher_type_effect_id');
      return $this->db->get_where('voucher_type_effect',array('voucher_type_id'=>$voucher_type_id))->row();
  }

  function get_transaction_voucher($id){

    $this->db->join('voucher_detail','voucher_detail.fk_voucher_id=voucher.voucher_id');
    return $this->db->get_where('voucher',array('voucher_id'=>$id))->result_array();
  }

  function get_voucher_type($voucher_type_id){
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $voucher_type = $this->db->get_where('voucher_type',
    array('voucher_type_id'=>$voucher_type_id))->row();

    return $voucher_type;

  }

  function get_office_bank($office_bank_id){
    $this->db->join('bank_branch','bank_branch.bank_branch_id=office_bank.fk_bank_branch_id');
    $this->db->join('bank','bank.bank_id=bank_branch.fk_bank_id');
    $result = $this->db->get_where('office_bank',array('office_bank_id'=>$office_bank_id));

    if($result->num_rows()>0){
      return $result->row();
    }else{
      return [];
    }
  }

  function get_project_allocation($allocation_id){
    $this->db->join('project','project.project_id=project_allocation.fk_project_id');
    $result = $this->db->get_where('project_allocation',array('project_allocation_id'=>$allocation_id));
    
    if($result->num_rows()>0){
      return $result->row();
    }else{
      return [];
    }
  }

  function list_table_where(){

    $max_approval_status_id = $this->general_model->get_max_approval_status_id('voucher');
    // Only list vouchers without not yet in the cash journal 
   
    $this->db->where(array($this->controller.'.fk_status_id<>'=>$max_approval_status_id));
 
  }

  function check_if_month_vouchers_are_approved($office_id,$month){
    
    $start_month_date = date('Y-m-01',strtotime($month));
    $end_month_date = date('Y-m-t',strtotime($month));

    $this->load->model('journal_model');

    $approved_vouchers = count($this->journal_model->journal_records($office_id,$month));

    $count_of_month_raised_vouchers = $this->db->get_where('voucher',
      array('fk_office_id'=>$office_id,'voucher_date>='=>$start_month_date,
      'voucher_date<='=>$end_month_date))->num_rows();

    return  $approved_vouchers == $count_of_month_raised_vouchers ? true : false;
  }

  
}
