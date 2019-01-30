<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_UsuarioController extends jfLib_Controller
{


    function indexAction()
    {
      
        $query = Doctrine_Query::create()
            ->from("Database_Model_Usuario")
            ->where("status='ACTIVO'")
            ;//verificamos si es adminisrador

        $this->view->query = $query->execute();
    }

    function altaAction(){


        if ($this->_request->isPost()) {
            $obj = new Database_Model_Persona();
            $obj->fromArray($this->_request->getPost());

            $query = Doctrine_Query::create()
                ->from("Database_Model_Usuario")
                ->where("id_usuario=?",$this->_request->getPost('id_usuario'))
                ->execute();
            $idusu="";
            foreach($query as $usu){
                $idusu=$usu["id_usuario"];
            }
            if($idusu!=""){
                $this->_informError('Este login ya existe favor de ingresar uno nuevo');
            }else{
                $objusu = new Database_Model_Usuario();
                $objusu->fromArray($this->_request->getPost());
                try {
                    $obj->save();
                    $objusu->save();
                    $this->_informSuccess();
                } catch (Exception $e) {
                    $this->_informError($e);
                }
            }


        }

    }

    function editarAction(){

        $obj = Doctrine_Core::getTable("Database_Model_Usuario")
            ->findOneBy("id_usuario", $this->_request->getParam("id"));
        $this->view->data = $obj->toArray();
        if ($this->_request->isPost()) {
            $obj->fromArray($this->_request->getPost());
            try {
                if($this->_request->getPost("password")){
                    $obj->password=$this->_request->getPost("password");
                }else{
                    $obj->password=$obj->password;
                }
                $obj->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }
    }

    function verAction()
    {
        $obj = Doctrine_Core::getTable("Database_Model_Usuario")
            ->findOneBy("id_usuario", $this->_request->getParam("id"));
        $this->view->data = $obj->toArray();

    }
    function borrarAction(){

        $this->_disableView();
        if($this->_request->getParam("id")){
            $obj = Doctrine_Core::getTable("Database_Model_Usuario")
                ->findOneBy("id_usuario", $this->_request->getParam("id"));
            if($obj){
                try {
                    $obj->status='BAJA';
                    $obj->save();
                    $this->_informSuccess();
                } catch (Exception $e) {
                    $this->_informError($e);
                }
            }



        }


    }


}