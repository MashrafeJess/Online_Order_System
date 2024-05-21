<?php
include "../PHP/config.php";
session_start();
if (!isset($_SESSION["ID"])) {
    header("Location:http://localhost/FDS/PHP/index.php");
}
$id = $_SESSION["ID"];
// echo $id;
$sql = "SELECT name,price,restaurant,pictures FROM food";
$result = mysqli_query($conn, $sql) or die("error");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="../CSS/main.css">
</head>

<body>
    <div class="head">
        <p class="j">Food Item</p> </br>
        <a class="j" href="http://localhost/FDS/PHP/logout.php">Logout</a>
        <a class="j" href="http://localhost/FDS/PHP/view.php">View Cart <img src="../pictures/cart.png" height="35px" width="30px"></a>
    </div>
    <!-- <hr class="rod"> -->
    <div class="container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $price = $row['price'];
            $rest = $row['restaurant'];
            $pic = $row['pictures'];

            echo '
        <div class="a" id="lol">
            <img class="p" src="' . $pic . '" width="250px" height="250px"><br>
            Name: ' . $name . '<br>
            Price: ' . $price . '<br>
            Restaurant: ' . $rest . '<br>
            <form method="POST" action="../PHP/insertCart.php">
                <input class="inp" type="number" name="qty" placeholder="Quantity" required>
                <input type="hidden" name="name" value="' . $name . '">
                <input type="hidden" name="price" value="' . $price . '">
                <button type="submit" name="save">
                    <img class="bt" src="../pictures/cart.png" alt="Add to Cart" width="15px" height="15px">
                </button>
            </form>
        </div>
    ';
        }
        ?>



    </div>
    </div>
</body>

</html>