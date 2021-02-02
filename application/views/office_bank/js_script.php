<script>
$(document).ready(function(){
    $("#office_bank_is_default").closest('.form-group').hide();

    $("#fk_office_id").on('change',function(){
        if($("#fk_bank_id").val()){
            show_office_bank_is_default_field();
        }
    });

    $("#fk_bank_id").on('change',function(){
        if($("#fk_office_id").val()){
            show_office_bank_is_default_field();
        }
    });

    function show_office_bank_is_default_field(){
        var data = {'office_id':$("#fk_office_id").val(),'bank_id':$("#fk_bank_id").val()};
        var url = "<?=base_url();?>Office_bank/check_office_has_default_office_bank"

        $.post(url,data,function(response){
            //console.log(response);
            if(!response){
                $("#office_bank_is_default").closest('.form-group').show();
            }else{
                $("#office_bank_is_default").closest('.form-group').hide();
            }
        });

        
    }
});
</script>