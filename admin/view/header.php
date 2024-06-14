<?php
    // Lấy tên người dùng từ phiên
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : "Tên Người Dùng";
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : 0; // Mặc định là nhân viên
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view/asset/RemixIcon_Fonts_v4.2.0/fonts/remixicon.css">
    <link rel="stylesheet" href="./view/asset/ckeditor5/styles.css">
    <link rel="stylesheet" href="./view/asset/css/style.css" >
    <title>Admin</title>
</head>
<body>
    <section class="admin">
       <div class="row-grid">
        <div class="admin-sidebar">
            <div class="admin-sidebar-top">
                <img src="./view/asset/image/768px-HUNRE_Logo.png" alt="">
            </div>
            <div class="admin-sidebar-content">
                <ul>
                <?php if ($role == 1): // Chỉ quản trị viên mới thấy mục này ?>
                    <li><a href=""><i class="ri-skull-line"></i>Thống Kê<i class="ri-arrow-down-s-fill"></i></a>
                        <ul class="sub-menu">
                            <div class="sub-menu-item">
                                 <li><a href="index.php"><i class="ri-star-fill"></i>Tổng Quan</a></li>
                            </div>
                         </ul>
                    </li>
                    <li><a href=""><i class="ri-skull-line"></i>Danh Mục<i class="ri-arrow-down-s-fill"></i></a>
                        <ul class="sub-menu">
                            <div class="sub-menu-item">
                                 <li><a href="index.php?act=danhmuc"><i class="ri-star-fill"></i>Danh Sách</a></li>
                                 <li><a href="index.php?act=danhmuc_add"><i class="ri-star-fill"></i>Thêm</a></li>
                            </div>
                         </ul>
                    </li>
                    <?php endif; ?>
                    <li><a href=""><i class="ri-emotion-happy-line"></i>Sản Phẩm<i class="ri-arrow-down-s-fill"></i></a>
                        <ul class="sub-menu">
                            <div class="sub-menu-item">
                                <li><a href="index.php?act=sanpham"><i class="ri-star-fill"></i>Danh Sách</a></li>
                                <li><a href="index.php?act=sanpham_add"><i class="ri-star-fill"></i>Thêm</a></li>
                            </div>
                        </ul>
                    
                    </li>
                    <li><a href=""><i class="ri-ghost-line"></i>Đơn Hàng<i class="ri-arrow-down-s-fill"></i></a>
                        <ul class="sub-menu">
                           <div class="sub-menu-item">
                                <li><a href="index.php?act=donhang"><i class="ri-star-fill"></i>Danh Sách</a></li>
                            
                           </div>
                        </ul>
                    </li>
                    <?php if ($role == 1): // Chỉ quản trị viên mới thấy mục này ?>
                    <li><a href=""><i class="ri-ghost-line"></i>Quản Trị<i class="ri-arrow-down-s-fill"></i></a>
                        <ul class="sub-menu">
                           <div class="sub-menu-item">
                                <li><a href="index.php?act=quantri"><i class="ri-star-fill"></i>Danh Sách</a></li>
                                <li><a href="index.php?act=quantri_add"><i class="ri-star-fill"></i>Thêm</a></li>
                           </div>
                        </ul>
                    </li>
                    <li><a href=""><i class="ri-ghost-line"></i>Khách Hàng<i class="ri-arrow-down-s-fill"></i></a>
                        <ul class="sub-menu">
                           <div class="sub-menu-item">
                                <li><a href="index.php?act=nguoidung"><i class="ri-star-fill"></i>Danh Sách</a></li>
                           </div>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="admin-content">
            <div class="admin-content-top">
                <div class="admin-content-top-left">
                    <ul class="flex-box">
                       
                        <li><a href="index.php?act=thoat"><p style= "font-size: 18px;"><i class="ri-home-2-line"></i><b style="color: red;">Đăng Xuất</b></p></a></li>
                    </ul>
                </div>
                <div class="admin-content-top-right">
                    <ul class="flex-box">
                        <li><i class="ri-notification-line" data-number="3"></i></li>
                        <li><i class="ri-message-2-line" data-number1="5"></i></li>
                        <li class="flex-box">
                            <img src="./view/asset/image/_2.jpg" alt="" style="width: 30px;">
                            <p><?php echo $username; ?><i class="ri-arrow-down-s-fill"></i></p>
                        </li>
                    </ul>
                </div>
            </div> 