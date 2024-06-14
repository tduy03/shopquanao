<?php

   //lấy 1 record đúng id truyền vào
   if(isset($_GET['id'])){
    $id = $_GET['id'];
    $kq1=getondm($id);
    }
    //cập nhật
    if(isset($_POST['capnhat'])&& $_POST['capnhat']){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $tendm = $_POST['tendm'];
            udatedm($id, $tendm);
            header('location: index.php?act=danhmuc');
            exit();
        }
    }
?>
            <div class="admin-content-main">
            <div class="admin-content-main-title">
                <h1>Sửa Danh Mục</h1>
            </div>
            <div class="admin-content-main-content">
                <div class="admin-content-main-content-product-add">
                    <div class="admin-content-main-content-left">
                    <form action="index.php?act=danhmuc_up" method="post">
                        <div class="admin-content-main-content-two-input">
                            <input type="text" name="tendm" placeholder="Tên Danh Mục" value="<?= $kq1[0]['tendm']?>">
                            <input type="hidden" name="id" id="" value="<?= $kq1[0]['id']?>">
                        </div>
                        <div class="admin-content-main-content-two-input">
                            <input type="text" placeholder="Thứ Tự">
                        </div>
                        
                        <div class="admin-content-main-content-two-input">
                            <input type="text" name="hienthi" placeholder="Hiển Thị">   
                        </div>
                        <input type="submit" name="capnhat" class="main-btn" value="Sửa Danh Mục">
                    </form>
                    </div>
             
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
    </div>
</section>
