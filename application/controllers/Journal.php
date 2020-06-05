<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Journal extends MY_Controller
{

  function __construct(){
    parent::__construct();

    $this->load->model('finance_model');
    $this->load->model('voucher_model');

  }

  function index(){}

  function month_opening_bank_cash_balance($office_id,$transacting_month,$office_bank_id = 0){
    return [
      'bank_balance'=>$this->journal_library->month_opening_bank_cash_balance($office_id,$transacting_month,$office_bank_id)['bank'],
      'cash_balance'=>$this->journal_library->month_opening_bank_cash_balance($office_id,$transacting_month)['cash']
    ];
  }

  function journal_records($office_id,$transacting_month, $project_allocation_ids = []){
      return $this->journal_library->journal_records($office_id,$transacting_month, $project_allocation_ids);
  }

  function get_office_data_from_journal($journal_id){
    return $this->journal_library->get_office_data_from_journal($journal_id);
  }

  function journal_navigation($office_id, $transacting_month){
    return $this->journal_library->journal_navigation($office_id, $transacting_month);
  }

  function financial_accounts(){
    return $this->journal_library->financial_accounts();
  }


  function result($id = ''){
    if($this->action == 'view'){
      
      $journal_id = hash_id($this->id,'decode');

      $office_id = $this->get_office_data_from_journal($journal_id)->office_id;
      $transacting_month = $this->get_office_data_from_journal($journal_id)->journal_month;

     return $this->result_array($office_id,$transacting_month,$journal_id);
    }else{
      return parent::result($id = '');
    }
  }

  private function result_array($office_id,$transacting_month,$journal_id,$office_bank_id = 0, $project_allocation_ids = []){
    $result = [
      'office_bank_accounts'=>$this->grants_model->office_bank_accounts($office_id),
      'office_has_multiple_bank_accounts'=>$this->grants_model->office_has_multiple_bank_accounts($office_id),
      'transacting_month'=> $transacting_month,
      'office_id'=>$office_id,
      'office_name'=> $this->get_office_data_from_journal($journal_id)->office_name,
      'navigation'=>$this->journal_navigation($office_id, $transacting_month),
      'accounts'=>$this->financial_accounts(),
      'month_opening_balance'=>$this->month_opening_bank_cash_balance($office_id,$transacting_month, $office_bank_id),
      'vouchers'=>$this->journal_records($office_id,$transacting_month,$project_allocation_ids)
     ];

     return $result;
  }

  function get_office_bank_project_allocation_ids($office_bank_id){
    $records = $this->grants_model->get_type_records_by_foreign_key_id('office_bank_project_allocation','office_bank',$office_bank_id);

    return count($records) > 0 ? array_column($records,'fk_project_allocation_id') : [];
  }

  function get_office_bank_journal(){
     
    /**
     * Class parameters e.g. $this->action and $this->id from MY_Controller are not visible on ajax request
     */
    
    $office_bank_id = $this->input->post('office_bank_id');
    $office_id = $this->input->post('office_id');
    $transacting_month = $this->input->post('transacting_month');
    $journal_id = hash_id($this->input->post('journal_id'),'decode');

    $project_allocation_ids = $this->get_office_bank_project_allocation_ids($office_bank_id);

    $result = $this->result_array($office_id,$transacting_month,$journal_id,$office_bank_id,$project_allocation_ids);

    $result['result'] = $result;
    $result['office_bank_name'] = $this->grants_model->get_type_name_by_id('office_bank',$office_bank_id);
    
    $view_page =  $this->load->view('journal/ajax_view',$result,true);

    echo $view_page;
  }

  function view(){
    parent::view();
  }


  static function get_menu_list(){

  }

}
