		<div class="sidebar-left">
			<nav class="navigation-left">
				<ul>
					<?php 
	if(($_SESSION['permission']) == '0')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		';
	}
	else if(($_SESSION['permission']) == '1')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		<li><a href="addworker.php">Formularz</a></li>
		<li><a href="session.php">Zawartość sesji</a></li>
		<li><a href="showworkers.php?id=1">Baza pracowników</a></li>
		<li><a href="edituser.php">Zmień dane</a></li>
		';
	}
	else if(($_SESSION['permission']) == '2')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		<li><a href="addworker.php">Formularz</a></li>
		<li><a href="session.php">Zawartość sesji</a></li>
		<li><a href="showworkers.php?id=1">Baza pracowników</a></li>
		<li><a href="editworker.php">Edycja pracownika</a></li>
		<li><a href="edituser.php">Zmień dane</a></li>
		';
	}
	else if(($_SESSION['permission']) == '3')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		<li><a href="addworker.php">Formularz</a></li>
		<li><a href="session.php">Zawartość sesji</a></li>
		<li><a href="showworkers.php?id=1">Baza pracowników</a></li>
		<li><a href="editworker.php">Edycja pracownika</a></li>
		<li><a href="delworker.php">Usunięcie pracownika</a></li>
		<li><a href="edituser.php">Zmień dane</a></li>
		';
	}
	else if(($_SESSION['permission']) == '4')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		<li><a href="addworker.php">Formularz</a></li>
		<li><a href="session.php">Zawartość sesji</a></li>
		<li><a href="showworkers.php?id=1">Baza pracowników</a></li>
		<li><a href="editworker.php">Edycja pracownika</a></li>
		<li><a href="delworker.php">Usunięcie pracownika</a></li>
		<li><a href="edituser.php">Zmień dane</a></li>
		<li><a href="editpermissions.php">Zmień poziom dostępu</a></li>
		<li><a href="deluser.php">Usuń użytkownika</a></li>
		';
	}
 ?>
				</ul>
			</nav>	
		</div>

