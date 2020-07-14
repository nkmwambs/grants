<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Voucher extends MY_Controller
{

  function __construct(){
    parent::__construct();

    $this->load->model('voucher_type_model');
    $this->load->model('approval_model');
    $this->load->model('voucher_model');
    $this->load->library('voucher_library');
  }

  /**
   * get_voucher_type_effect
   * 
   * The method gives the voucher type effsct code for a give voucher type.
   * Each voucher type has an associated effect and an account. 
   * 
   * There are 4 voucher type effects with codes income, expense, bank_contra 
   * [bank_contra - is for monies taken from bank to petty cash box] and 
   * cash_contra [is for monies rebanked from petty cash box to bank]
   * 
   * There are 2 voucher type accounts with codes names bank [holds bank transactions] and cash [petty cash transactions]
   * 
   * A valid combination for a voucher type can therefore be Bank Account with Effect of Expense
   * 
   * @param int $voucher_type_id - Is an primary key of a certain voucher type
   * 
   * @return String - Voucher Type Effect of a given voucher type id
   * 
   * @author Nicodemus Karisa Mwambire
   * 
   */
  function get_voucher_type_effect(int $voucher_type_id):Void{
    echo $this->voucher_library->get_voucher_type_effect($voucher_type_id)->voucher_type_effect_code;
  }

  /**
   * repopulate_office_banks
   * 
   * Get an json encoded array of list of bank accounts for an office in the format of each record with office_bank_id and office_bank_name
   * 
   * There is no direct relationship of a bank record in the bank table with office. 
   * The relationship between bank and office is met through the office_bank table through the bank_branch
   * An office can have more than 1 record representing it in the office_bank table and of different bank branches
   * 
   * It reads from a post data
   * 
   * @return Void - JSON Encoded string of array query result
   * 
   */
  function repopulate_office_banks():void{
    $office_id = $this->input->post('office_id');

    echo $this->voucher_library->get_json_populate_office_banks($office_id);
  }

  /**
   * validate_cheque_number
   * 
   * Get to check if the passed voucher cheque number for a given office bank record is a valid one.
   * 
   * It depends on the grants config item "allow_skipping_of_cheque_leaves". If set to false, an can only
   * enter cheque records sequentially without skipping as long as the cheque number is within the range of
   * the active cheque book leaves. The true allows skipping of cheque leaves with the range of the active cheque 
   * book leaves
   * 
   * @return Void - True [Is a useable/valid cheque number],
   * False [Invalid cheque number - already used/ or skipped depending of the allow_skipping_of_cheque_leaves config]
   */
  function validate_cheque_number():void{
    $office_bank_id = $this->input->post('office_bank');
    $cheque_number = $this->input->post('cheque_number');

    echo $this->voucher_library->validate_cheque_number($office_bank_id,$cheque_number);

  }

  /**
   * reload_approved_request_details
   * 
   * This methods gives a view file in string format. The view file is not rendered in a browser.
   * This view list in a HTML table all request detail records that have attained the status 
   * with n-1 (highest - 1) status_approval_sequence
   * 
   * @return Void - A view page in string format
   */
  function reload_approved_request_details():Void{
    echo $this->voucher_library->approved_unvouched_request_details();
  }

  function unset_voucher_office_session(){
    $this->session->unset_userdata('voucher_office');
  }

  function update_voucher_header_on_office_change(){
    $office_id = $this->input->post('office_id');

    // This session is very crucial in getting the list of approve request details
    if($this->session->voucher_office){
      $this->session->unset_userdata('voucher_office');
    }
    //Set a session for the voucher selected office
    $this->session->set_userdata('voucher_office',$office_id);
    

    //echo  $office_id;
    $voucher_number = $this->voucher_library->get_voucher_number($office_id);
    $voucher_date = $this->voucher_library->get_voucher_date($office_id);

    $data = ['voucher_number'=>$voucher_number,'voucher_date'=>$voucher_date];
    echo json_encode($data);
  }


  function get_request_detail($request_detail_id){

    //Update the request detail record by the id that has been passed in the arg
    $data['request_detail_voucher_number'] = $this->input->post('voucher_number');
    $this->db->where(array('request_detail_id'=>$request_detail_id));
    $this->db->update('request_detail',$data);

    // To be done from request detail model
    $this->db->join('project_allocation','project_allocation.project_allocation_id=request_detail.fk_project_allocation_id');
    $this->db->join('expense_account','expense_account.expense_account_id=request_detail.fk_expense_account_id');
    $this->db->select(array('request_detail_description','request_detail_quantity',
    'request_detail_unit_cost','request_detail_total_cost','expense_account_id',
    'project_allocation_id','request_detail_id'));
    

    $request_detail = $this->db->get_where('request_detail',array('request_detail_id'=>$request_detail_id))->row();

    $array = [
      'request_detail_id'=> $request_detail->request_detail_id,
      'voucher_detail_description' => $request_detail->request_detail_description,
      'voucher_detail_quantity' => $request_detail->request_detail_quantity,
      'voucher_detail_unit_cost' => $request_detail->request_detail_unit_cost,
      'voucher_detail_total_cost' => $request_detail->request_detail_total_cost,
      'expense_account_id' => $request_detail->expense_account_id,
      'project_allocation_id' => $request_detail->project_allocation_id
    ];

    echo json_encode($array);
  }

  // New voucher form methods

  function get_transaction_voucher($id){
    
    $raw_result = $this->voucher_model->get_transaction_voucher(hash_id($id,'decode'));

    $office_bank = $this->voucher_model->get_office_bank($raw_result[0]['fk_office_bank_id']);

    $office_cash = $this->voucher_model->get_office_cash($this->office_account_system($raw_result[0]['fk_office_id'])->account_system_id);
    
    $voucher_type = $this->voucher_model->get_voucher_type($raw_result[0]['fk_voucher_type_id']);
  
    $header = [];
    $body = [];

    $office = $this->db->get_where('office',array('office_id'=>$raw_result[0]['fk_office_id']))->row();

    $header['office_name'] = $office->office_code.' - '.$office->office_name;
    $header['office_code'] = $office->office_code;
    $header['office_id'] = $raw_result[0]['fk_office_id'];
    $header['voucher_date'] = $raw_result[0]['voucher_date'];
    $header['voucher_number'] = $raw_result[0]['voucher_number'];
    $header['voucher_type_name'] = $voucher_type->voucher_type_name;
    $header['office_bank'] = sizeof((array)$office_bank)>0?$office_bank->bank_name .'('.$office_bank->office_bank_account_number.')':"";
    $header['office_cash'] = sizeof((array)$office_cash)>0?$office_cash->office_cash_name:"";
    $header['voucher_cheque_number'] = $raw_result[0]['voucher_cheque_number'];
    $header['voucher_vendor'] = $raw_result[0]['voucher_vendor'];
    $header['voucher_vendor_address'] = $raw_result[0]['voucher_vendor_address'];
    $header['voucher_description'] = $raw_result[0]['voucher_description'];
    $header['voucher_created_date'] = $raw_result[0]['voucher_created_date'];

    $count = 0;
    foreach($raw_result as $row){
      $body[$count]['quantity'] = $row['voucher_detail_quantity'];
      $body[$count]['description'] = $row['voucher_detail_description'];
      $body[$count]['unitcost'] = $row['voucher_detail_unit_cost'];
      $body[$count]['totalcost'] = $row['voucher_detail_total_cost'];

      if($row['fk_expense_account_id'] > 0){
        $body[$count]['account_code'] = $this->db->get_where('expense_account',
        array('expense_account_id'=>$row['fk_expense_account_id']))->row()->expense_account_code;
      }elseif ($row['fk_income_account_id'] > 0) {
        $body[$count]['account_code'] = $this->db->get_where('income_account',
        array('income_account_id'=>$row['fk_income_account_id']))->row()->income_account_code;
      }elseif($row['fk_contra_account_id'] > 0){
          $body[$count]['account_code'] = $this->db->get_where('contra_account',
          array('contra_account_id'=>$row['fk_contra_account_id']))->row()->contra_account_code;
      }

      $allocation = $this->voucher_model->get_project_allocation($row['fk_project_allocation_id']);

      $body[$count]['project_allocation_code'] = !empty($allocation)?$allocation->project_allocation_name.' ('.$allocation->project_name.') ':"";

      $count++;
    }

    $item_status = $this->grants_model->initial_item_status('voucher');
    $logged_role_id = $this->session->role_id;
    $table = 'voucher';
    $primary_key = hash_id($this->id,'decode');

    $voucher_raiser_name = $this->record_raiser_info($raw_result[0]['voucher_created_by'])['full_name'];
    //$voucher_raiser_name = $this->record_raiser_info($raw_result[0]['voucher_last_modified_by'])['full_name'];

    return [
      "header"=>$header,
      "body"=>$body,
      'action_labels'=>['show_label_as_button'=>$this->general_model->show_label_as_button($item_status,$logged_role_id,$table,$primary_key)],'raiser_approver_info'=>['voucher_raiser_name'=>$voucher_raiser_name],
      //'chat_messages'=>$this->get_chat_messages($this->controller,$id),
    ];

  }

  function get_chat_messages($approve_item_name,$record_primary_key){

    $approve_item_id = $this->db->get_where('approve_item',
    array('approve_item_name'=>$approve_item_name))->row()->approve_item_id;


    $this->db->select(array(
      'fk_user_id as author',
      'message_detail_content as message',
      'message_detail_created_date as message_date'));
    
      $this->db->join('message','message.message_id=message_detail.fk_message_id');  

    $chat_messages = $this->db->get_where('message_detail',
    array('fk_approve_item_id'=>$approve_item_id,
    'message_record_key'=>1))->result_array();
   
    return $chat_messages;
    
  }

  function record_raiser_info($user_id){
    
    $user_obj = $this->db->get_where('user',array('user_id'=>$user_id));

    $user_info['full_name'] = '';

    if($user_obj->num_rows() > 0){
      $user_obj->row()->user_firstname.' '.$user_obj->row()->user_lastname;
    }

    return $user_info;
  }
  

  function result($id = ''){
    if($this->action == 'view'){
  
    $result = $this->get_transaction_voucher($this->id);

     return $result;
    }else{
      return parent::result($id = '');
    }
  }

  function view(){
    parent::view();
  }

  static function get_menu_list(){

  }


  // Custom voucher form functions

  function voucher_type_effect_and_code($voucher_type_id){
    $this->db->select(array('voucher_type_account_code','voucher_type_effect_code'));
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $voucher_type_effect_and_code = $this->db->get_where('voucher_type',array('voucher_type_id'=>$voucher_type_id))->row();

    return $voucher_type_effect_and_code;
  }

  function office_account_system($office_id){
   
    $this->db->join('account_system','account_system.account_system_id=office.fk_account_system_id');
    $office_accounting_system = $this->db->get_where('office',array('office_id'=>$office_id))->row();

    return $office_accounting_system;
  }

  function get_active_voucher_types($office_id){
    $account_system_id = $this->office_account_system($office_id)->account_system_id;
    $voucher_types = $this->voucher_type_model->get_active_voucher_types($account_system_id);

    echo json_encode($voucher_types);
  }

  function get_voucher_accounts_and_allocation($office_id, $voucher_type_id,$transaction_date,$office_bank_id = 0){

    $response = [];
    $response['is_bank_payment'] = false;
    $response['is_contra'] = false;
    $response['is_expense'] = false;
    $response['is_transaction_affecting_bank'] = false;
    $response['approved_requests'] = 0;
    $response['project_allocation'] = [];
    $response['office_cash'] = [];
    $response['is_cash_payment'] = false;

    //Check if voucher type requires cheque referencing
    $response['voucher_type_requires_cheque_referencing'] = $this->voucher_type_model->voucher_type_requires_cheque_referencing($voucher_type_id);

    $office_accounting_system = $this->office_account_system($office_id);

    $project_allocation = [];
    
    if( 
        !$office_accounting_system->account_system_is_allocation_linked_to_account || 
        $this->config->item("toggle_accounts_by_allocation")){

        $query_condition = "fk_office_id = ".$office_id." AND (project_end_date >= '".$transaction_date."' OR  project_allocation_extended_end_date >= '".$transaction_date."')";
        $this->db->select(array('project_allocation_id','project_allocation_name'));
        $this->db->join('project','project.project_id=project_allocation.fk_project_id');

        if($this->input->post('office_bank_id')){
          $this->db->where(array('fk_office_bank_id'=>$this->input->post('office_bank_id')));
          $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_project_allocation_id=project_allocation.project_allocation_id');
        }

        $this->db->where($query_condition);
        $project_allocation = $this->db->get('project_allocation')->result_object();
    }
    
    $voucher_type_effect_and_code = $this->voucher_type_effect_and_code($voucher_type_id);

    $voucher_type_effect = $voucher_type_effect_and_code->voucher_type_effect_code;
    $voucher_type_account = $voucher_type_effect_and_code->voucher_type_account_code;

    // Check if the voucher type is a bank payment
    if($voucher_type_account == 'bank' && ($voucher_type_effect == 'expense' || $voucher_type_effect == 'contra') ){
      $response['is_bank_payment'] = true;
      
    }elseif($voucher_type_account == 'cash'){
      $response['is_cash_payment'] = true;
      $response['office_cash'] = $this->db->select(array('office_cash_id','office_cash_name'))->get_where('office_cash',
      array('fk_account_system_id'=>$office_accounting_system->account_system_id,'office_cash_is_active'=>1))->result_array();
    }

    if($voucher_type_effect == 'contra'){
      $response['project_allocation'] = $project_allocation;
      $response['is_contra'] = true;
      $response['office_cash'] = $this->db->select(array('office_cash_id','office_cash_name'))->get_where('office_cash',
      array('fk_account_system_id'=>$office_accounting_system->account_system_id,'office_cash_is_active'=>1))->result_array();
    }

    if($voucher_type_account == 'bank'){
      $response['is_transaction_affecting_bank'] = true;
    }

    if($voucher_type_effect == 'income'){

      $response['project_allocation'] = $project_allocation;
      
      $this->db->select(array('income_account_id as account_id','income_account_name as account_name','income_account_code as account_code'));
      $response['accounts'] = $this->db->get_where('income_account',
      array('income_account_is_active'=>1,'fk_account_system_id'=>$office_accounting_system->fk_account_system_id))->result_object();
    
    }elseif($voucher_type_effect == 'expense'){
      $response['is_expense'] = true;
      $response['project_allocation'] = $project_allocation;
      $response['approved_requests'] = count($this->voucher_model->get_approved_unvouched_request_details($office_id));
      
      $this->db->select(array('expense_account_id as account_id','expense_account_name as account_name','expense_account_code as account_code'));
      $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
      $response['accounts'] = $this->db->get_where('expense_account',
      array('expense_account_is_active'=>1,'fk_account_system_id'=>$office_accounting_system->fk_account_system_id))->result_object();
    
    }elseif($voucher_type_account == 'cash' && $voucher_type_effect == 'contra'){

      $response['is_transaction_affecting_bank'] = true;

      $this->db->select(array('contra_account_id as account_id','contra_account_name as account_name','contra_account_code as account_code'));
      $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=contra_account.fk_voucher_type_account_id');
      $this->db->join('office_bank','office_bank.office_bank_id=contra_account.fk_office_bank_id');
      $response['accounts'] = $this->db->get_where('contra_account',
      array('voucher_type_account_code'=>'cash',
      'fk_account_system_id'=>$office_accounting_system->account_system_id,
      'office_bank_is_active'=>1,
      'office_bank_id'=>$office_bank_id))->result_object();

    }elseif($voucher_type_account == 'bank' && $voucher_type_effect == 'contra'){

      $response['is_transaction_affecting_bank'] = true;
    
      $this->db->select(array('contra_account_id as account_id','contra_account_name as account_name','contra_account_code as account_code'));
      $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=contra_account.fk_voucher_type_account_id');
      $this->db->join('office_bank','office_bank.office_bank_id=contra_account.fk_office_bank_id');
      $response['accounts'] = $this->db->get_where('contra_account',
      array('voucher_type_account_code'=>'bank',
      'fk_account_system_id'=>$office_accounting_system->account_system_id,
      'office_bank_is_active'=>1,
      'office_bank_id'=>$office_bank_id))->result_object();
    
    }
    

    echo json_encode($response);

  }

  function get_office_banks(){

    $office_id = $this->input->post('office_id');
    
    //echo $office_id;
    $this->db->select(array('office_bank_id','bank_name','office_bank_name','office_bank_account_number '));
  
    //$this->db->join('bank_branch','bank_branch.bank_branch_id=office_bank.fk_bank_branch_id');
    $this->db->join('bank','bank.bank_id=office_bank.fk_bank_id');
    
    //$this->grants_model->create_table_join_statement_with_depth('office_bank',['bank_branch','bank']);

    $office_banks = $this->db->get_where('office_bank',
    array('fk_office_id'=>$office_id,'office_bank_is_active'=>1))->result_object();

    echo json_encode($office_banks);
  }

  function check_cheque_validity(){
    $post = $this->input->post();
    $is_valid_cheque = true;
    $cheque_number_greater_than_last_leaf_serial = false;
    $no_active_cheque_book = false;

    $bank_id = $post['bank_id'];
    $office_id = $post['office_id'];
    $cheque_number = $post['cheque_number'];

    // Validity based on vouched cheques
    $used_cheque_in_vouchers = $this->db->get_where('voucher',
    array('fk_office_id'=>$office_id,
    'fk_office_bank_id'=>$bank_id,'voucher_cheque_number'=>$cheque_number,'voucher_is_reversed'=>0))->num_rows();

    // Validity based on cheque book serial numbers
    $active_cheque_book = $this->db->get_where("cheque_book",
    array('fk_office_bank_id'=>$bank_id,'cheque_book_is_active'=>1));

    if($active_cheque_book->num_rows() > 0){
      $start_serial = $active_cheque_book->row()->cheque_book_start_serial_number;
      $no_of_leaves = $active_cheque_book->row()->cheque_book_count_of_leaves;
      $last_serial = $start_serial + ($no_of_leaves - 1);

      if($cheque_number > $last_serial){
        $cheque_number_greater_than_last_leaf_serial = true;
      }
    }else{
      $no_active_cheque_book = true;
    }

     $is_valid_cheque = ($no_active_cheque_book || $used_cheque_in_vouchers > 0 || $cheque_number_greater_than_last_leaf_serial)?false:true;

     echo $is_valid_cheque;
  }


  function compute_next_voucher_number(){
    $office_id = $this->input->post('office_id');
    echo $this->voucher_model->get_voucher_number($office_id);
  }
   
  function get_office_voucher_date(){

    $office_id = $this->input->post('office_id');

    $next_vouching_date = $this->voucher_model->get_voucher_date($office_id);
    $last_vouching_month_date = date('Y-m-t',strtotime($next_vouching_date));
    
    $voucher_date_field_dates = ['next_vouching_date'=>$next_vouching_date,'last_vouching_month_date'=>$last_vouching_month_date];
  
    echo json_encode($voucher_date_field_dates);
  }

  function get_approve_request_details($office_id){
    //echo "Approved request details";
    echo $this->voucher_library->approved_unvouched_request_details($office_id);
  }

  function create_new_journal($journal_date,$office_id){
    $new_journal = [];

    $new_journal['journal_track_number'] = $this->grants_model->generate_item_track_number_and_name('journal')['journal_track_number'];
    $new_journal['journal_name'] =  "Journal for the month of ". $journal_date;
    $new_journal['journal_month'] = $journal_date;
    $new_journal['fk_office_id'] = $office_id;
    $new_journal['journal_created_date'] = date('Y-m-d');
    $new_journal['journal_created_by'] = $this->session->user_id;
    $new_journal['journal_last_modified_by'] = $this->session->user_id;
    $new_journal['fk_approval_id'] = $this->grants_model->insert_approval_record('journal');
    $new_journal['fk_status_id'] = $this->grants_model->initial_item_status('journal');

    //$new_journal = $this->grants_model->merge_with_history_fields('financial_report',$new_journal,false);

    $this->db->insert('journal',$new_journal);

    //return $this->db->insert_id();
  }

  function create_financial_report($financial_report_date){
      $new_mfr['financial_report_month'] = $financial_report_date;
      $new_mfr['fk_office_id'] = $this->input->post('fk_office_id');
      // $new_mfr['financial_report_statement_balance'] = 0;
      // $new_mfr['financial_report_statement_date'] = '0000-00-00';
      // $new_mfr['financial_report_is_submitted'] = 0;

      $new_mfr_to_insert = $this->grants_model->merge_with_history_fields('financial_report',$new_mfr);

      $this->db->insert('financial_report',$new_mfr_to_insert);
  }

  function insert_new_voucher(){

    $header = [];
    $detail = [];
    $row = [];

    $this->db->trans_start();
    
    // Check if this is the first voucher in the month, if so create a new journal record for the month
    // This must be run before a voucher is created
    if(!$this->voucher_model->office_has_vouchers_for_the_transacting_month($this->input->post('fk_office_id'),$this->input->post('voucher_date'))){
      
      // Create a journal record
      $this->create_new_journal(date("Y-m-01",strtotime($this->input->post('voucher_date'))),$this->input->post('fk_office_id'));

      // Insert the month MFR Record

      $this->create_financial_report(date("Y-m-01",strtotime($this->input->post('voucher_date'))));

    }

    // Check voucher type

    $voucher_type_effect_code = $this->voucher_type_effect_and_code($this->input->post('fk_voucher_type_id'))->voucher_type_effect_code;


    $header['voucher_track_number'] = $this->grants_model->generate_item_track_number_and_name('voucher')['voucher_track_number'];
    $header['voucher_name'] = $this->grants_model->generate_item_track_number_and_name('voucher')['voucher_name'];
   
    $header['fk_office_id'] = $this->input->post('fk_office_id');
    $header['voucher_date'] = $this->input->post('voucher_date');
    $header['voucher_number'] = $this->input->post('voucher_number');
    $header['fk_voucher_type_id'] = $this->input->post('fk_voucher_type_id');
    $header['fk_office_bank_id'] = $this->input->post('fk_office_bank_id') == null?0:$this->input->post('fk_office_bank_id');
    $header['fk_office_cash_id'] = $this->input->post('fk_office_cash_id') == null?0:$this->input->post('fk_office_cash_id');
    $header['voucher_cheque_number'] = $this->input->post('voucher_cheque_number') == null?0:$this->input->post('voucher_cheque_number');
    $header['voucher_vendor'] = $this->input->post('voucher_vendor');
    $header['voucher_vendor_address'] = $this->input->post('voucher_vendor_address');
    $header['voucher_description'] = $this->input->post('voucher_description');

    $header['voucher_created_by'] = $this->session->user_id;
    $header['voucher_created_date'] = date('Y-m-d');
    $header['voucher_last_modified_by'] = $this->session->user_id;

    $header['fk_approval_id'] = $this->grants_model->insert_approval_record('voucher');
    $header['fk_status_id'] = $this->grants_model->initial_item_status('voucher');

    
    $this->db->insert('voucher',$header);

    $header_id = $this->db->insert_id();

    for ($i=0; $i < sizeof($this->input->post('voucher_detail_quantity')); $i++) { 
      
      $detail['fk_voucher_id'] = $header_id;
      $detail['voucher_detail_track_number'] = $this->grants_model->generate_item_track_number_and_name('voucher_detail')['voucher_detail_track_number'];
      $detail['voucher_detail_name'] = $this->grants_model->generate_item_track_number_and_name('voucher_detail')['voucher_detail_name'];
     
      $detail['voucher_detail_quantity'] = $this->input->post('voucher_detail_quantity')[$i];
      $detail['voucher_detail_description'] = $this->input->post('voucher_detail_description')[$i];
      $detail['voucher_detail_unit_cost'] = $this->input->post('voucher_detail_unit_cost')[$i];
      $detail['voucher_detail_total_cost'] = $this->input->post('voucher_detail_total_cost')[$i];
      
      if($voucher_type_effect_code == 'expense'){
        $detail['fk_expense_account_id'] = $this->input->post('voucher_detail_account')[$i]; 
        $detail['fk_income_account_id'] = 0; 
        $detail['fk_contra_account_id'] = 0;     
      }elseif($voucher_type_effect_code == 'income'){
        $detail['fk_expense_account_id'] = 0; 
        $detail['fk_income_account_id'] = $this->input->post('voucher_detail_account')[$i]; 
        $detail['fk_contra_account_id'] = 0;    
      }elseif($voucher_type_effect_code == 'contra'){
        $detail['fk_expense_account_id'] = 0; 
        $detail['fk_income_account_id'] = 0; 
        $detail['fk_contra_account_id'] = $this->input->post('voucher_detail_account')[$i];    
      }
      // else{
      //   $detail['fk_expense_account_id'] = 0; 
      //   $detail['fk_income_account_id'] = 0; 
      //   $detail['fk_bank_contra_account_id'] = 0;    
      //   $detail['fk_cash_contra_account_id'] = $this->input->post('voucher_detail_account')[$i];
      // }
  
      
      $detail['fk_project_allocation_id'] = isset($this->input->post('fk_project_allocation_id')[$i])?$this->input->post('fk_project_allocation_id')[$i]:0;
      $detail['fk_request_detail_id'] = $this->input->post('fk_request_detail_id')[$i];
      $detail['fk_approval_id'] = $this->grants_model->insert_approval_record('voucher_detail');
      $detail['fk_status_id'] = $this->grants_model->initial_item_status('voucher_detail');      
      
      // // if request_id > 0 give the item the final status
      if($this->input->post('fk_request_detail_id')[$i] > 0){
        
        $this->update_request_detail_status_on_vouching($this->input->post('fk_request_detail_id')[$i],$header_id);
       
        // Check if all request detail items in the request has the last status and update the request to last status too
        
        //$this->update_request_on_paying_all_details($this->input->post('fk_request_detail_id')[$i]);   
       

      }
      
      $row[] = $detail;
    }

    //echo json_encode($row);
    $this->db->insert_batch('voucher_detail',$row);


    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
      echo "Voucher posting failed";
    }else{
      echo "Voucher posted successfully";
    }

  }

  function get_project_details_account(){
    
    $post = $this->input->post();

    $voucher_type_effect_and_code = $this->voucher_type_effect_and_code($post['voucher_type_id']);

    $voucher_type_effect = $voucher_type_effect_and_code->voucher_type_effect_code;
    $voucher_type_account = $voucher_type_effect_and_code->voucher_type_account_code;
    
    $project_allocation = [];

    $income_account_id = $post['account_id'];

    $office_accounting_system = $this->office_account_system($this->input->post('office_id'));

    if($voucher_type_effect == 'expense'){
      
      $this->db->select('income_account_id');
      $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
      $income_account_id = $this->db->get_where('expense_account',
      array('expense_account_id'=>$post['account_id']))->row()->income_account_id;
    }

    if($voucher_type_effect == 'expense' || $voucher_type_effect == 'income'){
      $query_condition = "fk_office_id = ".$post['office_id']." AND (project_end_date >= '".$post['transaction_date']."' OR  project_allocation_extended_end_date >= '".$post['transaction_date']."')";
      $this->db->select(array('project_allocation_id','project_allocation_name'));
      $this->db->join('project','project.project_id=project_allocation.fk_project_id');
      
      if($this->input->post('office_bank_id')){
        $this->db->where(array('fk_office_bank_id'=>$this->input->post('office_bank_id')));
        $this->db->join('office_bank_project_allocation','office_bank_project_allocation.fk_project_allocation_id=project_allocation.project_allocation_id');
      }

      if($office_accounting_system->account_system_is_allocation_linked_to_account){
        $this->db->where(array('fk_income_account_id'=>$income_account_id));
      }
      
      $this->db->where($query_condition);
      $project_allocation = $this->db->get('project_allocation')->result_object();
    }
    

    echo json_encode($project_allocation);

  }

  function get_accounts_for_project_allocation(){
    //voucher_type_id
    $post = $this->input->post();

    $voucher_type_effect_and_code = $this->voucher_type_effect_and_code($post['voucher_type_id']);

    $voucher_type_effect = $voucher_type_effect_and_code->voucher_type_effect_code;
    $voucher_type_account = $voucher_type_effect_and_code->voucher_type_account_code;
    
    $accounts = [];

    $project_allocation_id = $post['allocation_id'];
    $office_bank_id = $post['office_bank_id'];

    $office_accounting_system = $this->office_account_system($this->input->post('office_id'));
    
    $this->db->where(array('fk_account_system_id'=>$office_accounting_system->account_system_id));

    if($voucher_type_effect == 'expense'){
      $this->db->where(array('project_allocation_id'=>$project_allocation_id,'expense_account_is_active'=>1));
      $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
      $this->db->join('project','project.fk_income_account_id=income_account.income_account_id');
      $this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
      $this->db->select(array('expense_account_id as account_id','expense_account_name as account_name'));
      $accounts = $this->db->get('expense_account')->result_array();
    }elseif($voucher_type_effect == 'expense'){
      $this->db->where(array('project_allocation_id'=>$project_allocation_id,'income_account_is_active'=>1));
      $this->db->join('project','project.fk_income_account_id=income_account.income_account_id');
      $this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
      $this->db->select(array('income_account_id as account_id','income_account_name as account_name'));
      $accounts = $this->db->get('income_account')->result_array();
    }else{// Only contra effect enters here
      $this->db->where(array('fk_office_bank_id'=>$office_bank_id,'voucher_type_account_code'=>$voucher_type_account));
      $this->db->select(array('contra_account_id as account_id','contra_account_name as account_name'));
      $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=contra_account.fk_voucher_type_account_id');
      $accounts = $this->db->get_where('contra_account')->result_array();
    }  
    
    echo json_encode($accounts);
  }

  function update_request_detail_status_on_vouching($request_detail_id,$voucher_id){
        // $approve_item_id = $this->db->get_where('approve_item',array('approve_item_name'=>'request_detail'))->row()->approve_item_id;
        
        // $item_last_status = $this->voucher_model->get_approveable_item_last_status($approve_item_id);

        // $this->db->where(array('request_detail_id'=>$request_detail_id));
        // $this->db->update('request_detail',array('fk_status_id'=>$item_last_status));

        // Update the request detail record
        $this->db->where(array('request_detail_id'=>$request_detail_id));
        $this->db->update('request_detail',array('request_detail_voucher_number'=>$voucher_id));
  }

  function update_request_on_paying_all_details($request_detail_id){
    $request_id = $this->db->get_where('request_detail',array('request_detail_id'=>$request_detail_id))->row()->fk_request_id;
    $unpaid_request_details = $this->db->get_where('request_detail',array('fk_request_id'=>$request_id,'fk_status_id<>'=>7))->num_rows();
    
    $approve_item_id = $this->db->get_where('approve_item',array('approve_item_name'=>'request'))->row()->approve_item_id;
    $item_last_status = $this->voucher_model->get_approveable_item_last_status($approve_item_id);


    if($unpaid_request_details == 0){
      $this->db->where(array('request_id'=>$request_id));
      $this->db->update('request',array('fk_status_id'=>$item_last_status));
    }
  }
  
}
