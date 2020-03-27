<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["action"]) {
		case 'get':
			switch ($_GET["object"]) {
				
				case 'geturldate':
					$id_historialtratamiento= ( isset($_GET["id_historialtratamiento"]) ) ? $_GET["id_historialtratamiento"] : '';
					if( isset($_GET["id_cita"])){
						$id_cita = $_GET["id_cita"];
						$objcita = new Cita();
						$id_cita 				 = $_GET["id_cita"];
						$requestCita['id_historialtratamiento'] = $id_historialtratamiento;
						$id = $objcita->updateAll($id_cita,$requestCita);
						
						echo make_url("Pacientes","consulta",array('id_cita'=>$id_cita ));
					}
					break;
				case 'getcitas':
					$citas  = new Cita();
					if($res=$citas->getAllArr()){
						foreach($res as $row) {
							$personas = new Persona();
							$persona  = $personas->getTable($row['id_persona']);
							$users     = new User();
							$user      = $users->getTable($row['id_user']);
							
							$nombrepersona  = htmlentities($persona['nombre']." ".$persona['ap_paterno']." ".$persona['ap_materno']." "); 
							$nombreuser      = htmlentities($user['nombre']." ".$user['ap_paterno']." ".$user['ap_materno']." ");
							switch ($row['status']) {
								case 'active':	   $status = 'Pendiente';  $class = "bg-color-blue"; 	   $icon = "fa-clock-o"; break;
								case 'deleted':    $status = 'Cancelada';  $class = "bg-color-red";	       $icon = "fa-warning"; break;
								case 'Finalizada': $status = 'Finalizada'; $class = "bg-color-greenLight"; $icon = "fa-check";   break;
								default: 	       $status = 'N/A';		   $class = "";           	       $icon = "";           break;
							}
							$events['title']       = $nombrepersona; 
							$events['start']       = $row['fecha_inicial']; 
							$events['end']         = $row['fecha_final']; 
							$events['description'] = $status; 
							$events['allDay'] 	   = 'false'; 
							$events['url'] 		   = make_url("Citas","historial",array('id'=>$row['id_persona'] )); 
							$events['icon']        = $icon; 
							
						}
					}
					respondData($events);
					
					break;
				case 'getcliente':
					if( isset($_GET["id"]) && intval($_GET["id"]) ){
						$u = new Persona();
						if($res=$u->getTable($_GET['id'])){
							echo $data="
								<table border=1 style=' border-color: #CCC;' class='table table-striped table-bordered table-hover'>
									<tr  align='center'>
										<td colspan='2'>
											<h4><strong>Datos del cliente &nbsp; <a  class='btn btn-info' target='_blank' title='Editar Historial' href='".make_url("Clientes","edit",array('id'=>$res['id_persona']))."'><i class='fa fa-eye'></i></a></strong></h4>
										</td>
									</tr>
									<tr>
										<td><strong>Nombre:</strong></td>
										<td>" . htmlentities($res["nombre"] ." ".$res["ap_paterno"] ." ".$res["ap_materno"]) . "</td>
									</tr>
									<tr>
										<td><strong>Email:</strong></td><td>"   .htmlentities($res["email"])     . "</td>
									</tr>
									<tr>
										<td><strong>Telefono:</strong></td><td>" .htmlentities($res["telefono"]) . "</td>
									</tr>
									<tr><td><strong>Direccion:</strong></td><td>" .htmlentities($res["ciudad"]." ".$res["estado"]). " Col." .htmlentities($res["colonia"]) ." Call." .htmlentities($res["calle"]." ".$res["num_exterior"]. " " .$res["num_interior"])."</td>
									</tr>
								</table>";
						}else{
							echo 0;
						}
					}else{
						echo 0;
					}
					break;
				case 'getcitasproximas':
					if( isset($_GET["fecha_inicial"]) || isset($_GET["id_persona"])){
						$objcita = new Cita();
						$fecha_inicial  = ( isset($_GET['fecha_inicial']) ) ?  date('Y-m-d',strtotime($_GET['fecha_inicial'])) : date('Y-m-d'); 
						$id_persona    = ( isset($_GET['id_persona']) )   ? $_GET['id_persona'] : ''; 
						
						$arrayfilters['fecha_inicial'] = $fecha_inicial;
						$arrayfilters['id_persona']    = $id_persona;
						$arrayfilters['status']   	   = 'active';
						$data = $objcita->getAllArr($arrayfilters);
						include(SYSTEM_DIR.'/pages/Citas/Citas_getcitasproximas.php' );
					}
					break;
						
				case 'existecita':
					if( isset($_GET["fecha_inicial"]) && isset($_GET["fecha_final"]) && isset($_GET["id_user"])){
						$u = new Cita();
						if($res=$u->getExisteCita($_GET["fecha_inicial"],$_GET["fecha_final"],$_GET["id_usuario"])){
							echo 1;
						}else{
							echo 0;
						}
					}else{
						echo 0;
					}
					break;
				case 'changedaycita':
					if( isset($_GET["id_cita"]) && isset($_GET["date"]) ){
						$obj = new Cita();
						$cita=$obj->getTable($_GET["id_cita"]);
						if(!$cita) echo 0;
						$requestCita['fecha_inicial'] = date('Y-m-d',strtotime($_GET['date'])).' '.date('H:i:s',strtotime($cita['fecha_inicial']));
						$requestCita['fecha_final']   = date('Y-m-d',strtotime($_GET['date'])).' '.date('H:i:s',strtotime($cita['fecha_final']));
						$id=$obj->updateAll($_GET["id_cita"],$requestCita);
						if($id>0){
							echo $id;
						}else{
							echo 0;
						}
					}else{
						echo 0;
					}
					break;		
				case 'showpopup':

					$date = date('Y-m-d H:i');
					if(isset($_GET['date'])) {
						$date = $_GET['date'];
						$date = (count(explode('T',$date))) ? date('Y-m-d H:i',strtotime($_GET['date'])) : $_GET['date'].' '.date('H:i');
					} 
					$page = (isset($_GET['page'])) ? $_GET['page'] : 'add';
					$id_cita = '';
					$title   = 'Agendar Cita';
					$motivo = $id_persona = $id_user = '';
					$statuscita ='active';
					$fecha_inicial =  date('Y-m-d H:i',strtotime($date));
					$hora_inicial  =  date('H:i',strtotime($date));
					if(isset($_GET['id_cita'])){
						$id_cita=$_GET['id_cita'];
						$citas = new Cita();
						$cita  = $citas->getTable($id_cita);
						$date  = ($cita['fecha_inicial']) ? $cita['fecha_inicial'] : $date;
						$motivo        = $cita['motivo'];
						$id_persona    = $cita['id_persona'];
						$id_user       = $cita['id_user'];
						$date  		   =  date('Y-m-d H:i',strtotime ( $date ) );
						$statuscita    = $cita['status'];
						$title   	   = 'Reagendar Cita';
						$fecha_inicial = ($date) ? $date : date('Y-m-d H:i');
						$hora_inicial  = ($date) ? date('H:i',strtotime($date)) : date('H:i');
					}
					if($hora_inicial=='00:00'){
						$hora_inicial  = date('H:i');
						$fecha_inicial =  date('Y-m-d',strtotime($date)).' '.$hora_inicial;
					} 
					$fecha_final   = strtotime ( '+1 hour' , strtotime ( $fecha_inicial ) ) ;
					$hora_final    = date('H:i',$fecha_final);
					include(SYSTEM_DIR.'/pages/Citas/Citas_addpopup.php' );
					break;
				default:
					# code...
					break;
			}
			break;
		case 'post':
			switch ($_GET["object"]) {
				case 'savenewcita':
					$obj = new Cita();
					if(isPost()){
						if (intval($_POST['id_cita'])) {
							//update
							$motivo2 = (isset($_POST['motivo2'])) ? $_POST['motivo2'] : '';
							$requestCita['fecha_inicial']           = (isset($_POST['fecha_inicial']))          ? $_POST['fecha_inicial']          : '';
							$requestCita['fecha_final']             = (isset($_POST['fecha_final']))            ? $_POST['fecha_final']            : '';
							$requestCita['motivo'] 		            = (isset($_POST['motivo']))                 ? $_POST['motivo']                 : '';
							$requestCita['id_user']                 = (isset($_POST['id_user']))             	? $_POST['id_user']           	   : '';
							$requestCita['id_persona']              = (isset($_POST['id_persona']))             ? $_POST['id_persona']             : '';
							$requestCita['id_historialtratamiento'] = (isset($_POST['id_historialtratamiento']))? $_POST['id_historialtratamiento']: '';
							$requestCita['motivo']=$requestCita['motivo'].'|'.$motivo2;
							$id=$obj->updateAll($_POST['id_cita'],$requestCita);
						}else{
							//add new
							$motivo2 = (isset($_POST['motivo2'])) ? $_POST['motivo2'] : '';
							$_POST['motivo']  = $_POST['motivo'].'|'.$motivo2;
							$id=$obj->addAll(getPost());
						}						
						if($id){
							$datacita=$obj->getTable($id);
							$tiendas = new Tienda();
							$tienda  = $tiendas->getTable($datacita['id_tienda']);
							$class = ($tienda['color'])? "bg-color-".$tienda['color'] : '';
							switch ($datacita['status']) {
								case 'active':	   $status = 'Pendiente';  $editable = true;  $icon = "fa-clock-o"; break;
								case 'deleted':    $status = 'Cancelada';  $class = "bg-color-red";	      $editable = false; $icon = "fa-warning"; break;
								case 'Completada': $status = 'Completada'; $class = "bg-color-greenLight";$editable = false; $icon = "fa-check";   break;
								default: 	       $status = 'N/A';		   $editable = true;  $icon = "";           break;
							}
							$event = array(
								"title"       => $datacita['persona'],
								"start"       => $datacita['fecha_inicial'],
								"hora_ini"    => date('h:i A',strtotime($datacita['fecha_inicial'])),
								"hora_fin"    => date('h:i A',strtotime($datacita['fecha_final'])),
								"end"         => $datacita['fecha_final'],
								"status" 	  => $status,
								"motivo" 	  => $datacita['motivo'],
								"allDay"      => false,
								"className"   => array('event', $class),
								"icon"        => $icon,
								"id_cita"     => $id,
								"editable"    => $editable,
							);	
							echo json_encode($event);
						}else{
							echo 0;
						}
					}
					break;
				case 'deletecita':
					$obj = new Cita();
					if(isPost()){
						$id_cita = (intval($_POST['id_cita'])) ? $_POST['id_cita'] : die();
						$id=$obj->deleteAll($id_cita);
						if($id>0){
							echo $id;
						}else{
							echo 0;
						}
					}
					break;
				case 'changestatuscita':
					$obj = new Cita();
					if(isPost()){
						$id_cita = (intval($_POST['id_cita'])) ? $_POST['id_cita'] : die();
						$requestCita['status']='Completada';
						$id=$obj->updateAll($id_cita,$requestCita);
						if($id){
							echo $id_cita;
						}else{
							echo 0;
						}
					}
					break;
				default:
					# code...
					break;
			}
			break;
	}

	
	
}

?>