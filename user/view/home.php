<?php
    // Đặt ID của danh mục "BEST - SELLING"
    $best_selling_category_id = 20; 

    $best_localbrand_id = 4; 

    // Lấy danh sách sản phẩm "BEST - SELLING"
    $best_selling_products = get_best_selling_products($best_selling_category_id);
    // Lấy danh sách sản phẩm "LOCALBRAND"
    $best_localbrand_products = get_best_selling_products($best_localbrand_id);
?>
<!---------------------------------Slider------------------------------------->
<section class="slider">
    <div class="slider-items">
        <div class="slider-item"><img src="./view/asset/images/bia/slider_1.webp" alt=""></div>
        <div class="slider-item"><img src="./view/asset/images/bia/slideshow_3.webp" alt=""></div>
        <div class="slider-item"><img src="./view/asset/images/bia/4.jpg" alt=""></div>
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
<!-- Thêm ảnh bìa dưới sản phẩm BEST-SELLING -->
<section class="big-img">
    <div class="slide-img"><img src="./view/asset/images/bia/8.webp" alt="Ảnh bìa dưới sản phẩm BEST-SELLING"></div>
</section>
<!-- Thêm 3 ảnh bằng và ngang hàng nhau dưới ảnh bìa -->
<section class="slide-three">
    <div><img src="./view/asset/images/bia/three1.webp" alt="Ảnh 1"></div>
    <div><img src="./view/asset/images/bia/three2.webp" alt="Ảnh 2"></div>
    <div><img src="./view/asset/images/bia/three3.webp" alt="Ảnh 3"></div>
</section>
<section class="big-img">
    <div class="slide-img"><img src="./view/asset/images/bia/9.webp" alt="Ảnh bìa dưới sản phẩm BEST-SELLING"></div>
</section>
<section class="hot-products">
    <div class="container">
        <div class="row-grid" style="margin-top: -24px;">
            <p class="heading-text">LOCALBRAND</p>
        </div>
        <div class="row-grid row-grid-hot-products">
        <?php foreach ($best_localbrand_products as $product): ?>
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
<section class="big-img">
    <div class="slide-img"><img src="./view/asset/images/bia/10.webp" alt="Ảnh bìa dưới sản phẩm BEST-SELLING"></div>
</section>
