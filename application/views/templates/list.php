<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
//print_r($this->user_model->check_role_has_permissions('Bank','read'));


extract($result);
//echo isset($this->session->master_table)?$this->session->master_table:"Not set";
?>

<div class="row">
  <div class="col-xs-12">
    <form>
      <label for="" class="label-control col-xs-3" style="text-align:right;font-weight:bold;"><?=get_phrase('views');?></label>
      <div class="col-xs-6">
        <select class="form-control">
          <option>Select a view</option>
        </select>
      </div>
      <div class="col-xs-3"> <a href="#"><?=get_phrase('create_view');?></a>  &nbsp; <a href="#"><?=get_phrase('edit_view');?></a> &nbsp; <a href="#"><?=get_phrase('clone_view');?></a></div>
    </form>
  </div>
</div>

<hr/>

<div class="row" style="margin-bottom:25px;">
  <div class="col-xs-12" style="text-align:center;">

    <?php
    if($show_add_button){
      echo add_record_button($this->controller, $has_details_table,null,$has_details_listing);
    }
    ?>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <table class="table table-striped datatable">
      <thead><?=render_list_table_header($table_name,$keys);?></thead>
      <tbody>
        <?php
          $primary_key = 0;
          $primary_table = "";
          if(isset($table_body)){
            $primary_key = 0;
            $primary_key_column = array_shift($keys);

          foreach ($table_body as $row) {
            $primary_key = $row[$primary_key_column];
        ?>
          <tr>
              <td>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                    <?=get_phrase('action');?>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <li><?=list_table_edit_action($this->controller,$primary_key);?></li>
                    <li class="divider"></li>
                    <li><?=list_table_delete_action($this->controller,$primary_key);?></li>
                    <li class="divider"></li>
                    <li><a href="#"><?=get_phrase('attachments');?></a></li>

                  </ul>
                </div>
              </td>
              <?php

                  foreach ($keys as $column) {

                        if(strpos($column,'_key') == true){
                          continue;
                        }
                ?>
                        <td>
                          <?php

                            if(strpos($column,'track_number') == true ){
                              echo '<a href="'.base_url().strtolower($this->controller).'/view/'.hash_id($primary_key).'">'.$row[$column].'</a>';
                            }elseif(strpos($column,'is_active') == true){
                                echo $row[$column] == 1?"Yes":"No";
                            }else{
                              echo ucfirst(str_replace("_"," ",$row[$column]));
                            }

                           ?>
                        </td>
                <?php }?>

          </tr>

        <?php
              }
          }
        ?>

      </tbody>
    </table>
  </div>
</div>

<script>
  
</script>