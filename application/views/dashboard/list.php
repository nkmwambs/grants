<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  //print_r($this->approval_model->show_label_as_button(15,1,'request',2));
  //print_r($this->approval_model->has_approval_status_been_set('budget_item'));
  //print_r($this->approval_model->display_approver_status_action(1,'request',2));
  echo approval_action_buttons(1,'request',2);
?>

  <div class="row">
    <div class="col-sm-12">
      <div class="well">
        <h1><?=date('F, d Y')?></h1>
        <h3>Welcome to the site <strong><?=$this->session->name;?></strong></h3>
      </div>
    </div>
  </div>

  


