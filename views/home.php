<?php 
    $pageTitle = "Main";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php';
    } 
     
?> 
<main>
    <h1> Welcome to Bowler Home Automation </h1>
    <hr />
</main>


<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 