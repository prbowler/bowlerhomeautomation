<?php

function databaseConnect(){
    //local database
    //$server = 'localhost';
    //$dbname= 'homeautomation';
    //$username = 'iClient';
    //$password = 'qBzPz6yEGrTb0UcF';

    //heroku database
    $server = 'us-cdbr-east-05.cleardb.net';
    $dbname = 'heroku_cd3f44fce4ead91';
    $username = 'b4ea6cffd8b299';
    $password = '3e88d9bf';

    $dsn = 'mysql:host='.$server.';dbname='.$dbname;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        header('Location: ../views/500.php');
        exit;
    }
}

?>