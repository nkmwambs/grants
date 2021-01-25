<div class="row">
	<!-- Raw Links -->
	<div class="col-md-12 col-sm-12 clearfix ">

        <ul class="list-inline links-list pull-left">
        <!-- Language Selector -->
           <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" style='text-decoration:none;'>
                        <img src='<?=base_url();?>uploads/user_icons/2.png' class='img-circle' style='border:2px gray solid;' width='40px'/> 
							<div class='label label-primary'><?php echo ucfirst($this->session->name);?></div>
                    </a>


				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>user/view/<?=hash_id($this->session->user_id,'encode');?>">
                        	<i class="fa fa-user"></i>
							<span><?php echo get_phrase('your_profile');?></span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url();?>user_switch/list">
                        	<i class="fa fa-toggle-on"></i>
							<span><?php echo get_phrase('switch_user');?></span>
						</a>
					</li>


				</ul>


			</li>
        </ul>

	</div>

</div>

<hr style="margin-top:0px;" />
