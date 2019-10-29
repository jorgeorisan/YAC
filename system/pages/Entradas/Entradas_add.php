<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Entradas Alta";

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
    $obj = new Entrada();
    $id=$obj->addAll(getPost());
    if($id>0){
        informSuccess(true, make_url("Entradas","view",array('id'=>$id,'page'=>'venta')));
    }else{
       // informError(true,make_url("Entradas","index"));
    }
}
$begin     = (isset($_POST['fecha_inicial']))? $_POST['fecha_inicial'] : date('Y-m-d'); 
$idtienda = $_SESSION['user_info']['id_tienda'];
$tipousu  = $_SESSION['user_info']['id_usuario_tipo'];
$idusuario= $_SESSION['user_id'];
$disabled = ($tipousu==2 || $tipousu==5) ? '' : 'disabled';
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main" onKeyDown="javascript:Verificar()">
     <?php $breadcrumbs["Entradas"] = APP_URL."/Entradas/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
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
                            <span class="widget-icon"> <i class="fa fa-plus"></i></span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body"  style="overflow:auto">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <form id="barcode-form">
                                            <input type="hidden" name='action' value='get'>
                                            <input type="hidden" name='object' value='get_producto'>
                                            <?php if($disabled){
                                                ?>
                                                <input type="hidden" name='id_tienda' value='<?php echo $idtienda ?>'>
                                                <?php
                                            }
                                            
                                            ?>
                                            <table class="table-striped table-bordered table-hover" style="width:100%">
                                                <tr>
                                                    
                                                    <th style="width: 100px;">Sucursal Entrada</th>
                                                    <td colspan="2">
                                                        <select style="width:100%" class="select2" name="id_tienda" id="id_tienda" > 
                                                            <option value="">--Sucursal--</option>
                                                            <?php 
                                                            $obj = new Tienda();
                                                            $list=$obj->getAllArr();
                                                            if (is_array($list) || is_object($list)){
                                                                foreach($list as $val){
                                                                    $selected =  ($idtienda == $val['id_tienda'] ) ? "selected" : '';
                                                                    echo "<option ".$selected ." value='".$val['id_tienda']."'>".htmlentities($val['nombre'])."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <th>Codigo</th>
                                                    <td>
                                                        <input type="text" style="width:100%" for='autocomplete' class="form-control" id="barcode" name="codigo" placeholder="Buscar" onkeypress="nextFocus('barcode', 'cantidad')">
                                                    </td>
                                                    <td>
                                                        <div class="" style=''>
                                                            <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopupcatalogo()" > <i class="fa fa-search"></i></a>  
                                                            <a data-toggle="modal" class="btn btn-info" href="#myModal" onclick="showpopupaddnew()" > <i class="fa fa-plus"></i></a>                                                                                  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <td  colspan='3'>
                                                        <input type="number" style="width:80px" class="form-control" id="cantidad" name="cantidad"  value="1" placeholder="Cantidad" onkeypress="nextFocus('cantidad', 'btn_agregar')">
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td colspan='4'><br><input style="width:100%; height:100%" type="submit" class="btn btn-success"  id='btn_agregar'  value="Agregar"/> </td>
                                                    
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
								<form id="main-form" class="" role="form" method=post action="<?php echo make_url("Entradas","add");?>" onsubmit="return checkSubmit();">     
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h3 class="tit">Productos</h3>
                                        <input type="hidden" name="total-global" id="total-global" value="0"/>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right;">
                                        <h3 class="total"><span id="total-num"></span></h3>
                                    </div>
                                    <table id="productos" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <?php 
                                                $obj = new Tienda();
                                                $list=$obj->getAllArr($_SESSION['user_info']['info_adicional']);
                                                if (is_array($list) || is_object($list)){
                                                    foreach($list as $val){
                                                        echo "<input type='hidden' name='id_tiendas[]' value='".$val['id_tienda']."'>"; 
                                                        echo "<th class='".$val['abreviacion']."' >".htmlentities($val['abreviacion'])."</th>";
                                                    }
                                                }
                                                ?>
                                                <th>Codigo Interno</th>
                                                <th>Producto</th>
                                                <th>Costo</th>
                                                <th>Mayoreo</th>
                                                <th>Precio</th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <table class="table-striped table-bordered table-hover" style="width:100%">
                                                <tr>
                                                    <th>Referencia</th>
                                                    <td colspan="2">
                                                        <input type="text" style="width:100%"  class="form-control" id="referencia" name="referencia" placeholder="Referencia" onkeypress="nextFocus('referencia', 'barcode')">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Proveedor</th>
                                                    <td>
                                                        <select style="width:100%" class="select2" name="id_proveedorcompra" id="id_proveedorcompra" >
                                                            <option value="" disabled>--Selecciona Proveedor--</option>
                                                            <?php 
                                                            $obj = new ProveedorCompra();
                                                            $list=$obj->getAllArr();
                                                            if (is_array($list) || is_object($list)){
                                                                foreach($list as $val){
                                                                    $selected =  ( $val['id_proveedorcompra'] == 1 ) ? "selected" : '';
                                                                    echo "<option ".$selected ." value='".$val['id_proveedorcompra']."'>".htmlentities($val['nombre'])."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td style="width: 50px; text-align:right">
                                                        <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopupclientes()" > <i class="fa fa-plus"></i></a>                                          
                                                    <td>
                                                </tr>
                                                <tr>
                                                    <th>Tipo de pago</th>
                                                    <td colspan="2">
                                                        <select style="width:100%" class="select2 " name="tipo_pago"  id="tipo">
                                                            <?php 
                                                            $listref= getTipoPago();
                                                            if (is_array($listref)){
                                                                foreach($listref as $key => $valref){
                                                                    echo "<option value='".$key."'>".htmlentities($valref)."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Comentarios</th>
                                                    <td colspan="2">
                                                        <input type="text" class="form-control" id="comentarios" name="comentarios"  placeholder=""/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Fecha Entrada</th>
                                                    <td colspan="2"><input type="text" class="form-control datepicker" datepicker='past' name="fecha" id="fecha" value='<?php echo date('Y-m-d')?>'/></td>
                                                </tr>
                                                <tr> 
                                                    <th>Usuario</th>
                                                    <td colspan="2">
                                                        <select style="width:100%" class="select2" name="id_usuario" id="id_usuario" <?php echo $disabled?> >
                                                            <option value="">Selecciona</option>
                                                            <?php 
                                                            $obj = new Usuario();
                                                            $list=$obj->getAllArr();
                                                            if (is_array($list) || is_object($list)){
                                                                foreach($list as $val){
                                                                    $selected =  ($idusuario == $val['id'] ) ? "selected" : '';
                                                                    echo "<option ".$selected ." value='".$val['id']."'>".htmlentities($val['id_usuario'])."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="" style="text-align: center">
                                        <div class="col-md-12">
                                            <br>
                                            <button class="btn btn-primary btn-md" id='send' style="width: 100%" type="button">
                                                <i class="fa fa-save"></i>
                                                Registrar
                                            </button>
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
<!-- Modal -->
<div class="modal fade" id="myModal"  role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="100" alt="SmartAdmin">
                    <div id='titlemodal' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> Nuevo</span>
                    </div>
                    
                </h4>
            </div>
            <div class="modal-body no-padding" >
                <div id="contentpopup">

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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
    function Verificar()
    {
        var tecla=window.event.keyCode;
        if (tecla==116) {
            alert("¡¡¡Esta página no debe actualizarse, se podría duplicar la información!!!"); event.keyCode=0;
            event.returnValue=false;}
    }
    function nextFocus(inputF, inputS) {
        document.getElementById(inputF).addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
            document.getElementById(inputS).focus();
            }
        });
    }
   
    $(document).ready(function() {
        
       
        var getproducto = function(form){
            $.get(config.base+"/Entradas/ajax/get_producto", form,
                function (response) {
                    $("table#productos").append(response);
                });
            $("#cantidad").val(1);
            $("#barcode").val("").focus();
            return false;
        }
        
        $("#barcode-form").submit(function (e) {
            e.preventDefault();
            var res =  $('#barcode').val().split("::");
            if(res.length>0){
               $('#barcode').val(res[0].trim());
            }
            getproducto($(this).serialize());
            return false;
        });

        $("#id_tienda").change(function () {
            var id=$("#id_tienda").val();
            $("#catalogo").attr('href',''+id);
            return false;
        });
        
        $("#send").click(function (e) {
            $(".borrar-td").remove();    
            var tipo      = $("#tipo").val();       
            var proveedor   = $("#id_proveedorcompra").val();
            var productos = $(".producto");  
            if ( ! productos.length )  return notify("info","Los productos son requeridos");
            $("#ticket-items").val($("#productos").html());
            if ( tipo == 'Credito' && proveedor == 1  )  return notify("info","Se requiere un proveedor para las entradas a credito");
           
            $(this).hide();
            $("#main-form").submit();

            return false;
        });


        $('body').on('click', '.borrar-producto', function(){
            var id = $(this).attr("lineid");
            $("[lineid=" + id + "]").remove();
        });

   

        /**********Productos*************/
        showpopupaddnew = function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo Producto</span>');
            $.get(config.base+"/Productos/ajax/?action=get&object=addpopup", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        swal('Error al obtener los datos del Formulario');
                    }     
            });
            return false;
        }
        
        /**********Catalogos*************/
        showpopupcatalogo = function(){
            var id_tienda    = $("#id_tienda").val();
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Catalogo de Productos</span>');
            $.get(config.base+"/Productos/ajax/?action=get&object=showpopupcatalogo&id_tienda="+id_tienda, null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario de pacientes');
                        
                    }     
            });
        }


       
        $("#barcode").focus();
        $("#barcode").autocomplete({
            source: function (request, response) {
                var id=$("#id_tienda").val();
                $.getJSON(config.base+"/Productos/ajax/?action=get&size=20&object=getproductos&id_tienda="+id+"&texto=" + request.term, function (data) {
                    response($.map(data, function (value, key) {
                        return {
                            label: value.codinter+'::'+ value.nombre.toLowerCase()+' $'+ value.precio+'|'+value.existenciastienda,
                            value: value.codinter
                        };
                    }));
                });
            },
            minLength: 2,
            delay: 100 
        });
        /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */
         pageSetUp();

    });
  
</script>

<?php
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>
