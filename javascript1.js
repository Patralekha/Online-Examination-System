//javascript.js
//var playing = false;
//var score;
var action;
var timeremaining;
//var correctAnswer;

//if we click on the start
document.getElementById("start").onclick = function(){
    
    //if we are playing
    
    //if(playing == true){
        
        //location.reload(); //reload page
        
   // }else{//if we are not playing
        
        //change mode to playing
        
       // playing = true;
        
        //set score to 0
        
        //score = 0;
        //document.getElementById("scorevalue").innerHTML = score;
     
        //show countdown box
    
    var x = document.getElementById("myDIV");
    var b = document.getElementById("start");
    //var x = document.getElementById("myDIV");
	if (x.style.display === "none") { 
	b.style.visibility = 'hidden';
	x.style.display = "block";
    }
        //show("timeremaining");
        timeremaining = 60;
        document.getElementById("trv").innerHTML = timeremaining;
        show("timeremaining");
        //hide game over box
        
        hide("examEnd");
        
        //change button to reset
       // document.getElementById("start").innerHTML = "Reset Game";
        
        //start countdown
        
        startCountdown();
        
        //generate a new Q&A
        
        //generateQA();
   // }
    
}



function startCountdown(){
    action = setInterval(function(){
        timeremaining -= 1;
        document.getElementById("trv").innerHTML = timeremaining;
        if(timeremaining == 0){// game over
            stopCountdown();
          //  show("examEnd");
         document.getElementById("examEnd").innerHTML = "<div style='background-color:red,color:white'>Exam ended!</div>";   
            show("examEnd");
            hide("timeremaining");
            hide("endexam");
            hide("myDIV");
            //document.getElementById("startreset").innerHTML = "Start Game";
        }
    }, 1000);    
}

//stop counter

document.getElementById("endexam").onclick = function(){
    
    stopCountdown();
    
}

function stopCountdown(){
    clearInterval(action);   
}

//hide an element

function hide(Id){
    document.getElementById(Id).style.display = "none";   
}

//show an element

function show(Id){
    document.getElementById(Id).style.display = "block";   
}

