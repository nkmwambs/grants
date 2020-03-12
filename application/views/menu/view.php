<?php

$chunk = array_chunk($this->session->user_more_menu,$this->config->item('extra_menu_item_columns'),true);
?>
<div class='row'>
    <div class='col-xs-12'>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="<?=$this->config->item('extra_menu_item_columns');?>">More Menus</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            $lib = "";
            $menu_icon = "fa fa-bars";
            foreach($chunk as $column){

             ?>
            <tr>
             <?php   
            foreach ($column as $user_menu => $user_menu_item) {
                if($this->user_model->check_role_has_permissions($user_menu,'read')){
        ?>  
                
                    <td>
                    <a href="<?=base_url().$user_menu;?>/list">
                            <i class="<?=$menu_icon;?>"></i>
                            <span class="title"><?=get_phrase(strtolower($user_menu));?></span>
                    </a>
                   </td> 
                   
        <?php
                }
            }
         ?>
            </tr>
         <?php   
        }
        ?>
        </tbody>
        </table>
    </div>
</div>