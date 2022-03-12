<?php
    if(isset($_POST['txt'])){
        $txt=$_POST['txt'];
        $txt=htmlspecialchars($txt);
        $txt=rawurlencode($txt);
        $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-US');
        $player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
        echo $player;
    }

    if(isset($_POST['spokenTxt'])){
        $spokenTxt = $_POST['spokenTxt'];
    } else {
        $spokenTxt = 'default';
    }

    switch($spokenTxt){
        case 'thermostat':
            include './tstat/index.php';
            break;
        case 'lighting':
            include './lighting/index.php';
            break;
        case 'usage':
            include './usage/index.php';
            break;
        case 'home':
            include './index.php';
            break;
        default:
        include './index.php';

    }

?>
