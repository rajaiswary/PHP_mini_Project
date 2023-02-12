<html>
  <head>
    <style>
      form {
        width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      input[type="text"],
      input[type="number"],
      input[type="file"] {
        width: 100%;
        padding: 12px;
        margin-top: 8px;
        margin-bottom: 20px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      input[type="submit"] {
        width: 100%;
        padding: 12px 20px;
        margin-top: 20px;
        background-color: black;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      input[type="submit"]:hover {
        background-color: grey;
      }
    </style>
  </head>
  <body>
    <form action="" method = "post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name">

      <label for="phone">Phone:</label>
      <input type="number" id="phone" name="phone">

      <label for="state">State:</label>
      <input type="text" id="state" name="state">

      <label for="country">Country:</label>
      <input type="text" id="country" name="country">

      <label for="photo">Upload Photo:</label>
      <input type="file" id="photo" name="photo">

      <label for="pincode">Pincode:</label>
      <input type="number" id="pincode" name="pincode">

      <input type="submit" name = "submit" value="Submit">
      <a href = "list.php">Go back</a>
    </form>
  </body>
</html>

<?php

session_start();

$email = '';
$password = '';
$id = 0;
if (!isset($_SESSION['email'])) 
{


  header("Location: login.php");
}


//localhost details

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


$email = $_SESSION['email'];

$password = $_SESSION['password'];

$sql = "SELECT id FROM user WHERE email='$email' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $id = $row["id"];
} 
else
{
  echo "No matching record found.";
}





if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$name = $_POST["name"];
$phone = $_POST["phone"];
$state = $_POST["state"];
$country = $_POST["country"];
$photo = $_POST["photo"];
$pincode = $_POST["pincode"];


$sql = "INSERT INTO address (name, phone, state, country, photo, pincode,user_id)
VALUES ('$name', '$phone', '$state', '$country', '$photo', '$pincode','$id')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";

    header("Location:list.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

?>