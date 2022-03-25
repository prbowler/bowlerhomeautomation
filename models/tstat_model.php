<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/connections.php';

// Get tstat data based on an tstat id
function getTstatData($tstatId){
    $db = databaseConnect();
    $sql = 'SELECT * FROM tstats WHERE tstatId = :tstatId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':tstatId', $tstatId, PDO::PARAM_STR);
    $stmt->execute();
    $tstatData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $tstatData;
}

function getTstatStats($tstatId){
    $db = databaseConnect();
    $sql = 'SELECT * FROM tstatstat';
    $stmt = $db->prepare($sql);
    //$stmt->bindValue(':tstatId', $tstatId, PDO::PARAM_STR);
    $stmt->execute();
    $tstatStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $tstatStats;
}

//Register new tstat
function regTstat($tstatName){
    $db = databaseConnect();
    $sql = 'INSERT INTO tstat (tstatName)
        VALUES (:tstatName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':tstatName', $tstatName, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Change tstat heat / cool setpoints
function changeSetpoints($htgSp, $clgSp, $tstatId){
    $db = databaseConnect();
    $sql = 'UPDATE tstats SET htgSp = :htgSp , clgSp = :clgSp WHERE tstatId = :tstatId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':htgSp', $htgSp, PDO::PARAM_STR);
    $stmt->bindValue(':clgSp', $clgSp, PDO::PARAM_STR);
    $stmt->bindValue(':tstatId', $tstatId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Change tstat system to heat-cool-auto-off
function changeSystemSp($sysSp, $tstatId){
    $db = databaseConnect();
    $sql = 'UPDATE tstats SET sysSp = :sysSp WHERE tstatId = :tstatId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':sysSp', $sysSp, PDO::PARAM_STR);
    $stmt->bindValue(':tstatId', $tstatId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Change tstat sf to auto-on
function changeSfSp($sfSp, $tstatId){
    $db = databaseConnect();
    $sql = 'UPDATE tstats SET sfSp = :sfSp WHERE tstatId = :tstatId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':sfSp', $sfSp, PDO::PARAM_STR);
    $stmt->bindValue(':tstatId', $tstatId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Change tstat outputs on-off
function changeOutputs($sf, $htg, $clg, $tstatId){
    $db = databaseConnect();
    $sql = 'UPDATE tstats SET sf = :sf , htg = :htg , clg = :clg WHERE tstatId = :tstatId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':sf', $sf, PDO::PARAM_BOOL);
    $stmt->bindValue(':htg', $htg, PDO::PARAM_BOOL);
    $stmt->bindValue(':clg', $clg, PDO::PARAM_BOOL);
    $stmt->bindValue(':tstatId', $tstatId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

?>