<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Message_model extends MY_Model
{
  public $table = 'message'; // you MUST mention the table name
  public $dependant_table = 'message_detail';
  public $primary_key = 'message_id'; // you MUST mention the primary key

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){

  }

  public function lookup_tables(){
    return ['fk_approve_item_id'];
  }

 
  public function detail_tables(){
    return ['message_detail'];
  }

  function test(){
    return "Test";
  }

  function get_chat_messages($approve_item_name,$record_primary_key){

    $approve_item_id = $this->db->get_where('approve_item',
    array('approve_item_name'=>$approve_item_name))->row()->approve_item_id;


    $this->db->select(array(
      'fk_user_id as author',
      'message_detail_content as message',
      'message_detail_created_date as message_date'));
    
    $this->db->join('message','message.message_id=message_detail.fk_message_id');  
    $this->db->order_by('message_detail_created_date DESC');
    
    $chat_messages = $this->db->get_where('message_detail',
    array('fk_approve_item_id'=>$approve_item_id,
    'message_record_key'=>hash_id($this->id,'decode')))->result_array();
   
    return $chat_messages;
    
  }

}
