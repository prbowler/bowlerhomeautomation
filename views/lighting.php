<?php 
    $pageTitle = "Lighting";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; 
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php';
    } 
?> 

    <h1> Lighting Switches and Status </h1>
    <hr />
    
    <form action="/lighting/index.php" method="post" id="lights">
        <?php echo $switches;?>
        <input type="hidden" name="action" value="switch"> 
        <input type="hidden" value="Submit">
    </form>

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 