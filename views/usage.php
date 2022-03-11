<?php 
    $pageTitle = "Usage";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php'; 
?> 

<h1> Usage Page </h1>
<hr />

<?php 
    echo $usage;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 