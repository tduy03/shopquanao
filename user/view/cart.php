
<style>
   
</style>
<section class="cart">
    <div class="container">
        <div class="row-flex row-flex-cart">
            <h2>Giỏ hàng</h2>
        </div>
        <div class="cart-content row">
            <?php
            // Kiểm tra giỏ hàng có sản phẩm không
            if(isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0){
                $tong = 0;
                $i = 0;
                $selectedSize = $_SESSION['selected_size'] ?? '';
                ?>
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        foreach($_SESSION['giohang'] as $item) {
                            $tt = $item[3] * $item[4];
                            $tong += $tt;
                            echo '
                            <tr>
                                <td>
                                    <img src="'.$item[1].'" alt="">
                                </td>
                                <td><h3 style="font-size: smaller;">'.$item[2].'</h3>
                                    <p>'.$item[6].'</p>
                                    <div class="cart-price">
                                        <p>'. number_format($item[4], 0, '.', '.').'<sup>đ</sup> 
                                        <span>'.number_format($item[5], 0, '.', '.').'<sup>đ</sup></span></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-quantity-input">
                                        <i class="ri-subtract-line"></i>
                                        <input class="quantity-input" type="number" value="'.$item[3].'" required="" min="1" max="50" data-item-index="'.$i.'" name="sl" id="quantity_'.$i.'">
                                        <i class="ri-add-line"></i>
                                    </div>
                                </td>
                                <td><p style="color:rgb(178, 0, 0); font-weight: bold;">'.number_format($tt, 0, '.', '.') .'<sup>đ</sup></p></td>
                                <td><span><a href="index.php?act=delcart&i='.$i.'"><i class="ri-delete-bin-line"></i></a></span></td>
                            </tr>';
                            $i++;
                        }
                        ?>
                    </table>
                    <div class="checkout-buttons clearfix">
                        <label for="note" class="note-label h4 font-weight-bold">GHI CHÚ ĐƠN HÀNG</label>
                        <textarea class="form-control" id="note" name="note" rows="5"></textarea>
                    </div>
                </div>
                <?php
                // Hiển thị phần thông tin giỏ hàng bên phải
                ?>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2" style="padding-bottom: 11px;">
                                <i class="ri-shopping-cart-fill" style="font-size: 24px;"></i>
                            </th>
                        </tr>
                        <tr>
                            <td>TỔNG SẢN PHẨM:</td>
                            <td><?php echo count($_SESSION['giohang']); ?></td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG:</td>
                            <td><p id="total-price"><?php echo number_format($tong, 0, '.', '.') ?><sup>đ</sup></p></td>
                        </tr>
                        <tr>
                            <td>TẠM TÍNH:</td>
                            <td><p id="subtotal" style="color:black; font-weight: bold;"><?php echo number_format($tong, 0, '.', '.') ?><sup>đ</sup></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <p style="
                        text-align: center;
                        margin-left: 30px;
                        width: 80%;
                        padding: 10px 0;
                        font-family: var(--main-text-font);
                        color: aliceblue;
                        background-color: #1800b1;
                        border-radius: 50%;
                        font-weight: bold;">
                        Đơn hàng được miễn phí vận chuyển
                        </p>
                    </div>
                    <div class="cart-content-right-button">
                        <button style="font-weight: bold;"> <a href="index.php?act=category">TIẾP TỤC MUA HÀNG</a></button>
                        <?php if (isset($_SESSION['user'])): ?>
                            <form action="index.php?act=thanhtoan" method="POST">
                                <button type="submit" style="font-weight: bold;padding: 0 10px;">THANH TOÁN</button>
                            </form>
                        <?php else: ?>
                            <button style="font-weight: bold;" onclick="alert('Vui lòng đăng nhập để thanh toán'); window.location.href='index.php?act=login';">THANH TOÁN</button>
                        <?php endif; ?>
                    </div>
                    <div class="cart-content-right-dangnhap">
                        
                    </div>
                </div>
            <?php } else { ?>
                <div class="cart-empty-message">
                    <p>Giỏ Hàng Trống</p>
                    <p><img src="./view/asset/images/cart.png" alt="" width="60%"></p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>


