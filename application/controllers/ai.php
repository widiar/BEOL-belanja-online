<?php

class Ai extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->view->topbar();
        $this->load->view('ai/index');
        $this->load->view('templates/footer');
    }

    public function ambil()
    {
        if ($this->session->has_userdata('admin') || !$this->session->has_userdata('email') ) {
            echo "
				<script>
				document.location.href = '". base_url() ."';
				</script>
			";
        }
        $this->load->view('ai/data');
    }

    public function tambah_chat()
    {
       if ($this->session->has_userdata('admin') || !$this->session->has_userdata('email') ) {
            echo "
                <script>
                document.location.href = '". base_url() ."';
                </script>
            ";
        }
        $this->load->view('ai/simpan');
    }

    public function beli_brg()
    {
        if ($this->session->has_userdata('admin') || !$this->session->has_userdata('email') ) {
            echo "
                <script>
                document.location.href = '". base_url() ."';
                </script>
            ";
        }
        $this->load->view('ai/tambah');
    }

    public function bayar()
    {
        if ($this->session->has_userdata('admin') || !$this->session->has_userdata('email') ) {
            echo "
                <script>
                document.location.href = '". base_url() ."';
                </script>
            ";
        }
        $this->load->view('ai/bayar');
    }

    public function cobadeh()
    {
        $this->load->view('ai/bayar');
        // var_dump($this->session->has_userdata('admin'));
    }
}
