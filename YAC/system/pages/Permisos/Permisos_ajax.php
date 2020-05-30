<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'permisousertype':
			if( isset($_GET["id_usuario_tipo"]) ){
		        $permisos = array();
                $objpermuser = new PermisoUserType();
                $datapermisosuser = $objpermuser->getAllArr($_GET["id_usuario_tipo"]);
                if ( $datapermisosuser ) {
			        foreach ($datapermisosuser as $rowperm) {
			          $permisos[] = $rowperm['id_permiso'];
			        }
			    }

                $objpermisos = new Permiso();
                $datapermisos = $objpermisos->getAllArr();

		        $section = "";


		        
				$data="<table id='list-datatable' class='datatable-static table table-striped table-bordered table-hover'>
             	<th>Seccion</th>
              	<th>Pagina</th>
             	<th>Nombre Pagina</th>
              	<th>
                  <label>
                      <input type='checkbox' id='all'/>
                      <span class='lbl'></span>
                  </label>
              	</th>";
              	foreach ($datapermisos as $perm){ 
              		$checked="";
					if (in_array($perm['id'], $permisos)) {
                        $checked=" checked='checked' ";
                    } 
	                                  
		            if($perm['section']!=$section ){
		                $section=$perm['section'];
		                $data.="<tr>
		                    <td><strong>".$perm['section']."</strong></td>
			                <td></td>
		                    <td></td>
		                    <td></td>
		                </tr>
		                ";
	           		} 
	                $data.="<tr>
	                  <td>".ucwords($perm['section'])."</td>
	                  <td>".ucwords($perm['page'])."</td>
	                    <td>".ucwords($perm['nombre'])."</td>
	                    <td class='center'>
	                        <label>
	                            <input type='checkbox' name='perm[]' class='perm-check' ".$checked."
	                                value='".$perm['id']."'/>

	                            <span class='lbl'></span>

	                        </label>

	                    </td>

	                </tr>";
	            
	        	} 
				echo $data.="</tbody>
						</table>";
			
			}else{
				echo "No hay usertype";
			}
			break;
		case 'existpermiss':
			if( isset($_GET["page"]) ){
				$u = new Permiso();
				if($u->permissExists($_GET['section'],$_GET['page'])){
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