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

$(document).ready(function(){
  $("#voucher_cheque_number").attr('readonly','readonly');
  $("#voucher_number").attr('readonly','readonly');
  $("#center_name").attr('readonly','readonly');

  $("#fk_voucher_type_id").change(function(){
  
    let row  = $('.detail thead tr');
    let th = row.find('th');  
    let vtype = $(this).val();
   
    th.each(function(i,el){
      if($(el).hasClass('dynamic_column')){
        //$(el).css('backgroundColor','red');
        $(el).remove();
      }
    });

    if(vtype == 2 || vtype == 3 || vtype == 6 ) row.append('<th class="th_data dynamic_column" id="th_expense_account_name">Expense Account Name</th>');

    if(vtype == 5 || vtype == 7 || vtype == 8 ) row.append('<th class="th_data dynamic_column" id="th_income_account_name">Income Account Name</th>');
    
  });

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
