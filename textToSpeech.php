<?php
    if(isset($_POST['txt'])){
        $txt=$_POST['txt'];
        $txt=htmlspecialchars($txt);
        $txt=rawurlencode($txt);
        $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-US');
        $player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
        //echo $player;
    }

    if(isset($_POST['action'])){
        $action = $_POST['action'];
    } else {
        $action = 'default';
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
        case 'home':
           header('location: /');  
        break;   
        default:
           header('location: /');
    }
?>
