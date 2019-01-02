<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_Clientes2Controller extends jfLib_Controller
{


    function init()
    {
        parent::init();
        $this->view->datauserlogged=$this->_loggedUser;

    }
    function indexAction()
    {
      
        $tipousuario=$this->_loggedUser->id_usuario_tipo;
        $tienda=$this->_loggedUser->id_tienda;

        $query = Doctrine_Query::create()
                ->from("Database_Model_Persona")
                ->where("id_usuario_tipo in(1)")
                ->andWhere("status='ACTIVO'")
                ->orderBy("nombre ASC");
                


       
        $this->view->query = $query->execute();
    }

    function altaAction(){
        $tipousu=$this->_loggedUser->id_usuario_tipo;
        $tienda=$this->_loggedUser->id_tienda;
        $this->view->tipousu = $tipousu;

        if ($this->_request->isPost()) {
            $obj = new Database_Model_Persona();
            $obj->fromArray($this->_request->getPost());
            switch ($tipousu) {
                case 2:////si es administrador
                    if($this->_request->getPost('id_usuario_tipo')==1){//si el tipo de usuario a dar de alta es cliente
                        try {
                            $obj->id_tienda=$tienda;
                            $obj->save();
                            $this->_informSuccess();
                        } catch (Exception $e) {
                            $this->_informError($e);
                        }
                    }else{
                        $query = Doctrine_Query::create()
                            ->from("Database_Model_Usuario")
                            ->where("id_usuario=?",$this->_request->getPost('id_usuario'))
                            ->execute();
                        $idusu="";
                        foreach($query as $usu){
                            $idusu=$usu["id_usuario"];
                        }
                        if($idusu!=""){
                            echo "<script>alert('Este login ya existe favor de ingresar uno nuevo');</script>";
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
                    break;
                default://si no es administador
                    try {
                        $obj->id_tienda=$tienda;
                        $obj->save();
                        $this->_informSuccess();
                    } catch (Exception $e) {
                        $this->_informError($e);
                    }
            }
        }

    }

    function editarAction(){
        $query = Doctrine_Query::create()
            ->from("Database_Model_Persona")
            ->where("id_usuario=",$this->_loggedUser->id_usuario);

        /*if($this->_loggedUser->id_usuario == "789.mx")
        {
*/
            $query = Doctrine_Query::create()
                ->from("Database_Model_Persona")
                ->where("id_persona=?",$this->_request->getParam("id"));
                $ejec=$query->fetchOne();

            $this->view->data = $ejec;
            $obj = Database_Model_Persona::getById($this->_request->getParam("id"));
            if ($this->_request->isPost() ) {
                $obj->fromArray($this->_request->getParams());
                try {
                    $obj->save();
                    $this->_informSuccess();
                } catch (Exception $e) {
                    $this->_informError($e);
                }

            }
     /*   }else{
        $this->_informError(null,"No cuenta con los permisos para acceder a esta sección. Favor de comunicarse con su administrador.");
        $this->_disableView();
        }
     */
    }

    function verAction()
    {
        $query = Doctrine_Query::create()
            ->from("Database_Model_Persona")
            ->where("id_persona=?",$this->_request->getParam("id"));
        $ejec=$query->fetchOne();

        $this->view->data = $ejec;

    }

    function borrarAction(){

        $this->_disableView();
        if($this->_request->getParam("id")){
            $obj = Doctrine_Core::getTable("Database_Model_Persona")
                ->findOneBy("id_persona", $this->_request->getParam("id"));
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