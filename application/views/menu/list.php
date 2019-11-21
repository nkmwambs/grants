<div class="row">
    <div class="col-sm-12">
        <span>More menu items</span>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">

        <ul style='list-style:none'>
        <?php
        $lib = "";
        $menu_icon = "fa fa-bars";
        foreach ($this->session->user_more_menu as $user_menu => $user_menu_item) {
            // $lib = $user_menu.'_library'; 
          
            // $this->load->library($lib);

            // if(property_exists($this->$lib,'menu_icon')){
            //     $menu_icon = $this->$lib->menu_icon;
            // }

            if($this->user_model->check_role_has_permissions($user_menu,'read')){
        ?>
                <li>
                <a href="<?=base_url().strtolower($user_menu);?>/list">
                    <i class="<?=$menu_icon;?>"></i>
                    <span class="title"><?=get_phrase($user_menu);?></span>
                </a>
                </li>
        <?php        
            }
        }
        ?>
        </ul>

    </div>
</div>