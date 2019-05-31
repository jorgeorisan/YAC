<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Ver producto";

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
								<div class="col-sm-6">
									<div class="form-group">
										<label for="name">Categoria</label>
										<select style="width:100%" disabled class="select2" name="id_categoria" id="id_categoria">
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
										<select style="width:100%" disabled class="select2" name="id_proveedor" id="id_proveedor">
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
										<select style="width:100%" disabled class="select2" name="id_marca" id="id_marca">
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
										<select style="width:20%" disabled class="select2" name="paquete" id="paquete">
											<option value="0" <?php echo ($data['id_marca'] == 0 ) ? "selected" : '' ?>>No</option>
											<option value="1" <?php echo ($data['id_marca'] == 1 ) ? "selected" : '' ?>>Si</option>
										</select>
									</div>
									<div class="form-group">
										<label for="name">Precio Editable</label>
										<select style="width:20%" disabled class="select2" name="manual" id="manual">
											<option value="0" <?php echo ($data['manual'] == 0 ) ? "selected" : '' ?>>No</option>
											<option value="1" <?php echo ($data['manual'] == 1 ) ? "selected" : '' ?>>Si</option>
										</select>
									</div>
									<div class="form-group superbox">
										<label for="name">Imagen</label><br>
										<?php 
										$carpetaimg = ASSETS_URL.'/productosimages/images';
										
											echo "<div class='superbox-list'>
													<img src='".$carpetaimg.DIRECTORY_SEPARATOR.$data['imagen']."' 
													data-img='".$carpetaimg.DIRECTORY_SEPARATOR.$data['imagen']."'
													alt='".$data['imagen']."' title='".$data['imagen']."'
													style='max-width:150px;max-height:150px;min-width:100px'
													class='superbox-img'>
												</div>";

										?>       
									</div>
								</div>
								<div class="col-sm-6">
									<div class="col-sm-12" style="padding:0px">
										<div class="col-sm-6" style="padding:0px" >
											<div class="form-group">
												<label for="name">Codigo de Barras</label>
												<input type="text" readonly class="form-control" id="codbarras" name="codbarras"  value="<?php echo $data['codbarras']; ?>" placeholder="Codigo de Barras" onkeypress="nextFocus('codbarras', 'codigo')">
											</div>
										</div>
										<div class="col-sm-6" style="padding:0px;padding-left: 10px;">
											<div class="form-group">
												<label class="name">Codigo </label>
												<input type="text" readonly required class="form-control" id="codigo" name="codigo"  value="<?php echo $data['codinter']; ?>" placeholder="Codigo" onkeypress="nextFocus('codigo', 'nombre')">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="name">Nombre</label>
										<input type="text" readonly class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" placeholder="Nombre" onkeypress="nextFocus('nombre', 'costo')">
									</div>
									<div class="form-group">
										<label class="name">Costo </label>
										<input type="number" readonly class="form-control" id="costo" name="costo" value="<?php echo $data['costo']; ?>" placeholder="Costo" onkeypress="nextFocus('costo', 'precio_descuento')">
									</div>
									<div class="col-sm-12" style="padding:0px">
										<div class="col-sm-6" style="padding:0px">
											<div class="form-group">
												<label class="name"> Precio Mayoreo</label>
												<input type="number" readonly class="form-control" id="precio_descuento" value="<?php echo $data['precio_descuento']; ?>" name="precio_descuento" placeholder="Precio Mayoreo" onkeypress="nextFocus('precio_descuento', 'precio')">
											</div>
										</div>
										<div class="col-sm-6" style="padding:0px;padding-left: 10px;">
											<div class="form-group">
												<label class="name"> Precio</label>
												<input type="number" readonly class="form-control" id="precio" value="<?php echo $data['precio']; ?>" name="precio" placeholder="Precio" onkeypress="nextFocus('precio', 'existencia')">
											</div>
										</div>
									</div>
								</div>
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
  
    $(document).ready(function() {
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
