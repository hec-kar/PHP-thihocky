<?php
// handleLogin.php

// Include file opening.php để mở kết nối cơ sở dữ liệu
include_once __DIR__ . '/../includes/opening.php';


// Chức năng kiểm tra đăng nhập
function checkLogin($emailphone, $password, $conn) {
    // Xử lý dữ liệu đầu vào (kiểm tra tính hợp lệ, hash password nếu cần)
    // ...

    // Thực hiện truy vấn đến cơ sở dữ liệu
    $query = "SELECT * FROM users WHERE (email = '$emailphone' OR phone = '$emailphone') AND password = '$password'";
    $result = $conn->query($query);

    // Xử lý kết quả
    return $result->num_rows > 0;

}

// Kiểm tra nếu form đã được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ form
    $emailphone = $_POST['emailphone'] ?? '';
    $password = $_POST['password'] ?? '';

    // Gọi chức năng kiểm tra đăng nhập
    if (checkLogin($emailphone, $password, $conn)) {
        // Đăng nhập thành công
        echo "Login successful";
        // Có thể thực hiện các hành động sau khi đăng nhập thành công (ví dụ: chuyển hướng đến trang khác)
    } else {
        // Đăng nhập thất bại
        echo "Login failed";
        // Có thể thực hiện các hành động sau khi đăng nhập thất bại (ví dụ: hiển thị thông báo lỗi)
    }
}

// Đoạn mã HTML và CSS của trang đăng nhập
// ...

// Include file closing.php để đóng kết nối cơ sở dữ liệu
include_once __DIR__ . '/../includes/closing.php';

?>
