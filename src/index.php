<?php
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php'; 

$sql = "SELECT 
            product.*, 
            brands.name AS brand_name 
        FROM 
            product 
        JOIN 
            brands ON product.brand_id = brands.id
        ORDER BY 
            product.id DESC"; 
$result = $conn->query($sql);

if (!$result) {
    die("LỖI SQL: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPTOPWORLD</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/LAPTOP-WORLD.png" type="image/png">
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">
                <a href="index.php">
                    <img src="images/lt.png" alt="LAPTOPWORLD Logo" class="logo-image">
                </a>
            </div>
            <form class="search-bar" action="search.php" method="GET">
                <input type="text" name="query" placeholder="Tìm kiếm" required>
                <button type="submit">Tìm</button>
            </form>
            <div class="header-icons">
                <a href="cart.php" class="btn btn-outline-success">
                    <i class="fa fa-shopping-cart"></i> Xem Giỏ Hàng 
                    (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
                </a>
                <?php
                if (isset($_SESSION['user_id'])) {
                    ?>
                    <span>|</span>
                    <a href="#" class="welcome-user">Chào, <?php echo $_SESSION['user']; ?></a> 
                    <span>|</span>
                    <a href="logout.php">Đăng xuất</a>
                    <?php
                } else {
                    ?>
                    <a href="login.php">Đăng nhập</a>
                    <span>|</span>
                    <a href="register.php">Đăng ký</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </header>
    <nav class="main-nav">
        <div class="container">
            <ul>
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li class="megamenu-trigger">
                    <a href="#">LAPTOP</a>
                    <div class="mega-menu">
                        <div class="megamenu-column">
                            <h3>Thương hiệu</h3>
                            <a href="category.php?category_id=1&brand_id=1">ASUS</a>
                            <a href="category.php?category_id=1&brand_id=2">ACER</a>
                            <a href="category.php?category_id=1&brand_id=3">LENOVO</a>
                            <a href="category.php?category_id=1&brand_id=4">MSI</a>
                            <a href="category.php?category_id=1&brand_id=5">HP</a>
                            <a href="category.php?category_id=1&brand_id=6">DELL</a>
                        </div>
                        <div class="megamenu-column">
                            <h3>Giá bán</h3>
                            <a href="category.php?category_id=1&max_price=20000000">Dưới 20 triệu</a>
                            <a href="category.php?category_id=1&min_price=20000000&max_price=30000000">Từ 20 - 30 triệu</a>
                            <a href="category.php?category_id=1&min_price=30000000">Trên 30 triệu</a>
                        </div>
                    </div>
                </li>
                <li class="megamenu-trigger">
                    <a href="category.php?category_id=2">LINH KIỆN</a> 
                    <div class="mega-menu">
                        <div class="megamenu-column">
                            <h3>Loại Linh Kiện</h3>
                            <a href="category.php?category_id=2">RAM</a>
                            <a href="category.php?category_id=3">SSD</a>
                        </div>
                        <div class="megamenu-column">
                            <h3>Giá bán</h3>
                            <a href="category.php?max_price=1000000">Dưới 1 triệu</a>
                            <a href="category.php?min_price=1000000&max_price=3000000">Từ 1 đến 3 triệu</a>
                            <a href="category.php?min_price=3000000">Trên 3 triệu</a>
                        </div>
                    </div>
                </li>
                <li><a href="#">DỊCH VỤ</a></li>
                <li><a href="#">LIÊN HỆ</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php include 'fake_news.php'; ?>
    </div>
    <main class="container product-section">
        <h2>Tất cả sản phẩm</h2>
        <div class="product-grid">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $formatted_price = number_format($row["price"], 0, ',', '.') . 'đ';
            ?>
                    <div class="product-card">
                        <a href="product_detail.php?id=<?php echo $row["id"]; ?>">
                            <img src="images/<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>">
                            <h3 class="product-name"><?php echo $row["name"]; ?></h3>
                                <?php if ($row["category_id"] == 1): ?>
                                <div class="product-specs">
                                    <span><?php echo $row["cpu"]; ?></span>
                                    <span><?php echo $row["ram"]; ?></span>
                                    <span><?php echo $row["storage"]; ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <div class="product-price">
                                    <?php echo $formatted_price; ?>
                                </div>
                        </a>
                    </div>
                    <?php
                } 
            } else {
                echo "<p>Hiện chưa có sản phẩm nào.</p>";
            }
            $conn->close();
            ?>
        </div> 
    </main> 
    <div class="container">
        <?php include 'test_comments.php'; ?>
    </div>
</body>
</html>