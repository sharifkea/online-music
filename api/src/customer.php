<?php

    require_once("connection.php");

    class Customer extends DB {
        
        function get($email) {
            // Movie data
            $query = <<<'SQL'
                SELECT *
                FROM customer 
                WHERE Email = ?;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$email]);
            $results = $stmt->fetch();
            if($results==false)$results["return"]=false;
            else $results["return"]=true;
            $this->disconnect();

            return $results;
        }

        function add($data) {
            if(!isset($data['Company']))$data['Company']=null;
            if(!isset($data['Address']))$data['Address']=null;
            if(!isset($data['City']))$data['City']=null;
            if(!isset($data['State']))$data['State']=null;
            if(!isset($data['Country']))$data['Country']=null;
            if(!isset($data['PostalCode']))$data['PostalCode']=null;
            if(!isset($data['Phone']))$data['Phone']=null;
            if(!isset($data['Fax']))$data['Fax']=null;
            $newID=0;
           
            $query = <<<'SQL'
                INSERT INTO customer (FirstName,LastName,Password,Company,Address,City,State,Country,PostalCode,Phone,Fax,Email) VALUES (?,?,?,?,?,?,?, ?,?,?,?,?);
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$data['FirstName'],$data['LastName'],password_hash($data['Password'], PASSWORD_DEFAULT),$data['Company'],$data['Address'],$data['City'],$data['State'],$data['Country'],$data['PostalCode'],$data['Phone'],$data['Fax'],$data['Email']]);

            $newID = $this->pdo->lastInsertId();

            $this->disconnect();

            return $newID;
        }
        function update($data) {
            if(!isset($data['Company']))$data['Company']=null;
            if(!isset($data['Address']))$data['Address']=null;
            if(!isset($data['City']))$data['City']=null;
            if(!isset($data['State']))$data['State']=null;
            if(!isset($data['Country']))$data['Country']=null;
            if(!isset($data['PostalCode']))$data['PostalCode']=null;
            if(!isset($data['Phone']))$data['Phone']=null;
            if(!isset($data['Fax']))$data['Fax']=null;
            $query = <<<'SQL'
                update customer 
                set FirstName=?,
                    LastName=?,
                    Company=?,
                    Address=?,
                    City=?,
                    State=?,
                    Country=?,
                    PostalCode=?,
                    Phone=?,
                    Fax=?
                    WHERE CustomerId=?;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$data['FirstName'],$data['LastName'],$data['Company'],$data['Address'],$data['City'],$data['State'],$data['Country'],$data['PostalCode'],$data['Phone'],$data['Fax'],$data['CustomerId']]);

            $this->disconnect();

            return true;

        }

        function passUpdate($data) {
            
            $query = <<<'SQL'
                update customer 
                set Password=?
                    WHERE CustomerId=?;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([password_hash($data['Password'], PASSWORD_DEFAULT),$data['CustomerId']]);

            $this->disconnect();

            return true;

        }
    }
?>