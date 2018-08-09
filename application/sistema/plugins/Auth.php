<?php

/**
 * Checa la autenticación cada ves que la applicación corre
 *
 * @author Dinkbit
 *
 */
class Sistema_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{

    /**
     * Lista de páginas accesibles sin autenticación
     *
     * Modulo => Controlladores => Acciones
     *
     * @var array
     */
    private $_pubic =
        array(
            "ventas" => array(
                "administrar" => array("imprimir", "ver"),
                "factura" => array("renderfactura")
            ),
            "default" => array(
                "error" => array("error")
            ),
            "api" => array(
                "direccion" => array("getInfoByZipcode.json")
            ),
            "administracion"=>array(
                "productos"=>array(
                    "excelproductocosto"
                )
            )
        );
    /**
     * @var array Lista de páginas accesibles en modo offline
     */
    private $_offline =
        array(
            "default" => array(
                "error" => array("error"),
                "offline" => array("index")
            )
        );
    private $loginModule = 'login';
    private $loginController = 'index';
    private $loginAction = 'index';
    private $offlineModule = 'default';
    private $offlineController = 'offline';
    private $offlineAction = 'index';
    /**
     * Cambio de modo
     * 0 -> Online
     * 1 -> Offline
     *
     * @var BOOL
     */
    private $_modo = 0;

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $auth = Zend_Auth::getInstance();

        //offline
        if ($this->_modo == 1) {
            // No autenticado
            // - redirecciona al controlador solicitado en caso de que este sea publico.
            if (!$auth->hasIdentity()) {
                if ($this->_actionExists($request)) {
                    if (!$this->_canAccess($request, $this->_offline)) {
                        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                        $redirector->gotoSimpleAndExit($this->offlineAction, $this->offlineController, $this->offlineModule);
                    }
                }
            }

            // Autenticado
            if ($auth->hasIdentity()) {
                // Is logged in
                // Let's check the credential
                $identity = $auth->getIdentity();

                if ($this->_confirmUserID($identity) != 0) {
                    /* Variables are incorrect, user not logged in */
                    $auth->clearIdentity();
                    $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                    $redirector->gotoSimpleAndExit($this->loginAction, $this->loginController, $this->loginModule);
                    return false;
                }

                if (!$this->_canAccess($request, $this->_offline)) {
                    $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                    $redirector->gotoSimpleAndExit($this->offlineAction, $this->offlineController, $this->offlineModule);
                }
            }

            //online
        } else {
            // No autenticado
            // - redirecciona al controlador solicitado en caso de que este sea publico.
            if (!$auth->hasIdentity()) {
                if ($this->_actionExists($request)) {
                    if (!$this->_canAccess($request, $this->_pubic)) {
                        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                        $redirector->gotoSimpleAndExit($this->loginAction, $this->loginController, $this->loginModule);
                    }
                }
            }

            // User is logged in or on login page.
            if ($auth->hasIdentity()) {
                // Is logged in
                // Let's check the credential
                $identity = $auth->getIdentity();
                if ($this->_confirmUserID($identity) != 0) {
                    /* Variables are incorrect, user not logged in */
                    $auth->clearIdentity();
                    $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                    $redirector->gotoSimpleAndExit($this->loginAction, $this->loginController, $this->loginModule);
                    return false;
                }
            }
        }
    }


    /**
     * @param int $uid
     * @param varchar $sessionid
     * @return number Si ya esta logeado en otro lado o no
     */
    protected function _confirmUserID($identity)
    {

        $q = Doctrine_Query::create()->from('Database_Model_Usuario')
            ->where('id_usuario = ?', $identity->id_usuario)->andWhere('session_id = ?', $identity->session_id);

        $result = $q->fetchOne();

        if (!$result) {
            return 1; //Indicates username failure
        }
        //Validate that userid is correct
        if ($identity->session_id == $result->session_id) {
            return 0; //Success! Username and userid confirmed
        } else {
            return 2; //Indicates userid invalid
        }
    }

    /**
     * @param Zend_Controller_Request_Abstract $request Request to check
     * @param array $mode arrary de reglas estado de app
     * @return boolean Si tiene acceso o no
     */
    private function _canAccess($request, $mode)
    {
        if ($request->getModuleName() != $this->loginModule || $request->getControllerName() != $this->loginController || $request->getActionName() != $this->loginAction) {
            if (array_key_exists($request->getModuleName(), $mode)) {
                $controllers = $mode[$request->getModuleName()];
                if (array_key_exists($request->getControllerName(), $controllers)) {
                    $actions = $mode[$request->getModuleName()][$request->getControllerName()];
                    if (!in_array($request->getActionName(), $actions)) {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        return true;
    }

    /**
     * Revisa si (module-controller-action) exists
     *
     * @param Zend_Controller_Request_Abstract $request Request to check
     * @return boolean Whether the action exists
     */
    private function _actionExists(Zend_Controller_Request_Abstract $request)
    {
        $dispatcher = Zend_Controller_Front::getInstance()->getDispatcher();

        // Checamos el Controlador
        if (!$dispatcher->isDispatchable($request)) {
            return false;
        }

        // Checamos la action
        $controllerClassName = $dispatcher->formatControllerName($request->getControllerName());
        $controllerClassFile = $controllerClassName . '.php';
        if ($request->getModuleName() != $dispatcher->getDefaultModule()) {
            $controllerClassName = ucfirst($request->getModuleName()) . '_' . $controllerClassName;
        }
        try {
            require_once 'Zend/Loader.php';
            Zend_Loader::loadFile($controllerClassFile, $dispatcher->getControllerDirectory($request->getModuleName()));
            $actionMethodName = $dispatcher->formatActionName($request->getActionName());
            if (@in_array($actionMethodName, get_class_methods($controllerClassName))) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

}