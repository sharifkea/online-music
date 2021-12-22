<?php
require('auth.php');
error_reporting(E_ERROR | E_PARSE);
$name=$_SESSION['Name'];
$userID = $_SESSION['UserId'];
$email = $_SESSION['Email'];  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/functions.js"></script>
    <link rel="stylesheet" href="css/style.css"></style>
    <title>Online Music store</title>
    

    
  </head>
  <body class="">
    <header>
      <h1>Hi <?php echo $name; ?>, Welcome to Music Store</h1>
      <nav class="">  

      <div class="" id="">
        <ul class="">
          <li class="">
            <a class="" href="home.php">Home</a>
          </li>
          <li class="logout">
                <a class=""  href='logout.php'>Logout</a>
          </li>

          <?php
            if($_SESSION['Name']=='Admin') {?>
            <li class="">
              <a class="" href="AddArtist.php">Add Artist</a>
            </li>
            <li class="">
              <a class="" href="AddAlbum.php">Add Albums</a>
            </li>
            <li class="">
              <a class="" href="AddTrack.php">Add Track</a>
            </li>
          <?php }else { ?>
            <li class="">
                <a class=""  href='ShowInvoice.php'>Show Invoice</a>
            </li>
            <li class="">
              <a class="" id="customerBuy" href="#myModal" rel="modal:open">Buy</a>
            </li>
            
            <li class="cartInput">
              <input id="oneCart" type="number" name="cartOne" value="0" readonly>
            </li>
            
            <li class="profile">
              <a href="EditCustomer.php?id=<?php echo "$userID"?>" >Edit Profile</a>
            </li>
            <li class="changePassword">
                <a id="changepassword" href="ChangePassword.php?email=<?php echo "$email"?>" >Change Password</a>
            </li> 
          <?php } ?>
          </ul>
        </div>
    </nav>
</header>
<main>
  