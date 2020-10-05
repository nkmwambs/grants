<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//print_r($this->session->hierarchy_offices);
//print_r($this->session->context_associations);

//echo budget_review_buffer_month(10);

if ($this->session->system_admin) {

  //print_r($this->session->hierarchy_offices);
  //echo hash_id('1Oz3jEmZWr','decode');

  $this->read_db->join('account_system', 'account_system.account_system_id=bank.fk_account_system_id');
  $lookup_values['bank'] = $this->read_db->get_where('bank',array('account_system_code'=>$this->session->user_account_system))->result_array();
  print_r($lookup_values);
  //print_r($this->session->context_definition['context_definition_id']);

}

?>

<div class="row">
  <div class="col-sm-12">
    <div class="well">
      <h1><?= date('F, d Y') ?></h1>
      <h3>Welcome to the site <strong><?= $this->session->name; ?></strong></h3>
    </div>
  </div>
</div>

<!-- <div class='row'>
    <div class='col-xs-12'>
      <div class='btn btn-default' id='btn_test'>Test</div>
    </div>
  </div> -->

<script>
  $("#btn_test").on('click', function() {
    var url = "<?= base_url(); ?><?= $this->controller; ?>/custom_ajax_call";
    var data = {
      'ajax_method': 'testing',
      'return_as_json': false
    };

    $.post(url, data, function(response) {
      alert(response);
    });
  });
</script>