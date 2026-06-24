-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 05:49 PM
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
(6, 37, 'Ganjil', '2025/2026', 'Menunjukkan perilaku yang baik selama semester berjalan. Masih terdapat beberapa pelanggaran ringan, namun siswa mampu memperbaiki diri setelah diberikan pembinaan dan menunjukkan perkembangan yang positif.', '2026-06-24 15:01:27');

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
(37, 'Yuriska Pratiwi', '0051837264', 'X TKJ'),
(38, 'Fahrul Sidiq', '0072946185', 'XI TKJ'),
(39, 'Nerliani', '0064718293', 'XII TKJ'),
(40, 'Resti Ratnasari', '0085629371', 'X TKJ'),
(41, 'Firmansyah', '0091847256', 'X TKJ'),
(42, '0059273648', 'Dea Safitri', 'XI TKJ'),
(43, 'Feri Irawan', '0078361952', 'XI TKJ'),
(44, 'Dani Tirtana', '0062958471', 'XII TKJ'),
(45, 'Rama', '0084172639', 'XII TKJ');

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
(21, 37, '2026-04-27', 'Sekolah', '1782309026_Berita_Acara_Komunikasi_27_April_2026.pdf', 'Pada tanggal 27 April 2026 telah dilakukan komunikasi dengan orang tua siswa terkait perkembangan perilaku dan kedisiplinan siswa di lingkungan sekolah. Orang tua memahami informasi yang disampaikan oleh pihak sekolah dan menyatakan kesediaannya untuk memberikan perhatian, bimbingan, serta pengawasan yang lebih intensif kepada siswa. Orang tua juga mendukung upaya pembinaan yang dilakukan sekolah demi meningkatkan kedisiplinan dan tanggung jawab siswa.', 'proses', '2026-06-24 13:50:26', 'Sri Wahyuni');

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
(7, 171, 'Siswa diberikan arahan mengenai pentingnya menaati tata tertib sekolah terkait penggunaan perhiasan dan penampilan. Siswa memahami bahwa penggunaan perhiasan dan make-up berlebihan dapat mengganggu kedisiplinan serta tidak sesuai dengan ketentuan yang berlaku di lingkungan sekolah.\n', '2026-01-02', '2026-06-24 20:04:40'),
(8, 172, 'Siswa diberikan pemahaman mengenai pentingnya mengikuti kegiatan ekstrakurikuler Pramuka sebagai bagian dari pengembangan karakter, kedisiplinan, dan tanggung jawab. Siswa menyampaikan alasan ketidakhadiran dan berkomitmen untuk lebih aktif mengikuti kegiatan yang telah dijadwalkan.\n', '2026-01-14', '2026-06-24 20:07:15'),
(10, 174, 'Siswa diminta untuk meningkatkan kedisiplinan kehadiran dan wajib memberikan keterangan yang sah apabila berhalangan hadir. Wali kelas akan melakukan pemantauan terhadap kehadiran siswa pada periode berikutnya.\n', '2026-03-09', '2026-06-24 20:12:56'),
(11, 175, 'Siswa diberikan arahan mengenai pentingnya tanggung jawab dan kedisiplinan dalam menyelesaikan serta mengumpulkan tugas tepat waktu. Siswa memahami dampak keterlambatan terhadap proses pembelajaran dan berkomitmen untuk lebih mengatur waktu dalam menyelesaikan tugas sekolah.\n', '2026-03-25', '2026-06-24 20:29:36'),
(12, 176, 'Siswa diberikan pemahaman mengenai pentingnya menjaga kehadiran di sekolah dan mematuhi tata tertib yang berlaku. Siswa menyadari bahwa ketidakhadiran tanpa keterangan dapat berdampak pada proses pembelajaran dan prestasi akademik.\n', '2026-04-09', '2026-06-24 20:32:25'),
(13, 177, 'Siswa menyampaikan bahwa keterlambatan pengumpulan tugas terjadi karena kurang mampu mengatur waktu dalam menyelesaikan pekerjaan sekolah. Siswa diberikan arahan mengenai pentingnya tanggung jawab akademik dan diminta menyusun jadwal belajar yang lebih teratur agar dapat mengumpulkan tugas tepat waktu pada kesempatan berikutnya.', '2026-04-29', '2026-06-24 20:35:23'),
(14, 187, 'Siswa berkomitmen untuk meningkatkan kedisiplinan dalam kehadiran sekolah, mengumpulkan tugas tepat waktu, mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah, mengikuti kegiatan ekstrakurikuler sesuai ketentuan, serta mematuhi tata tertib sekolah agar tidak mengulangi pelanggaran yang sama di kemudian hari.', '2026-05-07', '2026-06-24 21:29:56'),
(15, 186, '\nSiswa berkomitmen untuk meningkatkan kedisiplinan dalam kehadiran sekolah, mengumpulkan tugas tepat waktu, mempersiapkan perlengkapan belajar sebelum berangkat ke sekolah, mengikuti kegiatan ekstrakurikuler sesuai ketentuan, serta mematuhi tata tertib sekolah agar tidak mengulangi pelanggaran yang sama di kemudian hari.', '2026-05-15', '2026-06-24 21:30:31'),
(16, 181, 'Siswa berkomitmen untuk mempersiapkan dan membawa buku pelajaran sesuai jadwal serta lebih bertanggung jawab terhadap kebutuhan belajarnya.', '2026-06-24', '2026-06-24 21:35:40'),
(17, 185, 'Siswa diberikan arahan mengenai pentingnya kedisiplinan kehadiran serta kewajiban memberikan informasi kepada pihak sekolah apabila berhalangan hadir. Siswa memahami bahwa ketidakhadiran tanpa keterangan dapat menghambat proses pembelajaran. Sebagai tindak lanjut, siswa diminta meningkatkan komunikasi dengan orang tua dan wali kelas terkait kehadiran di sekolah. Siswa berkomitmen untuk hadir secara teratur dan memberikan keterangan yang jelas apabila tidak dapat mengikuti kegiatan pembelajaran.\n', '2026-06-26', '2026-06-24 21:37:59'),
(18, 184, 'Siswa diberikan pembinaan mengenai pentingnya membawa perlengkapan belajar sesuai jadwal pelajaran yang telah ditentukan. Siswa mengakui kelalaiannya karena kurang mempersiapkan kebutuhan sekolah sebelum berangkat. Sebagai tindak lanjut, siswa diminta memeriksa kembali perlengkapan belajar setiap malam dan membuat daftar kebutuhan sesuai jadwal pelajaran. Siswa berkomitmen untuk lebih disiplin serta tidak mengulangi pelanggaran yang sama di kemudian hari.\n', '2026-03-22', '2026-06-24 21:38:44'),
(19, 180, 'Siswa diminta untuk meningkatkan kedisiplinan kehadiran dan wajib memberikan keterangan yang sah apabila berhalangan hadir. Wali kelas akan melakukan pemantauan terhadap kehadiran siswa pada periode berikutnya.', '2026-01-13', '2026-06-24 21:39:54'),
(20, 191, 'Siswa diberikan pembinaan mengenai pentingnya kedisiplinan kehadiran serta tanggung jawab untuk memberikan informasi apabila berhalangan hadir. Dari hasil konseling diketahui siswa memilih tidak masuk sekolah tanpa menyampaikan alasan kepada orang tua maupun wali kelas. Wali Kelas menjelaskan dampak ketidakhadiran terhadap proses pembelajaran dan penilaian akademik. Sebagai tindak lanjut, dilakukan koordinasi dengan orang tua untuk meningkatkan pengawasan terhadap kehadiran siswa. Siswa berkomitmen untuk hadir secara teratur dan segera memberikan keterangan apabila tidak dapat mengikuti kegiatan sekolah.', '2026-02-13', '2026-06-24 21:50:50'),
(21, 195, 'Siswa diberikan pembinaan mengenai pentingnya kedisiplinan kehadiran serta tanggung jawab untuk memberikan informasi apabila berhalangan hadir. Dari hasil konseling diketahui siswa memilih tidak masuk sekolah tanpa menyampaikan alasan kepada orang tua maupun wali kelas. Wali Kelas menjelaskan dampak ketidakhadiran terhadap proses pembelajaran dan penilaian akademik. Sebagai tindak lanjut, dilakukan koordinasi dengan orang tua untuk meningkatkan pengawasan terhadap kehadiran siswa. Siswa berkomitmen untuk hadir secara teratur dan segera memberikan keterangan apabila tidak dapat mengikuti kegiatan sekolah.', '2026-06-11', '2026-06-24 21:53:14'),
(22, 179, 'Siswa diberikan konseling mengenai pentingnya mengikuti kegiatan ekstrakurikuler sebagai bagian dari pembentukan karakter, kedisiplinan, dan tanggung jawab. Dalam sesi konseling, siswa mengakui tidak mengikuti kegiatan Pramuka karena kurang memiliki motivasi dan tidak menyampaikan alasan ketidakhadirannya kepada pembina. Siswa diberikan arahan agar lebih bertanggung jawab terhadap kewajiban yang telah ditetapkan sekolah serta memahami konsekuensi dari ketidakhadiran tanpa keterangan. Sebagai tindak lanjut, siswa berkomitmen untuk mengikuti kegiatan Pramuka secara rutin, memberikan konfirmasi apabila berhalangan hadir, serta menjaga komunikasi yang baik dengan pembina ekstrakurikuler.\n', '2026-06-25', '2026-06-24 22:43:10'),
(23, 189, 'Siswa diberikan konseling terkait pentingnya kehadiran dalam kegiatan pembelajaran dan dampak negatif yang dapat timbul akibat ketidakhadiran tanpa keterangan. Siswa memahami bahwa tindakannya dapat menghambat proses belajar serta menyulitkan pihak sekolah dalam melakukan pemantauan. Siswa diberikan pembinaan mengenai tanggung jawab sebagai peserta didik dan pentingnya menyampaikan informasi kepada wali kelas apabila berhalangan hadir. Sebagai tindak lanjut, siswa berkomitmen untuk meningkatkan kedisiplinan kehadiran, selalu memberikan surat izin atau keterangan yang sah apabila tidak dapat mengikuti pembelajaran, serta menjaga komunikasi dengan pihak sekolah dan orang tua.\n', '2026-06-20', '2026-06-24 22:43:45'),
(24, 188, 'Siswa mendapatkan pembinaan mengenai pentingnya berpartisipasi dalam kegiatan ekstrakurikuler sebagai sarana pengembangan potensi, keterampilan sosial, dan kedisiplinan. Dalam proses konseling, siswa menyadari bahwa ketidakhadiran tanpa keterangan merupakan bentuk kurangnya tanggung jawab terhadap kegiatan yang telah dipilih. Siswa diberikan motivasi untuk lebih aktif dalam mengikuti kegiatan sekolah dan memahami aturan yang berlaku. Sebagai tindak lanjut, siswa berkomitmen untuk hadir secara teratur pada kegiatan ekstrakurikuler, melaporkan alasan ketidakhadiran kepada pembina apabila berhalangan, serta menunjukkan sikap yang lebih bertanggung jawab dalam mengikuti setiap kegiatan sekolah.\n', '2026-06-15', '2026-06-24 22:44:08'),
(25, 178, 'Siswa diberikan konseling mengenai pentingnya menjaga kerapian dan penampilan sesuai dengan tata tertib sekolah yang berlaku. Dalam sesi konseling, siswa memahami bahwa penggunaan make-up yang berlebihan kurang sesuai dengan ketentuan sekolah dan dapat mengurangi citra kedisiplinan sebagai peserta didik. Siswa diberikan arahan untuk berpenampilan sederhana, rapi, dan sesuai dengan aturan yang telah ditetapkan. Sebagai tindak lanjut, siswa berkomitmen untuk tidak menggunakan make-up secara berlebihan saat berada di lingkungan sekolah serta menjaga penampilan yang mencerminkan sikap disiplin dan menghormati peraturan sekolah.', '2026-06-10', '2026-06-24 22:45:04');

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
(53, 37, 'siswa', 'Pelanggaran Baru', 'Kamu mendapatkan pelanggaran: ', 'pelanggaran', 'riwayat_pelanggaran.php', 0, '2026-06-24 21:10:10');

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
(171, 37, 22, '2026-01-02', 'Siswa menggunakan aksesoris dan riasan yang tidak sesuai dengan ketentuan sekolah.', 2),
(172, 37, 29, '2026-01-14', 'Siswa tidak mengikuti kegiatan ekstrakurikuler Pramuka sesuai jadwal yang telah ditetapkan tanpa memberikan keterangan atau izin yang jelas.\r\n', 3),
(174, 37, 2, '2026-03-05', 'Siswa tidak hadir mengikuti kegiatan pembelajaran di sekolah tanpa memberikan surat izin, surat keterangan sakit, maupun pemberitahuan kepada pihak sekolah.', 7),
(175, 37, 11, '2026-03-24', 'Siswa tidak menyerahkan tugas mata pelajaran Matematika sesuai batas waktu yang telah ditentukan oleh guru mata pelajaran.\r\n', 5),
(176, 37, 2, '2026-04-08', 'Siswa tidak hadir di sekolah pada jam pembelajaran tanpa memberikan informasi atau keterangan yang dapat dipertanggungjawabkan kepada pihak sekolah.\r\n', 7),
(177, 37, 11, '2026-04-28', 'Siswa tidak menyerahkan tugas mata pelajaran Bahasa Indonesia sesuai batas waktu yang telah ditentukan oleh guru mata pelajaran.\r\n', 5),
(178, 37, 22, '2026-06-10', 'Siswa terpantau memakai alis mata dan lipstik yang berlebihan', 2),
(179, 37, 29, '2026-06-24', 'Siswa tidak mengikuti ekstrakulikuler wajib (pramuka) tanpa konfirmasi/keterangan yang jelas', 3),
(180, 38, 2, '2026-01-10', 'Siswa tidak hadir mengikuti kegiatan pembelajaran selama satu hari penuh tanpa memberikan surat izin maupun keterangan kepada wali kelas.', 7),
(181, 38, 11, '2026-01-24', 'Siswa terlambat mengumpulkan tugas Matematika melebihi batas waktu yang telah ditentukan guru mata pelajaran.', 5),
(182, 38, 28, '2026-02-12', 'Siswa tidak membawa buku pelajaran sesuai jadwal sehingga tidak dapat mengikuti proses pembelajaran secara optimal.', 5),
(183, 38, 29, '2026-03-06', 'Siswa tidak mengikuti kegiatan ekstrakurikuler Pramuka tanpa memberikan alasan atau keterangan kepada pembina.', 3),
(184, 38, 11, '2026-03-20', 'Siswa kembali terlambat menyerahkan tugas Bahasa Indonesia meskipun telah diberikan pengingat oleh guru mata pelajaran.', 5),
(185, 38, 2, '2026-04-28', 'Siswa tidak masuk sekolah tanpa surat izin dari orang tua maupun pemberitahuan kepada pihak sekolah.', 7),
(186, 38, 28, '2026-05-15', 'Siswa tidak membawa buku pelajaran yang diperlukan saat kegiatan belajar mengajar berlangsung.', 5),
(187, 38, 11, '2026-06-05', 'Siswa terlambat menyerahkan tugas proyek kelompok sesuai tenggat waktu yang telah ditetapkan guru.', 5),
(188, 38, 29, '2026-06-12', 'Siswa tidak mengikuti kegiatan ekstrakurikuler wajib tanpa keterangan yang jelas kepada pembina kegiatan.', 3),
(189, 38, 2, '2026-06-19', 'Siswa tidak hadir di sekolah tanpa keterangan sehingga perlu dilakukan pemantauan oleh wali kelas.', 7),
(190, 39, 22, '2026-01-15', 'Saat dilakukan pemeriksaan kerapian, siswa diketahui menggunakan make-up yang cukup mencolok dan tidak sesuai dengan ketentuan tata tertib sekolah. Siswa telah diberikan teguran serta penjelasan mengenai pentingnya menjaga kerapian dan kesederhanaan penampilan selama berada di lingkungan sekolah.', 2),
(191, 39, 2, '2026-02-12', 'Siswa tidak mengikuti kegiatan pembelajaran selama satu hari tanpa memberikan surat izin maupun informasi kepada wali kelas. Ketidakhadiran tersebut menyebabkan siswa tertinggal beberapa materi pelajaran yang disampaikan pada hari tersebut.', 7),
(192, 39, 11, '2026-03-18', 'Siswa terlambat menyerahkan tugas mata pelajaran melebihi batas waktu yang telah ditentukan oleh guru sehingga menghambat proses penilaian.', 5),
(193, 39, 22, '2026-04-22', 'Siswa kembali ditemukan menggunakan make-up yang berlebihan dan tidak sesuai dengan ketentuan yang berlaku di sekolah. Guru piket telah memberikan teguran serta mengingatkan siswa agar mematuhi aturan mengenai kerapian dan penampilan.', 2),
(194, 39, 11, '2026-05-14', 'Siswa terlambat menyerahkan tugas yang diberikan guru karena kurang memperhatikan batas waktu pengumpulan yang telah ditetapkan.', 5),
(195, 39, 2, '2026-06-10', 'Siswa tidak hadir mengikuti kegiatan belajar mengajar tanpa adanya surat izin atau pemberitahuan dari orang tua kepada pihak sekolah. Wali kelas melakukan pemantauan dan meminta klarifikasi terkait ketidakhadiran tersebut.', 7);

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
(90, 37, '15', 'Peringkat 3 hafalan tahsin', 15, 'Sertifikat_Yuriska_Pratiwi.png', '2026-06-24 21:17:13', 'Disetujui', '', 10);

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
(38, 37, 21, '2026-06-24 14:17:25'),
(39, 38, 52, '2026-06-24 14:41:53'),
(40, 39, 28, '2026-06-24 14:48:18');

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
(47, 37, 6, '2026-05-28', 'Tidak melakukan pelanggaran selama 1 bulan berturut-turut', 3);

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
(11, 'Wakasek Kesiswaan', 'wakasek', 'siBK2026', 'wakasek', NULL, NULL),
(12, 'Kepala Sekolah', 'kepsek', 'siBK2026', 'kepala_sekolah', NULL, NULL),
(14, 'Kiki Saepullah', 'walikelas10', 'siBK2026', 'wali_kelas', NULL, 'X TKJ'),
(15, 'Rita Ratnasari', 'walikelas11', 'siBK2026', 'wali_kelas', NULL, 'XI TKJ'),
(45, 'Yuriska Pratiwi', '0051837264', '0051837264', 'siswa', 37, NULL),
(46, 'Fahrul Sidiq', '0072946185', '0072946185', 'siswa', 38, NULL),
(47, 'Nerliani', '0064718293', '0064718293', 'siswa', 39, NULL),
(48, 'Resti Ratnasari', '0085629371', '0085629371', 'siswa', 40, NULL),
(49, 'Firmansyah', '0091847256', '0091847256', 'siswa', 41, NULL),
(50, '0059273648', 'Dea Safitri', 'Dea Safitri', 'siswa', 42, NULL),
(51, 'Feri Irawan', '0078361952', '0078361952', 'siswa', 43, NULL),
(52, 'Dani Tirtana', '0062958471', '0062958471', 'siswa', 44, NULL),
(53, 'Rama', '0084172639', '0084172639', 'siswa', 45, NULL);

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
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_guru`
--
ALTER TABLE `data_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `komunikasi_ortu`
--
ALTER TABLE `komunikasi_ortu`
  MODIFY `id_komunikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `laporan_konseling`
--
ALTER TABLE `laporan_konseling`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `pengajuan_remisi`
--
ALTER TABLE `pengajuan_remisi`
  MODIFY `id_remisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `rekap_poin`
--
ALTER TABLE `rekap_poin`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `remisi_otomatis`
--
ALTER TABLE `remisi_otomatis`
  MODIFY `id_remisi_otomatis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
