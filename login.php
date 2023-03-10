<!DOCTYPE html>
<html>
<head>
  <title>Address Book - Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    header {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
    }

    header h1 {
      margin: 0;
    }

    .container {
      max-width: 960px;
      margin: 50px auto;
      text-align: center;
      padding: 50px;
      background-color: white;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2);
    }

    form {
      width: 50%;
      margin: 0 auto;
      text-align: left;
      padding: 50px;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      font-size: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #333;
      color: white;
      border: 0;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }

    .links {
      text-align: center;
      margin-top: 20px;
    }

    .links a {
      color: #333;
      text-decoration: none;
    }

    .links a:hover {
      color: #555;
    }
  </style>
</head>
<body>
  <header>
    <h1>Address Book</h1>
  </header>
  <div class="container">
    <h2>Login</h2>
    <form action="" method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password"  id="password" name="password" placeholder="Password" required><br>
      <input type="checkbox" onclick="showPassword()">Show Password<br><br>

      <input type="submit" name = "submit" value="Submit">
    </form>
    <script>
      function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
    <div class="links">
      <a href="register.php">Not a member yet? Register here</a><br>
      <a href="index.php">Back to Home</a>
    </div>
  </div>
</body>
</html>


<?php


$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "addressbook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$email = '';
$password = '';


//store in session
session_start();

if (isset($_POST['submit']))
{

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) 
    {
        
        header("Location: list.php");

        exit;
    } 
    else 
    {
        echo "Email or password is incorrect. Please try again.";
    }


    mysqli_close($conn);




    

}


?>
