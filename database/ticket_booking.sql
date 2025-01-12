-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2025 pada 14.36
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket_booking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `booking_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('pending','paid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `flight_id`, `price`, `booking_date`, `payment_status`) VALUES
(1, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:29:58', NULL),
(2, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:31:18', NULL),
(3, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:33:50', NULL),
(4, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:34:16', NULL),
(5, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:41:07', NULL),
(6, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:41:59', NULL),
(7, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:48:17', NULL),
(8, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:50:23', NULL),
(9, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 17:51:27', NULL),
(10, 1, 'FLIGHT-0002', 886000.00, '2025-01-07 18:19:14', NULL),
(11, 1, 'FLIGHT-0002', 886000.00, '2025-01-07 18:24:25', 'pending'),
(12, 1, 'FLIGHT-0001', 886000.00, '2025-01-07 19:03:56', 'pending'),
(13, 1, 'FLIGHT-0005', 886000.00, '2025-01-07 19:08:46', 'pending'),
(14, 1, 'FLIGHT-0001', 0.00, '2025-01-07 20:56:52', NULL),
(15, 1, 'FLIGHT-0003', 0.00, '2025-01-07 20:57:06', NULL),
(16, 1, 'FLIGHT-0001', 0.00, '2025-01-07 21:04:10', NULL),
(17, 1, 'FLIGHT-0001', 0.00, '2025-01-07 21:06:15', NULL),
(18, 1, 'FLIGHT-0001', 0.00, '2025-01-07 21:08:35', NULL),
(19, 1, 'FLIGHT-0001', 0.00, '2025-01-07 21:14:24', NULL),
(20, 1, 'FLIGHT-0012', 0.00, '2025-01-08 11:17:28', NULL),
(21, 1, 'FLIGHT-0001', 0.00, '2025-01-11 00:47:10', NULL),
(22, 1, 'FLIGHT-0033', 0.00, '2025-01-11 15:21:30', NULL),
(23, 1, 'FLIGHT-0033', 0.00, '2025-01-11 15:23:59', NULL),
(24, 1, 'FLIGHT-0033', 0.00, '2025-01-11 15:24:17', NULL),
(25, 1, 'FLIGHT-0033', 0.00, '2025-01-11 15:24:32', NULL),
(26, 1, 'FLIGHT-0056', 0.00, '2025-01-11 15:24:42', NULL),
(27, 3, 'FLIGHT-0012', 0.00, '2025-01-12 14:22:31', NULL),
(28, 3, 'FLIGHT-0001', 0.00, '2025-01-12 14:24:09', NULL),
(29, 3, 'FLIGHT-0002', 0.00, '2025-01-12 14:26:39', NULL),
(30, 3, 'FLIGHT-0006', 0.00, '2025-01-12 14:28:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `flights`
--

CREATE TABLE `flights` (
  `id` varchar(50) NOT NULL,
  `maskapai` varchar(255) DEFAULT NULL,
  `jadwal_keberangkatan` datetime DEFAULT NULL,
  `jadwal_kedatangan` datetime DEFAULT NULL,
  `estimasi_penerbangan` varchar(50) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `destinasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `flights`
--

INSERT INTO `flights` (`id`, `maskapai`, `jadwal_keberangkatan`, `jadwal_kedatangan`, `estimasi_penerbangan`, `harga`, `destinasi`) VALUES
('FLIGHT-0001', 'Citilink', '2025-01-28 23:34:58', '2025-01-29 01:08:58', '94 minutes', 886000.00, 'Lombok'),
('FLIGHT-0002', 'AirAsia', '2025-02-25 06:44:24', '2025-02-25 08:52:24', '128 minutes', 2257000.00, 'Batam'),
('FLIGHT-0003', 'AirAsia', '2025-02-28 22:42:46', '2025-02-28 23:34:46', '52 minutes', 2424000.00, 'Yogyakarta'),
('FLIGHT-0004', 'Citilink', '2025-04-16 15:31:04', '2025-04-17 01:14:04', '583 minutes', 1194000.00, 'Manado'),
('FLIGHT-0005', 'Lion Air', '2024-12-26 15:06:08', '2024-12-26 19:22:08', '256 minutes', 1526000.00, 'Banjarmasin'),
('FLIGHT-0006', 'AirAsia', '2025-03-01 13:16:33', '2025-03-01 21:59:33', '523 minutes', 2070000.00, 'Malang'),
('FLIGHT-0007', 'Lion Air', '2025-02-03 04:40:36', '2025-02-03 06:06:36', '86 minutes', 917000.00, 'Bali'),
('FLIGHT-0008', 'AirAsia', '2025-01-21 00:44:07', '2025-01-21 02:59:07', '135 minutes', 1974000.00, 'Pekanbaru'),
('FLIGHT-0009', 'Citilink', '2025-01-04 15:35:14', '2025-01-05 01:21:14', '586 minutes', 2710000.00, 'Makassar'),
('FLIGHT-0010', 'Lion Air', '2025-01-14 12:48:16', '2025-01-14 18:53:16', '365 minutes', 2097000.00, 'Bali'),
('FLIGHT-0011', 'Lion Air', '2025-04-26 07:50:05', '2025-04-26 11:57:05', '247 minutes', 1459000.00, 'Padang'),
('FLIGHT-0012', 'Garuda Indonesia', '2025-03-12 03:57:03', '2025-03-12 08:33:03', '276 minutes', 1650000.00, 'Surabaya'),
('FLIGHT-0013', 'Garuda Indonesia', '2025-04-17 14:00:11', '2025-04-17 20:41:11', '401 minutes', 984000.00, 'Manado'),
('FLIGHT-0014', 'Batik Air', '2025-03-07 13:08:04', '2025-03-07 20:47:04', '459 minutes', 2417000.00, 'Manado'),
('FLIGHT-0015', 'Garuda Indonesia', '2025-01-18 13:34:31', '2025-01-18 23:29:31', '595 minutes', 751000.00, 'Semarang'),
('FLIGHT-0016', 'Citilink', '2025-04-07 11:58:09', '2025-04-07 14:13:09', '135 minutes', 1504000.00, 'Lombok'),
('FLIGHT-0017', 'AirAsia', '2024-12-28 19:03:15', '2024-12-29 03:33:15', '510 minutes', 1733000.00, 'Pontianak'),
('FLIGHT-0018', 'Batik Air', '2025-01-17 00:04:30', '2025-01-17 04:40:30', '276 minutes', 928000.00, 'Surabaya'),
('FLIGHT-0019', 'Lion Air', '2024-12-31 02:27:23', '2024-12-31 11:26:23', '539 minutes', 962000.00, 'Pontianak'),
('FLIGHT-0020', 'Citilink', '2025-02-08 20:38:07', '2025-02-09 04:47:07', '489 minutes', 1694000.00, 'Jayapura'),
('FLIGHT-0021', 'Lion Air', '2025-02-04 21:58:47', '2025-02-04 23:15:47', '77 minutes', 2327000.00, 'Banjarmasin'),
('FLIGHT-0022', 'AirAsia', '2025-03-13 14:49:30', '2025-03-13 22:17:30', '448 minutes', 782000.00, 'Bali'),
('FLIGHT-0023', 'Batik Air', '2025-04-01 21:40:41', '2025-04-02 00:33:41', '173 minutes', 1308000.00, 'Batam'),
('FLIGHT-0024', 'Citilink', '2025-04-20 22:06:28', '2025-04-21 02:16:28', '250 minutes', 693000.00, 'Bandung'),
('FLIGHT-0025', 'Citilink', '2025-02-11 22:59:03', '2025-02-12 02:41:03', '222 minutes', 1076000.00, 'Makassar'),
('FLIGHT-0026', 'Garuda Indonesia', '2025-04-03 09:01:20', '2025-04-03 12:28:20', '207 minutes', 2390000.00, 'Balikpapan'),
('FLIGHT-0027', 'Batik Air', '2025-04-06 21:57:08', '2025-04-07 06:41:08', '524 minutes', 2708000.00, 'Balikpapan'),
('FLIGHT-0028', 'Batik Air', '2025-04-11 20:53:40', '2025-04-12 02:09:40', '316 minutes', 1444000.00, 'Batam'),
('FLIGHT-0029', 'AirAsia', '2025-04-02 08:58:49', '2025-04-02 11:13:49', '135 minutes', 636000.00, 'Medan'),
('FLIGHT-0030', 'Garuda Indonesia', '2025-04-14 06:12:20', '2025-04-14 12:20:20', '368 minutes', 1058000.00, 'Medan'),
('FLIGHT-0031', 'Batik Air', '2025-02-17 09:18:32', '2025-02-17 09:51:32', '33 minutes', 530000.00, 'Palembang'),
('FLIGHT-0032', 'Citilink', '2025-04-26 15:58:24', '2025-04-26 17:26:24', '88 minutes', 2626000.00, 'Medan'),
('FLIGHT-0033', 'Lion Air', '2025-03-12 22:45:49', '2025-03-13 05:06:49', '381 minutes', 2796000.00, 'Batam'),
('FLIGHT-0034', 'Lion Air', '2025-01-19 20:43:09', '2025-01-20 00:17:09', '214 minutes', 755000.00, 'Padang'),
('FLIGHT-0035', 'Garuda Indonesia', '2025-01-16 11:39:17', '2025-01-16 19:28:17', '469 minutes', 1823000.00, 'Pekanbaru'),
('FLIGHT-0036', 'Citilink', '2025-03-02 03:31:50', '2025-03-02 12:48:50', '557 minutes', 2200000.00, 'Banjarmasin'),
('FLIGHT-0037', 'Citilink', '2024-12-20 04:55:32', '2024-12-20 08:25:32', '210 minutes', 1354000.00, 'Semarang'),
('FLIGHT-0038', 'Batik Air', '2025-01-23 22:41:33', '2025-01-24 03:14:33', '273 minutes', 2448000.00, 'Solo'),
('FLIGHT-0039', 'Garuda Indonesia', '2025-03-12 17:13:51', '2025-03-12 22:27:51', '314 minutes', 1084000.00, 'Balikpapan'),
('FLIGHT-0040', 'AirAsia', '2025-01-30 07:15:34', '2025-01-30 13:53:34', '398 minutes', 2727000.00, 'Balikpapan'),
('FLIGHT-0041', 'AirAsia', '2025-03-16 20:30:24', '2025-03-17 02:12:24', '342 minutes', 1357000.00, 'Solo'),
('FLIGHT-0042', 'Batik Air', '2025-04-11 10:45:32', '2025-04-11 14:55:32', '250 minutes', 751000.00, 'Banjarmasin'),
('FLIGHT-0043', 'AirAsia', '2024-12-27 03:29:35', '2024-12-27 13:15:35', '586 minutes', 2093000.00, 'Medan'),
('FLIGHT-0044', 'Citilink', '2025-01-06 02:24:52', '2025-01-06 11:20:52', '536 minutes', 840000.00, 'Padang'),
('FLIGHT-0045', 'Batik Air', '2025-04-25 21:52:14', '2025-04-26 00:29:14', '157 minutes', 1789000.00, 'Makassar'),
('FLIGHT-0046', 'Lion Air', '2025-03-03 19:59:08', '2025-03-03 23:28:08', '209 minutes', 2001000.00, 'Jakarta'),
('FLIGHT-0047', 'AirAsia', '2025-03-19 07:34:44', '2025-03-19 16:41:44', '547 minutes', 910000.00, 'Makassar'),
('FLIGHT-0048', 'Garuda Indonesia', '2025-02-10 04:09:40', '2025-02-10 10:47:40', '398 minutes', 710000.00, 'Jayapura'),
('FLIGHT-0049', 'Lion Air', '2025-01-25 15:21:52', '2025-01-25 16:00:52', '39 minutes', 2715000.00, 'Bandung'),
('FLIGHT-0050', 'AirAsia', '2025-04-26 20:59:19', '2025-04-27 02:25:19', '326 minutes', 1406000.00, 'Yogyakarta'),
('FLIGHT-0051', 'Garuda Indonesia', '2025-04-28 11:04:20', '2025-04-28 18:02:20', '418 minutes', 1873000.00, 'Bandung'),
('FLIGHT-0052', 'AirAsia', '2025-04-11 13:48:23', '2025-04-11 17:31:23', '223 minutes', 1134000.00, 'Manado'),
('FLIGHT-0053', 'AirAsia', '2025-01-16 13:14:33', '2025-01-16 17:21:33', '247 minutes', 2408000.00, 'Jakarta'),
('FLIGHT-0054', 'Lion Air', '2025-03-07 06:07:09', '2025-03-07 15:52:09', '585 minutes', 2473000.00, 'Batam'),
('FLIGHT-0055', 'AirAsia', '2025-03-06 23:45:46', '2025-03-07 03:31:46', '226 minutes', 1970000.00, 'Semarang'),
('FLIGHT-0056', 'Citilink', '2025-04-25 05:28:39', '2025-04-25 09:52:39', '264 minutes', 714000.00, 'Manado'),
('FLIGHT-0057', 'Citilink', '2025-04-27 13:22:09', '2025-04-27 17:19:09', '237 minutes', 913000.00, 'Jayapura'),
('FLIGHT-0058', 'Batik Air', '2025-01-26 14:21:44', '2025-01-26 18:58:44', '277 minutes', 520000.00, 'Malang'),
('FLIGHT-0059', 'AirAsia', '2025-01-25 04:59:01', '2025-01-25 08:21:01', '202 minutes', 2592000.00, 'Lombok'),
('FLIGHT-0060', 'Batik Air', '2025-01-12 05:08:30', '2025-01-12 11:56:30', '408 minutes', 607000.00, 'Banjarmasin'),
('FLIGHT-0061', 'Batik Air', '2025-01-24 11:48:00', '2025-01-24 15:02:00', '194 minutes', 2849000.00, 'Pekanbaru'),
('FLIGHT-0062', 'Garuda Indonesia', '2025-03-07 04:01:02', '2025-03-07 12:04:02', '483 minutes', 2209000.00, 'Jakarta'),
('FLIGHT-0063', 'Batik Air', '2025-02-20 00:12:11', '2025-02-20 02:52:11', '160 minutes', 795000.00, 'Lombok'),
('FLIGHT-0064', 'Lion Air', '2025-04-15 18:48:12', '2025-04-15 23:39:12', '291 minutes', 743000.00, 'Manado'),
('FLIGHT-0065', 'Citilink', '2025-04-08 23:48:53', '2025-04-09 01:19:53', '91 minutes', 2679000.00, 'Padang'),
('FLIGHT-0066', 'Citilink', '2025-02-12 20:04:53', '2025-02-12 23:45:53', '221 minutes', 1700000.00, 'Manado'),
('FLIGHT-0067', 'Garuda Indonesia', '2025-02-08 11:34:59', '2025-02-08 18:25:59', '411 minutes', 2296000.00, 'Yogyakarta'),
('FLIGHT-0068', 'Batik Air', '2025-01-25 00:53:48', '2025-01-25 02:50:48', '117 minutes', 791000.00, 'Malang'),
('FLIGHT-0069', 'AirAsia', '2025-02-12 07:42:42', '2025-02-12 14:54:42', '432 minutes', 1843000.00, 'Solo'),
('FLIGHT-0070', 'Lion Air', '2025-03-07 08:32:36', '2025-03-07 15:12:36', '400 minutes', 509000.00, 'Banjarmasin'),
('FLIGHT-0071', 'AirAsia', '2024-12-23 21:59:09', '2024-12-24 06:20:09', '501 minutes', 1506000.00, 'Padang'),
('FLIGHT-0072', 'Lion Air', '2025-03-11 20:28:24', '2025-03-12 05:36:24', '548 minutes', 1949000.00, 'Solo'),
('FLIGHT-0073', 'Batik Air', '2025-01-02 02:47:26', '2025-01-02 04:12:26', '85 minutes', 1938000.00, 'Makassar'),
('FLIGHT-0074', 'Batik Air', '2025-01-18 03:22:30', '2025-01-18 07:46:30', '264 minutes', 945000.00, 'Palembang'),
('FLIGHT-0075', 'Lion Air', '2025-04-27 09:42:06', '2025-04-27 11:54:06', '132 minutes', 1489000.00, 'Pontianak'),
('FLIGHT-0076', 'Batik Air', '2025-01-07 07:40:51', '2025-01-07 16:57:51', '557 minutes', 2454000.00, 'Makassar'),
('FLIGHT-0077', 'Batik Air', '2025-02-10 18:41:49', '2025-02-11 03:36:49', '535 minutes', 1859000.00, 'Manado'),
('FLIGHT-0078', 'Batik Air', '2025-01-18 08:38:55', '2025-01-18 12:46:55', '248 minutes', 927000.00, 'Malang'),
('FLIGHT-0079', 'AirAsia', '2025-03-14 20:25:20', '2025-03-15 00:36:20', '251 minutes', 1723000.00, 'Banjarmasin'),
('FLIGHT-0080', 'Lion Air', '2025-03-04 14:34:02', '2025-03-04 22:20:02', '466 minutes', 1131000.00, 'Batam'),
('FLIGHT-0081', 'Batik Air', '2025-01-11 20:03:30', '2025-01-12 00:36:30', '273 minutes', 1408000.00, 'Pontianak'),
('FLIGHT-0082', 'AirAsia', '2025-02-24 13:49:28', '2025-02-24 23:44:28', '595 minutes', 963000.00, 'Surabaya'),
('FLIGHT-0083', 'AirAsia', '2025-03-26 02:43:30', '2025-03-26 08:05:30', '322 minutes', 595000.00, 'Medan'),
('FLIGHT-0084', 'AirAsia', '2025-02-13 05:27:08', '2025-02-13 07:25:08', '118 minutes', 2417000.00, 'Lombok'),
('FLIGHT-0085', 'Citilink', '2024-12-28 05:40:09', '2024-12-28 08:12:09', '152 minutes', 2375000.00, 'Batam'),
('FLIGHT-0086', 'Lion Air', '2025-04-11 02:19:32', '2025-04-11 04:09:32', '110 minutes', 592000.00, 'Semarang'),
('FLIGHT-0087', 'Citilink', '2025-02-21 04:35:24', '2025-02-21 10:07:24', '332 minutes', 838000.00, 'Balikpapan'),
('FLIGHT-0088', 'Batik Air', '2025-03-22 06:45:12', '2025-03-22 10:21:12', '216 minutes', 956000.00, 'Jakarta'),
('FLIGHT-0089', 'Batik Air', '2025-01-21 05:05:47', '2025-01-21 07:20:47', '135 minutes', 528000.00, 'Jayapura'),
('FLIGHT-0090', 'AirAsia', '2025-01-30 06:05:24', '2025-01-30 12:31:24', '386 minutes', 1351000.00, 'Padang'),
('FLIGHT-0091', 'Batik Air', '2025-04-07 05:49:43', '2025-04-07 10:52:43', '303 minutes', 721000.00, 'Surabaya'),
('FLIGHT-0092', 'Citilink', '2025-02-05 12:18:54', '2025-02-05 18:24:54', '366 minutes', 2085000.00, 'Jayapura'),
('FLIGHT-0093', 'Lion Air', '2025-03-14 03:39:09', '2025-03-14 12:03:09', '504 minutes', 2686000.00, 'Jakarta'),
('FLIGHT-0094', 'Garuda Indonesia', '2025-03-06 00:27:19', '2025-03-06 10:17:19', '590 minutes', 929000.00, 'Bandung'),
('FLIGHT-0095', 'Citilink', '2025-03-07 22:43:05', '2025-03-08 01:55:05', '192 minutes', 1478000.00, 'Bandung'),
('FLIGHT-0096', 'Garuda Indonesia', '2025-04-06 09:15:47', '2025-04-06 09:55:47', '40 minutes', 2668000.00, 'Banjarmasin'),
('FLIGHT-0097', 'Citilink', '2025-04-24 11:28:55', '2025-04-24 18:08:55', '400 minutes', 569000.00, 'Bandung'),
('FLIGHT-0098', 'Citilink', '2024-12-27 09:11:51', '2024-12-27 18:12:51', '541 minutes', 958000.00, 'Bali'),
('FLIGHT-0099', 'Garuda Indonesia', '2025-02-04 12:51:19', '2025-02-04 15:01:19', '130 minutes', 2325000.00, 'Makassar'),
('FLIGHT-0100', 'AirAsia', '2025-04-14 08:51:22', '2025-04-14 12:58:22', '247 minutes', 2354000.00, 'Pontianak'),
('FLIGHT-0101', 'Batik Air', '2025-04-17 19:38:01', '2025-04-17 21:12:01', '94 minutes', 856000.00, 'Batam'),
('FLIGHT-0102', 'Citilink', '2025-03-31 03:44:54', '2025-03-31 11:24:54', '460 minutes', 912000.00, 'Banjarmasin'),
('FLIGHT-0103', 'Garuda Indonesia', '2025-02-04 21:26:02', '2025-02-05 04:19:02', '413 minutes', 1694000.00, 'Lombok'),
('FLIGHT-0104', 'Garuda Indonesia', '2025-02-17 15:59:48', '2025-02-17 21:08:48', '309 minutes', 2944000.00, 'Bali'),
('FLIGHT-0105', 'Lion Air', '2025-02-21 19:58:57', '2025-02-22 01:12:57', '314 minutes', 555000.00, 'Banjarmasin'),
('FLIGHT-0106', 'Batik Air', '2025-02-12 13:14:29', '2025-02-12 14:28:29', '74 minutes', 2549000.00, 'Bandung'),
('FLIGHT-0107', 'AirAsia', '2025-01-10 10:12:55', '2025-01-10 20:10:55', '598 minutes', 619000.00, 'Banjarmasin'),
('FLIGHT-0108', 'AirAsia', '2025-02-03 05:37:18', '2025-02-03 10:33:18', '296 minutes', 1855000.00, 'Manado'),
('FLIGHT-0109', 'Lion Air', '2025-04-20 14:18:02', '2025-04-20 19:00:02', '282 minutes', 2624000.00, 'Jakarta'),
('FLIGHT-0110', 'Garuda Indonesia', '2025-04-20 13:37:31', '2025-04-20 18:08:31', '271 minutes', 2231000.00, 'Medan'),
('FLIGHT-0111', 'AirAsia', '2025-04-06 12:55:11', '2025-04-06 15:36:11', '161 minutes', 2105000.00, 'Lombok'),
('FLIGHT-0112', 'Lion Air', '2025-01-05 16:34:09', '2025-01-05 21:54:09', '320 minutes', 1731000.00, 'Lombok'),
('FLIGHT-0113', 'AirAsia', '2025-03-08 22:36:19', '2025-03-09 01:05:19', '149 minutes', 2486000.00, 'Medan'),
('FLIGHT-0114', 'Batik Air', '2025-02-26 09:39:05', '2025-02-26 10:56:05', '77 minutes', 1711000.00, 'Banjarmasin'),
('FLIGHT-0115', 'Garuda Indonesia', '2025-02-06 20:19:16', '2025-02-06 21:46:16', '87 minutes', 1217000.00, 'Semarang'),
('FLIGHT-0116', 'Lion Air', '2025-02-06 23:58:14', '2025-02-07 05:30:14', '332 minutes', 1314000.00, 'Semarang'),
('FLIGHT-0117', 'Lion Air', '2025-04-21 03:30:19', '2025-04-21 07:29:19', '239 minutes', 2736000.00, 'Makassar'),
('FLIGHT-0118', 'Lion Air', '2025-01-01 22:11:14', '2025-01-02 00:59:14', '168 minutes', 669000.00, 'Medan'),
('FLIGHT-0119', 'Citilink', '2025-04-24 16:19:06', '2025-04-24 22:00:06', '341 minutes', 2742000.00, 'Surabaya'),
('FLIGHT-0120', 'AirAsia', '2025-01-22 10:34:47', '2025-01-22 11:27:47', '53 minutes', 1640000.00, 'Pontianak'),
('FLIGHT-0121', 'Lion Air', '2025-04-15 02:13:00', '2025-04-15 05:16:00', '183 minutes', 2261000.00, 'Medan'),
('FLIGHT-0122', 'Lion Air', '2024-12-26 11:17:25', '2024-12-26 16:21:25', '304 minutes', 2821000.00, 'Bandung'),
('FLIGHT-0123', 'Garuda Indonesia', '2025-01-07 02:28:40', '2025-01-07 03:34:40', '66 minutes', 2646000.00, 'Lombok'),
('FLIGHT-0124', 'Batik Air', '2025-04-25 11:13:51', '2025-04-25 19:13:51', '480 minutes', 2403000.00, 'Pontianak'),
('FLIGHT-0125', 'Lion Air', '2025-04-18 15:13:17', '2025-04-18 22:49:17', '456 minutes', 1876000.00, 'Bali'),
('FLIGHT-0126', 'AirAsia', '2024-12-24 16:32:01', '2024-12-24 17:37:01', '65 minutes', 2110000.00, 'Medan'),
('FLIGHT-0127', 'AirAsia', '2025-02-07 11:08:58', '2025-02-07 14:12:58', '184 minutes', 1293000.00, 'Bandung'),
('FLIGHT-0128', 'Garuda Indonesia', '2025-02-11 00:51:53', '2025-02-11 03:58:53', '187 minutes', 897000.00, 'Medan'),
('FLIGHT-0129', 'Batik Air', '2025-01-07 00:59:43', '2025-01-07 05:33:43', '274 minutes', 1159000.00, 'Malang'),
('FLIGHT-0130', 'Citilink', '2025-03-31 01:18:24', '2025-03-31 09:52:24', '514 minutes', 2879000.00, 'Solo'),
('FLIGHT-0131', 'Batik Air', '2025-01-11 06:28:43', '2025-01-11 09:18:43', '170 minutes', 1604000.00, 'Makassar'),
('FLIGHT-0132', 'Lion Air', '2025-03-19 00:20:12', '2025-03-19 01:54:12', '94 minutes', 2466000.00, 'Padang'),
('FLIGHT-0133', 'Citilink', '2025-02-21 23:11:30', '2025-02-22 00:46:30', '95 minutes', 585000.00, 'Jakarta'),
('FLIGHT-0134', 'Lion Air', '2025-04-10 03:29:42', '2025-04-10 07:20:42', '231 minutes', 1218000.00, 'Jayapura'),
('FLIGHT-0135', 'Lion Air', '2025-03-24 03:44:38', '2025-03-24 05:01:38', '77 minutes', 1733000.00, 'Jakarta'),
('FLIGHT-0136', 'Batik Air', '2025-01-26 14:12:36', '2025-01-26 21:39:36', '447 minutes', 2044000.00, 'Yogyakarta'),
('FLIGHT-0137', 'Lion Air', '2025-01-11 10:14:37', '2025-01-11 13:36:37', '202 minutes', 1576000.00, 'Bali'),
('FLIGHT-0138', 'AirAsia', '2025-01-23 05:13:32', '2025-01-23 14:42:32', '569 minutes', 2316000.00, 'Makassar'),
('FLIGHT-0139', 'Citilink', '2024-12-25 05:11:14', '2024-12-25 15:07:14', '596 minutes', 1394000.00, 'Pekanbaru'),
('FLIGHT-0140', 'Garuda Indonesia', '2025-04-19 17:38:25', '2025-04-19 18:47:25', '69 minutes', 2808000.00, 'Bandung'),
('FLIGHT-0141', 'Citilink', '2025-03-31 19:39:34', '2025-04-01 01:04:34', '325 minutes', 1725000.00, 'Bali'),
('FLIGHT-0142', 'Garuda Indonesia', '2025-03-04 10:55:25', '2025-03-04 16:52:25', '357 minutes', 1208000.00, 'Jakarta'),
('FLIGHT-0143', 'Lion Air', '2025-03-30 02:14:04', '2025-03-30 07:13:04', '299 minutes', 863000.00, 'Jakarta'),
('FLIGHT-0144', 'Lion Air', '2025-03-31 06:20:12', '2025-03-31 15:13:12', '533 minutes', 1104000.00, 'Medan'),
('FLIGHT-0145', 'Garuda Indonesia', '2025-03-26 15:16:00', '2025-03-26 18:42:00', '206 minutes', 2826000.00, 'Bali'),
('FLIGHT-0146', 'Batik Air', '2025-01-22 06:20:02', '2025-01-22 07:16:02', '56 minutes', 2710000.00, 'Lombok'),
('FLIGHT-0147', 'Citilink', '2025-03-31 15:01:03', '2025-03-31 19:57:03', '296 minutes', 1498000.00, 'Makassar'),
('FLIGHT-0148', 'Batik Air', '2025-04-05 10:46:59', '2025-04-05 12:26:59', '100 minutes', 2834000.00, 'Batam'),
('FLIGHT-0149', 'Garuda Indonesia', '2025-04-20 08:14:04', '2025-04-20 12:54:04', '280 minutes', 2360000.00, 'Manado'),
('FLIGHT-0150', 'Batik Air', '2025-02-09 09:15:43', '2025-02-09 11:49:43', '154 minutes', 2777000.00, 'Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_date` datetime DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `payment_method` enum('Kartu Kredit','Transfer Bank','Gerai') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `invoices`
--

INSERT INTO `invoices` (`id`, `booking_id`, `user_id`, `invoice_date`, `total_price`, `payment_status`, `payment_method`) VALUES
(2, 6, 2, '2024-12-29 17:37:35', 2097000.00, 'pending', NULL),
(3, 6, 2, '2024-12-29 17:37:58', 2097000.00, 'pending', NULL),
(6, 18, 1, '2025-01-07 21:08:35', 886000.00, 'paid', NULL),
(7, 19, 1, '2025-01-07 21:14:24', 886000.00, 'paid', NULL),
(8, 20, 1, '2025-01-08 11:17:28', 1650000.00, 'paid', NULL),
(14, 26, 1, '2025-01-11 15:24:42', 714000.00, 'paid', NULL),
(15, 27, 3, '2025-01-12 14:22:31', 1650000.00, 'paid', NULL),
(16, 28, 3, '2025-01-12 14:24:09', 886000.00, 'paid', NULL),
(18, 30, 3, '2025-01-12 14:28:06', 2070000.00, 'paid', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `profile_pic`, `created_at`) VALUES
(1, 'zinedineizaaz', 'Zinedine Daffa Izaaz', 'zinedine@gmail.com', '$2y$10$Wepd622OiMXcXI.VGRHvE.Gej4W/yq3MdrGdT3o3S2.xC..YX0VXe', 'images/67815ae3bd082.tmp', '2024-12-27 19:57:14'),
(2, 'anggiedwi', 'Anggie Dwi', 'anggie@gmail.com', '$2y$10$1r0DlFG6U4pJ/snP5o0zEeLFBThc9VlRQcqXKWX0HwYbGy4qGoGxi', 'images/profile_picslogo_wic.jpg', '2024-12-29 17:09:43'),
(3, 'zinedinedaffa', 'Zinedine Izaaz', 'zine@gmail.com', '$2y$10$Sj8beGQPKxnAqovyM.DX1eUsaxZ8MoUV/dOe0fVYAfK86JWSbT6IC', 'images/profile_picszine_dine.jpg', '2025-01-12 14:20:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indeks untuk tabel `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`);

--
-- Ketidakleluasaan untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
