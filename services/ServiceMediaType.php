<?php 
require_once __DIR__.'/db.php';

class MediaTypeService 
{
    function GetMediaType() 
    {
        $connection = Connect::GetConnection();
        $sql = 'SELECT * FROM mediatype';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $mediaType = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $mediaType;
    }
}
?>