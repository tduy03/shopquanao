<?php
    $error = ""; // Khởi tạo biến lưu trữ thông điệp lỗi
    $name_value = ""; 
    $email_value = ""; 
    $tel_value = "";
    if(isset($_POST['dangky'])&& $_POST['dangky']){
        $name= $_POST['name'];
        $email= $_POST['email'];
        $tel= $_POST['tel'];
        $pass = $_POST['pass'];
        $pass_confirm = $_POST['pass_confirm'];
        $ngaytao = date('Y-m-d H:i:s');
        
         // Lưu lại giá trị đã nhập vào các biến
        $name_value = $name;
        $email_value = $email;
        $tel_value = $tel;
        // Kiểm tra xem số điện thoại có đủ 10 số không
        if (!preg_match('/^\d{10}$/', $tel)) {
            // Nếu số điện thoại không đúng định dạng, lưu thông báo lỗi vào biến
            $error = "Số điện thoại phải đủ 10 số!";
        // } elseif (!preg_match('/^\d{8}$/', $pass)) {
        //     // Kiểm tra mật khẩu có từ 8 đến 12 kí tự số
        //     $error = "Mật khẩu phải chứa từ 8 đến 12 ký tự số!";
        } elseif ($pass != $pass_confirm) {
            // Nếu mật khẩu không khớp, lưu thông báo lỗi vào biến
            $error = "Mật khẩu không khớp!";
        } else {
            // Nếu mật khẩu khớp và số điện thoại đúng định dạng, tiến hành thêm người dùng vào cơ sở dữ liệu
            insert_user($name, $email, $tel, $pass,$ngaytao);
            header('location: index.php?act=login');
        }
    }
?>
<section class="login-container">
    <form action="" method="POST">
    <div class="login-header">
        
    </div>
    <div class="form-group">
        <h1>ĐĂNG KÝ</h1>
        <label for="fullname" style="color: rgb(245, 0, 0);">*</label>
        <input type="text" id="" name="name" required placeholder="Họ Và Tên" value="<?php echo $name_value; ?>">
    </div>
    
    <div class="form-group">
        <input type="email" id="" name="email" required placeholder="Email" value="<?php echo $email_value; ?>">
    </div>
    
    <div class="form-group">
        <input type="text" id="" name="tel" required placeholder="Số Điện Thoại" value="<?php echo $tel_value; ?>">
    </div>
    <div class="form-group">
        <input type="password" name="pass" id="" required placeholder="Mật Khẩu">
    </div>
    <div class="form-group">
        <input type="password" name="pass_confirm" id="" required placeholder="Nhập Lại Mật Khẩu">
    </div>
    <?php if (!empty($error)) { ?>
            <div class="error" style="color: red;"><?php echo $error; ?></div>
    <?php } ?>
    <div class="form-group group-btn">
        <input type="submit" name="dangky" value="ĐĂNG KÝ">
        
    </div>
    </form>
</section>