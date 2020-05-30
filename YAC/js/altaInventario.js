$(document).ready(function () {
   buscarAseguradora();
   sectionSlide();
   capturaFecha();
   $("#chkIngresa").change(autoIngresaClinica);
});
function capturaFecha()
{
    var fechaCaptura = new Date();
    $("#fechaCaptura").val(fechaCaptura);
}
function nuevoInventario()
{
    var parametros = $("#frmInventario").serialize();
    $.ajax({
            data: parametros + "&accion=NuevoInventario",
            type: 'POST',
            url: 'inventarioInsertar.php',
            dataType: 'json',
            success: function (data) {
                cargaInventario(data);
            }
    });
    mostrarSecciones();
    var mostrarIncidente = document.getElementById("tabIncidente");
    mostrarIncidente.click();
    $("#Confirmar").remove();
}
function guardar ()
{
    var parametros = "";
    if ($("input[name='buscaInventario']").val() != null)
    {parametros += "txtFiltro=" + $("input[name='buscaInventario']").val();}
    $.ajax({
            data: parametros + "&accion=buscarInventarioSession",
            type: 'POST',
            url: 'inventarioInsertar.php',
            dataType: 'json',
            success: function (data) {
                var existe = data.length;
                var msjFuncion = 0;
                var msjEncabezado = "";
                var msjTexto = "";
                if(existe > 0)
                {
                    msjFuncion = 1;
                    msjEncabezado = "¿Actualizar registro?";
                    msjTexto = "Está apunto de modificar el reporte " + data[0].NoExpediente;
                    
                }else
                {
                    msjFuncion = 0;
                    msjEncabezado = "¿Insertar registro?";
                    msjTexto = "Está apunto de agregar un nuevo registro ";
                }
                mensajeAdvertencia(msjEncabezado, msjTexto, msjFuncion);
            }
            });
}
function enviaCorreo(data, correo) {
    var parametros="idInventario=" +data[0].idInventario;
    $.ajax({
        data: parametros + "&accion="+correo,
        type: 'POST',
        url: 'enviarCorreo.php',
        dataType: 'json',
        success: function (data) {
        }
    });
}
function insertarInventario(accion) {
    var fechaCaptura = new Date();
    var idEstatusRep = "&idEstatusRep=";
    var ingresa = $("#chkIngresa").prop("checked");
    if(ingresa){idEstatusRep += "2";}else{idEstatusRep += "1";}
    var parametros = $("#frmInventario").serialize();
    parametros += "&fechaCaptura=" + fechaCaptura;
    $.ajax({
        data: parametros + idEstatusRep +"&accion="+accion,
        type: 'POST',
        url: 'inventarioInsertar.php',
        dataType: 'json',
        success: function (data) {
            if(data != "Error")
            {
                var encabezado = "";
                var texto = "";
                if(accion == "ingresaInventario")
                {
                    encabezado = "Registro Ingresado";
                    texto = "El Expediente con el No. " + data[0].NoExpediente + " fue guardado con éxito.";
                }else
                {
                    encabezado = "Registro Actualizado";
                    texto = "El Expediente con el No. " + data[0].NoExpediente + " fue actualizado con éxito.";
                }
                mensajeRealizado(encabezado, texto);
            }
            else{
                alert(data); 
            }
        }
    });
}
function buscarAseguradora() {
    var idIngresa="";
    var parametros = $("#frmInventario").serialize();
    //alert(parametros);
    $.ajax({
        data: parametros + "&accion=cargarAseguradoras",
        type: 'POST',
        url: 'aseguradoraInsertar.php',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (id, value) {
                $("#idAseguradora").append('<option value="' + id + '">' + value + '</option>');
            });
        }
    });
}

function buscarClinica() {
    var parametros = $("#frmInventario").serialize();
    //alert(parametros);
    $.ajax({
        data: parametros + "&accion=buscaClinica",
        type: 'POST',
        url: 'clinicaInsertar.php',
        dataType: 'json',
        success: function (data) {
            //console.log(data);
            //console.log(data.nomAseguradora);
            $("input[name='nomClinica']").val(data.nombreClinica);
            $("input[name='numIntTall']").val(data.numInterior);
            $("input[name='ciudadTall']").val(data.ciudad);
            $("input[name='telefonoTall']").val(data.telefono);
            $("input[name='numExtTall']").val(data.numExterior);
            $("input[name='estadoTall']").val(data.estado);
            $("input[name='correoTall']").val(data.correo);
            $("input[name='calleTall']").val(data.calle);
            $("input[name='coloniaTall']").val(data.colonia);
            $("input[name='cpTall']").val(data.cp);
            $("input[name='rfcTall']").val(data.rfc);                                    
        }
    });
}

function buscarPaciente() {
    var parametros = $("#frmInventario").serialize();
    //alert(parametros);
    $.ajax({
        data: parametros + "&accion=buscaPaciente",
        type: 'POST',
        url: 'pacienteInsertar.php',
        dataType: 'json',
        success: function (data) {  
            //console.log(data);
            //alert(data.idPaciente);
            $("input[name='idPaciente']").val(data.idPaciente);
            $("input[name='nomPaciente']").val(data.nomPaciente);
            $("input[name='numIntCli']").val(data.numInt);
            $("input[name='ciudadCli']").val(data.ciudad);
            $("input[name='telefonoCli']").val(data.telefono);
            $("input[name='numExtCli']").val(data.numExt);
            $("input[name='estadoCli']").val(data.estado);
            $("input[name='correoCli']").val(data.correo);
            $("input[name='calleCli']").val(data.calle);
            $("input[name='coloniaCli']").val(data.colonia);
            $("input[name='cpCli']").val(data.cp);
            $("input[name='rfcPaciente']").val(data.rfc);                                                                
        }
    });
}

function buscarAuto() {
    var parametros = $("#frmInventario").serialize();
    //alert(parametros);
     $.ajax({
        data: parametros + "&accion=buscaVehiculo",
        type: 'POST',
        url: 'vehiculoInsertar.php',
        dataType: 'json',
        success: function (data) {
            $("input[name='idVehiculo']").val(data.idVehiculo);
            $("input[name='placas']").val(data.placa);
            $("input[name='modelo']").val(data.modelo);
            $("input[name='kms']").val(data.kms);
            $("input[name='color']").val(data.color);
            $("input[name='marca']").val(data.marca);
            $("input[name='serie']").val(data.serie); 
        }
     });
}
function sectionSlide(){
    $('dl dd').not('dt.activo + dd').hide(); 
    $('dl dt').click(function(){
    if ($(this).hasClass('activo')) {
            $(this).removeClass('activo');
            $(this).next().slideUp();
       } else {
            $('dl dt').removeClass('activo');
                $(this).addClass('activo');
                $('dl dd').slideUp();
                $(this).next().slideDown();
            }
        });
}
function autoIngresaClinica ()
{
    var ingresa = $("#chkIngresa").prop("checked");
    if(ingresa)
    {
       $("#Interiores").slideDown();
       $("#Motor").slideDown();
       $("#Frontal").slideDown();
       $("#Trasero").slideDown();
       $("#Izquierdo").slideDown();
       $("#Derecho").slideDown();
       $("#Cajuela").slideDown();
       $("#Otros").slideDown();
       $("#dtLlaves").slideDown();
       $("#dtLlantas").slideDown();
       $("#dtPreexist").slideDown();
       $("#dtObserv").slideDown();
       $("#dtArticulos").slideDown();
       $("#fotosAutoTransito").slideUp();
       $("#fotosAutoT").html('');
    }
    else
    {
        $("#Interiores").slideUp();
        $("#Motor").slideUp();
        $("#Frontal").slideUp();
        $("#Trasero").slideUp();
        $("#Izquierdo").slideUp();
        $("#Derecho").slideUp();
        $("#Cajuela").slideUp();
        $("#Otros").slideUp();
        $("#dtLlaves").slideUp();
        $("#dtLlantas").slideUp();
        $("#dtPreexist").slideUp();
        $("#dtObserv").slideUp();
        $("#dtArticulos").slideUp();
        $("#fotosAutoTransito").slideDown();
        $("#fotosInteriores").html('');
        $("#fotosMotor").html('');
        $("#fotosFrontal").html('');
        $("#fotosTrasero").html('');
        $("#fotosIzquierdo").html('');
        $("#fotosDerecho").html('');
        $("#fotosCajuela").html('');
        $("#fotosOtros").html('');
        $("#fotosLlaves").html('');
        $("#fotosLlantas").html('');
        $("#fotosPreexist").html('');
    }
    
}
function mostrarSecciones(){
       $("#tabIncidente").slideDown();
       $("#Paciente").slideDown();
       $("#Vehiculo").slideDown();
       $("#botones").slideDown();
}

function cargaInventario(data) {
    //Datos Reporte
    $("input[name='idInventario']").val(data[0].idInventario);
    $("input[name='noPoliza']").val(data[0].noPoliza);
    $("input[name='Siniestro']").val(data[0].Siniestro);
    $("input[name='NoExpediente']").val(data[0].NoExpediente);
    $("input[name='idClinica']").val(data[0].idClinica);
    $("#idAseguradora").val(data[0].idAseguradora);
    $("input[name='Reporte']").val(data[0].Reporte);
    $("input[name='deducible']").val(data[0].deducible);
    //Datos Paciente
    $("input[name='idPaciente']").val(data[0].idPaciente);
    $("input[name='rfcPaciente']").val(data[0].rfcPaciente);
    $("input[name='nomPaciente']").val(data[0].nomPaciente);
    $("input[name='telefonoCli']").val(data[0].telPaciente);
    $("input[name='ciudadCli']").val(data[0].ciudadPaciente);
    $("input[name='numIntCli']").val(data[0].numIntPaciente);
    $("input[name='numExtCli']").val(data[0].numExtPaciente);
    $("input[name='calleCli']").val(data[0].callePaciente);
    $("input[name='coloniaCli']").val(data[0].colPaciente);
    $("input[name='estadoCli']").val(data[0].estadoPaciente);
    $("input[name='correoCli']").val(data[0].correoPaciente);
    $("input[name='cpCli']").val(data[0].cpPaciente);
    //Datos Vehiculo
    $("input[name='idVehiculo']").val(data[0].idVehiculo);
    $("input[name='placas']").val(data[0].placaVehiculo);
    $("input[name='modelo']").val(data[0].modVehiculo);
    $("input[name='color']").val(data[0].colorVehiculo);
    $("input[name='marca']").val(data[0].marcaVehiculo);
    $("input[name='serie']").val(data[0].serieVehiculo);
    if(data[0].idEstatusRep == 1)
    {$("#chkIngresa").prop("checked",false);} 
    else if(data[0].idEstatusRep >= 2)
    {$("#chkIngresa").prop("checked",true);}
    autoIngresaClinica();
    //Datos Inventario
    $("#tablero").val(data[0].invTablero);
    $("#funcionIndicadores").val(data[0].invIndicadores);
    $("#tanqueGasolina").val(data[0].invTanque);
    $("input[name='Kilometraje']").val(data[0].invKilometraje);
    $("#FuncionamientoAC").val(data[0].invFuncionamientoAC);
    $("#ControlesAC").val(data[0].invControlesAC);
    $("#Cenicero").val(data[0].invCenicero);
    $("#Encendedor").val(data[0].invEncendedor);
    $("#Guantera").val(data[0].invGuantera);
    $("#Retrovisor").val(data[0].invRetrovisor);
    $("#LuzInterior").val(data[0].invLuzInterior);
    $("#Visera").val(data[0].invVisera);
    $("#Claxon").val(data[0].invClaxon);
    $("#EquipoAudioOriginal").val(data[0].invEquipoAudioOriginal);
    $("#EquipoAudioAdaptado").val(data[0].invEquipoAudioAdaptado);
    $("input[name='CategoriaEquipoAudio']").val(data[0].invCategoriaEquipoAudio);
    $("#Ecualizador").val(data[0].invEcualizador);
    $("#Amplificador").val(data[0].invAmplificador);
    $("#CajadeCDs").val(data[0].invCajadeCDs);
    $("#Bocinas").val(data[0].invBocinas);
    $("#AlarmadeFabrica").val(data[0].invAlarmaDeFabrica);
    $("#AlarmaInstalada").val(data[0].invAlarmaInstalada);
    $("#Tapetes").val(data[0].invTapetes);
    $("#Tapiceria").val(data[0].invTapiceria);
    $("#Intermitentes").val(data[0].invIntermitentes);
    $("#LucesExteriores").val(data[0].invLucesExteriores);
    $("#Bateria").val(data[0].invBateria);
    $("#TaponRadiador").val(data[0].invTaponRadiador);
    $("#Radiador").val(data[0].invRadiador);
    $("#TaponAceite").val(data[0].invTaponAceite);
    $("#Bandas").val(data[0].invBandas);
    $("#BayonetaMotor").val(data[0].invBayonetaDeMotor);
    $("#BayonetaTransmision").val(data[0].invBayonetaDeTransmision);
    $("#Purificador").val(data[0].invPurificador);
    $("#CablesBujias").val(data[0].invCablesBujias);
    $("#DepositoAgua").val(data[0].invDepositoAgua);
    $("#FaciaFrontal").val(data[0].invFaciaFrontal);
    $("#Placa").val(data[0].invPlaca);
    $("#Parrilla").val(data[0].invParrilla);
    $("#Faros").val(data[0].invFaros);
    $("#FarosNiebla").val(data[0].invFarosNiebla);
    $("#Viceles").val(data[0].invViceles);
    $("#CuartosFrontal").val(data[0].invCuartosFrontal);
    $("#EmblemaCofre").val(data[0].invEmblemaCofre);
    $("#EmblemaParrilla").val(data[0].invEmblemaParrilla);
    $("#ParabrisasFrontal").val(data[0].invParabrisasFrontal);
    $("#BrazosLimpiaParabrisas").val(data[0].invBrazosLimpiaParabrisas);
    $("#PlumasLimpiaParabrisas").val(data[0].invPlumasLimpiaParabrisas);
    $("#Cofre").val(data[0].invCofre);
    $("#Medallon").val(data[0].invMedallon);
    $("#Calaveras").val(data[0].invCalaveras);
    $("#Molduras").val(data[0].invMolduras);
    $("#BrazoLimpiador").val(data[0].invBrazoLimpiador);
    $("#PlumaLimpiadora").val(data[0].invPlumaLimpiadora);
    $("#Emblemas").val(data[0].invEmblemas);
    $("#Spoiler").val(data[0].invSpoiler);
    $("#PlacaTrasera").val(data[0].invPlacaTrasera);
    $("#Escape").val(data[0].invEscape);
    $("#FaciaTrasera").val(data[0].invFaciaTrasera);
    $("#CuartosLatIzq").val(data[0].invCuartosLatIzquierdo);
    $("#EmblemasLatIzq").val(data[0].invEmblemasLatIzquierdo);
    $("#EspejoLatIzq").val(data[0].invEspejoLatIzquierdo);
    $("#CristalesLatIzq").val(data[0].invCristalesLatIzquierdos);
    $("#ManijasLatIzq").val(data[0].invManijasLatIzquierdo);
    $("#MoldurasLatIzq").val(data[0].invMoldurasLatIzquierdo);
    $("#CuartosLatDer").val(data[0].invCuartosLatDerecho);
    $("#EmblemasLatDer").val(data[0].invEmblemasLatDerecho);
    $("#EspejoLatDer").val(data[0].invEspejoLatDerecho);
    $("#CristalesLatDer").val(data[0].invCristalesLatDerecho);
    $("#ManijasLatDer").val(data[0].invManijasLatDerecho);
    $("#MoldurasLatDer").val(data[0].invMoldurasLatDerecho);
    $("#Herramientas").val(data[0].invHerramientas);
    $("#Gato").val(data[0].invGato);
    $("#LlavedeLlantas").val(data[0].invLlaveDLlantas);
    $("#LlantaRefaccion").val(data[0].invLlantaRefaccion);
    $("#TapeteCajuela").val(data[0].invTapeteCajuela);
    $("#Extinguidor").val(data[0].invExtinguidor);
    $("#CablesPasaCorriente").val(data[0].invCablesPasaCorriente);
    $("#SenalesReflejantes").val(data[0].invSenalesReflejantes);
    $("#Antena").val(data[0].invAntena);
    $("#TapaGasolina").val(data[0].invTapaGasolina);
    $("#TaponGasolina").val(data[0].invTaponGasolina);
    $("#CanastillaViaje").val(data[0].invCanastillaViaje);
    $("#Llaves").val(data[0].invLlaves);
    $("#Llavero").val(data[0].invLlavero);
    $("#TarjetaCirc").val(data[0].invTarjetaCirculacion);
    $("#input[name='MedLlantaDelDer']").val(data[0].invMedLlantaDelDer);
    $("#input[name='CategoriaLlantaDelDer']").val(data[0].invCategoriaLlantaDelDer);
    $("#LlantaDelDerT").val(data[0].invLlantaDelDerT);
    $("#LlantaDelDerR").val(data[0].invLlantaDelDerR);
    $("#input[name='MedLlantaDelIzq']").val(data[0].invMedLlantaDelIzq);
    $("#input[name='CategoriaLlantaDelIzq']").val(data[0].invCategoriaLlantaDelIzq);
    $("#LlantaDelIzqT").val(data[0].invLlantaDelIzqT);
    $("#LlantaDelIzqR").val(data[0].invLlantaDelIzqR);
    $("#input[name='MedLlantaTrasDer']").val(data[0].invMedLlantaTrasDer);
    $("#input[name='CategoriaLlantaTrasDer']").val(data[0].invCategoriaLlantaTrasDer);
    $("#LlantaTrasDerT").val(data[0].invLlantaTrasDerT);
    $("#LlantaTrasDerR").val(data[0].invLlantaTrasDerR);
    $("#input[name='MedLlantaTrasIzq']").val(data[0].invMedLlantaTrasIzq);
    $("#input[name='CategoriaLlantaTrasIzq']").val(data[0].invCategoriaLlantaTrasIzq);
    $("#LlantaTrasIzqT").val(data[0].invLlantaTrasIzqT);
    $("#LlantaTrasIzqR").val(data[0].invLlantaTrasIzqR);
    $("#input[name='descDanosPreexist']").val(data[0].invDescDanosPreexist);
    $("#input[name='observaciones']").val(data[0].invObservaciones);
    $("#input[name='articulosResguardados']").val(data[0].invArticulosResguardados);
    mostrarSecciones();
    ImgInventario(0, "fotosAutoT", "CuentaFotosTransito");
    ImgInventario(1, "fotosInteriores", "CuentaFotosInteriores");
    ImgInventario(2, "fotosMotor", "CuentaFotosMotor");
    ImgInventario(3, "fotosFrontal", "CuentaFotosFrente");
    ImgInventario(4, "fotosTrasero", "CuentaFotosTrasero");
    ImgInventario(5, "fotosIzquierdo", "CuentaFotosIzquierdo");
    ImgInventario(6, "fotosDerecho", "CuentaFotosDerecho");
    ImgInventario(7, "fotosCajuela", "CuentaFotosCajuela");
    ImgInventario(8, "fotosOtros", "CuentaFotosOtros");
    ImgInventario(9, "fotosLlaves", "CuentaFotosLlaves");
    ImgInventario(10, "fotosLlantas", "CuentaFotosLlantas");
    ImgInventario(11, "fotosPreexist", "CuentaFotosPreexist");
//    var mostrarIncidente = document.getElementById("tabIncidente");
//    mostrarIncidente.click();
}
function cancelar()
{
    $("#Confirmar").remove();
}
function confirmaAltaInv(funcion)
{
    var accion;
    $("#Confirmar").remove();
    if (funcion == 0) {accion = "ingresaInventario";}
    else {accion = "actualizaInventario";}
    insertarInventario(accion);
}
function finAltaInv()
{
    $("#Aceptar").remove(); 
    if($("input[name='NoExpediente']").val() != "")
    {
    var parametros = "txtFiltro="+$("input[name='NoExpediente']").val();
    $.ajax({
            data: parametros + "&accion=buscarInventario",
            type: 'POST',
            url: 'inventarioInsertar.php',
            dataType: 'json',
            success: function (data) {
                var correo = "";
                var ingresa = $("#chkIngresa").prop("checked");
                if(ingresa)
                {correo = "correoIngresa";}
                else{correo = "correoTransito";}
                enviaCorreo(data, correo);
                window.location.assign("#/estatusReporte");
                cargaInventario(data);
                }
            });
    }
}
function mensajeAdvertencia(encabezado, texto, funcion)
{
    var txtMensaje = '<div id="Confirmar" ><div class="sweet-overlay" tabindex="-1" style="opacity: 1.1099999999999999; display: block;"></div><div class="sweet-alert showSweetAlert visible" tabindex="-1" data-has-cancel-button="true" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="true" data-timer="null" style="display: block; margin-top: -149px;"><div class="icon error" style="display: none;"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning pulseWarning" style="display: block;"> <span class="body pulseWarningIns"></span> <span class="dot pulseWarningIns"></span> </div> <div class="icon info" style="display: none;"></div> <div class="icon success" style="display: none;"> <span class="line tip"></span> <span class="line long"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom" style="display: none;"></div> <h2>' + encabezado + '</h2><p class="lead text-muted" style="display: block;">' + texto + '</p><p><button class="cancel btn btn-lg btn-default" tabindex="2" style="display: inline-block;" onclick="cancelar()">Cancelar</button> <button class="confirm btn btn-lg btn-warning" tabindex="1" style="display: inline-block;" onclick="confirmaAltaInv(' + funcion +')">Confirmar</button></p></div></div>';
    $("body").append(txtMensaje);
}
function msjAdvNvoInventario(encabezado, texto)
{
    var txtMensaje = '<div id="Confirmar" ><div class="sweet-overlay" tabindex="-1" style="opacity: 1.1099999999999999; display: block;"></div><div class="sweet-alert showSweetAlert visible" tabindex="-1" data-has-cancel-button="true" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="true" data-timer="null" style="display: block; margin-top: -149px;"><div class="icon error" style="display: none;"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning pulseWarning" style="display: block;"> <span class="body pulseWarningIns"></span> <span class="dot pulseWarningIns"></span> </div> <div class="icon info" style="display: none;"></div> <div class="icon success" style="display: none;"> <span class="line tip"></span> <span class="line long"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom" style="display: none;"></div> <h2>Nuevo Inventario</h2><p class="lead text-muted" style="display: block;">¿Desea dar de alta un nuevo inventario?</p><p><button class="cancel btn btn-lg btn-default" tabindex="2" style="display: inline-block;" onclick="cancelar()">Cancelar</button> <button class="confirm btn btn-lg btn-warning" tabindex="1" style="display: inline-block;" onclick="nuevoInventario()">Continuar</button></p></div></div>';
    $("body").append(txtMensaje);
}
function mensajeRealizado (encabezado, texto)
{
    var txtMensaje = '<div id="Aceptar"><div class="sweet-overlay" tabindex="-1" style="opacity: 1; display: block;"></div><div class="sweet-alert showSweetAlert visible" tabindex="-1" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="false" data-timer="null" style="display: block; margin-top: -167px;"><div class="icon error" style="display: none;"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning" style="display: none;"> <span class="body"></span> <span class="dot"></span> </div> <div class="icon info" style="display: none;"></div> <div class="icon success animate" style="display: block;"> <span class="line tip animateSuccessTip"></span> <span class="line long animateSuccessLong"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom" style="display: none; background-image: url(http://byrushan.com/projects/ma/1-5-2/angular/img/thumbs-up.png); width: 80px; height: 80px;"></div> <h2>' + encabezado + '</h2><p class="lead text-muted" style="display: block;">'+ texto + '</p><p><button class="cancel btn btn-lg btn-default" tabindex="2" style="display: none;">Cancel</button> <button class="confirm btn btn-lg btn-primary" tabindex="1" style="display: inline-block;" onclick="finAltaInv();">Aceptar</button></p></div></div>';
    $("body").append(txtMensaje);
}
function justNumbers(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46)) //numeros y punto
  // if (keynum == 8) //numeros
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}

/*Progress Bar */

function move(encabezado, texto) {
  var elem = document.getElementById("myBar");   
  var width = 10;
  var id = setInterval(frame, 300);
  function frame() {
    if (width >= 100) {
       clearInterval(id);
       $("#PrgrModal").hide();
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}
//function vistaPrevia(fileAutosTransito, destino)
//{
//    /* Limpiar vista previa */
//           var archivos = fileAutosTransito.files;
//           var navegador = window.URL || window.webkitURL;
//           /* Recorrer los archivos */
//           for(x=0; x<archivos.length; x++)
//           {
//               /* Validar tamaño y tipo de archivo */
//               var size = archivos[x].size;
//               var type = archivos[x].type;
//               var name = archivos[x].name;
//               if (size > 1024*1024*4)
//               {
//                   $("#"+ destino).append("<p style='color: red'>El archivo "+name+" supera el máximo permitido 1MB</p>");
//               }
//               else if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png' && type != 'image/gif')
//               {
//                   $("#"+ destino).append("<p style='color: red'>El archivo "+name+" no es del tipo de imagen permitida.</p>");
//               }
//               else
//               {
//                 var objeto_url = navegador.createObjectURL(archivos[x]);
//                 $("#"+ destino).append("<img src="+objeto_url+" width='250' height='250' class='obj'>");
//                 $("#fileAutosTransito2").add(archivos);
//               }
//           }
//           
//           enviaImagenes();
//}
//function updateSize(file) {
//  var nBytes = 0,
//      oFiles = file,
//      nFiles = oFiles.length;
//      alert(nFiles);
//  for (var nFileId = 0; nFileId < nFiles; nFileId++) {
//    nBytes += oFiles[nFileId].size;
//  }
//  var sOutput = nBytes + " bytes";
//  // optional code for multiples approximation
//  for (var aMultiples = ["KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"], nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
//    sOutput = nApprox.toFixed(2) + " " + aMultiples[nMultiple] + " (" + nBytes + " bytes)";
//  }
//  // end of optional code
//  document.getElementById("fileNum").innerHTML = nFiles;
//  document.getElementById("fileSize").innerHTML = sOutput;
//}





