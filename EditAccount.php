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
$cityErr = $numberErr ="";
$city = $number ="";
$noError = true;

$servername = 'localhost';
$username = 'username';
$password = 'password';
$errors = array();

// Create connection to server
$conn = mysqli_connect($servername, $username, $password);

// Check connection to server
if (!$conn) 
{
die('Connection failed: ' . mysqli_connect_error());
}
echo 'Connected successfully';

//Connect to database
mysqli_select_db($conn, 'gumtreedatabase');

$userInfo = "SELECT UserEmail, AdminPrivilege FROM user WHERE UserEmail LIKE '%".$_SESSION['userEmailAcc']."%'" ;
$result2 = $conn->query($userInfo);
$row2 = $result2->fetch_assoc();

if($row2["AdminPrivilege"] == 1)
{  
    $pageName = "AdminViewAccounts.php" ; 
} 
else
{ 
    $pageName = "ViewAccount.php" ;
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="modal">
  <form class="modal-content" action="" method="POST">
    <div class="container">
      <h1>Change Account Information</h1>
      <p>Please fill in this form to change your account information.</p>
      <hr>
      <label for="homeTown"><b>Home Town</b></label>
      <input type="text" placeholder="Enter your Home Town" name="homeTown" value="<?php echo $city;?>" required>
      <span class="error">* <?php echo $cityErr;?></span>
      

      <label for="cellNumb"><b>Cell Number</b></label>
      <input type="text" placeholder="Enter your Cell Number" name="cellNumb" value="<?php echo $number;?>" required>
      <span class="error">* <?php echo $numberErr;?></span>

      
      <div >
        <a href="<?php echo $pageName; ?>"><button type="button"  class="cancelbtn">Cancel</button></a>
        <button type="submit" name="submit" value="Submit" class="signup">Change</button>
      </div>
    </div>
  </form>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $city = test_input($_POST["homeTown"]);
  $number = test_input($_POST["cellNumb"]);
}

if(isset($_POST['submit']) && $noError)
{
    $query = "UPDATE user SET UserHomeTown = '".$city."', CellNumber = '".$number."' WHERE UserEmail LIKE '%".$_SESSION['userEmailAcc']."%'" ;
    $result = mysqli_query($conn, $query);
    $conn -> close();
    header("location: ".$pageName);
}
?>
</div>

</body>
</html>