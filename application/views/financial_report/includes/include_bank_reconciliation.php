<table class="table table-striped">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td><?=get_phrase('bank_statement_date');?></td>
                    <td>30th November 2019</td>
                </tr>
                <tr>
                    <td><?=get_phrase('bank_statement_closing_balance');?></td>
                    <td>
                        <?php if($multiple_offices_report){?>
                            2,702,668.87
                        <?php }else{?>
                            <input type="text" class="form-control" value="2,702,668.87"/>
                        <?php }?>
                    </td>
                </tr>
                <tr>
                    <td><?=get_phrase('book_closing_balance');?></td>
                    <td>2,545,768.87</td>
                </tr>
                <tr>
                    <td><?=get_phrase('oustanding_cheques');?></td>
                    <td>165,400.00</td>
                </tr>
                <tr>
                    <td><?=get_phrase('deposit_in_transit');?></td>
                    <td>8,500.00</td>
                </tr>
                <tr>
                    <td><?=get_phrase('reconciled_balance_balance');?></td>
                    <td>2,702,668.87 <span class="label label-success"><?=get_phrase('balanced');?></span></td>
                </tr>
            </tbody>
        </table>