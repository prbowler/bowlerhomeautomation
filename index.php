<?php 

    session_start();

    
    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }
   
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
         $action = filter_input(INPUT_GET, 'action');
    }

    $txt = filter_input(INPUT_POST, 'txt');
    if ($txt == NULL){
         $txt = filter_input(INPUT_GET, 'txt');
    }

    switch ($action){
        case 'tstat':
          header('location: /tstat/index.php?txt='.$txt); 
        break; 
        case 'lighting':
          header('location: /lighting/index.php?txt='.$txt);  
        break;
        case 'usage':
          header('location: /usage/index.php?txt='.$txt);  
        break;  
        case 'home':
          header('location: /index.php?txt='.$txt);  
        break; 
        default:
         include  $_SERVER['DOCUMENT_ROOT'] . '/views/home.php';
    }
?>