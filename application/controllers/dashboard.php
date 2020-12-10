<?php

class Dashboard extends CI_Controller
{
	public function index()
	{
		$data['barang'] = $this->model_barang->getdata()->result_array();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->view->topbar();
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_keranjang($id)
	{
		$email = $this->session->email;
		$barang = $this->model_barang->find($id)->row_array();
		//jika user tambah keranjang 2 kali
		$where = "email_user='$email' AND s_bayar=0";
		$this->db->where($where);
		$pesanan = $this->db->get('pesanan')->result_array();
		if ($pesanan) {
			foreach ($pesanan as $psn) {
				if ($psn['id_brg'] == $barang['id_brg']) {
					$tmp = $psn['jumlah'];
					$dps = ['jumlah' => ++$tmp];
					$this->db->update('pesanan', $dps, "id = {$psn['id']}");
					$ada = true;
				}
				if (isset($ada)) break;
			}
		}
		if (empty($ada)) {
			$tanggal = date('Y-m-d H:i:s');
			$data = [
				'id_brg' => $barang['id_brg'],
				'email_user' => $email,
				'jumlah' => 1,
				'harga_p' => $barang['harga'],
				'tgl_pesanan' => $tanggal,
				's_bayar' => 0
			];
			$this->db->insert('pesanan', $data);
		}
		redirect('/');
	}
	public function detail_keranjang()
	{
		$email = $this->session->email;
		$this->db->where('email_user', $email);
		$this->db->where('s_bayar', 0);
		$jml = $this->db->get('pesanan')->num_rows();
		if ($jml < 1) echo "
							<script>
							alert('Keranjang anda masih kosong');
							document.location.href = '..';
							</script>
						";
		
		$where = "SELECT * FROM `pesanan` JOIN `barang` ON `pesanan`.`id_brg`=`barang`.`id_brg` WHERE `email_user`='$email' AND `s_bayar`=0";
		$data['pesanan'] = $this->db->query($where)->result_array();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->view->topbar();
		$this->load->view('keranjang', $data);
		$this->load->view('templates/footer');
	}

	public function hapus_keranjang()
	{
		$this->db->empty_table('pesanan');
		redirect('/');
	}

	public function hapus_keranjang_id($id)
	{
		$this->db->delete('pesanan', ['id' => $id]);
		redirect('/dashboard/detail_keranjang');
	}

	public function pembayaran()
	{
		if ($this->session->userdata('admin')) {
			echo "
				<script>
				alert('Silahkan Login sebagai user untuk Melanjutkan');
				document.location.href = '..';
				</script>
			";
		}
		if (!$this->session->userdata('email')) {
			echo "
				<script>
				alert('Silahkan Login untuk Melanjutkan');
				document.location.href = '../profile/login';
				</script>
			";
		} else {
			$cek = $this->model_barang->cekstok()->result_array();
			$tt = 0;
			// var_dump($cek);
			foreach ($cek as $c) {
				if ($c['stok'] < $c['jumlah']) {
					echo "<script>alert('Stok dari barang " . $c['nama_brg'] . " tidak mencukupi'); document.location.href='" . base_url('dashboard/detail_keranjang') . "'</script>";
				} else {
					$tt += $c['harga_p'] * $c['jumlah'];
				}
			}
			$email = $this->session->userdata('email');
			$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
			$data['belanjaan'] = $tt;
			$this->session->set_userdata('bayar', 'false');
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->view->topbar();
			$this->load->view('pembayaran', $data);
			$this->load->view('templates/footer');
		}
	}

	public function prosesbayar()
	{
		$this->form_validation->set_rules('alamat', 'Alamat lengkap', 'required|trim');
		$this->form_validation->set_rules('no_tlp', 'Nomor Telepon', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->pembayaran();
		} else {
			$proses = $this->model_invoice->index();
			if ($proses) {
				$this->load->view('templates/header');
				$this->load->view('templates/sidebar');
				$this->view->topbar();
				$this->load->view('proses_bayar');
				$this->load->view('templates/footer');
				$this->session->unset_userdata('bayar');
			} else {
				echo "Maaf bro";
			}
		}
	}
	public function detail($id)
	{
		$data['barang'] = $this->model_barang->detail_brg($id)->result_array();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->view->topbar();
		$this->load->view('detail', $data);
		$this->load->view('templates/footer');
	}
}
