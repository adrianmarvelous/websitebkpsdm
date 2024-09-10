-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 02:23 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daftar_hadir`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `status_hadir` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `nip`, `status_hadir`) VALUES
(1, '197207082008011011', 1),
(2, '197207091998031007', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_master_asn`
--

CREATE TABLE `user_master_asn` (
  `nip` varchar(25) NOT NULL,
  `password` varchar(500) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gol` varchar(10) NOT NULL,
  `npwp` varchar(50) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `id_status` int(11) NOT NULL,
  `ganti_password` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `id_bidang` int(11) NOT NULL,
  `status_aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master_asn`
--

INSERT INTO `user_master_asn` (`nip`, `password`, `nik`, `nama`, `gol`, `npwp`, `nama_bank`, `no_rekening`, `jabatan`, `id_status`, `ganti_password`, `role`, `id_bidang`, `status_aktif`) VALUES
('196510021993022001', '$2y$10$Yg5E.Y7wXtQxQPlalDdqn.BaDO3StH4kMiNPBa5ekJPtUDDj16NJm', '3578084210650005', 'PATMIATI SE', '3D', '57.204.410.5-606.000', 'Bank Jatim', '0012577799', 'Pranata Kearsipan', 1, 1, 'asn', 1, 1),
('196606101989031021', '$2y$11$/7hlIHIgrhECAwkdUt97SuXesf3jY/mRDGH8X8Fa9HIQur9zCWFL2', '3515131006660006', 'SUPARMAN', '3B', '57.204.398.2-603.000', 'Bank Jatim', '0012082851', 'Pengadministrasi Kepegawaian', 1, 1, 'asn', 4, 1),
('196703191992021001', '$2y$10$OQTkUH/BVx09hDGBrg.jGeR30zzjDrAb4h3cAd7avYqbPTSrK3XaO', '3578171903670002', 'DRS MOCH.DJAMIL', '3D', '54.592.344.3-619.000', 'Bank Jatim', '0017125354', 'Kepala Bidang Pengelolaan Administrasi dan Informasi Kepegawaian', 1, 1, 'pptk', 4, 1),
('196901021994031008', '$2y$10$55FtjsgmM.aAgBzwbjBHCu7uobNcqrr5RMUEnqn4RPI13I1CvWtD2', '3578030201690005', 'IR. JOESTAMADJI MSI', '4B', '241804525615000', 'Bank Jatim', '0017705938', 'Analis Rencana Program dan Kegiatan', 1, 1, 'asn', 1, 1),
('196903231996021001', '$2y$10$fJet87o2TFekAuZmMhwxNeAoCUebVR/e7ktJmaudS3MV4F1qRUbSm', '3578042303690010', 'RACHMAD BASARI SE,MM', '4B', '07.873.889.5-609.000', 'Bank Jatim', '0017136259', 'Kepala Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 0, 1, 'kepala badan', 5, 0),
('196905101997022001', '$2y$10$j8AHXDYrAvg3QQtIu9A5d.8avgyqbFaDHfr2K4wrJAId716V8.kn6', '3515065005690009', 'MAMIK SUPARMI S.PD', '4A', '693479826-617000', 'Bank Jatim', '0017475959', 'Sekretaris', 1, 1, 'pptk', 1, 1),
('196908231999032001', '$2y$10$YKWHMMya769spMUP/OaHM.xw95HzTmht538eECw1yisT9E/KYkn7S', '3578106308690004', 'Dra ANIS MASLUCHAH M.SI', '4E', '57.204.389.1-619.000', 'Bank Jatim', '0017004255', 'Ahli Utama - Widyaiswara', 1, 1, 'asn', 2, 1),
('196910171993032006', '$2y$10$5YmgFncuV0V.FpC.iMuPeOU5VxhMyT5xb092Kgm/L4tP06HGBlX7.', '3578045710690004', 'IRA TURSILOWATI SH, MH', 'IV/c', '55.499.239.6.609.000', 'Bank Jatim', '0012613277', 'Kepala Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 1, 1, 'kepala badan', 1, 1),
('197005141997031005', '$2y$10$4.MPaYz86zuoOPatWhx0NuEgrrZjvPEUUsCdVVACE2l3j33K6fDe6', '3578291405700002', 'IFRON HADY SUSANTO, S.SOS.MIR', '4B', '25.168.505.3-619.000', 'Bank Jatim', '0012097930', 'Ahli Muda - Widyaiswara', 1, 1, 'asn', 2, 1),
('197010232001121002', '$2y$10$5Z5w7/AWEp70wIEtKauEbursCfS2.CaukGIEZd07O4j3sAVVAPoDe', '3524172310700001', 'ADIM AL BASID SH', '3A', '57.204.423.8-645.000', 'Bank Jatim', '0017704940', 'Bendahara', 1, 1, 'bendahara', 5, 0),
('197010311996022001', '$2y$10$5ayR38QjVEdUbYf2AJlQzOjhLTeTNMfd1GhH9Ao.5jGlErZxi3nOy', '3578317110700001', 'DWI YANI PRASTANTI S.PD', '3C', '57.204.417.0-614.000', 'Bank Jatim', '0012085621', 'Pranata Kearsipan', 1, 1, 'pengadministrasi keuangan', 1, 1),
('197105292009011001', '$2y$11$BmYZgDRjwY8UatEb2Ri80OEdcMxj9nTZSMGtXPwwRK9KFZsAzpQWK', '3576022905710002', 'FAHRUR ROZI', '2D', '57.204.355.2-602.000', 'Bank Jatim', '0012306512', 'Pengelola Sistem Informasi Manajemen Kepegawaian', 1, 1, 'asn', 2, 1),
('197111171996022001', '$2y$10$EFLd2j1Qi4hK6g8cYyhiTe6XARErv.kufYkILfoZPQh7Rn7BPi7UO', '3578095711710002', 'WACHIDAH S.E', '3D', '25.639.980.9-606.000', 'Bank Jatim', '0012560400', 'Pengelola Sistem Informasi Manajemen Kepegawaian', 1, 1, 'pembuat spj', 2, 1),
('197207082008011011', '$2y$10$R1dqxn2ruZdNoVcqNjQSUefK88V8eFV3lpKokkCwWYFeO/mQ7k4IW', '', 'MOHAMMAD HARYONO', '', '', 'Bank Jatim', '0372065176', 'Bendahara', 1, 1, 'bendahara', 1, 1),
('197207091998031007', '$2y$10$MfHrCpAdITTaOzr5SPCkgeIC5GjVloPqSJSVUqQ/D/bK1aZ732BZu', '3578050907720004', 'HENRY RACHMANTO SH, MM', '4A', '25.020.238.9-607.000', 'Bank Jatim', '0017706250', 'Kepala Bidang Pengembangan Kompetensi Pegawai', 1, 1, 'pptk', 2, 1),
('197208162001121007', '$2y$10$Z2jNTvVB..K9Soxej3nUmO4AdL9h780i8wTWLkeH7Rpb9aT0yF3OO', '3578021608720001', 'LUKMAN HAKIM SE', '3A', '69.355.248.1-609.000', 'Bank Jatim', '0012154321', 'Pengelola Sistem Informasi Manajemen Kepegawaian', 1, 1, 'asn', 4, 1),
('197208311997031004', '$2y$10$YPwl3AOhILzBNG7bn8L0Ae0qdWB.74PcKYV8zaNsZRDedsoAVobG6', '3578263108720004', 'R.MOH. SUHARTO WARDOYO, S.H, M. Hum', '4C', '14.070.407.3-643.000', 'Bank Jatim', '0012098693', 'Analis Rencana Program dan Kegiatan', 1, 1, 'asn', 1, 1),
('197212082009011001', '$2y$10$T9WTGRhKpEB3IgxS0hbBJOjl88FGWLSIM/UZibVYawH2/3ra0hkqW', '3508080812720001', 'SLAMET KANANG', '2D', '69.355.250.7-625.000', 'Bank Jatim', '0017708236', 'Pengelola Pemanfaatan Barang Milik Daerah', 1, 1, 'asn', 1, 1),
('197309042001121002', '$2a$12$cx6FA1IK54wmKi7QUW8IAOv7zycucthUhXsJsvjfpfakmcvfMNWFG', '3515130409730006', 'MOCH.SUMAR HARIYANTO ,ST', '3D', '57.204.391.7-603.000', 'Bank Jatim', '0012164262', 'Analis Kepegawaian Ahli Muda', 1, 1, 'asn', 4, 1),
('197309152009012001', '$2a$12$bJQ2dBybQDMmmf.Be72jvuDuMEYd.aWkw.nYIn14CdubX1kTazLIK', '3578135509730003', 'SUMARTI', '2D', '88.736.242.4-609.000', 'Bank Jatim', '0012950373', 'Pengadministrasi Kepegawaian', 1, 1, 'asn', 4, 1),
('197411302001122001', '$2y$10$3fMch5p3RGUH9IUynebYC.cditUksv.04FhPjBAhKXWukBwx31PY2', '3578157011740002', 'DWI RATNA M DEWI, S.Si,MM', '3D', '07.860.084.8-605.000', 'Bank Jatim', '0017706934', 'Analis Kepegawaian Ahli Muda', 1, 1, 'asn', 3, 1),
('197505152010011003', '$2y$11$8iImyZWvByc3h4UpIRBQmeYqD1xeimW3bP.TN3MYDHJwNhK.yVEBi', '3578261505750002', 'BAGUS PRAYOGO S.SOS', '3C', '35.122.553.7-619.000', 'Bank Jatim', '0017224247', 'Analis Fasilitasi Peningkatan Kompetensi', 1, 1, 'asn', 2, 1),
('197506282001121004', '$2y$10$fYlwAVtJTPP4wULEm4BfQuYm31l0Mc0yTzVxGxTjG9/eAcgfXZKTS', '3578032806750002', 'MOHAMAD ZAINURI', '3A', '57.204.396.6-615.000', 'Bank Jatim', '0012154402', 'Pengadministrasi Kepegawaian', 1, 1, 'asn', 2, 1),
('197604042005011012', '$2y$10$rosCGyJ2ZF3Y2wJHIvCWI.5VrzRnmwiA/G3gAkoyKgTJ2AmRM9tl.', '3578170404760003', 'ACHMAD HADI S.KOM', '3D', '34.255.639.6.619.000', 'Bank Jatim', '0012039263', 'Analis Kepegawaian Ahli Muda', 1, 1, 'asn', 3, 1),
('197605162009011003', '$2a$12$1Vzc1Ntt2kv2nHNj1XkVK.s7sRLFjFayfi3hE9T6qZZdJbsjcWdJ.', '3578011605760003', 'PRAMUDJI DWI LESMONO', '2D', '88.736.241.6-618.000', 'Bank Jatim', '0017121758', 'Pengadministrasi Kepegawaian', 1, 1, 'asn', 2, 1),
('197704211998092001', '$2y$10$bveC.1uf5eojcMBqo2B3mejfyo/qjaUwKDz7g5cLnO1rxED3Jm3A6', '3578196104770002', 'ISTATIK', '3B', '57.204.400.6-604.000', 'Bank Jatim', '0017702084', 'Pengadministrasi Pendaftaran Sensor', 1, 1, 'asn', 3, 1),
('197710242005012008', '$2y$10$PHJtdc0Zvpl/CPN3N59lQ.uyvaZC5i8QDnQc.OnqmRGGYy7F94A0y', '3578176410770002', 'KEN WAHYUNI SETYANINGSIH ST', '3D', '25.398.218.5-619.000', 'Bank Jatim', '0017124811', 'Analis Kepegawaian Ahli Muda', 1, 1, 'asn', 2, 1),
('197805212010012001', '$2y$10$HIeY4ts6/0S10ZbQrBYnhuDya.Op4ttQtavqeqUfByj78sp0FvjlS', '3578256105780003', 'MAHARANEE REZA PAHLEVI ST', '3C', '89.277.816.8-615.000', 'Bank Jatim', '0017215221', 'Analis Kepegawaian Ahli Muda', 1, 1, 'asn', 1, 1),
('197806072006042041', '$2y$10$9DeV0XLytf9KNIVVsK2dyuknXukoXa6mmJ4aamwtB7ATemBy1S3XS', '351412470678001', 'HISMI HASTA YUNIASIH S.SOS', '3D', '57.204.421.2-624.000', 'Bank Jatim', '0017702343', 'Analis Kepegawaian Ahli Muda', 1, 1, 'asn', 2, 1),
('197906102001122002', '$2y$11$3m/cMmIYtu24LByQlFjcceOOKj/2x8NpzJC5pc3bF60oPdg7DFGQC', '3578105006790008', 'SULISTYA RAHAYU', '3A', '57.204.385.9-619.000', 'Bank Jatim', '0017703374', 'Pengadministrasi Kepegawaian', 1, 1, 'asn', 2, 1),
('197907072010011001', '$2y$11$QWRXV88Rb5pBqlOPK1af9OmwzNvnziJwM87MNtX/3lsEagru6a7rO', '3578220707790003', 'RONNY CHOIRUL IMAM', '2D', '89.687.510.1-609.000', 'Bank Jatim', '0017230514', 'Pengelola Disiplin Pegawai', 1, 1, 'asn', 3, 1),
('197910052001122002', '$2y$10$ckeIOE56mR89sZqGG0OxQuhC93ucFOx10tI/GgVQkrguaXRh2/IuC', '3578104510790009', 'NUR INSIYA', '3A', '57.204.387.5-619.000', 'Bank Jatim', '0017126466', 'Pengadministrasi Kepegawaian', 1, 1, 'asn', 4, 1),
('198104012009012001', '$2y$10$Lu0uEJuJ/Cy6jk5svxBht.wBJit6gwfSc.TH8b5O88dteeyRctCNK', '3578084104810002', 'KANTI YULIANTI', '2B', '45.200.479.9-606.000', 'Bank Jatim', '0017706152', 'Pengelola Sistem Informasi Manajemen Kepegawaian', 1, 1, 'pembuat spj', 4, 1),
('198306272009022008', '$2y$10$UkFJ3y/k3ekpCwhhVS8vYO.pk2bacN5uICxSGEyvaIshUP48fp7pq', '3578086706830001', 'ANITA NENCI LIA ST', '3D', '68.510.044.8-606.000', 'Bank Jatim', '0017144570', 'Kepala Bidang Pengelolaan Kinerja Pegawai', 1, 1, 'pptk', 3, 1),
('198311112014122001', '$2y$10$RGtwsvRsNdnOfV03K0vn2eiUHutRXVBVB86GzYFUV3tYbUlVgaapK', '3578075111830001', 'SUCI SETYOWATI', '2C', '07.881.314.4-611.000', 'Bank Jatim', '0582077002', 'Pengadministrasi Kepegawaian', 1, 1, 'asn', 4, 1),
('198408072011011009', '$2y$10$xfrjuamj0PJ4TU2pXbgSju5FU9nkp9.J0Xtu.gzQqIqNlipUhIzJS', '3574030708840002', 'AGUS SAPTO PURNOMO S.E.', '3D', '347286874625000', 'Bank Jatim', '0017329502', 'Kepala Sub Bagian Keuangan', 1, 1, 'ppkskpd', 1, 1),
('198501152009022006', '$2y$10$rewkenRli.ndV8BUiySMiu4FLpdsRBVbKUZ4FjYjKnERSQsdl0EtC', '3578275501850001', 'CHRISTINA VANIA SABRINA SE', '3D', '25.790.611.5-604.000', 'Bank Jatim', '0017707221', 'Kepala Sub Bagian Keuangan', 1, 1, 'ppkskpd', 5, 0),
('198511152015012001', '$2y$10$KX/ooQzR5Uf4RxLsJuI5EeqVTv2d66jfimWu050C1D2vhReSpT5/q', '3578045511850006', 'RYZA CAHAYA S.IP', '3B', '358121887609000', 'Bank Jatim', '0017584618', 'Analis Kepegawaian Ahli Muda', 1, 1, 'asn', 4, 1),
('198806032015012001', '$2y$10$/K00SAKlW6OI39PsZFQ2Qulw0vzxOIxAbO4rQjMXLInFwCys5Gnfq', '3507254306880005', 'VANIA DWI PUTRI S.Kom', '3C', '445632003657000', 'Bank Jatim', '0017584847', 'Sub Koordinator Mutasi dan Promosi Pegawai', 1, 1, 'asn', 4, 1),
('198903152014022001', '$2y$10$SRabrbtwm7tadvgDMt1XQuXi73hUvXjEwniVwWH48Yj8wI8qZHIz2', '3578015503890003', 'NANCY MARTHA DEVIE A.Md', '2D', '66.365.363.2-618.000', 'Bank Jatim', '1277004361', 'Analis Rencana Program dan Kegiatan', 1, 1, 'pembuat spj', 1, 1),
('199004052020121001', '$2y$10$GoB8F6y5LaaGPh.ICEHutupekQs2z2wgRQfgSFO8ba7T0OEeToEIK', '3578040504900001', 'RIZKIE DENNY PRATAMA ,S.Kom', '3A', '92.515.322.3-609.000', 'Bank Jatim', '0017871277', 'Pengelola Sistem Informasi Manajemen Kepegawaian', 1, 1, 'asn', 4, 1),
('199508182014021001', '$2y$10$hxptPLJhvEbSC5Em3kjHTejg/gVmiUSXENqif7svrQwVb8aZQpufC', '3578171808950003', 'AGUS ARIANTO', '2B', '66.397.915.1-619.000', 'Bank Jatim', '0752021333', 'Pengadministrasi Pendaftaran Sensor', 1, 1, 'asn', 3, 1),
('199608062020122002', '$2y$10$Pu3fL5NqBcop.QCFi/zDGOuSda7X2unzK4ey6Ox5hndhq1py78Y4e', '3578104608960004', 'RHEZA DWI AYU SUDARMADI ,SH', '3A', '96.934.611.3-619.000', 'Bank Jatim', '1702017862', 'Pengelola Disiplin Pegawai', 1, 1, 'pembuat spj', 3, 1),
('dibabkpsdm', '$2a$12$mHK2tqzqQ7PBOT/ECre8p.jvTOZV.2Hb3VSmIBfD24vGbQ8RkkNjO', '', 'Diba Kumala', '', '', '', '', '', 1, 1, 'pengadministrasi', 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master_asn`
--
ALTER TABLE `user_master_asn`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
