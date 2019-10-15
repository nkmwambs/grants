<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Request_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'request'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
  }

  function index(){}

  public function lookup_tables(){
    //return array('center','approval','status');
    return array('center','approval');
  }

  public function detail_tables(){
    return array('request_detail');
  }

  public function master_table_visible_columns(){}

  public function master_table_hidden_columns(){}

  public function list_table_visible_columns(){}

  public function list_table_hidden_columns(){}

  public function detail_list_table_visible_columns(){}

  public function detail_list_table_hidden_columns(){}

  public function single_form_add_visible_columns(){}

  public function single_form_add_hidden_columns(){}

  public function master_multi_form_add_visible_columns(){
    return array('request_date','request_description','center_name');
  }

  public function detail_multi_form_add_visible_columns(){}

  public function master_multi_form_add_hidden_columns(){}

  public function detail_multi_form_add_hidden_columns(){}

  function detail_list(){}

  function master_view(){}

  public function list(){}

  public function view(){}

  // Access methods

  // public function show_add_button(){
  //   return false;
  // }


  //Insert Methods

  function add(){
    $post_array = $this->input->post();

    // Create a header and detail variables
    extract($post_array);

    $this->db->trans_start();

    // Initialize approval id. Important for items not approveable
    $approval_id = 0;

    // Create an approval if the request object is approveable item
    $approveable_item = $this->db->get_where('approveable_item',array('approveable_item_name'=>'request'));
    if($approveable_item->num_rows() > 0){
      $approval_random = 'APR-'.rand(1000,90000);
      $approval['approval_track_number'] = $approval_random;
      $approval['approval_name'] = 'Approval Ticket # '.$approval_random;
      $approval['fk_status_id'] = 1;
      $approval['approval_created_by'] = $this->session->user_id;
      $approval['approval_created_date'] = date('Y-m-d');
      $approval['approval_last_modified_by'] = $this->session->user_id;

      $this->db->insert('approval',$approval);

      $approval_id = $this->db->insert_id();
    }

    // Get elements for the request object
    $request_random = 'REQ-'.rand(1000,90000);
    $request['request_track_number'] = $request_random;
    $request['request_name'] = 'Request # '.$request_random;
    $request['fk_center_id'] = 1;
    $request['fk_approval_id'] = $approval_id;
    $request['request_date'] = $header['request_date'];
    $request['request_description'] = $header['request_description'];
    $request['request_created_date'] = date('Y-m-d');
    $request['request_created_by'] = $this->session->user_id;
    $request['request_last_modified_by'] = $this->session->user_id;

    $this->db->insert('request',$request);

    $request_id = $this->db->insert_id();

    // Get elements for the request_detail object
    if(isset($detail)){

      $request_detail = array();

      for($i=0;$i<sizeof($detail['request_detail_unit_cost']);$i++){
          foreach ($detail as $column => $values) {
            $request_detail[$i][$column] = $values[$i];
            $request_detail[$i]['request_detail_track_number'] = 'RQD-'.rand(1000,90000);
            $request_detail[$i]['fk_request_id'] = $request_id;
            $request_detail[$i]['fk_status_id'] = 1;
            $request_detail[$i]['request_detail_created_date'] = date('Y-m-d');
            $request_detail[$i]['request_detail_created_by'] =  $this->session->user_id;
            $request_detail[$i]['request_detail_last_modified_by'] =  $this->session->user_id;
          }
      }

      $this->db->insert_batch('request_detail',$request_detail);

    }

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
      echo get_phrase('insert_failed');
    }else{
      // Send an email to the approver here

      echo get_phrase('insert_successful');
      //echo json_encode($detail);
    }

  }

}
