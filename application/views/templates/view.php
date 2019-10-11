<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//Remove the primary key field from the master table
unset($result['master'][$this->controller.'_id']);

// Make the master detail table have columns as per the config
$columns = array_chunk($result['master'],$this->config->item('master_table_columns'),true);
//print_r($result);
?>

<div class="row">
  <div class="col-xs-12">
    <table class="table table-striped">
      <thead>
        <tr><th colspan="3" style="text-align:center;"><?=ucwords(str_replace("_"," ",$this->uri->segment(1)));?> Master Record</th></tr>
      </thead>
      <tbody>
        <?php

            foreach ($columns as $row) {
          ?>
            <tr>
          <?php
              //$primary_table_name = "";
              foreach ($row as $column_label => $column_value) {
                // Do not show deleted at column
                if( strpos($column_label,'_deleted_at') == true) continue;

                if(strpos($column_label,'_created_by') == true){
                    $column_value = $result['created_by'];
                }

                if(strpos($column_label,'_last_modified_by') == true ){
                    $column_value = $result['last_modified_by'];
                }

                if(strpos($column_label,'_id') == true ){
                    continue;
                }

          ?>
                <td>
                  <span style="font-weight:bold;"><?=ucwords(str_replace("_"," ",$column_label));?>:</span> &nbsp;
                  <?php
                    if(strpos($column_label,'is_active')){
                      echo $column_value == 1?get_phrase('yes'):get_phrase('no');

                    }elseif(strpos($column_label,'_name') && substr($column_label,0,-5) !== $result['master_table_name'] ){
                        $primary_table_name = substr($column_label,0,-5);
                        //echo $primary_table_name;
                        $lookup_table_id = $result['master'][$primary_table_name.'_id'];
                        echo '<a href="'.base_url().$primary_table_name.'/view/'.hash_id($lookup_table_id).'">'.$column_value.'</a>';
                    }else{
                      echo $column_value;
                    }
                  ?>
                </td>
          <?php
              }
          ?>
              </tr>
          <?php
            }
          ?>

      </tbody>
    </table>
    <?php

      foreach ($result['detail'] as $detail_table_name => $details) {
        extract($details);

        $primary_key_column = array_shift($keys);
        ?>

        <hr/>

        <div class="row" style="margin-bottom:25px;">
          <div class="col-xs-12" style="text-align:center;">
            <?=add_record_button($detail_table_name);?>
          </div>
        </div>
          <table class="table table-striped datatable_details">
            <thead>
              <!--Add one to count of keys because of the action column that has been added in this view s-->
              <tr><th colspan="<?=count($keys) + 1;?>"><?=ucwords(str_replace("_"," ",$detail_table_name));?></th></tr>
              <?=render_list_table_header($detail_table_name,$keys);?>
            </thead>
            <tbody>
              <?php foreach ($details['table_body'] as $row) { ?>
                <tr>
                  <td>
                    <span><a href="#"><?=get_phrase('edit');?></a></span> &nbsp;
                    <span><a href="#"><?=get_phrase('delete');?></a></span>
                  </td>
                  <?php
                      $primary_key = 0;
                      foreach ($keys as $column){
                        $primary_key = $row[$primary_key_column]
                  ?>
                        <td>

                          <?php
                          if(isset($row[$column])){
                            if(strpos($column,'track_number') == true && $details['has_details'] == 1 ){
                              echo '<a href="'.base_url().strtolower($detail_table_name).'/view/'.hash_id($primary_key).'">'.$row[$column].'</a>';
                            }elseif(strpos($column,'is_active') == true){
                                echo $td_value == 1?"Yes":"No";
                            }elseif(is_integer($row[$column])){
                                  echo number_format($row[$column],2);
                            }else{
                                echo ucfirst($row[$column]);
                            }
                          }else{
                            echo get_phrase('value_not_set');
                          }
                          ?>
                        </td>
                  <?php
                      }
                  ?>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        <?php
      }
    ?>
  </div>
</div>
