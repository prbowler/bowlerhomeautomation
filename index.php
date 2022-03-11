<?php 

    session_start();

    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }
   
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
         $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'tstat':
          header('location: /tstat/');  
        break; 
        case 'lighting':
          header('location: /lighting/');  
        break;
        case 'usage':
          header('location: /usage/');  
        break;   
        default:
         include  $_SERVER['DOCUMENT_ROOT'] . '/views/home.php';
    }
?>