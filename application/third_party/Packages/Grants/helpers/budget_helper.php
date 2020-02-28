<?php 

if ( ! function_exists('funder_projects_select')){
    function funder_projects_select($funder_projects){
            $select = "<select id='funder_projects_select' class='form-control'>
                    <option>Select Funder Projects ...</option>";
                    foreach($funder_projects as $funder_project){
                        $select .="<optgroup label='".$funder_project['funder']['funder_name']."'>";
                            foreach($funder_project['projects'] as $project){
                                $select .= "<option value='".$project['project_allocation_id']."'>";
                                    $select.= $project['project_allocation_name'];
                                $select .= "</option>";
                        }
                    $select .= "</optgroup>";
                 }

            $select .= "</select>";

        return $select;            
    }
}