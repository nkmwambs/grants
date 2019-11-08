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
  public $primary_key = 'voucher_id'; // you MUST mention the primary key
  public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
  public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){}

  public function lookup_tables(){
    return array('center','voucher_type');
  }

  public function detail_tables(){
    return array('voucher_detail');
  }

  function detail_list(){}

  // function master_view(){
  //   //return $this->db->select(array('voucher_id','voucher_date'))->get_where('voucher')->result_array();
  // }

  function master_multi_form_add_visible_columns(){
    return array('voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_description','center_name','voucher_type_name');
  }

  public function list(){}

  public function view(){}

  public function list_table_visible_columns(){
    return array('voucher_track_number','voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_created_date','center_name','voucher_type_name');
  }

  public function master_table_visible_columns(){
    return array('voucher_type_id','voucher_track_number','voucher_number','voucher_date','voucher_cheque_number',
    'voucher_vendor','voucher_description','center_name','center_id','voucher_type_name',
    'voucher_last_modified_by','voucher_created_by');
  }

    /**Local methods**/
  function highest_voucher_number($center_id = 1){

    // Get max voucher number for center
    return $this->db->select_max("voucher_number")->get_where('voucher',
    array('fk_center_id'=>$center_id))->row()->voucher_number;
  }

  
}
