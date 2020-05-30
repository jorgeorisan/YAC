<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Kardex producto";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
include(SYSTEM_DIR . "/inc/nav.php");
if(isset($_GET['id'])   && $_GET['id']>0)
    $id=$_GET['id'];
else
    informError(true,make_url("Productos","index"));

$obj = new Producto();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Productos","index"));
}


$begin        = ( isset($_GET['fecha_inicial']))? $_GET['fecha_inicial'] : ''; 
$idusuario    = ( isset($_GET['id_usuario']))   ? $_GET['id_usuario']    : '';
$idtienda  	  =  $_SESSION['user_info']['id_tienda'] ;
$codeproducto = $arrayfilters['id_producto'] = ( isset($_GET['id']) && $_GET['id'] > 0 )  ?  $_GET['id'] : '';
$arrayfilters['fecha_inicial'] = $begin;
$arrayfilters['id_usuario']    = $idusuario;
$arrayfilters['id_tienda']     = $idtienda;
$jsonarrayfilters=json_encode($arrayfilters);

$objreports = new Reports();
$dataventas = $objreports->getReporteVentas($arrayfilters);

$dataentrada           = $objreports->getReporteEntradas($arrayfilters);
$datasalidas           = $objreports->getReporteSalidas($arrayfilters);
$datatraspasosentrada  = $objreports->getReporteTraspasosEntrada($arrayfilters);
$datatraspasossalida   = $objreports->getReporteTraspasosSalida($arrayfilters);

  
$queryproductos= $obj->getAllArr($arrayfilters);
$totalkardex = '0';
$fecha_actualizacion = $existenciaactual= $usuario_actualizacion='';
foreach( $queryproductos as $key => $valprod){
    $existenciaactual       = $valprod['existenciastienda'];
    $fecha_actualizacion    = $valprod['fecha_actualizacion'];
    $usuario_actualizacion  = $valprod['usuario_actualizacion'];

}
   
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Productos"] = APP_URL."/Productos/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2><?php echo 'KARDEX'; ?></h2>
                            </header>
                            <div>
                                <div class="jarviswidget-editbox">
                                </div>
                                <div class="widget-body" style="overflow:auto">
                                <table style="height: 100%;width:100%;">
                                        <tr style ='color:blue'>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">ID</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Nombre</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Marca</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Categoria</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Exist</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">KARDEX</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold; ">Diferencia</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Act</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;"></td>
                                        </tr>
                                        <tr class="<?php echo $class; ?>">
                                            <td><?php echo htmlentities($data['id_producto']); ?></td>
                                            <td><?php echo htmlentities($data['codinter']); ?></td>
                                            <td><?php echo htmlentities($data['nombre']); ?></td>
                                            <td><?php echo htmlentities($data['marca']); ?></td>
                                            <td><?php echo htmlentities($data['categoria']); ?></td>
                                            <td><div id='totalexistencia'><?php echo $existenciaactual ; ?></td>
                                            <td><div id="totalkardex">N/E</div></td>
                                            <td><div id="totaldiferencia">N/E</div></td>
                                        
                                            <td><?php echo $fecha_actualizacion."<br>".$usuario_actualizacion;
                                            
                                            ?></td>
                                            <td class='borrar-td'>
                                            
                                            
                                                <a href="<?php echo make_url("Productos","edit").'/?id='.$codeproducto;?>" class="btn btn-info" > <i class="fas fa-pencil"></i></a>
                                                    
                                            </td>
                                        </tr>            
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            <?php 
                $totalcantidad = 0;
                ?>
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
						<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2><?php echo 'ENTRADAS' ?></h2>
							</header>
							<div>
								<div class="jarviswidget-editbox">
								</div>
                                <div class="widget-body" style="overflow:auto">
                                    <h4>Directas</h4>
                                    <table style="height: 100%;width:100%;">
                                        <tr style ='color:green'>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">ID En</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant. Ant</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Producto</td>
                                           
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Status</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Concepto</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;"></td>
                                        </tr>
                                        <?php 
                                        $totalgral  =  $totalcostogral = $totalutigral = 0;
                                        foreach($dataentrada as $row) {
                                            $objproductos = new Producto();
                                            $dataproducto = $objproductos->getTable($row['id_producto']);
                                            $totalcosto   = $row['totalcosto'];
                                            $total        = $row['cantidad']*$row['precio'];
                                            $utilidad     = $total - $totalcosto;
                                            $status = htmlentities($row['status']);
                                            switch ($status) {
                                                case 'BAJA':
                                                    $status = 'Cancelado';
                                                    $class  = 'cancelada';
                                                    break;
                                                case 'POR AUTORIZAR':
                                                    $class  = '';
                                                    break;
                                                default:
                                                    $class  = '';
                                                    $totalcostogral += $totalcosto;
                                                    $totalcantidad  += $row['cantidad'];
                                                    $totalgral      += $total;
                                                    $totalutigral   += $total - $totalcosto;
                                                    break;
                                            } 
                                            ?>
                                            <tr class="<?php echo $class; ?>">
                                                <td>
                                                    <a class="" href="<?php echo make_url("Entradas","view",array('id'=>$row['id_entrada'])); ?>">
                                                        <?php echo htmlentities($row['id_entrada'])?>
                                                    </a>
                                                </td>
                                                <td><?php echo htmlentities($row['cantidad_anterior']); ?></td>
                                                <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                <td><?php echo htmlentities($dataproducto['codinter']); ?></td>
                                                <td><?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                                               
                                                <td><?php echo htmlentities($row['status'])."<br>".$row['fecha_validacion']; ?></td>
                                                <td><?php echo htmlentities($row['concepto']); ?></td>
                                                <td><?php echo htmlentities($row['fecha_registro']); ?></td>
                                                <td class='borrar-td'>
                                                    
			                                        <?php $act =  $row['id_entrada_producto'].",'".$row['nombre']."',".$row['cantidad'];  ?>
                                                    <button class="btn btn-info col-xs-6"  onclick="showupdate(<?php echo $act; ?>,'Entradas')" title="Actualizar Registro"><i class="fa fa-sync"></i></button>
                                                    <?php 
                                                    if ($row['status']!='BAJA'){ ?> 
                                                            <a href="#" class="btn btn-danger" onclick="borrarregistrokardex(<?php echo $row['id_entrada_producto']?>,'Entradas')" > <i class="fas fa-ban"></i></a>

                                                    <?php 
                                                    } ?>
                                                </td>
                                            </tr>

                                        <?php
                                        } 
                                        ?>
                                    </table>
                                    <br>
                                    <h4>Traspasos Entrada</h4>
                                    <table style="height: 100%;width:100%;">
                                        <tr style ='color:green'>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">ID Tr</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant. Ant</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Origen</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Producto</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Status</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;"></td>
                                        </tr>
                                        <?php 
                                        $totalgral  =  $totalcostogral = $totalutigral =  0;
                                        foreach($datatraspasosentrada as $row) {
                                            $objproductos = new Producto();
                                            $dataproducto = $objproductos->getTable($row['id_producto']);
                                            $totalcosto   = $row['totalcosto'];
                                            $total        = $row['cantidad']*$row['precio'];
                                            $utilidad        = $total - $totalcosto;
                                            $status = htmlentities($row['status']);
                                            switch ($status) {
                                                case 'BAJA':
                                                    $status = 'Cancelado';
                                                    $class  = 'cancelada';
                                                    break;
                                                case 'POR AUTORIZAR':
                                                    $class  = '';
                                                    break;
                                                default:
                                                    $class  = '';
                                                    $totalcostogral += $totalcosto;
                                                    $totalcantidad  += $row['cantidad'];
                                                    $totalgral      += $total;
                                                    $totalutigral   += $total - $totalcosto;
                                                    break;
                                            } 
                                            ?>
                                            <tr class="<?php echo $class; ?>">
                                                <td>
                                                    <a class="" href="<?php echo make_url("Traspasos","view",array('id'=>$row['id_traspaso'])); ?>">
                                                        <?php echo htmlentities($row['id_traspaso'])?>
                                                    </a>
                                                </td>
                                                <td><?php echo htmlentities($row['cantidad_anterior']); ?></td>
                                                <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                <td><?php echo htmlentities($row['origen']); ?></td>
                                                <td><?php echo htmlentities($dataproducto['codinter']); ?></td>
                                                <td><?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                                               
                                                <td><?php echo htmlentities($row['status'])."<br>".$row['fecha_validacion']; ?></td>
                                                <td><?php echo htmlentities($row['fecha_registro']); ?></td>
                                                <td class='borrar-td'>
                                                    <?php 
                                                    if ($row['status']!='BAJA'){ ?> 
                                                        
                                                            <a href="#" class="btn btn-danger" onclick="borrar('<?php echo make_url("Traspasos","traspasoproductodelete",array('id'=>$row['id_traspaso_producto'])); ?>',<?php echo $row['id_traspaso_producto']; ?>);" > <i class="fas fa-ban"></i></a>
                                                        
                                                    <?php 
                                                    } ?>
                                                </td>
                                                
                                            </tr>

                                        <?php
                                        } 
                                        ?>
                                        <tr style ='color:green'> 
                                            <td style='font-weight:bold;'>Total:</td>
                                            <td></td>
                                            <td><strong id="totalentradas"><?php echo $totalcantidad; ?></strong></td>
                                            <td colspan="4"></td> 
                                        </tr>
                                    </table>
                
								</div>
							</div>
						</div>
					</article>
				
				</div>
            <?php  ?>

            <?php 
                $totalcantidad = 0;
                ?>
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
						<div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2><?php echo 'SALIDAS';  ?></h2>
							</header>
							<div>
								<div class="jarviswidget-editbox">
								</div>
                                <div class="widget-body" style="overflow:auto">
                                    <h4>Ventas</h4>
									<table id="" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
                                            <tr style ='color:red'>
												<th class = "col-md-1" data-class="phone,tablet"> No. Folio</th>
												<th class = "col-md-1" data-class="phone,tablet">Cant.</th>
												<th class = "col-md-1" data-class="phone,tablet">Codigo </th>
												<th class = "col-md-1" data-class="phone,tablet">Precio</th>
												<th class = "col-md-1" data-class="phone,tablet">Cliente</th>
												<th class = "col-md-1" data-class="phone,tablet">Usuario</th>
												<th class = "col-md-1" data-class="phone,tablet">Tienda</th>
												<th class = "col-md-1" data-class="phone,tablet">Precio</th>
												<th class = "col-md-1" data-class="phone,tablet">Fecha</th>
												<th class = "col-md-1" data-class="phone,tablet">Obs</th>
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
                                                            $totalcantidad += $row['cantidad'];
														}
														?>
                                                        <tr <?php echo $class;?>>
                                                            
															<td>
																<a class="" href="<?php echo make_url("Ventas","view",array('id'=>$row['id_venta'])); ?>">
																	<?php echo htmlentities($row['folio'])?>
																</a>
															</td>
															<td><?php echo htmlentities($row['cantidad'])?></td>
															<td><?php echo htmlentities($row['codinter'])?></td>
															
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
                                                            <td><?php echo htmlentities($row['comentarios']);
                                                                if($row['fecha_cancelacion']){
                                                                    echo "<br>Cancelacion:";
                                                                    echo $row['fecha_cancelacion'].' / '.$row['usuario_cancelacion'];
                                                                    echo "<br>".$row['razon_cancelacion'];

                                                                }
                                                            ?></td>
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
																			<?php } ?>
																			<li class="divider"></li>
																			<li>
																				<a href="#" title="Cancelar Producto" id="cancelar_venta<?php echo $row['id_productos_venta']; ?>" idpventa='<?php echo $row['id_productos_venta']; ?>' folio='<?php echo $row['nombre']; ?>' class="deleteventa">Cancelar Producto</a>
																			</li>
																		<?php 
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
                                    <h4>Traspasos Salida</h4>
                                    <table style="height: 100%;width:100%;">
                                       
                                        <tr style ='color:red'>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">ID Tr</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant. Ant</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Destino</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Producto</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Status</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;"></td>
                                        </tr>
                                        <?php 
                                        $totalgral  =  $totalcostogral = $totalutigral  = 0;
                                        foreach($datatraspasossalida as $row) {
                                            $objproductos = new Producto();
                                            $dataproducto = $objproductos->getTable($row['id_producto']);
                                            $totalcosto   = $row['totalcosto'];
                                            $total        = $row['cantidad']*$row['precio'];
                                            $utilidad        = $total - $totalcosto;
                                            $status = htmlentities($row['status']);
                                            switch ($status) {
                                                case 'BAJA':
                                                    $status = 'Cancelado';
                                                    $class  = 'cancelada';
                                                    break;
                                                case 'POR AUTORIZAR':
                                                    $class  = '';
                                                    break;
                                                default:
                                                    $class  = '';
                                                    $totalcostogral += $totalcosto;
                                                    $totalcantidad  += $row['cantidad'];
                                                    $totalgral      += $total;
                                                    $totalutigral   += $total - $totalcosto;
                                                    break;
                                            } 
                                            ?>
                                            <tr class="<?php echo $class; ?>">
                                                <td>
                                                    <a class="" href="<?php echo make_url("Traspasos","view",array('id'=>$row['id_traspaso'])); ?>">
                                                        <?php echo htmlentities($row['id_traspaso'])?>
                                                    </a>
                                                </td>
                                                <td><?php echo htmlentities($row['cantidad_anterior']); ?></td>
                                                <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                <td><?php echo htmlentities($row['destino']); ?></td>
                                                <td><?php echo htmlentities($dataproducto['codinter']); ?></td>
                                                <td><?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                                               
                                                <td><?php echo htmlentities($row['status'])."<br>".$row['fecha_validacion']; ?></td>
                                                <td><?php echo htmlentities($row['fecha_registro']); ?></td>
                                                <td class='borrar-td'>
                                                    <?php 
                                                    if ($row['status']!='BAJA'){ ?> 
                                                        
                                                            <a href="#" class="btn btn-danger" onclick="borrar('<?php echo make_url("Traspasos","traspasoproductodelete",array('id'=>$row['id_traspaso_producto'])); ?>',<?php echo $row['id_entrada_producto']; ?>);" > <i class="fas fa-ban"></i></a>
                                                        
                                                    <?php 
                                                    } ?>
                                                </td>
                                            </tr>

                                        <?php
                                        } 
                                        ?>
                                    </table>
                                    <br>
									<h4>Directas</h4>
                                    <table style="height: 100%;width:100%;">
                                        <tr style ='color:red'>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">ID Sal</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Producto</td>
                                           
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Status</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                            <td colspan="" style="background-color:#d0d0cf; font-weight:bold;"></td>
                                        </tr>
                                        <?php 
                                        $totalgral  =  $totalcostogral = $totalutigral = 0;
                                        foreach($datasalidas as $row) {
                                            $objproductos = new Producto();
                                            $dataproducto = $objproductos->getTable($row['id_producto']);
                                            $totalcosto   = $row['totalcosto'];
                                            $total        = $row['cantidad']*$row['precio'];
                                            $utilidad     = $total - $totalcosto;
                                            $status = htmlentities($row['status']);
                                            switch ($status) {
                                                case 'BAJA':
                                                    $status = 'Cancelado';
                                                    $class  = 'cancelada';
                                                    break;
                                                case 'POR AUTORIZAR':
                                                    $class  = '';
                                                    break;
                                                default:
                                                    $class  = '';
                                                    $totalcostogral += $totalcosto;
                                                    $totalcantidad  += $row['cantidad'];
                                                    $totalgral      += $total;
                                                    $totalutigral   += $total - $totalcosto;
                                                    break;
                                            } 
                                            ?>
                                            <tr class="<?php echo $class; ?>">
                                                <td>
                                                    <a class="" href="<?php echo make_url("Salidas","view",array('id'=>$row['id_salida'])); ?>">
                                                        <?php echo htmlentities($row['id_salida'])?>
                                                    </a>
                                                </td>
                                                <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                <td><?php echo htmlentities($dataproducto['codinter']); ?></td>
                                                <td><?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                                               
                                                <td><?php echo htmlentities($row['status'])."<br>".$row['fecha_validacion']; ?></td>
                                                
                                                <td><?php echo htmlentities($row['fecha_registro']); ?></td>
                                                <td class='borrar-td'>
                                                    <?php 
                                                    if ($row['status']!='BAJA'){ ?> 
                                                            <a href="#" class="btn btn-danger" onclick="borrarregistrokardex('<?php echo $row['id_salida_producto']; ?>','Salidas');" > <i class="fas fa-ban"></i></a>
                                                    <?php 
                                                    } ?>
                                                </td>
                                                
                                            </tr>

                                        <?php
                                        } 
                                        ?>
                                         <tr style ='color:red'>  
                                            <td style='font-weight:bold;'>Total:</td>
                                          
                                            <td><strong  id="totalsalidas"><?php echo $totalcantidad; ?></strong></td>
                                            <td colspan="4"></td> 
                                        </tr>
                                    </table>
                                    <br>
								</div>
							</div>
						</div>
					</article>
				
				</div>
			<?php ?>
            </section>
        </div>
    </div>
</div>
<!-- END MAIN PANEL -->
<div class="modal fade" id="showPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Visor de Imagenes</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/superbox/superbox.min.js"></script>

<script>
    function borrarregistrokardex(id,tipo){ 
        swal({
            title: "Estas seguro?",
            text: "Deseas eliminar este registro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Si, Eliminar!',
            closeOnConfirm: true
            },
            function(){
                var url = config.base+"/"+tipo+"/ajax/?action=get&object=deleteonlydecrement"; 
                $.ajax({
                    type: "GET",
                    url: url,
                    data: 'id='+id, 
                    success: function(response){
                        var data = $.parseJSON(response); 
                        console.log(data);
                        if(!data.error){
                            swal("Eliminado!", "Eliminado con exito!", "Exito");
                            
                            location.reload();
                        }else{
                            return notify('error',"Oopss error al Eliminar:"+data.response);
                        }
                    }
                    });
                return false; // Evitar ejecutar el submit del formulario.
                
            }
        );
    }
    $(document).ready(function() {
        showupdate = function(id,producto,existencia,tipo){
			
			$.SmartMessageBox({
				title : "Actualizar: "+producto,
				content : "Cantidad Actual: "+existencia,
				buttons : '[No][Yes]',
				input : "text",
				placeholder : "Nueva Cantidad"
			}, function(ButtonPressed, Value) {
				if (ButtonPressed === "Yes") {
					if(!Value) return notify('warning','Se necesita una cantidad');
					
					$.ajax({
						type: "POST",
						url: config.base+"/"+tipo+"/ajax/?action=post&object=updateexisencias",
						data: "id="+id+"&existencia="+Value,
						success: function(response){
							if(response>0){
								swal('Actualizado con exito');
                                location.reload();
							}else{
								return notify('error','Error al actualizar');
							}
						}
					});
				}
			});
			$('#txt1').val(existencia);
			return false;
		}
        
      var kardex =Math.abs(parseInt($('#totalentradas').html()-$('#totalsalidas').html()));
      console.log(kardex);
      var diferencia =parseInt($('#totalexistencia').html()-kardex);
        $('#totalkardex').html(kardex);
        if(diferencia!=0){
            diferencia = "<span style = 'color:red'>"+diferencia+"</span>";
        }
        $('#totaldiferencia').html(diferencia);

       
        /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */
         pageSetUp();

    })

</script>

<?php
    
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>

