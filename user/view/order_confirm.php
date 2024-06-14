<?php
    if (isset($_SESSION['iddh']) && $_SESSION['iddh'] > 0) {
        $oderinfo = getoderinfo($_SESSION['iddh']);
        if (count($oderinfo) > 0) {
            // Sao chép dữ liệu từ $_SESSION['giohang'] vào biến tạm thời
            $giohang_temp = isset($_SESSION['giohang']) ? $_SESSION['giohang'] : array();
?>
<section class="oder-cofirm p-to-top">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
                <p>Xác nhận đơn hàng: <span style="font-weight: bold;"><?= $oderinfo[0]['hoten'] ?>#<?= $oderinfo[0]['madh'] ?></span></p>
            </div> 
            <div class="row-flex">
                <div class="oder-cofirm-content">
                        <p>Đơn hàng của bạn đã được gửi đi <span style="font-weight: bold;">Thành Công!</span><br>
                        <span style="font-size: smaller;">Vui lòng check <span style="font-weight: bold; font-style: italic;"><a href="index.php?act=order">tại đây</a></span> để nhận và xác nhận <span style="font-weight: bold;">Đơn hàng</span></span>
                    </p>
                    <br>
                    <button class="main-btn"><a href="index.php?act=category">TIẾP TỤC MUA HÀNG</a></button>
                </div>
            </div>
            <?php
            }
        } 
        ?>
        </div>
    </section>
    <!--popular products-->
    <section class="hot-products">
        <div class="container" style="text-align: center; padding-top: 0.6%;">
           <img src="./view/asset/images/meme.jpg" alt="" style="width: 32%;">
        </div>
    </section>
