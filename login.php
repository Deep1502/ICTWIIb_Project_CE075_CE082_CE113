<?php
//Include config file
require_once "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        $username = $link -> real_escape_string($_POST["username"]);
		$password = $link -> real_escape_string($_POST["password"]);
		$sql1 = "Select * from users where username='" . $username . "' and password='" . $password . "'";
        if ($result1 = $link -> query($sql1)) {
			if($row1 = $result1 -> fetch_assoc()) {
				$userid = $row1["id"];
				session_start();
				$_SESSION["userid"] = $userid;
				header("Location:todo.php");
  			}
			$result1 -> free_result();
		}
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
	<title>Login Page</title>
	<style>
		body{
			font-family:montserrat;
			background:#4dd2ff;
			height:100vh;
		}
		.center{
			position:absolute;
			top:50%;
			left:50%;
			transform:translate(-50%,-50%);
			width:400px;
			background:white;
			border-radius:10px;
			border:3px solid #ff6347;
		}
		.center h1{
			text-align:center;
			padding:0 0 20px 0;
			border-bottom:1px solid silver;
		}
		.center form{
			padding:0 40px;
		}
		.center label{
    		font-size:18px;
		}
		.pass{
			margin:-5px 0 20px 5px;
		}
		.pass a{
    		color:#2691d9;
			text-decoration:none;
		}
		.pass a:hover{
     		text-decoration:underline;
		}
		input[type="submit"], input[type="reset"]{
			width:40%;
			height:50px;
			border:1 solid;
			background:#2691d9;
			border-radius:15px;
			font-size:20px;
			color:#e9f4fb;
		}
		.signup_link{
			margin:30px 0;
			font-size:16px;
			color:#666666;
		}
		.signup_link a{
			color:#2691d9;
			text-decoration:none;
		}
		.signup_link a:hover{
			text-decoration:underline;
		}
		label, input{
   			margin: 10px;
		}
	</style>
</head>
<body>
    <div class="center">
	<h1>LOGIN</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
		<label>Username</label>
		<input type="text" name="username" required><br>
		<label>Password</label>
		<input type="password" name="password" required><br>
		<input type="submit" value="Submit">
		<input type="reset" value="Reset">
	<div class="pass">
	<p>Forgot your password? <a href="forgotpassword.php">Click here</a> to set new password.</p>
	</div>
	<div class="signup_link">
	<p>New user? <a href="newuser.php">Click here</a> to register for to-do list.</p>
	</div>
	</form>
	</div>
</body>
</html>