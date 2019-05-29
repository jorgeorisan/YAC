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
$date = '';
if(isset($request['params']['date']))
    $date=$request['params']['date'];

if(isPost()){
    $obj = new Cita();
    $id  = $obj->addAll(getPost());
    //$id=240;
    
    if ($id > 0){
        informSuccess(true, make_url("Citas","index"));
    }else{
        informError(true,make_url("Citas","add"));
    }
}
$fecha_inicial = ($date) ? $date.' '.date('H:i') : date('Y-m-d H:i');
$fecha_final   = strtotime ( '+1 hour' , strtotime ( $fecha_inicial ) ) ;
$fecha_final   = date('Y-m-d H:i',$fecha_final);
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->

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
                                            <i class="far fa-building"></i> </span><h2>Recepcion</h2>
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
                                                                <input type="text" class="form-control" required  placeholder="Motivo de Cita" name="motivo" id="motivo" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            
                                                            <select style="width:100%" class="select2"  required name="id_usuario" id="id_usuario">
                                                                <option value="" selected disabled>Selecciona Usuario</option>
                                                                <?php 
                                                                $obj = new Usuario();
                                                                $list=$obj->getAllArr("17,18"); // medicos
                                                                if (is_array($list) || is_object($list)){
                                                                    foreach($list as $val){
                                                                        echo "<option value='".$val['id']."'>".htmlentities($val['id_usuario'])."</option>";
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
                                                                <select style="width:100%" class="select2"  required name="id_persona" id="id_persona">
                                                                    <option value="" selected disabled>Selecciona Cliente</option>
                                                                    <?php 
                                                                    $obj = new Persona();
                                                                    $list=$obj->getAllArr();
                                                                    if (is_array($list) || is_object($list)){
                                                                        foreach($list as $val){
                                                                            echo "<option value='".$val['id_persona']."'>".htmlentities($val['nombre'])."</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a data-toggle="modal" class="btn btn-success" href="#myModal" onclick="showpopuppersonas()" > <i class="fa fa-plus"></i></a>                                          
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4" id="contpersona">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12" id="contcitas" style="text-align:center">
                                                </div>
                                                
                                            </div>
                                        </div>
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
            var id_persona   = $("#id_persona").val();
            var id_usuario   = $("#id_usuario").val();
            var motivo        = $("#motivo").val();
            if ( ! fecha_alta )              return notify("info","La fecha de inicio es requerida");
            if ( ! fecha_final )             return notify("info","La fecha final es requerida");
            if ( fecha_final < fecha_alta )  return notify("info","La fecha final no puede ser menor a la fecha de inicio");      
            if ( ! id_persona )             return notify("info","El Paciente es requerido");
            if ( ! id_usuario )             return notify("info","El Usuario es requerido");
            if ( ! motivo )                  return notify("info","El motivo es requerido");
            
            $("#main-form").submit();       
        }
        $(document).keydown(function(event) {
            if (event.ctrlKey==true && (event.which == '106' || event.which == '74')) {
                // alert('thou. shalt. not. PASTE!');
                event.preventDefault();
            }
        });
      
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
        showpopuppersonas = function(){
            $('#titlemodal').html('<span class="widget-icon"><i class="far fa-plus"></i> Nuevo persona</span>');
            $.get(config.base+"/Clientes/ajax/?action=get&object=showpopup", null, function (response) {
                    if ( response ){
                        $("#contentpopup").html(response);
                    }else{
                        return notify('error', 'Error al obtener los datos del Formulario de personas');
                        
                    }     
            });
        }
        getpersona =function(id){
            if ( ! id ) return;
            $("#contpersona").html("<div align='center'><i class='far fa-cog fa-spin fa-5x'></i></div>");
            $.get(config.base+"/Citas/ajax/?action=get&object=getcliente&id=" + id, null, function (response) {
                    if ( response ){
                        $("#contpersona").html(response);
                    }else{
                        notify('error', 'Error al obtener los datos del persona');
                        return false;
                    }     
            });
        }
        $('body').on('click', '#savenewclient', function(){
            var nombre       = $("input[name=nombre]", $(this).parents('form:first')).val();
            var apellido_pat = $("input[name=apellido_pat]", $(this).parents('form:first')).val();
            var apellido_mat = $("input[name=apellido_mat]", $(this).parents('form:first')).val();
            var telefono     = $("input[name=telefono]", $(this).parents('form:first')).val();
            
            if(!nombre) {  notify('error',"Se necesita el nombre del persona."); return false; }
            var url = config.base+"/Clientes/ajax/?action=get&object=savenewclient"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).parents('form:first').serialize(), // Adjuntar los campos del formulario enviado.
                success: function(response){
                    if(response>0){
                        //alert("Group successfully added");
                        $('#id_persona').append($('<option>', {
                            value: response,
                            text: nombre+" "+apellido_pat+" "+apellido_mat,
                            selected:true
                        }));  
                        $("#id_persona").select2({
                            multiple: false,
                            header: "Selecciona una opcion",
                            noneSelectedText: "Seleccionar",
                            selectedList: 1
                        });
                        $('#myModal').modal('hide');
                        notify('success',"persona agregado correctamente:"+response);
                        getpersona(response);
                    }else{
                        notify('error',"Oopss error al agregar persona"+response);
                    }
                }
             });
            return false; // Evitar ejecutar el submit del formulario.
        });
        $('body').on('change', '#id_persona', function(){
            if( $(this).val() ){
                var id = $("#id_persona").val();
                getpersona(id);
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
               getcitasproximas();
            }
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
