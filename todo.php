<!DOCTYPE html>
<html>
<head>
    <title>To-do List</title>
    <style>
    	body{
    		background-color: #C2CAD0;
    	}
    	h1{
    		text-decoration: underline;
    		color: #7E685A;
    	}
    	h3{
    		color: royalblue;
    	}
    	table{
    		background-color: lightpink;
    		color: darkgreen;
    		border-collapse: collapse;
    		border: 3px groove blue;
    	}
    	a{
    		text-decoration: none;
    		color: forestgreen;
    	}
    	a:hover{
    		text-decoration: underline;
    		color: orangered;
    	}
    	th{
    		padding: 10px;
    		margin: 5px;
    		color: darkgreen;
    	} 
    	tr, td{
    		padding: 10px;
    		margin: 5px;
    		color: forestgreen;
    	}
    	p,div{
    		color: royalblue;
    		font-size: 20px;
    	}
    	label{
    		padding: 5px;
    	}
    	input{
    		background-color: lightblue;
    		color: black;
    		font-weight: bold;
    		padding: 10px;
    		margin: 10px;
    		border-radius: 10px;
    	}
	</style>
</head>
<body>
<center>
<?php
// Include config file
require_once "config.php";
// Attempt select query execution
session_start();
if(isset($_POST["sort"])){
	$_SESSION["choice"]=$_POST["sort"];
}
else{
	$_SESSION["choice"]="days_remaining";
}
if(isset($_SESSION["userid"])){
	$sql="Select * from tasks where userid='".$_SESSION["userid"]."' order by ".$_SESSION["choice"];
	if($result=$link->query($sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<h1>TO-DO LIST</h1>";
			echo "<h3>Following are the tasks you need to do before their respective duedate.</h3>";
			echo "<table border='2'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Id</th>";
			echo "<th>Subject</th>";
			echo "<th>Task</th>";
			echo "<th>Days remaining</th>";
			echo "<th>Action</th>";
			echo "<th>Remarks</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" . $row['id'] . "</td>";
				echo "<td>" . $row['subject'] . "</td>";
				echo "<td>" . $row['task'] . "</td>";
				echo "<td>" . $row['days_remaining'] . "</td>";
				echo "<td>";
				echo "<a href='read.php?id=" . $row['id'] . "'>View this task</a>";
				echo "&nbsp;";
				echo "<a href='update.php?id=" . $row['id'] . "'>Update this task</a>";
				echo "&nbsp;";
				echo "<a href='delete.php?id=" . $row['id'] . "'>Delete this task</a>";
				echo "&nbsp;";
				echo "</td>";
				if($row['days_remaining']<7){
					echo "<td>Task Pending</td>";
				}
				else{
					echo "<td></td>";
				}
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "<p>Has your professor given you a new task? <a href='create.php'>Click here</a> to create it.</p>";
			
		// Free result set
			mysqli_free_result($result);
		}
		else{
			echo "<p>You have not added any tasks in your to-do list.</p><br>";
			echo "<p><a href='create.php'>Click here</a> to add task.</p><br>";
		}
		echo "<p><a href='logout.php'>Logout</a></p>";
		echo "<p><a href='deluser.php'>Delete account</a>.</p>";
	}
}
else
	echo "<p>You haven't logged in to your account. <a href='login.php'>Click here</a> to login.</p>";
?>
<div>Sort by:
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<input type="radio" id="subject" name="sort" value="subject">
	<label for="subject">Subject</label>
	<input type="radio" id="days_remaining" name="sort" value="days_remaining">
	<label for="days_remaining">Days Remaining</label><br>
	<input type="submit" value="Submit">
	</form>
</div>
</center>
</body>
</html>