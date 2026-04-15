<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper(['url', 'form']);
    }
    
    /**
     * Display list of users
     */
    public function index() {
        $data['title'] = 'Kelola User';
        $data['users'] = $this->User_model->get_all();
        $this->load->view('templates/layout', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Add new user form
     */
    public function add() {
        $data['title'] = 'Tambah User';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username wajib diisi',
                        'is_unique' => 'Username sudah digunakan'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => 'Email wajib diisi',
                        'valid_email' => 'Format email tidak valid',
                        'is_unique' => 'Email sudah digunakan'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password wajib diisi',
                        'min_length' => 'Password minimal 6 karakter'
                    ]
                ],
                'name' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama lengkap wajib diisi'
                    ]
                ],
                'role' => [
                    'label' => 'Role',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role wajib dipilih'
                    ]
                ]
            ]);
            
            if ($this->form_validation->run() === TRUE) {
                $data_user = [
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'name' => $this->input->post('name'),
                    'role' => $this->input->post('role'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $this->User_model->insert($data_user);
                $this->session->set_flashdata('success', 'User berhasil ditambahkan');
                redirect('user');
            }
        }
        
        $data['roles'] = ['admin', 'user', 'manager'];
        $this->load->view('templates/layout', $data);
        $this->load->view('user/add_user', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Edit user form
     * @param int $id
     */
    public function edit($id) {
        $data['title'] = 'Edit User';
        $user = $this->User_model->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan');
            redirect('user');
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules([
                'username' => [
                    'label' => 'Username',
                    'rules' => "required|is_unique[users.username,id,{$id}]",
                    'errors' => [
                        'required' => 'Username wajib diisi',
                        'is_unique' => 'Username sudah digunakan'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => "required|valid_email|is_unique[users.email,id,{$id}]",
                    'errors' => [
                        'required' => 'Email wajib diisi',
                        'valid_email' => 'Format email tidak valid',
                        'is_unique' => 'Email sudah digunakan'
                    ]
                ],
                'name' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama lengkap wajib diisi'
                    ]
                ],
                'role' => [
                    'label' => 'Role',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role wajib dipilih'
                    ]
                ]
            ]);
            
            if ($this->form_validation->run() === TRUE) {
                $data_user = [
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('name'),
                    'role' => $this->input->post('role'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                // Update password if provided
                if ($this->input->post('password')) {
                    $data_user['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }
                
                $this->User_model->update($id, $data_user);
                $this->session->set_flashdata('success', 'User berhasil diupdate');
                redirect('user');
            }
        }
        
        $data['user'] = $user;
        $data['roles'] = ['admin', 'user', 'manager'];
        $this->load->view('templates/layout', $data);
        $this->load->view('user/edit_user', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Delete user
     * @param int $id
     */
    public function delete($id) {
        $user = $this->User_model->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan');
            redirect('user');
        }
        
        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus');
        redirect('user');
    }
}
