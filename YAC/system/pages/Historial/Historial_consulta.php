<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Nueva Consulta";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");
$date     = '';
$cita     = '';
$paciente = '';
if(isset($request['params']['id_cita'])){
    $id_cita=$request['params']['id_cita'];
    $citas = new Cita();
	$cita  = $citas->getTable($id_cita);
}
if(isset($request['params']['id'])){
    $id_paciente=$request['params']['id'];
    $pacientes = new Paciente();
	$paciente  = $pacientes->getTable($id_paciente);
}
if(isPost()){
    $obj = new Cita();
    $id  = $obj->addAll(getPost());
    //$id=240;
    
    if ($id > 0){
        informSuccess(true, make_url("Citas","view",array('id'=>$id)));
    }else{
        informError(true,make_url("Citas","add"));
    }
}
$nombrepaciente = ($paciente) ? $paciente['nombre'].' '.$paciente['apellido_pat'].' '.$paciente['apellido_mat'] : '';

$fecha_inicial = ($cita) ? $cita['fecha_inicial'] : date('Y-m-d H:i');
$fecha_final   = strtotime ( '+1 hour' , strtotime ( $fecha_inicial ) ) ;
$fecha_final   = date('Y-m-d H:i',$fecha_final);
$motivo        = ($cita) ? $cita['motivo'] : '';
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<style>
    .tratamiento{
        font-size: 10px;
    }
</style>
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Citas"] = APP_URL."/Citas/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="well ">
                    <header>
                            <h2><i class="fa fa-automobile"></i>&nbsp;<?php echo $page_title ?></h2>
                    </header>
                    <fieldset>          
                        <form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Citas","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">    

                            <section id="widget-grid" class="">
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-1">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-recepcion" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrecepcion').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Cita agendada</h2>
                                        </header>
                                        <div class="showrecepcion" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="name">Fecha Inicial </label>
                                                            <div class="input-group date form_datetime col-md-12 fecha_inicial" data-date="<?php echo $fecha_inicial ;?>"  data-link-field="fecha_inicial">
                                                                <input class="form-control" size="16" type="text" value="<?php echo $fecha_inicial;?>" readonly>
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                            </div>
                                                            <input type="hidden" name="fecha_inicial"  required id="fecha_inicial" value="<?php echo $fecha_inicial;?>" />
                                                        </div> 
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" required  placeholder="Motivo de Cita" name="motivo" id="motivo" value="<?php echo $motivo;?>"  >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            
                                                            <select style="width:100%" class="select2"  required name="id_personal" id="id_personal">
                                                                <option value="" selected disabled>Selecciona Medico</option>
                                                                <?php 
                                                                $obj = new Personal();
                                                                $list=$obj->getAllArr(2); // medicos
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        $selected = ($cita['id_personal']==$val['id']) ? 'selected'  : '' ;
                                                                        echo "<option $selected value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="name">Fecha Final</label>
                                                            <div class="input-group date form_datetime col-md-12 fecha_final" data-date="<?php echo $fecha_final;?>"  data-link-field="fecha_final">
                                                                <input class="form-control fecha_finaltxt" size="16" type="text" value="<?php echo $fecha_final;?>" readonly>
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                            </div>
                                                            <input type="hidden" name="fecha_final" id="fecha_final" value="<?php echo $fecha_final;?>" />
                                                        </div> 
                                                        <div class="form-group">
                                                            <div class="col-sm-10">
                                                                <select style="width:100%" class="select2"  required name="id_paciente" id="id_paciente">
                                                                    <option value="" selected disabled>Selecciona paciente</option>
                                                                    <?php 
                                                                    $obj = new Paciente();
                                                                    $list=$obj->getAllArr();
                                                                    if (is_array($list) || is_object($list)){
                                                                        foreach($list as $val){
                                                                            $selected = ($id_paciente==$val['id']) ? 'selected'  : '' ;
                                                                            echo "<option $selected value='".$val['id']."'>".htmlentities($val['nombre'])."</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopuppacientes()" > <i class="fa fa-plus"></i></a>                                          
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" >
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-6" id="contpaciente"></div> 
                                                    <div class="col-sm-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </article> 
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-2">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-diagrama" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showdiagrama').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Diagrama</h2>
                                        </header>
                                        <div class="showdiagrama" style="display: ;">
                                            <div class="col-sm-12 col-md-5 col-lg-5">
                                                <img src="<?php echo ASSETS_URL; ?>/img/diagrama.png" alt="Prueba de mapa de imágenes" style="width: 400px"  usemap="#billar">
                                                <map name="billar" id='billar'>

                                                    <area class="diente" title="Incisivo central derecho" shape="circle" coords="135,31,10">
                                                    <area class="diente" title="Incisivo central izquierdo" shape="circle" coords="150,31,10">
                                                    <area class="diente" title="Incisivo lateral izquierdo" shape="circle" coords="170,35,10">
                                                    <area class="diente" title="Canino izquierdo" shape="circle" coords="190,50,10" >
                                                    <area class="diente" title="Primer Premolar" shape="circle" coords="195,60,10" >
                                                    <area class="diente" title="Segundo Premolar" shape="circle" coords="210,90,15" >
                                                    <area class="diente" title="Primer molar" shape="circle" coords="215,125,20" >
                                                    <area class="diente" title="Segundo molar" shape="circle" coords="220,155,20">
                                                    <area class="diente" title="Tercer molar" shape="circle" coords="226,190,20" >
                                                </map>
                                            </div>
                                            <div class="col-sm-12 col-md-7 col-lg-7" style="float:right">
                                                <table style='width:100%' class='table-striped table-bordered table-hover' id="contentdientes">
                                                    <thead>    
                                                        <tr>
                                                            <th style=" width: 10%;">Cant.</th>
                                                            <th style=" width: 20%">Tratamientos</th>
                                                            <th style=" width: 15%;">Detalles</th>
                                                            <th style=" width: 10%">Prioridad</th>
                                                            <th style=" width: 20%">Fecha Rec.</th>
                                                            <th style=" width: 10%" >Costo</th>
                                                            <th style=" width: 10%" >Total</th>
                                                            <th style=" width: 5%" class="borrar-td"></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>                  
                                        </div>
                                    </div>
                                </article>
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-3">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-tratamiento" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showtratamiento').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Tratamiento</h2>
                                        </header>
                                        <div class="showtratamiento" style="display: none ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                            </div>
                                        </div>
                                    </div>    
                                </article>
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-4">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-receta" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showreceta').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Receta Medica</h2>
                                        </header>
                                    </div>
                                </article>
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-1">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-recomendaciones" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrecomendaciones').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-building"></i> </span><h2>Recomendaciones</h2>
                                        </header>
                                    </div>
                                </article>
                            </section>                                       
                        </form>
                    </fieldset>
                    
                    <footer>
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
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="50" alt="SmartAdmin">
                    <div id='titlemodal' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> Nuevo</span>
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
    	
	function draw() {
		var canvas = document.getElementById('canvas');
		if (canvas.getContext){
			var ctx = canvas.getContext('2d');

			ctx.fillRect(25,25,100,100);
			ctx.clearRect(45,45,60,60);
			ctx.strokeRect(50,50,50,50);
		}
	}
   $(document).ready(function() {
         //datetime
         $('.form_datetime').datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            language:  'es',
            weekStart: 0,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 0,
            minuteStep :30
        });
        
        /*GENERALES*/
       
        validateForm =function(){
            var fecha_alta    = $("input[name=fecha_inicial]").val();
            var fecha_final   = $("input[name=fecha_final]").val();
            var id_paciente   = $("#id_paciente").val();
            var id_personal   = $("#id_personal").val();
            var motivo        = $("#motivo").val();
            if ( ! fecha_alta )              return notify("info","La fecha de inicio es requerida");
            if ( ! fecha_final )             return notify("info","La fecha final es requerida");
            if ( fecha_final < fecha_alta )  return notify("info","La fecha final no puede ser menor a la fecha de inicio");      
            if ( ! id_paciente )             return notify("info","El Paciente es requerido");
            if ( ! id_personal )             return notify("info","El Medico es requerido");
            if ( ! motivo )                  return notify("info","El motivo es requerido");
            
            $("#main-form").submit();       
        }
        $(document).keydown(function(event) {
            if (event.ctrlKey==true && (event.which == '106' || event.which == '74')) {
                // alert('thou. shalt. not. PASTE!');
                event.preventDefault();
            }
        });
      
 

        //**********Clients*************/
        showpopuppacientes = function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo paciente</span>');
            $.get(config.base+"/Pacientes/ajax/?action=get&object=showpopup", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario de pacientes');
                        
                    }     
            });
        }
        getpaciente =function(id){
            if ( ! id ) return;
            $("#contpaciente").html("<div align='center'><i class='far fa-cog fa-spin fa-5x'></i></div>");
            $.get(config.base+"/Citas/ajax/?action=get&object=getpaciente&id=" + id, null, function (response) {
                    if ( response ){
                        $("#contpaciente").html(response);
                    }else{
                        notify('error', 'Error al obtener los datos del paciente');
                        return false;
                    }     
            });
        }
        $('body').on('click', '#savenewclient', function(){
            var nombre       = $("input[name=nombre]", $(this).parents('form:first')).val();
            var apellido_pat = $("input[name=apellido_pat]", $(this).parents('form:first')).val();
            var apellido_mat = $("input[name=apellido_mat]", $(this).parents('form:first')).val();
            var telefono     = $("input[name=telefono]", $(this).parents('form:first')).val();
            
            if(!nombre) {  notify('error',"Se necesita el nombre del paciente."); return false; }
            var url = config.base+"/Pacientes/ajax/?action=get&object=savenewclient"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).parents('form:first').serialize(), // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#id_paciente').append($('<option>', {
                            value: response,
                            text: nombre+" "+apellido_pat+" "+apellido_mat,
                            selected:true
                        }));  
                        $("#id_paciente").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        $('#myModal').modal('hide');
                        notify('success',"paciente agregado correctamente:"+response);
                        getpaciente(response);
                    }else{
                        notify('error',"Oopss error al agregar paciente"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('change', '#id_paciente', function(){
            if( $(this).val() ){
                var id = $("#id_paciente").val();
                getpaciente(id);
            }
        });
        $('body').on('change', '.fecha_inicial', function(){
            if( $(this).attr('data-date') ){
               var fechaini    = new Date($('#fecha_inicial').val());
               var fechafin    = $('#fecha_final');
               var fechafintxt = $('.fecha_finaltxt');
               var minutos     = fechaini.setMinutes(fechaini.getMinutes() + 60);
               var nuevafecha  = fechaini.getFullYear() + '-' + ("0"+(fechaini.getMonth()+1)).slice(-2) + '-' + ("0" + fechaini.getDate()).slice(-2) +' ' + ("0" + fechaini.getHours()).slice(-2) + ":" +("0" + fechaini.getMinutes()).slice(-2);
               fechafin.val(nuevafecha);
               fechafintxt.val(nuevafecha);
               $('.fecha_final').attr('data-date',nuevafecha);
            }
        });
        /*   tratamientos */
        gettratamiento =function(title){
            if ( ! title ) return;
            $("#contpaciente").html("<div align='center'><i class='far fa-cog fa-spin fa-5x'></i></div>");
            $.get(config.base+"/Historial/ajax/?action=get&object=gettratamiento&title=" + title, null, function (response) {
                    if ( response ){
                        $("#contentdientes").append(response);
                    }else{
                        notify('error', 'Error al obtener los datos del paciente');
                        return false;
                    }     
            });
        }
        
        $('.diente').click(function () {
            gettratamiento($(this).attr('title'));
		    return false;
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
