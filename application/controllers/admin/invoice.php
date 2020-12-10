<?php

class Invoice extends CI_Controller
{
	public function index()
	{
		if (!$this->session->has_userdata('admin')) {
			$this->load->view('templates/header');
			$this->load->view('miss/alert');
			$this->load->view('templates/footer');
		} else {
			$data['barang'] = $this->model_invoice->tampildata()->result_array();
			$this->load->view('templates/header');
			$this->load->view('admin/sidebar');
			$this->view->topbar();
			$this->load->view('admin/invoice', $data);
			$this->load->view('templates/footer');
		}
	}

	public function detail($id)
	{
		if (!$this->session->has_userdata('admin')) {
			$this->load->view('templates/header');
			$this->load->view('miss/alert');
			$this->load->view('templates/footer');
		} else {
			$data['invoice'] = $this->model_invoice->lihatdata($id)->result_array();
			$this->load->view('templates/header');
			$this->load->view('admin/sidebar');
			$this->view->topbar();
			$this->load->view('admin/detail_invoice', $data);
			$this->load->view('templates/footer');
		}
	}
}
