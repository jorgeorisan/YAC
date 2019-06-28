
<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Pacientes";

/* ---------------- END PHP Custom Scripts ------------- */
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
include(SYSTEM_DIR . "/inc/nav.php");


$obj = new Persona();
$arrayfilters['tipo'] = '11';
$arrayfilters['page'] = 'pacientes';
$data = $obj->getAllArr($arrayfilters);

//print_r($users);
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
			 <p><a class="btn btn-success" href="<?php echo make_url("Pacientes","add")?>" ><i class="fas fa-plus"></i> Nuevo Paciente</a></p>
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
											<th class = "col-md-1" data-hide="phone,tablet">No. Paciente</th>
											<th class = "col-md-1" data-class="expand">Nombre</th>
											<th class = "col-md-1" data-hide="phone"> Email</th>
											<th class = "col-md-1" data-hide=""> Telefono</th>
											<th class = "col-md-1" data-hide="phone,tablet"> Direccion</th>
											<th class = "col-md-1" data-hide="phone,tablet"> Alergico</th>
											<th class = "col-md-1" data-hide="phone,tablet"> Edad</th>
											<th class = "col-md-1" data-hide="phone,tablet">Fecha Alta</th>
											<th class = "col-md-1" data-hide="phone,tablet">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php  foreach($data as $row) {
											$nomtienda = $ano_diferencia  ="";
											$objtienda = new Tienda();
											$datatienda = $objtienda->getTable($row["id_tienda"]);
											if($datatienda){ $nomtienda = $datatienda["nombre"]; }
											
											if($row['fecha_nacimiento']!=""){
												list($ano,$mes,$dia) = explode("-",$row['fecha_nacimiento']);
												$ano_diferencia  = date("Y") - $ano;
												$mes_diferencia = date("m") - $mes;
												$dia_diferencia   = date("d") - $dia;
												if ($dia_diferencia < 0 || $mes_diferencia < 0)
													$ano_diferencia--;
											}
											?>
											<tr>
												<td><?php echo htmlentities($row['id_persona'])?></td>
												<td><a class="" href="<?php echo make_url("Pacientes","consulta",array('id'=>$row['id'])); ?>"><?php echo htmlentities($row['nombre'].' '.$row['ap_paterno'].' '.$row['ap_materno'])?></a></td>
												<td><?php echo htmlentities($row['email'])?></td>
												<td><?php echo htmlentities($row['telefono']) ?></td>
												<td><?php echo htmlentities($row['ciudad']." ".$row['estado']." Col. ".$row['colonia']." Calle. ".$row['calle']." Num. ".$row['num_exterior']." ".$row['num_interior']) ?></td>
												<td><?php //echo htmlentities($row['alergias']); ?></td>
												<td><?php echo $ano_diferencia; ?></td>
												<td><?php echo htmlentities($row['fecha_registro']) ?></td>
												<td>
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Accion <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a data-toggle="modal" href="#myModal" onclick="getcitasproximas(<?php echo $row['id_persona']?>)" >
																	Generar Consulta
																</a>
															</li>
															<li>
																<a class="" href="<?php echo make_url("Historial","view",array('id'=>$row['id_historial'])); ?>">Ver Historial</a>
															</li>
															
															<li class="divider"></li>
															<li>
																<a href="#" class="red" onclick="borrar('<?php echo make_url("Pacientes","personadelete",array('id'=>$row['id_persona'])); ?>',<?php echo $row['id_persona']; ?>);">Eliminar</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
										<?php }?>
									</tbody>
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
                        <span class="widget-icon"><i class="fa fa-plus"></i> Citas Proximas</span>
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
		getcitasproximas = function(id_paciente){
            var id_personal   = $("#id_personal").val();
            var url = config.base+"/Citas/ajax/?action=get&object=getcitasproximas"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "GET",
                url: url,
                data: 'id_paciente='+id_paciente, 
                success: function(response){
                    if(response){
						$("#titlemodal").html('Selecciona la cita del paciente');
						$("#contentpopup").html(response);
                    }else{
                        $("#contentpopup").html(''); 
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        }
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
