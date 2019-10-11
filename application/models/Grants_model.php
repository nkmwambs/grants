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

  function __construct(){
    parent::__construct();
  }

  function index(){

  }

  function list($lookup_tables,$table_name = "",$id = ""){
    // This $this->controller is a public parameter of the MY_Controller
    $table = $table_name == "" ? strtolower($this->controller) : $table_name;

    //$this->select_columns($table);

    if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          $lookup_table_id = $lookup_table.'_id';
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }

    //Allow a list result with an id condition
    if($id !== ""){
      $this->db->where(array('fk_'.$this->controller.'_id'=> hash_id($id,'decode') ));
    }

    return $this->db->get($table)->result_array();
  }

  function select_columns($table = "",$table_as_master = false){

    $table = $table == "" ? $this->controller : $table;

    $table_columns = $this->grants->table_columns($table,$this->grants->table_hidden_columns($table));

    if($table_as_master){
      if(is_array($this->grants->table_visible_columns($table,true)) && count($this->grants->table_visible_columns($table,true)) > 0 ){
        $table_columns = $this->grants->table_visible_columns($table,true);
      }else{
        $table_columns = $this->grants->table_columns($table,$this->grants->table_hidden_columns($table,true));
      }
    }else{
      if(is_array($this->grants->table_visible_columns($table)) && count($this->grants->table_visible_columns($table)) > 0 ){
        $table_columns = $this->grants->table_visible_columns($table);
      }
    }

    $this->db->select($table_columns);
  }

  function edit(){

  }

  function add(){

  }

  function view($detail_tables = array()){

    // This $this->controller is a public parameter of the MY_Controller
    $table = strtolower($this->controller);

    $model = $this->current_model;

    $this->select_columns($table);

    $lookup_tables = $this->grants->lookup_tables($table);

    $lookup_table_ids = array();

    if( is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          //Add lookup ids in the columns select
          $lookup_table_ids[] = $lookup_table."_id";

          //Create table joins
          $lookup_table_id = $lookup_table.'_id';
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }

    //Additonal select columns for lookup ids
    if(count($lookup_table_ids)>0){
      $this->db->select($lookup_table_ids);
    }

    $data = array();

    $data['master'] = (array)$this->db->get_where($table,array($table.'_id'=> hash_id($this->uri->segment(3,0),'decode') ))->row();
    $data['master_table_name'] = $table;
    // Get the name of the record creator
    $data['created_by'] = 1;//$data['master'][$table.'_created_by']>1? $this->db->select('CONCAT(`first_name`," ",`last_name`) as user_name')->get_where('user',
    //array('user_id'=>$data['master'][$table.'_created_by']))->row()->user_name:get_phrase('creator_user_not_set');

    //Get the name of the last record modifier
    $data['last_modified_by'] = 1;//$data['master'][$table.'_last_modified_by'] > 1? $this->db->select('CONCAT(`first_name`," ",`last_name`) as user_name')->get_where('user',
    //array('user_id'=>$data['master'][$table.'_last_modified_by']))->row()->user_name:get_phrase('modifier_user_not_set');

    if(is_array($detail_tables) && count($detail_tables) > 0 ){
      foreach ($detail_tables as $detail_table) {
          //$this->select_columns($detail_table);
          $data['detail'][$detail_table]= $this->grants->list_result($detail_table,'list');//return second arg as list and resolve the error
      }
    }

    return $data;
  }

  function get_all_table_fields($table_name = ""){
    $table = $table_name == ""?$this->controller:$table_name;
    return $this->db->table_exists($table)?$this->db->list_fields($table):array();
  }

}
