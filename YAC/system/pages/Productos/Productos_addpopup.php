
<section id="widget-grid" class="">
    <form id="main-formproductos" enctype="multipart/form-data" action="" method="post" > 
        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">Categoria</label>
                <select style="width:100%" class="select2" name="id_categoria" id="id_categoria">
                    <?php 
                    $obj = new Categoria();
                    $list=$obj->getAllArr();
                    if (is_array($list) || is_object($list)){
                        foreach($list as $val){
                            echo "<option value='".$val['id_categoria']."'>".$val['categoria']."</option>";
                        }
                    }
                        ?>
                </select>
            </div>  
            <div class="form-group">
                <label for="name">Seccion</label>
                <select style="width:100%" class="select2" name="id_proveedor" id="id_proveedor">
                    <?php 
                    $obj = new Proveedor();
                    $list=$obj->getAllArr();
                    if (is_array($list) || is_object($list)){
                        foreach($list as $val){
                            $selected = ($data['id_proveedor'] == 1 ) ?  $selected = "selected" : '' ;
                            echo "<option $selected value='".$val['id_proveedor']."'>".$val['nombre_corto']."</option>";
                        }
                    }
                    ?>
                </select>
            </div> 
            <div class="form-group">
                <label for="name">Marca</label>
                <select style="width:100%" class="select2" name="id_marca" id="id_marca">
                    <?php 
                    $obj = new Marca();
                    $list=$obj->getAllArr();
                    if (is_array($list) || is_object($list)){
                        foreach($list as $val){
                            echo "<option value='".$val['id_marca']."'>".$val['nombre']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>  
            <div class="form-group">
                <label for="name">Es un Paquete</label>
                <select style="width:20%" class="select2" name="id_usuario_tipo" id="id_usuario_tipo">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Precio Editable</label>
                <select style="width:20%" class="select2" name="manual" id="manual">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Imagen</label>
                <input type="file" id="imagen" name="imagen" title="Imagen">
                <div id='contfileproductos'></div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12" style="padding:0px">
                <div class="col-sm-6" style="padding:0px" >
                    <div class="form-group">
                        <label for="name">Codigo de Barras</label>
                        <input type="text" class="form-control" id="codbarras" name="codbarras" placeholder="Codigo de Barras" onkeypress="nextFocus('codbarras', 'codigo')">
                    </div>
                </div>
                <div class="col-sm-6" style="padding:0px;padding-left: 10px;">
                    <div class="form-group">
                        <label class="name">Codigo </label>
                        <input type="text" required class="form-control" id="codigo" name="codinter" placeholder="Codigo" onkeypress="nextFocus('codigo', 'nombre')">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" onkeypress="nextFocus('nombre', 'costo')">
            </div>
            <div class="form-group">
                <label class="name">Costo </label>
                <input type="number" class="form-control" id="costo" name="costo" value="0" placeholder="Costo" onkeypress="nextFocus('costo', 'precio_descuento')">
            </div>
            <div class="col-sm-12" style="padding:0px">
                <div class="col-sm-6" style="padding:0px">
                    <div class="form-group">
                        <label class="name"> Precio Mayoreo</label>
                        <input type="number" class="form-control" id="precio_descuento" value="0" name="precio_descuento" placeholder="Precio Mayoreo" onkeypress="nextFocus('precio_descuento', 'precio')">
                    </div>
                </div>
                <div class="col-sm-6" style="padding:0px;padding-left: 10px;">
                    <div class="form-group">
                        <label class="name"> Precio</label>
                        <input type="number" class="form-control" id="precio" value="0" name="precio" placeholder="Precio" onkeypress="nextFocus('precio', 'savenewproducto')">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
            <div class="row">
            <div class="col-md-12">
                    <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    <button class="btn btn-primary btn-md" type="submit" id="saveform">
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
    function existeproducto(codigo, callback){
        if ( ! codigo ) return;
        $.get(config.base+"/Productos/ajax/?action=get&object=existeproducto&codigo=" + codigo, null, function (response) {
            if ( response == 1){
                $("#codigo").val('');
                swal( 'Este codigo ya existe favor de intentar con otro');
                return false;
            }else{
                if(callback){
                    try { callback(); }
                    catch(err) {
                        console.log(err.message);
                    }
                }
            }     
        });
	}
    num=0;
    contfotosauto=0;
    numdel=1;
    var arraydeleteauto=[];
    function uploadimages(evt) {
        document.getElementById('contfileproductos').innerHTML='';
        var files = evt.target.files; // FileList object
        $numfotos=0;
        for (var i = 0, f; f = files[i]; i++) {
            $numfotos++;
        }
        if($numfotos<=15){
            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {
                var nameimage=files[i].name;
                if(files[i].size >= 3856819) {
                  alert("La imagen "+nameimage+" es muy grande, El tamaño maximo es de 3.67 MB");
                  files[i].value = null;
                  continue;
                }
                contfotosauto++;
                // Only process image files.
                if (!f.type.match('image.*')) {
                    notify("error","Solo puedes seleccionar imagenes");
                    continue;
                }
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {
                        var num=Math.floor(Math.random() * 1000); 
                        var span = document.createElement('span');
                        span.innerHTML = ['<img style="width:100px" title="click para eliminar" onclick="deleteimage(',num,');  return false;"  class="thumb" id="image_',num,'" max-width="150px" max-height="150px" src="', e.target.result,
                                        '" nameimage="', escape(theFile.name), '"/>'].join('');
                      document.getElementById('contfileproductos').insertBefore(span, null);
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);     
            }
        }else{
            notify("error","Solo puedes seleccionar 15 imagenes");
        } 
    }
    $(document).ready(function() {
        document.getElementById('imagen').addEventListener('change', uploadimages, false);
        $(function(){
            $('.superbox-img').click(function(){
                $('#showPhoto .modal-body').html($(this).clone().attr("height","100%"));
                $('#showPhoto').modal('show');
            })
        });
        $("#costo").keyup(function (e){
            var precio = (parseFloat($(this).val())*  1.5);
            var preciod = (parseFloat($(this).val())*  1.3 );
            var precioc = (parseFloat($(this).val())*  1.1 );
            $("#precio").val(precio.toFixed(2));
            $("#precio_descuento").val(preciod.toFixed(2));
            $("#precio_costo").val(precioc.toFixed(2));
        });
        $(".select2").select2({
            dropdownParent: $('#myModal'),
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        $("#main-formproductos").on('submit', function(){
            var id_categoria = $("#id_categoria").val();
            if ( ! id_categoria )  return swal("La categoria es requerida");
            var id_proveedor = $("#id_proveedor").val();
            if ( ! id_proveedor )  return swal("La Seccion es requerida");
            var id_marca = $("#id_marca").val();
            if ( ! id_marca )  return swal("La marca es requerida");
            var codigo = $("input[name=codinter]").val();
            if ( ! codigo )  return swal("El codigo es requerido");
            var nombre = $("input[name=nombre]").val();
            if ( ! nombre )  return swal("El nombre es requerido");
            var formData = new FormData($("#main-formproductos")[0]);
            existeproducto(codigo,function(){
                $.ajax({
                    type: "POST", 
                    url: config.base+"/Productos/ajax/?action=post&object=savenewproducto",
                    data: formData, 
                    contentType: false,
                    processData: false,
                    success: function(data){
                        var json = $.parseJSON(data);
                        if(json.status){
                            console.log(json.response);
                            //alert("Group successfully added");
                            $('#barcode').val(json.code);  
                            $('#myModal').modal('hide');
                            swal("Producto agregado correctamente:"+json.code);
                        }else{
                            console.log(json.response);
                            swal('error',"Oopss error al agregar producto"+json.code);
                        }
                    }
                });     
            });  
            return false; // Evitar ejecutar el submit del formulario.
        });
    })

</script>
