-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2019 pada 11.22
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catat_basic`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ct_detail_penjualan`
--

CREATE TABLE `ct_detail_penjualan` (
  `id_detail_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(200) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `harga_produk` double NOT NULL,
  `quantity` double NOT NULL,
  `size` varchar(200) NOT NULL,
  `subtotal` double NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ct_detail_penjualan`
--

INSERT INTO `ct_detail_penjualan` (`id_detail_penjualan`, `id_produk`, `kode_produk`, `nama_produk`, `harga_produk`, `quantity`, `size`, `subtotal`, `id_penjualan`, `created`, `updated`, `deleted`) VALUES
(13, 18, 'BSC-00001', 'Hallucination', 190000, 4, 'L', 760000, 21, '2019-04-10 14:56:14', '2019-04-10 14:56:14', 0),
(14, 18, 'BSC-00001', 'Hallucination', 190000, 4, 'L', 760000, 22, '2019-04-11 14:51:19', '2019-04-11 14:51:19', 0),
(15, 18, 'BSC-00001', 'Hallucination', 190000, 3, 'XL', 570000, 22, '2019-04-11 14:51:19', '2019-04-11 14:51:19', 0),
(16, 19, 'BSC-00002', 'Angel Of Death', 100000, 2, 'XL', 200000, 23, '2019-04-11 14:53:33', '2019-04-11 14:53:33', 0),
(17, 19, 'BSC-00002', 'Angel Of Death', 100000, 1, 'L', 100000, 23, '2019-04-11 14:53:33', '2019-04-11 14:53:33', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ct_detail_produks`
--

CREATE TABLE `ct_detail_produks` (
  `id_detail_produk` int(11) NOT NULL,
  `img_produk` varchar(200) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ct_detail_produks`
--

INSERT INTO `ct_detail_produks` (`id_detail_produk`, `img_produk`, `id_produk`, `created`, `updated`, `deleted`) VALUES
(5, 'SeeYa3.PNG', 19, '2019-04-11 10:36:19', '2019-04-11 10:43:49', 1),
(6, 'SeeYa12.PNG', 19, '2019-04-11 10:36:19', '2019-04-11 10:43:49', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ct_kategori_produk`
--

CREATE TABLE `ct_kategori_produk` (
  `id_kategori_produk` int(11) NOT NULL,
  `nama_kategori_produk` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ct_kategori_produk`
--

INSERT INTO `ct_kategori_produk` (`id_kategori_produk`, `nama_kategori_produk`, `id_user`, `created`, `updated`, `deleted`) VALUES
(1, 'T-shirt', 0, '2019-04-02 11:23:16', '2019-04-12 10:17:13', 0),
(2, 'Jacket', 0, '2019-04-02 11:23:16', '2019-04-12 10:14:12', 0),
(3, 'Pullover Hoodie', 0, '2019-04-11 21:37:04', '2019-04-12 10:15:22', 0),
(4, 'Caps', 0, '2019-04-11 21:37:40', '2019-04-11 21:37:40', 0),
(5, 'Parka Jacket', 0, '2019-04-11 22:01:19', '2019-04-11 22:01:19', 0),
(6, 'Bikers Jacket', 0, '2019-04-11 22:03:14', '2019-04-12 10:26:28', 1),
(7, 'Snapback', 0, '2019-04-11 22:04:07', '2019-04-11 22:04:07', 0),
(13, 'Printing Shirt', 1, '2019-04-12 14:59:57', '2019-04-12 15:02:12', 0),
(14, 'Bomber Jacket', 1, '2019-04-12 15:01:37', '2019-04-12 15:01:37', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ct_penjualan`
--

CREATE TABLE `ct_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_penjualan` varchar(200) NOT NULL,
  `tanggal_penjualan` datetime NOT NULL,
  `nama_pembeli` varchar(200) NOT NULL,
  `alamat_pembeli` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomor_telepon` varchar(200) NOT NULL,
  `kota_tujuan` varchar(200) NOT NULL,
  `status` enum('Belum Terbayar','Lunas') NOT NULL,
  `ongkos_kirim` double NOT NULL,
  `total` double NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ct_penjualan`
--

INSERT INTO `ct_penjualan` (`id_penjualan`, `kode_penjualan`, `tanggal_penjualan`, `nama_pembeli`, `alamat_pembeli`, `id_user`, `nomor_telepon`, `kota_tujuan`, `status`, `ongkos_kirim`, `total`, `created`, `updated`, `deleted`) VALUES
(21, 'PJ-00001', '2019-04-10 09:56:14', 'Dogi Degina', 'Jl.Jatisari Permai B1A Pepelegi, Waru, Sidoarjo', 1, '0897762373734', '409', 'Belum Terbayar', 10000, 770000, '2019-04-10 14:56:14', '2019-04-10 14:56:15', 0),
(22, 'PJ-00002', '2019-04-11 09:51:18', 'Raja Kone', 'Jl.Kaliurang KM 65 Yogyakarta', 1, '0837378298309', '501', 'Belum Terbayar', 15000, 1345000, '2019-04-11 14:51:18', '2019-04-11 14:51:19', 0),
(23, 'PJ-00003', '2019-04-11 09:53:33', 'Joni Maimunah', 'Jl. Anjay Jayapura', 1, '08483498349', '158', 'Belum Terbayar', 115000, 415000, '2019-04-11 14:53:33', '2019-04-12 10:29:05', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ct_produk`
--

CREATE TABLE `ct_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(200) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `size_produk` enum('S','M','L','L','XXL','All') NOT NULL,
  `harga_produksi` double NOT NULL,
  `harga_jual` double NOT NULL,
  `warna` varchar(200) NOT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `stok` double NOT NULL,
  `id_user` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ct_produk`
--

INSERT INTO `ct_produk` (`id_produk`, `kode_produk`, `nama_produk`, `size_produk`, `harga_produksi`, `harga_jual`, `warna`, `id_kategori_produk`, `stok`, `id_user`, `created`, `updated`, `deleted`) VALUES
(18, 'BSC-00001', 'Hallucination', '', 140000, 190000, 'Navy', 2, 10, 1, '2019-04-10 14:16:53', '2019-04-10 14:16:53', 0),
(19, 'BSC-00002', 'Angel Of Death', '', 75000, 100000, 'White', 1, 10, 1, '2019-04-11 10:36:00', '2019-04-11 10:43:49', 1),
(20, 'BSC-00003', 'Basic Beach', '', 75000, 100000, 'White', 1, 10, 1, '2019-04-12 10:22:52', '2019-04-12 10:22:59', 1),
(21, 'BSC-00004', 'Point Black', '', 75000, 100000, 'Black', 2, 10, 1, '2019-04-12 10:24:01', '2019-04-12 10:24:01', 0),
(22, 'BSC-00005', 'Strong', '', 75000, 100000, 'Forest Green', 1, 10, 1, '2019-04-12 10:24:24', '2019-04-12 10:24:37', 1),
(23, 'BSC-00006', 'Chill Beach', '', 75000, 100000, 'White', 1, 10, 1, '2019-04-12 15:26:10', '2019-04-12 15:26:10', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ct_user`
--

CREATE TABLE `ct_user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama_user` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ct_user`
--

INSERT INTO `ct_user` (`id_user`, `email`, `password`, `nama_user`, `status`, `created`, `updated`, `deleted`) VALUES
(1, 'aryabayu23@gmail.com', '90db160accb88f58a8905ab2f2f9a175fcc86dbc', 'Arya Bayu Ageng P', 1, '2019-04-01 11:54:47', '2019-04-01 13:29:43', 0),
(7, 'admin@admin.com', '82379017a05706e4f8b0ea9a4f000825675b4a65', 'ADMIN BASIC', 0, '2019-04-02 00:55:41', '2019-04-02 00:55:41', 0),
(8, 'arya_pamungkas_24rpl@student.smktelkom-mlg.sch.id', '90db160accb88f58a8905ab2f2f9a175fcc86dbc', 'Arya Bayu', 0, '2019-04-10 13:46:01', '2019-04-10 13:46:01', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ct_detail_penjualan`
--
ALTER TABLE `ct_detail_penjualan`
  ADD PRIMARY KEY (`id_detail_penjualan`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indeks untuk tabel `ct_detail_produks`
--
ALTER TABLE `ct_detail_produks`
  ADD PRIMARY KEY (`id_detail_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `ct_kategori_produk`
--
ALTER TABLE `ct_kategori_produk`
  ADD PRIMARY KEY (`id_kategori_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `ct_penjualan`
--
ALTER TABLE `ct_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `ct_produk`
--
ALTER TABLE `ct_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori_produk` (`id_kategori_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `ct_user`
--
ALTER TABLE `ct_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ct_detail_penjualan`
--
ALTER TABLE `ct_detail_penjualan`
  MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `ct_detail_produks`
--
ALTER TABLE `ct_detail_produks`
  MODIFY `id_detail_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ct_kategori_produk`
--
ALTER TABLE `ct_kategori_produk`
  MODIFY `id_kategori_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `ct_penjualan`
--
ALTER TABLE `ct_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `ct_produk`
--
ALTER TABLE `ct_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `ct_user`
--
ALTER TABLE `ct_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ct_detail_penjualan`
--
ALTER TABLE `ct_detail_penjualan`
  ADD CONSTRAINT `ct_detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `ct_penjualan` (`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ct_detail_produks`
--
ALTER TABLE `ct_detail_produks`
  ADD CONSTRAINT `ct_detail_produks_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `ct_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ct_penjualan`
--
ALTER TABLE `ct_penjualan`
  ADD CONSTRAINT `ct_penjualan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `ct_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `ct_produk`
--
ALTER TABLE `ct_produk`
  ADD CONSTRAINT `ct_produk_ibfk_1` FOREIGN KEY (`id_kategori_produk`) REFERENCES `ct_kategori_produk` (`id_kategori_produk`),
  ADD CONSTRAINT `ct_produk_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `ct_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
