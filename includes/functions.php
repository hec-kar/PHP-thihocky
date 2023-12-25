<?php
$GLOBALS['BASE'] = dirname(__DIR__);
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

        // Tạo một đối tượng Shop và gán dữ liệu
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

// prouct 
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