<?php
session_start();
// Kết nối Database - Hãy đảm bảo file db_connect.php của bạn đúng tên
include 'db_connect.php'; 
include 'google_config.php';
include 'auth.php'; // Nạp file auth.php đã sửa ở trên


require __DIR__ . '/vendor/autoload.php';
$client = new Google_Client();
$client->setClientId('764000185462-1alribgm2b9bsih0fcq5alp49lnps9q4.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost:8080/web_ban_laptop/google_callback.php');
 
$client->addScope('email');
$client->addScope('profile');
$url = $client->createAuthUrl();


if (isset($_GET['code'])) {
    // 1. Gửi yêu cầu đổi 'code' lấy 'access_token' qua thư viện CURL của PHP
    $url = 'https://oauth2.googleapis.com/token';
    $params = [
        'code'          => $_GET['code'],
        'client_id'      => $clientID,
        'client_secret'  => $clientSecret,
        'redirect_uri'   => $redirectUri,
        'grant_type'     => 'authorization_code'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response, true);

    if (isset($data['access_token'])) {
        $access_token = $data['access_token'];

        // 2. Dùng token để lấy Email và Tên từ Google
        $info_url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token;
        $user_info = json_decode(file_get_contents($info_url), true);

        $email = mysqli_real_escape_string($conn, $user_info['email']);
        $name = mysqli_real_escape_string($conn, $user_info['name']);

        // 3. Kiểm tra xem Email này đã có trong bảng users chưa
        $sql_check = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result) > 0) {
            // Khách quen: Lấy thông tin và lưu vào Session
            $user_data = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $user_data['username'];
            $_SESSION['user_id'] = $user_data['id']; // Giả sử bảng của bạn có cột id
        } else {
            // Khách mới: Tự động tạo tài khoản mới
            // Mật khẩu để trống hoặc để một chuỗi ngẫu nhiên vì họ dùng Google
            $username = explode('@', $email)[0]; // Lấy phần trước @ làm tên đăng nhập
            $sql_insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '')";
            
            if (mysqli_query($conn, $sql_insert)) {
                $_SESSION['user'] = $username;
                $_SESSION['user_id'] = mysqli_insert_id($conn);
            }
        }

        // 4. Đăng nhập thành công -> Về trang chủ
        header('Location: index.php');
        exit();

    } else {
        echo "Lỗi: Không lấy được Access Token từ Google. Hãy kiểm tra lại Client Secret.";
    }
} else {
    // Nếu không có mã code, đẩy về trang login
    header('Location: login.php');
    exit();
}
?>