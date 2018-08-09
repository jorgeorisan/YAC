$(document).ready(function (){

//UPDATES VERSIONS OF CARS VIA AJAX
    $("#car").change(function (){
        $.ajax({
            type: 'GET',
            url: 'admin/admin/version/process/ajax_versions.php',
            data: 'id_car='+$(this).val(),
            success: function(response){
                $("#version").html(response);
            }
        });
    });
    $("#car").change(function (){
        $.ajax({
            type: 'GET',
            url: 'admin/admin/insurance/process/ajax_insurances.php',
            data: 'id_car='+$(this).val(),
            success: function(response){
                $("#insurance_group").html(response);
                $("#insurance_group").buttonset();
                
            }
        });
    });

    $("#car").change(function (){
        $.ajax({
            type: 'GET',
            url: 'admin/admin/extra/process/ajax_extras.php',
            data: 'id_car='+$(this).val(),
            success: function(response){
                $("#extra_div").html(response);
                $("#extra_div").buttonset();
            }
        });
    });
    //CLEAR INPUTS
    $("[clear=true]").focus(function (){
        if($(this).val()==$(this).attr("default")){
            $(this).val("");
        }
    }).blur(function (){
        if($(this).val()==''){
            $(this).val($(this).attr("default"));
        }
    });

    //CHANGES RADIOS TO BUTTON
    $("#insurance_group").buttonset();

    //CHANGES CHECKBOXS TO BUTTON
    $("#extra_div").buttonset();

    $("#same_address").button();

    //COPIES THE ADDRESS
    $("[repeat=true]").keyup(function (){
        if($("#same_address").attr("checked")){
            var this_var=$(this);
            $("#"+this_var.attr("repeat_target")).val(this_var.val());
        }
    })

    $("#same_address").change(function (){
        if($(this).attr("checked")){
            $("#street2").val($("#street1").val());
            $("#neighborhood2").val($("#neighborhood1").val());
            $("#zipcode2").val($("#zipcode1").val());
            $("#reference2").val($("#reference1").val());
        }
    });

    //UPDATES TOTAL
    $("[update_total=true]").click(function (){
        $.ajax({
            type: 'GET',
            url: 'process/calc_total.php',
            data: $("#cotizador_form").serialize(),
            success: function(response){
                $("#total").html(response);
            }
        });
    }).change(function (){
        $.ajax({
            type: 'GET',
            url: 'process/calc_total.php',
            data: $("#cotizador_form").serialize(),
            success: function(response){
                $("#total").html(response);
            }
        });
    }).select(function (){
        $.ajax({
            type: 'GET',
            url: 'process/calc_total.php',
            data: $("#cotizador_form").serialize(),
            success: function(response){
                $("#total").html(response);
            }
        });
    });

    //REFRESH TOTAL
    $("#cotizador_form").submit(function (){
        $("#total").html("Total: $0.00");
    })

    $("#cotizador_form").submit(function (){
        $(this).validate();
    })
    //VALIDATE COTIZADOR FORM
    $("#cotizador_form").validate({
        rules:{
            from:{
                notEqualTo: 'Seleccionar fecha',
                required:true
            },
            to:{
                notEqualTo: 'Seleccionar fecha',
                required:true,
                laterDate: 'from'
            },
            street1:{
                notEqualTo: 'Calle y Número',
                required:true
            },
            street2:{
                notEqualTo: 'Calle y Número',
                required:true
            },
            neighborhood1:{
                notEqualTo: 'Colonia',
                required:true
            },
            neighborhood2:{
                notEqualTo: 'Colonia',
                required:true
            },
            zipcode1:{
                notEqualTo: 'Código postal',
                required:true
            },
            zipcode2:{
                notEqualTo: 'Código postal',
                required:true
            },
            reference1:{
                notEqualTo: 'Referencias',
                required:true
            },
            reference2:{
                notEqualTo: 'Referencias',
                required:true
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    //Do AJAX and insert the result before #add_row
    sendCotizador=function(form) {
        $.ajax({
            type: $(form).attr("method"),
            url: $(form).attr("action"),
            data: $(form).serialize(),
            success: function(html) {
                if(html=="1"){
                    $("#msg_tray").html("<p class='msg done'>Gracias, recibimos tu cotización y a la brevedad nos pondremos en contacto contigo</p>");
                    $(form).each(function(){
                        this.reset();
                    });
                }else{
                    $("#msg_tray").html(msg_error);
                }

            }
        });
    }

});
//CHANGE PRICE ON CLICK//
$("#ui-datepicker-div").click(function ()
{
    $.ajax({
        type: 'GET',
        url: 'process/calc_total.php',
        data: $("#cotizador_form").serialize(),
        success: function(response){
            $("#total").html(response);
        }
    });
}
);