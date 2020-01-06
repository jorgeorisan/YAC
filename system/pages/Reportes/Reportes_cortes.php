<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Reporte de Cortes de Venta";

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
$arrayfilters['fecha_inicial'] = $begin;
$arrayfilters['fecha_final']   = $end;
$arrayfilters['id_usuario']    = $idusuario;
$arrayfilters['id_tienda']     = $idtienda;
$arrayfilters['page']   	   = 'cortes';
$jsonarrayfilters 		= json_encode($arrayfilters);
$reports = new Reports();
$datapagos = $reports->getReporteCortes($arrayfilters);
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
								<form id="main-form" class="" role="form" method='get' action="<?php echo APP_URL.'/Reportes/cortes/?';?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
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
			
				<div class="row" style="padding: 20px; overflow:auto">
					
					<?php 
					$id_corte          	 = ""; 
					$id_usuario          = ""; 
					$tienda 			 = ""; 
					$fecha   			 = ""; 
					$totaldiferecia      = ""; 
					$status  			 = ""; 
					$total_entrada    	 = ""; 
					$total_salida  		 = ""; 
					$total_caja 		 = ""; 
					$total_dinero		 = ""; 
					$total_cajanew		 = ""; 
					foreach($datapagos as $row) {
						$id_corte          	 = $row['id']; 
						$id_usuario          = $row['id_usuario']; 
						$tienda 			 = $row['tienda']; 
						$fecha   			 = $row['fecha']; 
						$total_diferencia    = $row['total_diferencia']; 
						$status  			 = $row['status']; 
						$total_entrada    	 = $row['total_entrada']; 
						$total_salida  		 = $row['total_salida']; 
						$total_caja 		 = $row['total_caja']; 
						$total_dinero		 = $row['total_dinero']; 
						$total_cajanew		 = $row['total_cajanew']; 
						
						
						?>
						<article class="col-sm-12 col-md-12 col-lg-12"  id="">
							<div class="jarviswidget jarviswidget-color-white" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2><?php echo $tienda.' '.date('jS \of F Y ',strtotime($fecha));?></h2>
								</header>
								<div>
									<div class="jarviswidget-editbox"></div>
									<div class="widget-body" style="overflow: auto">
										<h3 class="tit"></h3>
										<table border='1' style="width:100%; ">
											<tr style="text-align: center">
												<td style="color: blue;">Entradas</td>
												<td style="color: red;">Salidas</td>
												<td style="color: green;">Caja</td>
											</tr>
											<tr>
												<td>
													<table border='1'>
														<thead>
															<tr>
																<th style="color:blue">C. Entrada</th>
																<th style="color:blue; width:10px">Entradas</th>
															</tr>
														</thead>
														<tbody class="renglones_dinero" style="text-align:center">
															<?php
															$concepto 			 = ''; 
															$cantidad			 = ''; 
															$tipo      			 = ''; 
															$datapagosconceptos = $reports->getReporteCortesConceptos($id_corte,'entrada');
															foreach($datapagosconceptos as $row) {
																$concepto 			 = $row['concepto']; 
																$cantidad			 = $row['cantidad']; 
																$tipo      			 = $row['tipo']; 
																
																?>
																<tr class="renglon">
																	<td><input class="question" name="text_entrada[]" placeholder="Concepto" type="text" value='<?php echo $concepto  ?>' ></td>
																	<td><input class="question r_entrada" name="row_entrada[]" placeholder="" type="number" value="<?php echo  $cantidad  ?>" ></td>
																</tr>
																<?php 
															} 
															?>
																
														</tbody>
														<footer>
															<tr class="totales">
																<td><strong>TOTAL ENTRADA</strong></td>
																<td><strong><div  id="total_dinero" style="width:10px; color:blue"><?php echo $total_entrada ?></div></strong></td>
															</tr>
														</footer>
													</table>
												</td>
												<td>
													<table border='1' >
														<thead>
															<tr>
																<th style="color:red; width:10px">Salidas</th>
																<th style="color:red">C. Salida</th>
															</tr>
														</thead>
														<tbody class="renglones_dinero" style="text-align:center">
															<?php
															$concepto 			 = ''; 
															$cantidad			 = ''; 
															$tipo      			 = ''; 
															$datapagosconceptos = $reports->getReporteCortesConceptos($id_corte,'salida');
															foreach($datapagosconceptos as $row) {
																$concepto 			 = $row['concepto']; 
																$cantidad			 = $row['cantidad']; 
																$tipo      			 = $row['tipo']; 
																
																?>
																<tr class="renglon">
																	<td><input class="question r_salida" name="row_salida[]" placeholder="" type="number" value="<?php echo $cantidad ; ?>"></td>
																	<td><input class="question" name="text_salida[]" placeholder="Concepto" type="text" value='<?php echo  $concepto; ?>'></td>
																</tr>
																<?php 
															} 
															?>
																
														</tbody>
														<footer>
															<tr class="totales">
																<td><strong><div  id="total_dinero" style="width:10px; color:red"><?php echo $total_salida ?></div></strong></td>
																<td><strong>TOTAL SALIDA</strong></td>
															</tr>
														</footer>
													</table>
												</td>
												<td>
													<table border='1'>
														<thead>
															<tr>
																<th style="color:green; width:10px">Monto</th>
																<th style="color:green">Tipo</th>
															</tr>
														</thead>
														<tbody class="renglones_dinero" style="text-align:center">
															<?php
															$concepto 			 = ''; 
															$cantidad			 = ''; 
															$tipo      			 = ''; 
															$datapagosconceptos = $reports->getReporteCortesConceptos($id_corte,'dinero');
															foreach($datapagosconceptos as $row) {
																$concepto 			 = $row['concepto']; 
																$cantidad			 = $row['cantidad']; 
																$tipo      			 = $row['tipo']; 
																
																?>
																<tr class="renglon">
																	<td><input class="question r_salida" name="row_salida[]" placeholder="" type="number" value="<?php echo $cantidad ; ?>"></td>
																	<td><input class="question" name="text_salida[]" placeholder="Concepto" type="text" value='<?php echo  $concepto; ?>'></td>
																</tr>
																<?php 
															} 
															?>
																
														</tbody>
														<footer>
															<tr class="totales">
																<td><strong><div  id="total_dinero" style="width:10px; color:red"><?php echo $total_salida ?></div></strong></td>
																<td><strong>TOTAL EFECTIVO</strong></td>
															</tr>
														</footer>
													</table>
												</td>
											</tr>
												<tr><td colspan="3">&nbsp;</td></tr>
												<tr class="totales">
													<td><strong>DIFERENCIA</strong></td>
													<td><strong><div  id="total_diferencia" style="width:10px; color:<?php echo ($total_diferencia>0)? "blue" : ($total_diferencia<0) ? 'red' : 'green' ;  ?>"><?php echo $total_diferencia ?></div></strong></td>
													<td></td>
												</tr>
												<tr class="totales">
													<td><strong>CAJA NUEVA</strong></td>
													<td><strong><div  id="total_cajanew" style="width:10px; "><?php echo $total_cajanew ?></div></strong></td>
													<td></td>
												</tr>
										</table>
									</div>
									
								</div>
							</div>
						</article>
					<?php
					} ?>
				</div>
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
