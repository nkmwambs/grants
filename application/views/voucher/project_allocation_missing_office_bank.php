<?php if(!empty($project_allocations)){ ?>


<table class='table table-striped'>
    <thead>
        <tr>
            <th colspan="4" style="text-align: center;"><?=get_phrase('unlinked_project_allocations_to_office_bank');?></th>
        </tr>
        <tr>
            <th><?=get_phrase('project_name');?></th>
            <th><?=get_phrase('project_allocation_name');?></th>
            <th><?=get_phrase('office_name');?></th>
            <th><?=get_phrase('link_to_office_bank');?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($project_allocations as $project_allocation){?>
            <tr>
                <td><?=$project_allocation['project_name'];?></td>
                <td><?=$project_allocation['project_allocation_name'];?></td>
                <td><?=$project_allocation['office_name'];?></td>
                <td><?=office_bank_select($project_allocation['office_id'],$project_allocation['project_allocation_id'])?></td>
            </tr>
        <?php }?>
    </tbody>
</table>

<?php } ?>