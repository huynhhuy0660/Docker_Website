<?php
// Bật thông báo lỗi để dễ kiểm tra (khi chạy ổn định có thể tắt đi)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Khởi tạo Session nếu chưa có
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. KẾT NỐI DATABASE (ĐÃ SỬA TÊN DB CHUẨN THEO ẢNH CỦA BẠN)
$host = "localhost";
$user_db = "root";
$pass_db = "";
$name_db = "db_ban_laptop"; // <--- Đã sửa từ 'web_ban_laptop' thành 'db_ban_laptop'

$conn = mysqli_connect('db', 'laptop_user', 'userpassword', 'laptop_store');

if (!$conn) {
    die("Lỗi kết nối Database: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

// ---------------------------------------------------------
// PHẦN 3: CÁC HÀM XỬ LÝ
// ---------------------------------------------------------

/**
 * Hàm này dùng cho file google_callback.php
 * Tự động đăng ký hoặc đăng nhập khi dùng Google
 */
function loginOrRegisterGoogle($conn, $email, $fullname) {
    // Bảo mật dữ liệu
    $email = mysqli_real_escape_string($conn, $email);
    $fullname = mysqli_real_escape_string($conn, $fullname);
    
    // Kiểm tra xem email này đã có trong bảng users chưa
    $stmt = $conn->prepare("SELECT id, username, fullname, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Đã có tài khoản -> Trả về thông tin để đăng nhập
        return $result->fetch_assoc();
    } else {
        // Chưa có -> Tạo tài khoản mới
        // Lấy phần trước @ làm username
        $username = explode('@', $email)[0];
        
        // Mật khẩu để trống (vì dùng Google), Role mặc định là 0 (User thường)
        // Lưu ý: Cột 'password' trong Database phải cho phép NULL hoặc bạn để chuỗi rỗng
        $stmt_insert = $conn->prepare("INSERT INTO users (username, email, password, fullname, role) VALUES (?, ?, '', ?, 0)");
        $stmt_insert->bind_param("sss", $username, $email, $fullname);
        
        if ($stmt_insert->execute()) {
            return [
                'id' => $conn->insert_id,
                'username' => $username,
                'fullname' => $fullname,
                'role' => 0
            ];
        }
    }
    return false;
}

/**
 * Hàm Đăng ký tài khoản thường (Logic cũ của bạn)
 */
function registerUser($conn, $username, $email, $password, $fullname) {
    // Kiểm tra trùng lặp
    $stmt_check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt_check->bind_param("ss", $username, $email);
    $stmt_check->execute();
    $stmt_check->store_result();
    
    if ($stmt_check->num_rows > 0) {
        $stmt_check->close();
        return ["status" => "error", "message" => "Tên đăng nhập hoặc Email đã được sử dụng."];
    }
    $stmt_check->close();

    // Mã hóa mật khẩu và thêm mới
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt_insert = $conn->prepare("INSERT INTO users (username, email, password, fullname, role) VALUES (?, ?, ?, ?, 0)");
    $stmt_insert->bind_param("ssss", $username, $email, $hashed_password, $fullname);
    
    if ($stmt_insert->execute()) {
        $stmt_insert->close();
        return ["status" => "success", "message" => "Đăng ký thành công!"];
    } else {
        return ["status" => "error", "message" => "Lỗi đăng ký: " . $conn->error];
    }
}

/**
 * Hàm Đăng nhập thường (Logic cũ của bạn)
 */
function loginUser($conn, $login_id, $password) {
    $stmt = $conn->prepare("SELECT id, username, fullname, password, role FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $login_id, $login_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Kiểm tra mật khẩu hash
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['fullname']; 
            $_SESSION['role'] = $user['role']; 
            return ["status" => "success", "message" => "Đăng nhập thành công!"];
        }
    }
    return ["status" => "error", "message" => "Tên đăng nhập hoặc mật khẩu không đúng."];
}

function isAuthenticated() {
    return isset($_SESSION['user_id']);
}
?>