if (!('webkitSpeechRecognition' in window)) {
    alert("Unable to use the Speech Recognition API");
} else {
    let recognition = new webkitSpeechRecognition();

    recognition.continuous = false;
    recognition.lang = 'en-US';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;
    
    recognition.onresult = function(event) { 
        saidText = "";
        for (let i = event.resultIndex; i < event.results.length; i++) {
            if (event.results[i].isFinal) {
                saidText = event.results[i][0].transcript;
            } else {
                saidText += event.results[i][0].transcript;
            }
        }
        document.getElementById('spokenTxt').value = saidText;
        
        for (let key in speachTxt) {
            console.log("key= ", key);
            if(key == saidText) {
                document.getElementById('txt').value = speachTxt[key];
                break;
            } else {
                document.getElementById('txt').value = 'I do not understand!';
            }
        }
    
        document.getElementById('theForm').submit();
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
        "Mildred":"Yes?",
        "where are you from":"I am from Iowa",
        "what is your favorite food":"dill pickles",
        "do you like Alexa":"no I do not",
        "do you like Green Eggs and Ham":"yes I do like green eggs and ham, Sam I am",
        "hi":"hello Wyatt",
        "change the termostat to 50 degrees":"ok termostat changed to 50 degrees",
        "thermostat":"going to thermostat",
        "lighting":"going to lighting",
        "usage":"going to usage",
        "home":"going to home"
    };
    
}



