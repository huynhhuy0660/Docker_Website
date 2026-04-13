<?php
session_start();
if (isset($_POST['update_btn'])) {
    foreach ($_POST['qty'] as $id => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $quantity;
        }
    }
}
header("Location: cart.php");
exit();
?>
$conn, $username, $email, $password, $fullname