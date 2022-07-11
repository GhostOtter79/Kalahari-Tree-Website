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
$pass2Err = $pass1Err = $nameErr = $emailErr = $surnameErr = $numbErr = $cityErr = "";
$pass1 = $pass2 = $name = $surname = $email = $numb = $city = "";
$noError = true;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  //################## Validate name ##################
  if (empty($_POST["name"]))
  {
    $nameErr = "Name is required";
    $noError = false;
  } 
  else 
  {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name))
    {
      $nameErr = "Only letters and white space allowed";
      $noError = false;
    }
  }

  //################## Validate surname ##################
  if (empty($_POST["surname"]))
  {
    $surnameErr = "Surname is required";
    $noError = false;
  } 
  else 
  {
    $surname = test_input($_POST["surname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$surname))
    {
      $surnameErr = "Only letters and white space allowed";
      $noError = false;
    }
  }
  
  //################## Validate email ##################
  if (empty($_POST["email"])) 
  {
    $emailErr = "Email is required";
    $noError = false;
  } 
  else
  {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $emailErr = "Invalid email format";
      $noError = false;
    }
  }

  //################## Validate number ##################
  if (empty($_POST["numb"])) 
  {
    $numbErr = "Number is required";
    $noError = false;
  } 
  else
  {
    $numb = test_input($_POST["numb"]);
    if (!is_numeric($numb)) 
    {
      $numbErr = "Invalid number format";
      $noError = false;
    }
  }

  //################## Validate hometown ##################
  if (empty($_POST["city"]))
  {
    $cityErr = "City is required";
    $noError = false;
  } 
  else 
  {
    $city = test_input($_POST["city"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$city))
    {
      $cityErr = "Only letters and white space allowed";
      $noError = false;
    }
  }

  //################## Validate passwords ##################
  if (empty($_POST["pass1"]))
  {
    $pass1Err = "Password is required";
    $noError = false;
  }
  
  if (empty($_POST["pass2"]))
  {
    $pass2Err = "City is required";
    $noError = false;
  }
    
  $pass1 = test_input($_POST["pass1"]);
  $pass2 = test_input($_POST["pass2"]);

  if($pass1 !== $pass2)
  {
    $pass2Err = "Passwords does not match";
    $noError = false;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="modal">
  <form class="modal-content" action="" method="POST">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="email"><b>Email</b></label><span class="error"> <?php echo $emailErr;?></span>
      <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>" required>
      
  
      <label for="FName"><b>Cellphone Number</b></label><span class="error"> <?php echo $numbErr;?></span>
      <input type="text" placeholder="Enter Cellphone Number" name="numb" value="<?php echo $numb;?>" required>
      
      
      <label for="FName"><b>Name</b></label><span class="error"> <?php echo $nameErr;?></span>
      <input type="text" placeholder="Enter Name" name="name" value="<?php echo $name;?>" required>
      

      <label for="LName"><b>Surname</b></label><span class="error"> <?php echo $surnameErr;?></span>
      <input type="text" placeholder="Enter Surname"  name="surname" value="<?php echo $surname;?>" required>
      

      <label for="HTown"><b>Home Town</b></label><span class="error"> <?php echo $cityErr;?></span>
      <input type="text" placeholder="Enter Home Town" name="city" value="<?php echo $city;?>" required>
      

      <label for="psw"><b>Password</b></label><span class="error"> <?php echo $pass1Err;?></span>
      <input type="password" placeholder="Enter Password" name="pass1" value="<?php echo $pass1;?>" required>
      

      <label for="psw-repeat"><b>Repeat Password</b></label><span class="error"> <?php echo $pass2Err;?></span>
      <input type="password" placeholder="Repeat Password" name="pass2" value="<?php echo $pass2;?>" required>
      

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <a href="Index1.php"><button type="button"  class="cancelbtn">Cancel</button></a>
        <button type="submit" name="submit" value="Submit" class="signup">Sign Up</button>
      </div>
    </div>
  </form>
</div>



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
    $q = 'INSERT INTO user (UserEmail, UserPassword, UserFName, UserLName, CellNumber, UserHomeTown) VALUES (\''.$email.'\', \''.$pass1.'\', \''.$name.'\', \''.$surname.'\', \''.$numb.'\', \''.$city.'\')';
    $res = mysqli_query($conn, $q);
    $_SESSION['username'] = $name . " " . $surname;
    $_SESSION["userEmailAcc"] = $email;

    $conn -> close();

    header("location: Index1.php");
}

?>

</body>
</html>