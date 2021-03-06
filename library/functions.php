<?php

//Setup HTML/PHP for thermostat system settings using the current setting returns HTML/PHP to be displayed 
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

//Not Used for future setup HTML/PHP for sf settings using the current setting returns HTML/PHP to be displayed 
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

//Setup HTML/PHP for displaying current lighting settings and switched to change returns HTML/PHP to be displayed 
function getlighting($lightingData) {
    $switches = "<div id='lights'>";
    foreach($lightingData as $room) {
        $name = $room['room'];
        $id = $name . 'checkbox';
        if ($room['switch'] == 1){$stat = 'checked';}else{$stat = '';}
        $src = "/img/$name.jpg";
        $switches .= '<div class="room">';
        $switches .= "<span>";
        $switches .= "<img class='switchImg' src=$src>";
        $switches .= "<label class='switch'><input type='checkbox' id=$id name='lights[]' value=$name $stat onchange='switchLight()'><span class='slider'></span></label>";
        $switches .= "</span>";
        if($room['switch'] == "0"){
            $switches .= "<img id=$name src='/img/light.png' width='50' height='50'>";
        } else {
            $switches .= "<img id=$name src='/img/light-on.png' width='50' height='50'>";
        }
        $switches .= "</div>";
    }
    $switches .= "</div>";
    return $switches;
}

//Sends thermostat stats to JSON file for JS to read  
function fileTstatStats($tstatData){
    $tstat = [];
    if($tstatData["htg"] == 0 && $tstatData["sat"] > 79) {
        $tstat["Kilawatts"] = 0.6;
        $tstat["Propane-gallons"] = 0.9;
    } else if(($tstatData["clg"] == 0 && $tstatData["sat"] < 65)){
        $tstat["Kilawatts"] = 10;
    } else {
        $tstat["Kilawatts"] = 0;
        $tstat["Propane-gallons"] = 0;
    }
    
    $jsonTstatStats = json_encode($tstat);
    $myfile = fopen("../data/tstatCurrent.json","w") or die("Unable to open file!");
    fwrite($myfile, $jsonTstatStats);
}

//Sends thermostat log stats to JSON file for JS to read 
function fileTotalTstatUsage($tstatStats){
    $tstatTotal = [];
    $tstatTotal["Kilawatts"] = 0;
    $tstatTotal["Propane-gallons"] = 0;
    foreach($tstatStats as $stat){
        if($stat["htg"] == 0 && $stat["sat"] > 79) {
            $tstatTotal["Kilawatts"] += 0.6;
            $tstatTotal["Propane-gallons"] += 0.9;
        } else if(($stat["clg"] == 0 && $stat["sat"] < 65)){
            $tstatTotal["Kilawatts"] += 10;
        } 
    }
    
    $jsonTstatTotal = json_encode($tstatTotal);
    $myfile = fopen("../data/tstatTotal.json","w") or die("Unable to open file!");
    fwrite($myfile, $jsonTstatTotal);
}

//Sends lighting stats to JSON file for JS to read 
function fileLightingStats($lightingData){
    $rooms = [];
    foreach($lightingData as $room) {
        if($room["switch"] == 1){
            $rooms[$room["room"]] = $room["watts"];
        } else {
            $rooms[$room["room"]] = 0;
        }
    }
    $jsonLightingStats = json_encode($rooms);
    $myfile = fopen("../data/lightsCurrent.json","w") or die("Unable to open file!");
    fwrite($myfile, $jsonLightingStats);
    return $rooms;
}

//Sends lighting log stats to JSON file for JS to read
function fileTotalLightingUsage($lightingStats, $rooms){
    $roomLightTotal = [];
    foreach($rooms as $k => $v){
        $roomLightTotal[$k] = 0;
    }
    foreach($lightingStats as $lightStat){
        foreach($roomLightTotal as $key => $value ){
            if($lightStat["room"] == $key){
                $roomLightTotal[$key] += $lightStat['switch'] * $lightStat['watts'];
            }
        }
    }
    
    $jsonRoomLightingTotal = json_encode($roomLightTotal);
    $myfile = fopen("../data/lightsTotal.json","w") or die("Unable to open file!");
    fwrite($myfile, $jsonRoomLightingTotal);
}

//Not Used Sets up HTML/PHP data for display of usage data from breakers by breaker
function getUsage($breakerData) {
    $usage = "<div id='usage'>";
    
    foreach($breakerData as $breaker) {
        $usage .= '<label for="' . $breaker['name'] . '">' . $breaker['name'] . ':</label>';
        $usage .= '<meter id="' . $breaker['name'] . '" value="' . ($breaker['amps'] / 100) . '">' . $breaker['amps'] . '%</meter>'; 
    }
    $usage .= "</div>";
    return $usage;
}

//Sets up HTML/PHP data for display of usage data from breakers by breaker
function getCurrentUsage($breakerData){
    $breakers = [];
    foreach($breakerData as $breaker){
        $breakers[$breaker["breakerName"]] = $breaker["amps"];
    }
    $jsonBreakerData = json_encode($breakers);
    $myfile = fopen("../data/current.json","w") or die("Unable to open file!");
    fwrite($myfile, $jsonBreakerData);
    return $breakers;
}

//Sets up HTML/PHP data for display of totaled usage data from breakers by breaker
function getTotalUsage($breakerDataStats, $breakers){
    $breakerTotal = [];
    foreach($breakers as $k => $v){
        $breakerTotal[$k] = 0;
    }
    foreach($breakerDataStats as $breakerStat){
        foreach($breakerTotal as $key => $value ){
            if($breakerStat["breakerName"] == $key){
                $breakerTotal[$key] += $breakerStat['status'] * $breakerStat['amps'];
            }
        }
    }
    
    $jsonBreakerData = json_encode($breakerTotal);
    $myfile = fopen("../data/total.json","w") or die("Unable to open file!");
    fwrite($myfile, $jsonBreakerData);
}

//Checks to see if email is valid
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

?>