<?php
$email = $this->session->email;
$kata = [];
$kk = "<div class='direct-chat-msg'>
    <div class='direct-chat-text'>
        Hallo ada yang bisa dibantu?
    </div>
</div>";
echo $kk;
array_push($kata, $kk);

$perintah = $this->db->get_where('chat_admin', ['email_usr' => $email]);
$hsl = $perintah->num_rows();
$perintah2 = $this->db->get_where('chat_user', ['nama_user' => $email]);
$hsl2 = $perintah2->num_rows();

if ($hsl > 0 || $hsl2 > 0) {
    $usr = $perintah2->result_array();
    $adm = $perintah->result_array();
    $i = $j = 0;
    while (!empty($usr[$i]) || !empty($adm[$j])) {
        if ($usr[$i]['chat'] != null) {
            $uu = "<div class='direct-chat-msg right'>
                <div class='direct-chat-text'>
                    " . $usr[$i]['chat'] . "
                </div>
            </div>
            ";
            echo $uu;
            array_push($kata, $uu);
        }

        // if (!empty($adm[$j])) {
        while (!empty($adm[$j]) && $adm[$j]['id_usr'] == $usr[$i]['id']) {
            if ($adm[$j]['id_brg'] != 0) {
                $idb = $adm[$j]['id_brg'];
                $idc = $adm[$j]['id'];
                $que = "SELECT `nama_brg`, `keterangan`, `harga`, `gambar` 
                        FROM `chat_admin` JOIN `barang`
                        ON `chat_admin`.`id_brg` = `barang`.`id_brg`
                        WHERE `chat_admin`.`id_brg` = '$idb'
                        ";
                $result = $this->db->query($que);
                $kuambil = $result->row_array();
                $brg = "<div class='card mb-3' style='max-width: 540px;'>
                            <div class='row no-gutters'>
                                <div class='col-md-4'>
                                    <img src='" . base_url('assets/images/') . $kuambil['gambar'] . "' class='card-img'>
                                </div>
                                <div class='col-md-8'>
                                    <div class='card-body'>
                                        <h5 class='card-title mt-3'>" . $kuambil['nama_brg'] . "</h5>
                                        <p class='card-text'>" . $kuambil['keterangan'] . "</p>
                                        <span class='badge badge-pill badge-success mb-2'>Rp. " . number_format($kuambil['harga'], 0, ',', '.') . "</span>
                                        <br>
                                        <a class='link_beli' href='" . base_url('ai/beli_brg') . "?idb=" . $idb . "&idc=" . $idc . "' class='card-link'>Beli Barang</a>
                                        <span> || </span>
                                        <a href='" . base_url('dashboard/detail/') . $idb . "' class='card-link'>Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                echo $brg;
                array_push($kata, $brg);
            }
            $cro = strpos($adm[$j]['chat'], "keranjang");
            if ($cro != 0) {
                $kk = "<div class='card mb-3' style='max-width: 540px;'>
                        <div class='row no-gutters'>
                            <div class='col-md'>
                                <div class='card-body'>
                                    <h5 class='card-title mt-3'>" . $adm[$j]['chat'] . "</h5>
                                    <p></p>
                                    <br>
                                    <a id='keranjang' href='" . base_url('dashboard/detail_keranjang') . "' class='card-link'>Lihat Keranjang</a>
                                    <span> || </span>
                                    <a class='bayardahsu' href='" . base_url('ai/bayar') . "' class='card-link'>Bayar Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>";
            } else {
                $kk = "<div class='direct-chat-msg'>
                            <div class='direct-chat-text'>
                                " . $adm[$j]['chat'] . "
                            </div>
                        </div>";
            }
            echo $kk;
            array_push($kata, $kk);
            $j++;
        }
        // }
        $i++;
    }
}
// echo json_encode($kata);
