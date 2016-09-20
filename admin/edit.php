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
	else if(isset($_POST['name']))
	{
		$id = $_POST['uid'];
		$edit = $_POST['uid'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$sex = $_POST['sex'];
		$maidenname = $_POST['maidenname'];
		$email = $_POST['Email'];
		$zip = $_POST['zip-code'];

		$_SESSION['formname'] = $name;
		$_SESSION['surname'] = $surname;
		$_SESSION['sex'] = $sex;
		$_SESSION['maidenname'] = $maidenname;
		$_SESSION['email'] = $email;
		$_SESSION['zip'] = $zip;

		$edytuj = $_POST['edytuj'];

		if ($edytuj == "Aktualizuj pracownika") 
		{
			if(!empty($name) && !empty($surname) && !empty($sex) && !empty($email) && !empty($zip))
			{
				$regular_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
				$regular_zipcode = "/^\d{2}-\d{3}$/"; 

				// Sprawdzenie czy email jest poprawny
				if(!preg_match( $regular_email, $email ))
				{
					echo $_SESSION['error_edit'] = '<span>Email jest niepoprawny.</span>';
					header("Location: edit.php?edit=".$id."");
				}
				else if(!preg_match($regular_zipcode, $zip))
				{
					echo $_SESSION['error_edit'] = '<span>Kod pocztowy jest niepoprawny.</span>';
					header("Location: edit.php?edit=".$id."");
				}
				else
				{
					$sql = "UPDATE workers SET Name = '$name' , Surname = '$surname' , Sex = '$sex' , MaidenName = '$maidenname' , Email = '$email', ZipCode = '$zip' WHERE ID = '$id'";
				
					$result = @$connect->query($sql);
					if($result)
					{
						unset($_SESSION['formname']);
						unset($_SESSION['surname']);
						unset($_SESSION['sex']);
						unset($_SESSION['maidenname']);
						unset($_SESSION['email']);
						unset($_SESSION['zip']);
						unset($_SESSION['error_edit']);
						echo 'Pracownik został uaktualniony';
						header('Location: editworker.php');
					}
					else
					{
						echo $_SESSION['error_edit'] = '<span>Błąd.</span>';
						header("Location: edit.php?edit=".$id."");
					}
				}
			}
			else
			{
				echo $_SESSION['error_edit'] = '<span>Wszystkie pola nie zostały wypełnione</span>';
				header("Location: edit.php?edit=".$id."");
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
		$id=$_GET['edit'];
		//echo $id;
		$query=mysql_query(" SELECT * FROM workers WHERE id='$id'");

		while($row = mysql_fetch_array($query)){
			echo $row['Name'];
		
	 ?>
	<form method="POST">
		<table class="table">
		<tr>
			<td>Imię:</td>
			<td><input type="text" name="name" value="<?php echo $row['Name'];?>"></td>
		</tr>
		<tr>
			<td>Nazwisko:</td>
			<td><input type="text"  name="surname" value="<?php echo $row['Surname'];?>"></td>
		</tr>
		<tr>
			<td>Płeć:</td>
			<td><input type="radio" <?php if($row['Sex'] === "mężczyzna"){echo 'checked="checked";}';}; ?>  name="sex" value="mężczyzna">Mężczyzna <br>
			<input type="radio" <?php if($row['Sex'] === "kobieta"){echo 'checked="checked";}';}; ?>  name="sex" value="kobieta"> Kobieta
			</td>
		</tr>
		<tr>
			<td>Nazwisko panieńskie:</td>
			<td><input type="text" value="<?php echo $row['MaidenName'];?>" name="maidenname"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" value="<?php echo $row['Email'];?>" name="Email"></td>
		</tr>
		<tr>
			<td>Kod pocztowy:</td>
			<td><input type="text" value="<?php echo $row['ZipCode'];?>" name="zip-code"></td>
		</tr>
	</table>

		<input type="hidden" name="uid" value="<?php echo $id; ?>">
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