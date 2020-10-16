<?php

class Grants_model_test extends TestCase{
    public function setUp(): void
    {
        $this->resetInstance();
        $this->CI->load->model('Grants_model');
        $this->obj = $this->CI->Grants_model;
    }

    function test_upload_attachment_is_true(){
        $expected = true;

        $list = $this->obj->upload_attachment(1);

        $this->assertTrue($list);
    }
}