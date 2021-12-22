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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>login</title>
  </head>
  <body>
      <header>
          <h1>Welcome to Music Store</h1>
      </header>	
      <?php
        if (isset($_POST['txtEmail'])){
          if($_POST['txtEmail']=='admin@kea.dk'){
            $curl = curl_init();
            curl_setopt_array(
              $curl, array(
            CURLOPT_URL => 'https://sharifs-music-api.herokuapp.com/api/admin',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',));
            $response = curl_exec($curl);
            curl_close($curl);
            $obj = json_decode($response, true);
            $pass=$obj['admin'][0]['Password'];
            if(password_verify($_POST['password'], $pass)){   
              $_SESSION['Name']='Admin';
              $_SESSION['Password']=$pass;
              $_SESSION['Email']='admin@kea.dk';
              $_SESSION['UserId']=-1;
              header('Location: home.php');
            }else{
              echo "<div>
                      <p>User Password is incorrect.</p>
                      <p><a href='index.php'>Try Again</a></p>
                      <p><a href='registration.php'>For Register </a></p> 
                    </div>";
            }
          }else{
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sharifs-music-api.herokuapp.com/api/customer/'.$_POST['txtEmail'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',));
            
            $response = curl_exec($curl);
            curl_close($curl);
            $obj = json_decode($response, true);
            if($obj['customer']['return']==false){
              echo "<div>
                      <p>User Email address is incorrect.</p>
                      <p><a href='index.php'>Try Again</a></p>
                      <p><a href='registration.php'>For Register </a></p>
                    </div>";
            }else{
              $pass=$obj['customer']['Password'];
              if(password_verify($_POST['password'], $pass)){   
                foreach($obj['customer'] as $key => $value) {
                  $_SESSION[$key]=$value;
                }$_SESSION['UserId']=$_SESSION['CustomerId'];
                $_SESSION['Name']=$_SESSION['FirstName'].' '.$_SESSION['LastName'];
                header('Location: home.php?login=Success');
              }else{
                echo "<div>
                        <p>Password is incorrect.</p>
                        <p><a href='index.php'>Try Again</a></p>
                        <p><a href='registration.php'>For Register </a></p>
                    </div>";
              }
            }
          }
        }else{
      ?>
      
        <main>
          <p1># For Admin email is admin@kea.dk</p1> 
          <div class ="form">
              <form action="" method="POST" name="login" >
                  
                  <input id="email" placeholder="User Email" type="email" name="txtEmail"  required tabindex="1"><br>
                  <input type="password" id='password' name="password" placeholder="Password" required tabindex="2"><br>
                  <input name="submit" id='submit' type="submit" value="Login" tabindex="3">
              </form>
              
          </div>
          
          <div id="login">
              
              
          </div>
          <div>
          <p>Not registered yet? <a href='registration.php'>Customer Register Here</a></p>
          </div>
        </main>

        <?php 
        }
        include_once('footer.php');?>

      
      
      

