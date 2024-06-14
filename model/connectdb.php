<?php
    function connectdb(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shopquanao";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Thiết lập chế độ báo lỗi cho PDO
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Nếu kết nối thành công, trả về đối tượng PDO
            return $conn;
        } catch(PDOException $e) {
            // Xử lý ngoại lệ và thông báo lỗi
            echo "Connection failed: " . $e->getMessage();
            // Trả về null nếu có lỗi xảy ra
            return null;
        }
    }
?>