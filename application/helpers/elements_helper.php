<?php 

if ( ! function_exists('select_element')){
    function select_element(Array $elements, String $placeholder,Array $classes = array(), String $id = ''){
            $select = "<select id='".$id."' class='form-control ".implode(' ',$classes)."'>
                    <option>".get_phrase('select_'.$placeholder)."</option>";
                    
                    foreach($elements as $element_key=>$element_value){
                        $select .= "<option value='".$element_key."'>".ucfirst($element_value)."</option>";    
                    }
    
            $select .= "</select>";

        return $select;          
    }
          
}

if ( ! function_exists('div_element')){
    function div_element($content = array(), $classes = array(), $id = ''){
        $div = "<div id='".$id."' class='".implode(' ',$classes)."'>";
            foreach($content as $elem){
                $div .= $elem;
            }
        $div .= "</div>";

        return $div;
    }
}

if ( ! function_exists('label_element')){
    function label_element($content, $classes = array(), $id = ''){
        return "<label id='".$id."' class='control-label ".implode(' ',$classes)."'>".$content."</label>";
    }
}

if ( ! function_exists('input_element')){
    function input_element(String $value = '', String $placeholder = '', Array $classes = array(), String $id = '', Array $parameters = array()){

        $_vars = '';

        foreach($parameters as $vars_key=>$vals){
            $_vars .= $vars_key.'='.$vals.' ';
        }

        return "<input type='text' placeholder='".$placeholder."' value='".$value."' ".$_vars." id='".$id."' class='form-control ".implode(' ',$classes)."' />";
    }
}

