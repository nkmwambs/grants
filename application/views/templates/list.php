<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//print_r($result);

//$current_month = 9;
//echo month_after_adding_size_of_budget_review_period($current_month);
//$a = financial_year_quarter_months(month_after_adding_size_of_budget_review_period($current_month));
//print_r(end($a['months_in_quarter']));

// $lookup_values = $this->budget_model->lookup_values();
// print_r($lookup_values['budget_tag']);

extract($result);
//echo $is_multi_row;
?>

<div class="row">
  <div class="col-xs-12">
    <?=Widget_base::load('view');?>
  </div>
</div>

<hr/>

<div class="row" style="margin-bottom:25px;">
  <div class="col-xs-12" style="text-align:center;">

    <?php
    if($show_add_button && $this->user_model->check_role_has_permissions(ucfirst($this->controller),'create')){
      echo add_record_button($this->controller, $has_details_table,null,$has_details_listing, $is_multi_row);
    }
    ?>
    <?=Widget_base::load('position','position_1');?>
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

            $require_originator_action = $this->general_model->status_require_originator_action($row['status_id'])
        ?>
          <tr>
              <td>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                    <?=get_phrase('action');?> 
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <?php if($this->user_model->check_role_has_permissions(ucfirst($this->controller),'update') ){ ?>
                    <li><?=list_table_edit_action($this->controller,$primary_key);?></li>
                    <li class="divider"></li>
                    <?php }?>
                    <?php if($this->user_model->check_role_has_permissions(ucfirst($this->controller),'delete') && $require_originator_action){ ?>
                    <li><?=list_table_delete_action($this->controller,$primary_key);?></li>
                    <?php }?>

                    <?php if(
                        !$this->user_model->check_role_has_permissions(ucfirst($this->controller),'update') && 
                        !$this->user_model->check_role_has_permissions(ucfirst($this->controller),'delete') 
                        

                    ){ 
                        echo "<li><a href='#'>".get_phrase('no_action')."</a></li>";
                    }?>

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
                              echo '<a href="'.base_url().$this->controller.'/view/'.hash_id($primary_key).'">'.$row[$column].'</a>';
                            }elseif(strpos($column,'_is_') == true){
                                echo $row[$column] == 1?"Yes":"No";
                            }elseif($fields_meta_data[$column] == 'int' || $fields_meta_data[$column] == 'decimal'){    
                              // Defense code to ignore non numeric values when lookup values method changes value type from numeric to non numeric
                              echo is_numeric($row[$column])?number_format($row[$column],2):$row[$column];
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