<?php
    function insert_sanpham($iddm, $tensp, $gia, $giacu, $img, $mota, $dacdiem, $size, $ngaytao, $chatlieu){
        $conn = connectdb();
        $sql = "INSERT INTO tbl_sanpham (iddm, tensp, gia, giacu, img, mota, dacdiem, size, ngaytao, chatlieu)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$iddm, $tensp, $gia, $giacu, $img, $mota, $dacdiem, $size, $ngaytao, $chatlieu]);
        
        // Lấy ID của sản phẩm vừa được thêm
        $lastInsertId = $conn->lastInsertId();
        return $lastInsertId;
    }
    function insert_image_library($product_id, $img){
        $conn = connectdb();
        $sql = "INSERT INTO tbl_image_libary (product_id, img) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product_id, $img]);
    }

    function getall_sanpham(){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_sanpham");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }

    //load spham theo danh mục
    function getall_sanphamdm($iddm,$view){
        $conn =connectdb();
        $sql = "SELECT * FROM tbl_sanpham WHERE 1";
        if($iddm>0){
            $sql.= " AND iddm=".$iddm;
        }
        if($view==1){
            $sql.= " order by view DESC";
        }else{
            $sql.= " order by id DESC";
        }
        $stmt = $conn -> prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }

    function delsp($id){
        $conn =connectdb();
        $sql = "DELETE FROM tbl_sanpham WHERE id=".$id;

        // use exec() because no results are returned
        $conn->exec($sql);
    }

    function updatesp($id, $iddm, $tensp, $gia, $giacu, $img, $mota, $dacdiem, $size, $ngaytao, $chatlieu) {
        $conn = connectdb();
        $sql = "UPDATE tbl_sanpham SET iddm=?, tensp=?, gia=?, giacu=?, img=?, mota=?, dacdiem=?, size=?, ngaytao=?, chatlieu=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$iddm, $tensp, $gia, $giacu, $img, $mota, $dacdiem, $size, $ngaytao, $chatlieu, $id]);
    }
    
    function delete_image_library($product_id) {
        $conn = connectdb();
        $sql = "DELETE FROM tbl_image_libary WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product_id]);
    }
    function get_product_images($product_id) {
        $conn = connectdb();
        $sql = "SELECT img FROM tbl_image_libary WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getonesp($id){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_sanpham WHERE id= ".$id);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }
    //tìm kiếm
    function searchProducts($keyword) {
        $conn = connectdb();
        $sql = "SELECT * FROM tbl_sanpham WHERE tensp LIKE ?";
        $stmt = $conn->prepare($sql);
        $keyword = '%' . $keyword . '%';
        $stmt->execute([$keyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Hàm lấy sản phẩm theo danh mục và phân trang
    function getall_sanphamdm_paginated($iddm, $page = 1, $perPage = 16) {
        $conn = connectdb();
        $start = ($page - 1) * $perPage;
        $sql = "SELECT * FROM tbl_sanpham WHERE 1";
        if ($iddm > 0) {
            $sql .= " AND iddm = $iddm";
        }
        $sql .= " ORDER BY id DESC";
        $sql .= " LIMIT $start, $perPage";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    }

    // Hàm đếm tổng số sản phẩm theo danh mục
    function count_sanphamdm($iddm) {
        $conn = connectdb();
        $sql = "SELECT COUNT(*) AS total FROM tbl_sanpham WHERE 1";
        if ($iddm > 0) {
            $sql .= " AND iddm = $iddm";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function count_all_sanpham() {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM tbl_sanpham");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    // Hàm lấy danh sách sản phẩm với phân trang
    function getall_sanpham_paginated1($offset, $per_page) {
        $conn = connectdb();
        $sql = "SELECT * FROM tbl_sanpham LIMIT $offset, $per_page";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //tìm kiếm
    function count_search_products($keyword, $category) {
        $conn = connectdb();
        $sql = "SELECT COUNT(*) FROM tbl_sanpham WHERE (tensp LIKE :keyword OR gia LIKE :keyword OR giacu LIKE :keyword OR size LIKE :keyword)";
        if ($category > 0) {
            $sql .= " AND iddm = :category";
        }
        $stmt = $conn->prepare($sql);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        if ($category > 0) {
            $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    function search_products_paginated($keyword, $category, $offset, $limit) {
        $conn = connectdb();
        $sql = "SELECT * FROM tbl_sanpham WHERE (tensp LIKE :keyword OR gia LIKE :keyword OR giacu LIKE :keyword OR size LIKE :keyword)";
        if ($category > 0) {
            $sql .= " AND iddm = :category";
        }
        $sql .= " LIMIT :offset, :limit";
        $stmt = $conn->prepare($sql);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        if ($category > 0) {
            $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        }
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //load ảnh sản phẩm danh mục best selling
    function get_best_selling_products($category_id, $limit = 5) {
        $conn = connectdb();
        $sql = "SELECT * FROM tbl_sanpham WHERE iddm = :category_id LIMIT :limit";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //load ảnh sản phẩm danh mục best selling
    function get_localbrand_products($category_id, $limit = 5) {
        $conn = connectdb();
        $sql = "SELECT * FROM tbl_sanpham WHERE iddm = :category_id LIMIT :limit";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

?>