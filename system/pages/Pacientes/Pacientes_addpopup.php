
<section id="widget-grid" class="">
  
    <form id="main-form" class="form-paciente" role="form" method=post action="#" onsubmit="return checkSubmit();" >
        <fieldset>    
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" onkeypress="nextFocus('nombre', 'apellido_pat')" > 
                </div>
                <div class="form-group">
                    <label for="name">Correo</label>
                    <input type="email" class="form-control" placeholder="example@email.com" name="email" id="email" onkeypress="nextFocus('email', 'telefono')">                                                          
                </div>
                <div class="form-group">
                    <label for="name">Calle</label>
                    <input type="text" class="form-control" placeholder="Calle" name="calle"  id="calle" onkeypress="nextFocus('calle', 'num_ext')">                                                                                               
                </div>
                 <div class="form-group">
                    <label for="name">Colonia</label>
                    <input type="text" class="form-control" placeholder="Colonia" name="colonia" id="colonia" onkeypress="nextFocus('colonia', 'ciudad')">                                                                                               
                </div>
            </div>
            <div class="col-sm-3">
                 <div class="form-group">
                    <label for="name">Apellido Paterno</label>
                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_pat" id="apellido_pat" onkeypress="nextFocus('apellido_pat', 'apellido_mat')" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Teléfono</label>
                    <input type="text" class="form-control" placeholder="Teléfono" name="telefono" id="telefono" onkeypress="nextFocus('telefono', 'estado')" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Número Exterior</label>
                    <input type="text" class="form-control" placeholder="Número Exterior" name="num_ext" id="num_ext" onkeypress="nextFocus('num_ext', 'num_int')" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Ciudad</label>
                    <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" id="ciudad" onkeypress="nextFocus('ciudad', 'cp')" >                                                                                               
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">Apellido Materno</label>
                    <input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_mat" id="apellido_mat" onkeypress="nextFocus('apellido_mat', 'email')" >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Estado</label>
                    <input type="text" class="form-control" placeholder="Estado" name="estado" id="estado"  onkeypress="nextFocus('estado', 'calle')"  >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">Número Interior</label>
                    <input type="text" class="form-control" placeholder="Número Interior" name="num_int" id="num_int" onkeypress="nextFocus('num_int', 'colonia')"  >                                                                                               
                </div>
                <div class="form-group">
                    <label for="name">CP</label>
                    <input type="text" class="form-control" placeholder="CP" name="cp" id="cp" onkeypress="nextFocus('cp', 'alergias')" >                                                                                               
                </div>
               
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Alergias</label>
                    <input type="text" class="form-control" placeholder="Alergias" name="alergias" id="alergias" onkeypress="nextFocus('alergias', 'savenewclient')">                                                                                               
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
</script>
