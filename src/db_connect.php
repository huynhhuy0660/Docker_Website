<?php
// Lấy thông tin từ Environment Variables trên Render
// Nếu không có (chạy ở máy cục bộ), sẽ dùng thông tin Aiven làm dự phòng
$host = getenv('DB_HOST') ?: 'mysql-1a8af744-huynhhuyy9c-b49b.e.aivencloud.com';
$port = getenv('DB_PORT') ?: '18393';
$user = getenv('DB_USER') ?: 'avnadmin';
$pass = getenv('DB_PASS') ?: 'AVNS_LnLNGqCBvCwutyF5X4j';
$dbname = getenv('DB_NAME') ?: 'defaultdb';

// Tạo kết nối tới Aiven MySQL
$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối database thất bại: " . mysqli_connect_error());
}

// Thiết lập bảng mã tiếng Việt
mysqli_set_charset($conn, "utf8mb4");
?>