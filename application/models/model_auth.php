<?php

class Model_auth extends CI_Model
{
    public function masukdata($data)
    {
        $this->db->insert('user', $data);
    }

    public function ambildata($data)
    {
        return $this->db->get_where('user', $data);
    }
}
