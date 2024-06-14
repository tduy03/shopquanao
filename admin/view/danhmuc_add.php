<?php
    //thêm mới danh mục
    if(isset($_POST['themmoi'])&& $_POST['themmoi']){
        $tendm= $_POST['tendm'];
        themdm($tendm);
        header('location: index.php?act=danhmuc');
    }
?>
            <div class="admin-content-main">
            <div class="admin-content-main-title">
                <h1>Thêm Danh Mục</h1>
            </div>
            <div class="admin-content-main-content">
                <div class="admin-content-main-content-product-add">
                    <div class="admin-content-main-content-left">
                    <form action="index.php?act=danhmuc_add" method="post">
                        <div class="admin-content-main-content-two-input">
                            <input type="text" name="tendm" placeholder="Tên Danh Mục">
                        </div>
                        <div class="admin-content-main-content-two-input">
                            <input type="text" placeholder="Thứ Tự">
                        </div>
                        
                        <div class="admin-content-main-content-two-input">
                            <input type="text" name="hienthi" placeholder="Hiển Thị">   
                        </div>
                        <input type="submit" name="themmoi" class="main-btn" value="Thêm Danh Mục">
                    </form>
                    </div>
             
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
    </div>
</section>
