<?php

class Profile extends CI_Controller
{
    public function login()
    {
        if ($this->session->has_userdata('email')) {
            redirect('/');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Halaman Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('profile/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_untuklogin();
        }
    }

    private function _untuklogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $where = ['email' => $email];
        $user = $this->model_auth->ambildata($where)->row_array();
        $admin = $this->db->get_where('admin', $where)->row_array();
        //user nya ada
        if ($user) {
            // if ($user['aktif'] == 1) {
            //jika user sudah valid
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email']
                ];
                $this->session->set_userdata($data);
                redirect('/');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Password salah</div>');
                redirect('profile/login');
            }
            // } else {
            //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            //     Email belum aktifasi</div>');
            //     redirect('profile/login');
            // }
        } else if ($admin) {
            if ($password === $admin['password']) {
                $this->session->set_userdata('admin', 'true');
                redirect('admin');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Email belum terdaftar</div>');
            redirect('profile/login');
        }
    }

    public function register()
    {
        if ($this->session->has_userdata('email')) {
            redirect('/');
        }
        $this->form_validation->set_rules('nama', 'Full name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Retype Password', 'required|trim|matches[password]');
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Halaman Daftar';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('profile/register');
            $this->load->view('templates/auth_footer');
        } else {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'gambar' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );
            $this->model_auth->masukdata($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Akun sudah berhasil terdaftar. Silahkan Login</div>');
            redirect('profile/login');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('bayar');
        redirect('/');
    }
    public function edit()
    {
        if (!$this->session->has_userdata('email')) {
            redirect('/');
        }
        $email = $this->session->userdata('email');
        $where = ['email' => $email];
        $data['user'] = $this->model_auth->ambildata($where)->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->view->topbar();
        $this->load->view('profile/edit', $data);
        $this->load->view('templates/footer');
    }
    public function update()
    {
        if (!$this->session->has_userdata('email')) {
            redirect('/');
        }
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $no_tlp = $this->input->post('no_tlp');
        $provinsi = $this->input->post('provinsi');
        $kota = $this->input->post('kota');
        $kodepos = $this->input->post('kodepos');
        $gambar = $_FILES['gambar']['name'];
        if ($gambar) {
            $config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                echo "<script>alert('Data Gagal ditambahkan'); document.location.href='../data_barang'; </script>";
                exit;
            } else {
                $oldgambar = $this->input->post('gambar');
                if ($oldgambar != 'default.jpg') {
                    unlink(FCPATH . 'assets/profile' . $oldgambar);
                }
                $gambar = $this->upload->data('file_name');
                $this->db->set('gambar', $gambar);
            }
        }

        $data = array(
            'nama' => $nama,
            'email' => $email,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kode_pos' => $kodepos,
            'no_tlp' => $no_tlp
        );
        // $this->db->set($data);
        $this->db->where('email', $email);
        // $where = array('id_brg' => $id);
        $this->db->update('user', $data);
        // $this->model_barang->updatebarang($data, $where, TB_BARANG);
        redirect('profile/edit');
    }
}
