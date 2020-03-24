<style>
.control-label{
    text-align:left;
}

.center{
    text-align:center;
}
</style>

<?php 
   //print_r($this->voucher_model->get_request_to_voucher_conversion_approval_status(9));
   //$approve_item_id = $this->db->get_where('approve_item',array('approve_item_name'=>'request_detail'))->row()->approve_item_id;
        
  // print_r($this->voucher_model->get_approveable_item_last_status($approve_item_id));
      
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
                        <div class='col-xs-3'>
                            <select class='form-control' id='office' name='fk_office_id'>
                                <option value=""><?=get_phrase('select_office');?></option>
                                <?php foreach($this->session->hierarchy_offices as $office){?>
                                        <option value="<?=$office['office_id'];?>"><?=$office['office_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label class='control-label col-xs-1 date-field'><?=get_phrase('date');?></label>
                        <div class='col-xs-3 date-field'>
                            <input id="transaction_date" type='text' name='voucher_date' readonly class='form-control' />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('voucher_number');?></label>
                        <div class='col-xs-3'>
                            <input type='text' readonly class='form-control' name='voucher_number' id="voucher_number" />
                        </div>

                    </div>

                    <div class='form-group'>
                        <label class='control-label col-xs-1'><?=get_phrase('voucher_type');?></label>
                        <div class='col-xs-3'>
                            <select class='form-control'  disabled="disabled" name='fk_voucher_type_id' id='voucher_type' onchange="getAccountsByVoucherType(this);">
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
                            <select class="form-control" name='fk_office_bank_id' id='bank' readonly>
                                    <option value=""><?=get_phrase('select_bank_account');?></option>
                            </select>
                        </div>


                        <label class='control-label col-xs-1'><?=get_phrase('cheque_number');?></label>
                        <div class='col-xs-2'>
                            <input type='text' name='voucher_cheque_number' id='cheque_number' readonly class='form-control' />
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
        var url = "<?=base_url();?>voucher/get_approve_request_details/" + office;

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

function showHiddenButtons(response_is_expense){
    
    $('.btn-save').show();
    $('.btn-save-new').show();
    $('.btn-insert').show();

    var only_allow_voucher_details_from_request = '<?=$this->config->item('only_allow_voucher_details_from_request');?>';

    if(response_is_expense && only_allow_voucher_details_from_request == true){
        $('.btn-insert').hide();
    }
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
    
    var rows = $("#tbl_voucher_body tbody tr");

    if($(this).val() == "") {
        resetVoucher();
        return false;
    }
    
    if($(".split_screen").hasClass('col-xs-6')) load_approved_requests();
    

    resetVoucher();

    computeNextVoucherNumber($(this).val());

    computeCurrentTransactingDate($(this).val());

    getOfficeBanks($(this).val());

    $.each(rows,function(i,el){
        el.remove();
    });

    $("#voucher_type").val('');

    $("#voucher_type").removeAttr('disabled');
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
    
    var account_select_option = "<option value=''>Select an account</option>";

    var allocation_select_option = "<option value=''>Select an allocation code</option>";

    var tbl_body_rows = $("#tbl_voucher_body tbody tr");
   
    checkIfDateIfSelected()?$.ajax({
        url:url,
        type:"POST",
        beforeSend:function(){

        },
        success:function(response){

            var response_objects = JSON.parse(response);

            var response_accounts = response_objects['accounts'];
            var response_allocation = response_objects['project_allocation'];
            var response_is_bank_payment = response_objects['is_bank_payment'];
            var response_is_expense = response_objects['is_expense'];
            var response_approved_requests = response_objects['approved_requests'];

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

            showHiddenButtons(response_is_expense);
            
            $(".allocation").html(allocation_select_option);

            $(".account").html(account_select_option);


            $.each($(".requests_badge"),function(i,el){
                $(el).html(response_approved_requests);
            });

            if(response_is_expense){
                $('.btn-retrieve-request').show();
            }else{
                $('.btn-retrieve-request').hide();
            }

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
    
    //alert(count_body_rows);
    
    if(count_body_rows > 1){
        $.each(tbl_body_rows,function(i,el){
            if(i != 0){
                $(el).remove();
            }
        });
    }

    // Empty the cells
    $(".body-input").val(null);
    $(".number-fields").val(0);
    $("#bank").val("");
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
});

function updateAccountAndAllocationField(expense_account_id = "", project_allocation_id = ""){
    var office_id = $("#office").val();

    var transaction_date = $("#transaction_date").val();

    var voucher_type_id = $("#voucher_type").val();// Can be expense, income, cash_contra or bank_contra

    var url = "<?=base_url();?>voucher/get_voucher_accounts_and_allocation/" + office_id + "/" + voucher_type_id + "/" + transaction_date;
    
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

            $(".allocation").html(allocation_select_option);

            $(".account").html(account_select_option);
            
            // last_added_row = $("#tbl_voucher_body tbody tr").last().find('select');

            // $.each(last_added_row,function(i,el){
                
            //     if(i == 0){
            //         // Not working in the mean time
            //         $(el).val() = expense_account_id;;
            //     }
                
            // });

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
    return "<td><select name='fk_project_allocation_id[]' class='form-control body-input allocation' name='' id=''></select></td>";
}

function requestIdCell(value = 0){
    return "<td><input name='fk_request_detail_id[]' type='number' class='form-control body-input number-fields request_number' value='" + value + "' name='' id='' readonly='readonly'/></td>";
}

function saveVoucher(){
    var url = "<?=base_url();?>voucher/insert_new_voucher";
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
    location.href = document.referrer 
});

$(".btn-save-new").on('click',function(){
    saveVoucher();
    resetVoucher();
});
</script>