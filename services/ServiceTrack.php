<?php
require_once __DIR__.'/db.php';

class TrackService{

  function isDataValid()
        {
          if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['mediaTypeId']) && 
          !empty($_POST['mediaTypeId']) && isset($_POST['milliseconds']) && !empty($_POST['milliseconds']) && 
          isset($_POST['unitPrice']) && !empty($_POST['unitPrice'])) 
          {
            return true;
          } else {
            return false;
          }
        }
    
    function InsertTrack($name,$albumId,$mediaTypeId,$genreId,$composer,$milliseconds,$bytes,$unitPrice){

      $connection = Connect::GetConnection();
      $sql = "INSERT INTO `track` (`Name`, `AlbumId`, `MediaTypeId`, `GenreId`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`) VALUES(:name, :albumId, :mediaTypeId, :genreId, :composer, :milliseconds, :bytes, :unitPrice)";
      $stmt = $connection->prepare($sql);

      if ($stmt->execute([':name'=> $name, ':albumId'=> $albumId, ':mediaTypeId'=> $mediaTypeId,
          ':genreId'=> $genreId, ':composer'=> $composer, ':milliseconds'=> $milliseconds, 
          ':bytes'=> $bytes, ':unitPrice'=> $unitPrice])) 
          {
            return true;
          } else {
            return false;
          }
    }    

    function GetTracks($pageNo){
        $connection = Connect::GetConnection();
        $limit = 20;

        $start = ($pageNo - 1) * $limit;
        $sql = "SELECT * FROM track LIMIT $start, $limit";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $track = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $track;
}

    function GetTotalTracksCount($limit){
        $connection = Connect::GetConnection();
          // count total number of rows in track table
          $count_query = "SELECT * FROM track";
          $query = $connection->prepare($count_query);
          $query->execute();
          $total_result = $query->rowCount();
          // calculate total pages
          $total_pages = ceil($total_result/$limit);
          return  $total_pages;
    }

    function GetTracksApi($pageNo)
    {
      header('Content-Type: application/json');
      echo json_encode($this->GetTracks($pageNo));
    }

    function GetTrackById($id){
          $connection = Connect::GetConnection();
        $sql ='SELECT * FROM track WHERE TrackId = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    function UpdateTrack($name, $albumId, $mediaTypeId, $genreId,  $composer,  $milliseconds,  $bytes, $unitPrice,  $id){
          $connection = Connect::GetConnection();
      $sql = "UPDATE `track` SET `Name`= :name,`AlbumId`= :albumId,`MediaTypeId`= :mediaTypeId,`GenreId`= :genreId,`Composer`= :composer,`Milliseconds`= :milliseconds,`Bytes`= :bytes,`UnitPrice`= :unitPrice WHERE TrackId = :id";

    $stmt = $connection->prepare($sql);
    if ($stmt->execute([':name'=> $name, ':albumId'=> $albumId, ':mediaTypeId'=> $mediaTypeId,
        ':genreId'=> $genreId, ':composer'=> $composer, ':milliseconds'=> $milliseconds, ':bytes'=> $bytes, 
        ':unitPrice'=> $unitPrice, ':id' => $id])) {
            return true;
        }
        return false;
    }



     function DeleteTrack($id){
        $connection = Connect::GetConnection();
          $sql = 'DELETE FROM track WHERE TrackId = :id';
          $stmt = $connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}



?>
