<?php
ob_start();

error_reporting(E_ALL); ini_set('display_errors', 1);

include('header.php');
include('menu-vertical.php');
?>


<!--productos-->
<div class="col-12 col-md-12 col-lg-9 ">
    <!--Row 1 productos-->
    <div class="row mb-4">
        <div class="col-12 col-md-3 cuadro-producto text-center p-3  " id="">
            <div class="contenedorImg text-center">
                <img src="images/rimel.jpg" class="img-provisional">
                <div class="contenedorDescripcion">
                    <button class="btn boton-vistarapida" data-toggle="modal" data-target="#ModalVistaRapida">Vista rápida</button>
                </div>
            </div>
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="producto.php">Rimel Exactitud</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 40.00" data-currency="MXN">$ 40.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 50.00" data-currency="MXN">$ 50.00</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 cuadro-producto text-center p-3">
            <img src="images/cera.jpg" class="img-provisional">
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="">Cera Española</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 290.00" data-currency="MXN">$ 290.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 440.00" data-currency="MXN">$ 440.00</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 cuadro-producto text-center p-3">
            <img src="images/ramo.jpg" class="img-provisional">
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="">Ramo de Cosméticos</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 290.00" data-currency="MXN">$ 290.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 440.00" data-currency="MXN">$ 440.00</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 cuadro-producto text-center p-3">
            <img src="images/sombras.jpg" class="img-provisional">
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="">Paleta de Sombras Frida</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 290.00" data-currency="MXN">$ 290.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 440.00" data-currency="MXN">$ 440.00</span>
                </div>
            </div>
        </div>
    </div>
    <!-- ../Row 1 productos-->
    <!--Row 2 productos-->
    <div class="row mb-4">
        <div class="col-12 col-md-3 cuadro-producto text-center p-3">
            <img src="images/rimel.jpg" class="img-provisional">
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="">Rimel Exactitud</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 40.00" data-currency="MXN">$ 40.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 50.00" data-currency="MXN">$ 50.00</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 cuadro-producto text-center p-3">
            <img src="images/cera.jpg" class="img-provisional">
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="">Cera Española</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 290.00" data-currency="MXN">$ 290.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 440.00" data-currency="MXN">$ 440.00</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 cuadro-producto text-center p-3">
            <img src="images/ramo.jpg" class="img-provisional">
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="">Ramo de Cosméticos</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 290.00" data-currency="MXN">$ 290.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 440.00" data-currency="MXN">$ 440.00</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 cuadro-producto text-center p-3">
            <img src="images/sombras.jpg" class="img-provisional">
            <div class="desc">
                <div class="h-nombre">
                    <h5><a href="">Paleta de Sombras Frida</a></h5>
                </div>
                <div class="">
                    <span class="money" data-currency-mxn="$ 290.00" data-currency="MXN">$ 290.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 440.00" data-currency="MXN">$ 440.00</span>
                </div>
            </div>
        </div>
    </div>
    <!-- ../Row 2 productos-->
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
                <h4 class="modal-title ml-auto sombra-texto-rosa" id="ModalVistaRapida">Rimel Exactitud</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row precio-vr mb-4">
                    <span class="money" data-currency-mxn="$ 40.00" data-currency="MXN">$ 40.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 50.00" data-currency="MXN">$ 50.00</span>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <img src="images/rimel.jpg" class="img-provisional-vr">
                    </div>
                    <div class="col-12 col-md-5">

                        <div class="row">
                            <p class="parrafo-vr">

                                Pestañas hermosas con el maravilloso
                                rimel marca Diamond, presentaciones:
                                <i>
                                    Henna,Aceite de Aguacate, Fibras Alargadoras,Kejel.
                                </i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row modal-footer">
                    <button type="button" class="btn boton-cerrar-vr" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn boton-vistarapida">Ver más información</button>
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
    $(document).ready(function() {
        $(".contenedorImg").hover(
            function() {

                $(".contenedorDescripcion").addClass("visible muestraDescripcion");
            },
            function() {

                $(".contenedorDescripcion").removeClass("muestraDescripcion");
                setTimeout(
                    function() {
                        $(".contenedorDescripcion").removeClass("visible muestraDescripcion");
                        $(".contenedorDescripcion").addClass("hidden");
                    }, 300);
            }
        );
    });
</script>