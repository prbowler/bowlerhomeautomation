<?php 
    $pageTitle = "Lighting";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php'; 
?> 

<h1> Lighting Page </h1>
<hr />

<?php 
    echo $switches;
    //echo $lightStatus;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 