<script>

function pre_record_post(){

  if($("#fkvoucher_type_id").val() == 0){
    alert('Choose a voucher type first');
    exit;
  }else if($('.voucher_detail_total_cost').length == 0){
    alert('Add a detail row first');
    exit;
  }

}

$(document).on('change','#voucher_cheque_number',function(){
  let office_bank = $("#fk_office_bank_id").val();
  let cheque_number = $(this).val();
  var url = "<?=base_url();?>voucher/validate_cheque_number";
  var data = {'office_bank':office_bank,'cheque_number':cheque_number};

  $.ajax({
    url:url,
    data:data,
    type:"POST",
    beforeSend:function(){
      $("#voucher_cheque_number").closest('.form-group').append('<div style="text-align:center;" id="validate_voucher_cheque_number">Validating .. </div>');
    },
    success:function(response){
      //alert(response);
      if(!response){
        $("#voucher_cheque_number").css('border','1px solid red');
        $("#voucher_cheque_number").val("");
        alert('Cheque number '+cheque_number+' is invalid');
      }else{
        $("#voucher_cheque_number").removeAttr('style');
      }

      $('#validate_voucher_cheque_number').remove();
      
      
    },
    error:function(){

    }
  });

});

$(document).on('change',"#fk_office_id",function(){

  var office_id =  $(this).val();
  var url = "<?=base_url();?>voucher/update_voucher_header_on_office_change";
  var data = {'office_id':office_id};
  let vtype = $("#fk_voucher_type_id").val();
  let offices = $(this);

  $.ajax({
    url:url,
    data:data,
    type:"POST",
    beforeSend:function(){
      //Toggle the overlay on
      $('#overlay').css('display','block');
    },
    success:function(response){
      // Toggle the overlay off
      $('#overlay').css('display','none');

      // Show fields and save buttons if the office name is selected else hide them
      if(office_id > 0){

        var obj = JSON.parse(response); 

        if($("#fk_voucher_type_id").val() > 0){
          $("#fk_voucher_type_id").val(0);
          $("#fk_office_bank_id").closest('.form-group').addClass('hidden');
          $("#voucher_cheque_number").closest('.form-group').addClass('hidden');
        }else{
          $("#voucher_number").closest('.form-group').removeClass('hidden');
          $("#voucher_date").closest('.form-group').removeClass('hidden');
          $("#fk_voucher_type_id").closest('.form-group').removeClass('hidden'); 
          $('.save').removeClass('hidden');
          $('.save_new').removeClass('hidden');
        
          $("#voucher_number").val(obj.voucher_number);
          $("#voucher_date").val(obj.voucher_date);  
        }        
        
        toggle_approved_request_details(vtype);


      }else{
        $("#voucher_number").closest('.form-group').addClass('hidden');
        $("#voucher_date").closest('.form-group').addClass('hidden');
        $("#fk_voucher_type_id").closest('.form-group').addClass('hidden');
        $('.save').addClass('hidden');
        $('.save_new').addClass('hidden');

        alert('Choose a valid office name');
      }

      remove_all_offices_except_selected(offices);
      
      
    },
    error:function(){

    }
  });

 
});

function remove_all_offices_except_selected(offices){
  
  let office_list = offices.children();

  let selected  = offices.children("option:selected").val();

  office_list.each(function(i,el){
    if($(el).val() != selected){
        // Works but has been commented
        //$(el).remove();
    }
  });

}

$(document).ready(function(){
 
 // Hides or make fields readonly on ready
  set_fields_on_ready();

  $("#fk_voucher_type_id").change(function(){

    let vtype = $(this).val();

    toggle_insert_row_button($(this));
 
    // Show/ hide the approved requests to allow adding their rows to a voucher details
    toggle_approved_request_details(vtype);

    // add column is true then add respective account type column e.g. expense account or income account columns
    append_account_column(vtype);

    // Show bank select when office is selected
    toggle_bank_field(vtype);
        
  });

});

function set_fields_on_ready(){
  $("#voucher_number").closest('.form-group').addClass('hidden');
  $("#voucher_date").closest('.form-group').addClass('hidden');
  $("#fk_voucher_type_id").closest('.form-group').addClass('hidden');
  $("#voucher_cheque_number").closest('.form-group').addClass('hidden');
  $("#fk_office_bank_id").closest('.form-group').addClass('hidden');
  $(".save").addClass('hidden');
  $('.save_new').addClass('hidden');
  $(".insert_row").addClass('hidden');
  
  $("#voucher_number").attr('readonly','readonly');
  $("#center_name").attr('readonly','readonly');

  $("#voucher_cheque_number").val(0);
}

function toggle_insert_row_button(el){
  if($(el).val() > 0){
      $('.insert_row').removeClass('hidden');
    }else{
      $(".insert_row").addClass('hidden');
    }
}

function toggle_bank_field(vtype){
  // Show bank select when office is selected
  if(vtype == 3 && $('#fk_office_id').val() > 0){
      $("#fk_office_bank_id").closest('.form-group').removeClass('hidden');
    }else{
      $("#fk_office_bank_id").closest('.form-group').addClass('hidden');
    }
}

// Add an expense or income account column
function append_account_column(vtype){
  let row  = $('.detail thead tr');
  let th = row.find('th');    
  let detail_body  = $('.detail tbody');
  var add_column = true;

  // Set add_column bool  
  th.each(function(i,el){
      if($(el).hasClass('dynamic_column')){

        var cfm = confirm('Are you sure you want to clear the details?');

        if(cfm){
          
          $(el).remove();

          detail_body.html('');
          
        }else{
          add_column = false;
        }
        
      }
    });

  // add column is true then add respective account type column e.g. expense account or income account columns
  if(add_column){
      
      if(vtype == 2 || vtype == 3 || vtype == 6 ) {
        row.append('<th class="th_data dynamic_column" id="th_expense_account_name">Expense Account Name</th>');
      }
    
      if(vtype == 5 || vtype == 7 || vtype == 8 ) {
        row.append('<th class="th_data dynamic_column" id="th_income_account_name">Income Account Name</th>');
      } 
    }
}

function toggle_approved_request_details(vtype){
  // 2 = Payment by Cash and 3 Payment by Bank
  if(vtype == 2 || vtype == 3) {

   // $("#approved_request_detail").removeClass('hidden');

      var url = "<?=base_url();?>voucher/reload_approved_request_details";  

      $.ajax({
        url:url,
        type:"POST",
        beforeSend:function(){
          $("#approved_request_detail").html('<div style="text-align:center;">Updating ... </div>');
        },
        success:function(response){
          $("#approved_request_detail").html(response);
        },
        error:function(){

        }

      });
    }
    // else{
    //   $("#approved_request_detail").addClass('hidden');
    // }
}

// Show cheque number field when a bank is selected
$("#fk_office_bank_id").change(function(){
  if($(this).val() > 0){
    $("#voucher_cheque_number").closest('.form-group').removeClass('hidden');
  }else{
    $("#voucher_cheque_number").closest('.form-group').addClass('hidden');
  }
  
});

function pre_row_insert(){
  if($("#voucher_type_name").val() == 0){
    alert('Choose a voucher type first');
    exit;
  }
}

function post_row_insert(){
  $("#voucher_type_name").attr("disabled", true);
}

$(document).ajaxSuccess(function() {
  $('.voucher_detail_total_cost').prop('readonly','readonly');
});

$(document).on('keyup','.input_voucher_detail',function(){

  if($(this).hasClass('voucher_detail_quantity')){
    var total_cost = 0;
    var qty = $(this).val();
    var unit_cost = $(this).closest('td').siblings().find('.voucher_detail_unit_cost').val();

    if(!$.isNumeric(unit_cost)){
      unit_cost = 0;
    }
    total_cost = parseFloat(qty) * parseFloat(unit_cost);
    $(this).closest('td').siblings().find('.voucher_detail_total_cost').val(total_cost);
    calcuate_grand_total();
  }

  if($(this).hasClass('voucher_detail_unit_cost')){
    var total_cost = 0;
    var unit_cost = $(this).val();
    var qty = $(this).closest('td').siblings().find('.voucher_detail_quantity').val();

    if(!$.isNumeric(qty)){
      qty = 0;
    }

    total_cost = parseFloat(unit_cost) * parseFloat(qty);
    $(this).closest('td').siblings().find('.voucher_detail_total_cost').val(total_cost);
    calcuate_grand_total();

  }



});

function calcuate_grand_total(){
  var sum = 0;

  $('.voucher_detail_total_cost').each(function(){
    sum += parseFloat($(this).val());
  });

  $('#grand_total').val(sum);
}

function on_row_delete(){
  calcuate_grand_total();
}
</script>
