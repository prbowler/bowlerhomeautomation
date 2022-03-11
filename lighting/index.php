<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/library/functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/models/lighting_model.php'; //with database

    //database connection
    $lightingData = getLightingData(); //with database
    /*
    $lightingData = array(
        array("name"=>"Front","status"=>"0"),
        array("name"=>"Kitchen","status"=>"1"),
        array("name"=>"Dining","status"=>"0"),
        array("name"=>"MasterBR","status"=>"1")
    );*/ //without database
    //var_dump($lightingData);

    $switches = getLighting($lightingData);

    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }
   
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
         $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'switchOn':   
        break; 
        case 'switchOff':
        break; 
        default:
         include $_SERVER['DOCUMENT_ROOT'] . '/views/lighting.php';
    }
?>