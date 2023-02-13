<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "addressbook";

$name_error = "";
$email_error = "";

$mobile_error = "";
$password_error = "";
$address_error = "";

  $is_valid = true;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $address = $_POST["address"];


   

    if (!preg_match("/^[a-zA-Z]+$/", $name)) {
      $name_error = "Name must contain only letters";
      $is_valid = false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format";
      $is_valid = false;
    }

    
    if (!preg_match("/^[7-9][0-9]{9}$/", $mobile)) {
      $mobile_error = "Mobile must start with 7, 8 or 9 and contain 10 digits";
      $is_valid = false;
    }

    if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+=-])(?=.*[0-9]).{8,}$/", $password)) {
      $password_error = "Password must contain at least one upper-case letter, one special character and a minimum of 8 characters";
      $is_valid = false;
    }

    if (empty($address)) 
    {
      $address_error = "Address cant be empty";
      $is_valid = false;
    }



    

    if ($is_valid)
    {

  


    $sql = "INSERT INTO user(name,email,mobile,password,address)
VALUES ('$name','$email','$mobile','$password','$address')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  header("Location: login.php");

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
}



?>



<!DOCTYPE html>
<html>
<head>
  <title>Address Book - Register</title>
  <style>
 .error{color : red;}
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

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="password"],
    textarea {
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
  </style>
</head>
<body>
  <header>
    <h1>Address Book</h1>
  </header>


  

  <div class="container">
    <h2>Register</h2>
    <form action="" method="post">
      <input type="text" name="name" placeholder="Name" required>
      <span class="error"><?php echo $name_error; ?></span><br><br>

      <input type="email" name="email" placeholder="Email" required>
      <span class="error"><?php echo $email_error; ?></span><br><br>

      <input type="number" name="mobile" placeholder="Mobile" required>
      <span class="error"><?php echo $mobile_error; ?></span><br><br>

      <input type="password" name="password" placeholder="Password" required>
      <span class="error"><?php echo $password_error; ?></span><br><br>

      <textarea name="address" placeholder="Address" required></textarea>
      <span class="error"><?php echo $address_error; ?></span><br><br>

      <input type="submit" name="submit" value="Submit">
      
    </form>

    <p style="text-align: center; margin-top: 30px;">Already have an account? <a href="login.php">Go to login</a></p>
    <p style="text-align: center; margin-top: 30px;">🏡<a href="index.php">Home</a></p>

  </div>
</body>
</html>


