<?php
session_start();
include 'db_connect.php'; // Kết nối CSDL (dựa trên file bạn đã có)

// Kiểm tra nếu giỏ hàng trống
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='container mt-5'><h3>Giỏ hàng của bạn đang trống. <a href='index.php'>Mua sắm ngay</a></h3></div>";
    exit();
}

// Lấy danh sách ID sản phẩm từ session
$cart_ids = array_keys($_SESSION['cart']);
$ids_string = implode(',', $cart_ids);

// Truy vấn lấy thông tin sản phẩm từ CSDL dựa trên ID
// LƯU Ý: Bạn cần thay 'products' bằng tên bảng thực tế trong database của bạn (ví dụ: 'san_pham', 'laptops')
$sql = "SELECT * FROM product WHERE id IN ($ids_string)";
$result = mysqli_query($conn, $sql);

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng - Web Bán Laptop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .cart-img { width: 80px; height: 80px; object-fit: cover; }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>
    
    <form action="update_cart.php" method="POST">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php 
                            $id = $row['id'];
                            $quantity = $_SESSION['cart'][$id];
                            $price = $row['price']; // Tên cột giá trong DB
                            $subtotal = $price * $quantity;
                            $total_price += $subtotal;
                            $image = 'images/' . $row['image']; // Đường dẫn ảnh
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><img src="<?php echo $image; ?>" class="cart-img" alt="Laptop"></td>
                            <td><?php echo number_format($price, 0, ',', '.'); ?> VNĐ</td>
                            <td>
                                <input type="number" name="qty[<?php echo $id; ?>]" value="<?php echo $quantity; ?>" min="1" class="form-control" style="width: 80px;">
                            </td>
                            <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                            <td>
                                <a href="remove_cart.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                    <td colspan="2" class="fw-bold text-danger"><?php echo number_format($total_price, 0, ',', '.'); ?> VNĐ</td>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary">← Tiếp tục mua sắm</a>
            <div>
                <button type="submit" name="update_btn" class="btn btn-warning">Cập nhật giỏ hàng</button>
                <a href="checkout.php" class="btn btn-primary">Thanh toán →</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>