<?php
require_once __DIR__.'/db.php';
require_once __DIR__.'/user.php';

class CustomerService{

    function isDataValid() {
        if (isset($_POST['fname']) && !empty($_POST['fname']) && isset($_POST['lname']) 
        && !empty($_POST['lname']) && isset($_POST['password']) && !empty($_POST['password']) 
        && isset($_POST['email']) && !empty($_POST['email'])) {
          return true;
          } else {
            return false;
          }
      }

    function GetCustomers($pageNo){
        $connection = Connect::GetConnection();
        $limit = 20;
        // count total number of rows in customer table
        $count_query = "SELECT * FROM customer";
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();

        // calculate the total pages
        $total_pages = ceil($total_result/$limit);
        $start = ($pageNo-1) * $limit;

        // query to get customers from customer table
        $sql = "SELECT * FROM customer LIMIT $start, $limit";

        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $customer;
}

    function GetTotalCustomersCount($limit){
        $connection = Connect::GetConnection();
        $count_query = "SELECT * FROM customer";
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();

        // calculate the total pages
        $total_pages = ceil($total_result/$limit);
        return $total_pages;
    }


    //use for REST API LATER
    function GetCustomersApi($pageNo)
    {
        header('Content-Type: application/json');
        echo json_encode($this->GetCustomers($pageNo));
    }


    function GetCustomerById($id){
          $connection = Connect::GetConnection();
          $sql ='SELECT * FROM customer WHERE CustomerId = :id';
          $stmt = $connection->prepare($sql);
          $stmt->execute([':id' => $id]);
          $customer = $stmt->fetch(PDO::FETCH_OBJ);
        return $customer;
    }

    
        function GetCustomerByEmail($email){
          $connection = Connect::GetConnection();
          $sql ='SELECT * FROM customer WHERE Email = :email';
          $stmt = $connection->prepare($sql);
          $stmt->execute([':email' => $email]);
          $customer = $stmt->fetch();
        return $customer;
    }

    

    function UpdateCustomer($fname, $lname, $company,$address,$city, $state, $country, $postalcode,  $phone,$fax,$email){
            $connection = Connect::GetConnection();
            $sql = "UPDATE `customer` SET `FirstName`= :fname,`LastName`= :lname,`Company`= :company,`Address`= :address,`City`= :city,`State`= :state,`Country`= :country,`PostalCode`= :postalcode,`Phone`= :phone,`Fax`= :fax WHERE Email = :email";
           // echo $sql;
            $stmt = $connection->prepare($sql);
            if ($stmt->execute([':fname'=> $fname, ':lname'=> $lname, ':company'=> $company, ':address'=> $address, ':city'=> $city, ':state'=> $state, 
            ':country'=> $country, ':postalcode'=> $postalcode, ':phone'=> $phone,
            ':fax'=> $fax, ':email' => $email])) {
            return true;
            }
            return false;
    }

    function changePassword($oldPassword, $newPassword, $email)
    {

        $user = new User();
     
        $validUser = $user->validate($email, $oldPassword);
        
        if ($validUser) {

            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $connection = Connect::GetConnection();
            $sql = "UPDATE `customer` SET `Password`= :password WHERE Email = :email";
                $stmt = $connection->prepare($sql);
                if ($stmt->execute([':password'=> $newPassword, ':email'=> $email])) {
                return true;
                }
                return false;            
            } 
            return false; 
            
        
    }



    function DeleteCustomer($id){
        $connection = Connect::GetConnection();
        $sql = 'DELETE FROM customer WHERE CustomerId = :id';        
        $stmt = $connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
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
