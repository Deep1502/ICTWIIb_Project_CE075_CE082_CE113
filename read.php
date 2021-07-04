<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM tasks WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $subject = $row["subject"];
                $task = $row["task"];
                $days_remaining = $row["days_remaining"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Record</title>
    <style>
        body{
            background-color: lightcyan;
        }
        h1{
            color: red;
            text-decoration: underline;
        }
        label{
            color: darkblue;
            font-size: 24px;
        }
        p{
            font-size: 20px;
            color: royalblue;
            font-style: italic;
        }
        div{
            border: 2px solid red;
            max-width: 50%;
            box-shadow: 5px 5px 5px orangered;
        }
    </style>
<body>
    <center>
	<h1>&nbsp;View Record</h1>
	<div>
		&nbsp;
		<label><b>Subject:</b></label>
		<p>&nbsp;&nbsp;<?php echo $row["subject"]; ?></p>
		&nbsp;
		<label><b>Task:</b></label>
		<p>&nbsp;&nbsp;<?php echo $row["task"]; ?></p>
		&nbsp;
		<label><b>Days Remaining:</b></label>
		<p>&nbsp;&nbsp;<?php echo $row["days_remaining"]; ?></p>
	    <p>&nbsp;&nbsp;<a href="todo.php">Back</a></p>
    </div>
    </center>      
</body>
</html>