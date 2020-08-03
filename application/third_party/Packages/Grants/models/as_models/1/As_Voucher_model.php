<?php

class As_Voucher_model extends MY_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function get_transaction_voucher($id){
        
        $result = ['Hello','World'];

        return $result;
    }
}