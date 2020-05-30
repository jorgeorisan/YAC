<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Reporte de Abonos";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$data      = '';
$idtienda  = '';//$_SESSION['user_info']['id_tienda'];
$idusuario = '';
$arrayfilters=[];

$begin      = (isset($_GET['fecha_inicial']))? $_GET['fecha_inicial'] : date('Y-m-d'); 
$end        = (isset($_GET['fecha_final']))  ? $_GET['fecha_final']   : date('Y-m-d');	
$idusuario  = (isset($_GET['id_usuario']))   ? $_GET['id_usuario']    : '';
$idtienda   = ($_SESSION['user_id']!=14)     ? $_SESSION['user_info']['id_tienda'] : '';
$idtienda   = (isset($_GET['id_tienda']))    ? $_GET['id_tienda']     : $idtienda;
$id_venta   = $arrayfilters['id_venta']   = ( isset($_GET['id_venta']) && $_GET['id_venta'] > 0 )  ?  $_GET['id_venta'] : '';
$id_persona = $arrayfilters['id_persona'] = ( isset($_GET['id_persona']) && $_GET['id_persona'] > 0 )  ?  $_GET['id_persona'] : '';
$arrayfilters['fecha_inicial'] = $begin;
$arrayfilters['fecha_final']   = $end;
$arrayfilters['id_usuario']    = $idusuario;
$arrayfilters['id_tienda']     = $idtienda;
$arrayfilters['page']   	   = 'pagos';
$jsonarrayfilters 		= json_encode($arrayfilters);
$reports = new Reports();
$datapagos     		= $reports->getReportePagos($arrayfilters);
//echo json_encode($datapagos );
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
			<div class="widget-body" style='padding-bottom: 10px;'>
			 	<a class="btn btn-success" href="<?php echo make_url("Ventas","add")?>" >Nueva Venta</a>
				<a class="btn btn-info" id="exportarventa"  target="_blank" href="<?php echo make_url("Reportes","excel",array('jsondata'=>$jsonarrayfilters))?>"  ><i class="fa fa-download"></i> &nbsp;Exportar</a>	
			</div>
			<div class="row">
				<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?php echo $page_title ?></h2>
						</header>
						<div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body" style="overflow: auto">
								<form id="main-form" class="" role="form" method='get' action="<?php echo APP_URL.'/Reportes/pagos/?';?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <fieldset>    
										<div class="row">
											<div class="col-xs-6  col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="name">Fecha Inicial</label>
													<input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" value="<?php echo $begin; ?>" placeholder="Fecha Inicial" name="fecha_inicial" >
												</div>
												<div class="form-group">
													<label for="name">Fecha Final</label>
													<input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" value="<?php echo $end; ?>" placeholder="Fecha Final" name="fecha_final" >
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
													<label for="name">Usuario<?php echo $idusuario;?></label>
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
										
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="name">Venta Folio</label>
													<select style="width:100%" class="select2" name="id_venta" id="id_venta">
														<option value="">Selecciona</option>
														<?php 
														$obj = new Venta();
														$arrayfilters['todo'] = true;
														$list=$obj->getAllArrVtaCredito();
														
														if (is_array($list) || is_object($list)){
															foreach($list as $val){
																$selected =  ($id_venta == $val['id_venta'] ) ? "selected" : '';
																echo "<option ".$selected ." value='".$val['id_venta']."'>".htmlentities($val['folio'])."</option>";
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="name">Cliente</label>
													<select style="width:100%" class="select2" name="id_persona" id="id_persona">
														<option value="">Selecciona</option>
														<?php 
														$obj = new Persona();
														$arrayfilters['todo'] = true;
														$list=$obj->getAllArr('clientes','Paciente');
														
														if (is_array($list) || is_object($list)){
															foreach($list as $val){
																$selected =  ($id_persona == $val['id_persona'] ) ? "selected" : '';
																echo "<option ".$selected ." value='".$val['id_persona']."'>".htmlentities($val['nombre'].' '.$val['ap_paterno'].' '.$val['ap_materno'].' | '.$val['telefono']).htmlentities($val['usuario_tipo'])."</option>";
															}
														}
														?>
													</select>
												</div>
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
			

			<?php if(isset($datapagos) && $datapagos!=''){ ?>
				<div class="row" style="overflow:auto">
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
												<th class = "col-md-1" data-class="expand">Folio Venta</th>
												<th class = "col-md-1" data-class="">Cliente </th>
												<th class = "col-md-1" data-class="">Usuario </th>
												<th class = "col-md-1" data-class="phone,tablet">Fecha Abono</th>
												<th class = "col-md-1" data-class="phone,tablet">Tipo Abono</th>
												<th class = "col-md-1" data-class="phone,tablet">Tipo Venta</th>
												<th class = "col-md-1" data-class="phone,tablet">Tienda</th>
												<th class = "col-md-1" data-class="phone,tablet">Abono</th>
												<th class = "col-md-1" data-class="phone,tablet">Adeudo</th>
												<th class = "col-md-1" data-class="phone,tablet">Total Venta</th>
												<th class = "col-md-1" data-class="phone,tablet">Status</th>
												<th class = "col-md-1" data-class="phone,tablet">Comentarios</th>
												<th class = "col-md-1" data-class="phone,tablet"></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$nomtienda = '';
											$total = $totalmonto = $totaladeudos = 0;
											$totaldevoluciones= 0;
											foreach($datapagos as $row) {
												$cliente = new Persona();
												$datacliente = (isset($row->id_persona)) ? $cliente->getTable($row->id_persona):'';
												$vendedor = new Usuario();
												$datavendedor = (isset($row->id_user)) ? $vendedor->getTable($row->id_user):'';
												
												$tienda = new Tienda();
												$datatienda = $tienda->getTable($row->id_tienda);
												if($datatienda) $nomtienda = $datatienda["nombre"]; 
											
												$descuento = ($row->descuento) ? 'Descuento:'.$row->descuento."<br>" : ''; 
												$class     = ($row->status=='CANCELADO' || $row->cancelado ) ? "class='cancelada'" : '';
												$statusv   = ($row->cancelado) ? "CANCELADA" : 'ACTIVA';
												
												$obj = new Venta();
												$totalpagado = $obj->getpagado($row->id_venta);
												if ($row->cancelado==0) {
													$total        += $row->total;
													$totaladeudos += $totalpagado;
													$obj = new Venta();
													$totaldevoluciones += $obj->getcancelaciones($row->id_venta);
												}
												if(!$class){
													$totalmonto+=$row->montoabono;
												}
												?>
												<tr <?php echo $class;?>>
													<td>
														<a class="" href="<?php echo make_url("Ventas","view",array('id'=>$row->id_venta)); ?>">
															<?php echo htmlentities($row->folio)?>
														</a>
													</td>
													<td><?php echo htmlentities($datacliente['nombre']." ".$datacliente['ap_paterno'])?></td>
													<td><?php echo htmlentities($datavendedor['id_usuario'])?></td>
													<td><?php echo htmlentities($row->fecha_abono)?></td>
													<td><?php echo htmlentities($row->tipo_pago)?></td>
													<td>
														<?php echo htmlentities($row->tipo)."<br>";
														if($row->icredito){
															echo "<span style='color:red'>En pago</span>";
														}
														?>
													</td>
													<td><?php echo htmlentities($nomtienda) ?></td>
													<td>$<?php echo number_format($row->montoabono, 2); ?></td>
													<td>$<?php echo number_format($row->total-$totalpagado, 2); ?></td>
													<td>$<?php echo number_format($row->total, 2); ?></td>
													<td><?php echo 'Abono:'.$row->status.'<br>Venta:'.$statusv ; ?></td>
													<td><?php echo $descuento.htmlentities($row->comentarios) ?></td>
													<td>
														<div class="btn-group">
															<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																Accion <span class="caret"></span>
															</button>
															<ul class="dropdown-menu">
																<li>
																	<a title="Ver Venta" class=""  href="<?php echo make_url("Ventas","view",array('id'=>$row->id_venta)); ?>"> Ver Venta</a>
																</li>
																<li>
																	<a title="Imprimir Venta" class="" target="_blank" href="<?php echo make_url("Ventas","print",array('id'=>$row->id_venta,'page'=>'venta','close'=>'true')); ?>">Imprimir</a>
																</li>
																<?php 
																if (!$row->cancelado){ ?> 
																	
																	<li class="divider"></li>
																	<li>
																		<a href="#" title="Cancelar Venta" id="cancelar_venta<?php echo $row->id_deudores; ?>" idventa='<?php echo $row->id_deudores; ?>' folio='<?php echo $row->id_deudores; ?>' class=" deleteventa">Eliminar</a>
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
												<th><?php echo $totalmonto ?></th>
												<th><?php echo $totaladeudos ?></th>
												<th><?php echo $total ?></th>
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
		 //**********pagoS*************/
       
        showpopuppagar = function(id_venta){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo Pago</span>');
            $.get(config.base+"/Ventas/ajax/?action=get&object=showpopuppagar&id="+id_venta, null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario de pacientes');
                        
                    }     
            });
            return false;
        }
      
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
