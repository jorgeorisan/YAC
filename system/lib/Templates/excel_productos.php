<?php

$page_title               	   = ucwords($dataJson->page);




$texto    = (isset($dataJson->texto))     ? $dataJson->texto : '' ; 
if(isset($dataJson->filters))  {
	$filtro = $dataJson->filters;
	$texto  =  (count($filtro[0])>0) ? $filtro[0]['value'] : ''  ; 
}

$idtienda = (isset($dataJson->id_tienda)) ? $dataJson->id_tienda : $_SESSION['user_info']['id_tienda'] ;
$size     = 0 ;
$page  	  = 0;
$maxRows  = $page * $size;

$productos = new Producto();
$arrayfilters['similar']   = $texto;
$arrayfilters['id_tienda'] = $idtienda;
$arrayfilters['maxRows']   = $maxRows;
$arrayfilters['todo']      = '1';

$arrayfilters['size']      = $size;

$productostienda  = $productos->getAllArr($arrayfilters);

$totalproductos   = $productos->getAllArr( array('todo'=>'all') );
$totalpagestabu   = 0; 

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
												<th class = "col-md-1" data-hide="phone,tablet">ID </th>
												<th class = "col-md-1" data-class="phone,tablet">CODIGO </th>
												<th class = "col-md-1" data-hide="phone,tablet">NOMBRE</th>
												<th class = "col-md-1" data-class="phone,tablet">MARCA</th>
												<th class = "col-md-1" data-class="phone,tablet">CATEGORIA</th>
												<th class = "col-md-1" data-class="phone,tablet">COSTO</th>
												<th class = "col-md-1" data-hide="phone,tablet">MAYOREO</th>
												<th class = "col-md-1" data-hide="phone,tablet">PRECIO</th>
												<th class = "col-md-1" data-hide="phone,tablet">EXIS. TIENDA</th>
												<th class = "col-md-1" data-hide="phone,tablet">EXIS. GENERAL</th>
												<th class = "col-md-1" data-hide="phone,tablet">ACTUALIZACION</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$nomtienda = '';
											$total = 0;
											$totaldevoluciones = 0;
											foreach($productostienda as $row) {
												
												?>
												<tr>
													<td><?php echo htmlentities($row['id_producto'])?></td>
													<td><?php echo htmlentities($row['codinter'])?></td>
													<td><?php echo htmlentities($row['nombre'])?></td>
													<td><?php echo htmlentities($row['marca'])?></td>
													<td><?php echo htmlentities($row['categoria'])?></td>
													<td><?php echo htmlentities($row['costo'])?></td>
													<td><?php echo htmlentities($row['preciomayoreo'])?></td>
													<td><?php echo htmlentities($row['precio'])?></td>
													<td><?php echo htmlentities($row['existenciastienda'])?></td>
													<td><?php echo htmlentities($row['existencias'])?></td>
													<td><?php echo htmlentities($row['fecha_actualizacion'].'/'.$row['usuario_actualizacion'])?></td>
													
												</tr>
											<?php
											}
											?>
										</tbody>
										<tfoot>
											
										</tfoot>
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