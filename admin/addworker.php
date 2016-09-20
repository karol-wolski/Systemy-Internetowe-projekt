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
	else
	{
		if(isset($_POST['name']))
		{
			// Przypisanie do zmiennych danych przesłanych z formularza
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$sex = $_POST['sex'];
			$maidenname = $_POST['maidenname'];
			$email = $_POST['email'];
			$zip = $_POST['zip-code'];

			// Przypisanie danych do zmiennych sesyjnych w selu wyświetlenia ich 
			// w formularzu jak wystąpią jakieś błędy żeby user nie wpisywał wszystkiego od nowa
			$_SESSION['formname'] = $name;
			$_SESSION['surname'] = $surname;
			$_SESSION['sex'] = $sex;
			$_SESSION['maidenname'] = $maidenname;
			$_SESSION['email'] = $email;
			$_SESSION['zip'] = $zip;

			// dodanie do tablicy sesyjnej żeby móc wyświetlić w "Zawartość sesji"
			// wszystkich użytkowników dodanych w danej sesji
			

			if(!empty($name) && !empty($surname) && !empty($sex) && !empty($email) && !empty($zip))
			{
				// wyrażenia regularne 
				$regular_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
				$regular_zipcode = "/^\d{2}-\d{3}$/"; 
				$reguler_name = "/^[a-z ]+$/i";

				// Sprawdzenie czy email jest poprawny
				if(!preg_match( $regular_email, $email ))
				{
					$_SESSION['error_add'] = '<p>Email jest niepoprawny.</p>';
				}
				else if(!preg_match($regular_zipcode, $zip))
				{
					$_SESSION['error_add'] = '<p>Kod pocztowy jest niepoprawny.</p>';
				}
				else if(!preg_match($reguler_name, $name))
				{
					$_SESSION['error_add'] = '<p>Imię nie może zawierać cyfr.</p>';
				}
				else if(!preg_match($reguler_name, $surname))
				{
					$_SESSION['error_add'] = '<p>Nazwisko nie może zawierać cyfr.</p>';
				}
				// else if(!preg_match($reguler_name, $maidenname))
				// {
				// 	$_SESSION['error_add'] = '<p>Nazwisko panieńskie nie może zawierać cyfr.</p>';
				// }
				else
				{
					$sql = "INSERT INTO workers (Name, Surname, Sex, MaidenName, Email, ZipCode) VALUES ('$name', '$surname', '$sex', '$maidenname', '$email', '$zip')";
				
					$result = @$connect->query($sql);
					if($result)
					{
						$_SESSION['workers'][] = Array(
						'formname'=>$name, 
						'surname'=>$surname, 
						'sex'=>$sex, 
						'maidenname'=>$maidenname,
			        	'email'=>$email, 
			        	'zip'=>$zip
			        	);
						
						$_SESSION['counter'] = $_SESSION['counter'] + 1;
						echo 'Pracownik został dodany';
						unset($_SESSION['error_add']);
						header('Location: lastadd.php');
					}
					else
					{
						$_SESSION['error_add'] = '<p>Błąd.</p>';
						header('Location: addworker.php');
					}
				}
			}
			else
			{
				$_SESSION['error_add'] = '<p>Wszystkie pola nie zostały wypełnione</p>';
			}
		}
		$connect->close();
	}
 ?>

<?php include ("header.php"); ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	<h2>Dodaj pracownika</h2>
	<form method="POST">
		<table class="table">
		<tr>
			<td>Imię:</td>
			<td><input type="text" name="name" value="<?php if(isset($_SESSION['formname'])) echo ($_SESSION['formname']);?>"></td>
		</tr>
		<tr>
			<td>Nazwisko:</td>
			<td><input type="text"  name="surname" value="<?php if(isset($_SESSION['surname'])) echo ($_SESSION['surname']);?>"></td>
		</tr>
		<tr>
			<td>Płeć:</td>
			<td><input type="radio" <?php if(isset($_SESSION['sex']) && $_SESSION['sex'] == "mężczyzna"){echo 'checked="checked";}';}; ?>  name="sex" value="mężczyzna">Mężczyzna <br>
			<input type="radio" <?php if(isset($_SESSION['sex']) && $_SESSION['sex'] == "kobieta"){echo 'checked="checked";}';}; ?>  name="sex" value="kobieta"> Kobieta
			</td>
		</tr>
		<tr>
			<td>Nazwisko panieńskie:</td>
			<td><input type="text" value="<?php if(isset($_SESSION['maidenname'])) echo ($_SESSION['maidenname']);?>" name="maidenname"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" value="<?php if(isset($_SESSION['email'])) echo ($_SESSION['email']);?>" name="email"></td>
		</tr>
		<tr>
			<td>Kod pocztowy:</td>
			<td><input type="text" value="<?php if(isset($_SESSION['zip'])) echo ($_SESSION['zip']);?>" name="zip-code"></td>
		</tr>
	</table>
		<input type="submit" value="Dodaj pracownika">
	</form>

	<?php 
		if(isset($_SESSION['error_add']))
		{
			echo $_SESSION['error_add'];
			unset($_SESSION['error_add']);
		}
	 ?>
	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>

