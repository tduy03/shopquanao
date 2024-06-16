<?php
session_start();
ob_start();
include '../model/connectdb.php';
include '../model/danhmucdb.php';
include '../model/sanphamdb.php';
include '../model/donhangdb.php';
include '../model/userbuydb.php';

connectdb();

include './view/header.php';
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'product':
            include './view/product.php';
            break;
        case 'addcart':
            // Lấy dữ liệu
            if (isset($_POST['addtocart']) && $_POST['addtocart']) {
                $id = $_POST['id'];
                $tensp = $_POST['tensp'];
                $img = $_POST['img'];
                $size = isset($_POST['size']) ? $_POST['size'] : ''; // Lấy size được chọn
                $gia = $_POST['gia'];
                $giacu = $_POST['giacu'];
                $sl = isset($_POST['sl']) && $_POST['sl'] > 0 ? $_POST['sl'] : 1;

                $fg = 0;
                $i = 0;
                foreach ($_SESSION['giohang'] as $item) {
                    if ($item[2] == $tensp && $item[6] == $size) { // So sánh cả tên sản phẩm và size
                        $slnew = $sl + $item[3];
                        $_SESSION['giohang'][$i][3] = $slnew;
                        $fg = 1;
                        break;
                    }
                    $i++;
                }
                if ($fg == 0) {
                    $item = array($id, $img, $tensp, $sl, $gia, $giacu, $size);
                    $_SESSION['giohang'][] = $item;
                }
                header('location: index.php?act=viewcart');
            }
            break;
        case 'viewcart':
            include './view/cart.php';
            break;
        case 'empty':
            include './view/empty_cart.php';
            break;
        case 'delcart':
            if (isset($_GET['i'])) {
                $i = $_GET['i'];
                unset($_SESSION['giohang'][$i]);
                $_SESSION['giohang'] = array_values($_SESSION['giohang']);
            } else {
                unset($_SESSION['giohang']);
            }
            header('location: index.php?act=viewcart');
            break;
        case 'thanhtoan':
            include './view/checkout.php';
            break;
        case 'donhang':
            if ((isset($_POST['thanhtoan'])) && ($_POST['thanhtoan'])) {
                // Lấy dữ liệu
                $tongdonhang = $_POST['tongdonhang'];
                $hoten = $_POST['hoten'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $pttt = $_POST['pttt'];
                $madh = "DYU" . rand(0, 99999);
                // Tạo đơn hàng
                // Trả về 1 id đơn hàng
                $iddh = taodonhang($madh, $tongdonhang, $pttt, $hoten, $address, $email, $tel);
                $_SESSION['iddh'] = $iddh;
                // Lưu trữ dữ liệu giỏ hàng vào biến tạm thời
                $giohang_temp = isset($_SESSION['giohang']) ? $_SESSION['giohang'] : array();
                // Xóa dữ liệu trong session giohang
                unset($_SESSION['giohang']);
                // Tiến hành thêm dữ liệu vào đơn hàng
                if ((isset($giohang_temp)) && (count($giohang_temp) > 0)) {
                    foreach ($giohang_temp as $item) {
                        addtocart($iddh, $item[0], $item[1], $item[2], $item[3], $item[4], $item[5], $item[6]);
                    }
                }
                // Lưu tổng đơn hàng vào session
                $_SESSION['tongdonhang'] = $tongdonhang;
                $_SESSION['madh'] = $madh;
                // Kiểm tra phương thức thanh toán
                if ($pttt == '1') {
                    // Chuyển hướng đến trang thanh toán VNPAY
                    header('Location: ./view/thanhtoanmomo.php');
                    exit;
                } else if ($pttt == '2') {
                    // Chuyển hướng đến trang xác nhận thanh toán tận nơi
                    header('Location: index.php?act=order_confirm');
                    exit;
                }
            }
            break;
            
            case 'xacnhan':
                if(isset($_POST['confirm_order'])) {
                    $order_id = $_POST['order_id'];
                    $status = "Đã xác nhận"; // Cập nhật trạng thái đã xác nhận
                    
                    // Gọi hàm update_order_status để cập nhật trạng thái
                    update_order_status($order_id, $status);
                    
                    // Chuyển hướng về lại trang chi tiết đơn hàng hoặc trang chủ
                    header('Location: index.php?act=order_success');
                    exit();
                }
                break;
            case 'huy':
                if(isset($_POST['confirm_order'])) {
                    $order_id = $_POST['order_id'];
                    $status = "Huỷ đơn hàng"; // Cập nhật trạng thái đã xác nhận
                    
                    // Gọi hàm update_order_status để cập nhật trạng thái
                    update_order_status($order_id, $status);
                    
                    // Chuyển hướng về lại trang chi tiết đơn hàng hoặc trang chủ
                    header('Location: index.php?act=order');
                    exit();
                }
                break;

        case 'order_confirm':
            include './view/order_confirm.php';
            break;
        case 'order_success':
            include './view/order_success.php';
            break;
        case 'order':
            include './view/order.php';
            break;
        case 'login':
            include './view/login.php';
            break;
        case 'register':
            include './view/register.php';
            break;
        case 'search':
            if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
                $keyword = $_POST['keyword'];
                $dssp = searchProducts($keyword);
                $_SESSION['dssp'] = $dssp; // Lưu kết quả tìm kiếm vào session
                include './view/category.php';
                
            } else {
                // Xử lý khi từ khóa tìm kiếm trống
                $_SESSION['dssp'] = [];
                include './view/category.php'; // Chuyển hướng tới category.php
                
            }
            break;
        case 'category':
            // Kiểm tra xem có từ khóa tìm kiếm hay không
            if (isset($_SESSION['dssp'])) {
                $dssp = $_SESSION['dssp'];
                unset($_SESSION['dssp']); // Xóa session sau khi lấy dữ liệu
            } else {
                // Lấy danh sách sản phẩm theo danh mục hoặc hiển thị tất cả
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $iddm = $_GET['id'];
                    $dssp = getall_sanphamdm($iddm, 0);
                } else {
                    $dssp = getall_sanphamdm(0, 0);
                }
            }
            
            include './view/category.php';
            break;
        case 'logout':
            session_unset();
            session_destroy();
            header('Location: index.php?act=login');
            break;
        default:
            include './view/home.php';
            break;
    }
} else {
    include './view/home.php';
}
include './view/footer.php';
?>
