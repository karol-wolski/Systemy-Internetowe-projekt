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
	else if(isset($_POST['usun']))
	{
		$usun = $_POST['usun'];
		if ($usun == 'Tak') 
		{
			$id = $_POST['uid'];
			$Permissions = $_POST['Permissions'];
			if ($Permissions == '4')
			{
				echo $_SESSION['error_del_user'] = '<span>Nie możesz usunąć administratora.</span>';
					header('Location: deluser.php');
			}
			else
			{
				$sql = "DELETE FROM users WHERE ID = '$id'";
					
				$result = @$connect->query($sql);
				if($result)
				{
					echo 'Użytkownik został usunięty';
					unset($_SESSION['error_del_user']);
					header('Location: deluser.php');
				}
				else
				{
					echo $_SESSION['error_del_user'] = '<span>Błąd.</span>';
					header('Location: deluser.php');
				}
			}
		}
		else
		{
			header('Location: deluser.php');
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
		mysql_select_db("SIlab", $connect); // wprowadź tutaj nazwę swojej tabeli zamiast "SIlab"
		$id=$_GET['deleteu'];
		$query=mysql_query("SELECT * FROM users WHERE id='$id'");
		while($row = mysql_fetch_array($query)){		
		$Permissions =  $row['Permissions'];
	 ?>
	<form  method="POST">
		<table class="table">
		<tr>
			<td>Czy na pewno chcesz usunąć użytkownika?</td>
			<td><input type="hidden" name="uid" value="<?php echo $id; ?>"></td>
			<td><input type="hidden" name="Permissions" value="<?php echo $Permissions; ?>"></td>
		</tr>
		</table>
		<input type="submit" name="usun" value="Tak">
		<input type="submit" name="usun" value="Nie">
	</form>

	<?php 
		} // koniec while
		if(isset($_SESSION['error_del_user']))
			echo $_SESSION['error_del_user'];
	 ?>

	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>