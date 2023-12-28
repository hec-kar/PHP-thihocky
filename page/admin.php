<?php include_once "../includes/opening.php";?>
<?php define("PAGE_TITLE", "Admin Home Page");?>

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
$listOrder = findOrderByShop($conn, $user->getAuthentication());

?>



<?php include_once '../includes/components/_header.php';?>
<?php include_once '../includes/components/_admin_nav.php';?>
<?php include_once '../includes/components/_admin_listOrder.php';?>
<?php include_once '../includes/components/_footer.php';?>


<?php include_once "../includes/closing.php";?>