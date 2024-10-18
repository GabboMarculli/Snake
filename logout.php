<!DOCTYPE html>

<?php 
	session_start();
	unset($_SESSION['Login']);
	session_destroy();
	header("Location: index.html")
 ?>

<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>SNAKE LOGOUT</title>
		<link rel="shortcut icon" type="image/x-icon" href="./css/immagini/snakeIcon.png">
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen">
	</head>
</html>