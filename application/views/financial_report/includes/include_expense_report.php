<?php foreach($expense_report as $income_record){?>
<table class="table table-striped">
        <thead>
            <tr>
                <th colspan='7' style='text-align:center;'><?=$income_record['income_account']['income_account_name'];?></th>
            </tr>
            <tr>
                <th><?=get_phrase('expense_account');?></th>
                <th><?=get_phrase('month_expense');?></th>
                <th><?=get_phrase('year_to_date_expense');?></th>
                <th><?=get_phrase('budget_to_date');?></th>
                <th><?=get_phrase('budget_variance');?></th>
                <th><?=get_phrase('percent_variance');?></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $month_expense = 0;
            $month_expense_to_date = 0;
            $budget_to_date = 0;

            foreach($income_record['expense_accounts'] as $expense_account){
        ?>
            <tr>
                <td><?=$expense_account['expense_account']['expense_account_code'].' - '.$expense_account['expense_account']['expense_account_name'];?></td>
                <td><?=number_format($expense_account['month_expense'],2);?></td>
                <td><?=number_format($expense_account['month_expense_to_date'],2);?></td>
                <td><?=number_format($expense_account['budget_to_date'],2);?></td>
                <td><?=number_format($expense_account['budget_variance'],2);?></td>
                <td><?=round($expense_account['budget_variance_percent'],2) * 100;?></td>
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
                <td><?=$budget_variance_percent;?></td>
                <td>&nbsp;</td>
            </tr>
        </tfoot>
    </table>

<?php }?>