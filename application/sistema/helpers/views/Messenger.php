<?php
/** 
 * @author Joe
 * 
 * 
 */
class Sistema_View_Helper_Messenger extends Zend_View_Helper_Abstract {
	//TODO - Insert your code here
    protected $_messageKeys = array(
            'msg_message',
            'error',
            'info',
            'success',
            'warning',
        );

        public function messenger()
        {
            foreach($this->_messageKeys as $messageKey) {
                if($messages = $this->_getMessages($messageKey)) {
                    echo $this->_renderMessage($messages,$messageKey);
                }
            }
        }

        protected function _getMessages($messageKey)
        {
            $result = array();
            $flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
            $flashMessenger->setNamespace($messageKey);

            if($flashMessenger->hasMessages()) {
                $result = $flashMessenger->getMessages();
            }

            // check view object
            if(isset($this->view->$messageKey)) {
                array_push($result, $this->view->$messageKey);
            }

            //add any messages from this request
            if ($flashMessenger->hasCurrentMessages()) {
                 $result = array_merge($result,
                      $flashMessenger->getCurrentMessages()
                 );
                 //we don’t need to display them twice.
                 $flashMessenger->clearCurrentMessages();
            }
             return $result;
        }

        protected function _renderMessage($message, $name)
        {
            if(!is_array($message)) {
                $message = array($message);
            }
            if($name==="success"){
                $name="done";
            }
            $messageElement="<p class='msg ".$name."'>";
            if($name=="success"){
                $messageElement.= "<strong>¡Listo!</strong>";
            }else if($name=="error"){
                $messageElement.= "<strong>¡Error!</strong>";
            }else if($name=="warning"){
                $messageElement.= "<strong>¡Atención!</strong>";
            }else if($name=="info"){
                $messageElement.= "<strong>Información</strong>";
            }
            $messageElement.=" <span>".$message[0]."</span></p>";
            return $messageElement;
            //return $this->view->htmlList($message, false, array('class'=>$name), true);
        }


}

?>