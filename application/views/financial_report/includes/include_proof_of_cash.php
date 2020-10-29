<?php
//print_r($proof_of_cash);
?>
<table class="table table-striped">
        <thead>
        </thead>
        <tbody>
            <tr>
                <td><?=get_phrase('cash_at_bank');?></td>
                <td><?=number_format($proof_of_cash['cash_at_bank'],2);?></td>
            </tr>
            <tr>
                <td><?=get_phrase('cash_at_hand');?></td>
                <td><?=number_format($proof_of_cash['cash_at_hand'],2);?></td>
            </tr>
            <tr>
                <td><?=get_phrase('total_cash');?></td>
                <td id='total_cash' class='code_proof_of_cash'><?=number_format($proof_of_cash['cash_at_hand'] + $proof_of_cash['cash_at_bank'],2);?></td>
            </tr>

            <tr>
                <td colspan='2' id='proof_of_cash_check' style='text-align:center;'></td>
            </tr>
        </tbody>
    </table>

   