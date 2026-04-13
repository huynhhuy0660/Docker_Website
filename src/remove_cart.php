<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]); // Xóa ID khỏi session
}
header("Location: cart.php"); // Quay lại trang giỏ hàng
exit();
?>