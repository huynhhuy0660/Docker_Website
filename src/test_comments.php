<style>
    .comment-section { margin-top: 30px; border-top: 1px solid #ccc; padding-top: 20px; }
    .comment-box { background: #fff; padding: 15px; margin-bottom: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-left: 4px solid #28a745; }
    .author-info { display: flex; align-items: center; margin-bottom: 8px; }
    .avatar-circle { width: 40px; height: 40px; background-color: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #555; margin-right: 10px; font-size: 18px;}
    .author-name { font-weight: bold; color: #333; font-size: 1.1em;}
    .comment-date { font-size: 0.85em; color: #999; margin-left: 10px; font-weight: normal;}
    .comment-body { color: #555; margin-top: 5px; line-height: 1.5;}
    .rating { color: #ffc107; font-size: 0.9em; margin-left: 5px;}
</style>

<?php
// 1. Gọi API lấy khung dữ liệu
$data = file_get_contents('https://jsonplaceholder.typicode.com/comments');
$comments = json_decode($data, true);

// 2. KHO DỮ LIỆU TIẾNG VIỆT 
$ho_vn = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Huỳnh', 'Hoàng', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];
$dem_vn = ['Văn', 'Thị', 'Minh', 'Ngọc', 'Quốc', 'Gia', 'Bảo', 'Thanh', 'Thùy', 'Kim', 'Hữu', 'Đức'];
$ten_vn = ['Hùng', 'Dũng', 'Tuấn', 'Kiệt', 'Lan', 'Huệ', 'Cúc', 'Mai', 'Hương', 'Giang', 'Nam', 'Bình', 'An', 'Khánh', 'Linh', 'Chi', 'My', 'Tâm', 'Thảo', 'Vinh'];

$mau_cau_viet = [
    "Máy dùng mượt, chơi game ngon lành! Shop giao hàng nhanh.",
    "Hàng đóng gói cẩn thận, shipper thân thiện. 5 sao cho shop.",
    "Laptop đẹp như hình, giá này quá ổn áp.",
    "Pin trâu, màn hình sắc nét. Sẽ ủng hộ shop tiếp.",
    "Tư vấn nhiệt tình, cài sẵn Win nên mua về dùng luôn, rất tiện.",
    "Hơi tiếc là giao hàng chậm hơn dự kiến 1 ngày, nhưng máy tốt nên bỏ qua.",
    "Máy chạy êm ru, không bị nóng. Rất đáng tiền.",
    "Shop uy tín, có phiếu bảo hành đầy đủ. Yên tâm hẳn.",
    "Cấu hình mạnh đúng như mô tả. Render video vù vù.",
    "Mua cho em trai đi học, nó khen mãi. Cảm ơn shop!",
    "Chất lượng build máy chắc chắn, phím gõ êm tay."
];

// Hàm tạo tên ngẫu nhiên
function tao_ten_viet($ho, $dem, $ten) {
    return $ho[array_rand($ho)] . ' ' . $dem[array_rand($dem)] . ' ' . $ten[array_rand($ten)];
}

// Lấy 5 bình luận demo
$demo_comments = array_slice($comments, 0, 15);
?>

<div class="comment-section">
    <h3>Khách hàng đánh giá (hơn <?php echo count($comments); ?> lượt đánh giá)</h3>
    
    <?php foreach ($demo_comments as $index => $comment): ?>
        <?php 
            // TRÁO ĐỔI DỮ LIỆU
            $ten_moi = tao_ten_viet($ho_vn, $dem_vn, $ten_vn);
            $noi_dung_moi = $mau_cau_viet[array_rand($mau_cau_viet)];
            
            // Tạo chữ cái đầu avatar (Ví dụ: Nguyễn Văn A -> lấy chữ A)
            $ten_arr = explode(' ', $ten_moi);
            $chu_cai_dau = mb_substr(end($ten_arr), 0, 1);
        ?>
        
        <div class="comment-box">
            <div class="author-info">
                <div class="avatar-circle" style="background-color: <?php echo '#' . substr(md5($ten_moi), 0, 6); ?>;">
                    <?php echo $chu_cai_dau; ?>
                </div>
                
                <div>
                    <div class="author-name">
                        <?php echo $ten_moi; ?> 
                        <span class="rating">⭐⭐⭐⭐⭐</span>
                        <span class="comment-date">- <?php echo rand(1, 23); ?> giờ trước</span>
                    </div>
                </div>
            </div>
            
            <div class="comment-body">"<?php echo $noi_dung_moi; ?>"</div>
        </div>
    <?php endforeach; ?>
</div>