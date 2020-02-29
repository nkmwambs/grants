<style>
.control-label{
    text-align:left;
}

.center{
    text-align:center;
}
</style>

<?php 
    //print_r($this->session->hierarchy_offices);
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
                            <div class='btn btn-default btn-reset'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default btn-insert'><?=get_phrase('insert_voucher_detail_row');?></div>
                            <div class='btn btn-default btn-save'><?=get_phrase('save');?></div>
                            <div class='btn btn-default btn-save-new'><?=get_phrase('save_and_new');?></div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='control-label col-xs-1'><?=get_phrase('office');?></label>
                        <div class='col-xs-3'>
                            <select class='form-control' id='office'>
                                <option><?=get_phrase('select_office');?></option>
                                <?php foreach($this->session->hierarchy_offices as $office){?>
                                        <option value="<?=$office['office_id'];?>"><?=$office['office_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('date');?></label>
                        <div class='col-xs-3'>
                            <input id="transaction_date" type='text' readonly data-format='yyyy-mm-dd' class='form-control datepicker' />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('voucher_number');?></label>
                        <div class='col-xs-3'>
                            <input type='text' readonly class='form-control' />
                        </div>

                    </div>

                    <div class='form-group'>
                        <label class='control-label col-xs-1'><?=get_phrase('voucher_type');?></label>
                        <div class='col-xs-3'>
                            <select class='form-control' id='voucher_type' onchange="getAccountsByVoucherType(this);">
                                <option value=""><?=get_phrase('select_voucher_type');?></option>
                                <?php 
                                    $voucher_types = $this->voucher_type_model->get_active_voucher_types();
                                    
                                    foreach($voucher_types as $voucher_type){
                                ?>
                                        <option value="<?=$voucher_type->voucher_type_id;?>"><?=$voucher_type->voucher_type_name;?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>


                        <label class='control-label col-xs-1'><?=get_phrase('bank_account');?></label>
                        <div class='col-xs-2'>
                            <select class="form-control" id='bank' readonly>
                                    <option value=""><?=get_phrase('select_bank_account');?></option>
                            </select>
                        </div>


                        <label class='control-label col-xs-1'><?=get_phrase('cheque_number');?></label>
                        <div class='col-xs-2'>
                            <input type='text' id='cheque_number' readonly class='form-control' />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('cheque_reversal');?></label>
                        <div class='col-xs-1'>
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
                            <div class='btn btn-default btn-reset'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default btn-insert'><?=get_phrase('insert_voucher_detail_row');?></div>
                            <div class='btn btn-default btn-save'><?=get_phrase('save');?></div>
                            <div class='btn btn-default btn-save-new'><?=get_phrase('save_and_new');?></div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12'>
                            <table class='table table-striped' id='tbl_voucher_body'>
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
                                <tbody id="tbl_voucher_body">
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
                            <div class='btn btn-default btn-reset'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default btn-insert'><?=get_phrase('insert_voucher_detail_row');?></div>
                            <div class='btn btn-default btn-save'><?=get_phrase('save');?></div>
                            <div class='btn btn-default btn-save-new'><?=get_phrase('save_and_new');?></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>    
    </div>
</div>

<script>

$(document).ready(function(){
    $('.btn-insert').hide();
    $('.btn-save').hide();
    $('.btn-save-new').hide();

    $("#voucher_type").prop('disabled','disabled');
});

function showHiddenButtons(){
    $('.btn-insert').show();
    $('.btn-save').show();
    $('.btn-save-new').show();
}

$("#bank").on("change",function(){
    if($("#cheque_number").val() != ""){
        $("#cheque_number").val("");
    }
});

function checkIfChequeIsValid(office,bank,cheque_number){
    
    var url = "<?=base_url();?>voucher/check_cheque_validity";
    var data = {'office_id':office,'bank_id':bank,'cheque_number':cheque_number};

    if($("#bank").val() == ""){
        alert("Choose a valid bank account");

        return false;
    }

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        beforeSend:function(){

        },
        success:function(response){
            if(!response){
                alert("The cheque number given ("+ cheque_number +") is not valid");
                $("#cheque_number").val("");
            }
        },
        error:function(){
            alert("Error occurred!");
        }
    });
}

$("#cheque_number").on('change',function(){
    var office = $("#office").val();
    var bank = $("#bank").val();
    var cheque_number = $("#cheque_number").val();

    checkIfChequeIsValid(office,bank,cheque_number);
})

function getOfficeBanks(office_id){
    
    var url = "<?=base_url();?>voucher/get_office_banks/" + office_id;

    var select_option = "<option value=''>Select a bank account</option>";

    $.ajax({
        url:url,
        beforeSend:function(){

        },
        success:function(response){

            var response_obj = JSON.parse(response);

            if(response_obj.length > 0){
                $.each(response_obj,function(i,el){
                    select_option += "<option value='" + response_obj[i].office_bank_id + "'>" + response_obj[i].bank_name + " ("+ response_obj[i].office_bank_account_number +")" + "</option>";
                });
            }

            $("#bank").html(select_option);

        },
        error:function(){
            alert('Error occurred!');
        }
    });
}

$("#office").on('change',function(){
    
    var rows = $("#tbl_voucher_body tbody tr");

    resetVoucher();

    getOfficeBanks($(this).val());

    $.each(rows,function(i,el){
        el.remove();
    });

    $("#voucher_type").val('');

    $("#voucher_type").prop('disabled','');
});

function checkIfDateIfSelected(){

    var checkIfDateIfSelected = true;

    if($("#transaction_date").val() == "") {
        //alert("Choose a valid transaction date");
        $("#voucher_type").val("");
        checkIfDateIfSelected = false
    };

    return checkIfDateIfSelected;
}

function getAccountsByVoucherType(voucherTypeSelect){

    var office_id = $("#office").val();

    var transaction_date = $("#transaction_date").val();

    var voucher_type_id = $(voucherTypeSelect).val();// Can be expense, income, cash_contra or bank_contra

    var url = "<?=base_url();?>voucher/get_voucher_accounts_and_allocation/" + office_id + "/" + voucher_type_id + "/" + transaction_date;
    
    var account_select_option = "";

    var allocation_select_option = "";

    var tbl_body_rows = $("#tbl_voucher_body tbody tr");
   
    checkIfDateIfSelected()?$.ajax({
        url:url,
        type:"POST",
        success:function(response){

           if(tbl_body_rows.length == 0){
             insertRow();
           } 

            response_objects = JSON.parse(response);

            response_accounts = response_objects['accounts'];
            response_allocation = response_objects['project_allocation'];
            response_is_bank_payment = response_objects['is_bank_payment'];

            if(response_accounts.length > 0){
                $.each(response_accounts,function(i,el){
                    account_select_option += "<option value='" + response_accounts[i].account_id + "'>" + response_accounts[i].account_name + "</option>";
                });
            }

            if(response_allocation.length > 0){
                $.each(response_allocation,function(i,el){
                    allocation_select_option += "<option value='" + response_allocation[i].project_allocation_id + "'>" + response_allocation[i].project_allocation_name + "</option>";
                });
            }

            showHiddenButtons();
            
            $(".allocation").html(allocation_select_option);

            $(".account").html(account_select_option);

            if(response_is_bank_payment){
                $("#cheque_number").removeAttr('readonly');
                $("#bank").removeAttr('readonly');
            }else{
                $("#cheque_number, #bank").val("");
                $("#cheque_number").prop('readonly','readonly');
                $("#bank").prop('readonly','readonly');
            }
        },
        error:function(xhr){
            alert('Error occurred!');
        }
    }):alert('Choose a valid date');
    
}

function resetVoucher(){
    var tbl_body_rows = $("#tbl_voucher_body tbody tr");

    // Remove extra rows
    var count_body_rows = tbl_body_rows.length;

    if(count_body_rows > 1){
        tbl_body_rows.each(function(i,el){
            if(i != 0){
                el.remove();
            }
        });
    }

    // Empty the cells
    $(".body-input").val(null);
    $(".number-fields").val(0);
    $("#bank").val("");
    $("#bank").html('<option value="">Select a bank</option>');
    
}

$(".btn-reset").on('click',function(){
    resetVoucher();
});

function copyRow(){
    
    var tbl_body = $("#tbl_voucher_body tbody");

    var original_row = tbl_body.find('tr').clone()[0];

    tbl_body.append(original_row);
}

function insertRow(){
    var tbl_body = $("#tbl_voucher_body tbody");

    var cell = actionCell(); 
    cell += quantityCell(); 
    cell += descriptionCell();
    cell += unitCostCell(); 
    cell += totalCostCell(); 
    cell += accountCell(); 
    cell += allocatioCodeCell(); 

    tbl_body.append("<tr>"+cell+"</tr>");
}

$(".btn-insert").on('click',function(){
    copyRow();    
});


function removeRow(rowCellButton){
    var row = $(rowCellButton).closest('tr');
    var tbl_body_rows = $("#tbl_voucher_body tbody tr");


    // Remove extra rows
    var count_body_rows = tbl_body_rows.length;

    if(count_body_rows > 1){
        row.remove();
    }else{
        alert('You can\'t remove all rows');
    }


}


function computeTotalCost(numberField){
    
    var activeCell = $(numberField);
    var row = $(numberField).closest('tr');

    var quantity = 0;
    var unitcost = 0;
    var totalcost = 0;

    if(activeCell.hasClass('quantity')){
        quantity = activeCell.val();

        if(quantity == "" || quantity == null){
            row.find('.quantity').val(0);
        }

        unitcost = row.find('.unitcost').val();
    }else{
        unitcost = activeCell.val();

        if(unitcost == "" || unitcost == null){
            row.find('.unitcost').val(0);
        }

        quantity = row.find('.quantity').val();
    }

    totalcost = quantity * unitcost;

    row.find('.totalcost').val(totalcost);
        
}

function replaceValue(numberField){
    $(numberField).val("");
}

function actionCell(){
    return "<td><div class='btn btn-danger action' onclick='removeRow(this);'>Remove Row</div></td>";
}

function quantityCell(){
    return "<td><input type='number' class='form-control body-input number-fields quantity' onclick='replaceValue(this);' onchange='computeTotalCost(this);' value='0' name='' id=''/></td>";
}

function descriptionCell(){
    return "<td><input type='text' class='form-control body-input description' value='' name='' id=''/></td>"; 
}

function unitCostCell(){
    return "<td><input type='number' class='form-control body-input number-fields unitcost' onclick='replaceValue(this);' onchange='computeTotalCost(this);'  value='0' name='' id=''/></td>";
}

function totalCostCell(){
    return "<td><input type='number' class='form-control body-input number-fields totalcost' value='' name='' id='' readonly='readonly'/></td>";
}

function accountCell(){
    return "<td><select class='form-control body-input account' name='' id=''></select></td>";
}

function allocatioCodeCell(){
    return "<td><select class='form-control body-input allocation' name='' id=''></select></td>";
}

$(".btn-save").on('click',function(){
    alert('Save');
});

$(".btn-save-new").on('click',function(){
    alert('Save and New');
});
</script>