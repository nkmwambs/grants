<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Grants_model extends CI_Model
{

  /**
 * single_form_add_visible_columns
 * @var Array
 */
public $single_form_add_visible_columns = [];



  function __construct(){
    parent::__construct();
  }

  function index(){

  }

  function edit($id){

    $post_array = $this->input->post();

    extract($post_array);
    $id = hash_id($id,'decode');
    $data = $header;
    //print_r($header);
    //exit();
    $this->db->where(array($this->controller.'_id'=>$id));
    $this->db->update($this->controller,$data);

    echo "Update completed";
  }

  function add(){

    // There are 3 insert scenarios
    // Scenario 1: Master detail insert without a primary relationship and master requires approval
    // Scenario 2: Master detail insert without a primary relationship and master doesn't require approval
    // Scenario 3: Master detail insert with a primary relationship and master requires approval
    // Scenario 4: Master detail insert with a primary relationship and master doesn't require approval
    // Scenario 5: Single record insert that requires approval
    // Scenario 6: Single record insert that doesn't require approval

    // Asign the post input to $post_array
    $post_array = $this->input->post();

    // Extract the post array into header and detail variables
    extract($post_array);

    // Determine if the input post has details or not by checking if the detail variable is set
    $post_has_detail = isset($detail)?true:false;

    // Check if the creation of the of the header and detail records requires an approval ticket
    $header_record_requires_approval = $this->approveable_item($this->controller);
    $detail_records_require_approval = $this->approveable_item($this->controller.'_detail');

    // Start a transaction
    //$this->db->trans_start();

    $approval = array();

    // Instatiate the $approval_id to 0
    $approval_id = 0;

    if($this->id){

       $decoded_hash_id = hash_id($this->id,'decode');

        $approval_id = $this->db->get_where($this->session->master_table,
        array($this->session->master_table.'_id'=>$decoded_hash_id))->row()->fk_approval_id;

    }

    // Create the approval ticket if required by the header record

    //if($header_record_requires_approval && $approval_id == 0){

      $approval_random = record_prefix('Approval').'-'.rand(1000,90000);
      $approval['approval_track_number'] = $approval_random;
      $approval['approval_name'] = 'Approval Ticket # '.$approval_random;
      $approval['approval_created_by'] = $this->session->user_id;
      $approval['approval_created_date'] = date('Y-m-d');
      $approval['approval_last_modified_by'] = $this->session->user_id;
      $approval['fk_approve_item_id'] = $this->db->get_where('approve_item',
      array('approve_item_name'=>$this->controller))->row()->approve_item_id;

      $this->db->insert('approval',$approval);

      // Get the approval ticket insert id when created and reassign the initialized $approval_id
      $approval_id = $this->db->insert_id();

    //}
    //echo $this->id;
    //echo json_encode($approval);
     //exit(); 
    // This array will hold the array with values for header record insert
    $header_columns = array();

    // Insert the header record. Use the $approval_id to insert into the fk_approval_id field
    $header_random = record_prefix($this->controller).'-'.rand(1000,90000);
    $header_columns[$this->controller.'_track_number'] = $header_random;
    $header_columns[$this->controller.'_name'] = ucfirst($this->controller).' # '.$header_random;

    foreach ($header as $key => $value) {
      $header_columns[$key] = $value;
    }

    if(isset($this->session->master_table) && $this->session->master_table !== null){
      $header_columns['fk_'.$this->session->master_table.'_id'] = hash_id($this->id,'decode');
    }

    //if($header_record_requires_approval){
      $header_columns['fk_status_id'] = $this->initial_item_status($this->controller);
    //}else{
      //$header_columns['fk_status_id'] = 0;
    //}

    $header_columns['fk_approval_id'] = $approval_id;

    $header_columns[$this->controller.'_created_date'] = date('Y-m-d');
    $header_columns[$this->controller.'_created_by'] = $this->session->user_id;
    $header_columns[$this->controller.'_last_modified_by'] = $this->session->user_id;

    // Insert header record
    $this->db->insert($this->controller,$header_columns);
    //echo json_encode($header_columns);
    // Get the insert id of the header record inserted
    $header_id = $this->db->insert_id();

    // Proceed with inserting details after checking if $post_has_detail
    if($post_has_detail){

      // The $detail_array is initia to hold the array of the for looped variable since the original $detail will be shifted
      $detail_array = $detail;

      // This is the array that will hold the insert batch array
      $detail_columns = array();

      // Get the first element of the detail array to be used to determine the number of detail rows
      $shifted_element = array_shift($detail);

      // Construct an insert batch array using the detail array
      for($i=0;$i<sizeof($shifted_element);$i++){
        foreach ($detail_array as $column => $values) {
          if(strpos($column,'_name') == true && $column !== $this->controller.'_detail_name'){
              $column = 'fk_'.substr($column,0,-5).'_id';
          }
          $detail_columns[$i][$column] = $values[$i];

          $detail_random = record_prefix($this->controller.'_detail').'-'.rand(1000,90000);
          $detail_columns[$i][$this->controller.'_detail_track_number'] = $detail_random;
          $detail_columns[$i]['fk_'.$this->controller.'_id'] = $header_id;

          // Only insert fk_status_if is the detail record requires approval
          //if($detail_records_require_approval){
              $detail_columns[$i]['fk_status_id'] = $this->initial_item_status($this->controller.'_detail');
          //}

          $detail['fk_approval_id'] = $approval_id;

          $detail_columns[$i][$this->controller.'_detail_created_date'] = date('Y-m-d');
          $detail_columns[$i][$this->controller.'_detail_created_by'] =  $this->session->user_id;
          $detail_columns[$i][$this->controller.'_detail_last_modified_by'] =  $this->session->user_id;
        }
      }
      //echo json_encode($detail_columns);
      // Insert the details using insert batch
      $this->db->insert_batch($this->controller.'_detail',$detail_columns);

    }

    // Insert attachments

    $this->upload_attachment($header_id);


    // End the transaction and determine if successful
    // if ($this->db->trans_status() === FALSE)
    // {
    //   echo get_phrase('insert_failed');
    //   //echo json_encode($request);
    // }else{
    //   // Send an email to the approver here
    //
       echo get_phrase('insert_successful');
    //   //echo json_encode($detail);
    // }

  }

  function upload_attachment($record_id){
    
  }

  function get_all_table_fields($table_name = ""){
    $table = $table_name == ""?$this->controller:$table_name;
    return $this->db->table_exists($table)?$this->db->list_fields($table):array();
  }

  function table_fields_metadata($table_name = ""){
    $table = $table_name == ""?$this->controller:$table_name;
    return $this->db->field_data($table);
  }

  function lookup_values($table){

    $result = $this->db->get($table)->result_array();

    $ids_array = array_column($result,$table.'_id');
    $value_array = array_column($result,$table.'_name');

    return array_combine($ids_array,$value_array);
  }

  /** Refined methods **/

  function list_select_columns(){

    // Check if the table has list_table_visible_columns not empty
    $list_table_visible_columns = $this->grants->list_table_visible_columns();
    $lookup_tables = $this->grants->lookup_tables();

    $get_all_table_fields = $this->get_all_table_fields();


    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
          strpos($get_all_table_field,'_created_by') == true ||
           strpos($get_all_table_field,'_last_modified_by') == true ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }


    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($list_table_visible_columns) && count($list_table_visible_columns) > 0 ){
      $visible_columns = $list_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }



    return $visible_columns;

  }

  function list($lookup_tables){
    $table = $this->controller;
    // Run column selector
    $this->db->select($this->list_select_columns());

    if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          $lookup_table_id = $lookup_table.'_id';
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }

    return $this->grants_get($table);

  }

  function master_view_select_columns(){

    // Check if the table has list_table_visible_columns not empty
    $master_table_visible_columns = $this->grants->master_table_visible_columns();
    $lookup_tables = $this->grants->lookup_tables();

    $get_all_table_fields = $this->get_all_table_fields();


    foreach ($get_all_table_fields as $get_all_table_field) {
      //Unset foreign keys columns
      if( substr($get_all_table_field,0,3) == 'fk_'){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }
    }

    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($master_table_visible_columns) && count($master_table_visible_columns) > 0 ){
      $visible_columns = $master_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(
              $lookup_table_column == $lookup_table.'_id' || $lookup_table_column == $lookup_table.'_name'
            ){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }


    return $visible_columns;

  }

  function detail_list_select_columns($table){

    // Check if the table has list_table_visible_columns not empty
    $detail_list_table_visible_columns = $this->grants->detail_list_table_visible_columns($table);
    $lookup_tables = $this->grants->lookup_tables($table);

    $get_all_table_fields = $this->get_all_table_fields($table);

    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
          strpos($get_all_table_field,'_created_by') == true ||
           strpos($get_all_table_field,'_last_modified_by') == true ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }


    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($detail_list_table_visible_columns) && count($detail_list_table_visible_columns) > 0 ){
      $visible_columns = $detail_list_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    return $visible_columns;

  }


  function master_select_columns(){

    $table = $this->controller;

    // Check if the table has list_table_visible_columns not empty
    $master_table_visible_columns = $this->grants->master_table_visible_columns($table);
    $lookup_tables = $this->grants->lookup_tables($table);

    $get_all_table_fields = $this->get_all_table_fields($table);


    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }


    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($master_table_visible_columns) && count($master_table_visible_columns) > 0 ){
      $visible_columns = $master_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }



    return $visible_columns;

  }


  function detail_list_query($table){

    $lookup_tables = $this->grants->lookup_tables($table);
    //echo $table.'</br>';
    //print_r($lookup_tables);
    //exit();
    // Run column selector
    $this->db->select($this->detail_list_select_columns($table));
    //print_r($this->detail_list_select_columns($table));
    //exit();
    if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          $lookup_table_id = $lookup_table.'_id';
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }
    //print_r(array('fk_'.$this->controller.'_id'=> hash_id($this->uri->segment(3,0),'decode')));
    //exit();
    $this->db->where(array($table.'.fk_'.$this->controller.'_id'=> hash_id($this->uri->segment(3,0),'decode') ));
    //print_r($this->db->get($table)->result_array());
    //echo $this->controller;
    //exit();
    //print_r($this->grants_get($table));
    //exit;
    return $this->grants_get($table);
  }


  function master_view(){

      $table = strtolower($this->controller);
    
      $model = $this->current_model;

      $this->db->select($this->master_view_select_columns());

      $lookup_tables = $this->grants->lookup_tables($table);
      //echo implode(',',$this->master_view_select_columns());
      //exit();

      if( is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {
            //Create table joins
            $lookup_table_id = $lookup_table.'_id';
            $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
        }
      }


      $data = array();

      $library = $table.'_library';

      $this->load->library($library);

      if( method_exists($this->$library,'list_table_where') && 
          is_array($this->$library->list_table_where()) &&
          count($this->$library->list_table_where()) > 0
        ){
        $this->db->where($this->$library->list_table_where());
      }

      $data = (array)$this->db->get_where($table,array($table.'_id'=> hash_id($this->uri->segment(3,0),'decode') ) )->row();

      // Get the name of the record creator
      $created_by = $data[$table.'_created_by'] >= 1? $this->db->select('CONCAT(`user_firstname`," ",`user_lastname`) as user_name')->get_where('user',
      array('user_id'=>$data[$table.'_created_by']))->row()->user_name:get_phrase('creator_user_not_set');

      $data['created_by'] = $created_by;

      //Get the name of the last record modifier
      $last_modified_by = $data[$table.'_last_modified_by'] >= 1? $this->db->select('CONCAT(`user_firstname`," ",`user_lastname`) as user_name')->get_where('user',
      array('user_id'=>$data[$table.'_last_modified_by']))->row()->user_name:get_phrase('modifier_user_not_set');

      $data['last_modified_by'] = $last_modified_by;

      return $data;
  }

  function grants_get($table){

    $library = $table.'_library';

    $this->load->library($library);

    if(method_exists($this->$library,'list_table_where') && 
        is_array($this->$library->list_table_where()) && 
          count($this->$library->list_table_where()) > 0
      ){
      $this->db->where($this->$library->list_table_where());
    }

    return $this->db->get($table)->result_array();
  }

  function grants_get_row($table){

    $library = $table.'_library';

    $this->load->library($library);

    if(method_exists($this->$library,'list_table_where') && 
        is_array($this->$library->list_table_where()) && 
          count($this->$library->list_table_where()) > 0
      ){
      $this->db->where($this->$library->list_table_where());
    }

    return $this->db->get($table)->row();
  }

  function master_multi_form_add_visible_columns(){

    // Check if the table has list_table_visible_columns not empty
    $master_table_visible_columns = $this->grants->master_multi_form_add_visible_columns();
    $lookup_tables = $this->grants->lookup_tables();

    $get_all_table_fields = $this->get_all_table_fields();

    foreach ($get_all_table_fields as $get_all_table_field) {
      //Unset foreign keys columns, created_by and last_modified_by columns
      if( substr($get_all_table_field,0,3) == 'fk_' ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }
    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($master_table_visible_columns) && count($master_table_visible_columns) > 0 ){
      $visible_columns = $master_table_visible_columns;
    }else{

      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }

    }

    return $visible_columns;
  }

  function single_form_add_visible_columns(){

    // Check if the table has list_table_visible_columns not empty
    $master_table_visible_columns = $this->grants->single_form_add_visible_columns();
    $lookup_tables = $this->grants->lookup_tables();

    $get_all_table_fields = $this->get_all_table_fields();

    foreach ($get_all_table_fields as $get_all_table_field) {
      //Unset foreign keys columns, created_by and last_modified_by columns
      if( substr($get_all_table_field,0,3) == 'fk_' ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }
    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($master_table_visible_columns) && count($master_table_visible_columns) > 0 ){
      $visible_columns = $master_table_visible_columns;
    }else{

      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }

    }
    //print_r($visible_columns);
    //exit();
    return $visible_columns;
  }

  function edit_visible_columns(){
        
        $table = $this->controller;

        // Check if the table has list_table_visible_columns not empty
        $edit_visible_columns = $this->grants->edit_visible_columns();
        $lookup_tables = $this->grants->lookup_tables();
    
        $get_all_table_fields = $this->get_all_table_fields();
    
        foreach ($get_all_table_fields as $get_all_table_field) {
          //Unset foreign keys columns, created_by and last_modified_by columns
          if( substr($get_all_table_field,0,3) == 'fk_' ||
               strpos($get_all_table_field,'_deleted_at') == true
            ){
            unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
          }
        }
    
    
        $visible_columns = $get_all_table_fields;
        $lookup_columns = array();
    
        if(is_array($edit_visible_columns) && count($edit_visible_columns) > 0 ){
          $visible_columns = $edit_visible_columns;
        }else{
    
          if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
            foreach ($lookup_tables as $lookup_table) {
    
              $lookup_table_columns = $this->get_all_table_fields($lookup_table);
    
              foreach ($lookup_table_columns as $lookup_table_column) {
                // Only include the name field of the look up table in the select columns
                if(strpos($lookup_table_column,'_name') == true){
                  //array_push($visible_columns,$lookup_table_column);
                  array_push($visible_columns,substr($lookup_table_column,0,-5).'_id');
                }
    
              }
            }
          }
    
        }

        if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
          foreach ($lookup_tables as $lookup_table) {
              $lookup_table_id = $lookup_table.'_id';
              $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
          }
        }
    
        $this->db->select($visible_columns);
        $this->db->where(array($table.'_id'=>hash_id($this->id,'decode')));
        return $this->grants_get_row($table);
  }

  function detail_multi_form_add_visible_columns($table){

    // Check if the table has list_table_visible_columns not empty
    $detail_table_visible_columns = $this->grants->detail_multi_form_add_visible_columns($table);
    $lookup_tables = $this->grants->lookup_tables($table);

    $get_all_table_fields = $this->get_all_table_fields($table);

    foreach ($get_all_table_fields as $get_all_table_field) {
      //Unset foreign keys columns, created_by and last_modified_by columns
      if( substr($get_all_table_field,0,3) == 'fk_' ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }
    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($detail_table_visible_columns) && count($detail_table_visible_columns) > 0 ){
      $visible_columns = $detail_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    return $visible_columns;

  }

  function approveable_item($approveable_item_name = ""){

    $approveable_item_name = $approveable_item_name == ""?$this->controller:$approveable_item_name;

    $approveable_item = $this->db->get_where('approve_item',
    array('approve_item_name'=>$approveable_item_name,'approve_item_is_active'=>1))->num_rows();

    $approveable_item_flag = false;

    if($approveable_item > 0){
      $approveable_item_flag = true;
    }

    return $approveable_item_flag;
  }

  // This give the initial approval status when inserting a record

  function initial_item_status($table_name = ""){

    $table = $table_name == "" ? $this->controller : $table_name;

    $approveable_item = $this->db->get_where('approve_item',
    array('approve_item_name'=>$table));

    $status_id = 0;

    if($approveable_item->num_rows() > 0 ){
      $approveable_item_id = $approveable_item->row()->approve_item_id;
      $initial_status = $this->db->get_where('status',array('fk_approve_item_id'=>$approveable_item_id,
      'status_approval_sequence'=>1));

      if($initial_status->num_rows() > 0 ){
          $status_id = $initial_status->row()->status_id;
      }

    }

    return $status_id;

  }

  function get_status_id($table,$primary_key){
    $fk_status_id = 0;

    $record_object = $this->db->get_where($table,array($table.'_id'=>$primary_key));

    if($record_object->num_rows()>0 && array_key_exists('fk_status_id',(array)$record_object->row() ) ){
     $fk_status_id = $this->db->get_where($table,array($table.'_id'=>$primary_key))->row()->fk_status_id;
    }

    return $fk_status_id;
  }

/**
* The method produces an array of the valid approval status ids for the listed items
*
**/

  function display_approver_status_action($item_status, $table_name = ""){

    $user_role_id = $this->session->role_id;;

    $table = $table_name == "" ? $this->controller : $table_name;

    $approveable_item = $this->db->get_where('approve_item',
    array('approve_item_name'=>$table,'approve_item_is_active'=>1));

    //$label = array();
    $raw_labels = array();

    if($approveable_item->num_rows() > 0 ){
      $approveable_item_id = $approveable_item->row()->approve_item_id;

      $current_status_object = $this->db->get_where('status',array('status_id'=>$item_status));

      if($current_status_object->num_rows()>0){
          $current_status_approval_direction = $current_status_object->row()->status_approval_direction;
          $current_status_approval_sequence = $current_status_object->row()->status_approval_sequence;

          if($current_status_approval_direction == 1 || $current_status_approval_direction == 0){
            //Point to the next status_action_label of status_approval_direction 1 or -1
            $next_status_approval_sequence_object = $this->db->get_where('status',
            array('fk_approve_item_id'=>$approveable_item_id,
            'status_approval_sequence > '=>$current_status_approval_sequence));

            if($next_status_approval_sequence_object->num_rows()>0){

              $next_status_approval_sequence = $next_status_approval_sequence_object->row()->status_approval_sequence;

              $this->db->where_in('status_approval_direction',array(1,-1));
              $this->db->select(array('status_id','status_action_label'));
              $this->db->join('status_role','status_role.fk_status_id=status.status_id');
              $raw_labels = $this->db->get_where('status',
              array('fk_approve_item_id'=>$approveable_item_id,
              'status_approval_sequence'=>$next_status_approval_sequence,'status_role.fk_role_id'=>$user_role_id))->result_array();

            }

          }elseif ($current_status_approval_direction == -1) {
            //Remain at the same status but point to the status_action_label of status_approval_direction 0
             $status_approval_sequence = $current_status_object->row()->status_approval_sequence;

             $this->db->where(array('status_approval_direction'=>0));
             $this->db->select(array('status_id','status_action_label'));
             $this->db->join('status_role','status_role.fk_status_id=status.status_id');
             $raw_labels = $this->db->get_where('status',
             array('fk_approve_item_id'=>$approveable_item_id,
             'status_approval_sequence'=>$current_status_approval_sequence,'status_role.fk_role_id'=>$user_role_id))->result_array();
          }

      }

      $columned_labels = array();
      // Finally filter the resultant array to only retain the correct status_action_label based on the user role id
      if(is_array($raw_labels) && count($raw_labels) > 0){
        $status_ids_array = array_column($raw_labels,'status_id');
        $labels_array = array_column($raw_labels,'status_action_label');

        $columned_labels = array_combine($status_ids_array,$labels_array);
      }

      return $columned_labels;


    }

  }

function center_start_date($center_id){
   return $this->db->get_where('center',array('center_id'=>$center_id))->row()->center_start_date;
}

// function role_fields_permission(){
//   $permission = array();

//   // Permission type 2 = Field Access, 1 = Pages Acess

//   //$permission['departmentmanager']['Bank']['bank_swift_code'] = 1550;
//   $this->db->join('permission','permission.permission_id=role_permission.fk_permission_id');
//   $this->db->get_where('role_permission',
//   array('fk_role_id'=>$this->session->role_id,'permission.permission_type'=>2));
// }

}
