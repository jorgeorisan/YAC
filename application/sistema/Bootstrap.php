<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoload()
    {
        $resourceLoader = new Zend_Application_Module_Autoloader(array(
                                                                      'basePath' => APPLICATION_PATH,
                                                                      'namespace' => 'Sistema',
                                                                      'resources' => array('modules' => array(APPLICATION_PATH . "/modules/"))
                                                                 )
        );

        $resourceLoader->addResourceTypes(array(
                                               'class' => array(
                                                   'path' => 'class',
                                                   'namespace' => 'Class',
                                               )
                                          )
        );

        //REGISTER jfLibrary
        $this->getApplication()->getAutoloader()->registerNamespace("jfLib_");
        $this->getApplication()->getAutoloader()->registerNamespace("Database_");

        return $resourceLoader;
    }

    protected function _initView()
    {
        //Initialize and/or retrieve a ViewRenderer object on demand via the helper broker
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->initView();
        //add the global helper directory path
        $viewRenderer->view->addHelperPath(APPLICATION_PATH . "/helpers/views", $this->_appNamespace . '_View_Helper');
    }

    protected function _initActionHelpers()
    {
        Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH . '/helpers/actions', $this->_appNamespace . '_Action_Helper');
    }

    protected function _initTranslators()
    {
        $translator = new Zend_Translate(
            array(
                 'adapter' => 'array',
                 'content' => APPLICATION_PATH . '/resources/languages',
                 'locale' => 'es',
                 'scan' => Zend_Translate::LOCALE_DIRECTORY
            )
        );
        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }

    protected function _initPlugins()
    {
        $bootstrap = $this->getApplication();
        if ($bootstrap instanceof Zend_Application) {
            $bootstrap = $this;
        }
        $bootstrap->bootstrap('frontController');
        $front = $bootstrap->getResource('frontController');

        $plugin = new Sistema_Plugin_Auth();
        $front->registerPlugin($plugin);
    }

    protected function _initDoctrine()
    {
        $this->getApplication()->getAutoloader()
                ->pushAutoloader(array('Doctrine', 'autoload'));

        $doctrineConfig = $this->getOption('doctrine');
        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(
            Doctrine::ATTR_MODEL_LOADING,
            $doctrineConfig['model_autoloading']
        );

        $manager->setCollate('utf8_unicode_ci');
        $manager->setCharset('utf8');
        //$manager->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_ALL);

        $conn = Doctrine_Manager::connection($doctrineConfig['dsn'], 'doctrine');

        $conn->setCharset('utf8');
        $conn->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, true);

        return $conn;
    }

}