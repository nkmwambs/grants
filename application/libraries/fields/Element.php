<?php 

class Element{
    // public $_id;
    // public $_value;
    // public $_classes;
    // public $_data;
    // public $_style;
    // public $_disabled;
    // public $_readonly;
    // public $_parameters;
  
    function __construct(){
    
    }
  
    static function Input($params = ['value'=>'','id'=>'','placeholder'=>'','classes'=>array(),'parameters'=>array()]){
      
      extract($params);

      $_value = (isset($value))?$value:'';
      $_id = (isset($id))?$id:'';
      $_placeholder = (isset($placeholder))?$placeholder:'';
      $_classes = (isset($classes))?$classes:[];
      $_parameters = (isset($parameters))?$parameters:[];
      
      return input_element($_value,$_placeholder,$_classes,$_id,$_parameters);
    }

    static function Div(){

    }

    static function Select($params = ['value'=>'','id'=>'']){
      
    }

    static function Label($params = ['value'=>'','id'=>'']){
      
    }

  
  }