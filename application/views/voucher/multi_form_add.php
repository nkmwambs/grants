<style>
.control-label{
    text-align:left;
}

.center{
    text-align:center;
}
/* .validate_error{
    border : 1px red solid;
} */

</style>


<div class="row">
    <div class="col-xs-12">
        <?=Widget_base::load('position','position_1');?>
    </div>
</div>

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
                            <select class='form-control required' id='office' name='fk_office_id'>
                                <option value=""><?=get_phrase('select_office');?></option>
                                <?php 
                                    foreach($this->session->hierarchy_offices as $office){
                                        if(!$office['office_is_active']) continue;
                                ?>
                                        <option value="<?=$office['office_id'];?>"><?=$office['office_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label class='control-label col-xs-1 date-field'><?=get_phrase('date');?></label>
                        <div class='col-xs-2 date-field'>
                            <input id="transaction_date" type='text' name='voucher_date' readonly class='form-control required' />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('voucher_number');?></label>
                        <div class='col-xs-2'>
                            <input type='text' readonly class='form-control required' name='voucher_number' id="voucher_number" />
                        </div>

                        <label class='control-label col-xs-1'><?=get_phrase('voucher_type');?></label>
                        <div class='col-xs-2'>
                            <select class='form-control required'  disabled="disabled" name='fk_voucher_type_id' id='voucher_type' onchange="get_bank_cash_information(this);">
                                <option value=""><?=get_phrase('select_voucher_type');?></option>
                                
                            </select>
                        </div>

                    </div>

                    <div class='form-group'>
                                                
                        <span class='hidden'>
                            <label class='control-label col-xs-1'><?=get_phrase('bank_account');?></label>
                            <div class='col-xs-2'>
                                <select class="form-control required account_fields" disabled="disabled" name='fk_office_bank_id' id='bank'>
                                        <option value=""><?=get_phrase('select_bank_account');?></option>
                                </select>
                            </div>
                        </span>

                        <span class='hidden'>
                            <label class='control-label col-xs-1'><?=get_phrase('cheque_number');?></label>
                            <div class='col-xs-2'>
                                <!-- <input type='text' name='voucher_cheque_number' id='cheque_number' disabled='disabled' class='form-control required account_fields' /> -->
                                <select class='form-control required account_fields' name='voucher_cheque_number' id='cheque_number' disabled='disabled'>
                                    <option value=''><?=get_phrase('select_cheque_number');?></option>
                                </select>
                            </div>
                        </span>

                        <span class='hidden'>
                            <label class='control-label col-xs-1'><?=get_phrase('cash_account');?></label>
                            <div class='col-xs-2'>
                                <select class="form-control required account_fields" disabled="disabled" name='fk_office_cash_id' id='cash_account'>
                                        <option value=""><?=get_phrase('select_cash_account');?></option>
                                </select>
                            </div>
                        </span>
                        
                        <span class='hidden'>
                            <label class='control-label col-xs-1'><?=get_phrase('receiving_account');?></label>
                            <div class='col-xs-2'>
                                <select name='cash_recipient_account' disabled="disabled" id='cash_recipient_account' class='form-control required account_fields'>
                                </select>
                            </div>
                        </span>


                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('payee/_vendor');?></label>
                        <div class='col-xs-11'>
                            <input type='text' id='voucher_vendor' name='voucher_vendor' class='form-control required' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('address');?></label>
                        <div class='col-xs-11'>
                            <input type='text' id='voucher_vendor_address' name='voucher_vendor_address' class='form-control required' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='col-xs-1'><?=get_phrase('description');?></label>
                        <div class='col-xs-11'>
                            <input type='text' id='voucher_description' name='voucher_description' class='form-control required' />
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

                                        <?php 
                                            $toggle_accounts_by_allocation = $this->config->item("toggle_accounts_by_allocation");

                                            if($toggle_accounts_by_allocation){
                                        ?>
                                                <th><?=get_phrase('allocation_code');?></th>
                                                <th><?=get_phrase('account');?></th>
                                        <?php }else{?>
                                                <th><?=get_phrase('account');?></th>
                                                <th><?=get_phrase('allocation_code');?></th>
                                        <?php }?> 
                                        
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
               <?php //echo Widget_base::load('upload');?>
            </div>
        </div>


    </div>
</div>

<script>

var toggle_accounts_by_allocation = '<?=$this->config->item("toggle_accounts_by_allocation");?>';

$(document).ready(function(){
    //get_approved_unvouched_request_details
    $('.date-field').hide();
    $('.btn-insert').hide();
    $('.btn-save').hide();
    $('.btn-save-new').hide();
    $('.btn-retrieve-request').hide();

    
});

// function update_request_details_count_on_badge(){
//     var badges = $(".requests_badge");
//     var request_rows = $(".map_request_to_voucher_row");

//     var current_count = request_rows.length;

//     badges.html(current_count);

// }
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

$(document).on('change', '#voucher_type',function(){

 var office=$('#office').val();

 var url=  "<?=base_url();?>Voucher/get_count_of_unvouched_request/"+ office;

 $.get(url,office,function(response){
     var badges = $(".requests_badge");
     badges.html(response);

 })

});


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

    $('.btn-save, .btn-save-new').show();
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

// function showHiddenButtons(response_is_expense, response_is_bank_payment, show_insert_buttons = false){
//     if(!response_is_bank_payment || (response_is_bank_payment && ($("#bank").val() != "" || $("#cheque_number").val() != ""))){
        
//         if(show_insert_buttons){
//             $('.btn-save').show();
//             $('.btn-save-new').show();
//         }    

//         $('.btn-insert').show();

//         var only_allow_voucher_details_from_request = '<?=$this->config->item('only_allow_voucher_details_from_request');?>';

//         if(response_is_expense && only_allow_voucher_details_from_request == true){
//             $('.btn-insert').hide();
//         }

//          if(response_is_expense){
//             $('.btn-retrieve-request').show();
//            }else{
//             $('.btn-retrieve-request').hide();
//         }
//     }else{
//         hide_buttons();
//     }

    
// }

function populate_cash_transfer_recipient(elem){
    var selected_option_index = elem.find(':selected').index();

    var elem_clone  = elem.clone();
    elem_clone.find('option').eq(selected_option_index).remove();
    options = elem_clone.children();

    $("#cash_recipient_account").html(options);
    $("#cash_recipient_account").prop("selectedIndex", 0);
 
}

$("#cash_account").on('change',function(){
    populate_cash_transfer_recipient($(this));
});

// function prevent_bank_change_when_voucher_has_detail_row(){
//     var tbl_body_rows = $("#tbl_voucher_body tbody tr");
//     var count_body_rows = tbl_body_rows.length;
    
//     if(count_body_rows > 0){
//         alert("You can't change a bank account when voucher has detail rows");
//         return false;
//     }else{
//         return true;
//     }
    
// }

$("#bank").on("change",function(ev){

    // Toogle Disable when a bank account is selected or not
    if($(this).val() != ''){
        $("#cheque_number").removeAttr('disabled');
        $("#cheque_number").removeAttr('readonly');
    }else{
        $("#cheque_number").val("");
        $("#cheque_number").prop('disabled','disabled');
    }

    // Populate transfer account list
    if(!$("#cash_recipient_account").closest('span').hasClass('hidden')){
        populate_cash_transfer_recipient($(this));
    }

    var office = $('#office').val();
    var bank = $(this).val();

    var url = "<?=base_url();?>Voucher/check_cheque_validity";
    var data = {'office_id':office,'bank_id':bank};

    // if($("#bank").val() == ""){
    //     alert("Choose a valid bank account");
    //     $('#cheque_number').val('');
    //     return false;
    // }

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        beforeSend:function(){

        },
        success:function(response){
            //console.log(response);

            var options = 'option value=""><?=get_phrase('select_cheque_number');?></option>';

            if(response == 0){
                alert('The bank account selected lacks a cheque book');
            }else{
                var obj = JSON.parse(response);
            
                $.each(obj,function(i,elem){
                    options += "<option value='"+elem.cheque_number+"'>"+elem.cheque_number+"</option>";
                });
            }

            $("#cheque_number").html(options);
        
        },
        error:function(){
            alert("Error occurred!");
        }
    });
});

// function checkIfChequeIsValid(office,bank,cheque_number){
    
//     var url = "<?=base_url();?>voucher/check_cheque_validity";
//     var data = {'office_id':office,'bank_id':bank,'cheque_number':cheque_number};

//     if($("#bank").val() == ""){
//         alert("Choose a valid bank account");
//         $('#cheque_number').val('');
//         return false;
//     }

//     $.ajax({
//         url:url,
//         data:data,
//         type:"POST",
//         beforeSend:function(){

//         },
//         success:function(response){
     
//             // if(!response){
//             //     alert("The cheque number given ("+ cheque_number +") is not valid");
//             //     $("#cheque_number").val("");
//             // }
//         },
//         error:function(){
//             alert("Error occurred!");
//         }
//     });
// }

$("#cheque_number").on('change',function(){
    var office = $("#office").val();
    var bank = $("#bank").val();
    var cheque_number = $("#cheque_number").val();

    //console.log(cheque_number);

    //checkIfChequeIsValid(office,bank,cheque_number);
});

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

$("#office").on('change',function(){
    var clear_office_selector = false;
    resetVoucher(clear_office_selector);

    //console.log($(this).val());

     if($(this).val() == "") {
         return false;
     }
    
    if($(".split_screen").hasClass('col-xs-6')) load_approved_requests();

    computeNextVoucherNumber($(this).val());

    computeCurrentTransactingDate($(this).val());

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

function populate_select(obj,parent_elem,default_html_text = 'Select an option'){
    
    parent_elem.children().remove();

    var option_html = "<option value=''>"+default_html_text+"</option>";

    $.each(obj,function(i,elem){
        option_html += "<option value='"+elem.item_id+"'>"+elem.item_name+"</option>";
    });

    parent_elem.append(option_html);
}

function add_options_to_bank_select(response_office_bank, show_cash_accounts = false){
    if(!show_cash_accounts) $("#cash_account").closest('span').addClass('hidden');
    
    $("#bank").closest('span').removeClass('hidden');
    $("#bank").removeAttr('disabled');
    $("#cheque_number").val("");
    populate_select(response_office_bank,$("#bank"),'Select a bank account');
}

function add_options_to_cash_select(response_office_cash, show_bank_accounts = false){
    if(!show_bank_accounts) $("#bank").closest('span').addClass('hidden');
    
    $("#cash_account").closest('span').removeClass('hidden');
    $("#cash_account").removeAttr('disabled');
    populate_select(response_office_cash,$("#cash_account"),'Select a cash account');
}

function get_bank_cash_information(voucherTypeSelect){

    remove_voucher_detail_rows();

    var office_id = $("#office").val();
    var voucher_type_id = $(voucherTypeSelect).val();// Can be expense, income, cash_contra or bank_contra
    var url = "<?=base_url();?>Voucher/check_voucher_type_affects_bank/" + office_id + "/" + voucher_type_id;
    var office_bank_id = !$("#bank").attr('disabled')?$("#bank").val():0;
    var extra_data = {'office_bank_id':office_bank_id};

    if(!voucher_type_id) {
        hide_buttons();
        $(".account_fields").closest('span').addClass('hidden');
        return false;
    }

    checkIfDateIsSelected()?$.post(url,extra_data,function(response){
        var response_objects = JSON.parse(response);
        var response_office_cash = response_objects['office_cash'];
        var response_office_bank = response_objects['office_banks'];
        var response_is_transfer_contra = response_objects['is_transfer_contra'];
        var response_is_bank_payment = response_objects['is_bank_payment'];


        if(response_office_cash.length > 0){
            add_options_to_cash_select(response_office_cash);

            if(response_office_bank.length > 0) add_options_to_bank_select(response_office_bank, true);
            
        }else if(response_office_bank.length > 0){
            add_options_to_bank_select(response_office_bank);

            if(response_office_cash.length > 0) add_options_to_cash_select(response_office_cash, true);
            
        }

        if(response_is_transfer_contra){
            $("#cash_recipient_account").closest('span').removeClass('hidden');
            $("#cash_recipient_account").removeAttr('disabled');
            $("#cash_recipient_account").html('');
        }else{
            $("#cash_recipient_account").closest('span').addClass('hidden');
        }

        if(response_is_bank_payment){
            $("#cheque_number").closest('span').removeClass('hidden');
        }else{
            $("#cheque_number").closest('span').addClass('hidden');
        }

        if(voucher_type_id){
            //update_request_details_count_on_badge();
            $(".btn-insert").show();
            $(".btn-retrieve-request").show();
        }else{
            hide_buttons();
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

// Returns if a value is an object
function isObject (value) {
    return value && typeof value === 'object' && value.constructor === Object ? true : false;
}

function create_accounts_select_options(response_accounts){
    var account_select_option = "<option value=''>Select an account</option>";

    if(isObject(response_accounts) && response_accounts.length > 0){
        $.each(response_accounts,function(i,el){
            account_select_option += "<option value='" + response_accounts[i].account_id + "'>" + response_accounts[i].account_name + "</option>";
        });
    }

    $(".account").html(account_select_option);

}

function create_allocation_select_options(response_allocation){
    var tbl_body = $("#tbl_voucher_body tbody");
    var allocation_select_option = "<option value=''>Select an allocation code</option>";

    if(response_allocation.length > 0){

        $(".allocation").removeAttr('disabled');

        $.each(response_allocation,function(i,el){
            allocation_select_option += "<option value='" + response_allocation[i].project_allocation_id + "'>" + response_allocation[i].project_allocation_name + "</option>";
        });
    }

    tbl_body.find(':last-child').find(".allocation").html(allocation_select_option);

}

function remove_voucher_detail_rows(min_rows = 0){
    var tbl_body_rows = $("#tbl_voucher_body tbody tr");

    // Remove extra rows
    var count_body_rows = tbl_body_rows.length;
    
    if(count_body_rows > min_rows){
        $.each(tbl_body_rows,function(i,el){
           if($("#tbl_voucher_body tbody tr").length > min_rows){
                $(el).remove();
            }
        });
    }
}

function reset_account_fields(){
    $('.account_fields').each(function(i,elem){
        $(elem).val('');
        $(elem).prop('disabled','disabled');
        $(elem).closest('span').addClass('hidden');
    });
}

function reset_particulars_fields(){
    $("#voucher_vendor").val("");
    $("#voucher_vendor_address").val("");
    $("#voucher_description").val("");
}

function reset_voucher_identity_fields(clear_office_selector){
    //console.log($("#office").val());
    if(clear_office_selector){
        $("#transaction_date").val("");
        $("#voucher_number").val('');
        $("#office").val('');
        $("#voucher_type").val("");
        $("#voucher_type").prop('disabled','disabled'); 
    }
      
}

function resetVoucher(clear_office_selector = true){
    remove_voucher_detail_rows();
    reset_account_fields();
    reset_particulars_fields();
    reset_voucher_identity_fields(clear_office_selector);
    hide_buttons();
    
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

function insertRow(response_is_contra = false){
    var tbl_body = $("#tbl_voucher_body tbody");
    var tbl_head = $("#tbl_voucher_body thead");

    var cell = actionCell(); 
    cell += quantityCell(); 
    cell += descriptionCell();
    cell += unitCostCell(); 
    cell += totalCostCell(); 

    if(toggle_accounts_by_allocation){
        cell += allocationCodeCell(); 
        cell += accountCell(); 
    }else{
        cell += accountCell(); 
        cell += allocationCodeCell(); 
    }

    cell += requestIdCell(); 

    tbl_body.append("<tr>"+cell+"</tr>");
}

function voucher_has_request_details_inserted(){
    var request_number = $('.request_number'); 
    var voucher_has_request_details_inserted = false;


    $.each(request_number,function(i,elem){
        if($(elem).val() > 0){
            voucher_has_request_details_inserted = true;
            return false;
        }
    });

    return voucher_has_request_details_inserted;

}

$(".btn-insert").on('click',function(){

    $('.account_fields').each(function(i,elem){
        //$(elem).attr("style", "pointer-events: none;");
        if($(elem).val() != ''){
            if($(elem).is('select')){
                $(elem).find('option:not(:selected)').prop('disabled', true);
            }else{
                $(elem).prop('readonly','readonly');
            }
        }
    });
    
    var tbl_body_rows = $("#tbl_voucher_body tbody tr");

    if(tbl_body_rows.length == 0 || voucher_has_request_details_inserted()){
        
        var count_account_fields = 0;

        $(".account_fields").each(function(i,elem){
            if(!$(elem).closest('span').hasClass('hidden') && $(elem).val() == ''){
                count_account_fields++;
                $(elem).css('border','1px red solid');
            }
        });

        if(count_account_fields) {
            alert('Complete filling the required cash or bank account fields');
            return false;
        }

        updateAccountAndAllocationField();
    }else{
        copyRow();   
    }  

    $(".btn-save, .btn-save-new").show();
});


function updateAccountAndAllocationField(){
    var office_id = $("#office").val();

    var transaction_date = $("#transaction_date").val();

    var voucher_type_id = $("#voucher_type").val();// Can be expense, income, cash_contra or bank_contra
    var office_bank_id = !$("#bank").attr('disabled')?$("#bank").val():0;
    var extra_data = {'office_bank_id':office_bank_id};
    var url = "<?=base_url();?>Voucher/get_voucher_accounts_and_allocation/" + office_id + "/" + voucher_type_id + "/" + transaction_date + "/" + office_bank_id;
    
    $.ajax({
        url:url,
        type:"POST",
        data:extra_data,
        beforeSend:function(){

        },
        success:function(response){
            //console.log(response);
            var account_select_option = "<option value=''>Select an account</option>";

            var allocation_select_option = "<option value=''>Select an allocation code</option>";

            var response_objects = JSON.parse(response);

            //var response_accounts = response_objects['accounts'];
            var response_allocation = response_objects['project_allocation'];
            //var toggle_accounts_by_allocation = '<?=$this->config->item("toggle_accounts_by_allocation");?>';
            var response_is_contra = response_objects['is_contra'];

            //alert(response);
            insertRow(response_is_contra);

            //console.log(toggle_accounts_by_allocation);

            //if(toggle_accounts_by_allocation){
                create_allocation_select_options(response_allocation);
            // } else {
            //     create_accounts_select_options(response_accounts);
            // }  
            
            
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
        updateTotalCost();
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

function updateTotalCost(){
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

    var office_bank_id = !$("#bank").attr('disabled')?$("#bank").val():0;

    //var toggle_accounts_by_allocation = '<?=$this->config->item("toggle_accounts_by_allocation");?>';

    if(!toggle_accounts_by_allocation){

        $.ajax({
            url:url,
            data:{'office_id':office_id,'account_id':account_id,'voucher_type_id':voucher_type_id,'transaction_date':transaction_date,'office_bank_id':office_bank_id},
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
    }
});

$(document).on('change','.allocation',function(){
    
    var office_id = $("#office").val();
    var allocation_id = $(this).val();
    var voucher_type_id = $("#voucher_type").val();
    var transaction_date = $("#transaction_date").val();
    var office_bank_id = !$("#bank").attr('disabled')?$("#bank").val():0;
    var row = $(this).closest('tr');

    var url = "<?=base_url();?>voucher/get_accounts_for_project_allocation/";
    var data = {'office_id':office_id,'allocation_id':allocation_id,'voucher_type_id':voucher_type_id,'transaction_date':transaction_date,'office_bank_id':office_bank_id};
    
    //var toggle_accounts_by_allocation = '<?=$this->config->item("toggle_accounts_by_allocation");?>';

    if(toggle_accounts_by_allocation){

        $.post(url,data,function(response){
                //alert(response);
                var response_accounts = JSON.parse(response);

                var accounts_select_option = "<option value=''>Select account</option>";

                if(response_accounts.length > 0){
                    $(".account").removeAttr('disabled');
                    $.each(response_accounts,function(i,el){
                        accounts_select_option += "<option value='" + response_accounts[i].account_id + "'>" + response_accounts[i].account_name + "</option>";
                    });
                }else{
                    $(".account").prop('disabled','disabled');
                }

                row.find(".account").html(accounts_select_option);
        });
    }

});

function actionCell(){
    return "<td><div class='btn btn-danger action' onclick='removeRow(this);'>Remove Row</div> &nbsp; <span onclick='clearRow(this);' class='fa fa-trash'></span> </td>";
}

function quantityCell(value = 0){
    return "<td><input name='voucher_detail_quantity[]' type='number' class='form-control required body-input number-fields quantity' onclick='replaceValue(this);' onchange='computeTotalCost(this);' value='" + value + "' name='' id=''/></td>";
}

function descriptionCell(value = ''){
    return "<td><input  name='voucher_detail_description[]' type='text' class='form-control required body-input description' value='" + value + "' name='' id=''/></td>"; 
}

function unitCostCell(value = 0){
    return "<td><input  name='voucher_detail_unit_cost[]' type='number' class='form-control required body-input number-fields unitcost' onclick='replaceValue(this);' onchange='computeTotalCost(this);'  value='" + value + "' name='' id=''/></td>";
}

function totalCostCell(value = 0){
    return "<td><input name='voucher_detail_total_cost[]' type='number' class='form-control required body-input number-fields totalcost' value='" + value + "' name='' id='' readonly='readonly'/></td>";
}

function accountCell(value = 0){
    //var toggle_accounts_by_allocation = '<?=$this->config->item("toggle_accounts_by_allocation");?>';
    
    if(toggle_accounts_by_allocation){
        return "<td><select disabled='disabled' name='voucher_detail_account[]' class='form-control required body-input account' name='' id=''></select></td>";
    }else{
        return "<td><select name='voucher_detail_account[]' class='form-control required body-input account' name='' id=''></select></td>";
    }
    
}

function allocationCodeCell(value = 0){
    //var toggle_accounts_by_allocation = '<?=$this->config->item("toggle_accounts_by_allocation");?>';

    if(toggle_accounts_by_allocation){
        return "<td><select name='fk_project_allocation_id[]' class='form-control required body-input allocation' name='' id=''></select></td>";
    }else{
        return "<td><select disabled='disabled' name='fk_project_allocation_id[]' class='form-control required body-input allocation' name='' id=''></select></td>";
    }
    
}

function requestIdCell(value = 0){
    return "<td><input name='fk_request_detail_id[]' type='number' class='form-control body-input number-fields request_number' value='" + value + "' name='' id='' readonly='readonly'/></td>";
}

function disable_elements_in_hidden_span(){
    var elem_in_hidden_span = $('span.hidden .account_fields');

    $.each(elem_in_hidden_span,function(i,elem){
        if(!$(elem).attr('disabled')){
            $(elem).prop('disabled','disabled');
        }
    });
}

function saveVoucher(clicked_btn){
    var url = "<?=base_url();?>Voucher/insert_new_voucher";
    var data = $("#frm_voucher").serializeArray();

    // Make all select or inputs in hidden span be disabled
    disable_elements_in_hidden_span();


    if(!check_required_fields()){
        alert('Empty required fields exists');
    }else{
        $.ajax({
            url:url,
            type:"POST",
            data:data,
            success:function(response){
                alert(response);
                //console.log(response);return false;
                if(clicked_btn.hasClass('btn-save')){
                    location.href = document.referrer 
                }else{
                    resetVoucher();
                }
            }

        });
    }
}

$(".btn-save").on('click',function(){
    saveVoucher($(this));
});

$(".btn-save-new").on('click',function(){
    saveVoucher($(this));

    //window.location.reload();
});

function check_required_fields(){
    return_flag = true;

    $(".required").each(function(i,el){
        if(
            $(el).val() == "" && 
            !$(el).attr('disabled') && 
            !$(el).attr('readonly') && 
            $(el).hasClass('required') 
        ){
            //$(el).addClass('validate_error');
            return_flag = false;
            $(el).css('border','1px red solid');
        }
    });

    return return_flag;
}


$(document).on('change','.required',function(){
    if($(this).attr('style')){
        $(this).removeAttr('style');
    }
});
</script>