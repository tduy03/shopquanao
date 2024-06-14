<?php
     $login_error = '';
    
     if (isset($_POST['dangnhap']) && $_POST['dangnhap']) {
         $username = $_POST['username'];
         $password = $_POST['password'];
 
         // Tách số điện thoại và email từ username
         if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
             $email = $username;
             $tel = '';
         } else {
             $email = '';
             $tel = $username;
         }
         
         if (check_userbuy($tel, $email, $password)) {
            // Lưu thông tin người dùng vào phiên làm việc
            $_SESSION['user'] = $username;
             header('Location: index.php?act=home');
             exit();
         } else {
             $login_error = 'Thông tin đăng nhập không đúng!';
         }
     }
?>
<section class="login-container">
    <form action="" method="POST">
        <div class="login-header">
            
        </div>
        <div class="form-group">
            <h1>ĐĂNG NHẬP</h1>
            <label for="username" style="color: rgb(245, 0, 0);">*</label>
            <input type="text" name="username" placeholder="Số Điện Thoại, Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Mật Khẩu" required>
        </div>
        <div class="form-group">
            <a href="#"><b>Quên mật khẩu?</b></a>
        </div>
        <?php if ($login_error): ?>
                <p style="color: red;"><?php echo $login_error; ?></p>
            <?php endif; ?>
        <div class="form-group">
            <input type="submit" value="ĐĂNG NHẬP" style="margin-left: 110px;" name="dangnhap">
        </div>
        <div class="form-group">
            <span style="font-size: small;margin-left: 32px;">Bạn chưa có tài khoản? Quý khách vui lòng <a href="index.php?act=register"><b>Đăng Ký</b></a></span><br>
        </div>
    </form>
</section>