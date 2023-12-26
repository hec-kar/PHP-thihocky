<?php include_once "../includes/opening.php";?>
<?php define("PAGE_TITLE", "Home Page");?>

<?php
session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = null;
}
?>


<?php $cart = null;?>
<?php $listShop = getAllShop($conn);?>


<?php include_once '../includes/components/_header.php';?>
<?php include_once '../includes/components/_nav.php';?>
<?php include_once '../includes/components/_login.php';?>
<?php include_once '../includes/components/_footer.php';?>



<?php include_once "../includes/closing.php";?>