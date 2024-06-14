<?php
    // Đặt ID của danh mục "BEST - SELLING"
    $best_selling_category_id = 20; // Cập nhật ID này theo cơ sở dữ liệu của bạn

    // Lấy danh sách sản phẩm "BEST - SELLING"
    $best_selling_products = get_best_selling_products($best_selling_category_id);
?>

<!---------------------------------Slider------------------------------------->
<section class="slider">
    <div class="slider-items">
        <div class="slider-item"><img src="./view/asset/images/bia/4.jpg" alt=""></div>
        <div class="slider-item"><img src="./view/asset/images/bia/5.jpg" alt=""></div>
        <div class="slider-item"><img src="./view/asset/images/bia/6.jpg" alt=""></div>
        <div class="slider-item"><img src="./view/asset/images/bia/7.webp" alt=""></div>
    </div>
    <div class="slider-arrow">
        <i class="ri-arrow-right-fill"></i>
        <i class="ri-arrow-left-fill"></i>
    </div>
</section>

<section class="hot-products">
    <div class="container">
        <div class="row-grid">
            <p class="heading-text">BEST - SELLING</p>
        </div>
        <div class="row-grid row-grid-hot-products">
        <?php foreach ($best_selling_products as $product): ?>
    <div class="hot-product-item">
        <a href="index.php?act=product&id=<?php echo $product['id']; ?>">
            <img src="<?php echo htmlspecialchars($product['img']); ?>" alt="">
            <p><b><?php echo htmlspecialchars($product['tensp']); ?></b></p>
        </a>
        <div class="product-item-price">
            <p style="text-align: center;">
                <?php echo number_format($product['gia'], 0, '.', '.'); ?><sup>đ</sup> 
                <span><?php echo number_format($product['giacu'], 0, '.', '.'); ?><sup>đ</sup></span>
            </p>
        </div>
    </div>
<?php endforeach; ?>
        </div>
    </div>
</section>