<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/connections.php';

//Register user
function regUser($userEmail, $userPassword){
    $db = databaseConnect();
    $sql = 'INSERT INTO userss (userEmail, userPassword)
        VALUES (:userEmail, :userPassword)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
    $stmt->bindValue(':userPassword', $userPassword, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function checkExistingEmail($userEmail) {
    $db = databaseConnect();
    $sql = 'SELECT userEmail FROM users WHERE userEmail = :userEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchedEmails = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchedEmails)) {
        return 0;
    } else {
        return 1;
    }
}

// Get user data based on an email address
function getuser($userEmail){
    $db = databaseConnect();
    $sql = 'SELECT userId, userEmail, userPassword FROM users WHERE userEmail = :userEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
}

//Change user password
function changePassword($userPassword, $userId){
    $db = databaseConnect();
    $sql = 'UPDATE users SET userPassword = :userPassword WHERE userId = :userId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userPassword', $userPassword, PDO::PARAM_STR);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

?>