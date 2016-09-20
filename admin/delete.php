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

			$sql = "DELETE FROM workers WHERE ID = '$id'";
				
			$result = @$connect->query($sql);
			if($result)
			{
				echo 'Pracownik został usunięty';
				unset($_SESSION['error_del_workers']);
				header('Location: delworker.php');
			}
			else
			{
				echo $_SESSION['error_del_workers'] = '<span>Błąd.</span>';
				header('Location: delworker.php');
			}
		}
		else
		{
			header('Location: delworker.php');
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
		$id=$_GET['delete'];
		//echo $id;
		$query=mysql_query(" SELECT * FROM workers WHERE id='$id'");

		while($row = mysql_fetch_array($query)){		
	 ?>
	<form method="POST">
		<table class="table">
		<tr>
			<td>Czy na pewno chcesz usunąć pracownika?</td>
			<td><input type="hidden" name="uid" value="<?php echo $id; ?>"></td>
		</tr>
		</table>
		<input type="submit" name="usun" value="Tak">
		<input type="submit" name="usun" value="Nie">
	</form>

	<?php 
		} // koniec while
		if(isset($_SESSION['error_del_workers']))
			echo $_SESSION['error_del_workers'];
	 ?>

	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>