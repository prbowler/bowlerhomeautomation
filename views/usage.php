<?php 
    $pageTitle = "Usage";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php';
    } 
?> 

<main>
    <h1> Usage Per Breaker </h1>
    <h2> Usage in Watts
    <hr />
    <canvas id="Current"></canvas>
    <canvas id="Total"></canvas>
    <script src="/js/graph.js"></script>
</main>

<?php 
    //echo $usage;
    //require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 