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
					$pacientes = new Paciente();
					$paciente  = $pacientes->getTable($row['id_paciente']);
					$users     = new User();
					$user      = $users->getTable($row['id_user']);
					$personal  = new Personal();
					$persona   = $personal->getTable($row['id_paciente']);
					$nombrepaciente  = htmlentities($paciente['nombre']." ".$paciente['apellido_pat']." ".$paciente['apellido_mat']." "); 
					$nombrepersonal  = htmlentities($persona['nombre']." ".$persona['apellido_pat']." ".$persona['apellido_mat']." ");
					$nombreuser      = htmlentities($user['nombre']." ".$user['apellido_pat']." ".$user['apellido_mat']." ");
					switch ($row['status']) {
						case 'active':	   $status = 'Pendiente';  $class = "bg-color-blue"; 	   $icon = "fa-clock-o"; break;
						case 'deleted':    $status = 'Cancelada';  $class = "bg-color-red";	       $icon = "fa-warning"; break;
						case 'Finalizada': $status = 'Finalizada'; $class = "bg-color-greenLight"; $icon = "fa-check";   break;
						default: 	       $status = 'N/A';		   $class = "";           	       $icon = "";           break;
					}
					$events['title']       = $nombrepaciente; 
					$events['start']       = $row['fecha_inicial']; 
					$events['end']         = $row['fecha_final']; 
					$events['description'] = $status; 
					$events['allDay'] 	   = 'false'; 
					$events['url'] 		   = make_url("Citas","historial",array('id'=>$row['id_paciente'] )); 
					$events['icon']        = $icon; 
					
				}
			}
  			respondData($events);
			
			break;
		case 'getpaciente':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$u = new Paciente();
				if($res=$u->getTable($_GET['id'])){
					$data="
						<table border=1 style=' border-color: #CCC;'>
							<tr  align='center'><td colspan='2'><h4>Datos del paciente</h4></td></tr>";
					$data.="<tr>
								<td><strong>Nombre:</strong></td>
								<td>" . htmlentities($res["nombre"] ." ".$res["apellido_pat"] ." ".$res["apellido_mat"]) . "</td>
							</tr>
							<tr>
								<td><strong>Email:</strong></td><td>"   .htmlentities($res["email"])     . "</td>
							</tr>
							<tr>
								<td><strong>Telefono:</strong></td><td>" .htmlentities($res["telefono"]) . "</td>
							</tr>
							<tr><td><strong>Direccion:</strong></td><td>" .htmlentities($res["ciudad"]." ".$res["estado"]). " Col." .htmlentities($res["colonia"]) ." Call." .htmlentities($res["calle"]." ".$res["num_ext"]. " " .$res["num_int"])."</td>
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
				
		default:
			# code...
			break;
	}
	
}

?>