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
						<a href="<?php echo base_url();?>account/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>


				</ul>


			</li>
        </ul>

	</div>

</div>

<hr style="margin-top:0px;" />
