<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome Controller
 *
 * Default controller for CodeIgniter application
 */
class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Welcome to CodeIgniter 3.11';
		$data['message'] = 'Your CodeIgniter application is ready to use!';
		
		$this->load->view('welcome_message', $data);
	}
}
