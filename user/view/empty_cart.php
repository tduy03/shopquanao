<?php
include './model/connectdb.php';
include './model/danhmucdb.php';
include './model/sanphamdb.php';
    include 'header.php';
?>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .empty-cart {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .empty-cart h1 {
            font-size: 24px;
            color: #333;
        }
        .empty-cart p {
            color: #666;
        }
        .empty-cart a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .empty-cart a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="empty-cart">
        <h1>Giỏ hàng của bạn đang trống</h1>
        <p>Không có sản phẩm nào trong giỏ hàng của bạn. Hãy tiếp tục mua sắm để thêm sản phẩm vào giỏ hàng.</p>
        <a href="index.php?act=category">Tiếp tục mua sắm</a>
    </div>
</body>

