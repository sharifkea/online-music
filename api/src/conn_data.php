<?php
    // Local db
    //$server = 'localhost';
    //$dbName = 'chinook_abridged';
    //$user = 'root';
    //$pwd = 'rony2204';

    // AWS db
	$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $server = $cleardb_url["host"];
        $user = $cleardb_url["user"];
    	$pwd = $cleardb_url["pass"];
	$dbName = substr($cleardb_url["path"],1);
	/*
	$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	$cleardb_server = $cleardb_url["host"];
	$cleardb_username = $cleardb_url["user"];
	$cleardb_password = $cleardb_url["pass"];
	$cleardb_db = substr($cleardb_url["path"],1);
	$active_group = 'default';
	$query_builder = TRUE;
	
	$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);*/

?>