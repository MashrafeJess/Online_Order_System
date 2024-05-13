<?php
include "config.php";
session_start();
if (!isset($_SESSION["ID"])) {
    header("Location:http://localhost/FDS/PHP/index.php");
}
$id = $_SESSION["ID"];
$sql = "SELECT name, email,address FROM customers WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $email, $address);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="../CSS/view.css">
</head>

<body>
    <div>
        <div class="head">
            <div class="a">
                <h1>Personal Details</h1>
            </div>
            <div class="b">
                Username : <?php echo $name; ?></br>
                Email : <?php echo $email; ?></br>
                Address : <?php echo $address; ?></br>
            </div>
            <div class="box">
                <?php
                if (!isset($_SESSION['cart'])) {
                    echo '<div id="non"> No Item added!! </br>
                    The cart is empty.</div>';
                } else {
                    $totalPrice = 0;
                    echo '
                    <div id="con">Name</div>
                <div id="con">Price</div>
                <div id="con">Quantity</div>
                <div id="con">Total Price</div>
                    ';
                    foreach ($_SESSION['cart'] as $product) {
                        $name = $product['name'];
                        $price = $product['price'];
                        $quantity = $product['qty'];
                        $subtotal = $price * $quantity;
                        $totalPrice += $subtotal;
                        echo '<div id="con">' . $name . '</div>';
                        echo '<div id="con">' . $price . '</div>';
                        echo '<div id="con">' . $quantity . '</div>';
                        echo '<div id="con">' . $subtotal . '</div>';
                    }
                    echo '<div id="con"></div>
                <div id="con"></div>
                <div id="con">Total:</div>
                <div id="con">' . $totalPrice . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<!-- <?php unset($_SESSION['cart']); ?> -->