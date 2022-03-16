if (!('webkitSpeechRecognition' in window)) {
    alert("Unable to use the Speech Recognition API");
} else {
    let recognition = new webkitSpeechRecognition();

    recognition.continuous = false;
    recognition.lang = 'en-US';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;
    
    recognition.onresult = function(event) { 
        let saidText = "";
        
        for (let i = event.resultIndex; i < event.results.length; i++) {
            if (event.results[i].isFinal) {
                saidText = event.results[i][0].transcript;
            } else {
                saidText += event.results[i][0].transcript;
            }
        }
        let text = saidText.toLowerCase();
        let cmdText = filterText(text);
        document.getElementById('spokenTxt').value = cmdText;
        document.getElementById('txt').value = getResponse(cmdText);
        respond(text);

        //theForm.submit();
    }
    
    recognition.onspeechend = function() {
        recognition.stop();
    }
    
    recognition.onnomatch = function(event) {
        diagnostic.textContent = 'I did not understand.';
    }
    
    //recognition.onerror = function(event) {
     //   diagnostic.textContent = 'Error occurred in recognition: ' + event.error;
    //}
    
    function startRecording(){
        recognition.start();
    }

    speachTxt = {
        "how are you today":"I am very good thank you", 
        "what is your name":"my name is Mildred",
        "hello":"hello to you too",
        "goodbye":"see you later",
        "mildred":"yes?",
        "where are you from":"I am from Iowa",
        "what is your favorite food":"dill pickles",
        "do you like alexa":"no I do not",
        "do you like green eggs and ham":"yes I do like green eggs and ham, Sam I am",
        "hi":"hello wyatt",
        "change the termostat to 50 degrees":"ok termostat changed to 50 degrees",
        "thermostat":"going to thermostat",
        "lighting":"going to lighting",
        "usage":"going to usage",
        "home":"going to home",
        "set":"changing setting on thermostat",
        "turn":"switching lights",
        "error":"there was an error processing your request"
    };
    
}

function getResponse(text){
    let response = 'error';
    for (let key in speachTxt) {
        console.log("key= ", key);
        if(key == text) {
            response =  speachTxt[key];
            break;
        } else {
            response =  'I do not understand!';
        }
    }
    return response;
}

function respond(text){
    if (document.getElementById('theForm')){
        let theForm = document.getElementById('theForm');
        let action = document.getElementById('action');
        let item = document.getElementById('item');
        if(text.includes('set')){
            let indexTo = text.lastIndexOf("to");
            let str = text.slice(indexTo + 3);
            let int = parseInt(str);
            let htgSetting = document.getElementById('htgSetting');
            let clgSetting = document.getElementById('clgSetting');
            if (document.getElementById('tstatSP')){
                let tstatSp = document.getElementById('tstatSP');
                if(text.includes('heat') && int < clgSetting.value && int < 80 && int > 60){
                    htgSetting.value = int;
                    tstatSp.submit();
                } else if(text.includes('cool') && int > htgSetting.value && int < 80 && int > 60){
                    clgSetting.value = int;
                    tstatSp.submit();
                } 
            } else {
                document.getElementById('txt').value = "error";
                document.forms[0].submit();    
            } 
        } else if(text.includes('system')){
            let sys = document.getElementById('sys')
            if(text.includes('heat')){sys.value = 'htg';} 
            else if(text.includes('cool')){sys.value = 'clg';}
            else if(text.includes('auto')){sys.value = 'auto';} 
            else if(text.includes('off')){sys.value = 'off';}
            document.getElementById('tstatSys').submit;
        } else if(text.includes('turn') && text.includes('light') && text.includes('on')){
            let indexTurn = text.indexOf("turn");
            let str = text.slice(indexTurn);
            let room = string.replace('on', '');
            room = room.replace('the');
            let lightSw = room.trim();
            document.getElementById('')
        } else if(text.includes('thermostat')){
            action.value = 'tstat';
            theForm.submit();
        } else if(text.includes('light')){
            action.value = 'lighting';
            theForm.submit();
        } else if(text.includes('usage')){
            action.value = 'usage';
            theForm.submit();
        } else if(text.includes('home')){
            action.value = 'home';
            theForm.submit();
        } 
    }
}

function filterText(text){
    if(text.includes('set')){
        return 'set';
    } else if(text.includes('turn')){
        return "turn";
    } else if(text.includes('thermostat')){
        return 'thermostat';
    } else if(text.includes('light')){
        return 'lighting';
    } else if(text.includes('usage')){
        return 'usage';
    } else if(text.includes('home')){
        action.value = 'home';
        return 'home';
    }
    return text;
}

    



