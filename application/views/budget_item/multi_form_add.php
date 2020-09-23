<style>
.center{
    text-align:center;
}
</style>

<?php 
//print_r($result);

extract($result);

?>

<div class="row">
    <div class='col-xs-12'>
        <div class="panel panel-default" data-collapsed="0">
       	    <div class="panel-heading">
           	    <div class="panel-title" >
           		    <i class="entypo-plus-circled"></i>
					    <?php echo get_phrase('add_budget_item_for_');?> <?=$office->office_code.' - '.$office->office_name.' : '.get_phrase('year').' - '.$office->budget_year;?>
           	    </div>
            </div>
	    
            <div class="panel-body"  style="max-width:50; overflow: auto;">	
                <?php echo form_open("" , array('id'=>'frm_budget_item','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
                    <div class='form-group'>
                        <div class='col-xs-12 center'>
                            <div class='btn btn-default btn-reset'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default btn-save'><?=get_phrase('save');?></div>
                            <div class='btn btn-default btn-save-new'><?=get_phrase('save_and_new');?></div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class="col-xs-12">
                            <textarea name='budget_item_description' id='budget_item_description' placeholder="<?=get_phrase('describe_budget_item');?>"  class='form-control resetable'></textarea> 
                        </div>         
                    </div>

                    <div class="form-group">

                        <label class='control-label col-xs-2'><?=get_phrase('project_allocation');?></label>
                        <div class='col-xs-2'>
                            <select name='fk_project_allocation_id' id='fk_project_allocation_id'  class='form-control resetable'>
                                <option value=''><?=get_phrase('select_a_project_allocation');?></option>        

                                <?php foreach($project_allocations as $project_allocation){?>
                                    <option value='<?=$project_allocation->project_allocation_id;?>'><?=$project_allocation->project_name;?></option>
                                <?php }?>    
                            </select>
                        </div>

                        <label class='control-label col-xs-2'><?=get_phrase('expense_account');?></label>
                        <div class='col-xs-2'>
                            <select name='fk_expense_account_id' id='fk_expense_account_id'  class='form-control resetable'>
                                
                                <option value=''><?=get_phrase('select_an_account');?></option>
                                
                                
                            </select>
                        </div>

                    </div>

                    <div class='form-group'>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?=get_phrase('action');?></th>
                                    <?php 
                                        foreach($months as $month){
                                    ?>
                                        <th><?=get_phrase($month->month_name);?></th>
                                    <?php 
                                        }
                                    ?>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><div class='btn btn-danger' id='btn-clear'><?=get_phrase('clear');?></div></td>
                                    
                                    <?php foreach($months as $month){ ?>
                                        <td><input type='text' id='' name='fk_month_id[<?=$month->month_id;?>][]' value='0' class='form-control month_spread' /></td>
                                    <?php }?>
                                
                                </tr>
                            </tbody>      
                        </table>
                    </div>

                    <div class='form-group'>
                        <!-- <label class='control-label col-xs-2'><?=get_phrase('total_cost');?></label> -->
                        <div class='col-xs-2'>
                            <input type='number' readonly='readonly' name='budget_item_total_cost' id='budget_item_total_cost'  class='form-control resetable' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12 center'>
                            <div class='btn btn-default btn-reset'><?=get_phrase('reset');?></div>
                            <div class='btn btn-default btn-save'><?=get_phrase('save');?></div>
                            <div class='btn btn-default btn-save-new'><?=get_phrase('save_and_new');?></div>
                        </div>
                    </div>                
                    <!--Hidden fields-->
                    <input type='hidden' value='<?=hash_id($this->id,'decode');?>' name='fk_budget_id' id='fk_budget_id' />
                </form>
            </div>    
                  
    </div>
</div>

<script>

$("#fk_project_allocation_id").on('change',function(){
    var project_allocation_id = $(this).val();
    var url = "<?=base_url();?>Budget_item/project_budgetable_expense_accounts/"+project_allocation_id;

    let option = '<option value=""><?=get_phrase('select_expense_account');?></option>';

    $('#fk_expense_account_id').html(option);


    if(!$.isNumeric(project_allocation_id)){
        return false;
    }

    $.get(url,function(response){
        var accounts_obj = JSON.parse(response);

        $.each(accounts_obj,function(i,el){
            option += '<option value="'+accounts_obj[i].expense_account_id+'">'+accounts_obj[i].expense_account_name+'</option>';
        });

        $('#fk_expense_account_id').html(option);
    });
    
});

$('.month_spread').focusout(function(){
    if(!$.isNumeric($(this).val())){
        $(this).val(0);
    }
});

$('.month_spread').focusin(function(){
    if($(this).val() == 0){
        $(this).val('');
    }
});

$('.month_spread').on('change',function(){
    if($(this).val() < 0){
        alert('<?=get_phrase('negative_values_not_allowed');?>');
        $(this).val(0);
    }
});


$('.month_spread').on('keyup',function(){
    
    var sum_spread = 0;

    $('.month_spread').each(function(index,elem){
        if($(elem).val() > 0){
            sum_spread = sum_spread + parseFloat($(elem).val());
        }
    });

    $('#budget_item_total_cost').val(sum_spread);
});

$("#btn-clear").on('click',function(){
    $.each($(".month_spread"),function(i,el){
        $(el).val(0);
    });
});

$(".btn-save-new").on('click',function(){
    save();
    resetForm();
});

$(".btn-save").on('click',function(){
    save();
    //go_back();
    location.href = document.referrer;
});

function save(){
    let frm = $("#frm_budget_item");

    let data = frm.serializeArray();

    let url = "<?=base_url();?>budget_item/insert_budget_item";

    // var countOfEmptyFields=0;

    // $('.form_control').each(function(index, item){

    // //   if($(item).val()==''){
    //     countOfEmptyFields++;
    //     $(item).css('border','1px solid red');
        
    // //   }


    // });

    // if(countOfEmptyFields>0){
    //     alert('<?=get_phrase('one_or_more_fields_missing');?>');
    //     return false;
    // }

    // alert(countOfEmptyFields);
    
    $.ajax({
        url:url,
        data:data,
        type:"POST",
        success:function(response){
            alert(response);
        }
    });
}

$(".btn-reset").on('click',function(){
    resetForm();
});

function resetForm(elem){
    $.each($('.resetable'),function(i,el){
        $($(el).val(null))
    });

    $.each($('.month_spread'),function(i,el){
        $($(el).val(0));
    });
}
</script>