<?php
    if(isset($_POST['themmoi']) && $_POST['themmoi']){
        $name= $_POST['name'];
        $tel= $_POST['tel'];
        $user= $_POST['user'];
        $pass= $_POST['pass'];
        $role= $_POST['role'];
        insert_ad($name, $tel, $user, $pass, $role);
        header('location: index.php?act=quantri');
    }
?>
<div class="admin-content-main">
    <div class="admin-content-main-title">
        <h1>Thêm Quản Trị</h1>
    </div>
    <div class="admin-content-main-content">
        <div class="admin-content-main-content-product-add">
            <div class="admin-content-main-content-left">
                <form action="index.php?act=quantri_add" method="post" enctype="multipart/form-data">
                    <div class="admin-content-main-content-two-input">
                        <select name="role" id="">
                            <option value="">Phân Quyền</option>
                            <option value="1">Quản Trị Viên</option>
                            <option value="0">Nhân Viên</option>
                        </select>
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Họ Tên" name="name">
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Số Điện Thoại" name="tel">
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Tên Đăng Nhập" name="user">
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Mật Khẩu" name="pass">
                    </div>
                    <input type="submit" value="Thêm Quản Trị" name="themmoi" class="main-btn">
            </div>
            </div>
            </form>
        </div>
    </div>
</div>
</section>