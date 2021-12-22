<?php

class Connect
{
  private static $dns ='mysql:host=localhost;dbname=chinook_abridged';
  private static $username = 'root';
  private static $password = 'rony2204';
  private static $options= [];

  public static function GetConnection()
   {
        return new PDO(self::$dns,self::$username,self::$password, self::$options);
  }
}


?>


<?php
/*
$dns ='mysql:host=localhost;dbname=chinook_abridged';
$username = 'root';
$password = '';
$options= [];

try {
    $connection = new PDO($dns, $username, $password, $options);
} catch(PDOException $e){
    
}
*/

?>