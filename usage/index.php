<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/library/functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/models/usage_model.php'; //with database

    //database connection
    $breakerData = getUsageData(); //with database
    $breakerStats = getUsageDataStats();
    

    $breakers = getCurrentUsage($breakerData);
    getTotalUsage($breakerStats, $breakers);
    
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