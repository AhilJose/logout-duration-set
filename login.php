<?php
  session_start();
  $msg = " ";

  if (!empty($_SESSION['username']))
  {
    header('Location: page.php');
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

<style type="text/css">
form {
  box-sizing: border-box;
  width: 400px;
  margin: 15% auto 0;
  box-shadow: 2px 2px 5px 1px rgba(0, 0, 0, 0.58);
  padding-bottom: 40px;
  border-radius: 3px;
  background-color: rgba(2, 2, 2, 0.78);
}
input[type=text],input[type=password]::-webkit-input-placeholder {
  font-family: 'roboto', sans-serif;
  transition: all 0.2s ease-in-out;
}

input[type=submit] {
  border: none;
  background: #1abc9c;
  cursor: pointer;
  border-radius: 3px;
  padding: 6px;
  width: 200px;
  color: white;
  margin-left: 100px;
  box-shadow: 0 3px 6px 0 rgba(0,0,0,0.2);
}
input[type=submit]:hover { 
    transform: translateY(-3px);
    box-shadow: 0 6px 6px 0 rgba(0,0,0,0.2);
}

input[type=text],input[type=password] {
	height: 30px;
	display: block;
  padding: 6px;
  margin: auto;
  color: white;
	border-right-color: transparent;
	border-top-color: transparent;
	border-left-color: transparent;
	background-color: transparent;
}

input[type=text]:focus,input[type=text]:valid, input[type=password]:focus, input[type=password]:valid {
    outline: none;
  }
input::-webkit-input-placeholder {
      color: #1abc9c;
      font-size: 13px;
      transform: translateY(-5px);
      visibility: visible !important;
    }
</style>

<body>
<!--php script section -->
<?php

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
  if (!empty($_POST['username']))
  {
      
    $con = mysqli_connect("localhost","root","","pro") or die('Unable to connect to database');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tbl_users WHERE uname = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    if ($count == 1)
    {
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      $_SESSION['time'] = 0;
    header('Location: page.php');
    }
    else
    {
      $msg = 'Incorrect Credential';
    }
  }  
}
?>
<!--End of php -->
	<form action="" method="POST">
		<p><input type="text" name="username" placeholder="Username" required></p>
		<p><input type="password" name="password" placeholder="Password" required><?php if($msg) echo "<legend>$msg</legend>"; ?></p>
		<p><input type="submit" name="submit" value="Login"></p>
	</form>

</body>
</html>