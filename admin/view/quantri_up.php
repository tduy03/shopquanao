<?php
    //lấy 1 record đúng id truyền vào
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $kq1=getone_ad($id);
    }
    //cập nhật
    if(isset($_POST['capnhat'])&& $_POST['capnhat']){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $name= $_POST['name'];
            $tel= $_POST['tel'];
            $user= $_POST['user'];
            $pass= $_POST['pass'];
            $role= $_POST['role'];
            update_ad($id, $name, $tel, $user, $pass, $role);
            header('location: index.php?act=quantri');
            exit();
        }
    }
?>
<div class="admin-content-main">
    <div class="admin-content-main-title">
        <h1>Sửa Quản Trị</h1>
    </div>
    <div class="admin-content-main-content">
        <div class="admin-content-main-content-product-add">
            <div class="admin-content-main-content-left">
                <form action="index.php?act=quantri_up" method="post" enctype="multipart/form-data">
                    <div class="admin-content-main-content-two-input">
                        <?php
                            $currentRole = $kq1[0]['role'] == 1 ? 'Quản Trị Viên' : 'Nhân Viên';
                        ?>
                        <select name="role" id="">
                            <option value="<?= $kq1[0]['role'] ?>"><?= $currentRole ?></option>
                            <option value="1">Quản Trị Viên</option>
                            <option value="0">Nhân Viên</option>
                        </select>
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Họ Tên" name="name" value="<?=$kq1[0]['name']?>">
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Số Điện Thoại" name="tel" value="<?=$kq1[0]['tel']?>">
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Tên Đăng Nhập" name="user" value="<?=$kq1[0]['user']?>">
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Mật Khẩu" name="pass" value="<?=$kq1[0]['pass']?>">
                    </div>
                    <input type="hidden" name="id" id="" value="<?= $kq1[0]['id']?>">
                    <input type="submit" value="Sửa Quản Trị" name="capnhat" class="main-btn">
            </div>
            </div>
            </form>
        </div>
    </div>
</div>
</section>