
<section id="widget-grid" class="">
  
    <form id="main-form" class="form-paciente" role="form" method=post action="#" onsubmit="return checkSubmit();" >
        <fieldset>    
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Tipo</label>
                    <select style="width:100%" class="select2 " name="id_usuario_tipo"  id="id_usuario_tipo">
                        <?php 
                        $listref= getTipoPersona();
                        if (is_array($listref)){
                            foreach($listref as $key => $valref){
                                $selected = ($option==$key) ? 'selected':'';
                                echo "<option value='".$key."' $selected>".htmlentities($valref)."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nombre*</label>
                    <input type="text" class="form-control buscar" placeholder="Nombre" name="nombre" id="nombre" onkeypress="nextFocus('nombre', 'ap_paterno')" > 
                </div>
                <div class="form-group">
                    <label for="name">Apellido Paterno</label>
                    <input type="text" class="form-control buscar" placeholder="Apellido Paterno" name="ap_paterno" id="ap_paterno" onkeypress="nextFocus('ap_paterno', 'ap_materno')" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Apellido Materno</label>
                    <input type="text" class="form-control buscar" placeholder="Apellido Materno" name="ap_materno" id="ap_materno" onkeypress="nextFocus('ap_materno', 'email')" >                                                                                               
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Correo</label>
                    <input type="email" class="form-control" placeholder="example@email.com" name="email" id="email" onkeypress="nextFocus('email', 'telefono')">                                                          
                </div>
                <div class="form-group">
                    <label for="name">Teléfono*</label>
                    <input type="text" class="form-control buscar" placeholder="Teléfono" name="telefono" id="telefono" onkeypress="nextFocus('telefono', 'observaciones')" >                                                                                               
                </div>
                
                <div class="form-group">
                    <label for="name">Observaciones</label>
                    <input type="text" class="form-control" placeholder="observaciones" name="observaciones" id="observaciones" onkeypress="nextFocus('observaciones', 'savenewclient')">                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Coincidencias</label>
                    <div id="contentpersons"></div>
                </div>
            </div>
        </fieldset> 
        <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
            <div class="row">
               <div class="col-md-12">
                    <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    <button class="btn btn-primary btn-md" type="button" id="savenewcliente">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>                              
    </form>
               
</section>
<script>
    function nextFocus(inputF, inputS) {
        document.getElementById(inputF).addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
            document.getElementById(inputS).focus();
            }
        });
    }
    $('body').on('keyup', '.buscar', function(){
        var nombre       = $("input[name=nombre]", $(this).parents('form:first')).val();
        var apellido_pat = $("input[name=ap_paterno]", $(this).parents('form:first')).val();
        var apellido_mat = $("input[name=ap_materno]", $(this).parents('form:first')).val();
        var telefono     = $("input[name=telefono]", $(this).parents('form:first')).val();
        var id_usuario_tipo    = $("#id_usuario_tipo").val();
        var url = config.base+"/Clientes/ajax/?action=get&object=personExistings"; // El script a dónde se realizará la petición.
        if(!nombre && !apellido_mat && !apellido_mat && !telefono) return false;
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).parents('form:first').serialize(), // Adjuntar los campos del formulario enviado.
            success: function(response){
                if(response){
                    //alert("Group successfully added");
                    $('#contentpersons').html(response);  
                   
                }else{
                    notify('error',"Oopss error al agregar Cliente"+response);
                }
            }
            });
        return false; // Evitar ejecutar el submit del formulario.
    });
    $('.select2').select2();
    
</script>
