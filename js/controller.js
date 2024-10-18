function Controller(board){
	this.Snake= new Snake();
	this.Sketcher= new Sketcher(board);
	this.Food= new Food();
	this.dx=10;
	this.dy=0;
	this.stat = null;
	this.modalita=0;
	this.velocita=130;
	this.audio= song();
}

Controller.prototype.changeModality=
	function(){
		this.modalita = document.getElementById("gameModality").value;			
}
	
Controller.prototype.has_game_ended= 
	function(){
        // controllo se la testa del serpente ha picchiato contro
        // un'altra parte del corpo del serpente. Per far ciò, per ogni quadratino
        // del serpente, controllo che la cordinata x E la cordinata y siano uguali
        // a quelle della testa del serpente. Se ciò accade, termina il gioco.
        for (var i = 4; i < this.Snake.body.length; i++) {
            if (this.Snake.body[i].x === this.Snake.body[0].x && this.Snake.body[i].y === this.Snake.body[0].y) 
                return true;
         }
		 
		 // poi, controllo di non essermi scontrato coi bordi
		 if(this.modalita==1)
			if(this.Snake.body[0].x < 0 || 
			   this.Snake.body[0].x > this.Sketcher.snakeboard.width - 10 ||
			   this.Snake.body[0].y > this.Sketcher.snakeboard.height - 10 ||
			   this.Snake.body[0].y < 0)
					return true;

      return false;
    }
	
Controller.prototype.change_direction =
	function(event){
      // metto in queste variabili la codifica dei tasti freccia della tastiera
	  var ENTER=13;
	  var SPACE= 32;
      var LEFT = 37;
      var RIGHT = 39;
      var UP = 38;
      var DOWN = 40;
	
      // metto in questa variabile la codifica del tasto premuto dall'utente 
      var keyPressed = event.keyCode;
      // e in quest'altre variabili controllo dove sto andando (se verso destra o in basso ecc)
      var goingUp = (this.dy === -10);
      var goingDown = (this.dy === 10);
      var goingRight = (this.dx === 10);
      var goingLeft = (this.dx === -10);
	  
	  var partitaInCorso= document.getElementById("start").disabled;
	  
	  if (keyPressed === SPACE & partitaInCorso){
		this.pause();			
		return;
      } 
	   
	  if (keyPressed === ENTER & !partitaInCorso){
		this.start();			
		return;
      } 
      // se l'utente ha premuto la freccia sinistra e non stavo andando a destra
      // imposto come velocità -10 verso (meno) destra, ovvero verso l'asse negativo rispetto
      //all'asse x, ovvero verso sinistra. Inoltre, mi sposto di 0 sull'asse y
      if (keyPressed === LEFT && !goingRight) {
        this.dx = -10;
        this.dy = 0;
		return;
      } // itero il ragionamento per tutte le altre direzioni
      if (keyPressed === UP && !goingDown) {
        this.dx = 0;
        this.dy = -10;
		return;
      }
      if (keyPressed === RIGHT && !goingLeft) {
        this.dx = 10;
        this.dy = 0;
		return;
      }
      if (keyPressed === DOWN && !goingUp) {
        this.dx = 0;
        this.dy = 10;
		return;
      }
    }
	
Controller.prototype.move_snake=
	function(){
      // Creo la nuova testa del serpente
      var head;
	  
      if (this.Snake.body[0].y < 0)
        head = {x: this.Snake.body[0].x , y: this.Sketcher.snakeboard.height - 10};
      else if (this.Snake.body[0].x > this.Sketcher.snakeboard.width - 10)
        head = {x: 0, y: this.Snake.body[0].y};
      else if (this.Snake.body[0].y > this.Sketcher.snakeboard.height -10)
        head = {x: this.Snake.body[0].x, y: 0 };
      else if (this.Snake.body[0].x < 0)
        head = {x: this.Sketcher.snakeboard.width -10, y: this.Snake.body[0].y};
      else 
        head = {x: this.Snake.body[0].x + this.dx, y: this.Snake.body[0].y + this.dy};
      // Aggiungo questa testa appena creata incima al mio array Snake
      this.Snake.body.unshift(head);

      // se le coordinate della testa del serpente sono le stesse della mela
      if (this.Snake.body[0].x === this.Food.food_x && this.Snake.body[0].y === this.Food.food_y) {
        // Incremento il punteggio
        this.stat.score+=1;
        // genero una nuova mela
        this.Food.gen_food(this.Sketcher.snakeboard,this.Snake);
		this.stat.updateStat();
		this.difficulty();
        // altrimenti
      } else
        // rimuovo l'ultimo elemento dell'array serpente, perchè altrimenti si
        // allungherebbe ogni volta che si muove
        this.Snake.body.pop();
      
    }
	
Controller.prototype.start =
	function(){
		updateButtonStatus();
		this.stat = new Stat();
		document.getElementById("gameModality").disabled=true;
		document.addEventListener("keydown", this.change_direction.bind(this));
		this.Food.gen_food(this.Sketcher.snakeboard,this.Snake);
        this.interval= setInterval(this.ontick.bind(this), this.velocita); 
    }
	
Controller.prototype.difficulty=
	function(){
		this.velocita= ((game.stat.score)>55)? this.velocita : this.velocita-2;
		clearInterval(this.interval);
		this.interval= setInterval(this.ontick.bind(this), this.velocita); 		
	}
	
Controller.prototype.gameOver =
	function() {
		clearInterval(this.interval);
		endOfGame();
		document.getElementById('start').disabled = false;
		document.getElementById("gameModality").disabled=false;
		this.stat.updateRecord();
		this.stat.score = 0;
		this.stat.updateStat();
	}
	
function endOfGame(){
		var form = document.getElementById('mioForm');
		form.elements[0].value = game.stat.recordPers;
		form.elements[1].value = game.stat.score;
		form.elements[2].value = game.stat.recordTot;
		form.submit();
	}
	
Controller.prototype.pause = 
	function() {
		updateButtonStatus();
		clearInterval(this.interval);
		this.interval = null;
	}
	
Controller.prototype.ontick =
	function(){			
			if (this.has_game_ended()){
					this.gameOver();
					return;
			}
			
            this.Sketcher.clearBoard();
            this.Sketcher.drawFood(this.Food);
            this.Sketcher.drawSnake(this.Snake);
			this.move_snake();
				
	}