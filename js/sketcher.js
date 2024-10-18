function Sketcher(board){
	this.snakeboard=board;
	this.snakeboard_ctx= board.getContext("2d");
}

Sketcher.prototype.drawFood  =
	function(Food){
      this.snakeboard_ctx.fillStyle = 'red';
      this.snakeboard_ctx.strokestyle = 'red';
      this.snakeboard_ctx.fillRect(Food.food_x, Food.food_y, 10, 10);
      this.snakeboard_ctx.strokeRect(Food.food_x, Food.food_y, 10, 10);
    }
	
Sketcher.prototype.drawSnakePart =
	function(snakePart){
      // riempio un quadrato del serpente di verde
      this.snakeboard.getContext("2d").fillStyle ='green';
      // coloro il bordo del quadrato di verde
      this.snakeboard.getContext("2d").strokestyle = 'green';
      // Disegno il quadrato in posizione di coordinate x ed y identiche a quelle
      // x ed y del serpente, e ogni quadrato è largo 10 e alto 10
      this.snakeboard.getContext("2d").fillRect(snakePart.x, snakePart.y, 10, 10);
      // Disegno il bordo di quel quadrato
      this.snakeboard.getContext("2d").strokeRect(snakePart.x, snakePart.y, 10, 10);
    }
	
Sketcher.prototype.clearBoard =
	function(modalita){
	  // il colore con cui la riempio è il nero
      this.snakeboard_ctx.fillStyle = 'black';
      // la tela avrà bordo nero
		this.snakeboard_ctx.strokestyle ='black';
      // la faccio rettangolare
      this.snakeboard_ctx.fillRect(0, 0, this.snakeboard.width, this.snakeboard.height);
      // disegno anche un bordo
      this.snakeboard_ctx.strokeRect(10, 10, this.snakeboard.width, this.snakeboard.height);
    }
	
Sketcher.prototype.drawSnake=
	function(Snake){
		Snake.body.forEach(this.drawSnakePart);
	}