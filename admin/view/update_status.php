<?php
    // Include các file và khai báo các hàm cần thiết
   
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $order_id = $_POST["order_id"];
        $new_status = $_POST["new_status"];
        
        // Cập nhật trạng thái trong cơ sở dữ liệu
        update_order_status($order_id, $new_status);
        
        echo "Success"; // Phản hồi về phía client
    }
?>
