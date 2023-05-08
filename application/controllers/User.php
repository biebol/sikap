<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
    
    public function usulkp_form()
{
    $data['title'] = 'Form Input Usulan Kenaikan Pangkat';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $this->form_validation->set_rules('nip', 'NIP', 'required');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
    $this->form_validation->set_rules('pangkat_lama', 'Pangkat Lama', 'required');
    $this->form_validation->set_rules('pangkat_baru', 'Pangkat Baru', 'required');
    $this->form_validation->set_rules('jenis_kenaikan', 'Jenis Kenaikan Pangkat', 'required');

    if ($this->form_validation->run() == false) {
        $this->load->model('Pangkat_model'); // Load model Pangkat_model
        $data['pangkat_lama_options'] = $this->Pangkat_model->getPangkatOptions(); // Ambil opsi pangkat lama dari model
        $data['pangkat_baru_options'] = $this->Pangkat_model->getPangkatOptions(); // Ambil opsi pangkat baru dari model

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/usulkp_form', $data);
        $this->load->view('templates/footer');
    } else {
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $pangkat_lama = $this->input->post('pangkat_lama');
        $pangkat_baru = $this->input->post('pangkat_baru');
        $jenis_kenaikan = $this->input->post('jenis_kenaikan');

        // Simpan data ke dalam tabel usulkp
        $usulkp1_data =array(
            'id' => $data['user']['id'],
            'nip' => $nip,
            'nama' => $nama,
            'jabatan' => $jabatan,
            'pangkat_lama' => $pangkat_lama,
            'pangkat_baru' => $pangkat_baru,
            'jenis_kenaikan' => $jenis_kenaikan
        );

        $this->db->insert('kp_t', $usulkp1_data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data usulan KP telah disimpan!</div>');
        redirect('user/usulkp_form');
    }
}
  public function usulkp()
{
    $data['title'] = 'Dokumen Kenaikan Pangkat Reguler';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/usulkp', $data);
        $this->load->view('templates/footer');
    } else {
        $name = $this->input->post('name');

        // Validasi dan proses upload file
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048; // 2MB

        $this->load->library('upload', $config);

        $file_upload_names = ['KepPangkatTerakhir', 'KepJabatanTerakhir', 'IjazahDikumti', 'IjazahUjianDinas', 'Algol', 'SKP2ThnTerakhir'];

        $file_paths = [];

        foreach ($file_upload_names as $file_name) {
            if (!$this->upload->do_upload($file_name)) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                redirect('user/usulkp');
            } else {
                $file_paths[$file_name] = $this->upload->data('file_path');
            }
        }

        // Simpan data ke tabel usulkp
        $usulkp_data = [
            'user_id' => $user_id,
            'KepPangkatTerakhir' => $file_paths['KepPangkatTerakhir'],
            'KepJabatanTerakhir' => $file_paths['KepJabatanTerakhir'],
            'IjazahDikumti' => $file_paths['IjazahDikumti'],
            'IjazahUjianDinas' => $file_paths['IjazahUjianDinas'],
            'Algol' => $file_paths['Algol'],
            'SKP2ThnTerakhir' => $file_paths['SKP2ThnTerakhir'],
        ];

        $this->db->insert('usulkp', $usulkp_data);

        // Update data ke tabel user
        $this->db->set('name', $name);
        $this->db->where('id', $user_id);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
        redirect('user');
    }
}
public function pangkat()
{
    $data['title'] = 'Input Pangkat';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('nama_pangkat', 'Nama Pangkat', 'required');
    $this->form_validation->set_rules('singkatan', 'Singkatan', 'required');

    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pangkat', $data);
        $this->load->view('templates/footer');
    } else {
        $nama_pangkat = $this->input->post('nama_pangkat');
        $singkatan = $this->input->post('singkatan');
        $created_at = date('Y-m-d H:i:s');
       
    $this->db->where('nama_pangkat', $nama_pangkat);
        $query = $this->db->get('pangkat');
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nama Pangkat sudah ada!</div>');
            redirect('user/pangkat');
        }
        $data = array(
            'nama_pangkat' => $nama_pangkat,
            'singkatan' => $singkatan,
            'created_at' => $created_at
        );

        $this->db->insert('pangkat', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pangkat Sudah Update</div>');
        redirect('user/pangkat');
    }
}

}
