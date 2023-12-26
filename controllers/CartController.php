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
                    // Add debug output
                    echo "Before Update: Quantity - " . $cart[$key]->getQuantity() . "<br>";

                    $cart[$key]->setQuantity($pro->getQuantity() + 1);
                    $isProductInCart = true;

                    // Add debug output
                    echo "After Update: Quantity - " . $cart[$key]->getQuantity() . "<br>";

                    break;
                }
            }

            if (!$isProductInCart) {
                $product->setQuantity(1);
                $cart[] = $product;
            }
        }

        $_SESSION["cart"] = $cart;

        $shop_id = isset($_GET["shop_id"]) ? (int) $_GET["shop_id"] : 0;
        header("Location: ../page/product_page.php?shop_id=" . $shop_id);
        exit();
    }
}
