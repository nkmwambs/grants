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
                          ?>
                             <li><?=list_table_approval_action($table,$primary_key);?></li>
                            <li class="divider"></li>
                             <li><?=list_table_decline_action($table,$primary_key);?></li>

                          <?php
                           }
                          ?>
                       </ul>
                     </div>
