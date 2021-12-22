<?php

    require_once("connection.php");
    require_once("todb.php");

    class Track extends DB {
        
        function search($searchText) {
            $query = <<<'SQL'
                SELECT tr.TrackId as TrackId,tr.Name as Name, tr.AlbumId as AlbumId,al.Title as AlbumTitle,
                ar.ArtistId as ArtistId,ar.Name as ArtistName, tr.MediaTypeId as MediaTypeId,mt.Name as MediaTypeName, 
                tr.GenreId as GenreId,ge.Name as GenreName, tr.Composer as Composer, tr.Milliseconds as Milliseconds, 
                tr.Bytes as Bytes, tr.UnitPrice as UnitPrice
                FROM track tr
                JOIN  album al
                    on tr.AlbumId=al.AlbumId
                    join artist ar
                        on al.ArtistId=ar.ArtistId
                        join genre ge
                            on tr.GenreId=ge.GenreId
                            join mediatype mt
                                on tr.MediaTypeId=mt.MediaTypeId
                                WHERE tr.Name LIKE ?
                                order by tr.Name;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['%' . $searchText . '%']);                

            $this->disconnect();

            return $stmt->fetchAll();                
        }
        function with_id($id) {
            $query = <<<'SQL'
                SELECT tr.TrackId as TrackId,tr.Name as Name, tr.AlbumId as AlbumId,al.Title as AlbumTitle,
                ar.ArtistId as ArtistId,ar.Name as ArtistName, tr.MediaTypeId as MediaTypeId,mt.Name as MediaTypeName, 
                tr.GenreId as GenreId,ge.Name as GenreName, tr.Composer as Composer, tr.Milliseconds as Milliseconds, 
                tr.Bytes as Bytes, tr.UnitPrice as UnitPrice
                FROM track tr
                JOIN  album al
                    on tr.AlbumId=al.AlbumId
                    join artist ar
                        on al.ArtistId=ar.ArtistId
                        join genre ge
                            on tr.GenreId=ge.GenreId
                            join mediatype mt
                                on tr.MediaTypeId=mt.MediaTypeId
                                WHERE tr.TrackId = ?
                                order by tr.Name;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);                

            $this->disconnect();

            return $stmt->fetchAll();                
        }
        function with_alb_id($albumId) {
            $query = <<<'SQL'
                SELECT tr.TrackId as TrackId,tr.Name as Name, tr.AlbumId as AlbumId,al.Title as AlbumTitle,
                ar.ArtistId as ArtistId,ar.Name as ArtistName, tr.MediaTypeId as MediaTypeId,mt.Name as MediaTypeName, 
                tr.GenreId as GenreId,ge.Name as GenreName, tr.Composer as Composer, tr.Milliseconds as Milliseconds, 
                tr.Bytes as Bytes, tr.UnitPrice as UnitPrice
                FROM track tr
                JOIN  album al
                    on tr.AlbumId=al.AlbumId
                    join artist ar
                        on al.ArtistId=ar.ArtistId
                        join genre ge
                            on tr.GenreId=ge.GenreId
                            join mediatype mt
                                on tr.MediaTypeId=mt.MediaTypeId
                                WHERE tr.AlbumId = ?
                                ORDER BY tr.Name;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$albumId]);                

            $this->disconnect();

            return $stmt->fetchAll();
            //return 'i m in';                
        }
        
        function add($data) {
            $newID=0;
           
            $query = <<<'SQL'
                INSERT INTO track (Name, AlbumId, MediaTypeId, GenreId, Composer, Milliseconds, Bytes, UnitPrice) VALUES (?, ?, ?, ?,?, ?, ?, ?);
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$data['Name'], $data['AlbumId'], $data['MediaTypeId'], $data['GenreId'],$data['Composer'],$data['Milliseconds'],$data['Bytes'],$data['UnitPrice']]);

            $newID = $this->pdo->lastInsertId();

            $this->disconnect();

            return $newID;
        }
                       
           
        function update($data) {
            try{ 
            $query = <<<'SQL'
                update track 
                set Name=?, 
                    Composer=?, 
                    Milliseconds=?, 
                    Bytes=?,
                    UnitPrice=? 
                    WHERE TrackId=?;
            SQL;

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$data['Name'],$data['Composer'],$data['Milliseconds'],$data['Bytes'],$data['UnitPrice'],$data['TrackId']]);

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
                    DELETE FROM track 
                    WHERE TrackId = ?;
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