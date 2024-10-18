function Food(){
	this.food_x;
	this.food_y;
}

Food.prototype.random_food=
	function(min,max){
      return Math.floor((Math.random() * (max-min) + min) / 10) * 10;
    }	
	
Food.prototype.gen_food=
	function (snakeboard,Snake){
	  do{
		this.food_x = this.random_food(0, snakeboard.width - 10);
		this.food_y = this.random_food(0, snakeboard.height - 10);
	  }while(!this.has_eaten_food(this.food_x,this.food_y,Snake));
    }
	
Food.prototype.has_eaten_food =
	function(x,y,snake){
		for(var i=0; i<snake.body.length; i++)
			if(snake.body[i].x == x & snake.body[i].y == y)
				return false;
				
		return true;		
	}

