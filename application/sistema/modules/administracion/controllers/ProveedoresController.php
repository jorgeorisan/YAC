<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_ProveedoresController extends jfLib_Controller
{


    function indexAction()
    {
        $form = new jfLib_Form_Search();
        $form->populate($this->_request->getParams());
        // Defining initial variables
        if ($this->_request->getParam('p')) {
            $currentPage = $this->_request->getParam('p');
        } else {
            $currentPage = 1;
        }
        $resultsPerPage = 25;
        $url = $this->view->baseUrl($this->_request->getModuleName() . "/" . $this->_request->getControllerName());
        $query = Doctrine_Query::create()
            ->from("Database_Model_Proveedor a")
            ->Where("status = 'ACTIVO'")
            ->orderBy("a.nombre_corto ASC");
        if ($q = $this->_request->getParam("q")) {
            $query->andWhere("a.nombre_corto LIKE '%$q%'")
                ->orWhere("a.id_proveedor LIKE '%$q%'");
        }
        $pagerLayout = new jfLib_Paginator(
            new Doctrine_Pager(
                $query,
                $currentPage,
                $resultsPerPage
            ),
            new Doctrine_Pager_Range_Sliding(array(
                'chunk' => 5
            )),
            $url
        );
        $pagerLayout->setTemplate('<a href="{%url}?p={%page_number}">{%page}</a>');
        $pager = $pagerLayout->getPager();
        $this->view->query = $pager->execute();
        $this->view->paginator = $pagerLayout;
        $this->view->form = $form;
    }


    function altaAction()
    {

        if ($this->_request->isPost()) {
            $obj = new Database_Model_Proveedor();
            $obj->fromArray($this->_request->getPost());
            try {
                $obj->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }
    }

    function editarAction()
    {
        $query = Doctrine_Query::create()
            ->from("Database_Model_Proveedor ")
            ->where("id_proveedor=".$this->_request->getParam("id"));
        $ejec=$query->fetchOne();

        $this->view->data = $ejec;
        if ($this->_request->isPost()) {
            $obj = Doctrine_Core::getTable("Database_Model_Proveedor")->findOneBy("id_proveedor", $this->_request->getParam("id"));
            $obj->fromArray($this->_request->getPost());
            try {
                $obj->save();
                $obj->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }



    }

    function verAction()
    {

        $this->view->obj = Database_Model_Proveedor::getById($this->_request->getParam("id"));
    }

    function borrarAction()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2" || $this->_loggedUser->id_usuario_tipo != "5") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }else{
            $obj = Database_Model_Proveedor::getById($this->_request->getParam("id"));

            try {
                $q = Doctrine_Query::create()
                    ->update('Database_Model_Proveedor')
                    ->set('status', '?', "BAJA")
                    ->where('id_proveedor = ?', $this->_request->getParam("id"));
                $q->execute();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }
    }

}