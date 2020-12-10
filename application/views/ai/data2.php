<?php
$koneksi = mysqli_connect("localhost", "root", "", "beol");
echo "Haloo ada yang bisa dibantu? <hr>";
$perintah = "SELECT * FROM chat_admin";
$hsl = mysqli_query($koneksi, $perintah);

$perintah2 = "SELECT * FROM chat_user";
$hsl2 = mysqli_query($koneksi, $perintah2);

if (mysqli_num_rows($hsl) > 0 || mysqli_num_rows($hsl2) > 0) {
    $user = mysqli_fetch_assoc($hsl2);
    $admin = mysqli_fetch_assoc($hsl);
    while ($user['chat'] != null || $admin['chat'] != null) {
        if ($user['chat'] != null)
            echo $user['chat'] . "<hr>";

        while ($admin['chat'] != null && $admin['id_usr'] == $user['id']) {
            if ($admin['id_brg'] != 0) {
                $idb = $admin['id_brg'];
                $idc = $admin['id'];
                $que = "SELECT `nama_brg`, `keterangan`, `harga` 
                        FROM `chat_admin` JOIN `barang`
                        ON `chat_admin`.`id_brg` = `barang`.`id_brg`
                        WHERE `chat_admin`.`id_brg` = '$idb'
                        ";
                $result = mysqli_query($koneksi, $que);
                $kuambil = mysqli_fetch_assoc($result);
                var_dump($kuambil);
                var_dump($idb);
                $link_tambah = "<a class='link' href='tambah.php?idb=" . $idb . "&idc=" . $idc . "'>
                                    <button>BELI</button>
                                </a>";
                echo $link_tambah;
                echo "<br>";
            }
            echo $admin['chat'] . "<hr>";
            $admin = mysqli_fetch_assoc($hsl);
        }
        $user = mysqli_fetch_assoc($hsl2);
    }
}

$link_ya = "<a class='link' href='ya.php'>
                <button>YA</button>
            </a>";
$link_tidak = "<a class='link' href='tidak.php'>
                <button>TIDAK</button>
            </a>";
echo $link_ya . $link_tidak;
