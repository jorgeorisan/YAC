 <?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Asignar permiso";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");


if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];

else
    informError(true,make_url("Users","index"));



$obj = new User();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Users","index"));
}
if(isPost()){
	$objpermuser = new PermisoUser();
    $datapermisosuser = $objpermuser->deleteAll($id);
    if(!$datapermisosuser){
    	echo "error al eliminar permisos";
    	exit;
    }
    if ( count($_POST["perm"] ) ) {
    	$error=0;
    	foreach ($_POST["perm"] as $perm) {
	        $objpermuser->addAll($perm,$id);
	        if ($id > 0){
	        }else{
	        	$error++;
	        }
    	}
    }else{
    	echo "No hay permisos";
    	exit;
    }
  	
   
    if( $error == 0  ) {
         informSuccess(true, make_url("Users","index"));
    }else{
        informError(true, make_url("Permisos","asignar",array('id'=>$id)),"asignar");
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Permisos"] = APP_URL."/Permisos/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-12 col-md-12 col-lg-12"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-edit"></i>
                            </span>
                            <h2><?php echo $page_title ?> </h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
                                <form id="main-form" class="" role="form" method=post 
                                action="<?php echo make_url("Permisos","asignar",array('id'=>$id));?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">
                                    <input type="text" class="" name="idPermiso" hidden>
                                    <fieldset>
                                         <div class="col-sm-4">
                                             <select style="width:100px" class="select2" name="id_usertype" id="id_usertype">
                                                <option value="">--Precargar Perfil--</option>
                                                <?php 
                                                $obj = new UserType();
                                                $list=$obj->getAllArr();
                                                if (is_array($list) || is_object($list)){
                                                    foreach($list as $val){
                                                        $selected = "";
                                                        //if ($data['id_usertype'] == $val['id'] )
                                                            //$selected = "selected";
                                                        
                                                        echo "<option ".$selected." value='".$val['id']."'>".$val['nombre']."</option>";
                                                    }
                                                }
                                                 ?>
                                            </select>
                                        </div>
                                        <div id="contpermisos">
                                            <table id="list-datatable" class="datatable-static table table-striped table-bordered table-hover">
    							             	<th>Seccion</th>
    							              	<th>Pagina</th>
    							             	<th>Nombre Pagina</th>
    							              	<th>
    							                  <label>
    							                      <input type="checkbox" id="all"/>
    							                      <span class="lbl"></span>
    							                  </label>
    							              </th>
    							              <?php
    									        $permisos = array();
    		                                    $objpermuser = new PermisoUser();
    		                                    $datapermisosuser = $objpermuser->getAllArr($id);
    									        foreach ($datapermisosuser as $rowperm) {
    									          $permisos[] = $rowperm['id_permiso'];
    									        }

    		                                    $objpermisos = new Permiso();
    		                                    $datapermisos = $objpermisos->getAllArr();

    									        $section = "";

    									        foreach ($datapermisos as $perm){ 

    									            if($perm['section']!=$section ){
    									                $section=$perm['section'];
    									        ?>
    									                <tr>
    									                    <td><strong><?php echo htmlentities(ucwords($perm['section'])); ?></strong></td>
    										                <td></td>
    									                    <td></td>
    									                    <td></td>
    									                </tr>
    									            <?php
    								           		} ?>
    								                <tr>
    								                    <td><?php echo htmlentities(ucwords($perm['section'])); ?></td>
    								                    <td><?php echo htmlentities(ucwords($perm['page'])); ?></td>
    								                    <td><?php echo htmlentities(ucwords($perm['nombre'])); ?></td>
    								                    <td class="center">
    								                        <label>
    								                            <input type="checkbox" name="perm[]" class="perm-check"
    								                                <?php if (in_array($perm['id'], $permisos)) {
    								                                    echo " checked='checked' ";
    								                                } ?>
    								                                   value="<?php echo $perm['id']; ?>"/>

    								                            <span class="lbl"></span>

    								                        </label>

    								                    </td>

    								                </tr>
    								            <?php 
    								        	} ?>
    								            </tbody>
    								      	</table>
                                          </div>
                                    </fieldset>
                                    <div class="form-actions" style="text-align: center">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                                    Cancelar
                                                </button>
                                                <button class="btn btn-primary btn-md" type="button" onclick=" validateForm();">
                                                    <i class="fa fa-save"></i>
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</div>

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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
    
    function validateForm()
    {
        

        $("#main-form").submit();       
    }
    $(document).ready(function() {
    	$("#all").change(function () {
	        if ($(this).is(':checked')) {
	            $(".perm-check").prop("checked", $(this).prop("checked") == true);
	        }else{
	            $(".perm-check").prop("checked", $(this).prop("checked") == "checked");

	        }
	    });
      
        $('body').on('change', '#id_usertype', function(){
            var id_usertype=$("input[name=id_usertype]", $(this).parents('form:first')).val();
            console.log(id_usertype);
          
            var url = config.base+"/Permisos/ajax/?action=get&object=permisousertype"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "GET",
                url: url,
                data: $(this).parents('form:first').serialize(), // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response){
                       $("#contpermisos").html(response);
                    }else{
                        notify('error',"Oopss error al obtener permisos de este perfil:"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */
         pageSetUp();

    })

</script>

<?php
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>
