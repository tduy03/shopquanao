<?php
session_start();
ob_start();
include "../model/connectdb.php";
include "../model/userdb.php";

if (isset($_POST['dangnhap']) && $_POST['dangnhap']) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $role = check_user($user, $pass);
    if ($role != -1) {
        $_SESSION['role'] = $role;
        header('Location: index.php');
    } else {
        $txt_error = "Tên đăng nhập hoặc mật khẩu không tồn tại";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Đăng Nhập</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }
    .login-container {
        width: 300px;
        margin: 0 auto;
        margin-top: 100px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-container h2 {
        text-align: center;
    }
    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .login-container input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .login-container input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="text" name="user" placeholder="Tên đăng nhập" required>
            <input type="password" name="pass" placeholder="Mật khẩu" required>
            <input type="submit" value="Đăng Nhập" name="dangnhap">
            <?php
                if (isset($txt_error) && $txt_error != '') {
                    echo "<font>" . $txt_error . "</font>";
                }
            ?>
        </form>
    </div>
</body>
</html>
