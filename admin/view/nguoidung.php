<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        del_userbuy($id);
    }
    $kq= getall_userbuy();
?>
<div class="admin-content-main">
                <div class="admin-content-main-title">
                    <h1>Danh Sách Khách Hàng</h1>
                </div>
                <div class="admin-content-main-content">
                    <div class="admin-content-main-content-product-list">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ Tên</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Email</th>
                                    <th>Ngày Tạo</th>
                                    <th>Tùy Chỉnh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($kq)&&count($kq)>0){
                                        $i=1;
                                        foreach($kq as $us){
                                            echo '<tr>
                                                <td>'.$i.'</td>
                                                <td>'.$us['name'].'</td>
                                                <td>'.$us['tel'].'</td>
                                                <td>'.$us['email'].'</td>
                                                <td>'.$us['ngaytao'].'</td>
                                                <td>
                                                    <a class="delete-class" href="index.php?act=nguoidung&id='.$us['id'].'">Xoá</a>
                                                </td>
                                            </tr>';
                                            $i++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
        </div>
       </div>
    </section>