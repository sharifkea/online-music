<?php 
require_once __DIR__.'/db.php';

class ArtistService 
{
    function isDataValid() 
        {
          if (isset($_POST['name']) && !empty($_POST['name'])) 
          {   
              return true;
          } else {
              return false;
          }
        }
        
    function InsertArtist($name) 
    {
        $connection = Connect::GetConnection();
        $sql = "INSERT INTO `artist` (`Name`) VALUES (:name)";
        $stmt = $connection->prepare($sql);

        if ($stmt->execute([':name'=> $name])) 
        {
            return true;
        } else {
            return false;
        }
    }

    function GetArtists($pageno) 
    {
        $connection = Connect::GetConnection();
        $limit = 20;

        $start = ($pageno-1) * $limit;
        // query to get customers from customer table
        $sql = "SELECT * FROM artist LIMIT $start, $limit";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $artist = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $artist;
    }

    function GetTotalArtistsCount($limit){
        $connection = Connect::GetConnection();
        $count_query = "SELECT * FROM artist";
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();

        // calculate the total pages
        $total_pages = ceil($total_result/$limit);
        return $total_pages;
    }

    function GetArtistsApi($pageNo)
    {
      header('Content-Type: application/json');
      echo json_encode($this->GetArtists($pageNo));
    }

    function GetArtistById($id) 
    {
        $connection = Connect::GetConnection();        
        $sql ='SELECT * FROM artist WHERE ArtistId = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        $artist = $stmt->fetch();
        return $artist;
    }

    function UpdateArtist($name, $id)
    {
        $connection = Connect::GetConnection();
        
        $sql = "UPDATE `artist` SET `Name`= :name WHERE ArtistId = :id";
    
        $stmt = $connection->prepare($sql);
        if ($stmt->execute([':name'=> $name, ':id' => $id])) {
                return true;
            }
            return false;
    }

    function DeleteArtist($id)
    {
        $connection = Connect::GetConnection();
        $sql = 'DELETE FROM artist WHERE ArtistId = :id';
        $stmt = $connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>