<?php

$obj = new Venta();
$arrayfilters['fecha_inicial'] = $dataJson->fecha_inicial;
$arrayfilters['fecha_final']   = $dataJson->fecha_final;
$arrayfilters['id_usuario']    = $dataJson->id_usuario;
$arrayfilters['id_tienda']     = $dataJson->id_tienda;
$page_title               	   = ucwords($dataJson->page);

$objreports = new Reports();
$dataventas = $objreports->getReporteVentas($arrayfilters);

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
									<table id="" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th class = "col-md-1" data-hide="phone,tablet"> No. Folio</th>
												<th class = "col-md-1" data-class="expand">Cant.</th>
												<th class = "col-md-1" data-class="phone,tablet">Codigo </th>
												<th class = "col-md-1" data-class="phone,tablet">Precio</th>
												<th class = "col-md-1" data-class="phone,tablet">Total</th>
												<th class = "col-md-1" data-class="phone,tablet">Tipo</th>
												<th class = "col-md-1" data-hide="phone,tablet">Usuario</th>
												<th class = "col-md-1" data-hide="phone,tablet">Tienda</th>
												<th class = "col-md-1" data-class="phone,tablet">Precio</th>
												<th class = "col-md-1" data-class="phone,tablet">Fecha</th>
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
												$dataventasproductos = $ventas->getReporteVentasProductos($rowventa["id_venta"]);
												foreach($dataventasproductos as $row) {
													$tienda = new Tienda();
													$datatienda = $tienda->getTable($row["id_tienda"]);
													if($datatienda) $nomtienda = $datatienda["nombre"]; 
													$id_venta=$row["id_venta"];
													$idventaanterior=$row["id_venta"];
												
													$venta = new Venta();
													$dataventa = $venta->getTable($row["id_venta"]);
													
													$class     = ($row["cancelado"]) ? "class='cancelada'" : '';
													$totalxproducto = 0;
													if (!$row['cancelado']) {
														//calculamos el descuento por producto
														$descxproducto   = ($totaldesc) ? ($row['total']*$totaldesc/$rowventa['total']) : 0 ; 
														$totalxproducto  = ($row['total']/$row['cantidad'])-$descxproducto;
														$totalgeneral   += $row['total'];
														$totalrecargas  += ($row['nombre']=='RECARGA')   ? $row['total'] : 0;
														$totalexcedente += ($row['nombre']=='EXCEDENTE') ? $row['total'] : 0;
													}
													?>
													<tr <?php echo $class;?>>
														<td><?php echo htmlentities($row['folio'])?></td>
														<td><?php echo htmlentities($row['cantidad'])?></td>
														<td><?php echo htmlentities($row['codinter']."::".$row['nombre'])?></td>
														<td>$<?php echo number_format($totalxproducto,2)?></td>
														<td>$<?php echo number_format($row['total'], 2); ?></td>
														<td>
															<?php echo htmlentities($row['tipo'])."<br>";
															if($row['icredito']){
																echo "<span style='color:red'>En pago</span>";
															}
															?>
														</td>
														<td><?php echo htmlentities($rowventa['id_usuario']) ?></td>
														<td><?php echo htmlentities($nomtienda) ?></td>
														<td><?php echo htmlentities($row['tipoprecio'])?></td>
														<td><?php echo htmlentities($row['fecha']) ?></td>
														
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
													</tr>
													<?php
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
									<table>
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