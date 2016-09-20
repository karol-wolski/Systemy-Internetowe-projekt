		<div class="sidebar-left">
			<nav class="navigation-left">
				<ul>
					<?php 
	if(!isset($_SESSION['logged']) || ($_SESSION['permission']) == '0')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		';
	}
	else if(isset($_SESSION['logged']) && ($_SESSION['permission']) == '1')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		<li><a href="admin/addworker.php">Formularz</a></li>
		<li><a href="">Zawartość sesji</a></li>
		<li><a href="admin/showworkers.php">Baza pracowników</a></li>
		<li><a href="admin/edituser.php">Zmień dane</a></li>
		';
	}
	else if(isset($_SESSION['logged']) && ($_SESSION['permission']) == '2')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		<li><a href="admin/addworker.php">Formularz</a></li>
		<li><a href="">Zawartość sesji</a></li>
		<li><a href="admin/showworkers.php">Baza pracowników</a></li>
		<li><a href="admin/editworker.php">Edycja pracownika</a></li>
		<li><a href="admin/edituser.php">Zmień dane</a></li>
		';
	}
	else if(isset($_SESSION['logged']) && ($_SESSION['permission']) == '3')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		<li><a href="admin/addworker.php">Formularz</a></li>
		<li><a href="">Zawartość sesji</a></li>
		<li><a href="admin/showworkers.php">Baza pracowników</a></li>
		<li><a href="admin/editworker.php">Edycja pracownika</a></li>
		<li><a href="admin/delworker.php">Usunięcie pracownika</a></li>
		<li><a href="admin/edituser.php">Zmień dane</a></li>
		';
	}
	else if(isset($_SESSION['logged']) && isset($_SESSION['permission']) == '4')
	{
		echo'
		<li><a href="index.php">Strona Główna</a></li>
		<li><a href="admin/addworker.php">Formularz</a></li>
		<li><a href="">Zawartość sesji</a></li>
		<li><a href="admin/showworkers.php">Baza pracowników</a></li>
		<li><a href="admin/editworker.php">Edycja pracownika</a></li>
		<li><a href="admin/delworker.php">Usunięcie pracownika</a></li>
		<li><a href="admin/edituser.php">Zmień dane</a></li>
		<li><a href="admin/editpermissions.php">Zmień poziom dostępu</a></li>
		<li><a href="admin/deluser.php">Usuń użytkownika</a></li>
		';
	}
 ?>
				</ul>
			</nav>	
		</div>

