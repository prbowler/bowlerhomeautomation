<?php 

/*<div class='search_container'>
	<input type='text' id='speechText' > &nbsp; <input type='button' id='start' value='Start' onclick='startRecording();'>
</div>
<div class="container"></div>*/

?>

<form action="/textToSpeech.php" method="post" id="theForm">
  <input type="hidden" id="txt" name="txt"><br>
  <input type="hidden" id="spokenTxt" name="spokenTxt"><br>
  <input type="hidden" value="">
</form>