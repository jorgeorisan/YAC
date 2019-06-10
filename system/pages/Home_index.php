<?php
//initilize the page
//require_once(SYSTEM_DIR . "\inc\init.php");
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)

require_once(SYSTEM_DIR . "/inc/config.ui.php");
/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php

include(SYSTEM_DIR . "/inc/nav.php");  //pone el menu de la izquierda


if($_SESSION['user_info']['id_usuario_tipo']=='4') // empleado
	header("Location:". make_url("Ventas","add"));

	
$citas  = new Cita();
$events = [];
if($res=$citas->getAllArr()){
	foreach($res as $key => $row) {
		$clientes = new Persona();
		$cliente  = $clientes->getTable($row['id_persona']);
		if(!$cliente) continue;
		$users     = new Usuario();
		$datauser      = $users->getTable($row['id_user']);
		$idHistorial = '';
		$link = make_url("Historial","consulta",array('id'=>$row['id_persona'],'id_cita'=>$row['id']));
		
		$nombrecliente  = htmlentities($cliente['nombre']." ".$cliente['ap_paterno']." "); 
		$user		    = htmlentities($datauser['nombre']);
		switch ($row['status']) {
			case 'active':	   $status = 'Pendiente';  $class = "bg-color-blue"; 	  $editable = true;  $icon = "fa-clock-o"; break;
			case 'deleted':    $status = 'Cancelada';  $class = "bg-color-red";	      $editable = false; $icon = "fa-warning"; break;
			case 'Completada': $status = 'Completada'; $class = "bg-color-greenLight";$editable = false; $icon = "fa-check";   break;
			default: 	       $status = 'N/A';		   $class = "";           	      $editable = true;  $icon = "";           break;
		}
		
		if($status == 'Completada'){
			$objH  = new Historial();
			$dataH = $objH->getTableFilter(array('id_cita',$row['id']));  
			$idHistorial= $dataH['id'];
			$link = make_url("Historial","view",array('id'=>$idHistorial));
		}
		
		$event = array([
			"title"       => $nombrecliente,
			"start"       => $row['fecha_inicial'],
			"hora_ini"    => date('h:i A',strtotime($row['fecha_inicial'])),
			"hora_fin"    => date('h:i A',strtotime($row['fecha_final'])),
			"end"         => $row['fecha_final'],
			"motivo" 	  => $row['motivo'],
			"status" 	  => $status,
			"allDay"      => false,
			"className"   => array('event', $class),
			"icon"        => $icon,
			"id_cita"     => $row['id'],
			"editable"    => $editable,
		]);	
		$events=array_merge($event, $events);
	}

}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Calendario"] = "";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<div class="widget-body" style='padding: 15px;'>
			<a class="btn btn-success" href="<?php echo make_url("Citas","add")?>" >Nueva Cita</a>
			<a class="btn btn-info" href="<?php echo make_url("Citas","index")?>" >Calendario Lista</a>
		</div>
		<!--  BEGIN pages -->
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<!-- new widget -->
				<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="true"  >
		
					<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
		
					data-widget-colorbutton="false"
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true"
					data-widget-sortable="false"
		
					-->
					<header>
						<span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
						<h2> Citas </h2>
						<div class="widget-toolbar">
							<!-- add: non-hidden - to disable auto hide -->
							<div class="btn-group">
								<button class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown">
									Mostrar <i class="fa fa-caret-down"></i>
								</button>
								<ul class="dropdown-menu js-status-update pull-right">
									<li>
										<a href="javascript:void(0);" id="mt">Mes</a>
									</li>
									<li>
										<a href="javascript:void(0);" id="ag">Agenda</a>
									</li>
									<li>
										<a href="javascript:void(0);" id="td">Hoy</a>
									</li>
								</ul>
							</div>
						</div>
					</header>
		
					<!-- widget div-->
					<div>
		
						<div class="widget-body no-padding">
							<!-- content goes here -->
							<div class="widget-body-toolbar">
		
								<div id="calendar-buttons">
		
									<div class="btn-group">
										<a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i class="fa fa-chevron-left"></i></a>
										<a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
							<div id="calendar"></div>
		
							<!-- end content -->
						</div>
		
					</div>
					<!-- end widget div -->
				</div>
				<!-- end widget -->
				
			</div>
		</div>


		<!--  END pages -->
	</div>
	<!-- END MAIN CONTENT -->

	<canvas id="canvas"></canvas>
</div>
<li>
	<a data-toggle="modal" class="btn-addnewcita" title="Nueva Cita" href="#myModal" >
		<i class="fa fa-history"></i>&nbsp;Nueva cita</a>
</li>
<!-- Modal  to Add Event -->
<div class="modal fade" id="myModal"  role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width:110%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="50" alt="SmartAdmin">
                    <div id='titlemodal' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> </span>
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
<!-- Modal clientes -->
<div class="modal fade" id="myModalSecond" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="100" alt="SmartAdmin">
                    <div id='titlemodalsecond' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> Nuevo</span>
                    </div>
                    
                </h4>
            </div>
            <div class="modal-body no-padding" >
                <div id="contentpopupsecond">

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--Modal-->
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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/moment/moment.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>

<script>
	
	

	$(document).ready(function() {
		
		/* DO NOT REMOVE : GLOBAL FUNCTIONS!
		 *
		 *
		 ********************************
		 *
		 * pageSetUp() is needed whenever you load a page.
		 * It initializes and checks for all basic elements of the page
		 * and makes rendering easier.
		 *
		 */
		 pageSetUp();

		"use strict";
	
	    var date = new Date();
	    var d = date.getDate();
	    var m = date.getMonth();
		var y = date.getFullYear();
		var baseurl = '<?php echo APP_URL ?>';
	
	    var hdr = {
	        left: 'title',
	        center: 'month,agendaWeek,agendaDay',
	        right: 'prev,today,next'
		};
		$('#myModal').on('hidden.bs.modal', function () {
            $('#myModalSecond').modal('hide');
        });
		// nueva cita
		function addnewcita(date){
			$("#myModal").modal("show");
			$('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nueva Cita</span>');
			$.get(config.base+"/Citas/ajax/?action=get&object=showpopup&date="+date, null, function (response) {
				if ( response ){
					$("#contentpopup").html(response);
				}else{
					return notify('error', 'Error al obtener los datos del Formulario de citas');
					
				}     
			});
		}
		$('body').on('click', '#savenewcita', function(){
            validateForm();
        });
		
        validateForm =function(){
            var fecha_inicial = $("input[name=fecha_inicial]").val();
            var fecha_final   = $("input[name=fecha_final]").val();
            var id_persona    = $("#id_persona").val();
            var id_personal   = $("#id_usuario").val();
            var motivo        = $("#motivo").val();
            if ( ! fecha_inicial )              return swal("La fecha de inicio es requerida");
            if ( ! fecha_final )                return swal("La Hora final es requerida");
            if ( fecha_final < fecha_inicial )  return swal("La Hora final no puede ser menor a la fecha de inicio");      
            if ( ! id_persona )                 return swal("El Cliente es requerido");
            if ( ! id_personal )                return swal("El Usuario es requerido");
            if ( ! motivo )                     return swal("El Tratamiento es requerido");
            saveNewCita();
        }
        $(document).keydown(function(event) {
            if (event.ctrlKey==true && (event.which == '106' || event.which == '74')) {
                // alert('thou. shalt. not. PASTE!');
                event.preventDefault();
            }
        });
      
        //**********clientes*************/
        showpopupclientes = function(){
            $('#titlemodalsecond').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo Cliente</span>');
            $.get(config.base+"/Clientes/ajax/?action=get&object=showpopup", null, function (response) {
                    if ( response ){
                        $("#contentpopupsecond").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario de pacientes');
                        
                    }     
            });
        }
        getcliente =function(id){
            if ( ! id ) return;
            $("#contcliente").html("<div align='center'><i class='far fa-cog fa-spin fa-5x'></i></div>");
            $.get(config.base+"/Citas/ajax/?action=get&object=getcliente&id=" + id, null, function (response) {
                if ( response ){
                    $("#contcliente").html(response);
                }else{
                    notify('error', 'Error al obtener los datos del cliente');
                    return false;
                }     
            });
        }
        $('body').on('click', '#savenewcliente', function(){
            
            var nombre       = $("input[name=nombre]", $(this).parents('form:first')).val();
            var ap_paterno = $("input[name=ap_paterno]", $(this).parents('form:first')).val();
            var ap_materno = $("input[name=ap_materno]", $(this).parents('form:first')).val();
            var telefono     = $("input[name=telefono]", $(this).parents('form:first')).val();
            
            if(!nombre)   {  swal("Se necesita el nombre del cliente.");   return false; }
            if(!telefono) {  swal("Se necesita el telefono del cliente."); return false; }
            var url = config.base+"/Clientes/ajax/?action=get&object=savenewclient"; // El script a dónde se realizará la petición.
            $(this).hide();
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).parents('form:first').serialize(), // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#id_persona').append($('<option>', {
                            value: response,
                            text: nombre+" "+ap_paterno+" "+ap_materno,
                            selected:true
                        }));  
                        $("#id_persona").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        swal("cliente agregado correctamente:"+response);
                        $('#myModalSecond').modal('hide');
                        getcliente(response);
                    }else{
                        swal("Oopss error al agregar cliente"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('click', '#deletecita', function(){
            swal({
                title: "Estas seguro?",
                text: "Deseas eliminar este registro?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Si, Eliminar!',
                closeOnConfirm: true
                },
                function(){
                    var id_cita  = $("input[name=id_cita]").val();
                    var url = config.base+"/Citas/ajax/?action=post&object=deletecita"; // El script a dónde se realizará la petición.
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: "id_cita="+id_cita, 
                        success: function(response){
                            if(response>0){
                                location.reload();
                            }else{
                                swal("Oopss error al agregar cliente"+response);
                            }
                        }
                    });
                }
            );
        
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('click', '#generarconsulta', function(){
            swal({
                title: "Estas seguro?",
                text: "Deseas generar una nueva consulta?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#555FDD',
                confirmButtonText: 'Si, Generar!',
                closeOnConfirm: true
                },
                function(){
                    var id_cita  = $("input[name=id_cita]").val();
                    var url = config.base+"/Citas/ajax/?action=get&object=geturldate"; // El script a dónde se realizará la petición.
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: "id_cita="+id_cita, 
                        success: function(response){
                            if(response){
                                window.location.replace(response);
                            }else{
                                swal("Oopss error al generar consulta"+response);
                            }
                        }
                    });
                }
            );
        });
        $('body').on('change', '#id_persona', function(){
            if( $(this).val() ){
                var id = $("#id_persona").val();
                getcliente(id);
            }
        });
        $('body').on('change', '#fecha', function(){
            $('#fecha_inicial').val( $(this).val() + ' ' + $('#hora_inicial').val() );
            $('#fecha_final').val( $(this).val() + ' ' + $('#hora_fin').val() );
            if( $(this).val() ){
               var fechaini    = new Date($('#fecha_inicial').val());
               var fechafin    = $('#fecha_final');
               var fechafintxt = $('.fecha_finaltxt');
               var minutos     = fechaini.setMinutes(fechaini.getMinutes() + 60);
               var nuevafecha  = fechaini.getFullYear() + '-' + ("0"+(fechaini.getMonth()+1)).slice(-2) + '-' + ("0" + fechaini.getDate()).slice(-2) +' ' + ("0" + fechaini.getHours()).slice(-2) + ":" +("0" + fechaini.getMinutes()).slice(-2);
               fechafin.val(nuevafecha);
               fechafintxt.val(nuevafecha);
               $('.fecha_final').attr('data-date',nuevafecha);
               //getcitasproximas();
            }
        });
        $('body').on('change', '#hora_inicial', function(){
            $('#fecha_inicial').val( $('#fecha').val() + ' ' + $(this).val() );
        });
        $('body').on('change', '#hora_fin', function(){
            $('#fecha_final').val(   $('#fecha').val() + ' ' + $(this).val() );
        });
       
		saveNewCita = function () {
            var url = config.base+"/Citas/ajax/?action=post&object=savenewcita"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
				dataType: "json",
                data: $('#main-form').serialize(), // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response){
						//$('#calendar').fullCalendar( 'refresh' );
						//location.reload();
						var event=response;
						$('#calendar').fullCalendar( 'renderEvent', event, true);
						
						$('#myModal').modal('hide');
                    }else{
						swal("Oopss error al agregar cita"+response);
						console.log(response);
                    }
                }
             });
        }
		
       
		//**********Citas*************/
		showpopupcitas = function(){
			
		}
	    /* initialize the calendar
		 -----------------------------------------------------------------*/
	
	    $('#calendar').fullCalendar({
	
	        header: hdr,
	        editable: true,
	        droppable: true, // this allows things to be dropped onto the calendar !!!

	        drop: function(date, jsEvent, ui, resourceId) {
				//alert("drop: " + date.format());
				// cuando agregas un nuevo elemento
			},
			eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
				// cuando cambias un evento a otro dia
				$.get(config.base+"/Citas/ajax/?action=get&object=changedaycita&id_cita="+event.id_cita + '&date=' + event.start.format(), null, function (response) {
					if ( response ){
						return notify('success','Reagendado con exito');
					}else{
						return notify('error', 'Error al obtener los datos del Formulario de citas');
					}     
				});
			},
			select: function(start, end, jsEvent) {  // click on empty time slot
				console.log('select');
                endtime = $.fullCalendar.moment(end).format('h:mm');
                starttime = $.fullCalendar.moment(start).format('dddd, MMMM Do YYYY, h:mm');
                var mywhen = starttime + ' - ' + endtime;
                start = moment(start).format();
                end = moment(end).format();
                $('#createEventModal #startTime').val(start);
                $('#createEventModal #endTime').val(end);
                $('#createEventModal #when').text(mywhen);
                $('#createEventModal').modal('toggle');
            },
			events: <?php echo json_encode($events); ?>,  // eventos json
			
			eventClick: function(event, jsEvent, view) {
				//un click
				//console.log('Event: ' + event.title+
				//'Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY+
				//'start: ' + event.start );
				//jsEvent.preventDefault(); // don't let the browser navigate

				
			},
	        eventRender: function (event, element, icon) {
				element.bind('dblclick',function(){
					//doble click
					if (event.id_cita) {
						$("#myModal").modal("show");
						$('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Editar Cita</span>');
						$.get(config.base+"/Citas/ajax/?action=get&object=showpopup&page=edit&id_cita="+event.id_cita, null, function (response) {
								if ( response ){
									$("#contentpopup").html(response);
								}else{
									return notify('error', 'Error al obtener los datos del Formulario de citas');
									
								}     
						});
					}
				});
				if (!event.status == "") {
	                element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.motivo +': ' + event.hora_ini + ' a ' + event.hora_fin + "</span>");
	            }
	            if (!event.icon == "") {
	                element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon +" '></i>");
	            }
			},
			dayClick: function(date, element, view) {
				// un click donde no hay elemento
				addnewcita(date.format());
			},
	        windowResize: function (event, ui) {
	            $('#calendar').fullCalendar('render');
			}
			
	    });
	
	    /* hide default buttons */
	    $('.fc-right, .fc-center').hide();

	
		$('#calendar-buttons #btn-prev').click(function () {
		    $('.fc-prev-button').click();
		    return false;
		});
		
		$('#calendar-buttons #btn-next').click(function () {
		    $('.fc-next-button').click();
		    return false;
		});
		
		$('#calendar-buttons #btn-today').click(function () {
		    $('.fc-today-button').click();
		    return false;
		});
		
		
		$('#mt').click(function () {
		    $('#calendar').fullCalendar('changeView', 'month');
		});
		
		$('#ag').click(function () {
		    $('#calendar').fullCalendar('changeView', 'agendaWeek');
		});
		
		$('#td').click(function () {
		    $('#calendar').fullCalendar('changeView', 'agendaDay');
		});		

		///
		// functions sistema
		//
	
	
	});

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
