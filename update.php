
<?php

session_start();
if (!isset($_SESSION['email'])) 
{


  header("Location: login.php");
}


$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "addressbook";

$name_error = "";
$phone_error = "";
$state_error = "";
$country_error = "";
$pincode_error = "";
$is_valid = true;







// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['id'])) 
{

    

$id = $_GET['id'];
$sql = "SELECT id, name, phone, state, country, photo, pincode FROM address WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);




}



if(isset($_POST['update'])) 
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $photo = $_POST['photo'];
    $pincode = $_POST['pincode'];

    if($photo == "")
    {
      $photo = $row['photo'];
    }


    if (!preg_match('/^[\p{L} ]+$/u', $name)) {
      $name_error = "Name must contain only letters";
      $is_valid = false;
    }

    if (!preg_match("/^[7-9][0-9]{9}$/", $phone)) {
      $phone_error = "Mobile must start with 7, 8 or 9 and contain 10 digits";
      $is_valid = false;
    }

    if (!preg_match("/^[1-9][0-9]{5}$/", $pincode)){
      $pincode_error = "Invalid pin code";
      $is_valid = false;


    }

    if (empty($state)) 
    {
      $state_error = "Address cant be empty";
      $is_valid = false;
    }
    if (empty($country)) 
    {
      $country_error = "Address cant be empty";
      $is_valid = false;
    }

    if ($is_valid)
    {


    $sql = "UPDATE address SET name='$name', phone='$phone', state='$state', country='$country', photo='$photo', pincode='$pincode' WHERE id=$id";
    if (mysqli_query($conn, $sql))
     {

        header("Location: list.php");

    }
     else 
     {
      echo "Error updating record: " . mysqli_error($conn);
    }
  }
}
mysqli_close($conn);


?>





<html>
  <head>
    <title>Update Record</title>
    <style>
          .error{color : red;}

      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }
      nav {
        background-color: #333;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        padding: 20px;
      }
      nav a {
        color: #f2f2f2;
        text-decoration: none;
        margin-right: 20px;
      }
      form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        margin: 50px auto;
        width: 500px;
        text-align: center;
      }
      input[type="text"], input[type="file"],input[type = "number"] {
        padding: 10px;
        margin-bottom: 20px;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #333;
      }
      input[type="submit"] {
        background-color: #333;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
      }
      input[type="submit"]:hover {
        background-color: #f2f2f2;
        color: #333;
      }
    </style>
  </head>
  <body>
    <nav>
      <a href="list.php">Profile</a>
      <a href="index.php">Home</a>
    </nav>
    <form action="" method="post">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <p>Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"></p>
      <span class="error"><?php echo $name_error; ?></span><br><br>

      <p>Phone: <input type="number" name="phone" value="<?php echo $row['phone']; ?>"></p>
      <span class="error"><?php echo $phone_error; ?></span><br><br>

      <p>State: <input type="text" name="state" value="<?php echo $row['state']; ?>"></p>
      <span class="error"><?php echo $state_error; ?></span><br><br>

      <p>Country: <input type="text" name="country" value="<?php echo $row['country']; ?>"></p>
      <span class="error"><?php echo $country_error; ?></span><br><br>

      <p>Photo: <input type="file" name="photo" value=""><span><?php echo $row['photo']; ?></span></p>

      <p>Pincode: <input type="number" name="pincode" value="<?php echo $row['pincode']; ?>"></p>
      <span class="error"><?php echo $pincode_error; ?></span><br><br>

      <input type="submit" name="update" value="Update">
    </form>
  </body>
</html>


