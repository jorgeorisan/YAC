<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'getpersonal':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$id = $_GET["id"];
				$begin	= $_GET['begin'];
				$end	= $_GET['end'];
				$objper  = new Personal();
				$dataper = $objper->getAllServicesGral($begin,$end);
				$totalglobal = 0 ;
				foreach ($dataper as $key => $row) {
					$lineId   = rand(1000, 100000);
					
					$idpersonal = $row['id_personal'];
						   
					$nombre = htmlentities($row['nombre'].' '.$row['apellido_pat'].' '.$row['apellido_mat']) ;
					$nombrevehiculo =  htmlentities($row['marca']." ".$row['submarca']." - ". $row['modelo']);
					$status = htmlentities($row['status']);
					$fecha  = htmlentities($row['fecha']);
					$id_vehiculo    =  htmlentities($row['id_vehiculo']);
					$porcentaje ="Fijo";
					switch ($row['forma_pago']) {
						case 'Fijo':
							$total = $row['cantidad'];
							break;
						default:
							$total      = $row['total']*($row['cantidad']/100);
							$porcentaje = $row['cantidad']."%";
							$totalglobal+= $total*($row['cantidad']/100);
							break;
					}
					$queryAllServices = $objper->getAllServices($begin,$end,$row['id_personal']);
					
					$detalles = json_encode($queryAllServices);
					$detalles = $nombre."<input type='hidden' name='detalles[]' value='".$detalles."'>";
						   
					$data="
						<tr class='personal' lineidpersonal='".$lineId."'>
							<input type='hidden' name='id_personal[]' value='".$id."'/>
							<input type='hidden' name='cantidad[]' value='".$row['cantidad_servicios']."'/>
							<input type='hidden' name='fecha[]' value='".$fecha."'/>
							<input type='hidden' name='id_vehiculo[]' value='" .$id_vehiculo ."'/>
							<td>" . $row['cantidad_servicios'] . "</td>
							<td>" . $detalles . "</td>
							<td>" . $nombrevehiculo . "</td>
							<td>" . $fecha . "</td>
							<td>
								<span style='float:left;padding-top: 10px;'>". $porcentaje ."</span>
								<input type='number' style='width: 80px;' class='form-control totalespersonal' name='totalpersonal[]' value='". $total ."' placeholder='00.00'>
							<td class='borrar-td'>
								<a data-toggle='modal' class='btn-historyservices' title='Ver Servicios' href='#myModal' idper='". $row['id_personal'] ."' >
									<i class='fa fa-history'></i>&nbsp;Servicios
								</a>
								<a href='javascript:void(0);' class='btn btn-danger borrar-personal' lineidpersonal='". $lineId ."'> 
									<i class='glyphicon glyphicon-trash'></i> 
								</a>
							</td>
						</tr>
						";

						echo $data;
				}
			}else{
				echo 0;
			}
			break;

		case 'showpopupHistoryServices':
			$page      = '';
			$id        = $_GET["id"];
			$fechaini  = $_GET["fechaini"];
			$fechafin  = $_GET["fechafin"];
		    $html = require_once(SYSTEM_DIR.'/pages/Personal/Personal_showpopupHistoryServices.php');
            if( $html )	echo $data=$html; 
                else    echo 0;
		
			break;
		default:
			# code...
			break;
	}
	
}

?>