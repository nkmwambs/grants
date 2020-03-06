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

  $account_system_id = $this->db->get_where('office',array('office_id'=>$office_id))->row()->fk_account_system_id;

  $result['request_type'] = $this->request_model->get_request_types($account_system_id);
  $result['department'] = $this->request_model->get_user_departments();

  echo json_encode($result);
}

function get_request_accounts_and_allocation($office_id, $request_date){
  
  $result['accounts'] = $this->request_model->get_request_detail_accounts($office_id);

  $result['project_allocation'] = $this->request_model->get_request_detail_project_allocation($office_id, $request_date);

  echo json_encode($result);
}

function insert_new_request(){
  echo "Success";
}

}
