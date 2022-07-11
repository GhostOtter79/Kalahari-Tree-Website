<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
  <!-- Connecting to server and database-->
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

    $query = "SELECT UserFName, UserLName, UserHomeTown, UserEmail, CellNumber FROM user WHERE UserEmail LIKE '%".$_SESSION['userEmailAcc']."%'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $name = $row["UserFName"];
    $surname = $row["UserLName"];
    $email = $row["UserEmail"];
    $town = $row["UserHomeTown"];
    $number = $row["CellNumber"];
  ?>

  <!-- Page ear name -->
  <head>
  <title>Kalahari Tree</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico?v=2" />
  </head>

  <!-- Link my style sheet aswell as google's icons sheet -->
  <link rel= "stylesheet" href="Stylesheet.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  
    <!-- Creates the bar with SignIn ect. -->
    <?php

//Tests if user is logged in or not
if (isset($_SESSION['username'])) //NULL
{
  echo("
    <nav id=\"navigationBar\">
      <ul>
        <span class= \"nav-left \" id= \"brand \" hrref=  \"Home \"><img src= \"Logo3.png \" alt= \"Kalahari Tree logo \" width= \"200 \" height= \"50 \"></span>
        <li>
            <a class= \"link \">".$_SESSION['username']."</a>
        </li>  
        <li>
            <a href= \"SignOut.php\" class= \"link \">Sign Out</a>
        </li>
      </ul>
  </nav>
  ");
}
else{
  echo("
  <nav id=\"navigationBar\">
    <ul>
      <span class= \"nav-left \" id= \"brand \" hrref=  \"Home \"><img src= \"Logo3.png \" alt= \"Kalahari Tree logo \" width= \"200 \" height= \"50 \"></span>
      <li>
          <a href= \"javascript:void(0) \" class= \"link \">Guest</a>
      </li>  
      <li>
          <a  href= \"SignIn.php\" class= \"link \">Sign In</a>
      </li>
    </ul>
  </nav>
  ");
}
?> 

   

    <!-- Creates category bar -->
    <cat id="categoryBar">
      <ul>
        <li>
          <a  href="Index1.php" class="link">Home</a>
        </li>
        <li>
          <a  href="Electronics.php" class="link">Electronics</a>
        </li>
        <li>
          <a href="HomeAndGarden.php" class="link">Home & Garden</a>
        </li>
        <li>
          <a href="Fashion.php" class="link">Fashion</a>
        </li>
        <li>
          <a href="SportsAndLeisure.php" class="link">Sports & Leisure</a>
        </li>
        <li>
          <a href="Pets.php" class="link">Pets</a>
        </li>
        <li>
          <a href="GamesAndToys.php" class="link">Games & Toys</a>
        </li>
        <li>
          <a href="Search.php" class="link">Search <i style="size: 17px"class="material-icons">search</i></a>
        </li>
      </ul>
    </cat>
    
    
<!--Account page -->
    
    <div id="center">
    <h1 style="text-align:center">Account Dashboard</h1>
    <div id="contentbox">
    <div id="signup">
    <div id="signup-st">
    <form action="" method="POST" id="signin" id="reg">
    <div id="reg-head" class="headrg">Your Profile</div>
    <table style="border: 0 align: center cellpadding: 2 cellspacing: 0">
    <tr id="lg-1">
    <td class="tl-1"> <div id="tb-name">First Name:</div> </td>
    <td class="tl-4"><?php echo $name; ?></td>
    </tr>
    <tr id="lg-1">
    <td class="tl-1"><div id="tb-name">Last Name:</div></td>
    <td class="tl-4"><?php echo $surname; ?></td>
    </tr>
    <tr id="lg-1">
    <td class="tl-1"><div id="tb-name">Home Town:</div></td>
    <td class="tl-4"><?php echo $town; ?> <a href="EditAccount.php"><i style="color:#FDE3A7; font-size:17px" class="material-icons">edit</i></a></td>
    </tr>
    <tr id="lg-1">
    <td class="tl-1"><div id="tb-name">Email:</div></td>
    <td class="tl-4"><?php echo $email; ?></td>
    </tr>
    <tr id="lg-1">
    <td class="tl-1"><div id="tb-name">Cell Number:</div></td>
    <td class="tl-4"><?php echo $number; ?> <a href="EditAccount.php"><i style="color:#FDE3A7; font-size:17px" class="material-icons">edit</i></a></td>
    </tr>
    </table>
    <div id="reg-bottom" class="btmrg"></div>
    </form>
    </div>
    </div>
    <div id="login">
    <div id="login-sg">
    <div id="st"><a href="CreateAds.php" id="st-btn10">Create Ad</a></div>
    <div id="st1"><a href="DeleteAccount.php" id="st-btn">Delete Account</a></div>
    </div>
    </div>
</div>
</div>
    
<!-- Show User Ads -->
    
    <div id="center2">
    <h1 style="text-align:center2">Your Ads</h1>
    
    <?php 
    
           $itemInfo = "SELECT ItemID, ItemName, ItemCategory, ItemCondition, PictureName, ItemPrice,UserHomeTown, UserEmail FROM items JOIN user USING(UserID) JOIN picture USING(ItemID) WHERE UserEmail LIKE '%".$_SESSION['userEmailAcc']."%'";
            $result = $conn->query($itemInfo);

            if ($result->num_rows > 0) {
                //output data of each row
                
                while($row = $result->fetch_assoc()) {
                    echo("
                      <items id=\"AccountAdContainer\">
                      <a name=\"asd\">
                        <div style=\"float: left\">
                            <p><img src= Pictures\\". $row["PictureName"]." alt=\"Picture of item\" width=\"200px\" height=\"auto\"></p>
                            <p>" .$row["ItemName"]."</br></p>
                            <p>R ".$row["ItemPrice"]."</br></p>
                            <p><i class=\"material-icons\">location_on</i>".$row["UserHomeTown"]."</p>
                            <a href=\"ViewItem.php?ItemID=".$row["ItemID"]."\" name=\"asd\"><p id=\"st-btn2\">View Ad</p></a>
                            <p href=\"ViewAccount.php\" id=\"st-btn3\">Delete Ad</p>
                        </div>
                      </a>
                      </items>
                    ");
                }
              } else {
                echo "0 results";
              }

        ?>

</body>
    </br>
    
  <div class="addvertiseDiv">
  </div>
            </div class="footerDiv">
  </br></br>
  <style>
  footer{
    background-color: rgb(0, 153, 255);
    color: white;
    text-align: center;
    width: 100%;
    margin-left:0px;
   }
    </style>
    <footer>
    <p><img src= "Logo3.png " alt= "Kalahari Tree logo " width= "200 " height= "50 ">
            </footer>
  </div>
</html>