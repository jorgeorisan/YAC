</div>
<footer>
  <div class="col-12 foot p-4 ">
    <div class="row">
      <div class="col-12 col-md-5 mb-5">
        <h5 class="h-foot mb-3">Tienda</h5>
        <span class="span-foot">
          <label class="h-foot"><i class="fas fa-map-marked-alt i-foot"></i>Sucursal Principal:</label> <br> Degollado Oriente #73, C.P. 61506. Heroica Zitácuaro, Michoacán De Ocampo, México.
        </span>
        <br>
        <span class="h-foot"><i class="fas fa-mobile-alt i-foot"></i>Teléfono: <a class="a-foot" href="tel:7151108800"> (715)-110-88-00</a></span> <br>
        <span class="h-foot"><i class="fas fa-envelope i-foot"></i>E-mail: <a class="a-foot" href="mailto:yoamocompraroficial@gmail.com"> yoamocompraroficial@gmail.com</a></span>

      </div>

      <div class="col-12 col-md-4 mb-5">
        <h5 class="h-foot mb-3">Servicio al cliente</h5>
        <span>
          <span class="h-foot"> <i class="fas fa-store-alt i-foot"></i> </span><a class="a-nos">Quiénes somos</a>
        </span><br>
        <span>
          <span class="h-foot"> <i class="fas fa-question i-foot"></i> </span><a class="a-nos">Preguntas frecuentes</a>
        </span><br>
        <span>
          <span class="h-foot"> <i class="fas fa-hand-holding-usd i-foot"></i> </span><a class="a-nos">Ventas por mayoreo</a>
        </span><br>
        <span>
          <span class="h-foot"> <i class="far fa-file-alt i-foot"></i> </span><a class="a-nos">Términos y condiciones</a>
        </span><br>
      </div>
      <div class="col-12 col-md-3  mb-5">
        <h5 class="h-foot mb-3">Nuestras redes sociales</h5>

      </div>
    </div>
  </div>
</footer>

</body>
<script src="js/jquery-1.11.1.min.js"></script>
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>-->
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->

<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
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