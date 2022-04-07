<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="bowlerhomeautomation" content="Bowler Home Automation">
        <meta name="keywords" content="home automation">
        <meta name="author" content="Philip Bowler">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if(isset($pageTitle)){ echo $pageTitle;}?> | Bowler Home Automation </title>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <script src="/js/speech.js"></script>
        <script src="/js/Chart.min.js"></script>
        <script src="/js/functions.js"></script>
    </head>
    <body>
        <header>
            <div id="logo">
                <a href="https://bowlerhomepage.herokuapp.com/">
                    <img class="logo" src="/img/logo.jpg" alt="Logo" height="50" width="50">
                </a>
            </div>
            <?php 
                $linkAccounts = "/users/index.php";
                $linkAccountsLogout = "/users/index.php?action=Logout";
                $linkAccountsLogin = "/users/index.php?action=login";
                if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) { 
                    echo "<span class='loginstatus'><a class='account' href='/users/index.php'>Welcome ". $_SESSION['userData']['email'] . " |- " . "</a> <a class='account' href='/users/index.php?action=Logout'>Logout</a></span>";
                } else {
                    echo "<span class='loginstatus'><a class='account' href='/users/index.php?action=login'>My Account</a></span>";
                }
            ?> 
        </header>