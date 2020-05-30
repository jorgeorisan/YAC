<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Reporte de Ventas por Producto";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$data      = '';
$idtienda  = '';//$_SESSION['user_info']['id_tienda'];
$idusuario = '';
$arrayfilters=[];

$begin        = ( isset($_GET['fecha_inicial']))? $_GET['fecha_inicial'] : date('Y-m-d'); 
$end          = ( isset($_GET['fecha_final']))  ? $_GET['fecha_final']   : date('Y-m-d');	
$idusuario    = ( isset($_GET['id_usuario']))   ? $_GET['id_usuario']    : '';
$idtienda  	  = ($_SESSION['user_id']!=14)       ? $_SESSION['user_info']['id_tienda'] : '';
$idtienda  	  = (isset($_GET['id_tienda']))     ? $_GET['id_tienda']     : $idtienda;
$codeproducto = $arrayfilters['id_producto'] = ( isset($_GET['id_producto']) && $_GET['id_producto'] > 0 )  ?  $_GET['id_producto'] : '';
$arrayfilters['fecha_inicial'] = $begin;
$arrayfilters['fecha_final']   = $end;
$arrayfilters['id_usuario']    = $idusuario;
$arrayfilters['id_tienda']     = $idtienda;
$arrayfilters['page']   	   = 'ventaproductos';
$jsonarrayfilters=json_encode($arrayfilters);

$objreports = new Reports();
$dataventas = $objreports->getReporteVentas($arrayfilters);

$permisousuario = new PermisoUsuario();
$persmisodeleteproductoventa= $permisousuario->getpermisouser( $_SESSION['user_id'], 'Ventas', 'deleteproductoventa');


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
				<a class="btn btn-info" id="exportarVentaProductos"  target="_blank" href="<?php echo make_url("Ventas","excel",array('jsondata'=>$jsonarrayfilters))?>"  ><i class="fa fa-download"></i> &nbsp;Exportar</a>	
			</div>
			<div class="row" style="overflow:auto">
				<article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?php echo $page_title ?></h2>
						</header>
						<div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body" style="overflow: auto">
								<form id="main-form" class="" role="form" method='get' action="<?php echo APP_URL.'/Ventas/productos/?';?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
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
											<div class="col-xs-6  col-sm-6 col-md-6 col-lg-6">
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
											<div class="col-xs-12">
												<div class="form-group">
													<label for="name">Producto</label>
													<select style="width:100%" class="select2" name="id_producto" id="id_producto">
														<option value="">Selecciona</option>
														<?php 
														$obj = new Producto();
														$arrayfilters['todo'] = true;
														$list=$obj->getAllArr($arrayfilters);
														
														if (is_array($list) || is_object($list)){
															foreach($list as $val){
																$selected =  ($codeproducto == $val['id_producto'] ) ? "selected" : '';
																echo "<option ".$selected ." value='".$val['id_producto']."'>".htmlentities($val['codinter']).'|'.htmlentities($val['nombre'])."</option>";
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
			

			<?php if(isset($dataventas) && $dataventas!=''){ ?>
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
						<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2><?php echo $page_title ?></h2>
							</header>
							<div>
								<div class="jarviswidget-editbox">
								</div>
								<div class="widget-body" style="overflow:auto">
									<table id="" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th class = "col-md-1" data-hide="expand"> No. Folio</th>
												<th class = "col-md-1" data-class="phone,tablet">Cant.</th>
												<th class = "col-md-1" data-class="phone,tablet">Codigo </th>
												<th class = "col-md-1" data-class="phone,tablet">Precio</th>
												<th class = "col-md-1" data-class="phone,tablet">Total</th>
												<th class = "col-md-1" data-class="phone,tablet">Tipo</th>
												<th class = "col-md-1" data-class="phone,tablet">Cliente</th>
												<th class = "col-md-1" data-class="phone,tablet">Usuario</th>
												<th class = "col-md-1" data-class="phone,tablet">Tienda</th>
												<th class = "col-md-1" data-class="phone,tablet">Precio</th>
												<th class = "col-md-1" data-class="phone,tablet">Fecha</th>
												<th class = "col-md-1" data-class="phone,tablet"></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$nomtienda = '';
											$totalgeneral = $totaldescgral = $totalpagadogral = $totalporpagar = $totalrecargas= $totalexcedente = 0;
											$idventaanterior='';
											$descuentos   = "";
											
											$class = $classventa= '';
											foreach ($dataventas as $rowventa){
												
												$porpagar=$totalpagado=$totaldesc='';
												$ventas = new Venta();
												if(!$rowventa['cancelado']){
													$totalpagado      = $ventas->getpagado($rowventa["id_venta"]);
													$totalpagadogral += $totalpagado;
													$totaldesc       = ($rowventa["descuento"]) ? $rowventa["descuento"] : 0;
													$totaldescgral	 += $totaldesc;
													if($rowventa['tipo']=='Credito' || $rowventa['tipo']=='Apartado')
														if($rowventa['icredito'])
															$totalporpagar += $porpagar = $rowventa['total']-$totalpagado;
												}
												$classventa     = ($rowventa["cancelado"]) ? "class='cancelada'" : '';
												$dataventasproductos = $objreports->getReporteVentasProductos($rowventa["id_venta"],$codeproducto);
												if($dataventasproductos){
													foreach($dataventasproductos as $row) {
														$tienda = new Tienda();
														$datatienda = $tienda->getTable($row["id_tienda"]);
														if($datatienda) $nomtienda = $datatienda["nombre"]; 
														$id_venta=$row["id_venta"];
														$idventaanterior=$row["id_venta"];
													
														$venta = new Venta();
														$dataventa = $venta->getTable($row["id_venta"]);
														$cliente = new Persona();
														$datacliente = $cliente->getTable($dataventa['id_persona']);
														$class     	 = ($row["cancelado"]) ? "class='cancelada'" : '';
														//calculamos el descuento por producto
														$descxproducto   = ($totaldesc) ? ($row['total']*$totaldesc/$rowventa['total']) : 0 ;
														$totalxproducto  = ($row['total']/$row['cantidad'])-$descxproducto;
														if (!$row['cancelado']) { 
															$totalgeneral   += $row['total'];
															$totalrecargas  += ($row['nombre']=='RECARGA')   ? $row['total'] : 0;
															$totalexcedente += ($row['nombre']=='EXCEDENTE') ? $row['total'] : 0;
														}
														?>
														<tr <?php echo $class;?>>
															<td>
																<a class="" href="<?php echo make_url("Ventas","view",array('id'=>$row['id_venta'])); ?>">
																	<?php echo htmlentities($row['folio'])?>
																</a>
															</td>
															<td><?php echo htmlentities($row['cantidad'])?></td>
															<td><?php echo htmlentities($row['codinter']).'<br>'.htmlentities($row['nombre'])?></td>
															<td>$<?php echo number_format($totalxproducto,2)?></td>
															<td>$<?php echo number_format($row['total'], 2); ?></td>
															<td>
																<?php echo htmlentities($row['tipo'])."<br>";
																if($row['icredito']){
																	echo "<span style='color:red'>En pago</span>";
																}
																?>
															</td>
															
															<td><?php echo htmlentities($datacliente['nombre']." ".$datacliente['ap_paterno'])?></td>
															<td><?php echo htmlentities($rowventa['id_usuario']) ?></td>
															<td><?php echo htmlentities($nomtienda) ?></td>
															<td><?php echo htmlentities($row['tipoprecio'])?></td>
															<td><?php echo htmlentities($row['fecha']) ?></td>
															<td>
																<div class="btn-group">
																	<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																		Accion <span class="caret"></span>
																	</button>
																	<ul class="dropdown-menu">
																		<li>
																			<a title="Ver Venta" class=""  href="<?php echo make_url("Ventas","view",array('id'=>$row['id_venta'])); ?>"> Ver Venta</a>
																		</li>
																		<li>
																			<a title="Imprimir Venta" class="" target="_blank" href="<?php echo make_url("Ventas","print",array('id'=>$row['id_venta'],'page'=>'venta')); ?>">Imprimir</a>
																		</li>
																		<?php 
																		if (!$row['cancelado']){ ?> 
																			<?php if($row['icredito']){ ?>
																				<li>
																					<a data-toggle="modal" style="color:cornflowerblue" href="#myModal" onclick="showpopuppagar(<?php echo $row['id_venta'] ?>)"> Pagar</a>
																				</li>
																			<?php }
																			if($persmisodeleteproductoventa){ ?>
																			<li class="divider"></li>
																			<li>
																				<a href="#" title="Cancelar Producto" id="cancelar_venta<?php echo $row['id_productos_venta']; ?>" idpventa='<?php echo $row['id_productos_venta']; ?>' folio='<?php echo $row['nombre']; ?>' class="deleteventa">Cancelar Producto</a>
																			</li>
																		<?php 
																			}
																		} ?>
																	</ul>
																</div>
															</td>
														</tr>
														<?php
													}
													if($rowventa["descuento"] || $porpagar){
														?>
														<tr <?php echo $classventa;?>>
															<td></td>
															<td></td>
															<td colspan="2">
																Descuento folio:<?php echo $rowventa["folio"] ?><br>
																<?php if($porpagar){
																	echo "Por Pagar:";
																} ?>
															</td>
															<td>$<?php echo number_format($rowventa["descuento"],2) ?>
																<?php if($porpagar){
																	echo "$".number_format($porpagar,2);
																} ?>
															</td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<?php
													}
												}
											}
											
											echo $descuentos;
											?>
										</tbody>
									
									</table>
									<br>
									<br>
									<table id="" class="table table-striped table-bordered table-hover" width="50%">
										<thead>
											<tr>
												<th class = "col-md-1" data-hide="expand"> Descuentos</th>
												<th class = "col-md-1"  data-class="phone,tablet">Por Pagar</th>
												<th class = "col-md-1" data-class="phone,tablet">Recargas </th>
												<th class = "col-md-1" data-class="phone,tablet">Excedente </th>
												<th class = "col-md-1" data-class="phone,tablet"> Venta</th>
											</tr>
										</thead>
										<tbody>
											<th>$<?php echo number_format($totaldescgral,2) ?></th>
											<th>$<?php echo number_format($totalporpagar,2) ?></th>
											<th>$<?php echo number_format($totalrecargas,2) ?></th>
											<th>$<?php echo number_format($totalexcedente,2) ?></th>
											<th>$<?php echo number_format($totalgeneral,2) ?></th>
										</tbody>
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
			var idventa = $(this).attr('idpventa');
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
					$.get(config.base+"/Ventas/ajax/?action=get&object=deleteproductoventa&idproductoventa="+idventa+"&motivo="+Value,
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
         $('body').on('change', '#montoabono', function(){
            if( $(this).val() ){
                var monto  = $("input[name=montoabono]", $(this).parents('form:first')).val();
                var deuda  = $("input[name=deuda]", $(this).parents('form:first')).val();
                var nuevadeuda = deuda - monto;
                if(nuevadeuda<0){ 
                    notify('error','El monto no puede ser mayor a la deuda actual');
                    $("#monto").val('').focus();
                    return false;
                }
            }
        });
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
        $('body').on('click', '#savenewpago', function(){
            var monto  = $("input[name=montoabono]", $(this).parents('form:first')).val();
            var deuda  = $("input[name=deuda]", $(this).parents('form:first')).val();
            if(!monto)  return notify('error',"Se necesita el monto.");  
            var nuevadeuda = deuda - monto;
            if(nuevadeuda<0){ 
                notify('error','El monto no puede ser mayor a la deuda actual');
                $("#monto").val('').focus();
                return false;
            }
            var url = config.base+"/Ventas/ajax/?action=get&object=savenewpago"; 
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).parents('form:first').serialize(), 
                success: function(response){
                    if(response>0){
                        //location.reload();
                    }else{
                        return notify('error',"Oopss error al agregar pago"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
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
