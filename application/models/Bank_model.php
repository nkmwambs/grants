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

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){

  }

  function lookup_tables(){
    
  }

  function detail_tables(){
    return ['bank_branch','office_bank'];
  }

  function list(){
    // $table_columns = $this->grants->table_columns('approval',$this->hidden_columns);
    // $this->db->select($table_columns);
    // $this->db->join('approval_status','approval_status.approval_status_id=approval.fk_approval_status_id');
    // $this->db->join('approveable_item','approveable_item.approveable_item_id=approval.fk_approveable_item_id');
    return $this->db->get('bank')->result_array();
  }

  function view(){

  }

 
}
