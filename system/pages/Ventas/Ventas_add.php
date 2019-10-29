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

$idtienda = $_SESSION['user_info']['id_tienda'];
$tipousu  = $_SESSION['user_info']['id_usuario_tipo'];
$idusuario= $_SESSION['user_id'];
$disabled = ($tipousu==2 || $tipousu==5) ? '' : 'disabled';

$id='';
if(isPost()){
    $obj = new Venta();
    $id=$obj->addAll(getPost());
}
//reporte de 10 ultimas ventas
$arrayfilters=[];
$begin     = (isset($_POST['fecha_inicial']))? $_POST['fecha_inicial'] : date('Y-m-d'); 
$end       = (isset($_POST['fecha_final']))  ? $_POST['fecha_final']   : date('Y-m-d');	
$arrayfilters['fecha_inicial'] = $begin;
$arrayfilters['fecha_final']   = $end;
$arrayfilters['id_tienda']     = $idtienda;
$arrayfilters['page']   	   = 'ventas';
$arrayfilters['size']   	   = '10';
$jsonarrayfilters 		= json_encode($arrayfilters);
$reports = new Reports();
$dataventas     		= $reports->getReporteVentas($arrayfilters);
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main" onKeyDown="javascript:Verificar()">
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
                            <div class="widget-body"  style="overflow:auto">
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
                                                <th style="width: 100px;">Sucursal</th>
                                                <td colspan="2">
                                                    <select style="width:100%" class="select2" name="id_tienda" id="id_tienda" <?php echo $disabled; ?> > 
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
                                                <td>
                                                    <select style="width:100%" class="select2" name="tipoprecio" id="tipoprecio">
                                                        <option value="">--Tipo Precio--</option>
                                                        <option value="Normal" selected>Normal</option>
                                                        <option value="Mayoreo">Mayoreo</option>
                                                        <option value="Promocumple">Regalo</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Código</th>
                                                <td colspan="2">
                                                    <input type="text" style="width:100%" for='autocomplete' class="form-control" id="barcode" name="codigo" placeholder="Buscar" onkeypress="nextFocus('barcode', 'cantidad')">
                                                </td>
                                                <td  colspan='1'>
                                                    <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopupcatalogo()" > <i class="fa fa-search"></i></a>                                          
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Cantidad</th>
                                                <td  colspan='3'>
                                                    <input type="number" style="width:100px" class="form-control" id="cantidad" name="cantidad"  value="1" placeholder="Cantidad" onkeypress="nextFocus('cantidad', 'btn_agregar')">
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td colspan='4'><br><input style="width:100%; height:100%" type="submit" class="btn btn-success"  id='btn_agregar'  value="Agregar"/> </td>
                                                
                                            </tr>
                                        </table>
                                    </form>
                                </div>
								<form id="main-form" class="" role="form" method=post action="<?php echo make_url("Ventas","add");?>" onsubmit="return checkSubmit();">     
                                    <input type="hidden" id='tiendaprod' name="id_tienda" value="<?php echo $idtienda ?>">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h3 class="tit">Productos</h3>
                                        <input type="hidden" name="total-global" id="total-global" value="0"/>
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
                                                <th ></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <table class="table-striped table-bordered table-hover" style="width:100%">
                                                <tr>
                                                    <td colspan="2"><label>Cliente</label></td>
                                                    <td style="width: 50px; text-align:right">
                                                        <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopupclientes()" > <i class="fa fa-plus"></i></a>                                          
                                                    <td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <select style="width:100%" class="select2" name="id_persona" id="id_persona" >
                                                            <?php 
                                                            $obj = new Persona();
                                                            $list=$obj->getAllArr('clientes');
                                                            if (is_array($list) || is_object($list)){
                                                                foreach($list as $val){
                                                                    $selected =  ( $val['id_persona'] == 2 ) ? "selected" : '';
                                                                    echo "<option ".$selected ." value='".$val['id_persona']."'>".htmlentities($val['nombre'].' '.$val['ap_paterno'].' '.$val['ap_materno'].' | '.$val['telefono'])."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                  
                                                </tr>
                                                <tr>
                                                    <td><label>Tipo de pago</label></td>
                                                    <td colspan="2">
                                                        <select style="width:100%" class="select2 " name="tipo"  id="tipo">
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
                                                <tr id="contabono" style="display: none">
                                                    <td><label>Monto del Abono</label></td>
                                                    <td colspan="2">
                                                        <input type="number" style="width:100px" class="form-control"  id="montoabono" name="montoabono" value="0" placeholder=""/>
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
                                                    <th>Descuento $</th>
                                                    <td>
                                                        <a href="#" id="solicitar-descuento-gerencial">Show/Hide</a>
                                                        <div id="descuento-gerencial" style="display: none;">
                                                            <input type="number" style="width:100px" id="monto" class="form-control" name="monto" placeholder="Monto"/>
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
                                                        <td colspan="2"><input type="text" class="form-control datepicker"  data-dateformat='yy-mm-dd' autocomplete="off" name="fecha" id="fecha" value='<?php echo date('Y-m-d')?>'/></td>
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
                                                                        $selected =  ($idusuario == $val['id'] ) ? "selected" : '';
                                                                        echo "<option ".$selected ." value='".$val['id']."'>".htmlentities($val['id_usuario'])."</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                <?php  }?>


                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                        <?php 
                                        if(isset($dataventas) && $dataventas!=''){ ?>
                                            <div class="row" style="overflow:auto">
                                                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
                                                        <header>
                                                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                                            <h2><?php echo "Reporte de ultimas 10 ventas" ?></h2>
                                                        </header>
                                                        <div>
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                            <div class="widget-body">
                                                                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class = "col-md-1" data-class="expand">Folio</th>
                                                                            <th class = "col-md-1" data-class="">Cliente </th>
                                                                            <th class = "col-md-1" data-class="">Vendedor </th>
                                                                            <th class = "col-md-1" data-class="phone,tablet">Fecha</th>
                                                                            <th class = "col-md-1" data-class="phone,tablet">Tipo</th>
                                                                            <th class = "col-md-1" data-class="phone,tablet">Total</th>
                                                                            <th class = "col-md-1" data-class="phone,tablet"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                        $nomtienda = '';
                                                                        $total = 0;
                                                                        $totaldevoluciones= 0;
                                                                        foreach($dataventas as $row) {
                                                                            
                                                                            $cliente = new Persona();
                                                                            $datacliente = $cliente->getTable($row['id_persona']);
                                                                            $tienda = new Tienda();
                                                                            $datatienda = $tienda->getTable($row["id_tienda"]);
                                                                            if($datatienda) $nomtienda = $datatienda["nombre"]; 
                                                                        
                                                                            $descuento = ($row["descuento"]) ? 'Descuento:'.$row["descuento"]."<br>" : ''; 
                                                                            $class     = ($row["cancelado"]) ? "class='cancelada'" : '';
                                                                            
                                                                            if ($row['cancelado']==0) {
                                                                                $total += $row['total'];
                                                                                $obj = new Venta();
                                                                                $totaldevoluciones += $obj->getcancelaciones($row['id_venta']);
                                                                            }
                                                                            ?>
                                                                            <tr <?php echo $class;?>>
                                                                                <td>
                                                                                    <a class="" target="_blank" href="<?php echo make_url("Ventas","view",array('id'=>$row['id_venta'])); ?>">
                                                                                        <?php echo htmlentities($row['folio'])?>
                                                                                    </a>
                                                                                </td>
                                                                                <td><?php echo htmlentities($datacliente['nombre']." ".$datacliente['ap_paterno'])?></td>
                                                                                <td><?php echo htmlentities($row['id_usuario'])?></td>
                                                                                <td><?php echo htmlentities($row['fecha'])?></td>
                                                                                <td>
                                                                                    <?php echo htmlentities($row['tipo'])."<br>";
                                                                                    if($row['icredito']){
                                                                                        echo "<span style='color:red'>En pago</span>";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td>$<?php echo number_format($row['total'], 2).'<br>'.$descuento; ?></td>
                                                                                <td>
                                                                                    <div class="btn-group">
                                                                                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                                            <i class="fas fa-chevron-down"></i> <span class="caret"></span>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu">
                                                                                            <li>
                                                                                                <a title="Ver Venta" class=""  target="_blank" href="<?php echo make_url("Ventas","view",array('id'=>$row['id_venta'])); ?>"> Ver Venta</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a title="Imprimir Venta"  class="" target="_blank" href="<?php echo make_url("Ventas","print",array('id'=>$row['id_venta'],'page'=>'venta','close'=>'true')); ?>">Imprimir</a>
                                                                                            </li>
                                                                                            <?php 
                                                                                            if (!$row['cancelado']){ ?> 
                                                                                              
                                                                                                <li class="divider"></li>
                                                                                                <li>
                                                                                                    <a href="#" title="Cancelar Venta" id="cancelar_venta<?php echo $row['id_venta']; ?>" idventa='<?php echo $row['id_venta']; ?>' folio='<?php echo $row['folio']; ?>' class=" deleteventa">Eliminar</a>
                                                                                                </li>
                                                                                            <?php 
                                                                                            } ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php 
                                        }?>
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
                        <span class="widget-icon"><i class="fa fa-plus"></i> Nuevo</span>
                    </div>
                    
                </h4>
            </div>
            <div class="modal-body no-padding" >
                <div id="contentpopup" class="printMe">

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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

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
    $('#dt_basic').dataTable({
        "aaSorting": [[0,"desc" ]],
        "iDisplayLength": 3,
    });
    $(".deleteventa").click(function(e) {
        e.preventDefault();
        var idventa = $(this).attr('idventa');
        var folio   = $(this).attr('folio');
        $.SmartMessageBox({
            title : "Cancelar Venta: "+folio,
            content : "Menciona el motivo de cancelacion",
            buttons : '[No][Yes]',
            input : "text",
            placeholder : "Motivo de cancelacion"
        }, function(ButtonPressed, Value) {
            if (ButtonPressed === "Yes") {
                if(!Value) return notify('warning','Se necesita un motivo');
                $.get(config.base+"/Ventas/ajax/deleteventa?action=get&object=deleteventa&idventa="+idventa+"&motivo="+Value,
                function (response) {
                    if(response){
                        notify('success','Cancelada con exito');
                        location.reload();
                    }else{
                        return notify('error','Error al cancelar venta');
                    }
                });
            }
        });
        $("#txt1").val('');
    });
   
    function nextFocus(inputF, inputS) {
        document.getElementById(inputF).addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
            document.getElementById(inputS).focus();
            }
        });
    }
    var calcTotal = function () {
        var totales = $(".totales");
        var totaldescuento = ($("#monto").val()>0) ? parseFloat($("#monto").val()) : 0;  
    
        var total = 0;
        for (var i = 0, len = totales.length; i < len; i++) {
            total = parseFloat(total);
            total += parseFloat($(totales[i]).val());
        }
        total = total-totaldescuento;

        $("#total-num").html(total);
        $("#total-global").val(total);
    }
    //imprimir venta
    var showimprimir = function(idventa=false){
        $.get(config.base+"/Ventas/ajax/?action=get&object=showimprimir&id_venta="+idventa, null, function (response) {
                if ( response ){
                    //console.log(response);
                    window.open(response,'Imprimir Ticket', 'width=600, height=600');
                }else{
                    return notify('error', 'Error al obtener el ticket');
                    
                }     
        });
    }

    $(document).ready(function() {
       
        
        var getproducto = function(form){
            $.get(config.base+"/Ventas/ajax/get_producto", form,
                function (response) {
                    console.log(response);
                    if(response == 'Cantidad insuficiente' || response == 'Producto no encontrado' || response=='No se enconto el producto en la tienda'){
                        if(response == 'Cantidad insuficiente'){
                            return notify('warning',response);
                        }else{
                            return notify('error',response);
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
        
      
        $("#barcode-form").submit(function (e) {
            e.preventDefault();
            var res =  $('#barcode').val().split("::");
            if(res.length>0 && res[0]){
               $('#barcode').val(res[0].trim());
                getproducto($(this).serialize());
            }
            return false;
        });

        //descuentos
        $("#solicitar-descuento-gerencial").click(function () {
            $("#descuento-gerencial").toggle();
            return false;
        });        
        $("#monto").change(function () {
            var monto = $("#monto").val();
            if ( monto=='') monto = 0;
            if (monto >= 0 || monto==''  ) {
                calcTotal();
            } else {
                 notify('warning', 'El monto no es correcto:'+monto);
                 $("#monto").val('')
                 return false;
            }
            return false;
        });
        $("#montoabono").change(function () {
            var tipo  = $("#tipo").val();
            var monto = parseFloat($("#montoabono").val());
            if( tipo == "Apartado" || tipo == "Credito" ) {
                if ( monto=='') monto = 0;
                if ( monto >= 0 || monto==''  ) {
                    if(monto > $("#total-global").val()){
                        notify('warning', 'El Abono debe ser menor al total de venta:'+monto);
                        $("#montoabono").val('')
                        return false;
                    }
                } else {
                    notify('warning', 'El Abono no es correcto:'+monto);
                    $("#montoabono").val('')
                    return false;
                }
            }else{
                notify('warning', 'El No se pueden meter abonos');
                $("#montoabono").val(0);
            }
            return false;
        });
        
       
        $("#tipo").change(function (e) {
            e.preventDefault();
            var tipo    = $("#tipo").val();
            
            var cliente = $("#id_persona").val();
            if(tipo=="Tarjeta Credito"|| tipo=="Tarjeta Debito") {
                $("#contcredencial").show();
            }else{
                $("#contcredencial").hide();
            }
            if(tipo == "Apartado" || tipo == "Credito" ) {
                $("#contabono").show();
            }else{
                $("#contabono").hide();
            }
            if ( (tipo == "Apartado" || tipo == "Credito")  && cliente == 2  )  return notify("info","Se requiere un cliente para los apartados");

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
            var tipo      = $("#tipo").val();       
            var cliente   = $("#id_persona").val();
            var productos = $(".producto");  
            if ( ! productos.length )  return notify("info","Los productos son requeridos");
            $("#ticket-items").val($("#productos").html());
            if ( (tipo == "Apartado" || tipo == "Credito")  && cliente == 2  )  
                return notify("info","Se requiere un cliente para los apartados");
           
           
            //$("#montoabono").val(0);
            //$("#monto").val(''); 
            //$("#comentarios").val(''); 
            //$('#tipoprecio').val('Normal').select2();
            //$('#id_persona').val('Efectivo').select2();
            //$('#tipo').val('Efectivo').select2();
          
            $(this).hide();
            $("#main-form").submit();

            return false;
        });

        $('body').on('click', '.borrar-producto', function(){
            var id = $(this).attr("lineid");
            $("[lineid=" + id + "]").remove();
            calcTotal();
        });

        $("#pago-recibido").keyup(function (){
            var total = parseFloat($("#total-global").val());
            var pagoRecibido = parseFloat($(this).val());

            $("#cambio").val(pagoRecibido-total);
        });

        /**********Clients*************/
        showpopupclientes = function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo Cliente</span>');
            $.get(config.base+"/Clientes/ajax/?action=get&object=showpopup", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario de pacientes');
                        
                    }     
            });
        }
        $('body').on('click', '#savenewcliente', function(){
            var nombre       = $("input[name=nombre]", $(this).parents('form:first')).val();
            var apellido_pat = $("input[name=ap_paterno]", $(this).parents('form:first')).val();
            var apellido_mat = $("input[name=ap_materno]", $(this).parents('form:first')).val();
            var telefono     = $("input[name=telefono]", $(this).parents('form:first')).val();
            var id_tienda    = $("#id_tienda").val();
            if(!nombre)  return notify('error',"Se necesita el nombre del Cliente."); 
            if(!telefono)  return notify('error',"Se necesita el telefono del Cliente."); 
            var url = config.base+"/Clientes/ajax/?action=get&object=savenewclient"; // El script a dónde se realizará la petición.
            $("#savenewcliente").attr('disabled','true');
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).parents('form:first').serialize()+'&id_tienda='+id_tienda, // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#id_persona').append($('<option>', {
                            value: response,
                            text: nombre+" "+apellido_pat+" "+apellido_mat,
                            selected:true
                        }));  
                        $("#id_persona").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        $('#myModal').modal('hide');
                        notify('success',"Cliente agregado correctamente:"+response);
                    }else{
                        notify('error',"Oopss error al agregar Cliente"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
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
        seleccionarpersona = function(id){
            $("#id_persona option[value="+ id +"]").attr("selected",true);
            $("#id_persona").select2();
            $('#myModal').modal('hide');
        }
        

        $("#barcode").focus();
       
        $("#id_tienda").change(function () {
            var id=$("#id_tienda").val();
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
            
            $("#tiendaprod").val(id);
            $("#catalogo").attr('href',''+id);
            return false;
        });
       
        $("#barcode").focus();
        
       
        $("#barcode").autocomplete({
            source: [ <?php echo $_SESSION['CADENA'] ?>],
            select: function(res) {
    
            }
        });
         /*
         $("#barcode").autocomplete({
            source: function () {
                        $.map(<?php echo $_SESSION['CADENA'] ?>, function (value, key) {
                                return {
                                    label: value.codinter+'::'+ value.nombre.toLowerCase()+' $'+ value.precio+'|'+value.existenciastienda,
                                    value: value.codinter
                            }
                        });
                    }
        });
        */
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
    if($id>0){
    echo "
        <script> 
            showimprimir(".$id.");
        </script>";
        //informSuccess(true, make_url("Ventas","print",array('id'=>$id,'page'=>'venta')));
    }    
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>
