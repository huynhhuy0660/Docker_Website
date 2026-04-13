<?php
// Client ID có thể để công khai
$clientID = '764000185462-1alribgm2b9bsih0fcq5alp49lnps9q4.apps.googleusercontent.com';

// Lấy mã bí mật từ Biến môi trường (Environment Variable)
// Trên máy tính cá nhân, bạn có thể dán mã vào phần sau dấu ?: để chạy thử
$clientSecret = getenv('GOOGLE_CLIENT_SECRET') ?: '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';

$redirectUri = 'https://laptop-store-vlu.onrender.com/google_callback.php'; 

$login_url = "https://accounts.google.com/o/oauth2/v2/auth?scope=" . urlencode('email profile') . 
             "&redirect_uri=" . urlencode($redirectUri) . 
             "&response_type=code&client_id=" . $clientID . "&access_type=online";
?>