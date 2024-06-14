<?php
    // Lấy dữ liệu danh mục
    $dsdm = getall_dm();
    $selected_dm_name = '';

    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
        $iddm = $_GET['id'];
        $dssp = getall_sanphamdm($iddm, 0);

        // Tìm tên danh mục được chọn
        foreach ($dsdm as $dm) {
            if ($dm['id'] == $iddm) {
                $selected_dm_name = $dm['tendm'];
                break;
            }
        }
    } else if (isset($_SESSION['dssp'])) {
        $dssp = $_SESSION['dssp'];
        $selected_dm_name = "Kết quả tìm kiếm";
    } else {
        $dssp = getall_sanphamdm(0, 0);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view/asset/RemixIcon_Fonts_v4.2.0/fonts/remixicon.css">
   <link rel="stylesheet" href="./view/asset/css/style.css">
    <title>DYUCLOTHER</title>
</head>
<body>
    <!-----------------------------Header------------------------->
    <header id="header"> 
        <div class="container">
            <div class="row-flex">
                <div class="header-bar-icon">
                    <i class="ri-menu-line"></i>
                </div>

                <div class="header-logo">
                    <a href="index.php"><img src="./view/asset/images/meme.jpg" alt=""></a>
                </div>
                <div class="header-logo-mobile">
                    <img src="./view/asset/images/pngtree-logo-with-beautiful-angel-anime-character-png-image_9052786.png" alt="" style="width: 70px;">
                </div>
                <div class="header-nav">
                    <nav>
                        <ul>
                            <li><a href="index.php?act=category">TẤT CẢ SẢN PHẨM</a></li>
                            <?php
                                foreach ($dsdm as $dm) {
                                    // echo '
                                    // <li class="category-left-li">
                                    //     <a href="index.php?act=category&id='.$dm['id'].'">'.$dm['tendm'].'</a>
                                    // </li>';
                                    echo '<li><a href="index.php?act=category&id='.$dm['id'].'">'.$dm['tendm'].'</a></li>';
                                }
                            ?>
                            <li><a href="index.php?act=oc">BÀI VIẾT</a></li>
                        </ul>
                    </nav>
                </div>
            <div class="header-right">
            <div class="header-search">
                <form action="index.php?act=search" method="POST">
                    <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm">
                </form>
            </div>
                <div class="header-cart">
                    
                    <a href="index.php?act=viewcart">
                    <?php
                        // Kiểm tra nếu session giohang đã được khởi tạo và có phần tử
                        if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                            // Đếm số sản phẩm trong giỏ hàng
                            $soLuongSanPham = count($_SESSION['giohang']);
                        } else {
                            $soLuongSanPham = 0; // Nếu không có sản phẩm, mặc định là 0
                        }
                        ?>
                        <i class="ri-shopping-cart-line" number="<?= $soLuongSanPham ?>"></i>
                    </a>
                </div>
                <div class="header-account">
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="index.php?act=order"><i class="ri-account-circle-line"></i></a>
                <?php else: ?>
                    <a href="index.php?act=login"><i class="ri-account-circle-line"></i></a>
                <?php endif; ?>
                </div>
            </div>
            </div>
        </div>
    </header>