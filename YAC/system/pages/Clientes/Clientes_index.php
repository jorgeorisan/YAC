
<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Clientes";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");


$obj = new Persona();
$arrayfilters['tipo'] = '1';
$arrayfilters['page'] = 'clientes';
$data = $obj->getAllArr($arrayfilters);

//print_r($data);
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		//$breadcrumbs["Add client"] = APP_URL."/Clients/add";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">
		<section id="widget-grid" class="">
			 <p><a class="btn btn-success" href="<?php echo make_url("Clientes","add")?>" ><i class="fas fa-plus"></i> Nuevo Cliente</a></p>
			<div class="row">
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?php echo $page_title ?></h2>
						</header>
						<div>
							<div class="jarviswidget-editbox">
							</div>
							<div class="widget-body">
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw fa-list-ol text-muted hidden-md hidden-sm hidden-xs"></i> No. Persona
											</th>
											<th class = "col-md-1" data-class="expand">
												<i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Nombre
											</th>
											<th class = "col-md-1" data-hide="phone">
												<i class="fa fa-fw  fa-envelope  text-muted hidden-md hidden-sm hidden-xs"></i> Email
											</th>
											<th class = "col-md-1" data-hide="">
												<i class="fa fa-fw  fa-phone-square text-muted hidden-md hidden-sm hidden-xs"></i> Telefono
											</th>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw  fa-check-square  text-muted hidden-md hidden-sm hidden-xs"></i> Direccion
											</th>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw  fa-exclamation-triangle  text-muted hidden-md hidden-sm hidden-xs"></i> Alergico
											</th>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw  fa-check-square  text-muted hidden-md hidden-sm hidden-xs"></i> Fecha Alta
											</th>
											<th class = "col-md-1" data-hide="phone,tablet">
												<i class="fa fa-fw  text-muted hidden-md hidden-sm hidden-xs"></i>Action
											</th>
										</tr>
									</thead>
									<tbody>
										<?php  foreach($data as $row) {
											$nomtienda="";
											$objtienda = new Tienda();
											$datatienda = $objtienda->getTable($row["id_tienda"]);
											if($datatienda){ $nomtienda = $datatienda["nombre"]; }
											?>
											<tr>
												<td><?php echo htmlentities($row['id_persona'])?></td>
												<td><?php echo htmlentities($row['nombre'].' '.$row['ap_paterno'].' '.$row['ap_materno'])?></td>
												<td><?php echo htmlentities($row['email'])?></td>
												<td><?php echo htmlentities($row['telefono']) ?></td>
												<td><?php echo htmlentities($row['ciudad']." ".$row['estado']." Col. ".$row['colonia']." Calle. ".$row['calle']." Num. ".$row['num_exterior']." ".$row['num_interior']) ?></td>
												<td><?php echo htmlentities($row['alergias']) ?></td>
												<td><?php echo htmlentities($row['fecha_registro']) ?></td>
												<td>
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Accion <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a class="" href="<?php echo make_url("Clientes","view",array('id'=>$row['id_persona'])); ?>">Ver</a>
															</li>
															<li>
																<a class="" href="<?php echo make_url("Clientes","edit",array('id'=>$row['id_persona'])); ?>">Editar</a>
															</li>
															<li>
																<a class="" href="<?php echo make_url("Clientes","pedido",array('id'=>$row['id_persona'])); ?>">Pedidos</a>
															</li>
															<li class="divider"></li>
															<li>
																<a href="#" class="red" onclick="borrar('<?php echo make_url("Clientes","personadelete",array('id'=>$row['id_persona'])); ?>',<?php echo $row['id_persona']; ?>);">Eliminar</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</article>
			</div>
		</section>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
	// include page footer
	include(SYSTEM_DIR . "/inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
	//include required scripts
	include(SYSTEM_DIR . "/inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script>

	$(document).ready(function() {
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
	
		/* DO NOT REMOVE : GLOBAL FUNCTIONS!
		 *
		 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
		 *
		
		 */

		 pageSetUp();
	})

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
