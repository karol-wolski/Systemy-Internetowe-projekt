<?php 
	error_reporting(0);
	// Dołączenie pliku z danymi bazy danych
	require_once "db.php";
	
	// Połaczenie z bazą danych
	// @ nie wyświetli nam błędów 
	$connect = @new mysqli($db_host, $db_login, $db_pass, $db_name);

	// Jeśli połączenie zawiera błędy
	if($connect->connect_errno == TRUE)
	{
		echo "Error: " . $connect->connect_errno;
		echo "Description: " . $connect->connect_error;
	}
	else
	{
		session_start();
		if(isset($_POST['newlogin']))
		{
			// Przypisanie do zmiennych danych przesłanych z formularza
			$rlogin = $_POST['newlogin'];
			$rpass = $_POST['newpass'];
			$rpassconf = $_POST['passconf'];
			$rname = $_POST['name'];
			$rsurname = $_POST['surname'];

			$query = mysql_query("SELECT Login FROM Users WHERE Login like '$rlogin'");

			if(!empty($rlogin) && !empty($rpass) && !empty($rpassconf) && !empty($rname) && !empty($rsurname))
			{
				// Sprawdzenie czy hasła są identyczne
				if(($rpass) != ($rpassconf))
				{
					echo $_SESSION['error_register'] = '<span>Hasła nie są identyczne.</span>';
				//	$success = false;
				}
				// Sprawdzenie czy login nie ma mniej niż 6 znaków
				else if(strlen($rlogin) < 6)
				{
					echo $_SESSION['error_register'] = '<span>Login ma mniej niż 6 znaków.</span>';
				}
				// Sprawdzenie czy hasło nie ma mniej niż 6 znaków
				else if(strlen($rpass) < 6)
				{
					echo $_SESSION['error_register'] = '<span>Hasło ma mniej niż 6 znaków.</span>';
				}

				else if(mysql_num_rows($query) != 0)
				{
					$_SESSION['error_register'] = '<span>Login jest już zajęty.</span>';
				}
				// Sprawdzenie czy w bazie istnieje już użytkownik o podanym loginie
				else
				{
                	$sql = "INSERT INTO Users (Name, Surname, Login, Password, Permissions) VALUES ('$rname', '$rsurname', '$rlogin', '$rpass', '0')";
				
					$result = @$connect->query($sql);
					if($result)
					{
						$_SESSION['registration'] = TRUE;
						$_SESSION['reg_name'] = $rname;
						unset($_SESSION['error_register']);
					}
					else
					{
						$_SESSION['error_register'] = '<span>Błąd.</span>';
					}
				}
			}
			else
			{
				$_SESSION['error_register'] = '<span>Wszystkie pola nie zostały wypełnione</span>';
			}
		}
		else
		{
			$_SESSION['error_register'] = 'Wszystkie pola nie zostały wypełnione';
		}
		$connect->close();		
	}
 ?>

<?php include ("header.php"); ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	
	<form method="POST">
		<table class="table">
		<tr>
			<td>Login:</td>
			<td><input type="text" name="newlogin"></td>
		</tr>
		<tr>
			<td>Hasło:</td>
			<td><input type="password" name="newpass"></td>
		</tr>
		<tr>
			<td>Powtórz hasło:</td>
			<td><input type="password" name="passconf"></td>
		</tr>
		<tr>
			<td>Imię:</td>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<td>Nazwisko:</td>
			<td><input type="text" name="surname"></td>
		</tr>
	</table>
		<input type="submit" class="button" value="Zarejestruj się">
	</form>

	<?php 
		if(isset($_SESSION['error_register']))
		{
			echo $_SESSION['error_register'];
			unset($_SESSION['error_register']);
		}
	 ?>

	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>