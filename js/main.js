$(document).ready(function () {
    $.ajax({
        data: "accion=validaSesion",
        type: "POST",
        url: "validaSesion.php",
        dataType: 'json',
        success: function (data) {
            if (data==="nada")
            {
             window.location = "login.html";
            }else{
                buscaUsuario();
                $("#login").css("display","none");
                
            }
        }
    });
 });
 function salir ()
 {
    $.ajax({
        data: "&accion=cerrarSesion",
        type: 'POST',
        url: 'validaSesion.php',
        success: function (data) {
                if (data==="Error")
                {
                 
                }else{
                    alert(data);
                    window.location = "login.html";
                }
            }
    });
     
 }



