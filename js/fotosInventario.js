function getFoto(id, e)
{
    var fileElem = document.getElementById(id);
    if (fileElem) {
        fileElem.click();
      }
  e.preventDefault();
}
function subeFotoInventario(obj){
    $("#PrgrModal").show();
    moveImg();
    var imgs = obj.files;
    var objId = obj.id;
    var destino = obj.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("DIV");
//    vistaPrevia(obj, destino[2].id);
    objId= objId.replace("fileInventario","");
    for (var i = 0; i < imgs.length; i++) {
            var fd = new FormData();
            fd.append('imagen1', imgs[i]);
            var ruta = "subirImagen.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    var IsError = datos[0]+datos[1]+datos[2]+datos[3]+datos[4];
                    if(IsError == "Error")
                    {
                        alert(datos);
                    }else{
                        guardaFotoInventario(datos, objId, destino[2].id);
                        
                    }
                }
            });
    } 
}
function vistaPrevia(archivos, destino) {
  var files = archivos.files;
  var preview = document.getElementById(destino);
  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    var imageType = /^image\//;
    if (!imageType.test(file.type)) {
      continue;
    }
    var img = document.createElement("img");
    img.classList.add("obj");
    img.height = 200;
    img.file = file;
    preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.
    var reader = new FileReader();
    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
    reader.readAsDataURL(file);
  }
}
function moveImg() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 100);
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
function guardaFotoInventario(url, objId, destino)
{ 
    var parametros = "idSeccion="+objId; 
    parametros+= "&url="+url;
    $.ajax({
        data: parametros + "&accion=ingresaFotosInv",
        type: 'POST',
        url: 'fotosInsertar.php',
        success: function (response) {
            agregaFoto(response, url, destino);
        }
    });
}
function agregaFoto(idFoto, url, destino)
{
    var resumen = "";
    resumen += "<div data-src='" + url + "' class='col-sm-3 col-xs-6'>";
    resumen += "<div class='lightbox-item p-item'  onclick='imageModal(this)'>";
    resumen += "<img src='" + url + "' alt=''>";
    resumen += "</div><input type='checkbox' value='' id='"+idFoto+"' onchange='chkFoto(this)' style='display:none'>";
    resumen += "</div>";
    $("#"+destino).append(resumen);
}
function ImgInventario(idSeccion, container, conteo)
{
    var parametros = "idSeccion="+idSeccion;
    $.ajax({
            data: parametros + "&accion=buscaFotosInv",
            type: 'POST',
            url: 'fotosInsertar.php',
            dataType: 'json',
            success: function (data) {
                $("#"+container).empty();
                var filas = data.length;
                var resumen = "";
                   for ( i = 0 ; i < filas; i++){ //cuenta la cantidad de registros

                            resumen += "<div data-src='" + data[i]['imgInventario'] + "' class='col-sm-3 col-xs-6'>";
                            resumen += "<div class='lightbox-item p-item'  onclick='imageModal(this)'>";
                            resumen += "<img src='" + data[i]['imgInventario'] + "' alt=''>";
                            resumen += "</div><input type='checkbox' value='' id='"+data[i]['idFoto']+"' onchange='chkFoto(this)' style='display:none'>";
                            resumen += "</div>";
                    }
                $("#"+container).html(resumen);
                $("#"+conteo).text(filas);
            }
           });
}
function selectFotos(container)
{ 
    var imgContainer = document.getElementById(container);
    var chks = imgContainer.getElementsByTagName("INPUT");
    var btnDelFoto = imgContainer.parentNode.parentNode.getElementsByTagName("LI");//.childNodes[1].childNodes[3].innerHTML;//.childNodes[7].id;
    for (var i = 0; i < chks.length; i++) {
        if(chks[i].style.display === "none"){chks[i].style.display = "block";}
        else if(chks[i].style.display === "block"){chks[i].style.display = "none"; chks[i].checked = false; $("#"+btnDelFoto[2].id).hide();}
    }
}
function chkFoto(chk)
{
    var imgContainer = chk.parentNode.parentNode;
    var btnDelFoto = imgContainer.parentNode.parentNode.getElementsByTagName("LI");
    var chks = imgContainer.getElementsByTagName("INPUT");
    var selChks = 0;
    for (var i = 0; i < chks.length; i++) {
        if(chks[i].checked  === true){selChks += 1;}
    }
    if (selChks >0){$("#"+btnDelFoto[2].id).show();}
    else if (selChks ===0){$("#"+btnDelFoto[2].id).hide();}
}
function delFotos(container)
{
    var encabezado = "Corfirmar eliminación de fotos seleccionadas";
    var texto = "Está apunto de eliminar las fotografías de siniestro del expediente actual seleccionadas .";
    msjAdvDelFoto(encabezado, texto, container);
}
function confDelFoto(container)
{
    var imgContainer = document.getElementById(container);
    var chks = imgContainer.getElementsByTagName("INPUT");
    var delFotos = 0;
    for (var i = 0; i < chks.length; i++) {
        if(chks[i].checked  === true){
           var idFoto = chks[i].id;
           var idSeccion = 0;
           $.ajax({
            data: "idFotoInv=" + idFoto + "&idSeccion=" + idSeccion + "&accion=eliminaFoto",
            type: 'POST',
            url: 'fotosInsertar.php',
            dataType: 'json',
            success: function (response) {
                if(response)
                {
                    delFotos = delFotos + 1; 
                }
            } 
        });
        }
    }
    cancelar();
    
    var btnDelFoto = imgContainer.parentNode.parentNode.getElementsByTagName("LI");
    var cuentaFotos = imgContainer.parentNode.parentNode.getElementsByTagName("SPAN");
    var idSeccion = imgContainer.parentNode.parentNode.getElementsByTagName("INPUT");
    idSeccion = idSeccion[0].id;
    idSeccion= idSeccion.replace("fileInventario","");
    $("#"+btnDelFoto[2].id).hide();
    var encabezado = "Fotografías eliminadas";
    var texto = "Eliminación de las fotografías seleccionadas realizada con éxito";
    msjRealDelFotos(encabezado, texto);
    ImgInventario(idSeccion, container, cuentaFotos[0].id);
}
function msjAdvDelFoto(encabezado, texto, container)
{
    var txtMensaje = '<div id="Confirmar" ><div class="sweet-overlay" tabindex="-1" style="opacity: 1.1099999999999999; display: block;"></div><div class="sweet-alert showSweetAlert visible" tabindex="-1" data-has-cancel-button="true" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="true" data-timer="null" style="display: block; margin-top: -149px;"><div class="icon error" style="display: none;"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning pulseWarning" style="display: block;"> <span class="body pulseWarningIns"></span> <span class="dot pulseWarningIns"></span> </div> <div class="icon info" style="display: none;"></div> <div class="icon success" style="display: none;"> <span class="line tip"></span> <span class="line long"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom" style="display: none;"></div> <h2>' + encabezado + '</h2><p class="lead text-muted" style="display: block;">' + texto + '</p><p><button class="cancel btn btn-lg btn-default" tabindex="2" style="display: inline-block;" onclick="cancelar()">Cancelar</button> <button class="confirm btn btn-lg btn-warning" tabindex="1" style="display: inline-block;" onclick=confDelFoto("'+container+'");>Confirmar</button></p></div></div>';
    $("body").append(txtMensaje);
}
function msjRealDelFotos(encabezado, texto)
{
    var txtMensaje = '<div id="Aceptar"><div class="sweet-overlay" tabindex="-1" style="opacity: 1; display: block;"></div><div class="sweet-alert showSweetAlert visible" tabindex="-1" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="false" data-timer="null" style="display: block; margin-top: -167px;"><div class="icon error" style="display: none;"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning" style="display: none;"> <span class="body"></span> <span class="dot"></span> </div> <div class="icon info" style="display: none;"></div> <div class="icon success animate" style="display: block;"> <span class="line tip animateSuccessTip"></span> <span class="line long animateSuccessLong"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom" style="display: none; background-image: url(http://byrushan.com/projects/ma/1-5-2/angular/img/thumbs-up.png); width: 80px; height: 80px;"></div> <h2>' + encabezado + '</h2><p class="lead text-muted" style="display: block;">'+ texto + '</p><p><button class="cancel btn btn-lg btn-default" tabindex="2" style="display: none;">Cancel</button> <button class="confirm btn btn-lg btn-primary" tabindex="1" style="display: inline-block;" onclick="terminar();">Aceptar</button></p></div></div>';
    $("body").append(txtMensaje);
}


















//function buscar() {
//    var parametros = $("#frmFotosInv").serialize();
//    $.ajax({
//            data: parametros + "&accion=buscarInventario",
//            type: 'POST',
//            url: 'inventarioInsertar.php',
//            dataType: 'json',
//            success: function (data) {
//                //$("#resultado").html(data);
//                $("input[name='nomPaciente']").val(data.nombreClie);
//        }
//    });
//}
//function subirImagen() {
//    if($("input[name='titImagen']" ).val() != "" && $("textarea[name='descImagen']" ).val() != "" && $("#imagen1").val().length > 0)
//    {
//    var formData = new FormData($("#frmFotosInv")[0]);
//            var ruta = "subirImagen.php";
//            $.ajax({
//                url: ruta,
//                type: "POST",
//                data: formData,
//                contentType: false,
//                processData: false,
//                success: function(datos)
//                {
//                    guardar(datos);
//                }
//            });
//    }else{
//        if($("input[name='titImagen']" ).val() === ""){alert("Agregue un título a la imagen");}
//        if($("textarea[name='descImagen']" ).val() === ""){alert("Agregue una descripción a la imagen");}
//        if($("#imagen1").val().length < 1){alert("Seleccione una imagen");}
//    }
//}
//function guardar(url)
//{
//    var parametros = $("#frmFotosInv").serialize(); 
//    parametros+= "&url="+url;
//    $.ajax({
//        data: parametros + "&accion=ingresaFotosInv",
//        type: 'POST',
//        url: 'fotosInsertar.php',
//        success: function (response) {
//            alert(response);
//            var imagen = "";
//            imagen += "<div style='width:24%; display:block; float:left; margin-top: 10px; margin-right: 10px;'>";
//            imagen += "<img src=" + url + " width='100%'>";
//            imagen += "<label style='width:100%; display:block; background-color:#555; color:#fff; padding:5px;'>" + $("textarea[name='descImagen']" ).val() + "</label>";
//            imagen += "</div>";
//            $("#imagenesSubidas").append(imagen);
//            $("#imagenesSubidas").show();
//            $("#siguiente").removeAttr("disabled");
//            limpiaformulario();
//        }
//    });
//}
//
//function vistaPrevia(archivos, destino) {
//  var files = archivos.files;
//  var preview = document.getElementById(destino);
//  for (var i = 0; i < files.length; i++) {
//    var file = files[i];
//   
//    var imageType = /^image\//;
//     
//    if (!imageType.test(file.type)) {
//      continue;
//    }
//    
//    var img = document.createElement("img");
//    img.classList.add("obj");
//    img.height = 200;
//    img.file = file;
//    preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.
//    var reader = new FileReader();
//    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
//    reader.readAsDataURL(file);
//  }
//}
//
//function enviaImagenes(Inventario) {
//  var imgs = document.querySelectorAll(".obj");
//  for (var i = 0; i < imgs.length; i++) {
//    new subeImagenes(imgs[i], imgs[i].file, Inventario[0].idInventario);
//  }
//}
//function subeImagenes(img, file, idInventario){
//    
//            var idSeccion = img.parentNode.className;
//            var fd = new FormData();
//            fd.append('imagen1', file);
//            var ruta = "subirImagen.php";
//            $.ajax({
//                url: ruta,
//                type: "POST",
//                data: fd,
//                contentType: false,
//                processData: false,
//                success: function(datos)
//                {
//                    var IsError = datos[0]+datos[1]+datos[2]+datos[3]+datos[4];
//                    if(IsError == "Error")
//                    {
//                        alert(datos);
//                    }else{
//                        guardarFotos(datos, idInventario, idSeccion);
//                    }
//                    
//                }
//            });
//}
//function guardarFotos(url, idInventario, idSeccion)
//{
//    var parametros = "idInventario="+idInventario+"&idSeccion="+idSeccion; 
//    parametros+= "&url="+url;
//    $.ajax({
//        data: parametros + "&accion=ingresaFotosInv",
//        type: 'POST',
//        url: 'fotosInsertar.php',
//        success: function (response) {
//        }
//    });
//}