<?php
    function insert_user($name, $email, $tel, $pass,$ngaytao){
        $conn =connectdb();
        $sql = "INSERT INTO tbl_userbuy (name, email, tel, pass,ngaytao)
        VALUES ('".$name."', '".$email."', '".$tel."', '".$pass."', '".$ngaytao."')";
        $conn->exec($sql);
    }
    // Hàm kiểm tra người dùng
    function check_userbuy($tel, $email, $pass) {
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_userbuy WHERE (tel=:tel OR email=:email) AND pass=:pass");
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return count($result) > 0;
    }

    function getall_userbuy(){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_userbuy");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }
    function del_userbuy($id){
        $conn = connectdb();
        $sql = "DELETE FROM tbl_userbuy WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
?>