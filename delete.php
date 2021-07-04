<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM tasks WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("Location: todo.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Record</title>
    <style>
        body{
            background-color: lightcyan;
        }
        h1{
            color: red;
            text-decoration: underline;
        }
        p{
            color: royalblue;
            font-size: 20px;
        }
        a{
            font-size: 18px;
            color: darkblue;
            margin: 10px;
        }
        input{
            padding: 10px;
            margin: 10px;
            color: darkblue;
            font-size: 18px;
            border-radius: 10px;
        }
        div{
            border: 2px solid red;
            box-shadow: 5px 5px 5px orangered;
            max-width: 50%;
        }
    </style>
</head>
<body>
    <center>
		<h1>Delete Record</h1>
        <div>
	    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
			<p>Have you completed the task and finished the submission?</p><br>
			<p>
				<input type="submit" value="Yes, I have">
				<a href="todo.php">No, I will do it</a>
			</p>
	</form>
    </div>
    </center>
</body>
</html>