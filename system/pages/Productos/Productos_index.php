
<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Productos";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$all= (isset($request['params']['opt'])) ?  true : false;

$obj = new Producto();
$data = $obj->getAllArr(false,false,false, $all );

//print_r($data);
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php include(SYSTEM_DIR . "/inc/ribbon.php"); ?>

	<!-- MAIN CONTENT -->
	<div id="content">
		<section id="widget-grid" class="">
			 <p><a class="btn btn-success" href="<?php echo make_url("Productos","add")?>" ><i class="fas fa-plus"></i> Nuevo Producto</a></p>
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
							<div class="widget-body" style="overflow:auto">
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th class = "col-md-1" data-class="expand"> ID</th>
											<th class = "col-md-1" data-hide=""> Codigo</th>
											<th class = "col-md-1" data-hide=""> Nombre</th>
											<th class = "col-md-1" data-hide=""> Marca</th>
											<th class = "col-md-1" data-hide="phone,tablet"> Categ.</th>
											<th class = "col-md-1" data-hide="phone,tablet"> Prov.</th>
											<?php if($_SESSION['user_info']['costos']) { ?>
												<th class = "col-md-1" data-hide=""> Costo</th>
											<?php } ?>
											<th class = "col-md-1" data-hide=""> Mayoreo</th>
											<th class = "col-md-1" data-hide=""> Precio</th>
											<th class = "col-md-1" data-hide=""> Exist.</th>
											<th class = "col-md-1" data-hide="phone,tablet"> Act.</th>
											<th class = "col-md-1" data-hide="phone,tablet">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$carpetaimg = ASSETS_URL.'/productosimages/images';
										foreach($data as  $key => $row) {
										?>
											<tr>
												<td><?php echo htmlentities($row['id_producto'])?></td>
												<td><?php echo htmlentities($row['codinter'])?></td>
												<td>
													<?php 
														if($row['imagen']!=''){	?>
															<a data-toggle="modal" class="" href="#myModal" onclick="showpopupImagen(<?php echo $row['id_producto'] ?>)"><?php echo htmlentities($row['nombre'])?><br><?php echo ($row['manual']) ? 'Servicio' : '' ?></a>
															<?php
														}else{ ?>
														<?php echo htmlentities($row['nombre'])?>
															<div id='contfileproductos<?php echo $row['id_producto'] ?>'></div>
															<br><a data-toggle="modal" class="" href="#myModal" onclick="showpopupImagen(<?php echo $row['id_producto'] ?>)">Subir Imagen</a>
														
														<?php
														} ?>
												</td>
												<td><?php echo htmlentities($row['marca']) ?></td>
												<td><?php echo htmlentities($row['categoria']) ?></td>
												<td><?php echo htmlentities($row['proveedor']) ?></td>
												<?php if($_SESSION['user_info']['costos']) { ?>
													<td><?php echo htmlentities($row['costo']) ?></td>
												<?php } ?>
												<td><?php echo htmlentities($row['preciomayoreo']) ?></td>
												<td><?php echo htmlentities($row['precio']) ?></td>
												<td>
													<div  id='contexistencias<?php echo $row['id_producto'] ?>'>
														<?php echo htmlentities($row['existenciastienda'].'/'.$row['existencias']) ?>
													</div>
												</td>
												
												<td style="font-size:10px">
													<div  id='contactualizaciones<?php echo $row['id_producto'] ?>'>
													<?php 
														if($row['fecha_actualizacion']){ 
															echo date('Y-m-d H:i',strtotime($row['fecha_actualizacion']))."<br>".htmlentities($row['usuario_actualizacion']);
														}
													?>
													</div>
													<?php 
													if($row['fecha_actualizacion']){ 
														?>
														<br><a data-toggle="modal" class="" href="#myModal" onclick="showpopupHistorial(<?php echo $row['id_producto'] ?>)">Historial</a>
														<?php 
													} 
													?>
													
												</td>
												<td>
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Accion <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a href="#" title="Actualizar Producto" onclick="showupdate(<?php echo $row['id_producto']; ?>,'<?php echo $row['nombre']; ?>',<?php echo $row['existenciastienda'];?>,<?php echo $row['existencias'];?>)">
																Actualizar</a>
															</li>
															<li>
																<a class="" href="<?php echo make_url("Productos","view",array('id'=>$row['id_producto'])); ?>">Ver</a>
															</li>
															<li>
																<a class="" href="<?php echo make_url("Productos","edit",array('id'=>$row['id_producto'])); ?>">Editar</a>
															</li>
															
															<li class="divider"></li>
															<li>
																<a href="#" class="red" onclick="borrar('<?php echo make_url("Productos","productodelete",array('id'=>$row['id_producto'])); ?>',<?php echo $row['id_producto']; ?>);">Eliminar</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
										<?php }?>
									</tbody>
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="100" alt="SmartAdmin">
                    <div id='titlemodal' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> </span>
                    </div>
                    
                </h4>
            </div>
            <div class="modal-body no-padding" >
                <div id="contentpopup" style="text-align:center">

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>

<script>

	$(document).ready(function() {
		
	
		$('#dt_basic').dataTable();
		showpopupHistorial = function(id){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i>Historial Actualizaciones</span>');
            $.get(config.base+"/Productos/ajax/?action=get&object=showpopupHistorial&id="+id, null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario de pacientes');
                        
                    }     
            });
            return false;
        }
		showpopupImagen = function(id){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i>Imagen</span>');
            $.get(config.base+"/Productos/ajax/?action=get&object=showpopupImagen&id="+id, null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario');
                        
                    }     
            });
            return false;
        }
		showupdate = function(idproducto,producto,existenciatienda,existencia){
			
			$.SmartMessageBox({
				title : "Actualizar: "+producto,
				content : "Existencia Actual: "+existenciatienda,
				buttons : '[No][Yes]',
				input : "text",
				placeholder : "Nueva Existencia"
			}, function(ButtonPressed, Value) {
				if (ButtonPressed === "Yes") {
					if(!Value) return notify('warning','Se necesita un motivo');
					
					$.ajax({
						type: "POST",
						url: config.base+"/Productos/ajax/?action=post&object=updateexisencias",
						data: "idproducto="+idproducto+"&existencia="+Value+"&existenciaant="+existenciatienda,
						success: function(response){
							if(response>0){
								var fecha    = new Date();
								var minutos     = fecha.setMinutes(fecha.getMinutes() + 60);
								var nuevafecha  = fecha.getFullYear() + '-' + ("0"+(fecha.getMonth()+1)).slice(-2) + '-' + ("0" + fecha.getDate()).slice(-2) +' ' + ("0" + fecha.getHours()).slice(-2) + ":" +("0" + fecha.getMinutes()).slice(-2);
								$('#contactualizaciones'+idproducto).html(nuevafecha);
								$('#contexistencias'+idproducto).html(Value+"/"+existencia);
								notify('success','Actualizado con exito');
							}else{
								return notify('error','Error al actualizar');
							}
						}
					});
				}
			});
			$('#txt1').val(existenciatienda);
			return false;
		}
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
