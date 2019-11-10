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

  /**
   * __construct
   * 
   * Intializer method
   * 
   * @return Void
   */
  function __construct(){
    parent::__construct();
  }

  /**
   * index
   * 
   * Index method
   * 
   * @return Void
   */
  function index(){

  }

/**
 * edit
 * 
 * This is the default edit method if not overwritten in the feature model
 * 
 * @param String $id : Hashed Id which is derived from the 3rd URI segment
 * @todo Use Transactions
 * @return String
 */
  function edit(String $id):String{

    $post_array = $this->input->post();

    extract($post_array);
    $id = hash_id($id,'decode');
    $data = $header;
    //print_r($header);
    //exit();
    $this->db->where(array($this->grants->primary_key_field($this->controller) => $id));
    $this->db->update($this->controller,$data);

    echo "Update completed";
  }

  /**
   * add
   * 
   * This is the default add method if not overwritten by a feature model. It automates the following:
   * - Action_before_insert post query manipulation
   * - Action_after_insert for any post create clean up/tidying up events
   * - Creates an approval record
   * - Automates the creation of both primary and foreign table inserts for master detail entries
   * 
   * @todo Implement Transaction
   * 
   * @return String
   */
  public function add(){

    // Asign the post input to $post_array
    $post_array = $this->input->post();

    // Check if there is a before insert method set in the feature model wrapped via grants model
    $post_array = $this->grants->action_before_insert($post_array);

    // Extract the post array into header and detail variables
    extract($post_array);

    // Determine if the input post has details or not by checking if the detail variable is set
    $post_has_detail = isset($detail)?true:false;

    // Check if the creation of the of the header and detail records requires an approval ticket
    $header_record_requires_approval = $this->approveable_item($this->controller);
    $detail_records_require_approval = $this->approveable_item($this->grants->dependant_table($this->controller));

    // Start a transaction
    //$this->db->trans_start();

    $approval = array();

    // Instatiate the $approval_id to 0
    $approval_id = 0;

    if($this->id){

       $decoded_hash_id = hash_id($this->id,'decode');

        $approval_id = $this->db->get_where($this->session->master_table,
        array($this->grants->primary_key_field($this->session->master_table) => $decoded_hash_id))->row()->fk_approval_id;

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
    $header_columns[$this->grants->name_field($this->controller)] = ucfirst($this->controller).' # '.$header_random;

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

      // The $detail_array is initial to hold the array of the for looped variable since the original $detail will be shifted
      $detail_array = $detail;

      // This is the array that will hold the insert batch array
      $detail_columns = array();

      // Get the first element of the detail array to be used to determine the number of detail rows
      $shifted_element = array_shift($detail);

      // Construct an insert batch array using the detail array
      for($i=0;$i<sizeof($shifted_element);$i++){
        foreach ($detail_array as $column => $values) {
          //if(strpos($column,'_name') == true && $column !== $this->grants->dependant_table($this->controller).'_name'){
          if( !$this->grants->is_lookup_tables_name_field($this->controller,$column) && 
              $this->grants->is_name_field($this->controller) ){    
            $column = 'fk_'.substr($column,0,-5).'_id';
          }
          $detail_columns[$i][$column] = $values[$i];

          $detail_random = record_prefix($this->grants->dependant_table($this->controller)).'-'.rand(1000,90000);
          $detail_columns[$i][$this->controller.'_detail_track_number'] = $detail_random;
          $detail_columns[$i]['fk_'.$this->controller.'_id'] = $header_id;

          // Only insert fk_status_if is the detail record requires approval
          //if($detail_records_require_approval){
              $detail_columns[$i]['fk_status_id'] = $this->initial_item_status($this->grants->dependant_table($this->controller));
          //}

          $detail['fk_approval_id'] = $approval_id;

          $detail_columns[$i][$this->controller.'_detail_created_date'] = date('Y-m-d');
          $detail_columns[$i][$this->controller.'_detail_created_by'] =  $this->session->user_id;
          $detail_columns[$i][$this->controller.'_detail_last_modified_by'] =  $this->session->user_id;
        }
      }
      //echo json_encode($detail_columns);
      // Insert the details using insert batch
      $this->db->insert_batch($this->grants->dependant_table($this->controller),$detail_columns);

    }

    // Insert attachments - Not important since an alternative means has been thought

    $this->upload_attachment($header_id);


    // End the transaction and determine if successful
    // if ($this->db->trans_status() === FALSE)
    // {
    //   echo get_phrase('insert_failed');
    //   //echo json_encode($request);
    // }else{

        // This runs after post is successful. It is defined in feature model wrapped via grants model
        if($this->grants->action_after_insert($post_array,$approval_id,$header_id)){
          echo get_phrase('insert_successful');
        }else{
          echo get_phrase('insert_successful_without_post_action');
        }
        
    //   //echo json_encode($detail);
    // }

  }

  /**
   * upload_attachment
   * @todo To be implemented later
   * @param String $record_id of the inserted header_id in the add method
   * 
   * @return void
   */
  private function upload_attachment($record_id){
    
  }

  /**
   * get_all_table_fields
   * 
   * A wrapper to CI table_exists method to check if a specified table exists in current database
   * and lists its field in an array or returns an empty array if not
   * 
   * @param String $table_name : Selected table
   * 
   * @return Array - Array of table fields
   */
  public function get_all_table_fields(String $table_name = ""):Array{
    $table = $table_name == ""?$this->controller:$table_name;
    return $this->db->table_exists($table)?$this->db->list_fields($table):array();
  }

  /**
   * table_fields_metadata
   * 
   * A field_data CI method wrapper to list field metadata 
   * 
   * @param String $table_name : Selected table
   * 
   * @return Array - Table fields metadata
   */
  public function table_fields_metadata($table_name = ""){
    $table = $table_name == ""?$this->controller:$table_name;
    return $this->db->table_exists($table)?$this->db->field_data($table):array();
  }

  /**
   * table_exists
   * 
   * A wrapper method table_exists CI DB object 
   * 
   * @param String : Selected table to check if exists
   * 
   * @return Boolean
   */
  public function table_exists(String $table_name = ""):bool{
    
    $table = $table_name == ""?$this->controller:$table_name;

    $table_exists = false;

    if($this->db->table_exists($table)){
      $table_exists = true;
    }

    return $table_exists;
  }

  function lookup_values($table){

    $result = $this->db->get($table)->result_array();

    $ids_array = array_column($result,$this->grants->primary_key_field($table));
    $value_array = array_column($result,$this->grants->name_field($table));

    return array_combine($ids_array,$value_array);
  }

  /**
   * list_select_columns
   * 
   * A method that returns an array of columns to be used as keys list_output method in the grants library.
   * It checks if the feature model has defined the list_table_visble_columns (Wrapped via grants library) 
   * or gets an array of all fields of the active table and
   * if finds any, adds to the fields array the name columns of the lookup tables as defined in the feature model
   * (Wrapped via grants library)
   *  Finally implements checking field access permissions 
   * 
   * @return Array : An array of columns to be used in the list method
   */
  public function list_select_columns(){

    // Check if the table has list_table_visible_columns not empty
    $list_table_visible_columns = $this->grants->list_table_visible_columns();
    $lookup_tables = $this->grants->lookup_tables();

    $get_all_table_fields = $this->get_all_table_fields();


    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
          $this->grants->is_history_tracking_field($this->controller,$get_all_table_field,'created_by') ||
           $this->grants->is_history_tracking_field($this->controller,$get_all_table_field,'last_modified_by') ||
           $this->grants->is_history_tracking_field($this->controller,$get_all_table_field,'deleted_at')
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
            if($this->grants->is_name_field($lookup_table,$lookup_table_column)){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    //return $visible_columns;
    return $this->control_column_visibility($this->controller,$visible_columns,'read');
  }


  /**
   * list
   * 
   * This method uses the list_select_columns returned array and creates table joins based on the 
   * lookup tables defined in the selected/active table lookup_tables feature model. This method has been 
   * used in the grants model to construct the list_query (A method switching between grants model database against the 
   * feature model results). The methods returns database results.
   * 
   * @todo Needs to be renamed to list_query to match a sibling method detail_list_query
   * 
   * @param Array $lookup_tables : An array of lookup tables as defined in the feature model lookup_tables method
   * @return Array : Database results
   */
  public function list(Array $lookup_tables):Array{
    $table = $this->controller;
    // Run column selector
    $this->db->select($this->list_select_columns());

    if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          $lookup_table_id = $this->grants->primary_key_field($lookup_table);
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }

    return $this->grants_get($table);

  }
  
  /**
   * master_view_select_columns
   * 
   * This method creates an array of selected columns to be used in the master_view method in this model.
   * The master_view method of this model is used to implement the grants master_view method which finally feeds
   * to the view_output method.
   * 
   * This methods utilizes a feature model wrapper method master_table_visible_columns from grant library which
   * checks if the feature model has specified columns to be used in the query of the master table of a view action page
   * or If not specified, it uses all fields from the selected table, ensuring that the foreign keys in this case are unset
   * In both cases above, it ensures that the name fields of the lookup tables are added to this array
   * 
   * It finally implements the fields access permission checks and returns the final array
   * 
   * @return Array - Select columns
   */
  private function master_view_select_columns(){

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

        if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
          foreach ($lookup_tables as $lookup_table) {
            
            // Add primary_keys for the lookup tables in the visible columns array
            $lookup_table_fields_data = $this->db->field_data($lookup_table);
            
            foreach($lookup_table_fields_data as $field_data){
              if($field_data->primary_key == 1){
                array_push($visible_columns,$field_data->name);
              }
            }

          }
        }    

    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(
              $lookup_table_column == $this->grants->primary_key_field($lookup_table) || $lookup_table_column == $this->grants->name_field($lookup_table)
            ){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    return $this->control_column_visibility($this->controller,$visible_columns,'read');

  }

  /**
   * detail_list_select_columns
   * 
   * It method is similar in use to the list_select_columns in its use only that it is used in creating select 
   * column array for the detail list table in a view action table.
   * 
   * It accepts an argument equal to the detail table name and check if the detail_list_table_visible_columns
   * (A feature model wrapper method) in the feature model returns any array or else uses all fields from
   * the selected table.
   * 
   * By default, all foreign keys, created_by, last_modified_by and deleted_at columns are unset in this method in the
   * case the columns are derived from all table fields and in this case, name fields from the lookup tables
   * are added to the array.
   * 
   * Field access permissions are applied to the array before it return
   * 
   * @param String : Name of the detail table
   * 
   * @return Array : Array of selected columns 
   */
  public function detail_list_select_columns($table){

    // Check if the table has list_table_visible_columns not empty
    $detail_list_table_visible_columns = $this->grants->detail_list_table_visible_columns($table);
    $lookup_tables = $this->grants->lookup_tables($table);

    $get_all_table_fields = $this->get_all_table_fields($table);

    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
           $this->grants->is_history_tracking_field($table,$get_all_table_field,'created_by') ||
           $this->grants->is_history_tracking_field($table,$get_all_table_field,'last_modified_by') ||
           $this->grants->is_history_tracking_field($table,$get_all_table_field,'deleted_at')
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
            if($this->grants->is_name_field($lookup_table,$lookup_table_column)){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    return $this->control_column_visibility($table,$visible_columns);
  }

  /**
   * master_select_columns
   * 
   * This method serves the view_output method in the grant model with keys of the master table in the view action pages
   * 
   * It tries to check in the feature model wrapper method master_table_visible_columns has been set or if not use the
   * all fields of the selected table. If using all fields from the table, it will unset the foreign keys and deleted_at fields and
   * ensure that the name fields of the lookup tables have been added to the select column array being created.
   * 
   * Finally, the method sanitizes the resultant array by enforcing the field access permissions
   * 
   * @return Array - Master table keys in the view action pages 
   */
  public function master_select_columns(){

    $table = $this->controller;

    // Check if the table has list_table_visible_columns not empty
    $master_table_visible_columns = $this->grants->master_table_visible_columns($table);
    $lookup_tables = $this->grants->lookup_tables($table);

    $get_all_table_fields = $this->get_all_table_fields($table);


    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
            $this->grants->is_history_tracking_field($table,$get_all_table_field,'deleted_at')
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
            if($this->grants->is_name_field($lookup_table,$lookup_table_column)){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    //return $visible_columns; // Come here
    return $this->control_column_visibility($table,$visible_columns,'read');

  }

  /**
   * detail_list_query
   * 
   * This method creates a query result to be used in the grants library detail_list_query method then in the 
   * detail_list_view and finally in the view_output. 
   * 
   * It takes the select column array of the detail_list_select_columns and implements of the detail table lookup tables
   * and then applies a where condition to only select records related to the selected master record.
   * 
   * @param String - Selected detail table
   * @return Array - Database result
   */
  function detail_list_query($table){

    $lookup_tables = $this->grants->lookup_tables($table);
    
    // Run column selector
    $this->db->select($this->detail_list_select_columns($table));

    if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          $lookup_table_id = $this->grants->primary_key_field($lookup_table);
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }

    // A condition to get records by the $id of the selected master table record (URI segment 3)
    $this->db->where(array($table.'.fk_'.$this->grants->primary_key_field($this->controller) => hash_id($this->uri->segment(3,0),'decode') ));

    return $this->grants_get($table);
  }


  function master_view(){

      $table = strtolower($this->controller);
    
      $model = $this->current_model;

      $select_columns = $this->master_view_select_columns();

      // Add created_by and last_modified_by fields if noe exists in columns selected
      if( !in_array($this->grants->history_tracking_field($table,'created_by'),$select_columns) || 
          !in_array($this->grants->history_tracking_field($table,'last_modified_by'),$select_columns)
        ){
        array_push($select_columns,$this->grants->history_tracking_field($table,'created_by'),
        $this->grants->history_tracking_field($table,'last_modified_by')); 
      }

      $this->db->select($select_columns);

      $lookup_tables = $this->grants->lookup_tables($table);
      //echo implode(',',$this->master_view_select_columns());
      //exit();

      if( is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {
            //Create table joins
            $lookup_table_id = $this->grants->primary_key_field($lookup_table);
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

      $data = (array)$this->db->get_where($table,array($this->grants->primary_key_field($table) => hash_id($this->uri->segment(3,0),'decode') ) )->row();
      
      // Get the name of the record creator
      $created_by = $data[$this->grants->history_tracking_field($table,'created_by')] >= 1? $this->db->select('CONCAT(`user_firstname`," ",`user_lastname`) as user_name')->get_where('user',
      array('user_id'=>$data[$this->grants->history_tracking_field($table,'created_by')]))->row()->user_name:get_phrase('creator_user_not_set');

      $data['created_by'] = $created_by;

      //Get the name of the last record modifier
      $last_modified_by = $data[$this->grants->history_tracking_field($table,'last_modified_by')] >= 1? $this->db->select('CONCAT(`user_firstname`," ",`user_lastname`) as user_name')->get_where('user',
      array('user_id'=>$data[$this->grants->history_tracking_field($table,'_last_modified_by')]))->row()->user_name:get_phrase('modifier_user_not_set');

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

  /**
   * master_multi_form_add_visible_columns
   * 
   * Lists in a array the selected columns/ fields in a master part of the multi form add action page
   * 
   * @return Array
   */
  function master_multi_form_add_visible_columns(): Array {

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

      return $this->control_column_visibility($this->controller,$visible_columns);
  }

  /**
   * control_column_visibility
   * 
   * This method checks if a field/column has permission to with a create label
   * @param $table String : Selected table
   * @param $visible_columns Array : Array of visible/ selected columns/ fields
   * @param $permission_label String : Can be create, update or read
   * 
   * @return Array
   */
  function control_column_visibility(String $table, Array $visible_columns, String $permission_label = 'create'): Array{
    $controlled_visible_columns = array();

    foreach($visible_columns as $column){
      if($this->grants->check_role_has_field_permission($table,$permission_label,$column)){
        $controlled_visible_columns[] = $column;
      }  
    }

    return $controlled_visible_columns;
  }

  /**
   * single_form_add_visible_columns
   * 
   * This is an array of the selected columns/fields to be used in SQL query in a single form add action page
   * 
   * @return Array
   */
  function single_form_add_visible_columns(): Array{

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

    return $this->control_column_visibility($this->controller,$visible_columns);
  }

  /**
   * edit_visible_columns
   * 
   * This method uses the edit_visible_columns wrapper method from grants library if set or 
   * all fields of the active table as select columns and the URI 3rd segement as where condition
   * to get the query results of the current record to be editted.
   * 
   * The foreign key fields and deleted at field is escaped and all the lookup name fields are exchanged
   * to their respective primary key fields.
   * 
   * @return Array - Database query result (Single row)
   */
  function edit_visible_columns():Object {
        
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

          foreach ($visible_columns as $column_index => $visible_column) {
            // Replace the lookup table name fields
            if( $this->grants->is_lookup_tables_name_field($table,$visible_column,true) !== null ){
              // Remove the lookup table name field. To be replaced with the primary key field of the 
              // lookup table
              unset($visible_columns[$column_index]);

              // Get the lookup table with the name field equals to $visible_column
              $lookup_table = $this->grants->is_lookup_tables_name_field($table,$visible_column,true);

              // Add to the visible column the primary key field of the lookup table above
              array_push($visible_columns,$this->grants->primary_key_field($lookup_table));
            }

          }

        }else{
    
          if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
            foreach ($lookup_tables as $lookup_table) {
    
              $lookup_table_columns = $this->get_all_table_fields($lookup_table);
    
              foreach ($lookup_table_columns as $lookup_table_column) {
                // Only include the name field of the look up table in the select columns
                if($this->grants->is_name_field($lookup_table,$lookup_table_column)){
                  array_push($visible_columns,$this->grants->primary_key_field($lookup_table));
                }
    
              }
            }
          }
    
        }

        if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
          foreach ($lookup_tables as $lookup_table) {
              $lookup_table_id = $this->grants->primary_key_field($lookup_table);
              $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
          }
        }

        $controlled_field_permission = $this->control_column_visibility($table, $visible_columns,'update');
        //print_r($controlled_field_permission);
        //exit('Edit visible columns');
        $this->db->select($controlled_field_permission);
        $this->db->where(array($this->grants->primary_key_field($table) => hash_id($this->id,'decode')));
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

    return $this->control_column_visibility($table,$visible_columns);//$visible_columns;

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


}
