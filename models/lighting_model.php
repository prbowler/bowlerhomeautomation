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