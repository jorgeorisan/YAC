
<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Pedidos Cliente";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
include(SYSTEM_DIR . "/inc/nav.php");
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Clientes","index"));

$obj = new Persona();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Clientes","index"));
}
if(isPost()){
    $obj = new Persona();
    $id = $obj->updateAll($id,getPost());
    if( $id  ) {
         informSuccess(true, informSuccess(true, make_url("Clientes","view",array('id'=>$id))));
    }else{
        informError(true, make_url("Clientes","edit",array('id'=>$id)),"edit");
    }
}

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Clientes"] = APP_URL."/Clientes/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-9 col-md-9 col-lg-9"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-plus"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
                                <form id="main-form" class="" role="form" method=post action="<?php echo make_url("Clientes","edit",array('id'=>$id))?>" onsubmit="return checkSubmit();">     
                                    <div id=""  ng-app='angularRoutingApp' ng-controller='mainController'>
                                        <!-- Aquí inyectamos las vistas -->
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Cont.</th>
                                                    <th>Cantidad</th>
                                                    <th>Descripcion</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="obj in productos track by $index">
                                                    <td>
                                                        {{ $index + 1 }}
                                                    </td>
                                                    <td>
                                                        <input type="number" style="width:70px" name="cantidad[]" class="form-control"
                                                            value="{{obj.cantidad}}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="descripcion[]" class="chosen-select"
                                                            value="{{obj.descripcion}}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" readonly name="status_pedido[]" class="form-control" value="{{obj.status_pedido}}"/>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger btn-xs" ng-click="quitarProducto($index)">
                                                            <i class="glyphicon glyphicon-remove"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>Nuevo</td>
                                                    <td>
                                                        <input type="number" style="width:70px" ng-model="newProducto.cantidad"  class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" ng-model="newProducto.descripcion"  class="form-control">
                                                    </td> 
                                                    <td>
                                                        <select style="width:100%" class="select2 " ng-model="newProducto.status_pedido">
                                                            <?php 
                                                            $listcat= statusPedido();
                                                            if (is_array($listcat)){
                                                                foreach($listcat as $key => $valcat){
                                                                    echo "<option value='".$key."'>".htmlentities($valcat)."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success btn-xs" ng-click="agregarProducto()">
                                                            <i class="glyphicon glyphicon-plus"></i> Agregar
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                <form>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</div>
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
 	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>-->
  	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.7/angular.min.js"></script>
  	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.3/angular-route.js"></script>
  	
<!-- END MAIN PANEL -->


<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
    // include page footer
    include(SYSTEM_DIR . "/inc/footer.php");
    //include required scripts
    include(SYSTEM_DIR . "/inc/scripts.php");
?>
<script >
    function nextFocus(inputF, inputS) {
        document.getElementById(inputF).addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
            document.getElementById(inputS).focus();
            }
        });
    }
    function validateForm()
    {
        var nombre = $("input[name=nombre]").val();
        if ( ! nombre )  return notify("info","El nombre es requerido");
        var telefono = $("input[name=telefono]").val();
        if ( ! telefono )  return notify("info","El telefono es requerido");

        $("#main-form").submit();       
    }
    // Creación del módulo
    var app = angular.module('angularRoutingApp', ['ngRoute']);
    app.controller('mainController', function ($scope, $http) {
    
        $scope.agregarProducto = function () {
            $scope.productos.push($scope.newProducto);
            $scope.newProducto = {
                cantidad: 1,
                descripcion: '',
                status_pedido: 'Solicitado',
                index: 0
            };
        };

        $scope.quitarProducto = function (index) {
            $scope.productos.splice(index, 1);
        };
        $scope.productos = [];
        $scope.newProducto = {
            cantidad: 1,
                descripcion: '',
                status_pedido: 'Solicitado',
                index: 0
        };
    });
    $(document).ready(function() {
    
    /* DO NOT REMOVE : GLOBAL FUNCTIONS!
     * pageSetUp() is needed whenever you load a page.
     * It initializes and checks for all basic elements of the page
     * and makes rendering easier.
     *
     */
     pageSetUp();

    });

</script>
<?php
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>
