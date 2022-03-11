<?php

function databaseConnect(){
    //local database
    //$server = 'localhost';
    //$dbname= 'homeautomation';
    //$username = 'iClient';
    //$password = 'qBzPz6yEGrTb0UcF';

    //heroku database
    $server = 'mysql://b4ea6cffd8b299:3e88d9bf@us-cdbr-east-05.cleardb.net';
    $dbname = 'heroku_cd3f44fce4ead91';
    $username = 'b4ea6cffd8b299';
    $password = '3e88d9bf';

    $dsn = 'mysql:host='.$server.';dbname='.$dbname;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username, $password, $options);
        /*header('Location: ../view/success.php');*/
        //echo "Success";
        return $link;
    } catch(PDOException $e) {
        header('Location: ../views/500.php');
        exit;
    }
}

function hDatabaseConnection(){
    //Get Heroku ClearDB connection information
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL")); //mysql://baa0e81b318289:4e03dad6@us-cdbr-east-05.cleardb.net/heroku_7b4c11141cf792a?reconnect=true
    $cleardb_server = $cleardb_url["host"]; //mysql://baa0e81b318289:4e03dad6@us-cdbr-east-05.cleardb.net/heroku_7b4c11141cf792a?reconnect=true
    $cleardb_username = $cleardb_url["user"]; //baa0e81b318289
    $cleardb_password = $cleardb_url["pass"]; //4e03dad6 
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $query_builder = TRUE;
    // Connect to DB
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
} 

   databaseConnect();

   ?>