<?php
require "vendor/autoload.php";
use PHPUnit\Framework\TestCase;

class GrantsTest extends TestCase{

    function setUp(): void
    {

    }

    function test_true(){
        $this->assertTrue(true);
    }
}