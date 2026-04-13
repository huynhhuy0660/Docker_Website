<?php
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php'; 
$search_query = ""; 
if (isset($_GET['query'])) {
    $search_query = trim($_GET['query']); 
}
$page_title = "Kết quả tìm kiếm cho: '" . htmlspecialchars($search_query) . "'";
$search_term = "%" . $search_query . "%";
$sql_products = "SELECT 
                    product.*, 
                    brands.name AS brand_name 
                FROM 
                    product 
                JOIN 
                    brands ON product.brand_id = brands.id
                WHERE 
                    product.name LIKE ?"; 

$sql_products .= " ORDER BY product.price ASC"; 
$stmt = $conn->prepare($sql_products);
$stmt->bind_param("s", $search_term); 
$stmt->execute();
$result = $stmt->get_result(); 
if (!$result) {
    die("LỖI SQL (tìm kiếm): " . $stmt->error);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title> 
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/LAPTOP-WORLD.png" type="image/png">
</head>
<body>

    <header>
        <div class="container header-content">
            <div class="logo">
                <a href="index.php">LAPTOPWORLD</a>
            </div>
            <form class="search-bar" action="search.php" method="GET">
                <input type="text" name="query" placeholder="Tìm kiếm" required value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit">Tìm</button>
            </form>
            <div class="header-icons">
                <a href="#">Giỏ hàng</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span>|</span>
                    <a href="#" class="welcome-user">Chào, <?php echo $_SESSION['full_name']; ?></a> 
                    <span>|</span>
                    <a href="logout.php">Đăng xuất</a>
                <?php else: ?>
                    <a href="login.php">Đăng nhập</a>
                    <span>|</span>
                    <a href="register.php">Đăng ký</a>
                <?php endif; ?>
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
                            <a href="category.php?brand_id=1">ASUS</a>
                            <a href="category.php?brand_id=2">ACER</a>
                            <a href="category.php?brand_id=4">MSI</a>
                            <a href="category.php?brand_id=3">LENOVO</a>
                            <a href="category.php?brand_id=6">DELL</a>
                            <a href="category.php?brand_id=5">HP</a>
                        </div>
                        <div class="megamenu-column">
                            <h3>Giá bán</h3>
                            <a href="category.php?max_price=15000000">Dưới 15 triệu</a>
                            <a href="category.php?min_price=15000000&max_price=20000000">Từ 15 đến 20 triệu</a>
                            <a href="category.php?min_price=20000000">Trên 20 triệu</a>
                        </div>
                    </div>
                </li>
                <li><a href="#">LINH KIỆN</a></li>
                <li><a href="#">DỊCH VỤ</a></li>
                <li><a href="#">LIÊN HỆ</a></li>
            </ul>
        </div>
    </nav>
<main class="container product-section">
    <h2><?php echo $page_title; ?></h2>
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
                                <div class="product-specs">
                                    <span><?php echo $row["cpu"]; ?></span>
                                    <span><?php echo $row["gpu"]; ?></span>
                                    <span><?php echo $row["storage"]; ?></span>
                                </div>
                                <div class="product-price">
                                    <?php echo $formatted_price; ?>
                                </div>
                        </a>
                    </div>
                    <?php
                } // 
            } else {
                echo "<p>Không tìm thấy sản phẩm nào khớp với từ khóa của bạn.</p>";
            }
            $stmt->close();
            $conn->close();
            ?>
        </div> 
    </main> 
</body>
</html>