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
      <h1>Delete Account</h1>
      <p>Are you sure you want to delete your account. All ads will be deleted.</p>
      <hr>
      <div >
        <a href="<?php echo $pageName; ?>"><button type="button"  class="cancelbtn">Cancel</button></a>
        <button type="submit" name="submit" value="Submit" class="signup">Delete Account</button>
      </div>
    </div>
  </form>


<?php
if(isset($_POST['submit']))
{
    //Find all items that belong to user
    $query = "SELECT ItemID, UserID, UserEmail from items join user using(UserID) where UserEmail like \"".$_SESSION["userEmailAcc"]."\"" ;
    $result = $conn->query($query);
    while($row = $result->fetch_assoc())
    {
        $ItemID = $row['ItemID'];

        //Delete image
        $query = "SELECT ItemID, PictureName FROM picture WHERE ItemID LIKE '".$ItemID."'";
        $result2 = $conn->query($query);
        $row2 = $result2->fetch_assoc();
        unlink("Pictures/".$row2['PictureName']);

        //Delete item query

        $query = "DELETE from items where ItemID = ".$ItemID;
        $result2 = mysqli_query($conn, $query);

        //Delete picture query

        $query = "DELETE from picture where ItemID = ".$ItemID;
        $result2 = mysqli_query($conn, $query);
    }

    //Delete user from user table

    $query = "DELETE from user where UserEmail like \"".$_SESSION["userEmailAcc"]."\"" ;
    $result2 = mysqli_query($conn, $query);
    
    $conn -> close();

    session_destroy();
    header("location: Index1.php");
}
?>
</div>
</body>
</html>