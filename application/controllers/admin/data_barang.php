<?php

class Data_barang extends CI_Controller
{
	public function index()
	{
		if ($this->session->has_userdata('admin')) {
			$data['barang'] = $this->model_barang->getdata()->result_array();
			$this->load->view('templates/header');
			$this->load->view('admin/sidebar');
			$this->view->topbar();
			$this->load->view('admin/data_barang', $data);
			$this->load->view('templates/footer');
		} else {
			$this->load->view('templates/header');
			$this->load->view('miss/alert');
			$this->load->view('templates/footer');
		}
	}
	public function tambahaksi()
	{
		if (!$this->session->has_userdata('admin')) {
			$this->load->view('templates/header');
			$this->load->view('miss/alert');
			$this->load->view('templates/footer');
		} else {
			$nama_brg = $this->input->post('nama_brg');
			$keterangan = $this->input->post('keterangan');
			$kategori = $this->input->post('kategori');
			$harga = $this->input->post('harga');
			$stok = $this->input->post('stok');
			$gambar = $_FILES['gambar']['name'];
			if ($gambar = '') { } else {
				$config['upload_path'] = './assets/images';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					echo "<script>alert('Data Gagal ditambahkan'); document.location.href='../data_barang'; </script>";
					die;
				} else $gambar = $this->upload->data('file_name');
			}

			$data = array(
				'nama_brg' => $nama_brg,
				'keterangan' => $keterangan,
				'kategori' => $kategori,
				'harga' => $harga,
				'stok' => $stok,
				'gambar' => $gambar
			);
			$this->model_barang->tambahdata($data, TB_BARANG);
			redirect('admin/data_barang');
		}
	}

	public function edit($id)
	{
		if (!$this->session->has_userdata('admin')) {
			$this->load->view('templates/header');
			$this->load->view('miss/alert');
			$this->load->view('templates/footer');
		} else {
			$where = array('id_brg' => $id);
			$data['barang'] = $this->model_barang->editbarang($where, TB_BARANG)->result_array();
			$this->load->view('templates/header');
			$this->load->view('admin/sidebar');
			$this->view->topbar();
			$this->load->view('admin/edit_barang', $data);
			$this->load->view('templates/footer');
		}
	}

	public function update()
	{
		if (!$this->session->has_userdata('admin')) {
			$this->load->view('templates/header');
			$this->load->view('miss/alert');
			$this->load->view('templates/footer');
		} else {
			$id = $this->input->post('id_brg');
			$nama_brg = $this->input->post('nama_brg');
			$keterangan = $this->input->post('keterangan');
			$kategori = $this->input->post('kategori');
			$harga = $this->input->post('harga');
			$stok = $this->input->post('stok');
			$gambar = $_FILES['gambar']['name'];
			if ($gambar) {
				$config['upload_path'] = './assets/images';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					echo "<script>alert('Data Gagal ditambahkan'); document.location.href='../data_barang'; </script>";
					exit;
				} else {
					$gambar = $this->upload->data('file_name');
					$this->db->set('gambar', $gambar);
				}
			}

			$data = array(
				'nama_brg' => $nama_brg,
				'keterangan' => $keterangan,
				'kategori' => $kategori,
				'harga' => $harga,
				'stok' => $stok
			);
			$this->db->set($data);
			$this->db->where('id_brg', $id);
			// $where = array('id_brg' => $id);
			$this->db->update(TB_BARANG);
			// $this->model_barang->updatebarang($data, $where, TB_BARANG);
			redirect('admin/data_barang');
		}
	}

	public function hapus($id)
	{
		if (!$this->session->has_userdata('admin')) {
			$this->load->view('templates/header');
			$this->load->view('miss/alert');
			$this->load->view('templates/footer');
		} else {
			$where = array('id_brg' => $id);
			$this->model_barang->hapusdata($where);
			redirect('admin/data_barang');
		}
	}
}
