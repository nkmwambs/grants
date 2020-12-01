<?php
    //print_r($this->general_model->is_min_approval_status_id('budget',176));
    //print_r($result);
    //print_r($this->grants_model->initial_item_status('budget'));
    //echo $this->session->user_account_system_id;
   

    // $lookup_values = $this->budget_model->lookup_values();
    // print_r($lookup_values);


    extract($result);
?>

<style>
    .row{
        margin:20px;
    }
</style>

<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('comment');?>
  </div>
</div>

<div class='row'>
    <!-- <div class='col-xs-2'>
        <a class='pull-left' href="#" title='Previous Year'><i class='fa fa-minus-circle' style='font-size:20pt;'></i></a>
    </div> -->
    
    <div class='col-xs-offset-2 col-xs-8 col-xs-offset-2' style='text-align:center;'>
        <a href="<?=base_url();?>Budget_item/multi_form_add/<?=$this->id;?>/Budget">
            <div class='btn btn-default'><?=get_phrase('add_new_budget_item');?></div>
        </a>

    </div>

    <!-- <div class='col-xs-2'>
        <a class='pull-right' href="#" title='Next Year'><i class='fa fa-plus-circle' style='font-size:20pt;'></i></a>
    </div> -->

</div>

<!-- <div class='row'>
    <div class='col-xs-12'>
        <div class='form-group'>
            <div class='col-xs-offset-4 col-xs-4'>
                <?=funder_projects_select($funder_projects);?>      
            </div>
            <div class='col-xs-2'>
                <div class='btn btn-success'>View</div>
            </div>
        </div>
    </div>
</div> -->

<div class='row'>
    <div class='col-xs-12'>
        
        <?php 
            //print_r($summary[2]);
            foreach($summary as $income_ac){
            $expense_spread = $income_ac['spread_expense_account'];
            
            //print_r($expense_spread);

            extract($income_ac);
            $months = array_keys(array_shift($spread_expense_account)['spread']);
        ?>
            
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan='14' style='text-align:center'>
                       <?=get_phrase('year');?> <?=$current_year;?> <?=$budget_tag;?> : <?=$office?> <?=$income_account['income_account_name'].' ('.$income_account['income_account_code'].')';?> <?=get_phrase('budget_summary');?> (<a href='<?=base_url();?>Budget/view/<?=$this->id;?>/schedule/<?=hash_id($income_account['income_account_id'],'encode');?>'><?=get_phrase('show_budget_schedule');?></a>) &nbsp; <div class='btn btn-success'><?=get_phrase('submit_budget');?></div>
                    </th>
                </tr>
                <tr>
                    <th><?=get_phrase('account');?></th>
                    <th><?=get_phrase('total_cost');?></th>

                    <?php foreach($months as $month){?>
                        <th><?=$month;?></th>
                    <?php }?>
                </tr>
            </thead>

            <tbody>
                 <?php 
                    //print_r($spread_account);
                    foreach($expense_spread as $expense_spreading){
                        extract($expense_spreading);
                ?>
                    <tr>
                        <td><?=$expense_account['account_code'].' - '.$expense_account['account_name'];?></td>
                        <td><?=number_format(array_sum($spread),2);?></td>

                        <?php foreach($spread as $month_amount){ ?>
                            <td><?=number_format($month_amount,2);?></td>
                        <?php }?>
                    </tr>
                 <?php }?>       
            </tbody>
            <tfoot>
                <tr>
                    <td><?=$income_account['income_account_name'];?> <?=get_phrase('total');?></td>
                    
                    <?php 
                        $total = 0;

                        foreach (array_column($expense_spread,'spread') as $row_spread) {
                            $total += array_sum($row_spread);
                        }
                    ?>

                    <td><?=number_format($total,2);?></td>

                    <?php 
                    
                    foreach(array_shift($expense_spread)['spread'] as $month_label=>$month_spread){?>
                        <td>
                            <?php 
                                $_spread_col = array_column($expense_spread,'spread');
                                echo number_format(array_sum(array_column($_spread_col,$month_label)),2);
                            ?>
                        </td>
                    <?php }?>

                </tr>
            </tfoot>
        </table>

        <?php }?>
       
    </div>
</div>