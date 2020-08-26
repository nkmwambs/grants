<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Bank_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'bank'; // you MUST mention the table name
  public $primary_key = 'bank_id'; // you MUST mention the primary key
  public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
  public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
  public $hidden_columns = array();

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function index()
  {
  }


  function delete($id = null)
  {
  }

  function lookup_tables()
  {
    return ['account_system'];
  }

  function detail_tables()
  {
    return ['office_bank'];
  }

  public function list_table_visible_columns()
  {
    return ['bank_track_number', 'bank_name', 'bank_swift_code', 'bank_is_active', 'account_system_name'];
  }

  function list()
  {
    // $table_columns = $this->grants->table_columns('approval',$this->hidden_columns);
    // $this->db->select($table_columns);
    // $this->db->join('approval_status','approval_status.approval_status_id=approval.fk_approval_status_id');
    // $this->db->join('approveable_item','approveable_item.approveable_item_id=approval.fk_approveable_item_id');
    //return $this->db->get('bank')->result_array();
  }

  function view()
  {
  }

  /**
   * transaction_validate_duplicates_columns
   * 
   * This is an override method. It lists all fields that needs to be checked if duplicate value
   * is about to be posted in the database.
   * 
   * @return Array
   */
  function transaction_validate_duplicates_columns()
  {
    return ['bank_swift_code'];
  }


  // function lookup_values()
  // {

  //   $lookup_values = [];

  //   if (!$this->session->system_admin) {
  //     $results = $this->db->select(array('account_system_id', 'account_system_name'))->get_where('account_system', array('account_system_code' => $this->session->user_account_system));

  //     if ($results->num_rows() > 0) {
  //       $lookup_values['account_system'] = $results->result_array();
  //     }
      
  //   } else {
  //     $results = $this->db->select(array('account_system_id', 'account_system_name'))->get('account_system');
  //     $lookup_values['account_system'] = $results->result_array();
  //   }

  //   return $lookup_values;
  // }

  // function render_view_page_data(){
  //   return ['Hello'];
  // }

  function list_table_where()
  {
    if (!$this->session->system_admin) {
      $this->db->where(array('account_system_code' => $this->session->user_account_system));
    }
  }


  // function transaction_validate_duplicates_columns(){
  //   return ['bank_name','bank_swift_code'];
  // }



}
