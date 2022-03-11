<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/library/functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/models/usage_model.php'; //with database

    //database connection
    $breakerData = getUsageData(); //with database
    /*
    $breakerData = array(
        array("name"=>"Front","amps"=>"10","status"=>"0"),
        array("name"=>"Kitchen","amps"=>"20","status"=>"1"),
        array("name"=>"Dining","amps"=>"10","status"=>"0"),
        array("name"=>"MasterBR","amps"=>"10","status"=>"1")
    ); */ //without database

    $usage = getUsage($breakerData);

    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }
   
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
         $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'more':   
        break; 
        default:
         include $_SERVER['DOCUMENT_ROOT'] . '/views/usage.php';
    }
?>