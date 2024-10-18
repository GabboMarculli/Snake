function Stat() {
	this.score = 0;
	this.recordPers = Number(document.getElementsByTagName('span')[1].firstChild.nodeValue);
	this.recordTot = Number(document.getElementsByTagName('span')[2].firstChild.nodeValue);
}

Stat.prototype.updateStat =
	function() {
		var span = document.getElementsByTagName('span');
		span[0].firstChild.nodeValue = this.score;
	}

Stat.prototype.updateRecord =
	function() {
		var span = document.getElementsByTagName('span');
		if (game.stat.score > game.stat.recordPers) {
			game.stat.recordPers = game.stat.score;
			span[1].firstChild.nodeValue = game.stat.recordPers;
		}

		if (game.stat.recordPers > game.stat.recordTot){
			game.stat.recordTot = game.stat.recordPers;
			span[2].firstChild.nodeValue = game.stat.recordTot;
		}
	}