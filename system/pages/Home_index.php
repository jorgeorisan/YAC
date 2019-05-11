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
$citas  = new Cita();
$events = [];
if($res=$citas->getAllArr()){
	foreach($res as $key => $row) {
		$personas = new Persona();
		$persona  = $personas->getTable($row['id_persona']);
		$users     = new Usuario();
		$user      = $users->getTable($row['id_usuario']);
		$persona  = new Persona();
		$persona   = $persona->getTable($row['id_persona']);
		$nombrepersona  = htmlentities($persona['nombre']." ".$persona['ap_paterno']." ".$persona['ap_materno']." "); 
		$nombrepersona  = htmlentities($persona['nombre']." ".$persona['ap_paterno']." ".$persona['ap_materno']." ");
		$nombreuser      = htmlentities($user['id_usuario']);
		switch ($row['status']) {
			case 'active':	   $status = 'Pendiente';  $class = "bg-color-blue"; 	   $icon = "fa-clock-o"; break;
			case 'deleted':    $status = 'Cancelada';  $class = "bg-color-red";	       $icon = "fa-warning"; break;
			case 'Finalizada': $status = 'Finalizada'; $class = "bg-color-greenLight"; $icon = "fa-check";   break;
			default: 	       $status = 'N/A';		   $class = "";           	       $icon = "";           break;
		}
		$event = array([
			"title"       => $nombrepersona,
			"start"       => $row['fecha_inicial'],
			"end"         => $row['fecha_final'],
			"description" => $status,
			"allDay"      => false,
			"className"   => array('event', $class),
			"url"         => make_url("Historial","consulta",array('id'=>$row['id_persona'],'id_cita'=>$row['id'])),
			"icon"        => $icon
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
	<a data-toggle="modal" class="btn-newevent" title="Nueva Cita" href="#myModal" >
		<i class="fa fa-history"></i>&nbsp;Nueva cita</a>
</li>
<!-- Modal  to Add Event -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
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
		// nueva cita
		function newEvent(date){
			$.get(config.base+"/Citas/ajax/?action=get&object=geturldate&date="+date, null, function (response) {
				if ( response ){
					location.href=response;
				}else{
					return notify('error', 'Error al redirigir a nueva cita');
				}    
			});
			
		}
	
	    /* initialize the calendar
		 -----------------------------------------------------------------*/
	
	    $('#calendar').fullCalendar({
	
	        header: hdr,
	        editable: true,
	        droppable: true, // this allows things to be dropped onto the calendar !!!
	
	        drop: function (date, allDay) { // this function is called when something is dropped
	
	            // retrieve the dropped element's stored Event Object
	            var originalEventObject = $(this).data('eventObject');
	
	            // we need to copy it, so that multiple events don't have a reference to the same object
	            var copiedEventObject = $.extend({}, originalEventObject);
	
	            // assign it the date that was reported
	            copiedEventObject.start = date;
	            copiedEventObject.allDay = allDay;
	
	            // render the event on the calendar
	            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
	            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
	
	            // is the "remove after drop" checkbox checked?
	            if ($('#drop-remove').is(':checked')) {
	                // if so, remove the element from the "Draggable Events" list
	                $(this).remove();
	            }
	
	        },
	
	        select: function(start, end, jsEvent) {  // click on empty time slot
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
	        events: <?php echo json_encode($events); ?>,  // request to load current events
			eventClick: function(event, jsEvent, view) {
				//alert('Event: ' + event.title);
				//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
				//alert('start: ' + event.start);
				jsEvent.preventDefault(); // don't let the browser navigate

				if (event.url) {
					location.href=event.url;
				}
			},
	        eventRender: function (event, element, icon) {
	            if (!event.description == "") {
	                element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.description +
	                    "</span>");
	            }
	            if (!event.icon == "") {
	                element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon +
	                    " '></i>");
	            }
			},
			dayClick: function(date, jsEvent, view) {
				newEvent(date.format());
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
