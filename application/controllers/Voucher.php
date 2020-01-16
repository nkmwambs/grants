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

  static function get_menu_list(){

  }

  
}
