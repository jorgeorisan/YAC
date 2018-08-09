<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 20/10/11
 * Time: 10:46
 *
 */

class Facturas_ReportesController extends jfLib_Controller
{
    function init()
    {
        parent::init();


    }

    function _onlyAdmin()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }

    function facturasAction()
    {
        //$this->_onlyAdmin();
        $form = new Facturas_Form_Reporte();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }

        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());
       /* ?>
        <script>
            alert('<?Php echo $this->_loggedUser->id_usuario_tipo;  ?>');
        </script>
<?php
*/
            $query = Doctrine_Query::create()
                ->from("Database_Model_Factura")
                ->where("DATE(fecha_registro) >= '$from'")
                ->andWhere("DATE(fecha_registro) <= '$to'")
                ->orderBy("serie,folio")
               ;



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
        }

        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function excelfacturasAction()
    {
        $this->_disableAllLayouts();

        $filename = "facturas.csv";
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");

//        echo "CLIENTE,FOLIO,SUCURSAL,DESCUENTO,TOTAL,USUARIO,AGENTE,CANTIDAD,PRODUCTO,NUM SERIE,CATEGORIA";
        echo "ID Factura,No Folio,Fecha,Usuario,Tienda,Cliente,Monto Total,IVA,IEPS"," ";
        echo "\n";
        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }

        $query = Doctrine_Query::create()
            ->from("Database_Model_Factura")
            ->where("DATE(fecha_registro) >= '$from'")
            ->andWhere("DATE(fecha_registro) <= '$to'")
            ->orderBy("serie,folio")
        ;



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
        }
        $total=$totaliva=$totalieps=0;
        foreach ($query->execute() as $obj) {

            echo str_replace(",", ";", $obj->id_factura) . ",";
            echo str_replace(",", ";",  $obj->serie."-".$obj->folio) . ",";
            echo str_replace(",", ";", $obj->fecha_registro) . ",";
            echo str_replace(",", ";", $obj->id_usuario) . ",";
            $nomtienda="";
            if($obj->id_usuario){
                $obju = Doctrine_Core::getTable("Database_Model_Usuario")->findOneBy("id_usuario", $obj->id_usuario);
                if($obju){
                    $nomtienda=$obju->Tienda->nombre;
                }
            }
            echo str_replace(",", ";", $nomtienda) . ",";
            echo str_replace(",", ";", $obj->id_persona."|".$obj->Persona->nombre) . ",";
            echo str_replace(",", ";", number_format($obj->total, 2)) . ",";
            echo str_replace(",", ";", number_format($obj->iva, 2)) . ",";
            echo str_replace(",", ";", number_format($obj->ieps, 2)) . ",";
            echo "\n";
        }
    }

}