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

  $post_array = $this->grants->action_before_edit($post_array);
 
  $this->db->trans_begin();
  $this->db->where(array($this->grants->primary_key_field($this->controller) => $id));
  $this->db->update($this->controller,$data);

  if ($this->db->trans_status() === FALSE)
  {
          $this->db->trans_rollback();
          return "Update not successful";
  }
  else
  {
          $this->db->trans_commit();
          return "Update completed";
  }

}

function check_item_requires_approval($approveable_item){
  return $this->approveable_item($approveable_item);
}

function insert_approval_record($approveable_item){

  $is_approveable_item = $this->approveable_item($approveable_item);
  $insert_id = 0;

  if($is_approveable_item){
    $approval_random = record_prefix('Approval').'-'.rand(1000,90000);
    $approval['approval_track_number'] = $approval_random;
    $approval['approval_name'] = 'Approval Ticket # '.$approval_random;
    $approval['approval_created_by'] = 1;$this->session->user_id?$this->session->user_id:1;
    $approval['approval_created_date'] = date('Y-m-d');
    $approval['approval_last_modified_by'] = 1;$this->session->user_id?$this->session->user_id:1;
    $approval['fk_approve_item_id'] = $this->db->get_where('approve_item',array('approve_item_name'=>strtolower($approveable_item)))->row()->approve_item_id;
    $approval['fk_status_id'] = $this->initial_item_status($approveable_item);

    $this->db->insert('approval',$approval);

    $insert_id = $this->db->insert_id();
  }

  return $insert_id;
  
}

function generate_item_track_number_and_name($approveable_item){
   $header_random = record_prefix($approveable_item).'-'.rand(1000,90000);
    $columns[$approveable_item.'_track_number'] = $header_random;
    $columns[$approveable_item.'_name'] = ucfirst($approveable_item).' # '.$header_random;

    return $columns;
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

    // Check if there is a before insert method set in the feature model wrapped via grants model
    $post_array = $this->grants->action_before_insert($post_array);

    // Extract the post array into header and detail variables
    extract($post_array);

    // Determine if the input post has details or not by checking if the detail variable is set
    $post_has_detail = isset($detail)?true:false;

    // Check if the creation of the of the header and detail records requires an approval ticket
    $header_record_requires_approval = $this->approveable_item($this->controller);
    //$detail_records_require_approval = $this->approveable_item($this->controller.'_detail');
    $detail_records_require_approval = $this->approveable_item($this->grants->dependant_table($this->controller));

    // Start a transaction
    $this->db->trans_begin();

    $approval = array();
    $details = array();

    if($this->id){

       $decoded_hash_id = hash_id($this->id,'decode');

        $approval_id = $this->db->get_where($this->session->master_table,
        array($this->session->master_table.'_id'=>$decoded_hash_id))->row()->fk_approval_id;

    }

    // Create the approval ticket if required by the header record
    $approval_id  = $this->insert_approval_record($this->controller);

    // This array will hold the array with values for header record insert
    $header_columns = array();

    // Insert the header record. Use the $approval_id to insert into the fk_approval_id field
    $header_random = record_prefix($this->controller).'-'.rand(1000,90000);
    $header_columns[$this->controller.'_track_number'] = $header_random;
    $header_columns[$this->controller.'_name'] = $this->input->post($this->controller.'_name') != ""?$this->input->post($this->controller.'_name'):ucfirst($this->controller).' # '.$header_random;

    foreach ($header as $key => $value) {
      $header_columns[$key] = $value;
    }

    if(isset($this->session->master_table) && $this->session->master_table !== null){
      $header_columns['fk_'.strtolower($this->session->master_table).'_id'] = hash_id($this->id,'decode');
    }

    $header_columns['fk_status_id'] = $this->initial_item_status($this->controller);

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
      
      // Table set up. Add missing mandatory fields and status
      //$this->grants->table_setup($this->grants->dependant_table($this->controller));

      // The $detail_array is initial to hold the array of the for looped variable since the original $detail will be shifted
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
      $details = $detail_columns;


      // Insert the details using insert batch
      $this->db->insert_batch($this->grants->dependant_table($this->controller),$detail_columns);
      

    }

    // End the transaction and determine if successful
    //$this->db->trans_complete();
    
    if ($this->db->trans_status() === FALSE)
    {       
            $this->db->trans_rollback();
            // return json_encode($header_columns);
            //return "Insert not successful";
            return get_phrase('insert_failed');
    }
    else
    {
            $this->db->trans_commit();

            $this->grants->action_after_insert($post_array,$approval_id,$header_id);

            // This runs after post is successful. It is defined in feature model wrapped via grants model
          //if($this->grants->action_after_insert($post_array,$approval_id,$header_id)){
            return get_phrase('insert_successful');
          //}else{
            //return get_phrase('insert_successful_without_post_action');
          //}
    }

  }

  /**
   * upload_attachment
   * 
   * @todo - not yet in use. Intended to be used by view action pages
   * @param String - Encoded primary key of the active record
   * @return void
   */
  function upload_attachment($record_id){
    
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
    //$this->controller = 'dashboard';
    $table = $table_name == ""?$this->controller:$table_name;
    return $this->db->table_exists($table)?$this->db->list_fields($table):array();
  }

  function lookup_tables($table_name = ""){
    //return $this->my_model->lookup_tables();

      if($table_name == '') $table_name = $this->controller;
  
      $fields = $this->grants_model->get_all_table_fields($table_name);
    
      $foreign_tables_array_padded_with_false = array_map(function($elem){
        return substr($elem,0,3) =='fk_'?substr($elem,3,-3):false;
      },$fields);

      // Prevent listing false values and status or approval tables for lookup. 
      // Add status_name and approval_name to the correct visible_columns method in models to see these fields in a page
      $foreign_tables_array = array_filter($foreign_tables_array_padded_with_false,function($elem){
        return $elem?$elem:false;
      });

      return $foreign_tables_array;
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

  /**
   * lookup_values
   * 
   * Create an array used when creating select field options as shown in the grants library detail_row_fields method
   * 
   * @todo - there is an error here when you specify the return type the insert row event in the 
   * multi_form_add action views does not work
   * 
   * @param String $table - Selected table
   * @return Array - Lookup options array
   */
  function lookup_values(String $table) {

    $table = strtolower($table);

    if( is_array($this->grants->lookup_values_where($table)) && 
        count($this->grants->lookup_values_where($table)) > 0)
    {
      //$this->create_table_join_statement(strtolower($this->controller),$this->grants->lookup_tables($this->controller));
      //$this->db->where($this->grants->lookup_values_where($table));
    }

    $result = $this->db->get($table)->result_array();

    $ids_array = array_column($result,$this->grants->primary_key_field($table));
    $value_array = array_column($result,$this->grants->name_field($table));

    return array_combine($ids_array,$value_array);
  }

  function initialize_db_schema(){
    if(file_exists('database/blank_db.sql')){
      $sql = file_get_contents('database/blank_db.sql');
      $exploded_sql = explode(';',$sql);

      foreach($exploded_sql as $query){
        $this->db->query($query);
      }
   
    }
  }
  
  function populate_initial_table_data(){

    $initialize_tables = $this->config->item('setup_initialized_tables');

    $foreign_keys_values = [];

    foreach($initialize_tables as $initialize_table){

      if(!$this->db->table_exists($initialize_table)) continue;

      $model = $initialize_table.'_model';

      $this->load->model($model);
      
      if(method_exists($this->$model,'intialize_table')){
        $insert_id = $this->$model->intialize_table($foreign_keys_values);

        $foreign_keys_values[$initialize_table.'_id'] = $insert_id;
      }

    }

    if(count($foreign_keys_values) > 0){
      return true;
    }else{
      return false;
    }

  }

  /**
   * create_context_tables
   * 
   * This method creates new context tables and files if not exists
   * 
   * @return Array
   */

  function create_context_tables(){

    $this->load->dbforge();

    $context_definitions = $this->config->item('context_definitions');

    $reversed_array_reverse = array_reverse($context_definitions);

    $count = count($reversed_array_reverse);

    $fields = [];
    $user_fields = [];

    $app_name = 'Core';
    
    // Unlink old context files - models and libraries
    $this->unlink_old_context_files($app_name);

    foreach($reversed_array_reverse as $context_definition){

      // Create a context schema table
      
      $context_rel_field = $count == count($reversed_array_reverse)?"fk_context_global_id":"fk_context_".array_shift($reversed_array_reverse)."_id";

      if(!$this->db->table_exists('context_'.$context_definition)){
        $fields[$context_definition] = [
          "context_".$context_definition."_id int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT",
          "context_".$context_definition."_track_number VARCHAR(100) NULL",
          "context_".$context_definition."_name VARCHAR(100) NULL",
          "context_".$context_definition."_description VARCHAR(100) NULL",
          "fk_office_id VARCHAR(100) NOT NULL",
          "fk_context_definition_id VARCHAR(100) NULL",
          $context_rel_field." INT(100) NULL",
          "context_".$context_definition."_created_date DATE NULL DEFAULT '0000-00-00'",
          "context_".$context_definition."_created_by INT(100) NULL",
          "context_".$context_definition."_last_modified_date TIMESTAMP NULL DEFAULT '0000-00-00'",
          "context_".$context_definition."_last_modified_by INT(100) NULL",
          "fk_approval_id INT(100) NULL",
          "fk_status_id INT(100) NULL"
        ];
        
        //$this->dbforge->add_key("context_".$context_definition."_id", TRUE);  
        foreach($fields[$context_definition] as $fld_def){
          $this->dbforge->add_field($fld_def);
        }

        $this->dbforge->create_table('context_'.$context_definition);

        
      }

      // Create a context user schema table
      if(!$this->db->table_exists('context_'.$context_definition.'_user')){

        $user_fields[$context_definition] = [
          "context_".$context_definition."_user_id int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT",
          "context_".$context_definition."_user_track_number VARCHAR(100) NULL",
          "context_".$context_definition."_user_name VARCHAR(100) NULL",
          'fk_context_'.$context_definition.'_id INT(100) NOT NULL',
          'fk_user_id INT(100) NOT NULL',
          'fk_designation_id INT(100) NOT NULL',
          'context_region_user_is_active INT(100) NOT NULL',
          'context_'.$context_definition.'_user_created_by INT(100) NOT NULL',
          'context_'.$context_definition.'_user_created_date DATE NULL DEFAULT "0000-00-00"',
          'context_'.$context_definition.'_user_last_modified_date TIMESTAMP NULL DEFAULT "0000-00-00"',
          'context_'.$context_definition.'_user_last_modified_by INT(100) NOT NULL',
          'fk_approval_id INT(100) NULL',
          'fk_status_id INT(100) NULL',
        ];

        foreach($user_fields[$context_definition] as $user_fld_def){
          $this->dbforge->add_field($user_fld_def);
        }

        //$this->dbforge->add_key("context_".$context_definition."_user_id", TRUE);
        $this->dbforge->create_table('context_'.$context_definition.'_user');
      }

      // Create context models and libraries files
      $this->create_context_files('context_'.$context_definition,$app_name);

      // Create context models and libraries files
      $this->create_context_files('context_'.$context_definition.'_user',$app_name);
      
      $count--;
    }
    

    return ['context_fields'=>$fields,'user_fields'=>$user_fields];
  }
  
  function create_context_files($table_name,$app_name){

    // Create new models and libraries
    $table_specs['lookup_tables'] = $this->lookup_tables($table_name);
    $this->grants->create_missing_system_files_methods($table_name,$app_name,$table_specs);
  }

  function unlink_old_context_files($app_name){
    $controllers_path = APPPATH.'controllers'.DIRECTORY_SEPARATOR;
    $models_path = APPPATH.'third_party'.DIRECTORY_SEPARATOR.'Packages'.DIRECTORY_SEPARATOR.ucfirst($app_name).DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR;
    $libararies_path = APPPATH.'third_party'.DIRECTORY_SEPARATOR.'Packages'.DIRECTORY_SEPARATOR.ucfirst($app_name).DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR; 
    
    $path_array = [$controllers_path,$models_path,$libararies_path];

    foreach($path_array as $path){
      $files_array = directory_iterator($path);
      $context_files = $this->filter_context_files(array_keys($files_array));

      foreach($context_files as $file){
        unlink($path.DIRECTORY_SEPARATOR.$file);
      }
    }
       
  }

  function filter_context_files($files){
    $context_tables = array_filter($files,function($file){
      return substr($file,0,8) == 'Context_' && !strpos($file,'definition',8) &&  !strpos($file,'global',8) ?$file:false;
    }); 

    return $context_tables;
  }

  function insert_status_for_approveable_item($approve_item_name){

    if($approve_item_name != ""){
      $this->db->trans_start();

      $user_id = $this->session->userdata('user_id')?$this->session->user_id:1;

    // Check if the table is in the approveable items table if not create it
     $approve_item_id = $this->insert_missing_approveable_item($approve_item_name);
      
      $account_systems_obj = $this->db->get('account_system');

      if($account_systems_obj->num_rows() > 0){

        $account_systems = $account_systems_obj->result_array();

        foreach($account_systems as $account_system){

          $approval_flow_obj = $this->db->get_where('approval_flow',
            array('fk_approve_item_id'=>$approve_item_id,
            'fk_account_system_id'=>$account_system['account_system_id']));

          $approval_flow_id = 0;

            if($approval_flow_obj->num_rows() == 0){
               $approval_flow_id = $this->insert_approval_flow($account_system, $approve_item_id, $approve_item_name, $user_id);
            }else{
              $approval_flow_id = $approval_flow_obj->row()->approval_flow_id;
            }

            // Insert the new status
           
            $status = $this->db->get_where('status',array('fk_approval_flow_id'=>$approval_flow_id,'status_approval_sequence'=>1));
            
            if($status->num_rows() == 0){

              $this->insert_new_status($approval_flow_id,$user_id);  
            
            }
        }
        
      }
      
      $this->db->trans_complete();

      if($this->db->trans_status() == false){
        $message = "Error occurred when creating missing status";
        show_error($message,500,'An Error As Encountered');
        return false;
      }else{
        return true;
      }
    }else{
      return false;
    }
    
  
  }

  function insert_approval_flow($account_system, $approve_item_id, $approve_item_name, $user_id){
    $approval_flow_data['approval_flow_track_number'] = $this->generate_item_track_number_and_name('approval_flow')['approval_flow_track_number'];
    $approval_flow_data['approval_flow_name'] = $account_system['account_system_name'].' '.str_replace("_"," ",$approve_item_name).' workflow';
    $approval_flow_data['fk_approve_item_id'] = $approve_item_id;
    $approval_flow_data['fk_account_system_id'] = $account_system['account_system_id'];

    $approval_flow_data['approval_flow_created_by'] = $user_id;
    $approval_flow_data['approval_flow_created_date'] = date('Y-m-d');
    $approval_flow_data['approval_flow_last_modified_by'] = $user_id;

    $this->db->insert('approval_flow',$approval_flow_data);
    
    return $this->db->insert_id();
  }

  function insert_new_status($approval_flow_id,$user_id){
    $status_data['status_track_number'] = $this->generate_item_track_number_and_name('status')['status_track_number'];
    $status_data['fk_approval_flow_id'] = $approval_flow_id;
    $status_data['status_name'] = get_phrase('new');
    $status_data['status_approval_sequence'] = 1;
    $status_data['status_approval_direction'] = 1;
    $status_data['status_is_requiring_approver_action'] = 0;
    $status_data['status_backflow_sequence'] = 0;
              
    // Get the new_status_role_id if set otherwise use the logged in user role id
    $new_status_default_role = $this->db->get_where('role',array('role_is_new_status_default'=>1));
    $role_id = $new_status_default_role->num_rows() > 0 ? $new_status_default_role->row()->role_id : 1;
             
    $status_data['fk_role_id'] = $role_id;
    $status_data['status_created_date'] =  date('Y-m-d');
    $status_data['status_created_by'] = $user_id;
    $status_data['status_last_modified_by']  = $user_id;
              
    $this->db->insert('status',$status_data); 
    
    return $this->db->insert_id();
  }

  function insert_status_if_missing($approve_item_name){

    
    $this->insert_status_for_approveable_item($approve_item_name);

    // Check if has dependant table

    if($this->grants->has_dependant_table($approve_item_name)){
      $this->mandatory_fields($this->grants->dependant_table($approve_item_name));
      $this->insert_status_for_approveable_item($this->grants->dependant_table($approve_item_name));    
    }

}


  /**
 * mandatory_fields
 * 
 * This method adds mandatory fields in a table. All tables should contain the following fields:
 * xxxx_created_date, xxxx_created_by, xxxx_last_modified_date, xxxx_last_modified_by, fk_approval_id and
 * fk_status_id
 * 
 * Again the approve_item table should contain the name of the table as approvable item and create a default 
 * new status of this table in the status table. Give this new status an status_approval_sequence of 1
 * 
 * @param $table String : The selected table
 * 
 * @return Bool
 */

function insert_missing_approveable_item($table){

  $approve_items = $this->db->get_where('approve_item',array('approve_item_name'=>$table));

  $approve_item_id = 0;

  if($approve_items->num_rows() == 0){
    $data['approve_item_track_number'] = $this->generate_item_track_number_and_name('approve_item')['approve_item_track_number'];
    $data['approve_item_name'] = $table;
    $data['approve_item_is_active'] = 0;
    $data['approve_item_created_date'] = date('Y-m-d');
    $data['approve_item_created_by'] = 1;//$this->session->user_id;
    $data['approve_item_last_modified_by'] = 1;//$this->session->user_id;

    //$approve_item_data_to_insert = $this->merge_with_history_fields('approve_item',$data,false);
    $this->db->insert('approve_item',$data);

    $approve_item_id = $this->db->insert_id();

  }else{
    $approve_item_id = $approve_items->row()->approve_item_id;
  }

  return $approve_item_id;
}

function mandatory_fields(String $table): void{

//  $this->db->trans_start();

  if($table!=='approval' && $table!=='approval_flow'){
      //Mandatory Fields: created_by, created_date,last_modified_by,last_modified_date,fk_approval_id,fk_status_id
      $mandatory_fields = array($table.'_created_date',$table.'_created_by',$table.'_last_modified_by',
      $table.'_last_modified_date','fk_approval_id','fk_status_id');
  }elseif($table == 'approval'){
      $mandatory_fields = array($table.'_created_date',$table.'_created_by',$table.'_last_modified_by',
      $table.'_last_modified_date','fk_status_id');
  }elseif($table == 'approval_flow'){
      $mandatory_fields = array($table.'_created_date',$table.'_created_by',$table.'_last_modified_by',
      $table.'_last_modified_date');
  }
      // Check if the mandatory fields exists in the listed table and if not alter the table by 
      // adding a column with default value as the newly inserted status_id

      $fields_to_add = array();

      $table_fields = $this->get_all_table_fields($table);

      foreach ($mandatory_fields as $mandatory_field) {
        if(!in_array($mandatory_field,$table_fields)) {

          if(substr($mandatory_field,0,3) == 'fk_' || substr($mandatory_field,-3,3) == '_by'){
            $fields_to_add[$mandatory_field]['type'] = 'INT';
            $fields_to_add[$mandatory_field]['constraint'] = '100';
          }elseif(strpos($mandatory_field,'_date') == true){
            $fields_to_add[$mandatory_field]['type'] = 'date';
            //$fields_to_add[$mandatory_field]['constraint'] = '100';
          }else{
            $fields_to_add[$mandatory_field]['type'] = 'varchar';
            $fields_to_add[$mandatory_field]['constraint'] = '100';
          }

        }
      }

      if(count($fields_to_add) > 0){
        $this->load->dbforge();
        $this->dbforge->add_column($table, $fields_to_add);
      }
  

  // $this->db->trans_complete();

  // if($this->db->trans_start() == false){
  //   return false;
  // }else{
  //   return true;
  // }
}

/**
 * create_table_join_statement
 * 
 * This method creates join statements of a CI query. It uses the primary tbale as first arg
 * and an array of its Secondary tables as derived from the primary table model
 * 
 * @param String $table - This is the primary table
 * @param Array $lookup_tables - This is an array of secondary tables
 * 
 * @return Mixed 
 */
function create_table_join_statement(String $table,Array $lookup_tables){
  if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
    foreach ($lookup_tables as $lookup_table) {
        $lookup_table_id = $this->grants->primary_key_field($lookup_table);
        $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
    }
  }

}

function create_table_join_statement_with_depth($base_table,$labeled_tables){
 
//https://codeigniter.com/userguide3/database/query_builder.html
//$this->db->reset_query();

 $join_array = $this->_create_table_join_statement_with_depth($base_table,$labeled_tables);
 
  foreach($join_array as $join_tables_depth){
    foreach($join_tables_depth as $primary_table => $join_tables){
        foreach($join_tables as $join_table){
            $this->db->join($join_table,$join_table.'.'.$join_table.'_id='.$primary_table.'.fk_'.$join_table.'_id');
        }
    }   
 }

}

function test_create_table_join_statement_with_depth($base_table,$labeled_tables){
 
  //https://codeigniter.com/userguide3/database/query_builder.html
  //$this->db->reset_query();

  $str = "";
  
   $join_array = $this->_create_table_join_statement_with_depth($base_table,$labeled_tables);
   
    foreach($join_array as $join_tables_depth){
      foreach($join_tables_depth as $primary_table => $join_tables){
          foreach($join_tables as $join_table){
              //$this->db->join($join_table,$join_table.'.'.$join_table.'_id='.$primary_table.'.fk_'.$join_table.'_id');
              $str .= $join_table;//.','.$join_table.'.'.$join_table.'_id='.$primary_table.'.fk_'.$join_table.'_id<br/>';
          }
      }   
   }
   
   return $join_array;
  }


function _create_table_join_statement_with_depth($base_table,$labeled_tables){
  
  $leveled_fields[1][$base_table] = [];

  foreach($labeled_tables as $labeled_table){
    if(in_array("fk_".$labeled_table."_id",$this->get_all_table_fields($base_table))){
      unset($labeled_tables[array_search($labeled_table,$labeled_tables)]);
      $level_one_labeled_tables = $labeled_tables;
      array_push($leveled_fields[1][$base_table],$labeled_table);

      
      //Second Level
      if(count($level_one_labeled_tables) == 0) break;
      foreach($leveled_fields[1][$base_table] as $level_two_base_table){
        $leveled_fields[2][$level_two_base_table] = [];
         foreach($level_one_labeled_tables as $level_two_labeled_table){
          if(in_array('fk_'.$level_two_labeled_table.'_id',$this->get_all_table_fields($level_two_base_table))){
              unset($level_one_labeled_tables[array_search($level_two_labeled_table,$level_one_labeled_tables)]);
              $level_two_labeled_tables = $level_one_labeled_tables;
              array_push($leveled_fields[2][$level_two_base_table],$level_two_labeled_table);

            
              //Third Level
              if(count($level_two_labeled_tables) == 0) break;
              foreach($leveled_fields[2][$level_two_base_table] as $level_three_base_table){
                $leveled_fields[3][$level_three_base_table] = [];
                  foreach($level_two_labeled_tables as $level_three_labeled_table){
                    if(in_array('fk_'.$level_three_labeled_table.'_id',$this->get_all_table_fields($level_three_base_table))){
                      unset($level_two_labeled_tables[array_search($level_three_labeled_table,$level_two_labeled_tables)]);
                      $level_three_labeled_tables = $level_two_labeled_tables;
                      array_push($leveled_fields[3][$level_three_base_table],$level_three_labeled_table);


                      // Fourth level
                      if(count($level_three_labeled_tables) == 0) break;
                      foreach($leveled_fields[3][$level_three_base_table] as $level_four_base_table){
                        $leveled_fields[4][$level_four_base_table] = [];
                        foreach($level_three_labeled_tables as $level_four_labeled_table){
                          if(in_array('fk_'.$level_four_labeled_table.'_id',$this->get_all_table_fields($level_four_base_table))){
                            unset($level_three_labeled_tables[array_search($level_four_labeled_table,$level_three_labeled_tables)]);
                            $level_four_labeled_tables = $level_three_labeled_tables;
                            array_push($leveled_fields[4][$level_four_base_table],$level_four_labeled_table);

                            
                            // Fifth level
                            if(count($level_four_labeled_tables) == 0) break;
                            foreach($leveled_fields[4][$level_three_base_table] as $level_five_base_table){
                              $leveled_fields[5][$level_five_base_table] = [];
                              foreach($level_four_labeled_tables as $level_five_labeled_table){
                                if(in_array('fk_'.$level_five_labeled_table.'_id',$this->get_all_table_fields($level_five_base_table))){
                                  unset($level_four_labeled_tables[array_search($level_five_labeled_table,$level_four_labeled_tables)]);
                                  $level_five_labeled_tables = $level_four_labeled_tables;
                                  array_push($leveled_fields[5][$level_five_base_table],$level_five_labeled_table);


                                  //Sixth Level
                                }
                              }
                            }

                          }
                        }
                      } 
                      
                    }
                  }
              }
              
          }
        }
      }
      //return $labeled_tables;
    }
  }
  
  return $leveled_fields;
}

function get_record_office_id($table,$primary_key){
  $lookup_tables = $this->grants->lookup_tables($table);
  $pk_field = $this->grants->primary_key_field($table);

  $office_id = 0;

  if(in_array('office',$lookup_tables)){
    $office_id = $this->db->get_where($table,
      array($pk_field=>$primary_key))->row()->fk_office_id;
  }

  return $office_id;
}

function center_where_condition(){
  $lookup_tables = $this->grants->lookup_tables($this->controller);

  if(in_array('center',$lookup_tables)){
    $this->db->where_in($this->controller.'.fk_center_id',$this->session->user_centers);
  }

}



function page_view_where_condition(...$args){

  $table = $args[0];
  

  $page_view_raw_conditions = array();

  if(isset($args[1])){
    
    $page_view_id = $args[1];
    
    //Page view conditions
    $this->db->select(array('page_view_condition_field','page_view_condition_operator',
    'page_view_condition_value'));
    $this->db->join('page_view','page_view.page_view_id=page_view_condition.fk_page_view_id');
    $page_view_raw_conditions = $this->db->get_where('page_view_condition',
    array('page_view_id'=>$page_view_id));

  }else{
    //Get the default page view (Non system admin)
    $this->db->select(array('page_view_condition_field','page_view_condition_operator',
    'page_view_condition_value'));

    if(!$this->session->system_admin){
      $this->db->join('page_view_role','page_view_role.fk_page_view_id=page_view.page_view_id');
      $this->db->where(array('fk_role_id'=>$this->session->role_id,'page_view_role_is_default'=>1));
    }else{
      $this->db->where(array('page_view_is_default'=>1));
    }

    $this->db->join('page_view','page_view.page_view_id=page_view_condition.fk_page_view_id');
    
    $page_view_raw_conditions = $this->db->get('page_view_condition');
  }

  if($page_view_raw_conditions->num_rows()>0){
    $page_view_raw_conditions = $page_view_raw_conditions->result_object();

    foreach($page_view_raw_conditions as $raw_condition){
      
      $value = $raw_condition->page_view_condition_value;
      if($raw_condition->page_view_condition_value == 'USER'){
        $value = $this->session->user_id;
      }
      
       // If operator is equal, less than, greater than, equal or less, equal or greater
      $query_condition = array($table.'.'.$raw_condition->page_view_condition_field=>$value);
      
      if($raw_condition->page_view_condition_operator == 'contains'){
        //If operator is contains - Not yet tested
        $query_condition = $table.'.'.$raw_condition->page_view_condition_field." LIKE %".$value."%";
        
      }elseif($raw_condition->page_view_condition_operator == 'between'){
        //If operator is between - Not yet tested
        $query_condition = $table.'.'.$raw_condition->page_view_condition_field."BETWEEN ".$value;
      }
      
      $this->db->where($query_condition);

    }
  }

}

function max_number_of_menu_items(){
  return $this->db->get('menu')->num_rows();
}

private function _run_list_query($table, $selected_columns, $lookup_tables, 
$model_where_method = "list_table_where", $filter_where_array = array() ){

  // Run column selector
  $this->db->select($selected_columns);
 
  // Model defined where condition
  $model = $table.'_model';
  $this->load->model($model);

  if(method_exists($this->$model,$model_where_method)){
    $this->$model->$model_where_method();
  }

  if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
    foreach ($lookup_tables as $lookup_table) {
      // Catch errors of missing lookup_tables in models
      if(!$this->db->table_exists($lookup_table)){
        $message = "The table ".$lookup_table." doesn't exist in the database. Check the lookup_tables function in the ".$table."_model";
        show_error($message,500,'An Error Was Encountered');
      }
        $lookup_table_id = $lookup_table.'_id';
        $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
    }
  }

  

  //View OUTPUT API defined condition array
  if(is_array($filter_where_array) && count($filter_where_array) > 0){
    $this->db->where($filter_where_array);
  }
  
  
}

/**
 * run_query
 * 
 * Runs an SQL query. Example used in the List_output class in the Output API
 * 
 * @param String $table - Selected table
 * @param Array $select_columns - Columns to be used in the select SQL portion
 * @param Array $lookup_tables - To be used to prepare a join statement
 * 
 * @return Array - Database result
 */
public function run_list_query($table, $selected_columns, $lookup_tables, 
  $model_where_method = "list_table_where", $filter_where_array = array() ): Array {
    

    $this->_run_list_query($table, $selected_columns, $lookup_tables,$model_where_method, $filter_where_array);

    if(!$this->db->get($table)){
      $error = $this->db->error();
      $message = 'You have a database error code '.$error['code'].'. '.$error['message'];
      show_error($message,500,'An Error Was Encountered');
    }else{
      $this->_run_list_query($table, $selected_columns, $lookup_tables,$model_where_method, $filter_where_array);
      return $this->db->get($table)->result_array();
    }
    
} 


function run_master_view_query($table,$selected_columns,$lookup_tables){

  $this->db->select($selected_columns); 

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

    if( method_exists($this->$library,'master_view_table_where') && 
        is_array($this->$library->master_view_table_where()) &&
        count($this->$library->master_view_table_where()) > 0
    ){
    $this->db->where($this->$library->master_view_table_where());
    }

    $data = (array)$this->db->get_where($table,array($this->grants->primary_key_field($table) => hash_id($this->uri->segment(3,0),'decode') ) )->row();
    
    // Get the name of the record creator
    $created_by = isset($data[$this->grants->history_tracking_field($table,'created_by')]) && $data[$this->grants->history_tracking_field($table,'created_by')] >= 1? $this->db->select('CONCAT(`user_firstname`," ",`user_lastname`) as user_name')->get_where('user',
    array('user_id'=>$data[$this->grants->history_tracking_field($table,'created_by')]))->row()->user_name:get_phrase('creator_user_not_set');

    $data['created_by'] = $created_by;

    //Get the name of the last record modifier
    $last_modified_by = isset($data[$this->grants->history_tracking_field($table,'last_modified_by')]) && $data[$this->grants->history_tracking_field($table,'last_modified_by')] >= 1? $this->db->select('CONCAT(`user_firstname`," ",`user_lastname`) as user_name')->get_where('user',
    array('user_id'=>$data[$this->grants->history_tracking_field($table,'last_modified_by')]))->row()->user_name:get_phrase('modifier_user_not_set');

    $data['last_modified_by'] = $last_modified_by;

    return $data;
}


    /**
   * control_column_visibility
   * 
   * This method checks if a field/column has permission to with a create label
   * @todo this method doesn't interact with the database thus needs to meove to an API or Lib/ 
   * Has been moved to Access_base class/ Remove it after all Output API code is moved
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


  function grants_get($table){

    $model = $table.'_model';

    $this->load->model($model);

    if(method_exists($this->$model,'list_table_where') ){
      // This is always a $this->db->where statement
      $this->$library->list_table_where();
    }

    return $this->db->get($table)->result_array();
  }

  function grants_get_row($table){

    $model = $table.'_model';

    $this->load->model($model);

    if(method_exists($this->$model,'list_table_where') ){
      // This is always a $this->db->where statement
      $this->$model->list_table_where();
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

    return $this->control_column_visibility($this->controller,$visible_columns);
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
     
    $controlled_visible_column = array();

    foreach($visible_columns as $column){
      if($this->grants->check_role_has_field_permission($this->controller,'create',$column)){
        $controlled_visible_column[] = $column;
      }  
    }

    return $controlled_visible_column;
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

    return $this->control_column_visibility($table,$visible_columns);

  }

  /**
   * approveable_item
   * 
   * Gives you true if the passed items is approveable else false
   * 
   * @param $approveable_item_name String - Object name
   * 
   * @return bool
   */

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

  // This give the initial approval status when inserting a record - To be taken to approval modal

  function initial_item_status($table_name = ""){

    $table = $table_name == "" ? $this->controller : $table_name;

    $approveable_item = $this->db->get_where('approve_item',
    array('approve_item_name'=>$table));

    $status_id = 0;

    if($approveable_item->num_rows() > 0 ){
      $approveable_item_id = $approveable_item->row()->approve_item_id;
      $this->db->join('approval_flow','approval_flow.approval_flow_id=status.fk_approval_flow_id');
      $initial_status = $this->db->get_where('status',array('fk_approve_item_id'=>$approveable_item_id,
      'status_approval_sequence'=>1));

      if($initial_status->num_rows() > 0 ){
          $status_id = $initial_status->row()->status_id;
      }

    }

    return $status_id;

  }

function center_start_date($center_id){
   return $this->db->get_where('office',array('office_id'=>$center_id))->row()->office_start_date;
}

function create_missing_page_access_permission(){
  // Get all menu items
  $menus = $this->db->get('menu');
  $page_access_permissions = $this->db->get_where('permission',array('permission_type'=>1));
  $permission_labels = $this->db->get('permission_label');

  $count_of_menus = $menus->num_rows();
  $count_of_page_access_permissions = $page_access_permissions->num_rows();
  $count_of_permission_labels = $permission_labels->num_rows();

  //$this->grants_model->mandatory_fields('permission');

  $this->db->trans_start();
  
  // Only create a permission if count of menus are more that the permissions available
  if(($count_of_page_access_permissions * $count_of_permission_labels) < ($count_of_menus * $count_of_permission_labels) ){
    foreach($menus->result_array() as $menu_item){
      
      // Only create a missing permission for a given menu item and permission label
      foreach($permission_labels->result_array() as $permission_label){
        if($this->db->get_where('permission',
        array('fk_permission_label_id'=>$permission_label['permission_label_id'],
        'permission_type'=>1,'fk_menu_id'=>$menu_item['menu_id']))->num_rows() == 0){

            $permission_data['permission_name'] = ucfirst($permission_label['permission_label_name']).' '.str_replace('_',' ',$menu_item['menu_name']);
            $permission_data['permission_description'] = ucfirst($permission_label['permission_label_name']).' '.str_replace('_',' ',$menu_item['menu_name']);
            $permission_data['permission_is_active'] = 1;
            $permission_data['fk_permission_label_id'] = $permission_label['permission_label_id'];
            $permission_data['permission_type'] = 1; // Page Access
            $permission_data['permission_field'] = 0; // Always 0 for Page Access
            $permission_data['fk_menu_id'] = $menu_item['menu_id'];//str_replace('_',' ',$menu_item['menu_id']);

            $permission_data_to_insert = $this->merge_with_history_fields('permission',$permission_data,false);


            $this->db->insert('permission',$permission_data_to_insert);
        
          }
      }
    }
  }

  $this->db->trans_complete();

  if($this->db->trans_status() == false){
    $message = "Error occurred when mass creating system page access permissions";
    show_error($message,500,'An Error As Encountered');
    return false;
  }else{
    return true;
  }

}



//Not yet used 

function update_status(){
  // Get status of current id
  $action_labels = $this->grants->action_labels($this->controller,hash_id($this->id,'decode'));

  $data['fk_status_id'] = $action_labels['next_approval_status'];
  $this->db->where(array('request_id'=>hash_id($this->id,'decode')));
  $this->db->update('request',$data);
}


function merge_with_history_fields(String $approve_item_name, Array $array_to_merge, bool $add_name_to_array = true){

  $data = [];

  $data[$approve_item_name.'_track_number'] = $this->generate_item_track_number_and_name($approve_item_name)[$approve_item_name.'_track_number'];
  $data[$approve_item_name.'_created_by'] = $this->session->user_id?$this->session->user_id:1;
  $data[$approve_item_name.'_last_modified_by'] = $this->session->user_id?$this->session->user_id:1;
  $data[$approve_item_name.'_created_date'] = date('Y-m-d');
  $data['fk_approval_id'] = $this->insert_approval_record($approve_item_name);
  $data['fk_status_id'] = $this->initial_item_status($approve_item_name);

  if($add_name_to_array){
    $data[$approve_item_name.'_name'] = $this->generate_item_track_number_and_name($approve_item_name)[$approve_item_name.'_name'];
  }

  return array_merge($array_to_merge,$data);
}


}
