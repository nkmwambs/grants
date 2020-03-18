<?php

$status_workflows = $result['approval_workflow_assignments'];

$user_departments = $result['user_departments'];

$office_hierarchy = $result['user_hierarchy_offices'];

$role_permissions = $result['role_permission'];

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
                    
                    <hr/>

                    <div class='form-group'>
                        <label style='text-align:center;' class='col-xs-12 control-label'>Page and Field Permissions</label>
                        <div class='col-xs-12'>
                            <table class='table datatable'>
                                <thead>
                                    <tr>
                                        <th><?=get_phrase('permission_item');?></th>
                                        <th><?=get_phrase('permission_type');?></th>
                                        <th><?=get_phrase('permission_label');?></th>
                                        <th><?=get_phrase('permission_name');?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                    foreach($role_permissions as $permission_item => $role_permission){
                                        foreach($role_permission as $permission_type => $labelled_permission){
                                            foreach($labelled_permission as $permission_label => $permission){
                                ?>  
                                        <tr>
                                            <td><?=ucwords(str_replace('_',' ',$permission_item));?></td>
                                            <td><?=$permission_type == 1?get_phrase('field_access'):get_phrase('field_access');?></td>
                                            <td><?=ucfirst($permission_label);?></td>
                                            <td><?=ucwords(str_replace('_',' ',$permission[0]));?></td>
                                        </tr>
                                <?php 
                                            }
                                        }
                                    }
                                ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label style='text-align:center;' class='col-xs-12 control-label'>Office Hierachy and Designation</label>
                        <div class='col-xs-12'>
                            <table class='table datatable'>
                            <thead> 
                                <tr>
                                    <th><?=get_phrase('office_context');?></th>
                                    <th><?=get_phrase('office_name');?></th>
                                    <th><?=get_phrase('user_designation');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($office_hierarchy as $context => $offices){
                                        foreach($offices as $office){
                                ?>
                                            <tr>
                                                <td><?=ucfirst($context);?></td>
                                                <td><?=$office['office_name'];?></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                    <?php 
                                            }
                                        }
                                    ?>
                            </tbody>
                            </table>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label style='text-align:center;' class='col-xs-12 control-label'>User Departments</label>
                        <div class='col-xs-12'>
                            <table class='table datatable'>
                                <thead>
                                    <tr>
                                        <th><?=get_phrase('department');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($user_departments as $user_department){?>
                                        <tr>
                                            <td><?=$user_department['department_name'];?></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class='form-group'>
                        <label style='text-align:center;' class='col-xs-12 control-label'>Approval Workflow Assignments</label>
                        <div class='col-xs-12'>
                            <table class='table datatable'>
                                <thead>
                                    <tr>
                                        <th><?=get_phrase('approveable_item');?></th>
                                        <th><?=get_phrase('status_name');?></th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($status_workflows as $status_workflow){?>
                                        <tr>
                                            <td><?=$status_workflow['approve_item_name'];?></td>
                                            <td><?=$status_workflow['status_name'];?></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
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