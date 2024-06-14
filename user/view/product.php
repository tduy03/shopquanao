<?php
    if(isset($_GET['id'])&&($_GET['id']>0)){
        $id= $_GET['id'];
        $kq= getonesp($id);
    }
    
?>
<!--Product detail-->
<section class="product-detail p-to-top">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
               <p ><h2>SẢN PHẨM</h2></p><i class="ri-arrow-right-line"></i>
               <p><?php 
                    if(isset($kq) && count($kq)>0){
                        echo $kq[0]['tensp'];
            
                    }else{
                        echo "No";
                    }
               ?></p>
            </div>
            <form action="index.php?act=addcart" method="post">
    <div class="row-grid">                
        <div class="product-detail-left">
            <img class="main-image" src="<?= $kq[0]['img']?>" alt="">
            <div class="product-images-items">
            <?php
                // Lấy các ảnh sản phẩm bổ sung từ hàm get_product_images($id)
                $product_images = get_product_images($kq[0]['id']);
                
                // Hiển thị các ảnh sản phẩm bổ sung
                foreach ($product_images as $image) {
                    echo '<img src="'.$image['img'].'" alt="Ảnh sản phẩm">';
                }
            ?>
            </div>
        </div>
        
        <div class="product-detail-right">
            <div class="product-detail-right-infor">
                <h1><?= $kq[0]['tensp']?></h1>
                <span><?= $kq[0]['chatlieu']?></span>
                <div class="product-item-price">
                    <p><?= number_format($kq[0]['gia']) ?><sup>đ</sup> <span><?= number_format($kq[0]['giacu'])?><sup>đ</sup></span></p>
                </div>
            </div>
            <div class="product-detail-right-des">
                <h2>Đặc điểm nổi bật</h2>
                <ul>
                    <li>Chất liệu: Cotton cao cấp</li>
                    <li>Graphic: In mặt trước và mặt sau</li>
                    <li>Kỹ thuật: in lụa </li>
                    <li>Phù hợp mặc đi chơi, mặc hàng ngày</li>
                    <li>Đây là sản phẩm thuộc Clean Vietnam Collection ,sản xuất tại Nhà máy DyuClother</li>
                    <li>Mục tiêu dự án đến 2023 sẽ tái chế được 500.000 chai nhựa thành sợi và sản xuất thành sản phẩm tốt về công năng</li>
                    <li>Người mẫu cao 180cm - 68kg, mặc áo XL</li>
                </ul>
            </div>
        
            <div class="product-detail-right-quantity">
                <h2>Số lượng:</h2>
                <div class="product-detail-right-quantity-input">
                    <i class="ri-subtract-line"></i>
                        <input class="quantity-input" type="number" value="1" required="" name="sl" min=1 max=50>
                    <i class="ri-add-line"></i>
                </div>
            </div>
            <div class="product-detail-right-size">
                <h2>Size:</h2>
                <div class="product-detail-right-size-c">
                <?php
                    $sizes = explode(',', $kq[0]['size']); // Giả sử kích cỡ được lưu trữ dưới dạng chuỗi "S,M,L,XL"
                    foreach ($sizes as $size) {
                        $id = 'size-' . htmlspecialchars($size); // Tạo một ID duy nhất cho mỗi checkbox
                        echo '<div class="size-option">
                                <input type="radio" id="' . $id . '" class="size-checkbox" name="size" value="' . htmlspecialchars($size) . '">
                                <label for="' . $id . '" class="size-label">' . htmlspecialchars($size) . '</label>
                            </div>';
                    }
                ?>
                </div>
            </div>
            <div class="product-detail-right-addcart">
                <input type="hidden" value="<?= $kq[0]['id']?>" name="id">
                <input type="hidden" value="<?= $kq[0]['img']?>" name="img">
                <input type="hidden" value="<?= $kq[0]['tensp']?>" name="tensp">
                <input type="hidden" value="<?= $kq[0]['gia']?>" name="gia">
                <input type="hidden" value="<?= $kq[0]['giacu']?>" name="giacu">
                <input type="submit" name="addtocart" class="main-btn" value="ĐẶT HÀNG">
            </div>
        </div>
    </div>
</form>
    <!--product-detial-content-->
            <div class="row-flex">
                <div class="product-detail-content">
                    <h2>Chi tiết sản phẩm</h2>
                    <p> Đây là những chiếc áo thun in hình trong dự án Clean Vietnam của DyuClother làm từ chất liệu Cotton kết hợp cùng chất liệu Polyester được tái chế từ các vỏ chai nhựa. 
                        <h3> Đặc điểm nổi bật áo thun In Heal The World Clean Vietnam</h3>
                         "Clean Vietnam" là dự án cộng đồng tâm huyết của Coolmate và đối tác của mình - Nam Anh Fabric và nghệ sĩ Vietmax với mong muốn nâng cao nhận thức về việc hạn chế sử dụng chai nhựa, tăng cường việc tái chế và tái sử dụng đồ nhựa, góp phần vì một Việt Nam thật xanh nói riêng. 
                         <img src="./view/asset/images/bia/ao-thun-nam-form-rong_(1).png" alt="">
                         <li>- Mềm mại và không gây khó chịu khi mặc </li>
                         <li>- Chất liệu co giãn 4 chiều đem lại sự thoải mái suốt ngày dài </li>
                         <li>- Bền dai, không bai, nhão, xù lông </li>
                         <li>- Tự hào sản xuất tại Việt Nam </li>
                         <li>- Mục tiêu dự án đến 2023 sẽ tái chế được 500.000 chai nhựa thành sợi và sản xuất thành sản phẩm tốt về công năng </li>
                        <h3>Chất liệu áo thun In Heal The World Clean Vietnam</h3> 
                         Chất liệu của chiếc áo thun in Heal The World Clean Vietnam chủ yếu là 80% Cotton và còn lại là 20% Recycle Polyester. Chiếc áo thun cotton này mang lại cho người mặc cảm giác thoải mái, dễ chịu nhờ khả năng hút ẩm cao và thấm hút tốt. 
                         <li> Áo thun cotton có độ bền cao, nhanh khô, sử dụng cả khi cho vào máy giặt. </li>
                        <h3>Thiết kế áo thun In Heal The World Clean Vietnam</h3>
                         Vẫn là kiểu áo thun nam dáng suông phù hợp với những người không thích dáng oversize, dáng rộng nhưng vẫn tôn dáng người lên khi mặc. 
                         <li> Phần cổ áo kết hợp giữa 75% cotton và 25% sợi sorona giúp ôm tốt hơn và không bị co giãn sau khi sử dụng lâu dài.</li>
                         <img src="./view/asset/images/bia/ao-thun-nam-form-regularfit_(1).png" alt="">
                        <h3>Mix & Match áo thun In Heal The World Clean Vietnam</h3>
                        DyuClother cho ra mắt chỉ duy nhất màu xanh đúng với tên dự án "Clean Vietnam". Chính vì màu sắc cơ bản, dễ mix đồ bạn có thể mix cùng mọi mẫu quần nam khác nhau. 
                         <li> Bạn muốn trở nên lịch sự khi đi làm hoặc đi chơi mix chiếc áo thun DyuClother cùng chiếc quần jean hoặc quần jogger. </li>
                         <li> Khi ở nhà, bạn muốn thoải mái vận động hằng ngày hãy mix cùng chiếc quần short. </li>
                        <h3>Cách bảo quản áo thun In Heal The World Clean Vietnam</h3> 
                         <li>- Giặt riêng áo màu và áo trắng tránh gây phai màu ra các áo trắng</li>
                         <li>- Nên giặt những chiếc áo thun với nước lạnh hoặc nước ấm dưới 40 độ C</li>
                         <li>- Không sử dụng nước tẩy hoặc bột giặt có có độ tẩy cao Không nên để áo thun ở những nơi ẩm ướt, với tính chất hút ẩm, hút nước tốt, áo thun dễ bị ẩm mốc, thậm chí để lại những vết ố trên vải áo.</li></p>

                </div>
            </div>
        </div>
    </section>