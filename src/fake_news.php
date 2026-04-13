<style>
    /* CSS giữ nguyên */
    .news-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;}
    .news-card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s; border: 1px solid #eee; display: flex; flex-direction: column;}
    .news-card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.2); }
    .news-img { width: 100%; height: 180px; object-fit: cover; background: #eee;}
    .news-content { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; }
    .news-tag { background: #e7f1ff; color: #007bff; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; display: inline-block; margin-bottom: 8px; width: fit-content;}
    .news-title { font-size: 16px; font-weight: bold; margin: 0 0 10px 0; color: #333; line-height: 1.4; height: 44px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;}
    .news-excerpt { font-size: 13px; color: #666; line-height: 1.5; margin-bottom: 15px; height: 60px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;}
    .read-more { margin-top: auto; font-size: 13px; color: #d70018; text-decoration: none; font-weight: bold;}
    .read-more:hover { text-decoration: underline; }
</style>

<?php
// 1. Gọi API lấy bài viết (Vẫn giữ để lấy khung)
$data = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$posts = json_decode($data, true);

// 2. KHO DỮ LIỆU TIẾNG VIỆT (Fake Data)
// ---------------------------------------------------------
// Mảng Tiêu đề
$tieu_de_tech = [
    "Đánh giá chi tiết Macbook Air M2: Vẫn là vua laptop mỏng nhẹ?",
    "Top 5 Laptop Gaming yêu thích nhất năm 2025",
    "Hướng dẫn cách vệ sinh laptop tại nhà đúng cách không lo hỏng máy",
    "Sinh viên IT nên chọn laptop nào? Cấu hình bao nhiêu là đủ?"
];

// Mảng Mô tả (Mới thêm vào để thay thế tiếng Anh)
$mo_ta_tech = [
    "Sở hữu con chip M2 mạnh mẽ cùng thiết kế vuông vức thời thượng, liệu chiếc máy này có còn đáng mua khi M3 sắp ra mắt?",
    "Tổng hợp những cỗ máy chiến game hiệu năng khủng, tản nhiệt mát rượi mà giá lại cực kỳ học sinh sinh viên.",
    "Laptop dùng lâu bị nóng và kêu to? Đừng lo, bài viết này sẽ chỉ bạn cách làm sạch bụi bẩn từ A-Z chỉ trong 15 phút.",
    "Học IT thì nên chọn máy nào, RAM bao nhiêu? Cùng tham khảo những gợi ý laptop phù hợp với sinh viên công nghệ thông tin."
];

// Mảng Ảnh (Của bạn)
$anh_cua_minh = [
    'images/macbookair.jpg',   // Ảnh 1
    'images/top5laptop.png',   // Ảnh 2
    'images/vslaptop.png',     // Ảnh 3
    'images/svit.png'          // Ảnh 4
];

// Lấy 4 bài viết để hiển thị
$demo_posts = array_slice($posts, 0, 4);
?>

<div class="news-section" style="margin-top: 50px;">
    <h3 style="border-left: 5px solid #d70018; padding-left: 10px; text-transform: uppercase;">Tin tức công nghệ mới</h3>
    
    <div class="news-grid">
        <?php foreach ($demo_posts as $index => $post): ?>
            <?php 
                // TRÁO ĐỔI DỮ LIỆU (Logic ghép nối)
                
                // 1. Lấy Tiêu đề Việt
                $title_viet = $tieu_de_tech[$index % count($tieu_de_tech)];
                
                // 2. Lấy Mô tả Việt (MỚI: Thay vì dùng substr tiếng Anh)
                $excerpt_viet = $mo_ta_tech[$index % count($mo_ta_tech)];
                
                // 3. Lấy Ảnh
                $img_url = $anh_cua_minh[$index % count($anh_cua_minh)];
                
                // Fallback nếu ảnh lỗi
                if (!file_exists($img_url)) {
                    $img_url = "https://loremflickr.com/300/200/computer?lock=" . $index;
                }
            ?>
            
            <div class="news-card">
                <img src="<?php echo $img_url; ?>" alt="News Image" class="news-img">
                
                <div class="news-content">
                    <span class="news-tag">LAPTOP NEWS</span>
                    <h4 class="news-title"><?php echo $title_viet; ?></h4>
                    
                    <p class="news-excerpt"><?php echo $excerpt_viet; ?></p>
                    
                    <a href="#" class="read-more">Xem chi tiết &rarr;</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>