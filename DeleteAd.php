<?php
session_start()
?>

<!DOCTYPE html>
<html>
<head>
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
    $ItemID = $_GET['ItemID'];
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
?>


<div class="modal">
  <form class="modal-content" action="" method="POST">
    <div class="container">
      <h1>Delete Ad</h1>
      <p>Are you sure you want to delete this ad.</p>
      <hr>
      <div >
        <a href="<?php echo $pageName; ?>"><button type="button"  class="cancelbtn">Cancel</button></a>
        <button type="submit" name="submit" value="Submit" class="signup">Delete Ad</button>
      </div>
    </div>
  </form>


<?php
if(isset($_POST['submit']))
{
    //Delete image
    $query = "SELECT ItemID, PictureName FROM picture WHERE ItemID LIKE '".$ItemID."'";
    $result2 = $conn->query($query);
    $row2 = $result2->fetch_assoc();
    unlink("Pictures/".$row2['PictureName']);

    //Delete item query

    $query = "DELETE from items where ItemID = ".$ItemID;
    $result = mysqli_query($conn, $query);

    //Delete picture query

    $query = "DELETE from picture where ItemID = ".$ItemID;
    $result = mysqli_query($conn, $query);

    header("location: ".$pageName);
    $conn -> close();
}
?>
</div>

</body>
</html>