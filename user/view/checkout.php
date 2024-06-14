
<form action="index.php?act=donhang" method="post">
<!----------Thanh toán------------------>
    <section class="delivery">
        <div class="container">
            <div class="delivery-content row">
                <div class="delivery-content-left">
                    <p>Thông tin nhận hàng</p>
                    <div class="delivery-content-left-input-top-item-big">
                        <input type="text" name="hoten" placeholder="Họ Tên">
                    </div>
                    <div class="delivery-content-left-input-top row">
                        <div class="delivery-content-left-input-top-item">
                            <label for=""> </label>
                            <input type="text" placeholder="Email" name="email">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for=""> </label>
                            <input type="tel" value="" placeholder="Số Điện Thoại" name="tel">
                        </div>
                        <div class="delivery-content-left-input-top-item-z">
                            <label for="Province"></label>
                            <select name="" id="Province" class="form-control">
                                <option value="">Tỉnh Thành</option>
                            </select>
                        </div>
                        <div class="delivery-content-left-input-top-item-z">
                            <label for="District"> </label>
                            <select name="" id="District" class="form-control">
                                <option value="">Quận Huyện</option>
                            </select>
                        </div>   
                        <div class="delivery-content-left-input-top-item-z">
                            <label for="Ward"> </label>
                            <select name="" id="Ward" class="form-control">
                                <option value="">Phường xã</option>
                            </select>
                        </div>                             
                    </div>

                    <div class="delivery-content-left-input-bottom">
                        <label for=""></label>
                        <input type="text" value="" placeholder="Địa Chỉ" name="address">
                    </div> 
                
                </div>
        
                <div class="delivery-content-right">
                    <table>
                        <tr>
                            <th style="font-weight: bold;" colspan="2">Đơn hàng (<?php echo isset($_SESSION['giohang']) ? count($_SESSION['giohang']) : 0; ?> sản phẩm)</th>
                            <th></th>
                        </tr>
                        <?php
                    
                        if((isset($_SESSION['giohang'])) && (count($_SESSION['giohang']) > 0)){
                            $tong = 0;
                            
                            foreach($_SESSION['giohang'] as $item) {
                                $tt = $item[3] * $item[4];
                                $tong += $tt;
                                
                                // Hiển thị thông tin của từng sản phẩm
                                echo '
                                <tr>
                                    <td colspan="2" style="position: relative;">
                                        <img src="'.$item[1].'" alt="">
                                        <span class="product-number" style="margin-right: 12px;">'.$item[3].'</span>
                                        <div class="product-details">
                                            <p>'.$item[2].'</p>
                                            <p>'.$item[6].'</p>
                                        </div>
                                    </td>
                                    <td><p style="padding: 10px;">'. number_format($tt).'<sup>đ</sup></p></td>
                                </tr>';
                            }
                        }
                        ?>
                            <td colspan="2"><input type="text" value="Nhập mã giảm giá"></td>
                            <td><button style="font-weight: bold;">NHẬP MÃ</button></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding-bottom:25px;" colspan="2">Tạm tính</td>
                            <td><p><?php echo number_format($tong)  ?><sup>đ</sup></p></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding-bottom:25px;" colspan="2">Phí vận chuyển</td>
                            <td>Miễn phí</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding-bottom:25px;" colspan="2">Tổng cộng</td>
                            <td><p><?php echo number_format($tong) ?><sup>đ</sup></p></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><a href="index.php?act=viewcart" style="color: #0f94f3; padding-bottom:25px;"><p><< Quay lại giỏ hàng</p></a></td>
                            <input type="hidden" name="tongdonhang" value="<?=$tong?>">
                            <td>
                                    <input type="submit" style="font-weight: bold; background-color: black; color:whitesmoke; cursor: pointer;padding: 0 5px;"" name="thanhtoan" value="THANH TOÁN">
                            </td>
                        </tr>
                        </table>
                </div>
        
            </div>
        </div>
    </section>
    <!------------Payment---------->
    <div class="container">
        <div class="payment-content row">
            <div class="payment-content-left">
                <div class="payment-content-left-mehtod-delivery">
                    <p style="font-weight: bold;">Phương thức giao hàng</p>
                    <div class="payment-content-left-mehtod-delivery-item">
                        <input checked type="radio" name="" id="">
                        <img src="./view/asset/images/png-clipart-scooter-computer-icons-vespa-scooter-angle-logo.png" alt="">
                        <label for="">Giao hàng chuyển phát nhanh (COD)</label>
                    </div>
                </div>
                <div class="payment-content-left-mehtod-payment">
                    <p style="font-weight: bold;">Phương thức thanh toán</p>
                    <div class="payment-content-left-mehtod-payment-item">
                            <input type="radio" name="pttt" id="" value="1">
                        <img src="./view/asset/images/Logo-MoMo-Circle.webp" alt="">
                        <label for="">Ví Điện Tử MOMO</label>
                    </div>
            
                    <div class="payment-content-left-mehtod-payment-item-z">
                        <input type="radio" name="pttt" id="" value="2">
                        <img src="./view/asset/images/Icon-nha-vector.png" alt="">
                        <label for="">Thanh Toán Tận Nơi</label>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

