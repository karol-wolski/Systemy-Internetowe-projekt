<div class="main">
			<?php 
	if(!isset($_SESSION['reg_name']))
	{
		echo '<p>To jest strona główna.</p>';
	}
	else
	{
		echo "<p>Zarejestrowano użytkownika: " . $_SESSION['reg_name'] . "!</p>";
		//unset($_SESSION['registration']);
	}
 ?>
		</div>