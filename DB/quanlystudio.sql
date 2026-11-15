-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 15, 2026 at 02:16 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlystudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietconcept`
--

DROP TABLE IF EXISTS `chitietconcept`;
CREATE TABLE IF NOT EXISTS `chitietconcept` (
  `MaChiTietConcept` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenChiTietConcept` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MoTa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `HinhAnh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT '1',
  `MaConcept` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`MaChiTietConcept`),
  KEY `FK_ChiTietConcept_Concept` (`MaConcept`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chitietconcept`
--

INSERT INTO `chitietconcept` (`MaChiTietConcept`, `TenChiTietConcept`, `MoTa`, `HinhAnh`, `TrangThai`, `MaConcept`) VALUES
('CTCPT001', 'Cà chua đỏ', 'Concept chân dung tông màu cà chua đỏ rực rỡ', '1.png', 1, 'CPT_CD'),
('CTCPT002', 'Hồng xinh', 'Concept chân dung ngọt ngào với sắc hồng', '2.png', 1, 'CPT_CD'),
('CTCPT003', 'Bướm vàng', 'Concept chân dung phụ kiện bướm vàng nghệ thuật', '3.png', 1, 'CPT_CD'),
('CTCPT004', 'Hạt nở đáng yêu', 'Concept chân dung nhẹ nhàng, dễ thương', '4.png', 1, 'CPT_CD'),
('CTCPT005', 'Hoa đồng tiền hồng', 'Concept chân dung trang trí hoa đồng tiền hồng', '5.png', 1, 'CPT_CD'),
('CTCPT006', 'Cúc họa mi xanh', 'Concept chân dung hoa cúc họa mi sắc xanh', '6.png', 1, 'CPT_CD'),
('CTCPT007', 'Hoa lyly vàng', 'Concept chân dung quý phái với hoa lyly vàng', '7.png', 1, 'CPT_CD'),
('CTCPT008', 'Kẹp xinh', 'Concept chân dung phụ kiện kẹp tóc xinh xắn', '8.png', 1, 'CPT_CD'),
('CTCPT009', 'Kẹp xinh 2', 'Concept chân dung kẹp tóc style cá tính', '9.png', 1, 'CPT_CD'),
('CTCPT010', 'Kẹp xinh 3', 'Concept chân dung kẹp tóc phong cách độc đáo', '10.png', 1, 'CPT_CD'),
('CTCPT011', 'Bướm gương', 'Concept chân dung bướm gương tạo hiệu ứng lấp lánh', '11.png', 1, 'CPT_CD'),
('CTCPT012', 'Bướm trắng', 'Concept chân dung bướm trắng mộng mơ', '12.png', 1, 'CPT_CD'),
('CTCPT013', 'Hoa linh lan', 'Concept chân dung tinh khôi với hoa linh lan', '13.png', 1, 'CPT_CD'),
('CTCPT014', 'Bánh quy nâu', 'Concept chân dung tông màu bánh quy nâu ấm áp', '14.png', 1, 'CPT_CD'),
('CTCPT015', 'Tím dễ thương', 'Concept chân dung tông màu tím đáng yêu', '15.png', 1, 'CPT_CD'),
('CTCPT016', 'Cặp đôi', 'Concept chụp ảnh đôi lãng mạn cho các cặp tình nhân', '16.png', 1, 'CPT_CDO'),
('CTCPT017', 'Bạn thân', 'Concept chụp ảnh kỷ niệm tình bạn thân thiết', '17.png', 1, 'CPT_CDO'),
('CTCPT018', 'Năng động', 'Concept profile phong cách trẻ trung, năng động', '18.png', 1, 'CPT_PF'),
('CTCPT019', 'Profile trắng', 'Concept profile nền trắng tối giản, chuyên nghiệp', '19.png', 1, 'CPT_PF'),
('CTCPT020', 'Vest đen', 'Concept profile vest đen thanh lịch, sang trọng', '20.png', 1, 'CPT_PF'),
('CTCPT021', 'Profile nhẹ nhàng', 'Concept profile thần thái nhẹ nhàng, tự nhiên', '21.png', 1, 'CPT_PF'),
('CTCPT022', 'Cổ lọ tone lạnh', 'Concept profile áo cổ lọ phong cách tone lạnh ấn tượng', '22.png', 1, 'CPT_PF'),
('CTCPT023', 'Thanh khiết', 'Concept profile góc mặt thanh khiết, tối giản', '23.png', 1, 'CPT_PF'),
('CTCPT024', 'Áo thun trắng', 'Concept profile đơn giản với áo thun trắng năng động', '24.png', 1, 'CPT_PF'),
('CTCPT025', 'Bánh mì', 'Concept profile props phụ kiện bánh mì độc đáo', '25.png', 1, 'CPT_PF'),
('CTCPT026', 'Bóng đen', 'Concept sinh nhật sang chảnh với bóng đen huyền bí', '32.png', 1, 'CPT_SN'),
('CTCPT027', 'Học sinh', 'Concept sinh nhật phong cách học sinh ngây thơ', '33.png', 1, 'CPT_SN'),
('CTCPT028', 'Nơ xinh', 'Concept sinh nhật điểm nhấn nơ xinh ngọt ngào', '34.png', 1, 'CPT_SN'),
('CTCPT029', 'Bóng bay hồng', 'Concept sinh nhật công chúa với bóng bay hồng', '35.png', 1, 'CPT_SN'),
('CTCPT030', 'Hồng xinh', 'Concept sinh nhật sắc hồng bánh beo, đáng yêu', '36.png', 1, 'CPT_SN'),
('CTCPT031', 'Vương miện', 'Concept sinh nhật vương miện kiêu sa', '37.png', 1, 'CPT_SN'),
('CTCPT032', 'Nâu tinh nghịch', 'Concept sinh nhật tông nâu ấm áp, tinh nghịch', '38.png', 1, 'CPT_SN'),
('CTCPT033', 'Party queen', 'Concept sinh nhật tiệc tùng lấp lánh như một nữ hoàng', '39.png', 1, 'CPT_SN'),
('CTCPT034', 'Dâu đỏ', 'Concept sinh nhật dâu đỏ mộng mơ', '40.png', 1, 'CPT_SN'),
('CTCPT035', 'Trắng basic', 'Concept sinh nhật tông trắng tối giản, tinh tế', '41.png', 1, 'CPT_SN'),
('CTCPT036', 'Giáng Sinh', 'Concept lễ hội Giáng Sinh với ánh đèn và không gian ấm áp', '42.png', 1, 'CPT_SS'),
('CTCPT037', 'Tết', 'Concept Tết đón xuân tràn ngập sắc đỏ, vàng truyền thống', '43.png', 1, 'CPT_SS'),
('CTCPT038', 'Dễ thương', 'Concept toàn thân dáng pose dễ thương, nhí nhảnh', '44.png', 1, 'CPT_TT'),
('CTCPT039', 'Cool ngầu', 'Concept toàn thân phong cách ngầu, cá tính', '45.png', 1, 'CPT_TT'),
('CTCPT040', 'Phong cách học sinh', 'Concept toàn thân đồng phục học sinh trẻ trung', '46.png', 1, 'CPT_TT');

-- --------------------------------------------------------

--
-- Table structure for table `chitietdichvudikem`
--

DROP TABLE IF EXISTS `chitietdichvudikem`;
CREATE TABLE IF NOT EXISTS `chitietdichvudikem` (
  `MaDatLich` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaDichVuDiKem` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoLuong` int DEFAULT NULL,
  `DonGiaApDung` decimal(12,2) DEFAULT NULL,
  `ThanhTien` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`MaDatLich`,`MaDichVuDiKem`),
  KEY `FK_ChiTiet_DichVuDiKem` (`MaDichVuDiKem`)
) ;

--
-- Dumping data for table `chitietdichvudikem`
--

INSERT INTO `chitietdichvudikem` (`MaDatLich`, `MaDichVuDiKem`, `SoLuong`, `DonGiaApDung`, `ThanhTien`) VALUES
('DL001', 'DVDK001', 1, 200000.00, 200000.00),
('DL002', 'DVDK003', 1, 100000.00, 100000.00),
('DL003', 'DVDK011', 4, 50000.00, 200000.00),
('DL004', 'DVDK002', 1, 350000.00, 350000.00),
('DL004', 'DVDK015', 1, 50000.00, 50000.00),
('DL007', 'DVDK005', 1, 300000.00, 300000.00),
('DL007', 'DVDK012', 1, 100000.00, 100000.00),
('DL009', 'DVDK003', 2, 100000.00, 200000.00),
('DL009', 'DVDK011', 3, 50000.00, 150000.00),
('DL011', 'DVDK007', 1, 400000.00, 400000.00),
('DL012', 'DVDK001', 1, 200000.00, 200000.00),
('DL014', 'DVDK005', 1, 300000.00, 300000.00),
('DL014', 'DVDK008', 1, 500000.00, 500000.00),
('DL015', 'DVDK011', 5, 50000.00, 250000.00),
('DL016', 'DVDK002', 1, 350000.00, 350000.00),
('DL017', 'DVDK010', 1, 1000000.00, 1000000.00),
('DL018', 'DVDK015', 1, 50000.00, 50000.00),
('DL019', 'DVDK012', 2, 100000.00, 200000.00),
('DL021', 'DVDK005', 1, 300000.00, 300000.00),
('DL023', 'DVDK008', 1, 500000.00, 500000.00),
('DL023', 'DVDK009', 1, 800000.00, 800000.00),
('DL028', 'DVDK004', 1, 150000.00, 150000.00),
('DL029', 'DVDK010', 1, 1000000.00, 1000000.00),
('DL030', 'DVDK015', 2, 50000.00, 100000.00),
('DL031', 'DVDK002', 1, 350000.00, 350000.00),
('DL033', 'DVDK005', 1, 300000.00, 300000.00),
('DL034', 'DVDK004', 1, 150000.00, 150000.00),
('DL035', 'DVDK003', 1, 100000.00, 100000.00),
('DL035', 'DVDK010', 1, 1000000.00, 1000000.00),
('DL036', 'DVDK002', 1, 350000.00, 350000.00),
('DL036', 'DVDK004', 1, 150000.00, 150000.00),
('DL040', 'DVDK002', 1, 350000.00, 350000.00),
('DL041', 'DVDK011', 5, 50000.00, 250000.00),
('DL043', 'DVDK002', 1, 350000.00, 350000.00),
('DL054', 'DVDK001', 1, 200000.00, 200000.00),
('DL055', 'DVDK003', 1, 100000.00, 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `concept`
--

DROP TABLE IF EXISTS `concept`;
CREATE TABLE IF NOT EXISTS `concept` (
  `MaConcept` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenConcept` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MoTa` text COLLATE utf8mb4_unicode_ci,
  `HinhAnh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MaConcept`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concept`
--

INSERT INTO `concept` (`MaConcept`, `TenConcept`, `MoTa`, `HinhAnh`, `TrangThai`) VALUES
('CPT_CD', 'Chân Dung', 'Concept chụp ảnh chân dung cá nhân, nghệ thuật', '26.png', 1),
('CPT_CDO', 'Cặp Đôi', 'Concept chụp ảnh cặp đôi, anniversary, tình nhân', '27.png', 1),
('CPT_PF', 'Profile', 'Concept chụp ảnh profile chuyên nghiệp, doanh nhân', '29.png', 1),
('CPT_SN', 'Sinh Nhật', 'Concept chụp ảnh kỷ niệm sinh nhật, tuổi mới', '30.png', 1),
('CPT_SS', 'Seasonal', 'Concept chụp ảnh theo mùa, Lễ Tết, Giáng Sinh, Học Đường', '31.png', 1),
('CPT_TT', 'Toàn Thân', 'Concept chụp ảnh chân dung toàn thân, thời trang', '28.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `datlich`
--

DROP TABLE IF EXISTS `datlich`;
CREATE TABLE IF NOT EXISTS `datlich` (
  `MaDatLich` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayDat` timestamp NULL DEFAULT NULL,
  `TrangThai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SoLuongNguoi` int DEFAULT NULL,
  `NgayCapNhat` timestamp NULL DEFAULT NULL,
  `GhiChu` text COLLATE utf8mb4_unicode_ci,
  `LyDoTuChoi` text COLLATE utf8mb4_unicode_ci,
  `MaKhachHang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaLichChup` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaDichVu` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaConcept` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaChiTietConcept` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaDatLich`),
  KEY `FK_DatLich_KhachHang` (`MaKhachHang`),
  KEY `FK_DatLich_LichChup` (`MaLichChup`),
  KEY `FK_DatLich_DichVu` (`MaDichVu`),
  KEY `FK_DatLich_Concept` (`MaConcept`)
) ;

--
-- Dumping data for table `datlich`
--

INSERT INTO `datlich` (`MaDatLich`, `NgayDat`, `TrangThai`, `SoLuongNguoi`, `NgayCapNhat`, `GhiChu`, `LyDoTuChoi`, `MaKhachHang`, `MaLichChup`, `MaDichVu`, `MaConcept`, `MaChiTietConcept`) VALUES
('DL001', '2026-08-31 19:15:00', 'Đã xác nhận', 1, '2026-09-01 20:20:00', 'Khách chọn phong cách nhẹ nhàng, tự nhiên', NULL, 'KH001', 'LC001', 'DV001', 'CPT_CD', NULL),
('DL002', '2026-09-01 20:30:00', 'Chờ xác nhận', 2, '2026-09-01 20:30:00', 'Khách muốn tư vấn thêm về concept', NULL, 'KH002', 'LC002', 'DV003', 'CPT_CDO', NULL),
('DL003', '2026-09-04 00:20:00', 'Đã hoàn thành', 1, '2026-09-20 04:00:00', 'Buổi chụp đã hoàn tất', NULL, 'KH003', 'LC004', 'DV002', 'CPT_CD', NULL),
('DL004', '2026-09-05 18:45:00', 'Đã xác nhận', 1, '2026-09-06 19:00:00', 'Khách yêu cầu chuẩn bị trang phục trước', NULL, 'KH004', 'LC005', 'DV001', 'CPT_CD', NULL),
('DL005', '2026-09-07 21:10:00', 'Đã hủy', 2, '2026-09-10 01:30:00', 'Khách thay đổi kế hoạch cá nhân', NULL, 'KH005', 'LC007', 'DV003', 'CPT_CDO', NULL),
('DL007', '2026-09-11 01:25:00', 'Đã xác nhận', 2, '2026-09-11 18:30:00', 'Chụp ảnh kỷ niệm cặp đôi', NULL, 'KH007', 'LC009', 'DV003', 'CPT_CDO', NULL),
('DL008', '2026-09-12 19:40:00', 'Đã hoàn thành', 1, '2026-09-29 04:00:00', 'Đã hoàn thành buổi chụp', NULL, 'KH008', 'LC010', 'DV002', 'CPT_TT', NULL),
('DL009', '2026-09-15 00:15:00', 'Đã xác nhận', 1, '2026-09-15 19:10:00', 'Khách chọn concept hoa', NULL, 'KH009', 'LC011', 'DV001', 'CPT_CD', NULL),
('DL010', '2026-09-16 18:20:00', 'Chờ xác nhận', 2, '2026-09-16 18:20:00', 'Đang chờ studio xác nhận', NULL, 'KH010', 'LC012', 'DV003', 'CPT_CDO', NULL),
('DL011', '2026-09-17 20:15:00', 'Đã xác nhận', 1, '2026-09-18 21:00:00', 'Chụp ảnh sinh nhật tuổi 18', NULL, 'KH011', 'LC013', 'DV002', 'CPT_SN', NULL),
('DL012', '2026-09-19 19:30:00', 'Chờ xác nhận', 1, '2026-09-19 19:30:00', 'Khách yêu cầu concept pastel', NULL, 'KH012', 'LC015', 'DV001', 'CPT_SN', NULL),
('DL013', '2026-09-21 23:45:00', 'Đã hủy', 1, '2026-09-23 02:20:00', 'Khách không thể đến đúng lịch', NULL, 'KH013', 'LC017', 'DV002', 'CPT_SN', NULL),
('DL014', '2026-09-23 18:50:00', 'Đã xác nhận', 2, '2026-09-23 20:00:00', 'Chụp ảnh cặp đôi phong cách Hàn Quốc', NULL, 'KH014', 'LC018', 'DV003', 'CPT_CDO', NULL),
('DL015', '2026-09-26 01:10:00', 'Đã xác nhận', 1, '2026-09-26 19:30:00', 'Chụp ảnh profile cá nhân', NULL, 'KH015', 'LC019', 'DV001', 'CPT_CD', NULL),
('DL016', '2026-09-27 20:00:00', 'Chờ xác nhận', 1, '2026-09-27 20:00:00', 'Khách đang cân nhắc concept vintage', NULL, 'KH016', 'LC020', 'DV002', 'CPT_CD', NULL),
('DL017', '2026-09-30 00:30:00', 'Đã xác nhận', 2, '2026-09-30 18:45:00', 'Chụp ảnh kỷ niệm hai người', NULL, 'KH017', 'LC021', 'DV003', 'CPT_CDO', NULL),
('DL018', '2026-10-01 19:20:00', 'Đã hoàn thành', 1, '2026-10-08 03:30:00', 'Buổi chụp đã hoàn thành', NULL, 'KH018', 'LC022', 'DV001', 'CPT_CD', NULL),
('DL019', '2026-10-03 21:45:00', 'Đã xác nhận', 1, '2026-10-04 19:00:00', 'Chụp chân dung phong cách thời trang', NULL, 'KH019', 'LC023', 'DV002', 'CPT_TT', NULL),
('DL021', '2026-10-06 18:30:00', 'Đã xác nhận', 1, '2026-10-06 19:15:00', 'Chụp ảnh Tết áo dài', NULL, 'KH021', 'LC027', 'DV001', 'CPT_SS', NULL),
('DL022', '2026-10-08 20:40:00', 'Đã hủy', 1, '2026-10-10 00:00:00', 'Khách xin hủy lịch vì lý do cá nhân', NULL, 'KH022', 'LC028', 'DV002', 'CPT_SS', NULL),
('DL023', '2026-10-10 19:00:00', 'Đã xác nhận', 2, '2026-10-10 20:20:00', 'Chụp ảnh cặp đôi phong cách retro', NULL, 'KH023', 'LC029', 'DV003', 'CPT_CDO', NULL),
('DL025', '2026-10-14 18:10:00', 'Đã xác nhận', 1, '2026-10-14 19:00:00', 'Chụp ảnh chân dung Beauty', NULL, 'KH025', 'LC032', 'DV002', 'CPT_CD', NULL),
('DL026', '2026-10-15 21:25:00', 'Bị từ chối', 2, '2026-10-16 18:30:00', 'Yêu cầu không phù hợp với điều kiện đặt lịch', 'Khung giờ không còn khả dụng', 'KH026', 'LC034', 'DV003', 'CPT_CDO', NULL),
('DL027', '2026-10-17 19:35:00', 'Đã xác nhận', 1, '2026-10-17 20:15:00', 'Chụp ảnh concept hoa tulip', NULL, 'KH027', 'LC036', 'DV001', 'CPT_CD', NULL),
('DL028', '2026-10-19 23:40:00', 'Chờ xác nhận', 1, '2026-10-19 23:40:00', 'Khách muốn chụp ảnh phong cách học đường', NULL, 'KH028', 'LC037', 'DV002', 'CPT_SS', NULL),
('DL029', '2026-10-21 20:05:00', 'Đã xác nhận', 2, '2026-10-21 21:00:00', 'Chụp ảnh cặp đôi kỷ niệm', NULL, 'KH029', 'LC039', 'DV003', 'CPT_CDO', NULL),
('DL030', '2026-10-24 01:20:00', 'Đã hoàn thành', 1, '2026-10-27 04:00:00', 'Buổi chụp đã hoàn thành và bàn giao ảnh', NULL, 'KH030', 'LC040', 'DV001', 'CPT_CD', NULL),
('DL031', '2026-10-25 03:57:37', 'Chờ thanh toán', 1, '2026-10-25 03:57:37', NULL, NULL, 'KH036', 'LC051', 'DV001', 'CPT_SN', NULL),
('DL033', '2026-10-29 08:20:51', 'Đã xác nhận', 1, '2026-10-29 08:22:26', NULL, NULL, 'KH036', 'LC029', 'DV002', 'CPT_SN', 'CTCPT026'),
('DL034', '2026-10-31 09:08:39', 'Đã xác nhận', 1, '2026-10-31 09:16:36', NULL, NULL, 'KH036', 'LC005', 'DV001', 'CPT_CD', 'CTCPT005'),
('DL035', '2026-10-31 10:46:32', 'Đã xác nhận', 1, '2026-10-31 10:46:55', 'tttttttttttttttttttttttttttttttttttttttttttttttttttttt', NULL, 'KH036', 'LC052', 'DV001', 'CPT_SS', 'CTCPT036'),
('DL036', '2026-11-02 11:27:45', 'Chờ thanh toán', 1, '2026-11-02 11:27:45', NULL, NULL, 'KH037', 'LC053', 'DV002', 'CPT_TT', 'CTCPT038'),
('DL037', '2026-11-04 11:51:43', 'Đã hủy', 1, '2026-11-14 08:29:35', NULL, 'Không muốn chụp nữa', 'KH037', 'LC027', 'DV001', 'CPT_SN', 'CTCPT029'),
('DL038', '2026-11-05 23:58:51', 'Đã xác nhận', 1, '2026-11-06 00:08:37', NULL, NULL, 'KH037', 'LC054', 'DV002', 'CPT_SS', 'CTCPT036'),
('DL039', '2026-11-08 00:37:16', 'Đã xác nhận', 1, '2026-11-08 00:37:22', NULL, NULL, 'KH037', 'LC004', 'DV001', 'CPT_TT', 'CTCPT039'),
('DL040', '2026-11-09 10:09:20', 'Đã xác nhận', 1, '2026-11-09 10:16:16', NULL, NULL, 'KH037', 'LC055', 'DV001', 'CPT_SN', 'CTCPT034'),
('DL041', '2026-11-09 15:26:12', 'Chờ thanh toán', 1, '2026-11-09 15:26:12', NULL, NULL, 'KH037', 'LC056', 'DV003', 'CPT_CDO', 'CTCPT017'),
('DL042', '2026-11-09 15:51:27', 'Chấp nhận đổi lịch', 1, '2026-11-14 07:12:08', '| [YÊU CẦU ĐỔI LỊCH] Ngày mới: 2026-11-20, Khung giờ: KG007. Lý do: có việc bận', NULL, 'KH037', 'LC057', 'DV001', 'CPT_SN', 'CTCPT026'),
('DL043', '2026-11-11 05:48:21', 'Chờ thanh toán', 1, '2026-11-11 05:48:21', NULL, NULL, 'KH001', 'LC058', 'DV001', 'CPT_PF', 'CTCPT019'),
('DL044', '2026-11-11 05:55:17', 'Chờ thanh toán', 1, '2026-11-11 05:55:17', NULL, NULL, 'KH001', 'LC059', 'DV001', 'CPT_TT', 'CTCPT039'),
('DL045', '2026-11-11 18:52:02', 'Chờ thanh toán', 1, '2026-11-11 18:52:02', NULL, NULL, 'KH036', 'LC074', 'DV001', 'CPT_TT', 'CTCPT038'),
('DL046', '2026-11-11 19:07:47', 'Chờ thanh toán', 1, '2026-11-11 19:07:47', NULL, NULL, 'KH036', 'LC075', 'DV002', 'CPT_PF', 'CTCPT018'),
('DL047', '2026-11-11 19:15:43', 'Chờ thanh toán', 1, '2026-11-11 19:15:43', NULL, NULL, 'KH036', 'LC076', 'DV001', 'CPT_CD', 'CTCPT003'),
('DL048', '2026-11-11 19:22:44', 'Chờ thanh toán', 1, '2026-11-11 19:22:44', NULL, NULL, 'KH036', 'LC077', 'DV003', 'CPT_PF', 'CTCPT019'),
('DL049', '2026-11-11 19:42:55', 'Chờ thanh toán', 1, '2026-11-11 19:42:55', NULL, NULL, 'KH036', 'LC078', 'DV001', 'CPT_CDO', 'CTCPT017'),
('DL050', '2026-11-11 19:48:24', 'Chờ thanh toán', 1, '2026-11-11 19:48:24', NULL, NULL, 'KH036', 'LC079', 'DV001', 'CPT_PF', 'CTCPT022'),
('DL051', '2026-11-11 19:53:55', 'Chờ thanh toán', 1, '2026-11-11 19:53:55', NULL, NULL, 'KH036', 'LC080', 'DV001', 'CPT_SN', 'CTCPT027'),
('DL052', '2026-11-11 20:03:54', 'Đã xác nhận', 1, '2026-11-11 20:04:02', NULL, NULL, 'KH036', 'LC081', 'DV001', 'CPT_PF', 'CTCPT020'),
('DL053', '2026-11-11 20:30:51', 'Chờ thanh toán', 1, '2026-11-11 20:30:51', NULL, NULL, 'KH036', 'LC082', 'DV001', 'CPT_CD', 'CTCPT013'),
('DL054', '2026-11-12 06:31:01', 'Chờ thanh toán', 1, '2026-11-12 06:31:01', NULL, NULL, 'KH036', 'LC083', 'DV001', 'CPT_CD', 'CTCPT002'),
('DL055', '2026-11-15 05:51:46', 'Chấp nhận đổi lịch', 1, '2026-11-15 09:00:57', '| [YÊU CẦU ĐỔI LỊCH] Ngày mới: 2026-11-30, Khung giờ: KG003. Lý do: có việc bận, không chụp ngày đó được', NULL, 'KH036', 'LC084', 'DV001', 'CPT_CD', 'CTCPT010');

--
-- Triggers `datlich`
--
DROP TRIGGER IF EXISTS `TRG_DatLich_KiemTraSucChua_Insert`;
DELIMITER $$
CREATE TRIGGER `TRG_DatLich_KiemTraSucChua_Insert` BEFORE INSERT ON `datlich` FOR EACH ROW BEGIN
    DECLARE V_SucChua INT;
    DECLARE V_SoLuong INT;

    IF NEW.TrangThai IN ('Chờ xác nhận', 'Đã xác nhận') THEN

        SELECT KG.SucChuaToiDa
        INTO V_SucChua
        FROM LichChup LC
        JOIN KhungGio KG
            ON LC.MaKhungGio = KG.MaKhungGio
        WHERE LC.MaLichChup = NEW.MaLichChup;

        SELECT COUNT(*)
        INTO V_SoLuong
        FROM DatLich
        WHERE MaLichChup = NEW.MaLichChup
          AND TrangThai IN ('Chờ xác nhận', 'Đã xác nhận');

        IF V_SoLuong >= V_SucChua THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT =
                'Khung gio da het suc chua, khong the dat lich!';
        END IF;

    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `TRG_DatLich_KiemTraSucChua_Update`;
DELIMITER $$
CREATE TRIGGER `TRG_DatLich_KiemTraSucChua_Update` BEFORE UPDATE ON `datlich` FOR EACH ROW BEGIN
    DECLARE V_SucChua INT;
    DECLARE V_SoLuong INT;

    IF NEW.TrangThai IN ('Chờ xác nhận', 'Đã xác nhận') THEN

        SELECT KG.SucChuaToiDa
        INTO V_SucChua
        FROM LichChup LC
        JOIN KhungGio KG
            ON LC.MaKhungGio = KG.MaKhungGio
        WHERE LC.MaLichChup = NEW.MaLichChup;

        SELECT COUNT(*)
        INTO V_SoLuong
        FROM DatLich
        WHERE MaLichChup = NEW.MaLichChup
          AND TrangThai IN ('Chờ xác nhận', 'Đã xác nhận')
          AND MaDatLich <> OLD.MaDatLich;

        IF V_SoLuong >= V_SucChua THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT =
                'Khung gio da het suc chua, khong the cap nhat dat lich!';
        END IF;

    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `TRG_DatLich_LuuNhatKy`;
DELIMITER $$
CREATE TRIGGER `TRG_DatLich_LuuNhatKy` AFTER UPDATE ON `datlich` FOR EACH ROW BEGIN
    DECLARE V_STT BIGINT DEFAULT 0;

    IF NOT (OLD.TrangThai <=> NEW.TrangThai) THEN

        -- Lấy số thứ tự lớn nhất trong lịch sử đặt lịch
        SELECT COALESCE(
            MAX(CAST(SUBSTRING(MaLichSuDatLich, 3) AS UNSIGNED)),
            0
        ) + 1
        INTO V_STT
        FROM lichsudatlich;

        INSERT INTO lichsudatlich (
            MaLichSuDatLich,
            TrangThaiCu,
            TrangThaiMoi,
            ThoiGianThaoTac,
            HanhDong,
            LyDo,
            GhiChu,
            MaDatLich
        )
        VALUES (
            CONCAT('LS', LPAD(V_STT, 8, '0')),
            OLD.TrangThai,
            NEW.TrangThai,
            CURRENT_TIMESTAMP,
            CASE
                WHEN NEW.TrangThai = 'Đã xác nhận'
                    THEN 'Duyệt'
                WHEN NEW.TrangThai IN ('Từ chối', 'Bị từ chối')
                    THEN 'Từ chối'
                WHEN NEW.TrangThai = 'Đã hủy'
                    THEN 'Hủy'
                ELSE 'Thay đổi trạng thái'
            END,
            NEW.LyDoTuChoi,
            NEW.GhiChu,
            NEW.MaDatLich
        );

    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dichvu`
--

DROP TABLE IF EXISTS `dichvu`;
CREATE TABLE IF NOT EXISTS `dichvu` (
  `MaDichVu` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenDichVu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MoTa` text COLLATE utf8mb4_unicode_ci,
  `DonGia` decimal(12,2) DEFAULT NULL,
  `ThoiLuongDuKien` int DEFAULT NULL,
  `SoNguoiToiDa` int DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MaDichVu`)
) ;

--
-- Dumping data for table `dichvu`
--

INSERT INTO `dichvu` (`MaDichVu`, `TenDichVu`, `MoTa`, `DonGia`, `ThoiLuongDuKien`, `SoNguoiToiDa`, `TrangThai`) VALUES
('DV001', 'Beauty - Chân dung', 'Gói chụp ảnh chân dung gồm 1 concept, 1 set trang phục, 1 layout makeup và làm tóc chuyên nghiệp. Thời gian chụp từ 1 đến 1.5 giờ. Bao gồm toàn bộ ảnh gốc chỉnh màu, video và hình ảnh hậu trường BTS, 8 ảnh chỉnh sửa hoàn thiện.', 3190000.00, 270, 1, 1),
('DV002', 'Beauty Plus - Chân dung toàn thân', 'Gói chụp ảnh chân dung toàn thân gồm 1 concept, 1 set trang phục, 1 layout makeup và làm tóc chuyên nghiệp. Thời gian chụp từ 1 đến 1.5 giờ. Bao gồm toàn bộ ảnh gốc chỉnh màu, video và hình ảnh hậu trường BTS, 10 ảnh chỉnh sửa hoàn thiện.', 4190000.00, 270, 1, 1),
('DV003', 'Lover - Cặp đôi', 'Gói chụp ảnh cặp đôi gồm 1 concept, 2 layout makeup và làm tóc chuyên nghiệp (1 nam và 1 nữ). Trường hợp 2 nữ phụ thu 500000 đồng. Thời gian chụp từ 1 đến 1.5 giờ. Bao gồm toàn bộ ảnh gốc chỉnh màu, video và hình ảnh hậu trường BTS, 10 ảnh chỉnh sửa hoàn thiện.', 5300000.00, 270, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dichvudikem`
--

DROP TABLE IF EXISTS `dichvudikem`;
CREATE TABLE IF NOT EXISTS `dichvudikem` (
  `MaDichVuDiKem` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenDichVuDiKem` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MoTa` text COLLATE utf8mb4_unicode_ci,
  `DonGia` decimal(12,2) DEFAULT NULL,
  `DonViTinh` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MaDichVuDiKem`)
) ;

--
-- Dumping data for table `dichvudikem`
--

INSERT INTO `dichvudikem` (`MaDichVuDiKem`, `TenDichVuDiKem`, `MoTa`, `DonGia`, `DonViTinh`, `TrangThai`) VALUES
('DVDK001', 'Thuê thêm trang phục thứ hai', 'Thuê thêm 1 bộ trang phục chụp thứ 2', 200000.00, 'bộ', 1),
('DVDK002', 'Thuê trang phục cao cấp', 'Thuê trang phục dòng cao cấp', 350000.00, 'bộ', 1),
('DVDK003', 'Thuê phụ kiện chụp ảnh', 'Thuê các phụ kiện chụp ảnh kèm theo', 100000.00, 'bộ', 1),
('DVDK004', 'Thuê nailbox', 'Thuê bộ nailbox trang trí tỉ mỉ', 150000.00, 'bộ', 1),
('DVDK005', 'Hoa tươi trang trí', 'Trang trí thêm hoa tươi theo yêu cầu', 300000.00, 'lần', 1),
('DVDK007', 'Trang trí phông nền riêng', 'Thiết kế phông nền riêng theo concept', 400000.00, 'lần', 1),
('DVDK008', 'Setup bối cảnh riêng', 'Setup bối cảnh riêng biệt', 500000.00, 'lần', 1),
('DVDK009', 'Thuê địa điểm ngoài Studio', 'Thuê địa điểm chụp ngoài studio', 800000.00, 'lần', 1),
('DVDK010', 'Chụp ảnh ngoài cảnh', 'Chụp ảnh ngoại cảnh ngoài studio', 1000000.00, 'lần', 1),
('DVDK011', 'Chỉnh sửa thêm ảnh đơn', 'Chỉnh sửa thêm 1 tấm ảnh đơn', 50000.00, 'tấm', 1),
('DVDK012', 'Chỉnh sửa thêm ảnh đôi', 'Chỉnh sửa thêm 1 tấm ảnh đôi', 100000.00, 'tấm', 1),
('DVDK015', 'Giao ảnh tận nơi', 'Giao ảnh in đến tận nơi khách hàng', 50000.00, 'lần', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

DROP TABLE IF EXISTS `hoadon`;
CREATE TABLE IF NOT EXISTS `hoadon` (
  `MaHoaDon` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TongTien` decimal(12,2) DEFAULT NULL,
  `SoTienGiam` decimal(12,2) DEFAULT NULL,
  `TienCoc` decimal(12,2) DEFAULT NULL,
  `TongTienPhaiTra` decimal(12,2) DEFAULT NULL,
  `SoTienDaThanhToan` decimal(12,2) DEFAULT NULL,
  `SoTienConLai` decimal(12,2) DEFAULT NULL,
  `TrangThai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NgayLap` timestamp NULL DEFAULT NULL,
  `NgayCapNhat` timestamp NULL DEFAULT NULL,
  `MaDatLich` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaKhachHang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaVoucher` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaHoaDon`),
  UNIQUE KEY `MaDatLich` (`MaDatLich`),
  KEY `FK_HoaDon_Voucher` (`MaVoucher`)
) ;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`MaHoaDon`, `TongTien`, `SoTienGiam`, `TienCoc`, `TongTienPhaiTra`, `SoTienDaThanhToan`, `SoTienConLai`, `TrangThai`, `NgayLap`, `NgayCapNhat`, `MaDatLich`, `MaKhachHang`, `MaVoucher`) VALUES
('HD001', 3690000.00, 300000.00, 500000.00, 3390000.00, 500000.00, 2890000.00, 'Đã đặt cọc', '2026-10-25 12:30:00', '2026-10-26 13:20:00', 'DL001', 'KH001', 'VC001'),
('HD002', 5400000.00, 500000.00, 1000000.00, 4900000.00, 1000000.00, 3900000.00, 'Chờ thanh toán', '2026-10-26 13:30:00', '2026-10-26 13:30:00', 'DL002', 'KH002', 'VC002'),
('HD003', 4390000.00, 300000.00, 500000.00, 4090000.00, 4090000.00, 0.00, 'Đã thanh toán', '2026-10-26 17:30:00', '2026-11-02 21:00:00', 'DL003', 'KH003', 'VC005'),
('HD004', 3590000.00, 0.00, 500000.00, 3590000.00, 500000.00, 3090000.00, 'Đã đặt cọc', '2026-10-27 12:00:00', '2026-10-28 12:00:00', 'DL004', 'KH004', 'VC001'),
('HD005', 5300000.00, 0.00, 0.00, 5300000.00, 0.00, 0.00, 'Đã hủy', '2026-10-27 14:10:00', '2026-10-29 18:30:00', 'DL005', 'KH005', 'VC003'),
('HD007', 5700000.00, 500000.00, 1000000.00, 5200000.00, 1000000.00, 4200000.00, 'Đã đặt cọc', '2026-10-28 18:30:00', '2026-10-29 11:30:00', 'DL007', 'KH007', 'VC007'),
('HD008', 4390000.00, 500000.00, 500000.00, 3890000.00, 3890000.00, 0.00, 'Đã thanh toán', '2026-10-29 13:00:00', '2026-11-05 21:00:00', 'DL008', 'KH008', 'VC003'),
('HD009', 3540000.00, 0.00, 500000.00, 3540000.00, 500000.00, 3040000.00, 'Đã đặt cọc', '2026-10-29 17:30:00', '2026-10-30 12:10:00', 'DL009', 'KH009', 'VC002'),
('HD010', 5450000.00, 0.00, 1000000.00, 5450000.00, 0.00, 5450000.00, 'Chờ thanh toán', '2026-10-30 11:20:00', '2026-10-30 11:20:00', 'DL010', 'KH010', 'VC004'),
('HD011', 4590000.00, 300000.00, 500000.00, 4290000.00, 500000.00, 3790000.00, 'Đã đặt cọc', '2026-10-30 13:20:00', '2026-10-30 14:00:00', 'DL011', 'KH011', 'VC004'),
('HD014', 6100000.00, 700000.00, 1000000.00, 5400000.00, 1000000.00, 4400000.00, 'Đã đặt cọc', '2026-11-01 12:00:00', '2026-11-01 13:00:00', 'DL014', 'KH012', 'VC008'),
('HD017', 4490000.00, 0.00, 0.00, 4490000.00, 4490000.00, 0.00, 'Đã thanh toán', '2026-11-07 15:22:26', '2026-11-07 15:22:26', 'DL033', 'KH014', 'VC005'),
('HD018', 3240000.00, 0.00, 500000.00, 3240000.00, 3240000.00, 0.00, 'Đã thanh toán', '2026-11-02 12:30:00', '2026-11-04 20:30:00', 'DL018', 'KH015', 'VC006'),
('HD023', 6600000.00, 1000000.00, 1000000.00, 5600000.00, 1000000.00, 4600000.00, 'Đã đặt cọc', '2026-11-03 12:15:00', '2026-11-03 13:20:00', 'DL023', 'KH016', 'VC010'),
('HD030', 3290000.00, 300000.00, 500000.00, 2990000.00, 2990000.00, 0.00, 'Đã hủy', '2026-11-03 18:30:00', '2026-11-11 14:05:41', 'DL030', 'KH017', 'VC001'),
('HD031', 3190000.00, 0.00, 957000.00, 3190000.00, 957000.00, 2233000.00, 'Đã đặt cọc', '2026-11-08 07:37:16', '2026-11-08 07:37:22', 'DL039', 'KH037', 'VC002'),
('HD033', 5550000.00, 0.00, 1665000.00, 5550000.00, 0.00, 5550000.00, 'Chờ thanh toán', '2026-11-09 15:26:12', '2026-11-09 15:26:12', 'DL041', 'KH037', NULL),
('HD034', 3190000.00, 500000.00, 807000.00, 2690000.00, 807000.00, 1883000.00, 'Đã đặt cọc', '2026-11-09 15:51:27', '2026-11-09 15:54:14', 'DL042', 'KH037', 'VC003'),
('HD035', 3540000.00, 0.00, 1062000.00, 3540000.00, 0.00, 3540000.00, 'Chờ thanh toán', '2026-11-11 05:48:21', '2026-11-11 05:48:21', 'DL043', 'KH001', NULL),
('HD036', 3190000.00, 0.00, 957000.00, 3190000.00, 0.00, 3190000.00, 'Chờ thanh toán', '2026-11-11 05:55:17', '2026-11-11 05:55:17', 'DL044', 'KH001', NULL),
('HD037', 3190000.00, 0.00, 957000.00, 3190000.00, 0.00, 3190000.00, 'Chờ thanh toán', '2026-11-11 18:52:02', '2026-11-11 18:52:02', 'DL045', 'KH036', NULL),
('HD038', 4190000.00, 0.00, 1257000.00, 4190000.00, 0.00, 4190000.00, 'Chờ thanh toán', '2026-11-11 19:07:47', '2026-11-11 19:07:47', 'DL046', 'KH036', NULL),
('HD039', 3190000.00, 0.00, 957000.00, 3190000.00, 0.00, 3190000.00, 'Chờ thanh toán', '2026-11-11 19:15:43', '2026-11-11 19:15:43', 'DL047', 'KH036', NULL),
('HD040', 5300000.00, 0.00, 1590000.00, 5300000.00, 0.00, 5300000.00, 'Chờ thanh toán', '2026-11-11 19:22:44', '2026-11-11 19:22:44', 'DL048', 'KH036', NULL),
('HD041', 3190000.00, 0.00, 957000.00, 3190000.00, 0.00, 3190000.00, 'Chờ thanh toán', '2026-11-11 19:42:55', '2026-11-11 19:42:55', 'DL049', 'KH036', NULL),
('HD042', 3190000.00, 0.00, 957000.00, 3190000.00, 0.00, 3190000.00, 'Chờ thanh toán', '2026-11-11 19:48:24', '2026-11-11 19:48:24', 'DL050', 'KH036', NULL),
('HD043', 3190000.00, 0.00, 957000.00, 3190000.00, 0.00, 3190000.00, 'Chờ thanh toán', '2026-11-11 19:53:55', '2026-11-11 19:53:55', 'DL051', 'KH036', NULL),
('HD044', 3190000.00, 500000.00, 957000.00, 2690000.00, 2690000.00, 0.00, 'Đã thanh toán', '2026-11-11 20:03:54', '2026-11-11 20:04:02', 'DL052', 'KH036', 'VC003'),
('HD045', 3190000.00, 0.00, 957000.00, 3190000.00, 0.00, 3190000.00, 'Chờ thanh toán', '2026-11-11 20:30:51', '2026-11-11 20:30:51', 'DL053', 'KH036', NULL),
('HD046', 3390000.00, 0.00, 1017000.00, 3390000.00, 0.00, 3390000.00, 'Chờ thanh toán', '2026-11-12 06:31:01', '2026-11-12 06:31:01', 'DL054', 'KH036', NULL),
('HD047', 3290000.00, 300000.00, 897000.00, 2990000.00, 897000.00, 2093000.00, 'Đã đặt cọc', '2026-11-15 05:51:46', '2026-11-15 05:52:02', 'DL055', 'KH036', 'VC004');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `MaKhachHang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HoTen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SoDienThoai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaChi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT NULL,
  `MaTaiKhoan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaKhachHang`),
  UNIQUE KEY `SoDienThoai` (`SoDienThoai`),
  UNIQUE KEY `Email` (`Email`),
  KEY `FK_KhachHang_TaiKhoan` (`MaTaiKhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKhachHang`, `HoTen`, `NgaySinh`, `GioiTinh`, `SoDienThoai`, `Email`, `DiaChi`, `TrangThai`, `MaTaiKhoan`) VALUES
('KH001', 'Nguyễn Văn An', '1998-03-15', 'Nam', '0901234501', 'nguyenvanan@gmail.com', 'Quận 1, TP.HCM', 1, 'TK001'),
('KH002', 'Trần Thị Bình', '2000-07-22', 'Nữ', '0901234502', 'tranthibinh@gmail.com', 'Quận 3, TP.HCM', 1, 'TK002'),
('KH003', 'Lê Hoàng Nam', '1997-11-08', 'Nam', '0901234503', 'lehoangnam@gmail.com', 'Quận 5, TP.HCM', 1, 'TK003'),
('KH004', 'Phạm Ngọc Anh', '2001-01-19', 'Nữ', '0901234504', 'phamngocanh@gmail.com', 'Quận 7, TP.HCM', 1, 'TK004'),
('KH005', 'Võ Minh Khang', '1999-05-30', 'Nam', '0901234505', 'vominhkhang@gmail.com', 'Quận Bình Thạnh, TP.HCM', 1, 'TK005'),
('KH006', 'Đặng Thu Hà', '1996-09-12', 'Nữ', '0901234506', 'dangthuha@gmail.com', 'Quận Gò Vấp, TP.HCM', 1, 'TK006'),
('KH007', 'Bùi Quốc Bảo', '2002-04-25', 'Nam', '0901234507', 'buiquocbao@gmail.com', 'Quận Tân Bình, TP.HCM', 0, 'TK007'),
('KH008', 'Hoàng Mai Linh', '1998-12-03', 'Nữ', '0901234508', 'hoangmailinh@gmail.com', 'Quận Phú Nhuận, TP.HCM', 1, 'TK008'),
('KH009', 'Đỗ Thanh Tùng', '1995-06-17', 'Nam', '0901234509', 'dothanhtung@gmail.com', 'Quận 10, TP.HCM', 1, 'TK009'),
('KH010', 'Ngô Khánh Vy', '2003-02-11', 'Nữ', '0901234510', 'ngokhanhvy@gmail.com', 'TP. Thủ Đức, TP.HCM', 1, 'TK010'),
('KH011', 'Dương Gia Huy', '1997-08-29', 'Nam', '0901234511', 'duonggiahuy@gmail.com', 'Quận 4, TP.HCM', 0, 'TK011'),
('KH012', 'Lý Thanh Trúc', '2000-10-06', 'Nữ', '0901234512', 'lythanhtruc@gmail.com', 'Quận 6, TP.HCM', 1, 'TK012'),
('KH013', 'Trịnh Đức Thịnh', '1994-12-21', 'Nam', '0901234513', 'trinhducthinh@gmail.com', 'Quận 8, TP.HCM', 1, 'TK013'),
('KH014', 'Mai Phương Thảo', '1999-04-14', 'Nữ', '0901234514', 'maiphuongthao@gmail.com', 'Quận Tân Phú, TP.HCM', 0, 'TK014'),
('KH015', 'Cao Tuấn Kiệt', '2001-07-09', 'Nam', '0901234515', 'caotuankiet@gmail.com', 'Quận 11, TP.HCM', 1, 'TK015'),
('KH016', 'Đinh Ngọc Hân', '1996-02-27', 'Nữ', '0901234516', 'dinhngochan@gmail.com', 'Quận 12, TP.HCM', 1, 'TK016'),
('KH017', 'Tạ Minh Quân', '1998-05-18', 'Nam', '0901234517', 'taminhquan@gmail.com', 'Quận Bình Tân, TP.HCM', 0, 'TK017'),
('KH018', 'Trương Bảo Ngọc', '2002-09-23', 'Nữ', '0901234518', 'truongbaongoc@gmail.com', 'Huyện Nhà Bè, TP.HCM', 1, 'TK018'),
('KH019', 'Phan Thanh Phong', '1995-01-31', 'Nam', '0901234519', 'phanthanhphong@gmail.com', 'Quận 2, TP.HCM', 1, 'TK019'),
('KH020', 'Huỳnh Kim Ngân', '2000-06-13', 'Nữ', '0901234520', 'huynhkimngan@gmail.com', 'Quận 9, TP.HCM', 0, 'TK020'),
('KH021', 'Nguyễn Đức Long', '1993-03-07', 'Nam', '0901234521', 'nguyenduclong@gmail.com', 'Quận 1, TP.HCM', 1, 'TK021'),
('KH022', 'Trần Ngọc Diệp', '1997-10-28', 'Nữ', '0901234522', 'tranngocdiep@gmail.com', 'Quận 3, TP.HCM', 1, 'TK022'),
('KH023', 'Lê Tuấn Anh', '2001-12-16', 'Nam', '0901234523', 'letuananh@gmail.com', 'Quận 5, TP.HCM', 1, 'TK023'),
('KH024', 'Phạm Thị Mỹ Duyên', '1998-08-05', 'Nữ', '0901234524', 'phamthimyduyen@gmail.com', 'Quận 7, TP.HCM', 0, 'TK024'),
('KH025', 'Võ Thành Đạt', '1996-11-24', 'Nam', '0901234525', 'vothanhdat@gmail.com', 'Quận Bình Thạnh, TP.HCM', 1, 'TK025'),
('KH026', 'Đặng Ngọc Thúy', '2002-05-02', 'Nữ', '0901234526', 'dangngocthuy@gmail.com', 'Quận Gò Vấp, TP.HCM', 1, 'TK026'),
('KH027', 'Bùi Minh Trí', '1994-09-19', 'Nam', '0901234527', 'buiminhtri@gmail.com', 'Quận Tân Bình, TP.HCM', 0, 'TK027'),
('KH028', 'Hoàng Yến Nhi', '2000-01-26', 'Nữ', '0901234528', 'hoangyennhi@gmail.com', 'Quận Phú Nhuận, TP.HCM', 1, 'TK028'),
('KH029', 'Đỗ Quang Hiếu', '1999-07-14', 'Nam', '0901234529', 'doquanghieu@gmail.com', 'Quận 10, TP.HCM', 1, 'TK029'),
('KH030', 'Ngô Thủy Tiên', '1995-04-08', 'Nữ', '0901234530', 'ngothuytien@gmail.com', 'TP. Thủ Đức, TP.HCM', 0, 'TK030'),
('KH031', 'Dương Hoài Nam', '1997-02-20', 'Nam', '0901234531', 'duonghoainam@gmail.com', 'Quận 4, TP.HCM', 1, 'TK031'),
('KH032', 'Lý Bảo Trâm', '2003-06-29', 'Nữ', '0901234532', 'lybaotram@gmail.com', 'Quận 6, TP.HCM', 1, 'TK032'),
('KH033', 'Trịnh Minh Đức', '1996-10-15', 'Nam', '0901234533', 'trinhminhduc@gmail.com', 'Quận 8, TP.HCM', 0, 'TK033'),
('KH034', 'Mai Thanh Tâm', '1998-12-09', 'Nữ', '0901234534', 'maithanhtam@gmail.com', 'Quận Tân Phú, TP.HCM', 1, 'TK034'),
('KH035', 'Cao Minh Châu', '2001-03-11', 'Nữ', '0901234535', 'caominhchau@gmail.com', 'Quận 11, TP.HCM', 1, 'TK035'),
('KH036', 'Thanh Tiền', '2010-10-10', 'Nữ', '0123456788', '030239230245@st.buh.edu.vn', 'Thủ Đức, TPHCM', 1, 'TK051'),
('KH037', 'TTTT', '2011-11-11', 'Nu', '0987654321', 'tranthithanhtien15012005.pt@gmail.com', 'Thủ Đức, TPHCM', 1, 'TK052');

-- --------------------------------------------------------

--
-- Table structure for table `khoakhunggio`
--

DROP TABLE IF EXISTS `khoakhunggio`;
CREATE TABLE IF NOT EXISTS `khoakhunggio` (
  `MaKhoa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayKhoa` date DEFAULT NULL,
  `ThoiGianHetHan` timestamp NULL DEFAULT NULL,
  `LoaiKhoa` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LyDo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaKhungGio` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaDatLich` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaKhoa`),
  KEY `FK_KhoaKhungGio_KhungGio` (`MaKhungGio`),
  KEY `FK_KhoaKhungGio_DatLich` (`MaDatLich`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khoakhunggio`
--

INSERT INTO `khoakhunggio` (`MaKhoa`, `NgayKhoa`, `ThoiGianHetHan`, `LoaiKhoa`, `LyDo`, `MaKhungGio`, `MaDatLich`) VALUES
('KKG001', '2026-11-18', '2026-11-18 11:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG007', 'DL001'),
('KKG002', '2026-11-07', '2026-11-07 07:30:00', 'Khóa tạm thời', 'Đang chờ studio xác nhận lịch chụp', 'KG003', 'DL002'),
('KKG003', '2026-11-30', '2026-11-30 06:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG002', 'DL004'),
('KKG005', '2026-11-06', '2026-11-06 05:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG001', 'DL007'),
('KKG006', '2026-11-13', '2026-11-13 11:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG007', 'DL009'),
('KKG007', '2026-11-23', '2026-11-23 05:30:00', 'Khóa tạm thời', 'Đang chờ studio xác nhận lịch chụp', 'KG001', 'DL010'),
('KKG008', '2026-11-10', '2026-11-10 09:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG005', 'DL011'),
('KKG009', '2026-11-17', '2026-11-17 06:30:00', 'Khóa tạm thời', 'Đang chờ studio xác nhận lịch chụp', 'KG002', 'DL012'),
('KKG010', '2026-11-14', '2026-11-14 13:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG009', 'DL014'),
('KKG011', '2026-11-20', '2026-11-20 07:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG003', 'DL015'),
('KKG012', '2026-11-11', '2026-11-11 10:30:00', 'Khóa tạm thời', 'Đang chờ studio xác nhận lịch chụp', 'KG006', 'DL016'),
('KKG013', '2026-11-29', '2026-11-29 16:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG012', 'DL017'),
('KKG014', '2026-11-19', '2026-11-19 12:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG008', 'DL019'),
('KKG016', '2026-11-18', '2026-11-18 06:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG002', 'DL021'),
('KKG017', '2026-11-25', '2026-11-25 07:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG003', 'DL023'),
('KKG019', '2026-11-09', '2026-11-09 08:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG004', 'DL025'),
('KKG020', '2026-11-13', '2026-11-13 07:30:00', 'Khóa chính thức', 'Lịch chụp đã được xác nhận', 'KG003', 'DL027');

--
-- Triggers `khoakhunggio`
--
DROP TRIGGER IF EXISTS `TRG_KhoaKhungGio_KiemTra_Insert`;
DELIMITER $$
CREATE TRIGGER `TRG_KhoaKhungGio_KiemTra_Insert` BEFORE INSERT ON `khoakhunggio` FOR EACH ROW BEGIN

    -- Tu dong dat thoi gian het han 15 phut
    IF NEW.LoaiKhoa = 'Khóa 15p' THEN
        SET NEW.ThoiGianHetHan =
            DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 15 MINUTE);
    END IF;

    -- Kiem tra khung gio dang duoc giu cho
    IF NEW.ThoiGianHetHan > CURRENT_TIMESTAMP THEN

        IF EXISTS (
            SELECT 1
            FROM KhoaKhungGio
            WHERE MaKhungGio = NEW.MaKhungGio
              AND NgayKhoa = NEW.NgayKhoa
              AND ThoiGianHetHan > CURRENT_TIMESTAMP
        ) THEN

            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT =
                'Khung gio nay dang co lenh giu cho con hieu luc!';

        END IF;

    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `khunggio`
--

DROP TABLE IF EXISTS `khunggio`;
CREATE TABLE IF NOT EXISTS `khunggio` (
  `MaKhungGio` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GioBatDau` time DEFAULT NULL,
  `GioKetThuc` time DEFAULT NULL,
  `SucChuaToiDa` int DEFAULT NULL,
  `ThoiGianDemPhut` int DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MaKhungGio`)
) ;

--
-- Dumping data for table `khunggio`
--

INSERT INTO `khunggio` (`MaKhungGio`, `GioBatDau`, `GioKetThuc`, `SucChuaToiDa`, `ThoiGianDemPhut`, `TrangThai`) VALUES
('KG001', '08:00:00', '12:30:00', 2, 15, 1),
('KG002', '09:00:00', '13:30:00', 2, 15, 1),
('KG003', '10:00:00', '14:30:00', 2, 15, 1),
('KG004', '11:00:00', '15:30:00', 2, 15, 1),
('KG005', '12:00:00', '16:30:00', 2, 15, 1),
('KG006', '13:00:00', '17:30:00', 2, 15, 1),
('KG007', '14:00:00', '18:30:00', 2, 15, 1),
('KG008', '15:00:00', '19:30:00', 2, 15, 1),
('KG009', '16:00:00', '20:30:00', 2, 15, 0),
('KG010', '17:00:00', '21:30:00', 2, 15, 0),
('KG011', '18:00:00', '22:30:00', 2, 15, 0),
('KG012', '19:00:00', '23:30:00', 2, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lichchup`
--

DROP TABLE IF EXISTS `lichchup`;
CREATE TABLE IF NOT EXISTS `lichchup` (
  `MaLichChup` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayChup` date DEFAULT NULL,
  `TrangThai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GhiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaLichLamViec` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaKhungGio` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaLichChup`),
  KEY `FK_LichChup_LichLamViec` (`MaLichLamViec`),
  KEY `FK_LichChup_KhungGio` (`MaKhungGio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lichchup`
--

INSERT INTO `lichchup` (`MaLichChup`, `NgayChup`, `TrangThai`, `GhiChu`, `MaLichLamViec`, `MaKhungGio`) VALUES
('LC001', '2026-11-18', 'Đã đặt', 'Lich chup concept beauty', 'LLV013', 'KG007'),
('LC002', '2026-11-07', 'Còn trống', 'Lich chup chan dung', 'LLV002', 'KG003'),
('LC003', '2026-11-25', 'Còn trống', 'Lich chup concept Giang Sinh', 'LLV020', 'KG011'),
('LC004', '2026-11-12', 'Đã đặt', 'Lich chup concept cap doi', 'LLV007', 'KG004'),
('LC005', '2026-11-30', 'Còn trống', 'Lich chup concept profile', 'LLV025', 'KG002'),
('LC006', '2026-11-09', 'Tạm khóa', 'Tam khoa khung gio', 'LLV004', 'KG010'),
('LC007', '2026-11-21', 'Còn trống', 'Lich chup cuoi tuan', 'LLV016', 'KG005'),
('LC008', '2026-11-15', 'Đã đặt', 'Lich chup concept vintage', 'LLV010', 'KG008'),
('LC009', '2026-11-06', 'Còn trống', 'Lich chup buoi sang', 'LLV001', 'KG001'),
('LC010', '2026-11-27', 'Đã đặt', 'Lich chup concept hoa', 'LLV022', 'KG006'),
('LC011', '2026-11-13', 'Còn trống', 'Lich chup concept nang tho', 'LLV008', 'KG007'),
('LC012', '2026-11-23', 'Đã đặt', 'Lich chup concept sinh nhat', 'LLV018', 'KG001'),
('LC013', '2026-11-10', 'Còn trống', 'Lich chup profile ca nhan', 'LLV005', 'KG005'),
('LC014', '2026-11-28', 'Đã đặt', 'Lich chup concept vintage', 'LLV023', 'KG011'),
('LC015', '2026-11-17', 'Còn trống', 'Lich chup concept hoa', 'LLV012', 'KG002'),
('LC016', '2026-11-08', 'Tạm khóa', 'Tam khoa khung gio', 'LLV003', 'KG010'),
('LC017', '2026-11-26', 'Còn trống', 'Lich chup concept cap doi', 'LLV021', 'KG004'),
('LC018', '2026-11-14', 'Còn trống', 'Lich chup cuoi tuan', 'LLV009', 'KG009'),
('LC019', '2026-11-20', 'Đã đặt', 'Lich chup concept chan dung', 'LLV015', 'KG003'),
('LC020', '2026-11-11', 'Tạm khóa', 'Ngay lam viec khong hoat dong', 'LLV006', 'KG006'),
('LC021', '2026-11-29', 'Còn trống', 'Lich chup cuoi tuan', 'LLV024', 'KG012'),
('LC022', '2026-11-16', 'Đã đặt', 'Lich chup chan dung ca nhan', 'LLV011', 'KG006'),
('LC023', '2026-11-19', 'Còn trống', 'Lich chup concept profile', 'LLV014', 'KG008'),
('LC024', '2026-11-22', 'Còn trống', 'Lich chup cuoi tuan', 'LLV017', 'KG005'),
('LC025', '2026-11-24', 'Tạm khóa', 'Studio nghi le', 'LLV019', 'KG002'),
('LC026', '2026-11-07', 'Đã đặt', 'Lich chup buoi chieu', 'LLV002', 'KG009'),
('LC027', '2026-11-18', 'Còn trống', 'Lich chup concept beauty', 'LLV013', 'KG002'),
('LC028', '2026-11-06', 'Đã đặt', 'Lich chup buoi chieu', 'LLV001', 'KG007'),
('LC029', '2026-11-25', 'Còn trống', 'Lich chup concept Giang Sinh', 'LLV020', 'KG003'),
('LC030', '2026-11-12', 'Còn trống', 'Lich chup concept cap doi', 'LLV007', 'KG012'),
('LC031', '2026-11-30', 'Đã đặt', 'Lich chup buoi chieu', 'LLV025', 'KG008'),
('LC032', '2026-11-09', 'Còn trống', 'Lich chup buoi sang', 'LLV004', 'KG004'),
('LC033', '2026-11-21', 'Đã đặt', 'Lich chup cuoi tuan', 'LLV016', 'KG009'),
('LC034', '2026-11-15', 'Còn trống', 'Lich chup concept sinh nhat', 'LLV010', 'KG005'),
('LC035', '2026-11-27', 'Còn trống', 'Lich chup concept profile', 'LLV022', 'KG012'),
('LC036', '2026-11-13', 'Đã đặt', 'Lich chup concept beauty', 'LLV008', 'KG003'),
('LC037', '2026-11-23', 'Còn trống', 'Lich chup concept sinh nhat', 'LLV018', 'KG007'),
('LC038', '2026-11-10', 'Đã đặt', 'Lich chup concept vintage', 'LLV005', 'KG011'),
('LC039', '2026-11-28', 'Còn trống', 'Lich chup cuoi tuan', 'LLV023', 'KG006'),
('LC040', '2026-11-17', 'Đã đặt', 'Lich chup concept nang tho', 'LLV012', 'KG004'),
('LC041', '2026-11-08', 'Còn trống', 'Lich chup cuoi tuan', 'LLV003', 'KG001'),
('LC042', '2026-11-26', 'Đã đặt', 'Lich chup concept cap doi', 'LLV021', 'KG008'),
('LC043', '2026-11-14', 'Còn trống', 'Lich chup buoi chieu', 'LLV009', 'KG005'),
('LC044', '2026-11-20', 'Đã đặt', 'Lich chup concept chan dung', 'LLV015', 'KG010'),
('LC045', '2026-11-11', 'Tạm khóa', 'Ngay lam viec khong hoat dong', 'LLV006', 'KG002'),
('LC046', '2026-11-29', 'Đã đặt', 'Lich chup concept profile', 'LLV024', 'KG006'),
('LC047', '2026-11-16', 'Còn trống', 'Lich chup concept hoa', 'LLV011', 'KG012'),
('LC048', '2026-11-19', 'Đã đặt', 'Lich chup concept vintage', 'LLV014', 'KG001'),
('LC049', '2026-11-22', 'Còn trống', 'Lich chup cuoi tuan', 'LLV017', 'KG009'),
('LC050', '2026-11-24', 'Tạm khóa', 'Studio nghi le', 'LLV019', 'KG011'),
('LC051', '2026-11-20', 'Đã đặt', 'Lịch chụp bổ sung tháng 11', 'LLV015', 'KG006'),
('LC052', '2026-12-01', 'Đã đặt', 'Lịch chụp đón chào tháng mới', 'LLV026', 'KG003'),
('LC053', '2026-12-03', 'Đã đặt', 'Lịch chụp concept mùa đông', 'LLV028', 'KG002'),
('LC054', '2026-11-18', 'Đã đặt', 'Lịch chụp tăng cường cuối tuần', 'LLV013', 'KG008'),
('LC055', '2026-11-12', 'Đã đặt', 'Lịch chụp đặc biệt giữa tuần', 'LLV007', 'KG002'),
('LC056', '2026-12-01', 'Đã đặt', 'Lịch chụp đón tháng 12', 'LLV026', 'KG006'),
('LC057', '2026-12-01', 'Còn trống', 'Lịch chụp đầu tháng 12', 'LLV026', 'KG005'),
('LC058', '2026-12-12', 'DaDat', 'Lịch chụp bổ sung tháng 12', 'LLV026', 'KG003'),
('LC059', '2026-11-12', 'DaDat', 'Lịch chụp giữa tháng 11', 'LLV007', 'KG003'),
('LC060', '2026-12-02', 'Còn trống', 'Lịch chụp concept Noel sớm', 'LLV026', 'KG001'),
('LC061', '2026-12-04', 'Đã đặt', 'Lịch chụp gia đình cuối năm', 'LLV028', 'KG004'),
('LC062', '2026-12-05', 'Còn trống', 'Lịch chụp chân dung cá nhân', 'LLV029', 'KG005'),
('LC063', '2026-12-06', 'Đã đặt', 'Lịch chụp kỷ yếu nhóm', 'LLV030', 'KG002'),
('LC064', '2026-12-08', 'Tạm khóa', 'Bảo trì thiết bị studio', 'LLV031', 'KG010'),
('LC065', '2026-12-10', 'Còn trống', 'Lịch chụp concept mùa đông', 'LLV032', 'KG003'),
('LC066', '2026-12-12', 'Đã đặt', 'Lịch chụp đôi kỷ niệm ngày cưới', 'LLV026', 'KG006'),
('LC067', '2026-12-15', 'Còn trống', 'Lịch chụp lookbook thời trang đông', 'LLV033', 'KG007'),
('LC068', '2026-12-18', 'Đã đặt', 'Lịch chụp concept Giáng Sinh', 'LLV034', 'KG008'),
('LC069', '2026-12-20', 'Còn trống', 'Lịch chụp profile doanh nhân', 'LLV035', 'KG001'),
('LC070', '2026-12-22', 'Đã đặt', 'Lịch chụp đón Giáng Sinh', 'LLV036', 'KG003'),
('LC071', '2026-12-24', 'Tạm khóa', 'Nghỉ lễ Giáng Sinh', 'LLV037', 'KG009'),
('LC072', '2026-12-26', 'Còn trống', 'Lịch chụp hậu Giáng Sinh', 'LLV038', 'KG004'),
('LC073', '2026-12-28', 'Đã đặt', 'Lịch chụp đón năm mới 2027', 'LLV039', 'KG006'),
('LC074', '2026-11-20', 'DaDat', NULL, NULL, 'KG001'),
('LC075', '2026-11-22', 'DaDat', NULL, NULL, 'KG006'),
('LC076', '2026-11-14', 'DaDat', NULL, NULL, 'KG001'),
('LC077', '2026-11-19', 'DaDat', NULL, NULL, 'KG010'),
('LC078', '2026-11-18', 'DaDat', NULL, NULL, 'KG003'),
('LC079', '2026-11-21', 'DaDat', NULL, NULL, 'KG001'),
('LC080', '2026-11-18', 'DaDat', NULL, NULL, 'KG006'),
('LC081', '2026-11-13', 'DaDat', NULL, NULL, 'KG008'),
('LC082', '2026-11-15', 'DaDat', NULL, NULL, 'KG011'),
('LC083', '2026-11-27', 'DaDat', NULL, NULL, 'KG008'),
('LC084', '2026-11-25', 'DaDat', NULL, NULL, 'KG007');

-- --------------------------------------------------------

--
-- Table structure for table `lichlamviec`
--

DROP TABLE IF EXISTS `lichlamviec`;
CREATE TABLE IF NOT EXISTS `lichlamviec` (
  `MaLichLamViec` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayLamViec` date DEFAULT NULL,
  `LoaiNgay` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GioMoCua` time DEFAULT NULL,
  `GioDongCua` time DEFAULT NULL,
  `TrangThaiLamViec` tinyint(1) DEFAULT NULL,
  `GhiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaNhanVien` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaLichLamViec`),
  UNIQUE KEY `NgayLamViec` (`NgayLamViec`),
  KEY `FK_LichLamViec_NhanVien` (`MaNhanVien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lichlamviec`
--

INSERT INTO `lichlamviec` (`MaLichLamViec`, `NgayLamViec`, `LoaiNgay`, `GioMoCua`, `GioDongCua`, `TrangThaiLamViec`, `GhiChu`, `MaNhanVien`) VALUES
('LLV001', '2026-11-06', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV001'),
('LLV002', '2026-11-07', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Tăng cường phục vụ khách cuối tuần', 'NV002'),
('LLV003', '2026-11-08', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Làm việc theo lịch Studio', 'NV003'),
('LLV004', '2026-11-09', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Hỗ trợ tư vấn và tiếp nhận khách hàng', 'NV004'),
('LLV005', '2026-11-10', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Phụ trách chỉnh sửa ảnh', 'NV005'),
('LLV006', '2026-11-11', 'Ngày thường', '08:00:00', '20:00:00', 0, 'Nhân viên tạm ngưng hoạt động', 'NV006'),
('LLV007', '2026-11-12', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Phụ trách chụp ảnh theo lịch hẹn', 'NV007'),
('LLV008', '2026-11-13', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Phụ trách makeup và làm tóc', 'NV008'),
('LLV009', '2026-11-14', 'Cuối tuần', '08:00:00', '21:00:00', 0, 'Nhân viên tạm ngưng hoạt động', 'NV009'),
('LLV010', '2026-11-15', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Quản lý và điều phối hoạt động Studio', 'NV010'),
('LLV011', '2026-11-16', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Quản lý hoạt động chụp ảnh', 'NV011'),
('LLV012', '2026-11-17', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Quản lý nhân sự và lịch làm việc', 'NV012'),
('LLV013', '2026-11-18', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Quản lý dịch vụ và chất lượng Studio', 'NV013'),
('LLV014', '2026-11-19', 'Ngày thường', '08:00:00', '20:00:00', 0, 'Nhân viên tạm ngưng hoạt động', 'NV014'),
('LLV015', '2026-11-20', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Quản lý chung và kiểm tra hoạt động Studio', 'NV015'),
('LLV016', '2026-11-21', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV001'),
('LLV017', '2026-11-22', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV002'),
('LLV018', '2026-11-23', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV003'),
('LLV019', '2026-11-24', 'Ngày lễ', '08:00:00', '20:00:00', 0, 'Ngày Văn hóa Việt Nam - Studio nghỉ lễ', 'NV004'),
('LLV020', '2026-11-25', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV005'),
('LLV021', '2026-11-26', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV007'),
('LLV022', '2026-11-27', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV008'),
('LLV023', '2026-11-28', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV010'),
('LLV024', '2026-11-29', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV011'),
('LLV025', '2026-11-30', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV012'),
('LLV026', '2026-12-01', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV013'),
('LLV027', '2026-12-02', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV015'),
('LLV028', '2026-12-03', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV001'),
('LLV029', '2026-12-04', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV002'),
('LLV030', '2026-12-05', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV003'),
('LLV031', '2026-12-06', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV004'),
('LLV032', '2026-12-07', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV005'),
('LLV033', '2026-12-08', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV007'),
('LLV034', '2026-12-09', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV008'),
('LLV035', '2026-12-10', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV010'),
('LLV036', '2026-12-11', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV011'),
('LLV037', '2026-12-12', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV012'),
('LLV038', '2026-12-13', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV013'),
('LLV039', '2026-12-14', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV015'),
('LLV040', '2026-12-15', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV001'),
('LLV041', '2026-12-16', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV002'),
('LLV042', '2026-12-17', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV003'),
('LLV043', '2026-12-18', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV004'),
('LLV044', '2026-12-19', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV005'),
('LLV045', '2026-12-20', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV007'),
('LLV046', '2026-12-21', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV008'),
('LLV047', '2026-12-22', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV010'),
('LLV048', '2026-12-23', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV011'),
('LLV049', '2026-12-24', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV012'),
('LLV050', '2026-12-25', 'Ngày lễ', '08:00:00', '20:00:00', 1, 'Giáng Sinh - lịch hoạt động đặc biệt', 'NV013'),
('LLV051', '2026-12-26', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV015'),
('LLV052', '2026-12-27', 'Cuối tuần', '08:00:00', '21:00:00', 1, 'Lịch làm việc cuối tuần', 'NV001'),
('LLV053', '2026-12-28', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV002'),
('LLV054', '2026-12-29', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV003'),
('LLV055', '2026-12-30', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV004'),
('LLV056', '2026-12-31', 'Ngày thường', '08:00:00', '20:00:00', 1, 'Lịch làm việc bình thường', 'NV005');

-- --------------------------------------------------------

--
-- Table structure for table `lichsudatlich`
--

DROP TABLE IF EXISTS `lichsudatlich`;
CREATE TABLE IF NOT EXISTS `lichsudatlich` (
  `MaLichSuDatLich` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TrangThaiCu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThaiMoi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ThoiGianThaoTac` timestamp NULL DEFAULT NULL,
  `HanhDong` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LyDo` text COLLATE utf8mb4_unicode_ci,
  `GhiChu` text COLLATE utf8mb4_unicode_ci,
  `MaDatLich` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaLichSuDatLich`),
  KEY `FK_LichSuDatLich_DatLich` (`MaDatLich`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lichsudatlich`
--

INSERT INTO `lichsudatlich` (`MaLichSuDatLich`, `TrangThaiCu`, `TrangThaiMoi`, `ThoiGianThaoTac`, `HanhDong`, `LyDo`, `GhiChu`, `MaDatLich`) VALUES
('LS00000001', 'Chờ xác nhận', 'Đã xác nhận', '2026-10-26 20:20:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đáp ứng điều kiện của Studio', 'Đã xác nhận lịch chụp cho khách hàng', 'DL001'),
('LS00000002', NULL, 'Chờ xác nhận', '2026-10-26 20:30:00', 'Tạo yêu cầu đặt lịch', 'Khách hàng gửi yêu cầu đặt lịch', 'Đang chờ tư vấn thêm về concept', 'DL002'),
('LS00000003', 'Đã xác nhận', 'Đã hoàn thành', '2026-11-03 04:00:00', 'Hoàn thành lịch chụp', 'Buổi chụp đã được thực hiện thành công', 'Đã hoàn tất buổi chụp cho khách hàng', 'DL003'),
('LS00000004', 'Chờ xác nhận', 'Đã xác nhận', '2026-10-28 19:00:00', 'Xác nhận đặt lịch', 'Đã kiểm tra và xác nhận yêu cầu của khách hàng', 'Đã tiếp nhận yêu cầu chuẩn bị trang phục', 'DL004'),
('LS00000005', 'Đã xác nhận', 'Đã hủy', '2026-10-30 01:30:00', 'Hủy đặt lịch', 'Khách hàng thay đổi kế hoạch cá nhân', 'Đã hủy lịch theo yêu cầu khách hàng', 'DL005'),
('LS00000007', 'Chờ xác nhận', 'Đã xác nhận', '2026-10-29 18:30:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp ảnh cặp đôi', 'DL007'),
('LS00000008', 'Đã xác nhận', 'Đã hoàn thành', '2026-11-06 04:00:00', 'Hoàn thành lịch chụp', 'Buổi chụp đã hoàn tất', 'Đã hoàn thành và bàn giao ảnh cho khách', 'DL008'),
('LS00000009', 'Chờ xác nhận', 'Đã xác nhận', '2026-10-30 19:10:00', 'Xác nhận đặt lịch', 'Đã kiểm tra thông tin đặt lịch', 'Khách hàng lựa chọn concept hoa', 'DL009'),
('LS00000010', NULL, 'Chờ xác nhận', '2026-10-30 18:20:00', 'Tạo yêu cầu đặt lịch', 'Khách hàng gửi yêu cầu đặt lịch', 'Đang chờ Studio xác nhận', 'DL010'),
('LS00000011', 'Chờ xác nhận', 'Đã xác nhận', '2026-10-30 21:00:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp sinh nhật tuổi 18', 'DL011'),
('LS00000012', NULL, 'Chờ xác nhận', '2026-10-31 19:30:00', 'Tạo yêu cầu đặt lịch', 'Khách hàng gửi yêu cầu đặt lịch', 'Khách yêu cầu concept pastel', 'DL012'),
('LS00000013', 'Chờ xác nhận', 'Đã hủy', '2026-11-02 02:20:00', 'Hủy đặt lịch', 'Khách hàng không thể đến đúng lịch', 'Đã cập nhật trạng thái hủy lịch', 'DL013'),
('LS00000014', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-01 20:00:00', 'Xác nhận đặt lịch', 'Đã kiểm tra thông tin và xác nhận yêu cầu', 'Đã xác nhận lịch chụp cặp đôi phong cách Hàn Quốc', 'DL014'),
('LS00000015', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-02 19:30:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch hợp lệ', 'Đã xác nhận lịch chụp profile cá nhân', 'DL015'),
('LS00000016', NULL, 'Chờ xác nhận', '2026-11-02 20:00:00', 'Tạo yêu cầu đặt lịch', 'Khách hàng gửi yêu cầu đặt lịch', 'Khách hàng đang cân nhắc concept vintage', 'DL016'),
('LS00000017', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-03 18:45:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp kỷ niệm hai người', 'DL017'),
('LS00000018', 'Đã xác nhận', 'Đã hoàn thành', '2026-11-05 03:30:00', 'Hoàn thành lịch chụp', 'Buổi chụp đã hoàn thành', 'Đã hoàn tất buổi chụp cho khách hàng', 'DL018'),
('LS00000019', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-03 19:00:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp chân dung thời trang', 'DL019'),
('LS00000021', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-04 19:15:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp Tết áo dài', 'DL021'),
('LS00000022', 'Đã xác nhận', 'Đã hủy', '2026-11-05 00:00:00', 'Hủy đặt lịch', 'Khách hàng xin hủy lịch vì lý do cá nhân', 'Đã tiếp nhận yêu cầu hủy lịch', 'DL022'),
('LS00000023', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-04 20:20:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp cặp đôi phong cách retro', 'DL023'),
('LS00000025', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-05 19:00:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp chân dung Beauty', 'DL025'),
('LS00000026', 'Chờ xác nhận', 'Bị từ chối', '2026-11-04 18:30:00', 'Từ chối đặt lịch', 'Khung giờ không còn khả dụng', 'Đã thông báo lý do từ chối cho khách hàng', 'DL026'),
('LS00000027', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-05 20:15:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp concept hoa tulip', 'DL027'),
('LS00000028', NULL, 'Chờ xác nhận', '2026-11-05 22:40:00', 'Tạo yêu cầu đặt lịch', 'Khách hàng gửi yêu cầu đặt lịch', 'Khách muốn chụp ảnh phong cách học đường', 'DL028'),
('LS00000029', 'Chờ xác nhận', 'Đã xác nhận', '2026-11-05 21:00:00', 'Xác nhận đặt lịch', 'Yêu cầu đặt lịch đã được chấp thuận', 'Đã xác nhận lịch chụp kỷ niệm cặp đôi', 'DL029'),
('LS00000030', 'Đã xác nhận', 'Đã hoàn thành', '2026-11-06 04:00:00', 'Hoàn thành lịch chụp', 'Buổi chụp đã hoàn thành và bàn giao ảnh', 'Đã hoàn tất quá trình chụp và bàn giao sản phẩm', 'DL030'),
('LS00000032', 'Chờ thanh toán', 'Đã xác nhận', '2026-11-07 15:22:26', 'Duyệt', NULL, NULL, 'DL033'),
('LS00000033', 'Chờ thanh toán', 'Đã xác nhận', '2026-11-07 16:16:36', 'Duyệt', NULL, NULL, 'DL034'),
('LS00000035', 'Chờ thanh toán', 'Đã xác nhận', '2026-11-07 19:21:07', 'Duyệt', NULL, NULL, 'DL037'),
('LS00000036', 'Chờ thanh toán', 'Đã xác nhận', '2026-11-11 20:04:02', 'Duyệt', NULL, NULL, 'DL052'),
('LS00000037', 'Đã xác nhận', 'Đang yêu cầu đổi lịch', '2026-11-14 07:12:08', 'Thay đổi trạng thái', NULL, '| [YÊU CẦU ĐỔI LỊCH] Ngày mới: 2026-11-20, Khung giờ: KG007. Lý do: có việc bận', 'DL042'),
('LS00000039', 'Đang yêu cầu đổi lịch', 'Chấp nhận đổi lịch', '2026-11-14 07:29:39', 'Thay đổi trạng thái', NULL, '| [YÊU CẦU ĐỔI LỊCH] Ngày mới: 2026-11-20, Khung giờ: KG007. Lý do: có việc bận', 'DL042'),
('LS00000040', 'Đã xác nhận', 'Đang yêu cầu hủy', '2026-11-14 08:29:35', 'Thay đổi trạng thái', 'Không muốn chụp nữa', NULL, 'DL037'),
('LS00000042', 'Đang yêu cầu hủy', 'Đã hủy', '2026-11-14 08:30:03', 'Hủy', 'Không muốn chụp nữa', NULL, 'DL037'),
('LS00000043', 'Chờ thanh toán', 'Đã xác nhận', '2026-11-15 05:52:02', 'Duyệt', NULL, NULL, 'DL055'),
('LS00000044', 'Đã xác nhận', 'Đang yêu cầu đổi lịch', '2026-11-15 09:00:57', 'Thay đổi trạng thái', NULL, '| [YÊU CẦU ĐỔI LỊCH] Ngày mới: 2026-11-30, Khung giờ: KG003. Lý do: có việc bận, không chụp ngày đó được', 'DL055'),
('LS00000046', 'Đang yêu cầu đổi lịch', 'Chấp nhận đổi lịch', '2026-11-15 09:01:13', 'Thay đổi trạng thái', NULL, '| [YÊU CẦU ĐỔI LỊCH] Ngày mới: 2026-11-30, Khung giờ: KG003. Lý do: có việc bận, không chụp ngày đó được', 'DL055'),
('LS000038', 'Đã xác nhận', 'Đang yêu cầu đổi lịch', '2026-11-14 07:12:08', 'Yêu cầu đổi lịch', 'có việc bận', 'Khách hàng yêu cầu đổi sang ngày: 2026-11-20', 'DL042'),
('LS000041', 'Đã xác nhận', 'Đang yêu cầu hủy', '2026-11-14 08:29:35', 'Yêu cầu hủy lịch', 'Không muốn chụp nữa', 'Khách hàng gửi yêu cầu hủy lịch.', 'DL037'),
('LS000045', 'Đã xác nhận', 'Đang yêu cầu đổi lịch', '2026-11-15 09:00:57', 'Yêu cầu đổi lịch', 'có việc bận, không chụp ngày đó được', 'Khách hàng yêu cầu đổi sang ngày: 2026-11-30', 'DL055');

-- --------------------------------------------------------

--
-- Table structure for table `lichsuthanhtoan`
--

DROP TABLE IF EXISTS `lichsuthanhtoan`;
CREATE TABLE IF NOT EXISTS `lichsuthanhtoan` (
  `MaLichSuThanhToan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TrangThaiCu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThaiMoi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ThoiGianCapNhat` timestamp NULL DEFAULT NULL,
  `NoiDung` text COLLATE utf8mb4_unicode_ci,
  `MaThanhToan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaLichSuThanhToan`),
  KEY `FK_LichSuThanhToan_ThanhToan` (`MaThanhToan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lichsuthanhtoan`
--

INSERT INTO `lichsuthanhtoan` (`MaLichSuThanhToan`, `TrangThaiCu`, `TrangThaiMoi`, `ThoiGianCapNhat`, `NoiDung`, `MaThanhToan`) VALUES
('LSTT000001', NULL, 'Chờ xử lý', '2026-10-25 12:35:00', 'Khách hàng khởi tạo giao dịch chuyển khoản cọc', 'TT001'),
('LSTT000002', 'Chờ xử lý', 'Thành công', '2026-10-25 12:37:12', 'Hệ thống nhận thanh toán cọc thành công qua VietQR', 'TT001'),
('LSTT000003', NULL, 'Chờ xử lý', '2026-10-26 13:35:00', 'Tạo giao dịch đặt cọc chờ khách chuyển khoản', 'TT002'),
('LSTT000004', NULL, 'Thành công', '2026-10-26 17:36:45', 'Thanh toán cọc 500,000 VNĐ thành công', 'TT003'),
('LSTT000005', NULL, 'Thành công', '2026-11-02 21:00:00', 'Thu tiền mặt còn lại 3,590,000 VNĐ tại Studio', 'TT004'),
('LSTT000006', NULL, 'Thành công', '2026-10-27 12:05:55', 'Thanh toán cọc qua Ví MoMo thành công', 'TT005'),
('LSTT000007', NULL, 'Thành công', '2026-10-27 14:16:10', 'Thanh toán cọc thành công', 'TT006'),
('LSTT000008', 'Thành công', 'Đã hoàn tiền', '2026-10-29 18:30:00', 'Hoàn cọc 500,000 VNĐ cho khách do hủy lịch đúng quy định', 'TT006'),
('LSTT000011', NULL, 'Thành công', '2026-10-28 18:37:00', 'Nhận tiền cọc 1,000,000 VNĐ cho gói cặp đôi', 'TT008'),
('LSTT000012', NULL, 'Thành công', '2026-10-29 13:05:40', 'Thanh toán cọc qua ZaloPay thành công', 'TT009'),
('LSTT000013', NULL, 'Thành công', '2026-11-05 20:55:00', 'Chuyển khoản thanh toán phần còn lại 3,390,000 VNĐ', 'TT010'),
('LSTT000014', NULL, 'Thành công', '2026-10-29 17:36:10', 'Thanh toán cọc thành công qua Ví MoMo', 'TT011'),
('LSTT000015', NULL, 'Thành công', '2026-10-30 13:26:15', 'Nhận chuyển khoản cọc gói sinh nhật', 'TT012'),
('LSTT000016', NULL, 'Thành công', '2026-11-01 12:07:30', 'Thanh toán cọc 1,000,000 VNĐ thành công', 'TT013'),
('LSTT000017', NULL, 'Thành công', '2026-11-02 12:35:50', 'Thanh toán cọc qua MoMo', 'TT014'),
('LSTT000018', NULL, 'Thành công', '2026-11-04 20:30:00', 'Thu tiền mặt còn lại 2,740,000 VNĐ khi hoàn thành buổi chụp', 'TT015'),
('LSTT000019', NULL, 'Thành công', '2026-11-03 12:21:40', 'Thanh toán cọc thành công qua VietQR', 'TT016'),
('LSTT000020', NULL, 'Thành công', '2026-11-05 18:36:10', 'Thanh toán toàn bộ 100% giá trị hóa đơn', 'TT017'),
('LSTT000021', NULL, 'Chờ xử lý', '2026-11-08 07:37:16', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT020'),
('LSTT000022', 'Chờ xử lý', 'Thành công', '2026-11-08 07:37:22', 'Trang thai thanh toan thay doi tu Chờ xử lý sang Thành công', 'TT020'),
('LSTT000023', 'Chờ xử lý', 'Thành công', '2026-11-08 07:37:22', 'Thanh toán thành công 957,000 VNĐ qua Chuyển khoản QR', 'TT020'),
('LSTT000027', NULL, 'Chờ xử lý', '2026-11-09 15:26:12', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT022'),
('LSTT000028', NULL, 'Chờ xử lý', '2026-11-09 15:51:27', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT023'),
('LSTT000029', 'Chờ xử lý', 'Thành công', '2026-11-09 15:54:14', 'Trang thai thanh toan thay doi tu Chờ xử lý sang Thành công', 'TT023'),
('LSTT000030', 'Chờ xử lý', 'Thành công', '2026-11-09 15:54:14', 'Thanh toán thành công 807,000 VNĐ qua Chuyển khoản QR', 'TT023'),
('LSTT000031', NULL, 'Chờ xử lý', '2026-11-11 05:48:21', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT024'),
('LSTT000032', NULL, 'Chờ xử lý', '2026-11-11 05:55:17', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT025'),
('LSTT000033', NULL, 'Chờ xử lý', '2026-11-11 19:48:24', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT026'),
('LSTT000034', NULL, 'Chờ xử lý', '2026-11-11 19:53:55', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT027'),
('LSTT000035', NULL, 'Chờ xử lý', '2026-11-11 20:03:54', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT028'),
('LSTT000036', 'Chờ xử lý', 'Thành công', '2026-11-11 20:04:02', 'Trang thai thanh toan thay doi tu Chờ xử lý sang Thành công', 'TT028'),
('LSTT000037', NULL, 'Chờ xử lý', '2026-11-11 20:30:51', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT029'),
('LSTT000038', NULL, 'Chờ xử lý', '2026-11-12 06:31:01', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT030'),
('LSTT000039', NULL, 'Chờ xử lý', '2026-11-15 05:51:46', 'Khởi tạo giao dịch đặt cọc chờ thanh toán', 'TT031'),
('LSTT000040', 'Chờ xử lý', 'Thành công', '2026-11-15 05:52:02', 'Trang thai thanh toan thay doi tu Chờ xử lý sang Thành công', 'TT031');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `MaNhanVien` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HoTen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SoDienThoai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaChi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ChucVu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT NULL,
  `MaTaiKhoan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaNhanVien`),
  UNIQUE KEY `SoDienThoai` (`SoDienThoai`),
  UNIQUE KEY `Email` (`Email`),
  KEY `FK_NhanVien_TaiKhoan` (`MaTaiKhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `HoTen`, `NgaySinh`, `GioiTinh`, `SoDienThoai`, `Email`, `DiaChi`, `ChucVu`, `TrangThai`, `MaTaiKhoan`) VALUES
('NV001', 'Nguyen Thanh Phuc', '1995-03-12', 'Nam', '0912345601', 'nguyenthanhphuc@gmail.com', 'Quan 1, TP.HCM', 'Nhiếp ảnh gia', 1, 'TK036'),
('NV002', 'Tran Minh Thu', '1997-07-25', 'Nu', '0912345602', 'tranminhthu@gmail.com', 'Quan 3, TP.HCM', 'Chuyên viên trang điểm', 1, 'TK037'),
('NV003', 'Le Quoc Bao', '1993-11-08', 'Nam', '0912345603', 'lequocbao@gmail.com', 'Quan 5, TP.HCM', 'Nhiếp ảnh gia', 1, 'TK038'),
('NV004', 'Pham Ngoc Mai', '1998-01-19', 'Nu', '0912345604', 'phamngocmai@gmail.com', 'Quan 7, TP.HCM', 'Nhân viên tư vấn', 1, 'TK039'),
('NV005', 'Vo Hoang Nam', '1994-05-30', 'Nam', '0912345605', 'vohoangnam@gmail.com', 'Quan Binh Thanh, TP.HCM', 'Chuyên viên chỉnh sửa ảnh', 1, 'TK040'),
('NV006', 'Dang Thi Kim Ngan', '1996-09-14', 'Nu', '0912345606', 'dangthikimngan@gmail.com', 'Quan Go Vap, TP.HCM', 'Nhân viên lễ tân', 0, 'TK041'),
('NV007', 'Bui Minh Tuan', '1992-04-22', 'Nam', '0912345607', 'buiminhtuan@gmail.com', 'Quan Tan Binh, TP.HCM', 'Nhiếp ảnh gia', 1, 'TK042'),
('NV008', 'Hoang Thu Trang', '1999-12-03', 'Nu', '0912345608', 'hoangthutrang@gmail.com', 'Quan Phu Nhuan, TP.HCM', 'Chuyên viên trang điểm', 1, 'TK043'),
('NV009', 'Do Thanh Khoa', '1995-06-17', 'Nam', '0912345609', 'dothanhkhoa@gmail.com', 'Quan 10, TP.HCM', 'Nhân viên tư vấn', 0, 'TK044'),
('NV010', 'Ngo Bao Tram', '2000-02-11', 'Nu', '0912345610', 'ngobaotram@gmail.com', 'TP. Thu Duc, TP.HCM', 'Quản lý Studio', 1, 'TK045'),
('NV011', 'Nguyen Hoang Minh', '1988-04-15', 'Nam', '0912345611', 'nguyenhoangminh@gmail.com', 'Quan 1, TP.HCM', 'Quản lý Studio', 1, 'TK046'),
('NV012', 'Tran Thi Thanh Huyen', '1990-08-21', 'Nu', '0912345612', 'tranthithanhhuyen@gmail.com', 'Quan 3, TP.HCM', 'Quản lý Studio', 1, 'TK047'),
('NV013', 'Le Minh Hoang', '1987-12-09', 'Nam', '0912345613', 'leminhhoang@gmail.com', 'Quan Binh Thanh, TP.HCM', 'Quản lý Studio', 1, 'TK048'),
('NV014', 'Pham Ngoc Lan', '1992-02-18', 'Nu', '0912345614', 'phamngoclan@gmail.com', 'Quan Phu Nhuan, TP.HCM', 'Quản lý Studio', 0, 'TK049'),
('NV015', 'Vo Thanh Tung', '1989-06-27', 'Nam', '0912345615', 'vothanhtung@gmail.com', 'TP. Thu Duc, TP.HCM', 'Quản lý Studio', 1, 'TK050');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

DROP TABLE IF EXISTS `taikhoan`;
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `MaTaiKhoan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenDangNhap` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MatKhau` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThaiHoatDong` tinyint(1) DEFAULT NULL,
  `NgayTao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `LanDangNhapCuoi` timestamp NULL DEFAULT NULL,
  `MaVaiTro` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaTaiKhoan`),
  UNIQUE KEY `TenDangNhap` (`TenDangNhap`),
  KEY `FK_TaiKhoan_VaiTro` (`MaVaiTro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`MaTaiKhoan`, `TenDangNhap`, `MatKhau`, `TrangThaiHoatDong`, `NgayTao`, `LanDangNhapCuoi`, `MaVaiTro`) VALUES
('TK001', 'nguyenvanan', 'An@K9mP2x!', 1, '2023-02-15 01:20:00', '2026-11-11 18:17:13', 'VT001'),
('TK002', 'tranthibinh', 'Binh#7Qw3Lm', 1, '2024-06-21 03:15:00', '2026-10-28 07:25:00', 'VT001'),
('TK003', 'lehoangnam', 'Cuong$5Rt8Yp', 1, '2022-11-08 07:30:00', '2026-09-15 09:40:00', 'VT001'),
('TK004', 'phamngocanh', 'Thao@2Mn6Kx', 1, '2025-01-17 02:45:00', '2026-11-01 02:15:00', 'VT001'),
('TK005', 'vominhkhang', 'Huy#8Lp4Vz', 1, '2023-09-12 06:10:00', '2026-08-20 03:20:00', 'VT001'),
('TK006', 'dangthuha', 'Lan$3Xc7Qm', 1, '2024-03-05 08:20:00', '2026-10-12 04:35:00', 'VT001'),
('TK007', 'buiquocbao', 'Nam@6Pk2Rt', 0, '2021-12-19 01:40:00', '2025-12-30 08:10:00', 'VT001'),
('TK008', 'hoangmailinh', 'Mai#4Wn9Ls', 1, '2025-07-23 04:25:00', '2026-11-02 01:45:00', 'VT001'),
('TK009', 'dothanhtung', 'Son$7Jk3Xp', 1, '2022-05-14 09:10:00', '2026-07-18 06:30:00', 'VT001'),
('TK010', 'ngokhanhvy', 'Anh@9Vr5Mq', 1, '2024-10-30 02:00:00', '2026-11-04 02:20:00', 'VT001'),
('TK011', 'duonggiahuy', 'Duc#2Qp8Yn', 0, '2023-04-09 03:35:00', '2026-03-29 02:40:00', 'VT001'),
('TK012', 'lythanhtruc', 'Huong$6Lm4Kt', 1, '2025-03-18 07:45:00', '2026-10-01 07:15:00', 'VT001'),
('TK013', 'trinhducthinh', 'Long@5Xz7Pw', 1, '2022-08-27 01:55:00', '2026-11-03 03:10:00', 'VT001'),
('TK014', 'maiphuongthao', 'Duong#8Nc3Rs', 0, '2024-12-11 06:30:00', '2025-11-21 09:50:00', 'VT001'),
('TK015', 'caotuankiet', 'Quan$4Tk9Lp', 1, '2021-06-03 02:20:00', '2026-10-25 04:25:00', 'VT001'),
('TK016', 'dinhngochan', 'Ngan@7Wp2Mx', 1, '2025-09-16 08:40:00', '2026-11-04 06:45:00', 'VT001'),
('TK017', 'taminhquan', 'Phuc#3Yr6Kq', 0, '2023-07-25 04:10:00', '2026-01-28 08:30:00', 'VT001'),
('TK018', 'truongbaongoc', 'Hanh$9Lm5Vx', 1, '2022-01-19 01:15:00', '2026-09-02 03:45:00', 'VT001'),
('TK019', 'phanthanhphong', 'Tung@4Qz8Np', 1, '2024-04-22 07:20:00', '2026-11-02 08:20:00', 'VT001'),
('TK020', 'huynhkimngan', 'Diep#6Xk2Rw', 0, '2025-05-07 03:50:00', '2025-10-30 01:55:00', 'VT001'),
('TK021', 'nguyenduclong', 'Quang$8Pm3Yt', 1, '2021-10-13 09:25:00', '2026-10-03 09:10:00', 'VT001'),
('TK022', 'tranngocdiep', 'Trang@5Nk7Ls', 1, '2023-12-02 02:35:00', '2026-08-11 02:30:00', 'VT001'),
('TK023', 'letuananh', 'Tri#9Wq4Kp', 1, '2024-08-19 06:45:00', '2026-11-04 05:40:00', 'VT001'),
('TK024', 'phamthimyduyen', 'Truc$2Jm8Xn', 0, '2022-03-28 04:30:00', '2025-07-27 07:50:00', 'VT001'),
('TK025', 'vothanhdat', 'Bao@7Lp3Vz', 1, '2025-02-09 01:50:00', '2026-09-22 04:15:00', 'VT001'),
('TK026', 'dangngocthuy', 'Hai#4Rt9Qm', 1, '2023-05-16 08:15:00', '2026-11-01 01:50:00', 'VT001'),
('TK027', 'buiminhtri', 'Dat$6Xc2Pw', 0, '2021-09-24 03:40:00', '2026-02-15 03:25:00', 'VT001'),
('TK028', 'hoangyennhi', 'Thao@8Mn5Kq', 1, '2024-01-12 07:05:00', '2026-10-19 06:55:00', 'VT001'),
('TK029', 'doquanghieu', 'Viet#3Pk7Ls', 1, '2025-06-28 02:25:00', '2026-11-04 07:30:00', 'VT001'),
('TK030', 'ngothuytien', 'Ha$9Vr4Yp', 0, '2022-10-06 06:55:00', '2025-09-29 09:15:00', 'VT001'),
('TK031', 'duonghoainam', 'Mai@2Qw6Rt', 1, '2023-03-11 01:35:00', '2026-07-12 02:50:00', 'VT001'),
('TK032', 'lybaotram', 'Manh#5Lm8Xp', 1, '2024-11-25 09:20:00', '2026-11-03 03:35:00', 'VT001'),
('TK033', 'trinhminhduc', 'Thuy$7Nk3Vz', 0, '2021-04-17 03:10:00', '2025-05-30 06:20:00', 'VT001'),
('TK034', 'maithanhtam', 'Khoi@4Wp9Yq', 1, '2025-08-04 07:50:00', '2026-10-14 08:45:00', 'VT001'),
('TK035', 'caominhchau', 'Van#8Xr2Km', 1, '2022-07-29 02:15:00', '2026-11-04 10:10:00', 'VT001'),
('TK036', 'nguyenthanhphuc', 'Phong@6Lm3Qx', 1, '2023-01-23 01:45:00', '2026-11-04 01:10:00', 'VT002'),
('TK037', 'tranminhthu', 'Nhu#4Pk8Vz', 1, '2024-05-13 04:20:00', '2026-10-23 02:25:00', 'VT002'),
('TK038', 'lequocbao', 'Quyet$7Rt2Mn', 0, '2022-12-07 08:35:00', '2026-08-02 03:40:00', 'VT002'),
('TK039', 'phamngocmai', 'Dat@9Xk5Lp', 1, '2025-04-26 02:40:00', '2026-11-15 07:21:14', 'VT002'),
('TK040', 'vohoangnam', 'Yen#3Wq7Km', 0, '2023-10-18 06:25:00', '2025-12-17 06:15:00', 'VT002'),
('TK041', 'dangthikimngan', 'Nhat$5Jm8Xr', 1, '2021-08-09 03:55:00', '2026-10-30 07:20:00', 'VT002'),
('TK042', 'buiminhtuan', 'Trung@2Qp6Vz', 0, '2024-02-14 07:15:00', '2026-04-11 08:35:00', 'VT002'),
('TK043', 'hoangthutrang', 'Yen#8Nk4Ls', 1, '2025-10-03 01:30:00', '2026-11-15 07:20:30', 'VT002'),
('TK044', 'dothanhkhoa', 'Khoa$6Vr9Pw', 0, '2022-04-20 09:45:00', '2026-11-10 03:52:23', 'VT002'),
('TK045', 'ngobaotram', 'Tam@3Xz7Qm', 1, '2023-06-30 02:50:00', '2026-10-02 07:55:00', 'VT003'),
('TK046', 'nguyenhoangminh', 'Minh#7Lp2Yx', 1, '2021-11-16 03:25:00', '2026-11-04 00:50:00', 'VT003'),
('TK047', 'tranthithanhhuyen', 'Son$4Qw9Km', 1, '2024-07-08 06:40:00', '2026-11-10 03:44:51', 'VT003'),
('TK048', 'leminhhoang', 'Nam@8Rt5Vz', 0, '2022-09-21 01:55:00', '2026-05-22 02:20:00', 'VT003'),
('TK049', 'phamngoclan', 'Ha#6Xk3Lp', 1, '2025-01-29 08:10:00', '2026-11-04 03:55:00', 'VT003'),
('TK050', 'vothanhtung', 'Bao$2Mn7Qp', 0, '2023-08-12 04:35:00', '2025-11-01 04:40:00', 'VT003'),
('TK051', 'thanhtien', 'Abcd@1234', 1, '2026-11-07 10:18:02', '2026-11-15 08:47:04', 'VT001'),
('TK052', 'TT', '1234@Abcd', 1, '2026-11-07 18:27:14', '2026-11-15 08:46:52', 'VT002');

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

DROP TABLE IF EXISTS `thanhtoan`;
CREATE TABLE IF NOT EXISTS `thanhtoan` (
  `MaThanhToan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoTien` decimal(12,2) DEFAULT NULL,
  `LoaiThanhToan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PhuongThuc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianThanhToan` timestamp NULL DEFAULT NULL,
  `MaGiaoDich` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NgayCapNhat` timestamp NULL DEFAULT NULL,
  `SoTienHoan` decimal(12,2) DEFAULT NULL,
  `LyDoHoan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaHoaDon` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaThanhToan`),
  UNIQUE KEY `MaGiaoDich` (`MaGiaoDich`),
  KEY `FK_ThanhToan_HoaDon` (`MaHoaDon`)
) ;

--
-- Dumping data for table `thanhtoan`
--

INSERT INTO `thanhtoan` (`MaThanhToan`, `SoTien`, `LoaiThanhToan`, `PhuongThuc`, `TrangThai`, `ThoiGianTao`, `ThoiGianThanhToan`, `MaGiaoDich`, `NgayCapNhat`, `SoTienHoan`, `LyDoHoan`, `MaHoaDon`) VALUES
('TT001', 500000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-10-31 19:35:00', '2026-10-31 19:37:12', 'GD20261101001', '2026-10-31 19:37:12', NULL, NULL, 'HD001'),
('TT002', 1000000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Chờ xử lý', '2026-11-01 20:35:00', NULL, 'GD20261102002', '2026-11-01 20:35:00', NULL, NULL, 'HD002'),
('TT003', 500000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-11-02 00:35:00', '2026-11-02 00:36:45', 'GD20261102003', '2026-11-02 00:36:45', NULL, NULL, 'HD003'),
('TT004', 3590000.00, 'Thanh toán còn lại', 'Tiền mặt', 'Thành công', '2026-11-18 03:50:00', '2026-11-18 04:00:00', 'GD20261118004', '2026-11-18 04:00:00', NULL, NULL, 'HD003'),
('TT005', 500000.00, 'Đặt cọc', 'Ví MoMo', 'Thành công', '2026-11-02 19:05:00', '2026-11-02 19:05:55', 'GD20261103005', '2026-11-02 19:05:55', NULL, NULL, 'HD004'),
('TT006', 500000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Đã hoàn tiền', '2026-11-02 21:15:00', '2026-11-02 21:16:10', 'GD20261103006', '2026-11-05 01:30:00', 500000.00, 'Khách hủy lịch chụp theo chính sách studio', 'HD005'),
('TT008', 1000000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-11-04 01:35:00', '2026-11-04 01:37:00', 'GD20261104008', '2026-11-04 01:37:00', NULL, NULL, 'HD007'),
('TT009', 500000.00, 'Đặt cọc', 'Thẻ ZaloPay', 'Thành công', '2026-11-04 20:05:00', '2026-11-04 20:05:40', 'GD20261105009', '2026-11-04 20:05:40', NULL, NULL, 'HD008'),
('TT010', 3390000.00, 'Thanh toán còn lại', 'Chuyển khoản QR', 'Thành công', '2026-11-21 03:45:00', '2026-11-21 03:55:00', 'GD20261121010', '2026-11-21 03:55:00', NULL, NULL, 'HD008'),
('TT011', 500000.00, 'Đặt cọc', 'Ví MoMo', 'Thành công', '2026-11-05 00:35:00', '2026-11-05 00:36:10', 'GD20261105011', '2026-11-05 00:36:10', NULL, NULL, 'HD009'),
('TT012', 500000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-11-05 20:25:00', '2026-11-05 20:26:15', 'GD20261106012', '2026-11-05 20:26:15', NULL, NULL, 'HD011'),
('TT013', 1000000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-11-07 19:05:00', '2026-11-07 19:07:30', 'GD20261108013', '2026-11-07 19:07:30', NULL, NULL, 'HD014'),
('TT014', 500000.00, 'Đặt cọc', 'Ví MoMo', 'Thành công', '2026-11-09 19:35:00', '2026-11-09 19:35:50', 'GD20261110014', '2026-11-09 19:35:50', NULL, NULL, 'HD018'),
('TT015', 2740000.00, 'Thanh toán còn lại', 'Tiền mặt', 'Thành công', '2026-11-16 03:20:00', '2026-11-16 03:30:00', 'GD20261116015', '2026-11-16 03:30:00', NULL, NULL, 'HD018'),
('TT016', 1000000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-11-12 19:20:00', '2026-11-12 19:21:40', 'GD20261113016', '2026-11-12 19:21:40', NULL, NULL, 'HD023'),
('TT017', 2990000.00, 'Thanh toán toàn bộ', 'Chuyển khoản QR', 'Thành công', '2026-11-16 01:35:00', '2026-11-16 01:36:10', 'GD20261116017', '2026-11-16 01:36:10', NULL, NULL, 'HD030'),
('TT019', 4490000.00, 'Thanh toán toàn bộ', 'Ví MoMo', 'Thành công', '2026-11-07 15:22:26', NULL, 'GD20261107222226919', '2026-11-07 15:22:26', NULL, NULL, 'HD017'),
('TT020', 957000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-11-08 07:37:16', '2026-11-08 07:37:22', 'GD20261108143716295', '2026-11-08 07:37:22', NULL, NULL, 'HD031'),
('TT022', 1665000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Chờ xử lý', '2026-11-09 15:26:12', NULL, 'GD20261109222612301', '2026-11-09 15:26:12', NULL, NULL, 'HD033'),
('TT023', 807000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-11-09 15:51:27', '2026-11-09 15:54:14', 'GD20261109225127940', '2026-11-09 15:54:14', NULL, NULL, 'HD034'),
('TT024', 1062000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Chờ xử lý', '2026-11-11 05:48:21', NULL, 'GD20261111124821303', '2026-11-11 05:48:21', NULL, NULL, 'HD035'),
('TT025', 957000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Chờ xử lý', '2026-11-11 05:55:17', NULL, 'GD20261111125517870', '2026-11-11 05:55:17', NULL, NULL, 'HD036'),
('TT026', 957000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Chờ xử lý', '2026-11-11 19:48:24', NULL, 'GD20261112024824', '2026-11-11 19:48:24', NULL, NULL, 'HD042'),
('TT027', 957000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Chờ xử lý', '2026-11-11 19:53:55', NULL, 'GD20261112025355', '2026-11-11 19:53:55', NULL, NULL, 'HD043'),
('TT028', 2690000.00, 'Thanh toán toàn bộ', 'Chuyển khoản QR', 'Thành công', '2026-11-11 20:03:54', '2026-11-11 20:04:02', 'GD20261112030354', '2026-11-11 20:04:02', NULL, NULL, 'HD044'),
('TT029', 957000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Chờ xử lý', '2026-11-11 20:30:51', NULL, 'GD20261112033051', '2026-11-11 20:30:51', NULL, NULL, 'HD045'),
('TT030', 1017000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Chờ xử lý', '2026-11-12 06:31:01', NULL, 'GD20261112133101', '2026-11-12 06:31:01', NULL, NULL, 'HD046'),
('TT031', 897000.00, 'Đặt cọc', 'Chuyển khoản QR', 'Thành công', '2026-11-15 05:51:46', '2026-11-15 05:52:02', 'GD20261115125146', '2026-11-15 05:52:02', NULL, NULL, 'HD047');

--
-- Triggers `thanhtoan`
--
DROP TRIGGER IF EXISTS `TRG_ThanhToan_KiemTra_Insert`;
DELIMITER $$
CREATE TRIGGER `TRG_ThanhToan_KiemTra_Insert` BEFORE INSERT ON `thanhtoan` FOR EACH ROW BEGIN
    DECLARE V_TongTienPhaiTra DECIMAL(12,2);
    DECLARE V_TongDaThanhToan DECIMAL(12,2);

    IF NEW.TrangThai = 'Thành công' THEN

        SELECT TongTienPhaiTra
        INTO V_TongTienPhaiTra
        FROM HoaDon
        WHERE MaHoaDon = NEW.MaHoaDon;

        SELECT COALESCE(SUM(SoTien), 0)
        INTO V_TongDaThanhToan
        FROM ThanhToan
        WHERE MaHoaDon = NEW.MaHoaDon
          AND TrangThai = 'Thành công';

        IF V_TongDaThanhToan + NEW.SoTien > V_TongTienPhaiTra THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT =
                'Tong tien thanh toan vuot qua tong tien phai tra!';
        END IF;

    END IF;

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `TRG_ThanhToan_KiemTra_Update`;
DELIMITER $$
CREATE TRIGGER `TRG_ThanhToan_KiemTra_Update` BEFORE UPDATE ON `thanhtoan` FOR EACH ROW BEGIN
    DECLARE V_TongTienPhaiTra DECIMAL(12,2);
    DECLARE V_TongDaThanhToan DECIMAL(12,2);

    IF NEW.TrangThai = 'Thành công' THEN

        SELECT TongTienPhaiTra
        INTO V_TongTienPhaiTra
        FROM HoaDon
        WHERE MaHoaDon = NEW.MaHoaDon;

        SELECT COALESCE(SUM(SoTien), 0)
        INTO V_TongDaThanhToan
        FROM ThanhToan
        WHERE MaHoaDon = NEW.MaHoaDon
          AND TrangThai = 'Thành công'
          AND MaThanhToan <> OLD.MaThanhToan;

        IF V_TongDaThanhToan + NEW.SoTien > V_TongTienPhaiTra THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT =
                'Tong tien thanh toan vuot qua tong tien phai tra!';
        END IF;

    END IF;

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `TRG_ThanhToan_LuuNhatKy`;
DELIMITER $$
CREATE TRIGGER `TRG_ThanhToan_LuuNhatKy` AFTER UPDATE ON `thanhtoan` FOR EACH ROW BEGIN
    DECLARE V_STT BIGINT DEFAULT 0;

    -- Chỉ ghi lịch sử khi trạng thái thực sự thay đổi
    IF NOT (OLD.TrangThai <=> NEW.TrangThai) THEN

        -- Lấy số thứ tự lớn nhất, không dùng COUNT(*) + 1
        SELECT COALESCE(
            MAX(CAST(SUBSTRING(MaLichSuThanhToan, 5) AS UNSIGNED)),
            0
        ) + 1
        INTO V_STT
        FROM lichsuthanhtoan;

        INSERT INTO lichsuthanhtoan (
            MaLichSuThanhToan,
            TrangThaiCu,
            TrangThaiMoi,
            ThoiGianCapNhat,
            NoiDung,
            MaThanhToan
        )
        VALUES (
            CONCAT('LSTT', LPAD(V_STT, 6, '0')),
            OLD.TrangThai,
            NEW.TrangThai,
            CURRENT_TIMESTAMP,
            CONCAT(
                'Trang thai thanh toan thay doi tu ',
                COALESCE(OLD.TrangThai, 'NULL'),
                ' sang ',
                COALESCE(NEW.TrangThai, 'NULL')
            ),
            NEW.MaThanhToan
        );

    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `thongbao`
--

DROP TABLE IF EXISTS `thongbao`;
CREATE TABLE IF NOT EXISTS `thongbao` (
  `MaThongBao` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaKhachHang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TieuDe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NoiDung` text COLLATE utf8mb4_unicode_ci,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `TrangThaiDoc` tinyint(1) DEFAULT NULL,
  `MaTaiKhoan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaDatLich` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaThongBao`),
  KEY `FK_ThongBao_TaiKhoan` (`MaTaiKhoan`),
  KEY `FK_ThongBao_DatLich` (`MaDatLich`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thongbao`
--

INSERT INTO `thongbao` (`MaThongBao`, `MaKhachHang`, `TieuDe`, `NoiDung`, `ThoiGianTao`, `TrangThaiDoc`, `MaTaiKhoan`, `MaDatLich`) VALUES
('TB001', NULL, 'Xác nhận đặt lịch thành công', 'Lịch chụp DL001 (Concept Chân Dung Nàng Thơ) đã được xác nhận cho ngày 03/11/2026.', '2026-10-26 13:20:00', 1, 'TK001', 'DL001'),
('TB002', NULL, 'Thanh toán cọc thành công', 'Hệ thống đã ghi nhận khoản tiền cọc 500,000 VNĐ cho hóa đơn HD001.', '2026-10-25 12:37:12', 1, 'TK001', 'DL001'),
('TB003', NULL, 'Yêu cầu đặt lịch đang chờ xác nhận', 'Yêu cầu đặt lịch DL002 của bạn đã được tiếp nhận và đang chờ Studio phản hồi.', '2026-10-26 13:30:00', 0, 'TK002', 'DL002'),
('TB004', NULL, 'Hoàn tất buổi chụp ảnh', 'Cảm ơn bạn đã sử dụng dịch vụ! Sản phẩm ảnh của lịch chụp DL003 đã hoàn thành.', '2026-11-02 21:00:00', 1, 'TK003', 'DL003'),
('TB005', NULL, 'Xác nhận đặt lịch thành công', 'Lịch chụp DL004 đã được Studio xác nhận. Vui lòng kiểm tra lại yêu cầu chuẩn bị trang phục.', '2026-10-28 12:00:00', 1, 'TK004', 'DL004'),
('TB006', NULL, 'Thông báo hủy lịch chụp', 'Lịch chụp DL005 của bạn đã được hủy thành công theo yêu cầu.', '2026-10-29 18:30:00', 1, 'TK005', 'DL005'),
('TB007', NULL, 'Thông báo hoàn tiền cọc', 'Khoản cọc 500,000 VNĐ cho đơn hàng HD005 đã được hoàn lại tài khoản của bạn.', '2026-10-29 18:35:00', 0, 'TK005', 'DL005'),
('TB009', NULL, 'Xác nhận đặt lịch cặp đôi', 'Lịch chụp DL007 (Concept Cặp Đôi Vintage) đã được duyệt.', '2026-10-29 11:30:00', 1, 'TK007', 'DL007'),
('TB010', NULL, 'Bàn giao ảnh thành công', 'Bộ ảnh chỉnh sửa hoàn thiện cho lịch DL008 đã được gửi đến bạn.', '2026-11-05 21:00:00', 1, 'TK008', 'DL008'),
('TB011', NULL, 'Yêu cầu đặt lịch mới', 'Có lịch đặt mới DL002 từ khách hàng Trần Thị Bình cần tư vấn thêm.', '2026-10-26 13:30:00', 1, 'TK039', 'DL002'),
('TB013', NULL, 'Lịch chụp mới được phân công', 'Bạn được phân công phụ trách lịch chụp DL001 ngày 03/11/2026.', '2026-10-26 13:20:00', 1, 'TK036', 'DL001'),
('TB014', NULL, 'Nhắc nhở buổi chụp hôm nay', 'Bạn có lịch chụp DL003 vào lúc 10:00 hôm nay.', '2026-11-01 17:00:00', 1, 'TK036', 'DL003'),
('TB015', NULL, 'Cảnh báo khung giờ bị từ chối', 'Lịch chụp DL026 đã bị hệ thống từ chối do trùng/quá sức chứa khung giờ.', '2026-11-04 11:30:00', 0, 'TK045', 'DL026'),
('TB016', NULL, 'Báo cáo doanh thu mới', 'Hóa đơn HD008 vừa hoàn tất thanh toán phần còn lại 3,390,000 VNĐ.', '2026-11-05 20:55:00', 1, 'TK045', NULL),
('TB017', NULL, 'Ưu đãi sinh nhật từ Studio', 'Chúc mừng sinh nhật! Sử dụng mã BIRTHDAY20 để nhận ưu đãi 20% cho buổi chụp tiếp theo.', '2026-10-25 10:00:00', 0, 'TK004', NULL),
('TB018', NULL, 'Ưu đãi sinh nhật từ Studio', 'Chúc mừng sinh nhật! Sử dụng mã BIRTHDAY20 để nhận ưu đãi 20% cho buổi chụp tiếp theo.', '2026-10-25 10:00:00', 0, 'TK010', NULL),
('TB019', NULL, 'Lịch chụp bị từ chối', 'Lịch chụp DL026 không thể xác nhận do khung giờ chọn đã hết chỗ. Vui lòng chọn khung giờ khác.', '2026-11-04 11:30:00', 1, 'TK026', 'DL026'),
('TB020', NULL, 'Thanh toán hoàn tất', 'Bạn đã thanh toán toàn bộ 100% giá trị hóa đơn HD030. Cảm ơn bạn!', '2026-11-05 18:36:10', 1, 'TK030', 'DL030'),
('TB021', 'KH037', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL039 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-08 07:37:16', 0, 'TK052', 'DL039'),
('TB022', 'KH037', 'Xác nhận thanh toán thành công', 'Hệ thống đã ghi nhận thanh toán thành công cho đơn hàng DL039 (Hóa đơn: HD031).', '2026-11-08 07:37:22', 0, 'TK052', 'DL039'),
('TB023', 'KH037', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL040 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-08 17:09:20', 0, 'TK052', 'DL040'),
('TB024', 'KH037', 'Xác nhận thanh toán thành công', 'Hệ thống đã ghi nhận thanh toán thành công cho đơn hàng DL040 (Hóa đơn: HD032).', '2026-11-08 17:16:16', 0, 'TK052', 'DL040'),
('TB025', 'KH037', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL041 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-09 15:26:12', 1, 'TK052', 'DL041'),
('TB026', 'KH037', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL042 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-09 15:51:27', 1, 'TK052', 'DL042'),
('TB027', 'KH037', 'Xác nhận thanh toán thành công', 'Hệ thống đã ghi nhận thanh toán thành công cho đơn hàng DL042 (Hóa đơn: HD034).', '2026-11-09 15:54:14', 1, 'TK052', 'DL042'),
('TB028', 'KH001', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL043 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 05:48:21', 0, 'TK001', 'DL043'),
('TB029', 'KH001', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL044 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 05:55:17', 0, 'TK001', 'DL044'),
('TB030', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL045 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 18:52:02', 0, 'TK051', 'DL045'),
('TB031', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL046 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 19:07:47', 0, 'TK051', 'DL046'),
('TB032', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL047 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 19:15:43', 0, 'TK051', 'DL047'),
('TB033', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL048 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 19:22:44', 0, 'TK051', 'DL048'),
('TB034', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL049 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 19:42:55', 0, 'TK051', 'DL049'),
('TB035', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL050 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 19:48:24', 0, 'TK051', 'DL050'),
('TB036', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL051 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 19:53:55', 0, 'TK051', 'DL051'),
('TB037', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL052 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 20:03:54', 0, 'TK051', 'DL052'),
('TB038', 'KH036', 'Xác nhận thanh toán thành công', 'Hệ thống đã ghi nhận thanh toán thành công cho đơn hàng DL052 (Hóa đơn: HD044).', '2026-11-11 20:04:02', 0, 'TK051', 'DL052'),
('TB039', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL053 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-11 20:30:51', 0, 'TK051', 'DL053'),
('TB040', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL054 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-12 06:31:01', 0, 'TK051', 'DL054'),
('TB041', 'KH036', 'Đơn đặt lịch mới đang chờ thanh toán', 'Đơn đặt lịch DL055 đã được tạo. Vui lòng hoàn tất thanh toán để xác nhận.', '2026-11-15 05:51:46', 1, 'TK051', 'DL055'),
('TB042', 'KH036', 'Xác nhận thanh toán thành công', 'Hệ thống đã ghi nhận thanh toán thành công cho đơn hàng DL055 (Hóa đơn: HD047).', '2026-11-15 05:52:02', 1, 'TK051', 'DL055');

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

DROP TABLE IF EXISTS `vaitro`;
CREATE TABLE IF NOT EXISTS `vaitro` (
  `MaVaiTro` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenVaiTro` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MoTa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaVaiTro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vaitro`
--

INSERT INTO `vaitro` (`MaVaiTro`, `TenVaiTro`, `MoTa`) VALUES
('VT001', 'Khách hàng', 'Người sử dụng hệ thống để đăng ký tài khoản, quản lý thông tin cá nhân, xem dịch vụ và đặt lịch chụp ảnh tại Studio.'),
('VT002', 'Nhân viên', 'Nhân viên Studio có quyền quản lý lịch làm việc, theo dõi lịch đặt chụp, cập nhật trạng thái đặt lịch và hỗ trợ khách hàng.'),
('VT003', 'Quản lý', 'Người quản lý toàn bộ hoạt động của Studio, bao gồm quản lý tài khoản, nhân viên, khách hàng, dịch vụ, lịch chụp, hóa đơn và thanh toán.');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

DROP TABLE IF EXISTS `voucher`;
CREATE TABLE IF NOT EXISTS `voucher` (
  `MaVoucher` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenVoucher` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaCode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LoaiGiamGia` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GiaTriGiam` decimal(12,2) DEFAULT NULL,
  `GiamToiDa` decimal(12,2) DEFAULT NULL,
  `DonToiThieu` decimal(12,2) DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `SoLuotSuDungToiDa` int DEFAULT NULL,
  `SoLuotDaSuDung` int DEFAULT NULL,
  `TrangThai` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MaVoucher`),
  UNIQUE KEY `MaCode` (`MaCode`)
) ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`MaVoucher`, `TenVoucher`, `MaCode`, `LoaiGiamGia`, `GiaTriGiam`, `GiamToiDa`, `DonToiThieu`, `NgayBatDau`, `NgayKetThuc`, `SoLuotSuDungToiDa`, `SoLuotDaSuDung`, `TrangThai`) VALUES
('VC001', 'Uu dai khach hang moi', 'NEW10', 'PhanTram', 10.00, 300000.00, 1000000.00, '2026-01-01', '2026-12-31', 200, 45, 1),
('VC002', 'Uu dai dat lich lan dau', 'FIRST15', 'PhanTram', 15.00, 500000.00, 2000000.00, '2026-01-01', '2026-12-31', 150, 38, 1),
('VC003', 'Voucher sinh nhat', 'BIRTHDAY20', 'PhanTram', 20.00, 500000.00, 1500000.00, '2026-01-01', '2027-12-31', 100, 25, 1),
('VC004', 'Qua sinh nhat dac biet', 'BIRTHDAY300', 'SoTien', 300000.00, NULL, 1500000.00, '2026-01-01', '2027-12-31', 100, 18, 1),
('VC005', 'Uu dai thanh vien Bac', 'SILVER10', 'PhanTram', 10.00, 300000.00, 1000000.00, '2026-01-01', '2026-12-31', 150, 42, 1),
('VC006', 'Uu dai Bac dac biet', 'SILVER15', 'PhanTram', 15.00, 400000.00, 1500000.00, '2026-01-01', '2026-12-31', 100, 20, 1),
('VC007', 'Uu dai thanh vien Vang', 'GOLD15', 'PhanTram', 15.00, 500000.00, 1500000.00, '2026-01-01', '2026-12-31', 150, 55, 1),
('VC008', 'Dac quyen thanh vien Vang', 'GOLD20', 'PhanTram', 20.00, 700000.00, 2000000.00, '2026-01-01', '2026-12-31', 100, 30, 1),
('VC009', 'Uu dai thanh vien Kim Cuong', 'DIAMOND20', 'PhanTram', 20.00, 800000.00, 2000000.00, '2026-01-01', '2027-12-31', 100, 35, 1),
('VC010', 'Dac quyen Kim Cuong', 'DIAMOND25', 'PhanTram', 25.00, 1000000.00, 2500000.00, '2026-01-01', '2027-12-31', 80, 22, 1),
('VC011', 'Qua tang Kim Cuong', 'DIAMOND500', 'SoTien', 500000.00, NULL, 2500000.00, '2026-01-01', '2027-12-31', 50, 12, 1),
('VC012', 'Uu dai mung Tet 2027', 'TET2027', 'PhanTram', 20.00, 600000.00, 1500000.00, '2027-01-01', '2027-02-28', 200, 0, 1),
('VC013', 'Giang sinh an lanh', 'XMAS2026', 'PhanTram', 15.00, 400000.00, 1200000.00, '2026-12-01', '2026-12-31', 150, 0, 1),
('VC014', 'Khach hang than thiet', 'LOYAL20', 'PhanTram', 20.00, 600000.00, 2000000.00, '2026-01-01', '2027-12-31', 100, 28, 1),
('VC015', 'Uu dai quay lai Studio', 'COMEBACK', 'SoTien', 200000.00, NULL, 1000000.00, '2026-01-01', '2026-12-31', 100, 15, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietconcept`
--
ALTER TABLE `chitietconcept`
  ADD CONSTRAINT `FK_ChiTietConcept_Concept` FOREIGN KEY (`MaConcept`) REFERENCES `concept` (`MaConcept`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `chitietdichvudikem`
--
ALTER TABLE `chitietdichvudikem`
  ADD CONSTRAINT `FK_ChiTiet_DatLich` FOREIGN KEY (`MaDatLich`) REFERENCES `datlich` (`MaDatLich`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ChiTiet_DichVuDiKem` FOREIGN KEY (`MaDichVuDiKem`) REFERENCES `dichvudikem` (`MaDichVuDiKem`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `datlich`
--
ALTER TABLE `datlich`
  ADD CONSTRAINT `FK_DatLich_Concept` FOREIGN KEY (`MaConcept`) REFERENCES `concept` (`MaConcept`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DatLich_DichVu` FOREIGN KEY (`MaDichVu`) REFERENCES `dichvu` (`MaDichVu`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DatLich_KhachHang` FOREIGN KEY (`MaKhachHang`) REFERENCES `khachhang` (`MaKhachHang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DatLich_LichChup` FOREIGN KEY (`MaLichChup`) REFERENCES `lichchup` (`MaLichChup`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `FK_HoaDon_DatLich` FOREIGN KEY (`MaDatLich`) REFERENCES `datlich` (`MaDatLich`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HoaDon_Voucher` FOREIGN KEY (`MaVoucher`) REFERENCES `voucher` (`MaVoucher`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `FK_KhachHang_TaiKhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `khoakhunggio`
--
ALTER TABLE `khoakhunggio`
  ADD CONSTRAINT `FK_KhoaKhungGio_DatLich` FOREIGN KEY (`MaDatLich`) REFERENCES `datlich` (`MaDatLich`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_KhoaKhungGio_KhungGio` FOREIGN KEY (`MaKhungGio`) REFERENCES `khunggio` (`MaKhungGio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lichchup`
--
ALTER TABLE `lichchup`
  ADD CONSTRAINT `FK_LichChup_KhungGio` FOREIGN KEY (`MaKhungGio`) REFERENCES `khunggio` (`MaKhungGio`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LichChup_LichLamViec` FOREIGN KEY (`MaLichLamViec`) REFERENCES `lichlamviec` (`MaLichLamViec`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `lichlamviec`
--
ALTER TABLE `lichlamviec`
  ADD CONSTRAINT `FK_LichLamViec_NhanVien` FOREIGN KEY (`MaNhanVien`) REFERENCES `nhanvien` (`MaNhanVien`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `lichsudatlich`
--
ALTER TABLE `lichsudatlich`
  ADD CONSTRAINT `FK_LichSuDatLich_DatLich` FOREIGN KEY (`MaDatLich`) REFERENCES `datlich` (`MaDatLich`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lichsuthanhtoan`
--
ALTER TABLE `lichsuthanhtoan`
  ADD CONSTRAINT `FK_LichSuThanhToan_ThanhToan` FOREIGN KEY (`MaThanhToan`) REFERENCES `thanhtoan` (`MaThanhToan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `FK_NhanVien_TaiKhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `FK_TaiKhoan_VaiTro` FOREIGN KEY (`MaVaiTro`) REFERENCES `vaitro` (`MaVaiTro`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `FK_ThanhToan_HoaDon` FOREIGN KEY (`MaHoaDon`) REFERENCES `hoadon` (`MaHoaDon`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `thongbao`
--
ALTER TABLE `thongbao`
  ADD CONSTRAINT `FK_ThongBao_DatLich` FOREIGN KEY (`MaDatLich`) REFERENCES `datlich` (`MaDatLich`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ThongBao_TaiKhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
