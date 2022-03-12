<?php 
    $pageTitle = "Termostat";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php';
?> 
<div class="top"><?php require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/menu.php';?></div>   

<h1> Thermostat Page </h1>
<hr />

<div id="tstat">
    <form action="/tstat/index.php" method="post" id="tstatSP">
    <div class="tPart t1">
        <input type="number" id="zoneTemp" name="zoneTemp" <?php if(isset($zt)){echo "value='$zt'";} ?>readonly>
        <input type="text" id="tstatStatus" name="tstatStatus" value="Heating" readonly>
        <input type="text" id="tstatAlarm" name="tstatStatus" value="Normal" readonly>
    </div>
    <div class="tPart t2">
        <label for="htgSetting">Heat</label>
        <input type="number" id="htgSetting" name="htgSet" class="setting" <?php if(isset($htgSp)){echo "value='$htgSp'";} ?>>
        <label for="clgSetting">Cool</label>
        <input type="number" id="clgSetting" name="clgSet" class="setting" <?php if(isset($clgSp)){echo "value='$clgSp'";} ?>>
    </div>
    <input type="hidden" name="action" value="chgSp">
    <input type="submit" value="Change Sp" class="smallbtn">
    </form>

    <form action="/tstat/index.php" method="post" id="tstatSys">
    <div class="tPart t3">
        <?php echo $sysOptions;?>
    </div>
    <div class="t4"> 
        <input type="hidden" name="action" value="chgSys"> 
        <input type="submit" value="Submit">
    </div>
    </form>

    <form action="/tstat/index.php" method="post" id="tstatSf">
        <?php echo $sfOptions;?>
        <input type="hidden" name="action" value="chgSf"> 
        <input type="submit" value="Submit">
    </form>
</div>

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; 
?> 

