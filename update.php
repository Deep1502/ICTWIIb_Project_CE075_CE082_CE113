<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$subject = $task = $days_remaining = "";
$subject_err = $task_err = $days_remaining_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate subject
    $input_subject = trim($_POST["subject"]);
    if(empty($input_subject)){
        $subject_err = "Please enter a subject.";
    } else{
        $subject = $input_subject;
    }
    
    // Validate task
    $input_task = trim($_POST["task"]);
    if(empty($input_task)){
        $task_err = "Please enter a task.";     
    } else{
        $task = $input_task;
    }
    
    // Validate days_remaining
    $input_days_remaining = trim($_POST["days_remaining"]);
    if(empty($input_days_remaining)){
        $days_remaining_err = "Please enter the days_remaining.";     
    } elseif(!ctype_digit($input_days_remaining)){
        $days_remaining_err = "Please enter a positive integer value.";
    } else{
        $days_remaining = $input_days_remaining;
    }
    
    // Check input errors before inserting in database
    if(empty($subject_err) && empty($task_err) && empty($days_remaining_err)){
        // Prepare an update statement
        $sql = "UPDATE tasks SET subject=?, task=?, days_remaining=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssii", $param_subject, $param_task, $param_days_remaining, $param_id);
            
            // Set parameters
            $param_subject = $subject;
            $param_task = $task;
            $param_days_remaining = $days_remaining;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("Location: todo.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM tasks WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Record</title>
    <style>
    	body{
            background-color: lightcyan;
        }
        h1{
            color: red;
            text-decoration: underline;
        }
        p, label{
            font-size: 20px;
            color: royalblue;
        }
        form{
            border: 2px solid red;
            box-shadow: 5px 5px 5px orangered;
            padding: 20px;
            max-width: 50%;
        }
        input, textarea{
            padding: 10px;
            margin: 10px;
            vertical-align: middle;
            color: darkblue;
            font-size: 18px;
            border-radius: 10px;
        }
        a{
            font-size: 20px;
            color: darkblue;
            margin: 10px;
        }
    </style>
</head>
<body>
	<center>
	<div>
		<h1>Update Record</h1>
	</div>
	<p>Please edit the input values and submit to update the record.</p>
	<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
		<div <?php echo (!empty($subject_err)); ?>">
			<label>Subject</label>
			<input type="text" name="subject" value="<?php echo $subject; ?>">
			<span><?php echo $subject_err;?></span>
		</div>
		<div <?php echo (!empty($task_err)); ?>">
			<label>Task</label>
			<textarea name="task" ><?php echo $task; ?></textarea>
			<span><?php echo $task_err;?></span>
		</div>
		<div <?php echo (!empty($days_remaining_err)); ?>">
			<label>Days Remaining</label>
			<input type="text" name="days_remaining" value="<?php echo $days_remaining; ?>">
			<span><?php echo $days_remaining_err;?></span>
		</div>
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<input type="submit" value="Submit">
		<a href="todo.php">Cancel</a>
	</form>
    </center>   
</body>
</html>