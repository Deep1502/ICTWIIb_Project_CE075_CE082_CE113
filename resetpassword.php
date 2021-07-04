<?php
	session_start();
	if(isset($_GET['id'])){
		$_SESSION['id']=$_GET['id'];
	}
	else{
		echo " done!!";
		if($_POST['Password']!=$_POST['Confirm_Password']){
			echo "Paswords are not matched";
		}
		else{
			require_once "config.php";
			if(filter_var($_POST['Password'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9](?=.*\W)(?=.*\w).{4,19}$/")))){
				$Password = $_POST['Password'];
				$id =  $_SESSION['id'];
				$query = "UPDATE users SET password='$Password' WHERE id = '$id'";
				$result = mysqli_query($link,$query);
				header('Location:login.php');
			}
			else{
				echo "Invalid password.";
			}
		}
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<style>
		body{
			background-color: orange;
		}
		h1{
			color: darkred;
			text-decoration: underline;
		}
		input{
			padding: 10px;
			margin: 10px;
			color: darkblue;
			font-size: 18px;
			border-radius: 10px;
		}
		form{
			border: 2px solid red;
			padding: 10px;
			box-shadow: 5px 5px 5px darkslateblue;
			background-color: antiquewhite;
			max-width: 50%;
		}
		label{
			color: darkblue;
			font-size: 20px;
			text-align: center;
		}
		p, ul, li{
			text-align: left;
			color: darkblue;
			font-size: 20px;
		}
	</style>
</head>
<body>
	<center>
		<h1>Reset Password</h1>
		<div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label>New Password</label>
		<input type="text" name="Password" placeholder="New Password" required><br>
		<label>Confirm New Password</label>
		<input type="text" name="Confirm_Password" placeholder="Confirm New Password" required><br>
		<input type="submit" name="submit">
		<p><strong>Note: </strong>Password must meet following:
		<ul>
			<li>start with letter or digit</li>
			<li>must contain at least one word element and one special character</li>
			<li>should be of 5 to 20 characters</li>
		</ul>
		</p>
		</form>
		</div>
</body>
</html>