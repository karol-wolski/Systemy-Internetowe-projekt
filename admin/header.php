<?php 
	session_start();
	if(!isset($_SESSION['logged']))
	{
		header('Location: ../signin.php');
		exit();
	}
 ?>
<!DOCTYPE HTML>
<html lang=”pl”>
	<head>
		<meta charset = "utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="../css/style.css">
		<title>Zadanie Laboratoryjne</title>
	</head>
	<body>
		<header>
			<h2>Systemy Internetowe</h2>
		</header>
	<div class="body">