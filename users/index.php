<?php 
    //User Controller
    session_start();
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/models/users.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/library/functions.php';
    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
         $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'login':
            $pageTitle = "Login";
            include $_SERVER['DOCUMENT_ROOT'] . '/views/login.php';
        break;
        case 'registration':
            $pageTitle = "User Registration";
            include $_SERVER['DOCUMENT_ROOT'] . '/views/registration.php';
        break;
        case 'register':
            $pageTitle = "User Registration";
            $userEmail = trim(filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL));
            $userPassword = trim(filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_STRING));
            $userEmail = checkEmail($userEmail);
            $checkPassword = checkPassword($userPassword);

            $existingEmail = checkExistingEmail($userEmail);
            // Check for existing email address in the table
            if($existingEmail){
                $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if(empty($userEmail) || empty($checkPassword)){
                $message = '<p class="warning">Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit; 
            }
            
            // Hash the checked password
            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            
            // Send the data to the model
            $regOutcome = regUser($userEmail, $hashedPassword);

            // Check and report the result
            if($regOutcome === 1){
                setcookie('email', $userEmail, strtotime('+1 year'), '/');
                $_SESSION['message'] = "Thanks for registering $userEmail. Please use your email and password to login.";
                header('Location: /userss/?action=login');
                exit;
            } else {
                $message = "<p class='warning'>Sorry $userEmail, but the registration failed. Please try again.</p>";
                include '../views/registration.php';
                exit;
            }
        break;
        case 'Login':
            $_SESSION['message'] = "";
            $pageTitle = "Login";
            $userEmail = trim(filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL));
            $userPassword = trim(filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_STRING));
            $userEmail = checkEmail($userEmail);
            $checkPassword = checkPassword($userPassword); 
            if(empty($userEmail) || empty($checkPassword)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/login.php';
                exit; 
            }
            
            $userData = getuser($userEmail);
           
            $hashCheck = password_verify($userPassword, $userData['userPassword']);
           
            if(!$hashCheck) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }
            
            $_SESSION['loggedin'] = TRUE;
            
            array_pop($userData);
            
            $_SESSION['userData'] = $userData;
            $pageTitle = "Admin";
            $_SESSION['message'] = "Login Successful";
            header('Location: /accounts');
            exit;
        break; 
        case 'Logout':
            $pageTitle = "Logout";
            session_unset();
            session_destroy();
            header('Location: /');
        break;
        case 'changePassword':
            $pageTitle = "Change Password";
            $_SESSION['message'] = "";
            $userId = $_SESSION['userData']['userId'];
            // Filter and store the data
            $userPassword = trim(filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_STRING));
            $checkPassword = checkPassword($userPassword);

            // Check for missing data
            if(empty($checkPassword)){
                $message = '<p class="warning">Please provide information for all empty form fields.</p>';
                $pageTitle = "Update Account";
                include '../view/user-update.php';
                exit; 
            }
            
            // Hash the checked password
            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            
            // Send the data to the model
            $changePasswordResult = changePassword($hashedPassword, $userId);

            // Check and report the result
            if($changePasswordResult === 1){
                $_SESSION['message'] = "Password was changed.";
            } else {
                $_SESSION['message'] = "ERROR: Password was not changed.";
            }
            $pageTitle = "Admin";
            include '../view/admin.php';
        break;
        default:
            $pageTitle = "Admin";
            if ($_SESSION['loggedin'] == TRUE & isset($_SESSION['userData']['userId'])){
                $userId = $_SESSION['userData']['userId'];
            }
            include '../views/admin.php';
        break;
    }
?>