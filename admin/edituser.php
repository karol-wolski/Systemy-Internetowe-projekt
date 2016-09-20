<?php 
	error_reporting(0);
	session_start();
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
	else if(isset($_POST['newlogin']))
	{
		// Przypisanie do zmiennych danych przesłanych z registration.php
		$rlogin = $_POST['newlogin'];
		$rpass = $_POST['newpass'];
		$rpassconf = $_POST['passconf'];
		$rname = $_POST['name'];
		$rsurname = $_POST['surname'];
		$edytuj = $_POST['edytuj'];
		$permissions = $_POST['permissions'];
		$id = $_POST['uid'];

		if($edytuj == "Aktualizuj pracownika")
		{
		if(!empty($rlogin) && !empty($rpass) && !empty($rpassconf) && !empty($rname) && !empty($rsurname))
		{
			// Sprawdzenie czy hasła są identyczne
			if(($rpass) != ($rpassconf))
			{
				$_SESSION['error_edit'] = '<span>Hasła nie są identyczne.</span>';
			}
			// Sprawdzenie czy login nie ma mniej niż 6 znaków
			else if(strlen($rlogin) < 6)
			{
				$_SESSION['error_edit'] = '<span>Login ma mniej niż 6 znaków.</span>';
			}
			// Sprawdzenie czy hasło nie ma mniej niż 6 znaków
			else if(strlen($rpass) < 6)
			{
				$_SESSION['error_edit'] = '<span>Hasło ma mniej niż 6 znaków.</span>';
			}
			// Sprawdzenie czy w bazie istnieje już użytkownik o podanym loginie
			else
			{	
            	$sql = "UPDATE Users SET Name = '$rname', Surname = '$rsurname', Login = '$rlogin', Password = '$rpass', Permissions = '$permissions'  WHERE ID = '$id'";
			
				$result = @$connect->query($sql);
				if($result)
				{
					unset($_SESSION['error_register']);
					unset($_SESSION['error_edit']);
					echo $_SESSION['edit_success'] = 'Użytkownik został zmodyfikowany';
					header('Location: index.php');
				}
				else
				{
					$_SESSION['error_edit'] = '<span>Błąd.</span>';
				}
			}
		}
		else
		{
			$_SESSION['error_edit'] = '<span>Wszystkie pola nie zostały wypełnione</span>';
		}
	}	
		$connect->close();	
	}
 ?>
<?php include ("header.php"); ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	<?php 
		require_once "db.php";
		$connect = mysql_connect($db_host, $db_login, $db_pass);
		mysql_select_db("SIlab", $connect);
		$id=$_SESSION['id'];
		//echo $id;
		$query=mysql_query(" SELECT * FROM users WHERE id='$id'");

		while($row = mysql_fetch_array($query)){
			$permissions = $row['Permissions'];
		
	 ?>
	<form method="POST">
		<table class="table">
		<tr>
			<td>Login:</td>
			<td><input type="text" value="<?php echo $row['Login'];?>" name="newlogin"></td>
		</tr>
		<tr>
			<td>Hasło:</td>
			<td><input type="password" value="<?php echo $row['Password'];?>" name="newpass"></td>
		</tr>
		<tr>
			<td>Powtórz hasło:</td>
			<td><input type="password" value="<?php echo $row['Password'];?>" name="passconf"></td>
		</tr>
		<tr>
			<td>Imię:</td>
			<td><input type="text" value="<?php echo $row['Name'];?>" name="name"></td>
		</tr>
		<tr>
			<td>Nazwisko:</td>
			<td><input type="text" value="<?php echo $row['Surname'];?>" name="surname"></td>
		</tr>
	</table>

		<input type="hidden" name="uid" value="<?php echo $id; ?>">
		<input type="hidden" name="permissions" value="<?php echo $permissions; ?>">
		<input type="submit" name="edytuj" value="Aktualizuj pracownika">
		<input type="submit" name="edytuj" value="Odrzuć zmiany">
	</form>

	<?php 
		}
		if(isset($_SESSION['error_edit']))
			echo $_SESSION['error_edit'];
	 ?>

	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>