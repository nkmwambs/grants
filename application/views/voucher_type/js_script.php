<script>
$(document).ready(function(){
    $("#fk_voucher_type_effect_id").closest('.form-group').hide();
});


$("#fk_voucher_type_account_id").on('change',function(){
 
    var voucher_type_account_id = $(this).val();
    var url = "<?=base_url();?>/Voucher_type/get_voucher_type_effects/"+voucher_type_account_id;

    $("#fk_voucher_type_effect_id").closest('.form-group').show();
    $("#fk_voucher_type_effect_id").children().remove();

    $.get(url,function(response){
        //alert(response);
        var options = JSON.parse(response);
        var option_html = '<option value="">Select voucher type effect</option>';

        $.each(options,function(i,elem){
            option_html += '<option value="'+elem.voucher_type_effect_id+'">'+elem.voucher_type_effect_name+'</option>';
        });

        $("#fk_voucher_type_effect_id").append(option_html);
    })

});
</script>