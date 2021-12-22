<?php
require_once __DIR__.'/db.php';

class QueryService {
    function ShowAllTracks($pageNo) {
        $connection = Connect::GetConnection();
        $limit = 20;

        $start = ($pageNo-1) * $limit;

        // query to get Tracks from track table
        $sql = " SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId LIMIT $start, $limit ";

        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $showTrackAll = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $showTrackAll;
    }

    function GetShowAllTrackTotalsCount($limit){
        $connection = Connect::GetConnection();
        // count total number of rows in track table
        $count_query = "SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId";
        
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();
        // calculate total pages
        $total_pages = ceil($total_result/$limit);
        return  $total_pages;
    }

    function SearchByTrackName($pageNo, $searchText) {
        $connection = Connect::GetConnection();
        $limit = 20;

        $start = ($pageNo-1) * $limit;

        // query to get Tracks from track table
        $sql = " SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId WHERE tr.Name LIKE '%$searchText%' LIMIT $start, $limit ";
         
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $showTrackByTrackName = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $showTrackByTrackName;
    }

    function GetSearchByTrackNameTotalsCount($limit, $searchText){
        $connection = Connect::GetConnection();
        // count total number of rows in track table
        $count_query = "SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId WHERE tr.Name LIKE '%$searchText%'";
        
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();
        // calculate total pages
        $total_pages = ceil($total_result/$limit);
        return  $total_pages;
    }

    function SearchByAlbumTitle($pageNo, $searchText) {
        $connection = Connect::GetConnection();
        $limit = 20;

        $start = ($pageNo-1) * $limit;

        // query to get Tracks from track table
        $sql = " SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId WHERE al.Title LIKE '%$searchText%' LIMIT $start, $limit ";
        
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $showTrackByAlbumTitle = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $showTrackByAlbumTitle;
    }

    function GetSearchByAlbumTitleTotalsCount($limit, $searchText){
        $connection = Connect::GetConnection();
        // count total number of rows in track table
        $count_query = "SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId WHERE al.Title LIKE '%$searchText%'";
        
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();
        // calculate total pages
        $total_pages = ceil($total_result/$limit);
        return  $total_pages;
    }

    function SearchByArtistName($pageNo, $searchText) {
        $connection = Connect::GetConnection();
        $limit = 20;

        $start = ($pageNo-1) * $limit;

        // query to get Tracks from track table
        $sql = " SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId WHERE ar.Name LIKE '%$searchText%' LIMIT $start, $limit ";

        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $showTrackByArtistName = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $showTrackByArtistName;
    }

    function GetSearchByArtistNameTotalsCount($limit, $searchText){
        $connection = Connect::GetConnection();
        // count total number of rows in track table
        $count_query = "SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId WHERE ar.Name LIKE '%$searchText%'";
        
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();
        // calculate total pages
        $total_pages = ceil($total_result/$limit);
        return  $total_pages;
    }

    function SearchByGenreName($pageNo, $searchText) {
        $connection = Connect::GetConnection();
        $limit = 20;

        $start = ($pageNo-1) * $limit;

        // query to get Tracks from track table
        $sql = " SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId WHERE ge.Name LIKE '%$searchText%' LIMIT $start, $limit ";

        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $showTrackByGenreName = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $showTrackByGenreName;
    }

    function GetSearchByGenreNameTotalsCount($limit, $searchText){
        $connection = Connect::GetConnection();
        // count total number of rows in track table
        $count_query = "SELECT tr.TrackId AS TrackID, tr.Name AS TrackName, al.Title AS AlbumName,ar.Name AS ArtistName,ge.Name AS GenreName, me.Name AS MediaTypeName, tr.Composer, tr.Milliseconds, tr.Bytes, tr.UnitPrice  FROM album al JOIN artist ar ON al.ArtistId = ar.ArtistId JOIN track tr ON al.AlbumId = tr.AlbumId LEFT JOIN genre ge ON ge.GenreId = tr.GenreId LEFT JOIN mediatype me ON me.MediaTypeId = tr.MediaTypeId WHERE ge.Name LIKE '%$searchText%'";
        
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();
        // calculate total pages
        $total_pages = ceil($total_result/$limit);
        return  $total_pages;
    }
}
?>