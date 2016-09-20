<?php 	
	error_reporting(0);
	require_once "admin/db.php";
	
	// Połaczenie z bazą danych
	$connect = @new mysqli($db_host, $db_login, $db_pass, $db_name);

	// Jeśli połączenie zawiera błędy
	if($connect->connect_errno == TRUE)
	{
		echo "Error: " . $connect->connect_errno;
		echo "Description: " . $connect->connect_error;
	}
	else
	{
		if(isset($_POST['login']))
		{	
			session_start();
			// Przypisanie do zmiennych danych przesłanych z signin.php
			$login = $_POST['login'];
			$pass = $_POST['pass'];

			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			$pass = htmlentities($pass, ENT_QUOTES, "UTF-8");

			$sql = "SELECT * FROM Users WHERE Login = '$login' AND Password = '$pass'";

			if($result = @$connect->query($sql))
			{
				$num_user = $result->num_rows;
				if($num_user == 1)
				{
				$_SESSION['logged'] = TRUE;
				$row = $result->fetch_assoc();

				$_SESSION['id'] = $row['ID'];
				$_SESSION['user'] = $row['Login'];
				$_SESSION['name'] = $row['Name'];
				$_SESSION['permission'] = $row['Permissions'];
				
				// Jeśli udało się zalogować to zmienna $_SESSION['error'] zostanie usunięta
				unset($_SESSION['error']);
				$result->free();
				header('Location: admin/index.php');
				}
				else
				{
					$_SESSION['error'] = '<span>Nieprawidłowy login lub hasło, Spróbuj ponownie</span>';
				}
			}
		}
		$connect->close();
	}
 ?>

<?php include ("header.php"); ?>
<?php 
	if(isset($_SESSION['logged']) && ($_SESSION['logged'] == true))
	{
		header('Location: admin/index.php');
		exit();
	}
 ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	<form method="POST">
		<input type="text" name="login" placeholder="Login">
		<br>
		<input type="password" name="pass" placeholder="Password">
		<br>
		<input type="submit" value="Zaloguj się">
	</form>

	<?php 
		if(isset($_SESSION['error']))
			echo $_SESSION['error'];
	 ?>

	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("footer.php"); ?>