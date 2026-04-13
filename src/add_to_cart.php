<?php
session_start();

// Kiểm tra xem có ID sản phẩm được gửi đến không
if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $image = $_POST['product_image'];
    $quantity = 1;

    // Cấu trúc giỏ hàng: $_SESSION['cart'][ID_Sản_Phẩm] = thông tin
    
    // Nếu giỏ hàng chưa tồn tại, tạo mới
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Nếu sản phẩm đã có trong giỏ, tăng số lượng
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        // Nếu chưa có, thêm mới vào giỏ
        $_SESSION['cart'][$id] = array(
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        );
    }
    
    // Thông báo và quay lại trang cũ
    echo "<script>alert('Đã thêm sản phẩm vào giỏ!'); window.history.back();</script>";
}
?>