<?php
    session_start();
    ob_start();
    if(isset($_SESSION['role'])){
    include '../model/connectdb.php';
    include '../model/danhmucdb.php';
    include '../model/sanphamdb.php';
    include '../model/donhangdb.php'; 
    include '../model/userdb.php'; 
    include '../model/userbuydb.php'; 
   
    include './view/header.php';
    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'danhmuc':
                include './view/danhmuc.php';
                break;
            case 'danhmuc_add':
                include './view/danhmuc_add.php';
                break;
            case 'danhmuc_up':
                include './view/danhmuc_up.php';
                break;
            case 'danhmuc_del':
                include './view/danhmuc.php';
                break;
            case 'sanpham':
                include './view/sanpham.php';
                break;
            case 'sanpham_add':
                include './view/sanpham_add.php';
                break;
            case 'sanpham_up':
                include './view/sanpham_up.php';
                break;
            case 'sanpham_del':
                include './view/sanpham.php';
                break;
            case 'addsp':
                include './view/sanpham.php';
                break;
            case 'donhang':
                include './view/donhang.php';
                break;
            case 'donhang_del':
                if(isset($_GET['order_id'])) {
                    $order_id = $_GET['order_id'];
                    if(delete_order($order_id)) {
                        // Điều hướng người dùng về trang danh sách đơn hàng sau khi xoá thành công
                        header("Location: ./index.php?act=donhang");
                        exit();
                    } else {
                        // Xử lý lỗi nếu có
                        echo "Xoá đơn hàng không thành công!";
                    }
                }
                break;
                case 'donhangct':
                    if(isset($_GET['order_id'])){
                        include './view/donhang_ct.php';
                    } else {
                        // Nếu không có order_id trong URL, chuyển hướng người dùng về trang danh sách đơn hàng
                        header("Location: ./index.php?act=donhang");
                        exit();
                    }
                break;
                case 'quantri':
                    include './view/quantri.php';
                    break;
                case 'quantri_add':
                    include './view/quantri_add.php';
                    break;
                case 'quantri_up':
                    include './view/quantri_up.php';
                    break;
                case 'nguoidung':
                    include './view/nguoidung.php';
                    break;
                case 'thoat':
                    if(isset($_SESSION['role']))
                    unset($_SESSION['role']);
                    header('location: login.php');
                    break;
            default:
                include './view/home.php';
                break;
        }
    }else{
        include './view/home.php';
    }
    include './view/footer.php';
}else{
    header('location: login.php');
}
?>