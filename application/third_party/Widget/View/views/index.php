<?php 
    
    $this->CI->db->select(array('page_view_id','page_view_name'));
    $this->CI->db->join('menu','menu.menu_id=page_view.fk_menu_id');
    
    if(!$this->CI->session->system_admin){
        $this->CI->db->where(array('fk_role_id'=>$this->CI->session->role_id));
    }
    
    $views = $this->CI->db->get_where('page_view',array('menu_derivative_controller'=>$this->CI->controller));

    $default_option = 0;
    $active_controller = $this->CI->controller;
    $active_page_view = $active_controller.'_active_page_view';

    if($this->CI->session->$active_page_view){
        $default_option = $this->CI->session->$active_page_view;
        //echo $this->CI->session->test_view;
    }
   
?>
<form method="POST" action="<?=base_url().$this->CI->controller;?>/list">
    <label for="" class="label-control col-xs-3" style="text-align:right;font-weight:bold;">
    <?=get_phrase('views');?></label>
    <div class="col-xs-6">
        <select name="page_view" class="form-control">
            <option><?=get_phrase('select_view');?></option>
            <?php 
                if($views->num_rows()>0){
                    $list_of_views = $views->result_object();

                    foreach($list_of_views as $view){
                      ?>
                        <option value="<?=$view->page_view_id;?>" <?php if ($default_option == $view->page_view_id) echo "selected";?> ><?=$view->page_view_name;?></option>
                      <?php  
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-xs-3"> 
        <button href="#" name="btn_page_view" value="btn_page_view" class="btn btn-default"><?=get_phrase('go');?></button>
        <!-- <a href="#"><?=get_phrase('create_view');?></a>  &nbsp; 
        <a href="#"><?=get_phrase('edit_view');?></a> &nbsp; 
        <a href="#"><?=get_phrase('clone_view');?></a></div> -->
    </div>    
</form>