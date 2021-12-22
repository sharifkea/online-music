<?php

    require_once("connection.php");

    class Genre extends DB {
        /**
         * Retrieves all from genre
         *
         * @return  GenreId and Name
         */
        function fetch_all() {
            $query = <<<'SQL'
                SELECT *
                FROM genre;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();                

            $this->disconnect();

            return $stmt->fetchAll(); 
                           
        }
    }
?>