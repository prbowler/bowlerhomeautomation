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

?>