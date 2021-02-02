<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//print_r(array_column($this->session->hierarchy_offices,"office_id"));
//print_r($this->project_allocation_model->get_office_group_lead_office_id(1));

if ($this->session->system_admin) {
  //print_r(count($this->user_model->user_hierarchy_offices(27)));//38, 27
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
<?php 
  //print_r(get_fy('2020-02-01'));
?>  

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