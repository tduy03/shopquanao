<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        del_ad($id);
    }
    $kq= getall_admin();
?>
<div class="admin-content-main">
                <div class="admin-content-main-title">
                    <h1>Danh Sách Quản Trị</h1>
                </div>
                <div class="admin-content-main-content">
                    <div class="admin-content-main-content-product-list">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ Tên</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Tên Đăng Nhập</th>
                                    <th>Phân Quyền</th>
                                    <th>Tùy Chỉnh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($kq)&&count($kq)>0){
                                        $i=1;
                                        foreach($kq as $ad){
                                            $role = $ad['role'] == 1 ? 'Quản trị viên' : 'Nhân viên';
                                            echo '<tr>
                                                <td>'.$i.'</td>
                                                <td>'.$ad['name'].'</td>
                                                <td>'.$ad['tel'].'</td>
                                                <td>'.$ad['user'].'</td>
                                                <td>'. $role.'</td>
                                                <td>
                                                    <a class="edit-class" href="index.php?act=quantri_up&id='.$ad['id'].'">Sửa</a>
                                                    |
                                                    <a class="delete-class" href="index.php?act=quantri&id='.$ad['id'].'">Xoá</a>
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