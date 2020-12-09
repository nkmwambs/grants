<?php
    //print_r($result['budget_schedule'][1]['budget_items'][1]['expense_items']['month_spread']);
    //print_r(array_shift($result['budget_schedule']));


    //print_r($month_names_with_number_keys);

    //print_r(array_keys($result));

    extract($result);
    //print_r($budget_schedule['spreading_of_month']);
    //print_r($month_names_with_number_keys);
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

<?php foreach($budget_schedule as $income_group){?>
<div class='row'>
    <div class='col-xs-12' style='text-align:center;font-weight:bold;'>
        <?=ucwords($income_group['income_account']['income_account_name']);?> <?=get_phrase('budget_schedule_for');?> <?=$office;?> <?=get_phrase('FY');?><?=$current_year;?> <?=$budget_tag;?> (<a href='<?=base_url();?>Budget/view/<?=$this->id;?>/summary/<?=hash_id(1);?>'><?=get_phrase('show_budget_summary');?></a>)
    </div>
</div>

<div class='row'>
    <div class='col-xs-12'>
        <?php foreach($income_group['budget_items'] as $loop_budget_items){?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan='16' style='text-align:center'>
                            <?=get_phrase('expense_account');?>: <?=$loop_budget_items['expense_account']['expense_account_code'];?> - <?=$loop_budget_items['expense_account']['expense_account_name'];?>
                        </th>
                    </tr>
                    <tr>
                        <th><?=get_phrase('action');?></th>
                        <th><?=get_phrase('description');?></th>
                        <th><?=get_phrase('total_cost');?></th>                        
                        <th><?=get_phrase('status');?></th>
                        <?php foreach($month_names_with_number_keys as $month_name){?>
                            <th><?=$month_name;?></th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($loop_budget_items['expense_items'] as $budget_item_id=>$loop_expense_items){?>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                                    <?=get_phrase('action');?>
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <?php if($this->user_model->check_role_has_permissions('Budget_item','update') && $is_current_review){ ?>
                                    <li><?=list_table_edit_action('budget_item',$budget_item_id);?></li>
                                    <li class="divider"></li>
                                    <?php }?>
                                    <?php if($this->user_model->check_role_has_permissions('Budget_item','delete') && $is_current_review){ ?>
                                    <li><?=list_table_delete_action('budget_item',$budget_item_id);?></li>
                                    <?php }?>

                                    <?php if(
                                        (!$this->user_model->check_role_has_permissions('Budget_item','update') && 
                                        !$this->user_model->check_role_has_permissions('Budget_item','delete')
                                        ) ||  !$is_current_review

                                    ){ 
                                        echo "<li><a href='#'>".get_phrase('no_action')."</a></li>";
                                    }?>

                                </ul>
                                </div>
                        </td>
                        <td><?=$loop_expense_items['description']?></td>
                        <td><?=number_format($loop_expense_items['total_cost'],2)?></td>
                        <td><div class='btn btn-success'><?=$loop_expense_items['status']['status_name'];?></div></td>
                        <?php foreach($month_names_with_number_keys as $month_number=>$month_name){?>
                            <th><?=$loop_expense_items['month_spread'][$month_number]['amount'];?></th>
                        <?php }?>
                    </tr>
                <?php }?>
                </tbody>
           </table>    
        <?php }?>
       
    </div>
</div>

<?php }?>  