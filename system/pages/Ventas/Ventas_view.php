<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Ver Venta";

/* ---------------- END PHP Custom Scripts ------------- */

$page_css[] = "vehiculo_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");
/* ---------------- END PHP Custom Scripts ------------- */


//include left panel (navigation)
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Venta","index"));


$obj = new Venta();
$data = $obj->getTable($id);
$obj->getstatus($id);
if ( !$data ) {
    informError(true,make_url("Ventas","index"));
}

$tienda = new Tienda();
$datatienda = $tienda->getTable($data['id_tienda']);
$cliente = new Persona();
$datacliente = $cliente->getTable($data['id_persona']);
$usuario = new Usuario();
$datauser = $usuario->getTable($data['id_user']);
$totalpagado = $obj->getpagado($id);

$porcentpagado = ($totalpagado * 100  / $data['total']);

if ($porcentpagado >= 75)
    $class  = 'label label-success';
if (($porcentpagado >= 50 && $porcentpagado < 75) )
    $class  = 'label label-warning';
if ($porcentpagado < 50 )
    $class  = 'label label-danger';
?>

<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Ventas"] = APP_URL."/Ventas"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
			<div class="row">   
                <div class="widget-body" style='padding-left: 15px;'>
					<a class="btn btn-success" target="_blank" href="<?php echo make_url("Ventas","print",array('id'=>$id,'page'=>'venta'))?>" ><i class="fa fa-print"></i> &nbsp;Imprimir</a>
			
                    <?php if($data['icredito']){ ?>
                        <a data-toggle="modal" class="btn btn-info" href="#myModal" onclick="showpopuppagar(<?php echo $id ?>)" > <i class="fa fa-plus"></i>&nbsp;Pagar</a>
                    <?php } ?>
                </div>
            </div>
			<div class=""> &nbsp; </div>
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
                            <div class="widget-body" style="overflow: auto;">
                                <table style="width:100%;">
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td height="100" style="width:15%;border:none;">
                                                        <img src="<?php echo ASSETS_URL; ?>/img/logo.png" border="0" height="80" width="260"/>
                                                    </td>
                                                    <td style="width:40%; text-align:center;border:none;">
                                                        <h3>Yo Amo Comprar</h3>
                                                        <p style=" line-height:1.5em; font-weight:bold;"><?php echo $datatienda['ubicacion']?><br />
                                                            Zitacuaro,Mich., Mexico<br>
                                                            Tel.7151108800<br>
                                                            R.F.C:AARL921226DJ6
                                                        </p>
                                                    </td>
                                                    <td style="width:32%;border:none;">
                                                        <table style="width:100%; text-align:center;">
                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:40%;">Folio No.</td>
																<td colspan="2" style="color:red;"><?php echo $data["folio"]; ?></td>
                                                            </tr>
                                                           
                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;">Fecha</td>
                                                                <td colspan="2" style=""><?php echo date("Y-m-d H:i:s",strtotime($data["fecha"])); ?></td>
                                                            </tr>
                                                           <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Vendedor </td>
																<td colspan="2"><?php echo htmlentities($datauser['id_usuario']); ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Tienda </td>
																<td colspan="2"><?php echo htmlentities($datatienda['nombre']); ?></td>
                                                            </tr>
															<tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Total</td>
																<td colspan="2"><?php echo htmlentities($data['total']); ?></td>
                                                            </tr>
                                                            <?php 
                                                            if($data['icredito']){
                                                                ?>
                                                                <tr>
                                                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Por Pagar</td>
                                                                    <td colspan="2" class="<?php echo $class; ?>"><?php echo $totalpagado."->".number_format($porcentpagado,0)."%";; ?></td>
                                                                </tr>
                                                                <?php
                                                            }?>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width:100%;" class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DE LA VENTA</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Cliente: </td>
													<td colspan="" style="width:30%;"><?php echo htmlentities($datacliente['nombre']." ".$datacliente['ap_paterno']." ".$datacliente['ap_materno']); ?></td>
													<td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Telefono: </td>
													<td colspan=""><?php echo htmlentities($datacliente['telefono']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Tipo pago: </td>
													<td colspan="" style="width:30%;"><?php echo htmlentities($data['tipo']); ?></td>
													<td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Observaciones: </td>
													<td colspan=""><?php echo $data['comentarios']; ?></td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">PRODUCTOS DE VENTA : </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="width:100%;">
														<table style="height: 100%;width:100%;">
                                                            <tr>
                                                                <td colspan="9" style="background-color:#d0d0cf; font-weight:bold; text-align: center"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Producto</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Precio Uni.</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Total </td>
                                                                <?php if($_SESSION['user_info']['costos']) { ?>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Total Costo</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Utilidad</td>
                                                                <?php } ?>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Tipo Precio</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;"></td>
                                                            </tr>
                                                            <?php 
                                                            $objpv = new ProductosVenta();
                                                            $datapv = $objpv->getAllArr($data['id_venta']);
                                                            $total  = 0;
                                                            foreach($datapv as $row) {
                                                                $status = htmlentities($row['cancelado']);
                                                                switch ($status) {
																	case '1':
																		$status = 'Cancelado';
                                                                        $class  = 'cancelada';
                                                                        break;
                                                                    default:
																		$class  = '';
																		$total+= $row['total'];
                                                                        break;
                                                                } 
                                                            ?>
                                                            <tr class="<?php echo $class; ?>">
                                                                <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                                <td><?php echo htmlentities($row['codinter']); ?></td>
                                                                <td><?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                                                                <td><?php echo htmlentities($row['precio_unitario']); ?></td>
                                                                <td><?php echo htmlentities($row['total']); ?></td>
                                                                <td><?php echo htmlentities($row['costo']); ?></td>
                                                                <td><?php echo htmlentities($row['utilidad']); ?></td>
                                                                <td><?php echo htmlentities($row['tipoprecio']); ?></td>
                                                                <td class='borrar-td'>
                                                                    <?php if (!$row['cancelado']){ ?> 
                                                                        <a href="#" title="Cancelar Venta" id="cancelar_venta<?php echo $row['id_productos_venta']; ?>" idventa='<?php echo $row['id_productos_venta']; ?>' folio='<?php echo $row['nombre']; ?>' class="btn btn-danger deleteventa"> <i class="fas fa-ban"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                            } 
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
																<td></td>
                                                                <td style='font-weight:bold;'>Total:</td>
                                                                <td><strong><?php echo $total; ?></strong></td>
                                                                <td></td> 
                                                                <td></td> 
                                                                <td></td> 
                                                                <td></td>
                                                            </tr>
                                                           
                                                        </table>
													</td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="50" alt="SmartAdmin">
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

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/superbox/superbox.min.js"></script>

<script>
	
    $(document).ready(function() {
         //**********pagoS*************/
         $('body').on('change', '#montoabono', function(){
            if( $(this).val() ){
                var monto  = $("input[name=montoabono]", $(this).parents('form:first')).val();
                var deuda  = $("input[name=deuda]", $(this).parents('form:first')).val();
                var nuevadeuda = deuda - monto;
                if(nuevadeuda<0){ 
                    notify('error','El monto no puede ser mayor a la deuda actual');
                    $("#monto").val('').focus();
                    return false;
                }
            }
        });
        showpopuppagar = function(id_venta){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo Pago</span>');
            $.get(config.base+"/Ventas/ajax/?action=get&object=showpopuppagar&id="+id_venta, null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario de pacientes');
                        
                    }     
            });
            return false;
        }
        $('body').on('click', '#savenewpago', function(){
            var monto  = $("input[name=montoabono]", $(this).parents('form:first')).val();
            var deuda  = $("input[name=deuda]", $(this).parents('form:first')).val();
            if(!monto)  return notify('error',"Se necesita el monto.");  
            var nuevadeuda = deuda - monto;
            if(nuevadeuda<0){ 
                notify('error','El monto no puede ser mayor a la deuda actual');
                $("#monto").val('').focus();
                return false;
            }
            var url = config.base+"/Ventas/ajax/?action=get&object=savenewpago"; 
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).parents('form:first').serialize(), 
                success: function(response){
                    if(response>0){
                        location.reload();
                    }else{
                        return notify('error',"Oopss error al agregar pago"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        //cancelar venta
        $(".deleteventa").click(function(e) {
            e.preventDefault();
			var idventa = $(this).attr('idventa');
			var folio   = $(this).attr('folio');
			$.SmartMessageBox({
				title : "Cancelar Producto Venta: "+folio,
				content : "Menciona el motivo de cancelacion",
				buttons : '[No][Yes]',
				input : "text",
				placeholder : "Motivo de cancelacion"
			}, function(ButtonPressed, Value) {
				if (ButtonPressed === "Yes") {
					if(!Value) return notify('warning','Se necesita un motivo');
					$.get(config.base+"/Ventas/ajax/deleteventa?action=get&object=deleteproductoventa&idproductoventa="+idventa+"&motivo="+Value,
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
