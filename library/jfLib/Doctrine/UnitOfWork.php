<?php

class jfLib_Doctrine_UnitOfWork {

    //http://www.doctrine-project.org/projects/orm/1.2/docs/cookbook/creating-a-unit-of-work-using-doctrine/en
    /**
     * Collection of models to be persisted
     *
     * @var array Doctrine_Record
     */
    protected $_createOrUpdateCollection = array();
    /**
     * Collection of models to be persisted
     *
     * @var array Doctrine_Record
     */
    protected $_deleteCollection = array();
    /**
     * Collection of insterted Ids
     *
     * @var array String
     */
    protected $last_inserted_id = array();

    /**
     * Add a model object to the create collection
     *
     * @param Doctrine_Record $model
     */
    public function registerModelForCreateOrUpdate($model) {
        // code to check to see if the model exists already
        if ($this->_existsInCollections($model)) {
            throw new Exception('model already in another collection for this transaction');
        }

        // no? add it
        $this->_createOrUpdateCollection[] = $model;
    }

    /**
     * Add a model object to the delete collection
     *
     * @param Doctrine_Record $model
     */
    public function registerModelForDelete($model) {
        // code to check to see if the model exists already
        if ($this->_existsInCollections($model)) {
            throw new Exception('model already in another collection for this transaction');
        }

        // no? add it
        $this->_deleteCollection[] = $model;
    }

    /**
     * Clear the Unit of Work
     */
    public function ClearAll() {
        $this->_deleteCollection = array();
        $this->_createOrUpdateCollection = array();
    }

    /**
     * Perform a Commit and clear the Unit Of Work. Throw an Exception if it fails and roll back.
     */
    public function commitAll() {
        $conn = Doctrine_Manager::connection();

        try {
            $conn->beginTransaction();

            $this->_performCreatesOrUpdates($conn);
            $this->_performDeletes($conn);

            $conn->commit();
        } catch (Doctrine_Exception $e) {
            $conn->rollback();
            throw new Exception("Error al crear el objeto: " . $e->errorMessage(), 101);
        }

        $this->clearAll();
    }

    protected function _performCreatesOrUpdates($conn) {
        foreach ($this->_createOrUpdateCollection as $model) {
            $model->save($conn);
            if ($model->getIncremented()) {
                $this->last_inserted_id[$model->getTable()->getComponentName()] = $model->getIncremented();
            }
        }
    }

    protected function _performDeletes($conn) {
        foreach ($this->_deleteCollection as $model) {
            $model->delete($conn);
        }
    }

    protected function _existsInCollections($model) {
        foreach ($this->_createOrUpdateCollection as $m) {
            if ($model->getOid() == $m->getOid()) {
                return true;
            }
        }

        foreach ($this->_deleteCollection as $m) {
            if ($model->getOid() == $m->getOid()) {
                return true;
            }
        }

        return false;
    }

    public function getTransaction() {
        return $this->last_inserted_id;
    }

}

?>
