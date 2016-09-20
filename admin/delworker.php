<?php 
	error_reporting(0);
 ?>
<?php include ("header.php"); ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	<h2>Usuwanie Pracowników</h2>
	<br>
	<hr>
	<table style="width:100%">
		<thead>
			<tr>
				<th>Usuń</th>
				<th>ID</th>
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
			require_once "db.php";
			$connect = mysql_connect($db_host, $db_login, $db_pass);
			mysql_select_db("SIlab", $connect); 

			$start=0;
			$limit=2;

			if(isset($_GET['id']))
			{
				$id=$_GET['id'];
				$start=($id-1)*$limit;
			}	
			$sql = mysql_query("SELECT * FROM workers ORDER BY id ASC LIMIT $start, $limit");

			$delete_site = "delete.php";
			while($row = mysql_fetch_array($sql))
			{
				$del = $row['ID'];
				echo '<tr><td>' . "<a href=\"". $delete_site ."?delete=".$del."\">Usuń</a>" . '</td>';
				echo '<td>' . $row['ID'] . '</td>';
				echo '<td>' . $row['Name'] . '</td>';
				echo '<td>' . $row['Surname'] . '</td>';
				echo '<td>' . $row['Sex'] . '</td>';
				echo '<td>' . $row['MaidenName'] . '</td>';
				echo '<td>' . $row['Email'] . '</td>';
				echo '<td>' . $row['ZipCode']. '</td></tr>';	
			}
			?>
			</tr>
		</tbody>
	<?php  ?>
	</table>
	<br>
	<hr>
	<br>
	<?php
		$rows=mysql_num_rows(mysql_query("select * from workers"));
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

