<?php

    require_once("connection.php");

    class Album extends DB {
        /**
         * Retrieves the Artists whose name includes a certain text
         * 
         * @param   text upon which to execute the search
         * @return  an array with artists information
         */
        function search($searchText) {
            $query = <<<'SQL'
                SELECT *
                FROM album
                WHERE Title LIKE ?
                ORDER BY Title;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['%' . $searchText . '%']);                

            $this->disconnect();

            return $stmt->fetchAll();                
        }
        function with_id($id) {
            $query = <<<'SQL'
                SELECT ab.AlbumId as AlbumId,ab.Title as Title,at.Name as ArtistName,ab.ArtistId as ArtistId
                FROM album ab
                JOIN artist at
                    ON at.ArtistId =ab.ArtistId WHERE ab.AlbumId=?;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([ $id]);                

            $this->disconnect();

            return $stmt->fetchAll();                
        }

        function with_art_id($artistId) {
            $query = <<<'SQL'
                SELECT *
                FROM album
                WHERE ArtistId = ?
                ORDER BY Title;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$artistId]);                

            $this->disconnect();

            return $stmt->fetchAll();                
        }
        function add($data) {
            $newID=0;
           
            $query = <<<'SQL'
                INSERT INTO album (Title, ArtistId) VALUES (?, ?);
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$data['Title'], $data['ArtistId']]);

            $newID = $this->pdo->lastInsertId();

            $this->disconnect();

            return $newID;
        }
                       
           
        function update($data) {
            
           try{ 
                $query = <<<'SQL'
                    update album 
                    set Title=? 
                        WHERE AlbumId=?;
                SQL;

                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$data['Title'], $data['AlbumId']]);

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
                    DELETE FROM album 
                    WHERE AlbumId = ?;
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