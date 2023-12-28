<?php
$GLOBALS['BASE'] = dirname(__DIR__);

//include utils
include_once __DIR__ . '/utils.php';

// -----SHOP--------

include $BASE . "/models/Shop.php";
function getAllShop($conn)
{
    $sql = 'select * from shops';
    $listShop = array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $shop_id = $row['shop_id'];
            $name = $row['name'];
            $address = $row['address'];
            $image = $row['image'];

            $newShop = new Shop($shop_id, $name, $address, $image);
            array_push($listShop, $newShop);
        }
    } else {
        return null;
    }
    return $listShop;
}

function getShopDetail($conn, $shop_id)
{
    $sql = 'SELECT * FROM shops WHERE shop_id =' . $shop_id;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy dữ liệu từ kết quả truy vấn
        $shopDetail = $result->fetch_assoc();

        $shop = new Shop();
        $shop->shop_id = $shopDetail['shop_id'];
        $shop->name = $shopDetail['name'];
        $shop->address = $shopDetail['address'];
        $shop->image = $shopDetail['image'];
        return $shop;
    } else {
        echo "No results found for shop with ID: " . $shop_id;
        return null;
    }
}

//search
function findShopByQuery($conn, $input)
{
    try {
        $listShop = array();
        $param_input = "%" . $input . "%";

        $sql = "SELECT * FROM shops WHERE name LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $param_input);

        // Thực hiện câu lệnh SQL
        $stmt->execute();
        $result = $stmt->get_result();

        // Lặp qua các hàng kết quả
        while ($row = $result->fetch_assoc()) {
            $shop_id = $row['shop_id'];
            $name = $row['name'];
            $address = $row['address'];
            $image = $row['image'];

            $newShop = new Shop($shop_id, $name, $address, $image);
            array_push($listShop, $newShop);
        }

        // Đóng kết quả và trả về danh sách cửa hàng
        $stmt->close();
        return $listShop;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    return null;
}

// -----SHOP--------

// -----------Product--------------
include $BASE . "/models/Product.php";

function getProductByShop($conn, $shop_id)
{
    $sql = 'select * from products where shop_id = ' . $shop_id;
    $listProduct = array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $name = $row['name'];
            $description = $row['description'];
            $exit_shop_id = $row['shop_id'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $type = $row['type'];
            $image = $row['image'];
            $newProduct = new Product($product_id, $name, $description, $exit_shop_id, $quantity, $price, $type, $image);
            array_push($listProduct, $newProduct);
        }
    } else {
        return null;
    }
    return $listProduct;
}

function findProductById($conn, $product_id): Product | null
{
    $sql = "select * from products where product_id = " . $product_id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $productData = $result->fetch_assoc();
        $product = new Product();

        $product->setProductId($productData["product_id"]);
        $product->setName($productData["name"]);
        $product->setDescription($productData["description"]);
        $product->setShopId($productData["shop_id"]);
        $product->setQuantity($productData["quantity"]);
        $product->setPrice($productData["price"]);
        $product->setType($productData["type"]);
        $product->setImage($productData["image"]);

        return $product;
    } else {
        return null;
    }
}

function findByOrder($conn, $order_id)
{
    try {
        $listProduct = array();
        $sql = "CALL GetProductDetails(?)";
        $sttm = $conn->prepare($sql);
        $sttm->bind_param("i", $order_id);
        $sttm->execute();
        $rs = $sttm->get_result();

        while ($row = $rs->fetch_assoc()) {
            $product_id = $row['product_id'];
            $name = $row['name'];
            $description = $row['description'];
            $shop_id = $row['shop_id'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $type = $row['type'];
            $image = $row['image'];

            $newProduct = new Product($product_id, $name, $description, $shop_id, $quantity, $price, $type, $image);
            array_push($listProduct, $newProduct);
        }
        return $listProduct;
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
    return null;
}

// -----------Product--------------

//-------User-------------
include $BASE . "/models/User.php";
function findUser($conn, $emailphone, $password): User | null
{
    $sql = null;
    if (strpos($emailphone, "@") !== false) {
        $sql = "SELECT * FROM users WHERE email = '" . $emailphone . "' AND password = '" . getMd5($password) . "'";
    } else {
        $sql = "SELECT * FROM users WHERE phone = '" . $emailphone . "' AND password = '" . getMd5($password) . "'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        $user = new User();

        $user->setUserId($userData['user_id']);
        $user->setUsername($userData['name']);
        $user->setEmail($userData['email']);
        $user->setPhone($userData['phone']);
        $user->setPassword($userData['password']);
        $user->setAuthentication($userData['authentication']);
        return $user;
    } else {
        return null;
    }
}

//-------User-------------

//-----------ORDER---------------
include $BASE . "/models/Order.php";

function insertOrder($conn, $user_id, $note)
{
    $sql = "INSERT INTO orders (user_id, note, date, due_time) VALUES (?, ?, ?, ?)";

    try {
        // Lấy ngày hiện tại
        $sqlDate = date('Y-m-d');
        // Đặt giá trị mặc định cho $due_time
        $due_time = 30;
        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $user_id, $note, $sqlDate, $due_time);

        // Thực hiện câu lệnh SQL
        $stmt->execute();

        // Lấy ID của bản ghi vừa tạo
        $orderId = $conn->insert_id;

        return $orderId;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    return -1;
}
function findOrderByShop($conn, $shop_id)
{
    $sql = "CALL GetOrdersByShopId(?)";
    try {
        $listOrder = array();
        $sttm = $conn->prepare($sql);
        $sttm->bind_param("i", $shop_id);
        $sttm->execute();
        $rs = $sttm->get_result();
        while ($row = $rs->fetch_assoc()) {
            $order = new Order();
            $order->setOrderId($row["order_id"]);
            $order->setUserId($row["user_id"]);
            $order->setNote($row["note"]);
            $order->setDate($row["date"]);
            $order->setDueTime($row["due_time"]);
            $order->setStatus($row["status"]);
            array_push($listOrder, $order);
        }
        return $listOrder;
    } catch (Exception $ex) {
        // Handle the exception as needed
        echo "Error: " . $ex->getMessage();
    }

    return null;
}

function findOrder($conn, $order_id)
{
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    try {
        $sttm = $conn->prepare($sql);
        $sttm->bind_param("i", $order_id);
        $sttm->execute();
        $rs = $sttm->get_result();

        if ($row = $rs->fetch_assoc()) {
            $order = new Order();
            $order->setOrderId($row["order_id"]);
            $order->setUserId($row["user_id"]);
            $order->setNote($row["note"]);
            $order->setDate($row["date"]);
            $order->setDueTime($row["due_time"]);
            $order->setStatus($row["status"]);

            return $order;
        }
    } catch (Exception $ex) {
        // Handle the exception as needed
        echo "Error: " . $ex->getMessage();
    }

    return null;
}

function updateOrder($conn, $order_id)
{
    try {
        $sql = "UPDATE orders SET status = 1 WHERE order_id = ?";
        $sttm = $conn->prepare($sql);
        $sttm->bind_param("i", $order_id);
        $sttm->execute();
        return true;
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
    return false;
}

//-----------ORDER---------------

//-----------ORDER_DETAIL---------------
include $BASE . "/models/OrderDetail.php";
function insertOrderDetail($conn, $order_id, $product_id, $quantity)
{
    $sql = "INSERT INTO orders_detail (orders_id, product_id, quantity) VALUES (?, ?, ?)";
    try {
        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $order_id, $product_id, $quantity);

        // Thực hiện câu lệnh SQL
        $stmt->execute();

        $stmt->close();
        return 0;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    return -1;
}
//-----------ORDER_DETAIL---------------
