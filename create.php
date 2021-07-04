<?php
// Include config file
require_once "config.php";
session_start();
if(isset($_SESSION["userid"])){
    // Define variables and initialize with empty values
    $subject = $task = $days_remaining = "";
    $subject_err = $task_err = $days_remaining_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate subject
        $input_subject = trim($_POST["subject"]);
        if(empty($input_subject)){
            $subject_err = "Please enter a subject.";
        } 
        else{
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
        if(empty($subject_err) && empty($task_err) && empty($duedate_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO tasks (userid, subject, task, days_remaining) VALUES (?, ?, ?, ?)";
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "issi", $param_userid, $param_subject, $param_task, $param_days_remaining);
                
                // Set parameters
                $param_userid = $_SESSION["userid"];
                $param_subject = $subject;
                $param_task = $task;
                $param_days_remaining = $days_remaining;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records created successfully. Redirect to landing page
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
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Record</title>
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
<h1>Create Record</h1>
<p>Please fill this form and submit to add record to the database.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
	
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
		<label>Days remaining</label>
		<input type="text" name="days_remaining" value="<?php echo $days_remaining; ?>">
		<span><?php echo $days_remaining_err;?></span>
	</div>
	<input type="submit" value="Submit">
	<a href="todo.php">Cancel</a>
</form>
</center>         
</body>
</html>