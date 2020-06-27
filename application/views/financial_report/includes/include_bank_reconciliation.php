<table class="table table-striped">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td><?=get_phrase('bank_statement_date');?></td>
                    <td>
                        <?php if($multiple_offices_report){?>
                            <?=$bank_reconciliation['bank_statement_date'];?>
                        <?php }else{?>
                            <input type="text" class="form-control datepicker" 
                            id="bank_statement_date" data-format='yyyy-mm-dd' readonly='readonly' value="<?=$bank_reconciliation['bank_statement_date'];?>"/>
                        <?php }?>
                        
                    </td>
                </tr>
                <tr>
                    <td><?=get_phrase('bank_statement_closing_balance');?></td>
                    <td>
                        <?php if($multiple_offices_report){?>
                            <?=$bank_reconciliation['bank_statement_balance'];?>
                        <?php }else{?>
                            <input type="text" class="form-control" id="bank_statement_balance" data-format='yyyy-mm-dd' value="<?=$bank_reconciliation['bank_statement_balance'];?>"/>
                        <?php }?>
                    </td>
                </tr>
                <tr>
                    <td><?=get_phrase('book_closing_balance');?></td>
                    <td><?=number_format($bank_reconciliation['book_closing_balance'],2);?></td>
                </tr>
                <tr>
                    <td><?=get_phrase('oustanding_cheques');?></td>
                    <td><?=number_format($bank_reconciliation['month_outstanding_cheques'],2);?></td>
                </tr>
                <tr>
                    <td><?=get_phrase('deposit_in_transit');?></td>
                    <td><?=number_format($bank_reconciliation['month_transit_deposit'],2);?></td>
                </tr>
                <tr>
                    <td><?=get_phrase('reconciled_bank_balance');?></td>
                    <td>
                        <span id='reconciled_bank_balance'><?=number_format($bank_reconciliation['bank_reconciled_balance'],2);?></span>
                        <span id='reconciliation_flag' class="label label-<?=$bank_reconciliation['is_book_reconciled']?'success':'danger';?>"><?=get_phrase($bank_reconciliation['is_book_reconciled']?'balanced':'not_balanced');?></span>
                    </td>
                </tr>
            </tbody>
        </table>
      