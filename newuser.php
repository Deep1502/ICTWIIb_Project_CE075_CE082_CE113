<?php
require_once "config.php";
if(isset($_POST["username"]) & isset($_POST["password"]) & isset($_POST["email"])){
	if(filter_var($_POST["username"], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]\w{4,19}$/")))){
		if(filter_var($_POST["password"], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9](?=.*\W)(?=.*\w).{4,19}$/")))){
			$password=$_POST["password"];
			$username=$_POST["username"];
			$email=$_POST["email"];
			$sql="INSERT INTO `users`(`username`, `password`, `email`) VALUES ('" . $username . "', '" . $password . "', '" . $email ."')";
			if($result=$link->query($sql)){
				echo "You have registered yourself!<br>";
				echo "<a href='login.php'>Back to login page</a>";
			}
		}
		else
			echo "Invalid password";
	}
	else
		echo "Invalid username or password";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<style>
		body{
			font-family:montserrat;
			background:#4dd2ff;
			height:100vh;
			overflow:hidden;
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
			font-size:20px;
		}
		.center h1{
			text-align:center;
			padding:0 0 20px 0;
			border-bottom:1px solid silver;
			text-decoration:underline;
		}
		.center form{
			padding:40px;
			box-sizing:border-box;
		}
		.center label{
			margin:10px;
		}
	 	input[type="submit"],input[type="reset"]{
			width:40%;
			height:40px;
			border:1 solid;
	  		background:#2691d9;
	  		border-radius:15px;
	  		font-size:20px;
	  		color:#e9f4fb;
	  		margin:10px;
		}
		.center p{
			margin:10px;
		}
		.center ul{
			list-style-type:square;
		}
	</style>	
</head>
<body>
<div class="center">
	<h1>New User</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
		<label>Username</label>
		<input type="text" name="username" required><br>
		<label>Password</label>
		<input type="password" name="password" required><br>
		<label>Email</label>
		<input type="email" name="email" required><br>
		<input type="submit" value="Register">
		<input type="reset" value="Reset">
		</form>
	<p><strong>Note: </strong>Password must meet following:</p>
	<ul>
	<li>Start with a letter or digit</li>
	<li>must contain at least one word element and special character</li>
	<li>should of 5 to 20 characters</li>
	</ul>
	</div>
</body>
</html>