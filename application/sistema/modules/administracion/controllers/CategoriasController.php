<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_CategoriasController extends jfLib_Controller
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
            ->from("Database_Model_Categoria")
            ->where("status='ACTIVO'");

        if ($q = $this->_request->getParam("q")) {
            $query->where("id_categoria LIKE '%$q%'");
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

        $form = new Administracion_Form_Categoria();
        $form->populate($this->_request->getParams());

        if ($this->_request->isPost() && $form->isValid($this->_request->getParams())) {

            $transaction = new jfLib_Doctrine_UnitOfWork();

            $obj = new Database_Model_Categoria();

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
        $obj = Doctrine_Core::getTable("Database_Model_Categoria")->findOneBy("id_categoria", $this->_request->getParam("id"));

        if (!$obj) {
            $this->_informError(null, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
        }


        $form = new Administracion_Form_Categoria();

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

        $this->view->obj = Database_Model_Categoria::getById($this->_request->getParam("id"));
    }

    function borrarAction()
    {

        $obj = Database_Model_Categoria::getById($this->_request->getParam("id"));

        try {
            $obj->status='BAJA';
            $obj->save();
            $this->_informSuccess();
        } catch (Exception $e) {
            $this->_informError($e);
        }
    }

}