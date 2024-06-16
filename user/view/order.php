<?php
    // Kiểm tra nếu hành động đăng xuất được gọi
    if(isset($_GET['act']) && $_GET['act'] == 'logout') {
        session_unset();
        session_destroy();
        header('Location: index.php?act=login');  // Chuyển hướng về trang đăng nhập
        exit();
    }

    if(isset($_POST['size'])) {
        $_SESSION['selected_size'] = $_POST['size'];
    }
    $tong = 0;
?>
<body>
    <section class="user-dashboard">
        <div class="wrapper">
            <div class="sidebar">
                <h2></h2>
                <ul>
                    <li><a href="#account">Tài Khoản Của Tôi</a></li>
                    <li><a href="#orders">Đơn Hàng</a></li>
                    <li><a href="index.php?act=logout">Đăng Xuất</a></li>
                </ul>
            </div>
            <div class="main-content">
            <?php
                if (isset($_SESSION['iddh']) && $_SESSION['iddh'] > 0) {
                    $oderinfo = getoderinfo($_SESSION['iddh']);
                    
                    if (count($oderinfo) > 0) {
                        $giohang_temp = isset($_SESSION['giohang']) ? $_SESSION['giohang'] : array();
            ?>
                <h2 class="order-title">Đơn Hàng Của Tôi</h2>
                <div class="order-status">
                    <div>
                        <h3>Đang xử lí</h3>
                    </div>
                    <div>
                        <h3>Đang giao hàng</h3>
                    </div>
                    <div>
                        <h3>Đã nhận hàng</h3>
                    </div>
                    <div>
                        <h3>Huỷ đơn hàng</h3>
                    </div>
                </div>
                <div class="order-info">
                    <h3><b>Mã đơn hàng: </b><?= $oderinfo[0]['madh'] ?></h3>
                    <p><b>Tên người nhận: </b> <?= $oderinfo[0]['hoten'] ?></p>
                    <p><b>Địa chỉ:</b> <?= $oderinfo[0]['address'] ?></p>
                    <p><b>Email:</b> <?= $oderinfo[0]['email'] ?></p>
                    <p><b>Điện thoại:</b> <?= $oderinfo[0]['tel'] ?></p>
                    <h3>Phương Thức Thanh Toán</h3>
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
                    <p><?= $txtmess?></p>
                    
                </div>
                <div class="order-details">
                    <h3>Chi Tiết Sản Phẩm</h3>
                    <table>
                        <tr>
                            <th></th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                        <?php
                            if (isset($_SESSION['iddh']) && $_SESSION['iddh'] > 0) {
                                $getshowcart = getshowcart($_SESSION['iddh']);
                                if (isset($getshowcart) && count($getshowcart) > 0) {
                                    $selectedSize = $_SESSION['selected_size'] ?? '';
                                    foreach ($getshowcart as $item) {
                                        $tt = $item['soluong'] * $item['donggia'];
                                        $tong += $tt;
                                        echo '<tr>
                                                <td><img src="'.$item['img'].'" alt="" width="60px"></td>
                                                <td>
                                                    <p>'.$item['tensp'].'</p>
                                                    <p style="font-size: small;">'.$item['size'].'</p>
                                                    <p style="font-size: small;">'.number_format($item['donggia'], 0, '.', '.') .'</p>
                                                </td>
                                                <td>'.$item['soluong'].'</td>
                                                <td>'. number_format($tt, 0, '.', '.').'<sup>đ</sup></td>

                                                <td>'.$oderinfo[0]['trangthai'].'</td>
                                            </tr>';
                                    }
                                    echo '<tr>
                                            <td colspan="3" style="text-align:right;"></td>
                                            <td><div class="order-actions">
                                                   <form action="index.php?act=xacnhan" method="post" id="confirmForm">
                                                        <input type="hidden" name="order_id" value="'.$_SESSION['iddh'].'">
                                                        <input type="submit" name="confirm_order" value="Xác nhận đơn hàng" class="main-btn">
                                                    </form>
                                                    
                                                </div>  
                                                <td><div class="order-actions">
                                                    <form action="index.php?act=huy" method="post" id="confirmForm">
                                                        <input type="hidden" name="order_id" value="'.$_SESSION['iddh'].'">
                                                        <input type="submit" name="confirm_order" value="Huỷ đơn hàng" class="main-btn" style="background: #f35723;">
                                                    </form>
                                                    
                                                </div> </td>
                                            </td>
                                            <td><div class="order-actions">
                                                   
                                                </div>  
                                            </td>
                                        </tr>';
                                } else {
                                    echo 'Giỏ hàng rỗng';
                                }
                            }
                        ?>
                    </table>
                </div>
                
            <?php
                    }
                }
            ?>
            </div>
        </div>
    </section>
</body>

