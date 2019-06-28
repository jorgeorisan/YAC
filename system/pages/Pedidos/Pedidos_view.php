<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Ver Pedido";

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
    informError(true,make_url("Pedido","index"));


$obj = new Pedido();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Pedidos","index"));
}

$tienda = new Tienda();
$datatienda = $tienda->getTable($data['id_tienda']);
$usuario = new Usuario();
$datauser = $usuario->getTable($data['id_user']);
?>

<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Pedidos"] = APP_URL."/Pedidos"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
			<div class="row">   
                <div class="widget-body" style='padding-left: 15px;'>
					<a class="btn btn-success" target="_blank" href="<?php echo make_url("Pedidos","print",array('id'=>$id,'page'=>'pedido'))?>" ><i class="fa fa-print"></i> &nbsp;Imprimir</a>
                    <?php if($data['status']=='SOLICITADO'){ ?>
                        <a  class="btn btn-info" href="#" onclick="validar(<?php echo $id ?>)" > <i class="fa fa-check"></i>&nbsp;Validar</a>
                    <?php } ?>
                   
                </div>
            </div>
			<div class=""> &nbsp; </div>
            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-white" id="wid-id-0" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="true">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2><?php echo $page_title." ".$id ?></h2>
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
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Usuario </td>
																<td colspan="2"><?php echo htmlentities($datauser['id_usuario']); ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Tienda </td>
																<td colspan="2"><?php echo htmlentities($datatienda['nombre']); ?></td>
                                                            </tr>
															<tr>
                                                                <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Total Costo</td>
																<td colspan="2">$<?php echo htmlentities($data['costo_total']); ?></td>
                                                            </tr>
                                                            
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
                                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DEL PEDIDO</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Referencia: </td>
													<td colspan="" style="width:30%;"><?php echo htmlentities($data['referencia']); ?></td>
													<td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Status: </td>
													<td colspan=""><?php echo htmlentities($data['status'])."<br>".$data['usuario_validacion'].":".$data['fecha_validacion']; ?></td>
                                                </tr>
                                                <tr>
													<td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Observaciones: </td>
                                                    <td colspan=""><?php echo $data['comentarios']; ?></td>
                                                    <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;"> </td>
													<td colspan="" style="width:30%;"><?php ?></td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">PRODUCTOS DEL PEDIDO : </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="width:100%;">
														<table style="height: 100%;width:100%;">
                                                            <tr>
                                                                <td colspan="11" style="background-color:#d0d0cf; font-weight:bold; text-align: center"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant. Ant</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Producto</td>
                                                                <?php if($_SESSION['user_info']['costos']) { ?>
                                                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Costo </td>
                                                                <?php } ?>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Mayoreo </td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Precio </td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Total </td>
                                                                <?php if($_SESSION['user_info']['costos']) { ?>
                                                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Total Costo</td>
                                                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Utilidad</td>
                                                                <?php } ?>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Status</td>
                                                                <td colspan="" style="background-color:#d0d0cf; font-weight:bold;"></td>
                                                            </tr>
                                                            <?php 
                                                            $objpv = new PedidoProducto();
                                                            $datapv = $objpv->getAllArr($id,true);
                                                            $totalgral  =  $totalcostogral = $totalutigral = 0;
                                                            foreach($datapv as $row) {
                                                                $objproductos = new Producto();
                                                                $dataproducto = $objproductos->getTable($row['id_producto']);
                                                                $totalcosto   = $row['totalcosto'];
                                                                $total        = $row['cantidad']*$row['precio'];
                                                                $utilidad        = $total - $totalcosto;
                                                                $status = htmlentities($row['status']);
                                                                switch ($status) {
                                                                    case 'BAJA':
                                                                        $status = 'Cancelado';
                                                                        $class  = 'cancelada';
                                                                        break;
                                                                    default:
                                                                        $class  = '';
                                                                        $totalcostogral += $totalcosto;
                                                                        $totalgral      += $total;
                                                                        $totalutigral   += $total - $totalcosto;
                                                                        break;
                                                                } 
                                                                ?>
                                                                <tr class="<?php echo $class; ?>">
                                                                    <td><?php echo htmlentities($row['cantidad_anterior']); ?></td>
                                                                    <td><?php echo htmlentities($row['cantidad']); ?></td>
                                                                    <td><?php echo htmlentities($dataproducto['codinter']); ?></td>
                                                                    <td><?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                                                                    <?php if($_SESSION['user_info']['costos']) { ?>
                                                                        <td><?php echo htmlentities($row['costo']); ?></td>
                                                                    <?php } ?>
                                                                    <td><?php echo htmlentities($row['mayoreo']); ?></td>
                                                                    <td><?php echo htmlentities($row['precio']); ?></td>
                                                                    <td><?php echo $total; ?></td>
                                                                    <?php if($_SESSION['user_info']['costos']) { ?>
                                                                        <td><?php echo $totalcosto; ?></td>
                                                                        <td><?php echo $utilidad; ?></td>
                                                                    <?php } ?>
                                                                    <td><?php echo htmlentities($row['status'])."<br>".$row['fecha_validacion']; ?></td>
                                                                    <td class='borrar-td'>
                                                                        <?php 
                                                                        if ($row['status']!='BAJA'){ ?> 
                                                                           
                                                                                <a href="#" class="btn btn-danger" onclick="borrar('<?php echo make_url("Pedidos","pedidoproductodelete",array('id'=>$row['id_pedido_producto'])); ?>',<?php echo $row['id_pedido_producto']; ?>);" > <i class="fas fa-ban"></i></a>
                                                                            
                                                                        <?php 
                                                                        } ?>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                            } 
                                                            ?>
                                                            <tr>  
                                                                <td colspan="4"></td>
                                                                <?php if($_SESSION['user_info']['costos']) { ?>
                                                                    <td></td> 
                                                                <?php } ?>
                                                                <td ></td> 
                                                                <td style='font-weight:bold;'>Total:</td>
                                                                <td><strong><?php echo $totalgral; ?></strong></td>
                                                                <?php if($_SESSION['user_info']['costos']) { ?>
                                                                    <td><strong><?php echo $totalcostogral; ?></strong></td>
                                                                    <td><strong><?php echo $totalutigral; ?></strong></td>
                                                                <?php } ?>
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
        validar = function(id_pedido){
            var url = config.base+"/Pedidos/ajax/?action=get&object=validar"; 
            $.ajax({
                type: "POST",
                url: url,
                data: "id_pedido="+id_pedido, 
                success: function(response){
                    if(response>0){
                        notify('success','Exito');
                        location.reload();
                    }else{
                        console.log(response);
                        return notify('error',"Oopss error al validar"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        }
        showpopuppagar = function(id_pedido){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo Pago</span>');
            $.get(config.base+"/Pedidos/ajax/?action=get&object=showpopuppagar&id="+id_Pedido, null, function (response) {
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
            var url = config.base+"/Pedidos/ajax/?action=get&object=savenewpago"; 
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
