<?php
$json      = (isset($_GET['json']))? $_GET['json'] : die('no data');

$jsonobj = json_decode($json);
$arrayfilters['fecha_inicial'] = $jsonobj->fecha_inicial;
$arrayfilters['fecha_final']   = $jsonobj->fecha_final;
$arrayfilters['id_usuario']    = $jsonobj->id_usuario;
$arrayfilters['id_tienda']     = $jsonobj->id_tienda;
$arrayfilters['page']   	   = $jsonobj->page;
$jsonarrayfilters 		= json_encode($arrayfilters);
$reports   = new Reports();
$datapagos = $reports->getReporteCortes($arrayfilters);

//echo json_encode($datapagos );
?>
<div class="row" style="overflow:auto;width:100%">
					
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
		
		<header>
			<h2><?php echo $tienda.' '.date('jS \of F Y ',strtotime($fecha));?></h2>
		</header>
		<div>
			<div class="widget-body" style="overflow: auto">
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
	<?php
	} ?>
</div>
<?php exit; ?>