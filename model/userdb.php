<?php
    function check_user($user, $pass){
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE user = :user AND pass = :pass");
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $kq = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($kq) {
            $_SESSION['role'] = $kq['role'];
            $_SESSION['user'] = $user; // Lưu tên người dùng vào phiên
            return $kq['role'];
        } else {
            return -1; // Trả về -1 nếu người dùng không tồn tại
        }
        
    }
    function getuserinfo($user,$pass){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_user WHERE user='".$user."' AND pass='".$pass."'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }

    function getall_admin(){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_user");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }
    function insert_ad($name, $tel, $user, $pass, $role){
        $conn =connectdb();
        $sql = "INSERT INTO tbl_user (name, tel, user, pass, role)
        VALUES ('".$name."', '".$tel."', '".$user."', '".$pass."','".$role."')";
        $conn->exec($sql);
    }
    function getone_ad($id){
        $conn =connectdb();
        $stmt = $conn -> prepare("SELECT * FROM tbl_user WHERE id= ".$id);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq= $stmt->fetchAll();
        return $kq;
    }
    function update_ad($id, $name, $tel, $user, $pass, $role){
        $conn= connectdb();
        $sql = "UPDATE tbl_user SET name='".$name."', tel='".$tel."', user='".$user."', pass='".$pass."', role='".$role."' WHERE id=".$id;
        // Prepare statement
        $stmt = $conn->prepare($sql);
        // execute the query
        $stmt->execute();
    }
    function del_ad($id){
        $conn = connectdb();
        
        $sql = "DELETE FROM tbl_user WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    ?>