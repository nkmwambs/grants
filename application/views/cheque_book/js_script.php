<script>
$("#cheque_book_count_of_leaves, #cheque_book_start_serial_number").on('change',function(){
    if($(this).val() < 1){
        alert('You must have a count greater than zero');
        $(this).val('');
        $(this).css('border','1px red solid');
    }else{    
        last_cheque_leaf_label();
    }
});

function last_cheque_leaf_label(){

        var start_serial = $("#cheque_book_start_serial_number").val();
        var leave_count = $("#cheque_book_count_of_leaves").val();

        var cheque_book_count_of_leaves_form_group = $("#cheque_book_count_of_leaves").closest('.form-group');
        
        if(start_serial > 0 && leave_count > 0){
            
            var last_leaf = parseInt(start_serial) + (parseInt(leave_count) - 1)

            if(!$("#last_leaf_form_group").length){
                cheque_book_count_of_leaves_form_group.after('<div class="form-group" id="last_leaf_form_group"><label class="col-xs-3 control-label"><?=get_phrase('cheque_book_last_serial_number');?></label><div class="col-xs-9" id="last_leaf_label" style="color:red;"><input type="number" class="form-control" readonly value="'+last_leaf+'"/></div></div>');
            }else{
                $('#last_leaf_label').find('input').val(last_leaf);
            }
        }
        
}
</script>