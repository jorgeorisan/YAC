</div>
<footer>
  <div class="col-12 foot p-5 ">
    <div class="row mb-3">
      <div class="col-12 col-md-5 mb-5">
        <h5 class="h-foot mb-3">Tienda</h5>
        <a class="span-foot a-link" target="_blank" href="https://goo.gl/maps/ETLWMFhGDuGwYTB88">
          <label class="h-foot"><i class="fas fa-map-marked-alt i-foot"></i>Sucursal Principal:</label> <br> Degollado Oriente #73, C.P. 61506. Heroica Zitácuaro, Michoacán De Ocampo, México.
        </a>
        <br>
        <span class="h-foot"><i class="fas fa-mobile-alt i-foot"></i>Teléfono: <a class="a-foot" href="tel:7151108800"> (715)-110-88-00</a></span> <br>
        <span class="h-foot"><i class="fas fa-envelope i-foot"></i>E-mail: <a class="a-foot" href="mailto:yoamocompraroficial@gmail.com"> yoamocompraroficial@gmail.com</a></span>

      </div>

      <div class="col-12 col-md-4 mb-5">
        <h5 class="h-foot mb-3">Servicio al cliente</h5>
        <span>
          <span class="h-foot"> <i class="fas fa-store-alt i-foot"></i> </span><a class="a-link" href="quienes-somos.php">Quiénes somos</a>
        </span><br>
        <span>
          <span class="h-foot"> <i class="fas fa-question i-foot"></i> </span><a class="a-link" href="preguntas-frecuentes.php">Preguntas frecuentes</a>
        </span><br>
        <span>
          <span class="h-foot"> <i class="fas fa-hand-holding-usd i-foot"></i> </span><a class="a-link" href="ventas-mayoreo.php">Ventas por mayoreo</a>
        </span><br>
        <span>
          <span class="h-foot"> <i class="far fa-file-alt i-foot"></i> </span><a class="a-link" href="terminos-y-condiciones.php">Términos y condiciones</a>
        </span><br>
      </div>
      <div class="col-12 col-md-3  mb-5">
        <h5 class="h-foot mb-5">Nuestras redes sociales</h5>
        <!-- partial:index.partial.html -->
        <div class="social row">
          <a href="https://www.facebook.com/pg/YoAmoComprarOficial" class="link facebook" target="_blank"><span class="fab fa-facebook"></span></a>
          <a href="https://instagram.com/yoamocomprar_oficial?igshid=cd2u832fbpye" class="link instagram" target="_blank"><span class="fab fa-instagram"></span></a>
          <a href="https://www.youtube.com" class="link youtube" target="_blank"><span class="fab fa-youtube"></span></a>
        </div>
        <!-- partial -->
      </div>
    </div>
  </div>
  <div class="derechos p-2 text-center">
    <span>© YO AMO COMPRAR / Todos los derechos reservados.</span>
  </div>
</footer>

</body>
<script src="js/jquery-1.11.1.min.js"></script>
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>-->
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->

<script src="js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

<script type="text/javascript">
 var config = {
    base: $('#base').val()
  };
  (function($) {
   
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
      }
      var $subMenu = $(this).next(".dropdown-menu");
      $subMenu.toggleClass('show');

      $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass("show");
      });

      return false;
    });
   
  })(jQuery)
  
</script>

</html>