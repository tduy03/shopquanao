<?php
    function taodonhang($madh, $tongdonhang, $pttt, $hoten, $address, $email, $tel){
        $conn = connectdb();
        $ngaydat = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
        $trangthai = "Chưa xác nhận"; // Thiết lập trạng thái mặc định
        $sql = "INSERT INTO tbl_oder (madh, tongdonhang, pttt, hoten, address, email, tel, ngaydat, trangthai)
                VALUES ('".$madh."','".$tongdonhang."','".$pttt."','".$hoten."','".$address."','".$email."','".$tel."', '".$ngaydat."', '".$trangthai."')";
        $conn->exec($sql);
        $last_id = $conn->lastInsertId();
        return $last_id;
    }
    function addtocart($iddh,$idpro,$img,$tensp,$soluong,$donggia,$giacu,$size){
        $conn =connectdb();
        $sql = "INSERT INTO tbl_cart (iddh,idpro,img,tensp,soluong,donggia,giacu,size)
        VALUES ('".$iddh."','".$idpro."','".$img."','".$tensp."','".$soluong."','".$donggia."','".$giacu."','".$size."')";
        $conn->exec($sql);
        $last_id = $conn->lastInsertId();
        return $last_id;
    }
    function getshowcart($iddh){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_cart WHERE iddh= ".$iddh);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }
    function getoderinfo($iddh){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_oder WHERE id= ".$iddh);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }
    function get_all_orders(){
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_oder");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $orders = $stmt->fetchAll();
        return $orders;
    }
    function get_order_details($order_id){
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_cart WHERE iddh = :order_id"); // Lấy chi tiết đơn hàng từ bảng tbl_cart dựa trên id của đơn hàng
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả các dòng kết quả và chuyển chúng thành mảng kết hợp
        return $order_details;
    }

    function delete_order($order_id){
        $conn = connectdb();
        
        // Xoá chi tiết đơn hàng trước
        $stmt1 = $conn->prepare("DELETE FROM tbl_cart WHERE iddh = :order_id");
        $stmt1->bindParam(':order_id', $order_id);
        $stmt1->execute();

        // Sau đó xoá đơn hàng chính
        $stmt2 = $conn->prepare("DELETE FROM tbl_oder WHERE id = :order_id");
        $stmt2->bindParam(':order_id', $order_id);
        $stmt2->execute();
        
        return true; // Trả về true nếu xoá thành công
    }
    // Hàm cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
    function update_order_status($order_id, $status){
        $conn = connectdb();
        $sql = "UPDATE tbl_oder SET trangthai = :status WHERE id = :order_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return true; // Trả về true nếu cập nhật thành công
    }

    // Hàm lấy trạng thái của đơn hàng từ cơ sở dữ liệu
    function get_order_status($order_id){
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT trangthai FROM tbl_oder WHERE id = :order_id");
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['trangthai']; // Trả về trạng thái đơn hàng
    }
    //Phân trang
    function count_all_orders() {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_oder");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    function get_all_orders_paginated($offset, $limit) {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_oder LIMIT :offset, :limit");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //tìm kiếm
    function count_search_orders($keyword) {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_oder 
                                WHERE madh LIKE :keyword 
                                OR pttt LIKE :keyword 
                                OR hoten LIKE :keyword 
                                OR tel LIKE :keyword 
                                OR email LIKE :keyword 
                                OR tongdonhang LIKE :keyword");
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    function search_orders_paginated($keyword, $offset, $limit) {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_oder 
                                WHERE madh LIKE :keyword 
                                OR pttt LIKE :keyword 
                                OR hoten LIKE :keyword 
                                OR tel LIKE :keyword 
                                OR email LIKE :keyword 
                                OR tongdonhang LIKE :keyword 
                                LIMIT :offset, :limit");
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>