<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//print_r($this->general_model->current_approval_actor(41));
//print_r($this->grants_model->approveable_item('office_bank'));
// print_r($this->session->context_offices);
// print_r($this->user_model->get_user_context_offices(1));
//print_r($this->session->user_account_system);
//  $string='Kenya National Office-account & system  ';
//  echo sanitize_characters($string);
?>

  <div class="row">
    <div class="col-sm-12">
      <div class="well">
        <h1><?=date('F, d Y')?></h1>
        <h3>Welcome to the site <strong><?=$this->session->name;?></strong></h3>
      </div>
    </div>
  </div>

  <div class='row'>
    <div class='col-xs-12'>
      <div class='btn btn-default' id='btn_test'>Test</div>
    </div>
  </div>

<script>
$("#btn_test").on('click',function(){
  var url = "<?=base_url();?><?=$this->controller;?>/custom_ajax_call";
  var data = {'ajax_method':'testing','return_as_json':false};

  $.post(url,data,function(response){
    alert(response);
  });
});
</script>


