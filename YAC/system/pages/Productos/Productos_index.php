
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

$all = (isset($_GET['id_categoria'])) ?  true : false;

$obj = new Producto();
$arrayfilters['todo'] = 1;
$arrayfilters['page'] = 'productos';

$arrayfilters['id_categoria'] = (isset($_GET['id_categoria'])) ? $_GET['id_categoria'] : '';
$arrayfilters['id_subcategoria'] = (isset($_GET['id_subcategoria'])) ? $_GET['id_subcategoria'] : '';
$arrayfilters['id_marca']     = (isset($_GET['id_marca'])) ? $_GET['id_marca'] : '';
$arrayfilters['size']     = (isset($_GET['size'])) ? $_GET['size'] : '10';
$jsonarrayfilters=json_encode($arrayfilters);
//print_r($data);
$totalproductos   = count(getAllProductos());
$data = $obj->getAllArr( $arrayfilters );
?>

<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php include(SYSTEM_DIR . "/inc/ribbon.php"); ?>

	<!-- MAIN CONTENT -->
	<div id="content">
		<section id="widget-grid" class="">
			<div class="widget-body" style='padding-bottom: 10px;'>
			 	<a class="btn btn-success" href="<?php echo make_url("Productos","add")?>" ><i class="fas fa-plus"></i> Nuevo Producto</a>
				<a class="btn btn-info" id=""  target="_blank" href="<?php echo make_url("Productos","excel",array('jsondata'=>$jsonarrayfilters))?>"  ><i class="fa fa-download"></i> &nbsp;Exportar</a>
				<a class="btn btn-info"  id='updatekardex' href="#" ><i class="fas fa-retweet"></i> Update Kardex</a>	
				
				<div style="text-align:center;display:none;"  id='loading' >
					<img  src="<?php echo ASSETS_URL; ?>/img/cargando.gif" style="height: 100px;"/><br>
					Por favor espere, estamos actualizando su informacion..
				</div>
				<div class="alert adjusted alert-info fade in msjalert" style="text-align:center;display:none;" >
					<button class="close" data-dismiss="alert">
						×
					</button>
					<div id="contentmsj"></div>
				</div>
			</div>
			<div class="row">
				<input type="hidden" value="<?php echo $_SESSION['user_info']['costos'];?>" id='show_costos'>
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
								
								<div class="card-body">
									<div class="card-heading">
										<h3 class="card-title">Productos</h3>
										<div class="row">
											<form  action="#" method="GET" id="main-form">
												<div class="col-sm-4">
													<div class="form-group">
														<label for="name">Categoria</label>
														<select style="width:100%" class="select2" name="id_categoria" id="id_categoria">
															<option>Selecciona</option>
															<?php 
															$obj = new Categoria();
															$list=$obj->getAllArr();
															if (is_array($list) || is_object($list)){
																foreach($list as $val){
																	$selected = ($arrayfilters['id_categoria']==$val['id_categoria']) ? 'selected': '';
																	echo "<option $selected  value='".$val['id_categoria']."'>".$val['categoria']."</option>";
																}
															}
																?>
														</select>
													</div>  
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label for="name">Sub Categoria</label>
														<select style="width:100%" class="select2" name="id_subcategoria" id="id_subcategoria">
															<option>Selecciona</option>
															<?php 
															$obj = new Subcategoria();
															$list=$obj->getAllArr();
															if (is_array($list) || is_object($list)){
																foreach($list as $val){
																	$selected = ($arrayfilters['id_subcategoria']==$val['id_subcategoria']) ? 'selected': '';
																	echo "<option $selected  value='".$val['id_subcategoria']."'>".$val['nombre_subcategoria']."</option>";
																}
															}
																?>
														</select>
													</div>  
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label for="name">Marca</label>
														<select style="width:100%" class="select2" name="id_marca" id="id_marca">
															<option>Selecciona</option>
															<?php 
															$obj = new Marca();
															$list=$obj->getAllArr();
															if (is_array($list) || is_object($list)){
																foreach($list as $val){
																	$selected = ($arrayfilters['id_marca']==$val['id_marca']) ? 'selected': '';
																	echo "<option $selected value='".$val['id_marca']."'>".$val['nombre']."</option>";
																}
															}
															?>
														</select>
													</div>    
												</div>
												<div class="col-sm-6" style="padding: 10px">
													<a class="btn btn-info" id="buscar" ><i class="fas fa-search"></i>Buscar</a>
													
												</div>
												
												

											</form>
										</div>
									
									</div>
									<div id="">
										
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>
												<tr>
													<th class = "col-md-1" data-hide="phone,tablet"> ID</th>
													<th class = "col-md-1" data-class="expand">Codigo: Nombre</th>
													<th class = "col-md-1" data-class="phone,tablet">Marca</th>
													<th class = "col-md-1" data-class="phone,tablet">Cate</th>
													<th class = "col-md-1" data-class="phone,tablet">SubCate</th>
													<?php if($_SESSION['user_info']['costos']) { ?>
														
														<th class = "col-md-1" data-class="phone,tablet">Costo </th>
													<?php } ?>
													<th class = "col-md-1" data-class="phone,tablet">Mayoreo </th>
													<th class = "col-md-1" data-hide="phone,tablet">Precio</th>
													<th class = "col-md-1" data-class="phone,tablet">Exist</th>
													<th class = "col-md-1" data-hide="phone,tablet">Act</th>
													<th class = "col-md-1" data-class="phone,tablet"></th>
												</tr>
												
											</thead>
											<tbody>
												<?php 
												$carpetaimg = ASSETS_URL.'/productosimages/images';
												foreach($data as  $key => $row) {
													$tienda = new Tienda();
													$imagen 	 = $row['imagen'];
													$id  		 = $row['id_producto'];
													$manual 	 = $row['manual'];
													$nombre      = $row['nombre'];
													$codinter    = $row['codinter'];
													$codinter 	 ='<div class="registros" style="float: left;" idprod="'.$id.'" id="contcodinter'.$id.'">'.$codinter.':</div>';
													
													$nombreimage  = ($manual==1) ? $row['nombre'].'<br>Servicio' :  $row['nombre']; 
													$htmlnombre = '';
													if($imagen){
														$htmlnombre = '<br><a data-toggle="modal" href="#myModal" onclick="showpopupImagen('.$id.')">'. $codinter.'<div id="contnombre'.$id.'">'.$nombreimage.'</div></a>';
													}else {
														$htmlnombre = $codinter.'<div id="contnombre'.$id.'">'.$nombreimage.'</div>'.'<div id="contfileproductos'.$id.'"></div>'.
														'<br><a data-toggle="modal" class="" href="#myModal" onclick="showpopupImagen('.$id.')">Subir Imagen</a>';
													}
												?>
													<tr>
														<td><?php echo htmlentities($row['id_producto'])?></td>
														<td><?php echo $htmlnombre?></td>
														<td><?php echo htmlentities($row['marca']) ?></td>
														<td>
															<div id="contcategoria<?php echo $id ?>"><?php echo $row['categoria'] ?></div>
																<a data-toggle="modal" class="" href="#myModal" onclick="showpopupEditar(<?php echo $id ?>)">Editar</a>
															
														</td>
														<td>
															<div id="contsubcategoria<?php echo $id ?>"><?php echo $row['subcategoria'] ?></div>
																<a data-toggle="modal" class="" href="#myModal" onclick="showpopupEditar(<?php echo $id ?>)">Editar</a>
															
														</td>
														<?php if($_SESSION['user_info']['costos']) { ?>
															<td><div id="contcosto<?php echo $id ?>"><?php echo htmlentities($row['costo']) ?></div></td>
														<?php } ?>
														<td><div id="contpreciomayoreo<?php echo $id ?>"><?php echo htmlentities($row['preciomayoreo']) ?></div></td>
														<td><div id="contprecio<?php echo $id ?>"><?php echo htmlentities($row['precio']) ?></div></td>
														<td>
															<div  id='contexistencias<?php echo $row['id_producto'] ?>'>
																<?php echo htmlentities($row['existenciastienda'].'/'.$row['existencias']) ?>
															</div>
															<a tarjet="_blank" href="<?php echo APP_URL.'/Productos/kardex/?id='.$id; ?>"  ><div id="kardex<?php echo $id ?>">KARDEX</div></a>
														
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
																		<a href="#" class="red" onclick="borrar('<?php echo APP_URL.'/Productos/productodelete/?id='.$id; ?>' ,<?php echo $id; ?>);">Eliminar</a>
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
<div class="modal fade" id="myModal" tabindex="" role="dialog">
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

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script>
	
	$(document).ready(function() {
		
		$('body').on('click', '#saveproduct', function(){
			saveproduct(this);
		});
		$('body').on('click', '#updatekardex', function(){
			$("#loading").show();
			var url = config.base+"/Productos/ajax/?action=get&object=updatekardex"; 
			$.ajax({
				type: "POST",
				url: url,
				data: $(event).parents('form:first').serialize(), 
				success: function(response){
					//swal("Exito al actualizar:"+response);
					
					$("#loading").hide();
					$(".msjalert").show(response);
					$("#contentmsj").html(response);
				}
			});
			return false; // Evitar ejecutar el submit del formulario.
		});
		saveproduct = function(event){
			var url = config.base+"/Productos/ajax/?action=post&object=updateproducto"; 
			$.ajax({
				type: "POST",
				url: url,
				data: $(event).parents('form:first').serialize(), 
				success: function(response){
					var data = $.parseJSON(response); 
					if(data.status){
						var producto = $.parseJSON(data.response);
						//console.log(producto);
						
						//$('#myModal').modal('hide');
						$('.modal').hide();
						$('.modal-backdrop').hide();
						cate = producto.categoria;
						
						$('#contcategoria'+producto.id_producto).html(producto.categoria);
						$('#contmarca'+producto.id_producto).html(producto.marca);
						$('#contnombre'+producto.id_producto).html(producto.nombre);
						$('#contcodinter'+producto.id_producto).html(producto.codinter);
						$('#contprecio'+producto.id_producto).html(producto.precio);
						$('#contpreciomayoreo'+producto.id_producto).html(producto.precio_descuento);
						$('#contcosto'+producto.id_producto).html(producto.costo);
						
						notify('success',"Exito al actualizar:"+producto.id_producto);
						return false;
						//location.reload();
					}else{
						return notify('error',"Oopss error al Actualizar:"+data.response);
					}
				}
				});
			return false; // Evitar ejecutar el submit del formulario.
		}
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
		showpopupEditar = function(id){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i>Editar Producto</span>');
            $.get(config.base+"/Productos/ajax/?action=get&object=showpopupEditar&id="+id, null, function (response) {
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

		//define table
		$('#dt_basic').dataTable();
		
		

		// $(".tabulator").tabulator("setSort", "reg", "desc");

		$("#buscar").click(function(){
			$("#main-form").submit();
			
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
