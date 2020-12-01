<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  //print_r($result);

  extract($result);

  $form = $this->element;

  $table = $form->create_single_form_add($this->controller, $fields,'edit_form');
  echo $form->add_form('Add '.$this->controller,$table);
?>

