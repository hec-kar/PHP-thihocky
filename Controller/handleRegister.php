<?php
// handleRegister.php
ob_start();

include_once __DIR__ . '/../includes/opening.php';

// Khởi tạo các biến lỗi và giá trị đã nhập
$error_register = $err_email = $err_phone = $err_repassword = '';
$name_value = $email_value = $phone_value = '';

// Kiểm tra nếu form đã được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ form
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';

    // Lưu giữ lại giá trị đã nhập
    $name_value = $name;
    $email_value = $email;
    $phone_value = $phone;

    // Kiểm tra mật khẩu và mật khẩu xác nhận
    if ($password !== $repassword) {
        $err_repassword = "Mật khẩu nhập lại không đúng!";
    } else {
        // Kiểm tra xem email hoặc phone đã tồn tại chưa
        $checkQuery = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $row = $checkResult->fetch_assoc();
            if ($row['email'] === $email) {
                $err_email = "Email đã tồn tại!";
            }
            if ($row['phone'] === $phone) {
                $err_phone = "Số điện thoại đã tồn tại!";
            }
        } else {
            // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu (đảm bảo bảo mật)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Thực hiện truy vấn đến cơ sở dữ liệu để lưu thông tin người dùng
            $insertQuery = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashedPassword')";

            if ($conn->query($insertQuery)) {
                // Lưu thông tin người dùng thành công
                header("Location: /pages/home.php");
                exit();
            } else {
                // Lỗi khi thực hiện truy vấn
                $error_register = "Đăng ký thất bại!";
            }
        }
    }
}

// Đóng kết nối đến cơ sở dữ liệu
include_once __DIR__ . '/../includes/closing.php';

// Thêm các biến session để truyền giá trị
$_SESSION['error_register'] = $error_register;
$_SESSION['err_email'] = $err_email;
$_SESSION['err_phone'] = $err_phone;
$_SESSION['err_repassword'] = $err_repassword;
$_SESSION['name_value'] = $name_value;
$_SESSION['email_value'] = $email_value;
$_SESSION['phone_value'] = $phone_value;
?>
