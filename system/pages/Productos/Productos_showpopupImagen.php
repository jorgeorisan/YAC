<section id="widget-grid" class="">
    <?php if(!$data['imagen']){ ?>
        <form id="main-form" enctype="multipart/form-data" action="" method="post" >     
            <input type="hidden" id="id_producto" name="id_producto"  value="<?php echo $data['id_producto']; ?>">
            <div class="col-sm-6">
                <div class="form-group superbox">
                    <label for="name">Imagen</label>
                    <input type="file" id="imagen" name="imagen"  value="<?php echo $data['imagen']; ?>" required title="Imagen">
                    <div id='contfileproductos'>
                        <?php 
                        if($data['imagen']){
                            $carpetaimg = ASSETS_URL.'/productos/images';
                            echo "<div class='superbox-list'>
                                    <img src='".$carpetaimg.DIRECTORY_SEPARATOR.$data['imagen']."' 
                                    data-img='".$carpetaimg.DIRECTORY_SEPARATOR.$data['imagen']."'
                                    alt='".$data['imagen']."' title='".$data['imagen']."'
                                    style='max-width:150px;max-height:150px;min-width:100px'
                                    class='superbox-img'>
                                </div>";
                        }
                        ?> 
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
    <?php }else{ ?>
        <div id='' style="display:">
            <?php 
            if($data['imagen']){
                $carpetaimg = ASSETS_URL.'/productosimages/images';
                echo "<div class=''>
                        <img src='".$carpetaimg.DIRECTORY_SEPARATOR.$data['imagen']."' 
                            data-img='".$carpetaimg.DIRECTORY_SEPARATOR.$data['imagen']."'
                            alt='".$data['imagen']."' title='".$data['imagen']."'
                            style=''
                            class='superbox-img'>
                    </div>";
            }
            ?> 
        </div>
    <?php } ?>
</section>

<script>
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
                   // notify("error","Solo puedes seleccionar imagenes");
                    continue;
                }
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {
                        var num=Math.floor(Math.random() * 1000); 
                        var span = document.createElement('span');
                        span.innerHTML = ['<img style="width:100px" title="click para eliminar"  class="thumb" id="image_',num,'" max-width="150px" max-height="150px" src="', e.target.result,
                                        '" nameimage="', escape(theFile.name), '"/>'].join('');
                      document.getElementById('contfileproductos').insertBefore(span, null);
                      $('#contfileproductos<?php echo $data['id_producto']; ?>').html($('#contfileproductos').html());
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);     
            }
        }else{
            notify("error","Solo puedes seleccionar 15 imagenes");
        } 
    }
    <?php if(!$data['imagen']){ ?>
        $(document).ready(function(e) {
            document.getElementById('imagen').addEventListener('change', uploadimages, false);
            $(function(){
                $('.superbox-img').click(function(){
                    $('#content').html($(this).clone().attr("height","100%"));
                    $('#myModal').modal('show');
                })
            });
            
        
            $("#main-form").on('submit', function(){
                var formData = new FormData($("#main-form")[0]);
                $.ajax({
                    type: "POST",
                    url: config.base+"/Productos/ajax/?action=post&object=updateimagen",
                    data: formData, 
                    contentType: false,
                    processData: false,
                    success: function(id){
                        if(id){
                            console.log(id);
                            if(id >0){
                                notify('success','Exito Al guardar la imagen.');
                                $('#myModal').modal('hide');
                            }else{
                                notify('error','Error al cargar imagen.');
                            }
                        }
                    }
                });
                return false;
            });
            
            //file type validation
            $("#imagen").change(function() {
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                    alert('Please select a valid image file (JPEG/JPG/PNG).');
                    $("#imagen").val('');
                    
                }
                return false;
            });
        });
    <?php } ?>
</script>