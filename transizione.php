<!DOCTYPE html>

<?php session_start(); ?>

<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>SNAKE RESULT</title>
		<link rel="shortcut icon" type="image/x-icon" href="./css/immagini/snakeIcon.png">
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen">
	</head>
	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$DBname = "snake";

			$connection = new mysqli($servername, $username, $password, $DBname);

			if ($connection->connect_error)
				die("connessione fallita: " . $connection->connect_error);

			$sql = "UPDATE Utente SET record = ".$_POST["punteggio"]." WHERE userName = '".$_SESSION["var"]."';";

 			
 			if ($_POST["punteggio"] > $_POST["maxScore"]) {
 				if ($connection->query($sql) === TRUE) {
 					echo "<div id='transizione'>";
 					echo "<h1>NEW HIGH SCORE!!!!!!!!!!!</h1><br><h2>Score: ".$_POST["punteggio"]."</h2><br>";
					echo "<a href='game.php'>RIGIOCA</a>";
 					echo "<a href='logout.php'>ESCI</a>";
 					echo "<a href='classifica.php'>CLASSIFICA</a>";
 					echo "</div>";
 				}
 			}
 			if ($_POST["punteggio"] > $_POST["recordInput"] && $_POST["punteggio"] < $_POST["maxScore"]) {
 				if ($connection->query($sql) === TRUE) {
	 				echo "<div id='transizione'>";
	 				echo "<h1>New Personal Record!!!!!!!</h1><br><h2>Score: ".$_POST["punteggio"]."</h2><br>";
					echo "<a href='game.php'>RIGIOCA</a>";
	 				echo "<a href='logout.php'>ESCI</a>";
	 				echo "<a href='classifica.php'>CLASSIFICA</a>";
	 				echo "</div>";
	 			}
 			}
 			if ($_POST["punteggio"] <= $_POST["recordInput"]) {
				echo "<div id='transizione'>";
 				echo "<h1>Hai ottenuto ".$_POST["punteggio"]." punti!!!</h1>";
 				echo "<a href='game.php'>RIGIOCA</a>";
 				echo "<a href='logout.php'>ESCI</a>";
 				echo "<a href='classifica.php'>CLASSIFICA</a>";
 				echo "</div>";
 			}

			$connection->close();

		 ?>
	</body>
</html>




