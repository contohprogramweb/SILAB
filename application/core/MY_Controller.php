<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Application Controller
 *
 * This class is the base controller for all controllers in the application.
 */
class CI_Controller {

	static $instance;

	public function __construct()
	{
		self::$instance =& $this;
		
		// Load base classes
		require_once BASEPATH.'core/Loader.php';
		require_once BASEPATH.'core/Common.php';
		
		// Initialize loader
		$this->load = new CI_Loader();
		
		// Auto-load packages
		$this->load->_ci_autoloader();
		
		log_message('info', 'Controller Class Initialized');
	}

	public function _ci_get_instance()
	{
		return self::$instance;
	}
}
