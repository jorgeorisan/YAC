<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_TiendasController extends jfLib_Controller
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
            ->from("Database_Model_Tienda")
            ->orderBy("id_tienda ASC");

        if ($q = $this->_request->getParam("q")) {
            $query->where("nombre LIKE '%$q%'");
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

        $form = new Administracion_Form_Tienda();
        $form->populate($this->_request->getParams());

        if ($this->_request->isPost() && $form->isValid($this->_request->getParams())) {

            $transaction = new jfLib_Doctrine_UnitOfWork();

            $obj = new Database_Model_Tienda();

            $obj->fromArray($this->_request->getParams());

            $transaction->registerModelForCreateOrUpdate($obj);

            try {
                $transaction->commitAll();

                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }

        }

        $this->view->form = $form;
    }

    function editarAction()
    {
        $obj = Doctrine_Core::getTable("Database_Model_Tienda")->findOneBy("id_tienda", $this->_request->getParam("id"));

        if (!$obj) {
            $this->_informError(null, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
        }


        $form = new Administracion_Form_Tienda();

        $form->populate($obj->toArray());

        if ($this->_request->isPost() && $form->isValid($this->_request->getParams())) {

            $transaction = new jfLib_Doctrine_UnitOfWork();

            $obj->fromArray($this->_request->getParams());

            $transaction->registerModelForCreateOrUpdate($obj);

            try {
                $transaction->commitAll();

                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }

        }

        $this->view->form = $form;
    }

    function verAction()
    {

        $this->view->obj = Database_Model_Tienda::getById($this->_request->getParam("id"));
    }

    function borrarAction()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }else{
            $obj = Database_Model_Tienda::getById($this->_request->getParam("id"));

            try {
                $q = Doctrine_Query::create()
                    ->update('Database_Model_Tienda')
                    ->set('status', '?', "BAJA")
                    ->where('id_tienda = ?', $this->_request->getParam("id"));
                $q->execute();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }
    }

}