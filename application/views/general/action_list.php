<?php  //print_r($action_labels); ?>
<div class="dropdown">
                       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                         <?=get_phrase('action');?>
                       <span class="caret"></span></button>
                       <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                         <li><?=list_table_edit_action($table,$primary_key);?></li>
                         <li class="divider"></li>
                         <li><?=list_table_delete_action($table,$primary_key);?></li>
                         <li class="divider"></li>
                         <?php
                           if($is_approveable_item) {

                             if( isset($action_labels['show_label_as_button']) && $action_labels['show_label_as_button']){
              
                              echo Widget_base::load('button',$action_labels['button_label'],$table.'/approve/'.hash_id($primary_key,'encode'));
                                        
                              if($action_labels['show_decline_button']){
                                echo Widget_base::load('button',get_phrase('decline'),$table.'/decline/'.hash_id($primary_key,'encode'));
                          
                              }

                              }


                           }
                          ?>
                       </ul>
                     </div>
