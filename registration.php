<?php
  session_start();
  if(isset($_SESSION['Name'])){
    header('Location: home.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/script.js"></script>

    <title>Register</title>
  </head>
  <body>
    <header>
        <h1>Welcome To Customer Registration</h1>
    </header>	
    <main>
      <div class ="form">
          <form action="registration.php" method="post" name="customerReg" id= "cr">           
              <input id="fn" name="FirstName"  placeholder="First Name" type="text"  required tabindex="1"><br>
              <input id="ln" name="LastName"  placeholder="Last Name" type="text"  required tabindex="2"><br>
              <input id="pw" type="password"  name="Password" placeholder="Password" required tabindex="3"><br>
              <input id="em" placeholder="Email Address" type="email" name="Email"  required tabindex="4">
              <input id="verify" name="verify" type="button" value="Verify"><br>
              <input id="cp" name="Company"  placeholder="Company Name" type="text" tabindex="7"><br>
              <input id="ad" name="Address"  placeholder="Address" type="text" tabindex="8"><br>
              <input id="ct" type="text"  name="City" placeholder="City" tabindex="7"><br>
              <input id="st" name="state"  placeholder="State" type="text"  tabindex="8"><br>
              <input id="co" name="Country"  placeholder="Country" type="text"  tabindex="9"><br>
              <input id="pc" type="text"  name="PostalCode" placeholder="Postal Code" tabindex="10"><br>
              <input id="ph" name="Phone"  placeholder="Phone Number" type="phone"  tabindex="11"><br>
              <input id="fx" name="Fax"  placeholder="Fax" type="phone"  tabindex="12"><br>
              <input name="submit" id="customerRegistration" type="submit" value="Submit" tabindex="13">
          </form>
      <div>
        <p>Back to <a href='index.php'>Login</a></p>
      </div>
    </main>
    <footer>2021 Abul Kasem Mohammed Omar Sharif</footer>
  </body>
</html>
