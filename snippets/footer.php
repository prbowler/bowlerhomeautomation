</main>
    <footer>
        <?php
            if(isset($_POST['txt'])){
                $txt=$_POST['txt'];
                $txt=htmlspecialchars($txt);
                $txt=rawurlencode($txt);
                $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-US');
                $player="<audio controls='controls' autoplay onended='sendToSite()'><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
                echo $player;
            }   
        ?>   
    </footer>
    </body>
</html>

