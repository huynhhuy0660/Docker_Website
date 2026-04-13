<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php'; 
include 'auth.php';
$message = null;
$username_value = '';
$email_value = '';
$fullname_value = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $fullname = trim($_POST['fullname']); 
    $username_value = $username;
    $email_value = $email;
    $fullname_value = $fullname;
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($fullname)) {
        $message = ["status" => "error", "message" => "Vui lòng điền đầy đủ tất cả các trường."];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = ["status" => "error", "message" => "Địa chỉ Email không hợp lệ."];
    } elseif ($password !== $confirm_password) {
        $message = ["status" => "error", "message" => "Mật khẩu xác nhận không khớp."];
    } elseif (strlen($password) < 6) {
        $message = ["status" => "error", "message" => "Mật khẩu phải có ít nhất 6 ký tự."];
    } else {
        $message = registerUser($conn, $username, $email, $password, $fullname);
        if ($message['status'] == 'success') {
            header("Location: login.php?success=" . urlencode($message['message']));
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
    <title>Đăng Ký Tài Khoản</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/LAPTOP-WORLD.png" type="image/png">
</head>
<body>
    <main class="auth-container"> 
        <div class="auth-form"> 
            <h2>ĐĂNG KÝ TÀI KHOẢN</h2>
            
            <?php if ($message): ?>
                <div class="form-message <?php echo $message['status']; ?>">
                    <?php echo htmlspecialchars($message['message']); ?>
                </div>
            <?php endif; ?>
            <form action="register.php" method="POST">
                
                <div class="form-group">
                    <label for="fullname">Họ và Tên</label>
                    <input type="text" id="fullname" name="fullname" required value="<?php echo htmlspecialchars($fullname_value); ?>">
                </div>
                <div class="form-group">
                    <label for="username">Tên Đăng Nhập</label>
                    <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($username_value); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email_value); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mật Khẩu (ít nhất 6 ký tự)</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Xác Nhận Mật Khẩu</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="submit-btn">ĐĂNG KÝ</button>
            </form>
            <div class="form-footer">
                Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>
            </div>
        </div>
    </main>
</body>
</html>