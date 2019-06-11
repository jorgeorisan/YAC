<?php

$obj = new Venta();
$arrayfilters['fecha_inicial'] = $dataJson->fecha_inicial;
$arrayfilters['fecha_final']   = $dataJson->fecha_final;
$arrayfilters['id_usuario']    = $dataJson->id_usuario;
$arrayfilters['id_tienda']     = $dataJson->id_tienda;
$page_title               	   = ucwords($dataJson->page);
$dataventas     		= $obj->getReporteVentas($arrayfilters);
$datacomisionesusuarios = $obj->getReporteComisionesUsuarios($arrayfilters);
$dataabonos     		= $obj->getReporteAbonos($arrayfilters);
$totalAbonosGenerales = 0;
foreach($dataabonos as $row) {
	$totalAbonosGenerales+=$row->totalventaabonos;
}
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$page_title.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<!-- MAIN PANEL -->
<div id="main" role="main">
	<!-- MAIN CONTENT -->
	<div id="content">
		<section id="widget-grid" class="">
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
												<th class = "col-md-1" data-hide="phone,tablet">Folio </th>
												<th class = "col-md-1" data-class="phone,tablet">Vendedor </th>
												<th class = "col-md-1" data-hide="phone,tablet">Fecha</th>
												<th class = "col-md-1" data-class="phone,tablet">Tipo</th>
												<th class = "col-md-1" data-class="phone,tablet">Tienda</th>
												<th class = "col-md-1" data-class="phone,tablet">Total</th>
												<th class = "col-md-1" data-hide="phone,tablet">Comentarios</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$nomtienda = '';
											$total = 0;
											$totaldevoluciones = 0;
											foreach($dataventas as $row) {
												$tienda = new Tienda();
												$datatienda = $tienda->getTable($row["id_tienda"]);
												if($datatienda) $nomtienda = $datatienda["nombre"]; 
											
												$descuento = ($row["descuento"]) ? 'Descuento:'.$row["descuento"]."<br>" : ''; 
												$class     = ($row["cancelado"]) ? "class='cancelada'" : '';
												
												if ($row['cancelado']==0) {
													$total += $row['total'];
													$totaldevoluciones += $obj->getcancelaciones($row['id_venta']);
												}
												?>
												<tr <?php echo $class;?>>
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
													
												</tr>
											<?php
											}
											?>
										</tbody>
										<tfoot>
											<?php if($totaldevoluciones>0) {?>
												<tr>
													<th colspan="5" style="text-align:right">Devoluciones:</th>
													<th><?php echo $totaldevoluciones;?></th>
													<th></th>
													<th></th>
												</tr>
											<?php } ?>
											<tr>
												<th colspan="5" style="text-align:right">Total:</th>
												<th><?php echo $total;?></th>
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
											<th>Total (CAJA)</th>
											<th>Apartados/Credito</th>
											<th>Total General</th>
											<th>Comision</th>
										</tr>
										<tbody>
											<?php 
											$totalventausuariogral   = 0;
											 $totalAbonosUsers    = 0;
											$totalventarecargasgral  = 0;
											$totalventaexcedentegral = 0;
											$totalcajagral           = 0;
											$totalventacreditogral   = 0;
											$totalventagral          = 0;
											$totalcomisiongral       = 0;
											$textusers				 = '';
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
												$totalcaja           = $totalventausuario + $totalventaabonos  + $totalventaexcedente  + $totalventarecargas +  ($totalventamayoreo/2)  ;
												$totalgeneral 		 = $totalventa   ; 
												$totalcomision		 = ( $row->id_usuario_tipo !=  9 ) ? $totalventausuario * $row->comision :  $totalventaexcedente * $row->comision ;
												$totalventausuariogral   += $totalventausuario;
												$totalAbonosUsers        += $totalventaabonos;
												$totalventarecargasgral  += $totalventarecargas;
												$totalventaexcedentegral += $totalventaexcedente;
												$totalcajagral           += $totalcaja;
												$totalventacreditogral   += $totalventacredito;
												$totalventagral          += $totalgeneral;
												$totalcomisiongral       += $totalcomision;
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
													<td><span title="<?php echo "(".$totalventausuario.'ventaUser)+('.$totalventaabonos.'abonos)+('.$totalventaexcedente.'excedente)-('.$totalventarecargas.'recargas)='.$totalcaja ?>">
															<?php echo $totalcaja; ?>
														</span>
													</td>
													<td><?php echo $totalventacredito; ?></td>
													<td><span title="<?php echo "(".$totalventausuario.'ventaUser)+('.$totalventaabonos.'abonos)+('.$totalventaexcedente.'excedente)-('.$totalventarecargas.'recargas)='.$totalcaja ?>">
															<?php echo $totalcaja; ?>
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
											} ?>
										</tbody>
										<tfoot>
											<tr>
												<th style="text-align:right">Total:</th>
												<th><?php echo $totalventausuariogral; ?></th>
												<th><?php echo $totalAbonosGenerales; ?></th>
												<th><?php echo $totalventarecargasgral; ?></th>
												<th><?php echo $totalventaexcedentegral; ?></th>
												<th><?php echo $totalcajagral + $totalAbonosOtros; ?></th>
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
			<?php }?>
			
		</section>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->