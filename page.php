<?php
session_start();
if (isset($_SESSION['username']) == null) {
	header('Location: login.php');
}

?>
<!DOCTYPE html>
<html>
<meta http-equiv="refresh" content="1;url=page.php">
<head>
	<title>Page</title>
</head>
<body>
<center>
<h1>Welcome back, <?php echo $_SESSION['username']; ?></h1>
<?php
	$_SESSION['time'] = $_SESSION['time'] + 1;
		echo '<h1>'.$_SESSION['time'].'</h1>'; 
	if ($_SESSION['time'] == '20') //Time duration
	{
		unset($_SESSION['username']);
		// Delete all session variables
		session_destroy();

		// Jump to login page
		header('Location: login.php');
	}

 ?>
</center>
</body>
</html>