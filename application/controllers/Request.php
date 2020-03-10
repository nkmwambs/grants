<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Request extends MY_Controller
{

  function __construct(){
    parent::__construct();

    $this->load->model('request_model');
    $this->load->library('request_library');
  }

  function index(){}

  function test(){
    echo "Done well!";
  }


  static function get_menu_list(){

  }

function get_request_type(){
  $result = [];

  $office_id = $this->input->post('office_id');

  //$account_system_id = $this->db->get_where('office',array('office_id'=>$office_id))->row()->fk_account_system_id;

  $result['request_type'] = $this->Request_model->get_request_types();
  $result['department'] = $this->Request_model->get_user_departments();

  echo json_encode($result);
}

function get_request_accounts_and_allocation($office_id, $request_date){
  
  $result['accounts'] = $this->request_model->get_request_detail_accounts($office_id);

  $result['project_allocation'] = $this->request_model->get_request_detail_project_allocation($office_id, $request_date);

  echo json_encode($result);
}

function insert_new_request(){
  
  $header = [];
  $detail = [];
  $row = [];

  $header['request_track_number'] = $this->grants_model->generate_item_track_number_and_name('request')['request_track_number'];
  $header['request_name'] = $this->grants_model->generate_item_track_number_and_name('request')['request_name'];
 
  $header['fk_office_id'] = $this->input->post('fk_office_id');
  $header['request_date'] = $this->input->post('request_date');
  $header['request_description'] = $this->input->post('request_description');
  $header['fk_request_type_id'] = $this->input->post('fk_request_type_id');
  $header['fk_department_id'] = $this->input->post('fk_department_id');

  $header['fk_approval_id'] = $this->grants_model->insert_approval_record('request');
  $header['fk_status_id'] = $this->grants_model->initial_item_status('request');

  $this->db->trans_start();
  $this->db->insert('request',$header);

  $header_id = $this->db->insert_id();

  for ($i=0; $i < sizeof($this->input->post('request_detail_quantity')); $i++) { 
    
    $detail['fk_request_id'] = $header_id;
    $detail['request_detail_track_number'] = $this->grants_model->generate_item_track_number_and_name('request_detail')['request_detail_track_number'];
    $detail['request_detail_name'] = $this->grants_model->generate_item_track_number_and_name('request_detail')['request_detail_name'];
   
    $detail['request_detail_quantity'] = $this->input->post('request_detail_quantity')[$i];
    $detail['request_detail_description'] = $this->input->post('request_detail_description')[$i];
    $detail['request_detail_unit_cost'] = $this->input->post('request_detail_unit_cost')[$i];
    $detail['request_detail_total_cost'] = $this->input->post('request_detail_total_cost')[$i];
    $detail['fk_expense_account_id'] = $this->input->post('fk_expense_account_id')[$i];
    $detail['request_detail_conversion_set'] = 0;
    $detail['request_detail_voucher_number'] = 0;
    
    $detail['fk_project_allocation_id'] = $this->input->post('fk_project_allocation_id')[$i];

    $detail['fk_approval_id'] = 0;//$this->grants_model->insert_approval_record('voucher_detail');
    $detail['fk_status_id'] = $this->grants_model->initial_item_status('request_detail');

    
    
    $row[] = $detail;
  }

  //echo json_encode($row);
  $this->db->insert_batch('request_detail',$row);

  $this->db->trans_complete();

  if ($this->db->trans_status() === FALSE)
  {
    echo "Request posting failed";
  }else{
    echo "Request posted successfully";
  }

}

}
