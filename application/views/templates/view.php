<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//print_r($result['detail']['project_allocation']);

extract($result['master']);

$this->grants->unset_lookup_tables_ids($keys);

// Make the master detail table have columns as per the config
$columns = array_chunk($keys,$this->config->item('master_table_columns'),true);

?>
<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('comment');?>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('position','position_1');?>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <table class="table table-striped">
      <thead>
        <tr>
          <th colspan="<?=$this->config->item('master_table_columns');?>" style="text-align:center;"><?=get_phrase($this->uri->segment(1).'_master_record');?>
          </th>
        </tr>

        <tr>
          <th colspan="<?=$this->config->item('master_table_columns');?>" style="text-align:center;">
              <?=Widget_base::load('button',get_phrase('edit'),$this->controller.'/edit/'.$this->id);?>
              <?=Widget_base::load('button',get_phrase('delete'),$this->controller.'/delete/'.$this->id);?>
              
              <?php 
                  $action_labels = $this->grants->action_labels($this->controller,hash_id($this->id,'decode'));
                  //print_r($action_labels);
                  if( isset($action_labels['show_label_as_button']) && $action_labels['show_label_as_button']){
              
                  echo Widget_base::load('button',$action_labels['button_label'],$this->controller.'/approve/'.$this->id);
                            
                  if($action_labels['show_decline_button']){
                    echo Widget_base::load('button',get_phrase('decline'),$this->controller.'/decline/'.$this->id);
              
                  }

                  }
               ?>     
                   

              <?=Widget_base::load('position','position_2');?>
          </th>
        </tr>
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
                
                // Implement these skips in the before Output
                //if( strpos($column,'_deleted_at') == true) continue;
              

                if(strpos($column,'_created_by') == true){
                    $column_value = $table_body['created_by'];
                }

                if(strpos($column,'_last_modified_by') == true ){
                    $column_value = $table_body['last_modified_by'];
                }


          ?>
                <td>
                  <span style="font-weight:bold;"><?=get_phrase($column);?>:</span> &nbsp;
                  <?php
                    if(strpos($column,'is_')){
                      echo $column_value == 1?get_phrase('yes'):get_phrase('no');

                    }elseif(in_array($column,$lookup_name_fields) ){
                        $primary_table_name = substr($column,0,-5);
                        $lookup_table_id = $table_body[$primary_table_name.'_id'];
                        echo '<a href="'.base_url().$primary_table_name.'/view/'.hash_id($lookup_table_id).'">'.ucwords(str_replace('_',' ',$column_value)).'</a>';
                    }else{
                        echo ucwords(str_replace('_',' ',$column_value));
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
    <div class="row">
      <div class="col-xs-12">
        <?=Widget_base::load('position','position_3');?>
      </div>
    </div>
    <?php

    if( isset($result['detail']) && count($result['detail']) > 0){

      foreach ($result['detail'] as $detail_table_name => $details) {
        extract($details);

        $primary_key_column = array_shift($keys);
        ?>

        <hr/>

        <div class="row" style="margin-bottom:25px;">
          <div class="col-xs-12" style="text-align:center;">
            
            <?php
              if($show_add_button){
                echo add_record_button($detail_table_name,$has_details_table,$this->uri->segment(3,null),$has_details_listing);
              }
            ?>
          </div>
        </div>
          <table class="table table-striped datatable_details">
            <thead>
              <!--Add one to count of keys because of the action column that has been added in this view s-->
              <tr><th colspan="<?=count($keys) + 1;?>"><?=ucwords(str_replace("_"," ",$detail_table_name));?></th></tr>
              <?=render_list_table_header($detail_table_name,$keys);?>
            </thead>
            <tbody>
              <?php foreach ($table_body as $row) {
                //print_r($row);
                ?>
                <tr>
                  <td>
                      <?php
                        echo $this->grants->action_list($detail_table_name,$row[$detail_table_name.'_id'],$is_approveable_item);
                      ?>
                  </td>
                  <?php
                      
                      $primary_key = 0;
                      
                      $column_key = 0;

                      $lookup_table = "";
                      
                      foreach ($keys as $column){
                        $primary_key = $row[$primary_key_column];
                        
                        if(strpos($column,'_id') == true && 
                            !$this->grants->is_primary_key_field($detail_table_name,$column) 
                          ){

                          //$column_key = $row['fk_'.$column];
                          // Remove the id suffix

                          $lookup_table = substr($column,0,-3);
                          continue;
                        }

                  ?>
                        <td>

                          <?php
                          if(isset($row[$column]) && array_key_exists($column,$row) ){
                            if(strpos($column,'track_number') == true && $has_details_table == 1 ){
                              echo '<a href="'.base_url().strtolower($detail_table_name).'/view/'.hash_id($primary_key).'">'.$row[$column].'</a>';
                            }elseif(strpos($column,'_is_active') == true){
                                echo $row[$column] == 1?"Yes":"No";
                            }elseif(is_integer($row[$column])){
                                  echo number_format($row[$column],2);
                            }elseif($column_key > 0){ 
                               echo '<a href="'.base_url().strtolower($lookup_table).'/view/'.hash_id($column_key).'">'.ucwords(str_replace('_',' ',$row[$column])).'</a>';
                            }else{
                                echo ucfirst($row[$column]);
                            }
                          }
                          else{
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

