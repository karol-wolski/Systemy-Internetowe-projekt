<?php 
	error_reporting(0);
 ?>
<?php include ("header.php"); ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	<h2>Usuwanie użytkownika</h2>
	<br>
	<hr>
	<table style="width:100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Imię</th>
				<th>Nazwisko</th>
				<th>Login</th>
				<th>Uprawnienia</th>
				<th>Usuń</th>
			</tr>
		</thead>
		<tbody style="text-align:center">
			<?php 
			require_once "db.php";
			$connect = mysql_connect($db_host, $db_login, $db_pass);
			mysql_select_db("SIlab", $connect);

			$start=0;
			$limit=4;

			if(isset($_GET['id']))
			{
				$id=$_GET['id'];
				$start=($id-1)*$limit;
			}	
			$sql = mysql_query("SELECT * FROM users ORDER BY id ASC LIMIT $start, $limit");

			$edit_site = "deleteu.php";
			while($row = mysql_fetch_array($sql))
			{
				$del = $row['ID'];
				
				echo '<tr><td>' . $row['ID'] . '</td>';
				echo '<td>' . $row['Name'] . '</td>';
				echo '<td>' . $row['Surname'] . '</td>';
				echo '<td>' . $row['Login'] . '</td>';
				echo '<td>' . $row['Permissions'] . '</td>';
				echo '<td>' . "<a href=\"". $edit_site ."?deleteu=".$del."\">Usuń</a>" . '</td>';
			}
			?>
			</tr>
		</tbody>
	</table>
	<br>
	<hr>
	<?php  
	if(isset($_SESSION['error_del_user']))
			echo $_SESSION['error_del_user'];
	?>
	<br>
	<?php
		$rows=mysql_num_rows(mysql_query("select * from users"));
		$total=ceil($rows/$limit);

		echo "<ul class='page'>";
		if($id>1)
		{
			echo "<li><a href='?id=".($id-1)."'>Poprzednia</a></li>";
		}
		for($i=1;$i<=$total;$i++)
		{
		if($i==$id) { echo "<li class='current'>".$i."</li>"; }

		else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
		}
		if($id!=$total)
		{
			echo "<li><a href='?id=".($id+1)."'>Następna</a></li>";
		}
		echo "</ul>";

	?>
	<br>
	</div>
<?php include ("sidebar-right.php"); ?>
<?php include ("../footer.php"); ?>

