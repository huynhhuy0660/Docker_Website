-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2025 lúc 12:51 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_ban_laptop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--
SET SESSION sql_require_primary_key = 0;
CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(2, 'ACER'),
(7, 'ALIAN WARE'),
(1, 'ASUS'),
(10, 'Corsair'),
(9, 'Crucial'),
(6, 'DELL'),
(11, 'G.Skill'),
(5, 'HP'),
(8, 'Kingston'),
(3, 'LENOVO'),
(4, 'MSI'),
(16, 'Samsung');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Laptop'),
(2, 'RAM'),
(3, 'SSD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cpu` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `gpu` varchar(255) NOT NULL,
  `storage` varchar(100) NOT NULL,
  `display` varchar(255) NOT NULL,
  `port` text NOT NULL,
  `audio` varchar(255) NOT NULL,
  `wifi-bluetooth` varchar(255) NOT NULL,
  `webcam` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `battery` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `dimensions` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `brand_id`, `category_id`, `name`, `price`, `image`, `description`, `cpu`, `ram`, `gpu`, `storage`, `display`, `port`, `audio`, `wifi-bluetooth`, `webcam`, `os`, `battery`, `weight`, `color`, `material`, `dimensions`, `quantity`) VALUES
(1, 2, 1, 'Laptop gaming Acer Predator Helios PHN16 73 757W', 51490000, 'acerpredator.png', '', 'Intel® Core™ Ultra 7 processor 255HX ( 20 nhân, 20 luồng) up to 5.2 GHz, 30MB Cache, 13 TOPS', '32GB (1x32GB) DDR5 6400MHz (2x SO-DIMM socket, up to 96GB SDRAM)', 'NVIDIA® GeForce RTX™ 5060 with 8 GB of dedicated GDDR7 VRAM, supporting 3328 NVIDIA® CUDA® Cores, 572 TOPS', '1TB PCIe NVMe SED SSD (Còn trống 1 khe SSD M.2 PCIE Gen 4, nâng cấp tối đa 4TB SSD PCIe Gen 4)', '16\" 2K+ (2560 x 1600) 240Hz DCI-P3 100% DDS, 500nits, Acer ComfyView™ LED-backlit TFT LCD,Nvidia Advanced Optimus capable,Wide viewing angle,Ultra-slim design', 'Total 2x USB Type-C\r\n 1x USB Type-C™ port supporting:\r\n • USB 3.2 Gen 2 (up to 10 Gbps)\r\n • DisplayPort over USB-C\r\n • Thunderbolt™ 4\r\n • USB charging 5 V; 3 A\r\n • DC-in port 20 V; 90 or 100 W\r\n 1x USB Type-C™ port, supporting:\r\n • USB 3.2 Gen 2 (up to 10 Gbps)\r\n • DisplayPort over USB-C\r\n • USB charging 5 V; 3 A\r\n • DC-in port 20 V; 90 W\r\n Total 3x USB Standard A\r\n 3x USB Standard-A ports, supporting:\r\n • 1x port for USB 3.2 Gen 1\r\n • 1x port for USB 3.2 Gen 2\r\n • 1x port for USB 3.2 Gen 2 featuring power off USB charging\r\n 1x HDMI® 2.1 port with HDCP support\r\n 1x Ethernet (RJ-45) port\r\n 1x microSD card (SDXC compatible)\r\n 1x DC-in jack for AC adapter\r\n 1x 3.5 mm headphone/speaker jack, supporting headsets with built-in microphone', 'DTS X:Ultra Audio', '802.11 a/b/g/n/ac/ax wireless LAN, bluetooth v5.4', '• Narrow USB HD camera\r\n• 1280 x 720 resolution\r\n• 1080p HD video at 60 fps with Temporal ', 'Windows 11 Home Single Language', '90Wh 4-cell Li-ion battery 230W AC Adapter', '2.8 kg', 'Obsidian black', 'Cover A: Aluminium\r\nCover B,C,D: ABS Plastic', '356.78 (W) x 275.5 (D) x 13.47/23.90 (H) mm', 100),
(2, 2, 1, 'Laptop gaming Acer Nitro V ANV15 51 78BG', 29490000, 'acernitro.png', '', 'Intel® Core™ i7-13620H (3.60 GHz up to 4.90 GHz, 10 nhân 16 luồng, 24 MB Intel® Smart Cache)', '16GB (8x2) DDR5 5200MHz (2x SO-DIMM socket, up to 96GB SDRAM)', 'NVIDIA® GeForce RTX™ 4060 8GB GDDR6', '512GB PCIe NVMe SED SSD (Còn trống 1 khe SSD M.2 PCIE, nâng cấp tối đa 2TB)', '15.6\" FHD (1920 x 1080) IPS, 180Hz, Acer ComfyView LED-backlit TFT LCD, SlimBezel, 100% sRGB, 300 nits', '1 x USB Type-C™ port supporting:\r\nUSB 3.2 Gen 2 (up to 10 Gbps)\r\nDisplayPort over USB-C\r\nThunderbolt™ 4\r\n3 x USB Standard-A ports, supporting:\r\nOne port for USB 3.2 Gen 1 featuring power off USB charging\r\nTwo ports for USB 3.2 Gen 1\r\n1 x HDMI® 2.1 port with HDCP support\r\n1 x 3.5 mm headphone/speaker jack, supporting headsets with built-in\r\nmicrophone\r\n1 x Ethernet (RJ-45) port', 'DTS® X:Ultra', '802.11a/b/g/n/ac+ax wireless LAN Dual Band (2.4 GHz and 5 GHz), Bluetooth® 5.1', '720p HD audio/video recording', 'Windows 11 Home', '4 Cell 57WHr', '2.1 kg', 'Obsidian Black', 'Vỏ nhựa', '362.3 (W) x 239.89 (D) x 22.9/26.9 (H) mm', 120),
(3, 1, 1, 'Laptop gaming ASUS ROG Strix G18 G815LM S9088W', 48990000, 'asusrog.png', '', 'Intel® Core™ Ultra 9 Processor 275HX 2.7 GHz (36MB Cache, up to 5.4 GHz, 24 cores, 24 Threads); Intel® AI Boost NPU up to 13TOPS', '32GB (2x16GB) DDR5 5600Mhz (2 khe cắm nâng cấp tối đa 64GB) ', 'NVIDIA® GeForce RTX™ 5060 Laptop GPU 8GB GDDR7 ROG Boost: 1610MHz  (1560MHz Boost Clock+50MHz OC, 100W+15W Dynamic Boost', '1TB PCIe® 4.0 NVMe™ M.2 SSD(Còn trống 1 khe M.2 PCIe Gen4x4)', '18\" 2.5K (2560 x 1600, WQXGA) 16:10, IPS-level, 240Hz 3ms,500 nits, Anti-glare display, DCI-P3:100%, Pantone Validated, ROG Nebula Display', '1x RJ45 LAN port\r\n1x Thunderbolt™ 4 with support for DisplayPort™ / power delivery (data speed up to 40Gbps)\r\n1x USB 3.2 Gen 2 Type-C with support for DisplayPort™ / power delivery / G-SYNC (data speed up to 10Gbps)\r\n3x USB 3.2 Gen 2 Type-A (data speed up to 10Gbps)\r\n1x HDMI 2.1 FRL', '2-speaker system with Smart Amplifier Technology', 'Wi-Fi 7(802.11be) (Triple band) 2*2, Bluetooth® v5.4', '1080P FHD IR Camera for Windows Hello', 'Windows 11 Home', '90WHrs, 4S1P, 4-cell Li-ion', '3.20 Kg', 'Volt Green', 'Vỏ nhôm', '39.9 x 29.8 x 2.35 ~ 3.20 cm (15.71\" x 11.73\" x 0.93\" ~ 1.26\")', 100),
(4, 1, 1, 'Laptop gaming ASUS ROG Zephyrus G14 GA403WM QS058WS', 53990000, 'asuszephy.png', '', 'AMD Ryzen™ AI 9 HX 370 Processor 2.0GHz (36MB Cache, up to 5.1GHz, 12 cores, 24 Threads); AMD XDNA™ NPU up to 50TOPS', '32GB LPDDR5X 7500 on board (Không nâng cấp được)', 'NVIDIA® GeForce RTX™ 5060 Laptop GPU 8GB GDDR7 Turbo mode: 1737MHz at 90W(1687MHz Boost Clock+50MHz OC, 75W+15W Dynamic Boost)', '1TB PCIe® 4.0 NVMe™ M.2 SSD (1 slot nâng cấp thay thế max 2TB)', '14 inch 3K ROG Nebula OLED (2880 x 1800) 16:10, 120Hz, G-Sync / Adaptive-Sync, 500 nits, 100% DCI-P3, Glossy display, Pantone Validated, Dolby Vision HDR', '1x Type-C USB 4 with support for DisplayPort™ / power delivery (data speed up to 40Gbps)\r\n1x USB 3.2 Gen 2 Type-C with support for DisplayPort™ / power delivery / G-SYNC (data speed up to 10Gbps)\r\n2x USB 3.2 Gen 2 Type-A (data speed up to 10Gbps)\r\n1x card reader (microSD) (UHS-II)\r\n1x HDMI 2.1 FRL\r\n1x 3.5mm Combo Audio Jack\r\nBuilt-in 3-microphone array', '4-speaker (dual force woofer) system with Smart Amplifier Technology, 2 Tweeters\r\n1x 3.5mm Combo Audio Jack\r\nBuilt-in 3-microphone array', 'Wi-Fi 7(802.11be) (Triple band) 2*2, Bluetooth® v5.4', '1080P FHD IR Camera for Windows Hello', 'Windows 11 Home + Microsoft Office Home 2024 + Microsoft 365 Basic', '73WHrs, 4S1P, 4-cell Li-ion', '1.5 Kg ', 'Platinum White', 'Vỏ nhôm', '31.1 x 22.0 x 1.59 ~ 1.63 cm', 100),
(5, 3, 1, 'Laptop gaming Lenovo Legion 5 15IRX10 83LY00HWVN', 40000000, 'legion.png', '', 'Intel® Core i7-14700HX, 20C (8P + 12E) / 28T, P-core 2.1 / 5.5GHz, E-core 1.5 / 3.9GHz, 33MB', '16GB (1x16GB) SO-DIMM DDR5 5600MHz (2 slots, nâng cấp tối đa 32GB)', 'NVIDIA® GeForce RTX™ 5060 8GB GDDR7, Boost Clock 2497MHz, TGP 115W, 572 AI TOPS', '512GB SSD M.2 2242 PCIe® 4.0x4 NVMe®\r\nUp to two drives, 2x M.2 SSD\r\n• M.2 2242 SSD up to 1TB', '15.1\" WQXGA (2560x1600) OLED 1000nits (peak) / 500nits (typical) glossy, 100% DCI-P3, 165Hz, Dolby Vision®, DisplayHDR™ True Black 600', '2x USB-A (USB 5Gbps / USB 3.2 Gen 1)\r\n1x USB-A (USB 5Gbps / USB 3.2 Gen 1), Always On\r\n1x USB-C® (USB 10Gbps / USB 3.2 Gen 2), with USB PD 65-100W and DisplayPort™ 2.1\r\n1x USB-C® (USB 10Gbps / USB 3.2 Gen 2), with DisplayPort™ 1.4\r\n1x HDMI® 2.1, up to 8K/60Hz\r\n1x Headphone / microphone combo jack (3.5mm)\r\n1x Ethernet (RJ-45)\r\n1x Power connector', 'Stereo speakers, 2W x2, audio by HARMAN, optimized with Nahimic Audio', 'Wi-Fi® 6, 802.11ax 2x2, Bluetooth® v5.2', 'HD 720p with E-shutter', 'Windows® 11 Home Single Language, English, Office Home 2024 + Lenovo® AI Now', '80Wh, 245W Slim Tip (3-pin)', '1.9 kg', 'Eclipse Black', 'PC-ABS + 15% Talc (Top), PC-ABS + 15% Talc (Bottom)', '	344.9 x 255.35 x 22.50-23.99 mm', 100),
(6, 3, 1, 'Laptop gaming Lenovo Lenovo Legion 7 16IAX10 83KY001VVN', 60000000, 'legion_white.png', '', 'Intel® Core Ultra 9 275HX, 24C (8P + 16E) / 24T, Max Turbo up to 5.4GHz, 36MB', '32GB (2x16GB) SO-DIMM DDR5 5600MHz (2 slots, nâng cấp tối đa 32GB)', 'NVIDIA® GeForce RTX™ 5070 8GB GDDR7, Boost Clock 2347MHz, TGP 115W, 798 AI TOPS', '1TB SSD M.2 2242 PCIe® 4.0x4 NVMe®\r\nUp to two drives, 2x M.2 SSD\r\n• M.2 2242 SSD up to 1TB each', '16\" WQXGA (2560x1600) OLED 500nits Glossy, 100% DCI-P3, 240Hz, DisplayHDR™ True Black 1000, Dolby Vision®, G-SYNC®, Low Blue Light, High Gaming Performance, Flicker Free', '1x USB-A (USB 5Gbps / USB 3.2 Gen 1)\r\n1x USB-A (USB 5Gbps / USB 3.2 Gen 1), Always On\r\n1x USB-C® (USB 10Gbps / USB 3.2 Gen 2), with USB PD 65-100W and DisplayPort™ 2.1\r\n1x USB-C® (Thunderbolt™ 4 / USB4® 40Gbps), with USB PD 65-100W and DisplayPort™ 2.1\r\n1x HDMI® 2.1, up to 8K/60Hz\r\n1x Headphone / microphone combo jack (3.5mm)\r\n1x Card reader\r\n1x Power connector', 'Stereo speakers, 2W x2, audio by HARMAN, optimized with Nahimic Audio, Smart Amplifier (AMP)', 'Wi-Fi® 7, 802.11be 2x2, Bluetooth® v5.4', '5.0MP + IR with E-shutter', 'Windows® 11 Home Single Language, English, Office Home 2024 + Lenovo® AI Now', '84Wh, 245W Slim Tip (3-pin)', '2.0 kg', 'Glacier White', 'Aluminium (Top), Aluminium (Bottom)', '361.7 x 263.4 x 15.9-17.9 mm (14.24 x 10.37 x 0.63-0.70 inches)', 100),
(7, 4, 1, 'Laptop gaming MSI Katana 15 HX B14WEK 295VN', 33000000, 'msi.png', '', 'Intel® Core™ i9 processor 14900HX 24 cores (8 P-cores + 16 E-cores), Max Turbo Frequency 5.8 GHz', '16GB (2 x 8GB) DDR5 5600MHz (2x SO-DIMM socket, up to 96GB SDRAM)', 'NVIDIA® GeForce RTX™ 5050 Laptop GPU powers advanced AI Up to 2662MHz Boost Clock 115W Maximum Graphics Power with Dynamic Boost. *May vary by scenario', '512GB NVMe PCIe Gen 4 SSD (Total 1 slot M.2-2280 , max 4TB)', '15.6\" QHD(2560x1440), 165Hz Refresh Rate,100% DCI-P3(Typical),IPS-Level, 300 nits', '1x Type-C (USB3.2 Gen1 / DP)\r\n3x Type-A USB3.2 Gen2\r\n1x HDMI™ 2.1 (8K @ 60Hz / 4K @ 120Hz)\r\n1x RJ45\r\n1x Mic-in/Headphone-out Combo Jack', 'Nahimic 3 Audio Enhancer Hi-Res Audio Ready\r\n2x 2W Speaker', 'Intel® Wi-Fi 6E AX211, Bluetooth® v5.3', 'HD type (30fps@720p)', 'Windows 11 Home ', '4 cell, 75Whr', '2.4 kg', 'Đen', 'Nhôm', '359 x 262 x 25.5 mm', 100),
(8, 5, 1, 'Laptop gaming HP OMEN 16-am0180TX BX8Y6PA', 31000000, 'hp.png', '', 'Intel® Core™ Ultra 5 225H (up to 4.9 GHz with Intel® Turbo Boost Technology, 18 MB L3 cache, 14 cores, 14 threads)', '16GB (8x2) DDR5 5600MHz (2x SO-DIMM socket, up to 32GB SDRAM)', 'NVIDIA® GeForce RTX™ 5050 Laptop GPU (8 GB GDDR7 dedicated)', '512 GB PCIe® Gen4 NVMe™ M.2 SSD ( 2 slot M2)', '16.1\" diagonal, 2K (1920 x 1200), 60-165 Hz, 3 ms response time, IPS, micro-edge, anti-glare, Low Blue Light, 400 nits, 100% sRGB', '1 USB Type-A 10Gbps signaling rate\r\n2 USB Type-A 5Gbps signaling rate\r\n1 AC smart pin\r\n1 HDMI 2.1\r\n1 headphone/microphone combo\r\n1 RJ-45\r\n1 USB Type-C® 10Gbps signaling rate (USB Power Delivery 3.0, DisplayPort™ 1.4, HP Sleep and Charge)', 'DTS:X® Ultra; Dual speakers; HP Audio Boost; HyperX', 'Intel® Wi-Fi 6E AX211 (2x2), Bluetooth® 5.3 wireless card', 'HP True Vision 1080p FHD camera with temporal noise reduction and integrated dual array digital microphones', 'Windows 11 Home', '6-cell, 83 Wh Li-ion polymer', '2.43 kg', 'Shadow black, black chrome logo', 'Vỏ nhựa', '35.75 x 26.9 x 2.37 cm (front); 35.75 x 26.9 x 2.54 cm (rear) ', 100),
(9, 6, 1, 'Laptop gaming Dell G15 5530 i7H161W11GR4060', 30000000, 'dell.png', '', 'Intel Core i7-13650HX (24 MB cache, 14 cores, 20 threads, up to 4.90 GHz Turbo)', '16GB (2x8GB) DDR5 4800MHz (2x SO-DIMM socket, up to 32GB SDRAM)', 'NVIDIA® GeForce RTX™ 4060 8GB GDDR6', '1TB SSD M.2 PCIe NVMe', '15.6\" FHD (1920x1080) 165Hz, 3ms, sRGB-100%, ComfortViewPlus, NVIDIA G-SYNC+DDS Display', '1 headset (headphone and microphone combo) port\r\n1 RJ45 Ethernet port\r\n3 USB 3.2 Gen 1 ports\r\n1 HDMI 2.1 port\r\n1 USB-C 3.2 Gen 2 port with DisplayPort™', 'Nahimic Audio', 'Intel® Wi-Fi 6 AX201, 2x2, 802.11ax, Bluetooth® wireless card, Bluetooth® V5.2', 'Integrated widescreen HD (720p) Webcam with single Array Digital Microphone', 'Windows 11 Home + Office Home & Student', '6 Cell 86WHrs', '2.81 kg', 'Dark Shadow Grey', 'Vỏ nhôm', '357.26 x 274.52 x 26.95 (mm)', 100),
(10, 1, 1, 'Laptop ASUS Expertbook P1403CVA-i516-50W', 14290000, 'exper.png', '', 'Intel® Core™ i5-13420H Processor 2.1 GHz (12MB Cache, up to 4.6 GHz, 8 cores, 12 Threads)', '16GB (2x8GB) DDR4 3200Mhz (2 khe max 32GB)', 'Intel® UHD Graphics onboard', '512GB M.2 NVMe™ PCIe® 4.0 SSD (2 slot, còn trống 1 khe M.2)', '14.0 FHD (1920 x 1080) 16:9, IPS-level, 60Hz, LED Backlit, Anti-glare display, NTSC: 45%, View angle 170, Screen-to-body ratio 87%', '2x USB 3.2 Gen 1 Type-A\r\n2x USB 3.2 Gen 2 Type-C support display / power delivery\r\n1x HDMI 1.4\r\n1x 3.5mm Combo Audio Jack\r\n1x RJ45 Gigabit Ethernet\r\nFingerPrint', 'Audio by Dirac\r\nBuilt-in speaker\r\nBuilt-in array microphone', 'Wi-Fi 6(802.11ax) (Băng tần kép) 2*2	Bluetooth® 5.3 Wireless Card', 'Webcam HD có màn trập camera', 'Windows 11 Home', '3 Cell 50WHrs', '1.43 kg', 'Misty Grey', 'LCD cover (Plastic), Top case (Plastic)', '32.45 x 21.44 x 1.97 ~ 1.97 cm', 100),
(11, 3, 1, 'Laptop gaming Lenovo LOQ 15ARP9 83JC00LVVN', 20000000, 'loq1.png', '', 'AMD Ryzen™ 5 7235HS (4C / 8T, 3.2 / 4.2GHz, 2MB L2 / 8MB L3)', '16GB (2x8GB) DDR5-4800 SO-DIMM (2x SO-DIMM socket, up to 32GB SDRAM)', 'NVIDIA® GeForce RTX™ 3050 6GB GDDR6, Boost Clock 1732MHz, TGP 95W', '512GB SSD M.2 2242 PCIe® 4.0x4 NVMe® (2 Slots: M2 2242 PCIe 4.0 x4 Slot/ M.2 2280 PCIe 4.0 x4 Slot)', '15.6\" FHD (1920x1080) IPS 300nits Anti-glare, 100% sRGB, 144Hz, G-SYNC®', '3x USB-A (USB 5Gbps / USB 3.2 Gen 1)\r\n1x USB-C® (USB 10Gbps / USB 3.2 Gen 2), with Lenovo® PD 140W and DisplayPort™ 1.4\r\n1x HDMI® 2.1, up to 8K/60Hz\r\n1x Headphone / microphone combo jack (3.5mm)\r\n1x Ethernet (RJ-45)\r\n1x Power connector', 'Stereo speakers, 2W x2, optimized with Nahimic Audio', 'Wi-Fi® 6, 11ax 2x2 + BT5.2, ', 'HD 720p with E-shutter', 'Windows® 11 Home Single Language, English', 'Integrated 60Wh (4 Cell)', '2.38 kg', 'Luna Grey', 'PC-ABS (Top), PC-ABS (Bottom)', '359.86 x 258.7 x 21.9-23.9 mm (14.17 x 10.19 x 0.86-0.94 inches)', 100),
(12, 3, 1, 'Laptop gaming Lenovo LOQ 15IRX9 83DV013PVN', 22000000, 'loq2.png', '', 'Intel® Core™ i5-13450HX, 10C (6P + 4E) / 16T, P-core 2.4 / 4.6GHz, E-core 1.8 / 3.4GHz, 20MB', '16GB (1x16GB) DDR5-4800 SO-DIMM (2x SO-DIMM socket, up to 32GB SDRAM)', 'NVIDIA® GeForce RTX™ 3050 6GB GDDR6, Boost Clock 1732MHz, TGP 95W, 142 AI TOPS', '512GB SSD M.2 2242 PCIe 4.0x4 NVMe (2 Slots: M2 2242 PCIe 4.0 x4 Slot/ M.2 2280 PCIe 4.0 x4 Slot)', '15.6\" FHD (1920x1080) IPS 300nits Anti-glare, 100% sRGB, 144Hz, G-SYNC®', '3x USB-A (USB 5Gbps / USB 3.2 Gen 1)\r\n1x USB-C® (USB 10Gbps / USB 3.2 Gen 2), with PD 140W and DisplayPort™ 1.4\r\n1x HDMI® 2.1, up to 8K/60Hz\r\n1x Headphone / microphone combo jack (3.5mm)\r\n1x Ethernet (RJ-45)\r\n1x Power connector', 'High Definition (HD) Audio, Realtek® ALC3287 codec', 'Wi-Fi 6 11ax, 2x2 + BT5.1', 'HD 720p with E-shutter', 'Windows 11 Home', 'Integrated 60Wh (4 Cell)', '2.38 kg', 'Luna Grey', 'PC-ABS (Top), PC-ABS (Bottom)', '359.6 x 264.8 x 22.1-25.2 mm', 100),
(13, 3, 1, 'Laptop gaming Lenovo LOQ 15IAX9 83GS000RVN', 23000000, 'loq3.png', '', 'Intel® Core™ i5-12450HX, 8C (4P + 4E) / 12T, P-core up to 4.4GHz, E-core up to 3.1GHz, 12MB', '16GB (1x16gb) DDR5-4800 SO-DIMM (2x SO-DIMM socket, up to 32GB SDRAM)', 'NVIDIA® GeForce RTX™ 4050 6GB GDDR6, Boost Clock 2370MHz, TGP 105W', '512GB SSD M.2 2242 PCIe 4.0x4 NVMe (2 Slots: M2 2242 PCIe 4.0 x4 Slot/ M.2 2280 PCIe 4.0 x4 Slot)', '15.6\" FHD (1920x1080) IPS 300nits Anti-glare, 100% sRGB, 144Hz, G-SYNC®', '3x USB-A (USB 5Gbps / USB 3.2 Gen 1)\r\n1x USB-C® (USB 10Gbps / USB 3.2 Gen 2), with PD 140W and DisplayPort™ 1.4\r\n1x HDMI® 2.1, up to 8K/60Hz\r\n1x Headphone / microphone combo jack (3.5mm)\r\n1x Ethernet (RJ-45)\r\n1x Power connector', 'Stereo speakers, 2W x2, optimized with Nahimic Audio', 'Wi-Fi® 6, 11ax 2x2 + BT5.2', 'HD 720p with E-shutter', 'Windows® 11 Home Single Language', 'Integrated 60Wh (4 Cell)', '2.38 kg', 'Luna Grey', 'PC-ABS (Top), PC-ABS (Bottom)', '359.86 x 258.7 x 21.9-23.9 mm', 100),
(14, 3, 1, 'Laptop gaming Lenovo Legion Pro 7 16IAX10H 83F5008VVN', 70000000, 'legion2.png', '', 'Intel® Core Ultra 9 275HX, 24 Cores (8 P-core + 16 E-core), 24 Threads, 5.4GHz, 36MB Cache, Integrated Intel® AI Boost, up to 13 TOPS', '32GB (2x16GB) SO-DIMM DDR5 6400MHz (2 slots, nâng cấp tối đa 32GB)', 'NVIDIA® GeForce RTX™ 5070 Ti 12GB GDDR7, Boost Clock 2220MHz, TGP 140W, 992 AI TOPS', '1TB SSD M.2 2280 PCIe® 4.0x4 NVMe® (2 slots M.2 2280 PCIe® 4.0 x4)', '16\" WQXGA (2560x1600) OLED 500nits Anti-glare, 100% DCI-P3, 240Hz, DisplayHDR™ True Black 1000, Dolby Vision®, NVIDIA® G-SYNC®, Advanced Optimus suppor', '2x USB-A (USB 5Gbps / USB 3.2 Gen 1)\r\n1x USB-A (USB 10Gbps / USB 3.2 Gen 2), Always On\r\n1x USB-C® (USB 10Gbps / USB 3.2 Gen 2), with Lenovo® PD 140W and DisplayPort™ 2.1\r\n1x Thunderbolt™ 4 / USB4® 40Gbps (support data transfer and DisplayPort™ 2.1)\r\n1x HDMI® 2.1, up to 8K/60Hz\r\n1x Headphone / microphone combo jack (3.5mm)\r\n1x Ethernet (2.5GbE RJ-45)\r\n1x Power connector', 'Stereo speakers (super linear speaker), 2W x2, audio by HARMAN, optimized with Nahimic Audio, Smart Amplifier (AMP)', 'Wi-Fi® 7, 802.11be 2x2 Wi-Fi®, Bluetooth v5.4', 'FHD 1080p with E-shutter', 'Windows® 11 Home SL + Office Home 2024 ', 'Integrated 99.9Wh Rechargeable Li-ion Battery, supports Super Rapid Charge\r\n', '2.57 kg', 'Eclipse Black', 'Aluminium (Top), Aluminium (Bottom)', '364.38 x 275.94 x 21.9-26.65 mm', 100),
(15, 3, 1, 'Laptop Lenovo ThinkPad X1 Carbon Gen 13 21NX003DVN', 39000000, 'thinkpad.png', '', 'Intel® Core™ Ultra 5 225H, 14C (4P + 8E + 2LPE) / 14T, Max Turbo up to 4.9GHz, 18MB', '16GB Soldered LPDDR5x-8400 ( Không thể nâng cấp)', 'Integrated Intel® Arc™ 130T GPU', '1TB SSD M.2 2280 PCIe® 4.0x4 NVMe® Opal 2.0 ( Tổng 1 M.2 2280 PCIe® 5.0 x4 slot, up to 2TB M.2 2280 ', '14\" WUXGA (1920x1200) IPS 500nits Anti-glare, 100% sRGB, 60Hz, Low Power', '1x USB-A (USB 5Gbps / USB 3.2 Gen 1)\r\n1x USB-A (USB 5Gbps / USB 3.2 Gen 1), Always On\r\n2x USB-C® (Thunderbolt™ 4 / USB4® 40Gbps), with USB PD 3.0 and DisplayPort™ 2.1\r\n1x HDMI® 2.1, up to 4K/60Hz\r\n1x Headphone / microphone combo jack (3.5mm)', 'Stereo speakers, 2W x2, Dolby Atmos®', 'Intel® Wi-Fi® 7 BE201, 802.11be 2x2, 	Bluetooth® 5.4', 'FHD 1080p + IR Discrete with Privacy Shutter', 'Windows® 11 Pro, English (US) / English (UK)', 'Integrated 57Wh', '1.06 kg', 'Black, Paint', 'Carbon Fiber (Top), Aluminium (Bottom) ', '312.80 x 214.75 x 8.38', 100),
(16, 6, 1, 'Laptop Dell Inspiron 15 3530 N3530-i7U161W11BLU-FP', 17750000, 'inspiron.png', '', 'Intel Core i7-1355U (1.70Ghz up to 5.00GHz, 12MB Cache)', '16GB DDR4 2666MHz (2x SO-DIMM socket, up to 16GB SDRAM)', 'Intel Iris Xe Graphics (with dual channel memory) onboard', '1TB SSD NVMe PCIe (1 Slot)', '15.6\" Full HD (1920 x 1080) 120Hz, Màn hình chống lóa, 250 nits, FreeSync', '2 x USB 3.2 Gen 1 ports (on systems configured with non Type-C®)\r\n1 x USB 2.0 port\r\n1 x headset (headphone and microphone combo) port\r\n1 x HDMI 1.4 port\r\nOne SD card slot', 'Realtek ALC3204, âm thanh Realtek', 'WiFi 802.11ax , Bluetooth® v5.3', '720p at 30 fps HD camera, single-integrated microphone', 'Windows 11 Home + Office Home&Student', '4 cell 54 Wh , Pin liền', '1.65 kg', 'Carbon Black', 'Vỏ nhựa', '358.5 x 235.56 x 16.96~18.99 mm ', 100),
(17, 1, 1, 'Laptop ASUS Vivobook 15 OLED A1505VA MA468W', 18950000, 'vivobook.png', '', 'Intel® Core™ i5-13500H Processor 2.6 GHz (18MB Cache, up to 4.7 GHz, 12 cores, 16 Threads)', '16GB (8GB Onboard + 8GB Sodimm) DDR4 3200MHz ', 'Intel Iris Xe Graphics (with dual channel memory) onboard', '512GB M.2 NVMe™ PCIe® 3.0 SSD (1 slot, support M.2 2280 PCIe 3.0x4)', '15.6inch 2.8K (2880 x 1620) OLED 16:9, 120Hz 0.2ms, 600nits, 100% DCI-P3, Glossy display, Screen-to-body ratio: 86%, PANTONE Validated, VESA CERTIFIED Display HDR True Black 600', '1x USB 2.0 Type-A\r\n1x USB 3.2 Gen 1 Type-C support power delivery\r\n2x USB 3.2 Gen 1 Type-A\r\n1x HDMI 1.4\r\n1x 3.5mm Combo Audio Jack\r\n1x DC-in', 'SonicMaster', 'Wi-Fi 6E(802.11ax) (Dual band) 1*1, Bluetooth® 5.3 Wireless Card', '720p HD camera With privacy shutter', 'Windows 11 Home', '50WHrs, 3S1P, 3-cell Li-ion', '1.7 kg', 'Cool Silver', 'Plastic (Top, Bottom, LCD cover)', '35.68 x 22.76 x 1.99 cm', 100),
(18, 4, 1, 'Laptop gaming MSI Katana 15 B13UDXK 2213VN', 19990000, 'katana1.png', '', 'Intel Core i5-13500H 12 cores (4 P-cores + 8 E-cores), Max Turbo Frequency 4.7 GHz', '16GB (2 x 8GB) DDR5 5200MHz (2x SO-DIMM socket, up to 64GB SDRAM)', 'NVIDIA® GeForce RTX™ 3050 6GB, Boost Clock 75W Maximum Graphics Power with Dynamic Boost.', '1TB NVMe PCIe Gen 4 SSD (2 slots, Nâng cấp cần gắn thêm linh kiện tại TTBH MSI)', '15.6\" FHD (1920x1080), 144Hz, IPS-Level, 45% NTSC', '1x Type-C (USB3.2 Gen1 / DP)\r\n2x Type-A USB3.2 Gen1\r\n1x Type-A USB2.0\r\n1x HDMI™ 2.1 (8K @ 60Hz / 4K @ 120Hz)\r\n1x RJ45', 'Nahimic 3 Audio Enhancer, Hi-Res Audio Ready', 'Intel® Wi-Fi 6E AX211, Bluetooth® v5.2', 'HD type (30fps@720p)', 'Windows 11 Home', '3 cell, 53.5Whr', '3 cell, 53.5Whr', 'Đen', 'Vỏ nhựa', '359 x 259 x 24.9 mm', 100),
(19, 4, 1, 'Laptop gaming MSI Titan 18 HX AI A2XWJG 035VN', 100000000, 'titan18.png', '', 'Intel® Core™ Ultra 9 285HX 24 nhân 24 luồng (Max turbo 5.5GHz)', '96GB (2 x 48GB) DDR5 6400MHz ', 'NVIDIA® GeForce RTX™ 5090 Laptop GPU 24GB GDDR7', '6TB NVMe PCIe (1 x NVMe M.2 SSD by PCIe Gen5 x4 + 3 x NVMe M.2 SSD by PCIe Gen4 x4)', '18\" UHD+ (3840x2400), 16:10, MiniLED, 120Hz Refresh Rate, 100% DCI-P3 (Typ.), VESA DisplayHDR™ 1000 Certified, IPS-Level panel', '2 x Thunderbolt™ 5 (DisplayPort™/ Power Delivery 3.1)\r\n3 x USB 3.2 Gen2 Type-A\r\n1 x HDMI™ 2.1 (8K@60Hz / 4K@120Hz)\r\n1 x SD Express Memory Card Reader\r\n1 x Audio combo jack', '6 Speaker designed by Dynaudio system (4 x 2W Speakers + 2 x 2W Woofers)', 'Intel® Killer™ Wi-Fi 7 BE1750, Bluetooth v5.4', 'IR FHD type (30fps@1080p) with HDR & 3D Noise Reduction+ (3DNR+)', 'Windows 11 Home', '4 cell, 99.99Whr', '3.6 kg', 'Core Black', 'Vỏ nhôm', '404 (W) x 307.5 (D) x 24~32.05 (H) mm', 100),
(20, 1, 1, 'Laptop ASUS Vivobook S14 S3407CA LY095WS', 19890000, 's14.png', '', 'Intel® Core™ Ultra 5 Processor 225H 1.7 GHz (18MB Cache, up to 4.9 GHz, 14 cores, 16 Threads); Intel® AI Boost NPU up to 13TOPS', '16GB DDR5 Onboard', 'Intel® Arc™ Graphics onboard', '512GB M.2 NVMe™ PCIe® 4.0 SSD', '14.0-inch WUXGA (1920 x 1200) 16:10\r\nLED Backlit, IPS, 60Hz\r\n300nits Brightness, 45% NTSC color gamut\r\nAnti-glare display, TÜV Rheinland-certified', '2x USB 3.2 Gen 1 Type-A (tốc độ dữ liệu lên đến 5Gbps)\r\n2x USB 3.2 Gen 1 Type-C hỗ trợ xuất màn/nguồn (tốc độ dữ liệu lên đến 5Gbps)\r\n1x HDMI 1.4\r\n1x Giắc cắm âm thanh kết hợp 3,5mm', 'Built-in speaker\r\nBuilt-in array microphone', 'Wi-Fi 6(802.11ax) (Dual band) 2*2, Bluetooth® 5.3 Wireless Card (*Phiên bản Bluetooth có thể thay đổi tùy thuộc vào hệ điều hành)', 'Camera FHD có chức năng IR hỗ trợ Windows Hello; Có nắp che linh hoạt', 'Windows 11 Home ', '70WHrs, 4S1P, 4-cell Li-ion', '1.40 kg', 'Xám', 'Vỏ nhựa', '31.52 x 22.34 x 1.59 ~ 1.79 cm', 100),
(21, 1, 1, 'Laptop gaming ASUS V16 V3607VU RP343W', 24290000, 'v16.png', '', 'Intel® Core™ 5 Processor 210H 2.2 GHz (12MB Cache, up to 4.8 GHz, 8 cores, 12 Threads)', '16GB (1x16GB) DDR5 ( Tổng 2 slot Ram, Còn trống 1 Slot)', 'NVIDIA® GeForce RTX™ 4050 Laptop GPU ', '512GB M.2 NVMe™ PCIe® 4.0 SSD ( Tổng 1 khe M.2 2280 PCIe 4.0x4)', '16.0-inch WUXGA (1920 x 1200) 16:10, LED Backlit, 144Hz, 300nits, 45% NTSC color gamut, Anti-glare display', '1x USB 3.2 Gen 1 Type-C with support for display / power delivery (data speed up to 5Gbps)\r\n2x USB 3.2 Gen 1 Type-A (data speed up to 5Gbps)\r\n1x HDMI 2.1 FRL\r\n1x 3.5mm Combo Audio Jack\r\n1x DC-in', 'SonicMaster\r\nBuilt-in speaker\r\nBuilt-in array microphone', 'Wi-Fi 6E(802.11ax) (Dual band) 2*2\r\nBluetooth® 5.3 Wireless Card', '1080p FHD camera ; With privacy shutter', 'Windows 11 Home', '63WHrs, 3S1P, 3-cell Li-ion', '1.95 kg ', 'Matte Black', 'LCD cover (Plastic), Top case (Plastic)', '35.70 x 25.07 x 1.80 ~ 2.20 cm', 100),
(22, 8, 2, 'Ram laptop Kingston 16GB DDR5 bus 5600', 2500000, 'ram1.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 100),
(23, 10, 2, 'Ram Laptop Corsair 8GB 4800MHz DDR5', 790000, 'ram2.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 100),
(24, 16, 3, 'SSD Samsung 980 Pro 1TB PCIe 4.0', 2500000, 'ssd1.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 100),
(25, 16, 3, 'SSD Samsung M.2 512GB', 1490000, 'ssd2.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `review_text`, `created_at`) VALUES
(1, 23, 4, 5, 'ngon', '2025-11-18 05:03:04'),
(2, 19, 4, 5, 'máy ngon trong tầm giá', '2025-11-18 05:21:09'),
(3, 23, 5, 5, '', '2025-11-18 06:21:50'),
(4, 19, 5, 5, 'ngon thí', '2025-11-18 06:30:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `role`) VALUES
(3, 'adminHuyy', '$2y$10$ofDP50tGuEFIkRoM9V7iAOhhuuqPRt6fwy153YNcb4HfNRH7h4H5a', 'huynhhuy', 'huynhhuyy9c@gmail.com', 0),
(4, 'tester', '$2y$10$ob/OyTnzrCpfObZ/jPvBx.1trykdrMOZ1z.qzE49pYGyJy28JLZpC', 'huybaor', 'xyzvc@gmail.com', 0),
(5, 'adminkhas', '$2y$10$PsAEMDn/L.LAArDbva5kWuJi7wvf0mOHwtIQO4g1kz/PRLi09Qjgi', 'toilatoi', 'abcxyz@gmail.com', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_user_unique` (`product_id`,`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
