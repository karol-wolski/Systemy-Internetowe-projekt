<?php 
	error_reporting(0);
 ?>
<?php include ("header.php"); ?>
<?php include ("sidebar-left.php"); ?>
	<div class="main">
	<h2>Wyszukiwanie po nazwisku</h2>
	<br>
	<hr>
	<table style="width:100%">
		<thead>
			<tr>
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
			$limit=5;
			//$where;
			$surname = $_POST['search'];
			$word = explode(" ", $surname);

			for($i = 0; $i < count($word); $i++)
			{
				$where .= "`surname` LIKE '%" . $word[$i] . "%'";
				if($i+1 != count($word))
				{
					$where .= " OR ";
				}
			}

			if(isset($_POST['search']))
			{
				if(strlen($_POST['search']))
				{
					$query_search = "SELECT * FROM workers WHERE $where";
				}
				else
				{
					$query_search = "SELECT * FROM workers";   
				}
			}
			$result = mysql_query($query_search);

			if(isset($_GET['id']))
			{
				$id=$_GET['id'];
				$start=($id-1)*$limit;
			}			

			$sql = mysql_query("SELECT * FROM workers ORDER BY id ASC LIMIT $start, $limit");

			while($row = mysql_fetch_row($result))
			{
				echo '<tr><td>' . $row[0] . '</td>';
				echo '<td>' . $row[1] . '</td>';
				echo '<td>' . $row[2] . '</td>';
				echo '<td>' . $row[3] . '</td>';
				echo '<td>' . $row[4] . '</td>';
				echo '<td>' . $row[5] . '</td>';
				echo '<td>' . $row[6]. '</td></tr>';	
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
		$rows=mysql_num_rows(mysql_query("select * from workers WHERE $where"));
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

