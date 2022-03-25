<?php 
    $pageTitle = "Lighting Stats";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php';
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php';
    } 
?>   

<main>
    <h1> Lighting Usage Stats </h1>
    <h2>Usage in Watts</h2>
    <hr />
    <canvas id="Current"></canvas>
    <canvas id="Total"></canvas>
    <script src="/js/graph.js"></script>
</main>>

    
<?php 
    //require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 
