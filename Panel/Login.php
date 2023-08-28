<?php
// login_process.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // In a real application, you would perform authentication here, e.g., query a database
    // For demonstration purposes, we'll use a simple example.
    $validUsername = "admin";
    $validPassword = "admin"; // Change this to the correct password

    // Check if the provided credentials are valid
    if ($username === $validUsername && $password === $validPassword) {
        // Successful login, start a PHP session
        session_start();

        // Store the username in the session variable
        $_SESSION["username"] = $username;

        // Redirect to a dashboard or welcome page
      
        exit;
    } 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <title>Login Page</title>
  <style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    h1{
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }
    img{
        width: 75px;
        height: 75px;
        padding-bottom: 20px;
    }
    
	form {
		width: 400px;
		margin: 0 auto;
		padding: 20px;
		background-color: #f2f2f2;
		border-radius: 5px;
		box-shadow: 0 0 5px 0 rgba(0,0,0,0.2);
	}
    label {
		display: inline-block;
		width: 120px;
		margin-bottom: 10px;
	}
    input[type="text"], input[type="password"] {
		padding: 10px;
		width: 95%;
		border-radius: 3px;
		border: none;
		margin-bottom: 20px;
	}
    input[type="submit"] {
        background-color: rgb(57, 211, 18);
        color: #f2f2f2;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }
        
    
    input[type="submit"]:hover {
        background-color: black;
    }
	.success {
		color: green;
		font-weight: bold;
		margin-bottom: 15px;
	}

	.eror {
		color: red;
		font-weight: bold;
		margin-bottom: 15px;
	}

  </style>
</head>
<body>
	<h1>Login Page</h1>
	<?php
    if (!empty($errorMsg)) {
        echo '<div class="error">' . $errorMsg . '</div>';
    }
    ?>
	<form name="loginForm"  method="post" action="">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username"><br><br>
		<label for="password">password:</label>
		<input type="password" id="password" name="password"><br><br>
		<input type="submit" name=""40 value="Login">

		<div id = "success"class="success"></div>
		<div  id= "eror" class="eror"></div>
	</form>
    <center>
    <h4>Copyright &copy; <font color="green" alt="ardian"> ardian </font> </h4>
    </center>

</body>
</html>