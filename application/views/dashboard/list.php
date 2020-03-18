<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  //print_r($this->session->user_hierarchy_offices);
  //print_r($this->user_model->get_user_context_definition(1));
  print_r($this->user_model->user_hierarchy_offices(1));

  //print_r($this->grants->context_definitions());
?>

  <div class="row">
    <div class="col-sm-12">
      <div class="well">
        <h1><?=date('F, d Y')?></h1>
        <h3>Welcome to the site <strong><?=$this->session->name;?></strong></h3>
      </div>
    </div>
  </div>

  


