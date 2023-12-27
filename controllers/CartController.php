<?php include_once '../includes/opening.php';?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["action"]) && $_GET["action"] == "addProductToCart") {
        $id_product = isset($_GET["id_product"]) ? (int) $_GET["id_product"] : 0;
        $product = findProductById($conn, $id_product);
        $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : array();

        if ($id_product > 0) {
            $isProductInCart = false;

            foreach ($cart as $key => $pro) {
                if ($pro->getProductId() == $id_product) {
                    // set quantity + 1 mỗi lần click
                    $cart[$key]->setQuantity($pro->getQuantity() + 1);
                    $isProductInCart = true;
                    break;
                }
            }

            if (!$isProductInCart) {
                // Set quantity cho lần chọn món đầu tiên
                $product->setQuantity(1);
                $cart[] = $product;
            }
        }

        $_SESSION["cart"] = $cart;

        $shop_id = isset($_GET["shop_id"]) ? (int) $_GET["shop_id"] : 0;
        header("Location: ../page/product_page.php?shop_id=" . $shop_id);
        exit();
    }

    if (isset($_GET["clear"]) && $_GET["clear"] == "OK") {
        // Kiểm tra nếu có yêu cầu clear và giá trị là "OK"
        // Thực hiện xóa giỏ hàng
        $_SESSION["cart"] = array(); // Đặt giỏ hàng thành một mảng trống hoặc có thể sử dụng $_SESSION["cart"] = []
        header("Location: ../page/shopping_cart.php");
        exit();
    }
}

// method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "update") {
        $id_product = isset($_POST["id_product"]) ? (int) $_POST["id_product"] : 0;
        $quantity = isset($_POST["quantity"]) ? (int) $_POST["quantity"] : 0;

        // Kiểm tra nếu giỏ hàng tồn tại trong session
        if (isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];

            // Lặp qua sản phẩm trong giỏ hàng
            foreach ($cart as &$product) {
                // Kiểm tra nếu ID sản phẩm trùng khớp và số lượng hợp lệ
                if ($product->getProductId() == $id_product && $quantity > 0) {
                    $product->setQuantity($quantity);
                    break;
                }
            }

            // Cập nhật giỏ hàng trong session
            $_SESSION["cart"] = $cart;
        }
        header("Location: ../page/shopping_cart.php");
        exit();
    }
    if (isset($_POST["action"]) && $_POST["action"] == "delete") {
        $id_product = isset($_POST["id_product"]) ? (int) $_POST["id_product"] : 0;

        // Kiểm tra nếu giỏ hàng tồn tại trong session
        if (isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];

            // Lặp qua sản phẩm trong giỏ hàng
            foreach ($cart as $key => $product) {
                // Kiểm tra nếu ID sản phẩm trùng khớp
                if ($product->getProductId() == $id_product) {
                    // Xóa sản phẩm khỏi giỏ hàng
                    unset($cart[$key]);
                    break;
                }
            }

            // Cập nhật giỏ hàng trong session
            $_SESSION["cart"] = array_values($cart);
        }

        header("Location: ../page/shopping_cart.php");
        exit();
    }

    //payment, tạo order
    if (isset($_POST["action"]) && $_POST["action"] == "payment") {
        // Kiểm tra giỏ hàng và tồn tại người dùng trong session
        if (!empty($_SESSION["cart"]) && isset($_SESSION["user"])) {
            // Lấy thông tin người dùng từ session
            $user = $_SESSION["user"];
            $user_id = $user->getUserId();

            // Lấy ghi chú từ form thanh toán
            $note = isset($_POST["note"]) ? $_POST["note"] : "";

            // Thực hiện chèn đơn hàng mới và chi tiết đơn hàng
            $newOrderId = insertOrder($conn, $user_id, $note);

            foreach ($_SESSION["cart"] as $product) {
                insertOrderDetail($conn, $newOrderId, $product->getProductId(), $product->getQuantity());
            }

            // Kiểm tra xem việc chèn đơn hàng mới có thành công hay không
            if ($newOrderId != -1) {
                // Đặt biến session để thông báo thanh toán thành công
                $_SESSION["payment_success"] = true;

                // Xóa giỏ hàng khỏi session
                unset($_SESSION["cart"]);

                // Chuyển hướng đến trang thanh toán thành công
                header("Location: ../page/shopping_cart.php");
                exit();
            } else {
                // Xử lý lỗi khi chèn đơn hàng mới không thành công
                $_SESSION["payment_error"] = true;
                header("Location: ../page/shopping_cart.php");
                exit();
            }
        } else {
            // Xử lý lỗi khi giỏ hàng trống hoặc người dùng không đăng nhập
            $_SESSION["payment_error"] = true;
            header("Location: ../page/shopping_cart.php");
            exit();
        }
    }
}
