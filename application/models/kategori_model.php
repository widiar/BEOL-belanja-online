<?php

class Kategori_model extends CI_Model{
    public function handphone()
    {
        return $this->db->get_where(TB_BARANG,array('kategori' => 'Handphone'));
    }
    public function tablet()
    {
        return $this->db->get_where(TB_BARANG,array('kategori' => 'tablet'));
    }
    public function laptop()
    {
        return $this->db->get_where(TB_BARANG,array('kategori' => 'laptop'));
    }
}