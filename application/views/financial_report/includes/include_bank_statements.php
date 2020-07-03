<?php if(!$multiple_offices_report){?>
    <div class="col-xs-12" style="margin-bottom:20px;">
        <form id="drop_statements"  class="dropzone hidden-print"></form>
    </div>
<?php }?>
        <table class="table table-striped" id="tbl_list_statements">
            <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('file_name');?></th>
                    <th><?=get_phrase('file_size');?></th>
                    <th><?=get_phrase('last_modified_date');?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($bank_statements_uploads as $bank_statements_upload){
                      if(!isset($bank_statements_upload['url'])) continue;
                    ?>
                    <tr>
                        <td><a href="#" class="fa fa-trash-o delete_statement" id="<?=$bank_statements_upload['url'];?>"></a></td>
                        <td><a target='__blank' href='<?=base_url();?><?=$bank_statements_upload['url'];?>'><?=$bank_statements_upload['file_name'];?></a></td>
                        <td><?=$bank_statements_upload['file_size'];?></td>
                        <td><?=$bank_statements_upload['last_modified_date'];?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>


<script>

</script>