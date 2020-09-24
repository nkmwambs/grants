<style>
.center{
    text-align:center;
}
</style>

<?php 
//print_r($result['budget_item_details']);

extract($result);

$budget_item = $budget_item_details[0];

//print_r($budget_item);
$total = array_sum(array_column($budget_item_details,'budget_item_detail_amount'));

?>

<div class="row">
    <div class='col-xs-12'>
        <div class="panel panel-default" data-collapsed="0">
       	    <div class="panel-heading">
           	    <div class="panel-title" >
           		    <i class="entypo-pencil"></i>
					    <?php echo get_phrase('edit_budget_item_for_');?> <?=$office->office_code.' - '.$office->office_name.' : '.get_phrase('FY').$office->budget_year;?>
           	    </div>
            </div>
	    
            <div class="panel-body"  style="max-width:50; overflow: auto;">	
                <?php echo form_open("" , array('id'=>'frm_budget_item','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
                    <div class='form-group'>
                        <div class='col-xs-12 center'>
                            <div class='btn btn-icon pull-left' id='btn_back'><i class='fa fa-arrow-left'></i></div>

                            <div class='btn btn-default btn-save'><?=get_phrase('save');?></div>
                            <div class='btn btn-default btn-save-new'><?=get_phrase('save_and_continue');?></div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class="col-xs-12">
                            <textarea name='budget_item_description' id='budget_item_description' placeholder="<?=get_phrase('describe_budget_item');?>"  class='form-control resetable'><?=$budget_item['budget_item_description'];?></textarea> 
                        </div>         
                    </div>

                    <div class="form-group">
                        <label class='control-label col-xs-2'><?=get_phrase('expense_account');?></label>
                        <div class='col-xs-2'>
                            <select name='fk_expense_account_id' id='fk_expense_account_id'  class='form-control resetable'>
                                <option value='<?=$budget_item['fk_expense_account_id'];?>'><?=$budget_item['expense_account_name'];?></option>                                
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
                                        <td><input type='text' id='' value='<?=$budget_item_details[$month->month_id - 1]['budget_item_detail_amount'];?>' name='fk_month_id[<?=$month->month_id;?>][]' value='0' class='form-control month_spread' /></td>
                                    <?php }?>
                                
                                </tr>
                            </tbody>      
                        </table>
                    </div>

                    <div class='form-group'>
                        <!-- <label class='control-label col-xs-2'><?=get_phrase('total_cost');?></label> -->
                        <div class='col-xs-2'>
                            <input type='number' readonly='readonly' name='budget_item_total_cost' id='budget_item_total_cost'  class='form-control resetable' value='<?=$total;?>' />
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12 center'>
                            <div class='btn btn-default btn-save'><?=get_phrase('save');?></div>
                            <div class='btn btn-default btn-save-new'><?=get_phrase('save_and_continue');?></div>
                        </div>
                    </div>                
                    <!--Hidden fields-->
                    <input type='hidden' value='<?=hash_id($this->id,'decode');?>' name='fk_budget_id' id='fk_budget_id' />
                </form>
            </div>    
                  
    </div>
</div>

<script>

$(".form-control").on('change',function(){
   if($(this).val() !== ''){
     $(this).removeAttr('style');
   }
});

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
    var count_of_empty_fields = 0;

    $('.form-control').each(function(i,el){
        if($(el).val() == ''){
            count_of_empty_fields++;
            $(el).css('border','1px solid red');
        }
    });

    if(count_of_empty_fields > 0){
        alert('<?=get_phrase("one_or_more_fields_are_empty");?>');
        return false;
    }

    save(false);
    resetForm();
});

$(".btn-save").on('click',function(){

    var count_of_empty_fields = 0;

    $('.form-control').each(function(i,el){
        if($(el).val() == ''){
            count_of_empty_fields++;
            $(el).css('border','1px solid red');
        }
    });

    if(count_of_empty_fields > 0){
        alert('<?=get_phrase("one_or_more_fields_are_empty");?>');
        return false;
    }

    save();
});

function save(go_back = true){
    let frm = $("#frm_budget_item");

    let data = frm.serializeArray();

    let url = "<?=base_url();?>budget_item/insert_budget_item";

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        success:function(response){
            alert(response);
            if(go_back) {
                location.href = document.referrer;
            }
        }
    });
}

$("#btn_back").on('click',function(){
    location.href = document.referrer;
});

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