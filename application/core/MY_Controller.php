<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*This autoloads all the classes in third_party folder subdirectories e.g. Output
  The third_party houses the reusable API or code systemwise
 */
require_once APPPATH."third_party".DIRECTORY_SEPARATOR."Api".DIRECTORY_SEPARATOR."autoload.php";

define('VALIDATION_ERROR','VALIDATION_ERROR');
define('VALIDATION_SUCCESS','VALIDATION_SUCCESS');

class MY_Controller extends CI_Controller
{

  private $list_result;
  
  /**
   * @var String $current_library - this holds value of active feature library
   */      
  public $current_library;
  
   /**
   * @var String $current_model - this holds value of active feature model
   */
  public $current_model;
  
  /**
   * @var String $controller - this holds value of active feature controller
   */
  public $controller;
  
   /**
   * @var String $action - this holds value of 2nd URI segment 
    * (i.e. type of a page that will open e.g. view, single_form_add, edit_form etc) 
   */
  
  public $action;
  
   /**
   * @var String $id - this holds the primary key value of a record. 
    * This is 3rd URI segment (mostly used on edit, view and delete a record)
    * This $id value is always null if not the actions above 
   */
  
  public $id = null;
    /**
   * @var String $master_table - this holds a value of a parent table 
    * (mostly is in view action pages) 
   */
  public $master_table = null;
  
    /**
   * @var Bool $has_permission - this holds value of true or false to check if the user has permissions 
    * to access the a particular page that you are trying to access. Action like edit point to apage
   */
  public $has_permission = false;
  public $sub_action = null;
  public $capped_controller;

  //public $widget = null;

  public $max_status_id = null;

  public $write_db = null;
  public $read_db = null;

  function __construct(){
    
    parent::__construct();

    $this->write_db = $this->load->database('write_db', true); // Master DB on Port 3306
    $this->read_db = $this->grants_model->read_database_connection();

    $this->load->add_package_path(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'Packages'.DIRECTORY_SEPARATOR.'Core');
    $this->load->add_package_path(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'Packages'.DIRECTORY_SEPARATOR.$this->session->package);
    $this->load->model('general_model');

    $segment = $this->uri->segment(1, 'dashboard');
    $action = $this->uri->segment(2, 'list');

    $this->current_library = strtolower($segment.'_library');
    $this->current_model = strtolower($segment.'_model');
    $this->controller = strtolower($segment);
    $this->capped_controller = ucfirst($segment);

    $this->action = $action;
    $this->sub_action = $this->uri->segment(4, null);;

    $this->load->library($this->current_library);
    $this->load->model($this->current_model);

    // Load package library, helper and model
    if($this->session->userdata('package')){
      $this->load->helper($this->session->package.'_package');
      $this->load->library($this->session->package.'_package_library');
      $this->load->model($this->session->package.'_package_model');
    }else{
      $this->session->sess_destroy();
    }
	
    //Setting the session of master table. For view action always the master table= the controler u are in.
    //Will alwasy be null for other actions
    
    if($this->action == 'view'){
      $this->session->set_userdata('master_table',ucfirst($this->controller));
      $this->id = hash_id($this->uri->segment(3,0),'decode');// Not sure what's this line does
    }elseif($this->action == 'single_form_add' && $this->uri->total_segments() == 4){
      $this->session->set_userdata('master_table',$this->uri->segment(4,0));
      $this->id = hash_id($this->uri->segment(3,0),'decode');// Not sure what's this line does
    }elseif ($this->action == 'list') {
      $this->session->set_userdata('master_table',null);
      $this->id = hash_id($this->uri->segment(3,0),'decode');// Use by filters only
    }

    $this->id = $this->uri->segment(3,null);

    $this->max_status_id = $this->general_model->get_max_approval_status_id($this->controller);
    
    //Set the Language Context
    $this->load->library('Language_library');
    $this->language_library->set_language($this->session->user_locale);

    // Instantiate page view (page filters) 
    //$this->session->set_userdata($this->controller.'_active_page_view',0);

    $this->load->model('ajax_model','dt_model');

    //Temporary, should be done on login/ auto load/ or check if already loaded
    $this->load->model('office_model');
    $this->load->model('approval_model');
    $this->load->model('general_model');
    $this->load->model('message_model');
    $this->load->model('attachment_model');

    //Check if account system models and libraries are loaded if not load them
    //check_and_load_account_system_model_exists('As_'.$this->controller.'_library','Grants','library');
    check_and_load_account_system_model_exists('As_'.$this->controller.'_model','Grants','model');

    // Logout if the user session expire
    if(!$this->session->user_id){
      redirect(base_url().'login','refresh');
    }

    $this->load->library('Grants_S3_lib');

  }


  /**
   * result() 
   * This method returns the contents that will be consumed in the view file
   * @param String $id: this is the primary key of selected record mostly in view and edit
   * @return Mixed 
   * @todo {seperate the method that uses ajax to post from result methods}
   */
  
  function result($id = ""){

    $action = $this->action.'_output';

    $lib = strtolower($this->current_library);

    /*Makes a decision if we are posting to db table when the $this->input->post() 
    return true otherwise load the page to add records*/
    if($this->input->post()){
      /*If $id> 0 mean has paased by code and not URI. The $id can be null if is not passed in URI segment
      e.g.In case of delete when the URI is not modified to have $id it will be passed as argument 
      from a clickable link
      The elseif takes effect when the $id is passed URI

      The if and elseif condtion handles edit and add. The else part of condition handles the new record post
      */
      if($id > 0){
        $this->$lib->$action($id);
      }elseif($this->id !== null){
        $this->$lib->$action($this->id);
      }elseif($this->action == 'list' || $this->action == 'view'){
          // Just to test if the third party API are working for list output
          // This is the way to go for all outputs. Move all outputs to the Output API  
          // Applies when using page view: See View Widget
          return Output_base::load($this->action);
      }else{
          $this->$lib->$action();
      }
        
      
        exit;
    }

    $render_model_result = 'render_'.$this->action.'_page_data';

    if($this->action == 'list' || $this->action == 'view' || $this->action == 'multi_row_add'){

        if(!$this->render_data_from_model($render_model_result)){
          // Render from default API
          $this->list_result = \Output_base::load($this->action);
        }

    }else{
      if(!$this->render_data_from_model($render_model_result)){
        // Render from default API
        $this->list_result = $this->$lib->$action();
      }
    }
    
    return $this->list_result;
  }

  function render_data_from_model($render_model_result){
    // Render custom data for list and view pages if render_list_page_data or 
    // render_view_page_data method are defined
    // in the specific feature models

    $is_model_set = false;
        if(
            check_and_load_account_system_model_exists('As_'.$this->controller.'_model') &&
            method_exists($this->{'As_'.$this->controller.'_model'},$render_model_result) 
        ){
          // Render results from account system model
            $this->list_result = $this->{'As_'.$this->controller.'_model'}->{$render_model_result}();

            $is_model_set = true;
        }elseif(
          // Render results from feature model
          method_exists($this->{$this->controller.'_model'},$render_model_result)
        ){
          $this->list_result = $this->{$this->controller.'_model'}->{$render_model_result}();
          $is_model_set = true;
        }

        return $is_model_set;
  }
   /**
   * page_name() 
   * This method returns the name of the view to be loaded
   *@return String
   */
  function page_name():String{
    //return the page name if the user has permissions otherwise error page of user not allowed access display

    if((hash_id($this->id,'decode') == null && $this->action == 'view') || !$this->has_permission){
      return 'error';
    }else{
      return $this->action;
    }
  }
  /**
   * page_title() 
   * This method returns the title of the  page being loaded
   *@return String
   */
  function page_title():String{
    $make_plural = $this->action == 'list'?"s":"";
    return get_phrase($this->action.'_'.$this->controller.$make_plural);
  }
  /**
   * views_dir() 
   * This method returns the folder path of the controller/feature file
   *@return String
   */
   function views_dir():String{
    $view_path = strtolower($this->controller);

    if(file_exists(VIEWPATH.$view_path.'/'.$this->session->user_account_system.'/'.$this->page_name().'.php') && $this->has_permission ){
      $view_path .= '/'.$this->session->user_account_system;
    }elseif(!file_exists(VIEWPATH.$view_path.'/'.$this->page_name().'.php') || !$this->has_permission ){
      $view_path =  'templates';
    }

    return $view_path;

  }
 /**
   * load_template() 
   * This method returns object [this is a view object]
   * @param Array $page_data
   *@return Mixed
   */
  private function load_template(Array $page_data){
    return $this->load->view('general/index',$page_data);
  }
/**
   * crud_view() 
   * This method returns an array. It packages the page name, page title , view folder and result of the page
   * @param String $id
   *@return Void
   */
  function crud_views(String $id=''):Void{

    $result = $this->result($id);

    // Page name, Page title and views_dir can be overrode in a controller
    $page_data['page_name'] = $this->page_name();
    $page_data['page_title'] = $this->page_title();
    $page_data['views_dir'] = $this->views_dir();
    $page_data['result'] = $result;

    // Can be overrode in a specific controller
    //$this->load->add_package_path(APPPATH.'workplan', FALSE);
    $this->load_template($page_data);
  }
/**
   * list() 
   * This method is an entry method for list action page. It loads user permission of the list page and assigns $has_permission
   *@return Void
   */
  function list():Void{
    $this->has_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'read');
    $this->crud_views();
    //echo json_encode($this->result());
  }

/**
   * view() 
   * This method is an entry method for view action page. It loads user permission of the view page and assigns $has_permission
   *@return Void
   */
  function view(){
    $this->has_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'read');
    $this->crud_views();
  }
/**
   * edit() 
   * This method is an entry method for edit action page. It loads user permission of 
   * the edit page and assigns $has_permission
   * @param String   
   *@return Void
   */
  function edit($id){
    $this->has_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'update');
    $this->crud_views($id);
  }
/**
   * multi_form_add() 
   * This method is an entry method for multi_form_add action page. It loads user 
   * permission of the multi_form_add page and assigns $has_permission
   * @todo {observe the sitautaion when $id argument is used otherwise pass no argument in the function}
   *@return Void
   */
  function multi_form_add($id = null):Void{
    $this->has_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'create');
    $this->id = $id;
    $this->grants_model->insert_status_if_missing(strtolower($this->controller));
    $this->crud_views();
  }
/**
   * single_form_add() 
   * This method is an entry method for single_form_add action page. It loads user 
   * permission of the single_form_add page and assigns $has_permission
   * @todo {observe the sitautaion when $id argument is used otherwise pass no argument in the function}
   *@return Void
   */
  function single_form_add($id = null):Void{
    $this->has_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'create');
    $this->id = $id;
    $this->grants_model->insert_status_if_missing(strtolower($this->controller));
    $this->crud_views();
  }

  function multi_row_add($id = null):Void{
    $this->has_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'create');
    $this->id = $id;
    $this->crud_views();
  }

/**
   * delete() 
   * This method is an entry method for delete action. It loads user 
   * permission of the delete action and assigns $has_permission
   * @param String
   *@return String
   */
  function delete($id = null){
    $this->has_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'delete');
    echo "Record deleted successful";
  }
/**
   * detail_row() 
   * This method is triggered by insert_row_butron on multform add page to create the rows of details section of the page 

   *@return VOid
   */
  function detail_row(){
    $fields = $this->input->post('fields');

    $lib = $this->grants->dependant_table($this->controller).'_library';

    $this->load->library($lib);

    echo json_encode($this->$lib->detail_row_fields($fields));
  }

  function list_ajax(){
    echo json_encode($this->grants->list_ajax_output());
  }

  function update_config($config_name, $config_file = "config", $config_array_name = 'config'){
    //Make this code for editing config items in the grants config
  
    $key = $this->input->post('key');
    $phrase = $this->input->post('phrase');

    //print_r($this->input->post());
    //echo $config_name;
    //exit();
  
    $reading = fopen(APPPATH.$config_name.'/'.$config_file.'.php', 'r');
    $writing = fopen(APPPATH.$config_name.'/myfile.tmp', 'w');
  
    $replaced = false;
  
    while (!feof($reading)) {
      $line = fgets($reading);
      
      if (stristr($line,$key)) {
        $line = "\t$".$config_array_name."['".$key."'] = '".$phrase."';\n";
        $replaced = true;
      }
  
      fputs($writing, $line);
    }
    fclose($reading); fclose($writing);
    // might as well not overwrite the file if we didn't replace anything
    if ($replaced) 
    {
      rename(APPPATH.$config_name.'/myfile.tmp', APPPATH.$config_name.'/'.$config_file.'.php');
    } else {
      unlink(APPPATH.$config_name.'/myfile.tmp');
    }
  
    //return $phrase;
  }

  function status_change($change_type = 'approve'){

    $status_id =$this->general_model->get_status_id($this->controller,hash_id($this->id,'decode'));
    $is_max_approval_status_id = $this->general_model->is_max_approval_status_id($this->controller,$status_id);
    //echo $is_max_approval_status_id;exit;
    // Prevent update of status when max status id is reached
    if(!$is_max_approval_status_id){
       // Get status of current id - to be taken to grants_model
       $master_action_labels = $this->grants->action_labels($this->controller,hash_id($this->id,'decode'));
       
      //print_r($master_action_labels);exit;
       //Update master record
       $data['fk_status_id'] = $master_action_labels['next_approval_status'];
       if($change_type == 'decline'){
         $data['fk_status_id'] = $master_action_labels['next_decline_status'];
       }
       
       $this->write_db->where(array(strtolower($this->controller).'_id'=>hash_id($this->id,'decode')));
       $this->write_db->update(strtolower($this->controller),$data);
       
       //$is_max_approval_status_id = $this->general_model->is_max_approval_status_id($this->controller,$data['fk_status_id']);

       $item_approval_id = $this->db->get_where($this->controller,
         array($this->controller.'_id'=>hash_id($this->id,'decode')))->row()->fk_approval_id;
         
         
         $this->write_db->where(array('approval_id'=>$item_approval_id));
         $this->write_db->update('approval',array('fk_status_id'=>$data['fk_status_id']));
      

      //  //Update detail record
      //  $detail_record = $this->grants->dependant_table($this->controller);
   
      //  //Get id of detail table
      //  $detail_id = $detail_record.'_id';
      //  $primary_table_id = 'fk_'.$this->controller.'_id';
       
      //  $detail_obj = $this->db->get_where($detail_record,
      //  array($primary_table_id=>hash_id($this->id,'decode')))->result_array();//->row()->$detail_id;

      //  foreach($detail_obj as $detail){
      //     $detail_key = $detail[$detail_id];

      //     $detail_action_labels = $this->grants->action_labels($detail_record ,$detail_key);    
        
      //     $detail_data['fk_status_id'] = $detail_action_labels['next_approval_status'];
  
      //     if($change_type == 'decline'){
      //       $detail_data['fk_status_id'] = $detail_action_labels['next_decline_status'];
      //     }
          
      //     $this->write_db->where(array($primary_table_id=>hash_id($this->id,'decode')));
      //     $this->write_db->update($detail_record,$detail_data);
      //  }

      //return hash_id($this->id,'decode');

      if(method_exists($this->{$this->current_model},'post_approve_action')){
        $this->{$this->current_model}->post_approve_action();
      }
   
    }    
       
    
    redirect(base_url() .$this->controller.'/view/'.$this->id, 'refresh');
  }

  function approve(){
    $this->status_change('approve');
  }

  function decline(){
    $this->status_change('decline');
  }

  function post_chat(){

    $this->grants->table_setup($this->controller);

    $post = $this->input->post();
    $approve_item_id = $this->db->get_where('approve_item',array('approve_item_name'=>$this->controller))->row()->approve_item_id;

    $message['message_track_number'] = "";
    $message['message_name'] = "";
    $message['fk_approve_item_id'] = $approve_item_id;
    $message['message_record_key'] = hash_id($post['item_id'],'decode');
    $message['message_created_by'] = $this->session->user_id;
    $message['message_last_modified_by'] =  $this->session->user_id;
    $message['message_created_date'] = date('Y-m-d');
    $message['message_is_thread_open'] = 1;

    // Check if a message a thread is open for this item before posting
    $open_thread = $this->db->get_where('message',
    array('fk_approve_item_id'=>$approve_item_id,
    'message_record_key'=>1,'message_is_thread_open'=>hash_id($post['item_id'],'decode')));

    $message_id = 0;

    if($open_thread->num_rows() == 0){
      $this->write_db->insert('message',$message);
      $message_id = $this->write_db->insert_id();
    }else{
      $message_id = $open_thread->row()->message_id;
    }
    
    $message_detail['message_detail_track_number'] = '';
    $message_detail['message_detail_name'] = '';
    $message_detail['fk_user_id'] = $this->session->user_id;
    $message_detail['message_detail_content'] = $post['message_detail_content'];
    $message_detail['fk_message_id'] = $message_id;
    $message_detail['message_detail_created_date'] = date('Y-m-d h:i:s');
    $message_detail['message_detail_created_by'] = $this->session->user_id;
    $message_detail['message_detail_last_modified_by'] = $this->session->user_id;
    $message_detail['message_detail_is_reply'] = 0;
    $message_detail['message_detail_replied_message_key'] = 0;

    $this->write_db->insert('message_detail',$message_detail);

    $returned_response = [
      'message'=>$post['message_detail_content'],
      'message_date'=> date('Y-m-d h:i:s'),
      'creator' => $this->session->name,
    ];
    echo json_encode($returned_response);
    //echo $post['item_id'];
  }

  function create_uploads_temp(){

    $string = $this->session->user_id.$this->controller.date('Y-m-d');
  
    $hash = md5($string);
  
    $storeFolder = "uploads/temps/".$this->controller."/".$hash;
  
    if(is_array($this->grants->upload_files($storeFolder)) && 
      count($this->grants->upload_files($storeFolder))>0){
        $info = ['temp_id'=>$hash];
    
        $files_array = array_merge($this->grants->upload_files($storeFolder),$info);
        
        if(!$this->session->has_userdata('upload_session')){
          $this->session->set_userdata('upload_session',$hash);
        }
        echo json_encode($files_array);
    
      }else{
      echo 0;
    }
  
  }
  
  function custom_ajax_call(){
    // This implementation has 2 predefined keys i.e. ajax_method and return_as_json and must be passed in the 
    // ajax post call from pages for this to work
    // ajax_method carries the method name of the implementing account system model while return_as_json is a bool
    // indicating if the returned result is in json or string format

    $post = $this->input->post();
    $model_name = 'As_'.$this->controller.'_model';
    $ajax_method = $post['ajax_method'];
    $return_as_json = !isset($post['return_as_json']) || $post['return_as_json'] == 'true' ? true : false;
    $package_name = !isset($post['package_name']) ? "Grants" : $post['package_name'];
    $return = [];
    
    if(check_and_load_account_system_model_exists($model_name,$package_name)){
        if(is_valid_array_from_contract_method($model_name,$ajax_method)){
          $return = $this->{$model_name}->{$ajax_method}();
        }elseif(
            method_exists($this->{$this->controller.'_model'},$ajax_method) &&
            is_valid_array_from_contract_method($this->{$this->controller.'_model'},$ajax_method)
          ){
          $return = $this->{$this->controller.'_model'}->{$ajax_method}();
        }else{
          $return = "Missing method `".$ajax_method."` in the account system or feature model for `".$this->controller."`";
        }
    }elseif(
        method_exists($this->{$this->controller.'_model'},$ajax_method) &&
        is_valid_array_from_contract_method($this->{$this->controller.'_model'},$ajax_method)
      ){
        $return = $this->{$this->controller}->{$ajax_method}();
    }else{
      $return = "Missing account system or feature model for `".$this->controller."`";
    }

    if($return_as_json || is_array($return)){
      echo json_encode($return);
    }else{
      echo $return;
    }  
    
  }

  function event_tracker(){
    $this->grants_model->event_tracker();
  }

}
