-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2024 at 12:07 PM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u144635195_simodip`
--

-- --------------------------------------------------------

--
-- Table structure for table `aspek_program`
--

CREATE TABLE `aspek_program` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aspek_program`
--

INSERT INTO `aspek_program` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Literasi Numerasi dan Karakter', 1, NULL, NULL),
(2, 'PTK', 1, NULL, NULL),
(3, 'Manajerial Kepala Sekolah', 1, NULL, NULL),
(4, 'Partisipasi Warga Satuan Pendidikan', 1, NULL, NULL),
(5, 'Tematik Dinas Pendidikan', 1, NULL, NULL),
(6, 'RB Tematik Stunting', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru_m`
--

CREATE TABLE `guru_m` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sekolah_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `kode_area` int(11) DEFAULT NULL,
  `jabatan` varchar(255) NOT NULL DEFAULT 'Guru',
  `is_aktif` tinyint(1) DEFAULT 1,
  `kabupaten_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru_m`
--

INSERT INTO `guru_m` (`id`, `sekolah_id`, `nama`, `no_telp`, `kota`, `alamat_lengkap`, `kode_area`, `jabatan`, `is_aktif`, `kabupaten_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Siti Badriah S.P.D', '0881026697527', 'Yogjakarta', 'Desa Magelang RT 10 210', 42132, 'Guru', 1, 1, NULL, NULL),
(2, 1, 'Prof Abdullah S.P.D', '0881026697527', 'Yogjakarta', 'Desa Kulon RT 20 RW 10', 35433, 'Kepala Sekolah', 1, 1, NULL, NULL),
(3, 4, 'Sunariah', '0881026697527', NULL, 'Serang', NULL, 'Kepala Sekolah', 1, 3, '2024-03-28 02:48:17', '2024-03-28 02:48:17'),
(4, 4, 'Hani Haeroni', '0881026697527', NULL, 'Padarincang', NULL, 'Guru', 1, 3, '2024-03-28 02:49:08', '2024-03-28 02:49:08'),
(5, 25, 'Andi Bakhtiar', '087808505606', NULL, 'Serang', NULL, 'Guru', 1, 3, '2024-03-28 03:03:13', '2024-03-28 03:03:13'),
(6, 25, 'Untung Supriyanto', '087771361002', NULL, 'serang', NULL, 'Kepala Sekolah', 1, 3, '2024-03-28 03:03:56', '2024-03-28 03:03:56'),
(7, 25, 'Agus Santosa', '087838598853', NULL, 'serang', NULL, 'Guru', 1, 3, '2024-03-28 03:04:48', '2024-03-28 03:04:48'),
(8, 26, 'Endang Tirtana', '081287599838', 'kab tanggerang', 'PERUM LEGOK INDAH', 15157, 'Kepala Sekolah', 1, 6, '2024-10-16 01:24:45', '2024-10-16 01:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_program`
--

CREATE TABLE `jenis_program` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_program`
--

INSERT INTO `jenis_program` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pendampingan', 1, NULL, NULL),
(2, 'Monev', 1, NULL, NULL),
(3, 'Bimtek / Seminar / Sosialisasi', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategory`
--

CREATE TABLE `kategory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategory`
--

INSERT INTO `kategory` (`id`, `nama`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Program Reguler', 'perencanaan', NULL, NULL),
(2, 'Program Tematik', 'perencanaan', NULL, NULL),
(4, 'Laporan Reguler', 'pelaporan', NULL, NULL),
(5, 'Laporan Tematik', 'pelaporan', NULL, NULL),
(6, 'Laporan Dengan Kondisi Khusus', 'pelaporan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lampiran`
--

CREATE TABLE `lampiran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelaporan` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_kabupaten`
--

CREATE TABLE `master_kabupaten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kabupaten` varchar(255) DEFAULT NULL,
  `kelompok_kabupaten` varchar(255) DEFAULT NULL,
  `is_aktif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_kabupaten`
--

INSERT INTO `master_kabupaten` (`id`, `nama_kabupaten`, `kelompok_kabupaten`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Kota Serang', 'Wilayah Seragon', 1, NULL, NULL),
(2, 'Kota Cilegon', 'Wilayah Seragon', 1, NULL, NULL),
(3, 'Kab Serang', 'Wilayah Seragon', 1, NULL, NULL),
(4, 'Kab Pandeglang', 'Wilayah Pandeglang', 1, NULL, NULL),
(5, 'Kab Lebak', 'Wilayah Lebak', 1, NULL, NULL),
(6, 'Kab Tangerang', 'Wilayah Kab Tangerang', 1, NULL, NULL),
(7, 'Kota Tangerang', 'Wilayah Tangerang', 1, NULL, NULL),
(8, 'Kota Tangerang Selatan', 'Wilayah Tangerang', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_tupoksi`
--

CREATE TABLE `master_tupoksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `sub_kegiatan` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_tupoksi`
--

INSERT INTO `master_tupoksi` (`id`, `tahun_ajaran`, `semester`, `kegiatan`, `id_kegiatan`, `sub_kegiatan`, `urutan`, `created_at`, `updated_at`) VALUES
(1, '2024', 'I', 'Menusun Program Pengawasan Tahunan', NULL, NULL, 1, NULL, NULL),
(2, '2024', 'I', 'Melaksanakan Pembinaan guru dan/atau Kepala Sekolah', NULL, NULL, 2, NULL, NULL),
(3, '2024', 'I', 'Melaksanakan Pemantauan pelaksanaan 8 SNP', NULL, NULL, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_18_132841_create_profiles_table', 1),
(4, '2023_07_09_040601_create_profilemarketpalces_table', 1),
(5, '2023_08_05_145659_create_guru_m_s_table', 1),
(6, '2023_08_05_145834_create_sekolah_m_s_table', 1),
(7, '2023_08_13_023116_create_master_kabupaten', 1),
(8, '2023_08_28_125924_create_master_tupoksi', 1),
(9, '2023_09_06_005223_create_table_gol_pangkat_ruang', 1),
(10, '2024_02_15_123549_create_sekolahbinaan_t_table', 1),
(11, '2024_02_15_124409_create_tugaskerja_t_table', 1),
(12, '2024_02_15_124546_create_umpanbalik_m_table', 1),
(13, '2024_02_15_124602_create_umpanbalik_t_table', 1),
(14, '2024_02_29_133332_create_table_pelaporan', 1),
(15, '2024_03_03_112600_create_lampiran_table', 1),
(16, '2024_03_03_114058_create_kategory_table', 1),
(17, '2024_03_03_114119_create_sub_kategory_table', 1),
(18, '2024_03_04_160411_create_tanggapan_umpanbalik_table', 1),
(19, '2024_03_07_101724_create_rencakakerja_t_table', 1),
(20, '2024_10_24_132541_create_jenis_program_table', 2),
(21, '2024_10_24_132934_create_aspek_program_table', 3),
(22, '2024_10_24_141257_add_column_to_rencanakerja_t_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengawas` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `sub_kategori` varchar(255) DEFAULT NULL,
  `judul` text NOT NULL,
  `sasaran` varchar(255) NOT NULL,
  `object` varchar(255) DEFAULT NULL,
  `tgl_pendampingan` date NOT NULL,
  `deskripsi_permasalahan` text DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `catatan_evaluasi` text DEFAULT NULL,
  `saran_rekomendasi` text DEFAULT NULL,
  `akses` text DEFAULT NULL,
  `disposisi` date DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelaporan`
--

INSERT INTO `pelaporan` (`id`, `id_pengawas`, `kategori`, `sub_kategori`, `judul`, `sasaran`, `object`, `tgl_pendampingan`, `deskripsi_permasalahan`, `uraian`, `catatan_evaluasi`, `saran_rekomendasi`, `akses`, `disposisi`, `lampiran`, `created_at`, `updated_at`) VALUES
(1, 13, '4', '2', 'Ujicoba Aplikasi Monitoring Online', 'Sekolah', '4', '2024-03-28', NULL, NULL, '<p>Sekolah dapat mengembangkan ……</p>', NULL, NULL, NULL, 'lampiran20240328025129_Z6CCRsootw.jpeg', '2024-03-28 02:51:29', '2024-03-28 02:51:29'),
(2, 14, '4', '3', 'Ujicoba Aplikasi Monitoring Online', 'Sekolah', '25', '2024-03-28', NULL, NULL, NULL, NULL, NULL, NULL, 'lampiran20240328031406_dP9BSVC1zZ.jpg', '2024-03-28 03:14:06', '2024-03-28 03:14:06'),
(3, 14, '4', '3', 'Ujicoba Aplikasi Monitoring Online', 'Guru', '5', '2024-03-28', NULL, NULL, '<p>jjndjsndasds</p>', '<p>lkkndaldnasds</p>', NULL, NULL, 'lampiran20240328031524_vZFqcqT0uW.jpg', '2024-03-28 03:15:24', '2024-03-28 03:15:24'),
(4, 14, '4', '3', 'monitoring uji kompetensi', 'Guru', '5', '2024-03-28', NULL, NULL, NULL, NULL, NULL, NULL, 'lampiran20240328052836_um7rVGNv5g.jpg', '2024-03-28 05:28:36', '2024-03-28 05:28:36'),
(5, 14, '4', '3', 'monitoring uji kompetensi', 'Guru', '7', '2024-03-31', NULL, NULL, '<p>KJDSFKJSFJK &nbsp;asdfjsdfjnkj</p>', '<p>lsakjflkaskd asfkas dasflda fsao</p>', NULL, NULL, 'lampiran20240331160009_hIvyNmtWLQ.png', '2024-03-31 16:00:09', '2024-03-31 16:00:09'),
(6, 14, '4', '3', 'ad', 'Guru', '5', '2024-04-02', NULL, NULL, '<p>ada</p>', '<p>ada</p>', NULL, NULL, 'lampiran20240401070449_MwaOgv7lXt.pdf', '2024-04-01 07:04:49', '2024-04-01 07:04:49'),
(7, 14, '4', '4', 'monitoring kesiapan sekolah pasca libur', 'Sekolah', '25', '2024-04-18', NULL, NULL, NULL, NULL, NULL, NULL, 'lampiran20240418035717_kPfuJsHO8M.jpg', '2024-04-18 03:57:17', '2024-04-18 03:57:17'),
(8, 14, '4', '3', 'test', 'Guru', '7', '2024-04-25', NULL, NULL, '<p>test</p>', '<p>test</p>', NULL, NULL, 'lampiran20240425073934_sjbiJm20ax.pdf', '2024-04-25 07:39:34', '2024-04-25 07:39:34'),
(9, 2, '4', '5', 'judul pelaporan 1', 'Guru', '4', '2024-10-01', NULL, NULL, '<p>evaluasi&nbsp;</p>', '<p>saran&nbsp;</p>', NULL, NULL, 'lampiran20240930130150_ijiI13PWQg.pdf', '2024-09-30 13:01:50', '2024-09-30 13:01:50'),
(10, 2, '4', '5', 'Testing Laporan', 'Guru', '4', '2024-10-06', NULL, NULL, '<p>catatan dan evaluasi</p>', '<p>saran dan rekomendasi</p>', NULL, NULL, 'lampiran20241006113240_QjNSoatAIe.pdf', '2024-10-06 11:32:40', '2024-10-06 11:32:40'),
(11, 2, '4', '5', 'test 3', 'Sekolah', '4', '2024-10-09', NULL, NULL, '<p>Catatan dan Evaluasi</p>', '<p>Saran dan Rekomendasi</p>', NULL, NULL, 'lampiran20241008012555_w3oOl3rh5U.pdf', '2024-10-08 01:25:55', '2024-10-08 01:25:55'),
(12, 2, '4', '5', 'test 4', 'Guru', '4', '2024-10-09', NULL, NULL, '<p>Catatan dan Evaluasi</p><p>Paragraph</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', '<p>Saran dan Rekomendasi</p>', NULL, NULL, 'lampiran20241008012840_2DwtmTe50w.xls', '2024-10-08 01:28:40', '2024-10-08 01:28:40'),
(13, 2, '4', '5', 'Judul Laporan', 'Guru', '4', '2024-10-08', NULL, NULL, '<p>Deskripsikan permasalahan</p><p>Paragraph</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', '<p>Deskripsikan permasalahan</p><p>Paragraph</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', NULL, NULL, 'lampiran20241008013922_vtJQJFQX4Z.xls', '2024-10-08 01:39:22', '2024-10-08 01:39:22'),
(15, 2, '4', '5', 'test 5', 'Guru', '4', '2024-10-09', NULL, NULL, '<p>Deskripsikan permasalahan</p><p>Paragraph</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', '<p>Deskripsikan permasalahan</p><p>Paragraph</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', NULL, NULL, 'lampiran20241008033502_XvqN7ORN2P.xls', '2024-10-08 03:35:02', '2024-10-08 03:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `profilemarketpalces`
--

CREATE TABLE `profilemarketpalces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `diskripsi` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `telpon` text DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `social1` varchar(255) DEFAULT NULL,
  `social2` varchar(255) DEFAULT NULL,
  `social3` varchar(255) DEFAULT NULL,
  `social4` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profilemarketpalces`
--

INSERT INTO `profilemarketpalces` (`id`, `title`, `diskripsi`, `address`, `telpon`, `zipcode`, `email`, `social1`, `social2`, `social3`, `social4`, `logo`, `favicon`, `kota`, `created_at`, `updated_at`) VALUES
(1, 'Sistem MoDiP', 'by Andi B Fransiska', 'Jogjakarta', '0813242424', 3055, 'hasanarofid@gitatalavial.com', 'facebok.com/gitatalavial', 'instagram.com/gitatalavial', 'theards.com/gitatalavial', 'twitter.com/gitatalavial', 'logogita.jpeg', 'logogita.jpeg', 'Yogjakarta', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `homepage` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `kode_area` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `no_telp`, `kota`, `homepage`, `alamat_lengkap`, `bio`, `kode_area`, `created_at`, `updated_at`) VALUES
(1, 1, '0812133313131', 'Yogjakarta', NULL, 'Desa Magelang RT 10 210', NULL, 42132, NULL, NULL),
(2, 2, '087262626262', 'Yogjakarta', NULL, 'Desa Kulon RT 20 RW 10', NULL, 35433, NULL, NULL),
(3, 3, '085234423', 'Yogjakarta', NULL, 'Desa Wetan RT 20 RW 10', NULL, 35433, NULL, NULL),
(4, 4, '085234423', 'Yogjakarta', NULL, 'Desa Wetan RT 20 RW 10', NULL, 35433, NULL, NULL),
(5, 5, '085234423', 'Banten', NULL, 'Desa Banten', NULL, 35433, NULL, NULL),
(6, 13, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-23 14:30:25', '2024-03-23 14:30:25'),
(7, 14, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-28 02:57:52', '2024-03-28 02:57:52'),
(8, 15, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-16 01:17:41', '2024-10-16 01:17:41'),
(9, 16, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 01:51:00', '2024-10-17 01:51:00'),
(10, 16, '087773614368', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 01:51:00', '2024-10-17 01:51:00'),
(11, 17, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(12, 17, '081515910177', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(13, 18, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(14, 18, '081387074166', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(15, 19, '081310426262', NULL, 'KCD KAB. TANGERANG', 'Jl. Water Point 9 Blok K17/05 Citra Raya-Panongan', 'ORA ET LABORA', NULL, '2024-10-17 03:59:06', '2024-10-28 07:47:40'),
(16, 19, '081310426262', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(17, 20, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(18, 20, '081310101500', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(19, 21, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(20, 21, '08121319723', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(21, 22, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 03:59:07', '2024-10-17 03:59:07'),
(22, 22, '08121352339', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 03:59:07', '2024-10-17 03:59:07'),
(23, 23, '087774521154', NULL, 'ekosaptini01@dinas.belajar.id', 'Villa Tomang Baru Blok AE.09 , Kotabumi, Kabupaten Tangerang.', 'Pengawas Ahli Madya Jenjang SMK', NULL, '2024-10-17 04:03:16', '2024-10-28 08:05:07'),
(24, 23, '087774521154', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 04:03:16', '2024-10-17 04:03:16'),
(25, 24, '082210794237', NULL, 'masliha22@dinas.belajar.id', 'Cluster Melia Residence X10/10, Citra Raya, Kel. mekar Bakti, Kec. Panongan, Kab. Tangerang, Banten', 'Pengawas SMK Kabupaten Tangerang,  Banten', NULL, '2024-10-17 04:03:16', '2024-10-28 08:10:00'),
(26, 24, '082210794237', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 04:03:16', '2024-10-17 04:03:16'),
(27, 25, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 04:03:16', '2024-10-17 04:03:16'),
(28, 25, '082193087435', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 04:03:16', '2024-10-17 04:03:16'),
(29, 26, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17 04:03:16', '2024-10-17 04:03:16'),
(30, 26, '081315031403', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 04:03:16', '2024-10-17 04:03:16'),
(31, 27, '081386049690', NULL, 'KCD  Kab. Tangerang', 'Bumi Puspiptek Asri Blok V D 07', NULL, NULL, '2024-10-17 04:03:16', '2024-10-28 08:02:47'),
(32, 27, '081386049690', 'Kab tanggerang', NULL, 'Kab tanggerang', NULL, 15157, '2024-10-17 04:03:16', '2024-10-17 04:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `rencakakerja_t`
--

CREATE TABLE `rencakakerja_t` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengawas` int(11) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `nama_program_kerja` varchar(255) DEFAULT NULL,
  `kategoriprogram_id` int(11) NOT NULL,
  `sekolah_id` varchar(255) DEFAULT NULL,
  `deskripsi_permasalahan` text DEFAULT NULL,
  `target_capaian` text DEFAULT NULL,
  `tenggat_waktu` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bulan` varchar(255) DEFAULT NULL,
  `jenisprogram_id` int(11) DEFAULT NULL,
  `aspekprogram_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rencakakerja_t`
--

INSERT INTO `rencakakerja_t` (`id`, `id_pengawas`, `tahun_ajaran`, `nama_program_kerja`, `kategoriprogram_id`, `sekolah_id`, `deskripsi_permasalahan`, `target_capaian`, `tenggat_waktu`, `created_at`, `updated_at`, `bulan`, `jenisprogram_id`, `aspekprogram_id`) VALUES
(1, 13, '2024', 'Pendampingan Kurikulum Merdeka', 1, '4,11,12,13,14,15,16,17', '<p>Sekolah binaan sudah mengembangkan diri menjadi Sekolah Mandiri Berubah sehingga diperlukan pendampingan&nbsp;</p>', '<p>Tercapainya KSOP pada satuan pendidikan</p>', 'Triwulan 1', '2024-03-28 02:45:03', '2024-03-28 02:45:03', NULL, NULL, NULL),
(2, 13, '2024', 'Monitoring Uji Kompetensi', 1, '4,11,12,13,14,15,16,17', '<p>Pelaksanaan Uji kompetensi sebagai program akhis pembelajaran di jenjang SMK</p>', '<p>Terlaksananya Uji Kompetensi yang sesuai dengan ketentuan dan memenuhi harapan Dunia Industri</p>', 'Triwulan 2', '2024-03-28 02:46:44', '2024-03-28 02:46:44', NULL, NULL, NULL),
(3, 14, '2024', 'Monitoring Uji Kompetensi', 1, '25,24,18,22,23', '<p>Penjaminan Mutu pelaksanaan Uji Kompetensi</p>', '<p>Tercapai pelaksanaan Uji Kompetensi sesuai Ketentuan</p>', 'Triwulan 2', '2024-03-28 03:12:31', '2024-03-28 03:12:31', NULL, NULL, NULL),
(4, 14, '2024', 'Monitoring Pasca Libur Idul Fitri', 1, '25,24,18,22,23', '<p>memantau kesipana guru dan tendiknpasca libur</p>', '<p>tercapai kesiapan optimal sdm sekolah mengahdapi pelayanan pendidikan pasca liburan</p>', 'Triwulan 1', '2024-04-18 03:56:10', '2024-04-18 03:56:10', NULL, NULL, NULL),
(5, 2, '2024', 'Program 1', 1, '4', NULL, NULL, 'Triwulan 4', '2024-09-30 13:00:49', '2024-10-15 03:13:34', NULL, NULL, NULL),
(7, 15, '2024', 'Pendampingan Uji Kompetensi', 1, '27,29,34,36,46', '<p>Memastikan sekolah melaksanakan Uji Kompetensi sesuai ketentuan</p>', NULL, NULL, '2024-10-25 14:06:47', '2024-10-25 14:06:47', 'November', 1, 1),
(8, 18, '2024', 'Pendampingan Akreditasi', 2, '137,141', '<p>Sudah mengisi SISPENA dan siap untuk visitasi&nbsp;</p>', NULL, NULL, '2024-10-28 07:12:30', '2024-10-28 07:44:26', 'November', 3, 3),
(9, 17, '2024', 'Sosialiasasi upaya pola usaha pencegahan stunting', 2, '84,85,86,87,88,89', NULL, NULL, NULL, '2024-10-28 08:05:51', '2024-10-28 08:23:16', 'November', 3, 6),
(10, 17, '2024', 'Penilaian Kinerja Kepala Sekolah', 1, '84,85,86,87,88,89', NULL, NULL, NULL, '2024-10-28 08:06:43', '2024-10-28 08:22:51', 'November', 2, 3),
(11, 23, '2024', 'Pendampingan Pengimbasan sekolah PK', 2, '244', '<p>Mendapatkan undangan kegiatan dari SMK PK</p>', NULL, NULL, '2024-10-28 08:13:45', '2024-10-28 08:13:45', 'November', 1, 3),
(12, 17, '2024', 'Pendampingan Penyusunan Program Kerja Asesmen Sumatif Semester 1.', 1, '84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113', NULL, NULL, NULL, '2024-10-28 08:43:34', '2024-10-28 08:46:30', 'November', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sekolahbinaan_t`
--

CREATE TABLE `sekolahbinaan_t` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengawas` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sekolahbinaan_t`
--

INSERT INTO `sekolahbinaan_t` (`id`, `id_pengawas`, `id_sekolah`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, NULL),
(2, 3, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 5, 1, NULL, NULL),
(5, 5, 2, NULL, NULL),
(6, 5, 3, NULL, NULL),
(7, 2, 4, '2024-03-23 14:58:00', '2024-03-23 14:58:00'),
(8, 13, 4, '2024-03-28 02:38:03', '2024-03-28 02:38:03'),
(9, 13, 11, '2024-03-28 02:38:03', '2024-03-28 02:38:03'),
(10, 13, 12, '2024-03-28 02:38:03', '2024-03-28 02:38:03'),
(11, 13, 13, '2024-03-28 02:38:03', '2024-03-28 02:38:03'),
(12, 13, 14, '2024-03-28 02:38:03', '2024-03-28 02:38:03'),
(13, 13, 15, '2024-03-28 02:38:03', '2024-03-28 02:38:03'),
(14, 13, 16, '2024-03-28 02:38:03', '2024-03-28 02:38:03'),
(15, 13, 17, '2024-03-28 02:38:03', '2024-03-28 02:38:03'),
(16, 14, 25, '2024-03-28 03:08:36', '2024-03-28 03:08:36'),
(17, 14, 24, '2024-03-28 03:08:46', '2024-03-28 03:08:46'),
(18, 14, 18, '2024-03-28 03:09:15', '2024-03-28 03:09:15'),
(19, 14, 22, '2024-03-28 03:09:15', '2024-03-28 03:09:15'),
(20, 14, 23, '2024-03-28 03:09:15', '2024-03-28 03:09:15'),
(21, 15, 26, '2024-10-16 01:22:20', '2024-10-16 01:22:20'),
(23, 15, 27, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(24, 15, 28, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(25, 15, 29, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(26, 15, 30, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(27, 15, 31, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(28, 15, 32, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(29, 15, 33, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(30, 15, 34, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(31, 15, 35, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(32, 15, 36, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(33, 15, 37, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(34, 15, 38, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(35, 15, 39, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(36, 15, 40, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(37, 15, 41, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(38, 15, 42, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(39, 15, 43, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(40, 15, 44, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(41, 15, 45, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(42, 15, 46, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(43, 15, 47, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(44, 15, 48, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(45, 15, 49, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(46, 15, 50, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(47, 15, 51, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(48, 15, 52, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(49, 15, 53, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(50, 15, 54, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(51, 15, 55, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(52, 15, 56, '2024-10-18 08:50:35', '2024-10-18 08:50:35'),
(53, 16, 57, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(54, 16, 58, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(55, 16, 59, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(56, 16, 60, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(57, 16, 61, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(58, 16, 62, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(59, 16, 63, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(60, 16, 64, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(61, 16, 65, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(62, 16, 66, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(63, 16, 67, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(64, 16, 68, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(65, 16, 69, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(66, 16, 70, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(67, 16, 71, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(68, 16, 72, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(69, 16, 73, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(70, 16, 74, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(71, 16, 75, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(72, 16, 76, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(73, 16, 77, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(74, 16, 78, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(75, 16, 79, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(76, 16, 80, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(77, 16, 81, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(78, 16, 82, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(79, 16, 83, '2024-10-25 13:58:03', '2024-10-25 13:58:03'),
(80, 17, 84, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(81, 17, 85, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(82, 17, 86, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(83, 17, 87, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(84, 17, 88, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(85, 17, 89, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(86, 17, 90, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(87, 17, 91, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(88, 17, 92, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(89, 17, 93, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(90, 17, 94, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(91, 17, 95, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(92, 17, 96, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(93, 17, 97, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(94, 17, 98, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(95, 17, 99, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(96, 17, 100, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(97, 17, 101, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(98, 17, 102, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(99, 17, 103, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(100, 17, 104, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(101, 17, 105, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(102, 17, 106, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(103, 17, 107, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(104, 17, 108, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(105, 17, 109, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(106, 17, 110, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(107, 17, 111, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(108, 17, 112, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(109, 17, 113, '2024-10-25 14:14:26', '2024-10-25 14:14:26'),
(110, 18, 114, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(111, 18, 115, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(112, 18, 116, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(113, 18, 117, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(114, 18, 118, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(115, 18, 119, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(116, 18, 120, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(117, 18, 121, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(118, 18, 122, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(119, 18, 123, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(120, 18, 124, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(121, 18, 125, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(122, 18, 126, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(123, 18, 127, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(124, 18, 128, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(125, 18, 129, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(126, 18, 130, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(127, 18, 131, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(128, 18, 132, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(129, 18, 133, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(130, 18, 134, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(131, 18, 135, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(132, 18, 136, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(133, 18, 137, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(134, 18, 138, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(135, 18, 139, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(136, 18, 140, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(137, 18, 141, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(138, 18, 142, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(139, 18, 143, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(140, 18, 144, '2024-10-25 14:38:02', '2024-10-25 14:38:02'),
(141, 19, 145, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(142, 19, 146, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(143, 19, 147, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(144, 19, 148, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(145, 19, 149, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(146, 19, 150, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(147, 19, 151, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(148, 19, 152, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(149, 19, 153, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(150, 19, 154, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(151, 19, 155, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(152, 19, 156, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(153, 19, 157, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(154, 19, 158, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(155, 19, 159, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(156, 19, 160, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(157, 19, 161, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(158, 19, 162, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(159, 19, 163, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(160, 19, 164, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(161, 19, 165, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(162, 19, 166, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(163, 19, 167, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(164, 19, 168, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(165, 19, 169, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(166, 19, 170, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(167, 19, 171, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(168, 19, 172, '2024-10-27 20:02:03', '2024-10-27 20:02:03'),
(169, 20, 173, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(170, 20, 174, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(171, 20, 175, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(172, 20, 176, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(173, 20, 177, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(174, 20, 178, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(175, 20, 179, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(176, 20, 180, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(177, 20, 181, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(178, 20, 182, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(179, 20, 183, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(180, 20, 184, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(181, 20, 185, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(182, 20, 186, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(183, 20, 187, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(184, 20, 188, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(185, 20, 189, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(186, 20, 190, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(187, 20, 191, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(188, 20, 192, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(189, 20, 193, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(190, 20, 194, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(191, 20, 195, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(192, 20, 196, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(193, 20, 197, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(194, 20, 198, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(195, 20, 199, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(196, 20, 200, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(197, 20, 201, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(198, 20, 202, '2024-10-27 20:30:48', '2024-10-27 20:30:48'),
(199, 21, 203, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(200, 21, 204, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(201, 21, 205, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(202, 21, 206, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(203, 21, 207, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(204, 21, 208, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(205, 21, 209, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(206, 21, 210, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(207, 21, 211, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(208, 21, 212, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(209, 21, 213, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(210, 21, 214, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(211, 21, 215, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(212, 21, 216, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(213, 21, 217, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(214, 21, 218, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(215, 21, 219, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(216, 21, 220, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(217, 21, 221, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(218, 21, 222, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(219, 21, 223, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(220, 21, 224, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(221, 21, 225, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(222, 21, 226, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(223, 21, 227, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(224, 21, 228, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(225, 21, 229, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(226, 21, 230, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(227, 21, 231, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(228, 21, 232, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(229, 21, 233, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(230, 21, 234, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(231, 21, 235, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(232, 21, 236, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(233, 21, 237, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(234, 21, 238, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(235, 21, 239, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(236, 21, 240, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(237, 21, 241, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(238, 21, 242, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(239, 21, 243, '2024-10-27 20:49:15', '2024-10-27 20:49:15'),
(240, 23, 212, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(241, 23, 244, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(242, 23, 245, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(243, 23, 246, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(244, 23, 247, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(245, 23, 248, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(246, 23, 249, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(247, 23, 250, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(248, 23, 251, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(249, 23, 252, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(250, 23, 253, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(251, 23, 254, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(252, 23, 255, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(253, 23, 256, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(254, 23, 257, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(255, 23, 258, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(256, 23, 259, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(257, 23, 260, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(258, 23, 261, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(259, 23, 262, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(260, 23, 263, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(261, 23, 264, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(262, 23, 265, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(263, 23, 266, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(264, 23, 267, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(265, 23, 268, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(266, 23, 269, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(267, 23, 270, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(268, 23, 271, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(269, 23, 272, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(270, 23, 273, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(271, 23, 274, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(272, 23, 275, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(273, 23, 276, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(274, 23, 277, '2024-10-27 21:16:59', '2024-10-27 21:16:59'),
(275, 25, 278, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(276, 25, 279, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(277, 25, 280, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(278, 25, 281, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(279, 25, 282, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(280, 25, 283, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(281, 25, 284, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(282, 25, 285, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(283, 25, 286, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(284, 25, 287, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(285, 25, 288, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(286, 25, 289, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(287, 25, 290, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(288, 25, 291, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(289, 25, 292, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(290, 25, 293, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(291, 25, 294, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(292, 25, 295, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(293, 25, 296, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(294, 25, 297, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(295, 25, 298, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(296, 25, 299, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(297, 25, 300, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(298, 25, 301, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(299, 25, 302, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(300, 25, 303, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(301, 25, 304, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(302, 25, 305, '2024-10-27 21:31:03', '2024-10-27 21:31:03'),
(303, 26, 306, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(304, 26, 307, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(305, 26, 308, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(306, 26, 309, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(307, 26, 310, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(308, 26, 311, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(309, 26, 312, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(310, 26, 313, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(311, 26, 314, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(312, 26, 315, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(313, 26, 316, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(314, 26, 317, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(315, 26, 318, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(316, 26, 321, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(317, 26, 322, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(318, 26, 323, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(319, 26, 324, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(320, 26, 325, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(321, 26, 326, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(322, 26, 327, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(323, 26, 328, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(324, 26, 329, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(325, 26, 330, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(326, 26, 331, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(327, 26, 332, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(328, 26, 333, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(329, 26, 334, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(330, 26, 335, '2024-10-27 21:43:23', '2024-10-27 21:43:23'),
(331, 27, 336, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(332, 27, 337, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(333, 27, 338, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(334, 27, 339, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(335, 27, 340, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(336, 27, 341, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(337, 27, 342, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(338, 27, 343, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(339, 27, 344, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(340, 27, 345, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(341, 27, 346, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(342, 27, 347, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(343, 27, 348, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(344, 27, 349, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(345, 27, 350, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(346, 27, 351, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(347, 27, 352, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(348, 27, 353, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(349, 27, 354, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(350, 27, 355, '2024-10-27 21:51:38', '2024-10-27 21:51:38'),
(351, 27, 356, '2024-10-27 21:51:38', '2024-10-27 21:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah_m`
--

CREATE TABLE `sekolah_m` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `npsn` varchar(255) NOT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `kode_area` int(11) DEFAULT NULL,
  `is_aktif` tinyint(1) DEFAULT 1,
  `kabupaten_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sekolah_m`
--

INSERT INTO `sekolah_m` (`id`, `nama_sekolah`, `npsn`, `no_telp`, `kota`, `alamat_lengkap`, `kode_area`, `is_aktif`, `kabupaten_id`, `created_at`, `updated_at`) VALUES
(1, 'SMAN 1 Leuwidamar Lebak', '', '031244233', 'Banten', 'Lebak', 42132, 1, 1, NULL, NULL),
(2, 'SMAN 2 Leuwidamar Lebak', '', '031244233', 'Banten', 'Lebak', 42132, 1, 1, NULL, NULL),
(3, 'SMAN 1 Rangkasbitung Lebak', '', '031244233', 'Banten', 'Lebak', 42132, 1, 1, NULL, NULL),
(4, 'SMKN Padarincang', '', '0', NULL, '0', NULL, 1, 3, '2024-03-23 14:31:54', '2024-03-23 14:35:14'),
(11, 'SMKS Bismillah Padarincang', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 02:34:45', '2024-03-28 02:34:45'),
(12, 'SMKS Bhakti Pertiwi Ciptayasa Ciruas', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 02:35:11', '2024-03-28 02:35:11'),
(13, 'SMKS Darunnajah Pabuaran', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 02:35:39', '2024-03-28 02:35:39'),
(14, 'SMKS Daruttaiban Pabuaran', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 02:36:00', '2024-03-28 02:36:00'),
(15, 'SMKS Al - MAshoem Pabuaran', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 02:36:32', '2024-03-28 02:36:32'),
(16, 'SMKS Mutakhir Petir', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 02:36:55', '2024-03-28 02:36:55'),
(17, 'SMKS Miftahul Falah Tj', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 02:37:21', '2024-03-28 02:37:21'),
(18, 'SMKN 1 Kramatwatu', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 03:00:11', '2024-03-28 03:00:11'),
(19, 'SMKS Maulana Yusuf Kotser', '0', '0', '-', '-', 0, 1, 1, '2024-03-28 03:00:30', '2024-03-28 03:00:30'),
(20, 'SMKS Al Aroof Cilegon', '0', '0', '-', '-', 0, 1, 2, '2024-03-28 03:00:51', '2024-03-28 03:00:51'),
(21, 'SMKS Madinatul Hadid Cilegon', '0', '0', '-', '-', 0, 1, 2, '2024-03-28 03:01:10', '2024-03-28 03:01:10'),
(22, 'SMKS Pembangunan Terpadu Tj', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 03:01:37', '2024-03-28 03:01:37'),
(23, 'SMKS Nurul Falah Bojong Pandan Tj', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 03:02:04', '2024-03-28 03:02:04'),
(24, 'SMKS Insan Cendekia Kragilan', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 03:02:31', '2024-03-28 03:02:31'),
(25, 'SMKN 1 Ciruas', '0', '0', '-', '-', 0, 1, 3, '2024-03-28 03:02:40', '2024-03-28 03:02:40'),
(26, 'SMAN 17 Kabupaten Tangerang', '20613528', '081287599838', 'kab tanggerang', 'PERUM LEGOK INDAH', 15157, 1, 6, '2024-10-16 01:21:56', '2024-10-16 01:21:56'),
(27, 'SMAN 22 Kabupaten Tangerang', '20613519', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(28, 'SMAN 23 Kabupaten Tangerang', '20613785', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(29, 'SMAN 28 Kabupaten Tangerang', '20613771', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(30, 'SMA Al-Asmaniyah Legok', '69734019', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(31, 'SMA IT Alia Legok', '20623136', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(32, 'SMA PGRI 83 Legok', '20603325', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(33, 'SMA Insan Kamil Tartila Legok', '69970379', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(34, 'SMA Yuppentek 3 Legok', '20603356', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(35, 'SMA Sunan Bonang Legok', '20603378', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(36, 'SMA UPH College Kelapa Dua', '20606507', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(37, 'SMA Pahoa Kelapa Dua', '20616061', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(38, 'SMA Kristen Tunas Bangsa Kelapa Dua', '20613974', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(39, 'SMA Stela Maris Kelapa Dua', '69883655', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(40, 'SMA Kristen Menara Tirza Kelapa Dua', '69883639', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(41, 'SMA Pelita Harapan Kelapa Dua', '69896001', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(42, 'SMA Al Wildan Kelapa Dua', '69982590', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(43, 'SMA Islamic Village Kelapa Dua', '20603346', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(44, 'SMA Katolik Penabur Gading Serpong', '20603357', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(45, 'SMA Tarakanita Gading Serpong', '20613524', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(46, 'SMA Al-Fityan Kelapa Dua', '69984260', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(47, 'SMA Tunas Mulia Gading Serpong Kelapa Dua', '69923665', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(48, 'SMA Genius Curug', '69895488', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(49, 'SMA Surya Bangsa Kelapa Dua', '20623139', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(50, 'SMA Jakarta Nanyang School KelapaDua', '69900307', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(51, 'SMA Alfa Sanah Cisauk', '20603170', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(52, 'SMA Ruhul Bayan Cisauk', '20607845', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(53, 'SMA Plus Daarul Hikmah Cisauk', '69945479', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(54, 'SMA Imtek Pagedangan', '20613766', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(55, 'SMA Syafana Islamic School Pagedangan', '69971027', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(56, 'SMA Iman Pengharapan Kasih BSD Pagedangan', '69950814', '08245545454545', 'Kab Tanggerang', 'Kab Tanggerang', 15157, 1, 6, '2024-10-18 08:48:02', '2024-10-18 08:48:02'),
(57, 'SMAN 6 Kabupaten Tangerang', '20603269', '081297330751', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(58, 'SMAN 8 Kabupaten Tangerang', '20603360', '082298961234', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(59, 'SMAN 10 Kabupaten Tangerang', '20603362', '087891921512', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(60, 'SMAN 16 Kabupaten Tangerang', '20603363', '082114866886', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(61, 'SMAN 27 Kabupaten Tangerang', '20613471', '085219565722', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(62, 'SMA Al-Fattah Tigaraksa', '69982444', '081212199533', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(63, 'SMA IT Ruhul Jadid Tigaraksa', '69880558', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(64, 'SMA Al-Husna Tigaraksa', '20615874', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(65, 'SMA Al-Mubarok Tigarkasa', '20613821', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(66, 'SMA PGRI 58 Tigarkasa', '20603324', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(67, 'SMA Al-Bassoriyah Cisoka', '69945475', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(68, 'SMA Islam Daar Et-Tohirin Cisoka', '20623135', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(69, 'SMA Nuurul Huda Cisoka', '20615474', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(70, 'SMA Sirojul Athfal Cisoka', '20613822', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(71, 'SMA Al Bayyinah Cisoka', '70014387', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(72, 'SMA Miftahussalam Jayanti', '69950716', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(73, 'SMA Sirrul Hikmah Solear', '69859656', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(74, 'SMA IT Bina Pekerti Solear', '70011551', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(75, 'SMA IT Darul Ijabah Jambe', '70037978', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(76, 'SMA Cendikia Al-Fallah Jambe', '20616391', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(77, 'SMA Daarul Ahsan Jayanti', '20613472', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(78, 'SMA Daar El-Qolam Jayanti', '20603164', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(79, 'SMA Daar El-Qolam 2 Jayanti', '20623133', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(80, 'SMA Raudatul Falah Jayanti', '20603374', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(81, 'SMA Masyariqul Anwar Jayanti', '20614153', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(82, 'SMA Yaspidam Jayanti', '20614045', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(83, 'SMA Daarul Ishlah Jayanti', '20603169', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 13:52:12', '2024-10-25 13:52:12'),
(84, 'SMAN 3 Kabupaten Tangerang', '20603361', '081297330751', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(85, 'SMAN 4 Kabupaten Tangerang', '20603358', '082298961234', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(86, 'SMAN 11 Kabupaten Tangerang', '20603251', '087891921512', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(87, 'SMAN 15 Kabupaten Tangerang', '20613603', '082114866886', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(88, 'SMAN 31 Kabupaten Tangerang', '70011662', '085219565722', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(89, 'SMAN 32 Kabupaten Tangerang', '70011668', '081212199533', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(90, 'SMA Atisa Dipamkara Curug', '20613824', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(91, 'SMA Lentera Harapan Curug', '69888887', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(92, 'SMA Gracia Curug ', '69949721', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(93, 'SMA Al-Husna Curug', '20603171', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(94, 'SMA Islam Al-Layyinah Curug  ', '20613522', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(95, 'SMA Daar El Gusti Curug', '20613525', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(96, 'SMA Pramita Curug', '20603372', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(97, 'SMA Wipama Cikupa    ', '20603382', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(98, 'SMA Al Ma’muniyah Cikupa', '20613523', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(99, 'SMA Nurul Hidayah Cikupa', '20613820', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(100, 'SMA IT Smart Syahida Cikupa', '69984685', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(101, 'SMA As-Sibghoh Cikupa', '69900411', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(102, 'SMA Tarakanita ', '20613524', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(103, 'SMA Plus Putra Bangsa Panongan', '20613527', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(104, 'SMA Citra Islami Panongan ', '20613826', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(105, 'SMA Citra Berkat Panongan ', '69858808', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(106, 'SMA Cordova Panongan', '69984622', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(107, 'SMA Perintis 1 Sepatan', '20603322', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(108, 'SMA Al-Multazam Sepatan', '20613627', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(109, 'SMA MKGR Sepatan', '20614014', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(110, 'SMA Ar-Rahman Sepatan', '69991298', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(111, 'SMA Prima Nusantara Sepatan', '20603373', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(112, 'SMA Plus Nurul Iman Ashopi Sepatan', '69992899', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(113, 'SMA IT Latansha Cendekia Pasarkemis', '69982608', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:10:50', '2024-10-25 14:10:50'),
(114, 'SMAN 5 Kabupaten Tangerang', '20603364', '081210782031', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(115, 'SMAN 12 Kabupaten Tangerang', '20603268', '08128356664', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(116, 'SMAN 20 Kabupaten Tangerang', '20613548', '0817899080', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(117, 'SMAN 21 Kabupaten Tangerang', '20613544', '081286245344', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(118, 'SMAN 25 Kabupaten Tangerang', '20613833', '081310811540', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(119, 'SMA Yadika 10 Kosambi', '20613865', '081212199533', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(120, 'SMA Bethel Kosambi', '20603160', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(121, 'SMA Dian Bangsa Kosambi', '69991481', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(122, 'SMA Tunas Bangsa Kosambi ', '20615080', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(123, 'SMA Al-Anwar Bina Mulia Kosambi ', '69984508', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(124, 'SMA Kristen Vila Bandara Kosambi   ', '70035596', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(125, 'SMA Bakti Ananda Kosambi', '70039188', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(126, 'SMA Babussalam Teluknaga', '20603159', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(127, 'SMA PGRI Teluknaga', '20613546', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(128, 'SMA Hiro Teluknaga', '20613545', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(129, 'SMA Genta Syahputra Teluknaga ', '20623134', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(130, 'SMA Al-Jumhuriyah Teluknaga ', '20603184', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(131, 'SMA Gemilang Pakuhaji ', '20613623', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(132, 'SMA Yustika Pakuhaji', '20616007', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(133, 'SMA Mustika A-Mujanah Pakuhaji', '69822823', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(134, 'SMA Aditya Karya Pakuhaji', '20623131', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(135, 'SMA Cemerlang Pakuhaji       ', '20603162', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(136, 'SMA Bina Putra Sepatan Timur', '69787117', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(137, 'SMA Daarul Abror Sepatan Timur', '70046005', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(138, 'SMA Nusantara Unggul Sukadiri', '20603320', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(139, 'SMA Matlaul Anwar Sukadiri', '20603327', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(140, 'SMA Daarul Muqimin Sukadiri', '20614878', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(141, 'SMA Riyadul Mukhlisin Sukadiri', '69899993', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(142, 'SMA Al-Ishlah Sukadiri', '69954817', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(143, 'SMA Harokatul Yamanie Sukadiri', '70008039', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(144, 'SMA Istafad Islamic School Sukadiri', '69947279', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-25 14:35:28', '2024-10-25 14:35:28'),
(145, 'SMAN 1 Kabupaten Tangerang', '20613470', '08121386579', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(146, 'SMAN 2 Kabupaten Tangerang', '20603367', '081319394953', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(147, 'SMAN 7 Kabupaten Tangerang', '20603365', '081213969249', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(148, 'SMAN 9 Kabupaten Tangerang', '20603366', '082299677977', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(149, 'SMAN 19 Kabupaten Tangerang', '20613465', '08121314791', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(150, 'SMAN 26 Kabupaten Tangerang', '20614057', '08128721603', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(151, 'SMAN 29 Kabupaten Tangerang', '20613561', '082261512122', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(152, 'SMAN 30 Kabupaten Tangerang', '69990896', '0817899080', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(153, 'SMA PGRI Balaraja', '20603353', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(154, 'SMA Mandiri Balaraja', '20603351', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(155, 'SMA Pelita Nusantara Balaraja', '69895489', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(156, 'SMA Al-Husna Mekar Baru ', '20616549', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(157, 'SMA Al-Falah Kresek ', '20603341', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(158, 'SMA Nusantara Kronjo', '69786313', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(159, 'SMA Bina Bhakti Kronjo', '20603161', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(160, 'SMA Langitan Kronjo', '70025225', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(161, 'SMA Ibnu Maski Gunung Kaler ', '60728438', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(162, 'SMA Asa Pertiwi Gunung Kaler ', '20614035', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(163, 'SMA Mutiara Bangsa Gunung Kaler  ', '20616158', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(164, 'SMA Al-Karim Gunung Kaler', '69987838', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(165, 'SMA Islam Nurul Huda Kedung Gunung Kaler', '20603344', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(166, 'SMA Quran Insan Pratama Sukamulya ', '69993054', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(167, 'SMA Islam Sunanul Haq Mekar Baru ', '70000391', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(168, 'SMA Paradigma Mauk', '20603321', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(169, 'SMA Al-Furqon Mauk', '20613541', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(170, 'SMA Islam Gintung Mauk ', '20603343', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(171, 'SMA Darul Abror Kemiri', '20603168', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(172, 'SMA Al-Falahiyah Kemiri', '20614224', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 19:58:46', '2024-10-27 19:58:46'),
(173, 'SMAN 13 Kabupaten Tangerang', '20603384', '081383454948', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(174, 'SMAN 14 Kabupaten Tangerang', '20613543', '085777087134', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(175, 'SMAN 18 Kabupaten Tangerang', '20614413', '081388277623', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(176, 'SMAN 24 Kabupaten Tangerang', '20613464', '081219898967', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(177, 'SMA Permata Insani Islamic School', '20622147', '081383454948', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(178, 'SMA Daarul Muttaqien Pasarkemis', '69871144', '085777087134', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(179, 'SMA PGRI 095 Pasarkemis', '20603326', '081388277623', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(180, 'SMA Tarsisius Vireta Pasarkemis', '20603379', '081219898967', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(181, 'SMA Maria Mediatrix Pasarkemis ', '20603352', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(182, 'SMA Al-Istiqomah Pasarkemis ', '20603183', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(183, 'SMA Kutabumi Pasarkemis', '20616006', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(184, 'SMA Daarut Tasbih Pasarkemis ', '69974660', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(185, 'SMA Al Jauhar Pasarkemis ', '70042562', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(186, 'SMA Mutiara Bangsa 6 Pasarkemis ', '70031033', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(187, 'SMA Yaspih Rajeg', '20603370', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(188, 'SMA Daarul Muhtarin Rajeg', '69953395', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(189, 'SMA Daarul Archam Rajeg', '20603165', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(190, 'SMA Al-Azhariyah Rajeg', '20603182', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(191, 'SMA Nurul Iman Rajeg ', '20613468', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(192, 'SMA Nurul Falah Rajeg ', '20614868', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(193, 'SMA Al Hasaniah Rajeg', '69988359', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(194, 'SMA Al Falahiyah Rajeg ', '69990274', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(195, 'SMA Babussalam Rajeg ', '70032601', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(196, 'SMA Queen Rajeg', '69970378', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(197, 'SMA Raudlatul Ulum Rajeg', '70010262', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(198, 'SMA Mutiara Insan Nusantara Rajeg   ', '69991469', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(199, 'SMA Darrussalam Sindang Jaya', '20603167', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(200, 'SMA Bani Tamim Sindang Jaya', '69822821', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(201, 'SMA Santa Laurensia Sindang Jaya', '69987588', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(202, 'SMA PGRI Sindang Sono SindangJaya', '69725917', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:28:14', '2024-10-27 20:28:14'),
(203, 'SMKN 1 Kab. Tangerang', '20607834', '08129638552', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(204, 'SMKN 5 Kab. Tangerang', '20607837', '081219923311', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(205, 'SMKN 11 Kab. Tangerang', '69824463', '087871792648', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(206, 'SMK Al-Hikmah Curug', '20607825', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(207, 'SMK Assalam Curug', '69861161', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(208, 'SMK PGRI Cikupa', '20603300', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(209, 'SMK Bersama', '69902838', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(210, 'SMK Binong Permai', '20615689', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(211, 'SMK Atisa Dipamkara', '20616396', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(212, 'SMK Nurul Huda Curug Wetan', '69962400', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(213, 'SMK Miftahul Jannah Cikupa', '20607833', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(214, 'SMK Miftahul Khaer', '20622271', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(215, 'SMK Prima Bakti', '20607842', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(216, 'SMK Putra Perdana Indonesia', '69894047', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(217, 'SMK Darussalam Panongan', '69726077', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(218, 'SMK Lentera Harapan', '69938646', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(219, 'SMK Al-Barkah Curug', '20616214', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(220, 'SMK Al Khoirat', '20614725', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(221, 'SMK Yuppentek 2 Tangerang', '20603292', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(222, 'SMK Mahakarya Cikupa', '69968722', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(223, 'SMK Bina Am Ma\'mur', '20613713', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(224, 'SMK Kharisma Panongan', '20616352', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(225, 'SMK Pancakarya 2 Tangerang', '20622272', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(226, 'SMK Citra Nusantara', '69880440', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(227, 'SMK Wipama Cikupa', '20603307', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(228, 'SMK Yuppentek 5 Curug', '20603297', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(229, 'SMK Taruna Karya Cikupa', '20607847', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(230, 'SMK Mandiri 01 Panongan', '20603259', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(231, 'SMK Kesehatan Utama Insani', '20623127', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(232, 'SMK Al Arobi', '20607824', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(233, 'SMK Al Hasanah', '20268067', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(234, 'SMK Gapura Pertiwi', '20622257', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(235, 'SMK Ibnu Maski', '20615730', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(236, 'SMK Matlaul Huda', '20615543', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(237, 'SMK Mandiri 2 Balaraja', '20603260', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(238, 'SMK Nurul Amin', '20616141', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(239, 'SMK PGRI Sukamulya', '20616353', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(240, 'SMK Tunas Harapan Balaraja', '20613680', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(241, 'SMK As-Salimiyah', '69988298', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(242, 'SMK Cendikia Bakti Muri', '69986438', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(243, 'SMK Jaya Buana', '60729364', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 20:45:51', '2024-10-27 20:45:51'),
(244, 'SMKN 7 Kabupaten Tangerang', '20614509', '08129638552', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(245, 'SMKN 12 Kabupaten Tangerang', '69897080', '081219923311', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(246, 'SMK Islamic Village', '20603253', '087871792648', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(247, 'SMK Lusiana', '20603295', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(248, 'SMK Media Informatika Dasana Indah', '20614573', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(249, 'SMK Nusa Jaya', '20614747', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(250, 'SMK Pasundan', '20224133', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(251, 'SMK Penrbangan Dirgantara', '20607840', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(252, 'SMK PGRI 31 Legok', '20613761', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(253, 'SMK Ruhul Bayan', '20607845', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(254, 'SMK YAPPIKA Legok', '20603291', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(255, 'SMK Semesta Cisauk', '20622270', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(256, 'SMK Bina Insani Cisauk', '20622269', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(257, 'SMK Tunas Cisauk', '20622184', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(258, 'SMK Siere Cendikia', '20622183', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(259, 'SMK Global Insan Legok', '20622250', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(260, 'SMK Al Anshor', '69759054', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(261, 'SMKP Aero Dirghantara', '69880559', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(262, 'SMK Insan Madani Palasari', '69954358', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(263, 'SMK Insan Kamil Tartila', '69968864', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(264, 'SMK Cendikia Bangsa', '69990144', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(265, 'SMK Al Ikhlas Legok', '69993047', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(266, 'SMK Islam Insan Mulia', '69992796', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(267, 'SMK Bina Mandiri', '20223125', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(268, 'SMK Al Hafidz', '69762769', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(269, 'SMK Anisa', '20622248', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(270, 'SMK Bani Usman Manunggal', '20623124', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(271, 'SMK KORPRI 2 Balaraja', '20607832', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(272, 'SMK Mutiara Bangsa', '20614518', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(273, 'SMK Nurul Huda', '69859383', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(274, 'SMK Yuppentek 3', '20603293', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(275, 'SMK Perjuangan Bangsa', '69978710', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(276, 'SMK Annur Bunar', '20616541', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(277, 'SMK Eka Darma', '20622256', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:14:15', '2024-10-27 21:14:15'),
(278, 'SMK N 6 Kab. Tangerang', '20614727', '081310959371', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(279, 'SMK N 14 Kab. Tangerang', '70046137', '082110797549', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(280, 'SMK Kesehatan Bina Prestasi Tangerang', '20616040', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(281, 'SMK Angkasa 1 Sepatan', '20603296', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(282, 'SMK Angkasa 2 Sepatan', '20615089', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(283, 'SMK Bintang Nusantara School', '20622254', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(284, 'SMK Global Tangerang', '69952417', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(285, 'SMK Hanjuang', '69903032', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(286, 'SMK Ilhami Kemiri', '20615820', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(287, 'SMK Mathlaul Anwar', '69943356', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(288, 'SMK Maestro Sepatan', '69876678', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(289, 'SMK Teknologi Pilar Bangsa', '20623128', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(290, 'SMK Pantura 1 Mauk', '20622251', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(291, 'SMK Plus Pakuhaji', '69902813', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(292, 'SMK Dirgantara Sukadiri', '20603279', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(293, 'SMK Al Gina', '20616336', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(294, 'SMK Plus As-Sa\'adah 2', '69790719', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(295, 'SMK Raudlatul Fikrah', '69965422', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(296, 'SMK Azzahra Sepatan', '69971901', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(297, 'SMK Perintis 1 Sepatan', '20603282', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(298, 'SMK Kesehatan Bhakti Insan Persada', '20622255', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(299, 'SMK Al-Multazam Sepatan', '69859362', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(300, 'SMK Kusuma Bangsa', '20268466', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(301, 'SMK Harapan Bangsa', '20622185', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(302, 'SMK Persada Pasar Kemis', '69734017', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(303, 'SMK Tunas Pakuhaji', '69859680', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(304, 'SMK Kutabumi 1', '69986033', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(305, 'SMK Gema Nusantara', '70003884', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:29:13', '2024-10-27 21:29:13'),
(306, 'SMKN 10 Kab. Tangerang', '69786933', '081717171741', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(307, 'SMKN 13 Kab. Tangerang', '70046641', '082299283668', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(308, 'SMK Teluknaga', '20616392', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(309, 'SMK Gapura Kasih', '20607829', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(310, 'SMK Tunas Bangsa', '20607848', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(311, 'SMK Cemerlang', '20616361', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(312, 'SMK Al Hikma', '20607825', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(313, 'SMK Teknologi Teluknaga', '20616392', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(314, 'SMK Patriot Nusantara', '20616194', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(315, 'SMK Putra Rifara', '20622258', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(316, 'SMK Nusantara Global', '69755237', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(317, 'SMK Bina Mandiri Teluknaga', '69761962', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(318, 'SMK YADIKA 10 Kosambi', '69892479', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(319, 'SMK Tunas Muda Unggul', '69952607', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(320, 'SMK Suari Terang', '69970757', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(321, 'SMK Karmel', '69979152', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(322, 'SMKI Cendekia Mulia', '69979226', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(323, 'SMK Darul Mu\'in', '69971507', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(324, 'SMK Mutiara Bangsa 6', '70013456', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(325, 'SMK Insan Teratai', '70042559', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(326, 'SMK Bina Insani Cijeruk', '20614746', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(327, 'SMK Daarut Taufiq', '20603278', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34');
INSERT INTO `sekolah_m` (`id`, `nama_sekolah`, `npsn`, `no_telp`, `kota`, `alamat_lengkap`, `kode_area`, `is_aktif`, `kabupaten_id`, `created_at`, `updated_at`) VALUES
(328, 'SMK Al – Mustafiyah', '20622253', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(329, 'SMK Anak Bangsa', '69903430', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(330, 'SMK Insan Madani', '69986395', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(331, 'SMK Daarul Ulum', '69955104', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(332, 'SMK Nurul Hikmah', '20614570', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(333, 'SMK Al – Falahiyyah', '69774575', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(334, 'SMK Garuda Pakuhaji', '69991994', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(335, 'SMK Citra Madani', '69892478', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:40:34', '2024-10-27 21:40:34'),
(336, 'SKh Negeri 01 Kab. Tangerang', '20615486', '085890530372', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(337, 'SKh Dian Bahagia', '69726943', '082298858005', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(338, 'SKh Mutiara Hikmatul Huda', '69726948', '085695784610', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(339, 'SKh Pelita Al Karomah', '69726945', '089526083243', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(340, 'SKh Darmawati Arif', '20616290', '085947469441', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(341, 'SKh Insan Mulia', '69873707', '081212809323', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(342, 'SKh Caraka Pratama', '69786385', '085281735229', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(343, 'SKh Mustika Tiga Raksa', '69974454', '081296681296', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(344, 'SKh Bina Insan Mandiri', '69966709', '089646554507', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(345, 'SKh Karya Insani', '69984149', '085218136681', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(346, 'SKh Aditia Silih Asih', '69725271', '082120320331', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(347, 'SKh Nurul Diyn', '69756125', '081314141995', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(348, 'SKh Menara Kasih', '69786285', '081361568450', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(349, 'SKh Syahida Harapan Bunda', '20613492', '081381115639', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(350, 'SKh Muslim Cendikia', '69773501', '081318303944', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(351, 'SKh Bhakti Luhur 02', '69924909', '081287907336', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(352, 'SKh Heksa Wiyata', '69726947', '0813380246128', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(353, 'SKh Griya Mandiri', '69966710', '081906276586', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(354, 'SKh Surya Bangsa', '70031512', '081285737991', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(355, 'SKh. Bhakti Putra', '69990473', '081291792986', 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18'),
(356, 'Sekolah Inklusi', '20606937', NULL, 'Kabupaten Tanggerang', 'Kabupaten Tanggerang', 15157, 1, 6, '2024-10-27 21:50:18', '2024-10-27 21:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategory`
--

CREATE TABLE `sub_kategory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kategory` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kategory`
--

INSERT INTO `sub_kategory` (`id`, `id_kategory`, `nama`, `created_at`, `updated_at`) VALUES
(1, 4, 'Harian', NULL, NULL),
(2, 4, 'Bulanan', NULL, NULL),
(3, 4, 'Rekapitulasi Pelaporan Reguler Satuan Pendidikan', NULL, NULL),
(4, 5, 'Laporan PKKS', NULL, NULL),
(5, 5, 'Laporan Tematik', NULL, NULL),
(6, 4, 'MPLS', NULL, NULL),
(7, 6, 'Ijin Operasional Penambahan Kompetensi Keahlian', NULL, NULL),
(8, 6, 'Konflik Kepemilikan Sekolah', NULL, NULL),
(9, 6, 'Pencegahan Stunting', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_gol_pangkat_ruang`
--

CREATE TABLE `table_gol_pangkat_ruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_golongan` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  `ruang_kerja` varchar(255) DEFAULT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_gol_pangkat_ruang`
--

INSERT INTO `table_gol_pangkat_ruang` (`id`, `nama_golongan`, `pangkat`, `ruang_kerja`, `id_golongan`, `created_at`, `updated_at`) VALUES
(1, 'Golongan III', 'Penata Muda', 'III A', 0, NULL, NULL),
(2, 'Golongan III', 'Penata Muda Tingkat 1', 'III B', 0, NULL, NULL),
(3, 'Golongan III', 'Penata', 'III C', 0, NULL, NULL),
(4, 'Golongan III', 'Penata Tingkat 1', 'III D', 0, NULL, NULL),
(5, 'Golongan IV', 'Pembina', 'IV A', 0, NULL, NULL),
(6, 'Golongan IV', 'Pembina Tingkat 1', 'IV B', 0, NULL, NULL),
(7, 'Golongan IV', 'Pembina Utama Muda', 'IV C', 0, NULL, NULL),
(8, 'Golongan IV', 'Pembina Utama Madya', 'IV D', 0, NULL, NULL),
(9, 'Golongan IV', 'Pembina Utama', 'IV E', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan_umpanbalik_t`
--

CREATE TABLE `tanggapan_umpanbalik_t` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_umpanbalik` int(11) NOT NULL,
  `jawaban_1` varchar(255) DEFAULT NULL,
  `jawaban_2` varchar(255) DEFAULT NULL,
  `jawaban_3` varchar(255) DEFAULT NULL,
  `jawaban_4` varchar(255) DEFAULT NULL,
  `jawaban_5` varchar(255) DEFAULT NULL,
  `jawaban_6` varchar(255) DEFAULT NULL,
  `jawaban_7` varchar(255) DEFAULT NULL,
  `jawaban_8` varchar(255) DEFAULT NULL,
  `jawaban_9` varchar(255) DEFAULT NULL,
  `jawaban_10` varchar(255) DEFAULT NULL,
  `jawaban_11` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugaskerja_t`
--

CREATE TABLE `tugaskerja_t` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengawas` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugaskerja_t`
--

INSERT INTO `tugaskerja_t` (`id`, `id_pengawas`, `id_tugas`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, NULL),
(2, 3, 2, NULL, NULL),
(3, 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `umpanbalik_m`
--

CREATE TABLE `umpanbalik_m` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `type_input` varchar(255) DEFAULT NULL,
  `aspek` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `urutan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `umpanbalik_m`
--

INSERT INTO `umpanbalik_m` (`id`, `pertanyaan`, `jawaban`, `type_input`, `aspek`, `status`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Pelayanan apakah yang diberikan oleh Pengawas sekolah saat ini?', 'supervisi managerial,supervisi Akademik,Evaluasi pendidikan,penelitian dan pengembangan,Pendampingan Tematik ( PPDB, MPLS, Uji Kompetensi, dll)', 'radiobutton', 'pendampingan', 1, 1, NULL, NULL),
(2, 'Apakah Pengawas sekolah menyampaikan rencana pendampingan sebelum pelaksanaan pendampingan', 'Ya,Tidak', 'radiobutton', 'pendampingan', 1, 2, NULL, NULL),
(3, 'Bagiaman Pelaksanaan pendampingan apakah sesuai dengan rencana?', 'Ya,Tidak', 'radiobutton', 'pendampingan', 1, 3, NULL, NULL),
(4, 'Bagaiamana pengawas sekolah melibatkan saudara dalam diskusi selama proses pendampingan?', 'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang', 'radiobutton', 'pendampingan', 1, 4, NULL, NULL),
(5, 'Bagaimana intetraksi yang terjadi selama proses pendampingan?', 'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang', 'radiobutton', 'pendampingan', 1, 5, NULL, NULL),
(6, 'Bagaimana suasana yang tercipta selama proses pendampingan?', 'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang', 'radiobutton', 'pendampingan', 1, 6, NULL, NULL),
(7, 'Bagaimana penguasaan materi/ Pengetahuan  yang dimiliki Pengawas Sekolah', 'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang', 'radiobutton', 'kompetensi', 1, 7, NULL, NULL),
(8, 'Bagaimana Komunikasi yang dilakukan selama proses pendampingan?', 'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang', 'radiobutton', 'kompetensi', 1, 8, NULL, NULL),
(9, 'Bagaimana ketepatan waktu pelaksanaan pendampingan?', 'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang', 'radiobutton', 'kompetensi', 1, 9, NULL, NULL),
(10, 'Berikan saran , hal apa yang harus ditingkatkan dari pelayanan Pengawas sekolah?', NULL, 'textarea', 'lainnya', 1, 10, NULL, NULL),
(11, 'Kebutuhan layanan supervisi / pendampingan seperti apa yang saudara harapkan?', NULL, 'textarea', 'lainnya', 1, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `umpanbalik_t`
--

CREATE TABLE `umpanbalik_t` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pelaporan` int(11) NOT NULL,
  `generate_url` varchar(255) NOT NULL,
  `id_pengawas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `umpanbalik_t`
--

INSERT INTO `umpanbalik_t` (`id`, `id_user`, `id_pelaporan`, `generate_url`, `id_pengawas`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'c41534371d11441a9a3f6e3d713ee1b4', 13, '2024-03-28 02:51:30', '2024-03-28 02:51:30'),
(2, 1, 3, '8ea6ed08836c4eaaab76bf1a480cefa9', 14, '2024-03-28 03:15:24', '2024-03-28 03:15:24'),
(3, 1, 4, 'bca797b2758548149114dad569344e8e', 14, '2024-03-28 05:28:36', '2024-03-28 05:28:36'),
(4, 1, 5, 'c568650889b7412c91a67baddd6ed43a', 14, '2024-03-31 16:00:09', '2024-03-31 16:00:09'),
(5, 1, 6, '3eb50bcd0fe747a7b9bb8f8bb5746758', 14, '2024-04-01 07:04:49', '2024-04-01 07:04:49'),
(6, 1, 8, '7b7e902cae2f4118aa4fe3c80de796ec', 14, '2024-04-25 07:39:34', '2024-04-25 07:39:34'),
(7, 1, 9, '03de928d66134b95bf5de95a1511dbc1', 2, '2024-09-30 13:01:50', '2024-09-30 13:01:50'),
(8, 1, 10, '9de2e9bbe61f4d7fb9ded48a7135e921', 2, '2024-10-06 11:32:40', '2024-10-06 11:32:40'),
(9, 1, 11, '47bd9e8f9a8d4b33ae4cfce03c2456a2', 2, '2024-10-08 01:25:55', '2024-10-08 01:25:55'),
(10, 4, 12, 'de8c835e1663472bae7420ba34416987', 2, '2024-10-08 01:28:40', '2024-10-08 01:28:40'),
(11, 4, 13, '93624871d36843a593787c63f7e23236', 2, '2024-10-08 01:39:22', '2024-10-08 01:39:22'),
(13, 4, 15, 'a54e3035140f4cccb5235443f7e5f8b1', 2, '2024-10-08 03:35:02', '2024-10-08 03:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Admin',
  `nip` varchar(100) DEFAULT NULL,
  `foto_profile` varchar(255) DEFAULT NULL,
  `jenjang_jabatan` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  `gol_ruang` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `kode_area` int(11) DEFAULT NULL,
  `kabupaten_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `nip`, `foto_profile`, `jenjang_jabatan`, `pangkat`, `gol_ruang`, `no_telp`, `kota`, `alamat_lengkap`, `kode_area`, `kabupaten_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Gita', 'admin@kcdkabtang.id', NULL, '$2y$10$xJVoD1t8jFnKVxpVCK3l9e0EEPG1tzItcLPEFMkl8l5iiR1VxkqJS', 'Super Admin', '', 'userdefault.jpg', '', '', '', NULL, NULL, NULL, NULL, 0, 'eMTKhnnW18C3ozHvFmtSRmjuBAUPOwhrpSwdrxZTq5t2wLmUlJoafhbd3VVB', NULL, NULL),
(2, 'Hasan', 'hasan@gmail.com', NULL, '$2y$10$WaZr6MFZoPgqPtkJkghvRuq7iuV4LuQ.dGLUdsp7i6kAxOdSD8X/y', 'Pengawas', '15481548745154687', 'userdefault.jpg', 'Pengawas Sekolah Utama', 'Pembina Utama', 'IV/d', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(3, 'Akbar', 'akbar@gmail.com', NULL, '$2y$10$HDoc0Pl59mHsAt83OyAzKOuOyYBXpb4p4U0wvw7ebjd9CVhTzuKga', 'Stakeholder', '', 'userdefault.jpg', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(4, 'Dr. Eko Supraptono, M.Si.', 'ekosupraptono@gmail.com', NULL, '$2y$10$E3cu7rg6C6fMiZDgk0YVtuOdRnz/MPzWexiMX2xG28Pt0EgXvIk6u', 'Pengawas', '196404151992031006', 'userdefault.jpg', 'Pengawas Sekolah Utama', 'Pembina Utama', 'IV/d', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5, 'Admin Wilayah Kota Serang', 'adminseragon@gmail.com', NULL, '$2y$10$JzxjopJYxWoGDbI3hq.A6eDzIp3OGIu5XvUEQQKj1kMvePfvFIika', 'Admin', '', 'userdefault.jpg', '', '', '', '087808505606', NULL, 'Kota Serang', NULL, 3, NULL, NULL, '2024-03-23 14:22:22'),
(6, 'Admin Wilayah Cilegon', 'admincilegon@gmail.com', NULL, '$2y$10$xp0opZXxPBroXV1RNYN5J.7AAHaMjetZ10JEyvLmJfIVKdcHFEp1m', 'Admin', '', 'userdefault.jpg', '', '', '', NULL, NULL, NULL, NULL, 2, '3rO1AepiNa3TVyefaJ4qJ7mLHSF57VsYnvx8few0oNHfZ2v3xmOmPciR0XBg', NULL, NULL),
(7, 'Admin Wilayah Kabupaten Serang', 'adminserang@gmail.com', NULL, '$2y$10$En5Nv9t8mC2BOrNtP4NS2O30kh9mJz4DK20LKAl1cKQUtaQ0WXtUW', 'Admin', '', 'userdefault.jpg', '', '', '', '87808505606', NULL, 'Kabupaten Serang', NULL, 3, 'krriJzm9wQWn58dgvXtkAAjtF8yqne4SW8Os8qCFZFiq7CiLteMqYZKM04SC', NULL, '2024-03-23 14:23:41'),
(8, 'Admin Wilayah Pandeglang', 'adminpandeglang@gmail.com', NULL, '$2y$10$xhxVOnjLy4GkCYbPVT7GWud8idDTDV6qjFrrjsUTgPWDF0gxu/CWi', 'Admin', '', 'userdefault.jpg', '', '', '', NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(9, 'Admin Wilayah Lebak', 'adminlebak@gmail.com', NULL, '$2y$10$MJ2tST/.Cy3WgojE8Brn/.1av0pQujZ7pe2mOm/A/Q2w76iUsWgbu', 'Admin', '', 'userdefault.jpg', '', '', '', NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(10, 'Admin Wilayah Kab Tangerang', 'adminkabtangerang@gmail.com', NULL, '$2y$10$Vx2EsmqJPno6fZIYHNYLsOuaCTSGhaMdUvzRFF/pDS.HAF8T78EZi', 'Admin', '', 'userdefault.jpg', '', '', '', NULL, NULL, NULL, NULL, 6, 'qemCVYvx79N8w2HSVSPM5paZsrwL4Nf9ARrz57kiq1mbAHLmelnjxO6JOrqS', NULL, NULL),
(11, 'Admin Wilayah Kota Tangerang', 'adminkotatangerang@gmail.com', NULL, '$2y$10$1lv7Y0kVrYYeVFlLFvENNulHyulzTQmBwGlQ10kLX0jSSntVnF2Aa', 'Admin', '', 'userdefault.jpg', '', '', '', NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL),
(12, 'Admin Wilayah Kota Tangerang Selatan', 'adminkotatangerangselatan@gmail.com', NULL, '$2y$10$PRHuUFXjEP4ilXI.KIV55OFduPGOfAfFX/1sJVEK/yAxDuxj92rue', 'Admin', '', 'userdefault.jpg', '', '', '', NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL),
(13, 'Anto Jayadi Kusuma, M.Pd.', 'antojayadi@gmail.com', NULL, '$2y$10$InETdBJ6TU85FyvI9BMT0uY4FLxhWGbxG5smJwdvPmRFlMgZHuUnG', 'Pengawas', '198502022009021002', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', '5', '5', '85719086864', NULL, 'padarincang', NULL, 3, NULL, '2024-03-23 14:30:25', '2024-03-28 02:41:46'),
(14, 'Billy Tedja Arief', 'billytedjaarief@gmail.com', NULL, '$2y$10$ysjjuB9uDjyBLuDnqqDr5.gflTrnLiaEaDWhz2su3zplu0GbMQlGy', 'Pengawas', '197907012010011006', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', '4', '4', '087822099180', NULL, 'serang', NULL, 3, NULL, '2024-03-28 02:57:52', '2024-03-28 02:57:52'),
(15, 'Drs. Utoyo, M.Pd', 'utoyo@delmansuper.com', NULL, '$2y$10$VBcRcE0zLQ5LHKpp.Kbhnu970LpdSpM9nx88ohx9uo66zbBtXAv12', 'Pengawas', '196604251994121001', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', '6', '6', '085773721283', 'kab tanggerang', 'Kab tanggerang', 15157, 6, NULL, '2024-10-16 01:17:41', '2024-10-16 01:17:41'),
(16, 'Drs. H. Suparto, M.Pd', 'suparto@gmail.com', NULL, '$2y$10$0oP6YYGWHUUwOIoNzocrxuY1FizBAsxzwr3NVttL5zgdT.1b786vS', 'Pengawas', '196606241994121005', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '087773614368', NULL, NULL, NULL, 6, NULL, '2024-10-17 01:51:00', '2024-10-17 01:51:00'),
(17, 'RISWAN, S.Pd.,', 'riswan@gmail.com', NULL, '$2y$10$kN6i4Pdr90G8BfJ/AJm2re7AVqB8tZPrtk/xIp2LPp5.DLG6XP8mC', 'Pengawas', '196804171994011001', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '081515910177', NULL, NULL, NULL, 6, NULL, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(18, 'Drs. Tri Susilarto, M.Pd', 'trisusilarto@gmail.com', NULL, '$2y$10$bIKV5Ac3sVR6pIAZMxVREeKLI/0Yt4lww8aZbyByxZkLH.X3/RX1G', 'Pengawas', '196608311994121003', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '081387074166', NULL, NULL, NULL, 6, NULL, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(19, 'Zonya Rubeka Bawengan, M.Pd', 'zonyarubeka@gmail.com', NULL, '$2y$10$Uj3X0ml0FDfe4QDohWwb9u.JSFghsAXY4lUGePt7kxHcTyUdIkp8i', 'Pengawas', '196810071994122003', '20241028074740_NPk0spiydJ.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '081310426262', NULL, NULL, NULL, 6, NULL, '2024-10-17 03:59:06', '2024-10-28 07:47:40'),
(20, 'Mohamad Ina Royana, S.Pd., MM', 'mohamadina@gmail.com', NULL, '$2y$10$sqa6IBbV9FVNn46XOjda.O10/yDXYpYM//bbJkU2WesLltMIfTogW', 'Pengawas', '197602282003121003', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '081310101500', NULL, NULL, NULL, 6, NULL, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(21, 'Herwan Toni, S.Pd., M.Eng', 'herwantoni@gmail.com', NULL, '$2y$10$oRO6wmZN2f924qOv7hbVZewi5MuZEaPHh5ygf8QsiSdlWeVnI9I2.', 'Pengawas', '196609051999031004', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '08121319723', NULL, NULL, NULL, 6, NULL, '2024-10-17 03:59:06', '2024-10-17 03:59:06'),
(22, 'Dra. Endeh Indradewi, M.Pd', 'endehindradewi@gmail.com', NULL, '$2y$10$m9mknWOURqQCp/cmEN7MwubvB3yP7A4.sfwOgLCjmej8LMyayBQ9m', 'Pengawas', '196509251992032006', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '08121352339', NULL, NULL, NULL, 6, NULL, '2024-10-17 03:59:07', '2024-10-17 03:59:07'),
(23, 'Eko Saptini., S.Pd.', 'ekosaptini@gmail.com', NULL, '$2y$10$lX5o0fqdbfpLwdzkP9ulke56UjaImCR2hbqONGxZvy4DalVkTGCuq', 'Pengawas', '1970001152008012013', '20241028080507_14pJ80s2q2.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '087774521154', NULL, NULL, NULL, 6, NULL, '2024-10-17 04:03:16', '2024-10-28 08:05:07'),
(24, 'Masliha, M.Pd.', 'masliha@gmail.com', NULL, '$2y$10$HZwcLrcOHy8tCtfu6Udice1I2I.dxISIwE1gnyy7teWaFz4zgBt8y', 'Pengawas', '197202022007012015', '20241028081000_y1y2wf4Gw3.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '082210794237', NULL, NULL, NULL, 6, NULL, '2024-10-17 04:03:16', '2024-10-28 08:10:00'),
(25, 'Umayah, S.P., M.Si.', 'umayah@gmail.com', NULL, '$2y$10$G9wS7TT4ZdIf8.H.y6ztT.ROZ3eRdtLoZ60AJlRW.GJrlhyyjkW4K', 'Pengawas', '197311262006042023', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '082193087435', NULL, NULL, NULL, 6, NULL, '2024-10-17 04:03:16', '2024-10-17 04:03:16'),
(26, 'Henry Akmal, S.T., M.Pd. ', 'henryakmal@gmail.com', NULL, '$2y$10$Ul/KWs6CN/.52Pnjs3FbHOfBRwNYCHYV0AQ0KDtdX/gd5X7BaZwky', 'Pengawas', '197510262009021001', 'userdefault.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '081315031403', NULL, NULL, NULL, 6, NULL, '2024-10-17 04:03:16', '2024-10-17 04:03:16'),
(27, 'Dra. Hj. Ngatini, MM', 'ngatini@gmail.com', NULL, '$2y$10$pE.hKJJ.WymfD9kcTrokKOEysf/gSMLxzfWgeME7EjagfWLBxrCc2', 'Pengawas', '196606241994032006', '20241028081538_rZxgmo6Ha2.jpg', 'Pengawas Sekolah Ahli Madya', 'Pembina Tk.I', 'Ivb', '081386049690', NULL, NULL, NULL, 6, NULL, '2024-10-17 04:03:16', '2024-10-28 08:15:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aspek_program`
--
ALTER TABLE `aspek_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru_m`
--
ALTER TABLE `guru_m`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_m_kabupaten_id_index` (`kabupaten_id`),
  ADD KEY `guru_m_sekolah_id_index` (`sekolah_id`);

--
-- Indexes for table `jenis_program`
--
ALTER TABLE `jenis_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategory`
--
ALTER TABLE `kategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_kabupaten`
--
ALTER TABLE `master_kabupaten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_tupoksi`
--
ALTER TABLE `master_tupoksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profilemarketpalces`
--
ALTER TABLE `profilemarketpalces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_index` (`user_id`);

--
-- Indexes for table `rencakakerja_t`
--
ALTER TABLE `rencakakerja_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sekolahbinaan_t`
--
ALTER TABLE `sekolahbinaan_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sekolah_m`
--
ALTER TABLE `sekolah_m`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sekolah_m_kabupaten_id_index` (`kabupaten_id`);

--
-- Indexes for table `sub_kategory`
--
ALTER TABLE `sub_kategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_gol_pangkat_ruang`
--
ALTER TABLE `table_gol_pangkat_ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanggapan_umpanbalik_t`
--
ALTER TABLE `tanggapan_umpanbalik_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugaskerja_t`
--
ALTER TABLE `tugaskerja_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `umpanbalik_m`
--
ALTER TABLE `umpanbalik_m`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `umpanbalik_t`
--
ALTER TABLE `umpanbalik_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_kabupaten_id_index` (`kabupaten_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aspek_program`
--
ALTER TABLE `aspek_program`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guru_m`
--
ALTER TABLE `guru_m`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis_program`
--
ALTER TABLE `jenis_program`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategory`
--
ALTER TABLE `kategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_kabupaten`
--
ALTER TABLE `master_kabupaten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_tupoksi`
--
ALTER TABLE `master_tupoksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pelaporan`
--
ALTER TABLE `pelaporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `profilemarketpalces`
--
ALTER TABLE `profilemarketpalces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rencakakerja_t`
--
ALTER TABLE `rencakakerja_t`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sekolahbinaan_t`
--
ALTER TABLE `sekolahbinaan_t`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `sekolah_m`
--
ALTER TABLE `sekolah_m`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT for table `sub_kategory`
--
ALTER TABLE `sub_kategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `table_gol_pangkat_ruang`
--
ALTER TABLE `table_gol_pangkat_ruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tanggapan_umpanbalik_t`
--
ALTER TABLE `tanggapan_umpanbalik_t`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugaskerja_t`
--
ALTER TABLE `tugaskerja_t`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `umpanbalik_m`
--
ALTER TABLE `umpanbalik_m`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `umpanbalik_t`
--
ALTER TABLE `umpanbalik_t`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
