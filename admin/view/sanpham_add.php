<?php
    if ((isset($_POST['themmoi']) && $_POST['themmoi'])) {
        $iddm = $_POST['iddm'];
        $tensp = $_POST['tensp'];
        $gia = str_replace('.', '', $_POST['gia']);
        $giacu = str_replace('.', '', $_POST['giacu']);
        $mota = $_POST['mota'];
        $dacdiem = $_POST['dacdiem'];
        $size = isset($_POST['size']) ? implode(',', $_POST['size']) : '';
        $ngaytao = date('Y-m-d'); // Lấy ngày hiện tại
        $chatlieu = $_POST['chatlieu'];
        
        // Xử lý upload ảnh đại diện
        if (isset($_FILES["hinh"])) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
            $img = $target_file;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Kiểm tra định dạng file ảnh
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "webp") {
                $uploadOk = 0;
            }
    
            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file);
                
                // Thêm sản phẩm vào cơ sở dữ liệu và lấy ID của sản phẩm vừa được thêm
                $product_id = insert_sanpham($iddm, $tensp, $gia, $giacu, $img, $mota, $dacdiem, $size, $ngaytao, $chatlieu);
    
                // Xử lý upload các ảnh sản phẩm
                if (isset($_FILES["hinhsp"])) {
                    foreach ($_FILES["hinhsp"]["name"] as $key => $value) {
                        $target_file_sp = $target_dir . basename($_FILES["hinhsp"]["name"][$key]);
                        $imageFileType = strtolower(pathinfo($target_file_sp, PATHINFO_EXTENSION));
    
                        // Kiểm tra định dạng file ảnh sản phẩm
                        if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif', 'webp'])) {
                            if (move_uploaded_file($_FILES["hinhsp"]["tmp_name"][$key], $target_file_sp)) {
                                // Thêm ảnh sản phẩm vào cơ sở dữ liệu
                                insert_image_library($product_id, $target_file_sp);
                            }
                        }
                    }
                }
                header("Location: index.php?act=sanpham");
                exit;
            }
        }
    }
    
    // Load danh sách danh mục
    $dsdm = getall_dm();
?>
<div class="admin-content-main">
    <div class="admin-content-main-title">
        <h1>Thêm Sản Phẩm</h1>
    </div>
    <div class="admin-content-main-content">
        <div class="admin-content-main-content-product-add">
            <div class="admin-content-main-content-left">
                <form action="index.php?act=sanpham_add" method="post" enctype="multipart/form-data">
                    <div class="admin-content-main-content-two-input">
                        <select name="iddm" id="">
                            <option value="0">Chọn Danh Mục</option>
                            <?php
                            foreach ($dsdm as $dm) {
                                echo '<option value="'.$dm['id'].'">'.$dm['tendm'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Tên Sản Phẩm" name="tensp">
                        <input type="text" placeholder="Chất liệu" name="chatlieu">
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Giá Bán" name="gia" id="gia-ban">
                        <input type="text" placeholder="Giá Cũ" name="giacu" id="gia-cu">
                    </div>
                    <div class="admin-content-main-content-one-input">
                        <div class="size-option">
                            <label for="">Chọn Size:</label>
                            <input type="checkbox" id="size-small" class="size-checkbox" name="size[]" value="S">
                            <label for="size-small" class="size-label">S</label>
                        </div>
                        <div class="size-option">
                            <input type="checkbox" id="size-medium" class="size-checkbox" name="size[]" value="M">
                            <label for="size-medium" class="size-label">M</label>
                        </div>
                        <div class="size-option">
                            <input type="checkbox" id="size-large" class="size-checkbox" name="size[]" value="L">
                            <label for="size-large" class="size-label">L</label>
                        </div>
                        <div class="size-option">
                            <input type="checkbox" id="size-xl" class="size-checkbox" name="size[]" value="XL">
                            <label for="size-xl" class="size-label">XL</label>
                        </div>
                    </div>

                    <textarea class="editor_des" name="dacdiem" id="" placeholder="Đặc điểm nổi bật"></textarea>
                    <textarea class="editor_content" name="mota" id="" placeholder="Chi tiết sản phẩm"></textarea>
                    <input type="submit" value="Thêm Sản Phẩm" name="themmoi" class="main-btn">
                    
                
            </div>
            <div class="admin-content-main-content-right">
                <div class="admin-content-main-content-right-image">
                    <label for="file">Ảnh Đại Diện</label>
                    <input type="file" id="file" name="hinh">
                    
                    <div class="image-show" id="image-show"></div>
                </div>
                <div class="admin-content-main-content-right-images">
                    <label for="files">Ảnh Sản Phẩm</label>
                    <input type="file" id="files" name="hinhsp[]" multiple>
                    <div class="images-show" id="images-show"></div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</section>
