<?php
    
    // Kiểm tra xem có tham số order_id trong URL không
    if(isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $order_details = get_order_details($order_id); // Lấy thông tin chi tiết của đơn hàng từ cơ sở dữ liệu
        
    } else {
        // Nếu không có tham số order_id, chuyển hướng người dùng về trang danh sách đơn hàng
        header("Location: danh-sach-don-hang.php");
        exit();
    }
?>
<div class="admin-content-main">
                <div class="admin-content-main-title">
                    <h1>Chi Tiết Đơn Hàng</h1>
                </div>
                <div class="admin-content-main-content">
                    <div class="admin-content-main-content-order-list">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Size</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                             $i = 1;
                             $tong=0;
                            foreach ($order_details as $detail) { 
                                $tt= $detail['soluong']*$detail['donggia'];
                                $tong+=$tt;
                                $dong_gia = number_format($detail['donggia'], 0, '.', '.');
                                $thanhtien=number_format($tt, 0, '.', '.');
                                $tonghang=number_format($tong, 0, '.', '.');
                                echo '<tr>
                                    <td>'.$i.'</td>
                                    <td><img style="width: 100px;" src="'.$detail['img'].'" alt=""></td>
                                    <td>'.$detail['tensp'].'</td>
                                    <td>'. $dong_gia.'đ</td>
                                    <td>'.$detail['soluong'].'</td>
                                    <td>'.$detail['size'].'</td>
                                    <td>'.$thanhtien.'đ</td>
                                    </tr>';
                                    $i++;
                            }    
                            ?>
                                <tr>
                                    <td colspan="6"><h3>Tổng Cộng:</h3></td>
                                    <td ><h3 style="color: red;"><?php echo $tonghang; ?>đ</h3></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
        </div>
       </div>
    </section>