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

  }

  function get_voucher_type_effect($voucher_type_id){
    echo $this->voucher_library->get_voucher_type_effect($voucher_type_id)->voucher_type_effect_code;
  }

  function repopulate_office_banks(){
    $office_id = $this->input->post('office_id');

    $bank_array = $this->voucher_library->populate_office_banks($office_id);

    echo json_encode($bank_array);
  }

  function validate_cheque_number(){
    $data = $this->input->post();

    echo $this->voucher_library->validate_cheque_number($data);

  }

  function reload_approved_request_details(){
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
    'request_detail_unit_cost','request_detail_total_cost','expense_account_id','project_allocation_id'));
    

    $request_detail = $this->db->get_where('request_detail',array('request_detail_id'=>$request_detail_id))->row();

    $array = [
      'voucher_detail_description' => $request_detail->request_detail_description,
      'voucher_detail_quantity' => $request_detail->request_detail_quantity,
      'voucher_detail_unit_cost' => $request_detail->request_detail_unit_cost,
      'voucher_detail_total_cost' => $request_detail->request_detail_total_cost,
      'expense_account_name' => $request_detail->expense_account_id,
      'project_allocation_name' => $request_detail->project_allocation_id
    ];

    echo json_encode($array);
  }

  // New voucher form methods

  function result($id = ''){
    if($this->action == 'view'){
  
    $transacting_month = '';
    $last_voucher_date = '';
    
    $result = [
      'transacting_month'=> $transacting_month,
      'last_voucher_date'=> $last_voucher_date,
     ];

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

  function get_voucher_accounts_and_allocation($office_id, $voucher_type_id,$transaction_date){

    $response = [];
    $response['is_bank_payment'] = false;

    $office_accounting_system = $this->db->get_where('office',array('office_id'=>$office_id))->row()->fk_account_system_id;

    $query_condition = "fk_office_id = ".$office_id." AND (project_end_date >= '".$transaction_date."' OR  project_allocation_extended_end_date >= '".$transaction_date."')";
    $this->db->select(array('project_allocation_id','project_allocation_name'));
    $this->db->join('project','project.project_id=project_allocation.fk_project_id');
    $this->db->where($query_condition);
    $project_allocation = $this->db->get('project_allocation')->result_object();
    
    $this->db->select(array('voucher_type_account_code','voucher_type_effect_code','voucher_type_account_code '));
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $voucher_type_effect_and_code = $this->db->get_where('voucher_type',array('voucher_type_id'=>$voucher_type_id))->row();

    $voucher_type_effect = $voucher_type_effect_and_code->voucher_type_effect_code;
    $voucher_type_account = $voucher_type_effect_and_code->voucher_type_account_code;

    if($voucher_type_account == 'bank' && $voucher_type_effect == 'expense'){
      $response['is_bank_payment'] = true;
    }

    if($voucher_type_effect == 'income'){

      $response['project_allocation'] = $project_allocation;
      
      $this->db->select(array('income_account_id as account_id','income_account_name as account_name','income_account_code as account_code'));
      $response['accounts'] = $this->db->get_where('income_account',array('income_account_is_active'=>1,'fk_account_system_id'=>$office_accounting_system))->result_object();
    
    }elseif($voucher_type_effect == 'expense'){
      
      $response['project_allocation'] = $project_allocation;
      
      $this->db->select(array('expense_account_id as account_id','expense_account_name as account_name','expense_account_code as account_code'));
      $response['accounts'] = $this->db->get_where('expense_account',array('expense_account_is_active'=>1))->result_object();
    
    }elseif($voucher_type_effect == 'cash_contra'){

    }elseif($voucher_type_effect == 'bank_contra'){

    }

    echo json_encode($response);

  }

  function get_office_banks($office_id){
    //echo $office_id;
    $this->db->select(array('office_bank_id','bank_name','office_bank_account_number '));
    $this->db->join('bank','bank.bank_id=office_bank.fk_bank_id');
    $office_banks = $this->db->get_where('office_bank',
    array('fk_office_id'=>$office_id,'is_office_bank_active'=>1))->result_object();

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
    'fk_office_bank_id'=>$bank_id,'voucher_cheque_number'=>$cheque_number))->num_rows();

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
  
}
