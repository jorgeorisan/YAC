 <?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Editar tienda";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");

if(isset($_GET['id'])   && $_GET['id']>0)
    $id=$_GET['id'];
else
    informError(true,make_url("Productos","index"));


$obj = new Tienda();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Catalogos","tienda"));
}

if(isPost()){
    $obj = new Tienda();
    $id = $obj->updateAll($id,getPost());
    
    if( $id  ) {
       
         //nuevas imagenes
         if (isset($_FILES['imagen'])){
            $carpetaimg = LOGOS.'/logostienda';
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpetaimg."/".$id.'.png');
            $request['logo']=$id.'.png';
            $id = $obj->updateAll($id,$request);
            if( $id >0  ) {
              
                informSuccess(true, make_url("Catalogos","tienda"));
            }else{
                informError(true,  make_url("Catalogos","tienda"));
            }
        }
        informSuccess(true, make_url("Catalogos","tienda"));
    }else{
        informError(true, make_url("Catalogos","tiendaedit",array('id'=>$id)),"tiendaedit");
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Tienda"] = APP_URL."/Catalogos/tienda"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-12 col-md-12 col-lg-12"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-edit"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
                               
                                <form id="main-form" class="" role="form" method='post' action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <input type="text" class="" name="idTienda" hidden>
                                    <fieldset>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Nombre</label>
                                                <input type="text" class="form-control" placeholder="Nombre Tienda" name="nombre" value="<?php echo htmlentities($data['nombre']); ?>">                                                    
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Ubicacion</label>
                                                <input type="text" class="form-control" placeholder="Direccion" name="ubicacion" value="<?php echo htmlentities($data['ubicacion']); ?>">                        
                                            </div>
                                            <div class="form-group superbox">
											<label for="name">Imagen</label>
                                            <input type="file" id="imagen" name="imagen"  value="<?php echo ($data['logo']!='') ? $data['logo']  : ''; ?>" title="Imagen">
                                            <div id='contfileproductos'>
                                                <?php 
                                                if($data['logo']){
                                                    $carpetaimg = ASSETS_URL.'/img/logostienda';
                                                    echo "<div class='superbox-list'>
                                                            <img src='".$carpetaimg.DIRECTORY_SEPARATOR.$data['logo']."' 
                                                            data-img='".$carpetaimg.DIRECTORY_SEPARATOR.$data['logo']."'
                                                            alt='".$data['logo']."' title='".$data['logo']."'
                                                            style='max-width:150px;max-height:150px;min-width:100px'
                                                            class='superbox-img'>
                                                        </div>";
                                                }
                                                ?> 
                                            </div>
                                        </div>
                                        </div>  
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="name">Info Adicional</label>
                                                <input type="text" class="form-control" placeholder="Inf. Adicional" name="info_adicional" value="<?php echo htmlentities($data['info_adicional']); ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Teléfono</label>
                                                <input type="text" class="form-control" placeholder="" name="telefono" value="<?php echo htmlentities($data['telefono']); ?>">                                                                                                                     
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Color</label>
                                                <select style="width:20%" class="select2" name="color" id="color">
                                                    <option value="">N/A</option>
                                                    <option value="pink"   <?php echo ($data['color'] == 'pink' ) ? "selected" : '' ?> >PINK</option>
                                                    <option value="blue"   <?php echo ($data['color'] == 'blue' ) ? "selected" : '' ?> >BLUE</option>
                                                    <option value="green"  <?php echo ($data['color'] == 'green' ) ? "selected" : '' ?> >GREEN</option>
                                                    <option value="purple" <?php echo ($data['color'] == 'purple' ) ? "selected" : '' ?> >PURPLE</option>
                                                    <option value="yellow" <?php echo ($data['color'] == 'yellow' ) ? "selected" : '' ?> >YELLOW</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">RFC</label>
                                                <input type="text" class="form-control" placeholder="RFC" name="rfc" value="<?php echo htmlentities($data['rfc']); ?>">                                                                                               
                                            </div>
                                            
                                        </div>
                                    </fieldset>
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
<!-- ==========================CONTENT ENDS HERE ========================== -->
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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
    
    function validateForm()
    {
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
