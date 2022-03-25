<?php 
    $pageTitle = "Termostat";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php';
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php';
    } 
?>   

<main>
    <h1> <?php echo $pageTitle; ?> </h1>
    <a class="statButton btn" href="../tstat/index.php?action=stats">Stats</a>
    <hr />

    <div id="tstat">
        <form action="/tstat/index.php" method="post" id="tstatSP">
            <div class="tPart t1">
                <output type="number" id="zoneTemp" name="zoneTemp"><?php if(isset($zt)){echo $zt;} ?></output>
                <output type="number" id="satTemp" name="satTemp"><?php if(isset($sat)){echo "SAT $sat";} ?></output>
                <output type="text" id="tstatStatus" name="tstatStatus"><?php if(isset($status)){echo "STAT $status";} ?></output>
                <output type="text" id="tstatAlarm" name="tstatAlarm"><?php if(isset($system)){echo "SYS $system";} ?></output>
            </div>
            <div class="tPart t2">
                <label for="htgSetting">Heat</label>
                <input type="number" id="htgSetting" name="htgSet" class="setting" <?php if(isset($htgSp)){echo "value='$htgSp'";} ?>>
                <label for="clgSetting">Cool</label>
                <input type="number" id="clgSetting" name="clgSet" class="setting" <?php if(isset($clgSp)){echo "value='$clgSp'";} ?>>
            </div>
            <input type="hidden" name="action" value="chgSp">
            <input type="hidden" name="txt">
            <input type="submit" value="Change Sp" class="smallbtn">
        </form>

        <form action="/tstat/index.php" method="post" id="tstatSys">
            <div class="tPart t3">
                <?php echo $sysOptions;?>
            </div>
            <div class="t4"> 
                <input type="hidden" name="action" value="chgSys"> 
                <input type="hidden" name="txt">
                <input type="submit" value="Submit">
            </div>
        </form>
        
    </div>
</main>


<?php 
    //require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/tts.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 

