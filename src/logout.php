<?php
session_start(); // 1. Bắt đầu session
session_unset(); // 2. Xóa tất cả biến session
session_destroy(); // 3. Hủy session
header("Location: index.php");// 4. Quay về trang chủ
exit();
?>