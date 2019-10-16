<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
//print_r($result);

extract($result['master']);

//Remove the primary key field from the master table
$master_primary_key = $table_body[$this->controller.'_id'];
unset($table_body[$this->controller.'_id']);
unset($keys[array_search($this->controller.'_id',$keys)]);

// Make the master detail table have columns as per the config
$columns = array_chunk($keys,$this->config->item('master_table_columns'),true);

?>

<div class="row">
  <div class="col-xs-12">
    <table class="table table-striped">
      <thead>
        <tr><th colspan="<?=$this->config->item('master_table_columns');?>" style="text-align:center;"><?=ucwords(str_replace("_"," ",$this->uri->segment(1)));?> Master Record</th></tr>
        <?php if($is_approveable_item){?>
        <tr>
          <th colspan="<?=$this->config->item('master_table_columns')?>" style="text-align:center;">
              <div class="btn btn-default"><?=get_phrase('approve_all_'.$this->controller.'_details');?></div>
              <div class="btn btn-default"><?=get_phrase('decline_all_'.$this->controller.'_details');?></div>
          </th>
        </tr>
      <?php }?>
      </thead>
      <tbody>


        <?php

            foreach ($columns as $row) {
          ?>
            <tr>
          <?php
              //$primary_table_name = "";
              foreach ($row as $column) {
                $column_value = $table_body[$column];
                //$lookup_table_primary_key = "";
                // Do not show deleted at column
                if( strpos($column,'_deleted_at') == true) continue;

                if(strpos($column,'_created_by') == true){
                    $column_value = $table_body['created_by'];
                }

                if(strpos($column,'_last_modified_by') == true ){
                    $column_value = $table_body['last_modified_by'];
                }

                if(strpos($column,'_id') == true ){
                    continue;
                }

          ?>
                <td>
                  <span style="font-weight:bold;"><?=ucwords(str_replace("_"," ",$column));?>:</span> &nbsp;
                  <?php
                    if(strpos($column,'is_active')){
                      echo $column_value == 1?get_phrase('yes'):get_phrase('no');

                    }elseif(strpos($column,'_name') && substr($column,0,-5) !== $table_name ){
                        $primary_table_name = substr($column,0,-5);
                        //echo $primary_table_name;
                        $lookup_table_id = $table_body[$primary_table_name.'_id'];
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

    if( isset($result['detail']) && count($result['detail']) > 0){

      foreach ($result['detail'] as $detail_table_name => $details) {
        extract($details);

        $primary_key_column = array_shift($keys);
        ?>

        <hr/>

        <div class="row" style="margin-bottom:25px;">
          <div class="col-xs-12" style="text-align:center;">
            <?=add_record_button($detail_table_name,$has_details_table,$has_details_listing);?>
          </div>
        </div>
          <table class="table table-striped datatable_details">
            <thead>
              <!--Add one to count of keys because of the action column that has been added in this view s-->
              <tr><th colspan="<?=count($keys) + 1;?>"><?=ucwords(str_replace("_"," ",$detail_table_name));?></th></tr>
              <?=render_list_table_header($detail_table_name,$keys);?>
            </thead>
            <tbody>
              <?php foreach ($table_body as $row) { ?>
                <tr>
                  <td>
                      <?php
                        echo $this->grants->action_list($detail_table_name,$row[$detail_table_name.'_id'],$is_approveable_item);
                      ?>
                  </td>
                  <?php
                      $primary_key = 0;
                      foreach ($keys as $column){
                        $primary_key = $row[$primary_key_column]
                  ?>
                        <td>

                          <?php
                          if(isset($row[$column])){
                            if(strpos($column,'track_number') == true && $has_details_table == 1 ){
                              echo '<a href="'.base_url().strtolower($detail_table_name).'/view/'.hash_id($primary_key).'">'.$row[$column].'</a>';
                            }elseif(strpos($column,'is_active') == true){
                                echo $row[$column] == 1?"Yes":"No";
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
    }
    ?>
  </div>
</div>
