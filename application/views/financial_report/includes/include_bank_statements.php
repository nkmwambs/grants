<?php if(!$multiple_offices_report){?>
    <div class="col-xs-12" style="margin-bottom:20px;">
        <form id="drop_statements"  class="dropzone"></form>
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

$(document).ready(function(){
    Dropzone.autoDiscover = false;
});

var myDropzone = new Dropzone("#drop_statements", { 
        url: "<?=base_url()?>financial_report/upload_statements",
        paramName: "file", // The name that will be used to transfer the file
        params:{
            'office_id':<?=$office_ids[0];?>,
            'reporting_month':'<?=$reporting_month;?>',
            'project_id': $("#project_ids").val()
        },
        maxFilesize: 5, // MB
        uploadMultiple:true,
        acceptedFiles:'image/*,application/pdf',    
    });

    // myDropzone.on("sending", function(file, xhr, formData) { 
    // // Will sendthe filesize along with the file as POST data.
    // formData.append("filesize", file.size);  

    // });

    myDropzone.on("complete", function(file) {
        //myDropzone.removeFile(file);
        myDropzone.removeAllFiles();
        //alert(myDropzone.getAcceptedFiles());
    }); 

    myDropzone.on("success", function(file,response) {
        //alert(response);
        if(response == 0){
            alert('Error in uploading files');
            return false;
        }
        var table_tbody = $("#tbl_list_statements tbody");
        var obj = JSON.parse(response);

        for (let i = 0; i < obj.file.name.length; i++) {
            table_tbody.append('<tr><td><a href="#" class="fa fa-trash-o delete_statement" id="uploads/attachments/financial_report/'+obj.financial_report_id+'/'+obj.file.name[i]+'"></a></td><td><a target="__blank" href="<?=base_url();?>uploads/attachments/financial_report/'+obj.financial_report_id+'/'+obj.file.name[i]+'">'+obj.file.name[i]+'</a></td><td>'+obj.file.size[i]+'</td><td><?=date('Y-m-d');?></td></tr>');
        }

    });  


    $(document).on('click','.delete_statement',function(){
 
        var file_path = $(this).attr('id');
        var url = "<?=base_url();?>financial_report/delete_statement";
        var data = {'path':file_path};

        $.ajax({
            url:url,
            data:data,
            type:"POST",
            success:function(response){
                alert(response);
                $(".delete_statement").closest('tr').remove();
            }
        });
        
    }); 
</script>