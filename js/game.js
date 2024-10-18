var game;

window.onload=function(){
	game= new Controller(document.getElementById('snakeboard'));
}

function updateButtonStatus(){
	var start= document.getElementById('start');
	var pausa= document.getElementById('pausa');
	start.disabled=!start.disabled;
	pausa.disabled=!pausa.disabled;
}

function song(){
	var audio = document.getElementById("canzone");
	audio.play();
	audio.loop=true;	
}