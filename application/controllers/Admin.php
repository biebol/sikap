<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pangkat_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }
    public function pangkat()
    {
    $data['title'] = 'Tambah Pangkat';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $this->form_validation->set_rules('nama_pangkat', 'Nama Pangkat', 'required');
    $this->form_validation->set_rules('singkatan', 'Singkatan', 'required');
    $data['pangkat'] = $this->db->get('pangkat')->result_array();

    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pangkat', $data);
        $this->load->view('templates/footer');
    } else {
        $nama_pangkat = $this->input->post('nama_pangkat');
        $singkatan = $this->input->post('singkatan');
        $created_at = date('Y-m-d H:i:s');
       
    $this->db->where('nama_pangkat', $nama_pangkat);
        $query = $this->db->get('pangkat');
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nama Pangkat sudah ada!</div>');
            redirect('admin/pangkat');
        }
        $data = array(
            'nama_pangkat' => $nama_pangkat,
            'singkatan' => $singkatan,
            'created_at' => $created_at
        );

        $this->db->insert('pangkat', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pangkat Sudah Update</div>');
        redirect('admin/pangkat');
    }
    }

    public function updatePangkat($pangkat_id) {
        $nama_pangkat = $this->input->post('nama_pangkat');
        $singkatan = $this->input->post('singkatan');
    
        // Panggil model untuk memperbarui data pangkat di database
        $this->Pangkat_model->updatePangkat($pangkat_id, $nama_pangkat, $singkatan);
    
        $this->session->set_flashdata('message', 'Data pangkat berhasil diperbarui.');
        redirect('admin/pangkat');
    }
    public function deletePangkat($pangkat_id)  
    {
        
    // Panggil model untuk menghapus data pangkat dari database
    $this->Pangkat_model->deletePangkat($pangkat_id);

    $this->session->set_flashdata('message', 'Data pangkat berhasil dihapus.');
    redirect('admin/pangkat');
    }
}
