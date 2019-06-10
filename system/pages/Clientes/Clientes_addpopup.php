
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
                                echo "<option value='".$key."'>".htmlentities($valref)."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nombre*</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" onkeypress="nextFocus('nombre', 'ap_paterno')" > 
                </div>
                <div class="form-group">
                    <label for="name">Correo</label>
                    <input type="email" class="form-control" placeholder="example@email.com" name="email" id="email" onkeypress="nextFocus('email', 'telefono')">                                                          
                </div>
              
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">Apellido Paterno</label>
                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="ap_paterno" id="ap_paterno" onkeypress="nextFocus('ap_paterno', 'ap_materno')" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Teléfono*</label>
                    <input type="text" class="form-control" placeholder="Teléfono" name="telefono" id="telefono" onkeypress="nextFocus('telefono', 'observaciones')" >                                                                                               
                </div>
                
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">Apellido Materno</label>
                    <input type="text" class="form-control" placeholder="Apellido Materno" name="ap_materno" id="ap_materno" onkeypress="nextFocus('ap_materno', 'email')" >                                                                                               
                </div>
              
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Observaciones</label>
                    <input type="text" class="form-control" placeholder="observaciones" name="observaciones" id="observaciones" onkeypress="nextFocus('observaciones', 'savenewclient')">                                                                                               
                </div>
            </div>
        </fieldset> 
        <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
            <div class="row">
               <div class="col-md-12">
                    <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    <button class="btn btn-primary btn-md" type="button" id="savenewclient">
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
    $('.select2').select2();
</script>
