<?php
session_start();
if (!isset($_SESSION["ID"])) {
    header("Location:http://localhost/FDS/PHP/index.php");
}

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quant = $_POST['qty'];

    $cartItem = array(
        'name' => $name,
        'price' => $price,
        'qty' => $quant
    );

    $_SESSION['cart'][] = $cartItem;
    $_SESSION['success'] = 'Item Added Successfully';

    // Redirect back to the previous page to avoid form resubmission
    header('Location:  http://localhost/FDS/pictures/main.php');
    exit;
}