$(document).ready(function() {

    var msg_done = "<p class='msg done'>La acción se realizó satisfactoriamente</p>";
    var msg_error = "<p class='msg error'>La acción no se realizó satisfactoriamente</p>";


    /*********************AJAX FUNCTIONS*******************/


    //Do AJAX and insert the result before #add_row
    doAjax = function(form) {
        $.ajax({
            type: $(form).attr("method"),
            url: $(form).attr("action"),
            data: $(form).serialize(),
            success: function(html) {
                if (html == "1") {
                    $("#msg_tray").html(msg_done);
                    $(form).each(function() {
                        this.reset();
                    });
                } else {
                    $("#msg_tray").html(html);
                }

            }
        });
    }
    //VALIDATE FORMS AND EXECUTE AJAX
    $("[ajax=true]").validate({
        submitHandler: function(form) {
            doAjax(form);
        }
    });

    $("[validate=true]").validate();


    $("[delete=true]").click(function(e){
        e.preventDefault();
        if(confirm("¿Seguro que desea borrar/cancelar?")){
            document.location=$(this).attr("href");
            return true;
        }else{
            return false;
        }
    });

    /***************ENDS AJAX FUNCTIONS************/


    /***************STYLE FUNCTIONS*****************/

    //ADDS ODD CLASS TO EVERY #data_table ODD ROW
    $("#data_table tr:odd").addClass("odd");


    /***************ENDS STYLE FUNCTIONS*************/

    /**********HELP FUNCTIONS************/

    //SHOW'S THE HELP VIDEO INSIDE A DIALOG GETTIG DYNAMIC ATTRIBUTES
    $("[action=show_help]").click(function() {
        $("#video img").attr("src", rootUrl() + "videos/" + $(this).attr("url"));
        $("#video").dialog({
            modal: true,
            width: 535,
            hide:'clip',
            resizable: false
        });
    });


    //SHOW'S A TOOLTIP
    $("[tooltip=true]").tipsy();

    /***********ENDS HELP FUNCTIONS******/


    //@return ROOT URL
    function rootUrl() {
        return "http://localhost/project_manager";
    }


    /*****TEST******/

    $(".msg").click(function () {
        $(this).hide("slow");
    });

    $("input,select,textarea").focus(
            function () {
                $(this).addClass("input-text-focus");
            }).blur(function () {
        $(this).removeClass("input-text-focus");
    });


    //BEGIN DATE FUNCTIONS

//PERMITE FECHAS SOLO DEL PASADO
//USO: <input type='text' datepicker="past"
    $("[datepicker=past]").datepicker({
        dateFormat:'yy-mm-dd',
        changeYear:true,
        changeMonth:true,
        yearRange: 'c-90:c+10',
        maxDate:new Date()
    });

//PERMITE FECHAS SOLO DEL FUTURO
//USO: <input type='text' datepicker="future"
    $("[datepicker=future").datepicker({
        dateFormat:'yy-mm-dd',
        changeYear:true,
        changeMonth:true,
        yearRange: 'c-90:c+10',
        minDate:new Date()
    });

//PERMITE TODAS LAS FECHAS
//USO: <input type='text' datepicker="true"
    $("[datepicker=true]").datepicker({
        dateFormat:'yy-mm-dd',
        changeYear:true,
        changeMonth:true
    });

//PERMITE FECHAS MAYORES A 18 AÑOS ATRAS
//USO: <input type='text' datepicker="over18"
    $("[datepicker=over18]").datepicker({
        dateFormat:'yy-mm-dd',
        changeYear:true,
        changeMonth:true,
        yearRange: 'c-90:c+10',
        maxDate:'-18y'
    });

//END DATE FUNCTIONS

    $("[datetimepicker=true]").datetimepicker({
        dateFormat:'yy-mm-dd',
        minDate: new Date(),
        changeYear:true,
        changeMonth:true,
        timeFormat: 'hh:mm:ss',
        stepMinute: 10
    });

//var date = $( "[datetimepicker=true]" ).datepicker( "option", "gotoCurrent" );
    var date = 0;
    $("[datetimepicker2=true]").datetimepicker({
        dateFormat:'yy-mm-dd',
        minDate: new Date(),
        changeYear:true,
        changeMonth:true,
        gotoCurrent:true,
        timeFormat: 'hh:mm:ss',
        stepMinute: 10,
        defaultDate: date + 2
    });

    $("[datepicker],[timepicker]").addClass("small-field")

    ///$("[timeago=true]").timeago();

    $("[timepicker=true]").timepicker();

    $("input:submit,.button").button();

});