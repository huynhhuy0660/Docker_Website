<?php
// Bật hiển thị lỗi để dễ debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db_connect.php';
include 'auth.php';

// Kiểm tra giỏ hàng. Nếu rỗng thì quay về trang chủ
if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

// --- TÍNH TOÁN TỔNG TIỀN (SỬA LẠI CHO CHÍNH XÁC) ---
$total_amount = 0;
$cart_items = [];

// Lấy danh sách ID sản phẩm từ session cart
$product_ids = array_keys($_SESSION['cart']);

if (!empty($product_ids)) {
    $ids = implode(',', $product_ids);
    $sql = "SELECT * FROM product WHERE id IN ($ids)";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Ép kiểu sang số nguyên (INT) để tính toán không bị lỗi
            $price = (int)$row['price'];
            $qty = (int)$_SESSION['cart'][$row['id']];
            
            $subtotal = $price * $qty; // Thành tiền từng món
            $total_amount += $subtotal; // Cộng dồn vào tổng
            
            // Lưu dữ liệu đã tính toán vào mảng để hiển thị bên dưới
            $row['qty'] = $qty;
            $row['subtotal'] = $subtotal;
            $cart_items[] = $row;
        }
    }
}

// Xử lý khi người dùng bấm nút "XÁC NHẬN ĐẶT HÀNG"
$order_success = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    
    // Kiểm tra kỹ lại SĐT ở server (để chắc chắn)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo "<script>alert('Số điện thoại phải đúng 10 chữ số!'); window.history.back();</script>";
        exit();
    }

    $address = $_POST['address'];
    $note = $_POST['note'];
    
    // Xóa giỏ hàng sau khi đặt thành công
    unset($_SESSION['cart']);
    $order_success = true;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - LAPTOPWORLD</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/lt.png" type="image/png">
</head>
<body>

    <header>
        <div class="container header-content">
            <div class="logo">
                <a href="index.php">
                     <img src="images/LAPTOP-WORLD.png" alt="LAPTOPWORLD Logo" class="logo-image">
                </a>
            </div>
            <div class="header-icons">
                <a href="cart.php" style="text-decoration: underline;">Quay lại giỏ hàng</a>
            </div>
        </div>
    </header>

    <main class="container checkout-section">
        
        <?php if ($order_success): ?>
            <div class="order-success-message">
                <h2 style="color: #28a745; border: none;">🎉 Đặt hàng thành công!</h2>
                <p>Cảm ơn bạn đã mua hàng tại LAPTOPWORLD.</p>
                <p>Nhân viên sẽ liên hệ với bạn qua số điện thoại <strong><?php echo htmlspecialchars($phone); ?></strong> để xác nhận đơn hàng.</p>
                <br>
                <a href="index.php" class="add-to-cart-btn" style="display: inline-block; width: auto; text-decoration: none;">Tiếp tục mua sắm</a>
            </div>
        
        <?php else: ?>
            <h2>THÔNG TIN THANH TOÁN</h2>
            
            <div class="checkout-layout">
                <div class="checkout-form">
                    <form action="checkout.php" method="POST">
                        <div class="form-group">
                            <label>Họ và tên người nhận:</label>
                            <input type="text" name="fullname"  required placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" required placeholder="">
                        </div>
                        
                        <div class="form-group">
                            <label>Số điện thoại:</label>
                            <input type="tel" name="phone" required 
                                   placeholder="" 
                                   pattern="[0-9]{10}" 
                                   maxlength="10"
                                   title="Vui lòng nhập đúng 10 chữ số"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        
                        <div class="form-group">
                            <label>Địa chỉ giao hàng:</label>
                            <input type="text" name="address" required placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Ghi chú (tùy chọn):</label>
                            <input type="text" name="note" placeholder="">
                        </div>
                        
                        <button type="submit" name="place_order" class="place-order-btn">XÁC NHẬN ĐẶT HÀNG</button>
                    </form>
                </div>

                <div class="checkout-summary">
                    <h3>Đơn hàng của bạn</h3>
                    <ul>
                        <?php foreach ($cart_items as $item): ?>
                            <li>
                                <span><?php echo $item['name']; ?></span>
                                
                                <span class="qty">x<?php echo $item['qty']; ?></span>
                                
                                <span class="price"><?php echo number_format($item['subtotal'], 0, ',', '.'); ?>đ</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="checkout-total">
                        <strong>Tổng cộng:</strong>
                        <span class="total-price"><?php echo number_format($total_amount, 0, ',', '.'); ?>đ</span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </main>

</body>
</html>