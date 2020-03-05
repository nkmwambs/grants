<?php
    //print_r($result['budget_schedule'][1]['budget_items'][1]['expense_items']['month_spread']);
    //print_r($result['budget_schedule']);
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
        <a href="<?=base_url();?>budget_item/multi_form_add/<?=$this->id;?>/budget">
            <div class='btn btn-default'>Add new budget item</div>
        </a>

    </div>

    <!-- <div class='col-xs-2'>
        <a class='pull-right' href="#" title='Next Year'><i class='fa fa-plus-circle' style='font-size:20pt;'></i></a>
    </div> -->

</div>

<div class='row'>
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
</div>

<?php foreach($budget_schedule as $income_group){?>
<div class='row'>
    <div class='col-xs-12' style='text-align:center;font-weight:bold;'>
        <?=$income_group['income_account']['income_account_name'];?> Budget Schedule for <?=$office;?> <?=$current_year;?> (<a href='<?=base_url();?>budget/view/<?=$this->id;?>/summary/<?=hash_id(1);?>'>Show budget summary</a>)
    </div>
</div>

<div class='row'>
    <div class='col-xs-12'>
        <?php foreach($income_group['budget_items'] as $loop_budget_items){?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan='19' style='text-align:center'>
                            Expense account: <?=$loop_budget_items['expense_account']['expense_account_code'];?> - <?=$loop_budget_items['expense_account']['expense_account_name'];?>
                        </th>
                    </tr>
                    <tr>
                        <th>Track Number</th>
                        <th>Description</th>
                        <th>Total Cost</th>                        
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($loop_budget_items['expense_items'] as $loop_expense_items){?>
                    <tr>
                        <td><?="<a href='".base_url()."budget_item/view/".hash_id($loop_expense_items['budget_item_id'],'encode')."' >".$loop_expense_items['budget_item_track_number']."</a>";?></td>
                        <td><?=$loop_expense_items['description']?></td>
                        <td><?=number_format($loop_expense_items['total_cost'],2)?></td>
                        <td><?=$loop_expense_items['status']['status_name'];?></td>
                    </tr>
                <?php }?>
                </tbody>
           </table>    
        <?php }?>
       
    </div>
</div>

<?php }?>