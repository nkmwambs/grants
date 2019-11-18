<?php

//echo json_encode($result);

//$request_detail_id = array_shift($result[0]);

$fields = array_keys($result[0]);
array_shift($fields);

?>

<div class="row">
    <div class="col-xs-12" class="no-print" style="text-align:center;margin:10px;font-weight:bold;">
        Approved Request Details
    </div>
</div>

<table class="table table-striped datatable">
    <thead>
        <tr>    
            <?php 
                foreach($fields as $field){
                    if($field == 'request_id'){
                        $field = get_phrase('action');
                    }
            ?>
                <th><?=get_phrase($field);?></th>
            <?php        
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($result as $row){ 
        ?>
            <tr>
        <?php
                foreach($fields as $field){
                    $cell_value = $row[$field];

                    if($field == 'request_id'){
                        $cell_value =  '<div class="btn btn-default" id="'.hash_id($row[$field]).'">'.get_phrase('add_to_voucher').'</div>';   
                    }
        ?>  
                    <td><?=$cell_value;?></td>
        <?php 
                }
        ?>
            </tr>
        <?php        
            }
        
        ?>
    </tbody>
</table>