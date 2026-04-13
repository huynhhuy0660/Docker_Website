<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? ''; 
    if ($action == 'add' || $action == 'buy_now') {
        $product_id = (int)$_POST['product_id'];
        $quantity = (int)$_POST['quantity'];

        if ($product_id > 0 && $quantity > 0) {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }
        }
        if ($action == 'buy_now') {
            header("Location: checkout.php");
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
        exit();
    }
    if ($action == 'update') {
        $product_id = (int)$_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        if ($product_id > 0 && isset($_SESSION['cart'][$product_id])) {
            if ($quantity > 0) $_SESSION['cart'][$product_id] = $quantity;
            else unset($_SESSION['cart'][$product_id]);
        }
        header("Location: cart.php");
        exit();
    }
    if ($action == 'remove') {
        $product_id = (int)$_POST['product_id'];
        if ($product_id > 0 && isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
        header("Location: cart.php");
        exit();
    }
}
header("Location: index.php");
exit();
?>