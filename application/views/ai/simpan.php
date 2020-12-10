<?php
$email = $this->session->email;
if (isset($_POST['pesan_usr'])) {
    $chat = $_POST['pesan_usr'];
    $tada = [
        'chat' => $chat,
        'nama_user' => $email
    ];
    $this->db->insert('chat_user', $tada);
}

$query = $this->db->get_where('chat_user', ['nama_user' => $email])->result_array();
$id_usr = $query[count($query) - 1]['id'];

$admin = $this->db->get_where('chat_admin', ['email_usr' => $email])->result_array();
$chatnya = $admin[count($admin) - 1]['chat'];
$adah = strpos($chatnya, "alamat");
$user = $this->db->get_where('user', ['email' => $email])->row_array();
// $_POST['pesan_usr'];
if ($adah > 0) {
    $alamat = $chat;
    $this->db->where('email', $email);
    $this->db->update('user', ['alamat' => $alamat]);
    $dah = true;
    $kata = "Pembayaran anda sudah di proses";
    //
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
    $sip = [
        'chat' => $kata,
        'id_usr' => $id_usr,
        'email_usr' => $email
    ];
    $this->db->insert('chat_admin', $sip);
}
if (empty($dah)) {
    if (isset($_POST['pesan_usr'])) {
        $jadi = explode('beli', $_POST['pesan_usr']);
        $hit = count($jadi);
        // var_dump($jadi);
        // var_dump($hit);
        // die;
        $jj = explode(' ', $jadi[$hit - 1]);
        $banyak = [];
        $hasilnya = [];
        foreach ($jj as $cari) {
            $cekangka = is_numeric($cari);
            if ($cekangka) {
                $banyak[] = intval($cari);
                continue;
            }
            if ($cari != '') {
                $query = "SELECT id_brg, nama_brg FROM barang
                             WHERE nama_brg LIKE '%$cari%'
                             ";
                $this->db->select('id_brg, nama_brg');
                $this->db->like('nama_brg', $cari);
                $hsl = $this->db->get('barang');
                // $hasilnya = $hsl->result_array();
                array_push($hasilnya, $hsl->row_array());
                if ($hsl->num_rows() > 0) {
                    $ketemu = true;
                }
            }
        }
        if (empty($ketemu)) {
            if ($hit > 1) {
                $ktbrg = explode('barang', $jadi[1]);
                $ktprdk = explode('produk', $jadi[1]);
                // var_dump($ktbrg);
                // var_dump($ktprdk);
                $kl = count($ktbrg);
                $ktl = count($ktprdk);
                // var_dump($kl);
                // die;
                if ($kl > 1) {
                    if ($ktbrg[$kl - 1] == '' || $ktprdk[$ktl - 1] == '') {
                        $kata = "Mau beli barang apa?";
                        // $this->db->insert('chat_admin', ['chat' => $kata, 'id_usr' => $id_usr, 'email_usr' => $email]);
                    } else {
                        $kata = "Maaf produk tidak ada COK";
                    }
                } else {
                    $kata = "Maaf produk tidak ada COK";
                }
            } else {
                $kata = "Maaf kami belum mengerti maksud anda. Atau barang yang anda minta tidak ada di daftar";
            }
            // var_dump($kata);
            // die;
            $this->db->insert('chat_admin', ['chat' => $kata, 'id_usr' => $id_usr, 'email_usr' => $email]);
        }
        if (isset($ketemu)) {
            for ($i = 0; $i < count($hasilnya); $i++) {
                $id = $hasilnya[$i]['id_brg'];
                $kata = "Produk " . $hasilnya[$i]['nama_brg'];
                if ($hasilnya[$i]['nama_brg'] != '' && !empty($banyak[$i])) {
                    $masuk = [
                        'id_brg' => $id,
                        'jumlah' => $banyak[$i],
                        'chat' => $kata,
                        'id_usr' => $id_usr,
                        'email_usr' => $email
                    ];
                    $this->db->insert('chat_admin', $masuk);
                } else if ($hasilnya[$i] != null) {
                    $masuk = [
                        'id_brg' => $id,
                        'jumlah' => 1,
                        'chat' => $kata,
                        'id_usr' => $id_usr,
                        'email_usr' => $email
                    ];
                    $this->db->insert('chat_admin', $masuk);
                }
            }
        }
        echo "berhasil";
    }
}
