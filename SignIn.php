<?php
session_start()
?>

<!DOCTYPE html>
<html>
<head>
<title>Kalahari Tree</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico?v=2" />
<link rel="stylesheet" href="Stylesheet.css" />
<style>
.error {color: #FF0000;}

body {
    background-color: white;
}
</style>
</head>
<body>
<?php
// define variables and set to empty values
$passErr = $emailErr ="";
$pass = $email ="";
$noError = true;


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  //################## Validate email ##################
  if (empty($_POST["email"])) 
  {
    $emailErr = "Email is required";
    $noError = false;
  }
  else
  {
    $email = test_input($_POST["email"]);
  }
  $pass = test_input($_POST["pass1"]);
  
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php
if(isset($_POST['submit']) && $noError)
{
    $servername = "localhost";
    $username = "username";
    $password = "password";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    mysqli_select_db($conn, 'gumtreedatabase');

    $query = "SELECT UserFName, UserLName, UserEmail, UserPassword FROM user WHERE UserEmail LIKE '".$email."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if($result->num_rows < 1)
    {
      $emailErr = "No account for this email";
      $noError = false;
    }

    if($row["UserPassword"] == $pass)
    {
      //successfully logged in
      $_SESSION['username'] = $row["UserFName"] . " " . $row["UserLName"];
      $_SESSION["userEmailAcc"] = $email;
      $conn -> close();
      header("location: Index1.php");
    }
    else
    {
      //not logged in
      $passErr = "Wrong password";
      $noError = false;
    }

    $conn -> close();
}

?>

<div class="modal">
  <form class="modal-content" action="" method="POST">
    <div class="container">
      <h1>Sign In</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="email"><b>Email</b></label><span class="error"> <?php echo $emailErr;?></span>
      <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>" required>
  
      

      <label for="psw"><b>Password</b></label><span class="error"> <?php echo $passErr;?></span>
      <input type="password" placeholder="Enter Password" name="pass1" value="<?php echo $pass;?>" required>

      <a href= "SignUp.php"> Sign Up </a>
      <div >
        <a href="Index1.php"><button type="button"  class="cancelbtn">Cancel</button></a>
        <button type="submit" name="submit" value="Submit" class="signup">Sign In</button>
      </div>
    </div>
  </form>



</div>

</body>
</html>