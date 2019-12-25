<div class="row">
    <div class="col-xs-12" class="no-print" style="text-align:center;margin:10px;font-weight:bold;">
        Approved Request Details
    </div>
</div>

<?php
//print_r($result);
if(count($result) > 0){

    $fields = array_keys($result[0]);
    //array_shift($fields);

    ?>

    <table class="table table-striped">
        <thead>
            <tr>    
                <?php 
                    foreach($fields as $field){
                        if($field == 'request_detail_id'){
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

                        if($field == 'request_detail_id'){
                            $cell_value =  '<div class="btn btn-default map_request_to_voucher_row" id="'.$row[$field].'">'.get_phrase('add_to_voucher').'</div>';   
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
<?php 
}else{
?>
    <div style="text-align:center;">No Items ready for vouching available</div>
<?php 
}
?>

<script>
$(".map_request_to_voucher_row").click(function(ev){
    

    $.ajax({
        url:'<?=base_url();?>voucher/get_request_detail/6',
        beforeSend:function(){

        },
        success:function(response){
            //alert(response);
            var obj = JSON.parse(response);
            
            run_detail_row(obj);
        },
        error:function(){

        }
    });

});

function run_detail_row(obj){

    var url = "<?=base_url();?><?=$this->controller;?>/detail_row";

    var fields = {};

    $(".th_data").each(function(i,el){
        let key  = $(this).attr('id').replace('th_','');
        //alert(obj[key);
        fields[key] = obj[key];
      }); 

    var data = {fields};  

    insert_row(url,data);
}
</script>
