<?php 
	error_reporting(0);
	// Dołączenie pliku z danymi bazy danych
	require_once "admin/db.php";
	
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
					$_SESSION['error_register'] = '<p>Hasła nie są identyczne.</p>';
				}
				// Sprawdzenie czy login nie ma mniej niż 6 znaków
				else if(strlen($rlogin) < 6)
				{
					$_SESSION['error_register'] = '<p>Login ma mniej niż 6 znaków.</p>';
				}
				// Sprawdzenie czy hasło nie ma mniej niż 6 znaków
				else if(strlen($rpass) < 6)
				{
					$_SESSION['error_register'] = '<p>Hasło ma mniej niż 6 znaków.</p>';
				}

				else if(mysql_num_rows($query) != 0)
				{
					$_SESSION['error_register'] = '<p>Login jest już zajęty.</p>';
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
						header('Location: index.php');
					}
					else
					{
						$_SESSION['error_register'] = '<p>Błąd.</p>';
					}
				}
			}
			else
			{
				$_SESSION['error_register'] = '<p>Wszystkie pola nie zostały wypełnione</p>';
			}
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
			<td><input type="text" name="newlogin" placeholder="Login"></td>
		</tr>
		<tr>
			<td><input type="password" name="newpass" placeholder="Hasło"></td>
		</tr>
		<tr>
			<td><input type="password" name="passconf" placeholder="Powtórz hasło"></td>
		</tr>
		<tr>
			<td><input type="text" name="name" placeholder="Imię"></td>
		</tr>
		<tr>
			<td><input type="text" name="surname" placeholder="Nazwisko"></td>
		</tr>
		<tr>
			<td>
			<input type="submit" value="Zarejestruj się">	
			</td>
		</tr>
		</table>
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