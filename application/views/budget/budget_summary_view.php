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
        <!-- <a href="<?=base_url();?>budget_item/multi_form_add/<?=$this->id;?>/budget">
            <div class='btn btn-default'>Add new budget item</div>
        </a> -->

    </div>

    <div class='col-xs-2'>
        <a class='pull-right' href="#" title='Next Year'><i class='fa fa-plus-circle' style='font-size:20pt;'></i></a>
    </div>

</div>

<div class='row'>
    <div class='col-xs-12'>
        <div class='form-group'>
            <div class='col-xs-3'>
                <label class='control-label pull-right'>Choose a funder</label>
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
    <div class='col-xs-12'>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan='14' style='text-align:center'>
                        Income Account 1 Budget Summary (<a href='<?=base_url();?>budget/view/<?=$this->id;?>/schedule/<?=hash_id(1);?>'>Show budget schedule</a>)
                    </th>
                </tr>
                <tr>
                    <th>Account</th>
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>E001 - Expense 1</td>
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

                </tr>            
            </tbody>
            <tfoot>
                <tr>
                    <td>Income Account 1 Total</td>
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
                </tr>
            </tfoot>
        </table>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan='14' style='text-align:center'>
                        Income Account 2 Budget Summary (<a href='<?=base_url();?>budget/view/<?=$this->id;?>/schedule/<?=hash_id(2);?>'>Show budget schedule</a>)
                    </th>
                </tr>
                <tr>
                    <th>Account</th>
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>E001 - Expense 2</td>
                    <td>60,000.00</td>
                    
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>20,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>20,000.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>20,000.00</td>

                </tr>            
            </tbody>
            <tfoot>
                <tr>
                    <td>Income Account 1 Total</td>
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
                </tr>
            </tfoot>
        </table>
    </div>
</div>