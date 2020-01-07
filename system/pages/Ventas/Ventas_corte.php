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
$idtienda  = '';//$_SESSION['user_info']['id_tienda'];
$idusuario = '';
$arrayfilters=[];

$begin     = (isset($_GET['fecha_inicial']))? $_GET['fecha_inicial'] : date('Y-m-d'); 
$end       = (isset($_GET['fecha_final']))  ? $_GET['fecha_final']   : date('Y-m-d');	
$idusuario = (isset($_GET['id_usuario']))   ? $_GET['id_usuario']    : '';
$idtienda  = ($_SESSION['user_id']!=14)      ? $_SESSION['user_info']['id_tienda'] : '';
$idtienda  = (isset($_GET['id_tienda']))    ? $_GET['id_tienda']     : $idtienda;
$arrayfilters['fecha_inicial'] = $begin;
$arrayfilters['fecha_final']   = $end;
$arrayfilters['id_usuario']    = $idusuario;
$arrayfilters['id_tienda']     = $idtienda;
$arrayfilters['page']   	   = 'ventas';
$jsonarrayfilters 		= json_encode($arrayfilters);
$reports = new Reports();
$dataventas     		= $reports->getReporteVentas($arrayfilters);
$datacomisionesusuarios = $reports->getReporteComisionesUsuarios($arrayfilters);
$dataabonos     		= $reports->getReporteAbonos($arrayfilters);
$totalAbonosGenerales = 0;
foreach($dataabonos as $row) {
	$totalAbonosGenerales+=$row->totalventaabonos;
}
$totalcajacorte = $reports->getCajaAnterior($arrayfilters);

if(isPost()){
	if(isset($_POST['text_entrada'])){
		$obj = new Corte();
		$id  = $obj->addAll(getPost());
		if($id){
			$arrayfilters['page']   = 'cortes';
			$jsonarrayfilters 		= json_encode($arrayfilters);

			$to = 'jororisan@gmail.com';
			$subject = $_SESSION['user_info']['tienda'].'- Corte del '.$begin.' al '.$end;
			$url =APP_URL.'/Reportes/cortediario/?json='.$jsonarrayfilters;
			$message = file_get_contents($url);

			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8\r\n";
			$headers .= "From: <no-reply@yoamocomprar.com>\r\n";
			$headers .= "X-YAC: 1\r\n";	
			$headers .= 'X-Mailer: PHP/' . phpversion();
			//$headers .= "Bcc: jororisan@gmail.com\r\n";	
					
				
			if(mail($to, $subject, $message, $headers)){
				echo 'Exito al enviar mail';
			} 
		}
	}
}

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
				<a class="btn btn-info" id="exportarventa"  target="_blank" href="<?php echo make_url("Ventas","excel",array('jsondata'=>$jsonarrayfilters))?>"  ><i class="fa fa-download"></i> &nbsp;Exportar</a>	
			</div>
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
								<form id="main-form" class="" role="form" mmethod='get' action="<?php echo APP_URL.'/Ventas/corte/?';?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
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
				<?php 
				$nomtienda = '';
				$total = 0;
				$totaldevoluciones= 0;
				foreach($dataventas as $row) {
					$cliente = new Persona();
					$datacliente = $cliente->getTable($row['id_persona']);
					$tienda = new Tienda();
					$datatienda = $tienda->getTable($row["id_tienda"]);
					if($datatienda) $nomtienda = $datatienda["nombre"]; 
				
					$descuento = ($row["descuento"]) ? 'Descuento:'.$row["descuento"]."<br>" : ''; 
					$class     = ($row["cancelado"]) ? "class='cancelada'" : '';
					
					if ($row['cancelado']==0) {
						$total += $row['total'];
						$obj = new Venta();
						$totaldevoluciones += $obj->getcancelaciones($row['id_venta']);
					}
					?>
				<?php
				}
				?>			

			<div class="row">
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
										<th>Total (CAJA)</th>
										<th>Apartados/Credito</th>
										<th>Total General</th>
										<th>Comision</th>
									</tr>
									<tbody>
										<?php 
										$totalventausuariogral   = 0;
										$totalAbonosUsers        = 0;
										$totalventarecargasgral  = 0;
										$totalventaexcedentegral = 0;
										$totalcajagral           = 0;
										$totalventacreditogral   = 0;
										$totalventagral          = 0;
										$totalcomisiongral       = 0;
										$textusers				 = '';
										$totalventacaja 	     = 0;
										foreach($datacomisionesusuarios as $row) {
											$textusers			.= $row->id_usuario.","; 
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
											$totalventausuario   = $totalventa - $totalventacredito - ($totalventamayoreo/2) - $totalventarecargas  ;
											$totalcaja           = $totalventausuario + $totalventaabonos  + $totalventarecargas +  ($totalventamayoreo/2)  ;
											$totalcaja           = ( $row->id_usuario_tipo !=  9 )  ? $totalcaja : $totalcaja - $totalventaexcedente;
											$totalcaja           = ( $row->id_usuario !=  'Lizzy' ) ? $totalcaja : $totalcaja - $totalventaexcedente;
											$totalgeneral 		 = $totalventa   ; 
											$totalcomision		 = $totalventausuario * $row->comision ;
											$totalventausuariogral   += $totalventausuario;
											$totalAbonosUsers        += $totalventaabonos;
											$totalventarecargasgral  += $totalventarecargas;
											$totalventaexcedentegral += $totalventaexcedente;
											$totalcajagral           += $totalcaja;
											$totalventacreditogral   += $totalventacredito;
											$totalventagral          += $totalgeneral;
											$totalcomisiongral       += $totalcomision;
											if(($row->id_user  == $_SESSION['user_id'] && $totalventacaja == 0 )){
												$totalventacaja =  $totalcaja ;
											}
											
											?>
											<tr>
												<td><?php echo ($row->id_usuario_tipo==9 || $row->id_usuario =='Lizzy' ) ? $id_usuario."->Servicio" : $id_usuario; ?></td>
												<td><span title="<?php echo "(".$totalventa.'venta)-('.$totalventacredito.'credito)-('.$totalventarecargas.'recargas)-('.($totalventamayoreo/2).'mayoreo)='.$totalventausuario ?>">
														<?php echo $totalventausuario?>
													</span>
												</td>
												<td><?php echo $totalventaabonos; ?></td>
												<td><?php echo $totalventarecargas; ?></td>
												<td><?php echo $totalventaexcedente; ?></td>
												<td><span title="<?php echo "(".$totalventausuario.'ventaUser)+('.$totalventaabonos.'abonos)-('.$totalventarecargas.'recargas)='.$totalcaja ?>">
														<?php echo $totalcaja; ?>
													</span>
												</td>
												<td><?php echo $totalventacredito; ?></td>
												<td>
													<span title="<?php echo "(".$totalventa.'venta) ='.$totalgeneral ?>">
														<?php echo $totalgeneral; ?>
													</span>	
												</td>
												<td><?php echo $totalcomision; ?></td>
											</tr>
										<?php
										
										}
										$totalAbonosOtros= $totalAbonosGenerales - $totalAbonosUsers;
										if( $totalAbonosOtros){
											?>
											<tr>
												<td style="text-align:right" title='Un usuario realizo un abono pero no tiene ventas'>Otro:</td>
												<td></td>
												<td><?php echo $totalAbonosOtros; ?></td>
												<td></td>
												<td></td>
												<td><?php echo $totalAbonosOtros; ?></td>
												<td></td>
												<td><?php echo $totalAbonosOtros; ?></td>
												<td></td>
											</tr>
											<?php 
										} 
										
										$totalventa     = $totalcajagral + $totalAbonosOtros;
										
										?>
									</tbody>
									<tfoot>
										<tr>
											<th style="text-align:right">Total:</th>
											<th><?php echo $totalventausuariogral; ?></th>
											<th><?php echo $totalAbonosGenerales; ?></th>
											<th><?php echo $totalventarecargasgral; ?></th>
											<th><?php echo $totalventaexcedentegral; ?></th>
											<th><?php echo $totalventa; ?></th>
											<th><?php echo $totalventacreditogral; ?></th>
											<th><?php echo $totalventagral + $totalAbonosOtros; ?></th>
											<th><?php echo $totalcomisiongral; ?></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</article>
			</div>
			<div class="row">
				<form id="main-form2" class="" role="form" method='post' action="<?php echo make_url("Ventas","corte");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
					<input type="hidden" name='fecha' id='fecha' value="<?php echo  $begin ?>">
					<input type="hidden" name='total_entrada' id='total_entrada2' value="0">
					<input type="hidden" name='total_salida' id='total_salida2' value="0">
					<input type="hidden" name='total_cajanew' id='total_cajanew2' value="0">
					<input type="hidden" name='total_caja' id='total_caja2' value="0">
					<input type="hidden" name='total_dinero' id='total_dinero2' value="0">
					<input type="hidden" name='total_diferencia' id='total_diferencia2' value="0">
					
					<div class="row" style="padding: 20px;">
						<article class="col-sm-12 col-md-8 col-lg-8"  id="">
							<div class="jarviswidget jarviswidget-color-white" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>Cuentas <?php echo date('l jS \of F Y ');?></h2>
								</header>
								<div>
									<div class="jarviswidget-editbox">
									</div>
									<div class="widget-body">
									<h3 class="tit"></h3>
									<table border='1' style="width:100%">
										<thead>
											<tr>
												<th style="color:blue">C. Entrada</th>
												<th style="color:blue; width:10px">Entradas</th>
												<th style="color:red; width:10px">Salidas</th>
												<th style="color:red">C. Salida</th>
											</tr>
										</thead>
										<tbody class="renglones">
											<tr class="renglon">
												<td><input class="question" name="text_entrada[]" placeholder="Concepto" type="text" value='Caja' ></td>
												<td><input class="question r_entrada" name="row_entrada[]" placeholder="" type="number" value="<?php echo $totalcajacorte?>" ></td>
												<td><input class="question r_salida" name="row_salida[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_salida[]" placeholder="Concepto" type="text" value='Sueldo'></td>
											</tr>
											<tr class="renglon">
												<td><input class="question" name="text_entrada[]" placeholder="Concepto" type="text" value='Venta'></td>
												<td><input class="question r_entrada" name="row_entrada[]" placeholder="" type="number" value="<?php echo $totalventacaja; ?>" ></td>
												<td><input class="question r_salida" name="row_salida[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_salida[]" placeholder="Concepto" type="text" value='Pago YAC STUDIO'></td>
											</tr>
											<tr class="renglon">
												<td><input class="question" name="text_entrada[]" placeholder="Concepto" type="text" value='YAC STUDIO'></td>
												<td><input class="question r_entrada" name="row_entrada[]" placeholder="" type="number"></td>
												<td><input class="question r_salida" name="row_salida[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_salida[]" placeholder="Concepto" type="text" value='Pago BE YAC SPA'></td>
											</tr>
											<tr class="renglon">
												<td><input class="question" name="text_entrada[]" placeholder="Concepto" type="text" value='BE YAC SPA'></td>
												<td><input class="question r_entrada" name="row_entrada[]" placeholder="" type="number"></td>
												<td><input class="question r_salida" name="row_salida[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_salida[]" placeholder="Concepto" type="text" value='Retiro'></td>
											</tr>
											<tr class="renglon">
												<td><input class="question" name="text_entrada[]" placeholder="Nuevo Concepto" type="text" value=''></td>
												<td><input class="question r_entrada" name="row_entrada[]" placeholder="" type="number"></td>
												<td><input class="question r_salida" name="row_salida[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_salida[]" placeholder="Nuevo Concepto" type="text" value=''></td>
											</tr>
										</tbody>
										<footer>
											<tr class="">
												<td colspan="4">&nbsp;</td>
											</tr>
											<tr class="totales">
												<td></td>
												<td><strong><div  id="total_entrada" style="width:10px; color:blue">0</div></strong></td>
												<td><strong><div  id="total_salida" style="width:10px; color:red">0</div></strong></td>
												<td></td>
											</tr>
											<tr class="totales">
												<td></td>
												<td><strong>Total en Caja</strong></td>
												<td><strong><div id="total_caja" style="width:10px; color:green">0</div></strong></td>
												<td></td>
											</tr>
										</footer>
									</table>
								</div>
							</div>
						</article>
						<article class="col-sm-12 col-md-6 col-lg-6"  id="">
							<div class="jarviswidget jarviswidget-color-white" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>EFECTIVO</h2>
								</header>
								<div>
									<div class="jarviswidget-editbox">
									</div>
									<div class="widget-body">
									<h3 class="tit"></h3>
									<table border='1' style="width:100%; paddign-top:10px">
										<thead>
											<tr>
												<th style="color:">Monto</th>
												<th style="color:blue">Tipo</th>
											</tr>
										</thead>
										<tbody class="renglones_dinero" style="text-align:center">
											<tr class="renglon_dinero">
												<td><input class="question r_dinero" name="row_dinero[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_dinero[]" placeholder="Concepto" type="text" value='Billetes'></td>
											</tr>
											<tr class="renglon_dinero">
												<td><input class="question r_dinero" name="row_dinero[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_dinero[]" placeholder="Concepto" type="text" value='Monedas 10'></td>
											</tr>
											<tr class="renglon_dinero">
												<td><input class="question r_dinero" name="row_dinero[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_dinero[]" placeholder="Concepto" type="text" value='Monedas 5'></td>
											</tr>
											<tr class="renglon_dinero">
												<td><input class="question r_dinero" name="row_dinero[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_dinero[]" placeholder="Concepto" type="text" value='Cambio'></td>
											</tr>
											<tr class="renglon_dinero">
												<td><input class="question r_dinero" name="row_dinero[]" placeholder="" type="number"></td>
												<td><input class="question" name="text_dinero[]" placeholder="Nuevo Concepto" type="text" value=''></td>
											</tr>
										</tbody>
										<footer>
											<tr class="">
												<td colspan="2">&nbsp;</td>
											</tr>
											<tr class="totales">
												<td><strong><div  id="total_dinero" style="width:10px; color:blue">0</div></strong></td>
												<td><strong>TOTAL</strong></td>
											</tr>
											<tr class="totales">
												<td><strong><div id="total_diferencia" style="width:10px; color:">0</div></strong></td>
												<td><strong>Diferencia</strong></td>
											</tr>
										</footer>
									</table>
								</div>
							</div>
						</article>
					</div>
					<div class="" style="text-align: center">
						<div class="col-md-12">
							<br>
							<button class="btn btn-primary btn-md" id='send' style="width: 100%" type="button">
								<i class="fa fa-save"></i>
								Registrar
							</button>
						</div>
					</div>
				</form>
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
	// Add New Block
	$('body').on('blur', '.renglon input', function(){

		// Get Variables
		total = $('.renglon').length;
		block = $(this).closest('.renglon');
		index = block.index() + 1;

		// Return if not last
		if ( total != index )
			return;

		// Return if empty
		empty = true;
		block.find('input').each(function(){
			if ( $(this).val() != "" )
				empty = false;
		});

		if ( empty )
			return;

		// Clone Block
		new_block = block.clone();
		new_block.css({'display': 'none'});
		new_block.find('input').each(function(){
			$(this).val("");
			if ( $(this).hasClass("is-invalid") )
				$(this).removeClass('is-invalid');
		});

		// Add Block
		block.closest('.renglones').append( new_block );
		new_block.show('medium');
	});
	$('body').on('blur', '.renglon_dinero input', function(){

		// Get Variables
		total = $('.renglon_dinero').length;
		block = $(this).closest('.renglon_dinero');
		index = block.index() + 1;

		// Return if not last
		if ( total != index )
			return;

		// Return if empty
		empty = true;
		block.find('input').each(function(){
			if ( $(this).val() != "" )
				empty = false;
		});

		if ( empty )
			return;

		// Clone Block
		new_block = block.clone();
		new_block.css({'display': 'none'});
		new_block.find('input').each(function(){
			$(this).val("");
			if ( $(this).hasClass("is-invalid") )
				$(this).removeClass('is-invalid');
		});

		// Add Block
		block.closest('.renglones_dinero').append( new_block );
		new_block.show('medium');
	});
	$('body').on('change', '.question', function(){
		var cont_entr=0;
		var cont_sal =0;
		var cont_din =0;
		$('.r_entrada').each(function (idx, obj) {
			if ( $(this).val() > 0){
				cont_entr+= parseInt($(this).val());
			}
		});
		$('.r_entrada').each(function (idx, obj) {
			if ( $(this).val() > 0 && idx == 0 ){
				$("#total_caja2").val($(this).val());
			}
		});
		$('.r_salida').each(function (idx, obj) {
			if ( $(this).val() > 0){
				cont_sal+= parseInt($(this).val());
			}
		});
		$('.r_dinero').each(function (idx, obj) {
			if ( $(this).val() > 0){
				cont_din+= parseInt($(this).val());
			}
		});
		
		$("#total_entrada2").val(cont_entr);
		$("#total_salida2").val(cont_sal);
	    $("#total_dinero2").val(cont_din) ;

		var total_entrada  = $("#total_entrada").html(cont_entr);
		var total_salida   = $("#total_salida").html(cont_sal);
		var total_dinero   = $("#total_dinero").html(cont_din) ;
		var total_caja     = parseInt(cont_entr)-parseInt(cont_sal);
		var total_dife     = parseInt(cont_din)-parseInt(total_caja);
		
		$("#total_caja").html(total_caja);
		$("#total_diferencia").html(total_dife);
		
		$("#total_cajanew2").val(total_caja);
		$("#total_diferencia2").val(total_dife);
		if(total_dife==0){
			$("#total_diferencia").attr('style','color:green');
		}else{
			$("#total_diferencia").attr('style','color:red');
		}
	});
	$('.question').change();
	$("#send").click(function (e) {
        
		$("#main-form2").submit();

		return false;
	});
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
                        location.reload();
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
