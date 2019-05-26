<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Editar producto";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
include(SYSTEM_DIR . "/inc/nav.php");
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Productos","index"));

$obj = new Producto();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Productos","index"));
}
if(isPost()){
    $obj = new Producto();
    $id = $obj->updateAll($id,getPost());
    if( $id >0  ) {
        //nuevas imagenes
        if (isset($_FILES['imagen']) && isset($data['imagen'])){
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
        
    }else{
        exit;
        informError(true, make_url("Productos","edit",array('id'=>$id)),"edit");
    }
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
								<form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Productos","edit",array('id'=>$id))?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <div class="col-sm-6">
                                        <div class="form-group">
											<label for="name">Categoria</label>
											<select style="width:100%" class="select2" name="id_categoria" id="id_categoria">
												<?php 
												$obj = new Categoria();
												$list=$obj->getAllArr();
												if (is_array($list) || is_object($list)){
													foreach($list as $val){
                                                        $selected = ($data['id_categoria']  == $val['id_categoria'] ) ?  $selected = "selected" : '' ;
														echo "<option   $selected value='".$val['id_categoria']."'>".$val['categoria']."</option>";
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
                                                        $selected = ($data['id_proveedor']  == $val['id_proveedor'] ) ?  $selected = "selected" : '' ;
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
                                                        $selected = ($data['id_marca'] == $val['id_marca'] ) ? "selected" : '';
														echo "<option  $selected value='".$val['id_marca']."'>".$val['nombre']."</option>";
													}
												}
												?>
											</select>
                                        </div>  
                                        <div class="form-group">
											<label for="name">Es un Paquete</label>
											<select style="width:20%" class="select2" name="id_usuario_tipo" id="id_usuario_tipo">
                                                <option value="0" <?php echo ($data['id_marca'] == 0 ) ? "selected" : '' ?>>No</option>
                                                <option value="1" <?php echo ($data['id_marca'] == 1 ) ? "selected" : '' ?>>Si</option>
											</select>
                                        </div>
                                        <div class="form-group">
											<label for="name">Precio Editable</label>
											<select style="width:20%" class="select2" name="manual" id="manual">
                                                <option value="0" <?php echo ($data['id_marca'] == 0 ) ? "selected" : '' ?>>No</option>
                                                <option value="1" <?php echo ($data['id_marca'] == 1 ) ? "selected" : '' ?>>Si</option>
											</select>
                                        </div>
                                        <div class="form-group superbox">
											<label for="name">Imagen</label>
                                            <input type="file" id="imagen" name="imagen"  value="<?php echo ($data['imagen']) ? $data['imagen']  : ''; ?>" title="Imagen">
                                            <div id='contfileproductos'>
                                                <?php 
                                                if($data['imagen']){
                                                    $carpetaimg = ASSETS_URL.'/productosimages/images';
                                                    echo "<div class='superbox-list'>
                                                            <img src='".$carpetaimg.DIRECTORY_SEPARATOR.$data['imagen']."' 
                                                            data-img='".$carpetaimg.DIRECTORY_SEPARATOR.$data['imagen']."'
                                                            alt='".$data['imagen']."' title='".$data['imagen']."'
                                                            style='max-width:150px;max-height:150px;min-width:100px'
                                                            class='superbox-img'>
                                                        </div>";
                                                }
                                                ?> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-sm-12" style="padding:0px">
                                            <div class="col-sm-6" style="padding:0px" >
                                                <div class="form-group">
                                                    <label for="name">Codigo de Barras</label>
                                                    <input type="text" class="form-control" id="codbarras" name="codbarras"  value="<?php echo $data['codbarras']; ?>" placeholder="Codigo de Barras" onkeypress="nextFocus('codbarras', 'codigo')">
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="padding:0px;padding-left: 10px;">
                                                <div class="form-group">
                                                    <label class="name">Codigo </label>
                                                    <input type="text" required class="form-control" id="codigo" name="codinter"  value="<?php echo $data['codinter']; ?>" placeholder="Codigo" onkeypress="nextFocus('codigo', 'nombre')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
											<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" placeholder="Nombre" onkeypress="nextFocus('nombre', 'costo')">
										</div>
                                        <div class="form-group">
											<label class="name">Costo </label>
											<input type="number" class="form-control" id="costo" name="costo" value="<?php echo $data['costo']; ?>" placeholder="Costo" onkeypress="nextFocus('costo', 'precio_descuento')">
                                        </div>
                                        <div class="col-sm-12" style="padding:0px">
                                            <div class="col-sm-6" style="padding:0px">
                                                <div class="form-group">
                                                    <label class="name"> Precio Mayoreo</label>
                                                    <input type="number" class="form-control" id="precio_descuento" value="<?php echo $data['precio_descuento']; ?>" name="precio_descuento" placeholder="Precio Mayoreo" onkeypress="nextFocus('precio_descuento', 'precio')">
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="padding:0px;padding-left: 10px;">
                                                <div class="form-group">
                                                    <label class="name"> Precio</label>
                                                    <input type="number" class="form-control" id="precio" value="<?php echo $data['precio']; ?>" name="precio" placeholder="Precio" onkeypress="nextFocus('precio', 'existencia')">
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
                                                <button class="btn btn-primary btn-md" type="button" onclick=" validateForm();">
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
    function nextFocus(inputF, inputS) {
        document.getElementById(inputF).addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
            document.getElementById(inputS).focus();
            }
        });
    }
    function validateForm()
    {
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
       

        $("#main-form").submit();           
    }
    num=0;
    contfotosauto=0;
    numdel=1;
    var arraydeleteauto=[];
    function uploadimages(evt) {
        document.getElementById('contfileproductos').innerHTML='';
        var files = evt.target.files; // FileList object
        $numfotos=0;
        for (var i = 0, f; f = files[i]; i++) {
            $numfotos++;
        }
        if($numfotos<=15){
            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {
                var nameimage=files[i].name;
                if(files[i].size >= 3856819) {
                  alert("La imagen "+nameimage+" es muy grande, El tamaño maximo es de 3.67 MB");
                  files[i].value = null;
                  continue;
                }
                contfotosauto++;
                // Only process image files.
                if (!f.type.match('image.*')) {
                    notify("error","Solo puedes seleccionar imagenes");
                    continue;
                }
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {
                        var num=Math.floor(Math.random() * 1000); 
                        var span = document.createElement('span');
                        span.innerHTML = ['<img style="width:100px" title="click para eliminar" onclick="deleteimage(',num,');  return false;"  class="thumb" id="image_',num,'" max-width="150px" max-height="150px" src="', e.target.result,
                                        '" nameimage="', escape(theFile.name), '"/>'].join('');
                      document.getElementById('contfileproductos').insertBefore(span, null);
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);     
            }
        }else{
            notify("error","Solo puedes seleccionar 15 imagenes");
        } 
    }
    $(document).ready(function() {
        document.getElementById('imagen').addEventListener('change', uploadimages, false);
        $(function(){
            $('.superbox-img').click(function(){
                $('#showPhoto .modal-body').html($(this).clone().attr("height","100%"));
                $('#showPhoto').modal('show');
            })
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
