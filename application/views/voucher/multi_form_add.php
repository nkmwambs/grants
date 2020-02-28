<style>
.control-label{
    text-align:left;
}

.center{
    text-align:center;
}
</style>

<?php 
    //print_r($this->user_model->__user_hierarchy_offices($this->session->user_id));
?>

<div class='row'>
    <div class='col-xs-12'>
        <div class="panel panel-default" data-collapsed="0">
       	    <div class="panel-heading">
           	    <div class="panel-title" >
           		    <i class="entypo-plus-circled"></i>
					    <?php echo get_phrase('transaction_voucher');?>
           	    </div>
            </div>
	    
            <div class="panel-body"  style="max-width:50; overflow: auto;">	
                <?php echo form_open("" , array('id'=>'frm_voucher','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
                    <div class='form-group'>
                        <div class='col-xs-12 center'>
                            <div class='btn btn-default'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default'><?=get_phrase('insert_voucher_detail_row');?></div>
                            <div class='btn btn-default'><?=get_phrase('save');?></div>
                            <div class='btn btn-default'><?=get_phrase('save_and_new');?></div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='control-label col-xs-1'><?=get_phrase('office');?></label>
                        <div class='col-xs-3'>
                            <select class='form-control'>
                                <option><?=get_phrase('select_office');?></option>
                                <?php foreach($this->session->hierarchy_offices as $office){?>
                                        <option value="<?=$office['office_id'];?>"><?=$office['office_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('date');?></label>
                        <div class='col-xs-3'>
                            <input type='text' readonly class='form-control datepicker' />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('voucher_number');?></label>
                        <div class='col-xs-3'>
                            <input type='text' readonly class='form-control' />
                        </div>

                    </div>

                    <div class='form-group'>
                        <label class='control-label col-xs-1'><?=get_phrase('voucher_type');?></label>
                        <div class='col-xs-3'>
                            <select class='form-control'>
                                <option><?=get_phrase('select_voucher_type');?></option>
                            </select>
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('cheque_number');?></label>
                        <div class='col-xs-3'>
                            <input type='text' readonly class='form-control' />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('cheque_reversal');?></label>
                        <div class='col-xs-3'>
                            <div class="make-switch switch-small" data-on-label="Yes" data-off-label="No">
								<input type="checkbox" id="reversal" name="reversal"/>
							</div>
                        </div>

                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('payee/_vendor');?></label>
                        <div class='col-xs-11'>
                            <input type='text' class='form-control' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('address');?></label>
                        <div class='col-xs-11'>
                            <input type='text' class='form-control' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('description');?></label>
                        <div class='col-xs-11'>
                            <input type='text' class='form-control' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12 center'>
                            <div class='btn btn-default'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default'><?=get_phrase('insert_voucher_detail_row');?></div>
                            <div class='btn btn-default'><?=get_phrase('save');?></div>
                            <div class='btn btn-default'><?=get_phrase('save_and_new');?></div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12'>
                            <table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th><?=get_phrase('action');?></th>
                                        <th><?=get_phrase('quantity');?></th>
                                        <th><?=get_phrase('description');?></th>
                                        <th><?=get_phrase('unit_cost');?></th>
                                        <th><?=get_phrase('total_cost');?></th>
                                        <th><?=get_phrase('account');?></th>
                                        <th><?=get_phrase('allocation_code');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>  
                                <tfoot>
                                    <tr>
                                        <td colspan='6'><?=get_phrase('total');?></td>
                                        <td><input type='text' class='form-control' readonly /></td>
                                    </tr>
                                </tfoot>      
                            </table>        
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12 center'>
                            <div class='btn btn-default'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default'><?=get_phrase('insert_voucher_detail_row');?></div>
                            <div class='btn btn-default'><?=get_phrase('save');?></div>
                            <div class='btn btn-default'><?=get_phrase('save_and_new');?></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>    
    </div>
</div>