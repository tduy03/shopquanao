<?php
    function getall_dm(){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_danhmuc");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }
    function deldm($id){
        $conn = connectdb();
        // Xóa các sản phẩm liên quan trước
        $sql = "DELETE FROM tbl_sanpham WHERE iddm = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        // Xóa danh mục
        $sql = "DELETE FROM tbl_danhmuc WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    function getondm($id){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_danhmuc WHERE id= ".$id);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }
    function udatedm($id, $tendm){
        $conn= connectdb();
        $sql = "UPDATE tbl_danhmuc SET tendm='".$tendm."' WHERE id=".$id;

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // execute the query
        $stmt->execute();
    }
    function themdm($tendm){
        $conn = connectdb();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO tbl_danhmuc (tendm)
        VALUES ('".$tendm."')";
        // use exec() because no results are returned
        $conn->exec($sql);

    }
?>