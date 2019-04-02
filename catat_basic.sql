-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Apr 2019 pada 08.34
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
  `nama_produk` varchar(200) NOT NULL,
  `harga_produk` double NOT NULL,
  `qty` double NOT NULL,
  `subtotal` double NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ct_detail_produk`
--

CREATE TABLE `ct_detail_produk` (
  `id_detail_produk` int(11) NOT NULL,
  `img_produk` varchar(200) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Kaos', 1, '2019-04-02 11:23:16', '2019-04-02 11:23:16', 0),
(2, 'Jaket', 1, '2019-04-02 11:23:16', '2019-04-02 11:23:16', 0);

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
  `bayar` double NOT NULL,
  `sisa` double NOT NULL,
  `total` double NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

INSERT INTO `ct_produk` (`id_produk`, `kode_produk`, `nama_produk`, `size_produk`, `harga_produksi`, `harga_jual`, `id_kategori_produk`, `stok`, `id_user`, `created`, `updated`, `deleted`) VALUES
(3, 'BSC-00001', 'Basic Beach', '', 75000, 100000, 1, 50, 1, '2019-04-02 11:34:28', '2019-04-02 11:34:28', 0),
(4, 'BSC-00002', 'Basic Classic', '', 75000, 100000, 1, 80, 1, '2019-04-02 11:53:53', '2019-04-02 11:53:53', 0),
(5, 'BSC-00003', 'Angel Of Death', '', 75000, 100000, 1, 50, 1, '2019-04-02 11:57:27', '2019-04-02 11:57:27', 0),
(6, 'BSC-00004', 'Basic Classic', '', 75000, 100000, 1, 19, 1, '2019-04-02 12:43:11', '2019-04-02 12:43:11', 0),
(7, 'BSC-00005', 'Basic Classic', '', 80000, 24000, 1, 50, 1, '2019-04-02 12:44:30', '2019-04-02 12:44:30', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ct_user`
--

CREATE TABLE `ct_user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama_user` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ct_user`
--

INSERT INTO `ct_user` (`id_user`, `email`, `password`, `nama_user`, `status`, `created`, `updated`, `deleted`) VALUES
(1, 'aryabayu23@gmail.com', '90db160accb88f58a8905ab2f2f9a175fcc86dbc', 'Arya Bayu Ageng P', 1, '2019-04-01 11:54:47', '2019-04-01 13:29:43', 0),
(4, 'arya_pamungkas_24rpl@student.smktelkom-mlg.sch.id', '90db160accb88f58a8905ab2f2f9a175fcc86dbc', 'Arya Bayu 2', 0, '2019-04-02 00:52:02', '2019-04-02 00:52:02', 0),
(5, 'basicbasicco@gmail.com', 'f5e882c2b73c45558da0596dfcc8b3f7ebd85cf2', 'ADMIN BASIC', 1, '2019-04-02 00:55:08', '2019-04-02 00:56:21', 0),
(7, 'admin@admin.com', '82379017a05706e4f8b0ea9a4f000825675b4a65', 'ADMIN BASIC', 0, '2019-04-02 00:55:41', '2019-04-02 00:55:41', 0);

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
-- Indeks untuk tabel `ct_detail_produk`
--
ALTER TABLE `ct_detail_produk`
  ADD PRIMARY KEY (`id_detail_produk`);

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
  MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ct_detail_produk`
--
ALTER TABLE `ct_detail_produk`
  MODIFY `id_detail_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `ct_kategori_produk`
--
ALTER TABLE `ct_kategori_produk`
  MODIFY `id_kategori_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ct_penjualan`
--
ALTER TABLE `ct_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ct_produk`
--
ALTER TABLE `ct_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ct_user`
--
ALTER TABLE `ct_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ct_detail_penjualan`
--
ALTER TABLE `ct_detail_penjualan`
  ADD CONSTRAINT `ct_detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `ct_penjualan` (`id_penjualan`);

--
-- Ketidakleluasaan untuk tabel `ct_detail_produk`
--
ALTER TABLE `ct_detail_produk`
  ADD CONSTRAINT `ct_detail_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `ct_produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `ct_kategori_produk`
--
ALTER TABLE `ct_kategori_produk`
  ADD CONSTRAINT `ct_kategori_produk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `ct_user` (`id_user`);

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
