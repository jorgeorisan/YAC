|<!-- PAGE FOOTER -->
<div class="page-footer" style="background: none;z-index:9999; border:0;margin:0;padding:0;height:24px;">
	<div class="row" style="position: absolute;bottom: 0">
		<div class="col-xs-12 col-sm-12">
			<div class="pull-right;">
				<div style="color:#eee;font-size:10px; border-radius: 0 6px 0 0 ;padding: 2px 6px;background: rgba(161,15,43,0.8);">YAC Corporation  © <?php echo date('Y');?></div>
			</div>
		</div>
		<?php if (FALSE){ ?>
		
		<div class="col-xs-12 col-sm-6">
			<span class="txt-color-white">SmartAdmin 1.9 <span class="hidden-xs"> - Web Application Framework</span> © 2014-2016</span>
		</div>

		<div class="col-xs-6 col-sm-6 text-right hidden-xs">
			<div class="txt-color-white inline-block">
				<i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
				<div class="btn-group dropup">
					<button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
						<i class="fa fa-link"></i> <span class="caret"></span>
					</button>
					<ul class="dropdown-menu pull-right text-left">
						<li>
							<div class="padding-5">
								<p class="txt-color-darken font-sm no-margin">Download Progress</p>
								<div class="progress progress-micro no-margin">
									<div class="progress-bar progress-bar-success" style="width: 50%;"></div>
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="padding-5">
								<p class="txt-color-darken font-sm no-margin">Server Load</p>
								<div class="progress progress-micro no-margin">
									<div class="progress-bar progress-bar-success" style="width: 20%;"></div>
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="padding-5">
								<p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
								<div class="progress progress-micro no-margin">
									<div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="padding-5">
								<button class="btn btn-block btn-default">refresh</button>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div> 
		<?php } ?>
	</div>
</div>
<!-- END PAGE FOOTER -->
