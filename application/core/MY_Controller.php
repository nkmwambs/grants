<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*This autoloads all the classes in third_party folder subdirectories e.g. Output
  The third_party houses the reusable API or code systemwise
 */
require_once APPPATH."third_party/autoload.php";

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
  
    /**
   * __construct()
	 * Description: 
	 * -Loads parent contructs initialization i.e. from CI_controller
	 * -Gets the value of 1st URI segment and assigns to $segment variable 
	 * and gets the 2nd URI segment assigns to $action variable.
	 * If uri segment 1st and 2nd have no value passed , it sets a default value of 'approval' 
	 * and 'list' respective
	 * -Initializes $current_library,$current_model,$controller,$action
	 * -Loads the current library and model
	 * -Sets the session of master table
   */
  function __construct(){

    parent::__construct();

    $segment = $this->uri->segment(1, 'approval');
    $action = $this->uri->segment(2, 'list');

    $this->current_library = $segment.'_library';
    $this->current_model = $segment.'_model';
    $this->controller = $segment;
    $this->action = $action;
	$this->id = $this->uri->segment(3, 0);

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
    //$this->load->model('user_model');

  }
  /**
   * result() 
   * This method returns the contents that will be consumed in the view file
   * @param String $id: this is the primary key of selected record mostly in view and edit
   * @return Mixed 
   * @todo {seperate the method that uses ajax to post from result methods}
   */

  function result(String $id){

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
    return $this->has_permission?$this->action:'error';
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
    $view_path = $this->controller;

    if(!file_exists(VIEWPATH.$view_path.'/'.$this->page_name().'.php') || !$this->has_permission ){
      $view_path =  'templates';
    }

    return $view_path;

  }
 /**
   * load_template() 
   * This method returns object [this is a view object]
   * @param Array $page_data
   *@return Object
   */
  private function load_template(Array $page_data):Object{
    return $this->load->view('general/index',$page_data);
  }
/**
   * crud_view() 
   * This method returns an array. It packages the page name, page title , view folder and result of the page
   * @param String $id
   *@return Void
   */
  private function crud_views(String $id=''):Void{

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
  function detail_row():Void{
    $fields = $this->input->post('fields');

    $lib = $this->controller."_detail_library";

    $this->load->library($lib);

    echo json_encode($this->$lib->detail_row_fields($fields));
  }

}
