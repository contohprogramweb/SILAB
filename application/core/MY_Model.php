<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Model Base Class
 */
class CI_Model {

	public function __construct()
	{
		log_message('info', 'Model Class Initialized');
	}

	public function _ci_get_instance()
	{
		return get_instance();
	}
}
