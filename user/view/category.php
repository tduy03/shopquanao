<?php
    // Lấy dữ liệu danh mục
    $dsdm = getall_dm();
    $selected_dm_name = '';
    $iddm = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $productsPerPage = 16;
    $dssp = [];

    // Kiểm tra xem có từ khóa tìm kiếm hay không
    if (isset($_SESSION['dssp'])) {
        $dssp = $_SESSION['dssp'];
        $selected_dm_name = "Kết quả tìm kiếm";
        unset($_SESSION['dssp']); // Xóa session sau khi lấy dữ liệu
    } else {
        // Lấy danh sách sản phẩm theo danh mục hoặc hiển thị tất cả
        if ($iddm > 0) {
            $dssp = getall_sanphamdm_paginated($iddm, $currentPage, $productsPerPage);
            $totalProducts = count_sanphamdm($iddm);
        } else {
            $dssp = getall_sanphamdm_paginated(0, $currentPage, $productsPerPage);
            $totalProducts = count_all_sanpham();
        }
        $totalPages = ceil($totalProducts / $productsPerPage);

        // Tìm tên danh mục được chọn
        foreach ($dsdm as $dm) {
            if ($dm['id'] == $iddm) {
                $selected_dm_name = $dm['tendm'];
                break;
            }
        }
        // Xử lý khi không có danh mục hoặc không tìm thấy sản phẩm
        if (empty($dssp)) {
            $selected_dm_name = "Không có sản phẩm";
        }
    }
?>
<style>
        /* Định dạng CSS cho phần phân trang */
       
        .pagination a {
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
            padding: 11px;
        }
        .pagination a.active {
            background-color: black;
            color: whitesmoke;
            border-radius: 5px;
            
        }
    </style>
<!-- Danh mục-->
<section class="cartegory">
    <div class="container">
        <div class="row">
            <div class="cartegory-left">
                <ul>
                    <li><b>DANH MỤC</b></li>
                    <li class="category-left-li"><a href="index.php?act=category">TẤT CẢ SẢN PHẨM</a></li>
                    <?php
                        foreach ($dsdm as $dm) {
                            echo '
                            <li class="category-left-li">
                                <a href="index.php?act=category&id='.$dm['id'].'">'.$dm['tendm'].'</a>
                                
                            </li>';
                            
                        }
                        
                    ?>
                    <li class="category-left-li"><a href="">QUẦN</a></li>
                    <li class="category-left-li"><a href="">ÁO</a></li>
                </ul>
            </div>
            <div class="cartegory-right row">
                <div class="cartegory-right-top-item">
                    <p><?php echo htmlspecialchars($selected_dm_name); ?></p>
                </div>
                <div class="cartegory-right-top-item">
                    <select name="" id="">
                        <option value="">Bộ lọc</option>
                    </select>
                </div>
                <div class="cartegory-right-top-item">
                    <select name="" id="">
                        <option value="">Sắp xếp</option>
                        <option value="">Giá cao đến thấp</option>
                        <option value="">Giá thấp đến cao</option>
                    </select>
                </div>
                <div class="cartegory-right-content row">
                    <?php
                        foreach ($dssp as $sp) {
                            echo '<div class="cartegory-right-content-item">
                                    <a href="index.php?act=product&id='.$sp['id'].'"><img src="'.$sp['img'].'" alt="">
                                    <h1>'.$sp['tensp'].'</h1></a>
                                    <p>'.number_format($sp['gia'], 0, '.', '.').'<sup>đ</sup> <span style="font-weight: 300;
                                                                    font-size: small;
                                                                    text-decoration: line-through;">'.number_format($sp['giacu'], 0, '.', '.').'<sup>đ</sup></span></p></div>';
                        }
                    ?>
                </div>
                </div>
                    <div class="category-right-bottom">
                        <div class="pagination" style="margin-left: 856%;margin-top: 22px;">
                            <?php
                                // Hiển thị các nút phân trang
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    echo '<a href="index.php?act=category&id='.$iddm.'&page='.$i.'" ';
                                    if ($i == $currentPage) echo ' class="active"';
                                    echo '>'.$i.'</a>';
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Script để xử lý sự kiện khi thay đổi sắp xếp
        function sortProducts() {
            var sortValue = document.getElementById("sort").value;
            // Thực hiện xử lý sắp xếp
            // Ví dụ: có thể dùng AJAX để gửi yêu cầu sắp xếp lên server và cập nhật danh sách sản phẩm
        }
        
    </script>