<?php
// Khởi tạo session
session_start();

// Xóa các thuộc tính "user" và "cart" khỏi session
unset($_SESSION['user']);
unset($_SESSION['cart']);

// Chuyển hướng đến trang home
header("Location: " . "./home.php");
exit();
