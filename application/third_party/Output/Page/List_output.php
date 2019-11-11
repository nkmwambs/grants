<?php

$path_parts = pathinfo(__FILE__);

class List_output{

    private $CI = null;

    function __construct(){
        $this->CI =& get_instance();
    }

    function output(){
        return $this->list_output();
    }

    function list_output(){

        $table = $this->CI->controller;
      
        $this->CI->grants->mandatory_fields($table);
      
        $result = $this->CI->grants->list_query();
        $keys = $this->CI->grants_model->list_select_columns();
        //$has_details = $this->check_if_table_has_detail_table();
        $show_add_button = $this->CI->grants->show_add_button();
      
        return array(
          'keys'=> $keys,
          'table_body'=>$result,
          'table_name'=> $table,
          'has_details_table' => $this->CI->grants->check_if_table_has_detail_table($table),
          'has_details_listing' => $this->CI->grants->check_if_table_has_detail_listing($table),
          'show_add_button'=>$show_add_button
        );
      }

}

require_once(__DIR__.DIRECTORY_SEPARATOR.'create_instance.php');