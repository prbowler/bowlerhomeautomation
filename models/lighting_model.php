<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/connections.php';

// Get all lighting data
function getLightingData(){
    $db = databaseConnect();
    $sql = 'SELECT * FROM lighting';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $lightingData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $lightingData;
}

//Get all lighting log stats
function getLightingStats(){
    $db = databaseConnect();
    $sql = 'SELECT * FROM lightingstat';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $lightingStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $lightingStats;
}

//Set the switch to on in data base
function turnOnSw($lightSw){
    $db = databaseConnect();
    $sql = 'UPDATE lighting SET switch = 1 WHERE room = :room';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':room', $lightSw, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Set the switch to off in data base
function turnOffSw($lightSw){
    $db = databaseConnect();
    $sql = 'UPDATE lighting SET switch = 0 WHERE room = :room';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':room', $lightSw, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Set the switch to val in data base
function switchLight($room, $val){
    $db = databaseConnect();
    $sql = 'UPDATE lighting SET switch = :val WHERE room = :room';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':room', $room, PDO::PARAM_STR);
    $stmt->bindValue(':val', $val, PDO::PARAM_BOOL);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}


?>