<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Voucher_type_model extends MY_Model 
{
  public $table = 'voucher_type'; // you MUST mention the table name
  public $name_field = "voucher_type_name";
  //public $primary_key = "voucher_detail_id";

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function delete($id = null){

  }

  function index(){}

  public function lookup_tables(){
    return array('voucher_type_account','voucher_type_effect','account_system');
  }

  public function detail_tables(){}

  public function list(){}

  public function view(){}

  function get_active_voucher_types($account_system_id, $office_id){

    $count_office_banks = $this->read_db->get_where('office_bank',
    array('fk_office_id'=>$office_id,'office_bank_is_active'=>1))->num_rows();

    if($count_office_banks < 2){
      $this->read_db->where_not_in('voucher_type_effect_code',['bank_to_bank_contra']);
    }

    $this->read_db->select(array('voucher_type_id','voucher_type_name','voucher_type_account_code','voucher_type_effect_code'));
    $this->read_db->join('account_system','account_system.account_system_id=voucher_type.fk_account_system_id');
    $this->read_db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');
    $this->read_db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    return $this->read_db->get_where('voucher_type',array('voucher_type_is_active'=>1,'fk_account_system_id'=>$account_system_id))->result_object();
  }

  function voucher_type_requires_cheque_referencing($voucher_type_id){
    $this->db->select(array('voucher_type_is_cheque_referenced'));
    
    $voucher_type_is_cheque_referenced =  $this->db->get_where('voucher_type',
    array('voucher_type_id'=>$voucher_type_id))->row()->voucher_type_is_cheque_referenced;

    return $voucher_type_is_cheque_referenced;
  }

  function list_table_where(){
    if(!$this->session->system_admin){
      $this->db->where(array('account_system_code'=>$this->session->user_account_system));
    }
  }

  function single_form_add_visible_columns()
  {
    return [
      'voucher_type_name',
      'voucher_type_abbrev',
      'voucher_type_is_active',
      'voucher_type_account_name',
      'voucher_type_effect_name',
      'voucher_type_is_cheque_referenced',
      'account_system_name'
    ];
  }
  
}
