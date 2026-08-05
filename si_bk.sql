-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2026 at 03:05 PM
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
(4, 41, 'Ganjil', '2025/2026', 'Menunjukkan sikap disiplin dan tanggung jawab yang sangat baik selama semester berjalan. Aktif mengikuti kegiatan pembelajaran, mematuhi tata tertib sekolah, serta mampu menjadi teladan bagi teman sebaya.', '2026-06-24 15:01:00'),
(5, 40, 'Ganjil', '2025/2026', 'Menunjukkan sikap disiplin dan tanggung jawab yang sangat baik selama semester berjalan. Aktif mengikuti kegiatan pembelajaran, mematuhi tata tertib sekolah, serta mampu menjadi teladan bagi teman sebaya.', '2026-06-24 15:01:11'),
(6, 37, 'Ganjil', '2025/2026', 'Menunjukkan perilaku yang baik selama semester berjalan. Masih terdapat beberapa pelanggaran ringan, namun siswa mampu memperbaiki diri setelah diberikan pembinaan dan menunjukkan perkembangan yang positif.', '2026-06-24 15:01:27'),
(7, 93, 'Ganjil', '2025/2026', 'Sangat disiplin dan mampu menjaga perilaku dengan baik. Diharapkan tetap mempertahankan sikap positif ini.', '2026-07-11 14:36:54'),
(8, 101, 'Ganjil', '2025/2026', 'Terdapat beberapa pelanggaran ringan, namun secara keseluruhan masih menunjukkan perilaku yang baik. Perlu lebih berhati-hati agar tidak mengulangi pelanggaran.', '2026-07-11 14:37:12'),
(9, 44, 'Ganjil', '2025/2026', 'Sangat disiplin dan mampu menjaga perilaku dengan baik. Diharapkan tetap mempertahankan sikap positif ini.', '2026-07-11 14:37:31'),
(10, 102, 'Ganjil', '2025/2026', 'Beberapa pelanggaran masih ditemukan selama semester ini. Diperlukan komitmen yang lebih baik agar tidak menambah akumulasi poin pelanggaran.', '2026-07-11 14:37:47'),
(11, 95, 'Ganjil', '2025/2026', 'Beberapa pelanggaran masih ditemukan selama semester ini. Diperlukan komitmen yang lebih baik agar tidak menambah akumulasi poin pelanggaran.', '2026-07-11 14:38:07'),
(12, 94, 'Ganjil', '2025/2026', 'Diharapkan terus memperbaiki sikap dan menjaga kedisiplinan sehingga tidak terjadi penambahan poin pelanggaran', '2026-07-11 14:39:55'),
(13, 108, 'Ganjil', '2025/2026', 'Menunjukkan komitmen untuk berubah menjadi lebih baik. Pertahankan dan tingkatkan perilaku positif tersebut.', '2026-07-11 14:40:22');

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
(5, 'Kiki Saepullah', '	198811302012011008', 'walikelas10', 'siBK2026', 'wali_kelas', 'X TKJ'),
(6, 'Rita Ratnasari', '	199007222015022003', 'walikelas11', 'siBK2026', 'wali_kelas', 'XI TKJ'),
(8, 'Liyana Septiani', '	198503152010011009', 'walikelas12', 'siBK2026', 'wali_kelas', 'XII TKJ');

-- --------------------------------------------------------

--
-- Table structure for table `data_orang_tua`
--

CREATE TABLE `data_orang_tua` (
  `id_orangtua` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama_orangtua` varchar(100) NOT NULL,
  `hubungan` enum('Ayah','Ibu','Wali') NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_orang_tua`
--

INSERT INTO `data_orang_tua` (`id_orangtua`, `id_siswa`, `nama_orangtua`, `hubungan`, `no_hp`, `alamat`) VALUES
(1, 88, 'Rahmawati', 'Ibu', '088200285673', 'Desa Sayang, Jatinangor'),
(2, 93, 'Yamin', 'Ibu', NULL, NULL),
(3, 47, 'Amina', 'Ibu', NULL, NULL),
(4, 74, 'Adi ', 'Ayah', '088200285532', 'Desa Mekargalih, Jatinangor'),
(5, 87, 'Mia Ningsih', 'Ibu', '0875423889', 'Desa Cipacing, Jatinangor'),
(7, 56, 'Jajang Arif', 'Ayah', '088200285679', 'Jl. Kiara Beres Rt 06/Rw 05 Kec. Jatinangor, Kab. Sumedang');

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
(37, 'Yuriska Pratiwi', '0051837264', 'X TKJ'),
(38, 'Fahrul Sidiq', '0072946185', 'XI TKJ'),
(40, 'Resti Ratnasari', '0085629371', 'X TKJ'),
(41, 'Firmansyah', '0091847256', 'X TKJ'),
(43, 'Feri Irawan', '0078361952', 'XI TKJ'),
(44, 'Dani Tirtana', '0062958471', 'XII TKJ'),
(46, 'Asep Nugraha', '0091847256', 'X TKJ'),
(47, 'Dede Suhendar', '0091847257', 'X TKJ'),
(48, 'Rina Apriani', '0091847258', 'X TKJ'),
(49, 'Yayan Mulyana', '0091847259', 'X TKJ'),
(50, 'Tati Sumiati', '0091847260', 'X TKJ'),
(51, 'Ujang Kurnia', '0091847261', 'X TKJ'),
(52, 'Euis Komalasari', '0091847262', 'X TKJ'),
(53, 'Rudi Hartono', '0091847263', 'X TKJ'),
(54, 'Yudi Hermawan', '0091847264', 'X TKJ'),
(55, 'Siti Nurjanah', '0091847265', 'X TKJ'),
(56, 'Agus Setiawan', '0091847266', 'X TKJ'),
(57, 'Nia Kurniasih', '0091847267', 'X TKJ'),
(58, 'Dian Permata', '0091847268', 'X TKJ'),
(59, 'Rizki Maulana', '0091847269', 'X TKJ'),
(60, 'Fitri Handayani', '0091847270', 'X TKJ'),
(61, 'Ilham Fauzi', '0091847271', 'X TKJ'),
(62, 'Rani Oktaviani', '0091847272', 'X TKJ'),
(63, 'Fajar Hidayat', '0091847273', 'X TKJ'),
(64, 'Wulan Sari', '0091847274', 'X TKJ'),
(65, 'Andri Saputra', '0091847275', 'X TKJ'),
(66, 'Rahmat Hidayat', '0091847276', 'XI TKJ'),
(67, 'Lina Marlina', '0091847277', 'XI TKJ'),
(70, 'Rendi Kurniawan', '0091847280', 'XI TKJ'),
(71, 'Putri Ayuningtyas', '0091847281', 'XI TKJ'),
(72, 'Deni Firmansyah', '0091847282', 'XI TKJ'),
(73, 'Intan Permatasari', '0091847283', 'XI TKJ'),
(74, 'Arif Setiawan', '0091847284', 'XI TKJ'),
(75, 'Nabila Safitri', '0091847285', 'XI TKJ'),
(76, 'Bagas Saputra', '0091847286', 'XI TKJ'),
(77, 'Yuni Kartika', '0091847287', 'XI TKJ'),
(78, 'Fikri Ramadhan', '0091847288', 'XI TKJ'),
(79, 'Salsa Amelia', '0091847289', 'XI TKJ'),
(80, 'Rio Maulana', '0091847290', 'XI TKJ'),
(81, 'Meylani Putri', '0091847291', 'XI TKJ'),
(82, 'Aldi Kurnia', '0091847292', 'XI TKJ'),
(83, 'Desi Handayani', '0091847293', 'XI TKJ'),
(84, 'Galih Prakoso', '0091847294', 'XI TKJ'),
(85, 'Citra Lestari', '0091847295', 'XI TKJ'),
(86, 'Rizal Fauzan', '0091847296', 'XI TKJ'),
(87, 'Anisa Maharani', '0091847297', 'XI TKJ'),
(88, 'Iqbal Maulana', '0091847298', 'XI TKJ'),
(90, 'Farhan Nugraha', '0091847300', 'XI TKJ'),
(91, 'Raka Pratama', '0091847301', 'XII TKJ'),
(92, 'Nanda Puspitasari', '0091847302', 'XII TKJ'),
(93, 'Aldi Saputra', '0091847303', 'XII TKJ'),
(94, 'Vina Oktaviani', '0091847304', 'XII TKJ'),
(95, 'Dimas Firmansyah', '0091847305', 'XII TKJ'),
(96, 'Siska Maharani', '0091847306', 'XII TKJ'),
(97, 'Fauzan Ramadhan', '0091847307', 'XII TKJ'),
(98, 'Novi Anggraeni', '0091847308', 'XII TKJ'),
(99, 'Reza Maulana', '0091847309', 'XII TKJ'),
(100, 'Tiara Lestari', '0091847310', 'XII TKJ'),
(101, 'Ari Nugroho', '0091847311', 'XII TKJ'),
(102, 'Dewi Kartika', '0091847312', 'XII TKJ'),
(103, 'Yusuf Hidayat', '0091847313', 'XII TKJ'),
(104, 'Melisa Putri', '0091847314', 'XII TKJ'),
(105, 'Hendra Gunawan', '0091847315', 'XII TKJ'),
(106, 'Rina Wulandari', '0091847316', 'XII TKJ'),
(107, 'Fajar Nugraha', '0091847317', 'XII TKJ'),
(108, 'Nisa Rahmawati', '0091847318', 'XII TKJ'),
(109, 'Dian Saputra', '0091847319', 'XII TKJ'),
(111, 'Revina Ayu', '0091887303', 'XII TKJ'),
(119, 'sensen', '10522003', 'XI TKJ');

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
(23, 75, '2026-04-27', 'Sekolah', '1783220489_Berita_Acara_Komunikasi_27_April_2026.pdf', 'Pada tanggal 27 April 2026 telah dilakukan komunikasi dengan orang tua siswa terkait perkembangan perilaku dan kedisiplinan siswa di lingkungan sekolah. Orang tua memahami informasi yang disampaikan oleh pihak sekolah dan menyatakan kesediaannya untuk memberikan perhatian, bimbingan, serta pengawasan yang lebih intensif kepada siswa. Orang tua juga mendukung upaya pembinaan yang dilakukan sekolah demi meningkatkan kedisiplinan dan tanggung jawab siswa.', 'proses', '2026-07-05 03:01:29', 'Sri Wahyuni'),
(24, 90, '2026-05-20', 'Sekolah', '1783220690_Berita_Acara_Komunikasi_20_Mei_2026.pdf', 'Pada tanggal 20 Mei 2026 telah dilakukan komunikasi dengan orang tua siswa terkait perkembangan perilaku dan kedisiplinan siswa di lingkungan sekolah. Orang tua memahami informasi yang disampaikan oleh pihak sekolah dan menyatakan kesediaannya untuk memberikan perhatian, bimbingan, serta pengawasan yang lebih intensif kepada siswa. Orang tua juga mendukung upaya pembinaan yang dilakukan sekolah demi meningkatkan kedisiplinan dan tanggung jawab siswa.', 'proses', '2026-07-05 03:04:50', 'Ade Risma'),
(25, 90, '2026-03-20', 'Sekolah', '1783220777_Berita_Acara_Komunikasi_20_Maret_2026.pdf', 'Pada tanggal 20 Maret 2026 telah dilakukan komunikasi dengan orang tua siswa terkait perkembangan perilaku dan kedisiplinan siswa di lingkungan sekolah. Orang tua memahami informasi yang disampaikan oleh pihak sekolah dan menyatakan kesediaannya untuk memberikan perhatian, bimbingan, serta pengawasan yang lebih intensif kepada siswa. Orang tua juga mendukung upaya pembinaan yang dilakukan sekolah demi meningkatkan kedisiplinan dan tanggung jawab siswa.', 'proses', '2026-07-05 03:06:17', 'Pipit'),
(26, 71, '2026-03-23', 'Home Visit', '1783220923_Berita_Acara_Komunikasi_23_Maret_2026.pdf', 'Pada tanggal 23 Maret 2026 telah dilakukan komunikasi dengan orang tua siswa terkait perkembangan perilaku dan kedisiplinan siswa di lingkungan sekolah. Orang tua memahami informasi yang disampaikan oleh pihak sekolah dan menyatakan kesediaannya untuk memberikan perhatian, bimbingan, serta pengawasan yang lebih intensif kepada siswa. Orang tua juga mendukung upaya pembinaan yang dilakukan sekolah demi meningkatkan kedisiplinan dan tanggung jawab siswa.', 'proses', '2026-07-05 03:08:43', 'Deden'),
(27, 86, '2026-02-22', 'Sekolah', '1783221090_Berita_Acara_Komunikasi_22_Februari_2026.pdf', 'Pada tanggal 27 April 2026 telah dilakukan komunikasi dengan orang tua siswa terkait perkembangan perilaku dan kedisiplinan siswa di lingkungan sekolah. Orang tua memahami informasi yang disampaikan oleh pihak sekolah dan menyatakan kesediaannya untuk memberikan perhatian, bimbingan, serta pengawasan yang lebih intensif kepada siswa. Orang tua juga mendukung upaya pembinaan yang dilakukan sekolah demi meningkatkan kedisiplinan dan tanggung jawab siswa.', 'proses', '2026-07-05 03:11:30', 'Riska Purwasari'),
(28, 94, '2026-05-19', 'Sekolah', '1783223421_Surat Pernyataan_19 Mei.pdf', 'Pada tanggal 19 Mei 2026 telah dilakukan komunikasi dengan orang tua siswa terkait perkembangan perilaku dan kedisiplinan siswa di lingkungan sekolah. Orang tua memahami informasi yang disampaikan oleh pihak sekolah dan menyatakan kesediaannya untuk memberikan perhatian, bimbingan, serta pengawasan yang lebih intensif kepada siswa. Orang tua juga mendukung upaya pembinaan yang dilakukan sekolah demi meningkatkan kedisiplinan dan tanggung jawab siswa.', 'proses', '2026-07-05 03:50:21', 'Wildansyah'),
(29, 95, '2026-04-27', 'Sekolah', '1783223713_Surat Pernyataan.pdf', 'Pada tanggal 27 April 2026 telah dilakukan komunikasi dengan orang tua siswa terkait perkembangan perilaku dan kedisiplinan siswa di lingkungan sekolah. Orang tua memahami informasi yang disampaikan oleh pihak sekolah dan menyatakan kesediaannya untuk memberikan perhatian, bimbingan, serta pengawasan yang lebih intensif kepada siswa. Orang tua juga mendukung upaya pembinaan yang dilakukan sekolah demi meningkatkan kedisiplinan dan tanggung jawab siswa.', 'proses', '2026-07-05 03:55:13', 'Iman'),
(30, 93, '2026-07-13', 'Sekolah', '1783958655_Berita_Acara_Komunikasi_20_Maret_2026.pdf', 'Pada hari seninsudah dilakukan pertemuan bersamaorang tua membahasa kesepakatan tindak lanjut pelanggran siswa ', 'proses', '2026-07-13 16:04:15', 'Yamin');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_konseling`
--

CREATE TABLE `laporan_konseling` (
  `id_laporan` int(11) NOT NULL,
  `id_pelanggaran_siswa` int(11) NOT NULL,
  `catatan_konseling` text NOT NULL,
  `tanggal_tindak_lanjut` date DEFAULT NULL,
  `tanggal_konseling` datetime DEFAULT current_timestamp(),
  `status` varchar(30) NOT NULL DEFAULT 'menunggu_pembinaan',
  `hasil_konseling` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_konseling`
--

INSERT INTO `laporan_konseling` (`id_laporan`, `id_pelanggaran_siswa`, `catatan_konseling`, `tanggal_tindak_lanjut`, `tanggal_konseling`, `status`, `hasil_konseling`) VALUES
(20, 191, 'Siswa diberikan pembinaan mengenai pentingnya kedisiplinan kehadiran serta tanggung jawab untuk memberikan informasi apabila berhalangan hadir. Dari hasil konseling diketahui siswa memilih tidak masuk sekolah tanpa menyampaikan alasan kepada orang tua maupun wali kelas. Wali Kelas menjelaskan dampak ketidakhadiran terhadap proses pembelajaran dan penilaian akademik. Sebagai tindak lanjut, dilakukan koordinasi dengan orang tua untuk meningkatkan pengawasan terhadap kehadiran siswa. Siswa berkomitmen untuk hadir secara teratur dan segera memberikan keterangan apabila tidak dapat mengikuti kegiatan sekolah.', '2026-02-13', '2026-06-24 21:50:50', 'menunggu_pembinaan', NULL),
(47, 252, 'Siswa dipanggil ke ruang BK terkait pelanggaran tidak membawa buku pelajaran sesuai jadwal. Siswa diberikan pembinaan agar lebih disiplin dalam mempersiapkan perlengkapan sekolah sebelum pembelajaran dimulai.', '2026-01-08', '2026-01-06 10:00:00', 'menunggu_pembinaan', NULL),
(48, 251, 'Siswa tidak membawa buku pelajaran sesuai jadwal. Siswa diberikan arahan agar selalu mengecek perlengkapan belajar sebelum masuk kelas.', '2026-01-07', '2026-01-05 10:10:00', 'menunggu_pembinaan', NULL),
(53, 190, 'Siswa melakukan pelanggaran kerapian dan fasilitas sekolah. Siswa diberikan pembinaan mengenai pentingnya menjaga lingkungan sekolah.', '2026-01-18', '2026-01-15 10:00:00', 'menunggu_pembinaan', NULL),
(74, 191, 'Siswa tidak mengikuti kegiatan pembelajaran dengan baik tanpa keterangan yang jelas. Siswa diberikan konseling mengenai tanggung jawab mengikuti pelajaran.', '2026-02-15', '2026-02-12 10:10:00', 'menunggu_pembinaan', NULL),
(94, 339, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(95, 340, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(96, 341, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(97, 342, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan. Tindak lanjut: siswa diberikan tanggung jawab membantu menjaga kebersihan kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(98, 343, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa berjanji lebih disiplin. Tindak lanjut: guru mata pelajaran memonitor penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(99, 344, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen untuk tidak menggunakan HP tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(100, 345, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(101, 346, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(102, 347, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(103, 348, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan. Tindak lanjut: siswa diberikan tanggung jawab membantu menjaga kebersihan kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(104, 349, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa berjanji lebih disiplin. Tindak lanjut: guru mata pelajaran memonitor penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(105, 350, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen untuk tidak menggunakan HP tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(106, 351, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(107, 352, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(108, 353, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(109, 354, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan. Tindak lanjut: siswa diberikan tanggung jawab membantu menjaga kebersihan kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(110, 355, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa berjanji lebih disiplin. Tindak lanjut: guru mata pelajaran memonitor penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(111, 356, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen untuk tidak menggunakan HP tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(112, 357, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(113, 358, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(114, 359, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(115, 360, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan. Tindak lanjut: siswa diberikan tanggung jawab membantu menjaga kebersihan kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(116, 361, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa berjanji lebih disiplin. Tindak lanjut: guru mata pelajaran memonitor penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(117, 362, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen untuk tidak menggunakan HP tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(118, 363, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(119, 364, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(120, 365, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(121, 366, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan. Tindak lanjut: siswa diberikan tanggung jawab membantu menjaga kebersihan kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(122, 367, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa berjanji lebih disiplin. Tindak lanjut: guru mata pelajaran memonitor penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(123, 368, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen untuk tidak menggunakan HP tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(124, 369, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(125, 370, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan belajar yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(126, 371, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(127, 372, 'Dilaksanakan konseling mengenai pentingnya menjaga kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan kelas maupun lingkungan sekolah. Tindak lanjut: siswa diminta ikut kegiatan kebersihan kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(128, 373, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa menyampaikan kesediaannya untuk lebih disiplin. Tindak lanjut: guru mata pelajaran memantau penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(129, 374, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(130, 375, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(131, 376, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan belajar yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(132, 377, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(133, 378, 'Dilaksanakan konseling mengenai pentingnya menjaga kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan kelas maupun lingkungan sekolah. Tindak lanjut: siswa diminta ikut kegiatan kebersihan kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(134, 379, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa menyampaikan kesediaannya untuk lebih disiplin. Tindak lanjut: guru mata pelajaran memantau penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(135, 380, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(136, 381, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(137, 382, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan belajar yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(138, 383, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(139, 384, 'Dilaksanakan konseling mengenai pentingnya menjaga kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan kelas maupun lingkungan sekolah. Tindak lanjut: siswa diminta ikut kegiatan kebersihan kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(140, 385, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa menyampaikan kesediaannya untuk lebih disiplin. Tindak lanjut: guru mata pelajaran memantau penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(141, 386, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(142, 387, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(143, 388, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan belajar yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(144, 389, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(145, 390, 'Dilaksanakan konseling mengenai pentingnya menjaga kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan kelas maupun lingkungan sekolah. Tindak lanjut: siswa diminta ikut kegiatan kebersihan kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(146, 391, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa menyampaikan kesediaannya untuk lebih disiplin. Tindak lanjut: guru mata pelajaran memantau penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(147, 392, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(148, 393, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen memperbaiki manajemen waktu. Tindak lanjut: guru BK berkoordinasi dengan guru mata pelajaran untuk memantau ketepatan pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(149, 394, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa bersedia membuat daftar perlengkapan belajar yang harus dibawa setiap hari. Tindak lanjut: wali kelas melakukan pemantauan selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(150, 395, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib berpakaian di sekolah. Siswa memahami alasan aturan tersebut dan bersedia mematuhinya. Tindak lanjut: guru piket melakukan pemantauan kedisiplinan berpakaian.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(151, 396, 'Dilaksanakan konseling mengenai pentingnya menjaga kebersihan lingkungan sekolah. Siswa menyadari kesalahannya dan bersedia menjaga kebersihan kelas maupun lingkungan sekolah. Tindak lanjut: siswa diminta ikut kegiatan kebersihan kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(152, 397, 'Dilaksanakan konseling mengenai tanggung jawab menyelesaikan tugas sekolah tepat waktu. Siswa menyampaikan kesediaannya untuk lebih disiplin. Tindak lanjut: guru mata pelajaran memantau penyelesaian tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(153, 398, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat komitmen tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(154, 399, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas. Siswa mengakui kurang mengatur waktu belajar sehingga terlambat menyerahkan tugas. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(155, 400, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(156, 401, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan yang berlaku dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(157, 402, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(158, 403, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa menyatakan akan lebih disiplin dalam mengatur waktu belajar. Tindak lanjut: guru mata pelajaran mengevaluasi perkembangan siswa.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(159, 404, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat surat pernyataan untuk tidak mengulangi pelanggaran.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(160, 405, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas. Siswa mengakui kurang mengatur waktu belajar sehingga terlambat menyerahkan tugas. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(161, 406, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(162, 407, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan yang berlaku dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(163, 408, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(164, 409, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa menyatakan akan lebih disiplin dalam mengatur waktu belajar. Tindak lanjut: guru mata pelajaran mengevaluasi perkembangan siswa.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(165, 410, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat surat pernyataan untuk tidak mengulangi pelanggaran.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(166, 411, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas. Siswa mengakui kurang mengatur waktu belajar sehingga terlambat menyerahkan tugas. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(167, 412, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(168, 413, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan yang berlaku dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(169, 414, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(170, 415, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa menyatakan akan lebih disiplin dalam mengatur waktu belajar. Tindak lanjut: guru mata pelajaran mengevaluasi perkembangan siswa.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(171, 416, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat surat pernyataan untuk tidak mengulangi pelanggaran.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(172, 417, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas. Siswa mengakui kurang mengatur waktu belajar sehingga terlambat menyerahkan tugas. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(173, 418, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(174, 419, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan yang berlaku dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(175, 420, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(176, 421, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa menyatakan akan lebih disiplin dalam mengatur waktu belajar. Tindak lanjut: guru mata pelajaran mengevaluasi perkembangan siswa.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(177, 422, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran tersebut. Tindak lanjut: siswa membuat surat pernyataan untuk tidak mengulangi pelanggaran.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(178, 423, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas. Siswa mengakui kurang mengatur waktu belajar sehingga terlambat menyerahkan tugas. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(179, 424, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(180, 425, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan yang berlaku dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(181, 426, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan sekolah. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(182, 427, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen menyusun jadwal belajar agar tidak mengulangi pelanggaran. Tindak lanjut: guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(183, 428, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran dan bersedia mematuhi aturan sekolah. Tindak lanjut: siswa membuat surat pernyataan untuk tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(184, 429, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kurang mengatur waktu belajar. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau perkembangan.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(185, 430, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(186, 431, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(187, 432, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan sekolah. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(188, 433, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen menyusun jadwal belajar agar tidak mengulangi pelanggaran. Tindak lanjut: guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(189, 434, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran dan bersedia mematuhi aturan sekolah. Tindak lanjut: siswa membuat surat pernyataan untuk tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(190, 435, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kurang mengatur waktu belajar. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau perkembangan.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(191, 436, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(192, 437, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(193, 438, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan sekolah. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(194, 439, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen menyusun jadwal belajar agar tidak mengulangi pelanggaran. Tindak lanjut: guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(195, 440, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran dan bersedia mematuhi aturan sekolah. Tindak lanjut: siswa membuat surat pernyataan untuk tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(196, 441, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kurang mengatur waktu belajar. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau perkembangan.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(197, 442, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(198, 443, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(199, 444, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan sekolah. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(200, 445, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen menyusun jadwal belajar agar tidak mengulangi pelanggaran. Tindak lanjut: guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(201, 446, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran dan bersedia mematuhi aturan sekolah. Tindak lanjut: siswa membuat surat pernyataan untuk tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(202, 447, 'Dilaksanakan konseling mengenai pentingnya disiplin dalam mengumpulkan tugas tepat waktu. Siswa mengakui kurang mengatur waktu belajar. Tindak lanjut: siswa membuat jadwal belajar harian dan guru mata pelajaran memantau perkembangan.', '2026-01-17', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(203, 448, 'Dilaksanakan konseling mengenai pentingnya mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah. Siswa berkomitmen memeriksa jadwal pelajaran setiap malam. Tindak lanjut: wali kelas melakukan monitoring selama dua minggu.', '2026-02-15', '2026-02-12 00:00:00', 'menunggu_pembinaan', NULL),
(204, 449, 'Dilaksanakan konseling mengenai kepatuhan terhadap tata tertib sekolah terkait penggunaan jaket saat pembelajaran berlangsung. Siswa memahami aturan dan berjanji mematuhinya. Tindak lanjut: guru piket melakukan pemantauan.', '2026-03-22', '2026-03-19 00:00:00', 'menunggu_pembinaan', NULL),
(205, 450, 'Dilaksanakan konseling mengenai kepedulian terhadap kebersihan lingkungan sekolah. Siswa menyadari kesalahannya setelah membuang sampah sembarangan dan bersedia menjaga kebersihan lingkungan sekolah. Tindak lanjut: siswa mengikuti kegiatan kerja bakti kelas selama satu minggu.', '2026-04-19', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(206, 451, 'Dilaksanakan konseling mengenai tanggung jawab dalam menyelesaikan tugas sekolah tepat waktu. Siswa mengakui kelalaiannya dan berkomitmen menyusun jadwal belajar agar tidak mengulangi pelanggaran. Tindak lanjut: guru mata pelajaran memantau pengumpulan tugas berikutnya.', '2026-05-24', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(207, 452, 'Dilaksanakan konseling mengenai dampak penggunaan telepon seluler saat pembelajaran terhadap konsentrasi belajar. Siswa memahami konsekuensi pelanggaran dan bersedia mematuhi aturan sekolah. Tindak lanjut: siswa membuat surat pernyataan untuk tidak menggunakan HP saat pembelajaran tanpa izin guru.', '2026-06-14', '2026-06-11 00:00:00', 'menunggu_pembinaan', NULL),
(208, 453, 'Siswa diberikan konseling mengenai pentingnya mengikuti upacara bendera sebagai bentuk disiplin, tanggung jawab, dan penghormatan terhadap tata tertib sekolah. Siswa berkomitmen untuk mengikuti seluruh kegiatan upacara pada kesempatan berikutnya.', '2026-06-22', '2026-06-19 00:00:00', 'menunggu_pembinaan', NULL),
(209, 454, 'Siswa diberikan pembinaan mengenai pentingnya menggunakan atribut sekolah sesuai ketentuan. Siswa menyatakan kesediaannya untuk melengkapi atribut yang belum sesuai agar tidak mengulangi pelanggaran.', '2026-06-23', '2026-06-20 00:00:00', 'menunggu_pembinaan', NULL),
(210, 455, 'Siswa diberikan arahan mengenai pentingnya menjaga kerapian dan penampilan sesuai tata tertib sekolah. Siswa bersedia merapikan model rambut sesuai ketentuan yang berlaku.', '2026-06-21', '2026-06-18 00:00:00', 'menunggu_pembinaan', NULL),
(211, 456, 'Siswa diberikan konseling mengenai pentingnya meminta izin kepada guru sebelum meninggalkan ruang kelas. Siswa memahami dampak dari tindakan tersebut terhadap proses pembelajaran dan berjanji tidak mengulanginya.', '2026-06-20', '2026-06-17 00:00:00', 'menunggu_pembinaan', NULL),
(212, 457, 'Siswa diberikan pembinaan mengenai pentingnya menjaga ketertiban selama proses pembelajaran. Siswa diminta meningkatkan pengendalian diri agar tidak mengganggu konsentrasi teman maupun guru.', '2026-06-19', '2026-06-16 00:00:00', 'menunggu_pembinaan', NULL),
(213, 458, 'Siswa diberikan arahan mengenai kewajiban mengikuti kegiatan pembelajaran secara penuh dan tidak berada di kantin pada jam pelajaran tanpa izin. Siswa menyatakan siap mematuhi tata tertib sekolah.', '2026-06-26', '2026-06-23 00:00:00', 'menunggu_pembinaan', NULL),
(214, 459, 'Siswa diberikan pembinaan mengenai pentingnya memarkir kendaraan pada tempat yang telah disediakan demi menjaga ketertiban dan keamanan lingkungan sekolah. Siswa bersedia mematuhi aturan parkir.', '2026-06-27', '2026-06-24 00:00:00', 'menunggu_pembinaan', NULL),
(215, 460, 'Siswa diberikan konseling mengenai pentingnya mengikuti kegiatan ekstrakurikuler yang telah dipilih sebagai bagian dari pengembangan karakter dan tanggung jawab. Siswa berkomitmen untuk hadir pada kegiatan berikutnya.', '2026-06-28', '2026-06-25 00:00:00', 'menunggu_pembinaan', NULL),
(216, 461, 'Siswa diberikan konseling mengenai pentingnya kehadiran di sekolah serta kewajiban memberikan keterangan apabila berhalangan hadir. Orang tua diimbau untuk turut memantau kehadiran siswa.', '2026-06-29', '2026-06-26 00:00:00', 'menunggu_pembinaan', NULL),
(217, 462, 'Siswa diberikan pembinaan mengenai aturan penggunaan telepon seluler selama kegiatan pembelajaran. Siswa memahami bahwa penggunaan HP tanpa izin dapat mengganggu proses belajar dan berjanji tidak mengulanginya.', '2026-06-30', '2026-06-27 00:00:00', 'menunggu_pembinaan', NULL),
(325, 572, 'Siswa terlambat mengumpulkan laporan praktikum. Hasil konseling menunjukkan siswa kurang mampu mengatur waktu penyelesaian tugas. Wali kelas memberikan arahan mengenai manajemen waktu dan meminta siswa menyusun jadwal belajar agar tugas dapat diselesaikan tepat waktu.', '2026-01-19', '2026-01-15 00:00:00', 'menunggu_pembinaan', NULL),
(326, 573, 'Siswa hadir ke sekolah dengan seragam yang tidak lengkap. Dalam konseling siswa mengaku terburu-buru saat berangkat sehingga ada atribut yang tertinggal. Wali kelas mengingatkan pentingnya mempersiapkan perlengkapan sekolah pada malam sebelumnya.', '2026-02-20', '2026-02-18 00:00:00', 'menunggu_pembinaan', NULL),
(327, 574, 'Siswa melanggar tata tertib mengenai kerapian rambut. Wali kelas memberikan pembinaan mengenai pentingnya menjaga penampilan sesuai aturan sekolah dan meminta siswa segera merapikan rambut sebelum pemeriksaan berikutnya.', '2026-03-20', '2026-03-17 00:00:00', 'menunggu_pembinaan', NULL),
(328, 575, 'Siswa tidak mengerjakan tugas yang diberikan guru. Berdasarkan hasil konseling diketahui siswa kurang disiplin dalam belajar di rumah. Wali kelas memberikan motivasi belajar, meminta siswa segera menyelesaikan tugas, serta akan memantau perkembangan akademiknya.', '2026-04-27', '2026-04-23 00:00:00', 'menunggu_pembinaan', NULL),
(329, 576, 'Siswa memarkir kendaraan di area yang tidak diperbolehkan. Wali kelas menjelaskan aturan parkir sekolah dan meminta siswa menggunakan area parkir yang telah disediakan agar tidak mengganggu ketertiban lingkungan sekolah.', '2026-05-25', '2026-05-22 00:00:00', 'menunggu_pembinaan', NULL),
(330, 577, 'Siswa mengobrol dengan suara keras hingga mengganggu proses pembelajaran. Dalam konseling siswa menyadari kesalahannya dan berjanji lebih menjaga sikap di kelas. Wali kelas memberikan pembinaan mengenai etika selama kegiatan belajar berlangsung.', '2026-06-29', '2026-06-25 00:00:00', 'menunggu_pembinaan', NULL),
(331, 578, 'Siswa tidak hadir tepat waktu mengikuti kegiatan pembelajaran. Dalam konseling siswa menjelaskan keterlambatan disebabkan kurang disiplin dalam mengatur waktu keberangkatan. Wali kelas memberikan pembinaan mengenai pentingnya disiplin waktu dan meminta siswa datang lebih awal setiap hari.', '2026-01-14', '2026-01-12 00:00:00', 'menunggu_pembinaan', NULL),
(332, 579, 'Siswa tidak membawa buku pelajaran sesuai jadwal sehingga tidak dapat mengikuti pembelajaran secara optimal. Wali kelas mengingatkan agar siswa memeriksa jadwal pelajaran setiap malam sebelum berangkat ke sekolah.', '2026-02-18', '2026-02-16 00:00:00', 'menunggu_pembinaan', NULL),
(333, 580, 'Siswa terlambat mengumpulkan tugas yang diberikan guru mata pelajaran. Berdasarkan hasil konseling, siswa mengalami kesulitan membagi waktu belajar. Wali kelas memberikan arahan mengenai penyusunan jadwal belajar dan target penyelesaian tugas.', '2026-03-20', '2026-03-18 00:00:00', 'menunggu_pembinaan', NULL),
(334, 581, 'Siswa menggunakan telepon seluler saat proses pembelajaran berlangsung tanpa izin. Wali kelas menjelaskan dampak penggunaan telepon seluler terhadap konsentrasi belajar dan meminta siswa menaati tata tertib sekolah.', '2026-04-17', '2026-04-15 00:00:00', 'menunggu_pembinaan', NULL),
(335, 582, 'Siswa kembali melakukan pelanggaran kedisiplinan dengan tidak mengenakan atribut sekolah secara lengkap. Wali kelas memberikan teguran serta meminta siswa mempersiapkan perlengkapan sekolah sebelum berangkat dari rumah.', '2026-05-22', '2026-05-20 00:00:00', 'menunggu_pembinaan', NULL),
(337, 584, 'Siswa tidak mengikuti upacara bendera tanpa alasan yang jelas. Dalam konseling, siswa mengakui kurang disiplin dan berjanji akan mengikuti seluruh kegiatan sekolah. Wali kelas memberikan pembinaan mengenai pentingnya mengikuti kegiatan wajib sekolah.', '2026-01-16', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(338, 585, 'Siswa terlambat memasuki kelas setelah jam istirahat selesai. Wali kelas mengingatkan agar siswa lebih menghargai waktu belajar dan segera kembali ke kelas ketika bel masuk berbunyi.', '2026-02-17', '2026-02-15 00:00:00', 'menunggu_pembinaan', NULL),
(339, 586, 'Siswa menggunakan telepon seluler saat proses pembelajaran tanpa izin. Wali kelas menjelaskan bahwa penggunaan telepon seluler dapat mengganggu konsentrasi belajar serta meminta siswa mematuhi tata tertib sekolah.', '2026-03-19', '2026-03-17 00:00:00', 'menunggu_pembinaan', NULL),
(340, 587, 'Siswa tidak mengenakan atribut sekolah secara lengkap saat pemeriksaan. Dalam konseling siswa mengaku lupa menyiapkan atribut. Wali kelas mengingatkan agar seluruh perlengkapan sekolah dipersiapkan sebelum berangkat.', '2026-04-18', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(341, 588, 'Siswa beberapa kali mengobrol saat guru menjelaskan materi sehingga mengganggu suasana kelas. Wali kelas memberikan pembinaan mengenai etika selama proses pembelajaran dan meminta siswa lebih fokus mengikuti pelajaran.', '2026-05-22', '2026-05-20 00:00:00', 'menunggu_pembinaan', NULL),
(342, 589, 'Siswa menunjukkan sikap kurang disiplin dengan terlambat mengumpulkan tugas. Wali kelas memberikan motivasi belajar serta meminta siswa membuat jadwal penyelesaian tugas agar tidak mengulangi pelanggaran yang sama.', '2026-06-26', '2026-06-24 00:00:00', 'menunggu_pembinaan', NULL),
(343, 590, 'Siswa datang ke sekolah tanpa mengenakan atribut seragam secara lengkap. Dalam konseling siswa mengaku terburu-buru saat berangkat sehingga lupa melengkapi atribut. Wali kelas memberikan pembinaan mengenai pentingnya disiplin berpakaian sesuai tata tertib sekolah.', '2026-01-15', '2026-01-13 00:00:00', 'menunggu_pembinaan', NULL),
(344, 591, 'Siswa membuang sampah sembarangan di lingkungan sekolah. Wali kelas memberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan serta meminta siswa ikut bertanggung jawab menjaga kebersihan kelas.', '2026-02-18', '2026-02-16 00:00:00', 'menunggu_pembinaan', NULL),
(345, 592, 'Siswa terlambat mengumpulkan tugas mata pelajaran. Berdasarkan hasil konseling diketahui siswa kurang mampu mengatur waktu belajar. Wali kelas memberikan arahan mengenai manajemen waktu dan meminta siswa lebih disiplin dalam menyelesaikan tugas.', '2026-03-20', '2026-03-18 00:00:00', 'menunggu_pembinaan', NULL),
(346, 593, 'Siswa menggunakan telepon seluler saat pembelajaran berlangsung tanpa izin. Wali kelas memberikan pembinaan mengenai dampak penggunaan telepon seluler terhadap konsentrasi belajar serta mengingatkan agar mematuhi tata tertib sekolah.', '2026-04-17', '2026-04-15 00:00:00', 'menunggu_pembinaan', NULL),
(347, 594, 'Siswa tidak mengikuti kegiatan pembelajaran dengan tertib karena sering berbicara dengan teman sebangku. Dalam konseling siswa menyadari kesalahannya dan berjanji lebih fokus selama proses pembelajaran berlangsung.', '2026-05-22', '2026-05-20 00:00:00', 'menunggu_pembinaan', NULL),
(348, 595, 'Siswa menunjukkan sikap yang lebih baik setelah beberapa kali diberikan pembinaan. Wali kelas tetap melakukan pemantauan secara berkala dan mengingatkan agar siswa mempertahankan kedisiplinan hingga akhir semester.', '2026-06-24', '2026-06-22 00:00:00', 'menunggu_pembinaan', NULL),
(349, 554, 'Siswa diberikan pembinaan terkait penggunaan aksesoris yang tidak sesuai dengan tata tertib sekolah. Guru BK menjelaskan pentingnya menjaga kerapihan dan kepatuhan terhadap peraturan sekolah. Siswa memahami kesalahannya dan berkomitmen tidak mengulangi pelanggaran.', '2026-01-15', '2026-01-09 09:30:00', 'menunggu_pembinaan', NULL),
(350, 555, 'Dilakukan konseling mengenai pentingnya membawa perlengkapan belajar sesuai jadwal pelajaran. Siswa mengakui kelalaiannya dan bersedia mempersiapkan kebutuhan belajar setiap hari.', '2026-02-18', '2026-02-12 10:00:00', 'menunggu_pembinaan', NULL),
(351, 556, 'Guru BK memberikan motivasi agar siswa lebih bertanggung jawab dalam mengerjakan dan mengumpulkan tugas tepat waktu. Siswa menyampaikan alasan keterlambatan dan berjanji memperbaiki kedisiplinannya.', '2026-03-24', '2026-03-18 09:15:00', 'menunggu_pembinaan', NULL),
(352, 557, 'Siswa diberikan arahan mengenai pentingnya menjaga kebersihan lingkungan sekolah sebagai bentuk tanggung jawab bersama. Siswa menerima pembinaan dengan baik dan bersedia menjaga kebersihan sekolah.', '2026-04-21', '2026-04-15 10:20:00', 'menunggu_pembinaan', NULL);
INSERT INTO `laporan_konseling` (`id_laporan`, `id_pelanggaran_siswa`, `catatan_konseling`, `tanggal_tindak_lanjut`, `tanggal_konseling`, `status`, `hasil_konseling`) VALUES
(353, 558, 'Dilakukan konseling terkait kepatuhan terhadap aturan penggunaan seragam di lingkungan sekolah. Siswa memahami bahwa penggunaan jaket di kelas tanpa alasan yang jelas tidak diperbolehkan dan berjanji mematuhi aturan.', '2026-05-27', '2026-05-21 08:45:00', 'menunggu_pembinaan', NULL),
(354, 559, 'Guru BK memberikan pembinaan mengenai penggunaan telepon seluler saat proses pembelajaran. Siswa memahami dampak negatif penggunaan HP terhadap konsentrasi belajar dan berkomitmen tidak mengulanginya.', '2026-06-16', '2026-06-10 09:40:00', 'menunggu_pembinaan', NULL),
(355, 560, 'Siswa diberikan pembinaan mengenai pentingnya menggunakan atribut seragam secara lengkap sesuai ketentuan sekolah. Siswa bersedia melengkapi atribut pada hari berikutnya.', '2026-01-16', '2026-01-10 08:30:00', 'menunggu_pembinaan', NULL),
(356, 561, 'Dilakukan konseling terkait tanggung jawab dalam menyelesaikan tugas sekolah. Siswa berjanji akan lebih disiplin dalam mengumpulkan tugas sesuai batas waktu yang ditentukan.', '2026-02-19', '2026-02-13 09:00:00', 'menunggu_pembinaan', NULL),
(357, 562, 'Guru BK memberikan arahan mengenai pentingnya mengikuti kegiatan ekstrakurikuler yang telah dipilih sebagai bagian dari pengembangan karakter siswa. Siswa berjanji akan hadir secara rutin.', '2026-03-25', '2026-03-19 10:15:00', 'menunggu_pembinaan', NULL),
(358, 563, 'Siswa diberikan pemahaman mengenai aturan parkir kendaraan di lingkungan sekolah demi keamanan dan ketertiban. Siswa bersedia memarkir kendaraan di tempat yang telah disediakan.', '2026-04-28', '2026-04-22 09:25:00', 'menunggu_pembinaan', NULL),
(359, 584, 'Siswa diberikan pembinaan mengenai pentingnya menjaga sikap disiplin di lingkungan sekolah. Siswa memahami konsekuensi dari pelanggaran yang dilakukan dan berkomitmen untuk memperbaiki perilakunya.', '2026-01-13', '2026-01-08 00:00:00', 'menunggu_pembinaan', NULL),
(360, 585, 'Guru BK melakukan konseling terkait kepatuhan terhadap tata tertib sekolah. Siswa bersedia menaati peraturan dan tidak mengulangi pelanggaran serupa.', '2026-02-16', '2026-02-11 00:00:00', 'menunggu_pembinaan', NULL),
(361, 586, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam mengikuti kegiatan belajar mengajar. Hasil konseling menunjukkan siswa kooperatif dan menerima pembinaan dengan baik.', '2026-03-22', '2026-03-17 00:00:00', 'menunggu_pembinaan', NULL),
(362, 587, 'Guru BK mengingatkan pentingnya menjaga perilaku yang mencerminkan karakter peserta didik. Siswa menyatakan kesediaannya untuk memperbaiki sikap.', '2026-04-21', '2026-04-16 00:00:00', 'menunggu_pembinaan', NULL),
(363, 588, 'Dilakukan evaluasi terhadap perkembangan perilaku siswa. Selama konseling siswa menunjukkan perubahan yang positif dan bersedia mempertahankan kedisiplinannya.', '2026-05-27', '2026-05-22 00:00:00', 'menunggu_pembinaan', NULL),
(364, 589, 'Siswa memperoleh pembinaan lanjutan serta diminta meningkatkan kepatuhan terhadap seluruh tata tertib sekolah.', '2026-06-28', '2026-06-23 00:00:00', 'menunggu_pembinaan', NULL),
(365, 590, 'Guru BK memberikan motivasi mengenai pentingnya disiplin dan tanggung jawab sebagai peserta didik. Siswa menerima arahan dengan baik.', '2026-01-15', '2026-01-10 00:00:00', 'menunggu_pembinaan', NULL),
(366, 591, 'Dilakukan konseling individu mengenai kepatuhan terhadap peraturan sekolah. Siswa memahami kesalahan dan berjanji tidak mengulanginya.', '2026-02-18', '2026-02-13 00:00:00', 'menunggu_pembinaan', NULL),
(367, 592, 'Siswa diarahkan agar lebih fokus dalam kegiatan pembelajaran serta menghindari perilaku yang dapat mengganggu proses belajar.', '2026-03-25', '2026-03-20 00:00:00', 'menunggu_pembinaan', NULL),
(368, 593, 'Guru BK bersama wali kelas melakukan pembinaan mengenai tanggung jawab dan kedisiplinan siswa selama berada di lingkungan sekolah.', '2026-04-23', '2026-04-18 00:00:00', 'menunggu_pembinaan', NULL),
(369, 594, 'Siswa diberikan penguatan karakter agar lebih bertanggung jawab terhadap aturan sekolah. Hasil konseling menunjukkan sikap yang kooperatif.', '2026-05-26', '2026-05-21 00:00:00', 'menunggu_pembinaan', NULL),
(370, 595, 'Dilakukan tindak lanjut berupa monitoring perilaku siswa selama proses pembelajaran untuk memastikan tidak terjadi pelanggaran berulang.', '2026-06-30', '2026-06-25 00:00:00', 'menunggu_pembinaan', NULL),
(371, 596, 'Guru BK melakukan konseling mengenai pentingnya menaati tata tertib sekolah. Siswa mengakui kesalahan yang dilakukan dan berkomitmen untuk lebih disiplin dalam mengikuti seluruh peraturan sekolah.', '2026-01-19', '2026-01-14 00:00:00', 'menunggu_pembinaan', NULL),
(372, 597, 'Siswa diberikan pembinaan terkait perilaku yang kurang sesuai dengan tata tertib sekolah. Guru BK mengingatkan pentingnya menjaga sikap sebagai peserta didik.', '2026-01-26', '2026-01-21 00:00:00', 'menunggu_pembinaan', NULL),
(373, 598, 'Dilakukan konseling individu untuk menggali penyebab pelanggaran. Siswa bersikap terbuka selama proses konseling dan bersedia memperbaiki perilakunya.', '2026-02-10', '2026-02-05 00:00:00', 'menunggu_pembinaan', NULL),
(374, 599, 'Guru BK memberikan motivasi agar siswa lebih bertanggung jawab terhadap kewajiban di sekolah serta menghindari pelanggaran yang sama di kemudian hari.', '2026-02-24', '2026-02-19 00:00:00', 'menunggu_pembinaan', NULL),
(375, 600, 'Siswa memperoleh arahan mengenai pentingnya menjaga kedisiplinan dan etika selama berada di lingkungan sekolah.', '2026-03-12', '2026-03-07 00:00:00', 'menunggu_pembinaan', NULL),
(376, 601, 'Dilakukan evaluasi perkembangan perilaku siswa. Hasil konseling menunjukkan siswa memahami konsekuensi dari setiap pelanggaran yang dilakukan.', '2026-03-26', '2026-03-21 00:00:00', 'menunggu_pembinaan', NULL),
(377, 602, 'Guru BK memberikan pembinaan lanjutan agar siswa mampu mengendalikan perilaku serta meningkatkan kepatuhan terhadap tata tertib sekolah.', '2026-04-09', '2026-04-04 00:00:00', 'menunggu_pembinaan', NULL),
(378, 603, 'Siswa menyampaikan penyesalan atas pelanggaran yang dilakukan dan menyatakan kesediaannya untuk memperbaiki sikap serta lebih disiplin.', '2026-04-23', '2026-04-18 00:00:00', 'menunggu_pembinaan', NULL),
(379, 604, 'Guru BK bersama wali kelas memberikan penguatan karakter mengenai tanggung jawab, disiplin, dan sikap saling menghormati di lingkungan sekolah.', '2026-05-14', '2026-05-09 00:00:00', 'menunggu_pembinaan', NULL),
(380, 605, 'Siswa diberikan pembinaan mengenai pentingnya menjaga nama baik diri sendiri, keluarga, dan sekolah melalui perilaku yang positif.', '2026-05-28', '2026-05-23 00:00:00', 'menunggu_pembinaan', NULL),
(381, 606, 'Dilakukan monitoring terhadap perkembangan perilaku siswa setelah pelaksanaan konseling. Siswa menunjukkan perubahan sikap yang lebih baik.', '2026-06-11', '2026-06-06 00:00:00', 'menunggu_pembinaan', NULL),
(382, 607, 'Guru BK mengingatkan siswa agar menjadikan pelanggaran yang pernah dilakukan sebagai bahan evaluasi diri sehingga tidak terulang kembali.', '2026-06-25', '2026-06-20 00:00:00', 'menunggu_pembinaan', NULL),
(383, 608, 'Guru BK melakukan konseling terkait pelanggaran yang dilakukan siswa. Siswa memahami bahwa setiap pelanggaran memiliki konsekuensi dan berkomitmen untuk meningkatkan kedisiplinan selama berada di lingkungan sekolah.', '2026-01-20', '2026-01-15 00:00:00', 'menunggu_pembinaan', NULL),
(384, 609, 'Siswa diberikan arahan mengenai pentingnya mematuhi tata tertib sekolah sebagai bentuk tanggung jawab. Siswa menunjukkan sikap kooperatif selama proses konseling.', '2026-02-03', '2026-01-29 00:00:00', 'menunggu_pembinaan', NULL),
(385, 610, 'Guru BK memberikan pembinaan agar siswa mampu mengontrol perilaku dan menjaga etika selama mengikuti kegiatan pembelajaran.', '2026-02-18', '2026-02-13 00:00:00', 'menunggu_pembinaan', NULL),
(386, 611, 'Dilakukan konseling individu untuk mengetahui penyebab pelanggaran. Siswa mengakui kesalahan serta bersedia memperbaiki sikap dan tidak mengulangi pelanggaran yang sama.', '2026-03-05', '2026-02-28 00:00:00', 'menunggu_pembinaan', NULL),
(387, 612, 'Guru BK memberikan motivasi mengenai pentingnya disiplin, tanggung jawab, dan menjaga nama baik sekolah. Siswa menerima pembinaan dengan baik.', '2026-03-20', '2026-03-15 00:00:00', 'menunggu_pembinaan', NULL),
(388, 613, 'Siswa mendapatkan pembinaan lanjutan terkait kepatuhan terhadap tata tertib sekolah. Guru BK akan melakukan pemantauan perkembangan perilaku siswa bersama wali kelas.', '2026-04-08', '2026-04-03 00:00:00', 'menunggu_pembinaan', NULL),
(389, 614, 'Guru BK mengingatkan siswa agar lebih bijak dalam bersikap serta mempertimbangkan dampak dari setiap tindakan yang dilakukan di lingkungan sekolah.', '2026-04-24', '2026-04-19 00:00:00', 'menunggu_pembinaan', NULL),
(390, 615, 'Dilakukan evaluasi hasil konseling. Siswa menunjukkan pemahaman yang baik terhadap aturan sekolah dan menyatakan kesediaannya untuk menjadi lebih disiplin.', '2026-05-13', '2026-05-08 00:00:00', 'menunggu_pembinaan', NULL),
(391, 616, 'Guru BK memberikan penguatan karakter mengenai sikap disiplin, tanggung jawab, dan kepedulian terhadap lingkungan sekolah. Siswa berjanji akan menjaga perilakunya dengan lebih baik.', '2026-05-29', '2026-05-24 00:00:00', 'menunggu_pembinaan', NULL),
(392, 617, 'Siswa memperoleh pembinaan mengenai pentingnya menaati tata tertib sekolah secara konsisten. Hasil konseling menunjukkan siswa menerima masukan dengan baik.', '2026-06-12', '2026-06-07 00:00:00', 'menunggu_pembinaan', NULL),
(393, 618, 'Guru BK bersama wali kelas melakukan tindak lanjut untuk memastikan siswa tidak mengulangi pelanggaran. Siswa menunjukkan perubahan perilaku yang positif setelah diberikan pembinaan.', '2026-06-26', '2026-06-21 00:00:00', 'menunggu_pembinaan', NULL),
(394, 619, 'Konseling penutup dilakukan sebagai evaluasi perkembangan siswa. Guru BK menyimpulkan bahwa siswa telah memahami konsekuensi pelanggaran serta diharapkan mampu mempertahankan perilaku disiplin di masa mendatang.', '2026-07-03', '2026-06-28 00:00:00', 'menunggu_pembinaan', NULL),
(395, 692, 'Siswa diberikan konseling mengenai pentingnya mengikuti upacara bendera sebagai bentuk disiplin, tanggung jawab, dan penghormatan terhadap tata tertib sekolah. Siswa berkomitmen untuk mengikuti seluruh kegiatan upacara pada kesempatan berikutnya.', '2026-01-13', '2026-07-05 11:04:54', 'menunggu_pembinaan', NULL),
(396, 693, 'Siswa diberikan konseling mengenai pentingnya meminta izin kepada guru sebelum meninggalkan ruang kelas. Siswa memahami dampak dari tindakan tersebut terhadap proses pembelajaran dan berjanji tidak mengulanginya.', '2026-02-19', '2026-07-05 11:08:03', 'menunggu_pembinaan', NULL),
(397, 694, 'Siswa diberikan konseling mengenai pentingnya mengikuti kegiatan ekstrakurikuler yang telah dipilih sebagai bagian dari pengembangan karakter dan tanggung jawab. Siswa berkomitmen untuk hadir pada kegiatan berikutnya.', '2026-05-20', '2026-07-05 11:24:06', 'menunggu_pembinaan', NULL),
(398, 697, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap sesuai tata tertib yang berlaku.', '2026-01-11', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(399, 698, 'Siswa diberikan arahan agar selalu mempersiapkan buku pelajaran sesuai jadwal sebelum berangkat ke sekolah.', '2026-01-12', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(400, 699, 'Siswa diberikan pembinaan mengenai pentingnya menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-01-13', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(401, 700, 'Siswa diberikan nasihat agar tidak menggunakan make up maupun aksesoris secara berlebihan selama berada di lingkungan sekolah.', '2026-01-13', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(402, 701, 'Siswa diberikan pembinaan agar tidak menggunakan jaket saat berada di lingkungan sekolah tanpa izin.', '2026-01-14', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(403, 702, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-01-14', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(404, 703, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap sesuai tata tertib.', '2026-01-15', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(405, 704, 'Siswa diberikan teguran dan diarahkan agar memarkir kendaraan pada tempat yang telah disediakan sekolah.', '2026-01-15', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(406, 705, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa perlengkapan belajar sesuai jadwal pelajaran.', '2026-01-16', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(407, 706, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-01-16', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(408, 707, 'Siswa diberikan pembinaan mengenai pentingnya mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-01-17', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(409, 708, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap.', '2026-01-17', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(410, 709, 'Siswa diberikan arahan agar mematuhi tata tertib sekolah mengenai penggunaan jaket di lingkungan sekolah.', '2026-01-18', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(411, 710, 'Siswa diberikan pembinaan agar lebih disiplin dalam mempersiapkan buku pelajaran sebelum mengikuti pembelajaran.', '2026-01-18', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(412, 711, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah.', '2026-01-19', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(413, 712, 'Siswa diberikan pembinaan agar menggunakan atribut sekolah secara lengkap sesuai ketentuan.', '2026-01-19', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(414, 713, 'Siswa diberikan pembinaan agar mematuhi aturan penggunaan perlengkapan sekolah yang telah ditetapkan.', '2026-01-20', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(415, 714, 'Siswa diberikan arahan agar tidak menggunakan jaket selama berada di lingkungan sekolah tanpa izin.', '2026-01-20', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(416, 715, 'Siswa diberikan pembinaan agar mempersiapkan perlengkapan belajar dengan baik sebelum berangkat ke sekolah.', '2026-01-21', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(417, 716, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan dan membuang sampah pada tempatnya.', '2026-01-21', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(418, 717, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-01-22', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(419, 718, 'Siswa diberikan arahan agar menggunakan perlengkapan sekolah sesuai tata tertib yang berlaku.', '2026-01-22', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(420, 719, 'Siswa diberikan pembinaan agar tidak berada di kantin pada saat kegiatan belajar mengajar berlangsung.', '2026-01-23', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(421, 720, 'Siswa diberikan pembinaan agar mematuhi aturan sekolah mengenai penggunaan jaket di lingkungan sekolah.', '2026-01-23', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(422, 721, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal yang telah ditentukan.', '2026-01-24', '2026-07-08 21:59:17', 'menunggu_pembinaan', NULL),
(423, 724, 'Siswa diberikan pembinaan agar selalu mempersiapkan buku pelajaran sesuai jadwal sebelum berangkat ke sekolah.', '2026-02-09', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(424, 725, 'Siswa diberikan pembinaan agar menggunakan atribut sekolah secara lengkap sesuai tata tertib yang berlaku.', '2026-02-09', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(425, 726, 'Siswa diberikan arahan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-02-10', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(426, 727, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-02-10', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(427, 728, 'Siswa diberikan pembinaan agar tidak menggunakan jaket di lingkungan sekolah tanpa izin.', '2026-02-11', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(428, 729, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-02-11', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(429, 730, 'Siswa diberikan pembinaan agar lebih disiplin dalam menggunakan atribut sekolah sesuai tata tertib.', '2026-02-23', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(430, 731, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa buku pelajaran sesuai jadwal.', '2026-02-12', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(431, 732, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-02-12', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(432, 733, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-02-13', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(433, 734, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah.', '2026-02-13', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(434, 735, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-02-14', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(435, 736, 'Siswa diberikan arahan agar selalu mempersiapkan buku pelajaran sesuai jadwal pelajaran.', '2026-02-14', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(436, 737, 'Siswa diberikan pembinaan agar tidak berada di kantin pada saat kegiatan belajar mengajar berlangsung.', '2026-02-15', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(437, 738, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-02-15', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(438, 739, 'Siswa diberikan arahan agar tidak menggunakan jaket selama berada di lingkungan sekolah tanpa izin.', '2026-02-16', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(439, 740, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah.', '2026-02-16', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(440, 741, 'Siswa diberikan pembinaan agar menggunakan atribut sekolah secara lengkap sesuai tata tertib sekolah.', '2026-02-17', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(441, 742, 'Siswa diberikan arahan agar mempersiapkan perlengkapan belajar dengan baik sebelum berangkat ke sekolah.', '2026-02-17', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(442, 743, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-02-18', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(443, 744, 'Siswa diberikan pembinaan mengenai pentingnya mengikuti kegiatan belajar di kelas selama jam pelajaran berlangsung.', '2026-02-18', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(444, 745, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dan menjadi teladan bagi teman-temannya.', '2026-02-26', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(445, 746, 'Siswa diberikan pembinaan agar mematuhi aturan sekolah mengenai penggunaan jaket di lingkungan sekolah.', '2026-02-19', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(446, 747, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-02-19', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(447, 748, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal yang telah ditentukan.', '2026-02-20', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(448, 749, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-02-20', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(449, 750, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-02-21', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(450, 751, 'Siswa diberikan pembinaan agar memanfaatkan waktu belajar dengan baik dan tidak berada di kantin saat jam pelajaran.', '2026-02-21', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(451, 752, 'Siswa diberikan arahan agar mematuhi tata tertib sekolah mengenai penggunaan jaket di lingkungan sekolah.', '2026-02-28', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(452, 753, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap dan mematuhi tata tertib sekolah.', '2026-02-22', '2026-07-08 22:06:04', 'menunggu_pembinaan', NULL),
(453, 754, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-03-09', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(454, 755, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-03-09', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(455, 756, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap sesuai tata tertib.', '2026-03-10', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(456, 757, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa buku pelajaran sesuai jadwal.', '2026-03-10', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(457, 758, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-03-11', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(458, 759, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-03-25', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(459, 760, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-03-11', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(460, 761, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah.', '2026-03-12', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(461, 762, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-03-12', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(462, 763, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal yang telah ditentukan.', '2026-03-13', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(463, 764, 'Siswa diberikan pembinaan agar tidak menggunakan jaket di lingkungan sekolah tanpa izin.', '2026-03-13', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(464, 765, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai tata tertib yang berlaku.', '2026-03-14', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(465, 766, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-03-27', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(466, 767, 'Siswa diberikan pembinaan agar tidak berada di kantin selama kegiatan belajar mengajar berlangsung.', '2026-03-14', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(467, 768, 'Siswa diberikan pembinaan agar menggunakan atribut sekolah secara lengkap sesuai tata tertib.', '2026-03-15', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(468, 769, 'Siswa diberikan arahan agar mempersiapkan buku pelajaran sebelum mengikuti pembelajaran.', '2026-03-15', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(469, 770, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-03-16', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(470, 771, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-03-16', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(471, 772, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah.', '2026-03-17', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(472, 773, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-03-17', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(473, 774, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa buku pelajaran sesuai jadwal.', '2026-03-18', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(474, 775, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-03-28', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(475, 776, 'Siswa diberikan pembinaan agar tidak menggunakan jaket di lingkungan sekolah tanpa izin.', '2026-03-18', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(476, 777, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas selama jam pelajaran berlangsung.', '2026-03-19', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(477, 778, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap sesuai tata tertib.', '2026-03-19', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(478, 779, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal.', '2026-03-20', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(479, 780, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-03-20', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(480, 781, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-03-21', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(481, 782, 'Siswa diberikan pembinaan agar menggunakan atribut sekolah secara lengkap sesuai tata tertib sekolah.', '2026-03-29', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(482, 783, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-03-21', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(483, 784, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-03-22', '2026-07-08 22:09:38', 'menunggu_pembinaan', NULL),
(484, 816, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-04-09', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(485, 817, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-04-09', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(486, 818, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa buku pelajaran sesuai jadwal.', '2026-04-10', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(487, 819, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap sesuai tata tertib sekolah.', '2026-04-10', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(488, 820, 'Siswa diberikan pembinaan agar tidak menggunakan jaket di lingkungan sekolah tanpa izin.', '2026-04-11', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(489, 821, 'Siswa diberikan pembinaan agar mematuhi tata tertib penggunaan perlengkapan sekolah.', '2026-04-11', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(490, 822, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-04-12', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(491, 823, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah serta diingatkan agar tidak mengulangi pelanggaran.', '2026-04-25', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(492, 824, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal yang telah ditentukan.', '2026-04-12', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(493, 825, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-04-13', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(494, 826, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-04-13', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(495, 827, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-04-14', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(496, 828, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-04-14', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(497, 829, 'Siswa diberikan arahan agar mempersiapkan buku pelajaran sebelum mengikuti pembelajaran.', '2026-04-15', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(498, 830, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap sesuai tata tertib.', '2026-04-15', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(499, 831, 'Siswa diberikan pembinaan agar tidak berada di kantin selama kegiatan belajar mengajar berlangsung.', '2026-04-16', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(500, 832, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-04-16', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(501, 833, 'Siswa diberikan arahan agar tidak menggunakan jaket selama berada di lingkungan sekolah tanpa izin.', '2026-04-17', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(502, 834, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dan menjadi teladan bagi teman-temannya.', '2026-04-17', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(503, 835, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-04-18', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(504, 836, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa buku pelajaran sesuai jadwal pelajaran.', '2026-04-18', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(505, 837, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai tata tertib yang berlaku.', '2026-04-19', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(506, 838, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas selama jam pelajaran berlangsung.', '2026-04-19', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(507, 839, 'Siswa diberikan pembinaan lanjutan agar lebih disiplin dalam menggunakan atribut sekolah secara lengkap.', '2026-04-28', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(508, 840, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-04-20', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(509, 841, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-04-20', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(510, 842, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal yang telah ditentukan.', '2026-04-21', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(511, 843, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-04-21', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(512, 844, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-04-22', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(513, 845, 'Siswa diberikan pembinaan lanjutan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-04-29', '2026-07-08 22:11:18', 'menunggu_pembinaan', NULL),
(514, 846, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap sesuai tata tertib yang berlaku.', '2026-05-10', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(515, 847, 'Siswa diberikan pembinaan agar tidak menggunakan jaket di lingkungan sekolah tanpa izin serta mematuhi tata tertib sekolah.', '2026-05-10', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(516, 848, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-05-11', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(517, 849, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-05-11', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(518, 850, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal pembelajaran.', '2026-05-12', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(519, 851, 'Siswa diberikan pembinaan lanjutan agar lebih disiplin dalam menggunakan atribut sekolah secara lengkap.', '2026-05-27', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(520, 852, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-05-12', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(521, 853, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-05-13', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(522, 854, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-05-13', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(523, 855, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-05-14', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(524, 856, 'Siswa diberikan arahan agar mempersiapkan buku pelajaran sebelum mengikuti proses pembelajaran.', '2026-05-14', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(525, 857, 'Siswa diberikan pembinaan mengenai pentingnya kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-05-15', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(526, 858, 'Siswa diberikan pembinaan agar tidak berada di kantin selama kegiatan belajar mengajar berlangsung.', '2026-05-15', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(527, 859, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah.', '2026-05-16', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(528, 860, 'Siswa diberikan pembinaan lanjutan agar menggunakan perlengkapan sekolah sesuai tata tertib yang berlaku.', '2026-05-29', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(529, 861, 'Siswa diberikan pembinaan agar tidak menggunakan jaket di lingkungan sekolah tanpa izin.', '2026-05-16', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(530, 862, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal yang telah ditentukan.', '2026-05-17', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(531, 863, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-05-17', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(532, 864, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-05-18', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(533, 865, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas selama jam pelajaran berlangsung.', '2026-05-18', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(534, 866, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-05-19', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(535, 867, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-05-19', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(536, 868, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal pelajaran.', '2026-05-20', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(537, 869, 'Siswa diberikan pembinaan lanjutan mengenai pentingnya menjaga kebersihan lingkungan sekolah dan tidak mengulangi pelanggaran.', '2026-05-30', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(538, 870, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-05-20', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(539, 871, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-05-21', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(540, 872, 'Siswa diberikan pembinaan agar tidak berada di kantin selama kegiatan belajar mengajar berlangsung.', '2026-05-21', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(541, 873, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-05-22', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(542, 874, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa buku pelajaran sesuai jadwal.', '2026-05-22', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(543, 875, 'Siswa diberikan pembinaan lanjutan agar menggunakan perlengkapan sekolah sesuai tata tertib yang berlaku.', '2026-05-31', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(544, 876, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-05-23', '2026-07-08 22:12:57', 'menunggu_pembinaan', NULL),
(545, 877, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-06-26', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(546, 878, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-06-26', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(547, 879, 'Siswa diberikan pembinaan agar selalu menggunakan atribut sekolah secara lengkap sesuai tata tertib sekolah.', '2026-06-26', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(548, 880, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa buku pelajaran sesuai jadwal pembelajaran.', '2026-06-26', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(549, 881, 'Siswa diberikan pembinaan agar tidak menggunakan jaket di lingkungan sekolah tanpa izin dan mematuhi tata tertib sekolah.', '2026-06-26', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(550, 882, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-06-26', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(551, 883, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai tata tertib yang berlaku.', '2026-06-27', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(552, 884, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah serta tidak mengulangi pelanggaran yang sama.', '2026-06-27', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(553, 885, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-06-27', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(554, 886, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal yang telah ditentukan.', '2026-06-27', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(555, 887, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-06-27', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(556, 888, 'Siswa diberikan pembinaan lanjutan mengenai pentingnya menjaga kebersihan lingkungan sekolah dan menjadi teladan bagi teman-temannya.', '2026-07-01', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(557, 889, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-06-28', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(558, 890, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar mengajar secara disiplin dan tidak berada di kantin saat jam pelajaran.', '2026-06-28', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(559, 891, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah sesuai tata tertib.', '2026-06-28', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(560, 892, 'Siswa diberikan arahan agar mempersiapkan buku pelajaran sebelum mengikuti proses pembelajaran.', '2026-06-28', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(561, 893, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-06-28', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(562, 894, 'Siswa diberikan pembinaan agar tidak menggunakan jaket di lingkungan sekolah tanpa izin.', '2026-06-28', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(563, 895, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-06-29', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(564, 896, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-06-29', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(565, 897, 'Siswa diberikan pembinaan agar tidak berada di kantin selama kegiatan belajar mengajar berlangsung.', '2026-06-29', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(566, 898, 'Siswa diberikan pembinaan lanjutan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-07-01', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(567, 899, 'Siswa diberikan edukasi mengenai pentingnya menjaga kebersihan lingkungan sekolah dengan membuang sampah pada tempatnya.', '2026-06-29', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(568, 900, 'Siswa diberikan arahan agar selalu membawa buku pelajaran sesuai jadwal pelajaran.', '2026-06-29', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(569, 901, 'Siswa diberikan pembinaan agar menggunakan perlengkapan sekolah sesuai ketentuan yang berlaku.', '2026-06-30', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(570, 902, 'Siswa diberikan pembinaan mengenai kedisiplinan dalam menggunakan atribut sekolah secara lengkap.', '2026-06-30', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(571, 903, 'Siswa diberikan pembinaan agar mematuhi tata tertib mengenai penggunaan jaket di lingkungan sekolah.', '2026-06-30', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(572, 904, 'Siswa diberikan pembinaan agar mengikuti kegiatan belajar di kelas dan tidak berada di kantin saat jam pelajaran berlangsung.', '2026-06-30', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(573, 905, 'Siswa diberikan pembinaan lanjutan mengenai pentingnya menjaga kebersihan lingkungan sekolah dan tidak mengulangi pelanggaran.', '2026-07-01', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(574, 906, 'Siswa diberikan arahan agar lebih bertanggung jawab dalam membawa buku pelajaran sesuai jadwal yang telah ditentukan.', '2026-07-01', '2026-07-08 22:16:34', 'menunggu_pembinaan', NULL),
(576, 920, 'Siswa diminta keruang BK', '2026-07-21', '2026-07-21 20:32:45', 'menunggu_pembinaan', NULL),
(578, 922, 'ya', '2026-07-21', '2026-07-21 21:25:12', 'menunggu_pembinaan', NULL),
(579, 923, 'ditunggu ya di ruang bk', '2026-07-22', '2026-07-21 22:21:20', 'menunggu_pembinaan', NULL),
(580, 924, 'kitaaa', '2026-07-07', '2026-07-21 22:23:03', 'menunggu_pembinaan', NULL),
(581, 925, 'hemmmmmm', '2026-07-22', '2026-07-21 22:38:23', 'menunggu_pembinaan', NULL),
(582, 926, 'okeyyy', '2026-07-21', '2026-07-21 22:56:26', 'menunggu_pembinaan', NULL),
(583, 927, 'Siswa Diminta hadir di ruang kelas oleh walas', '2026-07-22', '2026-07-22 16:05:04', 'menunggu_pembinaan', NULL),
(584, 929, 'Siswa di minta hadir di ruang wali kelas', '2026-07-24', '2026-07-24 13:26:47', 'menunggu_pembinaan', NULL),
(585, 930, 'Siswa diminta hadir di ruang guru', '2026-07-25', '2026-07-25 17:08:51', 'menunggu_pembinaan', NULL),
(586, 935, 'i', '2026-08-28', '2026-08-02 20:42:42', 'menunggu_pembinaan', NULL);

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
(45, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 20:03:29'),
(46, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 20:06:40'),
(47, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 20:09:47'),
(48, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 20:11:37'),
(49, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 20:29:05'),
(50, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 20:31:25'),
(51, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 20:33:43'),
(52, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 21:08:39'),
(53, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 21:10:10'),
(54, 42, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 16:54:43'),
(55, 41, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 20:17:05'),
(56, 40, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 21:26:01'),
(57, 40, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 21:33:54'),
(58, 40, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 21:43:44'),
(59, 40, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 22:00:46'),
(60, 40, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 22:03:24'),
(61, 40, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 22:08:18'),
(62, 40, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-26 22:24:18'),
(63, 41, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-01 17:15:17'),
(64, 41, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-01 21:31:43'),
(65, 41, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-01 21:32:44'),
(66, 54, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-04 14:48:31'),
(67, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 14:52:31'),
(68, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 14:54:02'),
(69, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 14:55:08'),
(70, 0, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 15:21:51'),
(71, 0, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 15:23:41'),
(72, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 15:27:00'),
(73, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 15:28:25'),
(74, 0, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 15:29:51'),
(75, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 15:30:53'),
(76, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 15:55:57'),
(77, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-04 15:57:51'),
(78, 111, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-05 11:04:15'),
(79, 111, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-05 11:06:47'),
(80, 111, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-05 11:23:24'),
(81, 111, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-05 11:29:37'),
(82, 110, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-07 22:42:31'),
(83, 115, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-09 13:34:16'),
(84, 115, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-09 13:35:40'),
(85, 0, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-09 13:46:47'),
(86, 115, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-09 13:49:41'),
(87, 115, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-09 16:07:08'),
(88, 117, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-11 21:19:52'),
(89, 117, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-11 21:20:59'),
(90, 117, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-11 21:22:36'),
(91, 117, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-11 21:27:56'),
(92, 117, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-11 21:29:41'),
(93, 56, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-11 21:42:53'),
(94, 56, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-11 21:44:11'),
(95, 41, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-11 21:47:30'),
(96, 82, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-20 16:46:33'),
(97, 56, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-21 21:13:16'),
(98, 56, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-21 21:25:03'),
(99, 56, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-21 22:15:49'),
(100, 65, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-21 22:22:42'),
(101, 56, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-21 22:37:23'),
(102, 65, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-21 22:55:56'),
(103, 47, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-22 15:53:28'),
(104, 73, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-07-24 12:51:15'),
(105, 105, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-24 13:20:42'),
(106, 82, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-25 17:08:22'),
(107, 62, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-26 10:22:20'),
(108, 62, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-26 10:22:33'),
(109, 90, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-07-26 10:23:07'),
(110, 119, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-08-02 17:25:49'),
(111, 119, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 1, '2026-08-02 20:40:35');

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
(190, 39, 22, '2026-01-15', 'Saat dilakukan pemeriksaan kerapian, siswa diketahui menggunakan make-up yang cukup mencolok dan tidak sesuai dengan ketentuan tata tertib sekolah. Siswa telah diberikan teguran serta penjelasan mengenai pentingnya menjaga kerapian dan kesederhanaan penampilan selama berada di lingkungan sekolah.', 2),
(191, 39, 2, '2026-02-12', 'Siswa tidak mengikuti kegiatan pembelajaran selama satu hari tanpa memberikan surat izin maupun informasi kepada wali kelas. Ketidakhadiran tersebut menyebabkan siswa tertinggal beberapa materi pelajaran yang disampaikan pada hari tersebut.', 7),
(251, 0, 28, '2026-01-06', 'ss', 5),
(252, 0, 29, '2026-01-05', 'fff', 3),
(339, 91, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(340, 91, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(341, 91, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(342, 91, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(343, 91, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(344, 91, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(345, 92, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(346, 92, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(347, 92, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(348, 92, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(349, 92, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(350, 92, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(351, 93, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(352, 93, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(353, 93, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(354, 93, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(355, 93, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(356, 93, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(357, 94, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(358, 94, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(359, 94, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(360, 94, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(361, 94, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(362, 94, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(363, 95, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(364, 95, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(365, 95, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(366, 95, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(367, 95, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(368, 95, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(369, 96, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(370, 96, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(371, 96, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(372, 96, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(373, 96, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(374, 96, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(375, 97, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(376, 97, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(377, 97, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(378, 97, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(379, 97, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(380, 97, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(381, 98, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(382, 98, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(383, 98, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(384, 98, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(385, 98, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(386, 98, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(387, 99, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(388, 99, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(389, 99, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(390, 99, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(391, 99, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(392, 99, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(393, 100, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(394, 100, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(395, 100, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(396, 100, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(397, 100, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(398, 100, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(399, 101, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(400, 101, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(401, 101, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(402, 101, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(403, 101, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(404, 101, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(405, 102, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(406, 102, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(407, 102, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(408, 102, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(409, 102, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(410, 102, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(411, 103, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(412, 103, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(413, 103, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(414, 103, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(415, 103, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(416, 103, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(417, 104, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(418, 104, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(419, 104, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(420, 104, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(421, 104, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(422, 104, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(423, 105, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(424, 105, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(425, 105, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(426, 105, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(427, 105, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(428, 105, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(429, 106, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(430, 106, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(431, 106, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(432, 106, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(433, 106, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(434, 106, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(435, 107, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(436, 107, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(437, 107, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(438, 107, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(439, 107, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(440, 107, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(441, 108, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(442, 108, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(443, 108, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(444, 108, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(445, 108, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(446, 108, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(447, 109, 27, '2026-01-13', 'Terlambat menyerahkan tugas mata pelajaran Matematika.', 5),
(448, 109, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(449, 109, 23, '2026-03-18', 'Memakai jaket di dalam kelas saat kegiatan belajar mengajar.', 2),
(450, 109, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(451, 109, 11, '2026-05-20', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(452, 109, 58, '2026-06-10', 'Menggunakan HP saat pelajaran tanpa izin guru.', 5),
(453, 91, 24, '2026-06-18', 'Tidak mengikuti upacara bendera tanpa memberikan izin kepada guru piket.', 10),
(454, 92, 20, '2026-06-19', 'Saat pemeriksaan atribut sekolah, siswa tidak memakai kaos kaki sesuai ketentuan sekolah.', 4),
(455, 93, 18, '2026-06-17', 'Model rambut siswa tidak sesuai dengan tata tertib yang berlaku di sekolah.', 5),
(456, 94, 48, '2026-06-16', 'Siswa meninggalkan ruang kelas tanpa meminta izin kepada guru saat pembelajaran berlangsung.', 20),
(457, 95, 51, '2026-06-15', 'Siswa membuat kegaduhan di dalam kelas sehingga mengganggu proses pembelajaran.', 15),
(458, 96, 52, '2026-06-22', 'Siswa berada di kantin pada saat jam pelajaran masih berlangsung tanpa izin.', 10),
(459, 97, 55, '2026-06-23', 'Kendaraan siswa diparkir tidak pada tempat yang telah ditentukan sekolah.', 5),
(460, 98, 29, '2026-06-24', 'Siswa tidak mengikuti kegiatan ekstrakurikuler tanpa memberikan keterangan.', 3),
(461, 99, 2, '2026-06-25', 'Siswa tidak masuk sekolah tanpa memberikan surat izin maupun keterangan.', 7),
(462, 100, 58, '2026-06-26', 'Siswa menggunakan telepon seluler saat pembelajaran berlangsung tanpa izin guru.', 5),
(554, 37, 22, '2026-01-08', 'Menggunakan aksesoris yang tidak sesuai dengan ketentuan sekolah.', 2),
(555, 37, 28, '2026-02-11', 'Tidak membawa buku mata pelajaran sesuai jadwal.', 5),
(556, 37, 11, '2026-03-17', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(557, 37, 54, '2026-04-14', 'Membuang sampah sembarangan setelah jam istirahat.', 5),
(558, 37, 23, '2026-05-20', 'Memakai jaket di dalam kelas saat pembelajaran berlangsung.', 2),
(559, 37, 58, '2026-06-09', 'Menggunakan telepon seluler saat pelajaran tanpa izin guru.', 5),
(560, 41, 20, '2026-01-09', 'Atribut seragam sekolah tidak lengkap saat pemeriksaan.', 4),
(561, 41, 27, '2026-02-12', 'Terlambat menyerahkan tugas Matematika.', 5),
(562, 41, 29, '2026-03-18', 'Tidak mengikuti kegiatan ekstrakurikuler tanpa keterangan.', 3),
(563, 41, 55, '2026-04-21', 'Memarkir kendaraan di luar area parkir siswa.', 5),
(564, 41, 11, '2026-05-22', 'Belum mengumpulkan tugas PKK.', 5),
(565, 41, 24, '2026-06-16', 'Tidak mengikuti upacara bendera tanpa alasan yang jelas.', 10),
(566, 46, 21, '2026-01-13', 'Tidak menggunakan ikat pinggang sesuai ketentuan sekolah.', 2),
(567, 46, 28, '2026-02-16', 'Tidak membawa buku pelajaran Produktif.', 5),
(568, 46, 54, '2026-03-20', 'Membuang sampah plastik di halaman sekolah.', 5),
(569, 46, 23, '2026-04-15', 'Memakai jaket saat pelajaran berlangsung.', 2),
(570, 46, 57, '2026-05-19', 'Bermain kartu di kelas sebelum guru datang.', 5),
(571, 46, 58, '2026-06-18', 'Menggunakan HP saat guru menjelaskan materi.', 5),
(572, 47, 27, '2026-01-14', 'Terlambat mengumpulkan laporan praktikum.', 5),
(573, 47, 20, '2026-02-17', 'Seragam tidak lengkap saat pemeriksaan pagi.', 4),
(574, 47, 18, '2026-03-16', 'Model rambut tidak sesuai tata tertib sekolah.', 5),
(575, 47, 25, '2026-04-22', 'Tidak mengerjakan tugas yang diberikan guru.', 5),
(576, 47, 55, '2026-05-21', 'Kendaraan diparkir di area guru.', 5),
(577, 47, 51, '2026-06-24', 'Mengobrol dengan suara keras sehingga mengganggu pembelajaran.', 15),
(578, 48, 22, '2026-01-12', 'Menggunakan aksesoris yang tidak diperbolehkan.', 2),
(579, 48, 29, '2026-02-10', 'Tidak mengikuti kegiatan ekstrakurikuler tanpa izin.', 3),
(580, 48, 11, '2026-03-19', 'Terlambat mengumpulkan tugas Informatika.', 5),
(581, 48, 54, '2026-04-23', 'Membuang bungkus makanan di bawah meja kelas.', 5),
(582, 48, 23, '2026-05-18', 'Menggunakan jaket saat kegiatan belajar berlangsung.', 2),
(584, 49, 20, '2026-01-07', 'Tidak memakai atribut seragam sekolah secara lengkap saat pemeriksaan pagi.', 4),
(585, 49, 27, '2026-02-10', 'Terlambat mengumpulkan tugas mata pelajaran Matematika.', 5),
(586, 49, 23, '2026-03-16', 'Menggunakan jaket di dalam kelas saat pembelajaran berlangsung.', 2),
(587, 49, 54, '2026-04-15', 'Membuang sampah plastik di halaman sekolah.', 5),
(588, 49, 58, '2026-05-21', 'Menggunakan telepon seluler saat guru menjelaskan materi.', 5),
(589, 49, 24, '2026-06-22', 'Tidak mengikuti upacara bendera tanpa memberikan keterangan.', 10),
(590, 50, 22, '2026-01-09', 'Menggunakan aksesoris yang tidak sesuai dengan tata tertib sekolah.', 2),
(591, 50, 28, '2026-02-12', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(592, 50, 11, '2026-03-19', 'Belum mengumpulkan tugas Bahasa Indonesia sesuai batas waktu.', 5),
(593, 50, 29, '2026-04-17', 'Tidak mengikuti kegiatan ekstrakurikuler tanpa izin.', 3),
(594, 50, 55, '2026-05-20', 'Memarkir kendaraan di luar area parkir siswa.', 5),
(595, 50, 48, '2026-06-24', 'Keluar dari kelas saat pembelajaran tanpa meminta izin.', 20),
(596, 51, 21, '2026-01-13', 'Tidak menggunakan ikat pinggang sesuai ketentuan sekolah.', 2),
(597, 51, 20, '2026-02-11', 'Atribut seragam sekolah tidak lengkap saat pemeriksaan.', 4),
(598, 51, 27, '2026-03-18', 'Terlambat menyerahkan tugas produktif.', 5),
(599, 51, 54, '2026-04-21', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(600, 51, 23, '2026-05-18', 'Menggunakan jaket di dalam kelas ketika pembelajaran berlangsung.', 2),
(601, 51, 51, '2026-06-23', 'Membuat kegaduhan di kelas sehingga mengganggu proses pembelajaran.', 15),
(602, 52, 22, '2026-01-08', 'Menggunakan riasan yang tidak sesuai dengan peraturan sekolah.', 2),
(603, 52, 28, '2026-02-09', 'Tidak membawa buku mata pelajaran Produktif.', 5),
(604, 52, 11, '2026-03-17', 'Terlambat mengumpulkan tugas PKK.', 5),
(605, 52, 25, '2026-04-16', 'Tidak mengerjakan tugas yang diberikan guru.', 5),
(606, 52, 58, '2026-05-26', 'Menggunakan telepon seluler saat pembelajaran berlangsung.', 5),
(607, 52, 52, '2026-06-18', 'Berada di kantin saat jam pelajaran tanpa izin.', 10),
(608, 53, 18, '2026-01-15', 'Model rambut tidak sesuai dengan ketentuan sekolah.', 5),
(609, 53, 29, '2026-02-18', 'Tidak mengikuti kegiatan ekstrakurikuler wajib tanpa izin.', 3),
(610, 53, 11, '2026-03-20', 'Belum mengumpulkan tugas mata pelajaran Informatika.', 5),
(611, 53, 54, '2026-04-22', 'Membuang sampah sembarangan setelah waktu istirahat.', 5),
(612, 53, 57, '2026-05-19', 'Bermain kartu di dalam kelas sebelum guru datang.', 5),
(613, 53, 24, '2026-06-25', 'Tidak mengikuti upacara bendera tanpa alasan yang dapat dipertanggungjawabkan.', 10),
(614, 54, 20, '2026-01-08', 'Tidak mengenakan atribut seragam sekolah secara lengkap saat pemeriksaan pagi.', 4),
(615, 54, 27, '2026-02-13', 'Terlambat menyerahkan tugas mata pelajaran Bahasa Indonesia.', 5),
(616, 54, 23, '2026-03-17', 'Menggunakan jaket di dalam kelas ketika proses pembelajaran berlangsung.', 2),
(617, 54, 55, '2026-04-21', 'Sepeda motor diparkir di luar area parkir yang telah ditentukan.', 5),
(618, 54, 11, '2026-05-20', 'Belum mengumpulkan tugas mata pelajaran Produktif sesuai jadwal.', 5),
(619, 54, 48, '2026-06-24', 'Meninggalkan ruang kelas tanpa meminta izin kepada guru.', 20),
(620, 55, 22, '2026-01-09', 'Menggunakan aksesoris yang tidak sesuai dengan ketentuan sekolah.', 2),
(621, 55, 28, '2026-02-11', 'Tidak membawa buku mata pelajaran sesuai jadwal.', 5),
(622, 55, 29, '2026-03-19', 'Tidak mengikuti kegiatan ekstrakurikuler wajib tanpa keterangan.', 3),
(623, 55, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(624, 55, 58, '2026-05-22', 'Menggunakan telepon seluler saat pembelajaran berlangsung tanpa izin.', 5),
(625, 55, 24, '2026-06-18', 'Tidak mengikuti upacara bendera tanpa alasan yang jelas.', 10),
(626, 56, 21, '2026-01-13', 'Tidak menggunakan ikat pinggang sesuai aturan sekolah.', 2),
(627, 56, 20, '2026-02-10', 'Atribut seragam tidak lengkap saat pemeriksaan.', 4),
(628, 56, 11, '2026-03-18', 'Terlambat mengumpulkan tugas mata pelajaran Matematika.', 5),
(629, 56, 25, '2026-04-22', 'Tidak mengerjakan tugas yang diberikan oleh guru.', 5),
(630, 56, 57, '2026-05-21', 'Bermain kartu di dalam kelas sebelum guru memasuki ruangan.', 5),
(631, 56, 51, '2026-06-23', 'Membuat kegaduhan di dalam kelas sehingga mengganggu proses belajar.', 15),
(632, 57, 22, '2026-01-12', 'Menggunakan riasan yang tidak sesuai dengan tata tertib sekolah.', 2),
(633, 57, 27, '2026-02-16', 'Terlambat mengumpulkan laporan praktikum.', 5),
(634, 57, 23, '2026-03-20', 'Menggunakan jaket di dalam kelas selama kegiatan belajar.', 2),
(635, 57, 54, '2026-04-16', 'Membuang sampah bekas makanan di halaman sekolah.', 5),
(636, 57, 58, '2026-05-26', 'Menggunakan telepon seluler saat guru sedang menjelaskan materi.', 5),
(637, 57, 52, '2026-06-17', 'Berada di kantin pada saat jam pelajaran tanpa izin.', 10),
(638, 58, 18, '2026-01-15', 'Model rambut tidak sesuai dengan tata tertib sekolah.', 5),
(639, 58, 28, '2026-02-17', 'Tidak membawa buku pelajaran Produktif sesuai jadwal.', 5),
(640, 58, 11, '2026-03-18', 'Belum menyerahkan tugas mata pelajaran PKK.', 5),
(641, 58, 55, '2026-04-23', 'Memarkir kendaraan di tempat yang bukan area parkir siswa.', 5),
(642, 58, 23, '2026-05-19', 'Menggunakan jaket saat proses pembelajaran berlangsung.', 2),
(643, 58, 24, '2026-06-25', 'Tidak mengikuti upacara bendera tanpa memberikan keterangan.', 10),
(644, 59, 20, '2026-01-07', 'Atribut seragam tidak lengkap saat pemeriksaan pagi.', 4),
(645, 59, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(646, 59, 11, '2026-03-18', 'Terlambat mengumpulkan tugas Bahasa Indonesia.', 5),
(647, 59, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(648, 59, 58, '2026-05-20', 'Menggunakan telepon seluler saat pembelajaran tanpa izin.', 5),
(649, 59, 24, '2026-06-22', 'Tidak mengikuti upacara bendera tanpa keterangan.', 10),
(650, 60, 22, '2026-01-09', 'Menggunakan aksesoris yang tidak sesuai ketentuan sekolah.', 2),
(651, 60, 27, '2026-02-13', 'Terlambat menyerahkan tugas Matematika.', 5),
(652, 60, 23, '2026-03-17', 'Menggunakan jaket saat proses pembelajaran.', 2),
(653, 60, 25, '2026-04-21', 'Tidak mengerjakan tugas yang diberikan guru.', 5),
(654, 60, 55, '2026-05-18', 'Memarkir kendaraan di luar area parkir siswa.', 5),
(655, 60, 48, '2026-06-24', 'Keluar dari kelas tanpa meminta izin guru.', 20),
(656, 61, 21, '2026-01-12', 'Tidak memakai ikat pinggang sesuai ketentuan.', 2),
(657, 61, 20, '2026-02-10', 'Atribut seragam tidak lengkap saat pemeriksaan.', 4),
(658, 61, 29, '2026-03-19', 'Tidak mengikuti kegiatan ekstrakurikuler tanpa izin.', 3),
(659, 61, 54, '2026-04-22', 'Membuang sampah sembarangan setelah jam istirahat.', 5),
(660, 61, 11, '2026-05-19', 'Belum mengumpulkan tugas Produktif.', 5),
(661, 61, 24, '2026-06-18', 'Tidak mengikuti upacara bendera tanpa alasan.', 10),
(662, 62, 22, '2026-01-08', 'Menggunakan riasan yang tidak sesuai tata tertib.', 2),
(663, 62, 28, '2026-02-16', 'Tidak membawa buku pelajaran Produktif.', 5),
(664, 62, 11, '2026-03-20', 'Terlambat mengumpulkan tugas PKK.', 5),
(665, 62, 55, '2026-04-23', 'Kendaraan diparkir di area guru.', 5),
(666, 62, 23, '2026-05-21', 'Menggunakan jaket saat pembelajaran berlangsung.', 2),
(667, 62, 52, '2026-06-17', 'Berada di kantin saat jam pelajaran tanpa izin.', 10),
(668, 63, 18, '2026-01-14', 'Model rambut tidak sesuai tata tertib sekolah.', 5),
(669, 63, 27, '2026-02-18', 'Terlambat mengumpulkan tugas Informatika.', 5),
(670, 63, 23, '2026-03-18', 'Menggunakan jaket di dalam kelas.', 2),
(671, 63, 54, '2026-04-16', 'Membuang sampah sembarangan di halaman sekolah.', 5),
(672, 63, 57, '2026-05-22', 'Bermain kartu di kelas sebelum guru datang.', 5),
(673, 63, 51, '2026-06-25', 'Membuat kegaduhan sehingga mengganggu pembelajaran.', 15),
(674, 64, 20, '2026-01-13', 'Atribut seragam sekolah tidak lengkap.', 4),
(675, 64, 28, '2026-02-17', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(676, 64, 11, '2026-03-19', 'Belum menyerahkan tugas Bahasa Inggris.', 5),
(677, 64, 29, '2026-04-15', 'Tidak mengikuti kegiatan ekstrakurikuler tanpa izin.', 3),
(678, 64, 58, '2026-05-26', 'Menggunakan HP saat guru menjelaskan materi.', 5),
(679, 64, 24, '2026-06-23', 'Tidak mengikuti upacara bendera tanpa keterangan.', 10),
(680, 65, 21, '2026-01-09', 'Tidak memakai atribut sekolah sesuai ketentuan.', 2),
(681, 65, 27, '2026-02-12', 'Terlambat menyerahkan tugas Produktif.', 5),
(682, 65, 25, '2026-03-17', 'Tidak mengerjakan tugas yang diberikan guru.', 5),
(683, 65, 54, '2026-04-21', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(684, 65, 55, '2026-05-20', 'Memarkir kendaraan tidak pada tempatnya.', 5),
(685, 65, 48, '2026-06-24', 'Keluar kelas tanpa izin saat pembelajaran.', 20),
(686, 110, 22, '2026-01-08', 'Menggunakan aksesoris yang tidak sesuai aturan sekolah.', 2),
(687, 110, 28, '2026-02-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(688, 110, 11, '2026-03-18', 'Terlambat mengumpulkan tugas Matematika.', 5),
(689, 110, 54, '2026-04-15', 'Membuang sampah sembarangan di lingkungan sekolah.', 5),
(690, 110, 23, '2026-05-21', 'Menggunakan jaket di dalam kelas saat pembelajaran.', 2),
(691, 110, 58, '2026-06-22', 'Menggunakan telepon seluler saat pembelajaran tanpa izin guru.', 5),
(692, 111, 24, '2026-01-13', 'Siswa Terpantau Tidak mengikuti upacara sekolah', 10),
(693, 111, 48, '2026-02-19', 'Siswa meninggalkan ruang kelas tanpa meminta izin kepada guru saat pembelajaran berlangsung.', 20),
(694, 111, 29, '2026-05-19', 'Siswa tidak mengikuti kegiatan ekstrakurikuler tanpa memberikan keterangan.', 3),
(695, 111, 28, '2026-04-06', 'Siswa tidak membawa buku catatan matematika ', 5),
(696, 110, 1, '2026-07-07', 'i', 10),
(697, 38, 19, '2026-01-10', 'Atribut sekolah tidak lengkap.', 4),
(698, 43, 28, '2026-01-11', 'Tidak membawa buku pelajaran sesuai jadwal.', 5),
(699, 66, 20, '2026-01-12', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(700, 67, 22, '2026-01-12', 'Menggunakan make-up berlebihan saat sekolah.', 2),
(701, 68, 23, '2026-01-13', 'Menggunakan jaket di lingkungan sekolah.', 2),
(702, 69, 54, '2026-01-13', 'Membuang sampah sembarangan.', 5),
(703, 70, 19, '2026-01-14', 'Atribut sekolah tidak lengkap.', 4),
(704, 71, 55, '2026-01-14', 'Memarkir kendaraan tidak pada tempatnya.', 5),
(705, 72, 28, '2026-01-15', 'Tidak membawa buku pelajaran.', 5),
(706, 73, 20, '2026-01-15', 'Menggunakan kaos kaki tidak sesuai ketentuan.', 4),
(707, 74, 52, '2026-01-16', 'Berada di kantin saat jam pelajaran.', 10),
(708, 75, 19, '2026-01-16', 'Atribut sekolah tidak lengkap.', 4),
(709, 76, 23, '2026-01-17', 'Menggunakan jaket saat pembelajaran.', 2),
(710, 77, 28, '2026-01-17', 'Tidak membawa buku pelajaran.', 5),
(711, 78, 54, '2026-01-18', 'Membuang sampah sembarangan.', 5),
(712, 79, 19, '2026-01-18', 'Atribut sekolah tidak lengkap.', 4),
(713, 80, 20, '2026-01-19', 'Sepatu tidak sesuai ketentuan.', 4),
(714, 81, 23, '2026-01-19', 'Menggunakan jaket di lingkungan sekolah.', 2),
(715, 82, 28, '2026-01-20', 'Tidak membawa buku pelajaran.', 5),
(716, 83, 54, '2026-01-20', 'Membuang sampah sembarangan.', 5),
(717, 84, 19, '2026-01-21', 'Atribut sekolah tidak lengkap.', 4),
(718, 85, 20, '2026-01-21', 'Ikat pinggang tidak sesuai ketentuan.', 4),
(719, 86, 52, '2026-01-22', 'Berada di kantin saat jam pelajaran.', 10),
(720, 87, 23, '2026-01-22', 'Menggunakan jaket di lingkungan sekolah.', 2),
(721, 88, 28, '2026-01-23', 'Tidak membawa buku pelajaran.', 5),
(722, 89, 54, '2026-01-23', 'Membuang sampah sembarangan.', 5),
(723, 90, 19, '2026-01-24', 'Atribut sekolah tidak lengkap.', 4),
(724, 38, 28, '2026-02-08', 'Tidak membawa buku pelajaran.', 5),
(725, 43, 19, '2026-02-08', 'Atribut sekolah tidak lengkap.', 4),
(726, 66, 20, '2026-02-09', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(727, 67, 54, '2026-02-09', 'Membuang sampah sembarangan.', 5),
(728, 68, 23, '2026-02-10', 'Menggunakan jaket di lingkungan sekolah.', 2),
(729, 69, 52, '2026-02-10', 'Berada di kantin saat jam pelajaran.', 10),
(730, 69, 19, '2026-02-22', 'Atribut sekolah tidak lengkap.', 4),
(731, 70, 28, '2026-02-11', 'Tidak membawa buku pelajaran.', 5),
(732, 71, 20, '2026-02-11', 'Menggunakan kaos kaki tidak sesuai ketentuan.', 4),
(733, 72, 23, '2026-02-12', 'Menggunakan jaket di lingkungan sekolah.', 2),
(734, 73, 54, '2026-02-12', 'Membuang sampah sembarangan.', 5),
(735, 74, 19, '2026-02-13', 'Atribut sekolah tidak lengkap.', 4),
(736, 75, 28, '2026-02-13', 'Tidak membawa buku pelajaran.', 5),
(737, 76, 52, '2026-02-14', 'Berada di kantin saat jam pelajaran.', 10),
(738, 77, 20, '2026-02-14', 'Sepatu tidak sesuai ketentuan.', 4),
(739, 78, 23, '2026-02-15', 'Menggunakan jaket di lingkungan sekolah.', 2),
(740, 79, 54, '2026-02-15', 'Membuang sampah sembarangan.', 5),
(741, 80, 19, '2026-02-16', 'Atribut sekolah tidak lengkap.', 4),
(742, 81, 28, '2026-02-16', 'Tidak membawa buku pelajaran.', 5),
(743, 82, 20, '2026-02-17', 'Menggunakan ikat pinggang tidak sesuai.', 4),
(744, 83, 52, '2026-02-17', 'Berada di kantin saat jam pelajaran.', 10),
(745, 83, 54, '2026-02-25', 'Membuang sampah sembarangan.', 5),
(746, 84, 23, '2026-02-18', 'Menggunakan jaket di lingkungan sekolah.', 2),
(747, 85, 19, '2026-02-18', 'Atribut sekolah tidak lengkap.', 4),
(748, 86, 28, '2026-02-19', 'Tidak membawa buku pelajaran.', 5),
(749, 87, 54, '2026-02-19', 'Membuang sampah sembarangan.', 5),
(750, 88, 20, '2026-02-20', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(751, 89, 52, '2026-02-20', 'Berada di kantin saat jam pelajaran.', 10),
(752, 89, 23, '2026-02-27', 'Menggunakan jaket di lingkungan sekolah.', 2),
(753, 90, 19, '2026-02-21', 'Atribut sekolah tidak lengkap.', 4),
(754, 38, 20, '2026-03-08', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(755, 43, 54, '2026-03-08', 'Membuang sampah sembarangan.', 5),
(756, 66, 19, '2026-03-09', 'Atribut sekolah tidak lengkap.', 4),
(757, 67, 28, '2026-03-09', 'Tidak membawa buku pelajaran.', 5),
(758, 68, 52, '2026-03-10', 'Berada di kantin saat jam pelajaran.', 10),
(759, 68, 23, '2026-03-24', 'Menggunakan jaket di lingkungan sekolah.', 2),
(760, 69, 20, '2026-03-10', 'Menggunakan kaos kaki tidak sesuai ketentuan.', 4),
(761, 70, 54, '2026-03-11', 'Membuang sampah sembarangan.', 5),
(762, 71, 19, '2026-03-11', 'Atribut sekolah tidak lengkap.', 4),
(763, 72, 28, '2026-03-12', 'Tidak membawa buku pelajaran.', 5),
(764, 73, 23, '2026-03-12', 'Menggunakan jaket di lingkungan sekolah.', 2),
(765, 74, 20, '2026-03-13', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(766, 74, 54, '2026-03-26', 'Membuang sampah sembarangan.', 5),
(767, 75, 52, '2026-03-13', 'Berada di kantin saat jam pelajaran.', 10),
(768, 76, 19, '2026-03-14', 'Atribut sekolah tidak lengkap.', 4),
(769, 77, 28, '2026-03-14', 'Tidak membawa buku pelajaran.', 5),
(770, 78, 20, '2026-03-15', 'Menggunakan ikat pinggang tidak sesuai.', 4),
(771, 79, 23, '2026-03-15', 'Menggunakan jaket di lingkungan sekolah.', 2),
(772, 80, 54, '2026-03-16', 'Membuang sampah sembarangan.', 5),
(773, 81, 19, '2026-03-16', 'Atribut sekolah tidak lengkap.', 4),
(774, 82, 28, '2026-03-17', 'Tidak membawa buku pelajaran.', 5),
(775, 82, 20, '2026-03-27', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(776, 83, 23, '2026-03-17', 'Menggunakan jaket di lingkungan sekolah.', 2),
(777, 84, 52, '2026-03-18', 'Berada di kantin saat jam pelajaran.', 10),
(778, 85, 19, '2026-03-18', 'Atribut sekolah tidak lengkap.', 4),
(779, 86, 28, '2026-03-19', 'Tidak membawa buku pelajaran.', 5),
(780, 87, 54, '2026-03-19', 'Membuang sampah sembarangan.', 5),
(781, 88, 20, '2026-03-20', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(782, 88, 19, '2026-03-28', 'Atribut sekolah tidak lengkap.', 4),
(783, 89, 23, '2026-03-20', 'Menggunakan jaket di lingkungan sekolah.', 2),
(784, 90, 52, '2026-03-21', 'Berada di kantin saat jam pelajaran.', 10),
(816, 38, 54, '2026-04-08', 'Membuang sampah sembarangan.', 5),
(817, 43, 20, '2026-04-08', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(818, 66, 28, '2026-04-09', 'Tidak membawa buku pelajaran.', 5),
(819, 67, 19, '2026-04-09', 'Atribut sekolah tidak lengkap.', 4),
(820, 68, 23, '2026-04-10', 'Menggunakan jaket di lingkungan sekolah.', 2),
(821, 69, 20, '2026-04-10', 'Menggunakan kaos kaki tidak sesuai ketentuan.', 4),
(822, 70, 52, '2026-04-11', 'Berada di kantin saat jam pelajaran.', 10),
(823, 70, 54, '2026-04-24', 'Membuang sampah sembarangan.', 5),
(824, 71, 28, '2026-04-11', 'Tidak membawa buku pelajaran.', 5),
(825, 72, 19, '2026-04-12', 'Atribut sekolah tidak lengkap.', 4),
(826, 73, 20, '2026-04-12', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(827, 74, 23, '2026-04-13', 'Menggunakan jaket di lingkungan sekolah.', 2),
(828, 75, 54, '2026-04-13', 'Membuang sampah sembarangan.', 5),
(829, 76, 28, '2026-04-14', 'Tidak membawa buku pelajaran.', 5),
(830, 77, 19, '2026-04-14', 'Atribut sekolah tidak lengkap.', 4),
(831, 78, 52, '2026-04-15', 'Berada di kantin saat jam pelajaran.', 10),
(832, 79, 20, '2026-04-15', 'Menggunakan ikat pinggang tidak sesuai.', 4),
(833, 80, 23, '2026-04-16', 'Menggunakan jaket di lingkungan sekolah.', 2),
(834, 81, 54, '2026-04-16', 'Membuang sampah sembarangan.', 5),
(835, 82, 19, '2026-04-17', 'Atribut sekolah tidak lengkap.', 4),
(836, 83, 28, '2026-04-17', 'Tidak membawa buku pelajaran.', 5),
(837, 84, 20, '2026-04-18', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(838, 85, 52, '2026-04-18', 'Berada di kantin saat jam pelajaran.', 10),
(839, 85, 19, '2026-04-27', 'Atribut sekolah tidak lengkap.', 4),
(840, 86, 23, '2026-04-19', 'Menggunakan jaket di lingkungan sekolah.', 2),
(841, 87, 54, '2026-04-19', 'Membuang sampah sembarangan.', 5),
(842, 88, 28, '2026-04-20', 'Tidak membawa buku pelajaran.', 5),
(843, 89, 20, '2026-04-20', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(844, 90, 52, '2026-04-21', 'Berada di kantin saat jam pelajaran.', 10),
(845, 90, 23, '2026-04-28', 'Menggunakan jaket di lingkungan sekolah.', 2),
(846, 38, 19, '2026-05-09', 'Atribut sekolah tidak lengkap.', 4),
(847, 43, 23, '2026-05-09', 'Menggunakan jaket di lingkungan sekolah.', 2),
(848, 66, 54, '2026-05-10', 'Membuang sampah sembarangan.', 5),
(849, 67, 20, '2026-05-10', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(850, 68, 28, '2026-05-11', 'Tidak membawa buku pelajaran.', 5),
(851, 68, 19, '2026-05-26', 'Atribut sekolah tidak lengkap.', 4),
(852, 69, 52, '2026-05-11', 'Berada di kantin saat jam pelajaran.', 10),
(853, 70, 23, '2026-05-12', 'Menggunakan jaket di lingkungan sekolah.', 2),
(854, 71, 54, '2026-05-12', 'Membuang sampah sembarangan.', 5),
(855, 72, 20, '2026-05-13', 'Menggunakan kaos kaki tidak sesuai ketentuan.', 4),
(856, 73, 28, '2026-05-13', 'Tidak membawa buku pelajaran.', 5),
(857, 74, 19, '2026-05-14', 'Atribut sekolah tidak lengkap.', 4),
(858, 75, 52, '2026-05-14', 'Berada di kantin saat jam pelajaran.', 10),
(859, 76, 54, '2026-05-15', 'Membuang sampah sembarangan.', 5),
(860, 76, 20, '2026-05-28', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(861, 77, 23, '2026-05-15', 'Menggunakan jaket di lingkungan sekolah.', 2),
(862, 78, 28, '2026-05-16', 'Tidak membawa buku pelajaran.', 5),
(863, 79, 19, '2026-05-16', 'Atribut sekolah tidak lengkap.', 4),
(864, 80, 20, '2026-05-17', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(865, 81, 52, '2026-05-17', 'Berada di kantin saat jam pelajaran.', 10),
(866, 82, 54, '2026-05-18', 'Membuang sampah sembarangan.', 5),
(867, 83, 23, '2026-05-18', 'Menggunakan jaket di lingkungan sekolah.', 2),
(868, 84, 28, '2026-05-19', 'Tidak membawa buku pelajaran.', 5),
(869, 84, 54, '2026-05-29', 'Membuang sampah sembarangan.', 5),
(870, 85, 20, '2026-05-19', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(871, 86, 19, '2026-05-20', 'Atribut sekolah tidak lengkap.', 4),
(872, 87, 52, '2026-05-20', 'Berada di kantin saat jam pelajaran.', 10),
(873, 88, 23, '2026-05-21', 'Menggunakan jaket di lingkungan sekolah.', 2),
(874, 89, 28, '2026-05-21', 'Tidak membawa buku pelajaran.', 5),
(875, 89, 20, '2026-05-30', 'Menggunakan kaos kaki tidak sesuai ketentuan.', 4),
(876, 90, 54, '2026-05-22', 'Membuang sampah sembarangan.', 5),
(877, 38, 20, '2026-06-25', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(878, 43, 54, '2026-06-25', 'Membuang sampah sembarangan.', 5),
(879, 66, 19, '2026-06-25', 'Atribut sekolah tidak lengkap.', 4),
(880, 67, 28, '2026-06-25', 'Tidak membawa buku pelajaran.', 5),
(881, 68, 23, '2026-06-25', 'Menggunakan jaket di lingkungan sekolah.', 2),
(882, 69, 52, '2026-06-25', 'Berada di kantin saat jam pelajaran.', 10),
(883, 70, 20, '2026-06-26', 'Menggunakan kaos kaki tidak sesuai ketentuan.', 4),
(884, 71, 54, '2026-06-26', 'Membuang sampah sembarangan.', 5),
(885, 72, 19, '2026-06-26', 'Atribut sekolah tidak lengkap.', 4),
(886, 73, 28, '2026-06-26', 'Tidak membawa buku pelajaran.', 5),
(887, 74, 23, '2026-06-26', 'Menggunakan jaket di lingkungan sekolah.', 2),
(888, 74, 54, '2026-06-30', 'Membuang sampah sembarangan.', 5),
(889, 75, 20, '2026-06-27', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(890, 76, 52, '2026-06-27', 'Berada di kantin saat jam pelajaran.', 10),
(891, 77, 19, '2026-06-27', 'Atribut sekolah tidak lengkap.', 4),
(892, 78, 28, '2026-06-27', 'Tidak membawa buku pelajaran.', 5),
(893, 79, 54, '2026-06-27', 'Membuang sampah sembarangan.', 5),
(894, 80, 23, '2026-06-27', 'Menggunakan jaket di lingkungan sekolah.', 2),
(895, 81, 20, '2026-06-28', 'Menggunakan sepatu tidak sesuai ketentuan.', 4),
(896, 82, 19, '2026-06-28', 'Atribut sekolah tidak lengkap.', 4),
(897, 83, 52, '2026-06-28', 'Berada di kantin saat jam pelajaran.', 10),
(898, 83, 23, '2026-06-30', 'Menggunakan jaket di lingkungan sekolah.', 2),
(899, 84, 54, '2026-06-28', 'Membuang sampah sembarangan.', 5),
(900, 85, 28, '2026-06-28', 'Tidak membawa buku pelajaran.', 5),
(901, 86, 20, '2026-06-29', 'Menggunakan kaos kaki tidak sesuai ketentuan.', 4),
(902, 87, 19, '2026-06-29', 'Atribut sekolah tidak lengkap.', 4),
(903, 88, 23, '2026-06-29', 'Menggunakan jaket di lingkungan sekolah.', 2),
(904, 89, 52, '2026-06-29', 'Berada di kantin saat jam pelajaran.', 10),
(905, 89, 54, '2026-06-30', 'Membuang sampah sembarangan.', 5),
(906, 90, 28, '2026-06-30', 'Tidak membawa buku pelajaran.', 5),
(911, 115, 41, '2026-06-09', '=', 50),
(916, 117, 1, '2026-06-11', '-', 10),
(917, 56, 7, '2026-06-24', 'Mengecat rambut tidak sesuai aturan sekolah', 5),
(918, 56, 23, '2026-06-25', 'memakai jaket di dalam kelas', 2),
(919, 41, 23, '2026-01-13', 'Memakai jaket saat jam pelajaran', 2),
(920, 82, 21, '2026-07-20', 'Mamakai prhiasanyang tidak seharusnya', 50),
(922, 56, 1, '2026-07-21', '-', 10),
(923, 56, 44, '2026-07-21', '-', 25),
(924, 65, 1, '2026-07-21', '-oksss', 10),
(925, 56, 2, '2026-07-21', '-', 7),
(926, 65, 7, '2026-07-21', '-', 5),
(927, 47, 23, '2026-07-22', 'Memakai jaket pada saat jam pelajaran di kelas', 2),
(928, 73, 23, '2026-07-24', 'Siswa memakai jaket ketika pembelajaran berlangsung', 2),
(929, 105, 7, '2026-07-24', 'Siswa mengecat rambut dengan warna pink', 5),
(930, 82, 45, '2026-07-25', 'Siswa merusak kursi kelas', 25),
(931, 62, 23, '2026-07-26', 'Siswa memakai jaket ketika berada di dalam kelas, saat pembelajaran berlangsung.', 2),
(932, 62, 23, '2026-07-26', 'Siswa memakai jaket ketika berada di dalam kelas, saat pembelajaran berlangsung.', 2),
(933, 90, 23, '2026-07-26', 'Siswa memakai jaket ketika berada di dalam kelas, saat pembelajaran berlangsung.', 2),
(934, 119, 23, '2026-07-01', '-', 2),
(935, 119, 1, '2026-08-02', '-', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pemanggilan_siswa`
--

CREATE TABLE `pemanggilan_siswa` (
  `id_pemanggilan` int(11) NOT NULL,
  `id_pelanggaran_siswa` int(11) NOT NULL,
  `tanggal_pemanggilan` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Menunggu Pembinaan','Sudah Dibina') DEFAULT 'Menunggu Pembinaan',
  `tanggal_pembinaan` date DEFAULT NULL,
  `hasil_pembinaan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemanggilan_siswa`
--

INSERT INTO `pemanggilan_siswa` (`id_pemanggilan`, `id_pelanggaran_siswa`, `tanggal_pemanggilan`, `keterangan`, `status`, `tanggal_pembinaan`, `hasil_pembinaan`, `created_at`) VALUES
(1, 922, '2026-07-21', 'Siswa dipanggil ke ruang BK terkait tindakan mencoret-coret sarana prasarana sekolah', 'Sudah Dibina', '2026-07-21', 'Siswa mengakui perbuatannya, menyatakan menyesal, dan bersedia membersihkan serta memperbaiki fasilitas yang dicoret', '2026-07-21 14:25:12'),
(2, 923, '2026-07-22', 'Siswa dipanggil terkait sikap tidak sopan yang ditunjukkan kepada guru di dalam kelas', 'Sudah Dibina', '2026-07-21', 'Siswa diberikan pengertian mengenai pentingnya sopan santun terhadap guru dan berjanji akan memperbaiki sikapnya', '2026-07-21 15:21:20'),
(3, 924, '2026-07-07', 'Siswa dipanggil terkait tindakan mencoret-coret fasilitas sekolah', 'Sudah Dibina', '2026-07-21', 'Siswa menyatakan menyesal atas perbuatannya dan bersedia memperbaiki fasilitas yang rusak', '2026-07-21 15:23:03'),
(4, 925, '2026-07-22', 'Siswa dipanggil karena tidak masuk sekolah tanpa keterangan', 'Sudah Dibina', '2026-07-22', 'Siswa menjelaskan alasan ketidakhadirannya dan berjanji tidak akan absen tanpa izin yang jelas di kemudian hari', '2026-07-21 15:38:23'),
(5, 926, '2026-07-21', 'Siswa dipanggil terkait pengecatan rambut dengan warna yang tidak sesuai ketentuan sekolah', 'Sudah Dibina', '2026-07-15', 'Siswa bersedia mengembalikan warna rambut sesuai ketentuan sekolah dalam waktu dekat', '2026-07-21 15:56:26'),
(6, 927, '2026-07-22', 'Siswa diminta hadir di ruang kelas oleh wali kelas terkait pemakaian jaket saat jam pelajaran', 'Sudah Dibina', '2026-07-22', 'Siswa diberikan peringatan agar tidak lagi memakai jaket di ruang kelas ketika pembelajaran berlangsung', '2026-07-22 09:05:04'),
(7, 929, '2026-07-24', 'Siswa dipanggil terkait pengecatan rambut dengan warna pink yang tidak sesuai ketentuan sekolah', 'Menunggu Pembinaan', NULL, NULL, '2026-07-24 06:26:47'),
(8, 930, '2026-07-25', 'Siswa dipanggil terkait tindakan merusak kursi kelas', 'Menunggu Pembinaan', NULL, NULL, '2026-07-25 10:08:51');

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
(90, 37, '15', 'Peringkat 3 hafalan tahsin', 15, 'Sertifikat_Yuriska_Pratiwi.png', '2026-06-24 21:17:13', 'Disetujui', '', 10),
(91, 38, '15', 'Juara  2 kelas', 15, 'dashboard.png', '2026-07-01 21:38:30', 'Menunggu', NULL, 0),
(92, 40, '25', 'Juara 2 Lomba Menyanyi', 25, 'mockup_laporan_awal 1.png', '2026-07-01 21:39:39', 'Menunggu', NULL, 0),
(93, 111, '15', 'Juara 3 Hafalan Tahsin', 15, 'Sertifikat_SMK_PUI_Jatinangor_Revina_Ayu_Juara_III 1.pdf', '2026-07-05 11:52:51', 'Disetujui', '', 11),
(94, 110, '15', 'Juara  2 kelas', 15, 'Sertifikat_SMK_PUI_Jatinangor_Revina_Ayu_Juara_III 1.pdf', '2026-07-05 21:24:50', 'Disetujui', NULL, 11),
(98, 119, '15', 'Juara HafalanTansin Per bulan', 15, 'FORM PERMOHONAN SIDANG (1).docx', '2026-08-02 20:49:15', 'Disetujui', '', 14);

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
(39, 38, 22, '2026-07-30 04:17:37'),
(40, 39, 4, '2026-07-05 04:08:57'),
(41, 42, 50, '2026-06-26 09:54:43'),
(52, 0, 102, '2026-07-09 06:46:47'),
(53, 91, 33, '2026-07-19 08:14:38'),
(54, 92, 27, '2026-07-19 08:14:38'),
(55, 93, 28, '2026-07-19 08:14:38'),
(56, 94, 44, '2026-07-16 03:38:15'),
(57, 95, 39, '2026-07-16 03:38:15'),
(58, 96, 33, '2026-07-22 08:54:12'),
(59, 97, 28, '2026-07-24 05:35:30'),
(60, 98, 26, '2026-07-24 05:35:30'),
(61, 99, 30, '2026-07-30 04:17:37'),
(62, 100, 28, '2026-07-30 04:17:37'),
(63, 101, 23, '2026-07-11 14:18:14'),
(64, 102, 23, '2026-07-11 14:18:14'),
(65, 103, 23, '2026-07-11 14:18:14'),
(66, 104, 23, '2026-07-11 14:18:14'),
(67, 105, 28, '2026-07-24 06:20:42'),
(68, 106, 23, '2026-07-11 14:18:14'),
(69, 107, 23, '2026-07-11 14:18:14'),
(70, 108, 23, '2026-07-11 14:18:14'),
(71, 109, 23, '2026-07-11 14:18:14'),
(72, 67, 20, '2026-07-30 04:17:37'),
(73, 68, 25, '2026-07-30 04:17:37'),
(74, 69, 44, '2026-07-30 04:17:37'),
(75, 70, 31, '2026-07-30 04:17:37'),
(76, 71, 24, '2026-07-30 04:17:37'),
(77, 72, 19, '2026-07-30 04:17:37'),
(78, 73, 27, '2026-07-24 05:51:15'),
(79, 74, 32, '2026-07-30 04:17:37'),
(80, 75, 34, '2026-07-30 04:17:37'),
(81, 76, 36, '2026-07-30 04:17:37'),
(82, 77, 19, '2026-07-30 04:17:37'),
(83, 78, 27, '2026-07-30 04:17:37'),
(84, 79, 19, '2026-07-30 04:17:37'),
(85, 80, 16, '2026-07-30 04:17:37'),
(86, 81, 26, '2026-07-30 04:17:37'),
(87, 82, 106, '2026-07-25 10:08:22'),
(88, 83, 37, '2026-07-30 04:17:37'),
(89, 84, 31, '2026-07-30 04:17:37'),
(90, 85, 31, '2026-07-30 04:17:37'),
(91, 86, 26, '2026-07-30 04:17:37'),
(92, 87, 27, '2026-07-30 04:17:37'),
(93, 88, 22, '2026-07-30 04:17:37'),
(94, 89, 44, '2026-07-30 04:17:37'),
(95, 90, 42, '2026-07-26 03:23:07'),
(121, 37, 19, '2026-07-09 06:36:28'),
(122, 41, 30, '2026-07-16 03:38:15'),
(123, 46, 19, '2026-07-19 08:14:38'),
(124, 47, 41, '2026-07-22 08:53:28'),
(125, 48, 12, '2026-07-21 15:31:39'),
(126, 49, 27, '2026-07-22 08:54:12'),
(127, 50, 36, '2026-07-24 05:35:30'),
(128, 51, 29, '2026-07-24 05:35:30'),
(129, 52, 28, '2026-07-19 08:14:38'),
(130, 53, 29, '2026-07-30 04:17:37'),
(131, 54, 37, '2026-07-24 05:35:30'),
(132, 55, 26, '2026-07-19 08:14:38'),
(133, 56, 85, '2026-07-21 15:37:23'),
(134, 57, 25, '2026-07-19 08:14:38'),
(135, 58, 28, '2026-07-30 04:17:37'),
(136, 59, 30, '2026-07-22 08:54:12'),
(137, 60, 35, '2026-07-24 05:35:30'),
(138, 61, 25, '2026-07-19 08:14:38'),
(139, 62, 29, '2026-07-26 03:22:33'),
(140, 63, 33, '2026-07-30 04:17:37'),
(141, 64, 28, '2026-07-24 05:35:30'),
(142, 65, 57, '2026-07-21 15:55:56'),
(143, 110, 23, '2026-07-07 15:42:31'),
(146, 111, 19, '2026-07-05 04:53:01'),
(148, 115, 47, '2026-07-09 09:07:15'),
(149, 117, 0, '2026-07-11 14:29:47'),
(150, 119, 0, '2026-08-02 13:49:51');

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
(47, 37, 6, '2026-05-28', 'Tidak melakukan pelanggaran selama 1 bulan berturut-turut', 3),
(57, 0, 6, '2026-05-21', 'Tidak melakukan pelanggaran 30 hari', 3),
(59, 110, 6, '2026-02-05', 'Tidak melakukan pelanggaran 30 hari', 5),
(60, 38, 6, '2026-03-14', 'Tidak melakukan pelanggaran 30 hari', 5),
(61, 39, 6, '2026-03-14', 'Tidak melakukan pelanggaran 30 hari', 5),
(62, 0, 6, '2026-02-05', 'Tidak melakukan pelanggaran 30 hari', 3),
(63, 67, 6, '2026-06-17', 'Tidak melakukan pelanggaran 30 hari', 6),
(64, 69, 6, '2026-07-03', 'Tidak melakukan pelanggaran 30 hari', 5),
(65, 70, 6, '2026-06-10', 'Tidak melakukan pelanggaran 30 hari', 5),
(66, 76, 6, '2026-06-12', 'Tidak melakukan pelanggaran 30 hari', 5),
(67, 83, 6, '2026-06-11', 'Tidak melakukan pelanggaran 30 hari', 5),
(68, 86, 6, '2026-07-02', 'Tidak melakukan pelanggaran 30 hari', 5),
(69, 111, 6, '2026-03-21', 'Tidak melakukan pelanggaran 30 hari', 4),
(70, 111, 6, '2026-06-18', 'Tidak melakukan pelanggaran 30 hari', 4),
(71, 37, 6, '2026-07-09', 'Tidak melakukan pelanggaran 30 hari', 5),
(75, 115, 6, '2026-07-09', 'Tidak melakukan pelanggaran 30 hari', 3),
(76, 101, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(77, 102, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(78, 103, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(79, 104, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(80, 105, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(81, 106, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(82, 107, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(83, 108, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(84, 109, 6, '2026-07-10', 'Tidak melakukan pelanggaran 30 hari', 4),
(85, 117, 6, '2026-07-11', 'Tidak melakukan pelanggaran 30 hari', 6),
(86, 94, 6, '2026-07-16', 'Tidak melakukan pelanggaran 30 hari', 3),
(87, 95, 6, '2026-07-15', 'Tidak melakukan pelanggaran 30 hari', 3),
(88, 41, 6, '2026-07-16', 'Tidak melakukan pelanggaran 30 hari', 4),
(89, 91, 6, '2026-07-18', 'Tidak melakukan pelanggaran 30 hari', 4),
(90, 92, 6, '2026-07-19', 'Tidak melakukan pelanggaran 30 hari', 4),
(91, 93, 6, '2026-07-17', 'Tidak melakukan pelanggaran 30 hari', 4),
(92, 46, 6, '2026-07-18', 'Tidak melakukan pelanggaran 30 hari', 5),
(93, 52, 6, '2026-07-18', 'Tidak melakukan pelanggaran 30 hari', 4),
(94, 55, 6, '2026-07-18', 'Tidak melakukan pelanggaran 30 hari', 4),
(95, 57, 6, '2026-07-17', 'Tidak melakukan pelanggaran 30 hari', 4),
(96, 61, 6, '2026-07-18', 'Tidak melakukan pelanggaran 30 hari', 4),
(97, 62, 6, '2026-07-17', 'Tidak melakukan pelanggaran 30 hari', 4),
(98, 48, 6, '2026-06-17', 'Tidak melakukan pelanggaran 30 hari', 5),
(99, 96, 6, '2026-07-22', 'Tidak melakukan pelanggaran 30 hari', 4),
(100, 49, 6, '2026-07-22', 'Tidak melakukan pelanggaran 30 hari', 4),
(101, 59, 6, '2026-07-22', 'Tidak melakukan pelanggaran 30 hari', 4),
(102, 97, 6, '2026-07-23', 'Tidak melakukan pelanggaran 30 hari', 4),
(103, 98, 6, '2026-07-24', 'Tidak melakukan pelanggaran 30 hari', 4),
(104, 50, 6, '2026-07-24', 'Tidak melakukan pelanggaran 30 hari', 4),
(105, 51, 6, '2026-07-23', 'Tidak melakukan pelanggaran 30 hari', 4),
(106, 54, 6, '2026-07-24', 'Tidak melakukan pelanggaran 30 hari', 4),
(107, 60, 6, '2026-07-24', 'Tidak melakukan pelanggaran 30 hari', 4),
(108, 64, 6, '2026-07-23', 'Tidak melakukan pelanggaran 30 hari', 4),
(109, 99, 6, '2026-07-25', 'Tidak melakukan pelanggaran 30 hari', 4),
(110, 100, 6, '2026-07-26', 'Tidak melakukan pelanggaran 30 hari', 4),
(111, 53, 6, '2026-07-25', 'Tidak melakukan pelanggaran 30 hari', 4),
(112, 58, 6, '2026-07-25', 'Tidak melakukan pelanggaran 30 hari', 4),
(113, 63, 6, '2026-07-25', 'Tidak melakukan pelanggaran 30 hari', 4),
(114, 38, 6, '2026-07-25', 'Tidak melakukan pelanggaran 30 hari', 4),
(115, 67, 6, '2026-07-25', 'Tidak melakukan pelanggaran 30 hari', 5),
(116, 68, 6, '2026-07-25', 'Tidak melakukan pelanggaran 30 hari', 4),
(117, 69, 6, '2026-07-25', 'Tidak melakukan pelanggaran 30 hari', 3),
(118, 70, 6, '2026-07-26', 'Tidak melakukan pelanggaran 30 hari', 4),
(119, 71, 6, '2026-07-26', 'Tidak melakukan pelanggaran 30 hari', 4),
(120, 72, 6, '2026-07-26', 'Tidak melakukan pelanggaran 30 hari', 5),
(121, 74, 6, '2026-07-30', 'Tidak melakukan pelanggaran 30 hari', 4),
(122, 75, 6, '2026-07-27', 'Tidak melakukan pelanggaran 30 hari', 4),
(123, 76, 6, '2026-07-27', 'Tidak melakukan pelanggaran 30 hari', 4),
(124, 77, 6, '2026-07-27', 'Tidak melakukan pelanggaran 30 hari', 5),
(125, 78, 6, '2026-07-27', 'Tidak melakukan pelanggaran 30 hari', 4),
(126, 79, 6, '2026-07-27', 'Tidak melakukan pelanggaran 30 hari', 5),
(127, 80, 6, '2026-07-27', 'Tidak melakukan pelanggaran 30 hari', 5),
(128, 81, 6, '2026-07-28', 'Tidak melakukan pelanggaran 30 hari', 4),
(129, 83, 6, '2026-07-30', 'Tidak melakukan pelanggaran 30 hari', 4),
(130, 84, 6, '2026-07-28', 'Tidak melakukan pelanggaran 30 hari', 4),
(131, 85, 6, '2026-07-28', 'Tidak melakukan pelanggaran 30 hari', 4),
(132, 86, 6, '2026-07-29', 'Tidak melakukan pelanggaran 30 hari', 4),
(133, 87, 6, '2026-07-29', 'Tidak melakukan pelanggaran 30 hari', 4),
(134, 88, 6, '2026-07-29', 'Tidak melakukan pelanggaran 30 hari', 4),
(135, 89, 6, '2026-07-30', 'Tidak melakukan pelanggaran 30 hari', 3),
(136, 119, 6, '2026-07-31', 'Tidak melakukan pelanggaran 30 hari', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('wali_kelas','wakasek','kepala_sekolah','siswa','orang_tua') NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`, `id_siswa`, `kelas`) VALUES
(1, 'Wali Kelas', 'wali kelas', 'siBK2026', 'wali_kelas', NULL, NULL),
(11, 'Wakasek Kesiswaan', 'wakasek', 'siBK2026', 'wakasek', NULL, NULL),
(12, 'Kepala Sekolah', 'kepsek', 'siBK2026', 'kepala_sekolah', NULL, NULL),
(14, 'Kiki Saepullah', 'walikelas10', 'siBK2026', 'wali_kelas', NULL, 'X TKJ'),
(15, 'Rita Ratnasari', 'walikelas11', 'siBK2026', 'wali_kelas', NULL, 'XI TKJ'),
(45, 'Yuriska Pratiwi', '0051837264', '0051837264', 'siswa', 37, NULL),
(46, 'Fahrul Sidiq', '0072946185', '0072946185', 'siswa', 38, NULL),
(47, 'Nerliani', '0064718293', '0064718293', 'siswa', 39, NULL),
(48, 'Resti Ratnasari', '0085629371', '0085629371', 'siswa', 40, NULL),
(49, 'Firmansyah', '0091847256', '0091847256', 'siswa', 41, NULL),
(51, 'Feri Irawan', '0078361952', '0078361952', 'siswa', 43, NULL),
(52, 'Dani Tirtana', '0062958471', '0062958471', 'siswa', 44, NULL),
(53, 'Rama', '0084172639', '0084172639', 'siswa', 45, NULL),
(55, 'Asep Nugraha', '0091847256', '0091847256', 'siswa', 46, 'X TKJ'),
(56, 'Dede Suhendar', '0091847257', '0091847257', 'siswa', 47, 'X TKJ'),
(57, 'Rina Apriani', '0091847258', '0091847258', 'siswa', 48, 'X TKJ'),
(58, 'Yayan Mulyana', '0091847259', '0091847259', 'siswa', 49, 'X TKJ'),
(59, 'Tati Sumiati', '0091847260', '0091847260', 'siswa', 50, 'X TKJ'),
(60, 'Ujang Kurnia', '0091847261', '0091847261', 'siswa', 51, 'X TKJ'),
(61, 'Euis Komalasari', '0091847262', '0091847262', 'siswa', 52, 'X TKJ'),
(62, 'Rudi Hartono', '0091847263', '0091847263', 'siswa', 53, 'X TKJ'),
(63, 'Yudi Hermawan', '0091847264', '0091847264', 'siswa', 54, 'X TKJ'),
(64, 'Siti Nurjanah', '0091847265', '0091847265', 'siswa', 55, 'X TKJ'),
(65, 'Agus Setiawan', '0091847266', '0091847266', 'siswa', 56, 'X TKJ'),
(66, 'Nia Kurniasih', '0091847267', '0091847267', 'siswa', 57, 'X TKJ'),
(67, 'Dian Permata', '0091847268', '0091847268', 'siswa', 58, 'X TKJ'),
(68, 'Rizki Maulana', '0091847269', '0091847269', 'siswa', 59, 'X TKJ'),
(69, 'Fitri Handayani', '0091847270', '0091847270', 'siswa', 60, 'X TKJ'),
(70, 'Ilham Fauzi', '0091847271', '0091847271', 'siswa', 61, 'X TKJ'),
(71, 'Rani Oktaviani', '0091847272', '0091847272', 'siswa', 62, 'X TKJ'),
(72, 'Fajar Hidayat', '0091847273', '0091847273', 'siswa', 63, 'X TKJ'),
(73, 'Wulan Sari', '0091847274', '0091847274', 'siswa', 64, 'X TKJ'),
(74, 'Andri Saputra', '0091847275', '0091847275', 'siswa', 65, 'X TKJ'),
(76, 'Rahmat Hidayat', '0091847276', '0091847276', 'siswa', 66, 'XI TKJ'),
(77, 'Lina Marlina', '0091847277', '0091847277', 'siswa', 67, 'XI TKJ'),
(80, 'Rendi Kurniawan', '0091847280', '0091847280', 'siswa', 70, 'XI TKJ'),
(81, 'Putri Ayuningtyas', '0091847281', '0091847281', 'siswa', 71, 'XI TKJ'),
(82, 'Deni Firmansyah', '0091847282', '0091847282', 'siswa', 72, 'XI TKJ'),
(83, 'Intan Permatasari', '0091847283', '0091847283', 'siswa', 73, 'XI TKJ'),
(84, 'Arif Setiawan', '0091847284', '0091847284', 'siswa', 74, 'XI TKJ'),
(85, 'Nabila Safitri', '0091847285', '0091847285', 'siswa', 75, 'XI TKJ'),
(86, 'Bagas Saputra', '0091847286', '0091847286', 'siswa', 76, 'XI TKJ'),
(87, 'Yuni Kartika', '0091847287', '0091847287', 'siswa', 77, 'XI TKJ'),
(88, 'Fikri Ramadhan', '0091847288', '0091847288', 'siswa', 78, 'XI TKJ'),
(89, 'Salsa Amelia', '0091847289', '0091847289', 'siswa', 79, 'XI TKJ'),
(90, 'Rio Maulana', '0091847290', '0091847290', 'siswa', 80, 'XI TKJ'),
(91, 'Meylani Putri', '0091847291', '0091847291', 'siswa', 81, 'XI TKJ'),
(92, 'Aldi Kurnia', '0091847292', '0091847292', 'siswa', 82, 'XI TKJ'),
(93, 'Desi Handayani', '0091847293', '0091847293', 'siswa', 83, 'XI TKJ'),
(94, 'Galih Prakoso', '0091847294', '0091847294', 'siswa', 84, 'XI TKJ'),
(95, 'Citra Lestari', '0091847295', '0091847295', 'siswa', 85, 'XI TKJ'),
(96, 'Rizal Fauzan', '0091847296', '0091847296', 'siswa', 86, 'XI TKJ'),
(97, 'Anisa Maharani', '0091847297', '0091847297', 'siswa', 87, 'XI TKJ'),
(98, 'Iqbal Maulana', '0091847298', '0091847298', 'siswa', 88, 'XI TKJ'),
(100, 'Farhan Nugraha', '0091847300', '0091847300', 'siswa', 90, 'XI TKJ'),
(101, 'Raka Pratama', '0091847301', '0091847301', 'siswa', 91, 'XII TKJ'),
(102, 'Nanda Puspitasari', '0091847302', '0091847302', 'siswa', 92, 'XII TKJ'),
(103, 'Aldi Saputra', '0091847303', '0091847303', 'siswa', 93, 'XII TKJ'),
(104, 'Vina Oktaviani', '0091847304', '0091847304', 'siswa', 94, 'XII TKJ'),
(105, 'Dimas Firmansyah', '0091847305', '0091847305', 'siswa', 95, 'XII TKJ'),
(106, 'Siska Maharani', '0091847306', '0091847306', 'siswa', 96, 'XII TKJ'),
(107, 'Fauzan Ramadhan', '0091847307', '0091847307', 'siswa', 97, 'XII TKJ'),
(108, 'Novi Anggraeni', '0091847308', '0091847308', 'siswa', 98, 'XII TKJ'),
(109, 'Reza Maulana', '0091847309', '0091847309', 'siswa', 99, 'XII TKJ'),
(110, 'Tiara Lestari', '0091847310', '0091847310', 'siswa', 100, 'XII TKJ'),
(111, 'Ari Nugroho', '0091847311', '0091847311', 'siswa', 101, 'XII TKJ'),
(112, 'Dewi Kartika', '0091847312', '0091847312', 'siswa', 102, 'XII TKJ'),
(113, 'Yusuf Hidayat', '0091847313', '0091847313', 'siswa', 103, 'XII TKJ'),
(114, 'Melisa Putri', '0091847314', '0091847314', 'siswa', 104, 'XII TKJ'),
(115, 'Hendra Gunawan', '0091847315', '0091847315', 'siswa', 105, 'XII TKJ'),
(116, 'Rina Wulandari', '0091847316', '0091847316', 'siswa', 106, 'XII TKJ'),
(117, 'Fajar Nugraha', '0091847317', '0091847317', 'siswa', 107, 'XII TKJ'),
(118, 'Nisa Rahmawati', '0091847318', '0091847318', 'siswa', 108, 'XII TKJ'),
(119, 'Dian Saputra', '0091847319', '0091847319', 'siswa', 109, 'XII TKJ'),
(120, 'Revina Ayu', '0091887303', '0091887303', 'siswa', 111, NULL),
(127, 'Rahmawati', 'ortu0091847298', '0091847298', 'orang_tua', 88, 'XI TKJ'),
(128, 'Yamin', 'ortu0091847303', '0091847303', 'orang_tua', 93, 'XII TKJ'),
(129, 'Amina', 'ortu0091847257', '0091847257', 'orang_tua', 47, 'X TKJ'),
(130, 'Adi ', 'ortu0091847284', '0091847284', 'orang_tua', 74, 'XI TKJ'),
(131, 'Mia Ningsih', 'ortu0091847297', '0091847297', 'orang_tua', 87, 'XI TKJ'),
(135, 'Jajang Arif', 'ortu0091847266', '0091847266', 'orang_tua', 56, 'X TKJ'),
(137, 'sensen', '10522003', '10522003', 'siswa', 119, NULL),
(138, 'Liyana Septiani', 'walikelas12', 'siBK2026', 'wali_kelas', NULL, 'XII TKJ');

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
-- Indexes for table `data_orang_tua`
--
ALTER TABLE `data_orang_tua`
  ADD PRIMARY KEY (`id_orangtua`);

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
-- Indexes for table `pemanggilan_siswa`
--
ALTER TABLE `pemanggilan_siswa`
  ADD PRIMARY KEY (`id_pemanggilan`),
  ADD KEY `fk_pemanggilan_pelanggaran` (`id_pelanggaran_siswa`);

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
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `data_guru`
--
ALTER TABLE `data_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_orang_tua`
--
ALTER TABLE `data_orang_tua`
  MODIFY `id_orangtua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `komunikasi_ortu`
--
ALTER TABLE `komunikasi_ortu`
  MODIFY `id_komunikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `laporan_konseling`
--
ALTER TABLE `laporan_konseling`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=587;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=936;

--
-- AUTO_INCREMENT for table `pemanggilan_siswa`
--
ALTER TABLE `pemanggilan_siswa`
  MODIFY `id_pemanggilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengajuan_remisi`
--
ALTER TABLE `pengajuan_remisi`
  MODIFY `id_remisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `rekap_poin`
--
ALTER TABLE `rekap_poin`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `remisi_otomatis`
--
ALTER TABLE `remisi_otomatis`
  MODIFY `id_remisi_otomatis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_konseling`
--
ALTER TABLE `laporan_konseling`
  ADD CONSTRAINT `laporan_konseling_ibfk_1` FOREIGN KEY (`id_pelanggaran_siswa`) REFERENCES `pelanggaran_siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemanggilan_siswa`
--
ALTER TABLE `pemanggilan_siswa`
  ADD CONSTRAINT `fk_pemanggilan_pelanggaran` FOREIGN KEY (`id_pelanggaran_siswa`) REFERENCES `pelanggaran_siswa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
