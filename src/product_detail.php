<?php
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php'; 
include 'auth.php'; 
$product_id = 0;
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
}
if ($product_id <= 0) {
    die("ID sản phẩm không hợp lệ!");
}
$review_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'submit_review') {
    if (!isAuthenticated()) {
        $review_message = "Vui lòng <a href='login.php'>đăng nhập</a> để gửi đánh giá.";
    } else {
        $user_id = $_SESSION['user_id'];
        $rating = (int)$_POST['rating'];
        $review_text = trim($_POST['review_text']);

        if ($rating < 1 || $rating > 5) {
            $review_message = "Vui lòng chọn số sao.";
        } else {
            $sql_insert_review = "INSERT INTO reviews (product_id, user_id, rating, review_text) 
                                VALUES (?, ?, ?, ?)
                                ON DUPLICATE KEY UPDATE 
                                    rating = VALUES(rating), 
                                    review_text = VALUES(review_text)";
            
            $stmt = $conn->prepare($sql_insert_review);
            $stmt->bind_param("iiss", $product_id, $user_id, $rating, $review_text);
            
            if ($stmt->execute()) {
                header("Location: product_detail.php?id=" . $product_id . "&review=success");
                exit();
            } else {
                $review_message = "Lỗi khi gửi đánh giá: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
if (isset($_GET['review']) && $_GET['review'] == 'success') {
    $review_message = "Cảm ơn bạn đã đánh giá sản phẩm!";
}
$sql = "SELECT 
            product.*, 
            brands.name AS brand_name 
        FROM 
            product 
        JOIN 
            brands ON product.brand_id = brands.id
        WHERE 
            product.id = $product_id";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    die("Không tìm thấy sản phẩm nào với ID này.");
}
$product = $result->fetch_assoc();
$formatted_price = number_format($product["price"], 0, ',', '.') . 'đ';
$sql_rating_avg = "SELECT 
                        AVG(rating) as avg_rating, 
                        COUNT(id) as review_count 
                   FROM reviews 
                   WHERE product_id = ?";
$stmt_avg = $conn->prepare($sql_rating_avg);
$stmt_avg->bind_param("i", $product_id);
$stmt_avg->execute();
$rating_data = $stmt_avg->get_result()->fetch_assoc();
$avg_rating = round($rating_data['avg_rating'] ?? 0, 1);
$review_count = $rating_data['review_count'] ?? 0;
$stmt_avg->close();
$sql_reviews_list = "SELECT 
                        reviews.*, 
                        users.fullname  
                     FROM 
                        reviews 
                     JOIN 
                        users ON reviews.user_id = users.id
                     WHERE 
                        reviews.product_id = ?
                     ORDER BY 
                        reviews.created_at DESC";
$stmt_list = $conn->prepare($sql_reviews_list);
$stmt_list->bind_param("i", $product_id);
$stmt_list->execute();
$reviews_result = $stmt_list->get_result(); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span>|</span>
                    <a href="#" class="welcome-user">Chào, <?php echo $_SESSION['user']; ?></a> 
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
                    <a href="category.php?category_id=1">LAPTOP</a>
                    <div class="mega-menu">
                        <div class="megamenu-column">
                            <h3>Thương hiệu</h3>
                            <a href="category.php?category_id=1&brand_id=1">ASUS</a>
                            <a href="category.php?category_id=1&brand_id=2">ACER</a>
                            <a href="category.php?category_id=1&brand_id=4">MSI</a>
                            <a href="category.php?category_id=1&brand_id=3">LENOVO</a>
                            <a href="category.php?category_id=1&brand_id=6">DELL</a>
                            <a href="category.php?category_id=1&brand_id=5">HP</a>
                        </div>
                        <div class="megamenu-column">
                            <h3>Giá bán (Laptop)</h3>
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
                            <a href="category.php?category_id=2">RAM (Nâng cấp)</a>
                            <a href="category.php?category_id=3">SSD (Ổ cứng)</a>
                        </div>
                        <div class="megamenu-column">
                            <h3>Giá bán (Linh kiện)</h3>
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
    <main class="container product-detail-section">
        <div class="product-detail-layout">
            <div class="product-image-gallery">
                <img src="images/<?php echo $product["image"]; ?>" alt="<?php echo $product["name"]; ?>">
            </div>
            <div class="product-info">
                <h1 class="product-title"><?php echo $product['name']; ?></h1>
                <div class="product-brand-detail">
                    Thương hiệu: 
                    <a href="category.php?brand_id=<?php echo $product['brand_id']; ?>">
                        <?php echo $product['brand_name']; ?>
                    </a>
                </div>
                <div class="star-rating-display">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?php if ($i <= $avg_rating): ?>
                            <span class="star-filled">&#9733;</span> 
                        <?php else: ?>
                            <span class="star-empty">&#9734;</span> 
                        <?php endif; ?>
                    <?php endfor; ?>
                    <span class="review-count">(<?php echo $review_count; ?> đánh giá)</span>
                </div>
                <div class="product-price-detail">
                    Giá:
                    <a href="#" class="product-price-box"><?php echo $formatted_price; ?></a>
                </div>
                <form action="cart_action.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    
                    <div class="form-group-quantity">
                        <label for="quantity">Số lượng:</label>
                        <input type="number" name="quantity" value="1" min="1" class="quantity-input-detail">
                    </div>
                    <div class="button-group">
                        <button type="submit" name="action" value="add" class="add-to-cart-btn">THÊM VÀO GIỎ HÀNG</button>
                        <button type="submit" name="action" value="buy_now" class="buy-now-btn">MUA NGAY</button>
                    </div>
                </form>
                <div class="specs-summary">
                    <h3>Cấu hình nổi bật</h3>
                    <ul>
                        <?php if (!empty($product['cpu'])): ?>
                            <li><strong>CPU:</strong> <span><?php echo nl2br($product['cpu']); ?></span></li>
                        <?php endif; ?>
                        
                        <?php if (!empty($product['gpu'])): ?>
                            <li><strong>GPU:</strong> <span><?php echo nl2br($product['gpu']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['ram'])): ?>
                            <li><strong>RAM:</strong> <span><?php echo nl2br($product['ram']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['storage'])): ?>
                            <li><strong>Ổ cứng:</strong> <span><?php echo nl2br($product['storage']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['display'])): ?>
                            <li><strong>Màn hình:</strong> <span><?php echo nl2br($product['display']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['port'])): ?>
                            <li><strong>Cổng kết nối:</strong> <span><?php echo nl2br($product['port']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['wifi'])): ?>
                            <li><strong>Wifi & Bluetooth:</strong> <span><?php echo nl2br($product['wifi']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['webcam'])): ?>
                            <li><strong>Webcam:</strong> <span><?php echo nl2br($product['webcam']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['os'])): ?>
                            <li><strong>Hệ điều hành:</strong> <span><?php echo nl2br($product['os']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['battery'])): ?>
                            <li><strong>Pin:</strong> <span><?php echo nl2br($product['battery']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['weight'])): ?>
                            <li><strong>Trọng lượng:</strong> <span><?php echo nl2br($product['weight']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['color'])): ?>
                            <li><strong>Màu sắc:</strong> <span><?php echo nl2br($product['color']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['material'])): ?>
                            <li><strong>Chất liệu:</strong> <span><?php echo nl2br($product['material']); ?></span></li>
                        <?php endif; ?>

                        <?php if (!empty($product['dimensions'])): ?>
                            <li><strong>Kích thước:</strong> <span><?php echo nl2br($product['dimensions']); ?></span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div> 
        <div class="product-full-description">
            <h2>Mô tả chi tiết sản phẩm</h2>
            <p><?php echo nl2br($product['description']); ?></p>
        </div>
        <div class="reviews-section">
            <h2>Đánh giá sản phẩm</h2>
            <div class="review-form">
                <?php if (isAuthenticated()): ?>
                    <form action="product_detail.php?id=<?php echo $product_id; ?>" method="POST">
                        <h4>Viết đánh giá của bạn:</h4>
                        <?php if (!empty($review_message)): ?>
                            <div class="review-message"><?php echo $review_message; ?></div>
                        <?php endif; ?>
                        <div class="form-group-rating">
                            <label>Chọn số sao:</label>
                            <select name="rating" required>
                                <option value="">-- Chọn --</option>
                                <option value="5">5 sao (Rất tốt)</option>
                                <option value="4">4 sao (Tốt)</option>
                                <option value="3">3 sao (Bình thường)</option>
                                <option value="2">2 sao (Tệ)</option>
                                <option value="1">1 sao (Rất tệ)</option>
                            </select>
                        </div>
                        <div class="form-group-rating">
                            <label>Viết bình luận (tùy chọn):</label>
                            <textarea name="review_text" placeholder="Viết đánh giá của bạn..."></textarea>
                        </div>
                        
                        <input type="hidden" name="action" value="submit_review">
                        <button type="submit" class="submit-btn">Gửi đánh giá</button>
                    </form>
                <?php else: ?>
                    <div class="review-login-prompt">
                        Vui lòng <a href="login.php">Đăng nhập</a> để viết đánh giá.
                    </div>
                <?php endif; ?>
            </div>
            <div class="review-list">
                <h3>Các đánh giá trước:</h3>
                <?php if ($reviews_result->num_rows > 0): ?>
                    <?php while($review = $reviews_result->fetch_assoc()): ?>
                        <div class="review-item">
                            <div class="review-author"><?php echo htmlspecialchars($review['fullname']); ?></div>
                            <div class="review-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= $review['rating']): ?>
                                        <span class="star-filled">&#9733;</span>
                                    <?php else: ?>
                                        <span class="star-empty">&#9734;</span>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            <div class="review-text">
                                <?php echo nl2br(htmlspecialchars($review['review_text'])); ?>
                            </div>
                            <div class="review-date">
                                <?php echo date("d/m/Y H:i", strtotime($review['created_at'])); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                <?php endif; ?>
            </div>

        </div>
    </main>
<?php
$conn->close();
?>
<div class="container">
    <?php include 'test_comments.php'; ?>
</div>
</body>
</html>