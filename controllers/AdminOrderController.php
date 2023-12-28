<?php include_once '../includes/opening.php';?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    updateOrder($conn, $order_id);
    header("Location: ../page/admin.php?");
    exit();
}