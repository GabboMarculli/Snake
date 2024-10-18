<!DOCTYPE html>

<?php session_start(); ?>

<html lang="it">
	<head>
		<meta charset="utf-8">
		<title> HIGHSCORE</title>
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen">
	</head>
	<body>
		<div id="registrazione2">
			<table>
				<caption>
					<h1>CLASSIFICA</h1>
				</caption>
				<thead>
					<tr><th>UserName</th><th>Punteggio</th></tr>
				</thead>
				<tbody>
					<?php
						$servername = "localhost";
						$username = "root";
						$DBpassword = "";
						$DBname = "snake";

						$connection = new mysqli($servername, $username, $DBpassword, $DBname);

						if ($connection->connect_error)
							die("connessione fallita: " . $connection->connect_error);

						$sql = "SELECT U.userName, U.record FROM Utente U ORDER BY U.record DESC;";

						// stampo la classifica che mi son preso dal server
						if($result = $connection->query($sql)){
							while ($row = $result->fetch_assoc())
							echo "<tr><td>".$row["userName"]."</td><td>".$row["record"]."</td></tr>";
						}

						$connection->close();
					?>
				</tbody>
			</table>
		</div>
		<a id="classifica" href="game.php">Torna al gioco</a>
	</body>
</html>