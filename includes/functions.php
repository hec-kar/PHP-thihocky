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
//-----------ORDER---------------

//-----------ORDER_DETAIL---------------

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
