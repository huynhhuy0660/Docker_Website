<?php
// Đảm bảo không có khoảng trắng trước thẻ <?php
$clientID = '764000185462-1alribgm2b9bsih0fcq5alp49lnps9q4.apps.googleusercontent.com';
$clientSecret = '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';

// HÃY KIỂM TRA DẤU GẠCH DƯỚI Ở ĐÂY
$redirectUri = 'http://localhost:8080/web_ban_laptop/google_callback.php'; 

$login_url = "https://accounts.google.com/o/oauth2/v2/auth?scope=" . urlencode('email profile') . 
             "&redirect_uri=" . urlencode($redirectUri) . 
             "&response_type=code&client_id=" . $clientID . "&access_type=online";
?>