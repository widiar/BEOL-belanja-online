<?php
// var_dump($_GET);
//nyari id user
$email = $this->session->email;
// var_dump($email);
$this->db->select('id');
$j = $this->db->get_where('chat_user', ['nama_user' => $email])->result_array();
$idcu = $j[count($j) - 1]['id'];

$idbr = $_GET['idb'];
$idca = $_GET['idc'];

$p = "SELECT *
      FROM `chat_admin` JOIN `barang`
      ON `chat_admin`.`id_brg` = `barang`.`id_brg`
      WHERE `chat_admin`.`id_brg` = '$idbr' AND `chat_admin`.`id`='$idca'";

$h = $this->db->query($p);
$r = $h->row_array();

if ($r['jumlah'] > 0) {
    // $total = $r['jumlah'] * $r['harga'];
    $kata = "Barang sudah ditambahkan di ke keranjang ";
    // $kata = "Ingin membeli " . $r['nama_brg'] . " dengan jumlah " . $r['jumlah'] . " dan harga total Rp. " . number_format($jumlah, 0, ',', '.') . "?";
    $p = [
        'id_usr' => $idcu,
        'chat' => $kata,
        'email_usr' => $email
    ];
    $this->db->insert('chat_admin', $p);

    $barang = $this->model_barang->find($idbr)->row_array();
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
}
