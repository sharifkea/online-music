<?php 
require_once __DIR__.'/db.php';

class AlbumService 
{
    function isDataValid() 
        {
            if (isset($_POST['title']) && !empty($_POST['title'])) 
            {   
                return true;
            } else {
                return false;
            }
        }

    function InsertAlbum($title,$artistId) 
    {
        $connection = Connect::GetConnection();
        $sql = "INSERT INTO `album` (`Title`, `ArtistId`) VALUES (:title, :artistId)";
        $stmt = $connection->prepare($sql);

        if ($stmt->execute([':title'=> $title, ':artistId'=> $artistId])) 
            {
                return true;
            } else {
                return false;
            }    
    }

    function GetAlbums($pageno) 
    {
        $connection = Connect::GetConnection();
        $limit = 20;
    
        $start = ($pageno-1) * $limit;
        // query to get Album from album table
        $sql = "SELECT * FROM album LIMIT $start, $limit";

        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $album = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $album;
    }

    function GetTotatlAlbumCount($limit){
        $connection = Connect::GetConnection();
        $count_query = "SELECT * FROM album";
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();

        // calculate the total pages
        $total_pages = ceil($total_result/$limit);
        return $total_pages;
    }

    function GetAlbumApi($pageno) {
        header ('Contain-Type application/json');
        echo json_encode($this->GetAlbums($pageno));
    }

    function GetAlbumById($id) 
    {
        $connection = Connect::GetConnection();
        $sql ='SELECT * FROM album WHERE AlbumId = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        $album = $stmt->fetch();
        return $album;
    }
    
    function UpdataAlbum($title, $artistId, $id) 
    {
        $connection = Connect::GetConnection();

        $sql = "UPDATE `album` SET `Title`= :title, `ArtistId`= :artistId WHERE AlbumId = :id";

        $stmt = $connection->prepare($sql);
        if ($stmt->execute([':title'=> $title, ':artistId'=> $artistId,':id' => $id])) {
                return true;
        }
        return false;
    }

    function DeleteAlbum($id) 
    {
        $connection = Connect::GetConnection();
        
        $sql = 'DELETE FROM album WHERE AlbumId = :id';
        $stmt = $connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }    
}
?>