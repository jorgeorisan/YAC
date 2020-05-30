
<section id="widget-grid" class="">
  
  <form id="main-form" class="form-refaccion" role="form" method=post action="#" onsubmit="return checkSubmit();" enctype="multipart/form-data">
    <fieldset>    
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <label for="name">Codigo</label>
                <input type="text" class="form-control" placeholder="Codigo Refaccion" name="codigo_refaccion" id="codigo_refaccion">                                                                                             
            </div>
            <div class="form-group">
                <select style="width:100%" class="select2" name="id_marca_refaccion" id="id_marca_refaccion">
                    <option value="">Selecciona Categoria</option>
                    <?php 
                    $objref = new Categoria();
                    $listref=$objref->getAllArr();
                    if (is_array($listref) || is_object($listref)){
                        foreach($listref as $valref){
                            
                            $selected = ( $id_marca == $valref['id'] ) ? 'selected' : '';
                            echo "<option $selected value='".$valref['id']."'>".htmlentities($valref['nombre'])."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Año</label>
            </div>
            <div class="form-group" style="width:50%;float:left">
                <select style="width:100%" class="select2" name="modelo_refaccion" id="modelo_refaccion">
                    <option value="">Año desde</option>
                    <?php 
                    $objcat=catModelo();
                    for ($i=0; $i < count($objcat) ; $i++) { 
                        echo "<option value='".$objcat[$i]."'>".htmlentities($objcat[$i])."</option>";
                    }  
                    ?>
                </select>
            </div>
            <div class="form-group" style="width:50%;float:left">
                <select style="width:100%" class="select2" name="modelo_hasta" id="modelo_hasta">
                    <option value="">Año hasta</option>
                    <?php 
                    $objcat=catModelo();
                    for ($i=0; $i < count($objcat) ; $i++) { 
                        echo "<option value='".$objcat[$i]."'>".htmlentities($objcat[$i])."</option>";
                    }  
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Costo</label>
                <input type="number" class="form-control" placeholder="Costo Aproximado Refaccion" name="costo_aprox_refaccion" id="costo_aprox_refaccion" >                                                                                             
            </div> 
            <div class="form-group" id="">
                <label for="name">Poder agregar mas detalles</label>
                <select style="width:100%" class="select2" name="detalles" id="detalles">
                    <option value="0">NO</option>
                    <option value="1">SI</option>
                    
                </select>
            </div>                                          
        </div>
        <div class="col-sm-6 col-md-6"> 
            <div class="form-group">
                <label for="name">Refaccion</label>
                <input type="text" class="form-control" placeholder="Nombre Refaccion" name="nombre_refaccion" id="nombre_refaccion" >                                                                                             
            </div>
            <div class="form-group" id="contsubmarca_refaccion">
                <select style="width:100%" class="select2" name="id_marca_refaccion" id="id_marca_refaccion">
                    <option value="">Selecciona Modelo</option>
                    <?php 
                    $objref = new Marca();
                    $listref=$objref->getAllbyid($id_marca);
                    if (is_array($listref) || is_object($listref)){
                        foreach($listref as $valref){
                            
                            $selected = ( $id_marca == $valref['id'] ) ? 'selected' : '';
                            echo "<option  $selected value='".$valref['id']."'>".htmlentities($valref['nombre'])."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" class="form-control" placeholder="Descripcion" name="descripcion_refaccion" id="descripcion_refaccion" >                                                                                               
            </div>
           
        </div>
                      
    </fieldset> 
      <div class="form-actions" style="text-align: center;width: 100%;margin-left: 0px;">
          <div class="row">
             <div class="col-md-12">
                  <button class="btn btn-default btn-md" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      Cancelar
                  </button>
                  <button class="btn btn-primary btn-md" type="button" id="savenewrefaccion">
                      <i class="fa fa-save"></i>
                      Guardar
                  </button>
              </div>
          </div>
      </div>                              
  </form>
             
</section>

<script>
   function getsubmarcarefaccion(id){
        if ( ! id ) return;

        $.get(config.base+"/Vehiculos/ajax/?action=get&object=getsubmarcapopup&id=" + id, null, function (response) {
                if ( response ){
                    $("#contsubmarca_refaccion").html(response);
                    $('#id_marca_refaccion').select2();
                   
                }else{
                    notify('error', 'Error al obtener los datos del paciente');
                    return false;
                }     
        });
    }
    $(document).ready(function() { 
         $('body').on('change', '#id_marca_refaccion', function(){
            if( $(this).val() ){
                var id = $("#id_marca_refaccion").val();
                getsubmarcarefaccion(id);
            }
        });
     
        $(".select2").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
    });
</script>