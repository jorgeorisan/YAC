<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Nueva Cita";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");
$idhistorialtratamiento = '';

$id_cita=(isset($request['params']['id_cita'])) ? $request['params']['id_cita'] : '';

if(isset($request['params']['id'])   && $request['params']['id']>0)
    $idhistorialtratamiento=$request['params']['id'];

if($idhistorialtratamiento){
    $objHtratamiento  = new HistorialTratamiento();
    $datatratamiento = $objHtratamiento->getTable($idhistorialtratamiento);
    $motivo         = $datatratamiento['tratamiento'];
    $id_paciente    = $datatratamiento['id_paciente'];
    $id_personal    = $datatratamiento['id_personal'];
    $fecha_inicial  = ($datatratamiento['fecha_recomendada']) ? $datatratamiento['fecha_recomendada'] : $fecha_inicial;
}
$date = date('Y-m-d H:i');
$title   = 'Agendar Cita';
$motivo = $id_paciente = $id_personal = '';
$statuscita ='active';
if ( intval ($id_cita) ) {
    $citas = new Cita();
    $cita  = $citas->getTable($id_cita);
    $date  = ($cita['fecha_inicial']) ? $cita['fecha_inicial'] : $date;
    $motivo        = $cita['motivo'];
    $id_paciente   = $cita['id_paciente'];
    $id_personal   = $cita['id_personal'];
    $date  		   =  date('Y-m-d H:i',strtotime ( $date ) );
    $statuscita    = $cita['status'];
    $title   	   = 'Reagendar Cita';
}
if(isset($request['params']['id_paciente'])   && $request['params']['id_paciente']>0)
    $id_paciente=$request['params']['id_paciente'];


$fecha_inicial = ($date) ? $date : date('Y-m-d H:i');
$hora_inicial  = ($date) ? date('H:i',strtotime($date)) : date('H:i');
$fecha_final   = strtotime ( '+1 hour' , strtotime ( $fecha_inicial ) ) ;
$hora_final    = date('H:i',$fecha_final);
if(isPost()){
    $obj = new Cita();
    if (intval($_POST['id_cita'])) {
        //update
        $requestCita['fecha_inicial'] = (isset($_POST['fecha_inicial'])) ? $_POST['fecha_inicial'] : '';
        $requestCita['fecha_final']   = (isset($_POST['fecha_final']))   ? $_POST['fecha_final']   : '';
        $requestCita['motivo'] 		  = (isset($_POST['motivo']))        ? $_POST['motivo']        : '';
        $requestCita['id_personal']   = (isset($_POST['id_personal']))   ? $_POST['id_personal']   : '';
        $requestCita['id_paciente']   = (isset($_POST['id_paciente']))   ? $_POST['id_paciente']   : '';
        $id=$obj->updateAll($_POST['id_cita'],$requestCita);
    }else{
        //add new
        $id=$obj->addAll(getPost());
    }		
    //$id=240;
    
    if ($id > 0){
            informSuccess(true, make_url());
    }else{
        informError(true,make_url("Citas","add"));
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->

<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Citas"] = APP_URL."/Citas/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <?php if($statuscita!='active'){ ?>
            <h6 class="alert alert-warning semi-bold">
                <i class="fa fa-times"></i> Esta cita no se puede editar por que ya esta  <strong><?php echo $statuscita; ?></strong>.
            </h6>
        <?php } ?>
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="well ">
                    <header>
                            <h2><i class="fa fa-clock"></i>&nbsp;<?php echo 'CITAS' ?></h2>
                    </header>
                    <fieldset>          
                        <form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Citas","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">    
                            <input type="hidden" value="<?php echo $id_cita?>" name="id_cita">
                            <input type="hidden" name="fecha_inicial"  required id="fecha_inicial" value="<?php echo $fecha_inicial;?>" />
                            <input type="hidden" name="fecha_final"    required id="fecha_final"   value="<?php echo date('Y-m-d H:i',$fecha_final);?>" />
                            <section id="widget-grid" class="">
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-1">
                                    <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-recepcion" 
                                    data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                        <header onclick="$('.showrecepcion').toggle()"> <span class="widget-icon"> 
                                            <i class="far fa-calendar"></i> </span><h2><?php echo $title ?></h2>
                                        </header>
                                        <div class="showrecepcion" style="display: ;">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox" style=""></div>
                                            <div class="widget-body">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="name">Fecha Cita </label>
                                                            <input class="form-control datepicker" size="16"  id="fecha" type="text" data-dateformat='yy-mm-dd' value="<?php echo date('Y-m-d',strtotime ( $fecha_inicial ) ) ;?>" readonly>
                                                        </div> 
                                                        <div class="form-group row">
                                                            <div class="col-sm-10 col-xs-10 row">
                                                                <select style="width:100%" class="select2"  required name="id_paciente" id="id_paciente">
                                                                    <option value="" selected disabled>Selecciona paciente</option>
                                                                    <?php 
                                                                    $obj = new Paciente();
                                                                    $list=$obj->getAllArr();
                                                                    if (is_array($list) || is_object($list)){
                                                                        foreach($list as $val){
                                                                            $selected = ($id_paciente == $val['id']) ? "selected" : "";
                                                                            echo "<option $selected value='".$val['id']."'>".htmlentities($val['nombre'].' '.$val['apellido_pat']." ".$val['apellido_mat'])."</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2 col-xs-2 ">
                                                                <a data-toggle="modal" class="btn btn-success" href="#myModalSecond" onclick="showpopuppacientes()" > <i class="fa fa-plus"></i></a>                                          
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <select style="width:100%" class="select2"  required name="id_personal" id="id_personal">
                                                                <option value="" selected disabled>Selecciona Medico</option>
                                                                <?php 
                                                                $obj = new Personal();
                                                                $list=$obj->getAllArr(2); // medicos
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        $selected = ($id_personal == $val['id']) ? "selected" : "";
                                                                        echo "<option $selected value='".$val['id']."'>".htmlentities($val['nombre'].' '.$val['apellido_pat']." ".$val['apellido_mat'])."</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group ">
                                                            <label for="name"><i class="fal fa-info-circle" title="Selecciona las horas para la cita"></i>&nbsp; Hora </label>
                                                            <div class="input-group row ">
                                                                <div class="col-md-4 ">
                                                                    <div class="allowed-time">
                                                                        <input class="form-control hora" style="width: 130px;"  type="time"  name="hora_inicial" id="hora_inicial" value="<?php echo $hora_inicial?>">
                                                                    
                                                                    </div>
                                                                </div>
                                                                <label class="col-md-2 col-sm-1" style="texl-align:center">a</label>
                                                                <div class="col-md-4">
                                                                    <div class="allowed-time">
                                                                        <input class="form-control hora" style="width: 130px;" type="time"  name="hora_fin" id="hora_fin" value="<?php echo $hora_final?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group ">
                                                            <input type="text" class="form-control" required  placeholder="Tratamiento" name="motivo" id="motivo" value="<?php echo $motivo;?>" >
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-sm-4" id="contpaciente">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="text-align: center">
                                                    <div class="row">
                                                        <?php if($statuscita=='active'){ ?>     
                                                            <div class="col-md-12">
                                                                <?php if($id_cita){ ?>
                                                                    <a href="<?php echo make_url("Historial","consulta",array('id_cita'=>$id_cita)); ?>">
                                                                        <button class="btn btn-success btn-md" type="button" id="">
                                                                            <i class="fa fa-file"></i>
                                                                            Generar Consulta
                                                                        </button>
                                                                    </a>
                                                                <?php } ?>
                                                                <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                                                    Cancelar
                                                                </button>
                                                                <button class="btn btn-primary btn-md" type="button" onclick=" validateForm();">
                                                                    <i class="fa fa-save"></i>
                                                                    Guardar
                                                                </button>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article> 
                            </section>                                       
                        </form>
                    </fieldset>
                    
                    <fieldset>
                        <div class="col-sm-12 col-md-12 col-lg-12" id="contcitas" style="text-align:">
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="100" alt="SmartAdmin">
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
   $(document).ready(function() {
         
        /*GENERALES*/
       
        validateForm =function(){
            var fecha_inicial = $("input[name=fecha_inicial]").val();
            var fecha_final   = $("input[name=fecha_final]").val();
            var id_paciente   = $("#id_paciente").val();
            var id_personal   = $("#id_personal").val();
            var motivo        = $("#motivo").val();
            if ( ! fecha_inicial )              return notify("info","La fecha de inicio es requerida");
            if ( ! fecha_final )                return notify("info","La Hora final es requerida");
            if ( fecha_final < fecha_inicial )  return notify("info","La Hora final no puede ser menor a la fecha de inicio");      
            if ( ! id_paciente )                return notify("info","El Paciente es requerido");
            if ( ! id_personal )                return notify("info","El Medico es requerido");
            if ( ! motivo )                     return notify("info","El Tratamiento es requerido");
            existecita();
                   
        }
        $(document).keydown(function(event) {
            if (event.ctrlKey==true && (event.which == '106' || event.which == '74')) {
                // alert('thou. shalt. not. PASTE!');
                event.preventDefault();
            }
        });
        existecita = function(){
            var fecha_inicial = $("input[name=fecha_inicial]").val();
            var fecha_final   = $("input[name=fecha_final]").val();
            var id_paciente   = $("#id_paciente").val();
            var id_personal   = $("#id_personal").val();
            var motivo        = $("#motivo").val();
            
            var url = config.base+"/Citas/ajax/?action=get&object=existecita"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "GET",
                url: url,
                data: "fecha_inicial="+fecha_inicial+'&fecha_final='+fecha_final+'&id_personal='+id_personal, 
                success: function(response){
                    if(response>0){
                        swal({
                            title: "Cita existente en este horario",
                            text: "Deseas agendar esta cita?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Si, Agendar!',
                            closeOnConfirm: true
                            },
                            function(){
                                $("#main-form").submit();
                            }
                        );
                    }else{
                        $("#main-form").submit();
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        }
        getcitasproximas = function(){
            var fecha_inicial = $("input[name=fecha_inicial]").val();
            var fecha_final   = $("input[name=fecha_final]").val();
            var id_paciente   = $("#id_paciente").val();
            var id_personal   = $("#id_personal").val();
            
            var url = config.base+"/Citas/ajax/?action=get&object=getcitasproximas"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "GET",
                url: url,
                data: "fecha_inicial="+fecha_inicial+'&fecha_final='+fecha_final+'&id_personal='+id_personal, 
                success: function(response){
                    if(response){
                        $("#contcitas").html(response);
                    }else{
                        $("#contcitas").html(''); 
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        }
        getcitasproximas();
 

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
        $('body').on('click', '#savenewpaciente', function(){
            var nombre       = $("input[name=nombre]", $(this).parents('form:first')).val();
            var apellido_pat = $("input[name=apellido_pat]", $(this).parents('form:first')).val();
            var apellido_mat = $("input[name=apellido_mat]", $(this).parents('form:first')).val();
            var telefono     = $("input[name=telefono]", $(this).parents('form:first')).val();
            
            if(!nombre)   {  swal("Se necesita el nombre del paciente.");   return false; }
            if(!telefono) {  swal("Se necesita el telefono del paciente."); return false; }
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
               getcitasproximas();
            }
        });
        $('body').on('change', '#hora_inicial', function(){
            $('#fecha_inicial').val( $('#fecha').val() + ' ' + $(this).val() );
        });
        $('body').on('change', '#hora_fin', function(){
            $('#fecha_final').val(   $('#fecha').val() + ' ' + $(this).val() );
        });
        <?php
        if($id_paciente){
            ?>
            $('#id_paciente').change();
            <?php
        }
        
        ?>
        
       
     
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
