<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//print_r($result);

extract($result);

?>

<div class="row">
  <div class="col-xs-12">
    <form>
      <label for="" class="label-control col-xs-3" style="text-align:right;font-weight:bold;">Views</label>
      <div class="col-xs-6">
        <select class="form-control">
          <option>Select a view</option>
        </select>
      </div>
      <div class="col-xs-3"> <a href="#">Create View</a>  &nbsp; <a href="#">Edit View</a> &nbsp; <a href="#">Clone View</a></div>
    </form>
  </div>
</div>

<hr/>

<div class="row" style="margin-bottom:25px;">
  <div class="col-xs-12" style="text-align:center;">
    <?=add_record_button($this->controller);?>
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
              <td nowrap="nowrap">
                <?=list_table_edit_action($this->controller,$primary_key);?> &nbsp;
                <?=list_table_delete_action($this->controller,$primary_key);?>
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
                              echo ucfirst($row[$column]);
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
