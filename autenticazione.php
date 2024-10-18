<!DOCTYPE html>

<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>SNAKE LOGIN</title>
		<link rel="shortcut icon" type="image/x-icon" href="./css/immagini/snakeIcon.png">
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen">
	</head>
	<body>
		<div id="registrazione">
			<?php 
				$servername = "localhost";
				$username = "root";
				$DBpassword = "";
				$DBname = "snake";

				$connection = new mysqli($servername, $username, $DBpassword, $DBname);

				if ($connection->connect_error)
					die("connessione fallita: " . $connection->connect_error);

				$utente = $_POST["userNameLog"];
				$password = $_POST["passwordLog"];

				$sql = "SELECT password FROM Utente U WHERE U.userName = '" .$utente."';";
				$result = $connection->query($sql);

				if (mysqli_num_rows($result) === 0) {
					echo "<h1>Sicuro di essere registrato?</h1><br>";
					echo "<a href='index.html'>Registrati</a>";
					echo "<a href='login.html'>Riprova</a>";
				}


				while ($row = $result->fetch_assoc()) {
					if ($password === $row['password']) {
						session_start();
						$_SESSION["var"] = $utente;
						$_SESSION["Login"] = "YES";
						header("Location: game.php");
					}
					else {
						echo "<h1>Hai sbagliato la password!</h1><br>";
						echo "<a href='login.html'>Riprova il login</a>";
					}
				}

				$connection->close();
			?>
		</div>