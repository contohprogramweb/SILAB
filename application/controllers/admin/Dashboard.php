<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'page_title' => 'Dashboard',
            'total_users' => 0,
            'total_products' => 0
        );

        // Example: Load data from database
        // $this->load->model('user_model');
        // $data['total_users'] = $this->user_model->count_all();

        $this->render('admin/dashboard_view', $data);
    }
}
