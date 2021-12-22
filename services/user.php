<?php
    
    require_once __DIR__.'/db.php';

    class User{

        public int $userID;
        public string $firstName;
        public string $lastName;
        public string $email;
        public bool $isAdmin;

        function validate($email, $password) {
        $this->isAdmin = false;;
          $connection = Connect::GetConnection();
          $sql = 'SELECT * FROM customer WHERE email = :email';
          $stmt = $connection->prepare($sql);

          $stmt->execute([':email'=> $email]);
          if ($stmt->rowCount() === 0) {
            if($this->isAdmin($password)){
                $this->userID = -1;
                $this->firstName = 'Admin';
                $this->lastName = '';
                $this->isAdmin = true;
              return true;
            }
             return false;
          }

          $row = $stmt->fetch();
          $this->userID = $row['CustomerId'];
          $this->firstName = $row['FirstName'];
          $this->lastName = $row['LastName'];
          $this->email = $email;
          echo $this->isAdmin;
          return (password_verify($password, $row['Password']));
        }

        function isAdmin($password) {
          $connection = Connect::GetConnection();
          $sql = 'SELECT Password FROM admin';
          $stmt = $connection->prepare($sql);

          $stmt->execute();
          if ($stmt->rowCount() === 0) {
             return false;
          }
          $row = $stmt->fetch();          
          return (password_verify($password, $row['Password']));
        }
    }

?>