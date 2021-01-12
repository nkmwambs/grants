<?php

if(!function_exists('office_bank_select')){
    function office_bank_select($office_id,$project_allocation_id = 0){

        $CI =& get_instance();
        $CI->load->model('office_bank_model');

        $option = "<option value=''>".get_phrase('select_office_bank')."</option>";

        $office_banks = $CI->office_bank_model->get_office_banks($office_id);

        foreach($office_banks as $office_bank){
            $option .= "<option value='".$office_bank['office_bank_id']."'>".$office_bank['office_bank_name']."</option>";
        }

        return '<select data-project_allocation_id = "'.$project_allocation_id.'" class="form-control change_office_bank">'.$option.'</select>';
    }

    if(!function_exists('get_related_voucher')){
        function get_related_voucher($voucher_id){
            $CI =& get_instance();
            return $CI->db->get_where('voucher',array('voucher_id'=>$voucher_id))->row()->voucher_number;
        }
    }
}