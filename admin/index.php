<?php include ("header.php"); ?>
<?php 
	if(!isset($_SESSION['logged']))
	{
		header('Location: ../index.php');
		exit();
	}
 ?>
<?php include ("sidebar-left.php"); ?>
<?php include ("content.php"); ?>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>