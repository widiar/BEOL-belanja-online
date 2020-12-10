<?php

class Model_invoice extends CI_Model
{
	public function index()
	{
		// date_default_timezone_set('Asia/Pontianak');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$no_tlp = $this->input->post('no_tlp');
		//masukin data ke user
		$user = [
			'nama' => $nama,
			'alamat' => $alamat,
			'no_tlp' => $no_tlp
		];
		$email = $this->session->userdata('email');
		$id_usr = $this->db->get_where('user', ['email' => $email])->row_array();
		$this->db->where(['email' => $email]);
		$this->db->update('user', $user);

		//tabel pesanan
		$this->db->where('email_user', $email);
		$this->db->where('s_bayar', 0);
		$item = $this->db->get('pesanan')->result_array();
		// var_dump($item);
		// die;
		foreach ($item as $as) {
			$this->db->where('id', $as['id']);
			$this->db->update('pesanan', ['s_bayar' => 1]);
			$brg = $this->db->get('barang')->row_array();
			$v = $brg['stok'] - $as['jumlah'];
			$this->db->where('id_brg', $as['id_brg']);
			$this->db->update('barang', ['stok' => $v]);
			$inv = [
				'id_pesanan' => $as['id'],
				'id_user' => $id_usr['id']
			];
			$this->db->insert('invoice', $inv);
		}

		return true;
	}

	public function tampildata()
	{
		$query = "SELECT `user`.`id`, `nama`, `email`
				  FROM `invoice` JOIN `user`
				  ON `invoice`.`id_user` = `user`.`id`
				  JOIN `pesanan`
				  ON `invoice`.`id_pesanan` = `pesanan`.`id` 
				";
		return $this->db->query($query);
	}

	public function lihatdata($id)
	{
		$query = "SELECT `nama`, `nama_brg`, `harga_p`, `jumlah`, `tgl_pesanan`
				  FROM `invoice` JOIN `user`
				  ON `invoice`.`id_user` = `user`.`id`
				  JOIN `pesanan`
				  ON `invoice`.`id_pesanan` = `pesanan`.`id`
				  JOIN `barang`
				  ON `pesanan`.`id_brg` = `barang`.`id_brg`
				  WHERE `user`.`id` = $id
				";
		// $menu = $this->db->query($query)->result_array();
		// var_dump($menu);
		// die;
		return $this->db->query($query);
	}
}
