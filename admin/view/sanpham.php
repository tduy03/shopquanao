<?php
    // Kết nối cơ sở dữ liệu và các hàm đã định nghĩa ở trên...

    // Số sản phẩm trên mỗi trang
    $per_page = 6;

    // Xác định trang hiện tại
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    }

    // Xác định từ khóa tìm kiếm và danh mục lọc
    $search_keyword = isset($_GET['search']) ? $_GET['search'] : '';
    $filter_category = isset($_GET['category']) ? (int)$_GET['category'] : 0;

    // Lấy tổng số sản phẩm phù hợp với từ khóa tìm kiếm và danh mục lọc
    $total_rows = count_search_products($search_keyword, $filter_category);
    $total_pages = ceil($total_rows / $per_page);

    // Kiểm tra giới hạn trang
    if ($current_page > $total_pages) {
        $current_page = $total_pages;
    }

    // Tính offset (vị trí bắt đầu của sản phẩm trong câu truy vấn)
    $offset = ($current_page - 1) * $per_page;

    // Lấy danh sách sản phẩm cho trang hiện tại
    $products = search_products_paginated($search_keyword, $filter_category, $offset, $per_page);

    // Lấy danh sách danh mục
    $dsdm = getall_dm();
    $danhmuc_map = [];
    foreach ($dsdm as $dm) {
        $danhmuc_map[$dm['id']] = $dm['tendm'];
    }
?>
<div class="admin-content-main">
    <div class="admin-content-main-title">
        <h1>Danh Sách Sản Phẩm</h1>
        <form id="filterForm" method="GET" action="index.php">
            <input type="hidden" name="act" value="sanpham">
            <input type="text" name="search" placeholder="Tìm Kiếm" value="<?php echo htmlspecialchars($search_keyword); ?>" style="padding: 8px 15px;border: 2px solid;margin: 8px 12px;">
            <select name="category" onchange="document.getElementById('filterForm').submit();" style="padding: 8px 15px;border: 2px solid;margin: 8px -6px;">
                <option value="0" >TẤT CẢ DANH MỤC</option >
                <?php
                    foreach ($dsdm as $dm) {
                        $selected = ($filter_category == $dm['id']) ? 'selected' : '';
                        echo '<option value="'.$dm['id'].'" '.$selected.'>'.$dm['tendm'].'</option>';
                    }
                ?>
            </select>
        </form>
    </div>
    <div class="admin-content-main-content">
        <div class="admin-content-main-content-product-list">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Danh Mục</th>
                        <th>Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá Bán</th>
                        <th>Giá Cũ</th>
                        <th>Size</th>
                        <th>Ngày Tạo</th>
                        <th>Tùy Chỉnh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($products) && count($products) > 0) {
                            $i = 1;
                            foreach ($products as $item) {
                                $tendm = isset($danhmuc_map[$item['iddm']]) ? $danhmuc_map[$item['iddm']] : 'Không xác định';
                                $gia_ban = number_format($item['gia'], 0, '.', '.');
                                $gia_cu = number_format($item['giacu'], 0, '.', '.');
                                echo '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$tendm.'</td>
                                        <td><img style="width: 80px;" src="'.$item['img'].'"></td>
                                        <td>'.$item['tensp'].'</td>
                                        <td>'.$gia_ban.'đ</td>
                                        <td>'.$gia_cu.'đ</td>
                                        <td>'.$item['size'].'</td>
                                        <td>'.$item['ngaytao'].'</td>
                                        <td>
                                            <a class="edit-class" href="index.php?act=sanpham_up&id='.$item['id'].'">Sửa</a>
                                            |
                                            <a class="delete-class" href="index.php?act=sanpham_del&id='.$item['id'].'">Xoá</a>
                                        </td>
                                    </tr>';
                                $i++;
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
                    echo '<a href="index.php?act=sanpham&page='.($current_page - 1).'&search='.urlencode($search_keyword).'&category='.urlencode($filter_category).'">&laquo; Trang trước</a>';
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo '<a class="active" href="#">'.$i.'</a>';
                    } else {
                        echo '<a href="index.php?act=sanpham&page='.$i.'&search='.urlencode($search_keyword).'&category='.urlencode($filter_category).'">'.$i.'</a>';
                    }
                }
                if ($current_page < $total_pages) {
                    echo '<a href="index.php?act=sanpham&page='.($current_page + 1).'&search='.urlencode($search_keyword).'&category='.urlencode($filter_category).'">Trang sau &raquo;</a>';
                }
                echo '</div>';
            }
        ?>
    </div>
</div>
