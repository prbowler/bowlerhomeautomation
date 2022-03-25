<?php 
        
    $pageTitle = "Login";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }

?>

<main>
    <h1><?php echo $pageTitle; ?> </h1>
    <hr>
    <form action="/users/index.php" method="post">
        <fieldset class="login">
            <legend>Login to your account</legend>
            <label for="email">Email:</label>
            <input type="email" aria-label= "email" name="email" id="email" <?php if(isset($email)){echo "value='$email'";}  ?> required><br><br>
            <div><span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span></div> 
            <label for="userPassword">Password:</label>
            <input type="password" aria-label="password" name="userPassword" id="userPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <button type="submit">Login</button>
            <input type="hidden" name="action" value="Login">
        </fieldset>
    </form> 
    <a href="../users/index.php?action=registration" aria-label="register for new acount" class="register">Register for a new account</a>
</main>

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 



