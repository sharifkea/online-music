<?php
require_once __DIR__.'/db.php';

class CreateCustomer{

    function isDataValid() {
        if (isset($_POST['fname']) && !empty($_POST['fname']) && isset($_POST['lname']) 
        && !empty($_POST['lname']) && isset($_POST['password']) && !empty($_POST['password']) 
        && isset($_POST['email']) && !empty($_POST['email'])) {
          return true;
          } else {
            return false;
          }
      }
    function InsertCustomer($fname, $lname, $password, $company, $address, 
        $city, $state, $country, $postalcode, $phone, $fax, $email){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $connection = Connect::GetConnection();
            $sql = "INSERT INTO `customer` (`FirstName`, `LastName`, `Password`, `Company`, `Address`, `City`, `State`, `Country`, `PostalCode`, `Phone`, `Fax`, `Email`) VALUES(:fname, :lname, :password, :company, :address, :city, :state, :country, :postalcode, :phone, :fax, :email)";
            $stmt = $connection->prepare($sql);
            if ($stmt->execute([':fname'=> $fname, ':lname'=> $lname, ':password'=> $password,
            ':company'=> $company, ':address'=> $address, ':city'=> $city, ':state'=> $state, 
            ':country'=> $country, ':postalcode'=> $postalcode, ':phone'=> $phone,
            ':fax'=> $fax, ':email'=> $email])) 
            {
                return true;
            } else {
                return false;
            }
    }    
}
?>
