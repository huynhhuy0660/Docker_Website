<?php
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php'; 
include 'auth.php'; 
$brand_id = 0;
$min_price = 0;
$max_price = 0;
$category_id = 0; 

$page_title = "Sản phẩm"; 
$conditions = [];
if (isset($_GET['brand_id'])) {
    $brand_id = (int)$_GET['brand_id'];
    if ($brand_id > 0) {
        $conditions[] = "product.brand_id = $brand_id";
    }
}
if (isset($_GET['min_price'])) {
    $min_price = (int)$_GET['min_price'];
    if ($min_price > 0) {
        $conditions[] = "product.price >= $min_price";
    }
}
if (isset($_GET['max_price'])) {
    $max_price = (int)$_GET['max_price'];
    if ($max_price > 0) {
        $conditions[] = "product.price <= $max_price";
    }
}
if (isset($_GET['category_id'])) {
    $category_id = (int)$_GET['category_id'];
    if ($category_id > 0) {
        $conditions[] = "product.category_id = $category_id";
    }
}
if ($category_id > 0) {
    $sql_cat = "SELECT name FROM categories WHERE id = $category_id";
    $result_cat = $conn->query($sql_cat);
    if ($result_cat && $result_cat->num_rows > 0) {
        $cat_row = $result_cat->fetch_assoc();
        $page_title = $cat_row['name']; 
    }
} 
else if ($brand_id > 0) {
    $sql_brand = "SELECT name FROM brands WHERE id = $brand_id";
    $result_brand = $conn->query($sql_brand);
    if ($result_brand && $result_brand->num_rows > 0) {
        $brand_row = $result_brand->fetch_assoc();
        $page_title = "Laptop " . $brand_row['name']; 
    }
} 
if ($min_price > 0 && $max_price > 0) {
    $page_title .= " (Từ " . number_format($min_price) . "đ đến " . number_format($max_price) . "đ)";
} else if ($min_price > 0) {
    $page_title .= " (Trên " . number_format($min_price) . "đ)";
} else if ($max_price > 0) {
    $page_title .= " (Dưới " . number_format($max_price) . "đ)";
}
$sql_products = "SELECT 
                    product.*, 
                    brands.name AS brand_name,
                    categories.name AS category_name
                FROM 
                    product 
                JOIN 
                    brands ON product.brand_id = brands.id
                LEFT JOIN
                    categories ON product.category_id = categories.id"; 

if (!empty($conditions)) {
    $sql_products .= " WHERE " . implode(" AND ", $conditions);
} else {
    $page_title = "Tất cả sản phẩm";
}
$sql_products .= " ORDER BY product.price ASC"; 
$result = $conn->query($sql_products);
if (!$result) {
    die("LỖI SQL (lọc): " . $conn->error);
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
                <a href="index.php">
                    <img src="images/lt.png" alt="LAPTOPWORLD Logo" class="logo-image">
                </a>
            </div>
            <form class="search-bar" action="search.php" method="GET">
                <input type="text" name="query" placeholder="Tìm kiếm" required>
                <button type="submit">Tìm</button>
            </form>
            <div class="header-icons">
                <a href="#">Giỏ hàng</a>
                
                <?php
                if (isAuthenticated()) { 
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
                        <a href="category.php?category_id=1">LAPTOP</a>
                        <div class="mega-menu">
                            <div class="megamenu-column">
                                <h3>Thương hiệu</h3>
                                <a href="category.php?category_id=1&brand_id=1&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>">ASUS</a>
                                <a href="category.php?category_id=1&brand_id=2&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>">ACER</a>
                                <a href="category.php?category_id=1&brand_id=3&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>">LENOVO</a>
                                <a href="category.php?category_id=1&brand_id=4&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>">MSI</a>
                                <a href="category.php?category_id=1&brand_id=5&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>">HP</a>
                                <a href="category.php?category_id=1&brand_id=6&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>">DELL</a>
                            </div>
                            <div class="megamenu-column">
                                <h3>Giá bán (Laptop)</h3>
                                <a href="category.php?category_id=1&max_price=20000000&brand_id=<?php echo $brand_id; ?>">Dưới 20 triệu</a>
                                <a href="category.php?category_id=1&min_price=20000000&max_price=30000000&brand_id=<?php echo $brand_id; ?>">Từ 20 - 30 triệu</a>
                                <a href="category.php?category_id=1&min_price=30000000&brand_id=<?php echo $brand_id; ?>">Trên 30 triệu</a>
                            </div>
                        </div>
                    </li>
                    <li class="megamenu-trigger">
                        <a href="category.php?category_id=2">LINH KIỆN</a>
                        <div class="mega-menu">
                            <div class="megamenu-column">
                                <h3>Loại Linh Kiện</h3>
                                <a href="category.php?category_id=2&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>">RAM (Nâng cấp)</a>
                                <a href="category.php?category_id=3&min_price=<?php echo $min_price; ?>&max_price=<?php echo $max_price; ?>">SSD (Ổ cứng)</a>
                            </div>
                            <div class="megamenu-column">
                                <h3>Giá bán (Linh kiện)</h3>
                                <a href="category.php?category_id=<?php echo $category_id; ?>&max_price=1000000&brand_id=0">Dưới 1 triệu</a>
                                <a href="category.php?category_id=<?php echo $category_id; ?>&min_price=1000000&max_price=3000000&brand_id=0">Từ 1 đến 3 triệu</a>
                                <a href="category.php?category_id=<?php echo $category_id; ?>&min_price=3000000&brand_id=0">Trên 3 triệu</a>
                            </div>
                        </div>
                    </li>
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
                echo "<p>Không tìm thấy sản phẩm nào phù hợp với điều kiện lọc.</p>";
            }
            $conn->close();
            ?>
        </div> 
    </main> 
</body>
</html>