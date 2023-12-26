<?php include_once '../includes/opening.php';?>
<?php
session_start();

// login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailphone = $_POST["emailphone"];
    $password = $_POST["password"];
    $user = findUser($conn, $emailphone, $password);

    if ($user === null) {
        $_SESSION["error_login"] = "Your information is incorrect";
        header("Location: login.php");
        exit();
    } else {
        if ($user->getAuthentication() != 0) {
            $_SESSION["user"] = $user;
            unset($_SESSION["error_login"]);
            header("Location: ../page/admin.php");
            exit();
        } else {
            $_SESSION["user"] = $user;
            unset($_SESSION["error_login"]);
            header("Location: ../page/home.php");
            exit();
        }
    }
}
