<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'geturldate':
			if( isset($_GET["date"])){
				$date = $_GET["date"];
				echo make_url("Citas","add",array('date'=>$date ));
			}
			break;
		case 'getcitas':
			$citas  = new Cita();
			if($res=$citas->getAllArr()){
				foreach($res as $row) {
					$personas = new Paciente();
					$persona  = $personas->getTable($row['id_persona']);
					$users     = new User();
					$user      = $users->getTable($row['id_user']);
					$personal  = new Personal();
					$persona   = $personal->getTable($row['id_persona']);
					$nombrepersona  = htmlentities($persona['nombre']." ".$persona['ap_paterno']." ".$persona['ap_materno']." "); 
					$nombrepersonal  = htmlentities($persona['nombre']." ".$persona['ap_paterno']." ".$persona['ap_materno']." ");
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
					$data="
						<table border=1 style=' border-color: #CCC;'>
							<tr  align='center'><td colspan='2'><h4>Datos del persona</h4></td></tr>";
					$data.="<tr>
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
					echo $data;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
			break;
				
		case 'getcitasproximas':
			if( isset($_GET["fecha_inicial"])  ){
				$objcita = new Cita();
				$fecha_inicial  = ( isset($_GET['fecha_inicial']) ) ?  date('Y-m-d',strtotime($_GET['fecha_inicial'])) : date('Y-m-d'); 
				$arrayfilters['fecha_inicial']     = $fecha_inicial;
				if ( $data = $objcita->getAllArr($arrayfilters) )
					include(SYSTEM_DIR.'/pages/Citas/Citas_getcitasproximas.php' );
			}
			break;
				
		case 'existecita':
			if( isset($_GET["fecha_inicial"]) && isset($_GET["fecha_final"]) && isset($_GET["id_personal"])){
				$u = new Cita();
				if($res=$u->getExisteCita($_GET["fecha_inicial"],$_GET["fecha_final"],$_GET["id_personal"])){
					echo 1;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
			break;
				
		default:
			# code...
			break;
	}
	
}

?>