<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/library/functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/models/lighting_model.php'; 

    //database connection get lighting data from database
    $lightingData = getLightingData(); 
    
    //Get HTML/PHP data to display from database data
    $switches = getLighting($lightingData);

    //Is not used
    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }
   
    //Checks for an action either post of get
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
         $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        //Switch the light either on or off
        case 'switch':
            if (isset($_POST['lights'])){
                $lights = $_POST['lights'];
                foreach($lightingData as $room){
                    if(in_array($room['room'], $lights)){
                        turnOnSw($room['room']);
                    } else {
                        turnOffSw($room['room']);
                    }
                }  
            } else {
                foreach($lightingData as $room){
                    turnOffSw($room['room']);
                }
            }
            header('location: /lighting/index.php'); 
        break;
        //Show the lighting logs
        case 'stats':
            $lightingStats = getLightingStats();
            $rooms = fileLightingStats($lightingData);
            fileTotalLightingUsage($lightingStats,$rooms);
            include $_SERVER['DOCUMENT_ROOT'] . '/views/lightingStats.php';
        break; 
        default:
         //Show the lighting switches
         include $_SERVER['DOCUMENT_ROOT'] . '/views/lighting.php';
    }
?>