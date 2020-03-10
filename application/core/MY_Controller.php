<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*This autoloads all the classes in third_party folder subdirectories e.g. Output
  The third_party houses the reusable API or code systemwise
 */
require_once APPPATH."third_party/Api/autoload.php";

class MY_Controller extends CI_Controller implements CrudModelInterface
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
  public $sub_action;

  //public $widget = null;

  function __construct(){
    
    parent::__construct();

    $this->load->add_package_path(APPPATH.'third_party/Packages/Core');
    $this->load->add_package_path(APPPATH.'third_party/Packages/Grants');
    //$this->widget = new Widget_base();

    $segment = $this->uri->segment(1, 'approval');
    $action = $this->uri->segment(2, 'list');

    $this->current_library = $segment.'_library';
    $this->current_model = $segment.'_model';
    $this->controller = strtolower($segment);
    $this->action = $action;
    $this->sub_action = $this->uri->segment(4, null);;

    $this->load->library($this->current_library);
    $this->load->model($this->current_model);
	
	
    //Setting the session of master table. For view action always the master table= the controler u are in.
    //Will alwasy be null for other actions
    
    if($this->action == 'view'){
      $this->session->set_userdata('master_table',$this->controller);
      $this->id = hash_id($this->uri->segment(3,0),'decode');
    }elseif ($this->action == 'list') {
      $this->session->set_userdata('master_table',null);
    }

    $this->id = $this->uri->segment(3,null);
    
    //Set the Language Context
    $this->load->library('Language_library');
    $this->language_library->set_language($this->session->user_locale);

    // Instantiate page view (page filters) 
    //$this->session->set_userdata($this->controller.'_active_page_view',0);

    $this->load->model('ajax_model','dt_model');

    //Temporary, should be done on login
    $this->load->model('office_model');
    $this->load->model('approval_model');

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

    $lib = $this->current_library;

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


    if($this->action == 'list' || $this->action == 'view'){
      // Just to test if the third party API are working for list output
      // This is the way to go for all outputs. Move all outputs to the Output API  
      $this->list_result = Output_base::load($this->action);
    }else{
      $this->list_result = $this->$lib->$action();
    }

    return $this->list_result;
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

    if(!file_exists(VIEWPATH.$view_path.'/'.$this->page_name().'.php') || !$this->has_permission ){
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
    $this->crud_views();
  }
/**
   * delete() 
   * This method is an entry method for delete action. It loads user 
   * permission of the delete action and assigns $has_permission
   * @param String
   *@return String
   */
  function delete($id = null):String{
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
        // Get status of current id - to taken to grants_model
        $master_action_labels = $this->grants->action_labels($this->controller,hash_id($this->id,'decode'));

        //Update master record
        $data['fk_status_id'] = $master_action_labels['next_approval_status'];
        if($change_type == 'decline'){
          $data['fk_status_id'] = $master_action_labels['next_decline_status'];
        }
        
        $this->db->where(array(strtolower($this->controller).'_id'=>hash_id($this->id,'decode')));
        $this->db->update(strtolower($this->controller),$data);
        
        $is_max_approval_status_id = $this->approval_model->is_max_approval_status_id($this->controller,hash_id($this->id,'decode'));

        $item_approval_id = $this->db->get_where($this->controller,
          array($this->controller.'_id'=>hash_id($this->id,'decode')))->row()->fk_approval_id;
          
        if($is_max_approval_status_id){
          
          $this->db->where(array('approval_id'=>$item_approval_id));
          $this->db->update('approval',array('fk_status_id'=>103));
        
        }else{
          $this->db->where(array('approval_id'=>$item_approval_id));
          $this->db->update('approval',array('fk_status_id'=>102));
        }

        //Update detail record
        $detail_record = $this->grants->dependant_table($this->controller);
    
        //Get id of detail table
        $detail_id = $detail_record.'_id';
        $primary_table_id = 'fk_'.$this->controller.'_id';
        
        $detail_key = $this->db->get_where($detail_record,
        array($primary_table_id=>hash_id($this->id,'decode')))->row()->$detail_id;
    
        $detail_action_labels = $this->grants->action_labels($detail_record ,$detail_key);    
        
        $detail_data['fk_status_id'] = $detail_action_labels['next_approval_status'];

        if($change_type == 'decline'){
          $detail_data['fk_status_id'] = $detail_action_labels['next_decline_status'];
        }
        
        $this->db->where(array($primary_table_id=>hash_id($this->id,'decode')));
        $this->db->update($detail_record,$detail_data);
    
        redirect(base_url() .$this->controller.'/view/'.$this->id, 'refresh');
  }

  function approve(){
    $this->status_change('approve');
  }

  function decline(){
    $this->status_change('decline');
  }

}
