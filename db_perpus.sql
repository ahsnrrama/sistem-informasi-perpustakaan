-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2024 pada 18.52
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nim` int(15) DEFAULT NULL,
  `nama_mahasiswa` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `verifikasi` int(2) NOT NULL DEFAULT 0,
  `id_kelas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `password`, `email`, `nim`, `nama_mahasiswa`, `jenis_kelamin`, `alamat`, `foto`, `no_hp`, `verifikasi`, `id_kelas`) VALUES
(3, '$2y$10$p2TIQES/FrX3DVdd8hSyM.w3jsgI5XeZLaA9RA5oftppq3QD1UeLm', 'zein@gmail.com', 102220023, 'zein', 'Laki-laki', 'Kebonsari, Karangdadap', '1728762755_5f9a707704893648ca74.png', '082134224561', 1, '2'),
(14, '$2y$10$fZVoo.80TLDfJRe9dXURVeRIjIEu/ZMtm5HVkZD9oVhbWDzaqKJa6', 'ricky@gmail.com', 102220034, 'Ricky Brain', 'Laki-laki', 'Wonopringgo', '1728762782_3e339fbe08cae5e25ea8.png', '085654635544', 0, '4'),
(16, '$2y$10$IYvG9oOB06Jf1oJubGDQRus64lRKMXTZloY3uNvxuVFAlNrGh0noO', 'stephen@gmail.com', 102220033, 'Stephen daws', 'Laki-laki', 'Amerika Serikat', '1728762773_c47ad218d3522b351767.png', '085645432111', 0, '4'),
(17, '$2y$10$IKy7LHR4kyryzGBBmEfqMeVXUdl.g.V1aik5ZehLWEb356OXBKiFy', 'chika@gmail.com', 102220031, 'Chika Angelina', 'Perempuan', 'Tegal, Jawa Tengah', '1728762764_a1465e945b32cec55d6b.png', '086787562133', 0, '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(20) DEFAULT NULL,
  `judul_buku` varchar(255) DEFAULT NULL,
  `id_kategori` int(2) DEFAULT NULL,
  `id_penulis` int(2) DEFAULT NULL,
  `id_penerbit` int(2) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `bahasa` varchar(20) DEFAULT NULL,
  `halaman` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `jml_tersedia` int(11) NOT NULL,
  `jml_dipinjam` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul_buku`, `id_kategori`, `id_penulis`, `id_penerbit`, `id_rak`, `isbn`, `tahun`, `bahasa`, `halaman`, `jumlah`, `cover`, `jml_tersedia`, `jml_dipinjam`, `deskripsi`) VALUES
(11, 'BK-2019-0011', 'Koleksi Program Web Java', 4, 2, 2, 1, '6020496546', '2019', 'Indonesia', 230, 10, '1728762531_cb303d11a134ee837f6d.jpeg', 10, 0, NULL),
(12, 'BK-2017-0012', 'Buku Sakti Pemrograman Web', 4, 1, 1, 1, '6232443527', '2017', 'Indonesia', 89, 15, '1728755426_95977a31b7ea35f149c4.jpeg', 15, 0, NULL),
(13, 'BK-2018-0013', 'Buku Sakti Pemrograman Web Seri PHP', 4, 1, 1, 1, '6232445414', '2018', 'Indonesia', 59, 4, '1728755496_f8dcded8ff00b9c55d30.jpeg', 4, 0, NULL),
(14, 'BK-2008-0014', 'Sejarah Indonesia Modern 1200–2008', 3, 12, 12, 4, '9789790241152', '2008', 'Indonesia', 423, 7, '1728755556_4bc108f56ea95013a6a4.jpeg', 7, 0, NULL),
(15, 'BK-2008-0015', ' Nusantara', 3, 13, 13, 8, '9789799101075', '2008', 'Indonesia', 50, 8, '1728755595_a668f3d9f4eaad9eec3d.jpeg', 8, 0, NULL),
(16, 'BK-2015-0016', ' Para Panglima Perang Islam', 3, 14, 14, 5, '9786027695696', '2015', 'Indonesia', 231, 5, '1728763470_aca982a8040a971ddfb6.jpeg', 5, 0, NULL),
(17, 'BK-2023-0017', 'The Art of War Seni Menaklukkan Lawan dan Memperoleh Peluang', 3, 15, 16, 7, '9786234008593', '2023', 'Indonesia', 120, 4, '1728763549_974b99049b9e5c1fb753.jpeg', 4, 0, NULL),
(18, 'BK-2019-0018', ' Marketing 4.0: Bergerak dari Tradisional ke Digital', 1, 16, 10, 10, '9786020621180', '2019', 'Indonesia', 200, 8, '1728763610_55998787ed85a1baf688.jpeg', 8, 0, NULL),
(19, 'BK-2024-0019', 'Strategi Perang Digital Marketing: Bagaimana Menjadi Pedagang UMKM Yang Bisa Bertranformasi Menjadi Miliarder Dan Mempunyai Personal Branding Yang Kuat', 1, 17, 15, 11, '9786230056635', '2024', 'Indonesia', 150, 10, '1728763907_74099f787fecdfbca6b8.jpeg', 10, 0, NULL),
(21, 'BK-2022-0021', ' Patologi Sosial', 5, 18, 17, 5, '9786022175339', '2022', 'Indonesia', 123, 3, '1728764503_2b87d77c10bf4ece2708.jpeg', 3, 0, NULL),
(23, 'BK-2021-0023', '73KNOLOGI TEPAT GUNA', 1, 19, 18, 2, '9786237267225', '2021', 'Indonesia', NULL, 2, '1734690861_7b4237d4339c891ae36a.jpg', 0, 0, '<p><span style=\"color: rgb(31, 31, 31); font-family: Arial, sans-serif; font-size: 13px;\">Buku ini dapat dijadikan sebagai salah satu rujukan pengenalan dunia pertanian dan perikanan yang atraktif dalam bahasa yang mudah dimengerti, penyelesaian beberapa permasalahan di bidang pertanian dan perikanan, serta dapat digunakan berbagai kegiatan untuk meningkatkan untuk pedoman kesejahteraan kaum marginal, kelompok wanita bahkan sangat sesuai sebagai pedoman pelaksanaan program Kuliah Kerja Nyata bidang peningkatan produksi pertanian dan perikanan</span></p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_pinjam` int(111) NOT NULL,
  `keterlambatan` int(11) DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT NULL,
  `denda_perhari` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `denda`
--

INSERT INTO `denda` (`id_denda`, `id_pinjam`, `keterlambatan`, `denda`, `denda_perhari`) VALUES
(43, 51, 40, 40000.00, 1000.00),
(44, 52, 4, 4000.00, 1000.00),
(45, 25, 47, 47000.00, 1000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Ekonomi'),
(2, 'Komik'),
(3, 'Sejarah'),
(4, 'Teknologi'),
(5, 'Sosial'),
(6, 'Novel'),
(8, 'Alam'),
(9, 'Pendidikan'),
(10, 'Matematika'),
(11, 'Budaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(2, 'IM22A'),
(4, 'IM22B'),
(5, 'IM22C'),
(6, 'IM22D'),
(7, 'IM23A'),
(8, 'IM23B'),
(9, 'IM23C'),
(10, 'IM23D'),
(11, 'IM21A'),
(12, 'IM21B'),
(13, 'IM21C'),
(14, 'IM21D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `no_pinjam` varchar(20) NOT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `tgl_bts_ambil` date DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `lama_pinjam` int(11) DEFAULT NULL,
  `tgl_harus_kembali` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status_pinjam` varchar(15) DEFAULT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `no_pinjam`, `tgl_pengajuan`, `id_anggota`, `id_buku`, `qty`, `tgl_bts_ambil`, `tgl_pinjam`, `lama_pinjam`, `tgl_harus_kembali`, `tgl_kembali`, `status_pinjam`, `ket`) VALUES
(15, '202410182203-003', '2024-10-18', 3, 12, 1, '0000-00-00', '2024-10-19', 5, '2024-10-24', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(20, '202410182223-0016', '2024-10-18', 16, 19, 1, '0000-00-00', '2024-10-19', 5, '2024-10-24', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(24, '202410190142-0014', '2024-10-19', 14, 19, 1, '0000-00-00', '2024-10-20', 2, '2024-10-22', NULL, 'ditolak', 'Pengajuan hangus karena tidak diambil dalam batas waktu'),
(25, '202410190143-0017', '2024-10-19', 17, 14, 1, '0000-00-00', '2024-10-20', 2, '2024-10-22', '2024-12-08', 'terlambat', ''),
(32, '202410292219-003', '2024-10-29', 3, 19, 1, '0000-00-00', '2024-10-30', 7, '2024-11-06', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(38, '202410300032-003', '2024-10-30', 3, 14, 1, '0000-00-00', '2024-10-30', 5, '2024-11-04', NULL, 'tepat', ''),
(43, '202412061504-0014', '2024-12-06', 14, 18, 1, '0000-00-00', '2024-12-06', 5, '2024-12-11', NULL, 'tepat', ''),
(44, '202412061640-0014', '2024-12-06', 14, 13, 1, NULL, '2024-12-06', 5, '2024-12-11', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(45, '202412061640-0014', '2024-12-06', 14, 19, 1, NULL, '2024-12-06', 7, '2024-12-13', NULL, 'dipinjam', ''),
(46, '202412061640-0017', '2024-12-06', 17, 18, 1, '2024-12-08', '2024-12-06', 5, '2024-12-11', NULL, 'ditolak', 'Pengajuan hangus karena tidak diambil dalam batas waktu'),
(47, '202412061641-0017', '2024-12-06', 17, 21, 1, NULL, '2024-12-06', 3, '2024-12-09', '2024-12-06', 'tepat', ''),
(48, '202412061641-0017', '2024-12-06', 17, 17, 1, NULL, '2024-12-06', 1, '2024-12-07', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(51, '202409104532-003', '2024-10-18', 16, 19, 1, '2024-10-20', '2024-10-19', 4, '2024-10-23', '2024-12-02', 'terlambat', ''),
(52, '202409104532-003', '2024-12-02', 14, 17, 1, '2024-12-03', '2024-12-03', 3, '2024-12-06', '2024-12-10', 'terlambat', ''),
(58, '202412072025-0016', '2024-12-07', 16, 19, 1, '2024-12-09', '2024-12-07', 1, '2024-12-08', NULL, 'ditolak', 'Pengajuan hangus karena tidak diambil dalam batas waktu'),
(59, '202412072025-0016', '2024-12-07', 16, 11, 1, NULL, '2024-12-07', 4, '2024-12-11', '2024-12-07', 'tepat', ''),
(66, '202412072046-0016', '2024-12-07', 16, 15, 1, '2024-12-09', '2024-12-07', 4, '2024-12-11', NULL, 'dipinjam', ''),
(67, '202412080049-0016', '2024-12-08', 16, 16, 1, '2024-12-10', '2024-12-08', 2, '2024-12-10', NULL, 'ditolak', 'Pengajuan hangus karena tidak diambil dalam batas waktu'),
(68, '202412080049-0016', '2024-12-08', 16, 13, 1, NULL, '2024-12-08', 4, '2024-12-12', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(69, '202412080056-0014', '2024-12-08', 14, 14, 1, NULL, '2024-12-08', 3, '2024-12-11', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(70, '202412080056-0014', '2024-12-08', 14, 17, 1, NULL, '2024-12-08', 1, '2024-12-09', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(71, '202412080056-0014', '2024-12-08', 14, 21, 1, '2024-12-10', '2024-12-08', 4, '2024-12-12', NULL, 'ditolak', 'Pengajuan hangus karena tidak diambil dalam batas waktu'),
(72, '202412080058-003', '2024-12-08', 3, 12, 1, NULL, '2024-12-08', 2, '2024-12-10', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(73, '202412080058-003', '2024-12-08', 3, 17, 1, '2024-12-10', '2024-12-08', 4, '2024-12-12', NULL, 'ditolak', 'Pengajuan hangus karena tidak diambil dalam batas waktu'),
(74, '202412080058-003', '2024-12-08', 3, 19, 1, NULL, '2024-12-08', 6, '2024-12-14', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(75, '202412080059-0017', '2024-12-08', 17, 13, 1, '2024-12-10', '2024-12-08', 1, '2024-12-09', NULL, 'ditolak', 'Pengajuan hangus karena tidak diambil dalam batas waktu'),
(76, '202412080059-0017', '2024-12-08', 17, 19, 1, '2024-12-10', '2024-12-08', 4, '2024-12-12', NULL, 'dipinjam', ''),
(77, '202412080059-0017', '2024-12-08', 17, 13, 1, NULL, '2024-12-08', 3, '2024-12-11', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(78, '202412181033-0016', '2024-12-18', 16, 17, 1, '2024-12-20', '2024-12-18', 3, '2024-12-21', NULL, 'ditolak', 'Pengajuan hangus karena tidak diambil dalam batas waktu'),
(79, '202412181044-0016', '2024-12-18', 16, 12, 1, NULL, '2024-12-18', 2, '2024-12-20', NULL, 'ditolak', 'Melewati batas waktu verifikasi, peminjaman ditolak'),
(80, '202412202304-0016', '2024-12-20', 16, 23, 1, '2024-12-22', '2024-12-20', 5, '2024-12-25', NULL, 'dipinjam', ''),
(81, '202412210014-0016', '2024-12-21', 16, 18, 1, NULL, '2024-12-21', 1, '2024-12-22', NULL, 'diproses', ''),
(82, '202412210017-0016', '2024-12-21', 16, 12, 1, NULL, '2024-12-21', 1, '2024-12-22', NULL, 'diproses', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`) VALUES
(1, 'Buku Kompas'),
(2, 'Republika'),
(3, 'Pustaka Hidayah'),
(4, 'GagasMedia'),
(5, 'Pustaka Alvabet'),
(6, 'Bentang Pustaka'),
(7, 'Kepustakaan Populer Gramedia (KPG)'),
(8, 'Erlangga'),
(9, 'Mizan Publishing'),
(10, 'Gramedia Pustaka Utama'),
(12, 'Serambi Ilmu Semesta'),
(13, 'Kepustakaan Populer Gramedia'),
(14, 'SAUFA'),
(15, 'Elex Media Komputindo'),
(16, 'Anak Hebat Indonesia'),
(17, 'Bumi Aksara'),
(18, 'Andi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`) VALUES
(1, 'A. Damhoeri'),
(2, 'A. Kembara'),
(3, 'A. Kohar Ibrahim'),
(4, 'Abdul Hadi'),
(5, 'Bastian Tito'),
(6, 'Basyral Hamidy Harahap'),
(7, 'Jujur Prananto'),
(8, 'Raditya Dika'),
(9, 'Ratna Megawangi'),
(10, 'Ridwan Sanjaya'),
(12, 'Merle Calvin Ricklefs'),
(13, 'Bernard Hubertus Maria Vlekke'),
(14, 'Rizem Aizid'),
(15, 'Sun Tzu'),
(16, 'Philip Kotler'),
(17, 'Tom Liwafa'),
(18, 'Paisol Burlian'),
(19, 'Agus Dwi Nugroho');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak_buku`
--

CREATE TABLE `rak_buku` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(50) DEFAULT NULL,
  `lantai_rak` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rak_buku`
--

INSERT INTO `rak_buku` (`id_rak`, `nama_rak`, `lantai_rak`) VALUES
(1, 'Rak A', 1),
(2, 'Rak A', 2),
(3, 'Rak A', 3),
(4, 'Rak A', 4),
(5, 'Rak B', 1),
(7, 'Rak B', 2),
(8, 'Rak B', 3),
(9, 'Rak B', 4),
(10, 'Rak C', 1),
(11, 'Rak C', 2),
(12, 'Rak C', 3),
(13, 'Rak C', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `level` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `foto`, `level`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$RUZPewrdnOL1u55/TdPB6Ow25x15InCSwO0sqxEc8.pwH4L.4MZ9W', NULL, 0),
(4, 'user', 'user@gmail.com', '$2y$10$T9brZA./A9XURLu95/LuBuT7zoBLPE.sUBZT7tw/eiK', NULL, 1),
(5, 'zein', 'zein@gmail.com', '$2y$10$55XyY2F/Wh554JEPHw7C2uUa1mm2KBFzlgcWY.JhQv1vZz17OPZmi', NULL, 1),
(10, 'Ricky Brain', 'ricky@gmail.com', '$2y$10$cz4rTSBAw4Rh1YUzbGcwYebdGVoitKj0Vlsd0WbA01oOz8dBOy2aK', NULL, 1),
(12, 'Stephen daws', 'stephen@gmail.com', '$2y$10$6tnnW/rZ3I6xalBIpNO0i.QHlZVkUnW55qCW6PTf1xgeSIGFPk2cy', NULL, 1),
(13, 'Chika Angelina', 'chika@gmail.com', '$2y$10$V/LOA5MRvQ7oz6ovsJhQweIYVL0kKn/GjWclYXTtKWR7hOr.pqDVu', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indeks untuk tabel `rak_buku`
--
ALTER TABLE `rak_buku`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `rak_buku`
--
ALTER TABLE `rak_buku`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
