<?php 
require_once __DIR__.'/db.php';

class GenreService 
{
    function GetGenres() 
    {
        $connection = Connect::GetConnection();
        $sql = 'SELECT * FROM genre';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $genre = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $genre;
    }

    function GetGenreNames()
    {
        $connection = Connect::GetConnection();
        $sql = 'SELECT Name FROM genre';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $genre = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $genre;
    }

    function GetTotalGenre() 
    {
        $connection = Connect::GetConnection();
        $count_query = "SELECT * FROM genre";
        $query = $connection->prepare($count_query);
        $query->execute();
        $totalGenre = $query->rowCount();
        return $totalGenre;
    }
}
?>