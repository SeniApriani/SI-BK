-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2026 at 05:17 PM
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
(10, 'Adam', '1234', 'X TKJ');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis_pelanggaran` varchar(100) NOT NULL,
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
(8, 'Kelakuan', 'Mencuri dan atau/ merampas hak milik orang lain', 75);

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
(1, 6, '2026-06-06', 'Sekolah', 'Berita acara.docx', 'selesai', '2026-06-06 04:23:32', 'Jaya'),
(2, 6, '2026-07-04', 'Home Visit', 'Berita acara.docx', 'selesai', '2026-06-06 04:24:01', 'Jaya'),
(3, 6, '2026-07-10', 'Sekolah', '1780720394_Berita acara.docx', 'selesai', '2026-06-06 04:33:14', 'Jaya'),
(4, 8, '2026-06-12', 'Home Visit', '1780720575_Berita acara.docx', 'selesai', '2026-06-06 04:36:15', 'ira'),
(5, 3, '2026-06-01', 'Home Visit', '1780737275_Tugas_Perbaikan_Nilai_INLAN.pdf', 'proses', '2026-06-06 09:14:35', 'Jaya'),
(6, 7, '2026-06-10', 'Sekolah', '1780996415_Tugas_Perbaikan_Nilai_INLAN.pdf', 'proses', '2026-06-09 09:13:35', 'Jaya'),
(7, 8, '2026-06-09', 'Home Visit', '1780996749_Tugas_Perbaikan_Nilai_INLAN.pdf', 'selesai', '2026-06-09 09:19:09', 'ira'),
(8, 6, NULL, NULL, NULL, 'proses', '2026-06-09 10:03:10', NULL),
(9, 6, NULL, NULL, NULL, 'proses', '2026-06-09 10:03:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_siswa`
--

CREATE TABLE `pelanggaran_siswa` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_pelanggaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`id`, `id_siswa`, `id_pelanggaran`, `tanggal`, `catatan`) VALUES
(1, 6, 1, '2026-06-05', '-'),
(2, 6, 1, '2026-06-06', ''),
(3, 7, 2, '2026-06-06', 'Tidak ada'),
(4, 3, 1, '2026-06-06', 'Astagfirullah anak ini'),
(5, 7, 7, '2026-05-11', 'Catatan otomatis 1'),
(6, 6, 2, '2026-05-11', 'Catatan otomatis 2'),
(7, 6, 1, '2026-05-16', 'Catatan otomatis 3'),
(8, 3, 3, '2026-05-11', 'Catatan otomatis 4'),
(9, 8, 3, '2026-05-08', 'Catatan otomatis 5'),
(10, 6, 2, '2026-05-10', 'Catatan otomatis 6'),
(11, 6, 3, '2026-05-28', 'Catatan otomatis 7'),
(12, 6, 7, '2026-06-01', 'Catatan otomatis 8'),
(13, 3, 3, '2026-05-12', 'Catatan otomatis 9'),
(14, 3, 1, '2026-05-14', 'Catatan otomatis 10'),
(15, 3, 7, '2026-05-14', 'Catatan otomatis 11'),
(16, 8, 1, '2026-06-02', 'Catatan otomatis 12'),
(17, 6, 2, '2026-05-24', 'Catatan otomatis 13'),
(18, 6, 2, '2026-05-09', 'Catatan otomatis 14'),
(19, 3, 7, '2026-05-31', 'Catatan otomatis 15'),
(20, 8, 1, '2026-05-27', 'Catatan otomatis 16'),
(21, 8, 3, '2026-05-10', 'Catatan otomatis 17'),
(22, 8, 1, '2026-05-18', 'Catatan otomatis 18'),
(23, 8, 2, '2026-05-14', 'Catatan otomatis 19'),
(24, 6, 1, '2026-05-08', 'Catatan otomatis 20'),
(36, 7, 8, '2026-06-06', 'Gen z nakal'),
(37, 0, 1, '2026-06-06', 'Rifan bandel'),
(38, 7, 7, '2026-06-06', 'Ditegur'),
(39, 6, 8, '2026-06-08', 'yy'),
(40, 6, 1, '2026-06-10', 'hem'),
(41, 10, 1, '2026-05-01', NULL);

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
  `kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_remisi`
--

INSERT INTO `pengajuan_remisi` (`id_remisi`, `id_siswa`, `jenis_prestasi`, `nama_prestasi`, `poin_remisi`, `bukti`, `tanggal_pengajuan`, `status`, `kelas`) VALUES
(30, 0, '15', 'Juara 3 Kelas', 15, 'g_tahapan penelitian.png', '2026-06-10 14:50:35', 'Menunggu', NULL),
(31, 6, '15', 'Juara 3 Kelas', 15, 'g_tahapan penelitian.png', '2026-06-10 14:50:58', 'Disetujui', NULL),
(32, 7, '15', 'Juara 3 Kelas', 15, 'ChatGPT Image 8 Jun 2026, 22.06.04.png', '2026-06-10 16:19:47', 'Disetujui', NULL),
(33, 7, '50', 'Juara 3 Kelas', 50, 'Tugas_Perbaikan_Nilai_INLAN.pdf', '2026-06-10 16:27:10', 'Menunggu', NULL),
(34, 7, '15', 'Juara Kelas', 15, 'ChatGPT Image 8 Jun 2026, 22.06.04.png', '2026-06-10 16:41:57', 'Menunggu', ''),
(35, 8, '15', 'Juara 3 Kelas', 15, 'ChatGPT Image Jun 3, 2026, 09_57_25 AM.png', '2026-06-10 16:50:46', 'Ditolak', NULL),
(36, 7, '15', 'Juara 3 Kelas', 15, 'ChatGPT Image Jun 7, 2026, 10_21_17 AM.png', '2026-06-10 16:59:15', 'Disetujui', ''),
(37, 6, '50', 'Juara 3 Kelas', 50, 'Tugas_Perbaikan_Nilai_INLAN.pdf', '2026-06-10 20:41:43', 'Disetujui', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `remisi_otomatis`
--

CREATE TABLE `remisi_otomatis` (
  `id_remisi_otomatis` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `persen_remisi` int(11) DEFAULT 6,
  `tanggal_remisi` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remisi_otomatis`
--

INSERT INTO `remisi_otomatis` (`id_remisi_otomatis`, `id_siswa`, `persen_remisi`, `tanggal_remisi`, `keterangan`) VALUES
(1, 10, 6, '2026-06-10', 'Tidak melakukan pelanggaran selama 1 bulan');

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
(18, 'Adam', '1234', '1234', 'siswa', 10, NULL);

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
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `komunikasi_ortu`
--
ALTER TABLE `komunikasi_ortu`
  MODIFY `id_komunikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pengajuan_remisi`
--
ALTER TABLE `pengajuan_remisi`
  MODIFY `id_remisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `remisi_otomatis`
--
ALTER TABLE `remisi_otomatis`
  MODIFY `id_remisi_otomatis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
