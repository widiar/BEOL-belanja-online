<?php
$email = $this->session->email;
$this->db->select('id');
$j = $this->db->get_where('chat_user', ['nama_user' => $email])->result_array();
$idcu = $j[count($j) - 1]['id'];

$user = $this->db->get_where('user', ['email' => $email])->row_array();
if ($user['alamat'] == null) {
    $kata = "Masukkan alamat anda terlebih dahulu";
} else {
    $kata = "Pembayaran anda sudah di proses";
    $this->db->where('email_user', $email);
    $this->db->where('s_bayar', 0);
    $item = $this->db->get('pesanan')->result_array();
    foreach ($item as $as) {
        $this->db->where('id', $as['id']);
        $this->db->update('pesanan', ['s_bayar' => 1]);
        $inv = [
            'id_pesanan' => $as['id'],
            'id_user' => $user['id']
        ];
        $this->db->insert('invoice', $inv);
    }
}
$data = [
    'chat' => $kata,
    'id_usr' => $idcu,
    'email_usr' => $email
];
$this->db->insert('chat_admin', $data);
