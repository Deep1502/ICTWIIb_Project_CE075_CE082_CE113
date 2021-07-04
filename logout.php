<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_destroy();
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<style>
		body{
			background-color: #4dd2ff;
		}
		h1{
			text-decoration:underline;
		}
		p{
			font-size:25px;
		}
		form{
			border:3px solid #ff6347;
			width:50%;
			background:white;
		}
		input{
			width:10%;
			height:25px;
			border:1 solid;
			background:#2691d9;
	  		border-radius:15px;
			font-size:20px;
	  		color:#e9f4fb;
	  		margin:10px;
		}
		a{
			color:#2691d9;
		}
		a:hover{
			text-decoration:underline;
		}
	</style>
</head>
<body>
<center>
	<h1>Logout</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<p>Are you sure you want to logout?</p>
		<input type="submit" value="Yes">
		<a href="todo.php">No</a>
	</form>
</center>
</body>
</html>