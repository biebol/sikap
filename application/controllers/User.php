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
        $data['name'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();


        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('pangkat_lama', 'Pangkat Lama', 'required');
        $this->form_validation->set_rules('pangkat_baru', 'Pangkat Baru', 'required');
        $this->form_validation->set_rules('jenis_kenaikan', 'Jenis Kenaikan Pangkat', 'required');
        
        if ($this->form_validation->run() == false) 
        {
            $this->load->model('Pangkat_model'); // Load model Pangkat_model
            $data['pangkat_lama'] = $this->Pangkat_model->getPangkatOptions(); // Ambil opsi pangkat lama dari model
            $data['pangkat_baru'] = $this->Pangkat_model->getPangkatOptions(); // Ambil opsi pangkat baru dari model
            
            $user_id = $this->session->userdata('id');
            $data['user_id'] = $this->db->get_where('user', ['id' => $this->session->userdata('user_id')])->row_array();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/usulkp_form', $data);
            $this->load->view('templates/footer');
        } 
        else 
        {
            $nip = $this->input->post('nip');
            $nama = $this->input->post('name');
            $user_id= $data['user']['id'];
            $jabatan = $this->input->post('jabatan');
            $pangkat_lama = $this->input->post('pangkat_lama');
            $pangkat_baru = $this->input->post('pangkat_baru');
            $jenis_kenaikan = $this->input->post('jenis_kenaikan');
            $created_at = date('Y-m-d H:i:s');
    

            // Simpan data ke dalam tabel usulkp
            $usulkp1_data =array(
            
                'nip' => $nip,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'user_id' => $user_id,
                'pangkat_lama_id' => $pangkat_lama,
                'pangkat_baru_id' => $pangkat_baru,
                'jenis_kenaikan' => $jenis_kenaikan,
                'created_at' => $created_at
            );

            $this->db->insert('kp_t', $usulkp1_data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data usulan KP telah disimpan!</div>');
            redirect('user/usulkp_form');
        }
    }
 //untuk form Kenaikan Pangkat Regurel
public function usulkp()
    {
        $data['title'] = 'Dokumen Kenaikan Pangkat Reguler';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('jenis_kenaikan', 'Jenis Kenaikan Pangkat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->model('Usulkp_model'); // Load model Pangkat_model
            $data['jenis_kenaikan'] = $this->Usulkp_model->getjeniskenaikan(); 
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/usulkp', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $user_id = $data['user']['id'];

            //validasi untuk proses jika ada user yang sudah upload makan di berikan notice
        $usulkp_check = $this->db->get_where('usulkp', ['user_id' => $user_id])->row_array();
            if ($usulkp_check) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">File-file sudah diunggah sebelumnya.</div>');
                redirect('user/usulkp');
            }

            // Validasi dan proses upload file
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2048; // 2MB

            $this->load->library('upload', $config);

            $file_upload_names = ['KepPangkatTerakhir', 'KepJabatanTerakhir', 'IjazahDikumti', 'IjazahUjianDinas', 'Algol', 'SKP2ThnTerakhir'];
            echo "Path unggahan: ";

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

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">File Kenaikan Pangkat Reguler Sudah Terupload!</div>');
            redirect('user/usulkp');
        }
    }
public function usulkp_f()
    {
        //untuk Menampilkan kolom user dan email
        $data['title'] = 'Dokumen Kenaikan Pangkat Fungsional';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('jenis_kenaikan', 'Jenis Kenaikan Pangkat', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->model('Usulkp_model'); // Load model Pangkat_model
            $data['jenis_kenaikan'] = $this->Usulkp_model->getjeniskenaikan(); // Ambil opsi pangkat lama dari model
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/usulkp_f', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $user_id = $data['user']['id'];
            $kp_id =$this->input->post('kp_id');

            
        $usulkp_check = $this->db->get_where('usulkp_f', ['user_id' => $user_id])->row_array();
            if ($usulkp_check) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">File-file Sudah Diunggah Sebelumnya.</div>');
                redirect('user/usulkp_f');
            }
           //tempat menyimpan file yang di upload
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2048; // 2MB

            $this->load->library('upload', $config);

            $file_upload_names = ['KepPangkatTerakhir', 'KepJabatanTerakhir', 'IjazahDikumti', 'PAK', 'SKP2ThnTerakhir'];
            
            foreach ($file_upload_names as $file_name) {
                if (!$this->upload->do_upload($file_name)) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                    redirect('user/usulkp_f');
                } else {
                    $file_paths[$file_name] = $this->upload->data('file_path');
                }
            }

            // Simpan data ke tabel usulkp
              $usulkp_f_data = [
                'user_id' => $user_id,
                'KepPangkatTerakhir' => $file_paths['KepPangkatTerakhir'],
                'KepJabatanTerakhir' => $file_paths['KepJabatanTerakhir'],
                'IjazahDikumti' => $file_paths['IjazahDikumti'],
                'kp_id' => $kp_id,
                'Algol' => null,
                'PAK' => $file_paths['PAK'],
                'SKP2ThnTerakhir' => $file_paths['SKP2ThnTerakhir'],
            ];
            $this->db->insert('usulkp', $usulkp_f_data);

            // Update data ke tabel user
            $this->db->set('name', $name);
            $this->db->where('id', $user_id);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">File Kenaikan Pangkat Reguler Sudah Terupload!</div>');
            redirect('user/usulkp_f');
        }
    }
    
public function usulkp_s()
{
    //untuk Menampilkan kolom user dan email
    $data['title'] = 'Dokumen Kenaikan Pangkat Struktural';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
    $this->form_validation->set_rules('jenis_kenaikan', 'Jenis Kenaikan Pangkat', 'required');


    if ($this->form_validation->run() == false) {
        $this->load->model('Usulkp_model'); // Load model Pangkat_model
        $data['jenis_kenaikan'] = $this->Usulkp_model->getjeniskenaikan(); // Ambil opsi pangkat lama dari model
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/usulkp_s', $data);
        $this->load->view('templates/footer');
    } else {
        $name = $this->input->post('name');
        $user_id = $data['user']['id'];
        $kp_id =$this->input->post('kp_id');

        
    $usulkp_check = $this->db->get_where('usulkp_s', ['user_id' => $user_id])->row_array();
        if ($usulkp_check) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">File-file Sudah Diunggah Sebelumnya.</div>');
            redirect('user/usulkp_s');
        }
       //tempat menyimpan file yang di upload
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048; // 2MB

        $this->load->library('upload', $config);

        $file_upload_names = ['KepPangkatTerakhir', 'KepJabatanTerakhir', 'IjazahDikumti', 'IjasahPim', 'SKP2ThnTerakhir'];
        
        foreach ($file_upload_names as $file_name) {
            if (!$this->upload->do_upload($file_name)) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                redirect('user/usulkp_s');
            } else {
                $file_paths[$file_name] = $this->upload->data('file_path');
            }
        }

        // Simpan data ke tabel usulkp
          $usulkp_s_data = [
            'user_id' => $user_id,
            'KepPangkatTerakhir' => $file_paths['KepPangkatTerakhir'],
            'KepJabatanTerakhir' => $file_paths['KepJabatanTerakhir'],
            'IjazahDikumti' => $file_paths['IjazahDikumti'],
            'kp_id' => $kp_id,
            'Algol' => null,
            'IjasahPim' => $file_paths['IjasahPim'],
            'SKP2ThnTerakhir' => $file_paths['SKP2ThnTerakhir'],
        ];
        $this->db->insert('usulkp', $usulkp_s_data);

        // Update data ke tabel user
        $this->db->set('name', $name);
        $this->db->where('id', $user_id);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">File Kenaikan Pangkat Reguler Sudah Terupload!</div>');
        redirect('user/usulkp_s');
        }
    }

}
