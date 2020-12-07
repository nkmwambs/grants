<?php

if(!function_exists('office_bank_select')){
    function office_bank_select($office_id,$project_allocation_id = 0){

        $CI =& get_instance();
        $CI->load->model('office_bank_model');

        $option = "<option value=''>".get_phrase('select_office_bank')."</option>";

        $office_banks = $CI->office_bank_model->get_office_banks($office_id);

        foreach($office_banks as $office_bank){
            $option .= "<option value='".$office_bank['office_bank_id']."'>".$office_bank['office_bank_name']."</option>";
        }

        ?>
            <script>
                $(document).on('change','.change_office_bank',function(){
                    var row = $(this).closest('tr');
                    var project_allocation_id = $(this).data('project_allocation_id');
                    var data ={'fk_project_allocation_id':project_allocation_id,'fk_office_bank_id':$(this).val()};
                    var url = "<?=base_url();?>Office_bank_project_allocation/insert_office_bank_project_allocation";

                    var cnf = confirm('Are you sure you want to create this association');

                    if(!cnf){
                        return false;
                        alert('Process aborted');
                    }

                    $.post(url,data,function(response){
                        console.log(response);
                        row.remove();
                        //return false;
                    });
                });
            </script>
        <?php

        return '<select data-project_allocation_id = "'.$project_allocation_id.'" class="form-control change_office_bank">'.$option.'</select>';
    }
}