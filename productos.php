<?php
ob_start();

error_reporting(E_ALL); ini_set('display_errors', 1);

include('header.php');
include('menu-vertical.php');
?>
<style>
@media screen and (min-width: 768px) and (max-width: 1024px) {

    .ocultar {
    display: inline !important;
    }

}
</style>

<!--productos-->
<div class="col-12 col-md-8 col-lg-9 ">
    <!--Row 1 productos-->
    <div class="row mb-4">
        <?php
        $urlimagen ='images/defaultimageproducto.jpg';
        $obj = new Producto();

        $arrayfilters['status_categoria'] = 'Nuevo';
        $queryproductos = $obj->getAllArrStatusCategoria( $arrayfilters );
        // echo   var_dump($queryproductos);
        $prod="";
        $carpetaimg = ASSETS_URL.'/productosimages/images/';
        foreach($queryproductos as $key => $producto){   
            if($producto['imagen']!=''){
                $urlimagen= $carpetaimg.$producto['imagen'];
            }
        ?>
            <div class="col-12 col-md-3 cuadro-producto text-center p-3  " id="">
                <div class="contenedorImg<?php echo $key?> text-center">
                    <img src="<?php echo $urlimagen?>" class="img-provisional">
                    <div id="descripcion<?php echo $key?>" class="contenedorDescripcion">
                        <button class="btn boton-vistarapida" data-toggle="modal"  onclick="buscarproducto(<?php echo $producto['id_producto'] ?>,'<?php echo $producto['nombre'] ?>')" data-target="#ModalVistaRapida">Vista rápida</button>
                    </div>
                </div>
                <div class="desc">
                    <div class="h-nombre">
                        <h5><a href="producto.php"><?php echo $producto['nombre']?></a></h5>
                    </div>
                    <div class="">
                        <span class="money" data-currency-mxn="<?php echo $producto['precio']?>" data-currency="MXN"><?php echo $producto['precio']?></span>
                        <!-- <span class="precio-anterior" data-currency-mxn="<?php echo $producto['precio']?>" data-currency="MXN"><?php echo $producto['precio']?></span> -->
                    </div>
                </div>
            </div>
        <?php }
        ?>
        <div class="col-12 col-md-3 cuadro-producto text-center p-3  " id="">
            <div class="contenedorImg2 text-center">
                <img src="images/cera.jpg" class="img-provisional">
                <div id="descripcion2" class="contenedorDescripcion">
                    <button class="btn boton-vistarapida" data-toggle="modal" data-target="#ModalVistaRapida">Vista rápida</button>
                </div>
            </div>
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="producto.php">Cera</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 40.00" data-currency="MXN">$ 40.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 50.00" data-currency="MXN">$ 50.00</span>
                </div>
            </div>
        </div>
    </div>
    <!-- ../Row 1 productos-->

    <!-- Row 3 Paginador-->
    <div class="row">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
    <!--../ Row 3 Paginador-->
</div>
<!--/productos-->

</div>
<!--Modal vista rápida-->
<!-- Modal -->
<div class="modal fade" id="ModalVistaRapida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vr" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ml-auto sombra-texto-rosa" id="ModalVistaRapidatitle">Rimel Exactitud</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="contentpopup" class="printMe">

                </div>
            </div>
        </div>
    </div>
</div>
<!--../Modal vista rápida-->
<?php
include('footer.php');
?>
<script>
    function buscarproducto(id_producto,title){
            console.log(id_producto);
            $.get(config.base+"/Productos/ajax/?action=get&object=showinfoproducto&id="+id_producto, null, function (response) {
                    if ( response ){
                        $("#ModalVistaRapidatitle").html(title);
                        $("#contentpopup").html(response);
                        
                    }else{
                        return notify('error', 'Error al obtener los datos');
                        
                    }     
            });
            return false;
        }
    $(document).ready(function() {
        
        <?php
            foreach($queryproductos as $key => $producto){    
            ?>
            $(".contenedorImg<?php echo $key?>").hover(
                function() {
                    $("#descripcion<?php echo $key?>").addClass("visible muestraDescripcion");
                },
                function() {

                    $("#descripcion<?php echo $key?>").removeClass("muestraDescripcion");
                    setTimeout(
                        function() {
                            $("#descripcion<?php echo $key?>").removeClass("visible muestraDescripcion");
                            $("#descripcion<?php echo $key?>").addClass("hidden");
                        }, 300);
                }
            );
            <?php
            }    
        ?>

//2
    });
</script>