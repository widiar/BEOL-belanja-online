<?php

class Model_barang extends CI_Model
{
	public function getdata()
	{
		return $this->db->get(TB_BARANG);
	}

	public function tambahdata($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function editbarang($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function updatebarang($data, $where, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function hapusdata($where)
	{
		$this->db->delete(TB_BARANG, $where);
	}

	public function find($id)
	{
		return $this->db->get_where(TB_BARANG, array('id_brg' => $id), 1);
	}
	public function detail_brg($id)
	{
		return $this->db->get_where(TB_BARANG, array('id_brg' => $id));
	}

	public function cekstok()
	{
		$email = $this->session->email;
		$q = "SELECT * FROM `pesanan` JOIN `barang` ON `pesanan`.`id_brg`=`barang`.`id_brg` WHERE `email_user`='$email' AND `s_bayar`=0";
		return $this->db->query($q);
	}
}
