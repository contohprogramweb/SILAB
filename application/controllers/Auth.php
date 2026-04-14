<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function login()
    {
        // If already logged in, redirect to dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }

        $data['page_title'] = 'Login';

        if ($this->input->post('login')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Example: Validate user from database
            // $this->load->model('user_model');
            // $user = $this->user_model->validate_login($username, $password);

            // Hardcoded demo login (remove in production)
            if ($username === 'admin' && $password === 'admin123') {
                $session_data = array(
                    'logged_in' => TRUE,
                    'username' => $username,
                    'user_id' => 1
                );

                $this->session->set_userdata($session_data);
                redirect('admin/dashboard');
            } else {
                $data['error'] = 'Username atau password salah!';
            }
        }

        $this->load->view('auth/login_view', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
