<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fields_base{

  private $column;

  private $table;

  private $is_header = false;

  private $CI = null;

  function __construct($column, $table, $is_header = false){

    $this->CI =& get_instance();

    $this->column = $column;

    $this->table = $table;

    $this->is_header = $is_header;

  }

  function index(){

  }

  function field_type(){

    $all_fields = $this->CI->grants_model->table_fields_metadata($this->table);

    $array_of_columns = array_column($all_fields,'name');
    $array_of_types = array_column($all_fields,'type');

    $name_types = array_combine($array_of_columns,$array_of_types);

    $column_type = 'int';

    $field_type = 'number';

    if(strpos($this->column,'_name') == true  && $this->column !== $this->table.'_name'){
      $this->column = 'fk_'.substr($this->column,0,-5).'_id';
    }

    if(array_key_exists($this->column,$name_types)){
      $column_type  = $name_types[$this->column];

      if($column_type == 'int' || $column_type == 'decimal'){

        $field_type = "number";

        if(strpos($this->column,'_id') == true){
          $field_type = "select";
        }

      } elseif($column_type == 'varchar'){
        $field_type = "text";
      }elseif ($column_type == 'date') {
        $field_type = "date";
      }else{
        $field_type = "text";
      }

    }

    return $field_type;

  }

  function number_field(){
    $id = "";
    $name = 'detail['.$this->column.'][]';

    if($this->is_header){
      $id = $this->column;
      $name = 'header['.$this->column.']';
    }

    $value = 0;

    $library = $this->CI->controller.'_library';

    $method = $this->column.'_field_value';

    if(method_exists($this->CI->$library,$method)){
      $value = $this->CI->$library->$method();
    }

    return '<input id="'.$id.'" required="required" type="number" value="'.$value.'" class="form-control input_'.$this->table.' '.$this->column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" />';
  }

  function text_field(){

    $id = "";
    $name = 'detail['.$this->column.'][]';

    if($this->is_header){
      $id = $this->column;
      $name = 'header['.$this->column.']';
    }

    $value = "";

    $library = $this->CI->controller.'_library';

    $method = $this->column.'_field_value';

    if(method_exists($this->CI->$library,$method)){
      $value = $this->CI->$library->$method();
    }


    return '<input id="'.$id.'" value="'.$value.'" required="required" type="text" class="form-control input_'.$this->table.' '.$this->column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" />';
  }


  function date_field(){

        $id = "";
        $name = 'detail['.$this->column.'][]';

        if($this->is_header){
          $id = $this->column;
          $name = 'header['.$this->column.']';
        }

        $value = "";

        $library = $this->CI->controller.'_library';

        $method = $this->column.'_field_value';

        if(method_exists($this->CI->$library,$method)){
          $value = $this->CI->$library->$method();
        }

      return '<input id="'.$id.'" value="'.$value.'" data-format="yyyy-mm-dd" required="required" readonly="readonly" type="text" class="form-control datepicker input_'.$this->table.' '.$this->column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" />';
  }

  function select_field($options){

    $id = "";

    $column_placeholder = $this->column;

    if(substr($this->column,0,3) == 'fk_'){
      $column_placeholder = substr($this->column,3,-3);
    }

    $name = 'detail['.$this->column.'][]';

    if($this->is_header){
      $id = $this->column;
      $name = 'header['.$this->column.']';
    }

    $value = 0;

    $library = $this->CI->controller.'_library';

    $method = $this->column.'_field_value';

    if(method_exists($this->CI->$library,$method)){
      $value = $this->CI->$library->$method();
    }

    $select =  "<select id='".$id."' name='".$name."' class='form-control input_".$this->table." ".$this->column." ' required='required'>
            <option value='0'>".get_phrase('select_'.ucwords(str_replace('_',' ',$column_placeholder)))."</option>";

            foreach ($options as $option_value=>$option_html) {
              $selected = "";
              if($option_value == $value){
                  $selected = "selected='selected'";
              }
              $select .= "<option value='".$option_value."' ".$selected.">".$option_html."</option>";
            }

    $select .= "</select>";

    return $select;
  }


}
