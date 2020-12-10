-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2019 pada 12.15
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beol`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(4) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_brg`, `nama_brg`, `keterangan`, `kategori`, `harga`, `stok`, `gambar`) VALUES
(2, 'IPAD 3', 'Ini adalah Ipad terbagus', 'Tablet', 20000000, 0, 'ipad3.jpg'),
(3, 'HP K20', 'Ini hp bagus kedua', 'Handphone', 15000000, 5, 'K20.jpg'),
(4, 'OPPO', 'Ini hp Oppo sih', 'Handphone', 10000000, 4, 'oppo.jpg'),
(5, 'Pochophone', 'Ini hp maknyusss', 'Handphone', 7000000, 7, 'p30p.jpg'),
(9, 'Redmiasasdk K20', 'Hp Redmik Nih Terbaru', 'Handphone', 80000, 3, 'a80.jpg'),
(14, 'Sony', 'ini hp SOny bagus angetz', 'Handphone', 70000, 5, 'ipad1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE IF NOT EXISTS invoice(
    id int AUTO_INCREMENT PRIMARY KEY,
    id_pesanan int,
    id_user int
);

CREATE TABLE IF NOT EXISTS pesanan(
    id int AUTO_INCREMENT PRIMARY KEY,
    id_brg int,
    jumlah int,
    subtotal int,
    tgl_pesanan datetime
);

CREATE TABLE IF NOT EXISTS user(
    id int AUTO_INCREMENT PRIMARY KEY,
    nama varchar(120),
    email varchar(120),
    alamat varchar(120),
    no_tlp varchar(100),
    password varchar(255),
    gambar varchar(120),
    role_id int,
    aktif int(2),
    tanggal_dibuat datetime()
);