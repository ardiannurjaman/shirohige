<?php
session_start();
include 'koneksi/koneksi.php';

// Check if user is already logged in using session
if (isset($_SESSION["login"])) {
  header("Location:index.php");
  exit;
}

// Check if cookie exists and try to log in with cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  $stmt = mysqli_prepare($conn, "SELECT username FROM user WHERE id_user = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  // Check cookie with hashed username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
    header("Location:index.php");
    exit;
  }
}

// Handle login form submission
if (isset($_POST['login'])) {
  $username = htmlspecialchars($_POST["username"]);
  $password = $_POST["password"];

  $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_user'] = $row['id_user'];
      $_SESSION['username'] = $username;
      $_SESSION['hak_akses'] = $row['hak_akses'];

      // Set session and cookie if "remember" is checked
      $_SESSION['login'] = true;

      if (isset($_POST['remember'])) {
        $secure_key = hash('sha256', $row['username']);
        setcookie('id', $row['id_user'], time() + 60 * 60 * 24 * 30, "/");
        setcookie('key', $secure_key, time() + 60 * 60 * 24 * 30, "/");
      }

      header("Location:index.php");
      exit;
    } else {
      echo "
      <script>
          alert('Password Salah!');
          window.location.href = 'loginnn.php';
      </script>";
    }
  } else {
    echo "
    <script>
        alert('Login Gagal! Username Tidak Ditemukan!');
        window.location.href = 'loginnn.php';
    </script>";
  }

  mysqli_stmt_close($stmt);
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
		<input type="submit" name="login"40 value="Login" alt="Submit">

		<div id = "success"class="success"></div>
		<div  id= "eror" class="eror"></div>
	</form>
    <center>
    <h4>Copyright &copy; <font color="green" alt="ardian"> ardian </font> </h4>
    </center>

</body>
</html>