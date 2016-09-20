<?php include ("header.php"); ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	<h2>Dodana osoba</h2>
	<hr>
	<p>Imię: 
	<?php if (isset($_SESSION['formname'])) 
	{
		echo ($_SESSION['formname']);
	} ?>
	</p>
	<p>Nazwisko
<?php if (isset($_SESSION['surname'])) 
	{
		echo ($_SESSION['surname']);
	} ?>
	</p>
	<p>Płeć
<?php if (isset($_SESSION['sex'])) 
	{
		echo ($_SESSION['sex']);
	} ?>
	</p>
	<p>Nazwisko panieńskie
<?php if (isset($_SESSION['maidenname'])) 
	{
		echo ($_SESSION['maidenname']);
	} ?>
	</p>
	<p>Email
<?php if (isset($_SESSION['email'])) 
	{
		echo ($_SESSION['email']);
	} ?>
	</p>
	<p>Kod pocztowy
<?php if (isset($_SESSION['zip'])) 
	{
		echo ($_SESSION['zip']);
	} ?>
	</p>
	<?php 
	unset($_SESSION['formname']);
	unset($_SESSION['surname']);
	unset($_SESSION['sex']);
	unset($_SESSION['maidenname']);
	unset($_SESSION['email']);
	unset($_SESSION['zip']);
	 ?>
	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>