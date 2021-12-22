<?php

    require_once("connection.php");

    class MediaType extends DB {
        /**
         * Retrieves the Admin Password
         *
         * @return  an array with password
         */
        function fetch_all() {
            $query = <<<'SQL'
                SELECT *
                FROM mediatype;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();                

            $this->disconnect();

            return $stmt->fetchAll();                
        }
    }
?>