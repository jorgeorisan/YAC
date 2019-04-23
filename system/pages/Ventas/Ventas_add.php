<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Ventas Alta";

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
    $id=$obj->addAll(getPost());
    if($id>0){
        //nuevas imagenes
        if (isset($_FILES['imagen'])){
            $carpetaimg = PRODUCTOS.'/images';
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpetaimg."/".$id."_".$_POST['codigo'].'.png');
            $request['imagen']=$id."_".$_POST['codigo'].'.png';
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
}
$idtienda = $_SESSION['user_info']['id_tienda'];
$tipousu  = $_SESSION['user_info']['id_usuario_tipo'];
$idusuario= $_SESSION['user_info']['id_usuario'];
$disabled = ($tipousu==2 || $tipousu==5) ? '' : 'disabled';
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Producto"] = APP_URL."/Producto/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
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
                            <div class="widget-body">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <form id="barcode-form">
                                            <input type="hidden" name='action' value='get'>
                                            <input type="hidden" name='object' value='get_producto'>
                                            <table class="table-striped table-bordered table-hover" style="width:100%">
                                                    <tr>
                                                        <th style="width: 150px;">Sucursal</th>
                                                        <td>
                                                            <div class="form-group">
                                                                <select style="width:100%" class="select2" name="id_tienda" id="id_tienda" <?php echo $disabled; ?>>
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
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>TIPO PRECIO</th>
                                                        <td>
                                                            <div class="form-group">
                                                                <select style="width:100%" class="select2" name="tipoprecio" id="tipoprecio">
                                                                    <option value="">--Tipo Precio--</option>
                                                                    <option value="Normal" selected>Normal</option>
                                                                    <option value="Mayoreo">Mayoreo</option>
                                                                    <option value="Promocumple">Promo Cumple</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Código de barras</th>
                                                        <td>
                                                            <input type="text" style="width:100%" for='autocomplete' class="form-control" id="barcode" name="codigo" placeholder="Buscar" onkeypress="nextFocus('barcode', 'cantidad')">
                                                        </td>
                                                        <td>
                                                            <a fancybox="true" class="btn btn-info" style="" id="catalogo" ><i class="fas fa-search"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Cantidad</th>
                                                        <td>
                                                            <input type="number" style="width:50px" class="form-control" id="cantidad" name="cantidad"  value="1" placeholder="Cantidad" onkeypress="nextFocus('cantidad', 'btn_agregar')">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='3' style="text-align:center"><br><input style="width:100%" type="submit" class="btn btn-success"  id='btn_agregar'  value="Agregar"/> </td>
                                                        
                                                    </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
								<form id="main-form" class="" role="form" method=post action="<?php echo make_url("Ventas","add");?>" onsubmit="return checkSubmit();">     
                                    
                                   
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h3 class="tit">Productos</h3>
                                        <input type="hidden" name="total-global" id="total-global" value="0"/>
                                        <input type="hidden" name="ticket_items" id="ticket-items" value="0"/>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right;">
                                        <h3 class="total">Total: $<span id="total-num"></span></h3>
                                    </div>
                                    <table id="productos" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Codigo Interno</th>
                                                <th>Producto</th>
                                                <th>Subtotal</th>
                                                <th>Total</th>
                                                <th class="borrar-td"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <table class="table-striped table-bordered table-hover" style="width:100%">
                                                <tr>
                                                    <td><label>Cliente</label></td>
                                                    <td>
                                                        <select style="width:100%" class="select2" name="id_persona" id="id_persona" >
                                                            <option value="" disabled>--Selecciona Cliente--</option>
                                                            <?php 
                                                            $obj = new Persona();
                                                            $list=$obj->getAllArr();
                                                            if (is_array($list) || is_object($list)){
                                                                foreach($list as $val){
                                                                    $selected =  (2 == $val['id_persona'] ) ? "selected" : '';
                                                                    echo "<option ".$selected ." value='".$val['id_persona']."'>".htmlentities($val['nombre'].' '.$val['ap_paterno'].' '.$val['ap_materno'])."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td style="width: 50px; text-align:right">
                                                        <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopuppacientes()" > <i class="fa fa-plus"></i></a>                                          
                                                    <td>
                                                </tr>
                                                <tr>
                                                    <td><label>Tipo de pago</label></td>
                                                    <td colspan="2">
                                                        <select name="tipo" class="select2" id="tipo">
                                                            <option value="Efectivo">Efectivo</option>
                                                            <option value="Tarjeta Credito">Tarjeta Credito</option>
                                                            <option value="Tarjeta Debito">Tarjeta Debito</option>
                                                            <option value="Credito">Credito</option>
                                                            <option value="Otro">Otro</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr id="contabono" style="display: none">
                                                    <td><label>Monto del Abono</label></td>
                                                    <td colspan="2">
                                                        <input type="number" style="width:100px" class="form-control"  id="abono" name="abono" value="0" placeholder=""/>
                                                    </td>
                                                </tr>
                                                <tr id="contcredencial" style="display: none">
                                                    <td><label>Numero Identificacion</label></td>
                                                    <td colspan="2">
                                                        <input type="number" style="width:200px" class="form-control"  id="credencial" name="credencial" placeholder=""/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Pago recibido</label></td>
                                                    <td colspan="2">
                                                        <input type="number" style="width:100px" class="form-control"  id="pago-recibido" placeholder="$0.00"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Cambio</label></td>
                                                    <td colspan="2">
                                                        <input type="number" style="width:100px" class="form-control"  id="cambio" readonly="readonly" placeholder="$0.00"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><label>Descuento Gerencial</label></td>
                                                    <td colspan="2" style="text-align:center">
                                                        <a href="#" id="solicitar-descuento-gerencial">Show/Hide</a>

                                                        <div id="descuento-gerencial" style="display: none;">
                                                            <table class="nostyle">
                                                                <tr>
                                                                    <td>
                                                                        <label>Monto en $</label>
                                                                    </td>
                                                                    <td><input type="text" id="monto" class="form-control" name="monto"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label>Usuario</label>
                                                                    </td>
                                                                    <td><input type="text" class="form-control" name="id_usuario" id="id_usuariodesc"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label>Contraseña</label>
                                                                    </td>
                                                                    <td><input type="password" autocomplete="" class="form-control" name="password" id="passworddesc"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="button" id="cancelar-solicitud" class="form-control" value="Cancelar"/></td>
                                                                    <td>
                                                                        <input type="button" id="mandar-solicitud" class="form-control" value="Solicitar"/>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Comentarios Venta</label></td>
                                                    <td colspan="2">
                                                        <input type="text" class="form-control" id="comentarios" name="comentarios"  placeholder=""/>
                                                    </td>
                                                </tr>
                                                <?php if(!$disabled){?>
                                                    <tr>
                                                        <td>
                                                            <label>Fecha Venta</label>
                                                        </td>
                                                        <td colspan="2"><input type="text" class="form-control datepicker" datepicker='past' name="fecha" id="" value='<?php echo date('Y-m-d')?>'/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>Vendedor</label>
                                                        </td>
                                                        <td colspan="2">
                                                            <select style="width:100%" class="select2" name="id_usuario" id="id_usuario" <?php echo $disabled?> >
                                                                <option value="">Selecciona</option>
                                                                <?php 
                                                                $obj = new Usuario();
                                                                $list=$obj->getAllArr();
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        $selected =  ($idusuario == $val['id_usuario'] ) ? "selected" : '';
                                                                        echo "<option ".$selected ." value='".$val['id_usuario']."'>".htmlentities($val['id_usuario'])."</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                <?php  }?>


                                            </table>
                                        </div>
                                    </div>
                                    <div class="" style="text-align: center">
                                        <div class="col-md-12">
                                            <br>
                                            <button class="btn btn-primary btn-md" id='send' style="width: 100%" type="button" onclick=" validateForm();">
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
    function validateForm(){
        var id_categoria = $("#id_categoria").val();
        if ( ! id_categoria )  return notify("info","La categoria es requerida");
        var id_proveedor = $("#id_proveedor").val();
        if ( ! id_proveedor )  return notify("info","La Seccion es requerida");
        var id_marca = $("#id_marca").val();
        if ( ! id_marca )  return notify("info","La marca es requerida");
        var codigo = $("input[name=codigo]").val();
        if ( ! codigo )  return notify("info","El codigo es requerido");
        var nombre = $("input[name=nombre]").val();
        if ( ! nombre )  return notify("info","El nombre es requerido");
       
        $("#main-form").submit();           
    }
    $(document).ready(function() {
        var calcTotal = function () {
            var totales = $(".totales");
            var total = 0;
            for (var i = 0, len = totales.length; i < len; i++) {
                total = parseFloat(total);
                total += parseFloat($(totales[i]).val());
            }

            $("#total-num").html(total);
            $("#total-global").val(total);
        }
        
        var getproducto = function(form){
            $.get(config.base+"/Ventas/ajax/get_producto", form,
                function (response) {
                    console.log(response);
                    if(response.trim()=='SIN EXISTENCIA'){
                        if (confirm("No hay existencia de este producto, deseas agregarlo al inventario?") == true) {
                            addproducto(form);
                        }
                    }else{
                        $("table#productos").append(response);
                        calcTotal();
                    }
                    
                });
            $("#cantidad").val(1);
            $("#barcode").val("").focus();
            return false;
        }
        var addproducto = function(form){
            if ( ! form ) return;
            $.get(config.base+"/Ventas/ajax/addproducto", form,
            function (response) {
                if(response==1){
                    getproducto(form);
                }else{
                    return notify('warning', 'A Ocurrido un error');
                       
                } 
            });
            return false;
        }
        var save= function(){
            var nomcli    = $('#nom_cli').val();
            var appat     = $('#ap_pat').val();
            var apmat     = $('#ap_mat').val();
            var telcli    = $('#tel_cli').val();
            var comentcli = $('#coment_cli').val();
            if(nomcli && telcli){
                $.post(config.base+"/Clientes/ajax/saveaddpopup",
                    {
                        nombre:     nomcli,
                        ap_paterno: appat,
                        ap_materno: apmat,
                        telefono:   telcli,
                        observaciones: comentcli
                    },
                    function (response) {
                        
                        if(response>0){
                            //alert("Group successfully added");
                            $('#id_persona').append($('<option>', {
                                value: response,
                                text: nomcli,
                                selected:true
                            }));  
                            $(".select2").multiselect({
                                multiple: false,
                                header: "Selecciona una opcion",
                                noneSelectedText: "Seleccionar",
                                selectedList: 1
                            }).multiselectfilter();
                                //$.fancybox.close();
                        }else{
                            return notify('Error', "Oopss error al agregar cliente"+response);
                           
                        }
                    }
                );
            }else{
                return notify('info', 'El nombre y telefono es requerido');
                
            }
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

        $("#barcode").focus(
            function () {
                $(this).addClass("yellow-bg");
            }).blur(function () {
                $(this).removeClass("yellow-bg");
            });

        $("#barcode").focus();

        $("#solicitar-descuento-gerencial").click(function () {
            
            $("#descuento-gerencial").toggle();
            return false;
        });
       
        $("#tipo").change(function (e) {
            e.preventDefault();
            console.log($("#tipo").val());
            var id=$("#tipo").val();
            if(id=="Tarjeta Credito"|| id=="Tarjeta Debito") {
                $("#contcredencial").show();
            }else{
                $("#contcredencial").hide();
            }
            if(id=="Credito") {
                $("#contabono").show();
            }else{
                $("#contabono").hide();
            }

            return false;
        });
        $("#id_tienda").change(function () {
            var id=$("#id_tienda").val();
            $("#catalogo").attr('href',''+id);
            return false;
        });
        $("#mandar-solicitud").click(function (e) {
            e.preventDefault();

            var idusu=document.getElementById("id_usuariodesc").value;
            var pass=document.getElementById("passworddesc").value;
            var msj=$("#main-form").serialize()+"&id_usuario="+idusu+"&password="+pass;
            if (idusu==2 ) {
                return notify('warning', 'Selecciona un cliente');
            }else{


                var $monto = parseFloat($("#monto").val());
                if ($monto > 0 ) {
                    $.get(config.base+"/Ventas/ajax/descuentogerencial", msj, function (response) {
                        $("table#productos").append(response);
                        document.getElementById("passworddesc").value = "";
                        document.getElementById("id_usuariodesc").value = "";
                        document.getElementById("mandar-solicitud").style.display = "none";
                        calcTotal();

                    });
                } else {
                    return notify('warning', 'El monto no es correcto');
                }
            }
            return false;
        });
        $("#cancelar-solicitud").click(function (e) {
            e.preventDefault();
            $("[lineid=descuento-gerencial]").remove();
            calcTotal();
            document.getElementById("mandar-solicitud").style.display ="Inherit";
            return false;
        });

        $("#send").click(function (e) {


            $(".borrar-td").remove();
            $("#ticket-items").val($("#productos").html());

            if ($("#tipo").val() != "") {
                $(this).hide();
                $("#main-form").submit();

            } else {
                $("#tipo").focus();
                alert("Hay que escoger una forma de pago");
            }
        });


        $(".borrar-producto").on('click', function (e) {
            e.preventDefault();

            var id = $(this).attr("lineid");
            $("[lineid=" + id + "]").remove();
            calcTotal();
        });

        $("#pago-recibido").keyup(function (){
            var total = parseFloat($("#total-global").val());
            var pagoRecibido = parseFloat($(this).val());

            $("#cambio").val(pagoRecibido-total);
        });
        $("#barcode").autocomplete({
            source: [ <?php echo $_SESSION['CADENA'] ?>],
            select: function(res) {
    
            }
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
