<?php

    require_once("connection.php");

    class Artist extends DB {
        /**
         * Retrieves the Artists whose name includes a certain text
         * 
         * @param   text upon which to execute the search
         * @return  an array with artists information
         */
        function search($searchText) {
            $query = <<<'SQL'
                SELECT ArtistId, Name
                FROM artist
                WHERE Name LIKE ?
                ORDER BY Name;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['%' . $searchText . '%']);                

            $this->disconnect();

            return $stmt->fetchAll();                
        }
        function with_id($id) {
            $query = <<<'SQL'
                SELECT *
                FROM artist
                WHERE  ArtistId=?;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([ $id]);                

            $this->disconnect();

            return $stmt->fetchAll();                
        }

        function add($data) {
            $newID=0;
           
            $query = <<<'SQL'
                INSERT INTO artist (Name) VALUES (?);
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$data['Name']]);

            $newID = $this->pdo->lastInsertId();

            $this->disconnect();

            return $newID;
        }
                       
           
        function update($data) {
            try{ 
                $query = <<<'SQL'
                    update artist 
                    set Name=? 
                        WHERE ArtistId=?;
                SQL;

                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$data['Name'], $data['ArtistId']]);

                $this->disconnect();

                return true;
            }catch(Exception $e)
            {
                return false;
            }

        }

        function delete($id) {  
            

           try{ 
                $query = <<<'SQL'
                    DELETE FROM artist 
                    WHERE ArtistId = ?;
                SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$id]);

                $return = true;
                $this->disconnect();

                return $return;
            }catch(Exception $e)
            {
                return false;
            }
        }
    }
?>