<?php include ("header.php"); ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	<h2>Sesja</h2>
	<hr>
	<table style="width:100%">
		<thead>
			<tr>
				<th>Imię</th>
				<th>Nazwisko</th>
				<th>Płeć</th>
				<th>Nazwisko panieńskie</th>
				<th>Email</th>
				<th>Kod pocztowy</th>
			</tr>
		</thead>
		<tbody style="text-align:center">
                        
		<?php
		if(isset($_SESSION['workers']))
		{
			foreach($_SESSION['workers'] as $worker)
			{
				echo '<tr>
				<td>'.$worker['formname'].'</td>
				<td>'.$worker['surname'].'</td>
				<td>'.$worker['sex'].'</td>
				<td>'.$worker['maidenname'].'</td>
				<td>'.$worker['email'].'</td>
				<td>'.$worker['zip'].'</td>
				</tr>';
			}
		}
		else
		{
			echo 'Brak dodanych pracowników w sesji';
		}
		?>      
		
		</tbody>
	</table>
	<?php 
		if(isset($_SESSION['counter']) && $_SESSION['counter'] > '0')
		{
			echo 'Ilość pracowników dodanych w aktualnej sesji: ';
			echo $_SESSION['counter'];
		}
	 ?>
	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>

