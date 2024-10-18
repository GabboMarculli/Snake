<!DOCTYPE html>

<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>SNAKE REGISTRATION</title>
		<link rel="shortcut icon" type="image/x-icon" href="./css/immagini/snakeIcon.png">
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen">
	</head>
	<body>
		<div id="registrazione">
			<?php
				// parametri che invio per la connessione, sono sempre questi circa
				$servername = "localhost"; //questo indica che il server sono io
				$username = "root";
				$DBpassword = "";
				$DBname = "snake";
				
				// parametri per la connessione, sono sempre questi circa
				$connection = new mysqli($servername, $username, $DBpassword, $DBname);

				// se la connessone è fallita, esco dalla pagina con un messaggio d'errore
				if ($connection->connect_error)
					die("connessione fallita: " . $connection->connect_error);

				// verifica che i campi siano stati riempiti, altrimenti stampa quell'errore
				if ($_POST["userNameReg"] === "" || $_POST["passwordReg"] === "") {
					echo "<h2>Errore: UserName o password assenti!</h2><br>";
					echo "<a href='index.html'>Riprova!</a>";
					exit; // uguale a die
				}
				
				// inserisco in queste variabili i parametri inseriti
				$utente = $_POST["userNameReg"];
				$password = $_POST["passwordReg"];
				$record = 0;

				// faccio una query per vedere se c'è già un utente con quel nome
				$sql = "INSERT INTO Utente VALUES ('".$utente."','".$password."',".$record.");";

				// se non c'è, e nessuno collide sulla chiave, lo inserisco
				if ($connection->query($sql) === TRUE) {
					echo "<h2>registrazione avvenuta con successo!</h2><br>";
				}
				else {	// altrimenti è errore
					echo "<h2>Un altro giocatore si chiama cosi!</h2>";
					echo "<a href='index.html'>Riprova a registrarti</a>";
				}

				// chiudo la connessione al server
				$connection->close();
			?>

			<a href="login.html">Login</a>
		</div>
	</body>
</html>