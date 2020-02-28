<?php
    print_r($result);

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
    <div class='col-xs-2'>
        <a class='pull-left' href="#" title='Previous Year'><i class='fa fa-minus-circle' style='font-size:20pt;'></i></a>
    </div>
    
    <div class='col-xs-8' style='text-align:center;'>
        <a href="<?=base_url();?>budget_item/multi_form_add/<?=$this->id;?>/budget">
            <div class='btn btn-default'>Add new budget item</div>
        </a>

    </div>

    <div class='col-xs-2'>
        <a class='pull-right' href="#" title='Next Year'><i class='fa fa-plus-circle' style='font-size:20pt;'></i></a>
    </div>

</div>

<div class='row'>
    <div class='col-xs-12'>
        <div class='form-group'>
            <div class='col-xs-3'>
                <label class='control-label pull-right'>Choose a funder project</label>
            </div>
            <div class='col-xs-7'>
                <?=funder_projects_select($funder_projects);?>
            </div>
            <div class='col-xs-2'>
                <div class='btn btn-success'>View</div>
            </div>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-xs-12' style='text-align:center;font-weight:bold;'>
        <?=$budget_schedule['income_account']['income_account_name'];?> Budget Schedule for <?=$office;?> <?=$current_year;?> (<a href='<?=base_url();?>budget/view/<?=$this->id;?>/summary/<?=hash_id(1);?>'>Show budget summary</a>)
    </div>
</div>

<div class='row'>
    <div class='col-xs-12'>
        <?php foreach($budget_schedule['budget_items'] as $budget_items){?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan='19' style='text-align:center'>
                            Expense account: <?=$budget_items['expense_account']['expense_account_code'];?> - <?=$budget_items['expense_account']['expense_account_name'];?>
                        </th>
                    </tr>
                    <tr>
                        <th>Action</th>
                        <th>Track Number</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
                        <th>Total Cost</th>

                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                        
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
           </table>    
        <?php }?>
        <!-- <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan='19' style='text-align:center'>
                       Expense account: E001 - Expense Account 1
                    </th>
                </tr>
                <tr>
                    <th>Action</th>
                    <th>Track Number</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Total Cost</th>

                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                    
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <i class='fa fa-check' title='Approve'></i> 
                        <i class='fa fa-times' title='Decline'></i> 
                        <i class='fa fa-pencil' title='Edit'></i>
                        <i class='fa fa-trash' title='Delete'></i>  
                    </td>
                    <td><a href="#">BUEM-78374</a></td>
                    <td>Training Cost</td>
                    <td>3</td>
                    <td>30,000.00</td>
                    <td>90,000.00</td>
                    
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>

                    <td>New</td>
                </tr> 

                <tr>
                    <td>
                        <i class='fa fa-check' title='Approve'></i> 
                        <i class='fa fa-times' title='Decline'></i> 
                        <i class='fa fa-pencil' title='Edit'></i>
                        <i class='fa fa-trash' title='Delete'></i>  
                    </td>
                    <td><a href="#">BUEM-57654</a></td>
                    <td>Training Cost</td>
                    <td>3</td>
                    <td>30,000.00</td>
                    <td>90,000.00</td>
                    
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>

                    <td>Submitted</td>
                </tr>            
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='5'>Expense Account 1 Total</td>
                    <td>0.00</td>

                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>

                    <td></td>
                </tr>
            </tfoot>
        </table>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan='19' style='text-align:center'>
                       Expense account: E002 - Expense Account 2
                    </th>
                </tr>
                <tr>
                    <th>Action</th>
                    <th>Track Number</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Total Cost</th>

                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>

                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <i class='fa fa-check' title='Approve'></i> 
                        <i class='fa fa-times' title='Decline'></i> 
                        <i class='fa fa-pencil' title='Edit'></i>
                        <i class='fa fa-trash' title='Delete'></i>  
                    </td>
                    <td><a href="#">BUEM-46544</a></td>
                    <td>Training Cost</td>
                    <td>3</td>
                    <td>30,000.00</td>
                    <td>90,000.00</td>
                    
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>

                    <td>Declined</td>    
                </tr> 

                <tr>
                    <td>
                        <i class='fa fa-check' title='Approve'></i> 
                        <i class='fa fa-times' title='Decline'></i> 
                        <i class='fa fa-pencil' title='Edit'></i>
                        <i class='fa fa-trash' title='Delete'></i>  
                    </td>
                    <td><a href="#">BUEM-65654</a></td>
                    <td>Training Cost</td>
                    <td>3</td>
                    <td>30,000.00</td>
                    <td>90,000.00</td>
                    
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>30,000.00</td>

                    <td>Returned For Rework</td>
                </tr>            
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='5'>Expense Account 2 Total</td>
                    <td>0.00</td>

                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>

                    <td></td>
                </tr>
            </tfoot>
        </table> -->
    </div>
</div>