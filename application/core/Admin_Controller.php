<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Load common libraries and helpers
        $this->load->helper('url');
        $this->load->library('session');
    }

    protected function render($view, $data = array())
    {
        // Set default page title
        if (!isset($data['page_title'])) {
            $data['page_title'] = 'Dashboard';
        }

        // Load the view content
        $data['content'] = $this->load->view($view, $data, TRUE);

        // Load the adminlte template
        $this->load->view('templates/adminlte', $data);
    }
}
