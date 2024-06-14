<?php
    // Kết nối cơ sở dữ liệu và các hàm đã định nghĩa ở trên...

    // Số đơn hàng trên mỗi trang
    $per_page = 6;

    // Xác định trang hiện tại
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    }

    // Xác định từ khóa tìm kiếm
    $search_keyword = isset($_GET['search']) ? $_GET['search'] : '';

    // Lấy tổng số đơn hàng phù hợp với từ khóa tìm kiếm
    $total_rows = count_search_orders($search_keyword);
    $total_pages = ceil($total_rows / $per_page);

    // Kiểm tra giới hạn trang
    if ($current_page > $total_pages) {
        $current_page = $total_pages;
    }

    // Tính offset (vị trí bắt đầu của đơn hàng trong câu truy vấn)
    $offset = ($current_page - 1) * $per_page;

    // Lấy danh sách đơn hàng cho trang hiện tại
    $orders = search_orders_paginated($search_keyword, $offset, $per_page);
?>

<div class="admin-content-main">
    <div class="admin-content-main-title">
        <h1>Danh Sách Đơn Hàng</h1>
        <form method="GET" action="index.php">
            <input type="hidden" name="act" value="donhang">
            <input type="text" name="search" placeholder="Tìm Kiếm" value="<?php echo htmlspecialchars($search_keyword); ?>" style="padding: 8px 15px;border: 2px solid;margin: 8px 12px;"> 
            
        </form>
    </div>
    <div class="admin-content-main-content">
        <div class="admin-content-main-content-order-list">
            <table>
                <thead>
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Tổng Tiền Hàng</th>
                        <th>Tên</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Chi Tiết</th>
                        <th>Ngày</th>
                        <th>Trạng Thái</th>
                        <th>Tuỳ Biến</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if (isset($orders) && count($orders) > 0) {
                        foreach ($orders as $order) {
                            $order_status = get_order_status($order['id']);
                            $tong_don = number_format($order['tongdonhang'], 0, '.', '.');
                            echo '<tr>
                                    <td>'.$order['madh'].'</td>
                                    <td><p style="color: red;">'.$tong_don.'đ</p>
                                         <p style="color: blue;">';
                                            if ($order['pttt'] == 1) {
                                                echo "Ví Điện Tử MOMO";
                                            } elseif ($order['pttt'] == 2) {
                                                echo "Thanh toán tận nơi";
                                            } else {
                                                echo "Chưa Có Thanh Toán";
                                            }
                                            echo '</p>
                                    </td>
                                    <td>'.$order['hoten'].'</td>
                                    <td>'.$order['tel'].'</td>
                                    <td>'.$order['email'].'</td>
                                    <td>'.$order['address'].'</td>
                                    <td>
                                        <a class="edit-class" href="index.php?act=donhangct&order_id= '.$order['id'].'">Xem</a>
                                    </td>
                                    <td>'.date('d/m/Y H:i:s', strtotime($order['ngaydat'])).'</td>
                                    <td>
                                        <p class="status" style="
                                                        background-color: #f77125;
                                                        width: 80%;
                                                        padding: 6px;
                                                        text-align: center;
                                                        margin: 0 16px;
                                                        border-radius: 5px;
                                                        color: whitesmoke;
                                                    " >'.$order['trangthai'].'</p>
                                        <p>
                                            <select class="status-select" onchange="changeStatus(this)" style="
                                                width: 80%;
                                                padding: 6px;
                                                border: 2px solid black;
                                                border-radius: 5px;
                                                margin: 4px;
                                            ">
                                                <option value="Đang Xử Lý">Đang Xử Lý</option>
                                                <option value="Đang Giao Hàng">Đang Giao Hàng</option>
                                                <option value="Đã Nhận Hàng">Đã Nhận Hàng</option>
                                                <option value="Huỷ Đơn Hàng">Huỷ Đơn Hàng</option>
                                            </select>
                                        </p>
                                    </td>
                                    <td>
                                        <a class="delete-class" href="index.php?act=donhang_del&order_id='.$order['id'].'">Xoá</a>
                                    </td>
                                </tr>';
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
        <?php
            if ($total_pages > 1) {
                echo '<div class="pagination">';
                if ($current_page > 1) {
                    echo '<a href="index.php?act=donhang&page='.($current_page - 1).'&search='.urlencode($search_keyword).'">&laquo; Trang trước</a>';
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo '<a class="active" href="#">'.$i.'</a>';
                    } else {
                        echo '<a href="index.php?act=donhang&page='.$i.'&search='.urlencode($search_keyword).'">'.$i.'</a>';
                    }
                }
                if ($current_page < $total_pages) {
                    echo '<a href="index.php?act=donhang&page='.($current_page + 1).'&search='.urlencode($search_keyword).'">Trang sau &raquo;</a>';
                }
                echo '</div>';
            }
        ?>
    </div>
</div>
