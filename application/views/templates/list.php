<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
//$perm = $this->session->role_permissions;
//print_r($this->session->role_permissions);
//print_r($this->user_model->check_role_has_permissions('Voucher','read'));
//print_r($this->user_model->permission_label_depth('create'));
//print_r($this->session->role_permissions);
//print_r($this->user_model->update_permitted_permission_labels_based_on_depth($perm,'Voucher','read',1));
//print_r($this->user_model->get_user_permissions(4));
extract($result);
//echo isset($this->session->master_table)?$this->session->master_table:"Not set";/ Create -> Read -> Update -> Delete
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
      echo add_record_button($this->controller, $has_details_table,null,$has_details_listing);
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
        ?>
          <tr>
              <td>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                    <?=get_phrase('action');?>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <?php if($this->user_model->check_role_has_permissions(ucfirst($this->controller),'update')){ ?>
                    <li><?=list_table_edit_action($this->controller,$primary_key);?></li>
                    <li class="divider"></li>
                    <?php }?>
                    <?php if($this->user_model->check_role_has_permissions(ucfirst($this->controller),'delete')){ ?>
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
                            //  }elseif($column !='approval_name' && $column!='status_name'){
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