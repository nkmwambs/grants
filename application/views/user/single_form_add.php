<?php
    // Not i use at the moment
    extract($result);
?>

<style>
    .user_message{
        text-align:center;
        color:red;
    }
</style>

<div class='row'>
    <div class='col-xs-12'>

    <div class="panel panel-default" data-collapsed="0">
       	    <div class="panel-heading">
           	    <div class="panel-title" >
           		    <i class="entypo-plus-circled"></i>
					    <?php echo get_phrase('add_user');?>
           	    </div>
            </div>
	    
            <div class="panel-body"  style="max-width:50; overflow: auto;">	

                <?php echo form_open("" , array('id'=>'frm_user','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
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
                        <label class='col-xs-2 control-label'>First Name</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('user_firstname');?>
                        </div>

                        <label class='col-xs-2 control-label'>Last Name</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('user_lastname');?>
                        </div>
                    </div>


                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>Preferred Username</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('user_name');?>
                        </div>

                        <label class='col-xs-2 control-label'>Email</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('user_email');?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>User Context Definition</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('context_definition_name',0);?>
                        </div>

                        <label class='col-xs-2 control-label'>Is User a Context Manager</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('user_is_context_manager');?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>User Office Context</label>
                        <div class='col-xs-4' id='div_office_context'>
                            <select class='form-control' disabled='disabled'></select>
                        </div>

                        <label class='col-xs-2 control-label'>User Department</label>
                        <div class='col-xs-4' id='div_user_department'>
                            <select class='form-control' disabled='disabled'></select>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>Is User a System Administrator</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('user_is_system_admin',0,$this->session->system_admin?false:true);?>
                        </div>

                        <label class='col-xs-2 control-label'>Is User Active</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('user_is_active',1);?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>User Role</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('role_name');?>
                        </div>

                        <label class='col-xs-2 control-label'>User Default Language</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->header_row_field('language_name',1);?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>User Designation</label>
                        <div class='col-xs-4' id='div_user_designation'>
                            <select class='form-control' disabled='disabled'></select>
                        </div>
                    </div>    

                    <div class='form-group'>
                        <label class='col-xs-2 control-label'>User Password</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->password_field('user_password');?>
                        </div>

                        <label class='col-xs-2 control-label'>Confirm Password</label>
                        <div class='col-xs-4'>
                            <?=$this->grants->password_field('confirm_user_password');?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label style='text-align:center;' class='col-xs-12 control-label'>Page Access Permissions</label>
                        <div class='col-xs-12'>
                            
                        </div>
                    </div>

                    <div class='form-group'>
                        <label style='text-align:center;' class='col-xs-12 control-label'>Field Access Permission</label>
                        <div class='col-xs-12'>
                            
                        </div>
                    </div>

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

                </form>   
            </div>
        </div>                
    </div>
</div>

<script>
function onchange_fk_context_definition_id(elem){
    
    let url = "<?=base_url();?>user/get_ajax_response_for_selected_definition/";
    let data = {'context_definition_id':$(elem).val(),'user_email':$("#user_email").val()};
    

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        success:function(response){
            //alert(response);
            let obj  = JSON.parse(response);

            $("#div_office_context").html(obj.select_office_context);
            $('#div_user_department').html(obj.select_department);
            $('#div_user_designation').html(obj.select_designation);

            if(obj.message !== true){
                $('.user_message').html(obj.message); 
            }else{
                $('.user_message').html(null);
            }
        }
    });
}

$("#user_email").on('change',function(){
    var user_email = $(this);
    var user_name = $("#user_name");
    let url = "<?=base_url();?>user/check_if_email_is_used";
    let data = {'user_email':$(this).val(),'user_name':$("#user_name").val()};

    $.ajax({
        url:url,
        type:"POST",
        data:data,
        success:function(is_valid_email){
    
            if(is_valid_email){
                $('#fk_context_definition_id').val('0').prop('selected', true);
                $('#user_is_context_manager').val('0').prop('selected', true);

                if($("#office_context")){
                    $("#office_context").empty().prop('disabled','disabled');
                    $("#department").empty().prop('disabled','disabled');
                }
            }else{
                alert('Invalid email "'+ user_email.val() +'" or username "'+ user_name.val()+'"');
                user_email.val(null);
                user_name.val(null);
            } 

            
        }
    });
    
});

$("#fk_role_id").on('change',function(){
   var url = "<?=base_url();?>user/list_role_permissions/"+$(this).val();

    $.ajax({
        url:url,
        success:function(response){
            //alert(response);
        }
    });

});

$("#confirm_user_password, #user_password").on('change',function(){
    var confirm_pass = $("#confirm_user_password").val();
    var pass = $("#user_password").val();

    if(confirm_pass.localeCompare(pass) == 0 && confirm_pass.length > 0 && pass.length > 0 ){
        $(".user_message").html(null);
    }else{
        $(".user_message").html('Password mismatch');
        $("#confirm_user_password").val(null);
    }

});

$(document).ready(function(){
    $(".user_message").html(null);
    $("#confirm_user_password, #user_password, #user_name, #user_email").val(null);
});

$(".btn-save").on('click',function(ev){

    var url = "<?=base_url();?>user/create_new_user";
    var data = $("#frm_user").serializeArray();

    //alert(url);

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        success:function(response){
            alert(response);
            location.href = document.referrer  
        }
    });

    ev.preventDefault();

});


</script>