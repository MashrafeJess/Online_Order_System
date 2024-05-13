<?php
include "config.php";
if (isset($_POST['save'])) {
	// echo "Saved";
	$name = mysqli_real_escape_string($conn, $_POST['username']);
	$pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
	$sql = "SELECT id FROM customers WHERE email ='{$name}'AND pass = '{$pass}'";
	$result = mysqli_query($conn, $sql) or die("Failed");
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			// echo "Saved2";
			session_start();
			$_SESSION["ID"] = $row['id'];
			header("Location:http://localhost/FDS/pictures/main.php");
		}
		// echo $_SESSION["ID"];
	} else {
		$msg = "Invalid User!";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
	<link rel="stylesheet" href="./style.css">
	<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>
	<!-- partial:index.partial.html -->
	<div class="container">
		<div class="screen">
			<div class="screen__content">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login">
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<input type="email" name="username" class="login__input" placeholder="User name / Email">
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<input type="password" name="pass" class="login__input" placeholder="Password">
					</div>
					<button name="save" class="button login__submit">
						<span class="button__text">Log In Now</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>
				</form>
				<div class="social-login">
					<h3>log in via</h3>
					<div class="social-icons">
						<a href="#" class="social-login__icon fab fa-instagram"></a>
						<a href="#" class="social-login__icon fab fa-facebook"></a>
						<a href="#" class="social-login__icon fab fa-twitter"></a>
					</div>
				</div>
			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape4"></span>
				<span class="screen__background__shape screen__background__shape3"></span>
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>
		</div>
	</div>
	<!-- partial -->
	<?php
	if (isset($msg)) {
		echo '<p class="err">' . $msg . '</p>';
	}
	?>
</body>

</html>