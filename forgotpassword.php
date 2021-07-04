<?php
session_start();
include_once 'config.php';
if(isset($_POST['submit'])) {
    $user_id1 = $_POST['user_id'];
    try{
    	$result = mysqli_query($link,"SELECT * FROM users where username='" . $_POST['user_id'] . "'");
    	$row = mysqli_fetch_assoc($result);
    	if(empty($row)){
    		throw new Exception('Invalid user id.');
    	}
    	else{
			$user_id2=$row['username'];
			$email_id=$row['email'];
			$id=$row['id'];
  			if($user_id1==$user_id2) {
    			$to = $email_id;
	    		$txt = "Hi, $user_id1. Click http://localhost/ICTW-b/Project/resetpassword.php?id=$id to reset password";
	    		$headers = "From: deepatel1502@gmail.com\r\n";
		    	$subject = "Reset Password";
    		 	$msg=mail($to,$subject,$txt,$headers);
    			if($msg){
    				echo "Link to change the password has been sent to your registered email id.";
      				$_SESSION['msg'] = 'password link sent';
    			}
    			else{
    				echo "mail was not sent!!";			
    			}
  			}
  		}
    }
    catch(Exception $e){
    	echo "<p>Caught exception: ".$e->getMessage()."</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<style>
		body{
			background-color: orange;
		}
		h1{
			color: darkred;
			text-decoration: underline;
			text-align: center;
		}
		p,td{
			color: darkblue;
			font-size: 20px;
			text-align: center;
		}
		table{
			border: 2px solid red;
			padding: 10px;
			box-shadow: 5px 5px 5px darkslateblue;
			background-color: antiquewhite;
		}
		input{
			padding: 10px;
			margin: 10px;
			color: darkblue;
			font-size: 18px;
			border-radius: 10px;
		}
	</style>
</head>
<body>
	<h1>Forgot Password</h1>
	<p>Enter your userid and mail will be sent to your registered email id for password reset link</p>
	<form action='' method='post'>
	<table align='center'>
		<tr>
			<td>user id:</td>
			<td><input type='text' name='user_id'/></td>
		</tr>
		<tr>
			<td colspan="2"><input type='submit' name='submit' value='Submit'/></td>
		</tr>
	</table>
	</form>
</body>
</html>