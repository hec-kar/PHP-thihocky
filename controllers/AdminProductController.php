<?php include_once '../includes/opening.php';?>

<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST['action'] == "addProduct") {
        $productName = $_POST["name"];
        $productDesc = $_POST["description"];
        $productQuantity = (int) $_POST["quantity"];
        $productType = (int) $_POST["type"];
        $price = (double) $_POST["price"];

        // Assuming you have a User object in the session
        $user = $_SESSION["user"];
        $shop_id = $user->getAuthentication();

        // Assuming you have a function to insert the product
        $success = insertProduct($conn, $productName, $productDesc, $shop_id, $productQuantity, $productType, $price);

        if ($success) {
            header("Location: ../page/admin_product.php");
            exit();
        } else {
            echo "Failed to insert product.";
        }
    }

    if (isset($_POST["action"]) && $_POST['action'] == "updateProduct") {
        $product_id = (int) $_POST["product_id"];
        $productName = $_POST["name"];
        $productDesc = $_POST["description"];
        $productQuantity = (int) $_POST["quantity"];
        $productType = (int) $_POST["type"];
        $price = (double) $_POST["price"];
        $result = updateProduct($conn, $product_id, $productName, $productDesc, $productQuantity, $productType, $price);
        if ($result) {
            header("Location: ../page/admin_product.php");
            exit();
        } else {
            echo "Failed to update product.";
        }
    }
}

// edit vs update

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["action"]) && $_GET['action'] == "delete") {
        $id_product = (int) $_GET["id"];
        $result = deleteProduct($conn, $id_product);
        if ($result) {
            header("Location: ../page/admin_product.php");
            exit();
        } else {
            echo "Failed to delete product.";
        }
    }
}