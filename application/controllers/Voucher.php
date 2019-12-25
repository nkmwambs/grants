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


  function get_request_detail($request_detail_id){

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
      'voucher_detail_account' => $request_detail->expense_account_id,
      'project_allocation_name' => $request_detail->project_allocation_id
    ];

    echo json_encode($array);
  }

  static function get_menu_list(){

  }

}
