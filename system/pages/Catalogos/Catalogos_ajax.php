<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
        case 'getserviciospaquete':
            if( isset($_GET["id"]) && intval($_GET["id"]) ){
                $id = $_GET["id"];
                ob_start();
                include(SYSTEM_DIR.'/pages/Catalogos/Catalogos_getserviciospaquete.php' );
                   
                
                $html = ob_get_contents();
                ob_end_clean();

                if( $html ){
                        echo $data=$html;
                }else{
                    echo 0;
                }
            }
			break;
		case 'getselectrefaccion':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$obj = new Refaccion();
				if($list=$obj->getAllbyid($_GET["id"])){
					$data='<select style="width:100%" class="select2" name="idrefaccion" id="idrefaccion">
								<option value="">Selecciona Refaccion</option>';
                        if (is_array($list) || is_object($list)){
                            foreach($list as $val){
                                $data.="<option value='".$val['id']."'>".htmlentities($val['codigo'].'||'.$val['nombre'])."</option>";
                            }
                        }
                         
                    echo $data.='</select>';
				}else{
					echo 'No se han encontrado resultados';
				}
			}else{
				echo 0;
			}
			break;

			case 'getrefaccionpedido':
				if( isset($_GET["id"]) && intval($_GET["id"]) ){
					$id    = $_GET["id"];
					$cant  = ($_GET["cantidad"]>0) ? $_GET["cantidad"] : 1 ;
					$u  = new Refaccion();
					if($res       = $u->getTable($id)){
						$lineId   = rand(1000, 100000);
						$detalles = htmlentities( $res["nombre"] )."<input type='hidden' name='detalles_refaccion[]'>";
						if ( $res['detalles'] ) 
							$detalles ="<input type='text' name='detalles_refaccion[]' style='width: 150px;'  class='form-control' placeholder='Detalles' >";
						
						$costounit  = ($res["costo_aprox"] )  ? $res["costo_aprox"] : '' ;
						$values		= $u->getPrecio($id);
						$preciounit = ($values)  ? $values['precio']  : 0 ;
						$totalcosto = ($cant && $costounit )  ? $cant*$costounit    : '' ;
						$data="
							<tr class='refaccion' lineidrefaccion='".$lineId."'>
								<input type='hidden' name='id_refaccion[]' value='".$id."'/>
								<input class='cantidadesrefaccion' type='hidden' name='cantidad_refaccion[]' value='".$cant."'/>
								<td>" . $cant . "</td>
								<td>" . htmlentities( $res["codigo"] ) . "</td>
								<td>" .  $detalles . "</td>";
						
						$data.="<td><input type='number' style='width: 80px;' class='form-control costorefaccion' name='costorefaccion[]' value='".$costounit."' placeholder='00.00'></td>
								<td><input type='number' style='width: 80px;' class='form-control preciorefaccion' name='preciorefaccion[]' value='".$preciounit."' placeholder='00.00'></td>
								<td><input type='number' style='width: 80px;' readonly class='form-control totalesrefaccion' name='totalrefaccion[]' value='".$totalcosto."' placeholder='00.00'></td>";
						
						$data.="
								<td class='borrar-td'>
								<a href='javascript:void(0);' class='btn btn-danger borrar-refaccion' lineidrefaccion='".$lineId."'> 
									<i class='glyphicon glyphicon-trash'></i> </a>";
								$data.="
								</td>
							</tr>
							";
							echo $data;
					}else{
						echo 'No se han encontrado resultados';
					}
				}else{
					echo 0;
				}
			break;
        
		case 'getrefaccion':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$id    = $_GET["id"];
				$aseg  = ($_GET["aseguradora"]>1) ? 1                 : 0 ;
				$cant  = ($_GET["cantidad"]>0)    ? $_GET["cantidad"] : 1 ;
				$u  = new Refaccion();
				if($res       = $u->getTable($id)){
					$lineId   = rand(1000, 100000);
					$detalles = htmlentities( $res["nombre"] )."<input type='hidden' name='detalles_refaccion[]'>";
					if ( $res['detalles'] )  $detalles ="<input type='text' name='detalles_refaccion[]' style='width: 150px;'  class='form-control' placeholder='Detalles' >";
					
					$costoaprox = ($res["costo_aprox"] && $aseg==0 ) ? $res["costo_aprox"] : '' ;
					$total      = ($cant && $costoaprox && $aseg==0) ? $cant*$costoaprox   : '' ;
					$data="
						<tr class='refaccion' lineidrefaccion='".$lineId."'>
							<input type='hidden' name='id_refaccion[]' value='".$id."'/>
							<input class='cantidadesrefaccion' type='hidden' name='cantidad_refaccion[]' value='".$cant."'/>
							<td>" . $cant . "</td>
							<td>" . htmlentities( $res["codigo"] ) . "</td>
							<td>" .  $detalles . "</td>";
					if ( !$aseg ){
						$data.="<td><input type='number' style='width: 80px;' class='form-control costorefaccion' name='costorefaccion[]' value='".$costoaprox."' placeholder='00.00'></td>
							<td><input type='number' style='width: 80px;' readonly class='form-control totalesrefaccion' name='totalrefaccion[]' value='".$total."' placeholder='00.00'></td>";
					}else{
						$data.="<td><input type='hidden' style='width: 50px;' class='form-control costorefaccion' name='costorefaccion[]' value='' placeholder='00.00'></td>
						<td><input type='hidden' style='width: 50px;' readonly class='form-control totalesrefaccion' name='totalrefaccion[]' value='' placeholder='00.00'></td>";
					}
					$data.="
							<td class='borrar-td'>
							<a href='javascript:void(0);' class='btn btn-danger borrar-refaccion' lineidrefaccion='".$lineId."'> 
								<i class='glyphicon glyphicon-trash'></i> </a>";
							$data.="
							</td>
						</tr>
						";
						echo $data;
				}else{
					echo 'No se han encontrado resultados';
				}
			}else{
				echo 0;
			}
			break;
        case 'getservicio':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$id = $_GET["id"];
				$u  = new Servicio();
				if($res = $u->getTable($id)){
					$lineId   = rand(1000, 100000);
					$u2       = new ServicioPaquete();
					$detalles = htmlentities( $res["nombre"] )."<input type='hidden' name='detalles_servicio[]'>";
					if ( $res['detalles'] )  $detalles ="<input type='text' name='detalles_servicio[]' style='width: 150px;'  class='form-control' placeholder='Detalles' >";
					$data="
						<tr class='servicio' lineid='".$lineId."'>
							<input type='hidden' name='id_servicio[]' value='".$id."'/>
							<td>" . htmlentities( $res["codigo"] ) . "</td>
							<td>" . $detalles . "</td>
							<td><input type='number' style='width: 80px;'  class='form-control totales' name='total_servicio[]' placeholder='00.00'></td>
							<td class='borrar-td'>
							<a href='javascript:void(0);' class='btn btn-danger borrar-servicio' lineid='".$lineId."'> 
								<i class='glyphicon glyphicon-trash'></i> </a>";
							if ( $res2 = $u2->getTableServicios( $id ) ){
								$data.="<div class='btn-group' style='padding-left: 10px;'>
									<button class='btn btn-primary btn-sm dropdown-toggle' data-toggle='dropdown'>
										Servicios <span class='caret'></span>
									</button>
									<ul class='dropdown-menu' style='    min-width: 250px;'>";
										foreach($res2 as $keyser => $row){
											$keyser++;
											$data.= "<li>" . $keyser .'.- '. htmlentities( $row["codigo"] ) . '||' . htmlentities( $row["nombre"] )  ."</li>";
										}
							$data.="</ul>
								</div>";
							}
							$data.="
							</td>
						</tr>
						";
						echo $data;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
			break;
		case 'getserviciopaqueteshow':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$id = $_GET["id"];
				$u  = new ServicioPaquete();
				if($res=$u->getTable($id)){
					foreach($res as $row){
						$lineId = rand(1000, 100000);
						$detalles ="";
						if ( $row['detalles'] )  $detalles ="<input type='text' name='detalles_servicio[]' style='width: 150px;'  class='form-control' placeholder='Detalles' >";
					
						echo $data="
							<tr class='servicio' lineid='".$lineId."'>
								<input type='hidden' name='id_servicio[]' value='".$row['id']."'/>
								<td>" . htmlentities( $row["codigo"] ) . "</td>
								<td>" . htmlentities( $row["nombre"] ) . $detalles . "</td>
								<td>
								$<input type='number' class='totales' name='total_servicio[]' placeholder='00.00'>
									<label>Paquete " . htmlentities( $row["paquete"] ) . "</label>
								</td>

								<td class='borrar-td'>
									<a href='javascript:void(0);' class='btn btn-danger borrar-servicio' lineid='".$lineId."'> 
									<i class='glyphicon glyphicon-trash'></i> </a>
								</td>
							</tr>
							";
					}
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
            break;
		case 'showpopupservicio':
		    $html = file_get_contents(SYSTEM_DIR.'/pages/Catalogos/Catalogos_adpopupservice.php');
            if( $html )	echo $data=$html; 
                else    echo 0;
		
			break;
		case 'showpopupChangeStatusServicio':
			$page           = $_GET["page"];
			$id             = $_GET["id"];
			$status         = $_GET["statusant"];
			$personal       = "";
			$fecha_inicio   = date("Y-m-d");
			$fecha_estimada = "";
			$fecha_fin      = "";
			$u  = new HistorialVehiculoservicio();
			if($res = $u->getLastStatus($id)){
				$personal       = $res['id_personal'];
				$fecha_inicio   = ( isset($res['fecha_inicio'] )  && $res['fecha_inicio'] != '' )   ? date('Y-m-d H:i',strtotime($res['fecha_inicio'])) : '';
				$fecha_estimada = ( isset($res['fecha_estimada']) && $res['fecha_estimada'] != '' ) ? date('Y-m-d H:i',strtotime($res['fecha_estimada'])) : '';
				$fecha_fin      = ( isset($res['fecha_fin'] )     && $res['fecha_fin'] != '' )      ? date('Y-m-d H:i',strtotime($res['fecha_fin'])) : '';
				$status         = $res['status'];
				
			}else{
				$res=[];
			}
		    $html = require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_showpopupChangeStatusServicio.php');
            if( $html )	echo $data=$html; 
                else    echo 0;
		
			break;
		case 'showpopupChangeStatusRefaccion':
			$page           = $_GET["page"];
			$id             = $_GET["id"];
			$status         = $_GET["statusant"];
			$personal       = "";
			$fecha_inicio   = date("Y-m-d");
			$fecha_estimada = "";
			$fecha_fin      = "";
			$almacen		= "";
			$u  = new HistorialVehiculorefaccion();
			if($res = $u->getLastStatus($id)){
				$personal       = $res['id_personal'];
				$fecha_inicio   = ( isset($res['fecha_inicio'] )  && $res['fecha_inicio'] != '' )   ? date('Y-m-d H:i',strtotime($res['fecha_inicio'])) : '';
				$fecha_estimada = ( isset($res['fecha_estimada']) && $res['fecha_estimada'] != '' ) ? date('Y-m-d H:i',strtotime($res['fecha_estimada'])) : '';
				$fecha_fin      = ( isset($res['fecha_fin'] )     && $res['fecha_fin'] != '' )      ? date('Y-m-d H:i',strtotime($res['fecha_fin'])) : '';
				$almacen        = $res['id_almacen'];
				$status         = $res['status'];
				
			}else{
				$res=[];
			}
		    $html = require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_showpopupChangeStatusRefaccion.php');
            if( $html )	echo $data=$html; 
                else    echo 0;
		
			break;
		case 'showpopupHistoryStatusServicio':
			$page      = '';
			$id        = $_GET["id"];
		    if($html=require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_showpopupHistoryStatusServicio.php')){
				echo $html;
			}
           
		
			break;
		case 'showpopupHistoryStatusRefaccion':
			$page      = '';
			$id        = $_GET["id"];
		    $html = require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_showpopupHistoryStatusRefaccion.php');
            if( $html )	echo $data=$html; 
                else    echo 0;
		
			break;
		
		case 'showpopupaddservicetoorden':
			$html = require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_showpopupaddservicetoorden.php');
			break;
		case 'showpopupaddrefacciontoorden':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$id = $_GET["id"];
				$obj = new Vehiculo();
				$datavehiculo = $obj->getTable($id);
				if ( !$datavehiculo ) {
				    echo "error id";
				}
				$html = require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_showpopupaddrefacciontoorden.php');
			}
			break;
		case 'savenewservice':
		    $obj = new Servicio();
			if(isPost()){
			    $id=$obj->addAll(getPost());
			    if($id>0) echo $id;
			    else      echo 0;
			}
			break;
		case 'savenewservicetoorden':
		    $obj = new VehiculoServicio();
			if(isPost()){
			    $id=$obj->addAll(getPost());
			    if($id>0) echo $id;
			    else      echo 0;
			}

			break;
		case 'showpopuprefaccion':
			$id_marca 	 = $_GET['id_marca'];
			$id_marca = $_GET['id_marca'];
			$html = require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_adpopuprefaccion.php');
			break;
		case 'savenewrefacciontoorden':
			// se manda llamar desde vehiculo view
		    $obj = new VehiculoRefaccion();
			if(isPost()){
			    $id=$obj->addAll(getPost());
			    if($id>0) echo $id;
			    else      echo 0;
			}

			break;
		case 'showpopuprefaccionbuscar':
			
		    $html = require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_showpopuprefaccionbuscar.php');
            
			break;
		case 'getresrefaccion':
			$marca    = ($_GET["marca"])    ? $_GET["marca"]    : '' ;
			$submarca = ($_GET["submarca"]) ? $_GET["submarca"] : '' ;
			$year     = ($_GET["year"])     ? $_GET["year"]     : '' ;
			
		    $html = require_once(SYSTEM_DIR.'/pages/Catalogos/Catalogos_getresrefaccion.php');
            
			break;
		case 'getgastostipo':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$id    = $_GET["id"];
				$cant  = ($_GET["cantidad"]>0)    ? $_GET["cantidad"] : 1 ;
				$u  = new GastosTipo();
				if($res       = $u->getTable($id)){
					$lineId   = rand(1000, 100000);
					$detalles = htmlentities( $res["nombre"] );
					if ( $res['codigo'] == 'nomina') {
						$obj = new Nomina();
						if($list=$obj->getAllAvailable()){
							$detalles.='<br><select style="width:50%" lineid="'.$lineId.'"  class="select2 vincular-nomina" name="detalles[]" id="detalles'.$lineId.'">
										<option value="" total="">Vincular Nomina</option>';
								if (is_array($list) || is_object($list)){
									foreach($list as $val){
										$detalles.="<option total='".$val['total']."' value='".$val['id']."'>".htmlentities($val['id'].'||'.$val['nombre'])."</option>";
									}
								}
							$detalles.='</select>';
						}else{
							$detalles .="<input type='text' name='detalles[]' style='width: 150px;'  class='form-control' placeholder='Detalles' >";
						}						
						$detalles .="</select>";
					}else{
						$detalles .="<input type='text' name='detalles[]' style='width: 150px;'  class='form-control' placeholder='Detalles' >";
					}
					$values	   = $u->getPrecio($id);
					$totalunit = ($values)  ? $values['total']/$values['cantidad']  : 0 ;
					$total     = ($values)  ? $values['total']  : 0 ;
					$data="
							<tr class='gastos' lineidgastos='".$lineId."'>
								<input type='hidden' name='id_gastostiporegistros[]' value='".$id."'/>
								<input class='cantidadesgastos' type='hidden' name='cantidad[]' value='".$cant."'/>
								<td>" . $cant . "</td>
								<td>" . htmlentities( $res["codigo"] ) . "</td>
								<td>" .  $detalles . "</td>";
						
						$data.="
								<td><input type='number' style='width: 80px;' id='totalesregistros".$lineId."' class='form-control totalesgastos' name='totalesregistros[]' value='".$total."' placeholder='00.00'></td>";
						
						$data.="
								<td class='borrar-td'>
								<a href='javascript:void(0);' class='btn btn-danger borrar-gastos' lineidgastos='".$lineId."'> 
									<i class='glyphicon glyphicon-trash'></i> </a>";
								$data.="
								</td>
							</tr>
							";
							echo $data;
				}else{
					echo 'No se han encontrado resultados';
				}
			}else{
				echo 0;
			}
            
			break;
		case 'savenewrefaccion':
			// se manda llamar desde vehiculo alta 
		    $obj = new Refaccion();
			if(isPost()){
			    $id=$obj->addAll(getPost());
			    if($id>0) echo $id;
			    else      echo 0;
			}
			break;
	}
	
}

?>