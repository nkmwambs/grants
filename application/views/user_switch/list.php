<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="fa fa-toggle-on"></i>
                            <?php echo get_phrase('switch_user');?>
                    </div>
                </div>
            
                <div class="panel-body"  style="max-width:50; overflow: auto;">	
                    <?php echo form_open(base_url()."login/switch_user" , array('id'=>'frm_switch_user','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                        <div class="form-group">
                            <label class="control-label col-xs-4"><?=get_phrase('choose_user_to_switch_to');?></label>

                            <div class="col-xs-4">
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value=""><?=get_phrase("choose_a_user");?></option>
                                    <?php 
                                        foreach($result as $user){
                                            ?>
                                                <option value="<?=$user['user_id'];?>"><?=$user['user_firstname'].' '.$user['user_firstname'].' ['.$user['user_name'].']';?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-success"><?=get_phrase('switch');?></button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>