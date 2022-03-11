<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/connections.php';

// Get all usage data
function getUsageData(){
    $db = databaseConnect();
    $sql = 'SELECT * FROM breakers';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $usageData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $usageData;
}

?>