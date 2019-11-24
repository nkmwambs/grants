<?php 
    
    // This code should move to either access api or user model
    
    if(!$this->CI->session->system_admin){
        $this->CI->db->where(array('fk_role_id'=>$this->CI->session->role_id));
        $this->CI->db->select(array('page_view_id','page_view_name','page_view_role_is_default as page_view_is_default'));
        $this->CI->db->join('page_view_role','page_view_role.fk_page_view_id=page_view.page_view_id');
    }else{
        $this->CI->db->select(array('page_view_id','page_view_name','page_view_is_default as page_view_is_default'));
    }
    
    $this->CI->db->join('menu','menu.menu_id=page_view.fk_menu_id');
    
    $views = $this->CI->db->get_where('page_view',array('menu_derivative_controller'=>$this->CI->controller));

    // Get the default page view for the role - Probably needs to be a session on login
    //$default_page_view = $this->CI->db->get_where('page_view_role',
    //array('fk_role_id'=>$this->CI->session->role_id,'page_view_role_is_default'=>1));

    // End of what needs to be moved

    $default_option = 0;
    $active_controller = $this->CI->controller;
    $active_page_view = $active_controller.'_active_page_view';

    if($this->CI->session->$active_page_view){
        $default_option = $this->CI->session->$active_page_view;
        //echo $this->CI->session->test_view;
    }
   
?>
    
    <div class="col-xs-offset-3 col-xs-6">
        <select name="page_view" class="form-control select2">
            <option value="0"><?=get_phrase('select_filter');?></option>
            <?php 
                if($views->num_rows()>0){
                    $list_of_views = $views->result_object();

                    foreach($list_of_views as $view){
                      ?>
                        <option value="<?=$view->page_view_id;?>" 
                        
                        <?php 
                            if (    
                                    $default_option == $view->page_view_id || 
                                    $view->page_view_is_default == 1
                                         
                                ) 
                                {
                                    echo "selected";
                                }
                                    
                        ?> 
                        
                        >
                        <?=$view->page_view_name;?>
                        </option>
                      <?php  
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-xs-3"> 
        <button href="#" id="btn-filter" name="btn_page_view" value="btn_page_view" class="btn btn-default"><?=get_phrase('filter');?></button>
    </div>    
