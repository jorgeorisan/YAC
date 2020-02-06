
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
$arrayfilters['todo'] = $all;
$arrayfilters['page'] = 'productos';

$arrayfilters['id_categoria'] = (isset($_GET['id_categoria'])) ? $_GET['id_categoria'] : '';
$arrayfilters['id_marca']     = (isset($_GET['id_marca'])) ? $_GET['id_marca'] : '';
$jsonarrayfilters=json_encode($arrayfilters);
//print_r($data);
$totalproductos   = count(getAllProductos());
$filters = (isset($_GET['id_categoria'])) ? "&id_categoria=".$_GET['id_categoria'].'&id_marca='.$_GET['id_marca']:'';
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
												<div class="col-sm-6">
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
												<div class="col-sm-6">
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
												<div class="card-controls">
													<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
														<div class="card-input tabulator-filter">
															<input type="text" class="form-control form-control-sm d-none d-md-inline-block" placeholder="Buscar Producto">
														</div>
													</div>
													<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
														<input type="number" id="size" class="form-control form-control-sm d-none d-md-inline-block" placeholder="Filtrar" value="10">
													</div>
												</div>
												

											</form>
										</div>
									
									</div>
									<div id="example-table"></div>
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

<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/node_modules/jquery.tabulator/dist/css/bootstrap/tabulator_bootstrap.min.css">
<script src="<?php echo ASSETS_URL; ?>/node_modules/jquery.tabulator/dist/js/tabulator.js"></script>
<script>
	
	$(document).ready(function() {
		
		$('body').on('click', '#saveproduct', function(){
			saveproduct(this);
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
		// Filters
		 $('.tabulator-filter input').on('keyup', function(){
			$("#example-table").tabulator(
				"setFilter", 'nombre', 'like', $(this).val(),
				"setFilter", 'codinter', 'like', $(this).val(),
				"setFilter", 'marca', 'like', $(this).val(),
				"setFilter", 'categoria', 'like', $(this).val(),
			);
		});
		
		// Formatter
        var productos_action = function(cell, formatterParams) {
            data   			   = cell.getRow().getData();
            id     			   = data['id_producto'];
            nombre 			   = data['nombre'];
			existenciastienda  = data['existenciastienda'];
			existencias        = data['existencias'];

			view_link  = edit_link = delete_link  = '';
			
			view_link   = config.base+"/Productos/view/?id="+id;
			edit_link   = config.base+"/Productos/edit/?id="+id;
			delete_link = "'"+config.base+"/Productos/productodelete/?id="+id+"'";
			
			act = id+",'"+nombre+"',"+existenciastienda+","+existencias;
			
            html = '<div class="btn-group">'+
						'<button class="btn btn-default col-xs-6"  onclick="showupdate('+act+')" title="Actualizar Producto"><i class="fa fa-sync fa-spin"></i></button>'+
						'<a href='+view_link+'> <button class="btn btn-default col-xs-6" title="Ver"><i class="fa fa-eye"></i></button></a>'+
						'<a href='+edit_link+'> <button class="btn btn-default col-xs-6" title="Editar"><i class="fa fa-pencil"></i></button></a>'+
						'<button class="btn btn-default col-xs-6"  onclick="borrar('+delete_link+','+id+')" title="Eliminar"><i class="fa fa-times"></i></button>'+
					'</div>';

            return html;
		};
		var act_formatter = function(cell, formatterParams) {
			data  = cell.getRow().getData();
			fecha = data['fecha_actualizacion'];
			user  = data['usuario_actualizacion'];
			id    = data['id_producto'];
			datos = (fecha) ? fecha + ' <br> ' + user : '';
			html ='<div id="contactualizaciones'+id+'">'+datos+'</div>'+
				'<a data-toggle="modal" class="" href="#myModal" onclick="showpopupHistorial('+id+')">Historial</a><br>';
			
												
			return html;
		};
		var categoria_formatter = function(cell, formatterParams) {
			data  = cell.getRow().getData();
			categoria = data['categoria'];
			id    = data['id_producto'];
			
			return html ='<div id="contcategoria'+id+'">'+categoria+'</div>'+
				'<a data-toggle="modal" class="" href="#myModal" onclick="showpopupEditar('+id+')">Editar</a>';
		};

		var codinter_formatter = function(cell, formatterParams) {
			data  = cell.getRow().getData();
			codinter = data['codinter'];
			id    = data['id_producto'];
			
			return html ='<div class="registros" idprod="'+id+'" id="contcodinter'+id+'">'+codinter+'</div>';
		};
		var preciomayoreo_formatter = function(cell, formatterParams) {
			data  = cell.getRow().getData();
			preciomayoreo = data['preciomayoreo'];
			id    = data['id_producto'];
			
			return html ='<div id="contpreciomayoreo'+id+'">'+preciomayoreo+'</div>';
		};
		var precio_formatter = function(cell, formatterParams) {
			data  = cell.getRow().getData();
			precio = data['precio'];
			id    = data['id_producto'];
			
			return html ='<div id="contprecio'+id+'">'+precio+'</div>';
		};
		var costo_formatter = function(cell, formatterParams) {
			data  = cell.getRow().getData();
			costo = data['costo'];
			id    = data['id_producto'];
			
			return html ='<div id="contcosto'+id+'">'+costo+'</div>';
		};
		var marca_formatter = function(cell, formatterParams) {
			data  = cell.getRow().getData();
			marca = data['marca'];
			id    = data['id_producto'];
			return html ='<div id="contmarca'+id+'">'+marca+'</div>';
		};
	
		var exist_formatter = function(cell, formatterParams) {
			data               = cell.getRow().getData();
			existenciastienda  = data['existenciastienda'];
			id 				   = data['id_producto'];
			existencias        = data['existencias'];
			kardex        	   = data['kardex'];
			title              = '<div  id="contexistencias'+id+'">'+ existenciastienda + '/' + existencias+'</div>'+
				'<a tarjet="_blank" href="'+config.base+"/Productos/kardex/?id="+id+'"  ><div id="kardex'+id+'">KARDEX='+kardex+'</div></a>';
			
			return title;
		};
		var name_formatter = function(cell, formatterParams) {
			data         = cell.getRow().getData();
			imagen 		 = data['imagen'];
			id  		 = data['id_producto'];
			manual 		 = data['manual'];
			nombre       = data['nombre'];
			
			if(manual==1){ nombreimage  = data['nombre']+'<br>Servicio'; }else{ nombreimage  = data['nombre']; } 
			html = '';
			if(imagen){
				html = '<br><a data-toggle="modal" href="#myModal" onclick="showpopupImagen('+id+')">'+'<div id="contnombre'+id+'">'+nombreimage+'</div>'+'</a>';
			}else {
				html = '<div id="contnombre'+id+'">'+nombreimage+'</div>'+'<div id="contfileproductos'+id+'"></div>'+
				'<br><a data-toggle="modal" class="" href="#myModal" onclick="showpopupImagen('+id+')">Subir Imagen</a>';
			}
			
			return html;
		};
		
		try{ 
			//si es telefono
			document.createEvent("TouchEvent"); 
			var modopantalla='fitDataFill'; // muestra todos los campos
		}catch(e){ 
			var modopantalla='fitColumns'; // muestra todos los campos compactados
			var modopantalla='fitDataFill'; // muestra todos los campos compactados
		}
		
		var table = $("#example-table").tabulator({
			//layout: "fitDataFill",
			layout: modopantalla,
            pagination:"remote",
            paginationSize:$('#size').val(),
            ajaxURL: config.base+"/Productos/ajax/?action=get&object=getproductos<?php echo $filters  ;?>&totalproductos=<?php echo $totalproductos  ;?>",
            placeholder: "No Data Available",
			initialSort: [{column:"codinter", dir:"desc"}],
			ajaxFiltering: true,
			movableColumns:true,
			columns: [
                { title: "ID",  field: "id_producto",  align: "left", sorter: "string" },
				{ title: "Codigo", formatter:  codinter_formatter,  align: "left", sorter: "string" },
				{ title: "Nombre", formatter:  name_formatter, align: "left",width:250, sorter: "string" },
				{ title: "Marca", align: "left", formatter: marca_formatter, sorter: "string" },
				{ title: "Cate", align: "left", sorter: "string", formatter: categoria_formatter },
				<?php if($_SESSION['user_info']['costos']) { ?>
					{ title: "Costo", formatter:  costo_formatter, align: "left", sorter: "string" },
				<?php } ?>
				{ title: "Mayoreo", formatter:  preciomayoreo_formatter, align: "left", sorter: "string" },
				{ title: "Precio", formatter:  precio_formatter, align: "left", sorter: "string" },
				{ title: "Exist",  formatter: exist_formatter, align: "left", sorter: "string" },
				{ title: "Act",  align: "left", sorter: "string", formatter: act_formatter,width:100  },
				{ title: "Actions", width: 95, sorter: 'number', formatter: productos_action, sortable: false, headerSort: false }
			],
            pageLoaded: function(data){ 
				
			 }
		});

		// $(".tabulator").tabulator("setSort", "reg", "desc");

		$("#action").click(function(){
			console.log("html", $(".tabulator").tabulator("getHtml"))
			$("#html-table").html($(".tabulator").tabulator("getHtml"))
		});
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
