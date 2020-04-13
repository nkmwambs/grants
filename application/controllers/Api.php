<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Api extends CI_Controller{
  function __construct(){
    parent::__construct();

    $this->load->model('general_model');
    $this->load->library('language_library');
  }
    
  function index(){
   
  }

  function approveable_item($approveable_item){
    echo json_encode($this->grants_model->approveable_item($approveable_item));
  }
  
  function get_status_id($approveable_item,$record_id){
    echo $this->general_model->get_status_id($approveable_item,$record_id);
  }

  function intialize_table(){
    $foreign_keys_values = [];
    $this->load->model('context_definition_model');
    echo json_encode($this->context_definition_model->intialize_table($foreign_keys_values));
    
  }    

  function insert_approval_record($approve_item){
    echo json_encode($this->grants_model->insert_approval_record($approve_item));
  }

  function create_context_tables(){
    echo json_encode($this->grants_model->create_context_tables());
  }

  function yaml_tables_versions(){
    $raw_specs = file_get_contents(APPPATH.'version'.DIRECTORY_SEPARATOR.'spec.yaml');

    $specs_array = yaml_parse($raw_specs,0);

    echo json_encode($specs_array['grants']);
  }

  function get_all_table_fields(){
    $fields = $this->grants_model->get_all_table_fields('voucher');
    
    $foreign_tables_array_padded_with_false = array_map(function($elem){
      return substr($elem,0,3) =='fk_'?substr($elem,3,-3):false;
    },$fields);

    $foreign_tables_array = array_filter($foreign_tables_array_padded_with_false,function($elem){
      return $elem && $elem != 'status' && $elem != 'approval'?$elem:false;
    });

    echo json_encode($foreign_tables_array);
  }

  function directory_iterator(){
    $app_name = 'Core';
    
    $files_array = directory_iterator(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'Packages'.DIRECTORY_SEPARATOR.ucfirst($app_name).DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR);

    $files = array_keys($files_array);

    $context_tables = array_filter($files,function($file){
      return substr($file,0,8) == 'Context_' && !strpos($file,'definition',8) &&  !strpos($file,'global',8) ?$file:false;
    });

    echo json_encode($context_tables);
  }

  function create_context_files($table_name = '',$app_name = ''){
    $contexts = ['level_one','level_two','level_three'];
    $app_name = 'Core';

    foreach($contexts as $context){
      $this->grants_model->create_context_files('context_'.$context,$app_name);
    }
    
    echo json_encode($this->directory_iterator());
  }

}