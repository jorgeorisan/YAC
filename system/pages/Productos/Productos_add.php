<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Productos Alta";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
include(SYSTEM_DIR . "/inc/nav.php");
if(isPost()){
    $obj = new Producto();
    if(!$obj->existeProducto($_POST['codinter'])){
        $id=$obj->addAll(getPost());
        if($id>0){
            //nuevas imagenes
            if (isset($_FILES['imagen'])){
                $carpetaimg = PRODUCTOS.'/images';
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpetaimg."/".$id."_".$_POST['codinter'].'.png');
                $request['imagen']=$id."_".$_POST['codinter'].'.png';
                $id = $obj->updateAll($id,$request);
                if( $id >0  ) {
                    informSuccess(true, make_url("Productos","view",array('id'=>$id)));
                }else{
                    informError(true, make_url("Productos","edit",array('id'=>$id)),"edit");
                }
            }else{
                informSuccess(true, make_url("Productos","view",array('id'=>$id)));
            }
            informSuccess(true, make_url("Productos","view",array('id'=>$id)));
        }else{
            informError(true,make_url("Productos","index"));
        }
    }else{
        echo "<script>notify('warning','El codigo ya existe');</script>";
    }
}

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Producto"] = APP_URL."/Producto/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-9 col-md-9 col-lg-9"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-plus"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
								<form id="main-form" class="" role="form" method=post action="<?php echo make_url("Productos","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <div class="col-sm-6">
                                        <div class="form-group">
											<label for="name">Categoria</label>
											<select style="width:100%" class="select2" name="id_categoria" id="id_categoria">
												<?php 
												$obj = new Categoria();
												$list=$obj->getAllArr();
												if (is_array($list) || is_object($list)){
													foreach($list as $val){
														echo "<option value='".$val['id_categoria']."'>".$val['categoria']."</option>";
													}
												}
												 ?>
											</select>
                                        </div>  
                                        <div class="form-group">
											<label for="name">Seccion</label>
											<select style="width:100%" class="select2" name="id_proveedor" id="id_proveedor">
												<?php 
												$obj = new Proveedor();
												$list=$obj->getAllArr();
												if (is_array($list) || is_object($list)){
													foreach($list as $val){
                                                        $selected = ($data['id_proveedor'] == 1 ) ?  $selected = "selected" : '' ;
														echo "<option $selected value='".$val['id_proveedor']."'>".$val['nombre_corto']."</option>";
													}
												}
												?>
											</select>
										</div> 
                                        <div class="form-group">
											<label for="name">Marca</label>
											<select style="width:100%" class="select2" name="id_marca" id="id_marca">
												<?php 
												$obj = new Marca();
												$list=$obj->getAllArr();
												if (is_array($list) || is_object($list)){
													foreach($list as $val){
														echo "<option value='".$val['id_marca']."'>".$val['nombre']."</option>";
													}
												}
												?>
											</select>
                                        </div>  
                                        <div class="form-group">
											<label for="name">Es un Paquete</label>
											<select style="width:20%" class="select2" name="id_usuario_tipo" id="id_usuario_tipo">
                                                <option value="0">No</option>
                                                <option value="1">Si</option>
											</select>
                                        </div>
                                        <div class="form-group">
											<label for="name">Precio Editable</label>
											<select style="width:20%" class="select2" name="manual" id="manual">
                                                <option value="0">No</option>
                                                <option value="1">Si</option>
											</select>
                                        </div>
                                        <div class="form-group">
											<label for="name">Imagen</label>
											<input type="file" id="imagen" name="imagen" title="Imagen">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-sm-12" style="padding:0px">
                                            <div class="col-sm-6" style="padding:0px" >
                                                <div class="form-group">
                                                    <label for="name">Codigo de Barras</label>
                                                    <input type="text" class="form-control" id="codbarras" name="codbarras" placeholder="Codigo de Barras" onkeypress="nextFocus('codbarras', 'codigo')">
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="padding:0px;padding-left: 10px;">
                                                <div class="form-group">
                                                    <label class="name">Codigo </label>
                                                    <input type="text" required class="form-control" id="codigo" name="codinter" placeholder="Codigo" onkeypress="nextFocus('codigo', 'nombre')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
											<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" onkeypress="nextFocus('nombre', 'costo')">
										</div>
                                        <div class="form-group">
											<label class="name">Costo </label>
											<input type="number" class="form-control" id="costo" name="costo" value="0" placeholder="Costo" onkeypress="nextFocus('costo', 'precio_descuento')">
                                        </div>
                                        <div class="col-sm-12" style="padding:0px">
                                            <div class="col-sm-6" style="padding:0px">
                                                <div class="form-group">
                                                    <label class="name"> Precio Mayoreo</label>
                                                    <input type="number" class="form-control" id="precio_descuento" value="0" name="precio_descuento" placeholder="Precio Mayoreo" onkeypress="nextFocus('precio_descuento', 'precio')">
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="padding:0px;padding-left: 10px;">
                                                <div class="form-group">
                                                    <label class="name"> Precio</label>
                                                    <input type="number" class="form-control" id="precio" value="0" name="precio" placeholder="Precio" onkeypress="nextFocus('precio', 'savenewproducto')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions" style="text-align: center">
                                        <div class="row">
                                           <div class="col-md-12">
                                                <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                                    Cancelar
                                                </button>
                                                <button class="btn btn-primary btn-md" id='savenewproducto' type="button" onclick=" validateForm();">
                                                    <i class="fa fa-save"></i>
                                                    Guardar
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
        </div>
    </div>
</div>
<!-- END MAIN PANEL -->

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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
    function nextFocus(inputF, inputS) {
        document.getElementById(inputF).addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
            document.getElementById(inputS).focus();
            }
        });
    }
    function existeproducto(codigo, callback){
        if ( ! codigo ) return;
        $.get(config.base+"/Productos/ajax/?action=get&object=existeproducto&codigo=" + codigo, null, function (response) {
        		if ( response == 1){
					$("#codigo").val('');
					notify('warning', 'Este codigo ya existe favor de intentar con otro');
					return false;
				}else{
					if(callback){
						try { callback(); }
						catch(err) {
                        	console.log(err.message);
                    	}
					}
				}     
        });
	}
    function validateForm(){
        var id_categoria = $("#id_categoria").val();
        if ( ! id_categoria )  return notify("info","La categoria es requerida");
        var id_proveedor = $("#id_proveedor").val();
        if ( ! id_proveedor )  return notify("info","La Seccion es requerida");
        var id_marca = $("#id_marca").val();
        if ( ! id_marca )  return notify("info","La marca es requerida");
        var codigo = $("input[name=codinter]").val();
        if ( ! codigo )  return notify("info","El codigo es requerido");
        var nombre = $("input[name=nombre]").val();
        if ( ! nombre )  return notify("info","El nombre es requerido");
        existeproducto(codigo,function(){
			    $("#main-form").submit();		
			});        
    }
    $(document).ready(function() {
        $("#costo").keyup(function (e){
            var precio = (parseFloat($(this).val())*  1.5);
            var preciod = (parseFloat($(this).val())*  1.3 );
            var precioc = (parseFloat($(this).val())*  1.1 );
            $("#precio").val(precio.toFixed(2));
            $("#precio_descuento").val(preciod.toFixed(2));
            $("#precio_costo").val(precioc.toFixed(2));

        });
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
