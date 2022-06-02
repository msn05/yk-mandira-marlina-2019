-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2020 pada 05.22
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ykmandira`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_akses`
--

CREATE TABLE `db_akses` (
  `id_akses` int(11) NOT NULL,
  `password` text NOT NULL,
  `status_users` int(1) NOT NULL,
  `login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` datetime NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_akses`
--

INSERT INTO `db_akses` (`id_akses`, `password`, `status_users`, `login`, `logout`, `id_level`) VALUES
(5006, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(15767, '$2y$10$51/ip7ZXDbwFpJ4yZ1itkOuZg0vL.5icADiE1jLVQusCDR8RISBza', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 4),
(20641, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(31424, '$2y$10$6YwXumysWNcX3.Wptd6hQORA1cLUBPMi23ApFAS2y4EwfjV4IPaFe', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 1),
(50916, '$2y$10$GoDFwafbnexFWd9pDyB.me6ZOV4pJxHzcjR3nkmoNS6x1ju04CPvG', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 1),
(77775, '$2y$10$8NBQgEZ3ALsOGssgjzIHouNO5fFs1EP27vWU1oF18bCXs.yXXw62S', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 3),
(99045, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 3),
(161270, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(291328, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(568669, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(679062, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(692720, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(767902, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(861527, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2),
(901099, '$2y$10$yTRYOzkqiLPcYJPU4XHT..ZSEY0Asj5mlhJzoTKsk2V4BdhTVWlk.', 1, '2020-07-25 04:42:27', '2020-07-25 05:21:46', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_data_akses`
--

CREATE TABLE `db_data_akses` (
  `id_data_akses` int(11) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `nomor_telephone` varchar(12) NOT NULL,
  `nomor_wa` varchar(12) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `nomor_darurat` varchar(16) NOT NULL,
  `status_akun_pengguna` int(1) DEFAULT NULL,
  `id_file_identitas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_data_akses`
--

INSERT INTO `db_data_akses` (`id_data_akses`, `id_akses`, `nama_lengkap`, `no_ktp`, `no_kk`, `nomor_telephone`, `nomor_wa`, `email`, `alamat`, `tanggal_lahir`, `tempat_lahir`, `nomor_darurat`, `status_akun_pengguna`, `id_file_identitas`) VALUES
(1, 31424, 'marlina', '1234567890123221', '1234567890123221', '085764554966', '085764554696', 'marlina@email.com', 'alamat', '1997-09-05', 'palembang', '08127345438', 1, 781707),
(48, 50916, 'nanda', '1671100509970004', '1671100509970001', '08127345438', '8127345438', 'nandawahyu@gmail.com', 'jalan tanjung sari 2 lrg suka marga', '1997-07-18', 'palembang', '08127345432', 1, 43523),
(49, 15767, 'irawan arawndi', '167110099807004', '167110099807004', '085387123487', '853871234874', 'irawan_12@gmail.com', 'jalan ampera raya bukit kecil palembang', '1989-07-16', 'jakarta', '08538712348749', 1, 26864),
(50, 99045, 'putri', '16711908870003', '16711908870001', '085638293748', '85638293748', 'putriwijaya@gmail.com', 'jalan sultan syahrid no 1556', '2020-07-17', 'palembang', '085638293748', 1, 76546),
(51, 77775, 'siti', '1671200055667711', '1671200055644771', '081233445577', '081233445577', 'siti21@gmail.com', 'jalan', '1998-03-11', 'palembang', '081233445577', 1, 35167);

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_file`
--

CREATE TABLE `db_file` (
  `id_file_identitas` int(16) NOT NULL,
  `ktp` text,
  `kk` text,
  `buku_nikah` text,
  `pasport` text,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_file`
--

INSERT INTO `db_file` (`id_file_identitas`, `ktp`, `kk`, `buku_nikah`, `pasport`, `foto`) VALUES
(26864, 'KTP_irawan_arawndi1.pdf', 'KK_irawan_arawndi1.pdf', NULL, NULL, 'foto_irawan_arawndi1.PNG'),
(28804, 'Buku_Nikah_ahmad_wijaya.pdf', 'KK_ahmad_wijaya.pdf', NULL, 'Pasport_ahmad_wijaya.pdf', 'foto_ahmad_wijaya.PNG'),
(35167, 'KTP_siti.pdf', 'KK_siti.pdf', NULL, NULL, 'foto_siti.jpg'),
(43523, 'KTP_nanda2.pdf', 'KK_nanda2.pdf', NULL, NULL, 'foto_nanda2.PNG'),
(76546, 'KTP_putri1.pdf', 'KK_putri1.pdf', NULL, NULL, 'foto_putri1.PNG'),
(189653, NULL, NULL, NULL, NULL, NULL),
(286907, 'Buku_Nikah_lila.pdf', 'KK_lila.pdf', NULL, 'Pasport_lila.pdf', 'foto_lila.jpeg'),
(390441, 'Buku_Nikah_23242.pdf', 'KK_23242.pdf', NULL, 'Pasport_23242.pdf', 'foto_23242.png'),
(391020, 'Buku_Nikah_linda.pdf', 'KK_linda.pdf', NULL, 'Pasport_linda.pdf', 'foto_linda.PNG'),
(411904, NULL, NULL, NULL, NULL, NULL),
(473579, 'Buku_Nikah_andini_rianti.pdf', 'KK_andini_rianti.pdf', NULL, 'Pasport_andini_rianti.pdf', 'foto_andini_rianti.PNG'),
(521200, 'Buku_Nikah_Fenty.pdf', 'KK_Fenty.pdf', NULL, 'Pasport_Fenty.pdf', 'foto_Fenty.PNG'),
(549096, 'KTP_nanda_marlina.pdf', 'KK_nanda_marlina.pdf', 'buku_nikah_nanda_marlina.pdf', 'pasport_nanda_marlina.pdf', 'foto_nanda_marlina.PNG'),
(687080, NULL, NULL, NULL, NULL, NULL),
(781707, 'KTP_marlina2.pdf', 'KK_marlina2.pdf', NULL, NULL, 'foto_marlina2.png'),
(818998, 'ktp_ajeng_kartika.pdf', 'kk_ajeng_kartika.pdf', NULL, 'pasport_ajeng_kartika.pdf', 'foto_ajeng_kartika1.png'),
(820736, 'KTP_lina.pdf', 'KK_lina.pdf', NULL, 'Pasport_lina.pdf', 'default.png'),
(843479, 'KTP_hani.pdf', 'KK_hani.pdf', NULL, 'Pasport_hani.pdf', 'default.png'),
(849241, 'KTP_riandi_wijaya.pdf', 'KK_riandi_wijaya.pdf', NULL, 'Pasport_riandi_wijaya.pdf', 'default.png'),
(939757, 'Buku_Nikah_laila.pdf', 'KK_laila.pdf', NULL, 'Pasport_laila.pdf', 'foto_laila.PNG'),
(941769, 'Buku_Nikah_sdfdsfs.pdf', 'KK_sdfdsfs.pdf', NULL, 'Pasport_sdfdsfs.pdf', 'foto_sdfdsfs.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_histori_layanan`
--

CREATE TABLE `db_histori_layanan` (
  `id_layanan` int(11) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `id` int(11) NOT NULL,
  `kode_layanan` int(1) NOT NULL,
  `nama_layanan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_hotel`
--

CREATE TABLE `db_hotel` (
  `id` int(15) NOT NULL,
  `kode_hotel` text NOT NULL,
  `nama_hotel` text NOT NULL,
  `harga` text,
  `negara` text NOT NULL,
  `provinsi` text NOT NULL,
  `kota` text NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telphone` text NOT NULL,
  `email` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_hotel`
--

INSERT INTO `db_hotel` (`id`, `kode_hotel`, `nama_hotel`, `harga`, `negara`, `provinsi`, `kota`, `alamat`, `nomor_telphone`, `email`) VALUES
(11, 'HT-2', 'hotel2', '190000', 'indonesia', 'sumatera selatan', 'palembang', 'jalan', '089374973829', 'hotel2@gmail.com'),
(12, 'HT-3', 'hotel 3', '200000', 'indonesia', 'bali', 'kute', 'jalan jalan', '089474938492', 'hotel3@gmail.com'),
(13, 'HT-4', 'APPLE', '100000', 'CHINA', 'BEIJING', 'CHINA', 'No.2A Sanqingdi Fengtai District, Beijing 100040 Cin', '081367668899', 'APPLE22@GMAIL.COM'),
(14, 'HT-21', 'Hotel Raffles Makkah Palace', '2000000', 'Saudi Arabia', 'Saudi Arabia', 'Mecca', 'Royal Tower? Ibrahim Al Khalil, Rd? Near Masjid Al Haram Al Hajlah? Mecca 24231, Saudi Arabia', '966125717888', 'raffles_makkah@gmail.com'),
(15, 'HT-34', 'Al-Ghufran Safwah Hotel Makkah', '1200000', 'Saudi Arabia', 'Saudi Arabia', 'mecca', 'Ajyad Street, Al Haram, Mecca 21966, Saudi Arabia', '966125777773', 'al_ghufran@gmail.com'),
(16, 'HT-342', 'Sheraton Makkah Jabal Al Kaaba Hotel', '1300000', 'Saudi arabia', 'Saudi arabia', 'mecca', 'Jabal Al Kaaba Makkah Al Mukkarammah? Mecca 24231, Saudi Arabia', '966125518900', 'sheraton@gmail.com'),
(17, 'HT-5', 'hotel miramare', '300000', 'cina', 'sakura', 'beajing', 'cina', '081322556611', 'hotel22@gmail.com'),
(18, 'HT-8', 'hotel novotel', '400000', 'Indonesia', 'Sumatera Selatan', 'Palembang', 'indonesia', '081378332211', 'hotelnovotel22@gmailc.om');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_kelengkapan_data`
--

CREATE TABLE `db_kelengkapan_data` (
  `id` int(11) NOT NULL,
  `id_kelengkapandata` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `jumlah` int(2) NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal_post` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_kelengkapan_data`
--

INSERT INTO `db_kelengkapan_data` (`id`, `id_kelengkapandata`, `nama_barang`, `jumlah`, `status`, `tanggal_post`) VALUES
(35, 68484, 'ihram', 1, 2, '2020-07-06'),
(36, 922, 'koper', 1, 2, '2020-07-06'),
(37, 41257, 'tas kecil', 1, 2, '2020-07-06'),
(38, 48718, 'buku manasik', 2, 2, '2020-07-06'),
(39, 80430, 'mukenah', 2, 2, '2020-12-06'),
(40, 83452, 'nametag', 2, 2, '2020-12-06'),
(41, 40216, 'batik seragam', 1, 2, '2020-07-06'),
(42, 29669, 'topi', 1, 1, '2020-07-20'),
(43, 5991, 'bajukaos', 1, 1, '2020-07-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_layanan`
--

CREATE TABLE `db_layanan` (
  `id_layanan` int(11) NOT NULL,
  `kode_layanan` varchar(5) NOT NULL,
  `nama_layanan` varchar(50) NOT NULL,
  `tanggal_post` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_layanan`
--

INSERT INTO `db_layanan` (`id_layanan`, `kode_layanan`, `nama_layanan`, `tanggal_post`) VALUES
(561157227, 'U', 'Pariwisata', '2020-07-06'),
(749206543, 'TH', 'Haji', '2020-07-06'),
(973785400, 'TU', 'Umroh', '2020-07-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_level`
--

CREATE TABLE `db_level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL,
  `status_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_level`
--

INSERT INTO `db_level` (`id_level`, `nama_level`, `status_level`) VALUES
(1, 'administrator', 1),
(2, 'customer', 1),
(3, 'karyawan', 1),
(4, 'pimpinan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_metode_pembayaran`
--

CREATE TABLE `db_metode_pembayaran` (
  `id_metode_pembayaran` int(11) NOT NULL,
  `metode` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_metode_pembayaran`
--

INSERT INTO `db_metode_pembayaran` (`id_metode_pembayaran`, `metode`) VALUES
(240570, 'credit'),
(669952, 'cash');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_paket`
--

CREATE TABLE `db_paket` (
  `id_paket` varchar(16) NOT NULL,
  `kode_paket_data` varchar(20) NOT NULL,
  `id_layanan` int(16) NOT NULL,
  `lama_perjalanan` int(11) NOT NULL,
  `tanggal_Berakhir` date NOT NULL,
  `tanggal_berangkat` datetime NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `id_transportasi_paket` varchar(19) NOT NULL,
  `id_metode_pembayaran_paket` int(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `maskapai_penerbangan` int(11) NOT NULL,
  `maxPelanggan` int(11) NOT NULL,
  `catatan` text,
  `start_in` varchar(50) DEFAULT NULL,
  `end_ind` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_paket`
--

INSERT INTO `db_paket` (`id_paket`, `kode_paket_data`, `id_layanan`, `lama_perjalanan`, `tanggal_Berakhir`, `tanggal_berangkat`, `tanggal_dibuat`, `id_transportasi_paket`, `id_metode_pembayaran_paket`, `harga`, `maskapai_penerbangan`, `maxPelanggan`, `catatan`, `start_in`, `end_ind`) VALUES
('208190', 'Makan Pempek', 561157227, 3, '2020-07-23', '2020-07-30 05:00:00', '2020-07-14', 'BOT-002', 240570, 2000000, 87922, 30, '', 'Jakarta', 'Palembang'),
('216848', 'Balinighthost', 561157227, 4, '2020-07-13', '2020-07-31 13:00:00', '2020-07-13', 'BOT-002', 669952, 5000000, 41311, 10, 'note catatan', 'Palembang', 'bali'),
('251878', 'haji 12 hari', 749206543, 30, '2020-08-20', '2020-08-22 19:00:00', '2020-07-25', '0', 669952, 27000000, 87922, 30, '<p>mendapat air zam zam mendapatkan makan oleh oleh dari arab saudi mendapatkan asories</p>\r\n', NULL, ''),
('419953', 'haji plus one', 749206543, 10, '2020-07-12', '2020-07-24 17:46:00', '2020-07-20', 'BOT-002', 240570, 25000000, 87922, 20, '<p>makan 3 kali sehari&nbsp;</p>\r\n\r\n<p>bisa mendapatkan buku doasehari sehari</p>\r\n\r\n<p>dapat air zam zam 1 liter dan makan oleh oleh kas arab saudi</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', NULL, ''),
('819943', 'lampung', 561157227, 3, '2020-08-20', '2020-08-23 18:40:00', '2020-07-20', '0', 0, 1295000, 87922, 30, 'paket mendapat banyak gratis perlengkapan \r\nmendapat hadiah menarik dari promosi yang berlangsung\r\ndiscon menarik menarik meranik', 'Palembang', 'lampung'),
('825309', 'beijing', 561157227, 3, '2020-09-20', '2020-09-22 20:00:00', '2020-07-20', 'BOT-3', 669952, 1000000, 88354, 30, 'dpat makan dan minuman\r\nasosories \r\ndiscon belanja  yang bekerja sama\r\n', 'Palembang', 'cina'),
('82552', 'Komodo Rescor', 561157227, 7, '2020-07-24', '2020-08-27 05:00:00', '2020-07-14', 'BOT-002', 240570, 5000000, 40205, 20, '', 'Palembang', 'Maluku'),
('875003', 'lampung', 561157227, 3, '2020-10-21', '2020-10-24 18:58:00', '2020-07-21', 'BOT-4', 669952, 1200000, 41311, 30, 'full ac\r\nwifi\r\nselimut \r\nmakan dan minum\r\nasosorie', 'Palembang', 'lampung'),
('922288', 'sriwijaya', 561157227, 3, '2020-10-21', '2020-10-24 19:10:00', '2020-07-21', 'BOT-4', 669952, 1000000, 74271, 30, 'mendapatkan assoories\r\nmndapatkansarapaN DI HOTEL\r\nWISATA ke pulau kemaro\r\nmakan siang di restoran\r\nmenuju pusat oleh oleh palembang\r\n\r\n', 'Palembang', 'Palembang'),
('94839', 'paket 9 hari', 973785400, 9, '2020-07-31', '2020-08-31 03:00:00', '2020-07-14', 'BOT-002', 240570, 24500000, 83040, 30, '', NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_penerbangan`
--

CREATE TABLE `db_penerbangan` (
  `id` int(11) NOT NULL,
  `kode_penerbangan` varchar(16) NOT NULL,
  `nama_maskapai` varchar(50) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `id_dokumen_kemitraan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_penerbangan`
--

INSERT INTO `db_penerbangan` (`id`, `kode_penerbangan`, `nama_maskapai`, `tanggal_pesan`, `jumlah_kursi`, `id_dokumen_kemitraan`) VALUES
(40205, 'WING-007', 'WING', '2020-06-21', 4, 82692),
(41311, 'citilink-006', 'citilink air', '2020-07-13', 7, 62838),
(74271, 'AIR-001', 'Maskapai', '2020-07-17', 3, 8426),
(83040, 'batik-006', 'batik air', '2020-07-13', 4, 57298),
(87922, 'sriwijaya-003', 'sriwijaya', '2020-07-12', 0, 31209),
(88354, 'garuda-004', 'garuda air', '2020-07-16', 3, 2279),
(92441, 'nam-002', 'nam air', '2020-07-07', 0, 57472);

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_penerbangan_kursi`
--

CREATE TABLE `db_penerbangan_kursi` (
  `id` int(11) NOT NULL,
  `id_penerbangan_kursi` varchar(11) NOT NULL,
  `nomor_kursi` varchar(15) NOT NULL,
  `status_kursi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_penerbangan_kursi`
--

INSERT INTO `db_penerbangan_kursi` (`id`, `id_penerbangan_kursi`, `nomor_kursi`, `status_kursi`) VALUES
(113, '74271', 'a003', 0),
(114, '83040', 'A002', 0),
(115, '83040', 'A001', 0),
(116, '83040', 'K001', 0),
(117, '83040', 'P002', 0),
(118, '41311', 'A001', 1),
(119, '41311', 'N001', 1),
(120, '41311', 'A003', 1),
(121, '41311', 'C001', 0),
(122, '41311', 'T002', 0),
(123, '41311', 'T0021', 0),
(124, '41311', 'N002', 0),
(125, '74271', 'A004', 0),
(126, '74271', 'C002', 0),
(127, '40205', 'A002', 1),
(128, '40205', 'A004', 1),
(129, '40205', 'A001', 0),
(130, '40205', 'A0045', 1),
(131, '88354', 'a0001', 1),
(132, '88354', 'a003', 1),
(133, '88354', 'a002', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_perusahaan`
--

CREATE TABLE `db_perusahaan` (
  `id_perusahaan` varchar(11) NOT NULL,
  `nama_perusahaan` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_telphone` varchar(16) NOT NULL,
  `no_fax` int(11) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `nomor_registrasi` varchar(40) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `logo` text NOT NULL,
  `struktur_organisasi` text NOT NULL,
  `serajarah_perusahaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_perusahaan`
--

INSERT INTO `db_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat`, `no_telphone`, `no_fax`, `email`, `nomor_registrasi`, `visi`, `misi`, `logo`, `struktur_organisasi`, `serajarah_perusahaan`) VALUES
('003-PLG-202', 'Yeka Madira Palembang', 'Jl. Jend. Sudirman No.1051, 20 Ilir D. I, Kec. Ilir Tim. I, Kota Palembang, Sumatera Selatan 30114', '0829371827323', 0, 'ykmandira002@gmail.com', '1293-01-TR-PLG', '<ol>\r\n	<li>Menjadi&nbsp; agen perjalanan dan wisata pilihan di sumatera dan indonesia</li>\r\n	<li>untuk membuat perjalanan internasional dapat diakses oleh orang-orang sumatera</li>\r\n	<li>untuk menyambut pengunjung ke sumatera selatan dan daerah palembang</li>\r\n</ol>\r\n', '<ol>\r\n	<li>untuk memberikan Anda layanan terbaik dalam pemesanan tiket dan hotel dan perjalanan wisata</li>\r\n	<li>Kami melayani cepat dan benar</li>\r\n</ol>\r\n', '0', 'Struktur_Organisasi_2.png', '<p>PT. Lematang didirikan pada tahun 2004 yang disahkan dengan nomor induk berusaha(NIB) 022020719281 dengan nama PT. Yeka Madira yang berkantor di JL. R. Sumanto PTC Block B.2 No 55 Kel. 8 &nbsp;Ilir, kec. Ilir Timur Tiga Palembang, prov. Sumatera Selatan Seiring dengan berkembangannya perusahaan yang semakin maju klasfikasi baku lapangan usaha indonesia(KBLI) Kode&nbsp; KBLI 7911 Aktivitas Agen Perjalanan Wisata KBLI 7920 Aktivitas Perjalanan Wisata KBLI 7990 Jasa Reservasi Lainnya YBDI YTDL.</p>\r\n\r\n<p>PT Yeka Madira menyediakan layanan tiketing dan tour internasional baik untuk pelanggan bisnis maupun untuk pelanggan pribadi kami memiliki 09 orang untuk membantu Anda semua kebutuhan perjalanan Anda kami telah memesan secara langsung ke maskapai-maskapai utama di Indonesia kami bekerja dengan patner perjalanan untuk memenuhi semua kebutuhan perjalanan internasional Anda</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_transportasi_darat`
--

CREATE TABLE `db_transportasi_darat` (
  `id` varchar(11) NOT NULL,
  `nama_bus` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `id_dokumen_kemitraan` int(11) NOT NULL,
  `tanggal_post` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_transportasi_darat`
--

INSERT INTO `db_transportasi_darat` (`id`, `nama_bus`, `kapasitas`, `keterangan`, `id_dokumen_kemitraan`, `tanggal_post`) VALUES
('BOT-002', 'trakindo', 10, '<p>dokumen kerjasama mitra bus sriwijaya bus name</p>\r\n', 11151, '2020-07-12'),
('BOT-2', 'pariwisata', 30, '<p>bus maksimal 30 orang</p>\r\n\r\n<p>banyak hadiah hadiah menarik</p>\r\n', 59500, '2020-07-20'),
('BOT-3', 'buschin', 30, '<p>selimut</p>\r\n\r\n<p>ac</p>\r\n\r\n<p>wifi&nbsp;</p>\r\n\r\n<p>makan minuman</p>\r\n', 90265, '2020-07-20'),
('BOT-4', 'busnovotel', 30, '<p>wifi</p>\r\n\r\n<p>ac</p>\r\n\r\n<p>selimut</p>\r\n\r\n<p>perlengkapan dan lain laain</p>\r\n', 50937, '2020-07-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_pesan_tiket_pelanggan`
--

CREATE TABLE `tb_detail_pesan_tiket_pelanggan` (
  `id` int(11) NOT NULL,
  `id_tiket_pemesanan` text NOT NULL,
  `id_keterangan_tiket` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_tagihan`
--

CREATE TABLE `tb_detail_tagihan` (
  `id_detail_tagihan` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `hal_tagihan` text NOT NULL,
  `id_detail_tagihannya` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_tagihan_tiket`
--

CREATE TABLE `tb_detail_tagihan_tiket` (
  `id_detail_tagiihan` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `nominal` int(50) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokumentasi`
--

CREATE TABLE `tb_dokumentasi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `foto` text NOT NULL,
  `keterangan` text,
  `kategori_dokumentasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_dokumentasi`
--

INSERT INTO `tb_dokumentasi` (`id`, `tanggal`, `foto`, `keterangan`, `kategori_dokumentasi`) VALUES
(96, '2020-07-13', 'foto_tanggal_20200713105629.jpg', '', 2),
(97, '2020-07-13', 'foto_tanggal_20200713105636.jpg', '', 1),
(98, '2020-07-13', 'foto_tanggal_20200713105644.jpg', '', 1),
(102, '2020-07-13', 'foto_tanggal_20200713105712.jpg', 'nusa dua', 3),
(103, '2020-07-13', 'foto_tanggal_20200713105718.jpg', '', 3),
(104, '2020-07-13', 'foto_tanggal_20200713105725.jpg', '', 3),
(105, '2020-07-13', 'foto_tanggal_20200713105730.jpg', '', 3),
(107, '2020-07-13', 'foto_tanggal_20200713105741.jpg', '', 2),
(114, '2020-07-20', 'foto_tanggal_20200720141053.jpg', 'keliling semua kota medapatkan hadiah dan asosries', 3),
(115, '2020-07-20', 'foto_tanggal_20200720141908.jpg', 'keliling ke semua benua ', 3),
(116, '2020-07-20', 'foto_tanggal_20200720142155.png', 'transportasi', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokumen_kemitraan`
--

CREATE TABLE `tb_dokumen_kemitraan` (
  `id_dokumen` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `nilai_kerjasama` int(20) NOT NULL,
  `tanggal_berlaku` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `nama_pemberi_kerjasama` text NOT NULL,
  `file_kemitraan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_dokumen_kemitraan`
--

INSERT INTO `tb_dokumen_kemitraan` (`id_dokumen`, `nama_perusahaan`, `nilai_kerjasama`, `tanggal_berlaku`, `tanggal_berakhir`, `nama_pemberi_kerjasama`, `file_kemitraan`) VALUES
(300, 'bus pariwisata', 17000000, '2020-04-14', '2020-12-04', 'ahmad', 'Dokumen_Kemitraan_Bus_dengan_perusahaanbus_pariwisata.pdf'),
(2279, 'pt garuda air', 600000, '2020-07-17', '2020-07-18', 'dedek', 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaanpt_garuda_air.pdf'),
(4139, 'bus avanza', 1060000, '2020-01-22', '2020-12-30', 'excel', 'Dokumen_Kemitraan_Bus_dengan_perusahaanbus_avanza.pdf'),
(8426, 'Perusahaana', 10000000, '2020-07-26', '2020-08-06', 'Ahamdi Wijaya', 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaanPerusahaan1.pdf'),
(9877, 'medium bus', 1349994, '2020-01-01', '2020-12-30', 'excel', 'Dokumen_Kemitraan_Bus_dengan_perusahaanmedium_bus1.pdf'),
(11151, 'sriwijaya bus', 2000000, '2020-07-12', '2020-07-19', 'ahmadi wijaya', 'Dokumen_Kemitraan_Bus_dengan_perusahaansriwijaya_bus.pdf'),
(24349, 'elegant bus', 1330000, '2020-01-01', '2020-12-30', 'excel', 'Dokumen_Kemitraan_Bus_dengan_perusahaanelegant_bus1.pdf'),
(31209, 'pt sriwijaya', 500000, '2020-07-13', '2020-07-14', 'nanang', 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaanpt_sriwijaya.pdf'),
(43301, 'big bus', 1330000, '2020-01-01', '2020-12-30', 'excel', 'Dokumen_Kemitraan_Bus_dengan_perusahaanbig_bus.pdf'),
(50937, 'busnovotel', 400000, '2020-09-21', '2020-09-24', 'alex', 'Dokumen_Kemitraan_Bus_dengan_perusahaanbusnovotel.pdf'),
(57298, 'pt batik air', 350000, '2020-07-14', '2020-08-15', 'yuhu', 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaanpt_batik_air.pdf'),
(57472, 'pt nam air', 400000, '2020-07-08', '2020-07-09', 'alex', 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaanpt_nam_air.pdf'),
(59500, 'bus pariwisata', 400000, '2020-09-12', '2020-02-15', 'ahmad', 'Dokumen_Kemitraan_Bus_dengan_perusahaanbus_pariwisata.pdf'),
(62838, 'pt citilink air', 450000, '2020-07-14', '2020-07-16', 'oke', 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaanpt_citilink_air.pdf'),
(78390, 'medium', 1550000, '2020-01-01', '2020-12-01', 'excel', 'Dokumen_Kemitraan_Bus_dengan_perusahaanmedium.pdf'),
(82692, 'PT WINGS AIR', 200000, '2020-06-22', '2020-06-22', 'ELEK', 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaanPT_WINGS_AIR.pdf'),
(90265, 'buschin', 400000, '2020-10-22', '2020-10-24', 'julianto', 'Dokumen_Kemitraan_Bus_dengan_perusahaanbuschin.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_file_tiket`
--

CREATE TABLE `tb_file_tiket` (
  `id` int(11) NOT NULL,
  `id_pemesanan` varchar(50) NOT NULL,
  `nomor_tiket` varchar(30) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hotel_paket`
--

CREATE TABLE `tb_hotel_paket` (
  `id` int(11) NOT NULL,
  `id_paket_hotel` int(11) NOT NULL,
  `rules_hotel` varchar(30) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_hotel_paket`
--

INSERT INTO `tb_hotel_paket` (`id`, `id_paket_hotel`, `rules_hotel`, `id_hotel`) VALUES
(20, 419953, '1', 13),
(21, 216848, '1', 13),
(22, 94839, '1', 12),
(23, 208190, '1', 11),
(24, 82552, '1', 12),
(25, 819943, '1', 11),
(26, 251878, '1', 14),
(27, 825309, '0', 13),
(28, 875003, '1', 18),
(29, 922288, '1', 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_image_slide`
--

CREATE TABLE `tb_image_slide` (
  `id` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `created` date NOT NULL,
  `action` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_image_slide`
--

INSERT INTO `tb_image_slide` (`id`, `image`, `created`, `action`) VALUES
(1, 114, '2020-07-25', 1),
(2, 115, '2020-07-25', 1),
(3, 116, '2020-07-25', 1),
(4, 102, '2020-07-25', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keberangakatan`
--

CREATE TABLE `tb_keberangakatan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `paket_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_keberangakatan`
--

INSERT INTO `tb_keberangakatan` (`id`, `id_pelanggan`, `paket_id`) VALUES
(1, 54, ''),
(41, 54, '251878'),
(42, 59, ''),
(43, 59, '419953');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keterangan_harga_tiket`
--

CREATE TABLE `tb_keterangan_harga_tiket` (
  `id_tiket_data` varchar(40) NOT NULL,
  `level` int(1) NOT NULL,
  `harga` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keterangan_metode_pembayaran`
--

CREATE TABLE `tb_keterangan_metode_pembayaran` (
  `id` int(11) NOT NULL,
  `id_metode_pembayaran` int(11) NOT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_keterangan_metode_pembayaran`
--

INSERT INTO `tb_keterangan_metode_pembayaran` (`id`, `id_metode_pembayaran`, `bank_name`, `tanggal_dibuat`, `keterangan`) VALUES
(47, 240570, 'bca', '2020-07-18', 'bank bca dengan no 119-3493-399 atas nama yeka madira'),
(48, 240570, 'bri', '2020-07-18', 'bank bra dengan no 119-3493-399 atas nama yeka madira'),
(49, 240570, 'yeka madira', '2020-07-18', 'langsung bayar di kantor'),
(50, 669952, 'bca', '2020-07-23', 'TF KE 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_normatif_promo_layanan`
--

CREATE TABLE `tb_normatif_promo_layanan` (
  `id_promo` varchar(16) NOT NULL,
  `id_note_layanan` int(11) NOT NULL,
  `harga_normal_data` int(20) NOT NULL,
  `tanggal_post` date NOT NULL,
  `status_promo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_normatif_promo_layanan`
--

INSERT INTO `tb_normatif_promo_layanan` (`id_promo`, `id_note_layanan`, `harga_normal_data`, `tanggal_post`, `status_promo`) VALUES
('PPK-242975', 819943, 2000000, '2020-07-21', 1),
('PPK-380929', 208190, 2200000, '2020-07-17', 1),
('PPK-388490', 922288, 1500000, '2020-07-21', 1),
('PPK-777627', 94839, 26000000, '2020-07-18', 1),
('PPK-811925', 825309, 2000000, '2020-07-21', 1),
('PPK-861924', 419953, 26000000, '2020-07-17', 1),
('PPK-926556', 82552, 6500000, '2020-07-18', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_panduan`
--

CREATE TABLE `tb_panduan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_kategori` varchar(4) NOT NULL,
  `keterangan` text NOT NULL,
  `note_idText` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_panduan`
--

INSERT INTO `tb_panduan` (`id`, `tanggal`, `id_kategori`, `keterangan`, `note_idText`) VALUES
(15, '2020-07-12 13:37:30', 'TU', '<p>lorem ipsun data post&nbsp;</p>\r\n\r\n<p>lorem ipsun data post&nbsp;</p>\r\n\r\n<p>lorem ipsun data post&nbsp;</p>\r\n\r\n<p>lorem ipsun data post&nbsp;lorem ipsun data post&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'Pendaftaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) NOT NULL,
  `id_akses_data` int(11) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `emails` varchar(50) NOT NULL,
  `nomor_telphone` varchar(16) NOT NULL,
  `nomor_wa` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `pekerjaan` int(1) DEFAULT NULL,
  `ahli_hakim_id` varchar(50) DEFAULT NULL,
  `status_data_keluarga` int(1) DEFAULT NULL,
  `id_file_dokumen` int(11) DEFAULT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id`, `id_akses_data`, `no_ktp`, `nama_lengkap`, `no_kk`, `emails`, `nomor_telphone`, `nomor_wa`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `pekerjaan`, `ahli_hakim_id`, `status_data_keluarga`, `id_file_dokumen`, `tgl_daftar`) VALUES
(53, 5006, '1671199005570003', 'ajeng kartika', '1671199005570003', 'ajeng_kartika@gmail.com', '0876728362837', '876728362837', 'jalan.OR.Misa no.92', 'palembang', '1996-06-19', 2, 2, 'ahmadi wijaya', 1, 818998, '2020-07-05'),
(54, 20641, '1671199336670003', 'nanda marlina', '1671199336670001', 'nanda_marlina12@gmail.com', '0812768493739', '812768493739', 'jalan sultan syahrid no 1556', 'palembang', '1997-01-15', 2, 2, 'yanto', 2, 549096, '2020-07-05'),
(56, 861527, '1671100407710004', 'andini rianti', '1671100407710001', 'andini@gmail.com', '081274837837', '81274837837', 'jalan perintis kemerdekaan', 'palembang', '1993-06-19', 2, 0, 'ahmadi wijaya', 1, 473579, '2020-04-12'),
(57, 161270, '1671199330070003', 'ahmad wijaya', '1671199330070003', 'ahmadi_wijaya@gmail.com', '081274638374', '81274638374', 'jalan veteran', 'palembang', '1989-06-24', 1, 0, 'marlina', 2, 28804, '2020-07-06'),
(58, 568669, '1671100789970004', 'riandi wijaya', '1671100789970004', 'Rusydieamin@gmail.com', '0812748373484', '812748373484', 'jalan residen abdul rozak', 'jambi', '1999-10-15', 1, NULL, NULL, NULL, 849241, '2020-05-03'),
(59, 901099, '1671019293847560', 'Fenty', '1671908765432176', 'fentypratiwi@gmail.com', '081234567890', '81234567890', 'jln gersik no.101', 'banyuasin', '1991-12-12', 2, 0, 'iqbaal', 1, 521200, '2020-03-16'),
(60, 767902, '1671091234567890', 'hani', '1671098765432123', 'hanihanafiah@gmail.com', '089845678909', '89845678909', 'lrg bening sari', 'jambi', '2010-08-08', 2, NULL, NULL, NULL, 843479, '2020-07-06'),
(62, 679062, '1671002244112233', 'laila', '1671002244112233', 'laila23@gmail.com', '081365227785', '081365227785', 'jalan rawasari', 'palembang', '1988-09-13', 2, 0, 'siti', 3, 939757, '2020-07-20'),
(63, 692720, '1671200033221156', 'lina', '1671200033221111', 'lina22@gmail.com', '081356332211', '081356332211', 'jalan', 'palembang', '1998-08-22', 2, NULL, NULL, NULL, 820736, '2020-03-15'),
(72, 291328, '0671992211446677', 'lila', '0671992211446679', 'lila@gmail.com', '08132277662231', '08132277662233', 'jalan', 'palembang', '2020-09-12', 2, 0, 'nanda', 1, 286907, '2020-07-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemasanan_paket`
--

CREATE TABLE `tb_pemasanan_paket` (
  `id` int(11) NOT NULL,
  `id_pemesanan` varchar(50) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pemasanan_paket`
--

INSERT INTO `tb_pemasanan_paket` (`id`, `id_pemesanan`, `id_paket`, `id_pelanggan`, `tanggal_pesan`, `status`) VALUES
(41, 'Ap-77579', 251878, 54, '2020-07-25 04:42:59', 3),
(42, 'Ap-52433', 94839, 62, '2020-07-25 04:43:20', 1),
(43, 'Ap-1558', 419953, 59, '2020-07-25 04:43:29', 3),
(44, 'Ap-72923', 251878, 53, '2020-07-25 04:43:34', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perlengkapan_paket`
--

CREATE TABLE `tb_perlengkapan_paket` (
  `id` int(11) NOT NULL,
  `id_perlengkapan_paket` int(11) NOT NULL,
  `id_kelengkapan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_perlengkapan_paket`
--

INSERT INTO `tb_perlengkapan_paket` (`id`, `id_perlengkapan_paket`, `id_kelengkapan`, `jumlah`) VALUES
(60, 419953, 68484, 1),
(61, 419953, 922, 1),
(62, 419953, 48718, 1),
(63, 216848, 41257, 1),
(64, 94839, 68484, 1),
(65, 94839, 41257, 1),
(66, 94839, 83452, 1),
(67, 208190, 83452, 1),
(68, 82552, 41257, 1),
(69, 82552, 922, 2),
(70, 819943, 41257, 1),
(71, 819943, 40216, 1),
(72, 819943, 80430, 1),
(73, 251878, 68484, 1),
(74, 251878, 922, 1),
(75, 251878, 41257, 1),
(76, 251878, 48718, 2),
(77, 251878, 80430, 1),
(78, 251878, 83452, 2),
(79, 251878, 40216, 1),
(80, 825309, 41257, 1),
(81, 875003, 41257, 1),
(82, 875003, 922, 1),
(83, 922288, 41257, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesan_tiket`
--

CREATE TABLE `tb_pesan_tiket` (
  `id_pesan_tiket_data` varchar(50) NOT NULL,
  `id_tiket_data_pesan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `waktu_pesan` time NOT NULL,
  `status` int(11) NOT NULL,
  `id_tiket_pesawat_data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_promo_image`
--

CREATE TABLE `tb_promo_image` (
  `id` int(11) NOT NULL,
  `id_promo` varchar(30) NOT NULL,
  `image_file` text NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_promo_image`
--

INSERT INTO `tb_promo_image` (`id`, `id_promo`, `image_file`, `created`) VALUES
(56, 'PPK-380929', 'foto_PPK-380929.jpg', '2020-07-17'),
(57, 'PPK-380929', 'foto_PPK-3809291.jpg', '2020-07-17'),
(58, 'PPK-380929', 'foto_PPK-3809292.jpg', '2020-07-17'),
(59, 'PPK-861924', 'foto_PPK-861924.jpg', '2020-07-17'),
(60, 'PPK-861924', 'foto_PPK-8619241.jpg', '2020-07-17'),
(61, 'PPK-861924', 'foto_PPK-8619242.jpg', '2020-07-17'),
(62, 'PPK-777627', 'foto_PPK-777627.jpg', '2020-07-18'),
(63, 'PPK-777627', 'foto_PPK-7776271.jpg', '2020-07-18'),
(64, 'PPK-777627', 'foto_PPK-7776272.jpg', '2020-07-18'),
(65, 'PPK-926556', 'foto_PPK-926556.jpg', '2020-07-18'),
(66, 'PPK-926556', 'foto_PPK-9265561.jpg', '2020-07-18'),
(68, 'PPK-926556', 'foto_PPK-9265562.jpg', '2020-07-18'),
(69, 'PPK-242975', 'foto_PPK-242975.jpg', '2020-07-21'),
(70, 'PPK-242975', 'foto_PPK-2429751.jpg', '2020-07-21'),
(71, 'PPK-388490', 'foto_PPK-388490.jpg', '2020-07-21'),
(72, 'PPK-388490', 'foto_PPK-3884901.jpg', '2020-07-21'),
(73, 'PPK-811925', 'foto_PPK-811925.jpg', '2020-07-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tagihan_pembayaran`
--

CREATE TABLE `tb_tagihan_pembayaran` (
  `id` int(11) NOT NULL,
  `kode_pemesanan` varchar(50) NOT NULL,
  `nomor_tagihan` varchar(50) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tagihan_pembayaran`
--

INSERT INTO `tb_tagihan_pembayaran` (`id`, `kode_pemesanan`, `nomor_tagihan`, `nominal`, `keterangan`) VALUES
(13, 'Ap-77579', 'A-35318-25072020', 27000000, 'Tagihan Awal Pembayawan'),
(14, 'Ap-1558', 'A-28191-25072020', 25000000, 'Tagihan Awal Pembayawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tagihan_tiketing`
--

CREATE TABLE `tb_tagihan_tiketing` (
  `id` int(11) NOT NULL,
  `id_tagihannya` int(30) NOT NULL,
  `jumlah_uang` int(20) NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tiket_yeka_madira`
--

CREATE TABLE `tb_tiket_yeka_madira` (
  `id_tiket_YKM` int(11) NOT NULL,
  `id_penerbangan` int(16) NOT NULL,
  `kode_pesawat` varchar(50) NOT NULL,
  `id_data_tiket` varchar(25) NOT NULL,
  `waktu_berangkat` time NOT NULL,
  `hari` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `to` varchar(50) NOT NULL,
  `form` varchar(50) NOT NULL,
  `bandara1` varchar(50) NOT NULL,
  `bandara2` varchar(50) NOT NULL,
  `Jumlah_tiket` int(11) NOT NULL,
  `session_karyawan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tiket_yeka_madira`
--

INSERT INTO `tb_tiket_yeka_madira` (`id_tiket_YKM`, `id_penerbangan`, `kode_pesawat`, `id_data_tiket`, `waktu_berangkat`, `hari`, `tanggal`, `to`, `form`, `bandara1`, `bandara2`, `Jumlah_tiket`, `session_karyawan_id`) VALUES
(7, 40205, 'JKT-A0012', 'TP-YK-10773', '13:00:00', 'Selasa', '2020-07-14', 'Palembang', 'Bali', 'I Gusti Ngurah Rai', 'SMB II', 0, 31424),
(8, 40205, 'Plg-002', 'TP-YK-47116', '18:00:00', 'Rabu', '2020-07-15', 'Palembang', 'Jakarta', 'Soekarno Hata', 'SMB II', 0, 31424),
(9, 41311, 'JKT-A002', 'TP-YK-65464', '18:00:00', 'Rabu', '2020-07-15', 'Palembang', 'Jakarta', 'Soekarno Hatta', 'SMB II', 0, 31424),
(10, 41311, 'PLG-A003', 'TP-YK-59098', '15:00:00', 'Kamis', '2020-07-16', 'Palembang', 'Jakarta', 'Soekarno Hata', 'SMB II', 0, 31424),
(11, 88354, 'PLG-JKT02', 'TP-YK-27898', '03:17:00', 'Jumat', '2020-07-31', 'Jakarta', 'Palembang', 'SMB II', 'Soekarno Hatta', 0, 31424),
(12, 41311, 'BAL-KLT-03', 'TP-YK-26487', '01:18:00', 'Rabu', '2020-07-29', 'Pontianak', 'Bali', 'I Gusti Ngurah Rai', 'Raden Intan', 0, 31424),
(13, 92441, 'RIU-JKS-003', 'TP-YK-13462', '06:20:00', 'Jumat', '2020-07-31', 'Jakarta', 'Riau', 'Raden Patah', 'Soekarno', 0, 31424);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `db_akses`
--
ALTER TABLE `db_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `db_data_akses`
--
ALTER TABLE `db_data_akses`
  ADD PRIMARY KEY (`id_data_akses`),
  ADD UNIQUE KEY `id_akses` (`id_akses`),
  ADD UNIQUE KEY `nomor_telephone` (`nomor_telephone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nomor_darurat` (`nomor_darurat`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`),
  ADD UNIQUE KEY `id_file_identitas` (`id_file_identitas`);

--
-- Indeks untuk tabel `db_file`
--
ALTER TABLE `db_file`
  ADD PRIMARY KEY (`id_file_identitas`);

--
-- Indeks untuk tabel `db_histori_layanan`
--
ALTER TABLE `db_histori_layanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_layanan` (`id_layanan`);

--
-- Indeks untuk tabel `db_hotel`
--
ALTER TABLE `db_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `db_kelengkapan_data`
--
ALTER TABLE `db_kelengkapan_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_kelengkapandata` (`id_kelengkapandata`);

--
-- Indeks untuk tabel `db_layanan`
--
ALTER TABLE `db_layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `db_level`
--
ALTER TABLE `db_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `db_metode_pembayaran`
--
ALTER TABLE `db_metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

--
-- Indeks untuk tabel `db_paket`
--
ALTER TABLE `db_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `db_penerbangan`
--
ALTER TABLE `db_penerbangan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_penerbangan` (`kode_penerbangan`),
  ADD UNIQUE KEY `id_dokumen_kemitraan` (`id_dokumen_kemitraan`),
  ADD KEY `nama_maskapi` (`nama_maskapai`),
  ADD KEY `kode_penerbangan_2` (`kode_penerbangan`);

--
-- Indeks untuk tabel `db_penerbangan_kursi`
--
ALTER TABLE `db_penerbangan_kursi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penerbangan_kursi` (`id_penerbangan_kursi`);

--
-- Indeks untuk tabel `db_perusahaan`
--
ALTER TABLE `db_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indeks untuk tabel `db_transportasi_darat`
--
ALTER TABLE `db_transportasi_darat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_dokumen_kemitraan` (`id_dokumen_kemitraan`);

--
-- Indeks untuk tabel `tb_detail_pesan_tiket_pelanggan`
--
ALTER TABLE `tb_detail_pesan_tiket_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_detail_tagihan`
--
ALTER TABLE `tb_detail_tagihan`
  ADD PRIMARY KEY (`id_detail_tagihannya`);

--
-- Indeks untuk tabel `tb_detail_tagihan_tiket`
--
ALTER TABLE `tb_detail_tagihan_tiket`
  ADD PRIMARY KEY (`id_detail_tagiihan`);

--
-- Indeks untuk tabel `tb_dokumentasi`
--
ALTER TABLE `tb_dokumentasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_dokumen_kemitraan`
--
ALTER TABLE `tb_dokumen_kemitraan`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indeks untuk tabel `tb_file_tiket`
--
ALTER TABLE `tb_file_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_hotel_paket`
--
ALTER TABLE `tb_hotel_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_image_slide`
--
ALTER TABLE `tb_image_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_keberangakatan`
--
ALTER TABLE `tb_keberangakatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_keterangan_harga_tiket`
--
ALTER TABLE `tb_keterangan_harga_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_keterangan_metode_pembayaran`
--
ALTER TABLE `tb_keterangan_metode_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete_metode` (`id_metode_pembayaran`);

--
-- Indeks untuk tabel `tb_normatif_promo_layanan`
--
ALTER TABLE `tb_normatif_promo_layanan`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indeks untuk tabel `tb_panduan`
--
ALTER TABLE `tb_panduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`),
  ADD UNIQUE KEY `id_akses_data` (`id_akses_data`);

--
-- Indeks untuk tabel `tb_pemasanan_paket`
--
ALTER TABLE `tb_pemasanan_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_perlengkapan_paket`
--
ALTER TABLE `tb_perlengkapan_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pesan_tiket`
--
ALTER TABLE `tb_pesan_tiket`
  ADD PRIMARY KEY (`id_pesan_tiket_data`);

--
-- Indeks untuk tabel `tb_promo_image`
--
ALTER TABLE `tb_promo_image`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tagihan_pembayaran`
--
ALTER TABLE `tb_tagihan_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_tagihan` (`nomor_tagihan`);

--
-- Indeks untuk tabel `tb_tagihan_tiketing`
--
ALTER TABLE `tb_tagihan_tiketing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tiket_yeka_madira`
--
ALTER TABLE `tb_tiket_yeka_madira`
  ADD PRIMARY KEY (`id_tiket_YKM`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `db_data_akses`
--
ALTER TABLE `db_data_akses`
  MODIFY `id_data_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `db_histori_layanan`
--
ALTER TABLE `db_histori_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `db_hotel`
--
ALTER TABLE `db_hotel`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `db_kelengkapan_data`
--
ALTER TABLE `db_kelengkapan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `db_layanan`
--
ALTER TABLE `db_layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=973785401;

--
-- AUTO_INCREMENT untuk tabel `db_penerbangan`
--
ALTER TABLE `db_penerbangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92442;

--
-- AUTO_INCREMENT untuk tabel `db_penerbangan_kursi`
--
ALTER TABLE `db_penerbangan_kursi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_pesan_tiket_pelanggan`
--
ALTER TABLE `tb_detail_pesan_tiket_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_tagihan`
--
ALTER TABLE `tb_detail_tagihan`
  MODIFY `id_detail_tagihannya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_tagihan_tiket`
--
ALTER TABLE `tb_detail_tagihan_tiket`
  MODIFY `id_detail_tagiihan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_dokumentasi`
--
ALTER TABLE `tb_dokumentasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `tb_dokumen_kemitraan`
--
ALTER TABLE `tb_dokumen_kemitraan`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90266;

--
-- AUTO_INCREMENT untuk tabel `tb_file_tiket`
--
ALTER TABLE `tb_file_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_hotel_paket`
--
ALTER TABLE `tb_hotel_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_image_slide`
--
ALTER TABLE `tb_image_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_keberangakatan`
--
ALTER TABLE `tb_keberangakatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `tb_keterangan_harga_tiket`
--
ALTER TABLE `tb_keterangan_harga_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_keterangan_metode_pembayaran`
--
ALTER TABLE `tb_keterangan_metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `tb_panduan`
--
ALTER TABLE `tb_panduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `tb_pemasanan_paket`
--
ALTER TABLE `tb_pemasanan_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `tb_perlengkapan_paket`
--
ALTER TABLE `tb_perlengkapan_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `tb_promo_image`
--
ALTER TABLE `tb_promo_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `tb_tagihan_pembayaran`
--
ALTER TABLE `tb_tagihan_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_tagihan_tiketing`
--
ALTER TABLE `tb_tagihan_tiketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_tiket_yeka_madira`
--
ALTER TABLE `tb_tiket_yeka_madira`
  MODIFY `id_tiket_YKM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `db_data_akses`
--
ALTER TABLE `db_data_akses`
  ADD CONSTRAINT `db_data_akses_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `db_akses` (`id_akses`),
  ADD CONSTRAINT `db_data_akses_ibfk_2` FOREIGN KEY (`id_file_identitas`) REFERENCES `db_file` (`id_file_identitas`);

--
-- Ketidakleluasaan untuk tabel `tb_keterangan_metode_pembayaran`
--
ALTER TABLE `tb_keterangan_metode_pembayaran`
  ADD CONSTRAINT `delete_metode` FOREIGN KEY (`id_metode_pembayaran`) REFERENCES `db_metode_pembayaran` (`id_metode_pembayaran`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
