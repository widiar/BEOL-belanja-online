<?php

class Kategori extends CI_Controller
{
	public function handphone()
	{
		$data['barang'] = $this->kategori_model->handphone()->result_array();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->view->topbar();
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}
	public function laptop()
	{
		$data['barang'] = $this->kategori_model->laptop()->result_array();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->view->topbar();
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}
	public function tablet()
	{
		$data['barang'] = $this->kategori_model->tablet()->result_array();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->view->topbar();
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}
}
