<?php
// Lấy số lượng đơn hàng theo từng trạng thái
$new_and_pending_orders = count_new_and_pending_orders();
$confirmed_orders = count_orders_by_status('Đã Xác Nhận');
$canceled_orders = count_orders_by_status('Huỷ Đơn Hàng');

// Số đơn hàng trên mỗi trang
$per_page = 4;

// Xác định trang hiện tại từ tham số GET, mặc định là trang 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) {
    $current_page = 1;
}

// Xác định từ khóa tìm kiếm từ tham số GET
$search_keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Lấy tổng số đơn hàng phù hợp với từ khóa tìm kiếm
$total_rows = count_search_orders($search_keyword);
$total_pages = ceil($total_rows / $per_page);

// Kiểm tra giới hạn trang hiện tại
if ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Tính offset (vị trí bắt đầu của đơn hàng trong câu truy vấn)
$offset = ($current_page - 1) * $per_page;

// Lấy danh sách đơn hàng cho trang hiện tại
$orders = search_orders_paginated($search_keyword, $offset, $per_page);
?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /*--nút phân trang --*/
        .pagination {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 3px 4px;
            text-decoration: none;
            transition: background-color .3s;
            border: 2px solid black;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #000000;
            color: white;
            border: 1px solid #000000;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="admin-content-main">
        <div class="admin-content-main-title">
            <h1>Thống kê đơn hàng</h1>
            <canvas id="orderChart" width="500" height="150"></canvas>
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
                                        <a class="edit-class" href="index.php?act=donhangct&order_id='.$order['id'].'">Xem</a>
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
                                                    ">'.$order['trangthai'].'</p>
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
                    echo '<a href="index.php?page='.($current_page - 1).'&search='.urlencode($search_keyword).'">&laquo; Trang trước</a>';
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo '<a class="active" href="#">'.$i.'</a>';
                    } else {
                        echo '<a href="index.php?page='.$i.'&search='.urlencode($search_keyword).'">'.$i.'</a>';
                    }
                }
                if ($current_page < $total_pages) {
                    echo '<a href="index.php?page='.($current_page + 1).'&search='.urlencode($search_keyword).'">Trang sau &raquo;</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('orderChart').getContext('2d');
        var orderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mới & Chưa Xác Nhận', 'Đã Xác Nhận', 'Huỷ Đơn Hàng'],
                datasets: [{
                    label: 'Số lượng đơn hàng',
                    data: [<?php echo $new_and_pending_orders; ?>, <?php echo $confirmed_orders; ?>, <?php echo $canceled_orders; ?>],
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>