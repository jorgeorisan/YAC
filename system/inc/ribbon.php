	<!-- RIBBON -->
	<div id="ribbon">
		<div class="col-sm-1">
			<div class="" style="padding: 7px; font-size: 8px;">
				<?php echo $_SESSION['user_info']['tienda']."-".$_SESSION['user_info']['usuario_tipo']; ?>
			</div>
		</div>
		<span class="ribbon-button-alignment"> 
			<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" 
			data-original-title="<i class='text-warning fa fa-warning'></i> Warning! Actualizar" 
			data-html="true"><i class="fas fa-sync fa-spin"></i></span> 
		</span>

		<!-- breadcrumb -->
		<ol class="breadcrumb">
			<?php
				foreach ($breadcrumbs as $display => $url) {
					$breadcrumb = $url != "" ? '<a href="'.$url.'">'.$display.'</a>' : $display;
					echo '<li>'.$breadcrumb.'</li>';
				}
				echo '<li>'.$page_title.'</li>';
			?>
		</ol>
		<!-- end breadcrumb -->

		<!-- You can also add more buttons to the
		ribbon for further usability

		Example below:

		<span class="ribbon-button-alignment pull-right">
		<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
		<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
		<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
		</span> -->

	</div>
	<!-- END RIBBON -->