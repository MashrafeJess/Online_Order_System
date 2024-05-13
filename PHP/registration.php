<?php
include "config.php";
if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $address = mysqli_real_escape_string($conn, $_POST['adrs']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpass']));
    $sql = "SELECT email FROM customers WHERE  email = '{$email}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $msg = "Email already in use!";
    } else if ($pass != $cpass) {
        $msg1 = "Passwords didn't match!";
    } else {
        $sql1 = "INSERT INTO customers (`name`, `email`, `address`, `pass`, `cpass`) VALUES ('{$name}','{$email}','{$address}','{$pass}','{$cpass}')";
        if (mysqli_query($conn, $sql1)) {
            header('Location: http://localhost/FDS/PHP/index.php');
            exit(); // Ensure no further output is sent after redirection
        } else {
            echo "Failed";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/register.css">
</head>

<body>
    <div class="user">
        <header class="user__header">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
            <h1 class="user__title">Sign Up Form for Online Food Delivery System</h1>
        </header>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form">
            <div class="form__group">
                <input type="text" name="name" placeholder="Username" class="form__input" />
            </div>

            <div class="form__group">
                <input type="email" name="mail" placeholder="Email" class="form__input" />
            </div>
            <div class="form__group">
                <input type="text" name="adrs" placeholder="Address" class="form__input" />
            </div>
            <div class="form__group">
                <input type="password" name="pass" placeholder="Password" class="form__input" />
            </div>
            <div class="form__group">
                <input type="password" name="cpass" placeholder="Confirm Password" class="form__input" />
            </div>

            <button class="btn" name="save" type="submit">Register</button>
        </form>
    </div>
    <?php
    if (isset($msg)) {
        echo '<p class="err">' . $msg . '</p>';
    } else if (isset($msg1)) {
        echo '<p class = "err">' . $msg1 . '</p>';
    }
    ?>
</body>

</html>