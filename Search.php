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
      </ul>
    </cat>
  </head> 
  </br></br>

  <form id="signin" id="reg" action="" method="POST">
    <div id="search-st">
        <input type="text" placeholder="Search for items" name="searchText">
        <div class="tableDiv">
            
            <table cellspacing="15" style="width:100% padding:15">
            <tbody style="width:100% margin-right: 0">
                <tr id="searhRows">
                    <th class="searchRows2"><h5 id="header5">Categories:</h5></th>
                    <th class="searchRows3"><h5 id="header5">Conditions:</h5></th>
                    <th class="searchRows4"><h5 id="header5">Sort with:</h5></th>
                </tr>
                <tr id="searhRows">
                    <td class="searchRows2"><div id="tableDiv2">Electronics <input type="checkbox" id="electronicsCheck" name="electronicsCheck" value="1"></div></td>
                
                    <td class="searchRows3"><div id="tableDiv2">Great <input type="checkbox" id="greatCheck" name="greatCheck" value="1"></div> </td>
                    <td class="searchRows4"><div id="tableDiv2">
                        <select id="categories" name="condition">
                            <option value="ItemPriceH">Price: Highest first</option>
                            <option value="ItemPriceL">Price: Lowest first</option>
                            <option value="DateAddedF">Date added: Oldest first</option>
                            <option value="DateAddedL">Date added: Newest first</option>
                        </select>
                    </td>
                </tr>
                <tr id="searhRows">
                    <td class="searchRows2"><div id="tableDiv2">Home & Garden <input type="checkbox" id="homeCheck" name="homeCheck" value="1"></div></td>
                    
                    <td class="searchRows3"><div id="tableDiv2">Good <input type="checkbox" id="goodCheck" name="goodCheck" value="1"></div></td>
                </tr>
                <tr id="searhRows">
                    <td class="searchRows2"><div id="tableDiv2">Fashion <input type="checkbox" id="fashionCheck" name="fashionCheck" value="1"></div></td>
                
                    <td class="searchRows3"><div id="tableDiv2">Needs Repairs <input type="checkbox" id="repairsCheck" name="repairsCheck" value="1"></div></td>
                
                </tr>
                <tr id="searhRows">
                    <td class="searchRows2"><div id="tableDiv2">Sports & Leisure <input type="checkbox" id="sportsCheck" name="sportsCheck" value="1"></div></td>
                    
                </tr>
                <tr id="searhRows">
                    <td class="searchRows2"><div id="tableDiv2">Pets <input type="checkbox" id="petsCheck" name="petsCheck" value="1"></div></td>
                    
                </tr>
                <tr id="searhRows">
                    <td class="searchRows2"><div id="tableDiv2">Games & Toys <input type="checkbox" id="gamesCheck" name="gamesCheck" value="1"></div></td>
                    
                </tr>
                </tbody>
            </table>
        </div>  
        
    <button  id="st-btn4" type="submit" name="submit" value="Submit" ><i style="size: 17px"class="material-icons">	filter_list</i></button>

    <div class="addvertiseDiv">

  </div>
  </div class="footerDiv">
  
  <?php
  if(isset($_POST['submit']))
  {
    $electronicsCheck = $greatCheck = $homeCheck = $goodCheck = $fashionCheck = $repairsCheck = $sportsCheck = $petsCheck = $gamesCheck = "";
    $catBOOL = "";
    $search = " ItemName like '%".$_POST['searchText']."%'";

    if(!isset($_POST['electronicsCheck']) && !isset($_POST['homeCheck']) && !isset($_POST['fashionCheck']) && !isset($_POST['sportsCheck']) && !isset($_POST['petsCheck']) && !isset($_POST['gamesCheck']))
    {
      $catBOOL = "1";
    }
    else
    {
      $catBOOL = "0";
    }

    if(!isset($_POST['greatCheck']) && !isset($_POST['goodCheck']) && !isset($_POST['repairsCheck']))
    {
      $condBOOL = "1";
    }
    else
    {
      $condBOOL = "0";
    }

    if(isset($_POST['electronicsCheck']))
    {
      $electronicsCheck = " OR ItemCategory LIKE \"Electronics\"";
    }
    else
    {
      $electronicsCheck = "";
    }

    if(isset($_POST['homeCheck']))
    {
      $homeCheck = " OR ItemCategory LIKE \"Home and Garden\"";
    }
    else
    {
      $homeCheck = "";
    }

    if(isset($_POST['fashionCheck']))
    {
      $fashionCheck = " OR ItemCategory LIKE \"Fashion\"";
    }
    else
    {
      $fashionCheck = "";
    }

    if(isset($_POST['sportsCheck']))
    {
      $sportsCheck = " OR ItemCategory LIKE \"Sports and Leisure\"";
    }
    else
    {
      $sportsCheck = "";
    }

    if(isset($_POST['petsCheck']))
    {
      $petsCheck = " OR ItemCategory LIKE \"Pets\"";
    }
    else
    {
      $petsCheck = "";
    }

    if(isset($_POST['gamesCheck']))
    {
      $gamesCheck = " OR ItemCategory LIKE \"Games and Toys\"";
    }
    else
    {
      $gamesCheck = "";
    }

    if(isset($_POST['greatCheck']))
    {
      $greatCheck = " OR ItemCondition LIKE \"Great\"";
    }
    else
    {
      $greatCheck = "";
    }

    if(isset($_POST['goodCheck']))
    {
      $goodCheck = " OR ItemCondition LIKE \"Good\"";
    }
    else
    {
      $goodCheck = "";
    }

    if(isset($_POST['repairsCheck']))
    {
      $repairsCheck = " OR ItemCondition LIKE \"Needs Repairs\"";
    }
    else
    {
      $repairsCheck = "";
    }

    if($_POST['condition'] == 'ItemPriceH')
    {
      $orderBy = 'ItemPrice desc';
    }
    else if($_POST['condition'] == 'ItemPriceL')
    {
      $orderBy = 'ItemPrice';
    }
    else if($_POST['condition'] == 'DateAddedF')
    {
      $orderBy = 'DateAdded';
    }
    else if($_POST['condition'] == 'DateAddedL')
    {
      $orderBy = 'DateAdded desc';
    }

    //$itemInfo = "SELECT ItemID, ItemName, ItemCategory, ItemCondition, PictureName, ItemPrice,UserHomeTown FROM items JOIN user USING(UserID) JOIN picture USING(ItemID) WHERE".$search.$electronicsCheck;
    $itemInfo = "SELECT ItemID, ItemName, ItemCategory, ItemCondition, PictureName, ItemPrice,UserHomeTown FROM items JOIN user USING(UserID) JOIN picture USING(ItemID) WHERE
    ".$search." AND (".$catBOOL.$electronicsCheck.$homeCheck.$fashionCheck.$sportsCheck.$petsCheck.$gamesCheck.") AND (".$condBOOL.$greatCheck.$goodCheck.$repairsCheck.") 
    ORDER BY ".$orderBy;
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
  } 
  ?>

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