<?php 
    $pageTitle = "Usage";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php'; 
?> 

    <h1 id="tytle"> Watt Usage Per Breaker </h1>
    <hr />
    <canvas id="Current"></canvas>
    <canvas id="Total"></canvas>
    <script src="/js/graph.js"></script>

<?php 
    //echo $usage;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 