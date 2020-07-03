
<section id="widget-grid" class="">
    <form id="formproduct" class="form-productos" role="form" method=post action="#" onsubmit="return checkSubmit();" >
        <input type="hidden" name="id_producto" value="<?php echo $data['id_producto']?>" >
        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">Categoria</label>
                <select style="width:100%" class="select2" name="id_categoria" id="id_categoria">
                    <?php 
                    $obj = new Categoria();
                    $list=$obj->getAllArr();
                    if (is_array($list) || is_object($list)){
                        foreach($list as $val){
                            $selected = ($data['id_categoria']  == $val['id_categoria'] ) ?  $selected = "selected" : '' ;
                            echo "<option   $selected value='".$val['id_categoria']."'>".$val['categoria']."</option>";
                        }
                    }
                        ?>
                </select>
            </div>  
            <div class="form-group">
                <label for="name">Status Categoria</label>
                <select style="width:100%" class="select2" name="status_categoria" id="status_categoria">
                 
                    <option value='Normal' <?php echo ($data['status_categoria'] == 'Normal' ) ?  $selected = "selected" : ''?>>Normal</option>
                    <option value='Nuevo' <?php echo ($data['status_categoria'] == 'Nuevo' ) ?  $selected = "selected" : ''?>>Nuevo</option>
                    <option value='Proximamente' <?php echo ($data['status_categoria'] == 'Proximamente' ) ?  $selected = "selected" : ''?>>Proximamente</option>
                    <option value='Oferta' <?php echo ($data['status_categoria'] == 'Oferta' ) ?  $selected = "selected" : ''?>>Oferta</option>
                     
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
                            $selected = ($data['id_proveedor']  == $val['id_proveedor'] ) ?  $selected = "selected" : '' ;
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
                            $selected = ($data['id_marca'] == $val['id_marca'] ) ? "selected" : '';
                            echo "<option  $selected value='".$val['id_marca']."'>".$val['nombre']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>  
            <div class="form-group">
                <label for="name">Es un Paquete</label>
                <select style="width:20%" class="select2" name="paquete" id="paquete">
                    <option value="0" <?php echo ($data['paquete'] == 0 ) ? "selected" : '' ?>>No</option>
                    <option value="1" <?php echo ($data['paquete'] == 1 ) ? "selected" : '' ?>>Si</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Servicio</label>
                <select style="width:20%" class="select2" name="manual" id="manual">
                    <option value="0" <?php echo ($data['manual'] == 0 ) ? "selected" : '' ?>>No</option>
                    <option value="1" <?php echo ($data['manual'] == 1 ) ? "selected" : '' ?>>Si</option>
                </select>
            </div>
            
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12" style="padding:0px">
                <div class="col-sm-6" style="padding:0px" >
                    <div class="form-group">
                        <label for="name">Codigo de Barras</label>
                        <input type="text" class="form-control" id="codbarras" name="codbarras"  value="<?php echo $data['codbarras']; ?>" placeholder="Codigo de Barras" onkeypress="nextFocus('codbarras', 'codigo')">
                    </div>
                </div>
                <div class="col-sm-6" style="padding:0px;padding-left: 10px;">
                    <div class="form-group">
                        <label class="name">Codigo </label>
                        <input type="text" required class="form-control" id="codigo" name="codinter"  value="<?php echo $data['codinter']; ?>" placeholder="Codigo" onkeypress="nextFocus('codigo', 'nombre')">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" placeholder="Nombre" onkeypress="nextFocus('nombre', 'costo')">
            </div>
            <div class="form-group">
                <label class="name">Costo </label>
                <input type="number" class="form-control" id="costo" name="costo" value="<?php echo $data['costo']; ?>" placeholder="Costo" onkeypress="nextFocus('costo', 'precio_descuento')">
            </div>
            <div class="col-sm-12" style="padding:0px">
                <div class="col-sm-6" style="padding:0px">
                    <div class="form-group">
                        <label class="name"> Precio Mayoreo</label>
                        <input type="number" class="form-control" id="precio_descuento" value="<?php echo $data['precio_descuento']; ?>" name="precio_descuento" placeholder="Precio Mayoreo" onkeypress="nextFocus('precio_descuento', 'precio')">
                    </div>
                </div>
                <div class="col-sm-6" style="padding:0px;padding-left: 10px;">
                    <div class="form-group">
                        <label class="name"> Precio</label>
                        <input type="number" class="form-control" id="precio" value="<?php echo $data['precio']; ?>" name="precio" placeholder="Precio" onkeypress="nextFocus('precio', 'existencia')">
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
                    <button class="btn btn-primary btn-md" type="button" id="saveproduct">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>                              
    </form>        
</section>
<script>
    $(".select2").select2({
        multiple: false,
        header: "Selecciona una opcion",
        noneSelectedText: "Seleccionar",
        selectedList: 1
    });
   
    
</script>
