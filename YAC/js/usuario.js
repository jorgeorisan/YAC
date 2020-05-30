
function llenaSelectRol()
{
    $.ajax({
        data: "accion=buscaRol",
        type: "POST",
        url: "rolsearch.php",
        dataType: 'json',
        success: function (data) {
            $("#roles").empty();
            $("#roles").append('<option value="0">Seleccione un rol...</option>');
            $.each(data, function (id, value) {
                $("#roles").append('<option value="' + id + '">' + value + '</option>');
            });
        }
    });
}
function llenaSelectProceso()
{
    $.ajax({
        data: "accion=buscaProceso",
        type: "POST",
        url: "procesosearch.php",
        dataType: 'json',
        success: function (data) {
            $("#procesos").empty();
            $("#procesos").append('<option value="0">Seleccione un proceso...</option>');
            $.each(data, function (id, value) {
                //console.log(value);
                $("#procesos").append('<option value="' + id + '">' + value + '</option>');
            });
        }
    });
}
function llenaSelectClinica()
{
    $.ajax({
        data: "accion=cargarClinicaes",
        type: "POST",
        url: "clinicaInsertar.php",
        dataType: 'json',
        success: function (data) {
            $("#idClinica").empty();
            $("#idClinica").append('<option value="0">Seleccione un clinica...</option>');
            $.each(data, function (id, value) {
                $("#idClinica").append('<option value="' + id + '">' + value + '</option>');
            });
        }
    });
}
function ingresaNip(){
    var rol = $("#roles");
    if (rol.val() == 7 || rol.val() == 8 || rol.val()== 1)
    {
        $("#nipGroup").css("display","block");
        if(rol.val()==8)
        {
            llenaSelectProceso();
           $("#procesoGroup").css("display","block"); 
        }else{$("#procesoGroup").css("display","none");}
    }else{
        $("#nipGroup").css("display","none");
        $("#procesoGroup").css("display","none"); 
    }
}   
function buscaUsuario() {
     $.ajax({
        data: "accion=obtieneUsuario",
        type: 'POST',
        url: 'validaSesion.php',
        dataType: 'json',
        success: function (data) {
            
            if(data.idRol === "9")
            {
                $("#menu-trigger").hide();
                $("#toggle-width").hide();
            }
            if(data.idRol != "1")
            {
                $(".profile-menu > a ").css("background", "url(../imagenes/LogoMastretaOriginal.png) no-repeat center top");
                $(".profile-menu > a ").css("background-size", "contain");
                 $("#mainAdm").hide();
            }
            if($(document).find("#frmHome").length > 0)
            {
                    if(data.idRol === "9")
                {
                    var menuR = document.getElementById("menuRight");
                    var liMenu = menuR.getElementsByTagName("LI");
                    liMenu[0].style.display = "none";
                    liMenu[1].style.display = "none";
                }
                $("#homeHeader").text("Bienvenido "+data.nomUsuario);
                buscaInventarioSesion("buscarInventario");
            }
            if($(document).find("#frmAlcanceTrabajo").length > 0)
            {
                buscaInventarioSesion("buscarInventarioSession");
            }
            if($(document).find("#frmCotizacion").length > 0)
            {
                buscaInventarioSesion("buscarInventarioSession");
            }
            if($(document).find("#frmNota").length > 0)
            {
                buscaInventarioSesion("buscarInventarioSession");
            } 
            if($(document).find("#frmEntrega").length > 0)
            {
                buscaInventarioSesion("buscarInventarioSession");
            } 
            if($(document).find("#frmUsuario").length > 0)
            {
                llenaSelectRol();
                var rol = Number(data.idRol);
                if(rol === 1)
                {  
                    $("#clinicaGroup").css("display", "block"); 
                    llenaSelectClinica();
                }
            }
            if($(document).find("#frmRepGeneral").length > 0)
            {
                if(data.idRol != "1")
                {
                    $("input[name='opBusqueda']").hide();
                }
            } 
        }
     });
}
function buscaIdUsuario() {
    var idUsuario = 0;
     $.ajax({
        data: "accion=obtieneUsuario",
        type: 'POST',
        url: 'validaSesion.php',
        dataType: 'json',
        success: function (data) {
            idUsuario = data.idUsuario;
        }
     });
     return idUsuario;
}
function guardarUsuario() {
    var parametros = $("#frmUsuario").serialize(); 
    $.ajax({
        data: parametros + "&accion=ingresaUsuario",
        type: 'POST',
        url: 'usuarioInserta.php',
        dataType: 'json',
        success: function (response) {
            var encabezado = "Usuario Agregado";
            var texto = "Nuevo usuario agregado exitosamente.";
            msjUsuarioAgregado (encabezado, texto);
        }
    });
}
function actualizaUsuario() {
    var parametrosA = $("#frmUsuario").serialize();
    $.ajax({
        data: parametrosA + "&accion=actualizaUsuario",
        type: 'POST',
        url: 'usuarioInserta.php',
        dataType: 'json',
        success: function (response) {
            var encabezado = "Usuario Actualizado";
            var texto = "Usuario actualizado exitosamente.";
            msjUsuarioAgregado (encabezado, texto);
        }
    });
}

function buscar() {
    var parametrosB = $("#frmUsuario").serialize();
    $.ajax({
        data: parametrosB + "&accion=buscaUsuario",
        type: 'POST',
        url: 'usuarioInserta.php',
        dataType: 'json',
        success: function (data) {
            //console.log(data);
            $("input[name='idUsuario']").val(data.idUsuario);
            $("input[name='nomUsuario']").val(data.nomUsuario);
            $("input[name='usuario']").val(data.usuario);
            $("input[name='pass']").val(data.pass);
            $("input[name='correo']").val(data.correo);
            $("#idClinica").val(data.idClinica);
            $("#roles").val(data.idRol);
            $("input[name='nip']").val(data.nip);
            $("#procesos").val(data.proceso);
        } 
    });
}
function buscaInventarioSesion(accion) {
    $.ajax({
            data: "accion="+accion,
            type: 'POST',
            url: 'inventarioInsertar.php',
            dataType: 'json',
            success: function (data) {
                cargaInventario(data);
            }
            });
}
function estatusReporte(idInventario){
    window.location.assign("#/estatusReporte");
    var parametros = "idInventario="+idInventario;
    $.ajax({
            data: parametros + "&accion=buscarInventario",
            type: 'POST',
            url: 'inventarioInsertar.php',
            dataType: 'json',
            success: function (data) {
                cargaInventario(data);
            }});
    
}
$(document).keypress(function(e) {
    if(e.which == 13) {
        if($(document).find("#frmNomina").length > 0)
        {
        }else{
            var parametros = "";
            if ($("input[name='buscaInventario']").val() != null)
            {
                parametros += "txtFiltro=" + $("input[name='buscaInventario']").val();}
            else{parametros += "txtFiltro=";}
            $(".lvh-search-close").click();
            $.ajax({
                    data: parametros + "&accion=buscarInventario",
                    type: 'POST',
                    url: 'inventarioInsertar.php',
                    dataType: 'json',
                    success: function (data) {
                        cargaInventario(data);
            }});
        }
}});
function msjUsuarioAgregado (encabezado, texto)
{
    var txtMensaje = '<div id="Aceptar"><div class="sweet-overlay" tabindex="-1" style="opacity: 1; display: block;"></div><div class="sweet-alert showSweetAlert visible" tabindex="-1" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="false" data-timer="null" style="display: block; margin-top: -167px;"><div class="icon error" style="display: none;"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning" style="display: none;"> <span class="body"></span> <span class="dot"></span> </div> <div class="icon info" style="display: none;"></div> <div class="icon success animate" style="display: block;"> <span class="line tip animateSuccessTip"></span> <span class="line long animateSuccessLong"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom" style="display: none; background-image: url(http://byrushan.com/projects/ma/1-5-2/angular/img/thumbs-up.png); width: 80px; height: 80px;"></div> <h2>' + encabezado + '</h2><p class="lead text-muted" style="display: block;">'+ texto + '</p><p><button class="cancel btn btn-lg btn-default" tabindex="2" style="display: none;">Cancel</button> <button class="confirm btn btn-lg btn-primary" tabindex="1" style="display: inline-block;" onclick="terminar();">Aceptar</button></p></div></div>';
    $("body").append(txtMensaje);
}
function terminar()
{
    $("#Aceptar").remove(); 
    limpiarForm();
}
function limpiarForm()
{
    $("input[name='idUsuario']").val("");
    $("input[name='nomUsuario']").val("");
    $("input[name='usuario']").val("");
    $("input[name='pass']").val("");
    $("input[name='correo']").val("");
    $("#idClinica").val("0");
    $("#roles").val("0");
    $("input[name='nip']").val("");
    $("#procesos").val("0");
}

