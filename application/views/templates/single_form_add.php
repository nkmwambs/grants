<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  // $fld = new Fields_base('project_end_date','project');

  // print_r($fld->is_field_required());

  extract($result);

  $form = $this->element;

  $table = $form->create_single_form_add($this->controller, $fields,'edit_form');
  echo $form->add_form('Add '.$this->controller,$table);
?>

