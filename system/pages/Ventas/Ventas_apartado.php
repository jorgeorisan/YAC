<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Reporte de Ventas a Apartados";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");

$obj = new Venta();

$dataventas = $obj->getReporteVentasApartados();
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		//$breadcrumbs["Add client"] = APP_URL."/Clients/add";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">
		<section id="widget-grid" class="">
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
							<div class="widget-body">
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th class = "col-md-1" data-hide="phone,tablet"> </th>
											<th class = "col-md-1" data-class="expand">Folio</th>
											<th class = "col-md-1" data-class="phone,tablet">Vendedor </th>
											<th class = "col-md-1" data-class="phone,tablet">Cliente </th>
											<th class = "col-md-1" data-hide="phone,tablet">Fecha</th>
											<th class = "col-md-1" data-class="phone,tablet">Tipo</th>
											<th class = "col-md-1" data-class="phone,tablet">Tienda</th>
											<th class = "col-md-1" data-class="phone,tablet">Total</th>
											<th class = "col-md-1" data-class="phone,tablet">Pagado</th>
											<th class = "col-md-1" data-class="phone,tablet">%Pagado</th>
											<th class = "col-md-1" data-class="phone,tablet">Deuda</th>
											<th class = "col-md-1" data-class="phone,tablet">Dias</th>
											<th class = "col-md-1" data-class="phone,tablet"></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$nomtienda = '';
										$total = 0;
										foreach($dataventas as $row) {
											$tienda = new Tienda();
											$datatienda = $tienda->getTable($row["id_tienda"]);
											if($datatienda) $nomtienda = $datatienda["nombre"]; 
										
											$descuento = ($row["descuento"])   ? $row["descuento"] : ''; 
											$class     = ($row["cancelado"]) ? "class='cancelada'" : '';
											
											if ($row['cancelado']==0) {
												$total += $row['total'];
											}
											$totalpagado = $obj->getpagado($row["id_venta"]);
											$porcentpagado = ($totalpagado * 100  / $row['total']);

											if ($porcentpagado >= 75)
												$class  = 'label label-success';
											if (($porcentpagado >= 50 && $porcentpagado < 75) )
												$class  = 'label label-warning';
											if ($porcentpagado < 50 )
												$class  = 'label label-danger';
											?>
											<tr <?php echo $class;?>>
												<td>
													<a class="" href="<?php echo make_url("Ventas","view",array('id'=>$row['id_venta'])); ?>">
														<?php echo htmlentities($row['id_venta'])?>:Ver
													</a>
												</td>
												<td><?php echo htmlentities($row['folio'])?></td>
												<td><?php echo htmlentities($row['id_usuario'])?></td>
												<td><a class="" href="<?php echo make_url("Clientes","view",array('id'=>$row['id_persona'])); ?>">
														<?php echo htmlentities($row['cliente'])."<br>".htmlentities($row['telefono'])?>
													</a>
												</td>
												<td><?php echo htmlentities($row['fecha'])?></td>
												<td>
													<?php echo htmlentities($row['tipo'])."<br>";
													if($row['icredito']){
														echo "<span style='color:red'>En pago</span>";
													}
													?>
												</td>
												<td> <?php echo htmlentities($nomtienda) ?></td>
												<td>$<?php echo number_format($row['total'], 2); ?></td>
												<td>$<?php echo number_format($totalpagado, 2); ?></td>
												<td> <?php echo "<span class='".$class."'>".number_format($porcentpagado,0)."%</span>"; ?></td>
												<td>$<?php echo number_format($row['total']-$totalpagado, 2)?></td>
												<td> <?php echo $row['dias']; ?></td>
												<td>
													
													
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Accion <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a title="Ver Venta" class=""  href="<?php echo make_url("Ventas","view",array('id'=>$row['id_venta'])); ?>"> Ver Venta</a>
															</li>
															<li>
																<a title="Imprimir Venta" class="" target="_blank" href="<?php echo make_url("Ventas","print",array('id'=>$row['id_venta'],'page'=>'venta')); ?>">Imprimir</a>
															</li>
															<?php 
															if (!$row['cancelado']){ ?> 
																<?php if($row['icredito']){ ?>
																	<li>
																		<a data-toggle="modal" class="" href="#myModal" onclick="showpopuppagar(<?php echo $row['id_venta'] ?>)"> Pagar</a>
																	</li>
																<?php } ?>
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
									<tfoot>
										<tr>
											<th colspan="6" style="text-align:right">Total:</th>
											<th><?php echo $total;?></th>
											<th></th>
											<th></th>
										</tr>
									</tfoot>
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
<!-- Modal -->
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
<!-- /.modal -->
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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script>
 	
	$(document).ready(function() {
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		$('#dt_basic').dataTable({
			"aaSorting": [[ 1,"asc" ]],
        	"iDisplayLength": 50,

			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
			
		});
		var table = $('#dt_basic2').dataTable();
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
                        //location.reload();
                    }else{
                        return notify('error',"Oopss error al agregar pago"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
		/* DO NOT REMOVE : GLOBAL FUNCTIONS!
		 *
		 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
		 *
		
		 */
		
		

		 pageSetUp();
	})

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
