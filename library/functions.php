<?php

function getSysOptions($sysSp) {
    $options = array('htg','clg','auto','off');
    $sysOptions = "<label for='sys'>System:</label><select name='sys' id='sys' size='4'>";
    foreach($options as $option){
        if($sysSp == $option){
            $sysOptions .= "<option value='$option' selected>$option</option>";
        } else {
            $sysOptions .= "<option value='$option'>$option</option>";
        }
    }
    $sysOptions .= "</select>";
    return $sysOptions;
}

function getSfOptions($sfSp) {
    $options = array('auto','on');
    $sfOptions = "<label for='sf'>SF:</label><select name='sf' id='sf' size='2'>";
    foreach($options as $option){
        if($sfSp == $option){
            $sfOptions .= "<option value='$option' selected>$option</option>";
        } else {
            $sfOptions .= "<option value='$option'>$option</option>";
        }
    }
    $sfOptions .= "</select>";
    return $sfOptions;
}

function getlighting($lightingData) {
    $switches = "<div id='lights'>";
    foreach($lightingData as $room) {
        $name = $room['name'];
        $src = "/img/$name.jpg";
        $switches .= '<div class="room">';
        $switches .= "<span>";
        $switches .= "<img src=$src>";
        $switches .= "<label class='switch'><input type='checkbox'><span class='slider'></span></label>";
        $switches .= "</span>";
        if($room['status'] == "0"){
            $switches .= "<img id=$name src='/img/light.png' width='50' height='50'>";
        } else {
            $switches .= "<img id=$name src='/img/lighton.png' width='50' height='50'>";
        }
        $switches .= "</div>";
    }
    $switches .= "</div>";
    return $switches;
}

function getUsage($breakerData) {
    $usage = "<div id='usage'>";
    
    foreach($breakerData as $breaker) {
        $usage .= '<label for="' . $breaker['name'] . '">' . $breaker['name'] . ':</label>';
        $usage .= '<meter id="' . $breaker['name'] . '" value="' . ($breaker['amps'] / 100) . '">' . $breaker['amps'] . '%</meter>'; 
    }
    $usage .= "</div>";
    return $usage;
}

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
   }
 
// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function writeFile($filename, $data){
    //$myfile = fopen($filename, "w") or die("Unable to open file!");
    //fwrite($myfile, $data);
    //fclose($myfile);
}

?>