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
                         <li><?=get_phrase('attachments');?></li>
                         <li class="divider"></li>
                         <?php
                           if($is_approveable_item) {
                             if(is_array($action_labels) && count($action_labels) > 0){
                               foreach ($action_labels as $next_status_id => $action_label) {
                             ?>
                                <li><a href="#"><?=get_phrase($action_label);?></a></li>
                                <li class="divider"></li>
                             <?php
                           }

                             }


                           }
                          ?>
                       </ul>
                     </div>
