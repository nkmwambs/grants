<script>
    $("#cheque_injection_number, #fk_office_bank_id").on("change",function(){

        var cheque_injection_number_elem = $("#cheque_injection_number");
        var cheque_injection_number = $("#cheque_injection_number").val();
        var office_bank_id = $("#fk_office_bank_id").val();


        if(!office_bank_id && cheque_injection_number){
            alert("Kindly choose a bank account");
        }else if(office_bank_id && cheque_injection_number){
            var url = "<?=base_url();?>cheque_injection/validate_cheque_number";
            var data = {'cheque_number':cheque_injection_number,"office_bank_id":office_bank_id};

            $.post(url,data,function(response){
                 if(response == 0){
                    alert('Duplicate injected cheque number '+ cheque_injection_number +' found or leaf is in a used cheque book');
                    cheque_injection_number_elem.val("");
                }
            });
        }
    });
</script>