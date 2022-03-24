<?php 
    $pageTitle = "Termostat";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php';
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php';
    } 
?>   


    <h1> Theromstat Usage Stats </h1>
    <hr />
    <canvas id="Current"></canvas>
    <canvas id="Total"></canvas>
    <script src="/js/graph.js"></script>


<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 