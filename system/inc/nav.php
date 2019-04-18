		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional hre="" links. See documentation for details.
				-->
				<?php
					$ui = new SmartUI();
					$ui->create_nav($page_nav)->print_html();
				?>
<!-- User info -->
				<ul><li>
				
				
				<?php if (true){?>	

						<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
							<i class="fa fa-bell"></i>
							<span class="menu-item-parent">&nbsp;&nbsp;Alertas</span>
						</a>

					<?php } ?>
			
				</li></ul>
			</nav>

			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->
