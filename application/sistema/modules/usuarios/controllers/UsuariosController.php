<?php

/**
 * @Filename:  UsuariosController.php
 * Location:   modules/sucursales/controllers
 * Function:   Un compendio de funciones relativas a los usuarios
 * @Creator:   Giovanni Alberto García
 * @version:   1.0
 */

/**
 * Esta clase proveerá diversas acciones relativas a los usuarios
 * Function: Diversas funciones referentes a los usuarios
 */
class Usuarios_UsuariosController extends Sistema_Class_Controller
{

    /**
     * La lista de provedores activos
     */
    public function indexAction()
    {
        $pagina = $this->_getParam('pagina') != null ? $this->_getParam('pagina') : 1;
        $resultados = $this->_getParam('resultados') != null ? $this->_getParam('resultados') : 200;

        $pager = new Doctrine_Pager(
            Doctrine_Query::create()
                ->from('Database_Model_Usuario')
                ->where('activo = 1'),
            $pagina,
            $resultados
        );

        $usuarios = $pager->execute();

        // mostrar todo
        if ($resultados == 0) {
            $pager->setMaxPerPage($pager->getNumResults());
            $usuarios = $pager->execute();
        }

        $this->view->pagina = $pagina;
        $this->view->resultados = $resultados;
        $this->view->usuarios = $usuarios;
    }

    /**
     * Este método sirve para agregar un nuevo proveedor
     */
    public function agregarAction()
    {
        $form = new Usuarios_Form_Usuario();
        // Procesar la petición de la forma
        if ($this->getRequest()->isPost()) {
            if (!$form->isValid($_POST)) {
                // Validación fallida, mostrarla con errores
                $this->view->form = $form;
                return $this->render();
            }
            // Sin errores, haz el proveedor y guardalo
            $values = $form->getValues();
            $usuario = new Database_Model_Usuario();
            $usuario->fromArray($values);
            $usuario->password = md5($values['password']);

            try {
                // si algo falla rollback y se borra el proveedor
                $usuario->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }

        } else {
            // Procesar la petición get
            $this->view->form = $form;
        }
    }

    public function editarAction()
    {
        $usuario = Doctrine_Core::getTable("Database_Model_Usuario")->findOneBy("id_usuario", $this->_request->getParam("id"));
        if (!$usuario) {
            $this->_informError(null, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
        }
        $this->view->data = $usuario->toArray();
        // Procesar la petición de la forma
        if ($this->getRequest()->isPost()) {
            $passant=$usuario->password;
            $usuario->fromArray($this->_request->getPost());
            $usuario->password =$passant;
            if($this->_request->getPost('password')){
                $usuario->password = md5($this->_request->getPost('password'));
            }
            if($this->_request->getPost('embarcacion_usuario')){
                $usuario->embarcacion_usuario = $this->_request->getPost('numeroembarcacion_usuario');
            }
            // Sin errores, haz el proveedor y guardalo
           // $values = $form->getValues();
            //$usuario = new Database_Model_Usuario();
           // $usuario->fromArray($values);


            try {

                $numdocumentos =$usuario->embarcacion_usuario;
                $documentosarc=$this->_request->getPost('id_embarcacion');
                $error=0;
                $objde = Doctrine_Query::create()
                    ->from("Database_Model_EmbarcacionUsuario")
                    ->where("id_usuario=?", $usuario->id_usuario);
                foreach($objde->execute() as $del){
                    try {
                            $del->delete();
                    } catch (Exception $e) {
                        $this->_informError($e);
                    }
                }
                for ($key=0;$key<$numdocumentos;$key++){
                    if($documentosarc[$key]) {//kardex
                        $iObjd = Doctrine_Core::getTable("Database_Model_EmbarcacionUsuario")
                            ->create();
                        $iObjd->id_usuario = $usuario->id_usuario;
                        $iObjd->id_embarcacion = $documentosarc[$key];
                        try {
                            $iObjd->save();
                        } catch (Exception $e) {
                           echo $e;
                            exit;
                        }
                    }



                }
                $usuario->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }

        } else {
            // Procesar la petición get
        }
    }
    public function desactivarAction()
    {
        $this->_disableAllLayouts();
        $usuario = self::dameUsuario();
        $usuario->activo = FALSE;
        $usuario->fecha_baja=date('Y-m-d h:i:s');
        $usuario->fecha_baja=date('Y-m-d h:i:s');
        $usuario->id_usuariobaja=$this->_loggedUser->id_usuario;
        try {
            $usuario->save();
            $this->_informSuccess();
        } catch (Exception $e) {
            $this->_informError($e);
        }
    }

    private function dameUsuario()
    {
        if ($this->_request->getParam('id')) {
            // retrieve param
            $id = $this->_request->getParam('id');
        } else {
            // No param no work
            $this->_informError(null, 'Debes proporcionar un id', true, 'usuarios/usuarios');
        }
        // retrieve the element
        $usuario = Doctrine_Core::getTable('Database_Model_Usuario')->find($id);
        // check if element exists
        if (!$usuario) {
            $this->_informError(null, 'El elemento deseado no existe', true, 'usuario');
        } else {
            return $usuario;
        }
    }

    /**
     * This method is going to show a form to add a sucursal and process it
     */
    public function cambiarcontraseniaAction()
    {
        $form = new Administracion_Form_CambiarContrasenia();
        // Manage the request by form
        if ($this->getRequest()->isPost()) {
            if (!$form->isValid($_POST)) {
                // Failed validation; redisplay form with errors
                $this->view->form = $form;
                return $this->render();
            }
            $values = $form->getValues();

            // Verificar si la vieja contraseña es la correcta
            $old = $values['old_password'];
            $u = Doctrine_Core::getTable('Database_Model_Usuario')->find($this->_loggedUser->id_usuario);
            if ($u->password == md5($old)) {
                $u->password = md5($values['new_password']);
                try {
                    $u->save();
                    $this->_informSuccess('Tu contraseña se cambio con éxito', true, 'administracion/usuarios/cambiarcontrasenia');
                } catch (Exception $e) {
                    $this->_informError($e, null, true, 'administracion/usuarios/cambiarcontrasenia');
                }
            } else {
                $this->_informError(null, 'Contraseña actual inválida', true, 'administracion/usuarios/cambiarcontrasenia');
            }
        } else {
            // Process the get request by browser
            $this->view->form = $form;
        }
    }

    /**
     * Método para editar los permisos a los cuales tendrá acceso el usuario
     * @param id El ID del usuario
     */
    public function editarpermisosAction()
    {
        $usuario = self::dameUsuario();
        $this->view->usuario = $usuario;

        if ($this->_request->isPost()) {
            $transaction = new jfLib_Doctrine_UnitOfWork();
           // $usuario->UsuarioAccion->clear();//borra los registros de la tabla usuarioAction del usuario
            $qryacusu=   Doctrine_Query::create()
                ->from("Database_Model_UsuarioAccion")
                ->where('id_usuario=?',$usuario->id_usuario)
                ->execute();
            foreach ($qryacusu as $foo) {
                try {
                    $foo->delete();
                } catch (Exception $e) {
                    $this->_informError();
                    return;
                }
            }


            foreach ($this->_request->getParam("perm") as $perm) {
                $usuarioAccion = new Database_Model_UsuarioAccion();
                $usuarioAccion->id_accion = $perm;
                $usuarioAccion->id_usuario = $usuario->id_usuario;

                try {
                    $usuarioAccion->save();
                } catch (Exception $e) {
                    echo $e;
                    die();
                }
            }

            $this->_informSuccess();

        }
    }
}

?>