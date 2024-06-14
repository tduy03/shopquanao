<?php
    
    
     // Kiểm tra nếu là yêu cầu xóa danh mục
     if (isset($_GET['id'])) {
        $id = $_GET['id'];
        deldm($id);
    }
    //hiển thị danh mục
    $kq= getall_dm();
?>
            <div class="admin-content-main">
            <div class="admin-content-main-title">
                <h1>Danh Sách Danh Mục</h1>
            </div>
            <div class="admin-content-main-content">
                <div class="admin-content-main-content-product-list">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Danh Mục</th>
                                <th>Hiển Thị</th>
                                <th>Tùy Chỉnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if((isset($kq))&&(count($kq)>0)){
                                    $i=1;
                                    foreach ($kq as $item) {
                                        echo '<tr>
                                                <td>'.$i.'</td>
                                                <td>'.$item['tendm'].'</td>
                                                <td>'.$item['hienthi'].'</td>
                                                <td>
                                                    <a class="edit-class" href="index.php?act=danhmuc_up&id='.$item['id'].'">Sửa</a>
                                                    |
                                                    <a class="delete-class" href="index.php?act=danhmuc_del&id='.$item['id'].'">Xoá</a>
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
