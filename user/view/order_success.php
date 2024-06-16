<?php
    if (isset($_SESSION['iddh']) && $_SESSION['iddh'] > 0) {
        $oderinfo = getoderinfo($_SESSION['iddh']);
        if (count($oderinfo) > 0) {
            // Sao chép dữ liệu từ $_SESSION['giohang'] vào biến tạm thời
            $giohang_temp = isset($_SESSION['giohang']) ? $_SESSION['giohang'] : array();
?>
<body>
<section class="oder-cofirm p-to-top">
    <div class="container">
        <div class="row-flex row-flex-product-detail">
            <p>Xác nhận đơn hàng: <span style="font-weight: bold;"><?= $oderinfo[0]['hoten'] ?>#<?= $oderinfo[0]['madh'] ?></span></p>
        </div> 
        <div class="row-flex">
            <div class="oder-cofirm-content">
                <p>Đơn hàng của bạn đã được xác nhận <span style="font-weight: bold;">Thành Công!</span><br>
                <span style="font-size: smaller;">Chúng tôi sẽ <span style="font-weight: bold; font-style: italic;">Giao hàng </span> tối đa là <span style="font-weight: bold;">3 ngày</span> làm việc</span>
                </p>
                <br>
                <button class="main-btn"><a href="index.php?act=category">TIẾP TỤC MUA HÀNG</a></button>
            </div>
        </div>
        <div class="row-flex">
        
            <div class="info-left" style="
                        background-color: #f9862d;
                        width: 30%;
                        margin-left: 15%;
                        padding: 20px 10px;
                        margin-top: 12px;
                        border-radius: 5px;">
                <h3>Thông tin người nhận</h3>
                <p><b>Mã đơn hàng: <?= $oderinfo[0]['madh'] ?></b></p>
                <p><b>Tên người nhận:</b> <?= $oderinfo[0]['hoten'] ?></p>
                <p><b>Email:</b> <?= $oderinfo[0]['email'] ?></p>
                <p><b>Địa chỉ:</b> <?= $oderinfo[0]['address'] ?></p>
                <p><b>Số điện thoại:</b> <?= $oderinfo[0]['tel'] ?></p>
                <?php
                switch ($oderinfo[0]['pttt']) {
                    case '1':
                        $txtmess = "Ví Điện Tử MOMO";
                        break;
                    case '2':
                        $txtmess = "Thanh toán tận nơi";
                        break;
                    default:
                        $txtmess = "Chưa chọn phương thức thanh toán";
                        break;
                }
                ?>
                <p><b>Phương thức thanh toán:</b> <?= $txtmess ?></p>
            </div>
            <div class="info-right">
                <h3>Thông tin đơn hàng</h3>
                <?php
                if (isset($_SESSION['iddh']) && $_SESSION['iddh'] > 0) {
                    $getshowcart = getshowcart($_SESSION['iddh']);
                    if (isset($getshowcart) && count($getshowcart) > 0) {
                        // Khởi tạo biến tổng
                        $selectedSize = $_SESSION['selected_size'] ?? '';
                        $tong = 0;
                        foreach ($getshowcart as $item) {
                            $tt = $item['soluong'] * $item['donggia'];
                            $tong += $tt;
                            echo '
                            <div class="product-info">
                                <div class="product-image-container">
                                    <img src="'.$item['img'].'" alt="Ảnh sản phẩm" class="product-image">
                                </div>
                                <div class="product-details">
                                    <p><b>Sản phẩm:</b> '.$item['tensp'].'</p>
                                    <p><b>Size:</b> '.$item['size'].'</p>
                                    <p><b>Giá:</b> '.number_format($item['donggia'], 0, '.', '.') .'đ</p>
                                    <p><b>Số lượng:</b> '.$item['soluong'].'</p>
                                    <p><b>Thành tiền:</b> '. number_format($tt, 0, '.', '.').'đ</p>
                                </div>
                            </div>';
                        }
                    } else {
                        echo 'Giỏ hàng rỗng';
                    }
                }
                ?>
            </div>
        </div>
        <?php
            }
        } else {
            echo 'Không có thông tin đơn hàng.';
        }
        ?>
    </div>
</section>
</body>
