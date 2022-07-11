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
// define variables and set to empty values
    $itemname = $description = $category = $condition = $price = "";
    $itemnameErr = $descriptionErr = $categoryErr = $conditionErr = $priceErr = "";

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

?>

<div class="modal">
  <form class="modal-content" action="" method="POST" enctype="multipart/form-data">
    <div class="container">
      <h1>Create an Ad</h1>
      <p>Please fill in this form to create an Ad.</p>
      <hr>
      <label for="itemName"><b>Item Name</b></label>
      <input type="text" placeholder="Enter Item Name" name="itemName" value="<?php echo $itemname;?>" required>
  
      <label for="description"><b>Description</b></label>
      <input type="text" placeholder="Enter Description of Item" name="description" value="<?php echo $description;?>" required>
      
      <label for="category"><b>Category</b></label>
      </br>
      <!-- code vir 'n drop down list -->
      <select id="categories" name="categories">
      <option value="Electronics">Electronics</option>
      <option value="Home and Garden">Home and Garden</option>
      <option value="Fashion">Fashion</option>
      <option value="Sports and Leisure">Sports and Leisure</option>
      <option value="Pets">Pets</option>
      <option value="Games and Toys">Games and Toys</option>
      </select>
      </br></br>

      <label for="LName"><b>Condition</b></label>
      </br>
      <!-- code vir 'n drop down list -->
      <select id="categories" name="condition">
      <option value="Great">Great</option>
      <option value="Good">Good</option>
      <option value="Needs Repairs">Needs Repairs</option>
      </select>
      </br></br>

      <label for="price"><b>Price</b></label>
      <input type="text" placeholder="Enter Selling Price" name="price" value="<?php echo $price;?>" required>

      <label for="psw"><b>Picture of Item</b></label>

      <!-- add picture -->
      </br></br>
      <input type="file" name="fileToUpload">
      </br>
      </br>
      <div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'gold',
          layout: 'vertical',
          label: 'buynow',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"USD","value":0.63}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>
  </br>
  </br>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <a href="<?php echo $pageName; ?>"><button type="button"  class="cancelbtn">Cancel</button></a>
        <button type="submit" name="submit" value="Submit" class="signup">Create Ad</button>
      </div>
    </div>
  </form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{ 
  //do validation

  $itemname = $_POST['itemName'];
  $description = $_POST['description'];
  $category = $_POST['categories'];
  $condition = $_POST['condition'];
  $price = $_POST['price'];
}

if(isset($_POST['submit']) && $noError)
{
  $servername = "localhost";
  $username = "username";
  $password = "password";

  // Create connection
  $conn = new mysqli($servername, $username, $password);

  // Check connection
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  mysqli_select_db($conn, 'gumtreedatabase');

  $query = "SELECT PictureID, PictureName from picture order by PictureID desc limit 1" ;
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  $newPictureID = intval($row['PictureID']) + 1;
  $newPictureName = "Picture".$newPictureID.".".pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
  //echo $newPictureName;
  
  $target_dir = "Pictures/";
  $target_file = $target_dir . $newPictureName;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"]))
  {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    }
    else
    {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file))
  {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" )
  {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  $image = $_FILES["fileToUpload"]["tmp_name"];
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000)
  {
    $factorReduce = $_FILES["fileToUpload"]["size"]/5000;

    if($imageFileType == "jpg" || $imageFileType == "jpeg")
    {
      $imageT = imagecreatefromjpeg($image);
      imagejpeg($imageT,$image,75);
    }
    else if($imageFileType == "png")
    {
      $imageT = imagecreatefrompng($image);
      imagepng($imageT,$image,75);
    }  
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0)
  {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  }
  else
  {
    
    if (move_uploaded_file($image, $target_file))  //set the new name in $target_file
    {
      echo "The file ". htmlspecialchars( basename( $target_file)). " has been uploaded.";
    }
    else
    {
      echo "Sorry, there was an error uploading your file.";
    }

    //Find userID
    $query = "SELECT UserID, UserEmail from user where UserEmail like \"".$_SESSION["userEmailAcc"]."\"" ;
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $userID = $row['UserID'];

    //itemID
    $query = "SELECT ItemID from items order by ItemID desc limit 1" ;
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $itemID = intval($row['ItemID']) + 1;

    //Insert item into table
    $date = date("Y-m-d H:i:s");
    echo $date;
    $q = 'INSERT INTO items (ItemID, UserID, ItemName, ItemDescription, ItemCategory, DateAdded, ItemCondition, ItemPrice) VALUES (\''.$itemID.'\', \''.$userID.'\', \''.$itemname.'\', \''.$description.'\', \''.$category.'\', \''.$date.'\', \''.$condition.'\', \''.$price.'\')';
    $res = mysqli_query($conn, $q);

    //Insert picture into table
    $q = 'INSERT INTO picture (PictureID, ItemID, PictureName) VALUES (\''.$newPictureID.'\', \''.$itemID.'\', \''.$newPictureName.'\')';
    $res = mysqli_query($conn, $q);

    $conn -> close();

    header("location: ".$pageName);
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</div>
</body>
</html>