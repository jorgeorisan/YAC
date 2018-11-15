<?php

define('CHARSET', 'ISO-8859-1');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

class Sistema_Class_Controller extends jfLib_Controller
{
    protected $_modelPrefix   = 'Sistema_Models_';
    protected $_dbModelPrefix = 'Database_Model_';

    protected $_templatesPath = APPLICATION_PATH . '/layouts/templates/';

    protected $_pacls    = [];
    protected $_cacls    = [];
    protected $_pmodules = [];
    protected $_cmodules = [];

    public function init()
    {
        parent::init();
       

    }
    function conect()
    {
		global $application;
		$doctrine = $application->getOption("doctrine");

		$mysqli = new mysqli($doctrine['host'], $doctrine['user'], $doctrine['password'], $doctrine['dbname']);

		if ($mysqli->connect_error) {
			error_log( 'Error connecting to the database (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
			die('Error connecting to the database.');
		}
		return $mysqli;
	}

   
}