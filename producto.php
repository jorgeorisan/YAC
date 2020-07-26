<?php
include('header.php');
include('menu-vertical.php');
?>
<!-- visor de imágenes producto-->
<link rel='stylesheet' href='css/xzoom.css'>
<link rel="stylesheet" href="css/visor.css">
<!-- /vidor de imágenes producto-->

<!--detalles del producto-->
<div class="col-12 col-md-12 col-lg-9 text-center mb-4">
    <h4 class=" mb-4 sombra-texto-rosa">Rimel Exactitud</h4>
    <!--visor de imágenes-->

    <section id="default" class="padding-top0">
        <div class="row">

            <div class="col-11 col-md-8  col-lg-7">
                <div class="">
                    <img class="xzoom mb-4" id="xzoom-default" src="images/imagen1.jpg" xoriginal="images/imagen1.1.jpg" />
                    <div class="xzoom-thumbs">
                        <a href="images/imagen1.1.jpg"><img class="xzoom-gallery" width="80" src="images/imagen1.jpg" xpreview="images/imagen1.jpg" title="Con extracto de mamey, para pestañas más fuertes!"></a>

                        <a href="images/imagen2.1.jpg"><img class="xzoom-gallery" width="80" src="images/imagen2.jpg" title="images/imagen2.jpg"></a>

                        <a href="images/imagen3.1.jpg"><img class="xzoom-gallery" width="80" src="images/imagen3.jpg" title="images/imagen3.jpg"></a>

                        <a href="images/imagen4.1.jpg"><img class="xzoom-gallery" width="80" src="images/imagen4.jpg" title="images/imagen4.jpg"></a>
                    </div>
                </div>
            </div>
            <div class="col-11 col-md-4 col-lg-5">
                <h5 class="texto-rosa">Descripción del producto:</h5>
                <p class="text-justify">
                    Esta máscara te ayudará a tener unas pestañas más definidas
                    y voluminosas con un aspecto natural para el diario.
                    Es a prueba de agua, elige la que más te gusta!
                    Tiene 4 presentaciones.
                </p>
                <div class="mb-3">
                    <span class="money" data-currency-mxn="$ 40.00" data-currency="MXN">$ 40.00</span>
                    <span class="precio-anterior" data-currency-mxn="$ 50.00" data-currency="MXN">$ 50.00</span>
                </div>
                <div class="mb-1">
                    <span class="disponible">Producto disponible</span> <br>
                    <span class="disponible d-none">Quedan pocas piezas</span><br>
                    <span class="disponible d-none">Producto agotado temporalmente</span>
                </div>
                <div class=" compartir text-right">
                    <a href="" class="acompartir"><i class="fab fa-facebook-f mx-2"></i></a>
                    <a href="" class="acompartir"><i class="fab fa-twitter mx-2"></i></a>
                    <a href="" class="acompartir"><i class="fab fa-whatsapp ml-2"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!--/visor de imágenes-->
</div>
<!--../detalles del producto-->
</div>
</div>
<?php
include('footer.php');
?>
<script src='js/xzoom.min.js'></script>
<script src='js/hammer.min.js'></script>
<script src='js/foundation.min.js'></script>
<script src="js/visor.js"></script>