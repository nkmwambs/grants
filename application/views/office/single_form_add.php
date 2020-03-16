<div class='row'>
    <div class='col-xs-12'>

    <div class="panel panel-default" data-collapsed="0">
       	    <div class="panel-heading">
           	    <div class="panel-title" >
           		    <i class="entypo-plus-circled"></i>
					    <?php echo get_phrase('add_office');?>
           	    </div>
            </div>
	    
            <div class="panel-body"  style="max-width:50; overflow: auto;">	
            <?php echo form_open("" , array('id'=>'frm_office','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
                    <div class='form-group'>
                        <div class='col-xs-12 user_message'>

                        </div>
                    </div>    

                    <div class='form-group'>
                        <div class='col-xs-12'  style='text-align:center;'>
                            <button id='' class='btn btn-default btn-reset'>Reset</button>
                            <button id='' class='btn btn-default btn-save'>Save</button>
                            <button id='' class='btn btn-default btn-save-new'>Save and New</button>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>Office Name</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('office_name');?>
                        </div>

                        <label class='col-xs-2 control-label'>Office Description</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('office_description');?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>Office Code</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('office_code');?>
                        </div>

                        <label class='col-xs-2 control-label'>Office Start Date</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('office_start_date');?>
                        </div>

                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>Context Definition</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('context_definition_name');?>
                        </div>

                        <label class='col-xs-2 control-label'>Reporting Context</label>
                        <div class='col-xs-4' id='div_office_context'>
                            <select class='form-control' disabled='disabled'></select>
                        </div>
                        
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>Is Office Active?</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('office_is_active',1);?>
                        </div>

                        <label class='col-xs-2 control-label'>Office Accounting System</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('account_system_name');?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12'  style='text-align:center;'>
                            <button id='' class='btn btn-default btn-reset'>Reset</button>
                            <button id='' class='btn btn-default btn-save'>Save</button>
                            <button id='' class='btn btn-default btn-save-new'>Save and New</button>
                        </div>
                    </div>


                </form>    
            </div>
    </div>  

<script>

    $("#fk_context_definition_id").on('change',function(){
        //alert('Hello');
        var url = "<?=base_url();?>office/get_ajax_responses_for_context_definition";
        var data = {'context_definition_id':$(this).val()};

        $.ajax({
            url:url,
            data:data,
            type:"POST",
            success:function(response){
                //alert(response);

                var obj = JSON.parse(response);

                $("#div_office_context").html(obj.office_context);
            }
        });
    });


    $(".btn-save,.btn-save-new").on('click',function(ev){
        //alert('Saving');
        var url = "<?=base_url();?>office/create_new_office";
        var data = $("#frm_office").serializeArray();

        $.ajax({
            url:url,
            type:"POST",
            data:data,
            success:function(response){
 
                alert(response);

                if(btn.hasClass('btn-save')){
                    location.href = document.referrer 
                }else{
                    reset_form();
                }
            }
        });

        ev.preventDefault();
    });

$(".btn-reset").on('click',function(ev){
    reset_form();

    ev.preventDefault();
});

function reset_form(){
    $('input').val(null);
    $("#fk_context_definition_id").val(0).prop('selected',true);
    $("#fk_account_system_id").val(0).prop('selected',true);
    $("#office_description").val(null);

    $("#office_context").empty().prop('disabled','disabled');

}
</script>      