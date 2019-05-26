<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Reporte de Entradas";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$data      = '';
$idtienda  = '';//$_SESSION['user_info']['id_tienda'];
$idusuario = '';
$arrayfilters=[];

$objEntrada = new Entrada();
$begin     = (isset($_POST['fecha_inicial']))? $_POST['fecha_inicial'] : date('Y-m-d'); 
$end       = (isset($_POST['fecha_final']))  ? $_POST['fecha_final']   : date('Y-m-d');	
$idusuario = (isset($_POST['id_usuario']))   ? $_POST['id_usuario']    : '';
$idtienda  = (isset($_POST['id_tienda']))    ? $_POST['id_tienda']     : '';
$arrayfilters['fecha_inicial'] = $begin;
$arrayfilters['fecha_final']   = $end;
$arrayfilters['id_usuario']    = $idusuario;
$arrayfilters['id_tienda']     = $idtienda;

$dataentradas = $objEntrada->getReporteEntradas($arrayfilters);

$dataentradaspendientes = $objEntrada->getReporteEntradasPendientes();

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
			 
			<div class="row">
				
				<article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?php echo $page_title ?></h2>
						</header>
						<div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
								<form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Entradas","index");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <fieldset>    
                                        <div class="col-xs-12  col-sm-12 col-md-6 col-lg-6">
							                <div class="form-group">
							                    <label for="name">Fecha Inicial</label>
							                    <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" value="<?php echo $begin; ?>" placeholder="Fecha Inicial" name="fecha_inicial" >
							                </div>
							                <div class="form-group">
							                    <label for="name">Fecha Final</label>
							                    <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" value="<?php echo $end; ?>" placeholder="Fecha Final" name="fecha_final" >
							                </div>
										</div>
										<div class="col-sm-6">
							                <div class="form-group">
							                    <label for="name">Tienda</label>
							                    <select style="width:100%" class="select2" name="id_tienda" id="id_tienda">
													<option value="">Selecciona</option>
													<?php 
													$obj = new Tienda();
													$list=$obj->getAllArr();
													if (is_array($list) || is_object($list)){
														foreach($list as $val){
															$selected =  ($idtienda == $val['id_tienda']  ) ? "selected" : '';
															echo "<option ".$selected ." value='".$val['id_tienda']."'>".htmlentities($val['nombre'])."</option>";
														}
													}
													?>
												</select>
							                </div>
							                <div class="form-group">
							                    <label for="name">Usuario</label>
							                    <select style="width:100%" class="select2" name="id_usuario" id="id_usuario">
													<option value="">Selecciona</option>
													<?php 
													$obj = new Usuario();
													$list=$obj->getAllArr();
													if (is_array($list) || is_object($list)){
														foreach($list as $val){
															$selected =  ($idusuario == $val['id'] ) ? "selected" : '';
															echo "<option ".$selected ." value='".$val['id']."'>".htmlentities($val['id_usuario'])."</option>";
														}
													}
													?>
												</select>
							                </div>
							            </div>
                                    </fieldset> 
                                    <div class="form-actions" style="text-align: center">
                                        <div class="row">
                                           <div class="col-md-12">
                                                <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                                    Cancelar
                                                </button>
                                                <button class="btn btn-primary btn-md" type="button" id='btngenerar' onclick=" validateForm();">
                                                    <i class="fa fa-save"></i>
                                                    Generar
                                                </button>
                                            </div>
                                        </div>
                                    </div>                              
                                </form>
                            </div>
                        </div>
					</div>
				</article>
				
			</div>
			

			<?php if(isset($dataentradas) && $dataentradas!=''){ ?>
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
												<th class = "col-md-1" data-hide="phone,tablet"> </th>
												<th class = "col-md-1" data-class="expand">No. Folio</th>
												<th class = "col-md-1" data-class="phone,tablet">Tienda</th>
												<th class = "col-md-1" data-class="phone,tablet">Referencia </th>
												<th class = "col-md-1" data-class="phone,tablet">Tipo</th>
												<th class = "col-md-1" data-hide="phone,tablet">Comentarios</th>
												<?php if($_SESSION['user_info']['costos']) { ?>
													<th class = "col-md-1" data-class="phone,tablet">Total Costo</th>
												<?php } ?>
												<th class = "col-md-1" data-class="phone,tablet">Total Precio</th>
												<th class = "col-md-1" data-hide="phone,tablet">Fecha</th>
												<th class = "col-md-1" data-hide="phone,tablet">Status</th>
												<th class = "col-md-1" data-class="phone,tablet"></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$nomtienda = '';
											$total = $totalcosto = 0;
											foreach($dataentradas as $row) {
												$tienda = new Tienda();
												$datatienda = $tienda->getTable($row["id_tienda"]);
												if($datatienda) $nomtienda = $datatienda["abreviacion"]; 
											
												$status = htmlentities($row['status']);
												switch ($status) {
													case 'BAJA':
														$status = 'Cancelado';
														$class  = 'cancelada';
														break;
													default:
														$class  = '';
														$total += $row['total'];
														$totalcosto += $row['costo_total'];
														break;
												} 
												?>
												<tr class="<?php echo $class; ?>">
													<td>
														<a class="" href="<?php echo make_url("Entradas","view",array('id'=>$row['id_entrada'])); ?>">
															<?php echo htmlentities($row['id_entrada'])?>:Ver
														</a>
													</td>
													<td><?php echo htmlentities($row['folio'])?></td>
													<td><?php echo htmlentities($nomtienda) ?></td>
													<td><?php echo htmlentities($row['referencia'])?></td>
													<td>
														<?php echo htmlentities($row['tipo_pago'])."<br>";
														if($row['icredito']){
															echo "<span style='color:red'>En pago</span>";
														}
														?>
													</td>
													<td><?php echo htmlentities($row['comentarios']) ?></td>
													<?php if($_SESSION['user_info']['costos']) { ?>
														<td>$<?php echo number_format($row['costo_total'], 2); ?></td>
													<?php } ?>
													<td>$<?php echo number_format($row['total'], 2); ?></td>
													<td><?php echo htmlentities($row['fecha'])?></td>
													<td><?php echo htmlentities($row['status'])."<br>".$row['fecha_validacion'] ?></td>
													<td>
														<div class="btn-group">
															<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																Accion <span class="caret"></span>
															</button>
															<ul class="dropdown-menu">
																<li>
																	<a title="Ver Entrada" class=""  href="<?php echo make_url("Entradas","view",array('id'=>$row['id_entrada'])); ?>"> Ver Entrada</a>
																</li>
																<li>
																	<a title="Imprimir Entrada" class="" target="_blank" href="<?php echo make_url("Entradas","print",array('id'=>$row['id_entrada'],'page'=>'entrada')); ?>">Imprimir</a>
																</li>
																<?php 
																if ($row['status']!='BAJA'){ ?> 
																	<?php if($row['icredito']){ ?>
																		<li>
																			<a data-toggle="modal" class="btn btn-info" href="#myModal" onclick="showpopuppagar(<?php echo $row['id_entrada'] ?>)"> Pagar</a>
																		</li>
																	<?php } ?>
																	<li class="divider"></li>
																	<li>
																		<a href="#" class="red" onclick="borrar('<?php echo make_url("Entradas","entradadelete",array('id'=>$row['id_entrada'])); ?>',<?php echo $row['id_entrada']; ?>);">Eliminar</a>
																	</li>
																<?php 
																} ?>
															</ul>
														</div>
													</td>
												</tr>
											<?php
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="6" style="text-align:right">Total:</th>
												<?php if($_SESSION['user_info']['costos']) { ?>
													<th>$<?php echo $totalcosto;?></th>
												<?php } ?>
												<th>$<?php echo $total;?></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</article>
					
				</div>
			<?php }?>
			<?php if(isset($dataentradaspendientes) && $dataentradaspendientes!=''){ ?>
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2><?php echo "ENTRADAS POR VALIDAR" ?></h2>
							</header>
							<div>
								<div class="jarviswidget-editbox">
								</div>
								<div class="widget-body">
									<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th class = "col-md-1" data-hide="phone,tablet"> </th>
												<th class = "col-md-1" data-class="expand">No. Folio</th>
												<th class = "col-md-1" data-class="phone,tablet">Tienda</th>
												<th class = "col-md-1" data-class="phone,tablet">Referencia </th>
												<th class = "col-md-1" data-class="phone,tablet">Tipo</th>
												<th class = "col-md-1" data-hide="phone,tablet">Comentarios</th>
												<?php if($_SESSION['user_info']['costos']) { ?>
													<th class = "col-md-1" data-class="phone,tablet">Total Costo</th>
												<?php } ?>
												<th class = "col-md-1" data-class="phone,tablet">Total Precio</th>
												<th class = "col-md-1" data-hide="phone,tablet">Fecha</th>
												<th class = "col-md-1" data-hide="phone,tablet">Status</th>
												<th class = "col-md-1" data-class="phone,tablet"></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$nomtienda = '';
											$total = $totalcosto = 0;
											foreach($dataentradaspendientes as $row) {
												$tienda = new Tienda();
												$datatienda = $tienda->getTable($row["id_tienda"]);
												if($datatienda) $nomtienda = $datatienda["abreviacion"]; 
											
												$status = htmlentities($row['status']);
												switch ($status) {
													case 'BAJA':
														$status = 'Cancelado';
														$class  = 'cancelada';
														break;
													default:
														$class  = '';
														$total += $row['total'];
														$totalcosto += $row['costo_total'];
														break;
												} 
												?>
												<tr class="<?php echo $class; ?>">
													<td>
														<a class="" href="<?php echo make_url("Entradas","view",array('id'=>$row['id_entrada'])); ?>">
															<?php echo htmlentities($row['id_entrada'])?>:Ver
														</a>
													</td>
													<td><?php echo htmlentities($row['folio'])?></td>
													<td><?php echo htmlentities($nomtienda) ?></td>
													<td><?php echo htmlentities($row['referencia'])?></td>
													<td>
														<?php echo htmlentities($row['tipo_pago'])."<br>";
														if($row['icredito']){
															echo "<span style='color:red'>En pago</span>";
														}
														?>
													</td>
													<td><?php echo htmlentities($row['comentarios']) ?></td>
													<?php if($_SESSION['user_info']['costos']) { ?>
														<td>$<?php echo number_format($row['costo_total'], 2); ?></td>
													<?php } ?>
													<td>$<?php echo number_format($row['total'], 2); ?></td>
													<td><?php echo htmlentities($row['fecha'])?></td>
													<td><?php echo htmlentities($row['status'])."<br>".$row['fecha_validacion'] ?></td>
													<td>
														<div class="btn-group">
															<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																Accion <span class="caret"></span>
															</button>
															<ul class="dropdown-menu">
																<li>
																	<a title="Ver Entrada" class=""  href="<?php echo make_url("Entradas","view",array('id'=>$row['id_entrada'])); ?>"> Ver Entrada</a>
																</li>
																<li>
																	<a title="Imprimir Entrada" class="" target="_blank" href="<?php echo make_url("Entradas","print",array('id'=>$row['id_entrada'],'page'=>'entrada')); ?>">Imprimir</a>
																</li>
																<?php 
																if ($row['status']!='BAJA'){ ?> 
																	<?php if($row['icredito']){ ?>
																		<li>
																			<a data-toggle="modal" class="btn btn-info" href="#myModal" onclick="showpopuppagar(<?php echo $row['id_entrada'] ?>)"> Pagar</a>
																		</li>
																	<?php } ?>
																	<li class="divider"></li>
																	<li>
																		<a href="#" class="red" onclick="borrar('<?php echo make_url("Entradas","entradadelete",array('id'=>$row['id_entrada'])); ?>',<?php echo $row['id_entrada']; ?>);">Eliminar</a>
																	</li>
																<?php 
																} ?>
															</ul>
														</div>
													</td>
												</tr>
											<?php
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="6" style="text-align:right">Total:</th>
												<?php if($_SESSION['user_info']['costos']) { ?>
													<th>$<?php echo $totalcosto;?></th>
												<?php } ?>
												<th>$<?php echo $total;?></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</article>
					
				</div>
			<?php }?>
			
		</section>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="50" alt="SmartAdmin">
                    <div id='titlemodal' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> Nuevo</span>
                    </div>
                    
                </h4>
            </div>
            <div class="modal-body no-padding" >
                <div id="contentpopup">

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
 	function validateForm()
    {
        var fecha_inicial = $("input[name=fecha_inicial]").val();
        if ( ! fecha_inicial )  return notify("info","La fecha inicial es requerido");
		var fecha_final = $("input[name=fecha_final]").val();
        if ( ! fecha_final )  return notify("info","La fecha final es requerido");

        $("#main-form").submit();       
	}
	
	
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
			"aaSorting": [[ 1,"asc" ]],
        	"iDisplayLength": 50,

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
	});



</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
