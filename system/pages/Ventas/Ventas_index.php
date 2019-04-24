<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Reporte de Ventas";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$data      = '';
$begin     = date('Y-m-d'); 
$end       = date('Y-m-d');
$idtienda  = '';//$_SESSION['user_info']['id_tienda'];
$idusuario = '';
$arrayfilters=[];

$obj = new Venta();
if(isPost()){
	$begin     = $_POST['fecha_inicial']; 
	$end       = $_POST['fecha_final'];	
	$idusuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';
	$idtienda  = (isset($_POST['id_tienda']))  ? $_POST['id_tienda'] : $_SESSION['user_info']['id_tienda'];
	$arrayfilters['fecha_inicial'] = $begin;
	$arrayfilters['fecha_final']   = $end;
	$arrayfilters['id_usuario']    = $idusuario;
	$arrayfilters['id_tienda']     = $idtienda;
}
$dataventas     		= $obj->getReporteVentas($arrayfilters);
$datacomisionesusuarios = $obj->getReporteComisionesUsuarios($arrayfilters);
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
				
				<article class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
					<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?php echo $page_title ?></h2>
						</header>
						<div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
								<form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Ventas","index");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <fieldset>    
                                        <div class="col-sm-6">
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
															$selected =  ($idtienda == $val['id_tienda'] ) ? "selected" : '';
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
															$selected =  ($idusuario == $val['id_usuario'] ) ? "selected" : '';
															echo "<option ".$selected ." value='".$val['id_usuario']."'>".htmlentities($val['id_usuario'])."</option>";
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
                                                <button class="btn btn-primary btn-md" type="button" onclick=" validateForm();">
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
			

			<?php if(isset($dataventas) && $dataventas!=''){ ?>
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
												<th class = "col-md-1" data-class="phone,tablet">Vendedor </th>
												<th class = "col-md-1" data-hide="phone,tablet">Fecha</th>
												<th class = "col-md-1" data-class="phone,tablet">Tipo</th>
												<th class = "col-md-1" data-class="phone,tablet">Tienda</th>
												<th class = "col-md-1" data-class="phone,tablet">Total</th>
												<th class = "col-md-1" data-hide="phone,tablet">Comentarios</th>
												<th class = "col-md-1" data-class="phone,tablet"></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$nomtienda = '';
											$total = 0;
											foreach($dataventas as $row) {
												$tienda = new Tienda();
												$datatienda = $tienda->getTable($row["id_tienda"]);
												if($datatienda) $nomtienda = $datatienda["nombre"]; 
											
												$descuentos = new Descuentos();
												$datadescuentos = $descuentos->getTable($row["id_venta"]);
												$descuento = ($datadescuentos)   ? $datadescuentos["descripciondesc"]."<br>" : ''; 
												$class     = ($row["cancelado"]) ? "class='cancelada'" : '';
												
												if ($row['cancelado']==0) {
													$total += $row['total'];
												}
												?>
												<tr <?php echo $class;?>>
													<td>
														<a class="" href="<?php echo make_url("Ventas","view",array('id'=>$row['id_venta'])); ?>">
															<?php echo htmlentities($row['id_venta'])?>:Ver
														</a>
													</td>
													<td><?php echo htmlentities($row['folio'])?></td>
													<td><?php echo htmlentities($row['id_usuario'])?></td>
													<td><?php echo htmlentities($row['fecha'])?></td>
													<td>
														<?php echo htmlentities($row['tipo'])."<br>";
														if($row['icredito']){
															echo "<span style='color:red'>En pago</span>";
														}
														?>
													</td>
													<td><?php echo htmlentities($nomtienda) ?></td>
													<td>$<?php echo number_format($row['total'], 2); ?></td>
													<td><?php echo $descuento.htmlentities($row['comentarios']) ?></td>
													<td>
														<?php if (!$row['cancelado']){ ?>
															<a href="#" id="cancelar_venta<?php echo $row['id_venta']; ?>" idventa='<?php echo $row['id_venta']; ?>' folio='<?php echo $row['folio']; ?>' class="btn btn-primary deleteventa"> Cancelar </a>
														<?php } ?>
													</td>
												</tr>
											<?php
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="6" style="text-align:right">Total:</th>
												<th><?php echo $total;?></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</article>
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget jarviswidget-color-white" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2>Comisiones de Ventas</h2>
							</header>
							<div>
								<div class="jarviswidget-editbox">
								</div>
								<div class="widget-body">
								<h3 class="tit"></h3>
									<table width="100%" class="table table-striped table-bordered table-hover">
										<tr>
											<th>Usuario</th>
											<th>Total Comisionable </th>
											<th>Abonos</th>
											<th>Recargas</th>
											<th>Execente</th>
											<th>Total Venta (CAJA)</th>
											<th>Por Cobrar</th>
											<th>Total General</th>
											<th>Comision</th>
										</tr>
										<tbody>
											<?php 
											$totalventausuariogral   = 0;
											$totalventaabonosgral    = 0;
											$totalventarecargasgral  = 0;
											$totalventaexcedentegral = 0;
											$totalcajagral           = 0;
											$totalventacreditogral   = 0;
											$totalventagral          = 0;
											$totalcomisiongral       = 0;
											foreach($datacomisionesusuarios as $row) {
												$id_usuario          = $row->id_usuario; 
												$totalventa 		 = $row->totalventa; 
												$totalventacredito   = $row->totalventacredito; 
												$totalventacancelada = $row->totalventacancelada; 
												$totalventamayoreo   = $row->totalventamayoreo; 
												$totalventaabonos    = $row->totalventaabonos; 
												$totalventarecargas  = $row->totalventarecargas; 
												$totalventaexcedente = $row->totalventaexcedente; 
												$totalventadescuento = $row->totalventadescuento; 
												$totalventa 		 = $totalventa - $totalventadescuento; // quitamos los decuentos
												$totalventausuario   = $totalventa - $totalventacredito - $totalventamayoreo - $totalventarecargas  ;
												$totalcaja           = $totalventausuario + $totalventaabonos + $totalventarecargas + $totalventaexcedente ;
												$totalcomision		 = $totalventausuario * $row->comision ;
												$totalventausuariogral   += $totalventausuario;
												$totalventaabonosgral    += $totalventaabonos;
												$totalventarecargasgral  += $totalventarecargas;
												$totalventaexcedentegral += $totalventaexcedente;
												$totalcajagral           += $totalcaja;
												$totalventacreditogral   += $totalventacredito;
												$totalventagral          += $totalventa;
												$totalcomisiongral       += $totalcomision;
												?>
												<tr>
													<td><?php echo $id_usuario; ?></td>
													<td><span title="<?php echo $totalventa.'-'.$totalventacredito.'-'.$totalventarecargas.'-'.$totalventamayoreo.'='.$totalcaja ?>">
														<?php echo $totalventausuario?></span>
													</td>
													<td><?php echo $totalventaabonos; ?></td>
													<td><?php echo $totalventarecargas; ?></td>
													<td><?php echo $totalventaexcedente; ?></td>
													<td><?php echo $totalcaja; ?></td>
													<td><?php echo $totalventacredito; ?></td>
													<td><?php echo $totalventa; ?></td>
													<td><?php echo $totalcomision; ?></td>
												</tr>
											<?php
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th style="text-align:right">Total:</th>
												<th><?php echo $totalventausuariogral; ?></th>
												<th><?php echo $totalventaabonosgral; ?></th>
												<th><?php echo $totalventarecargasgral; ?></th>
												<th><?php echo $totalventaexcedentegral; ?></th>
												<th><?php echo $totalcajagral; ?></th>
												<th><?php echo $totalventacreditogral; ?></th>
												<th><?php echo $totalventagral; ?></th>
												<th><?php echo $totalcomisiongral; ?></th>
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
		var table = $('#dt_basic2').dataTable();
		$(".deleteventa").click(function(e) {
            e.preventDefault();
			var idventa = $(this).attr('idventa');
			var folio   = $(this).attr('folio');
			$.SmartMessageBox({
				title : "Cancelar Venta: "+folio,
				content : "Menciona el motivo de cancelacion",
				buttons : '[No][Yes]',
				input : "text",
				placeholder : "Motivo de cancelacion"
			}, function(ButtonPressed, Value) {
				if (ButtonPressed === "Yes") {
					if(!Value) return notify('warning','Se necesita un motivo');
					$.get(config.base+"/Ventas/ajax/deleteventa?action=get&object=deleteventa&idventa="+idventa+"&motivo="+Value,
					function (response) {
						if(response){
							notify('success','Cancelada con exito');
							location.reload();
						}else{
							return notify('error','Error al cancelar venta');
						}
					});
				}
			});
			$("#txt1").val('');
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
