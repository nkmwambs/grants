<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

?>
	<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->

		<div class="navbar-inner">

			<!-- logo -->
			<div class="navbar-brand">
				 <a href="<?php echo base_url(); ?>">
	                <img src="uploads/logo.png"  style="max-height:20px;"/>
	            </a>
			</div>


			<!-- main menu -->

			<ul class="navbar-nav">
				<!-- DASHBOARD -->
		        <?=$this->menu->navigation();?>

			</ul>


			<!-- notifications and other links -->
			<ul class="nav navbar-right pull-right">

				<li class="sep"></li>

				<li>
					<a href="<?php echo base_url();?>index.php?login/logout">
						<?=get_phrase('log_out');?> <i class="entypo-logout right"></i>
					</a>
				</li>


				<!-- mobile only -->
				<li class="visible-xs">

					<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
					<div class="horizontal-mobile-menu visible-xs">
						<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
							<i class="entypo-menu"></i>
						</a>
					</div>

				</li>

			</ul>

		</div>

	</header>
