<?php 
$carpetaimg = ASSETS_URL.'/productosimages/images/';
$urlimagen ='images/defaultimageproducto.jpg';
if($data['imagen']!=''){
    $urlimagen= $carpetaimg.$data['imagen'];
}
?>
<div class="row precio-vr mb-4">
    <span class="money" data-currency-mxn="<?php echo $data['precio']?>" data-currency="MXN">$ <?php echo $data['precio']?> MXN</span>
    <!-- <span class="precio-anterior" data-currency-mxn="<?php echo $data['precio']?>" data-currency="MXN">$ 50.00</span> -->
</div>
<div class="row">
    <div class="col-12 col-md-7 text-center m-auto">
        <img src="<?php echo $urlimagen?>" class="img-provisional-vr">
    </div>
    <div class="col-12 col-md-5">

        <div class="row">
            <p class="parrafo-vr">
                <?php echo ($data['descripcion'])? htmlentities($data['descripcion']) :'No se encontro descripcion'; ?>
            </p>
        </div>
    </div>
</div>
<div class="row modal-footer">
    <button type="button" class="btn boton-cerrar-vr" data-dismiss="modal">Cerrar</button>
    <!--<button type="button" class="btn boton-vistarapida">Ver más información</button>-->
</div>