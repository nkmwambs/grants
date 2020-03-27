<table class="table table-striped" id="fund_balance_table">
        <thead>
            <tr>
                <th><?=get_phrase('fund');?></th>
                <th><?=get_phrase('opening_balance');?></th>
                <th><?=get_phrase('month_income');?></th>
                <th><?=get_phrase('month_expense');?></th>
                <th><?=get_phrase('closing_balance');?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($fund_balance_report as $fund_account_info){?>
                <tr>
                    <td><?=$fund_account_info['account_name'];?></td>
                    <td class="currency fund_month_opening_balance"><?=number_format($fund_account_info['month_opening_balance'],2);?></td>
                    <td class="currency fund_month_income"><?=number_format($fund_account_info['month_income'],2);?></td>
                    <td class="currency fund_month_expense"><?=number_format($fund_account_info['month_expense'],2);?></td>
                    <td class="currency fund_month_closing_balance">0.00</td>
                </tr>
            <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td id="total_fund_month_opening_balance">0.00</td>
                <td id="total_fund_month_income">0.00</td>
                <td id="total_fund_month_expense">0.00</td>
                <td id="total_fund_month_closing_balance">0.00</td>
            </tr>
        </tfoot>
        </table>