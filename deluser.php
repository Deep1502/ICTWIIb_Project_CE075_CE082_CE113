<?php
require_once "config.php";
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$sql="DELETE FROM `tasks` WHERE userid=".$_SESSION["userid"];
	if($result=$link->query($sql)){
		$sql1="DELETE FROM `users` WHERE id=".$_SESSION["userid"];
		if($result1=$link->query($sql1)){
			session_destroy();
			header("Location:login.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Account</title>
	<style>
		body{
			background:#4dd2ff;
		}
		h1{
			text-align:center;
			text-decoration:underline;
		}
		p{
			font-size:25px;
		}
		form{
			border:3px solid #ff6347;
			width:50%;
			background-color: white;
		}
		input{
			width:10%;
			height:30px;
			border:1solid;
	  		background:#2691d9;
	  		border-radius:15px;
	  		font-size:20px;
	  		color:#e9f4fb;
	  		margin:10px;
		}
		a{
			color:#2691d9;
		}
	</style>
</head>
<body>
	<center>
	<h1>Delete account</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <p>Are you sure you want to delete your account?<br>All data will be erased.</p>	
	<input type="submit" value="Yes">
	<a href="todo.php">No</a>
	</form>
	</center>
</body>
</html>