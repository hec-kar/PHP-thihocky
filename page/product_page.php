<?php include_once "../includes/opening.php";?>
<?php define("PAGE_TITLE", "Shop Product Page");?>

<?php
session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = null;
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = null;
}
?>



<?php
$shop_id = 0;
if (isset($_GET['shop_id'])) {
    // Lấy giá trị của 'shop_id'
    $shop_id = $_GET['shop_id'];
}

$shop = new Shop();
$shop = getShopDetail($conn, $shop_id);

$listProduct = getProductByShop($conn, $shop_id);
?>






<?php include_once '../includes/components/_header.php';?>
<?php include_once '../includes/components/_nav.php';?>
<?php include_once '../includes/components/_product_by_shop.php';?>
<?php include_once '../includes/components/_footer.php';?>


<?php include_once "../includes/closing.php";?>