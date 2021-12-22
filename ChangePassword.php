<?php require 'header.php'; 

if (isset($_POST['oldPassword'])&&isset($_POST['newPassword'])){
    if(password_verify($_POST['oldPassword'], $_SESSION['Password'])){
        $data='Password='.$_POST['newPassword'].'&CustomerId='.$_SESSION['CustomerId'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sharifs-music-api.herokuapp.com/api/customer/password',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $returnData = json_decode($response, true);
        if($returnData['customer']){
            echo '<script> alert("Your Password has been changed, please login again.") </script>';
           
            header('Location: logout.php');
        }else echo '<script> alert("Some Error Found.") </script>';
    }else echo '<script> alert("Old Password, not match, Try Again.") </script>';
    
}?>


<div >
    <div >
        <div>
            <h2>Change Password</h2>
        </div>
        <div >
  
            <form method="POST">
                <div class="">
                    <label for="oldPassword">Old Password</label>
                    <input type="password" name="oldPassword" id="oldPassword" class="create">
                </div>
                <div class="">
                    <label for="newPassword">New Password</label>
                    <input type="password" name="newPassword" id="newPassword" class="create">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Change</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
