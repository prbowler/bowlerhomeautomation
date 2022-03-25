<nav>
  <div class="menu">
    <button id="btn1" class="btn" onclick='startRecording();'></button>
    <a href="/index.php/?action=lighting" id="btn2" class="btn"></a>
    <a href="/index.php/?action=usage" id="btn3" class="btn"></a>
    <a href="/index.php/?action=tstat" id="btn4" class="btn"></a>
    <a href="/index.php" id="btn5" class="btn"></a>
  </div> 
  <div class="hiddenMenu">
    <form class="tts" action="/index.php" method="post" id="theForm">
    <input type="hidden" id="txt" name="txt"><br>
    <input type="hidden" id="spokenTxt" name="spokenTxt"><br>
    <input type="hidden" id="action" name="action">
    <input type="hidden" id="item" name="item">
    <input type="hidden" value="">
  </div>
</form>
</nav>

