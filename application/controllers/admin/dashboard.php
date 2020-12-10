<?php

class Dashboard extends CI_Controller
{
	public function index()
	{
		if ($this->session->has_userdata('admin')) {
			$this->load->view('templates/header');
			$this->load->view('admin/sidebar');
			$this->view->topbar();
			$this->load->view('admin/dashboard');
			$this->load->view('templates/footer');
		} else {
			$this->load->view('templates/header');
			$this->load->view('miss/alert');
			$this->load->view('templates/footer');
		}
	}
}
