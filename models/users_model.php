<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/connections.php';

//Register user
function regUser($email, $userPassword){
    $db = databaseConnect();
    $sql = 'INSERT INTO users (email, userPassword)
        VALUES (:email, :userPassword)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':userPassword', $userPassword, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function checkExistingEmail($email) {
    $db = databaseConnect();
    $sql = 'SELECT email FROM users WHERE email = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
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
function getuser($email){
    $db = databaseConnect();
    $sql = 'SELECT userId, email, userPassword FROM users WHERE email = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
}

//Change user userPassword
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