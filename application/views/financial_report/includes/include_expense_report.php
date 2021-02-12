<style>
.is_clicked{
    color: red;
}
</style>
<div id="expense_reports">

    <?php 
    //print_r($this->budget_tag_model->get_budget_tag_id_based_on_reporting_month(25,'2021-01-01'));
    //print_r($reporting_month);
    //print_r($expense_report[3]['expense_accounts']);

    $check_sum = array_column($expense_report,'check_sum');

    $cnt = 0;
    foreach($expense_report as $income_record){
        $cnt++;
        if($check_sum[$cnt - 1] == 0 && $this->config->item('skip_empty_expense_reports')) continue;  // Skips expense tables that lack records

    ?>
    <div class="row">
        <div class="col-xs-12 cols">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan='<?=!$multiple_offices_report?8:7;?>' style='text-align:center;'><?=$income_record['income_account']['income_account_name'];?></th>
                    </tr>
                    <tr>
                        <th><?=get_phrase('expense_account');?></th>
                        <th><?=get_phrase('month_expense');?></th>
                        <th><?=get_phrase('year_to_date_expense');?> [A]</th>
                        <th><?=get_phrase('budget_to_date');?> [B]</th>
                        <th><?=get_phrase('budget_variance');?> [C = (B - A)]</th>
                        <th><?=get_phrase('percent_variance');?> [(C/B) %]</th>
                        <?php if(!$multiple_offices_report){?>
                        <th><?=get_phrase('variance_comment');?></th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $month_expense = 0;
                    $month_expense_to_date = 0;
                    $budget_to_date = 0;
                     
                    
                    foreach($income_record['expense_accounts'] as $expense_account){

                        if(
                            $expense_account['month_expense'] == 0
                            && $expense_account['month_expense_to_date'] == 0
                                && $expense_account['budget_to_date'] == 0
                                && !$this->config->item('show_empty_rows_in_expense_report')
                        ) continue;
                ?>
                    <tr>
                        <td><?=$expense_account['expense_account']['expense_account_code'].' - '.$expense_account['expense_account']['expense_account_name'];?></td>
                        <td><?=number_format($expense_account['month_expense'],2);?></td>
                        <td><?=number_format($expense_account['month_expense_to_date'],2);?></td>
                        <td><?=number_format($expense_account['budget_to_date'],2);?></td>
                        <?php 
                            $budget_variance = $expense_account['budget_to_date'] - $expense_account['month_expense_to_date'];
                            $percent_budget_variance = $expense_account['budget_to_date'] > 0 ? ($budget_variance/$expense_account['budget_to_date']) : -1;
                        ?>
                        <td><?=number_format($budget_variance ,2);?></td>
                        <td><?=round($percent_budget_variance,2) * 100;?></td>
                        <?php if(!$multiple_offices_report){?>
                        <td><i id="variance_comment_<?=$expense_account['expense_account']['expense_account_code'];?>" data-account_id = "<?=$expense_account['expense_account']['expense_account_id'];?>" class="fa fa-comment variance_comment" style="cursor: pointer;"></i> <?=$expense_account['expense_account_comment'] !== ''?'<i class="fa fa-eye"></i>':'';?></td>
                        <?php }?>
                    </tr>
                <?php 
                        $month_expense += $expense_account['month_expense'];
                        $month_expense_to_date += $expense_account['month_expense_to_date'];
                        $budget_to_date += $expense_account['budget_to_date'];
                    }
                ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td><?=get_phrase('total');?></td>
                        <td><?=number_format($month_expense,2);?></td>
                        <td><?=number_format($month_expense_to_date,2);?></td>
                        <td><?=number_format($budget_to_date,2);?></td>
                        <?php 
                            $budget_variance = $budget_to_date - $month_expense_to_date;
                            $budget_variance_percent = $budget_to_date != 0?round($budget_variance / $budget_to_date,2) * 100:0;
                        ?>
                        <td><?=number_format($budget_variance,2);?></td>
                        <td><?php echo $budget_variance_percent?$budget_variance_percent:'';?></td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php }?>

</div>

<input type="hidden" id="variance_comment_id" value="0"/>

<div id="note_area_holder" class="col-xs-4 hidden">
    <textarea class="form-control" class="note_area" <?=!$this->user_model->check_role_has_permissions(ucfirst($this->controller),'create')?'disabled':'';?>
    placeholder="Put your notes here" rows="10"></textarea>
</div>

<script>

$(document).on('change','.active_note_area > textarea',function(){
    var expense_account_id = $(".is_clicked").first().data('account_id');
    var comment = $(this).val();
    var url = "<?=base_url();?>Financial_report/post_expense_account_comment";
    var office_id = $("#office_ids").val();
    var reporting_month = '<?=$reporting_month;?>';
    var data = {'expense_account_id':expense_account_id,'office_id':office_id,'reporting_month':reporting_month,'variance_comment_text':comment};

    $.post(url,data,function(response){
        alert(response);
    });

});


$(document).on('click',".variance_comment",function(){

    var cols = $(this).closest('.cols');
    var cols_is_full_spaned = cols.hasClass("col-xs-12");
    var row = cols.closest('.row');
    var sibling_rows = row.siblings();
    var id = $(this).attr('id');
    var variance_comment = $(this);

            if($(".is_clicked").length > 0){
                $(".is_clicked").each(function(i,el){
                    $(el).removeClass('is_clicked');
                });
            }

            $(".active_note_area").each(function(i,el){
                $(el).remove();
            });

            sibling_rows.each(function(i,el){
                var sibling_cols = $(el).find('.cols');
        
                var sibling_cols_is_semi_spaned = sibling_cols.hasClass("col-xs-8");

                if(sibling_cols_is_semi_spaned){
                    sibling_cols.removeClass("col-xs-8").addClass("col-xs-12");
                }
            });

            if(cols_is_full_spaned && !variance_comment.hasClass('is_clicked')){

                cols.removeClass("col-xs-12").addClass("col-xs-8");
                $(this).addClass("is_clicked");
                $("#variance_comment_id").val(id);
                update_notes_area(row);
        
            }else if(!cols_is_full_spaned && !variance_comment.hasClass('is_clicked') && id != $("#variance_comment_id").val() ){    
                
                $(this).addClass("is_clicked");
                $("#variance_comment_id").val(id);
                update_notes_area(row);

            }else{

                cols.removeClass("col-xs-8").addClass("col-xs-12");
                $(this).removeClass("is_clicked");
            
            }    

});

function update_notes_area(row){
    
    var expense_account_id = $(".is_clicked").first().data('account_id');
    var office_id = $("#office_ids").val();
    var reporting_month = '<?=$reporting_month;?>';
    var data = {'expense_account_id':expense_account_id,'office_id':office_id,'reporting_month':reporting_month};

    var url = "<?=base_url();?>Financial_report/get_expense_account_comment";

    $.post(url,data,function(comment){
        var pane_count = row.children().length;
        var note_area_holder = $("#note_area_holder");

        if(pane_count == 1){
            var new_note_area_holder = note_area_holder.clone();
            new_note_area_holder.removeAttr('id');
            new_note_area_holder.removeClass('hidden').addClass('active_note_area');
            new_note_area_holder.css('margin-top','100px');
            new_note_area_holder.find('textarea').html(comment);
            row.append(new_note_area_holder);
        }
    });
    
    
}
</script>