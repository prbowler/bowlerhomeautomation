<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/library/functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/models/tstat_model.php'; //with database

    //database conection   
    $tstatData = getTstatData(2); //with database
    //$tstatData = array("htgSp"=>"68","clgSp"=>"78","sysSp"=>"auto","sfSp"=>"auto","zt"=>"68"); //when do dtatbase


    //var_dump($tstatData);
    $htgSp = $tstatData['htgSp'];
    $clgSp = $tstatData['clgSp'];
    $sysSp = $tstatData['sysSp'];
    $sfSp = $tstatData['sfSp'];
    $zt = $tstatData['zt'];

    $sysOptions = getSysOptions($sysSp);
    $sfOptions = getSfOptions($sfSp);

    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }
   
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
         $action = filter_input(INPUT_GET, 'action');
    }

    //$data = json_encode($tstatData);

    //writeFile("../data/data.txt", $data);

    switch ($action){
        case 'chgSp': 
            $htgSet = filter_input(INPUT_POST, 'htgSet');
            $clgSet = filter_input(INPUT_POST, 'clgSet');
            if($htgSet == NULL || $clgSet == NULL || $htgSet > $clgSet || $htgSet < 60 || $clgSet > 80) {
                echo("Unable to save setting");   
            } else {
                echo "new htg setting $htgSet new clg setting $clgSet";
                $htgSp = $htgSet;
                $clgSp = $clgSet;
                changeSetpoints($htgSp,$clgSp,2);
            } 
            header('location: /tstat/index.php');
        break; 
        case 'chgSys':
            $system = filter_input(INPUT_POST, 'sys');
            if($system == NULL) {
                echo "Unable to change system"; 
            } else if($system == "htg" || $system == "clg" || $system == "auto" || $system == "off"){
                echo "changing system to $system"; 
                $sysSp = $system;
                changeSystemSp($sysSp,2);
            } else {
                echo "Unable to change system incorect system";
            }
            header('location: /tstat/index.php');
        break;
        case 'chgSf':
            $sf = filter_input(INPUT_POST, 'sf');
            if($sf == NULL) {
                echo "invalid sf perimeter";  
            } else if($sf == "on" || $sf == "auto"){
                echo "change sf to $sf";
                $sfSp = $sf;
                changeSfSp($sfSp,2);
            } else {
                echo "invalid sf perimeter";
            }
            header('location: /tstat/index.php'); 
        break;   
        default:
         include $_SERVER['DOCUMENT_ROOT'] . '/views/tstat.php';
    }
?>