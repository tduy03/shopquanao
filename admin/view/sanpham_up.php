<?php
// Load danh sách danh mục
$dsdm = getall_dm();

// Lấy chi tiết sản phẩm theo ID
if (isset($_GET['id']) && ($_GET['id'] > 0)) {
    $spct = getonesp($_GET['id']);
}

if ((isset($_POST['capnhat']) && $_POST['capnhat'])) {
    $id = $_POST['id'];
    $iddm = $_POST['iddm'];
    $tensp = $_POST['tensp'];
    $gia = str_replace('.', '', $_POST['gia']);
    $giacu = str_replace('.', '', $_POST['giacu']);
    $mota = $_POST['mota'];
    $dacdiem = $_POST['dacdiem'];
    $size = isset($_POST['size']) ? implode(',', $_POST['size']) : '';
    $ngaytao = date('Y-m-d'); // Lấy ngày hiện tại
    $chatlieu = $_POST['chatlieu'];
    
    $img = "";
    // Xử lý upload ảnh
    if (isset($_FILES["hinh"]) && $_FILES["hinh"]["error"] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
        $img = $target_file;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng file ảnh
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "webp") {
            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file);
        } else {
            $img = "";
        }
    }

    updatesp($id, $iddm, $tensp, $gia, $giacu, $img, $mota, $dacdiem, $size, $ngaytao, $chatlieu);
    header("Location: index.php?act=sanpham");
    exit;
}
?>
<div class="admin-content-main">
    <div class="admin-content-main-title">
        <h1>Sửa Sản Phẩm</h1>
    </div>
    <div class="admin-content-main-content">
        <div class="admin-content-main-content-product-add">
            <div class="admin-content-main-content-left">
                <form action="index.php?act=sanpham_up" method="post" enctype="multipart/form-data">
                    <div class="admin-content-main-content-two-input">
                        <select name="iddm" id="">
                            <option value="0">Chọn Danh Mục</option>
                            <?php
                                    $iddmcur= $spct[0]['iddm'];
                                    if(isset($dsdm)){
                                        foreach ($dsdm as $dm) {
                                            if($dm['id']== $iddmcur)
                                                echo '<option value="'.$dm['id'].'" selected>'.$dm['tendm'].'</option>';
                                            else 
                                                echo '<option value="'.$dm['id'].'">'.$dm['tendm'].'</option>';
                                                
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Tên Sản Phẩm" name="tensp" value="<?=$spct[0]['tensp']?>">
                        <input type="text" placeholder="Chất liệu" name="chatlieu" value="<?=$spct[0]['chatlieu']?>">
                    </div>
                    <div class="admin-content-main-content-two-input">
                        <input type="text" placeholder="Giá Bán" name="gia" value="<?=$spct[0]['gia']?>" id="gia-ban">
                        <input type="text" placeholder="Giá Cũ" name="giacu" value="<?=$spct[0]['giacu']?>" id="gia-cu">
                    </div>
                    <div class="admin-content-main-content-one-input">
                        <div class="size-option">
                            <label for="">Chọn Size:</label>
                            <input type="checkbox" id="size-small" class="size-checkbox" name="size[]" value="S" <?php echo (strpos($spct[0]['size'], 'S') !== false) ? 'checked' : ''; ?>>
                            <label for="size-small" class="size-label">S</label>
                        </div>
                        <div class="size-option">
                            <input type="checkbox" id="size-medium" class="size-checkbox" name="size[]" value="M" <?php echo (strpos($spct[0]['size'], 'M') !== false) ? 'checked' : ''; ?>>
                            <label for="size-medium" class="size-label">M</label>
                        </div>
                        <div class="size-option">
                            <input type="checkbox" id="size-large" class="size-checkbox" name="size[]" value="L" <?php echo (strpos($spct[0]['size'], 'L') !== false) ? 'checked' : ''; ?>>
                            <label for="size-large" class="size-label">L</label>
                        </div>
                        <div class="size-option">
                            <input type="checkbox" id="size-xl" class="size-checkbox" name="size[]" value="XL" <?php echo (strpos($spct[0]['size'], 'XL') !== false) ? 'checked' : ''; ?>>
                            <label for="size-xl" class="size-label">XL</label>
                        </div>
                    </div>

                    <textarea class="editor_des" name="dacdiem" id="" placeholder="Đặc điểm nổi bật"><?=$spct[0]['dacdiem']?></textarea>
                    <textarea class="editor_content" name="mota" id="" placeholder="Chi tiết sản phẩm"><?=$spct[0]['mota']?></textarea>
                    <input type="hidden" name="id" id="" value="<?=$spct[0]['id']?>">
                    <input type="submit" value="Sửa Sản Phẩm" name="capnhat" class="main-btn">
            </div>
            <div class="admin-content-main-content-right">
            <div class="admin-content-main-content-right-image">
                <label for="file">Ảnh Đại Diện</label>
                    <input type="file" id="file" name="hinh">
                    <div class="img-container">
                        <img src="<?= $spct[0]['img'] ?>" alt="" >
                        <button type="button" class="remove-btn" onclick="deleteImage('<?= $spct[0]['img'] ?>')" style="margin-right: 241px;">X</button>
                    </div>
                </div>
                <div class="admin-content-main-content-right-images">
                    <label for="files">Ảnh Sản Phẩm</label>
                    <input type="file" id="files" name="hinhsp[]" multiple>
                    <div class="images-show" id="images-show">
                        <?php
                        $product_images = get_product_images($spct[0]['id']);
                        foreach ($product_images as $image) {
                            echo '<div class="image-container">';
                            echo '<img src="'.$image['img'].'" alt="" width="100px">';
                            echo '<button type="button" class="remove-btn" onclick="deleteImage(\''.$image['img'].'\')">X</button>';
                            echo '</div>';
                        }
                        ?>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</section>
