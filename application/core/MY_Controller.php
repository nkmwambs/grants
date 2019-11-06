<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller implements CrudModelInterface
{

  private $list_result;

  public $current_library;
  public $current_model;
  public $controller;
  public $action;
  public $id = null;
  public $master_table = null;
  public $has_permission = false;

  function __construct(){

    parent::__construct();

    $segment = $this->uri->segment(1, 'approval');
    $action = $this->uri->segment(2, 'list');

    $this->current_library = $segment.'_library';
    $this->current_model = $segment.'_model';
    $this->controller = $segment;
    $this->action = $action;

    $this->load->library($this->current_library);
    $this->load->model($this->current_model);

    if($this->action == 'view'){
      $this->session->set_userdata('master_table',$this->controller);
      $this->id = hash_id($this->uri->segment(3,0),'decode');
    }elseif ($this->action == 'list') {
      $this->session->set_userdata('master_table',null);
    }

    $this->id = $this->uri->segment(3, 0);

    $this->load->model('user_model');

  }


  function result($id = 0){

    $action = $this->action.'_output';

    $lib = $this->current_library;

    if($this->input->post()){
      if($id > 0){
        $this->$lib->$action($id);
      }elseif($this->id !== null){
        $this->$lib->$action($this->id);
      }else{
        $this->$lib->$action();
      }

        exit;
    }

    return $this->list_result = $this->$lib->$action();
  }

  function page_name(){
    return $this->has_permission?$this->action:'error';
  }

  function page_title(){
    $make_plural = $this->action == 'list'?"s":"";
    return get_phrase($this->action.'_'.$this->controller.$make_plural);
  }

  function views_dir(){
    $view_path = $this->controller;

    if(!file_exists(VIEWPATH.$view_path.'/'.$this->page_name().'.php') || !$this->has_permission ){
      $view_path =  'templates';
    }

    return $view_path;

  }

  function load_template($page_data = array()){
    return $this->load->view('general/index',$page_data);
  }

  // A specific controller can override crud method

  function crud_views($id = 0){

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

  // Can be overrode in a speicific controller
  function list(){
    $this->has_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'read');
    $this->crud_views();
  }

  // Can be overrode in a speicific controller
  function view(){
    $this->crud_views();
  }

  function edit($id){
    $this->crud_views($id);
  }


// The null $id happens if the record being created has no dependant primary record
  function multi_form_add($id = null){
    $this->id = $id;
    $this->crud_views();
  }

  function single_form_add($id = null){
    $this->id = $id;
    $this->crud_views();
  }

  function delete($id = null){
    echo "Record deleted successful";
  }

  function detail_row(){
    $fields = $this->input->post('fields');

    $lib = $this->controller."_detail_library";

    $this->load->library($lib);

    echo json_encode($this->$lib->detail_row_fields($fields));
  }

  // function error(){
  //   $page_data['page_name'] = 'error';
  //   $page_data['page_title'] = 'Error Exceptions';
  //   $page_data['views_dir'] = 'templates';
  //   $page_data['error_message'] = 'templates';
  //
  //  $this->load->view('general/index',$page_data);
  // }

}
