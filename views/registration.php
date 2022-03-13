<?php 

    $pageTitle = "Login";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 

    if (isset($message)) {
    echo $message;
    }

?>

<form method="post" action="/users/index.php">
    <fieldset class="login">
    <legend>Register for new account</legend>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" <?php if(isset($email)){echo "value='$email'";}  ?> required ><br><br>
    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, 1 low case letter, and 1 special character</span> 
    <label for="userPassword">Password:</label>
    <input type="password" name="userPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
    <input class="button" type="submit" name="submit" aria-label="submit form" id="regbtn" value="Register">
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="register">
    </fieldset>
    
</form> 

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 