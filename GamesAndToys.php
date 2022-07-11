<?php
// Start the session
session_start()
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
    // $_SESSION["isSignedIn"];

    //Tests if user is logged in or not
    if (isset($_SESSION['username'])) //NULL
    {
      
      $userInfo = "SELECT UserEmail, AdminPrivilege FROM user WHERE UserEmail LIKE '%".$_SESSION['userEmailAcc']."%'" ;
            $result2 = $conn->query($userInfo);
            $row2 = $result2->fetch_assoc();

            if($row2["AdminPrivilege"] == 1){  
              $pageName = "AdminViewAccounts.php" ; 
            } 
            else{ 
              $pageName = "ViewAccount.php" ;
            }

      echo("
        <nav id=\"navigationBar\">
          <ul>
            <span class= \"nav-left \" id= \"brand \" hrref=  \"Home \"><img src= \"Logo3.png \" alt= \"Kalahari Tree logo \" width= \"200 \" height= \"50 \"></span>
            <li>
                <a href= ". $pageName ." class= \"link \">".$_SESSION['username']."</a>
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
</head> 
</br></br>

    <body>
    <div class="addvertiseDiv">
        <div class="bodyStyle">    
        <p > Home > Games & Toys</p>
        </div>
        <div>
            <h2>
            Games & Toys Items
            </h2>

            <?php  
           $itemInfo = "SELECT ItemID, ItemName, ItemCategory, ItemCondition, PictureName, ItemPrice,UserHomeTown FROM items JOIN user USING(UserID) JOIN picture USING(ItemID) WHERE ItemCategory LIKE \"Games and Toys\"";
            $result = $conn->query($itemInfo);

            if ($result->num_rows > 0) {
                // output data of each row
                
                while($row = $result->fetch_assoc()) {
                    echo("
                    <a href=\"ViewItem.php?ItemID=".$row["ItemID"]."\" name=\"asd\">
                        <div class=\"addvertiseContainer\">
                            <p><img src= Pictures\\". $row["PictureName"]." alt=\"Picture of item\" width=\"200px\" height=\"auto\"></p>
                            <p>" .$row["ItemName"]."</br></p>
                            <p>R ".$row["ItemPrice"]."</br></p>
                            <p><i class=\"material-icons\">location_on</i>".$row["UserHomeTown"]."</p>
                        </div>
                      </a>
                    ");
                }
              } else {
                echo "0 results";
              }

        ?>
        </div>
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
