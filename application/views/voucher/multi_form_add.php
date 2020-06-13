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
  <div class='row' id="main_row">  
    <div class='col-xs-12 split_screen'>
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
                            <div class='btn btn-default btn-retrieve-request'><?=get_phrase('show_or_hide_requests');?> &nbsp; <span class='badge badge-secondary requests_badge'>0</span></div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='control-label col-xs-1'><?=get_phrase('office');?></label>
                        <div class='col-xs-2'>
                            <select class='form-control' id='office' name='fk_office_id'>
                                <option value=""><?=get_phrase('select_office');?></option>
                                <?php foreach($this->session->hierarchy_offices as $office){?>
                                        <option value="<?=$office['office_id'];?>"><?=$office['office_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label class='control-label col-xs-1 date-field'><?=get_phrase('date');?></label>
                        <div class='col-xs-2 date-field'>
                            <input id="transaction_date" type='text' name='voucher_date' readonly class='form-control' />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('voucher_number');?></label>
                        <div class='col-xs-2'>
                            <input type='text' readonly class='form-control' name='voucher_number' id="voucher_number" />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('voucher_type');?></label>
                        <div class='col-xs-2'>
                            <select class='form-control'  disabled="disabled" name='fk_voucher_type_id' id='voucher_type' onchange="getAccountsByVoucherType(this);">
                                <option value=""><?=get_phrase('select_voucher_type');?></option>
                                
                            </select>
                        </div>

                    </div>

                    <div class='form-group'>

                        <label class='control-label col-xs-1'><?=get_phrase('cash_account');?></label>
                        <div class='col-xs-2'>
                            <select class="form-control" name='fk_office_cash_id' id='cash_account' disabled='disabled'>
                                    <option value=""><?=get_phrase('select_cash_account');?></option>
                            </select>
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('bank_account');?></label>
                        <div class='col-xs-2'>
                            <select class="form-control" name='fk_office_bank_id' id='bank' disabled='disabled'>
                                    <option value=""><?=get_phrase('select_bank_account');?></option>
                            </select>
                        </div>


                        <label class='control-label col-xs-1'><?=get_phrase('cheque_number');?></label>
                        <div class='col-xs-2'>
                            <input type='text' name='voucher_cheque_number' id='cheque_number' disabled='disabled' class='form-control' />
                        </div>

                        <!-- <label class='control-label col-xs-1'><?=get_phrase('cheque_reversal');?></label>
                        <div class='col-xs-1'>
                            <div class="make-switch switch-small" data-on-label="Yes" data-off-label="No">
								<input type="checkbox" id="reversal" name="reversal"/>
							</div>
                        </div> -->

                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('payee/_vendor');?></label>
                        <div class='col-xs-11'>
                            <input type='text' name='voucher_vendor' class='form-control' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('address');?></label>
                        <div class='col-xs-11'>
                            <input type='text' name='voucher_vendor_address' class='form-control' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('description');?></label>
                        <div class='col-xs-11'>
                            <input type='text' name='voucher_description' class='form-control' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12 center'>
                            <div class='btn btn-default btn-reset'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default btn-insert'><?=get_phrase('insert_voucher_detail_row');?></div>
                            <div class='btn btn-default btn-save'><?=get_phrase('save');?></div>
                            <div class='btn btn-default btn-save-new'><?=get_phrase('save_and_new');?></div>
                            <div class='btn btn-default btn-retrieve-request'><?=get_phrase('show_or_hide_requests');?> &nbsp; <span class='badge badge-secondary requests_badge'>0</span></div>
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
                                        <th><?=get_phrase('request_number');?></th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_tbody">
                                </tbody>  
                                <tfoot>
                                    <tr>
                                        <td colspan='6'><?=get_phrase('total');?></td>
                                        <td><input type='text' id='voucher_total' class='form-control' readonly /></td>
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
                            <div class='btn btn-default btn-retrieve-request'><?=get_phrase('show_or_hide_requests');?> &nbsp; <span class='badge badge-secondary requests_badge'>0</span></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>  
        
        <div class="row">
            <div class="col-xs-12">
               <?=Widget_base::load('upload');?>
            </div>
        </div>


    </div>
</div>

<script>

$(document).ready(function(){
    //get_approved_unvouched_request_details
    $('.date-field').hide();
    $('.btn-insert').hide();
    $('.btn-save').hide();
    $('.btn-save-new').hide();
    $('.btn-retrieve-request').hide();

});

function load_approved_requests(){
        var office = $("#office").val();
        var url = "<?=base_url();?>Voucher/get_approve_request_details/" + office;

        $("#request_screen").html("");

        $.ajax({
            url:url,
            beforeSend:function(){

            },
            success:function(response){
                
                if($("#main_row").find('#request_screen').length == 0){
                    $("#main_row").append("<div id='request_screen' class='col-xs-6'>"+response+"</div>");
                }else{
                    $("#request_screen").html(response);
                }
                
                $("#request_screen").css('overflow-x','auto');

                update_request_details_count_on_badge();
            },
            error:function(){
                alert("Error occurred!");
            }
        });
}

$(".btn-retrieve-request").on('click',function(){
    
    if($(".split_screen").hasClass('col-xs-12')){
        $(".split_screen").removeClass('col-xs-12').addClass('col-xs-6');

        var split_screen = $(".split_screen");

        load_approved_requests();   

        remove_request_derived_voucher_details(); 
       
    }else{
        $("#request_screen").remove();
        $(".split_screen").removeClass('col-xs-6').addClass('col-xs-12');

        var tbl_body_rows = $("#tbl_voucher_body tbody tr");

        if(tbl_body_rows.length > 0){
            $('.btn-save').show();
            $('.btn-save-new').show();
        }
        

    }
});

function remove_request_derived_voucher_details(){
    var tbl_voucher_body_rows = $("#tbl_voucher_body tbody tr");

    $.each(tbl_voucher_body_rows,function(i,el){
        
        let row_request_id_input = $(el).find("td:last").find('input');

        if(parseInt(row_request_id_input.val()) > 0){
            row_request_id_input.closest("tr").remove();

            //Adjust the voucher_total value
            let row_voucher_total = $(el).find('.totalcost').val();
            let voucher_total = $("#voucher_total").val();

            $update_voucher_total = parseFloat(voucher_total) - parseFloat(row_voucher_total);

            $("#voucher_total").val($update_voucher_total);
        }
    });
}

function hide_buttons(){
    $('.btn-insert').hide();
    $('.btn-save').hide();
    $('.btn-save-new').hide();
    $('.btn-retrieve-request').hide();
}

function showHiddenButtons(response_is_expense, response_is_bank_payment, show_insert_buttons = false){
    if(!response_is_bank_payment || (response_is_bank_payment && ($("#bank").val() != "" || $("#cheque_number").val() != ""))){
        
        if(show_insert_buttons){
            $('.btn-save').show();
            $('.btn-save-new').show();
        }    

        $('.btn-insert').show();

        var only_allow_voucher_details_from_request = '<?=$this->config->item('only_allow_voucher_details_from_request');?>';

        if(response_is_expense && only_allow_voucher_details_from_request == true){
            $('.btn-insert').hide();
        }

         if(response_is_expense){
            $('.btn-retrieve-request').show();
           }else{
            $('.btn-retrieve-request').hide();
        }
    }else{
        hide_buttons();
    }

    
}

$("#bank").on("change",function(){
    //$("#cheque_number").removeAttr('disabled');
    
    //updateAccountAndAllocationField();
    getAccountsByVoucherType($('#voucher_type'));

    if($("#cheque_number").val() != ""){
        $("#cheque_number").val("");
    }
    
    if($(this).val() && $("#cheque_number").val() != ""){
        showHiddenButtons(true,true,false);
    }else{
        hide_buttons();
    }
});

$("#cheque_number").on('change',function(){
    if($(this).val() && $("#bank").val() != ""){
        showHiddenButtons(true,true,false);
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
    
    var url = "<?=base_url();?>voucher/get_office_banks/";

    var select_option = "<option value=''>Select a bank account</option>";

    $.ajax({
        url:url,
        data:{'office_id':office_id},
        type:"POST",
        beforeSend:function(){

        },
        success:function(response){

            var response_obj = JSON.parse(response);

            if(response_obj.length > 0){
                $.each(response_obj,function(i,el){
                    select_option += "<option value='" + response_obj[i].office_bank_id + "'>" + response_obj[i].bank_name + " ("+ response_obj[i].office_bank_name +")" + "</option>";
                });
            }

            $("#bank").html(select_option);

        },
        error:function(){
            alert('Error occurred!');
        }
    });
}


function computeNextVoucherNumber(office_id){
    
    var url = "<?=base_url();?>voucher/compute_next_voucher_number/";

    $.ajax({
        url:url,
        data:{'office_id':office_id},
        type:"POST",
        beforeSend:function(){
            
        },
        success:function(response){
            $("#voucher_number").val(response);
        },
        error:function(){
            alert('Error occurred');
        }
    });
}

function computeCurrentTransactingDate(office_id){
    
    var url = "<?=base_url();?>voucher/get_office_voucher_date/";

    $.ajax({
        url:url,
        type:"POST",
        data:{'office_id':office_id},
        beforeSend:function(){

        },
        success:function(response){
            $('.date-field').show();
        
            let obj = JSON.parse(response);

            $("#transaction_date").val(obj.next_vouching_date);

            $('#transaction_date').datepicker({
		        format: 'yyyy-mm-dd',
		        startDate: obj.next_vouching_date,
		        endDate:obj.last_vouching_month_date
	        });


        },
        error:function(){
            alert('Error occurred');
        }
    });
}

$('#transaction_date').on('click',function(){
        
        
});


$("#office").on('change',function(){
    
    //var rows = $("#tbl_voucher_body tbody tr");

    resetVoucher();

    if($(this).val() == "") {
        //resetVoucher();
        return false;
    }
    
    if($(".split_screen").hasClass('col-xs-6')) load_approved_requests();
    
    computeNextVoucherNumber($(this).val());

    computeCurrentTransactingDate($(this).val());

    getOfficeBanks($(this).val());

    getActiveVoucherTypes();
});

function getActiveVoucherTypes(){

    var office_id = $("#office").val();

    var url = "<?=base_url();?>Voucher/get_active_voucher_types/" + office_id;

    $.ajax({
        url:url,
        success:function(response){

            $("#voucher_type").removeAttr('disabled');

            var voucher_type_option = "<option value=''>Select a Voucher Type</option>";

            var response_voucher_type = JSON.parse(response);
     
            if(response_voucher_type.length > 0){
                $.each(response_voucher_type,function(i,el){
                    voucher_type_option += "<option value='" + response_voucher_type[i].voucher_type_id + "'>" + response_voucher_type[i].voucher_type_name + "</option>";
                });
            }

            $("#voucher_type").html(voucher_type_option);
        }
    });

}

function checkIfDateIsSelected(){

    var checkIfDateIsSelected = true;

    if($("#transaction_date").val() == "") {
        //alert("Choose a valid transaction date");
        $("#voucher_type").val("");
        checkIfDateIsSelected = false
    };

    return checkIfDateIsSelected;
}

function getAccountsByVoucherType(voucherTypeSelect){

    var office_id = $("#office").val();

    var transaction_date = $("#transaction_date").val();

    var voucher_type_id = $(voucherTypeSelect).val();// Can be expense, income, cash_contra or bank_contra

    //var office_cash_id = $("#cash_account").val();

    var url = "<?=base_url();?>Voucher/get_voucher_accounts_and_allocation/" + office_id + "/" + voucher_type_id + "/" + transaction_date;

    var tbl_body_rows = $("#tbl_voucher_body tbody tr");
   
    checkIfDateIsSelected()?$.ajax({
        url:url,
        type:"POST",
        success:function(response){

            var response_objects = JSON.parse(response);

            var response_accounts = response_objects['accounts'];
            var response_allocation = response_objects['project_allocation'];
            var response_office_cash = response_objects['office_cash'];
            var response_is_bank_payment = response_objects['is_bank_payment'];
            var response_is_contra = response_objects['is_contra'];
            var response_is_expense = response_objects['is_expense'];
            var response_is_transaction_affecting_bank = response_objects['is_transaction_affecting_bank'];
            var response_approved_requests = response_objects['approved_requests'];
            //var response_is_allocation_linked_to_account = response_objects['is_allocation_linked_to_account'];
            //alert(response_is_cash_payment);
            create_accounts_and_allocation_select_options(response_accounts,response_allocation);

            showHiddenButtons(response_is_expense,response_is_bank_payment,false);

            $.each($(".requests_badge"),function(i,el){
                $(el).html(response_approved_requests);
            });

            if(response_is_bank_payment || response_is_contra || response_is_transaction_affecting_bank){
                $("#bank").removeAttr('disabled');
                
                if(response_is_bank_payment && response_is_transaction_affecting_bank && $("#bank").val() !=""){
                    $("#cheque_number").removeAttr('disabled');
                }else if(response_is_contra){
                    $("#cash_account").removeAttr('disabled');
                    create_office_cash_dropdown(response_office_cash);
                }else{
                    //!$("#bank").attr('disabled')?$("#bank").prop('disabled','disabled'):null;
                    !$("#cheque_number").attr('disabled')?$("#cheque_number").prop('disabled','disabled'):null;
                    !$("#cash_account").attr('disabled')?$("#cash_account").prop('disabled','disabled'):null;
                }
                
            }else if(response_is_cash_contra){

                $("#cash_account").removeAttr('disabled');
                create_office_cash_dropdown(response_office_cash);
            
            }else{
                $("#cheque_number, #bank").val("");
                !$("#cheque_number").attr('disabled')?$("#cheque_number").prop('disabled','disabled'):null;
                !$("#bank").attr('disabled')?$("#bank").prop('disabled','disabled'):null;
                !$("#cash_account").attr('disabled')?$("#cash_account").prop('disabled','disabled'):null;
            }
        },
        error:function(xhr){
            alert('Error occurred!');
        }
    }):alert('Choose a valid date');
    
}

function create_office_cash_dropdown(response_office_cash){
    var account_select_option = "<option value=''>Select Cash Account</option>";

    if(response_office_cash.length > 0){
        $.each(response_office_cash,function(i,el){
            account_select_option += "<option value='" + response_office_cash[i].office_cash_id + "'>" + response_office_cash[i].office_cash_name + "</option>";
        });
    }

    $("#cash_account").html(account_select_option);
}

function create_accounts_and_allocation_select_options(response_accounts,response_allocation){
    var account_select_option = "<option value=''>Select an account</option>";

    var allocation_select_option = "<option value=''>Select an allocation code</option>";

    if(response_accounts.length > 0){
        $.each(response_accounts,function(i,el){
            account_select_option += "<option value='" + response_accounts[i].account_id + "'>" + response_accounts[i].account_name + "</option>";
        });
    }

    if(response_allocation.length > 0){

        $(".allocation").removeAttr('disabled');

        $.each(response_allocation,function(i,el){
            allocation_select_option += "<option value='" + response_allocation[i].project_allocation_id + "'>" + response_allocation[i].project_allocation_name + "</option>";
        });
    }

    $(".allocation").html(allocation_select_option);

    $(".account").html(account_select_option);

}

function resetVoucher(){
    var tbl_body_rows = $("#tbl_voucher_body tbody tr");

    // Remove extra rows
    var count_body_rows = tbl_body_rows.length;
    
    //alert(count_body_rows);
    
    if(count_body_rows > 1){
        $.each(tbl_body_rows,function(i,el){
           // if(i != 0){
                $(el).remove();
            //}
        });
    }

    // Empty the cells
    $(".body-input").val(null);
    $(".number-fields").val(0);
    // $("#bank").val("");
    $("#bank").html('<option value="">Select a bank</option>');

    $("#voucher_vendor").val("");
    $("#voucher_vendor_address").val("");
    $("#voucher_description").val("");
    $("#transaction_date").val("");
    $("#voucher_number").val("");

    $("#voucher_type").val("");
    $("#voucher_type").prop('disabled','disabled');;    
}

$(".btn-reset").on('click',function(){
    resetVoucher();
});

function copyRow(){
    
    var tbl_body = $("#tbl_voucher_body tbody");

    var original_row = tbl_body.find('tr').clone()[0];

    tbl_body.append(original_row);

    $.each(tbl_body.find("tr:last").find('input'),function(i,el){
        let resatable_fields = ['quantity','description','unitcost'];
        var elem = $(el);

        resatable_fields.forEach(function(fieldClass,index){
            if(elem.hasClass(fieldClass)){
                elem.removeAttr('readonly');
            }
            
            if(elem.hasClass('number-fields')){
                elem.val(0);
            }else{
                elem.val("");
            }
        });
    });
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
    cell += requestIdCell(); 

    tbl_body.append("<tr>"+cell+"</tr>");
}

$(".btn-insert").on('click',function(){
    
    var tbl_body_rows = $("#tbl_voucher_body tbody tr");

    if(tbl_body_rows.length == 0){
        insertRow();
        updateAccountAndAllocationField();
    }else{
        copyRow();   
    }  

    showHiddenButtons(false,false,true);
});

function updateAccountAndAllocationField(expense_account_id = "", project_allocation_id = ""){
    var office_id = $("#office").val();

    var transaction_date = $("#transaction_date").val();

    var voucher_type_id = $("#voucher_type").val();// Can be expense, income, cash_contra or bank_contra

    var url = "<?=base_url();?>Voucher/get_voucher_accounts_and_allocation/" + office_id + "/" + voucher_type_id + "/" + transaction_date;
    
    if(!$("#bank").attr('disabled') && $("#bank").val() == ""){
        alert('Bank details and cheque number is required');
        return false;
    }else if(!$("#bank").attr('disabled')){
        var office_bank_id = $("#bank").val();
        url = "<?=base_url();?>Voucher/get_voucher_accounts_and_allocation/" + office_id + "/" + voucher_type_id + "/" + transaction_date + "/" + office_bank_id;
    }
    
    $.ajax({
        url:url,
        type:"POST",
        beforeSend:function(){

        },
        success:function(response){
            var account_select_option = "<option value=''>Select an account</option>";

            var allocation_select_option = "<option value=''>Select an allocation code</option>";

            var response_objects = JSON.parse(response);

            var response_accounts = response_objects['accounts'];
            
            var response_allocation = response_objects['project_allocation'];

            create_accounts_and_allocation_select_options(response_accounts,response_allocation);
            
        },
        error:function(){
            alert('Error occurred');
        }
    });
}


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

    $("#voucher_total").val(sumVoucherDetailTotalCost());
        
}

function sumVoucherDetailTotalCost(){
   
    var sum = 0;

    $.each($('.totalcost'),function(i,el){
        sum += parseFloat($(el).val());
    });
    
    return sum;
}

function replaceValue(numberField){
    $(numberField).val("");
}

function clearRow(el){
    $(el).closest('tr').find(".body-input").val(null);
    $(el).closest('tr').find(".number-fields").val(0);
}

$(document).on('change','.account',function(){

    var office_id = $("#office").val();
    var account_id = $(this).val();
    var voucher_type_id = $("#voucher_type").val();
    var transaction_date = $("#transaction_date").val();
    
    var url = "<?=base_url();?>voucher/get_project_details_account/";

    $.ajax({
        url:url,
        data:{'office_id':office_id,'account_id':account_id,'voucher_type_id':voucher_type_id,'transaction_date':transaction_date},
        type:"POST",
        success:function(response){

            var response_allocation = JSON.parse(response);

            var allocation_select_option = "<option value=''>Select an allocation code</option>";

            if(response_allocation.length > 0){
                $(".allocation").removeAttr('disabled');
                $.each(response_allocation,function(i,el){
                    allocation_select_option += "<option value='" + response_allocation[i].project_allocation_id + "'>" + response_allocation[i].project_allocation_name + "</option>";
                });
            }else{
                $(".allocation").prop('disabled','disabled');
            }

            $(".allocation").html(allocation_select_option);
        }
    });
});

function actionCell(){
    return "<td><div class='btn btn-danger action' onclick='removeRow(this);'>Remove Row</div> &nbsp; <span onclick='clearRow(this);' class='fa fa-trash'></span> </td>";
}

function quantityCell(value = 0){
    return "<td><input name='voucher_detail_quantity[]' type='number' class='form-control body-input number-fields quantity' onclick='replaceValue(this);' onchange='computeTotalCost(this);' value='" + value + "' name='' id=''/></td>";
}

function descriptionCell(value = ''){
    return "<td><input  name='voucher_detail_description[]' type='text' class='form-control body-input description' value='" + value + "' name='' id=''/></td>"; 
}

function unitCostCell(value = 0){
    return "<td><input  name='voucher_detail_unit_cost[]' type='number' class='form-control body-input number-fields unitcost' onclick='replaceValue(this);' onchange='computeTotalCost(this);'  value='" + value + "' name='' id=''/></td>";
}

function totalCostCell(value = 0){
    return "<td><input name='voucher_detail_total_cost[]' type='number' class='form-control body-input number-fields totalcost' value='" + value + "' name='' id='' readonly='readonly'/></td>";
}

function accountCell(value = 0){
    return "<td><select name='voucher_detail_account[]' class='form-control body-input account' name='' id=''></select></td>";
}

function allocatioCodeCell(value = 0){
    return "<td><select disabled='disabled' name='fk_project_allocation_id[]' class='form-control body-input allocation' name='' id=''></select></td>";
}

function requestIdCell(value = 0){
    return "<td><input name='fk_request_detail_id[]' type='number' class='form-control body-input number-fields request_number' value='" + value + "' name='' id='' readonly='readonly'/></td>";
}

function saveVoucher(){
    var url = "<?=base_url();?>Voucher/insert_new_voucher";
    var data = $("#frm_voucher").serializeArray();

    $.ajax({
        url:url,
        type:"POST",
        data:data,
        beforeSend:function(){

        },
        success:function(response){
            alert(response);
            //location.href = document.referrer 
        },
        error:function(){
            alert('Error occurred');
        }

    });
}

$(".btn-save").on('click',function(){
    saveVoucher();
    //go_back();
    location.href = document.referrer; 
});

$(".btn-save-new").on('click',function(){
    saveVoucher();
    resetVoucher();
});
</script>