<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  //print_r(explode('/',$_SERVER['REQUEST_URI']));
?>

  <div class="row">
    <div class="col-sm-12">
      <div class="well">
        <h1><?=date('F, d Y')?></h1>
        <h3>Welcome to the site <strong><?=$this->session->name;?></strong></h3>
      </div>
    </div>
  </div>

  


