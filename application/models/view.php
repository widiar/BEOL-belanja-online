<?php

class View extends CI_Model
{
    public function topbar()
    {
        $akun['user'] = [
            'nama' => 'Sign In',
            'gambar' => 'default.jpg'
        ];
        if ($this->session->has_userdata('admin')) {
            $akun['user'] = [
                'nama' => 'Admin',
                'gambar' => 'default.jpg'
            ];
        } else if ($this->session->has_userdata('email')) {
            $where = ['email' => $this->session->userdata('email')];
            $akun['user'] = $this->model_auth->ambildata($where)->row_array();
        }
        $akun['jml'] = $this->db->get('pesanan')->num_rows();
        $this->load->view('templates/topbar', $akun);
    }
}
