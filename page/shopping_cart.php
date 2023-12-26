<?php include_once "../includes/opening.php";?>
<?php define("PAGE_TITLE", "Shopping Cart Page");?>

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




<?php include_once '../includes/components/_header.php';?>
<?php include_once '../includes/components/_nav.php';?>
<?php include_once '../includes/components/_cart.php';?>
<?php include_once '../includes/components/_footer.php';?>


<?php include_once "../includes/closing.php";?>