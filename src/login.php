<?php
// Bật hiển thị lỗi (PHẢI NẰM TRÊN CÙNG)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'google_config.php';
include 'db_connect.php'; 
include 'auth.php'; // Chứa hàm loginUser

// Nếu đã đăng nhập rồi thì chuyển về trang chủ
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$message = null;
$login_id_value = ''; // Giữ lại giá trị user đã nhập

// Xử lý thông báo thành công sau khi đăng ký
if (isset($_GET['success'])) {
    $message = ["status" => "success", "message" => htmlspecialchars($_GET['success'])];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $login_id = trim($_POST['login_id']); // Có thể là username hoặc email
    $password = $_POST['password'];
    $login_id_value = $login_id; // Giữ lại tên đăng nhập

    // Kiểm tra dữ liệu hợp lệ
    if (empty($login_id) || empty($password)) {
        $message = ["status" => "error", "message" => "Vui lòng nhập Tên đăng nhập/Email và Mật khẩu."];
    } else {
        // Gọi hàm đăng nhập
        $message = loginUser($conn, $login_id, $password);

        // Nếu đăng nhập thành công, chuyển hướng đến trang chủ
        if ($message['status'] == 'success') {
            header("Location: index.php");
            exit;
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Hệ Thống</title>
    <!-- Link đến file CSS chung -->
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/LAPTOP-WORLD.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="auth-container"> <!-- Class CSS mới từ file .rar -->
        <div class="auth-form"> <!-- Class CSS mới từ file .rar -->
            <h2>ĐĂNG NHẬP</h2>
            
            <?php if ($message): ?>
                <div class="form-message <?php echo $message['status']; ?>">
                    <?php echo htmlspecialchars($message['message']); ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                
                <div class="form-group">
                    <label for="login_id">Tên Đăng Nhập hoặc Email</label>
                    <input type="text" id="login_id" name="login_id" required value="<?php echo htmlspecialchars($login_id_value); ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Mật Khẩu</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="submit-btn">ĐĂNG NHẬP</button>
                <div style="text-align: center; margin: 15px 0; color: #888;">Hoặc</div>
                <a href="<?php echo $login_url; ?>" class="google-btn-custom">
                    <i class="fab fa-google" style="color: #4285F4; margin-right: 10px;"></i>
                    <span>Tiếp tục với Google</span>
                </a>
              
            </form>

            <div class="form-footer">
                <a href="#">Quên Mật Khẩu?</a> | <!-- Tạm thời trỏ href="#" -->
                <a href="register.php">Đăng Ký Tài Khoản Mới</a>
            </div>
        </div>
    </main>

</body>
</html>