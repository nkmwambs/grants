<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fields_base{

  private $column;

  private $table;

  private $is_header = false;

  private $CI = null;

  private $default_field_value = null;
  
  function __construct($column, $table, $is_header = false){

    $this->CI =& get_instance();

    $this->column = $column;

    $this->table = $table;

    $this->is_header = $is_header;

    $this->set_default_field_value();
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
         
        // All fields of format fk_xxx_id are select types
        if(strpos($this->column,'_id') == true && substr($this->column,0,3) == 'fk_' ){
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

  private function input_fields($value){

    $id = "";
    $name = 'detail['.$this->column.'][]';
    $master_class = "detail";

    if($this->is_header){
      $id = $this->column;
      $name = 'header['.$this->column.']';
      $master_class = 'master';
    }

    $value = ($value == "" && $this->default_field_value !== 0 ) ? $this->default_field_value : $value;

    return array('id'=>$id,'name'=>$name,'master_class'=>$master_class,'value'=>$value);
  }
  
  function set_default_field_value(){
    
    $library = $this->CI->controller.'_library';

    if(method_exists($this->CI->$library,'default_field_value')){
     
      $default_fields_values = $this->CI->$library->default_field_value();
     
      if(array_key_exists($this->column,$default_fields_values)){
        $this->default_field_value = $default_fields_values[$this->column];
      }
    }

    return $this->default_field_value;
  }

  function number_field($value = 0){

    extract($this->input_fields($value));

    return '<input id="'.$id.'" required="required" type="number" value="'.$value.'" class="form-control '.$master_class.' input_'.$this->table.' '.$this->column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" />';
  }

  function text_field($value = ""){

    extract($this->input_fields($value));

    return '<input id="'.$id.'" value="'.$value.'" required="required" type="text" class="form-control '.$master_class.' input_'.$this->table.' '.$this->column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" />';
  }

  function email_field($value = ""){

    extract($this->input_fields($value));

    return '<input id="'.$id.'" value="'.$value.'" required="required" type="email" class="form-control '.$master_class.' input_'.$this->table.' '.$this->column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" />';
  }

  function password_field($value = ""){

    extract($this->input_fields($value));

    return '<input id="'.$id.'" value="'.$value.'" required="required" type="password" class="form-control '.$master_class.' input_'.$this->table.' '.$this->column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" />';
  }

  function longtext_field($value = ""){

    extract($this->input_fields($value));

    return '<textarea id="'.$id.'" required="required" class="form-control '.$master_class.' input_'.$this->table.' '.$this->column.' " name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" >'.$value.'</textarea>';
  }

  function date_field($value = ""){

    extract($this->input_fields($value));

    return '<input id="'.$id.'" value="'.$value.'" data-format="yyyy-mm-dd" required="required" readonly="readonly" type="text" class="form-control '.$master_class.' datepicker input_'.$this->table.' '.$this->column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$this->column))).'" />';
  }

  function select_field($options, $selected_option = 0){

    $id = "";

    $column_placeholder = $this->column;

    if(substr($this->column,0,3) == 'fk_'){
      $column_placeholder = substr($this->column,3,-3);
    }

    $name = 'detail['.$this->column.'][]';
    $master_class = "detail";

    if($this->is_header){
      $id = $this->column;
      $name = 'header['.$this->column.']';
      $master_class = 'master';
    }


    $this->set_default_field_value();
   
    $selected_option = ($selected_option == "" && $this->default_field_value !== 0 ) ? $this->default_field_value : $selected_option;

    $select =  "<select id='".$id."' name='".$name."' class='form-control ".$master_class." input_".$this->table." ".$this->column." ' required='required'>
            <option value='0'>".get_phrase('select_'.ucwords(str_replace('_',' ',$column_placeholder)))."</option>";

            foreach ($options as $option_value=>$option_html) {
              $selected = "";
              if($option_value == $selected_option){
                  $selected = "selected='selected'";
              }
              $select .= "<option value='".$option_value."' ".$selected.">".get_phrase($option_html)."</option>";
            }

    $select .= "</select>";

    return $select;
  }


}
