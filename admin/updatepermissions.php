<?php 
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
	else
	{
		$permissions = $_POST['Permissions'];
		$id = $_POST['uid'];
	            	
     	$sql = "UPDATE Users SET Permissions = '$permissions'  WHERE ID = '$id'";
	
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
			echo $_SESSION['error_update_permissions'] = '<span>Błąd.</span>';
			header('Location: edituser.php');
		}
	}
		$connect->close();
 ?>