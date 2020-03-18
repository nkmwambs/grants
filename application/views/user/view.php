<?php
//print_r($result);

extract($result['user_info']);

?>

<div class='row'>
    <div class='col-xs-12'>
        <div class="panel panel-default" data-collapsed="0">
       	    <div class="panel-heading">
           	    <div class="panel-title" >
           		    <i class="entypo-eye"></i>
					    <?php echo get_phrase('view_user');?>
           	    </div>
            </div>
	    
            <div class="panel-body"  style="max-width:50; overflow: auto;">	

                <?php echo form_open("" , array('id'=>'frm_user','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                     <div class='form-group'>
                        <div class='col-xs-12'  style='text-align:center;'>
                            <button id='' class='btn btn-default btn-edit'>Edit</button>
                            <button id='' class='btn btn-default btn-clone'>Clone</button>
                        </div>
                    </div>   

                    <?php 
                        echo form_group(
                            form_group_content('First Name',form_group_content_input($user_firstname,false)),
                            form_group_content('Last Name',form_group_content_input($user_lastname,false)),
            
                            form_group_content('Preferred User Name',form_group_content_input($user_name,false)),
                            form_group_content('Email',form_group_content_input($user_email,false)),
              
                            form_group_content('User Context Definition',form_group_content_input(ucfirst($context_definition_name),false)),
                            form_group_content('Is User a Context Manager?',form_group_content_input($user_is_context_manager == 0?get_phrase('no'):get_phrase('yes'),false)),
                        
                            form_group_content('Is User a System Administrator',form_group_content_input($user_is_system_admin == 0?get_phrase('no'):get_phrase('yes'),false)),
                            form_group_content('Is User Active',form_group_content_input($user_is_active == 0?get_phrase('no'):get_phrase('yes'),false)),
                       
                            form_group_content('User Role',form_group_content_input($role_name,false)),
                            form_group_content('User Default Language',form_group_content_input($language_name,false))
                        
                        );


                    ?>

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
                        <label style='text-align:center;' class='col-xs-12 control-label'>Office Hierachy and Designation</label>
                        <div class='col-xs-12'>
                            
                        </div>
                    </div>

                    <div class='form-group'>
                        <label style='text-align:center;' class='col-xs-12 control-label'>User Departments</label>
                        <div class='col-xs-12'>
                            
                        </div>
                    </div>
                    
                    <div class='form-group'>
                        <label style='text-align:center;' class='col-xs-12 control-label'>Approval Workflow Assignments</label>
                        <div class='col-xs-12'>
                            
                        </div>
                    </div>

                   
                    <div class='form-group'>
                        <div class='col-xs-12'  style='text-align:center;'>
                            <button id='' class='btn btn-default btn-edit'>Edit</button>
                            <button id='' class='btn btn-default btn-clone'>Clone</button>
                        </div>
                    </div> 

                </form>
            </div>
        </div>
          
    <div>
</div>