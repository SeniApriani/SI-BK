-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2026 at 04:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_bk`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_guru`
--

CREATE TABLE `data_guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `kelas_wali` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_guru`
--

INSERT INTO `data_guru` (`id_guru`, `nama_guru`, `nip`, `username`, `password`, `role`, `kelas_wali`) VALUES
(5, 'Kiki Saepullah', '12345678', 'walikelas10', 'siBK2026', 'wali_kelas', 'X TKJ'),
(6, 'Rita Ratnasari', '666666666', 'walikelas11', 'siBK2026', 'wali_kelas', 'XI TKJ');

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `nama_siswa`, `nisn`, `kelas`) VALUES
(3, 'Rafa Nur Alam Fasa', '0051234569', 'XI TKJ'),
(6, 'Lail', '0051234560', 'X TKJ'),
(7, 'Rifan', '0051234564', 'X TKJ'),
(8, 'Rafa', '005123477', 'XI TKJ'),
(10, 'Adam', '1234', 'X TKJ'),
(11, 'Dahlia ', '4321', 'XII TKJ'),
(12, 'Ainun', '555', 'XI TKJ'),
(14, 'pi', '000', 'X TKJ'),
(15, 'Rahma', '777', 'XI TKJ'),
(16, 'Fara', '666', 'XII TKJ'),
(17, 'Dali', '111', 'X TKJ');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis_pelanggaran` varchar(500) DEFAULT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_pelanggaran`
--

INSERT INTO `jenis_pelanggaran` (`id_pelanggaran`, `kategori`, `jenis_pelanggaran`, `poin`) VALUES
(1, 'Kelakuan', ' Mencorat coret sarana prasarana sekolah.', 10),
(2, 'Kerajinan', 'Tidak masuk sekolah (tanpa ada keterangan)', 7),
(3, 'Kerapian', 'Bertatto/bertindik/piercing dan sejenisnya', 15),
(7, 'Kerapian', 'Mengecat rambut selain warna hitam', 5),
(8, 'Kelakuan', 'Mencuri dan atau/ merampas hak milik orang lain', 75),
(9, 'Kelakuan', 'Menggunakan laptop, hp, music player pada saat pembelajaran (tanpa ijin  guru).', 5),
(11, 'Kerajinan', 'Terlambat menyerahkan tugas mata pelajaran', 5),
(18, 'Kerapian', 'Memelihara rambut tidak sesuai ketentuan (model dan bentuk) dan/atau membuat/menyusun rambut sebagai model hiasan kepala', 5),
(19, 'Kerapian', 'Memakai pakaian/bentuk pakaian/kelengkapan sekolah tidak sesuai ketentuan/atribut tidak lengkap', 4),
(20, 'Kerapian', 'Memakai ikat pinggang/kaos kaki/sepatu tidak sesuai ketentuan', 4),
(21, 'Kerapian', 'Siswa putra memakai perhiasan (gelang, kalung, dll)', 2),
(22, 'Kerapian', 'Siswa putri memakai perhiasan serta make-up berlebihan', 2),
(23, 'Kerapian', 'Memakai jaket/sweater di dalam lingkungan sekolah (kecuali ada surat izin)', 2),
(24, 'Kerajinan', 'Tidak mengikuti upacara/apel tanpa ijin', 10),
(25, 'Kerajinan', 'Tidak menyerahkan atau tidak mengerjakan tugas mata pelajaran', 5),
(26, 'Kerajinan', 'Tidak mengikuti kegiatan sekolah (selain item B.1) yang telah ditentukan', 5),
(27, 'Kerajinan', 'Terlambat menyerahkan tugas mata pelajaran', 5),
(28, 'Kerajinan', 'Tidak membawa buku pelajaran sesuai jadwal', 5),
(29, 'Kerajinan', 'Tidak mengikuti kegiatan ekstrakurikuler tanpa keterangan', 3),
(30, 'Kelakuan', 'Membawa atau mengkonsumsi miras, ganja, narkoba dan sejenisnya di sekolah', 100),
(31, 'Kelakuan', 'Membawa, menonton, dan/atau mengedarkan barang porno di sekolah', 100),
(32, 'Kelakuan', 'Melakukan tindak pidana atau terlibat tindak pidana (pencopetan, pemerasan, dll)', 100),
(33, 'Kelakuan', 'Menganiaya atau mengintimidasi guru, kepala sekolah, karyawan, dan teman', 100),
(34, 'Kelakuan', 'Melakukan tindakan/kegiatan/perbuatan asusila', 75),
(35, 'Kelakuan', 'Membawa atau berkelahi menggunakan senjata tajam atau senjata api', 75),
(36, 'Kelakuan', 'Berjudi, taruhan atau sejenisnya di lingkungan sekolah', 75),
(37, 'Kelakuan', 'Berkelahi dan/atau terlibat perkelahian (tanpa menggunakan senjata)', 50),
(38, 'Kelakuan', 'Mengancam warga sekolah', 50),
(39, 'Kelakuan', 'Memalsukan tandatangan orang tua, guru, kepala sekolah, dan karyawan', 50),
(40, 'Kelakuan', 'Memalsukan stempel sekolah', 50),
(41, 'Kelakuan', 'Mengikuti atau menjadi anggota organisasi terlarang', 50),
(42, 'Kelakuan', 'Menerobos atau melompat pagar', 25),
(43, 'Kelakuan', 'Mencemarkan nama baik sekolah/guru/karyawan', 25),
(44, 'Kelakuan', 'Bersikap tidak sopan terhadap guru/kepala sekolah/karyawan', 25),
(45, 'Kelakuan', 'Merusak sarana prasarana sekolah atau warga sekolah', 25),
(46, 'Kelakuan', 'Merokok atau membawa rokok/korek api di lingkungan sekolah atau luar sekolah saat berseragam', 25),
(47, 'Kelakuan', 'Membuat pernyataan bohong/dusta/palsu', 25),
(48, 'Kelakuan', 'Meninggalkan kelas/pembelajaran tanpa izin guru', 20),
(49, 'Kelakuan', 'Mengabaikan surat panggilan dari sekolah', 20),
(50, 'Kelakuan', 'Mengabaikan panggilan guru/kepala sekolah/karyawan', 20),
(51, 'Kelakuan', 'Membuat gaduh atau mengganggu kegiatan pembelajaran', 15),
(52, 'Kelakuan', 'Berada di kantin atau tempat parkir saat pembelajaran tanpa izin', 10),
(53, 'Kelakuan', 'Menggunakan kendaraan bermotor tidak sesuai aturan kepolisian', 10),
(54, 'Kelakuan', 'Membuang sampah sembarangan atau merusak taman', 5),
(55, 'Kelakuan', 'Tidak memarkir kendaraan di tempat yang ditentukan', 5),
(56, 'Kelakuan', 'Mencontek atau kerja sama saat ujian', 5),
(57, 'Kelakuan', 'Membaca komik/bermain kartu saat pelajaran', 5),
(58, 'Kelakuan', 'Menggunakan laptop/HP/media player saat pelajaran tanpa izin', 5);

-- --------------------------------------------------------

--
-- Table structure for table `komunikasi_ortu`
--

CREATE TABLE `komunikasi_ortu` (
  `id_komunikasi` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis_pertemuan` varchar(50) DEFAULT NULL,
  `file_ba` varchar(255) DEFAULT NULL,
  `status` enum('proses','selesai') DEFAULT 'proses',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_ortu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komunikasi_ortu`
--

INSERT INTO `komunikasi_ortu` (`id_komunikasi`, `id_siswa`, `tanggal`, `jenis_pertemuan`, `file_ba`, `status`, `created_at`, `nama_ortu`) VALUES
(11, 7, '2026-06-11', 'Sekolah', '1781143429_Tugas_Perbaikan_Nilai_INLAN.pdf', 'proses', '2026-06-11 02:03:49', 'Jaya'),
(12, 7, '2026-06-15', 'Home Visit', '1781447821_ChatGPT Image Jun 7, 2026, 10_21_17 AM.png', 'proses', '2026-06-14 14:37:01', 'Jalan'),
(13, 7, '2026-07-09', 'Sekolah', '1781447900_riwayat remisi.txt', 'proses', '2026-06-14 14:38:20', 'ira'),
(14, 7, '2026-06-30', 'Sekolah', '1781448279_riwayat remisi.txt', 'proses', '2026-06-14 14:44:39', 'Jalan');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status_baca` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `role`, `judul`, `pesan`, `tipe`, `link`, `status_baca`, `created_at`) VALUES
(1, 7, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-14 14:42:23'),
(2, 7, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-14 14:52:08'),
(3, 8, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-14 17:47:49'),
(4, 15, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-14 20:11:24'),
(5, 15, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-14 20:20:04'),
(6, 16, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-14 20:41:52'),
(7, 15, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-14 21:15:26'),
(8, 11, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-15 19:44:19'),
(9, 11, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-15 19:47:22'),
(10, 11, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-15 20:02:00'),
(11, 11, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-15 20:18:10'),
(12, 11, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-15 20:27:39'),
(13, 17, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-15 20:28:25'),
(14, 17, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-15 20:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_siswa`
--

CREATE TABLE `pelanggaran_siswa` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_pelanggaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text DEFAULT NULL,
  `periode_akademik` varchar(30) DEFAULT NULL,
  `poin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`id`, `id_siswa`, `id_pelanggaran`, `tanggal`, `catatan`, `periode_akademik`, `poin`) VALUES
(85, 7, 2, '2026-06-14', 'h', NULL, 7),
(86, 7, 1, '2026-06-14', '-', NULL, 10),
(87, 7, 11, '2026-06-14', 'y', NULL, 5),
(88, 7, 3, '2026-06-14', '-', NULL, 15),
(89, 7, 1, '2026-06-14', '-', NULL, 10),
(92, 6, 11, '2026-06-14', '-', NULL, 5),
(94, 10, 1, '2026-06-10', 'Uji coba pelanggaran bulan ini', NULL, 5),
(95, 14, 1, '2026-06-10', 'uji coba ID 14', NULL, 5),
(96, 8, 1, '2026-05-01', 'Uji coba remisi otomatis', NULL, 5),
(97, 8, 1, '2026-05-01', 'Uji coba remisi otomatis', NULL, 5),
(99, 11, 1, '2026-05-01', NULL, NULL, 10),
(100, 11, 11, '2026-06-14', '-', NULL, 5),
(101, 11, 11, '2026-06-14', '-', NULL, 5),
(102, 7, 9, '2026-06-14', '-', NULL, 5),
(103, 7, 7, '2026-06-14', '-', NULL, 5),
(104, 8, 11, '2026-06-14', '=', NULL, 5),
(106, 15, 1, '2026-05-10', 'Data uji coba remisi otomatis', NULL, 15),
(107, 15, 11, '2026-06-14', '-', NULL, 5),
(108, 16, 3, '2026-06-14', '-', NULL, 15),
(109, 15, 8, '2026-06-14', '-', NULL, 75),
(110, 11, 1, '2026-06-15', '-', '', 10),
(111, 11, 1, '2026-06-15', '=', 'Genap 2025/2026', 10),
(112, 11, 2, '2026-06-15', '-', 'Genap 2025/2026', 7),
(113, 11, 1, '2026-06-15', '-', 'Genap 2025/2026', 10),
(114, 11, 11, '2026-06-15', '-', 'Genap 2025/2026', 5),
(115, 17, 2, '2026-06-15', '-', 'Genap 2025/2026', 7),
(116, 17, 2, '2026-06-15', '-', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_remisi`
--

CREATE TABLE `pengajuan_remisi` (
  `id_remisi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jenis_prestasi` varchar(100) DEFAULT NULL,
  `nama_prestasi` varchar(255) DEFAULT NULL,
  `poin_remisi` int(11) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT current_timestamp(),
  `status` enum('Menunggu','Disetujui','Ditolak') DEFAULT 'Menunggu',
  `kelas` varchar(50) DEFAULT NULL,
  `potongan_poin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_remisi`
--

INSERT INTO `pengajuan_remisi` (`id_remisi`, `id_siswa`, `jenis_prestasi`, `nama_prestasi`, `poin_remisi`, `bukti`, `tanggal_pengajuan`, `status`, `kelas`, `potongan_poin`) VALUES
(55, 7, '15', 'Juara 3 Kelas', 15, 'ChatGPT Image Jun 7, 2026, 10_21_17 AM.png', '2026-06-14 09:14:21', 'Disetujui', NULL, 0),
(56, 11, '25', 'k', 25, 'riwayat remisi.txt', '2026-06-14 11:49:40', 'Disetujui', NULL, 0),
(57, 8, '15', '-', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-14 20:35:21', 'Disetujui', NULL, 7),
(58, 16, '15', '-', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-14 20:42:43', 'Disetujui', NULL, 2),
(59, 16, '15', 'Juara  2 kelas', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-14 20:45:17', 'Ditolak', NULL, 0),
(60, 8, '100', '-', 100, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-14 21:13:56', 'Disetujui', NULL, 42),
(61, 15, '100', '-', 100, 'riwayat remisi.txt', '2026-06-14 21:16:12', 'Disetujui', NULL, 94),
(62, 7, '15', 'Juara 3 Kelas', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 09:13:22', 'Disetujui', NULL, 8),
(63, 7, '25', 'Juara 3 Kelas', 25, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 09:18:06', 'Disetujui', '', 11),
(64, 7, '15', '-', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 09:36:29', 'Disetujui', '', 5),
(65, 7, '15', '-', 15, 'riwayat remisi.txt', '2026-06-15 09:37:29', 'Ditolak', '', 0),
(66, 7, '15', '-', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 09:52:32', 'Menunggu', '', 0),
(67, 7, '15', 'Juara', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 09:53:17', 'Menunggu', '', 0),
(68, 7, '25', 'ujicoba', 25, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 13:21:15', 'Menunggu', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rekap_poin`
--

CREATE TABLE `rekap_poin` (
  `id_rekap` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `total_poin` int(11) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekap_poin`
--

INSERT INTO `rekap_poin` (`id_rekap`, `id_siswa`, `total_poin`, `updated_at`) VALUES
(8, 7, 27, '2026-06-15 02:37:07'),
(17, 14, 5, '2026-06-14 03:07:13'),
(18, 8, 0, '2026-06-14 14:14:01'),
(19, 11, 42, '2026-06-15 13:02:00'),
(21, 15, 0, '2026-06-14 14:16:34'),
(22, 16, 13, '2026-06-14 13:43:10'),
(23, 17, 7, '2026-06-15 13:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `remisi_otomatis`
--

CREATE TABLE `remisi_otomatis` (
  `id_remisi_otomatis` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `persen_remisi` int(11) DEFAULT 6,
  `tanggal_remisi` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `potongan_poin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remisi_otomatis`
--

INSERT INTO `remisi_otomatis` (`id_remisi_otomatis`, `id_siswa`, `persen_remisi`, `tanggal_remisi`, `keterangan`, `potongan_poin`) VALUES
(7, 8, 6, '2026-06-14', 'Tidak melakukan pelanggaran selama 30 hari', 0),
(8, 15, 6, '2026-06-14', 'Tidak melakukan pelanggaran 30 hari', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('wali_kelas','wakasek','kepala_sekolah','siswa') NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`, `id_siswa`, `kelas`) VALUES
(1, 'Wali Kelas', 'wali kelas', 'siBK2026', 'wali_kelas', NULL, NULL),
(5, 'Rafa Nur Alam Fasa', '0051234569', '0051234569', 'siswa', 3, NULL),
(8, 'Lail', '0051234560', '0051234560', 'siswa', 6, NULL),
(9, 'Rifan', '0051234564', '0051234564', 'siswa', 7, NULL),
(10, 'Rafa', '005123477', '005123477', 'siswa', 8, NULL),
(11, 'Wakasek Kesiswaan', 'wakasek', 'siBK2026', 'wakasek', NULL, NULL),
(12, 'Kepala Sekolah', 'kepsek', 'siBK2026', 'kepala_sekolah', NULL, NULL),
(14, 'Kiki Saepullah', 'walikelas10', 'siBK2026', 'wali_kelas', NULL, 'X TKJ'),
(15, 'Rita Ratnasari', 'walikelas11', 'siBK2026', 'wali_kelas', NULL, 'XI TKJ'),
(18, 'Adam', '1234', '1234', 'siswa', 10, NULL),
(19, 'Dahlia ', '4321', '4321', 'siswa', 11, NULL),
(20, 'Ainun', '555', '555', 'siswa', 12, NULL),
(22, 'pi', '000', '000', 'siswa', 14, NULL),
(23, 'Rahma', '777', '777', 'siswa', 15, NULL),
(24, 'Fara', '666', '666', 'siswa', 16, NULL),
(25, 'Dali', '111', '111', 'siswa', 17, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_guru`
--
ALTER TABLE `data_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`);

--
-- Indexes for table `komunikasi_ortu`
--
ALTER TABLE `komunikasi_ortu`
  ADD PRIMARY KEY (`id_komunikasi`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_remisi`
--
ALTER TABLE `pengajuan_remisi`
  ADD PRIMARY KEY (`id_remisi`);

--
-- Indexes for table `rekap_poin`
--
ALTER TABLE `rekap_poin`
  ADD PRIMARY KEY (`id_rekap`),
  ADD UNIQUE KEY `id_siswa` (`id_siswa`),
  ADD UNIQUE KEY `id_siswa_2` (`id_siswa`);

--
-- Indexes for table `remisi_otomatis`
--
ALTER TABLE `remisi_otomatis`
  ADD PRIMARY KEY (`id_remisi_otomatis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_guru`
--
ALTER TABLE `data_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `komunikasi_ortu`
--
ALTER TABLE `komunikasi_ortu`
  MODIFY `id_komunikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `pengajuan_remisi`
--
ALTER TABLE `pengajuan_remisi`
  MODIFY `id_remisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `rekap_poin`
--
ALTER TABLE `rekap_poin`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `remisi_otomatis`
--
ALTER TABLE `remisi_otomatis`
  MODIFY `id_remisi_otomatis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
