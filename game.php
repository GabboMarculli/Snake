<!DOCTYPE html>
<?php 
	function Logged() {
		if (isset($_SESSION["Login"]))
			return true;
		else 
			return false;
	}

	session_start();
	if(!Logged())
		header("Location: index.html");
?>
<html lang="it">
	<head>	
		<meta charset="utf-8"> 
		<title>Snake</title>
		<link rel="shortcut icon" type="image/x-icon" href="./css/immagini/snakeIcon.png">
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen">
		<script type="text/javascript" src="./js/controller.js"></script>
		<script type="text/javascript" src="./js/sketcher.js"></script>
		<script type="text/javascript" src="./js/food.js"></script>
		<script type="text/javascript" src="./js/game.js"></script>
		<script type="text/javascript" src="./js/snake.js"></script>
		<script type="text/javascript" src="./js/stat.js"></script>
	</head>
	<body>
		<audio id="canzone">
 				<source src="./suoni/Snake.mp3" type="audio/mpeg">
		</audio>
		
		<div id="buttonWrapper">
			<button class="bottone" id="start" onclick="game.start()">START</button>
			<a href="logout.php">LOGOUT</a>
			<a href="classifica.php">CLASSIFICA</a>
			<a href="istruzioni.html">ISTRUZIONI</a>
			<button class="bottone" id="pausa" onclick="game.pause()" disabled>PAUSA</button>			
		</div>
		
		<div id="modalita" class="rettangolo">
			<p>MODALITA' DI GIOCO<p>
				<select name="gameModality" id="gameModality" onchange="game.changeModality()">
					<option value="0">Con effetto 'pacman'</option>
					<option value="1">Con i bordi</option>
				</select>
		</div>
		
		<br>
		<div id='statistiche'>
			<?php 
				$servername = "localhost";
				$username = "root";
				$password = "";
				$DBname = "snake";

				$connection = new mysqli($servername, $username, $password, $DBname);

				if ($connection->connect_error)
					die("connessione fallita: " . $connection->connect_error);

				$recordPersonale = 0;
				$recordTotale = 0;
				$sql = "SELECT record FROM Utente U WHERE U.userName = '" . $_SESSION['var'] . "';";
				$sql2 = "SELECT MAX(U.record) as massimo FROM Utente U;";
				

				if($result = $connection->query($sql)){
					while ($row = $result->fetch_assoc())
					$recordPersonale = $row["record"];
				}

				if ($result2 = $connection->query($sql2)){
					while ($row2 = $result2->fetch_assoc())
					$recordTotale = $row2["massimo"];
				}


				$connection->close();

			 ?>			 
			<div>
				Punteggio:
				<span>0</span>
			</div>
			<div>
				Record Personale:
				<span><?php echo $recordPersonale; ?></span>
				<form id="mioForm" action="transizione.php" method="post">
					<input type="hidden" name="recordInput" value="">
					<input type="hidden" name="punteggio" value="">
					<input type="hidden" name="maxScore" value="">
				</form>
			</div>
			<div>
				Record Generale:
				<span><?php echo $recordTotale; ?></span>
			</div>
		</div>
		
		<div id="wrapper">
			 <canvas id="snakeboard" width="400" height="400"></canvas>
		</div>
	</body>
</html>