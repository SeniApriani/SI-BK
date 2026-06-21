-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 05:10 PM
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
-- Table structure for table `catatan_semester`
--

CREATE TABLE `catatan_semester` (
  `id_catatan` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `catatan_walikelas` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catatan_semester`
--

INSERT INTO `catatan_semester` (`id_catatan`, `id_siswa`, `semester`, `tahun_ajaran`, `catatan_walikelas`, `created_at`) VALUES
(1, 28, 'Ganjil', '2025/2026', 'Bagus', '2026-06-20 13:47:48'),
(2, 23, 'Ganjil', '2025/2026', 'Tingkatkan ya ', '2026-06-21 14:54:28');

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
(18, 'Tami', '321', 'XII TKJ'),
(19, 'Ulfa', '1', 'XII TKJ'),
(20, 'Cuangki', '2', 'XII TKJ'),
(21, 'Saloma', '4528173640', 'X TKJ'),
(23, 'Fardol Sidi', '6247158392', 'X TKJ'),
(25, 'Hironda', '8452916375', 'X TKJ'),
(26, 'Triani', '5362817490', 'XI TKJ'),
(27, 'Wulan Ayu', '6925471830', 'XI TKJ'),
(28, 'Nenden', '7814352691', 'XI TKJ'),
(29, 'Surya', '8246719530', 'XI TKJ'),
(30, 'Sandi', '9572136840', 'XI TKJ'),
(31, 'Fadina', '4718293650', 'XII TKJ'),
(33, 'Rizky Pratama', '7529614380', 'XII TKJ'),
(34, 'Putri Ayunda', '8392175640', 'XII TKJ'),
(35, 'Dimas Saputra', '9645827310', 'XII TKJ'),
(36, 'Zara', '25', 'X TKJ');

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
  `hasil_komunikasi` text DEFAULT NULL,
  `status` enum('proses','selesai') DEFAULT 'proses',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_ortu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komunikasi_ortu`
--

INSERT INTO `komunikasi_ortu` (`id_komunikasi`, `id_siswa`, `tanggal`, `jenis_pertemuan`, `file_ba`, `hasil_komunikasi`, `status`, `created_at`, `nama_ortu`) VALUES
(11, 7, '2026-06-11', 'Sekolah', '1781143429_Tugas_Perbaikan_Nilai_INLAN.pdf', NULL, 'proses', '2026-06-11 02:03:49', 'Jaya'),
(12, 7, '2026-06-15', 'Home Visit', '1781447821_ChatGPT Image Jun 7, 2026, 10_21_17 AM.png', NULL, 'proses', '2026-06-14 14:37:01', 'Jalan'),
(13, 7, '2026-07-09', 'Sekolah', '1781447900_riwayat remisi.txt', NULL, 'proses', '2026-06-14 14:38:20', 'ira'),
(14, 7, '2026-06-30', 'Sekolah', '1781448279_riwayat remisi.txt', NULL, 'proses', '2026-06-14 14:44:39', 'Jalan'),
(15, 23, '2026-06-16', 'Sekolah', '1781626278_Struktur Penulisan BAB III.pdf', NULL, 'proses', '2026-06-16 16:11:18', 'Ira'),
(16, 25, '2026-06-21', 'Sekolah', '1782034649_form pencatatan.png', 'kamu nakl sih', 'proses', '2026-06-21 09:37:29', 'Jalan'),
(17, 25, '2026-06-28', 'Sekolah', '1782035195_form pencatatan.png', 'Untuk membantu saya menyesuaikan format dokumen dengan situasi Anda, beritahu saya:Untuk keperluan apa berita acara ini dibuat? (Misal: pelanggaran disiplin, mediasi masalah antar siswa, atau sosialisasi program sekolah)Apakah ada kesepakatan khusus atau sanksi spesifik yang perlu dimasukkan ke dalam dokumen?\r\ncvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'proses', '2026-06-21 09:46:35', 'ira'),
(18, 25, '2026-06-21', 'Sekolah', '1782035560_g_tahapan penelitian.png', 'BERITA ACARA PEMANGGILAN ORANG TUA / WALI SISWASMA/SMK [Nama Sekolah Anda]Nomor: [Isi Nomor Surat jika ada]Pada hari ini, [Hari, Contoh: Senin], tanggal [Tanggal] bulan [Bulan] tahun [Tahun], telah dilakukan pertemuan dan musyawarah antara pihak sekolah dengan orang tua/wali siswa, terkait pelanggaran tata tertib atau evaluasi perkembangan belajar siswa.Pertemuan ini dihadiri oleh:I. Pihak Sekolah / Wali KelasNama: [Nama Guru / BK]NIP/NUPTK: [Nomor Identitas]Jabatan: [Wali Kelas / Guru BK / Kepala Sekolah]II. Pihak Orang Tua / Wali SiswaNama: [Nama Lengkap Orang Tua]Hubungan dengan Siswa: [Contoh: Ayah / Ibu / Wali]Pekerjaan: [Pekerjaan Orang Tua]Alamat: [Alamat Rumah Orang Tua]Mengenai siswa bersangkutan:Nama Siswa: [Nama Lengkap Siswa]Kelas: [Kelas Siswa]NIS / NISN: [Nomor Induk Siswa]Adapun hasil keputusan dan kesepakatan dalam pertemuan ini adalah sebagai berikut:Bahwa siswa tersebut di atas telah melakukan [Sebutkan jenis pelanggaran / permasalahan secara jelas, misalnya: pelanggaran tata tertib berupa membolos sebanyak 5 kali / penurunan nilai akademik].Pihak sekolah dan orang tua telah melakukan dialog dan pembinaan kepada siswa yang bersangkutan.Pihak orang tua/wali siswa memahami permasalahan tersebut dan akan meningkatkan pengawasan di luar jam sekolah.Pihak orang tua/wali siswa bersedia mematuhi kesepakatan berupa: [Sebutkan sanksi atau surat peringatan jika ada, misalnya: Siswa akan diberikan skorsing selama 3 hari / Siswa wajib mengikuti bimbingan khusus].Demikian Berita Acara ini dibuat dengan sebenarnya dan dalam keadaan sadar, tanpa ada unsur paksaan dari pihak mana pun. Berita Acara ini menjadi bagian yang sah dari dokumen pembinaan siswa di sekolah.Dibuat di : [Nama Kota Sekolah]Pada tanggal : [Tanggal Pembuatan Berita Acara]Pihak Orang Tua / Wali Siswa,                                      Pihak Sekolah,( [Nama Terang Orang Tua] )                                      ( [Nama Terang Guru / Wali Kelas] )Mengetahui,Kepala Sekolah( [Nama Kepala Sekolah dan Gelar] )NIP. [Nomor Induk Pegawai]', 'proses', '2026-06-21 09:52:40', 'Ira'),
(19, 18, '2026-06-22', 'Home Visit', '1782037111_form pencatatan.png', 'Berikut adalah format standar Berita Acara Pemanggilan dan Pembinaan Orang Tua Siswa (konteks sekolah) yang paling umum digunakan. Anda bisa menyesuaikan bagian di dalam tanda kurung siku [...] sesuai dengan situasi spesifik Anda.', 'proses', '2026-06-21 10:18:31', 'Jalan'),
(20, 36, '2026-06-23', 'Home Visit', '1782047430_form pencatatan.png', 'nakal banget ', 'proses', '2026-06-21 13:10:30', 'Iman');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_konseling`
--

CREATE TABLE `laporan_konseling` (
  `id_laporan` int(11) NOT NULL,
  `id_pelanggaran_siswa` int(11) NOT NULL,
  `catatan_konseling` text NOT NULL,
  `tanggal_tindak_lanjut` date DEFAULT NULL,
  `tanggal_konseling` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_konseling`
--

INSERT INTO `laporan_konseling` (`id_laporan`, `id_pelanggaran_siswa`, `catatan_konseling`, `tanggal_tindak_lanjut`, `tanggal_konseling`) VALUES
(2, 149, 'Siswa berjanji tidak akan mengulangi hal serupa', '2026-06-20', '2026-06-20 10:51:45'),
(3, 147, 'Siswa menyepakati tidak akan mengulangi kesalahan', '2026-06-20', '2026-06-20 11:49:54'),
(4, 146, 'Siswa berjanji tidak akan mengulangi kesalahan yang serupa', '2026-06-20', '2026-06-20 12:30:55'),
(5, 150, 'Siswa berjanji ....', '2026-06-22', '2026-06-21 20:09:24');

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
(14, 17, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-15 20:35:38'),
(15, 19, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-16 09:05:41'),
(16, 18, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-16 09:27:20'),
(17, 18, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-16 09:33:03'),
(18, 19, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-16 10:06:08'),
(19, 19, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-16 10:09:12'),
(20, 19, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-16 10:14:14'),
(21, 15, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-16 11:15:49'),
(22, 19, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-16 22:48:50'),
(23, 30, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-20 06:19:47'),
(24, 36, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-21 20:05:52'),
(25, 36, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-21 20:06:32'),
(26, 36, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-21 20:07:51');

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
  `poin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`id`, `id_siswa`, `id_pelanggaran`, `tanggal`, `catatan`, `poin`) VALUES
(85, 7, 2, '2026-06-14', 'h', 7),
(86, 7, 1, '2026-06-14', '-', 10),
(87, 7, 11, '2026-06-14', 'y', 5),
(88, 7, 3, '2026-06-14', '-', 15),
(89, 7, 1, '2026-06-14', '-', 10),
(92, 6, 11, '2026-06-14', '-', 5),
(94, 10, 1, '2026-06-10', 'Uji coba pelanggaran bulan ini', 5),
(95, 14, 1, '2026-06-10', 'uji coba ID 14', 5),
(96, 8, 1, '2026-05-01', 'Uji coba remisi otomatis', 5),
(97, 8, 1, '2026-05-01', 'Uji coba remisi otomatis', 5),
(99, 11, 1, '2026-05-01', NULL, 10),
(100, 11, 11, '2026-06-14', '-', 5),
(101, 11, 11, '2026-06-14', '-', 5),
(102, 7, 9, '2026-06-14', '-', 5),
(103, 7, 7, '2026-06-14', '-', 5),
(104, 8, 11, '2026-06-14', '=', 5),
(106, 15, 1, '2026-05-10', 'Data uji coba remisi otomatis', 15),
(107, 15, 11, '2026-06-14', '-', 5),
(108, 16, 3, '2026-06-14', '-', 15),
(109, 15, 8, '2026-06-14', '-', 75),
(110, 11, 1, '2026-06-15', '-', 10),
(111, 11, 1, '2026-06-15', '=', 10),
(112, 11, 2, '2026-06-15', '-', 7),
(113, 11, 1, '2026-06-15', '-', 10),
(114, 11, 11, '2026-06-15', '-', 5),
(115, 17, 2, '2026-06-15', '-', 7),
(116, 17, 2, '2026-06-15', '-', 7),
(117, 18, 1, '2026-05-10', 'Terlambat datang ke sekolah', 20),
(118, 19, 28, '2026-06-16', '-', 5),
(119, 18, 23, '2026-06-16', '-', 2),
(124, 15, 18, '2026-06-16', '-', 5),
(125, 20, 1, '2026-05-10', 'Pelanggaran bulan Mei (tes)', 5),
(126, 21, 11, '2026-01-05', 'Terlambat menyerahkan tugas', 5),
(127, 21, 54, '2026-01-18', 'Membuang sampah sembarangan', 5),
(128, 22, 20, '2026-01-08', 'Ikat pinggang tidak sesuai', 4),
(129, 22, 29, '2026-01-22', 'Tidak mengikuti ekstrakurikuler', 3),
(130, 23, 24, '2026-01-10', 'Tidak mengikuti upacara', 10),
(131, 23, 28, '2026-01-27', 'Tidak membawa buku pelajaran', 5),
(132, 24, 19, '2026-01-12', 'Pakaian tidak sesuai ketentuan', 4),
(133, 24, 23, '2026-01-21', 'Memakai jaket saat pembelajaran', 2),
(134, 24, 55, '2026-01-30', 'Tidak memarkir kendaraan pada tempatnya', 5),
(135, 25, 52, '2026-01-07', 'Berada di kantin saat jam pelajaran', 10),
(136, 25, 57, '2026-01-16', 'Membaca komik saat pelajaran', 5),
(137, 25, 42, '2026-01-28', 'Menerobos pagar sekolah', 25),
(138, 23, 51, '2026-02-04', 'Membuat gaduh saat pembelajaran', 15),
(139, 23, 54, '2026-02-18', 'Membuang sampah sembarangan', 5),
(140, 24, 11, '2026-02-06', 'Terlambat menyerahkan tugas', 5),
(141, 24, 52, '2026-02-20', 'Berada di kantin saat jam pelajaran', 10),
(142, 25, 42, '2026-02-10', 'Menerobos pagar sekolah', 25),
(146, 21, 11, '2026-03-12', 'Terlambat menyerahkan tugas mata pelajaran', 5),
(147, 21, 11, '2026-06-15', 'Terlambat sekolah', 5),
(148, 19, 43, '2026-06-16', '-', 25),
(149, 30, 3, '2026-06-20', 'nakal', 15),
(150, 36, 37, '2026-06-21', 'Siswa berkelahi', 50),
(151, 36, 22, '2026-06-21', 'memakai soflent', 2),
(152, 36, 22, '2026-06-21', 'memakai kacamta bavkkpinkk', 2);

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
(66, 7, '15', '-', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 09:52:32', 'Disetujui', '', 3),
(67, 7, '15', 'Juara', 15, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 09:53:17', 'Menunggu', '', 0),
(68, 7, '25', 'ujicoba', 25, 'WhatsApp Image 2026-06-14 at 4.47.38 PM.jpeg', '2026-06-15 13:21:15', 'Menunggu', '', 0),
(77, 19, '15', 'Juara  2 kelas', 15, 'Sertifikat Project Basic Web_Page_27.jpg', '2026-06-16 22:49:34', 'Disetujui', '', 4),
(79, 21, '15', 'Juara 3 Kelas', 15, 'Sertifikat Materi HTML_Page_22.jpg', '2026-06-16 22:55:35', 'Disetujui', 'X TKJ', 3),
(80, 0, '50', 'juara di hati', 50, 'penjelasan menu komunikasi.docx', '2026-06-21 20:14:14', 'Menunggu', NULL, 0),
(81, 36, '50', 'juara di hati', 50, 'penjelasan menu komunikasi.docx', '2026-06-21 20:15:47', 'Disetujui', '', 27),
(82, 36, '25', 'juara di hati', 25, 'penjelasan menu komunikasi.docx', '2026-06-21 20:17:03', 'Disetujui', '', 7);

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
(8, 7, 20, '2026-06-16 15:51:09'),
(17, 14, 5, '2026-06-14 03:07:13'),
(18, 8, 0, '2026-06-14 14:14:01'),
(19, 11, 42, '2026-06-15 13:02:00'),
(21, 15, 5, '2026-06-16 04:16:41'),
(22, 16, 13, '2026-06-14 13:43:10'),
(23, 17, 7, '2026-06-15 13:35:38'),
(26, 18, 21, '2026-06-16 02:37:16'),
(27, 20, 4, '2026-06-16 04:33:56'),
(28, 21, 14, '2026-06-16 15:55:50'),
(29, 22, 1, '2026-06-16 15:09:54'),
(30, 23, 35, '2026-06-16 16:04:28'),
(31, 24, 20, '2026-06-16 15:09:54'),
(32, 25, 65, '2026-06-20 12:55:58'),
(33, 19, 26, '2026-06-16 16:06:38'),
(34, 30, 15, '2026-06-19 23:19:47'),
(35, 36, 20, '2026-06-21 13:17:09');

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
(8, 15, 6, '2026-06-14', 'Tidak melakukan pelanggaran 30 hari', 1),
(10, 18, 6, '2026-06-10', 'Tidak melakukan pelanggaran selama 1 bulan berturut-turut', 1),
(12, 20, 6, '2026-06-16', 'Tidak melakukan pelanggaran 30 hari', 1),
(13, 21, 6, '2026-02-17', 'Tidak melakukan pelanggaran selama 1 bulan berturut-turut', 1),
(14, 22, 6, '2026-02-21', 'Remisi otomatis karena tidak melakukan pelanggaran selama 1 bulan berturut-turut', 1),
(42, 21, 6, '2026-04-11', 'Tidak melakukan pelanggaran selama 1 bulan berturut-turut', 1),
(43, 21, 6, '2026-05-11', 'Tidak melakukan pelanggaran selama 1 bulan berturut-turut', 1);

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
(25, 'Dali', '111', '111', 'siswa', 17, NULL),
(26, 'Tami', '321', '321', 'siswa', 18, NULL),
(27, 'Ulfa', '1', '1', 'siswa', 19, NULL),
(28, 'Cuangki', '2', '2', 'siswa', 20, NULL),
(29, 'Saloma', '4528173640', '4528173640', 'siswa', 21, 'X TKJ'),
(30, 'Wildiana', '5819362741', '5819362741', 'siswa', 22, 'X TKJ'),
(31, 'Fardol Sidi', '6247158392', '6247158392', 'siswa', 23, 'X TKJ'),
(32, 'Yuriska', '7138529460', '7138529460', 'siswa', 24, 'X TKJ'),
(33, 'Hironda', '8452916375', '8452916375', 'siswa', 25, 'X TKJ'),
(34, 'Triani', '5362817490', '5362817490', 'siswa', 26, 'XI TKJ'),
(35, 'Wulan Ayu', '6925471830', '6925471830', 'siswa', 27, 'XI TKJ'),
(36, 'Nenden', '7814352691', '7814352691', 'siswa', 28, 'XI TKJ'),
(37, 'Surya', '8246719530', '8246719530', 'siswa', 29, 'XI TKJ'),
(38, 'Sandi', '9572136840', '9572136840', 'siswa', 30, 'XI TKJ'),
(39, 'Fadina', '4718293650', '4718293650', 'siswa', 31, 'XII TKJ'),
(41, 'Rizky Pratama', '7529614380', '7529614380', 'siswa', 33, 'XII TKJ'),
(42, 'Putri Ayunda', '8392175640', '8392175640', 'siswa', 34, 'XII TKJ'),
(43, 'Dimas Saputra', '9645827310', '9645827310', 'siswa', 35, 'XII TKJ'),
(44, 'Zara', '25', '25', 'siswa', 36, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan_semester`
--
ALTER TABLE `catatan_semester`
  ADD PRIMARY KEY (`id_catatan`);

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
-- Indexes for table `laporan_konseling`
--
ALTER TABLE `laporan_konseling`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_pelanggaran_siswa` (`id_pelanggaran_siswa`);

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
-- AUTO_INCREMENT for table `catatan_semester`
--
ALTER TABLE `catatan_semester`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_guru`
--
ALTER TABLE `data_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `komunikasi_ortu`
--
ALTER TABLE `komunikasi_ortu`
  MODIFY `id_komunikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `laporan_konseling`
--
ALTER TABLE `laporan_konseling`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `pengajuan_remisi`
--
ALTER TABLE `pengajuan_remisi`
  MODIFY `id_remisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `rekap_poin`
--
ALTER TABLE `rekap_poin`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `remisi_otomatis`
--
ALTER TABLE `remisi_otomatis`
  MODIFY `id_remisi_otomatis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_konseling`
--
ALTER TABLE `laporan_konseling`
  ADD CONSTRAINT `laporan_konseling_ibfk_1` FOREIGN KEY (`id_pelanggaran_siswa`) REFERENCES `pelanggaran_siswa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
