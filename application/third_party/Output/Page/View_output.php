<?php 

$path_parts = pathinfo(__FILE__);

class View_output extends Output_template{

    function __construct(){
        parent::__construct();
    }


    /**
     * view_output
     * 
     * This method returns the output of all view action views
     * 
     * @return array
     * 
     */

    function _output(){
        $table = $this->controller;
    
        $this->CI->grants_model->mandatory_fields($table);
    
        $query_output = $this->CI->grants->master_view();
        $keys = $this->CI->grants_model->master_select_columns();
        $has_details = $this->CI->grants->check_if_table_has_detail_table($table);
        $is_approveable_item = $this->CI->grants->approveable_item();
    
        $result['master'] = array(
            'keys'=> $keys,
            'table_body'=>$query_output,
            'table_name'=> $table,
            'has_details_table' => $has_details,
            'is_approveable_item' => $is_approveable_item,
            'action_labels'=>$this->CI->grants->action_labels($table,hash_id($this->CI->uri->segment(3,0),'decode'))
        );
    
        $detail_tables = $this->CI->grants->detail_tables($table);
    
        $result['detail'] = array();
    
        if($has_details){
            $detail = array();
            foreach ($detail_tables as $detail_table) {
            $detail[$detail_table] = $this->CI->grants->detail_list_view($detail_table);
            }
    
            $result['detail'] = $detail;
        }
    
        return $result;
    
    }

}

require_once(__DIR__.DIRECTORY_SEPARATOR.'create_instance.php');