<?php

class Bank_model_test extends TestCase{
    public function setUp(): void
    {
        $this->resetInstance();
        $this->CI->load->model('Bank_model');
        $this->obj = $this->CI->Bank_model;
    }

    function test_delete_returns_true(){
        $expects = true;

        $delete = $this->obj->delete(1);

        $this->assertTrue($delete);
    }
}