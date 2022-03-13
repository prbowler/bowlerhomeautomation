<?php 
    $pageTitle = "Main";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php';
    } 
     
?> 

<h1> Welcome to Bowler Home Automation </h1>
<hr />

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 